@extends('admin-panel.layouts.master')

@section('title', 'تولید انبوه کدهای QR')

@section('content')
<div class="ecaps-content-wrapper">
    <div class="ecaps-content">
        <div class="ecaps-page-header">
            <h1>تولید انبوه کدهای QR</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تولید انبوه کدهای QR</li>
                </ol>
            </nav>
        </div>

        <div class="ecaps-content-inner">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تولید کدهای QR برای محدوده مشخص</h4>
                            <p class="card-text">شماره شروع و پایان را وارد کنید تا کدهای QR برای تمام درختان در این محدوده تولید شود.</p>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.qr-generator.generate') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_id" class="form-label">شماره شروع <span class="text-danger">*</span></label>
                                            <input type="number" 
                                                   class="form-control @error('start_id') is-invalid @enderror" 
                                                   id="start_id" 
                                                   name="start_id" 
                                                   value="{{ old('start_id') }}" 
                                                   min="1" 
                                                   required>
                                            @error('start_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_id" class="form-label">شماره پایان <span class="text-danger">*</span></label>
                                            <input type="number" 
                                                   class="form-control @error('end_id') is-invalid @enderror" 
                                                   id="end_id" 
                                                   name="end_id" 
                                                   value="{{ old('end_id') }}" 
                                                   min="1" 
                                                   required>
                                            @error('end_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            <i class="zmdi zmdi-info"></i>
                                            <strong>نکته:</strong> 
                                            برای هر شماره در محدوده مشخص شده، یک کد QR تولید می‌شود که شامل لینک به صفحه نمایش اطلاعات درخت است. 
                                            تمام کدهای QR در یک فایل ZIP دانلود خواهند شد.
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="zmdi zmdi-download"></i>
                                            تولید و دانلود کدهای QR
                                        </button>
                                       
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- اطلاعات اضافی -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">راهنمای استفاده</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><i class="zmdi zmdi-check text-success"></i> شماره شروع و پایان باید عدد صحیح باشند</li>
                                <li><i class="zmdi zmdi-check text-success"></i> شماره پایان باید بزرگتر یا مساوی شماره شروع باشد</li>
                                <li><i class="zmdi zmdi-check text-success"></i> کدهای QR به فرمت SVG تولید می‌شوند</li>
                                <li><i class="zmdi zmdi-check text-success"></i> هر کد QR شامل لینک مستقیم به صفحه درخت است</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">مثال</h5>
                        </div>
                        <div class="card-body">
                            <p>اگر شماره شروع <strong>1</strong> و شماره پایان <strong>10</strong> را وارد کنید:</p>
                            <ul>
                                <li>10 کد QR تولید می‌شود</li>
                                <li>فایل‌ها: tree-1.svg تا tree-10.svg</li>
                                <li>فایل ZIP: qr-codes-1-to-10.zip</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const startIdInput = document.getElementById('start_id');
    const endIdInput = document.getElementById('end_id');
    
    // اعتبارسنجی شماره پایان
    function validateEndId() {
        const startId = parseInt(startIdInput.value);
        const endId = parseInt(endIdInput.value);
        
        if (startId && endId && endId < startId) {
            endIdInput.setCustomValidity('شماره پایان باید بزرگتر یا مساوی شماره شروع باشد');
        } else {
            endIdInput.setCustomValidity('');
        }
    }
    
    startIdInput.addEventListener('input', validateEndId);
    endIdInput.addEventListener('input', validateEndId);
});
</script>
@endpush 