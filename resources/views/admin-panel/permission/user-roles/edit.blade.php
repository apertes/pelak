@extends('admin-panel.layouts.master')
@section('title', 'ویرایش نقش‌های کاربر')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">ویرایش نقش‌های کاربر: {{ $user->name }}</h2>
        <a href="{{ route('admin.user-roles.index') }}" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> بازگشت</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.user-roles.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label>نقش‌ها</label>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role{{ $role->id }}" @if($user->roles->contains('name', $role->name)) checked @endif>
                                    <label class="form-check-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">ذخیره تغییرات</button>
            </form>
        </div>
    </div>
</div>
@endsection 