{{-- فرم ایجاد کاربر جدید --}}
@extends('admin-panel.layouts.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><i class="fa fa-user-plus"></i> ایجاد کاربر جدید</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"><i class="fa fa-user"></i> نام</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="email"><i class="fa fa-envelope"></i> ایمیل</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password"><i class="fa fa-lock"></i> رمز عبور</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation"><i class="fa fa-lock"></i> تکرار رمز عبور</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ذخیره</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> بازگشت</a>
    </form>
</div>
@endsection 