<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obsidian Admin - {{ \App\Models\Setting::get('site_name', 'Narjis Infotech') }}</title>
    
    <!-- Google Fonts (Poppins & JetBrains Mono) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 Icons CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Remix Icons (Premium Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #0A0A0F;
            --surface-card: #111118;
            --sidebar-bg: #0c0c14;
            --primary-accent: {{ \App\Models\Setting::get('primary_color', '#6C63FF') }}; /* Dynamic Accent */
            --secondary-accent: #00D4FF; /* Cyan */
            --border-glow: rgba(255, 255, 255, 0.06);
            --text-primary: #FFFFFF;
            --text-secondary: #A0A0B0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-secondary);
            overflow-x: hidden;
        }

        /* Obsidian Sidebar Styling */
        #sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            color: #ffffff;
            z-index: 1000;
            transition: all 0.3s;
            border-right: 1px solid var(--border-glow);
            box-shadow: 10px 0 30px rgba(0,0,0,0.5);
        }

        #sidebar .sidebar-header {
            padding: 24px;
            background-color: rgba(0,0,0,0.3);
            text-align: center;
            border-bottom: 1px solid var(--border-glow);
        }

        #sidebar .sidebar-header h4 {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        #sidebar ul.components {
            padding: 15px 0;
            height: calc(100vh - 90px);
            overflow-y: auto;
            scrollbar-width: thin;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 0.9rem;
            display: block;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        #sidebar ul li a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        #sidebar ul li a:hover, #sidebar ul li.active a {
            color: #ffffff;
            background-color: rgba(255,255,255,0.03);
            border-left-color: var(--secondary-accent);
        }

        /* Content Area */
        #content {
            margin-left: 260px;
            transition: all 0.3s;
            min-height: 100vh;
            background-color: var(--bg-dark);
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .top-navbar {
            background-color: var(--sidebar-bg);
            padding: 15px 30px;
            border-bottom: 1px solid var(--border-glow);
        }

        .top-navbar h5 {
            color: #ffffff;
            font-weight: 600;
        }

        /* Obsidian Glass Cards */
        .card {
            border: 1px solid var(--border-glow);
            border-radius: 16px;
            background-color: var(--surface-card);
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            margin-bottom: 25px;
        }

        .card-header {
            background-color: rgba(255,255,255,0.01);
            border-bottom: 1px solid var(--border-glow);
            font-weight: 600;
            color: #ffffff;
            padding: 18px 25px;
            border-top-left-radius: 16px !important;
            border-top-right-radius: 16px !important;
        }

        .card-body {
            padding: 25px;
        }

        /* Input Controls */
        .form-control, .form-select, textarea {
            background-color: rgba(255,255,255,0.03) !important;
            border: 1px solid var(--border-glow) !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 10px 15px !important;
        }
        .form-control:focus, .form-select:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.15) !important;
            border-color: var(--secondary-accent) !important;
        }

        /* Buttons Premium */
        .btn {
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-accent) 0%, var(--secondary-accent) 100%);
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(var(--primary-accent), 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(var(--primary-accent), 0.3);
        }

        /* Tables list styling */
        .table {
            color: var(--text-secondary);
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
            background-color: rgba(255,255,255,0.02) !important;
            color: #ffffff !important;
            border-bottom: 2px solid var(--border-glow);
            padding: 14px 18px;
        }

        .table td {
            padding: 14px 18px;
            font-size: 0.88rem;
            border-bottom: 1px solid var(--border-glow);
            color: var(--text-secondary);
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.01) !important;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .status-badge.active {
            background-color: rgba(0, 230, 118, 0.15);
            color: #00E676;
        }

        .status-badge.inactive {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }

        /* Form text tags style */
        .form-text {
            color: var(--text-secondary) !important;
            opacity: 0.75;
        }

        /* Responsive menu toggles */
        @media (max-width: 991.98px) {
            #sidebar {
                margin-left: -260px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                margin-left: 0;
            }
            #content.active {
                margin-left: 260px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar Obsidian Drawer -->
    <nav id="sidebar">
        <div class="sidebar-header">
            @php $logo = \App\Models\Setting::get('site_logo') @endphp
            @if($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="img-fluid mb-2" style="max-height: 40px; width: auto; object-fit: contain;">
            @endif
            <h4>{{ \App\Models\Setting::get('site_name', 'Narjis Infotech') }}</h4>
            <span class="text-muted small" style="font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: var(--secondary-accent) !important;">Control Panel</span>
        </div>

        <!-- Sidebar Search Menu -->
        <div class="px-3 mb-2 mt-3">
            <div class="position-relative">
                <input type="text" id="menuSearch" class="form-control form-control-sm py-2 ps-5 fs-13" placeholder="Search menu..." style="background-color: rgba(255,255,255,0.03); border: 1px solid var(--border-glow); color: #fff; font-size: 0.82rem; padding-left: 35px !important; border-radius: 8px;">
                <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 12px; top: 50%; transform: translateY(-50%); font-size: 0.8rem;"></i>
            </div>
        </div>

        <ul class="list-unstyled components">
            <li class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            </li>
            
            <li class="sidebar-section-title px-3 pt-3 pb-1 text-muted small text-uppercase" style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;">Core Content</li>
            
            <li class="{{ Request::routeIs('admin.services.*') ? 'active' : '' }}">
                <a href="{{ route('admin.services.index') }}"><i class="fa-solid fa-server"></i> Services</a>
            </li>
            <li class="{{ Request::routeIs('admin.tech-stack.*') ? 'active' : '' }}">
                <a href="{{ route('admin.tech-stack.index') }}"><i class="fa-solid fa-layer-group"></i> Tech Stack / Skills</a>
            </li>
            <li class="{{ Request::routeIs('admin.projects.*') ? 'active' : '' }}">
                <a href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-images"></i> Projects / Portfolio</a>
            </li>
            <li class="{{ Request::routeIs('admin.products.*') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-box-open"></i> Products</a>
            </li>
            <li class="{{ Request::routeIs('admin.team.*') ? 'active' : '' }}">
                <a href="{{ route('admin.team.index') }}"><i class="fa-solid fa-users"></i> Team Members</a>
            </li>
            <li class="{{ Request::routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <a href="{{ route('admin.testimonials.index') }}"><i class="fa-solid fa-comments"></i> Testimonials</a>
            </li>
            <li class="{{ Request::routeIs('admin.faqs.*') ? 'active' : '' }}">
                <a href="{{ route('admin.faqs.index') }}"><i class="fa-solid fa-circle-question"></i> FAQs</a>
            </li>

            <li class="sidebar-section-title px-3 pt-3 pb-1 text-muted small text-uppercase" style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;">Insights & Queries</li>
            
            <li class="{{ Request::routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                <a href="{{ route('admin.blog-categories.index') }}"><i class="fa-solid fa-tags"></i> Blog Categories</a>
            </li>
            <li class="{{ Request::routeIs('admin.blogs.*') ? 'active' : '' }}">
                <a href="{{ route('admin.blogs.index') }}"><i class="fa-solid fa-blog"></i> Blog Posts</a>
            </li>
            <li class="{{ Request::routeIs('admin.inquiries.index') ? 'active' : '' }}">
                <a href="{{ route('admin.inquiries.index') }}"><i class="fa-solid fa-envelope-open-text"></i> Inquiries</a>
            </li>

            <li class="sidebar-section-title px-3 pt-3 pb-1 text-muted small text-uppercase" style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;">Site Design</li>
            
            <li class="{{ Request::routeIs('admin.hero') ? 'active' : '' }}">
                <a href="{{ route('admin.hero') }}"><i class="fa-solid fa-circle-play"></i> Hero Section</a>
            </li>
            <li class="{{ Request::routeIs('admin.about') ? 'active' : '' }}">
                <a href="{{ route('admin.about') }}"><i class="fa-solid fa-circle-info"></i> About Us Section</a>
            </li>
            <li class="{{ Request::routeIs('admin.menus.index') ? 'active' : '' }}">
                <a href="{{ route('admin.menus.index') }}"><i class="fa-solid fa-bars"></i> Menus / Navigation</a>
            </li>
            <li class="{{ Request::routeIs('admin.settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}"><i class="fa-solid fa-gears"></i> General Settings</a>
            </li>
        </ul>
    </nav>

    <!-- Content Area -->
    <div id="content">
        <!-- Top Navbar -->
        <nav class="navbar top-navbar navbar-expand-lg">
            <div class="container-fluid p-0">
                <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary me-3 d-lg-none">
                    <i class="fa-solid fa-bars"></i>
                </button>
                
                <h5 class="m-0 text-white">Obsidian Control Center</h5>

                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3 text-muted d-none d-md-inline small"><i class="fa-regular fa-user me-1 text-info"></i> Admin: {{ Auth::guard('admin')->user()->name }}</span>
                    
                    <!-- Front View / Visit Site Button -->
                    <a href="{{ route('frontend.home') }}" target="_blank" class="btn btn-sm btn-outline-info me-2 px-3 d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-weight: 500; transition: all 0.3s ease;">
                        <i class="fa-solid fa-globe"></i>
                        <span>Front Side</span>
                    </a>

                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-power-off"></i> Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Body -->
        <div class="container-fluid px-4 py-4">
            
            <!-- Dynamic Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 8px; background-color: rgba(0, 230, 118, 0.15); color: #00E676;">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-allowed-multiple="false" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 8px; background-color: rgba(220, 53, 69, 0.15); color: #dc3545;">
                    <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-allowed-multiple="false" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-auto py-3 text-center border-top" style="background-color: var(--sidebar-bg); border-top: 1px solid var(--border-glow) !important;">
            <div class="container-fluid px-4">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start small text-muted">
                        <p class="mb-0">{{ \App\Models\Setting::get('footer_copyright') }}</p>
                    </div>
                    <div class="col-md-6 text-md-end small text-muted mt-2 mt-md-0">
                        <p class="mb-0">{{ \App\Models\Setting::get('footer_attribution', 'Made with ❤️ in Surat') }}</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 Bundle JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
        $(document).ready(function () {
            // Sidebar Toggle for Mobile
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            // Real-time Sidebar Menu Filter Search
            $('#menuSearch').on('input', function () {
                var query = $(this).val().toLowerCase().trim();
                var currentSectionHeader = null;
                var sectionHasMatch = false;

                // Loop over all list items inside components
                $('#sidebar ul.components > li').each(function () {
                    var $item = $(this);

                    // If it is a section title
                    if ($item.hasClass('sidebar-section-title')) {
                        // Apply display to the previous section title
                        if (currentSectionHeader) {
                            currentSectionHeader.toggle(sectionHasMatch);
                        }
                        currentSectionHeader = $item;
                        sectionHasMatch = false;
                        return;
                    }

                    // For regular menu items
                    var text = $item.find('a').text().toLowerCase();
                    if (text.includes(query)) {
                        $item.show();
                        sectionHasMatch = true;
                    } else {
                        $item.hide();
                    }
                });

                // Handle the last section header
                if (currentSectionHeader) {
                    var currentHeaderToggle = query === '' ? true : sectionHasMatch;
                    currentSectionHeader.toggle(currentHeaderToggle);
                }
                
                // If search query is empty, ensure all section headers are shown
                if (query === '') {
                    $('#sidebar ul.components > li.sidebar-section-title').show();
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
