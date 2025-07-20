@extends('admin-panel.layouts.master')

@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px; background: linear-gradient(90deg,#1976d2 60%,#42a5f5 100%); color: #fff;">
                <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-2" style="font-weight: bold;">داشبورد مدیریت</h2>
                        <p class="mb-0">خوش آمدید به پنل مدیریت سامانه درختان و گزارشات شهروندی</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fa fa-tree" style="font-size: 60px; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm text-center" style="border-radius: 16px;">
                <div class="card-body">
                    <i class="fa fa-users mb-2" style="font-size: 2rem; color: #1976d2;"></i>
                    <h5 class="card-title mb-1">تعداد کاربران</h5>
                    <div class="display-6 fw-bold">{{ \App\Models\User::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm text-center" style="border-radius: 16px;">
                <div class="card-body">
                    <i class="fa fa-flag mb-2" style="font-size: 2rem; color: #1976d2;"></i>
                    <h5 class="card-title mb-1">گزارش‌های ثبت‌شده</h5>
                    <div class="display-6 fw-bold">{{ \DB::table('tree_reports')->count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm text-center" style="border-radius: 16px;">
                <div class="card-body">
                    <i class="fa fa-tree mb-2" style="font-size: 2rem; color: #1976d2;"></i>
                    <h5 class="card-title mb-1">درختان ثبت‌شده</h5>
                    <div class="display-6 fw-bold">{{ \DB::table('trees')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px;">
                <div class="card-body">
                    <h5 class="mb-3" style="color:#1976d2;font-weight:bold;"><i class="fa fa-info-circle me-2"></i> راهنمای سریع</h5>
                    <ul class="mb-0" style="line-height:2;">
                        <li>از منوی کناری برای مدیریت کاربران، سمت‌ها، گزارش‌ها و ... استفاده کنید.</li>
                        <li>برای خروج، از منوی بالا گزینه خروج را انتخاب کنید.</li>
                        <li>در صورت نیاز به راهنمایی بیشتر، با مدیر سیستم تماس بگیرید.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 