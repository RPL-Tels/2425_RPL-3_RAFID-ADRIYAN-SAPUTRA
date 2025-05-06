<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function update(request $request) {
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
        ]);
    
        $user = auth()->user();
    
        // Jika ada file yang di-upload
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::delete('public/profile_photos/' . $user->profile_photo);
            }
    
            // Simpan foto baru
            $fileName = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('public/profile_photos', $fileName);
    
            // Update kolom profile_photo di database
            $user->profile_photo = $fileName;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function deleteavatar() {
        $user = auth()->user();

        // Cek jika user memiliki foto profil yang sudah diupload
        if ($user->profile_photo) {
            // Hapus foto lama
            Storage::delete('public/profile_photos/' . $user->profile_photo);
    
            // Set foto profil menjadi default (misalnya, 'default.png')
            $user->profile_photo = '';
            $user->save();
        }
    
        return redirect()->back()->with('success', 'Profile photo successfully deleted!'); 
    }

    public function updates(Request $request) {
        $user = Auth::user();
        $request->validate([
            'email' => 'required|string|max:255|unique:users,email,'. $user->id,
            'number' => 'required|max:14|string|min:6|unique:users,number,'. $user->id,
        ],[
            'email' => 'The email already taken',
            'number' => 'The phone number already taken',
        ]);

        $dataToUpdate = [];
        if ($request->email != $user->email) {
            $dataToUpdate['email'] = $request->email;
        }

        if ($request->number != $user->number) {
            $dataToUpdate['number'] = $request->number;
        }

        if (!empty($dataToUpdate)) {
            $user->update($dataToUpdate);
        }

        return redirect()->back()->with('success','your account has been updated.');
    }

    public function updatepass(request $request) {
        $request->validate([
            'current_password' => 'required',
            // 'new_password' => 'required|min:8|confirmed',
            'new_password' => [
                'required', 
                'string', 
                'min:8',               // Password minimal 8 karakter
                'confirmed',           // Harus cocok dengan field 'new_password_confirmation'
                'regex:/[a-z]/',       // Harus ada huruf kecil
                'regex:/[A-Z]/',       // Harus ada huruf besar
                'regex:/[0-9]/',       // Harus ada angkax
                'regex:/[@$!%*#?&]/',
            ],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }
        
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
            'update_at' => now(),
        ]);
    
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
        // Redirect dengan status sukses
        // return redirect()->back()->with('status', 'Password berhasil diubah!');
    }
}
