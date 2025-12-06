<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return redirect()->route('home');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        // Validate the input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'visitor',
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to home
        return redirect()->route('home')->with('success', 'Welcome to TheSPARK! Your account has been created successfully.');
    }
}
