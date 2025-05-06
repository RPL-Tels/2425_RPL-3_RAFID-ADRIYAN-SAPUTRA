<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'company' => ['required', 'string','unique:users'],
            'addres' => ['required', 'string', 'min:6', 'max:255'],
            'number' => ['required', 'string', 'min:6' ,'max:22', 'unique:users'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company' => $request->company,
            'addres' => $request->addres,
            'number' => $request ->number,
            'user_id' => 'U-' . strtoupper(Str::random(4)),
        ]);
        return Redirect()->route('login');
    }
}
