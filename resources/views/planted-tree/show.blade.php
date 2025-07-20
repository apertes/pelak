@extends('admin-panel.layouts.master')

@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-8 col-12">
            <div class="card shadow-lg border-0" style="border-radius: 22px; background: #f5f7fa;">
                <div class="card-header d-flex align-items-center" style="background: linear-gradient(90deg, #1976d2 70%, #64b5f6 100%); border-radius: 22px 22px 0 0; box-shadow: 0 2px 12px 0 rgba(25, 118, 210, 0.10);">
                    <i class="zmdi zmdi-nature text-white" style="font-size: 2rem;"></i>
                    <span class="ms-2 text-white fw-bold" style="font-size: 1.3rem;">اطلاعات کامل درخت شماره {{ $plantedTree->id }}</span>
                </div>
                <div class="card-body" style="background: #fff; border-radius: 0 0 22px 22px;">
                    <div class="row g-4 align-items-stretch">
                        <div class="col-md-7 mb-3">
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-group-work text-primary ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">گروه درخت</div>
                                            <div class="fw-bold">{{ $plantedTree->group->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-leaf text-success ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">گونه</div>
                                            <div class="fw-bold">{{ $plantedTree->tree->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-pin text-warning ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">مکان</div>
                                            <div class="fw-bold">{{ $plantedTree->location->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-city text-info ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">جایگاه</div>
                                            <div class="fw-bold">{{ $plantedTree->position->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-info text-danger ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">وضعیت</div>
                                            <span class="badge bg-primary" style="border-radius:8px; font-size:1rem;">{{ $plantedTree->status }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-qrcode text-dark ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">کد QR</div>
                                            <span class="badge bg-primary" style="border-radius:8px; font-size:1rem;">{{ $plantedTree->qr_code }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-comment-text text-secondary ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">توضیحات</div>
                                            <div>{{ $plantedTree->description ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center bg-light rounded-3 p-3 mb-2 shadow-sm">
                                        <i class="zmdi zmdi-gps-dot text-primary ms-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <div class="fw-bold text-secondary small">مختصات</div>
                                            <div>طول: {{ $plantedTree->latitude }} | عرض: {{ $plantedTree->longitude }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($plantedTree->qrcode)
                                <div class="mt-3">
                                    <div class="card p-2 border-0 shadow-sm" style="border-radius: 14px; background: #e3f2fd;">
                                        <div class="text-center">
                                            <img src="{{ asset($plantedTree->qrcode->qr_image) }}" alt="QR Code" style="width: 120px; height: 120px; border: 2px solid #1976d2; border-radius: 10px;">
                                            <div class="mt-2">
                                                <small class="text-muted">برای اسکن و مشاهده اطلاعات عمومی درخت</small>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ asset($plantedTree->qrcode->qr_image) }}" download class="btn btn-primary btn-sm shadow-sm" style="border-radius: 8px;">
                                                    <i class="zmdi zmdi-download"></i> دانلود کد QR
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="card mb-3 border-0 shadow-sm" style="border-radius: 14px;">
                                <div class="card-header bg-light text-primary font-weight-bold border-0" style="border-radius: 14px 14px 0 0;">عکس درخت</div>
                                <div class="card-body text-center">
                                    @if($plantedTree->image)
                                        <img src="{{ asset('storage/' . $plantedTree->image) }}" alt="عکس درخت" style="border-radius: 10px; max-width: 100%; max-height: 250px; object-fit: cover; box-shadow: 0 2px 12px 0 rgba(25, 118, 210, 0.10);">
                                    @else
                                        <span class="text-muted">بدون عکس</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card border-0 shadow-sm" style="border-radius: 14px;">
                                <div class="card-header bg-light text-primary font-weight-bold border-0" style="border-radius: 14px 14px 0 0;">موقعیت روی نقشه</div>
                                <div class="card-body p-2">
                                    <div id="map" style="height: 180px; border-radius: 10px; overflow: hidden;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('admin.planted-trees') }}" class="btn btn-secondary btn-lg shadow-sm" style="border-radius: 10px; min-width: 180px;">
                            <i class="zmdi zmdi-arrow-back"></i> بازگشت به لیست درختان
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lat = {{ $plantedTree->latitude ?? 35.6892 }};
            var lng = {{ $plantedTree->longitude ?? 51.3890 }};
            var map = L.map('map').setView([lat, lng], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            var marker = L.marker([lat, lng]).addTo(map);
        });
    </script>
@endpush 