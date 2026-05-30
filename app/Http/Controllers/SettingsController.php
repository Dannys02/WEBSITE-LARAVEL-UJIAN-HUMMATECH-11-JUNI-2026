<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Show the settings page for the authenticated user
     */
    public function showSettings()
    {
        $user = Auth::user();
        return view('auth.settings', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'phone.max' => 'Nomor HP maksimal 20 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format file harus: jpeg, png, jpg, atau webp',
            'image.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('image')) {
            // Delete old picture if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Store new picture
            $path = $request->file('image')->store('profile-pictures', 'public');
            $validated['image'] = $path;
        }

        // Update user
        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'different:current_password',
                'confirmed',
            ],
        ], [
            'current_password.required' => 'Password saat ini tidak boleh kosong',
            'password.required' => 'Password baru tidak boleh kosong',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.different' => 'Password baru tidak boleh sama dengan password saat ini',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        // Update password
        $user->update([
            'password' => bcrypt($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
