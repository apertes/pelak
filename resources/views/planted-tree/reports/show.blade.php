@extends('admin-panel.layouts.master')
@section('title', 'جزئیات گزارش')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">جزئیات گزارش</h2>
        <a href="{{ route('planted-trees.reports.index', $report->planted_tree_id) }}" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> بازگشت به لیست گزارشات</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3 text-primary"><i class="fas fa-flag me-2"></i>{{ $report->title }}</h4>
            <p><strong>ثبت‌کننده:</strong> {{ $report->user->name ?? 'نامشخص' }}</p>
            <p><strong>وضعیت:</strong> @if($report->seen) <span class="badge bg-success">دیده شده</span> @else <span class="badge bg-warning text-dark">جدید</span> @endif</p>
            <p><strong>توضیحات:</strong></p>
            <div class="alert alert-light">{{ $report->description }}</div>
            @if($report->image)
                <div class="mb-3">
                    <strong>فایل/عکس:</strong><br>
                    <img src="{{ asset('storage/' . $report->image) }}" alt="گزارش" class="img-fluid rounded shadow" style="max-width: 400px;">
                </div>
            @endif
            <p class="text-muted"><i class="fas fa-calendar-alt me-1"></i>تاریخ ثبت: {{ jdate($report->created_at)->format('Y/m/d H:i') }}</p>
        </div>
    </div>
</div>
@endsection 