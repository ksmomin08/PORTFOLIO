@extends('layouts.app')

@section('title', 'Our Products - ' . \App\Models\Setting::get('site_name'))

@section('content')
<!-- Page Header Banner -->
<section class="page-header py-5 text-center text-md-start" style="background: radial-gradient(circle at 10% 20%, rgba(var(--primary-rgb), 0.05) 0%, transparent 40%); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-2 text-white">Our Digital Products</h1>
                <p class="text-muted mb-0">Discover our customized SaaS systems, enterprise CRMs, and commercially available web assets.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0" data-aos="fade-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none text-primary">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid Section -->
<section class="products-grid py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="bento-card tilt-card p-0 h-100 overflow-hidden d-flex flex-column">
                        <div style="height: 240px; overflow: hidden; position: relative;">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, transparent 40%, rgba(10, 10, 15, 0.9) 100%);"></div>
                        </div>
                        <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                @if($product->category)
                                    <span class="tech-badge mb-2 align-self-start">{{ $product->category }}</span>
                                @endif
                                <h4 class="fw-bold text-white mb-2 h5">{{ $product->title }}</h4>
                                <p class="text-muted small mb-4" style="line-height: 1.6;">{{ $product->description }}</p>
                            </div>
                            @if($product->demo_url)
                                <div class="mt-auto">
                                    <a href="{{ $product->demo_url }}" target="_blank" class="btn btn-premium w-100 text-center"><i class="ri-arrow-right-up-line me-2"></i> Launch Product Demo</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Digital products listed shortly.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
