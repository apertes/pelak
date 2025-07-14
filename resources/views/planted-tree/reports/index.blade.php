@extends('admin-panel.layouts.master')
@section('title', 'گزارشات ثبت‌شده برای درخت ' . $tree->id)
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">گزارشات ثبت‌شده برای درخت: <span class="text-primary">{{ $tree->id }}</span></h2>
        <a href="{{ route('tree.public.show', $tree->id) }}" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> بازگشت به جزییات درخت</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>عنوان گزارش</th>
                        <th>کاربر ثبت‌کننده</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->user->name ?? 'نامشخص' }}</td>
                            <td>
                                @if($report->seen)
                                    <span class="badge bg-success">دیده شده</span>
                                @else
                                    <span class="badge bg-warning text-dark">جدید</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tree-reports.show', $report->id) }}" class="btn btn-info btn-sm"><i class="zmdi zmdi-eye"></i> مشاهده</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 