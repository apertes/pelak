<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش درخت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
        }
        .edit-card {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 2rem 1rem 2rem;
        }
        .form-label, label {
            color: #1976d2;
            font-weight: 600;
        }
        .btn-primary, .btn-success {
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-cancel {
            border-radius: 8px;
        }
        .form-control, select {
            border-radius: 8px;
            background: #fff;
        }
        .leaflet-container {
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="main-container">
    <div class="edit-card">
        <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
            <i class="fa fa-edit me-2"></i> ویرایش درخت
        </h4>
        <form action="{{ route('planted-trees.update', $plantedTree->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>گروه درخت</label>
                    <select name="tree_group_id" class="form-control">
                        <option value="">انتخاب گروه</option>
                        @foreach($treeGroups as $group)
                            <option value="{{ $group->id }}" @if($plantedTree->tree_group_id == $group->id) selected @endif>{{ $group->name }}</option>
                        @endforeach
                    </select>
                    @error('tree_group_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>گونه درخت</label>
                    <select name="tree_id" class="form-control">
                        <option value="">انتخاب گونه</option>
                        @foreach($trees as $tree)
                            <option value="{{ $tree->id }}" @if($plantedTree->tree_id == $tree->id) selected @endif>{{ $tree->name }}</option>
                        @endforeach
                    </select>
                    @error('tree_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>مکان</label>
                    <select name="location_id" class="form-control">
                        <option value="">انتخاب مکان</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" @if($plantedTree->location_id == $location->id) selected @endif>{{ $location->name }}</option>
                        @endforeach
                    </select>
                    @error('location_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>جایگاه</label>
                    <select name="position_id" class="form-control">
                        <option value="">انتخاب جایگاه</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}" @if($plantedTree->position_id == $position->id) selected @endif>{{ $position->name }}</option>
                        @endforeach
                    </select>
                    @error('position_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>انتخاب موقعیت روی نقشه</label>
                    <div id="map" style="height: 300px;"></div>
                </div>
                <div class="col-md-3 mb-3">
                    <label>طول جغرافیایی</label>
                    <input type="number" step="0.000001" name="latitude" id="latitude" class="form-control" value="{{ old('latitude', $plantedTree->latitude) }}">
                    @error('latitude')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label>عرض جغرافیایی</label>
                    <input type="number" step="0.000001" name="longitude" id="longitude" class="form-control" value="{{ old('longitude', $plantedTree->longitude) }}">
                    @error('longitude')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>عکس درخت</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($plantedTree->image)
                        <img src="{{ asset('storage/' . $plantedTree->image) }}" alt="عکس درخت" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; margin-top: 8px;">
                    @endif
                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>وضعیت</label>
                    <select name="status" class="form-control">
                        <option value="سالم" @if($plantedTree->status == 'سالم') selected @endif>سالم</option>
                        <option value="بیمار" @if($plantedTree->status == 'بیمار') selected @endif>بیمار</option>
                        <option value="خشک شده" @if($plantedTree->status == 'خشک شده') selected @endif>خشک شده</option>
                    </select>
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label>توضیحات</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $plantedTree->description) }}</textarea>
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary" style="min-width: 120px;">
                    <i class="fa fa-edit me-2"></i> ذخیره تغییرات
                </button>
                <a href="/" class="btn btn-light btn-cancel" style="min-width: 100px;">انصراف</a>
            </div>
        </form>
    </div>
</div>
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
</body>
</html> 