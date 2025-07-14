@extends('admin-panel.layouts.master')
@section('title', 'مدیریت مجوزها')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">مدیریت مجوزها</h2>
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success"><i class="zmdi zmdi-plus"></i> مجوز جدید</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>نام مجوز</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $perm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $perm->name }}</td>
                            <td>
                                <a href="{{ route('admin.permissions.edit', $perm) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                <form action="{{ route('admin.permissions.destroy', $perm) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('حذف شود؟')"><i class="zmdi zmdi-delete"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 