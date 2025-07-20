{{-- فرم ثبت درخت جدید (متریال و مدرن به سبک user-manager) --}}
@extends('admin-panel.layouts.master')

@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">nature</i> ثبت درخت جدید
                    </h4>
                    <form action="{{ route('planted-trees.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="tree_group_id" style="color: #1976d2;">گروه درخت</label>
                                <select name="tree_group_id" id="tree_group_id" class="form-control" style="border-radius: 8px; background: #fff;" required>
                                    <option value="">انتخاب گروه</option>
                                    @foreach($treeGroups as $group)
                                        <option value="{{ $group->id }}" {{ old('tree_group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                @error('tree_group_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="tree_id" style="color: #1976d2;">گونه درخت</label>
                                <select name="tree_id" id="tree_id" class="form-control" style="border-radius: 8px; background: #fff;" required>
                                    <option value="">انتخاب گونه</option>
                                    @foreach($trees as $tree)
                                        <option value="{{ $tree->id }}" {{ old('tree_id') == $tree->id ? 'selected' : '' }}>{{ $tree->name }}</option>
                                    @endforeach
                                </select>
                                @error('tree_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="status" style="color: #1976d2;">وضعیت</label>
                                <select name="status" id="status" class="form-control" style="border-radius: 8px; background: #fff;" required>
                                    <option value="سالم" {{ old('status') == 'سالم' ? 'selected' : '' }}>سالم</option>
                                    <option value="بیمار" {{ old('status') == 'بیمار' ? 'selected' : '' }}>بیمار</option>
                                    <option value="خشک شده" {{ old('status') == 'خشک شده' ? 'selected' : '' }}>خشک شده</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="mb-1" for="location_id" style="color: #1976d2;">مکان</label>
                                <select name="location_id" id="location_id" class="form-control" style="border-radius: 8px; background: #fff;" required>
                                    <option value="">انتخاب مکان</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                @error('location_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="mb-1" for="position_id" style="color: #1976d2;">جایگاه</label>
                                <select name="position_id" id="position_id" class="form-control" style="border-radius: 8px; background: #fff;" required>
                                    <option value="">انتخاب جایگاه</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                @error('position_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="mb-1" for="map" style="color: #1976d2;">انتخاب موقعیت روی نقشه</label>
                                <div id="map" style="height: 300px; border-radius: 8px; overflow: hidden;"></div>
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="mb-1" for="latitude" style="color: #1976d2;">طول جغرافیایی</label>
                                <input type="number" step="0.000001" name="latitude" id="latitude" class="form-control" style="border-radius: 8px; background: #fff;" value="{{ old('latitude', 35.6892) }}" required>
                                @error('latitude')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="mb-1" for="longitude" style="color: #1976d2;">عرض جغرافیایی</label>
                                <input type="number" step="0.000001" name="longitude" id="longitude" class="form-control" style="border-radius: 8px; background: #fff;" value="{{ old('longitude', 51.3890) }}" required>
                                @error('longitude')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="mb-1" for="image" style="color: #1976d2;">عکس درخت</label>
                                <input type="file" name="image" id="image" class="form-control" style="border-radius: 8px; background: #fff;" accept="image/*">
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="mb-1" for="description" style="color: #1976d2;">توضیحات</label>
                                <textarea name="description" id="description" class="form-control" style="border-radius: 8px; background: #fff;" rows="3">{{ old('description') }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label>منطقه</label>
                                <select name="region_id" class="form-control">
                                    <option value="">انتخاب منطقه</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" @if(old('region_id') == $region->id) selected @endif>{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                @error('region_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn" style="background: #1976d2; color: #fff; border-radius: 8px; min-width: 120px;">
                                <i class="material-icons align-middle">add</i> ثبت
                            </button>
                            <a href="{{ route('admin.planted-trees') }}" class="btn btn-light" style="border-radius: 8px; min-width: 100px;">انصراف</a>
                        </div>
                    </form>
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
            var latInput = document.getElementById('latitude');
            var lngInput = document.getElementById('longitude');
            var lat = parseFloat(latInput.value) || 35.6892;
            var lng = parseFloat(lngInput.value) || 51.3890;
            var map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            var marker = L.marker([lat, lng], {draggable:true}).addTo(map);
            function updateInputs(e) {
                var latlng = e.latlng || marker.getLatLng();
                latInput.value = latlng.lat;
                lngInput.value = latlng.lng;
            }
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInputs(e);
            });
            marker.on('dragend', function(e) {
                updateInputs(e);
            });
        });
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush 