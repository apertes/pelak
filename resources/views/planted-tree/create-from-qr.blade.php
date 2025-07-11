<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت درخت جدید - کد: {{ $id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .qr-info {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }
        #map {
            height: 300px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="form-container p-4 p-md-5">
                    <div class="qr-info text-center">
                        <h3><i class="fas fa-qrcode me-2"></i>ثبت درخت جدید</h3>
                        <p class="mb-0">کد QR: <strong>{{ $id }}</strong></p>
                        <small>لطفاً اطلاعات درخت را تکمیل کنید</small>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('tree.public.create', $id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">گروه درخت <span class="text-danger">*</span></label>
                                <select name="tree_group_id" class="form-select" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($treeGroups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                @error('tree_group_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">گونه درخت <span class="text-danger">*</span></label>
                                <select name="tree_id" class="form-select" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($trees as $tree)
                                        <option value="{{ $tree->id }}">{{ $tree->name }}</option>
                                    @endforeach
                                </select>
                                @error('tree_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">مکان <span class="text-danger">*</span></label>
                                <select name="location_id" class="form-select" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">جایگاه <span class="text-danger">*</span></label>
                                <select name="position_id" class="form-select" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">طول جغرافیایی <span class="text-danger">*</span></label>
                                <input type="number" name="latitude" class="form-control" step="any" required value="35.6892">
                                @error('latitude')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">عرض جغرافیایی <span class="text-danger">*</span></label>
                                <input type="number" name="longitude" class="form-control" step="any" required value="51.3890">
                                @error('longitude')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">وضعیت <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="سالم">سالم</option>
                                <option value="بیمار">بیمار</option>
                                <option value="خشک شده">خشک شده</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="توضیحات اضافی..."></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">عکس درخت</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">انتخاب موقعیت روی نقشه</label>
                            <div id="map"></div>
                            <small class="text-muted">برای تغییر موقعیت، روی نقشه کلیک کنید</small>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>ثبت درخت
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // نقشه Leaflet
        var map = L.map('map').setView([35.6892, 51.3890], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var marker = L.marker([35.6892, 51.3890]).addTo(map);

        // تغییر موقعیت با کلیک
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.querySelector('input[name="latitude"]').value = e.latlng.lat.toFixed(6);
            document.querySelector('input[name="longitude"]').value = e.latlng.lng.toFixed(6);
        });

        // به‌روزرسانی نقشه با تغییر فیلدها
        document.querySelector('input[name="latitude"]').addEventListener('change', function() {
            var lat = parseFloat(this.value);
            var lng = parseFloat(document.querySelector('input[name="longitude"]').value);
            if (!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 13);
            }
        });

        document.querySelector('input[name="longitude"]').addEventListener('change', function() {
            var lat = parseFloat(document.querySelector('input[name="latitude"]').value);
            var lng = parseFloat(this.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 13);
            }
        });
    </script>
</body>
</html> 