@extends('admin-panel.layouts.master')
@section('title', 'ویرایش مجوز')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">ویرایش مجوز: {{ $permission->name }}</h2>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> بازگشت</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">نام مجوز</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{ $permission->name }}">
                </div>
                <button type="submit" class="btn btn-primary w-100">ذخیره تغییرات</button>
            </form>
        </div>
    </div>
</div>
@endsection 