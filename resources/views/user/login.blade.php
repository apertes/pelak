<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود / ثبت‌نام - شهروندان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-bg: rgba(255, 255, 255, 0.95);
            --border-radius: 18px;
            --shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .auth-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 400px;
            width: 100%;
            animation: slideInUp 0.8s ease-out;
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

        .nav-tabs {
            border: none;
            background: transparent;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-radius: 12px 12px 0 0;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .nav-tabs .nav-link:hover:not(.active) {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .tab-content {
            padding: 2rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .btn {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-success {
            background: var(--success-gradient);
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.6);
        }

        .alert {
            border-radius: 12px;
            border: none;
            font-weight: 500;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #721c24;
        }

        .alert-success {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="auth-card">
            <ul class="nav nav-tabs nav-justified" id="authTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">
                        <i class="fas fa-sign-in-alt me-2"></i>ورود
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">
                        <i class="fas fa-user-plus me-2"></i>ثبت‌نام
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="authTabContent">
                <div class="tab-pane fade show active" id="login" role="tabpanel">
                    <form method="POST" action="{{ route('user.login.submit') }}">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ request('redirect', '/') }}">
                        <div class="mb-3">
                            <label for="login-email" class="form-label">ایمیل</label>
                            <input type="email" class="form-control" id="login-email" name="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="form-label">رمز عبور</label>
                            <input type="password" class="form-control" id="login-password" name="password" required>
                        </div>
                        @if(session('login_error'))
                            <div class="alert alert-danger">{{ session('login_error') }}</div>
                        @endif
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>ورود
                        </button>
                    </form>
                </div>
                <div class="tab-pane fade" id="register" role="tabpanel">
                    <form method="POST" action="{{ route('user.register.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="register-name" class="form-label">نام و نام خانوادگی</label>
                            <input type="text" class="form-control" id="register-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-email" class="form-label">ایمیل</label>
                            <input type="email" class="form-control" id="register-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-password" class="form-label">رمز عبور</label>
                            <input type="password" class="form-control" id="register-password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-password_confirmation" class="form-label">تکرار رمز عبور</label>
                            <input type="password" class="form-control" id="register-password_confirmation" name="password_confirmation" required>
                        </div>
                        @if(session('register_error'))
                            <div class="alert alert-danger">{{ session('register_error') }}</div>
                        @endif
                        @if(session('register_success'))
                            <div class="alert alert-success">{{ session('register_success') }}</div>
                        @endif
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-user-plus me-2"></i>ثبت‌نام
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Switch tab on error
        @if(session('register_error') || session('register_success'))
            var tab = new bootstrap.Tab(document.getElementById('register-tab'));
            tab.show();
        @endif
    </script>
</body>
</html> 