<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('frontend.layouts.register');
    }
    public function loginForm()
    {
        return view('frontend.layouts.login');
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:4'],
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/')->with('success', 'Successfully Registered.');
    }
     public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect('/')->with('success', 'You`re logged in.');
        }
        return back()->with('failed', 'Email or Password Wrong!.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'Please login.');;
    }
}
