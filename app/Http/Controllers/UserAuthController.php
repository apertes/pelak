<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->where('type', 'citizen')->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            $redirect = $request->input('redirect') ?: '/';
            return redirect($redirect);
        } else {
            return back()->withInput()->with('login_error', 'ایمیل یا رمز عبور اشتباه است.');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => 'citizen',
        ]);
        Auth::login($user);
        return redirect('/')->with('register_success', 'ثبت‌نام با موفقیت انجام شد و وارد شدید.');
    }
} 