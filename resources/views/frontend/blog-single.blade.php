@extends('layouts.app')

@section('title', $blog->meta_title ?? $blog->title . ' - ' . \App\Models\Setting::get('site_name'))
@section('meta_description', $blog->meta_description ?? Str::limit(strip_tags($blog->content), 150))

@section('content')
<!-- Page Header / Breadcrumb -->
<section class="page-header py-4" style="background-color: rgba(255,255,255,0.01); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small p-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.blog') }}" class="text-decoration-none text-primary">Blog</a></li>
                <li class="breadcrumb-item active text-white text-truncate" style="max-width: 300px;" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Blog Article Details -->
<section class="blog-detail py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Left Column: Main Post Content -->
            <div class="col-lg-8" data-aos="fade-right">
                <article class="blog-post">
                    <!-- Thumbnail Banner -->
                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid rounded-4 shadow-sm w-100 mb-4" style="max-height: 440px; object-fit: cover;">
                    
                    <!-- Metadata info -->
                    <div class="d-flex align-items-center flex-wrap gap-3 mb-4 text-muted small">
                        <span class="badge bg-primary px-3 py-2 fw-bold" style="background-color: var(--primary-color) !important;">{{ $blog->category->name ?? 'General' }}</span>
                        <span><i class="ri-calendar-line me-1"></i> {{ $blog->published_date ? $blog->published_date->format('F d, Y') : '' }}</span>
                        <span><i class="ri-user-3-line me-1"></i> By Admin</span>
                    </div>

                    <!-- Title -->
                    <h1 class="fw-bold text-white mb-4 display-6" style="line-height: 1.3;">{{ $blog->title }}</h1>
                    
                    <!-- Rich-Text Content -->
                    <div class="post-content mb-5 text-muted" style="line-height: 1.9; font-size: 1.05rem;">
                        {!! $blog->content !!}
                    </div>

                    <!-- Tags & Social Share -->
                    @if($blog->tags)
                        <div class="border-top border-bottom border-secondary border-opacity-10 py-3 d-flex flex-wrap gap-2 align-items-center">
                            <span class="fw-bold text-white me-2 small">Tags:</span>
                            @foreach(explode(',', $blog->tags) as $tag)
                                <span class="tech-badge">#{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    @endif
                </article>
            </div>

            <!-- Right Column: Sidebar Related Posts -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="bento-card p-4 position-sticky" style="top: 110px;">
                    <h5 class="fw-bold mb-4 text-white"><i class="ri-fire-fill text-danger me-2"></i> Related Insights</h5>
                    
                    <div class="row g-4">
                        @forelse($relatedBlogs as $rel)
                            <div class="col-12">
                                <div class="row g-3 align-items-center">
                                    <div class="col-4">
                                        <img src="{{ asset('storage/' . $rel->thumbnail) }}" alt="{{ $rel->title }}" class="img-fluid rounded-3" style="height: 65px; width: 100%; object-fit: cover;">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.88rem; line-height: 1.4;">
                                            <a href="{{ route('frontend.blog.single', $rel->slug) }}" class="text-decoration-none text-white hover-primary">{{ Str::limit($rel->title, 45) }}</a>
                                        </h6>
                                        <span class="text-muted small" style="font-size: 0.75rem;"><i class="ri-calendar-line me-1"></i> {{ $rel->published_date ? $rel->published_date->format('M d, Y') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-muted small">No related articles found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .hover-primary:hover {
        color: var(--primary-color) !important;
    }
    .post-content p {
        margin-bottom: 1.5rem;
    }
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
</style>
@endsection
