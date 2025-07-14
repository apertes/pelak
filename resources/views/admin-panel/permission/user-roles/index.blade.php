@extends('admin-panel.layouts.master')
@section('title', 'اختصاص نقش به کاربر')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">اختصاص نقش به کاربر</h2>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>نام کاربر</th>
                        <th>ایمیل</th>
                        <th>نقش‌ها</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge badge-info">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.user-roles.edit', $user) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i> ویرایش نقش</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 