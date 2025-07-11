@extends('admin-panel.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow" style="max-width: 600px; margin: auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">اطلاعات درخت</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>کد درخت:</strong> {{ $plantedTree->id }}</li>
                <li class="list-group-item"><strong>گروه:</strong> {{ optional($plantedTree->group)->name }}</li>
                <li class="list-group-item"><strong>گونه:</strong> {{ optional($plantedTree->tree)->name }}</li>
                <li class="list-group-item"><strong>مکان:</strong> {{ optional($plantedTree->location)->name }}</li>
                <li class="list-group-item"><strong>جایگاه:</strong> {{ optional($plantedTree->position)->name }}</li>
                <li class="list-group-item"><strong>وضعیت:</strong> {{ $plantedTree->status }}</li>
                <li class="list-group-item"><strong>توضیحات:</strong> {{ $plantedTree->description }}</li>
                <li class="list-group-item"><strong>مختصات:</strong> {{ $plantedTree->latitude }}, {{ $plantedTree->longitude }}</li>
            </ul>
            @if($plantedTree->qr_image)
                <div class="text-center mb-3">
                    <img src="/{{ $plantedTree->qr_image }}" alt="QR Code" style="width: 180px;">
                    <div class="small text-muted mt-2">برای دریافت اطلاعات این درخت، QR را اسکن کنید.</div>
                </div>
            @endif
            @if($plantedTree->qrcode)
                <div class="text-center mb-3">
                    <img src="{{ asset($plantedTree->qrcode->qr_image) }}" alt="QR Code" style="width: 180px; border: 1px solid #ddd; border-radius: 8px;">
                    <div class="small text-muted mt-2">برای دریافت اطلاعات این درخت، QR را اسکن کنید.</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 