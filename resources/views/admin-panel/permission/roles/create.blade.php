@extends('admin-panel.layouts.master')
@section('title', 'افزودن نقش جدید')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">افزودن نقش جدید</h2>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> بازگشت</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.roles.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">نام نقش</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="مثلاً: admin, employee, ...">
                </div>
                <div class="form-group mb-3">
                    <label>مجوزها</label>
                    <div class="row">
                        @foreach($permissions as $perm)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm{{ $perm->id }}">
                                    <label class="form-check-label" for="perm{{ $perm->id }}">{{ $perm->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">ذخیره نقش</button>
            </form>
        </div>
    </div>
</div>
@endsection 