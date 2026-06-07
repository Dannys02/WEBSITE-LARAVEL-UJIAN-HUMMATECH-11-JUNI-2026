<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalRequest;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Product;
use App\Models\RentalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with(['customer', 'product']);

        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        $rentals = $query->latest()->paginate(10);
        $customers = Customer::orderBy('name', 'asc')->get();
        $products = Product::select('id', 'name', 'price_per_day', 'stock')->orderBy('name', 'asc')->get();

        return view('admin.rental.index', compact('rentals', 'customers', 'products'));
    }

    public function store(RentalRequest $request)
    {
        DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);
            $qty = $request->qty;

            // Validasi dan potong stok jika status active
            if ($request->status === 'active') {
                if ($product->stock < $qty) {
                    throw ValidationException::withMessages([
                        'product_id' => 'Stok produk tidak mencukupi untuk disewa'
                    ]);
                }
                $product->decrement('stock', $qty);
            }

            $totalDays = $this->calculateTotalDays($request->rental_date, $request->return_date);
            $totalPrice = $product->price_per_day * $totalDays * $qty;

            // Simpan Rental
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

            // Simpan Detail
            RentalDetail::create([
                'rental_id'  => $rental->id,
                'product_id' => $product->id,
                'qty'        => $qty,
                'price'      => $product->price_per_day,
                'subtotal'   => $totalPrice,
            ]);
        });

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil dibuat!');
    }

    public function update(RentalRequest $request, Rental $rental)
    {
        DB::transaction(function () use ($request, $rental) {
            $product = Product::findOrFail($request->product_id);

            $oldWasBorrowed = $rental->status === 'active';
            $newIsBorrowed = $request->status === 'active';

            // 1. Kembalikan stok lama sementara (jika sebelumnya disewa)
            if ($oldWasBorrowed) {
                Product::where('id', $rental->product_id)->increment('stock', $rental->qty);
            }

            // 2. Refresh instance product (karena bisa jadi produk barunya = produk lama yang baru saja ditambah stoknya)
            if ($rental->product_id == $product->id) {
                $product->refresh();
            }

            // 3. Potong stok baru jika status baru active
            if ($newIsBorrowed) {
                if ($product->stock < $request->qty) {
                    throw ValidationException::withMessages([
                        'product_id' => 'Stok produk tidak mencukupi untuk disewa.'
                    ]);
                }
                $product->decrement('stock', $request->qty);
            }

            $totalDays = $this->calculateTotalDays($request->rental_date, $request->return_date);
            $totalPrice = $product->price_per_day * $totalDays * $request->qty;

            // 4. Update data rental
            $rental->update([
                'customer_id'    => $request->customer_id,
                'product_id'     => $request->product_id,
                'qty'            => $request->qty,
                'rental_date'    => $request->rental_date,
                'return_date'    => $request->return_date,
                'status'         => $request->status,
                'total_price'    => $totalPrice,
                'payment_status' => $request->payment_status,
            ]);

            // 5. Update detail rental
            RentalDetail::where('rental_id', $rental->id)->delete();
            RentalDetail::create([
                'rental_id'  => $rental->id,
                'product_id' => $product->id,
                'qty'        => $request->qty,
                'price'      => $product->price_per_day,
                'subtotal'   => $totalPrice,
            ]);
        });

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil diperbarui!');
    }

    public function destroy(Rental $rental)
    {
        DB::transaction(function () use ($rental) {
            // FIX: Hanya kembalikan stok jika statusnya 'active'.
            // Jika statusnya 'cancelled', stok sudah dikembalikan oleh fungsi cancelRental.
            if ($rental->status === 'active') {
                Product::where('id', $rental->product_id)->increment('stock', $rental->qty);
            }

            $rental->delete();
        });

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil dihapus!');
    }

    public function borrowedList(Request $request)
    {
        $query = Rental::with(['customer', 'product'])->where('status', 'active');

        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        $rentals = $query->latest()->paginate(10);

        return view('admin.borrowed.index', compact('rentals'));
    }

    public function returnRental(Rental $rental)
    {
        if ($rental->status !== 'active') {
            return redirect()->back()->withErrors(['error' => 'Transaksi tidak dapat dikembalikan!']);
        }

        DB::transaction(function () use ($rental) {
            $rental->update(['status' => 'returned']);
            Product::where('id', $rental->product_id)->increment('stock', $rental->qty);
        });

        return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
    }

    public function cancelRental(Rental $rental)
    {
        if ($rental->status === 'active') {
            DB::transaction(function () use ($rental) {
                Product::where('id', $rental->product_id)->increment('stock', $rental->qty);
                $rental->update(['status' => 'cancelled']);
            });

            return redirect()->back()->with('success', 'Transaksi rental berhasil dibatalkan!');
        }

        return redirect()->back()->withErrors(['error' => 'Hanya transaksi aktif yang bisa dibatalkan!']);
    }

    /**
     * Helper method untuk menghitung total hari sewa.
     */
    private function calculateTotalDays($startDate, $endDate): int
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $hours = $start->diffInHours($end);
        $days = (int) ceil($hours / 24);

        return $days > 0 ? $days : 1;
    }
}
