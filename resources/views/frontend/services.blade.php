@extends('layouts.app')

@section('title', 'Services Offered - ' . \App\Models\Setting::get('site_name'))

@section('content')
<!-- Page Header Banner -->
<section class="page-header py-5 text-center text-md-start" style="background: radial-gradient(circle at 10% 20%, rgba(var(--primary-rgb), 0.05) 0%, transparent 40%); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-2 text-white">Our Professional Services</h1>
                <p class="text-muted mb-0">Discover our technical offerings, application development strategies, and custom business solutions.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0" data-aos="fade-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none text-primary">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Services</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Services Listing -->
<section class="services-list py-5">
    <div class="container">
        <div class="row g-5">
            @forelse($services as $index => $srv)
                <div class="col-12" id="{{ $srv->slug }}" data-aos="fade-up">
                    <div class="row align-items-center {{ $index % 2 == 1 ? 'flex-md-row-reverse' : '' }}">
                        <!-- Visual Card Indicator -->
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div class="bento-card tilt-card p-5 text-center" style="background-color: rgba(var(--primary-rgb), 0.02);">
                                <i class="{{ $srv->icon_class ?? 'ri-computer-line' }} fa-5x text-primary" style="color: var(--secondary-color) !important;"></i>
                                <h3 class="fw-bold mt-4 mb-0 text-white h4">{{ $srv->title }}</h3>
                            </div>
                        </div>

                        <!-- Content Column -->
                        <div class="col-md-7">
                            <span class="tech-badge mb-2"><i class="ri-service-line me-1"></i> SOLUTIONS</span>
                            <h2 class="fw-bold mb-3 text-white">{{ $srv->title }}</h2>
                            <p class="text-muted mb-4" style="font-size: 1.05rem; line-height: 1.8;">
                                {{ $srv->short_description }}
                            </p>
                            <hr class="border-secondary border-opacity-10 my-4">
                            <h6 class="fw-bold text-white mb-3"><i class="ri-checkbox-circle-fill text-success me-2 fa-lg"></i> Our Approach & Methodology</h6>
                            <p class="text-muted small" style="white-space: pre-wrap; line-height: 1.7;">{{ $srv->full_description }}</p>
                            
                            <a href="{{ route('frontend.contact') }}?service={{ urlencode($srv->title) }}" class="btn btn-premium btn-sm mt-3"><i class="ri-mail-send-line me-2"></i> Book consultation for {{ $srv->title }}</a>
                        </div>
                    </div>
                </div>
                
                @if(!$loop->last)
                    <div class="col-12"><hr class="border-secondary border-opacity-10 my-0"></div>
                @endif
            @empty
                <div class="col-12 text-center text-muted py-5">Services will be listed shortly.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
