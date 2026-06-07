<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\UpdatePasswordRequest;

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

    public function updateProfile(SettingRequest $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validated();

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

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validated();

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
