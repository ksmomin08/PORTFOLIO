<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found - {{ \App\Models\Setting::get('site_name', 'Narjis Infotech') }}</title>
    
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 Icons CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2a4a 0%, #1c3d5a 100%);
            color: #ffffff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .error-card {
            text-align: center;
            max-width: 500px;
            padding: 40px;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -2px;
            background: linear-gradient(to right, #0d6efd, #25d366);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .error-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .error-desc {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.98rem;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        .btn-home {
            background-color: #0d6efd;
            color: #ffffff;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            transition: all 0.3s;
            border: none;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.35);
            text-decoration: none;
            display: inline-block;
        }

        .btn-home:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.45);
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="error-card">
        <div class="error-code">404</div>
        <h2 class="error-title">Page Not Found</h2>
        <p class="error-desc">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Let's get you back on track!</p>
        <a href="{{ route('frontend.home') }}" class="btn-home"><i class="fa-solid fa-house me-2"></i> Return to Homepage</a>
    </div>

</body>
</html>
