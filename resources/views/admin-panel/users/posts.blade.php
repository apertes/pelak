{{-- فرم انتساب سمت به کاربر --}}
@extends('admin-panel.layouts.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><i class="fa fa-user-tag"></i> انتساب سمت به {{ $user->name }}</h1>
    <form action="{{ route('admin.users.posts.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label><i class="fa fa-sitemap"></i> انتخاب سمت‌ها</label>
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="posts[]" value="{{ $post->id }}" id="post_{{ $post->id }}" {{ $user->posts->contains($post->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="post_{{ $post->id }}">
                                <i class="fa fa-sitemap"></i> {{ $post->title }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('posts')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ذخیره سمت‌ها</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> بازگشت</a>
    </form>
</div>
@endsection 