<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obsidian Login - {{ \App\Models\Setting::get('site_name', 'Narjis Infotech') }}</title>
    
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 Icons CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0A0A0F;
            --surface-card: #111118;
            --primary-accent: #6C63FF;
            --secondary-accent: #00D4FF;
            --border-glow: rgba(255, 255, 255, 0.06);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 50% 50%, rgba(108, 99, 255, 0.1) 0%, var(--bg-dark) 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0;
        }

        .login-card {
            background-color: var(--surface-card);
            border-radius: 16px;
            border: 1px solid var(--border-glow);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 420px;
            padding: 40px;
            backdrop-filter: blur(10px);
        }

        .login-card h3 {
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-label {
            color: #A0A0B0;
        }

        .form-control {
            background-color: rgba(255,255,255,0.03) !important;
            border: 1px solid var(--border-glow) !important;
            color: #ffffff !important;
            border-radius: 10px !important;
            padding: 12px 15px !important;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.15) !important;
            border-color: var(--secondary-accent) !important;
        }

        .btn-primary {
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary-accent) 0%, var(--secondary-accent) 100%);
            border: none;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(108, 99, 255, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(108, 99, 255, 0.55);
        }

        .input-group-text {
            background-color: rgba(255,255,255,0.02) !important;
            border: 1px solid var(--border-glow) !important;
            border-right: none !important;
            color: #A0A0B0 !important;
            border-radius: 10px 0 0 10px !important;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0 !important;
        }

        .error-message {
            font-size: 0.82rem;
            color: #dc3545;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <h3 class="mb-1">OBSIDIAN ADMIN</h3>
            <p class="text-muted small">Secure Panel Authentication</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger border-0 small py-2 mb-3" style="border-radius: 8px; background-color: rgba(220, 53, 69, 0.15); color: #dc3545;">
                <i class="fa-solid fa-circle-exclamation me-1"></i> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success border-0 small py-2 mb-3" style="border-radius: 8px; background-color: rgba(0, 230, 118, 0.15); color: #00E676;">
                <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label small font-weight-500">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="admin@portfolio.com" required autofocus>
                </div>
                @error('email')
                    <div class="error-message"><i class="fa-solid fa-circle-xmark me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label small font-weight-500">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                </div>
                @error('password')
                    <div class="error-message"><i class="fa-solid fa-circle-xmark me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" style="background-color: rgba(255,255,255,0.03); border: 1px solid var(--border-glow);">
                    <label class="form-check-label small text-muted" for="remember">
                        Remember Session
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-right-to-bracket me-2"></i> Access Panel</button>
        </form>
    </div>

</body>
</html>
