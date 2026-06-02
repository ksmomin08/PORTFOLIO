@extends('layouts.app')

@section('title', 'About Us - ' . \App\Models\Setting::get('site_name'))

@section('content')
<!-- Page Header Banner -->
<section class="page-header py-5 text-center text-md-start" style="background: radial-gradient(circle at 10% 20%, rgba(var(--primary-rgb), 0.05) 0%, transparent 40%); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-2 text-white">About Our Agency</h1>
                <p class="text-muted mb-0">Learn about our digital journey, mission parameters, and expert engineering team.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0" data-aos="fade-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none text-primary">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Bio -->
<section class="about-bio py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                @if(isset($settings['about_image']))
                    <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="About Us" class="img-fluid rounded-4 shadow-sm" style="max-height: 420px; width: 100%; object-fit: cover;">
                @else
                    <div class="bento-card p-5 text-center border-start border-primary border-4" style="background-color: rgba(var(--primary-rgb), 0.03);">
                        <i class="ri-rocket-fill fa-4x text-primary mb-3"></i>
                        <h4 class="fw-bold text-white mb-2">Who We Are</h4>
                        <p class="text-muted small mb-0">A dedicated technical partner committed to empowering business scalability through applications.</p>
                    </div>
                @endif
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <span class="tech-badge mb-2"><i class="ri-history-line me-1"></i> OUR STORY</span>
                <h2 class="fw-bold mb-4 display-6 text-white">Driving <span>Digital Success</span></h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    {{ $settings['about_text'] ?? 'At Narjis Infotech, we are committed to driving digital transformation. With a dedicated team of designers, developers, and strategists, we create state-of-the-art web products and custom mobile solutions that elevate your brand and maximize efficiency.' }}
                </p>
                
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="p-3 bg-white bg-opacity-5 rounded h-100 border-start border-primary border-3" style="border: 1px solid rgba(255,255,255,0.04);">
                            <h6 class="fw-bold text-primary mb-2 small"><i class="ri-focus-3-line me-2"></i> Our Mission</h6>
                            <p class="text-muted small mb-0">{{ $settings['about_mission'] ?? 'To provide top-tier, reliable, and scalable technology solutions.' }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-white bg-opacity-5 rounded h-100 border-start border-success border-3" style="border: 1px solid rgba(255,255,255,0.04);">
                            <h6 class="fw-bold text-success mb-2 small"><i class="ri-eye-line me-2"></i> Our Vision</h6>
                            <p class="text-muted small mb-0">{{ $settings['about_vision'] ?? 'To be a globally recognized leader in digital innovation.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Journey Timeline -->
<section class="journey-timeline py-5" style="background: rgba(17, 17, 24, 0.4); border-top: 1px solid rgba(255,255,255,0.03); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="tech-badge mb-2"><i class="ri-route-line me-1"></i> HISTORY TIMELINE</span>
            <h2 class="fw-bold display-5 text-white">Our <span>Journey</span></h2>
            <p class="text-muted">The milestones and structural growth that define our agency's identity.</p>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-12">
                <div class="d-flex flex-nowrap overflow-x-auto gap-4 py-3" style="scrollbar-width: thin; -ms-overflow-style: none;">
                    
                    <div class="bento-card p-4 flex-shrink-0" style="width: 280px; border-left: 4px solid var(--primary-color);">
                        <h4 class="text-primary fw-bold mb-2">2016</h4>
                        <h6 class="fw-bold text-white mb-2">Founding Day</h6>
                        <p class="text-muted small mb-0">Started as a 3-member developer studio crafting custom landing pages.</p>
                    </div>

                    <div class="bento-card p-4 flex-shrink-0" style="width: 280px; border-left: 4px solid #25d366;">
                        <h4 class="text-success fw-bold mb-2">2018</h4>
                        <h6 class="fw-bold text-white mb-2">First Enterprise App</h6>
                        <p class="text-muted small mb-0">Launched a robust SaaS dashboard for international logistic systems.</p>
                    </div>

                    <div class="bento-card p-4 flex-shrink-0" style="width: 280px; border-left: 4px solid #ffc107;">
                        <h4 class="text-warning fw-bold mb-2">2021</h4>
                        <h6 class="fw-bold text-white mb-2">Global Expansion</h6>
                        <p class="text-muted small mb-0">Expanded team to 15+ engineers and partnered with major US retail brands.</p>
                    </div>

                    <div class="bento-card p-4 flex-shrink-0" style="width: 280px; border-left: 4px solid #dc3545;">
                        <h4 class="text-danger fw-bold mb-2">2024</h4>
                        <h6 class="fw-bold text-white mb-2">AI Integrations</h6>
                        <p class="text-muted small mb-0">Began implementing advanced LLM models and custom AI assistants for enterprise automation.</p>
                    </div>

                    <div class="bento-card p-4 flex-shrink-0" style="width: 280px; border-left: 4px solid var(--primary-color);">
                        <h4 class="text-primary fw-bold mb-2">2026</h4>
                        <h6 class="fw-bold text-white mb-2">The Future</h6>
                        <p class="text-muted small mb-0">Setting new milestones in software design, speed, and premium product engineering.</p>
                    </div>

                </div>
                <div class="text-muted small text-center mt-3"><i class="fa-solid fa-left-right me-1"></i> Drag / Scroll horizontally to explore our journey timeline</div>
            </div>
        </div>
    </div>
</section>

<!-- Team Members -->
<section class="team-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="tech-badge mb-2"><i class="ri-user-star-line me-1"></i> OUR ORG</span>
            <h2 class="fw-bold display-5 text-white">Meet the <span>Experts</span></h2>
            <p class="text-muted">Our dedicated team of seasoned web designers and system architects.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($teamMembers as $member)
                <div class="col-lg-3 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="bento-card tilt-card text-center h-100 p-0 overflow-hidden">
                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                        <div class="p-4">
                            <h5 class="fw-bold text-white mb-1 h6">{{ $member->name }}</h5>
                            <p class="text-muted small mb-3" style="font-size: 0.82rem;">{{ $member->designation }}</p>
                            @if($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank" class="text-info"><i class="ri-linkedin-box-fill fa-lg"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Team profile is being finalized.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
