<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت درخت جدید - کد: {{ $id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-bg: rgba(255, 255, 255, 0.95);
            --border-radius: 20px;
            --shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--primary-gradient);
            min-height: 100vh;
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
            z-index: 1;
        }

        .main-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .form-container {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            position: relative;
            animation: slideInUp 0.8s ease-out;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .qr-header {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .qr-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .qr-header h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .qr-code-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            margin: 1rem 0;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        .form-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control:hover, .form-select:hover {
            border-color: #cbd5e0;
            transform: translateY(-1px);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            z-index: 2;
        }

        .form-control.with-icon {
            padding-left: 3rem;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .map-container {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 2px solid #e2e8f0;
        }

        #map {
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .alert-danger {
            background: rgba(245, 101, 101, 0.1);
            color: #c53030;
            border-left: 4px solid #f56565;
        }

        .alert-success {
            background: rgba(72, 187, 120, 0.1);
            color: #2f855a;
            border-left: 4px solid #48bb78;
        }

        .progress-bar {
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .form-section {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: #667eea;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                border-radius: 16px;
            }
            
            .form-body {
                padding: 1.5rem;
            }
            
            .qr-header {
                padding: 1.5rem;
            }
        }

        .file-upload-area {
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            background: rgba(255, 255, 255, 0.5);
        }

        .file-upload-area:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .file-upload-area.dragover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            transform: scale(1.02);
        }

        .upload-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .status-badges {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .status-badge.active {
            background: var(--success-gradient);
            color: white;
            border-color: #48bb78;
        }

        .status-badge:not(.active) {
            background: rgba(255, 255, 255, 0.8);
            color: #4a5568;
            border-color: #e2e8f0;
        }

        .status-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="main-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="form-container">
                        <div class="qr-header">
                            <h2><i class="fas fa-tree me-2"></i>ثبت درخت جدید</h2>
                            <div class="qr-code-badge">
                                <i class="fas fa-qrcode me-2"></i>کد QR: {{ $id }}
                            </div>
                            <p class="mb-0 opacity-75">لطفاً اطلاعات درخت را با دقت تکمیل کنید</p>
                        </div>

                        <div class="form-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('tree.public.create', $id) }}" method="POST" enctype="multipart/form-data" id="treeForm">
                                @csrf
                                
                                <!-- اطلاعات اصلی درخت -->
                                <div class="form-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-seedling"></i>
                                        اطلاعات اصلی درخت
                                    </h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">گروه درخت <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <i class="fas fa-layer-group input-icon"></i>
                                                <select name="tree_group_id" class="form-select with-icon" required>
                                                    <option value="">انتخاب گروه درخت</option>
                                                    @foreach($treeGroups as $group)
                                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('tree_group_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">گونه درخت <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <i class="fas fa-leaf input-icon"></i>
                                                <select name="tree_id" class="form-select with-icon" required>
                                                    <option value="">انتخاب گونه درخت</option>
                                                    @foreach($trees as $tree)
                                                        <option value="{{ $tree->id }}">{{ $tree->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('tree_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- موقعیت مکانی -->
                                <div class="form-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-map-marker-alt"></i>
                                        موقعیت مکانی
                                    </h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">مکان <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <i class="fas fa-map input-icon"></i>
                                                <select name="location_id" class="form-select with-icon" required>
                                                    <option value="">انتخاب مکان</option>
                                                    @foreach($locations as $location)
                                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('location_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">جایگاه <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <i class="fas fa-crosshairs input-icon"></i>
                                                <select name="position_id" class="form-select with-icon" required>
                                                    <option value="">انتخاب جایگاه</option>
                                                    @foreach($positions as $position)
                                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('position_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">طول جغرافیایی <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <i class="fas fa-globe input-icon"></i>
                                                <input type="number" name="latitude" class="form-control with-icon" step="any" required value="35.6892">
                                            </div>
                                            @error('latitude')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">عرض جغرافیایی <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <i class="fas fa-globe-americas input-icon"></i>
                                                <input type="number" name="longitude" class="form-control with-icon" step="any" required value="51.3890">
                                            </div>
                                            @error('longitude')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="map-container">
                                        <label class="form-label">انتخاب موقعیت روی نقشه</label>
                                        <div id="map"></div>
                                        <small class="text-muted mt-2 d-block">
                                            <i class="fas fa-info-circle me-1"></i>
                                            برای تغییر موقعیت، روی نقشه کلیک کنید
                                        </small>
                                    </div>
                                </div>

                                <!-- وضعیت و توضیحات -->
                                <div class="form-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-clipboard-list"></i>
                                        وضعیت و توضیحات
                                    </h4>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">وضعیت درخت <span class="text-danger">*</span></label>
                                        <div class="status-badges">
                                            <div class="status-badge active" data-status="سالم">
                                                <i class="fas fa-check-circle me-1"></i>سالم
                                            </div>
                                            <div class="status-badge" data-status="بیمار">
                                                <i class="fas fa-exclamation-triangle me-1"></i>بیمار
                                            </div>
                                            <div class="status-badge" data-status="خشک شده">
                                                <i class="fas fa-times-circle me-1"></i>خشک شده
                                            </div>
                                        </div>
                                        <input type="hidden" name="status" value="سالم" id="statusInput">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">توضیحات اضافی</label>
                                        <textarea name="description" class="form-control" rows="4" placeholder="توضیحات مربوط به درخت، شرایط خاص، یا یادداشت‌های مهم..."></textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- آپلود عکس -->
                                <div class="form-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-camera"></i>
                                        عکس درخت
                                    </h4>
                                    
                                    <div class="file-upload-area" id="fileUploadArea">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <h5>عکس درخت را آپلود کنید</h5>
                                        <p class="text-muted">فایل را اینجا بکشید یا کلیک کنید</p>
                                        <input type="file" name="image" class="form-control" accept="image/*" style="display: none;" id="fileInput">
                                    </div>
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- دکمه ثبت -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>ثبت درخت
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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

        // مدیریت وضعیت درخت
        document.querySelectorAll('.status-badge').forEach(badge => {
            badge.addEventListener('click', function() {
                document.querySelectorAll('.status-badge').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('statusInput').value = this.dataset.status;
            });
        });

        // مدیریت آپلود فایل
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('fileInput');

        fileUploadArea.addEventListener('click', () => fileInput.click());

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFileUploadArea(files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                updateFileUploadArea(e.target.files[0]);
            }
        });

        function updateFileUploadArea(file) {
            const icon = fileUploadArea.querySelector('.upload-icon i');
            const title = fileUploadArea.querySelector('h5');
            const description = fileUploadArea.querySelector('p');

            icon.className = 'fas fa-check-circle';
            title.textContent = 'فایل انتخاب شد';
            description.textContent = file.name;
            fileUploadArea.style.background = 'rgba(72, 187, 120, 0.1)';
            fileUploadArea.style.borderColor = '#48bb78';
        }

        // انیمیشن‌های اضافی
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('.form-control, .form-select');
            formElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
                element.style.animation = 'slideInUp 0.6s ease-out forwards';
            });
        });
    </script>
</body>
</html> 