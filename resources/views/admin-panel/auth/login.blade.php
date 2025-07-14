@extends('admin-panel.layouts.master')
@section('title', 'ورود به پنل ادمین')
@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1.5rem;">
        <div class="text-center mb-4">
            <i class="material-icons" style="font-size: 48px; color: #185a9d;">admin_panel_settings</i>
            <h3 class="mb-0 mt-2" style="font-weight: bold; color: #185a9d;">ورود به پنل ادمین</h3>
        </div>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="email">ایمیل</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="ایمیل سازمانی">
            </div>
            <div class="form-group mb-3">
                <label for="password">رمز عبور</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="رمز عبور">
            </div>
            <button type="submit" class="btn btn-primary w-100" style="background: #185a9d; border: none; font-weight: bold;">ورود</button>
            @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif
        </form>
    </div>
</div>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection 