<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPassController extends Controller
{
    public function view() {
        return view('auth.forgotpass');
    }
    public function viewcode(Request $request) {
        return view('auth.codeforgot');
    }
    public function viewreset(Request $request) {
        if(!session('otp_verified')) return redirect('/forgotpass');
        return view('auth.resetpass');
    }
    public function done() {
        return view('auth.done');
    }

    public function sendcode(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expired_at = now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new kirimEmail($otp, $user->name));
        session(['reset_email' => $user->email]);
        return redirect('/codepass')->with('success', 'Kode OTP telah dikirim ke email.');
    }
    public function verifyCode(Request $request)
    {
        $request->validate(['full_otp' => 'required']);
        $user = User::where('email', session('reset_email'))->first();
        if(!$user || $user->otp !== $request->full_otp || now()->gt($user->otp_expired_at)) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }
        session(['otp_verified' => true]);
        return redirect('/resetpass');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
    
        $user = User::where('email', session('reset_email'))->first();
        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_expired_at = null;
        $user->save();
        session()->forget(['reset_email', 'otp_verified']);
        return redirect()->route('all-done')->with('success', 'Password berhasil diubah!');
    }

    public function kirimEmail()
    {
        $otp = "167890";
        $name = "admin";
        Mail::to('test-p8k1zhfrx@srv1.mail-tester.com')->send(new kirimEmail($otp,$name));
        return 'Email berhasil dikirim!';
    }

    public function email() {
        $otp = "167890";
        $name = "admin";
        return view('emails.emails', compact('otp','name'));
    }
}
