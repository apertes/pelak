@extends('admin-panel.layouts.master')

@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">visibility</i> نمایش اطلاعات درخت
                    </h4>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <strong>گروه درخت:</strong> {{ $plantedTree->group->name ?? '-' }}<br>
                            <strong>گونه:</strong> {{ $plantedTree->tree->name ?? '-' }}<br>
                            <strong>مکان:</strong> {{ $plantedTree->location->name ?? '-' }}<br>
                            <strong>جایگاه:</strong> {{ $plantedTree->position->name ?? '-' }}<br>
                            <strong>وضعیت:</strong> <span class="badge" style="background: #1976d2; color: #fff;">{{ $plantedTree->status }}</span><br>
                            <strong>QR Code:</strong> <span class="badge" style="background: #1976d2; color: #fff; font-size: 10px;">{{ $plantedTree->qr_code }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>طول جغرافیایی:</strong> {{ $plantedTree->latitude }}<br>
                            <strong>عرض جغرافیایی:</strong> {{ $plantedTree->longitude }}<br>
                            <strong>توضیحات:</strong> {{ $plantedTree->description ?? '-' }}<br>
                            <strong>عکس:</strong><br>
                            @if($plantedTree->image)
                                <img src="{{ asset('storage/' . $plantedTree->image) }}" alt="عکس درخت" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                            @else
                                <span class="text-muted">بدون عکس</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- نمایش QR Code -->
                    @if($plantedTree->qrcode)
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 style="color: #1976d2;">QR Code درخت</h5>
                            <div class="text-center">
                                <img src="{{ asset($plantedTree->qrcode->qr_image) }}" alt="QR Code" style="width: 200px; height: 200px; border: 2px solid #1976d2; border-radius: 8px;">
                                <div class="mt-2">
                                    <small class="text-muted">برای اسکن و مشاهده اطلاعات عمومی درخت</small>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ asset($plantedTree->qrcode->qr_image) }}" download class="btn btn-sm btn-outline-primary">
                                        <i class="material-icons">download</i> دانلود QR Code
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label style="color: #1976d2;">موقعیت روی نقشه</label>
                        <div id="map" style="height: 300px; border-radius: 8px; overflow: hidden;"></div>
                    </div>
                    <a href="{{ route('admin.planted-trees') }}" class="btn btn-light" style="border-radius: 8px; min-width: 100px;">بازگشت</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lat = {{ $plantedTree->latitude ?? 35.6892 }};
            var lng = {{ $plantedTree->longitude ?? 51.3890 }};
            var map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            var marker = L.marker([lat, lng]).addTo(map);
        });
    </script>
@endpush 