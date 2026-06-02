@extends('layouts.app')

@section('content')
<!-- Particles & Hero Section -->
<section class="hero-section text-center text-lg-start position-relative d-flex align-items-center" style="min-height: 95vh; padding: 120px 0 80px 0; overflow: hidden; background: radial-gradient(circle at 10% 20%, rgba(var(--primary-rgb), 0.08) 0%, transparent 40%);">
    
    <!-- Particles Backdrop container -->
    <div id="particles-js" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none;"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-5 mb-lg-0" data-aos="fade-right">
                
                <!-- Floating Glassmorphic Badges -->
                @if(\App\Models\Setting::get('hero_show_badges', true))
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center justify-content-lg-start">
                    @php
                        $b1_text = \App\Models\Setting::get('hero_badge_1_text', 'Laravel Expert 🔥');
                        $b1_icon = \App\Models\Setting::get('hero_badge_1_icon', 'ri-fire-fill text-danger');
                        $b2_text = \App\Models\Setting::get('hero_badge_2_text', '5★ Rated');
                        $b2_icon = \App\Models\Setting::get('hero_badge_2_icon', 'ri-star-fill text-warning');
                        $b3_text = \App\Models\Setting::get('hero_badge_3_text', '50+ Projects');
                        $b3_icon = \App\Models\Setting::get('hero_badge_3_icon', 'ri-code-s-slash-line text-info');
                    @endphp
                    @if($b1_text)
                        <span class="tech-badge" style="background: rgba(255, 255, 255, 0.04); border-color: rgba(var(--primary-rgb), 0.3); color: #ffffff;">
                            @if($b1_icon)<i class="{{ $b1_icon }} me-1"></i>@endif {!! $b1_text !!}
                        </span>
                    @endif
                    @if($b2_text)
                        <span class="tech-badge">
                            @if($b2_icon)<i class="{{ $b2_icon }} me-1"></i>@endif {!! $b2_text !!}
                        </span>
                    @endif
                    @if($b3_text)
                        <span class="tech-badge">
                            @if($b3_icon)<i class="{{ $b3_icon }} me-1"></i>@endif {!! $b3_text !!}
                        </span>
                    @endif
                </div>
                @endif

                <!-- Typographic giant heading -->
                <h1 class="display-3 fw-800 mb-3 brand-gradient-text" style="font-weight: 800; line-height: 1.1; font-size: clamp(2.5rem, 5vw, 4.5rem);">
                    {!! nl2br(e(\App\Models\Setting::get('hero_title', 'We Build Digital'))) !!}
                    @if(\App\Models\Setting::get('hero_show_typewriter', true))
                        <br><span id="typewriter" class="text-white" style="border-right: 3px solid var(--secondary-color); padding-right: 5px;">Experiences</span>
                    @endif
                </h1>
                
                <p class="lead mb-4 text-muted" style="font-size: 1.15rem; max-width: 580px; line-height: 1.7;">
                    {{ \App\Models\Setting::get('hero_subtitle', 'Transforming complex enterprise problems into award-winning web products and digital builds. We compete with awwwards standards to deliver premium engineering.') }}
                </p>

                <!-- CTA Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                    @php
                        $cta1_text = \App\Models\Setting::get('hero_cta_1_text', 'View Our Work');
                        $cta1_link = \App\Models\Setting::get('hero_cta_1_link', '/portfolio');
                        if($cta1_link === '/portfolio') {
                            $cta1_link = route('frontend.projects');
                        } elseif(!Str::startsWith($cta1_link, ['http://', 'https://', '/'])) {
                            $cta1_link = url($cta1_link);
                        }

                        $cta2_text = \App\Models\Setting::get('hero_cta_2_text', 'Let\'s Discuss');
                        $cta2_link = \App\Models\Setting::get('hero_cta_2_link', '/contact-us');
                        if($cta2_link === '/contact-us') {
                            $cta2_link = route('frontend.contact');
                        } elseif(!Str::startsWith($cta2_link, ['http://', 'https://', '/'])) {
                            $cta2_link = url($cta2_link);
                        }
                    @endphp
                    @if(!empty($cta1_text))
                        <a href="{{ $cta1_link }}" class="btn btn-premium px-4 py-3" data-hover-text="Explore"><i class="ri-apps-2-line me-2"></i> {{ $cta1_text }}</a>
                    @endif
                    @if(!empty($cta2_text))
                        <a href="{{ $cta2_link }}" class="btn btn-outline-premium px-4 py-3" data-hover-text="Talk"><i class="ri-chat-smile-2-line me-2"></i> {{ $cta2_text }}</a>
                    @endif
                </div>
            </div>

            <!-- Right: Orbiting CSS 3D illustration -->
            <div class="col-lg-5 text-center position-relative" data-aos="fade-left" style="height: 400px; display: flex; align-items: center; justify-content: center;">
                <div class="orbit-container" style="position: relative; width: 300px; height: 300px; transform-style: preserve-3d; perspective: 1000px;">
                    <!-- Floating Center Orb -->
                    <div class="center-orb" style="position: absolute; width: 100px; height: 100px; background: radial-gradient(circle, var(--primary-color) 0%, var(--secondary-color) 100%); border-radius: 50%; top: 100px; left: 100px; box-shadow: 0 0 50px rgba(var(--primary-rgb), 0.5); animation: orbit-pulse 4s infinite ease-in-out;"></div>
                    
                    @php
                        $satellites = json_decode(\App\Models\Setting::get('hero_satellites') ?? '[]', true);
                        if (empty($satellites)) {
                            $satellites = [
                                ['name' => 'Laravel', 'icon' => 'fa-brands fa-laravel text-danger', 'duration' => 20],
                                ['name' => 'MySQL', 'icon' => 'fa-solid fa-database text-info', 'duration' => 25],
                            ];
                        }
                        $count = count($satellites);
                    @endphp

                    @foreach($satellites as $index => $sat)
                        @php
                            $duration = !empty($sat['duration']) ? $sat['duration'] : 20;
                        @endphp
                        <div class="satellite sat-{{ $index }} bento-card p-2 text-center" style="position: absolute; top: 110px; left: 107.5px; width: 85px; height: 80px; border-radius: 12px; box-shadow: 0 0 20px rgba(var(--primary-rgb), 0.2); animation: sat-spin-{{ $index }} {{ $duration }}s infinite linear; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <i class="{{ $sat['icon'] }} fa-lg"></i>
                            <div class="small fw-bold text-white mt-1" style="font-size: 0.65rem;">{{ $sat['name'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom: Scrolling horizontal loop marquee -->
    <div class="position-absolute bottom-0 left-0 w-100 py-3" style="background: rgba(17, 17, 24, 0.5); border-top: 1px solid rgba(255,255,255,0.03); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
        <div class="marquee-container" style="overflow: hidden; white-space: nowrap; width: 100%;">
            <div class="marquee-content d-inline-block" style="animation: marquee-scroll 25s linear infinite;">
                @php
                    $marquee_items = array_map('trim', explode(',', \App\Models\Setting::get('hero_marquee_text', 'FULL-STACK LARAVEL, AWWWARDS PREMIUM UI/UX, GSAP SCROLL TRIGGER, REACT & NEXT.JS, CLOUD SYSTEM MANAGEMENT')));
                    $colors = ['text-primary', 'text-secondary', 'text-info', 'text-warning', 'text-danger'];
                @endphp
                
                @foreach($marquee_items as $index => $item)
                    @php $color = $colors[$index % count($colors)]; @endphp
                    <span class="mx-5 text-white small fw-bold" style="font-family: 'JetBrains Mono', monospace; opacity: 0.65;">
                        <i class="ri-circle-fill {{ $color }} me-2" style="font-size: 8px;"></i> {{ strtoupper($item) }}
                    </span>
                @endforeach
                
                <!-- Repeat for infinite loop -->
                @foreach($marquee_items as $index => $item)
                    @php $color = $colors[$index % count($colors)]; @endphp
                    <span class="mx-5 text-white small fw-bold" style="font-family: 'JetBrains Mono', monospace; opacity: 0.65;">
                        <i class="ri-circle-fill {{ $color }} me-2" style="font-size: 8px;"></i> {{ strtoupper($item) }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CSS Orbit Keyframes -->
<style>
    @keyframes orbit-pulse {
        0%, 100% { transform: scale(1); filter: drop-shadow(0 0 25px rgba(var(--primary-rgb), 0.4)); }
        50% { transform: scale(1.08); filter: drop-shadow(0 0 45px rgba(var(--secondary-rgb), 0.6)); }
    }
    @php
        foreach($satellites as $index => $sat) {
            $startAngle = $count > 0 ? ($index * (360 / $count)) : 0;
            $endAngle = $startAngle + 360;
            $radius = ($index % 2 == 0) ? 120 : 140;
            echo "
            @keyframes sat-spin-{$index} {
                0% { transform: rotate({$startAngle}deg) translateX({$radius}px) rotate(-{$startAngle}deg); }
                100% { transform: rotate({$endAngle}deg) translateX({$radius}px) rotate(-{$endAngle}deg); }
            }
            ";
        }
    @endphp
    @keyframes marquee-scroll {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-50%); }
    }
</style>

<!-- Stats Counter Section -->
<section class="stats-counter py-4" style="background: rgba(17, 17, 24, 0.4); border-top: 1px solid rgba(255,255,255,0.03); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="row align-items-center text-center py-2">
            <div class="col-6 col-md-3 mb-3 mb-md-0 position-relative">
                <h3 class="display-6 fw-bold mb-1 brand-gradient-text counter" data-target="{{ filter_var($settings['stat_years'] ?? '10', FILTER_SANITIZE_NUMBER_INT) }}">0</h3>
                <p class="text-muted small mb-0 fw-500 text-uppercase tracking-wider" style="font-size: 0.72rem;">Years Experience</p>
                <div class="d-none d-md-block" style="position: absolute; right: 0; top: 15%; height: 70%; width: 1px; background: rgba(255,255,255,0.08); box-shadow: 0 0 8px #ffffff;"></div>
            </div>
            
            <div class="col-6 col-md-3 mb-3 mb-md-0 position-relative">
                <h3 class="display-6 fw-bold mb-1 brand-gradient-text counter" data-target="{{ filter_var($settings['stat_projects'] ?? '250', FILTER_SANITIZE_NUMBER_INT) }}">0</h3>
                <p class="text-muted small mb-0 fw-500 text-uppercase tracking-wider" style="font-size: 0.72rem;">Projects Delivered</p>
                <div class="d-none d-md-block" style="position: absolute; right: 0; top: 15%; height: 70%; width: 1px; background: rgba(255,255,255,0.08); box-shadow: 0 0 8px #ffffff;"></div>
            </div>
            
            <div class="col-6 col-md-3 position-relative">
                <h3 class="display-6 fw-bold mb-1 brand-gradient-text counter" data-target="{{ filter_var($settings['stat_clients'] ?? '180', FILTER_SANITIZE_NUMBER_INT) }}">0</h3>
                <p class="text-muted small mb-0 fw-500 text-uppercase tracking-wider" style="font-size: 0.72rem;">Happy Clients</p>
                <div class="d-none d-md-block" style="position: absolute; right: 0; top: 15%; height: 70%; width: 1px; background: rgba(255,255,255,0.08); box-shadow: 0 0 8px #ffffff;"></div>
            </div>
            
            <div class="col-6 col-md-3">
                <h3 class="display-6 fw-bold mb-1 brand-gradient-text counter" data-target="{{ filter_var($settings['stat_team'] ?? '25', FILTER_SANITIZE_NUMBER_INT) }}">0</h3>
                <p class="text-muted small mb-0 fw-500 text-uppercase tracking-wider" style="font-size: 0.72rem;">Expert Engineers</p>
            </div>
        </div>
    </div>
</section>

<!-- Bento Services Section -->
<section class="services-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="tech-badge mb-2" style="color: var(--secondary-color) !important; border-color: rgba(var(--secondary-rgb), 0.3);"><i class="ri-pulse-line me-1"></i> WHAT WE DO</span>
            <h2 class="fw-bold display-5 text-white">Our Bento <span>Services</span></h2>
            <p class="text-muted">High-performing visual services custom built for standard-defining brands.</p>
        </div>

        <!-- Bento Asymmetric Grid -->
        <div class="row g-4">
            @forelse($services as $index => $srv)
                @if($loop->first)
                    <!-- Large Bento Card (features) -->
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="bento-card tilt-card h-100 d-flex flex-column justify-content-between p-4 p-md-5">
                            <div>
                                <div class="text-info mb-4">
                                    <i class="{{ $srv->icon_class ?? 'ri-computer-line' }} fa-4x" style="color: var(--secondary-color);"></i>
                                </div>
                                <h3 class="fw-bold text-white mb-3 h2">{{ $srv->title }}</h3>
                                <p class="text-muted mb-4" style="line-height: 1.8;">{{ $srv->short_description }}</p>
                            </div>
                            <a href="{{ route('frontend.services') }}#{{ $srv->slug }}" class="text-decoration-none mt-3 fw-bold text-info small" style="color: var(--secondary-color) !important;">Explore Solutions <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                @else
                    <!-- Small Bento Cards -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up">
                        <div class="bento-card tilt-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="text-primary mb-3">
                                    <i class="{{ $srv->icon_class ?? 'ri-cpu-line' }} fa-3x" style="color: var(--primary-color);"></i>
                                </div>
                                <h4 class="fw-bold text-white mb-2 h5">{{ $srv->title }}</h4>
                                <p class="text-muted small" style="line-height: 1.6;">{{ Str::limit($srv->short_description, 130) }}</p>
                            </div>
                            <a href="{{ route('frontend.services') }}#{{ $srv->slug }}" class="text-decoration-none mt-3 fw-bold text-primary small" style="color: var(--primary-color) !important;">Learn More <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-12 text-center text-muted">Core services listed shortly.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- How We Work - Connection Scroll-Line Timeline -->
<section class="how-we-work py-5">
    <div class="container text-center">
        <div class="section-header mb-5" data-aos="fade-up">
            <span class="tech-badge mb-2"><i class="ri-road-map-line me-1"></i> METHODOLOGY</span>
            <h2 class="fw-bold display-5 text-white">How We <span>Work</span></h2>
            <p class="text-muted">A systematic and transparent lifecycle to transform your vision into reality.</p>
        </div>

        <div class="row g-4 mt-4 position-relative">
            <!-- Timeline connection lines -->
            <div class="d-none d-lg-block position-absolute w-75" style="height: 2px; background: rgba(255,255,255,0.06); top: 50px; left: 12.5%; z-index: 0;">
                <div id="scroll-progress-line" style="height: 100%; width: 0%; background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)); box-shadow: 0 0 10px var(--secondary-color); transition: width 0.1s;"></div>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="bento-card h-100 text-center p-4" style="z-index: 2;">
                    <div class="mx-auto rounded-circle mb-3 d-flex align-items-center justify-content-center border border-info border-2" style="width: 60px; height: 60px; background: rgba(0,212,255,0.05);">
                        <span class="display-6 fw-bold text-info" style="font-family: 'Clash Display';">01</span>
                    </div>
                    <h5 class="fw-bold text-white mb-2">Research</h5>
                    <p class="text-muted small mb-0">Thorough market analysis, feasibility checks, and detailed feature planning.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="bento-card h-100 text-center p-4" style="z-index: 2;">
                    <div class="mx-auto rounded-circle mb-3 d-flex align-items-center justify-content-center border border-primary border-2" style="width: 60px; height: 60px; background: rgba(108,99,255,0.05);">
                        <span class="display-6 fw-bold text-primary" style="font-family: 'Clash Display';">02</span>
                    </div>
                    <h5 class="fw-bold text-white mb-2">Design</h5>
                    <p class="text-muted small mb-0">Wireframing, modern visual mockups, UI components, and premium prototypes.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="bento-card h-100 text-center p-4" style="z-index: 2;">
                    <div class="mx-auto rounded-circle mb-3 d-flex align-items-center justify-content-center border border-info border-2" style="width: 60px; height: 60px; background: rgba(0,212,255,0.05);">
                        <span class="display-6 fw-bold text-info" style="font-family: 'Clash Display';">03</span>
                    </div>
                    <h5 class="fw-bold text-white mb-2">Develop</h5>
                    <p class="text-muted small mb-0">Clean coding, robust backend engines, and extensive responsiveness checks.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="bento-card h-100 text-center p-4" style="z-index: 2;">
                    <div class="mx-auto rounded-circle mb-3 d-flex align-items-center justify-content-center border border-success border-2" style="width: 60px; height: 60px; background: rgba(0,230,118,0.05);">
                        <span class="display-6 fw-bold text-success" style="font-family: 'Clash Display';">04</span>
                    </div>
                    <h5 class="fw-bold text-white mb-2">Deliver</h5>
                    <p class="text-muted small mb-0">Rigorous QA testing, sitemap deployment, sitemap optimization, and handoff.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tech Stack Section -->
<section class="skills-section py-5">
    <div class="container text-center">
        <div class="section-header mb-5" data-aos="fade-up">
            <span class="tech-badge mb-2"><i class="ri-stack-line me-1"></i> MASTERED UTILITIES</span>
            <h2 class="fw-bold display-5 text-white">Technologies We <span>Use</span></h2>
            <p class="text-muted">We leverage the latest frameworks to build secure and highly scalable applications.</p>
        </div>

        <!-- Dynamic Brand-colored glow grids -->
        <div class="row g-3 justify-content-center mt-3" data-aos="fade-up">
            @forelse($techStacks as $tech)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="bento-card p-3 d-flex flex-column align-items-center justify-content-center h-100 tech-card" style="transition: border-color 0.3s, box-shadow 0.3s;">
                        @if(Str::startsWith($tech->icon, 'tech_stacks/'))
                            <img src="{{ asset('storage/' . $tech->icon) }}" alt="{{ $tech->name }}" style="max-height: 44px; max-width: 44px; object-fit: contain;" class="mb-2">
                        @else
                            <i class="{{ $tech->icon ?? 'ri-terminal-box-line' }} fa-2x mb-2 text-white opacity-70"></i>
                        @endif
                        <span class="small fw-bold text-white" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem;">{{ $tech->name }}</span>
                        <span class="text-muted small mt-1" style="font-size: 0.68rem;">{{ $tech->category }}</span>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted">Technologies listed shortly.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="projects-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="tech-badge mb-2"><i class="ri-gallery-line me-1"></i> FEATURED CASE STUDIES</span>
            <h2 class="fw-bold display-5 text-white">Our Work <span>Speaks</span></h2>
            <p class="text-muted">Take a look at some of our award-winning web products and digital builds.</p>
        </div>

        <div class="row g-4">
            @forelse($projects->take(3) as $proj)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="bento-card tilt-card p-0 h-100 overflow-hidden d-flex flex-column">
                        <div class="position-relative overflow-hidden" style="height: 240px;">
                            <img src="{{ asset('storage/' . $proj->image) }}" alt="{{ $proj->title }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
                            <div class="project-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, transparent 40%, rgba(10, 10, 15, 0.9) 100%); transition: opacity 0.3s;"></div>
                        </div>
                        <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <span class="tech-badge mb-2 align-self-start text-uppercase" style="font-size: 0.7rem;">{{ $proj->category }}</span>
                                <h4 class="fw-bold text-white mb-3 h5">{{ $proj->title }}</h4>
                                <p class="text-muted small mb-4" style="line-height: 1.6;">{{ Str::limit($proj->description, 120) }}</p>
                            </div>
                            @if($proj->project_url)
                                <a href="{{ $proj->project_url }}" target="_blank" class="btn btn-sm btn-outline-premium w-100 text-center" data-hover-text="CASE"><i class="ri-arrow-right-up-line me-2"></i> Launch Project</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Projects will be loaded shortly.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-us py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <span class="tech-badge mb-2"><i class="ri-questionnaire-line me-1"></i> WHY PARTNER WITH US</span>
                <h2 class="fw-bold display-5 text-white mb-4">We Craft <span>Scalability</span></h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">{{ $settings['about_text'] ?? 'We are custom app strategists dedicated to premium visual excellence.' }}</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 d-flex align-items-center text-white small">
                        <i class="ri-checkbox-circle-fill text-success fa-xl me-3"></i>
                        <span>Awwwards-level Premium Frontend UI/UX Designs</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center text-white small">
                        <i class="ri-checkbox-circle-fill text-success fa-xl me-3"></i>
                        <span>Robust & Enterprise-ready Laravel Backends</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center text-white small">
                        <i class="ri-checkbox-circle-fill text-success fa-xl me-3"></i>
                        <span>Dynamic Admin Systems with full key customization</span>
                    </li>
                </ul>
            </div>

            <!-- Absolute positioned floating cards banner -->
            <div class="col-lg-6 position-relative text-center d-flex justify-content-center align-items-center" data-aos="fade-left" style="height: 380px;">
                @if(isset($settings['about_image']))
                    <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="Why us" class="img-fluid rounded-4 shadow-sm h-100" style="object-fit: cover; max-height: 320px; width: 100%;">
                @else
                    <div class="bento-card p-5 border-start border-primary border-4" style="max-width: 420px; z-index: 2;">
                        <i class="ri-medal-fill fa-4x text-primary mb-3"></i>
                        <h4 class="fw-bold text-white mb-2">Award Winning Studio</h4>
                        <p class="text-muted small mb-0">Highly rated digital architects based in Surat, serving businesses worldwide.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- FAQs Section -->
<section class="faq-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="tech-badge mb-2"><i class="ri-question-fill me-1"></i> QUERY RESPONSE</span>
            <h2 class="fw-bold display-5 text-white">Frequently Asked <span>Questions</span></h2>
            <p class="text-muted">Have queries? We have compiled responses to our most common client inquiries.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="accordion border-0" id="faqAccordion">
                    @forelse($faqs as $index => $faq)
                        <div class="accordion-item mb-3 border-0 bg-transparent rounded-4 overflow-hidden" style="border: 1px solid rgba(255,255,255,0.05) !important;">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button fw-bold text-white {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}" style="padding: 22px; background-color: rgba(255,255,255,0.02); color: #ffffff !important;">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted p-4" style="line-height: 1.8; background-color: rgba(255,255,255,0.01); border-top: 1px solid rgba(255,255,255,0.05);">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted">FAQs will be listed soon.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call-To-Action Banner -->
<section class="cta-banner py-5 my-5 text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.15) 0%, rgba(var(--secondary-rgb), 0.15) 100%); border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05);">
    <div class="container py-4 position-relative" style="z-index: 2;" data-aos="zoom-in">
        <h2 class="display-4 fw-bold text-white mb-3">Ready to Build Something Amazing?</h2>
        <p class="text-muted lead mb-5" style="max-width: 600px; margin: 0 auto;">Partner with a world-class IT agency and scale your digital capabilities with maximum visual clarity.</p>
        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <a href="{{ route('frontend.contact') }}" class="btn btn-premium px-5 py-3" data-hover-text="START">Start a Project</a>
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="btn btn-outline-premium px-5 py-3" data-hover-text="CHAT"><i class="fa-brands fa-whatsapp me-2"></i> WhatsApp Chat</a>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                <span class="tech-badge mb-2"><i class="ri-mail-send-line me-1"></i> SEND MESSAGE</span>
                <h2 class="fw-bold display-5 text-white mb-3">Initiate <span>Contact</span></h2>
                <p class="text-muted mb-4" style="line-height: 1.7;">Send us your detailed software outlines. Our digital engineers will reply with full project proposal structures within 24 hours.</p>
                
                <div class="mb-3 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; color: var(--primary-color) !important; background-color: rgba(var(--primary-rgb), 0.1) !important;">
                        <i class="ri-phone-fill fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 small text-white">Voice Call Support</h6>
                        <span class="text-muted small">{{ $settings['phone_1'] ?? '' }}</span>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; color: var(--secondary-color) !important; background-color: rgba(var(--secondary-rgb), 0.1) !important;">
                        <i class="ri-mail-line fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 small text-white">Official Inbox Address</h6>
                        <span class="text-muted small">{{ $settings['email'] ?? '' }}</span>
                    </div>
                </div>
            </div>

            <!-- Form with floating labels & glowing borders -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="bento-card p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success mb-4" style="border-radius: 8px;">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('frontend.contact.submit') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label small fw-bold text-white">Your Full Name</label>
                                <input type="text" class="form-control text-white border-0 py-2.5 px-3 rounded-3" id="name" name="name" required placeholder="e.g. John Doe" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08) !important;">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label small fw-bold text-white">Your Business Email</label>
                                <input type="email" class="form-control text-white border-0 py-2.5 px-3 rounded-3" id="email" name="email" required placeholder="e.g. name@company.com" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08) !important;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="phone" class="form-label small fw-bold text-white">Your Contact Number</label>
                                <input type="text" class="form-control text-white border-0 py-2.5 px-3 rounded-3" id="phone" name="phone" required placeholder="e.g. +91 9876543210" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08) !important;">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="service" class="form-label small fw-bold text-white">Service Category Required</label>
                                <select class="form-select text-white border-0 py-2.5 px-3 rounded-3" id="service" name="service" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08) !important;">
                                    <option value="" disabled selected class="text-dark">Select Service</option>
                                    @foreach($services as $srv)
                                        <option value="{{ $srv->title }}" class="text-dark">{{ $srv->title }}</option>
                                    @endforeach
                                    <option value="General Inquiry" class="text-dark">General / Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label small fw-bold text-white">Message / Requirements Brief</label>
                            <textarea class="form-control text-white border-0 py-2.5 px-3 rounded-3" id="message" name="message" rows="4" required placeholder="Describe your software objectives or scale requirements..." style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08) !important;"></textarea>
                        </div>

                        <button type="submit" class="btn btn-premium w-100 py-3" data-hover-text="SEND"><i class="fa-solid fa-paper-plane me-2"></i> Submit Inquiry Proposal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Initialize Particles.js Floating dots
    if (typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', {
            "particles": {
                "number": { "value": 70, "density": { "enable": true, "value_area": 800 } },
                "color": { "value": "#ffffff" },
                "shape": { "type": "circle" },
                "opacity": { "value": 0.15, "random": true },
                "size": { "value": 3, "random": true },
                "line_linked": { "enable": true, "distance": 130, "color": "#ffffff", "opacity": 0.05, "width": 1 },
                "move": { "enable": true, "speed": 1.2 }
            },
            "retina_detect": true
        });
    }

    $(document).ready(function() {
        // Stats counters spin animation
        const counters = document.querySelectorAll('.counter');
        const speed = 150;

        const startCount = (counter) => {
            const updateCount = () => {
                const rawTarget = counter.getAttribute('data-target') || '0';
                const target = parseInt(rawTarget.replace(/\D/g, '')) || 0;
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target + '+';
                }
            };
            updateCount();
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCount(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            observer.observe(counter);
        });

        // Typewriter Rotator
        const words = {!! json_encode(array_map('trim', explode(',', \App\Models\Setting::get('hero_typewriter_words', 'Experiences, Products, Solutions, Applications')))) !!};
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const typewriterEl = document.getElementById('typewriter');

        function type() {
            const currentWord = words[wordIndex];
            if (isDeleting) {
                typewriterEl.innerText = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typewriterEl.innerText = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }

            let typeSpeed = isDeleting ? 40 : 100;

            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 1600; // Hold word
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                typeSpeed = 400; // Pause before typing next
            }

            setTimeout(type, typeSpeed);
        }
        
        if (typewriterEl) {
            type();
        }

        // GSAP ScrollTrigger for How We Work connecting timeline fill progress
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
            
            gsap.to('#scroll-progress-line', {
                scrollTrigger: {
                    trigger: '.how-we-work',
                    start: 'top 50%',
                    end: 'bottom 60%',
                    scrub: 0.5
                },
                width: '100%'
            });
        }
    });
</script>
@endsection
