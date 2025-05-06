<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function Clients(Request $request) {
        $data = User::where('role', 'user')->paginate(5);
        return view('admin.client', compact('data'));
    }

    public function clientSearch(Request $request) {
        $query = $request->get('query');
        $data = User::query();

        if($query) {
            $data = $data->where(function($q) use ($query){
                            $q->where('name', 'LIKE', "%{$query}%")
                              ->orWhere('user_id', 'LIKE',"%{$query}%")
                              ->orWhere('email', 'LIKE', "%{$query}%")
                              ->orWhere('role', $query)
                              ->orWhere('number', 'LIKE', "%{$query}%");
                         });
        }
        $data = $data->where('role', 'user')->paginate(5);
        return view('admin.client_search', compact('data'));
    }

    public function addUser() {
        return view('admin.addUser');
    }

    public function editeUser($user_id) {
        $data = User::where('user_id', $user_id)->firstOrFail();
        return view('admin.editeUser', compact('data'));
    }

    public function editStore(Request $request, $user_id) {
         // Validasi data
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user_id . ',user_id'],
            'password' => ['nullable', 'string', 'min:6'],
            'company' => ['nullable', 'string'],
            'addres' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:22', 'unique:users,number,' . $user_id . ',user_id'],
        ]);

        // Cari user berdasarkan user_id
        $user = User::where('user_id', $user_id)->firstOrFail();

        // Siapkan data untuk update
        $userData = $request->only(['name', 'email', 'company', 'addres', 'number']);

        // Perbarui password jika diberikan
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Update data user
        $user->update($userData);

        return redirect()->route('admin-clients')->with('success', 'User updated successfully.');
    }

    public function userDelete($user_id) {
        // Cari user berdasarkan user_id
        $user = User::where('user_id', $user_id)->firstOrFail();

        // Hapus foto profil jika ada
        if ($user->profile_photo) {
            Storage::delete('public/profile_photos/'.$user->profile_photo);
        }

        // Hapus user
        $user->delete();

        return redirect()->route('admin-clients')->with('success', 'User deleted successfully.');
    }

    public function viewInvoice() {
        return view('admin.invoice');
    }
}