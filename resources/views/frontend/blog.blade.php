@extends('layouts.app')

@section('title', 'Blog & Insights - ' . \App\Models\Setting::get('site_name'))

@section('content')
<!-- Page Header Banner -->
<section class="page-header py-5 text-center text-md-start" style="background: radial-gradient(circle at 10% 20%, rgba(var(--primary-rgb), 0.05) 0%, transparent 40%); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-2 text-white">Our Blog & Insights</h1>
                <p class="text-muted mb-0">Stay informed with industry articles, development tutorials, and corporate insights.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0" data-aos="fade-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none text-primary">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Blog Listing Section -->
<section class="blog-listing py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="bento-card p-0 h-100 overflow-hidden d-flex flex-column">
                        <div style="height: 220px; overflow: hidden; position: relative;">
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, transparent 40%, rgba(10, 10, 15, 0.9) 100%);"></div>
                        </div>
                        <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="tech-badge" style="font-size: 0.7rem;">{{ $blog->category->name ?? 'General' }}</span>
                                    <span class="text-muted small" style="font-size: 0.75rem;"><i class="ri-calendar-line me-1"></i> {{ $blog->published_date ? $blog->published_date->format('M d, Y') : '' }}</span>
                                </div>
                                <h4 class="fw-bold mb-3 h5 text-white" style="line-height: 1.4;">
                                    <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="text-decoration-none text-white hover-primary" style="transition: color 0.2s;">{{ $blog->title }}</a>
                                </h4>
                                <p class="text-muted small mb-4" style="line-height: 1.6;">{{ Str::limit(strip_tags($blog->content), 125) }}</p>
                            </div>
                            <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="text-decoration-none small fw-bold text-info mt-auto" style="color: var(--secondary-color) !important;">Read Article <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Blog posts will be listed shortly.</div>
            @endforelse
        </div>

        @if($blogs->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('styles')
<style>
    .hover-primary:hover {
        color: var(--primary-color) !important;
    }
</style>
@endsection
