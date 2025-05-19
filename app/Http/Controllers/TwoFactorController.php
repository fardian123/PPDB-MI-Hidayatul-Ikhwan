<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    /**
     * Tampilkan form input kode OTP
     */
    public function index()
    {
        return view('auth.two-factor');
    }

    /**
     * Kirim OTP ke email user saat diminta
     */

     
    public function send(Request $request)
    {
        $user = auth()->user();

        // Generate kode 6 digit dan simpan
        $code = rand(100000, 999999);
        $user->two_factor_code = $code;
        $user->save();

        // Kirim kode ke email
        Mail::raw("Kode verifikasi dua faktor Anda adalah: $code", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject("Kode Verifikasi - SPMB Hidayatul Ikhwan");
        });
        \Log::info("User input code: {$request->code}, actual: {$user->two_factor_code}");


        return redirect()->route('two-factor.index')->with('status', 'Kode Verifikasi telah dikirim ke email Anda.');
    }

    /**
     * Verifikasi kode OTP
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ]);
    
        $user = auth()->user();
    
        if ($request->code == $user->two_factor_code) {
            // Set session agar lolos middleware
            session(['two_factor_authenticated' => true]);
    
            // Kosongkan kode
            $user->two_factor_code = null;
            $user->is_verified = true;
            $user->save();

            
            if($user->role == "petugas"){
                return redirect("/petugas/dashboard");
                
                
            }
            return redirect('/dashboard');
        }
    
        return redirect()->route('two-factor.index')->withErrors([
            'code' => 'Kode verifikasi salah.',
        ]);
    }
}
