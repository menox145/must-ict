<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('registration.index', [
            'title' => 'register',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'password' => 'required|min:5|max:255',
            'unit_bagian' => 'required|in:dokter,perawat,it'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_admin'] = true;
        $validatedData['email'] = strtolower($validatedData['username']) . '@inventory.local';

        $user = User::create($validatedData);

        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
        }

        return back()->with('error', 'Registration failed. Please try again.');
    }
}
