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
        // Memuat customer dan detail produknya
        $query = Rental::with(['customer', 'details.product']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $rentals = $query->latest()->paginate(10);
        $customers = Customer::orderBy('name', 'asc')->get();

        // Mengambil produk beserta harga sewa per harinya
        // Sesuaikan price_per_day dengan nama kolom harga di tabel products Anda (misal: rental_price)
        $products = Product::select('id', 'name', 'price_per_day')->orderBy('name', 'asc')->get();

        return view('admin.rental.index', compact('rentals', 'customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'product_ids'   => 'required|array|min:1',
            'product_ids.*' => 'exists:products,id',
            'rental_date'   => 'required|date',
            'return_date'   => 'required|date|after_or_equal:rental_date',
            'status'        => 'required|in:rented,returned,late',
            'payment_status' => 'required|in:unpaid,dp,paid',
        ]);

        // Hitung selisih hari (Minimal 1 hari sewa jika di hari yang sama)
        $start = Carbon::parse($request->rental_date);
        $end = Carbon::parse($request->return_date);
        $days = $start->diffInDays($end);
        if ($days == 0) $days = 1;

        // Hitung Total Harga dari semua produk yang dipilih
        $totalPrice = 0;
        $productsData = Product::whereIn('id', $request->product_ids)->get();

        foreach ($productsData as $product) {
            // Gunakan $product->price atau nama field harga Anda
            $totalPrice += ($product->price * $days);
        }

        // 1. Simpan data utama Rental
        $rental = Rental::create([
            'customer_id'    => $request->customer_id,
            'rental_date'    => $request->rental_date,
            'return_date'    => $request->return_date,
            'status'         => $request->status,
            'total_price'    => $totalPrice,
            'payment_status' => $request->payment_status,
        ]);

        // 2. Simpan ke tabel detail (RentalDetail) untuk tiap produk yang dipilih
        foreach ($productsData as $product) {
            RentalDetail::create([
                'rental_id'  => $rental->id,
                'product_id' => $product->id,
                'price_per_day' => $product->price_per_day, // Menyimpan snapshot harga saat disewa
            ]);
        }

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental banyak produk berhasil dibuat.');
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'product_ids'   => 'required|array|min:1',
            'product_ids.*' => 'exists:products,id',
            'rental_date'   => 'required|date',
            'return_date'   => 'required|date|after_or_equal:rental_date',
            'status'        => 'required|in:rented,returned,late',
            'payment_status' => 'required|in:unpaid,dp,paid',
        ]);

        $start = Carbon::parse($request->rental_date);
        $end = Carbon::parse($request->return_date);
        $days = $start->diffInDays($end);
        if ($days == 0) $days = 1;

        $totalPrice = 0;
        $productsData = Product::whereIn('id', $request->product_ids)->get();

        foreach ($productsData as $product) {
            $totalPrice += ($product->price * $days);
        }

        // Update data utama
        $rental->update([
            'customer_id'    => $request->customer_id,
            'rental_date'    => $request->rental_date,
            'return_date'    => $request->return_date,
            'status'         => $request->status,
            'total_price'    => $totalPrice,
            'payment_status' => $request->payment_status,
        ]);

        // Sinkronisasi/Reset detail produk lama dengan yang baru
        RentalDetail::where('rental_id', $rental->id)->delete();
        foreach ($productsData as $product) {
            RentalDetail::create([
                'rental_id'  => $rental->id,
                'product_id' => $product->id,
                'price_per_day' => $product->price_per_day,
            ]);
        }

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil diperbarui.');
    }

    public function destroy(Rental $rental)
    {
        // Karena cascadeOnDelete() sudah diset di migration,
        // detail akan otomatis terhapus saat rental didelete
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil dihapus.');
    }
}
