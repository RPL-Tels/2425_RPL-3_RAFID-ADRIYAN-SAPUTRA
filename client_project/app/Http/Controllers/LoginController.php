<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function logout(Request $request):RedirectResponse { 
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'exists:users,email', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $user = Auth::user();
                $fullName = $user->name;
                $shortName = implode(' ', array_slice(explode(' ',$fullName), 0, 3));
                return redirect()->route('dashboard-admin', ['ShortName' => $shortName]);
            } else {
                return redirect()->route('user-dashboard');
            }
        }
        return back()->withErrors(['loginerror' => 'Login failed! Please check your credentials and try again.']);
    }
    protected function showUserDashboard()
    {
        $user = Auth::user();
        $fullName = $user->name;
        $shortName = implode(' ', array_slice(explode(' ',$fullName), 0, 3));
        return view('user.dashboard', ['ShortName' => $shortName]);
    }
    protected function showAdminDashboard()
    {
        $user = Auth::user();
        $fullName = $user->name;
        $shortName = implode(' ', array_slice(explode(' ',$fullName), 0, 3));
        return view('admin.dashboard', compact('shortName'));
    }
}
