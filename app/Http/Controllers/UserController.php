<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Models\Rental;
use App\Models\Customer;
use App\Models\Product;


class UserController extends Controller
{
    public function dashboard()
    {
        $totalProduk = Product::count();

        $totalCustomer = Customer::count();

        $rentalAktif = Rental::where('status', 'rented')
            ->orWhere('status', 'late')
            ->count();

        $totalRevenue = Rental::where('status', 'rented')->orWhere('status', 'paid')
            ->sum('total_price');

        return view('admin.dashboard', compact('totalProduk', 'totalCustomer', 'rentalAktif', 'totalRevenue'));
    }

    public function showRegister()
    {
        if (User::exists()) {
            return redirect()->route('login')->withErrors(['register' => 'Maaf, pendaftaran ditutup karena akun utama sudah dikonfigurasi.']);
        }

        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        if (User::exists()) {
            return redirect()->route('login')->withErrors(['register' => 'Maaf, data pengguna sudah ada. Registrasi dilarang!']);
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan data pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Registrasi berhasil!');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Coba login pengguna
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
