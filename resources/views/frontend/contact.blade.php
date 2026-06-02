@extends('layouts.app')

@section('title', 'Contact Us - ' . \App\Models\Setting::get('site_name'))

@section('content')
<!-- Page Header Banner -->
<section class="page-header py-5 text-center text-md-start" style="background: radial-gradient(circle at 10% 20%, rgba(var(--primary-rgb), 0.05) 0%, transparent 40%); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-2 text-white">Contact Us</h1>
                <p class="text-muted mb-0">Get in touch with our tech experts, request a project quote, or schedule a strategy call.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0" data-aos="fade-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none text-primary">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Main Details & Maps -->
<section class="contact-details py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Left Column: Form -->
            <div class="col-lg-7" data-aos="fade-right">
                <div class="bento-card p-4 p-md-5">
                    <h3 class="fw-bold mb-2 text-white">Request a Quote</h3>
                    <p class="text-muted small mb-4">Send us your project scope and objectives. Our team will contact you shortly.</p>
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success mb-4" style="border-radius: 8px;">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('frontend.contact.submit') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label small fw-bold text-white">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="e.g. John Doe">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label small fw-bold text-white">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="e.g. name@company.com">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="country_code" class="form-label small fw-bold text-white">Country Code</label>
                                <input type="text" class="form-control" id="country_code" name="country_code" placeholder="e.g. +91" value="+91">
                            </div>

                            <div class="col-md-8 mb-4">
                                <label for="phone" class="form-label small fw-bold text-white">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required placeholder="e.g. 9876543210">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="service" class="form-label small fw-bold text-white">Service Type Required</label>
                            <select class="form-select" id="service" name="service">
                                <option value="" disabled selected class="text-dark">Select Service</option>
                                @foreach(\App\Models\Service::where('status', true)->get() as $srv)
                                    <option value="{{ $srv->title }}" class="text-dark">{{ $srv->title }}</option>
                                @endforeach
                                <option value="General Inquiry" class="text-dark">General / Other</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label small fw-bold text-white">Outline your Message / Requirements</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Describe your software goals, platform parameters, budget, or timelines..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-premium w-100 py-3"><i class="ri-mail-send-line me-2"></i> Submit Inquiry Proposal</button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Map & Corporate Contacts -->
            <div class="col-lg-5" data-aos="fade-left">
                <h4 class="fw-bold mb-4 text-white">Office Coordinates</h4>
                
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <div class="bento-card p-4 d-flex align-items-start border-start border-primary border-4" style="background-color: rgba(255,255,255,0.01);">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; flex-shrink: 0; background-color: rgba(var(--primary-rgb), 0.1) !important;">
                                <i class="ri-map-pin-line fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 small text-white">HQ Location Address</h6>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">{{ $settings['address'] ?? 'Surat, Gujarat, India' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="bento-card p-4 d-flex align-items-start border-start border-success border-4 h-100" style="background-color: rgba(255,255,255,0.01);">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; flex-shrink: 0; background-color: rgba(0, 230, 118, 0.1) !important;">
                                <i class="ri-phone-line fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 small text-white">Phone Lines</h6>
                                <p class="text-muted small mb-0">{{ $settings['phone_1'] ?? '+91 98765 43210' }}<br>{{ $settings['phone_2'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="bento-card p-4 d-flex align-items-start border-start border-info border-4 h-100" style="background-color: rgba(255,255,255,0.01);">
                            <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; flex-shrink: 0; background-color: rgba(var(--secondary-rgb), 0.1) !important;">
                                <i class="ri-mail-line fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 small text-white">Email Support</h6>
                                <a href="mailto:{{ $settings['email'] ?? 'info@narjis.com' }}" class="text-muted small text-decoration-none d-block text-truncate" style="max-width: 140px;">{{ $settings['email'] ?? 'info@narjis.com' }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Map Iframe Integration -->
                @if(!empty($settings['map_link']))
                    <div class="bento-card overflow-hidden shadow-sm p-0" style="height: 260px;">
                        <!-- Custom styled dark embed map visual overlay -->
                        <iframe src="{{ $settings['map_link'] }}" width="100%" height="100%" style="border:0; filter: invert(90%) hue-rotate(180deg);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
