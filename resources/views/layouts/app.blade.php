<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Dynamic SEO Meta Tags -->
    <title>@yield('title', \App\Models\Setting::get('meta_title', 'Premium IT Portfolio'))</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', 'Elite web & product engineering studio.'))">
    
    <!-- Premium Fonts -->
    <!-- Clash Display (Fontshare) -->
    <link href="https://api.fontshare.com/v2/css?f[]=clash-display@400,500,600,700,800&display=swap" rel="stylesheet">
    <!-- Inter (Body) & JetBrains Mono (Code/Badges) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Remix Icons (Ultra Premium Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- FontAwesome 6 Icons CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- AOS Animations CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google Analytics Code Injection -->
    {!! \App\Models\Setting::get('google_analytics') !!}
    
    @php
        $themeColor = \App\Models\Setting::get('primary_color', '#6C63FF');
        $hex = ltrim($themeColor, '#');
        if (strlen($hex) == 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
            $themeRgb = "$r, $g, $b";
        } else {
            $themeRgb = "108, 99, 255"; // default fallback
        }
    @endphp

    <style>
        /* Modern Premium CSS System */
        :root {
            --primary-color: {{ $themeColor }}; /* Dynamic Primary Color */
            --secondary-color: #00D4FF; /* Electric Cyan default */
            --primary-rgb: {{ $themeRgb }};
            --secondary-rgb: 0, 212, 255;
            --bg-dark: #0A0A0F;
            --surface-card: #111118;
            --border-glow: rgba(255, 255, 255, 0.08);
            --text-primary: #FFFFFF;
            --text-secondary: #A0A0B0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-secondary);
            overflow-x: hidden;
            overflow-y: auto;
            position: relative;
        }

        /* Set Clash Display for premium headings */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Clash Display', sans-serif;
            color: var(--text-primary);
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* 3D Moving Glowing Orbs */
        .glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(130px);
            opacity: 0.15;
            z-index: -1;
            pointer-events: none;
            animation: floating 25s infinite ease-in-out;
        }
        .glow-orb-1 {
            width: 450px;
            height: 450px;
            background: var(--primary-color);
            top: 5%;
            left: -10%;
        }
        .glow-orb-2 {
            width: 500px;
            height: 500px;
            background: var(--secondary-color);
            bottom: 15%;
            right: -10%;
            animation-delay: -8s;
        }
        @keyframes floating {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, -80px) scale(1.15); }
        }

        /* Trendy Mesh Grid Background */
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px), 
                linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size: 55px 55px;
            z-index: -2;
            pointer-events: none;
        }

        /* Interactive Custom Cursor */
        .custom-cursor-dot {
            width: 6px;
            height: 6px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            position: fixed;
            z-index: 10000;
            pointer-events: none;
            transform: translate(-50%, -50%);
            transition: width 0.2s, height 0.2s;
        }
        .custom-cursor-circle {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(var(--secondary-rgb), 0.4);
            border-radius: 50%;
            position: fixed;
            z-index: 9999;
            pointer-events: none;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: width 0.3s, height 0.3s, background-color 0.3s, border-color 0.3s;
        }
        .custom-cursor-circle.active {
            width: 65px;
            height: 65px;
            background-color: rgba(var(--primary-rgb), 0.15);
            border-color: var(--primary-color);
        }

        /* Hide default cursor on desktops */
        @media (min-width: 992px) {
            body {
                cursor: none;
            }
            a, button, .filter-btn, .accordion-button {
                cursor: none;
            }
        }

        /* SVG Preloader Screen */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--bg-dark);
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .preloader-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
        }
        .logo-path {
            stroke: var(--primary-color);
            stroke-width: 3;
            fill: none;
            stroke-dasharray: 600;
            stroke-dashoffset: 600;
            animation: drawLogo 3s ease-in-out forwards;
        }
        @keyframes drawLogo {
            to { stroke-dashoffset: 0; }
        }

        /* Frosted Sticky Navbar */
        .navbar {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            padding: 24px 0;
            background-color: transparent;
        }
        .navbar.scrolled {
            background-color: rgba(10, 10, 15, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 14px 0;
        }
        .navbar-brand h4 {
            font-weight: 800;
            font-size: 1.3rem;
            color: #ffffff;
        }
        .navbar-brand span {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-link {
            font-size: 0.92rem;
            font-weight: 500;
            color: var(--text-secondary) !important;
            padding: 6px 18px !important;
            position: relative;
            transition: color 0.3s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 18px;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: width 0.3s ease;
        }
        .nav-link:hover::after, .nav-item.active .nav-link::after {
            width: calc(100% - 36px);
        }
        .nav-link:hover, .nav-item.active .nav-link {
            color: #ffffff !important;
        }

        /* Bento / Glassmorphic Custom Cards */
        .bento-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1;
        }
        .bento-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.15) 0%, rgba(var(--secondary-rgb), 0.15) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }
        .bento-card:hover {
            transform: translateY(-5px);
            border-color: rgba(var(--secondary-rgb), 0.3);
            box-shadow: 0 10px 30px rgba(var(--primary-rgb), 0.1);
        }
        .bento-card:hover::before {
            opacity: 1;
        }

        /* JetBrains Badges */
        .tech-badge {
            font-family: 'JetBrains Mono', monospace;
            background-color: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255,255,255,0.06);
            color: var(--text-secondary);
            font-size: 0.78rem;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-block;
            transition: all 0.3s;
        }
        .tech-badge:hover {
            color: #ffffff;
            border-color: var(--secondary-color);
            box-shadow: 0 0 10px rgba(var(--secondary-rgb), 0.2);
        }

        /* Buttons Visuals */
        .btn-premium {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 12px 28px;
            border-radius: 30px;
            border: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 6px 20px rgba(var(--primary-rgb), 0.3);
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(var(--primary-rgb), 0.4);
            color: #ffffff;
        }
        
        .btn-outline-premium {
            border: 2px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            background-color: transparent;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 10px 26px;
            border-radius: 30px;
            transition: all 0.3s;
        }
        .btn-outline-premium:hover {
            border-color: var(--secondary-color);
            background-color: rgba(var(--secondary-rgb), 0.05);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(var(--secondary-rgb), 0.15);
        }

        /* WhatsApp Floating button with pulse ring */
        .whatsapp-float-premium {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #ffffff;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            z-index: 9998;
            transition: all 0.3s;
            text-decoration: none;
        }
        .whatsapp-float-premium::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            border: 2px solid #25d366;
            animation: pulse-ring 1.8s infinite ease-out;
        }
        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.35); opacity: 0; }
        }
        .whatsapp-float-premium:hover {
            transform: scale(1.1);
            color: #ffffff;
        }

        /* Glassmorphism Cookie Consent overlay */
        .cookie-consent-premium {
            position: fixed;
            bottom: 30px;
            left: 30px;
            max-width: 400px;
            background: rgba(17, 17, 24, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 20px 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 9997;
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-left: 4px solid var(--secondary-color);
        }

        /* Dynamic primary glow accent overlay */
        .brand-gradient-text {
            background: linear-gradient(135deg, var(--text-primary) 30%, var(--primary-color) 70%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        footer {
            background-color: #060609;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 80px 0 30px 0;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Grid Layout Mesh -->
    <div class="grid-overlay"></div>

    <!-- Glowing Background Orbs -->
    <div class="glow-orb glow-orb-1"></div>
    <div class="glow-orb glow-orb-2"></div>

    <!-- Custom Cursor follow elements -->
    <div class="custom-cursor-dot d-none d-lg-block"></div>
    <div class="custom-cursor-circle d-none d-lg-block"></div>

    <!-- SVG Logo Preloader Overlay -->
    <div id="preloader">
        <svg class="preloader-logo" viewBox="0 0 100 100">
            <!-- Intersecting tech geometric grid -->
            <path class="logo-path" d="M20,50 L50,20 L80,50 L50,80 Z M50,20 L50,80 M20,50 L80,50" />
        </svg>
        <div class="text-white small fw-bold tracking-widest mt-2" style="font-family: 'JetBrains Mono', monospace; letter-spacing: 2px;">INITIALIZING UTILITIES</div>
    </div>

    <!-- Transparent Frosted Header -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('frontend.home') }}">
                @php $logo = \App\Models\Setting::get('site_logo') @endphp
                @if($logo)
                    <img src="{{ asset('storage/' . $logo) }}" alt="Logo" style="max-height: 40px;">
                @endif
                <h4 class="mb-0">{{ \App\Models\Setting::get('site_name', 'Narjis') }}<span>{{ \App\Models\Setting::get('site_tagline') ? ' Infotech' : '' }}</span></h4>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ri-menu-4-line fa-2x"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
                    @foreach(\App\Models\Menu::where('is_enabled', true)->orderBy('sort_order')->get() as $menu)
                        <li class="nav-item {{ Request::url() == route($menu->route_name) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route($menu->route_name) }}">{{ $menu->label }}</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('frontend.contact') }}" class="btn btn-premium">Book a Call <i class="fa-solid fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </nav>

    <!-- Content Block -->
    <div class="main-body">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 mb-4">
                    @if(\App\Models\Setting::get('footer_show_logo', true))
                    <a class="navbar-brand text-decoration-none d-flex align-items-center gap-2 mb-3" href="{{ route('frontend.home') }}">
                        @if($logo)
                            <img src="{{ asset('storage/' . $logo) }}" alt="Logo" style="max-height: 40px;">
                        @endif
                        @php 
                            $customLogoText = \App\Models\Setting::get('footer_logo_text', 'NARJIS INFOTECH');
                            $parts = explode(' ', $customLogoText);
                            $lastWord = count($parts) > 1 ? array_pop($parts) : '';
                            $firstPart = implode(' ', $parts);
                        @endphp
                        <h4 class="text-white mb-0">{!! $firstPart !!}@if($lastWord)<span> {!! $lastWord !!}</span>@endif</h4>
                    </a>
                    @endif
                    
                    @if(\App\Models\Setting::get('footer_show_tagline', true))
                    <p class="small mb-4 text-muted">{{ \App\Models\Setting::get('site_tagline') }}</p>
                    @endif
                    
                    @if(\App\Models\Setting::get('footer_show_socials', true))
                    <!-- Social icons with individual hover glows -->
                    <div class="social-icons d-flex gap-2">
                        @php
                            $fb = \App\Models\Setting::get('social_facebook');
                            $ig = \App\Models\Setting::get('social_instagram');
                            $li = \App\Models\Setting::get('social_linkedin');
                            $tw = \App\Models\Setting::get('social_twitter');
                        @endphp
                        @if($fb) <a href="{{ $fb }}" target="_blank" class="tech-badge" style="padding: 8px 12px;"><i class="fa-brands fa-facebook-f"></i></a> @endif
                        @if($ig) <a href="{{ $ig }}" target="_blank" class="tech-badge" style="padding: 8px 12px;"><i class="fa-brands fa-instagram"></i></a> @endif
                        @if($li) <a href="{{ $li }}" target="_blank" class="tech-badge" style="padding: 8px 12px;"><i class="fa-brands fa-linkedin-in"></i></a> @endif
                        @if($tw) <a href="{{ $tw }}" target="_blank" class="tech-badge" style="padding: 8px 12px;"><i class="fa-brands fa-x-twitter"></i></a> @endif
                    </div>
                    @endif
                </div>

                @if(\App\Models\Setting::get('footer_show_company', true))
                <div class="col-sm-6 col-lg-2">
                    <h6 class="text-white mb-4 text-uppercase tracking-wider small fw-bold">Company</h6>
                    <ul class="list-unstyled small">
                        @foreach(\App\Models\Menu::where('is_enabled', true)->orderBy('sort_order')->limit(4)->get() as $menu)
                            <li class="mb-2"><a href="{{ route($menu->route_name) }}" class="text-decoration-none text-muted hover-white" style="transition: all 0.2s;">{{ $menu->label }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(\App\Models\Setting::get('footer_show_solutions', true))
                <div class="col-sm-6 col-lg-3">
                    <h6 class="text-white mb-4 text-uppercase tracking-wider small fw-bold">Solutions Offered</h6>
                    <ul class="list-unstyled small">
                        @foreach(\App\Models\Service::where('status', true)->limit(4)->get() as $srv)
                            <li class="mb-2"><a href="{{ route('frontend.services') }}" class="text-decoration-none text-muted hover-white" style="transition: all 0.2s;">{{ $srv->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(\App\Models\Setting::get('footer_show_address', true) || \App\Models\Setting::get('footer_show_phone', true) || \App\Models\Setting::get('footer_show_email', true))
                <div class="col-lg-3">
                    <h6 class="text-white mb-4 text-uppercase tracking-wider small fw-bold">Surat HQ Location</h6>
                    <ul class="list-unstyled small text-muted">
                        @if(\App\Models\Setting::get('footer_show_address', true))
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fa-solid fa-location-dot text-primary me-3 mt-1" style="color: var(--secondary-color) !important;"></i>
                            <span>{{ \App\Models\Setting::get('address') }}</span>
                        </li>
                        @endif
                        @if(\App\Models\Setting::get('footer_show_phone', true))
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-phone text-success me-3"></i>
                            <span>{{ \App\Models\Setting::get('phone_1') }}</span>
                        </li>
                        @endif
                        @if(\App\Models\Setting::get('footer_show_email', true))
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-envelope text-info me-3"></i>
                            <span>{{ \App\Models\Setting::get('email') }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>

            <hr class="border-secondary border-opacity-10 my-4">

            <div class="row">
                <div class="col-md-6 text-center text-md-start small">
                    <p class="mb-0 text-muted">{{ \App\Models\Setting::get('footer_copyright') }}</p>
                </div>
                <div class="col-md-6 text-center text-md-end small mt-2 mt-md-0">
                    <p class="mb-0 text-muted">{{ \App\Models\Setting::get('footer_attribution', 'Made with ❤️ in Surat') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp widget with active pulse animation -->
    @php $wa = \App\Models\Setting::get('whatsapp_number') @endphp
    @if($wa)
        <a href="https://wa.me/{{ $wa }}?text=Hello,%20I'm%20interested%20in%20your%20premium%20services!" class="whatsapp-float-premium" target="_blank">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    @endif

    <!-- Cookies Premium slide-up glass overlay -->
    <div class="cookie-consent-premium" id="cookieOverlay">
        <div class="cookie-text text-white small">
            <i class="ri-cookie-line me-2 text-warning fa-lg"></i>
            {{ \App\Models\Setting::get('cookie_consent_text', 'We employ cookies for analytics.') }}
        </div>
        <button type="button" class="btn btn-sm btn-premium" id="acceptCookie" style="padding: 6px 16px;">Accept</button>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Premium Animations Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.19/bundled/lenis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS Animations
        AOS.init({
            duration: 900,
            once: true,
            offset: 80
        });

        // Initialize Lenis Smooth Scroll globally
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothWheel: true
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // SVG draw out preloader screen fade-out
        $(window).on('load', function() {
            setTimeout(function() {
                gsap.to('#preloader', {
                    opacity: 0,
                    visibility: 'hidden',
                    duration: 0.6,
                    ease: 'power2.out'
                });
            }, 1000);
        });

        $(document).ready(function() {
            // Navbar Frosted glass transitions on scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 40) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
            if ($(window).scrollTop() > 40) {
                $('.navbar').addClass('scrolled');
            }

            // Custom Trail Cursor handlers
            const dot = document.querySelector('.custom-cursor-dot');
            const circle = document.querySelector('.custom-cursor-circle');

            document.addEventListener('mousemove', function(e) {
                if(dot && circle) {
                    dot.style.left = e.clientX + 'px';
                    dot.style.top = e.clientY + 'px';
                    
                    gsap.to(circle, {
                        x: e.clientX,
                        y: e.clientY,
                        duration: 0.12,
                        ease: 'power2.out'
                    });
                }
            });

            // Toggle custom cursor states on links and buttons
            $('a, button, .filter-btn, .accordion-button').on('mouseenter', function() {
                if(circle) {
                    circle.classList.add('active');
                    var txt = $(this).attr('data-hover-text');
                    if(txt) {
                        circle.innerText = txt;
                    }
                }
            }).on('mouseleave', function() {
                if(circle) {
                    circle.classList.remove('active');
                    circle.innerText = '';
                }
            });

            // Cookie Consent Handler
            if (!localStorage.getItem('cookie_consent_premium')) {
                setTimeout(function() {
                    $('#cookieOverlay').css('display', 'flex').hide().fadeIn(500);
                }, 1500);
            }

            $('#acceptCookie').on('click', function() {
                localStorage.setItem('cookie_consent_premium', 'true');
                $('#cookieOverlay').fadeOut(400);
            });

            // Initialize Vanilla Tilt.js on Bento glass cards
            if (typeof VanillaTilt !== 'undefined') {
                VanillaTilt.init(document.querySelectorAll(".tilt-card"), {
                    max: 12,
                    speed: 400,
                    glare: true,
                    "max-glare": 0.15,
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
