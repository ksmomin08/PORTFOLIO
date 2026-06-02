@extends('layouts.app')

@section('title', 'Our Portfolio - ' . \App\Models\Setting::get('site_name'))

@section('content')
<!-- Page Header Banner -->
<section class="page-header py-5 text-center text-md-start" style="background: radial-gradient(circle at 10% 20%, rgba(var(--primary-rgb), 0.05) 0%, transparent 40%); border-bottom: 1px solid rgba(255,255,255,0.03);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-2 text-white">Our Portfolio</h1>
                <p class="text-muted mb-0">Explore our custom web designs, SaaS integrations, and mobile engineering solutions.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0" data-aos="fade-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none text-primary">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Portfolio</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Grid Section -->
<section class="portfolio-grid py-5">
    <div class="container">
        <!-- Categories Filter Bar -->
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-12 text-center">
                <div class="d-inline-flex flex-wrap gap-2 p-2 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);">
                    <button class="btn btn-sm btn-primary active filter-btn px-4 py-2 rounded-3" data-filter="all">All Projects</button>
                    @foreach($categories as $cat)
                        <button class="btn btn-sm btn-outline-premium filter-btn px-4 py-2 rounded-3" data-filter="{{ Str::slug($cat) }}" style="border-width: 1px !important;">{{ $cat }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Grid of Projects -->
        <div class="row g-4" id="projectsContainer">
            @forelse($projects as $project)
                <div class="col-lg-4 col-md-6 project-item filter-{{ Str::slug($project->category) }}" data-aos="fade-up">
                    <div class="bento-card tilt-card p-0 h-100 overflow-hidden d-flex flex-column">
                        <div style="height: 240px; overflow: hidden; position: relative;">
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, transparent 40%, rgba(10, 10, 15, 0.9) 100%);"></div>
                        </div>
                        <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <span class="tech-badge mb-2 align-self-start">{{ $project->category }}</span>
                                <h4 class="fw-bold text-white mb-2 h5">{{ $project->title }}</h4>
                                <p class="text-muted small mb-4" style="line-height: 1.6;">{{ $project->description }}</p>
                            </div>
                            @if($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" class="btn btn-sm btn-outline-premium w-100 text-center"><i class="ri-arrow-right-up-line me-2"></i> Live Demo</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">No projects found.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.filter-btn').on('click', function() {
            $('.filter-btn').removeClass('btn-primary active').addClass('btn-outline-premium');
            $(this).addClass('btn-primary active').removeClass('btn-outline-premium');

            var filter = $(this).attr('data-filter');

            if(filter === 'all') {
                $('.project-item').hide().fadeIn(450);
            } else {
                $('.project-item').hide();
                $('.project-item.filter-' + filter).fadeIn(450);
            }
        });
    });
</script>
@endsection
