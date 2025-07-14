@extends('admin-panel.layouts.master')
@section('title', 'افزودن مجوز جدید')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">افزودن مجوز جدید</h2>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> بازگشت</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">نام مجوز</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="مثلاً: edit tree, report tree, ...">
                </div>
                <button type="submit" class="btn btn-success w-100">ذخیره مجوز</button>
            </form>
        </div>
    </div>
</div>
@endsection 