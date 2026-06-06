<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Customer;
use App\Models\Product;
use App\Models\RentalDetail; // Pastikan model ini ada
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        // Auto-update status to late if return date has passed and status is still rented
        Rental::where('status', 'rented')
            ->where('return_date', '<', Carbon::now())
            ->update(['status' => 'late']);

        $query = Rental::with(['customer', 'product']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $rentals = $query->latest()->paginate(10);
        $customers = Customer::orderBy('name', 'asc')->get();
        $products = Product::select('id', 'name', 'price_per_day', 'stock')->orderBy('name', 'asc')->get();

        return view('admin.rental.index', compact('rentals', 'customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'product_id'    => 'required|exists:products,id',
            'qty'           => 'required|integer|min:1',
            'rental_date'   => 'required|date|after_or_equal:today',
            'return_date'   => 'required|date|after:rental_date',
            'status'        => 'required|in:rented,returned,late',
            'payment_status' => 'required|in:unpaid,dp,paid',
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty;

        $isBorrowed = in_array($request->status, ['rented', 'late']);
        if ($isBorrowed) {
            if ($product->stock < $qty) {
                return redirect()->back()->withErrors(['product_id' => 'Stok produk tidak mencukupi untuk disewa.'])->withInput();
            }
            $product->decrement('stock', $qty);
        }

        // Hitung selisih jam (Minimal 1 hari sewa)
        $start = Carbon::parse($request->rental_date);
        $end = Carbon::parse($request->return_date);
        $hours = $start->diffInHours($end);
        $days = ceil($hours / 24);
        if ($days <= 0) $days = 1;

        $totalPrice = $product->price_per_day * $days * $qty;

        // 1. Simpan data utama Rental
        $rental = Rental::create([
            'customer_id'    => $request->customer_id,
            'product_id'     => $request->product_id,
            'qty'            => $qty,
            'rental_date'    => $request->rental_date,
            'return_date'    => $request->return_date,
            'status'         => $request->status,
            'total_price'    => $totalPrice,
            'payment_status' => $request->payment_status,
        ]);

        // 2. Simpan ke tabel detail (RentalDetail) untuk produk yang dipilih
        RentalDetail::create([
            'rental_id'     => $rental->id,
            'product_id'    => $product->id,
            'qty'           => $qty,
            'price'         => $product->price_per_day,
            'subtotal'      => $totalPrice,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil dibuat.');
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'product_id'    => 'required|exists:products,id',
            'qty'           => 'required|integer|min:1',
            'rental_date'   => 'required|date|after_or_equal:today',
            'return_date'   => 'required|date|after:rental_date',
            'status'        => 'required|in:rented,returned,late',
            'payment_status' => 'required|in:unpaid,dp,paid',
        ]);

        $oldQty = $rental->qty;
        $oldProductId = $rental->product_id;
        $oldStatus = $rental->status;
        $newProductId = $request->product_id;
        $newStatus = $request->status;
        $newQty = $request->qty;

        $oldWasBorrowed = in_array($oldStatus, ['rented', 'late']);
        $newIsBorrowed = in_array($newStatus, ['rented', 'late']);

        $product = Product::findOrFail($newProductId);

        // 1. Temporarily restore stock of the old product if it was borrowed
        if ($oldWasBorrowed) {
            $oldProduct = Product::find($oldProductId);
            if ($oldProduct) {
                $oldProduct->increment('stock', $oldQty);
                if ($oldProductId == $newProductId) {
                    $product->refresh();
                }
            }
        }

        // 2. If the new status is borrowed, check and decrement the new product stock
        if ($newIsBorrowed) {
            if ($product->stock < $newQty) {
                // Revert the temporary restore before returning error
                if ($oldWasBorrowed) {
                    $oldProduct = Product::find($oldProductId);
                    if ($oldProduct) {
                        $oldProduct->decrement('stock', $oldQty);
                    }
                }
                return redirect()->back()->withErrors(['product_id' => 'Stok produk tidak mencukupi untuk disewa.'])->withInput();
            }
            $product->decrement('stock', $newQty);
        }

        $start = Carbon::parse($request->rental_date);
        $end = Carbon::parse($request->return_date);
        $hours = $start->diffInHours($end);
        $days = ceil($hours / 24);
        if ($days <= 0) $days = 1;

        $totalPrice = $product->price_per_day * $days * $newQty;

        // Update data utama
        $rental->update([
            'customer_id'    => $request->customer_id,
            'product_id'     => $request->product_id,
            'qty'            => $newQty,
            'rental_date'    => $request->rental_date,
            'return_date'    => $request->return_date,
            'status'         => $request->status,
            'total_price'    => $totalPrice,
            'payment_status' => $request->payment_status,
        ]);

        // Sinkronisasi/Reset detail produk lama dengan yang baru
        RentalDetail::where('rental_id', $rental->id)->delete();
        RentalDetail::create([
            'rental_id'     => $rental->id,
            'product_id'    => $product->id,
            'qty'           => $newQty,
            'price'         => $product->price_per_day,
            'subtotal'      => $totalPrice,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil diperbarui.');
    }

    public function destroy(Rental $rental)
    {
        $wasBorrowed = in_array($rental->status, ['rented', 'late']);
        if ($wasBorrowed) {
            $qty = $rental->qty;
            $product = Product::find($rental->product_id);
            if ($product) {
                $product->increment('stock', $qty);
            }
        }
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil dihapus.');
    }

    public function borrowedList(Request $request)
    {
        // Auto-update status to late if return date has passed and status is still rented
        Rental::where('status', 'rented')
            ->where('return_date', '<', Carbon::now())
            ->update(['status' => 'late']);

        $query = Rental::with(['customer', 'product'])
            ->whereIn('status', ['rented', 'late']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $rentals = $query->latest()->paginate(10);

        return view('admin.borrowed.index', compact('rentals'));
    }

    public function returnRental(Rental $rental)
    {
        if (in_array($rental->status, ['rented', 'late'])) {
            $rental->update(['status' => 'returned']);

            $qty = $rental->qty;
            $product = Product::find($rental->product_id);
            if ($product) {
                $product->increment('stock', $qty);
            }

            return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
        }

        return redirect()->back()->withErrors(['error' => 'Transaksi tidak dapat dikembalikan.']);
    }

    public function cancelRental(Rental $rental)
    {
        $wasBorrowed = in_array($rental->status, ['rented', 'late']);
        if ($wasBorrowed) {
            $qty = $rental->qty;
            $product = Product::find($rental->product_id);
            if ($product) {
                $product->increment('stock', $qty);
            }
        }

        $rental->delete();

        return redirect()->back()->with('success', 'Transaksi rental berhasil dibatalkan dan dihapus.');
    }
}
