{{-- فرم ایجاد سمت جدید --}}
@extends('admin-panel.layouts.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><i class="fa fa-plus"></i> ایجاد سمت جدید</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title"><i class="fa fa-sitemap"></i> عنوان سمت</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-sitemap"></i></span>
                </div>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="parent_id"><i class="fa fa-sitemap"></i> والد (اختیاری)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-sitemap"></i></span>
                </div>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">بدون والد</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ذخیره</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> بازگشت</a>
    </form>
</div>
@endsection 