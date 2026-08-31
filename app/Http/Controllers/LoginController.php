<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = \App\Models\User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()->with('loginError', 'Username tidak ditemukan.');
        }

        if (!Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], true)) {
            return back()->with('loginError', 'Password salah.');
        }

        $request->session()->regenerate();

        if (Auth::user()->is_admin) {
            return redirect()->intended('/pinjam')->with('success', 'Login berhasil. Selamat datang, Admin!');
        }

        return redirect()->intended('/pinjam/form')->with('success', 'Login berhasil. Selamat datang!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
    protected function authenticated()
    {
        return redirect('/login');
    }
}
