<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود به پنل ادمین</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            min-height: 100vh;
            direction: rtl;
            font-family: Tahoma, Arial, sans-serif;
        }
        .login-card {
            max-width: 370px;
            margin: 80px auto;
            border-radius: 16px;
            box-shadow: 0 4px 24px #1976d211;
            background: #fff;
            padding: 32px 28px 24px 28px;
        }
        .login-card h2 {
            color: #1976d2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 24px;
        }
        .form-label {
            color: #1976d2;
            font-weight: 500;
        }
        .form-control {
            border-radius: 8px;
            background: #fff;
        }
        .login-btn {
            background: #1976d2;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px #1976d222;
        }
        .login-btn:hover {
            background: #1251a3;
        }
        .login-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 12px;
        }
        .login-icon svg {
            width: 44px;
            height: 44px;
            fill: #1976d2;
        }
        .alert-danger {
            border-radius: 8px;
            font-size: 0.98rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-icon">
            <svg viewBox="0 0 48 48"><path d="M24 4a7 7 0 0 1 7 7c0 1.2-.3 2.3-.8 3.3A8 8 0 0 1 40 22c0 1.2-.2 2.3-.6 3.3A7 7 0 0 1 41 32a7 7 0 0 1-7 7h-3v3h4a2 2 0 1 1 0 4H13a2 2 0 1 1 0-4h4v-3h-3a7 7 0 0 1-7-7c0-2.1.9-4.1 2.6-5.6A7.9 7.9 0 0 1 17.8 14c-.5-1-.8-2.1-.8-3.3a7 7 0 0 1 7-7zm-2 35v3h4v-3h-4z"/></svg>
        </div>
        <h2>ورود به پنل ادمین</h2>
        <form method="POST" action="{{ route('admin.login.submit') }}" autocomplete="off">
            @csrf
            <div class="mb-3">
                <label for="login_field" class="form-label">ایمیل / شماره موبایل / کد ملی</label>
                <input type="text" name="login_field" id="login_field" class="form-control" required autofocus value="{{ old('login_field') }}" placeholder="مثال: example@email.com یا 09123456789 یا 1234567890">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            @if($errors->any())
                <div class="alert alert-danger mb-3 text-center">
                    {{ $errors->first() }}
                </div>
            @endif
            <button type="submit" class="btn login-btn w-100 mt-2">ورود</button>
        </form>
    </div>
</body>
</html> 