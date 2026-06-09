<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Rental;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. DATA CUSTOMERS (15 Data)
        // ==========================================
        $customers = [
            ['name' => 'Budi Santoso', 'phone' => '081234567801', 'address' => 'Jl. Merdeka No. 1, Jakarta', 'identity_number' => '3171234567890001'],
            ['name' => 'Siti Aminah', 'phone' => '081234567802', 'address' => 'Jl. Sudirman No. 2, Bandung', 'identity_number' => '3271234567890002'],
            ['name' => 'Andi Darmawan', 'phone' => '081234567803', 'address' => 'Jl. Thamrin No. 3, Surabaya', 'identity_number' => '3371234567890003'],
            ['name' => 'Rina Melati', 'phone' => '081234567804', 'address' => 'Jl. Gatot Subroto No. 4, Medan', 'identity_number' => '3471234567890004'],
            ['name' => 'Joko Widodo', 'phone' => '081234567805', 'address' => 'Jl. Asia Afrika No. 5, Solo', 'identity_number' => '3571234567890005'],
            ['name' => 'Dewi Lestari', 'phone' => '081234567806', 'address' => 'Jl. Diponegoro No. 6, Semarang', 'identity_number' => '3671234567890006'],
            ['name' => 'Agus Setiawan', 'phone' => '081234567807', 'address' => 'Jl. Pahlawan No. 7, Malang', 'identity_number' => '3771234567890007'],
            ['name' => 'Sari Indah', 'phone' => '081234567808', 'address' => 'Jl. Veteran No. 8, Yogyakarta', 'identity_number' => '3871234567890008'],
            ['name' => 'Hendra Gunawan', 'phone' => '081234567809', 'address' => 'Jl. Gajah Mada No. 9, Bali', 'identity_number' => '3971234567890009'],
            ['name' => 'Maya Sari', 'phone' => '081234567810', 'address' => 'Jl. Hayam Wuruk No. 10, Makassar', 'identity_number' => '3101234567890010'],
            ['name' => 'Eko Prasetyo', 'phone' => '081234567811', 'address' => 'Jl. Imam Bonjol No. 11, Padang', 'identity_number' => '3111234567890011'],
            ['name' => 'Fitriani', 'phone' => '081234567812', 'address' => 'Jl. Teuku Umar No. 12, Aceh', 'identity_number' => '3121234567890012'],
            ['name' => 'Dedi Saputra', 'phone' => '081234567813', 'address' => 'Jl. S. Parman No. 13, Balikpapan', 'identity_number' => '3131234567890013'],
            ['name' => 'Nina Marlina', 'phone' => '081234567814', 'address' => 'Jl. A. Yani No. 14, Banjarmasin', 'identity_number' => '3141234567890014'],
            ['name' => 'Rizky Aditya', 'phone' => '081234567815', 'address' => 'Jl. MT Haryono No. 15, Pontianak', 'identity_number' => '3151234567890015'],
        ];

        foreach ($customers as $customer) {
            // $customer['user_id'] = 1; // Buka komentar ini jika tabel customers sudah ada user_id
            Customer::create($customer);
        }


        // ==========================================
        // 2. DATA PRODUCTS (15 Data)
        // ==========================================
        $products = [
            ['name' => 'Kamera Canon EOS 700D', 'category' => 'Elektronik', 'stock' => 5, 'price_per_day' => 150000, 'description' => 'Kamera DSLR cocok untuk pemula.', 'image' => null],
            ['name' => 'Tenda Dome 4 Orang', 'category' => 'Outdoor', 'stock' => 10, 'price_per_day' => 50000, 'description' => 'Tenda camping double layer anti air.', 'image' => null],
            ['name' => 'Proyektor Epson EB-X41', 'category' => 'Elektronik', 'stock' => 3, 'price_per_day' => 200000, 'description' => 'Proyektor resolusi tinggi untuk presentasi/nobar.', 'image' => null],
            ['name' => 'PlayStation 5', 'category' => 'Gaming', 'stock' => 2, 'price_per_day' => 250000, 'description' => 'Konsol PS5 lengkap dengan 2 stik.', 'image' => null],
            ['name' => 'Sepeda Gunung Polygon', 'category' => 'Olahraga', 'stock' => 5, 'price_per_day' => 100000, 'description' => 'Sepeda MTB untuk medan terjal.', 'image' => null],
            ['name' => 'Sleeping Bag Polar', 'category' => 'Outdoor', 'stock' => 15, 'price_per_day' => 15000, 'description' => 'Sleeping bag hangat untuk di gunung.', 'image' => null],
            ['name' => 'Sound System Portable', 'category' => 'Elektronik', 'stock' => 4, 'price_per_day' => 120000, 'description' => 'Speaker aktif portable dengan mic wireless.', 'image' => null],
            ['name' => 'Nintendo Switch', 'category' => 'Gaming', 'stock' => 3, 'price_per_day' => 150000, 'description' => 'Nintendo Switch V2 full games.', 'image' => null],
            ['name' => 'Matras Camping', 'category' => 'Outdoor', 'stock' => 20, 'price_per_day' => 10000, 'description' => 'Matras spons nyaman untuk tidur.', 'image' => null],
            ['name' => 'Tripod Takara', 'category' => 'Elektronik', 'stock' => 8, 'price_per_day' => 25000, 'description' => 'Tripod kamera kokoh dan ringan.', 'image' => null],
            ['name' => 'HT Baofeng UV-5R', 'category' => 'Elektronik', 'stock' => 10, 'price_per_day' => 30000, 'description' => 'Handy Talky jarak jauh.', 'image' => null],
            ['name' => 'Kompor Portable', 'category' => 'Outdoor', 'stock' => 12, 'price_per_day' => 20000, 'description' => 'Kompor kotak camping (tanpa gas).', 'image' => null],
            ['name' => 'Drone DJI Mini 2', 'category' => 'Elektronik', 'stock' => 2, 'price_per_day' => 350000, 'description' => 'Drone aerial ringan dan mudah diterbangkan.', 'image' => null],
            ['name' => 'Kursi Lipat', 'category' => 'Outdoor', 'stock' => 15, 'price_per_day' => 15000, 'description' => 'Kursi santai lipat untuk mancing/camping.', 'image' => null],
            ['name' => 'Lensa Fix Canon 50mm', 'category' => 'Elektronik', 'stock' => 4, 'price_per_day' => 75000, 'description' => 'Lensa bokeh untuk potret.', 'image' => null],
        ];

        foreach ($products as $product) {
            // $product['user_id'] = 1; // Buka komentar ini jika tabel products sudah ada user_id
            Product::create($product);
        }


        // ==========================================
        // 3. DATA RENTALS (15 Data)
        // ==========================================
        // Kita asumsikan relasi 1 to 1 urutan untuk mempermudah (Customer 1 sewa Produk 1, dst)
        // $rentals = [];
        // for ($i = 1; $i <= 15; $i++) {
        //     $qty = rand(1, 2);
        //     $days = rand(1, 3);
            
        //     // Perhitungan harga (mengambil harga dari array products di atas - index array mulai dari 0)
        //     $pricePerDay = $products[$i - 1]['price_per_day'];
        //     $totalPrice = $pricePerDay * $days * $qty;

        //     // Status acak agar data lebih realistis
        //     $statuses = ['active', 'returned', 'cancelled'];
        //     $paymentStatuses = ['unpaid', 'dp', 'paid'];

        //     $rentalDate = Carbon::now()->subDays(rand(1, 10));
        //     $returnDate = (clone $rentalDate)->addDays($days);

        //     $rental = [
        //         'customer_id' => $i,
        //         'product_id' => $i,
        //         'qty' => $qty,
        //         'rental_date' => $rentalDate,
        //         'return_date' => $returnDate,
        //         'status' => $statuses[array_rand($statuses)],
        //         'total_price' => $totalPrice,
        //         'payment_status' => $paymentStatuses[array_rand($paymentStatuses)],
        //     ];

        //     // $rental['user_id'] = 1; // Buka komentar ini jika tabel rentals sudah ada user_id
        //     Rental::create($rental);
        // }
    }
}