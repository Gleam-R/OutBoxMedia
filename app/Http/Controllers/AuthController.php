<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle registration request
    public function register(Request $request)
    {
        // Validate registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Ensure passwords match
        ]);

        // Create the user with the default 'user' role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before saving
            'role' => 'user', // Automatically assign the 'user' role
        ]);

        // Log the user in after registration
        Auth::login($user);

        // Redirect based on role
        return redirect()->route('berita.index'); // Redirect to the user's dashboard or desired route
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login attempt
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Melakukan login
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.berita.index'); // Admin route
            } else {
                return redirect()->route('user.berita.index'); // User route
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }



    // Logout the user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('berita.index'); // Redirect to homepage after logout
    }
}
