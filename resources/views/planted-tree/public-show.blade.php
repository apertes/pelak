<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اطلاعات درخت - کد: {{ $plantedTree->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --danger-gradient: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
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
            padding: 2rem 0;
        }

        .tree-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            position: relative;
            animation: slideInUp 0.8s ease-out;
        }

        .tree-card::before {
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

        .tree-header {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .tree-header::before {
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

        .tree-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .tree-id-badge {
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

        .tree-content {
            padding: 2rem;
        }

        .tree-image-section {
            margin-bottom: 2rem;
        }

        .tree-image-container {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            background: #f8fafc;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tree-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: var(--transition);
        }

        .tree-image:hover {
            transform: scale(1.05);
        }

        .no-image-placeholder {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

        .no-image-placeholder i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-section {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.1rem;
        }

        .section-title i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #4a5568;
        }

        .info-value {
            font-weight: 600;
            color: #2d3748;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            text-align: center;
        }

        .status-salam {
            background: var(--success-gradient);
            color: white;
        }

        .status-bimar {
            background: var(--warning-gradient);
            color: white;
        }

        .status-khoshk {
            background: var(--danger-gradient);
            color: white;
        }

        .map-section {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        #map {
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .qr-section {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            text-align: center;
        }

        .qr-code {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .qr-code img {
            width: 150px;
            height: 150px;
            border-radius: 8px;
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

        .back-button {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: #667eea;
            backdrop-filter: blur(10px);
            transition: var(--transition);
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: #5a67d8;
        }

        @media (max-width: 768px) {
            .tree-card {
                margin: 1rem;
                border-radius: 16px;
            }
            
            .tree-content {
                padding: 1.5rem;
            }
            
            .tree-header {
                padding: 1.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .back-button {
                top: 1rem;
                right: 1rem;
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }

        .description-section {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        .description-text {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #667eea;
            font-style: italic;
            color: #4a5568;
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <button class="back-button" onclick="history.back()">
        <i class="fas fa-arrow-right me-2"></i>بازگشت
    </button>

    <div class="main-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="tree-card">
                        <div class="tree-header">
                            <h1><i class="fas fa-tree me-2"></i>اطلاعات درخت</h1>
                            <div class="tree-id-badge">
                                <i class="fas fa-hashtag me-2"></i>کد درخت: {{ $plantedTree->id }}
                            </div>
                            <p class="mb-0 opacity-75">مشاهده جزئیات کامل درخت</p>
                        </div>

                        <div class="tree-content">
                            <!-- تصویر درخت -->
                            <div class="tree-image-section">
                                <h4 class="section-title">
                                    <i class="fas fa-camera"></i>
                                    تصویر درخت
                                </h4>
                                <div class="tree-image-container">
                                    @if($plantedTree->image)
                                        <img src="{{ asset('storage/' . $plantedTree->image) }}" 
                                             alt="تصویر درخت {{ $plantedTree->id }}" 
                                             class="tree-image"
                                             onerror="this.parentElement.innerHTML='<div class=\'no-image-placeholder\'><i class=\'fas fa-image\'></i><h5>تصویر در دسترس نیست</h5><p>برای این درخت تصویری ثبت نشده است</p></div>'">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image"></i>
                                            <h5>تصویر در دسترس نیست</h5>
                                            <p>برای این درخت تصویری ثبت نشده است</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- اطلاعات اصلی -->
                            <div class="info-grid">
                                <div class="info-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-seedling"></i>
                                        اطلاعات درخت
                                    </h4>
                                    <div class="info-item">
                                        <span class="info-label">گروه درخت:</span>
                                        <span class="info-value">{{ optional($plantedTree->group)->name ?? 'نامشخص' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">گونه درخت:</span>
                                        <span class="info-value">{{ optional($plantedTree->tree)->name ?? 'نامشخص' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">وضعیت:</span>
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $plantedTree->status)) }}">
                                            @if($plantedTree->status == 'سالم')
                                                <i class="fas fa-check-circle me-1"></i>
                                            @elseif($plantedTree->status == 'بیمار')
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                            @else
                                                <i class="fas fa-times-circle me-1"></i>
                                            @endif
                                            {{ $plantedTree->status }}
                                        </span>
                                    </div>
                                </div>

                                <div class="info-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-map-marker-alt"></i>
                                        موقعیت مکانی
                                    </h4>
                                    <div class="info-item">
                                        <span class="info-label">مکان:</span>
                                        <span class="info-value">{{ optional($plantedTree->location)->name ?? 'نامشخص' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">جایگاه:</span>
                                        <span class="info-value">{{ optional($plantedTree->position)->name ?? 'نامشخص' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">مختصات:</span>
                                        <span class="info-value">{{ $plantedTree->latitude }}, {{ $plantedTree->longitude }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- نقشه -->
                            <div class="map-section">
                                <h4 class="section-title">
                                    <i class="fas fa-map"></i>
                                    موقعیت روی نقشه
                                </h4>
                                <div id="map"></div>
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-info-circle me-1"></i>
                                    موقعیت دقیق درخت روی نقشه
                                </small>
                            </div>

                            <!-- توضیحات -->
                            @if($plantedTree->description)
                                <div class="description-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-clipboard-list"></i>
                                        توضیحات
                                    </h4>
                                    <div class="description-text">
                                        {{ $plantedTree->description }}
                                    </div>
                                </div>
                            @endif

                            <!-- کد QR -->
                            <div class="qr-section">
                                <h4 class="section-title">
                                    <i class="fas fa-qrcode"></i>
                                    کد QR درخت
                                </h4>
                                @if($plantedTree->qrcode)
                                    <div class="qr-code">
                                        <img src="{{ asset($plantedTree->qrcode->qr_image) }}" 
                                             alt="QR Code درخت {{ $plantedTree->id }}"
                                             onerror="this.parentElement.innerHTML='<div class=\'text-muted\'><i class=\'fas fa-exclamation-triangle me-2\'></i>کد QR در دسترس نیست</div>'">
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-info-circle me-1"></i>
                                        برای دریافت اطلاعات این درخت، QR را اسکن کنید
                                    </p>
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        کد QR برای این درخت تولید نشده است
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // نقشه Leaflet
        var map = L.map('map').setView([{{ $plantedTree->latitude }}, {{ $plantedTree->longitude }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // مارکر درخت
        var treeIcon = L.divIcon({
            html: '<i class="fas fa-tree" style="color: #4facfe; font-size: 24px;"></i>',
            className: 'tree-marker',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });

        var marker = L.marker([{{ $plantedTree->latitude }}, {{ $plantedTree->longitude }}], {icon: treeIcon}).addTo(map);

        // پاپ‌آپ اطلاعات
        marker.bindPopup(`
            <div style="text-align: center;">
                <h6><i class="fas fa-tree"></i> درخت شماره {{ $plantedTree->id }}</h6>
                <p style="margin: 0;">{{ optional($plantedTree->tree)->name ?? 'نامشخص' }}</p>
                <small style="color: #666;">{{ $plantedTree->status }}</small>
            </div>
        `);

        // انیمیشن‌های اضافی
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.info-section, .map-section, .description-section, .qr-section');
            sections.forEach((section, index) => {
                section.style.animationDelay = `${index * 0.1}s`;
                section.style.animation = 'slideInUp 0.6s ease-out forwards';
            });
        });
    </script>
</body>
</html> 