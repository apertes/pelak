<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * نمایش فرم لاگین ادمین
     */
    public function __invoke(Request $request)
    {
        return view('admin-panel.auth.login');
    }

    /**
     * پردازش لاگین ادمین
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'ایمیل یا رمز عبور اشتباه است.');
        }
        // فقط کاربرانی که نقش admin یا مجوز دسترسی به پنل ادمین دارند
        if (!$user->hasRole('admin') && !$user->can('access admin panel')) {
            return back()->with('error', 'شما مجوز ورود به پنل ادمین را ندارید.');
        }
        Auth::login($user, true);
        return redirect()->route('admin.dashboard');
    }
}
