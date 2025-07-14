@extends('admin-panel.layouts.master')
@section('title', 'مدیریت نقش‌ها')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">مدیریت نقش‌ها</h2>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success"><i class="zmdi zmdi-plus"></i> نقش جدید</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>نام نقش</th>
                        <th>مجوزها</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $perm)
                                    <span class="badge badge-info">{{ $perm->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if(!$role->is_post_role)
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('حذف شود؟')"><i class="zmdi zmdi-delete"></i></button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled><i class="zmdi zmdi-edit"></i></button>
                                    <button class="btn btn-secondary btn-sm" disabled><i class="zmdi zmdi-delete"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 