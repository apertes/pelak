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
            <div class="row">
                <div class="col-md-8">
                    <h4 class="mb-3 text-primary"><i class="fas fa-flag me-2"></i>{{ $report->title }}</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>ثبت‌کننده:</strong> {{ $report->user->name ?? 'نامشخص' }}</span>
                            <span class="text-muted"><i class="zmdi zmdi-account"></i> کد کاربر: {{ $report->user->id ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>درخت مربوطه:</strong> 
                                @if($report->plantedTree)
                                    <a href="{{ route('tree.public.show', $report->planted_tree_id) }}" class="text-primary">
                                        {{ $report->plantedTree->name ?? 'درخت شماره ' . $report->planted_tree_id }}
                                    </a>
                                @else
                                    نامشخص
                                @endif
                            </span>
                            <span class="text-muted"><i class="zmdi zmdi-nature"></i> کد درخت: {{ $report->planted_tree_id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>وضعیت:</strong> @if($report->seen) <span class="badge bg-success">دیده شده</span> @else <span class="badge bg-warning text-dark">جدید</span> @endif</span>
                            <span class="text-muted"><i class="zmdi zmdi-calendar"></i> تاریخ ثبت: {{ \Morilog\Jalali\Jalalian::fromDateTime($report->created_at)->format('Y/m/d H:i') }}</span>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <strong>توضیحات:</strong>
                        <div class="alert alert-light mt-2">{{ $report->description }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if($report->image)
                        <div class="mb-3">
                            <strong>فایل/عکس:</strong><br>
                            <img src="{{ asset('storage/' . $report->image) }}" alt="گزارش" class="img-fluid rounded shadow" style="max-width: 100%;">
                        </div>
                    @endif
                    @if($report->plantedTree)
                        <div class="card mt-3">
                            <div class="card-header bg-light text-primary"><i class="zmdi zmdi-nature"></i> اطلاعات درخت</div>
                            <div class="card-body p-2">
                                <ul class="list-unstyled mb-0">
                                    <li><strong>نام:</strong> {{ $report->plantedTree->tree->name ?? '-' }}</li>
                                    <li><strong>موقعیت:</strong> {{ $report->plantedTree->location->name ?? '-' }}</li>
                                    <li><strong>نوع:</strong> {{ $report->plantedTree->tree->group->name ?? '-' }}</li>
                                    <li><strong>کد درخت:</strong> {{ $report->plantedTree->id }}</li>
                                    <li><strong>موقعیت دقیق (Position):</strong> {{ $report->plantedTree->position->name ?? '-' }}</li>
                                </ul>
                                @if($report->plantedTree->image)
                                    <div class="mt-3">
                                        <strong>عکس درخت:</strong><br>
                                        <img src="{{ asset('storage/' . $report->plantedTree->image) }}" alt="عکس درخت" class="img-fluid rounded shadow" style="max-width: 100%;">
                                    </div>
                                @endif
                                @if($report->plantedTree->latitude && $report->plantedTree->longitude)
                                    <div class="mt-3">
                                        <strong>موقعیت روی نقشه:</strong>
                                        <div style="width: 100%; height: 200px; border-radius: 8px; overflow: hidden;">
                                            <iframe width="100%" height="200" frameborder="0" style="border:0" allowfullscreen
                                                src="https://www.openstreetmap.org/export/embed.html?bbox={{ $report->plantedTree->longitude - 0.001 }},{{ $report->plantedTree->latitude - 0.001 }},{{ $report->plantedTree->longitude + 0.001 }},{{ $report->plantedTree->latitude + 0.001 }}&amp;layer=mapnik&amp;marker={{ $report->plantedTree->latitude }},{{ $report->plantedTree->longitude }}">
                                            </iframe>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 