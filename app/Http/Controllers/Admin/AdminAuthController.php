<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin-panel.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_field' => 'required',
            'password' => 'required',
        ]);

        $loginField = $request->input('login_field');
        $password = $request->input('password');

        // تشخیص نوع ورودی
        if (filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        } elseif (preg_match('/^09\d{9}$/', $loginField)) {
            $fieldType = 'phone';
        } elseif (preg_match('/^\d{10}$/', $loginField)) {
            $fieldType = 'national_code';
        } else {
            return back()->withErrors(['login_field' => 'فرمت ورودی صحیح نیست.']);
        }

        $credentials = [
            $fieldType => $loginField,
            'password' => $password,
            'type' => 'employee',
        ];
    //  dd($credentials);
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['login_field' => 'اطلاعات وارد شده صحیح نیست یا شما کارمند نیستید.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
} 