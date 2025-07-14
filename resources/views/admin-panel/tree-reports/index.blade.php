@extends('admin-panel.layouts.master')
@section('title', 'لیست همه گزارشات درختان')
@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="zmdi zmdi-flag me-2"></i>لیست همه گزارشات درختان
                    </h4>
                    
                    @if($reports->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-center align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان گزارش</th>
                                        <th>کاربر ثبت‌کننده</th>
                                        <th>درخت مربوطه</th>
                                        <th>وضعیت</th>
                                        <th>تاریخ ثبت</th>
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
                                                <a href="{{ route('tree.public.show', $report->planted_tree_id) }}" class="text-primary">
                                                    درخت شماره {{ $report->planted_tree_id }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($report->seen)
                                                    <span class="badge bg-success">دیده شده</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">جدید</span>
                                                @endif
                                            </td>
                                            <td>{{ jdate($report->created_at)->format('Y/m/d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('tree-reports.show', $report->id) }}" class="btn btn-info btn-sm">
                                                    <i class="zmdi zmdi-eye"></i> مشاهده
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $reports->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="zmdi zmdi-info-outline me-2"></i>
                            هیچ گزارشی ثبت نشده است.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 