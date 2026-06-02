@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 text-primary">Manage Hero Section & Counters</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <!-- Left Column: Hero Text content -->
                        <div class="col-md-6 border-end border-secondary border-opacity-10 pr-lg-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Main Hero Texts</h6>
                            
                            <div class="mb-3">
                                <label for="hero_tagline" class="form-label">Hero Tagline / Small text (e.g. INNOVATION • SUCCESS)</label>
                                <input type="text" class="form-control" id="hero_tagline" name="hero_tagline" value="{{ $settings['hero_tagline'] ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label for="hero_title" class="form-label">Main Heading / Title</label>
                                <textarea class="form-control" id="hero_title" name="hero_title" rows="2" required>{{ $settings['hero_title'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="hero_subtitle" class="form-label">Subheading / Description Text</label>
                                <textarea class="form-control" id="hero_subtitle" name="hero_subtitle" rows="3">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="hero_bg" class="form-label">Hero Background Image</label>
                                <input type="file" class="form-control" id="hero_bg" name="hero_bg">
                                @if(isset($settings['hero_bg']))
                                    <div class="mt-2 p-2 border border-secondary border-opacity-10 rounded d-inline-block" style="background-color: rgba(255,255,255,0.01);">
                                        <img src="{{ asset('storage/' . $settings['hero_bg']) }}" alt="Hero Background" class="img-thumbnail border-0" style="max-height: 80px; background: transparent;">
                                    </div>
                                @endif
                            </div>

                            <hr class="border-secondary border-opacity-10 my-4">

                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Rotating Typewriter Keywords</h6>
                            
                            <div class="mb-3">
                                <label for="hero_typewriter_words" class="form-label">Typewriter Rotating Words (Comma-Separated)</label>
                                <input type="text" class="form-control" id="hero_typewriter_words" name="hero_typewriter_words" value="{{ $settings['hero_typewriter_words'] ?? 'Experiences, Products, Solutions, Applications' }}">
                                <div class="form-text small text-muted">Use commas to separate words, e.g. Experiences, Products, Solutions</div>
                            </div>

                            <hr class="border-secondary border-opacity-10 my-4">

                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">CTA Buttons & Scrolling Marquee</h6>
                            
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="hero_cta_1_text" class="form-label">Button 1 Text</label>
                                    <input type="text" class="form-control" id="hero_cta_1_text" name="hero_cta_1_text" value="{{ $settings['hero_cta_1_text'] ?? 'View Our Work' }}">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="hero_cta_1_link" class="form-label">Button 1 Link</label>
                                    <input type="text" class="form-control" id="hero_cta_1_link" name="hero_cta_1_link" value="{{ $settings['hero_cta_1_link'] ?? '/portfolio' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="hero_cta_2_text" class="form-label">Button 2 Text</label>
                                    <input type="text" class="form-control" id="hero_cta_2_text" name="hero_cta_2_text" value="{{ $settings['hero_cta_2_text'] ?? 'Let\'s Discuss' }}">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="hero_cta_2_link" class="form-label">Button 2 Link</label>
                                    <input type="text" class="form-control" id="hero_cta_2_link" name="hero_cta_2_link" value="{{ $settings['hero_cta_2_link'] ?? '/contact-us' }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="hero_marquee_text" class="form-label">Scrolling Marquee Text (Comma-Separated)</label>
                                <input type="text" class="form-control" id="hero_marquee_text" name="hero_marquee_text" value="{{ $settings['hero_marquee_text'] ?? 'FULL-STACK LARAVEL, AWWWARDS PREMIUM UI/UX, GSAP SCROLL TRIGGER, REACT & NEXT.JS, CLOUD SYSTEM MANAGEMENT' }}">
                                <div class="form-text small text-muted">Use commas to separate skills/services scrolling in the loop at the bottom of the hero section.</div>
                            </div>
                        </div>

                        <!-- Right Column: Stats & Badges -->
                        <div class="col-md-6 pl-lg-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Statistics Counters</h6>
                            
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="stat_years" class="form-label">Years of Experience</label>
                                    <input type="text" class="form-control" id="stat_years" name="stat_years" value="{{ $settings['stat_years'] ?? '' }}">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="stat_projects" class="form-label">Projects Completed</label>
                                    <input type="text" class="form-control" id="stat_projects" name="stat_projects" value="{{ $settings['stat_projects'] ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="stat_clients" class="form-label">Happy Clients</label>
                                    <input type="text" class="form-control" id="stat_clients" name="stat_clients" value="{{ $settings['stat_clients'] ?? '' }}">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="stat_team" class="form-label">Expert Team Members</label>
                                    <input type="text" class="form-control" id="stat_team" name="stat_team" value="{{ $settings['stat_team'] ?? '' }}">
                                </div>
                            </div>

                            <hr class="border-secondary border-opacity-10 my-4">

                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Dynamic Glassmorphic Badges</h6>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-sm-6">
                                    <label for="hero_badge_1_text" class="form-label small fw-semibold text-white">Badge 1: Label</label>
                                    <input type="text" class="form-control form-control-sm" id="hero_badge_1_text" name="hero_badge_1_text" value="{{ $settings['hero_badge_1_text'] ?? 'Laravel Expert 🔥' }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="hero_badge_1_icon" class="form-label small fw-semibold text-white">Badge 1: Icon Class</label>
                                    <input type="text" class="form-control form-control-sm" id="hero_badge_1_icon" name="hero_badge_1_icon" value="{{ $settings['hero_badge_1_icon'] ?? 'ri-fire-fill text-danger' }}">
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-sm-6">
                                    <label for="hero_badge_2_text" class="form-label small fw-semibold text-white">Badge 2: Label</label>
                                    <input type="text" class="form-control form-control-sm" id="hero_badge_2_text" name="hero_badge_2_text" value="{{ $settings['hero_badge_2_text'] ?? '5★ Rated' }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="hero_badge_2_icon" class="form-label small fw-semibold text-white">Badge 2: Icon Class</label>
                                    <input type="text" class="form-control form-control-sm" id="hero_badge_2_icon" name="hero_badge_2_icon" value="{{ $settings['hero_badge_2_icon'] ?? 'ri-star-fill text-warning' }}">
                                </div>
                            </div>

                            <div class="row g-2 mb-4">
                                <div class="col-sm-6">
                                    <label for="hero_badge_3_text" class="form-label small fw-semibold text-white">Badge 3: Label</label>
                                    <input type="text" class="form-control form-control-sm" id="hero_badge_3_text" name="hero_badge_3_text" value="{{ $settings['hero_badge_3_text'] ?? '50+ Projects' }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="hero_badge_3_icon" class="form-label small fw-semibold text-white">Badge 3: Icon Class</label>
                                    <input type="text" class="form-control form-control-sm" id="hero_badge_3_icon" name="hero_badge_3_icon" value="{{ $settings['hero_badge_3_icon'] ?? 'ri-code-s-slash-line text-info' }}">
                                </div>
                            </div>

                            <hr class="border-secondary border-opacity-10 my-4">

                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Visibility Controls</h6>
                            
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                        <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="hero_show_badges" name="hero_show_badges" value="1" {{ ($settings['hero_show_badges'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                        <label class="form-check-label text-white small" for="hero_show_badges" style="cursor: pointer;">Show Header Badges</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                        <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="hero_show_typewriter" name="hero_show_typewriter" value="1" {{ ($settings['hero_show_typewriter'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                        <label class="form-check-label text-white small" for="hero_show_typewriter" style="cursor: pointer;">Enable Typewriter</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-secondary border-opacity-10 my-5">

                    <!-- Wide Section: Orbiting Satellite Languages / Technologies -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-transparent border-0">
                                <div class="card-header px-0 d-flex justify-content-between align-items-center border-0" style="background: transparent;">
                                    <div>
                                        <h6 class="text-uppercase text-muted fw-bold mb-1 small" style="letter-spacing: 0.5px;">Orbiting Satellite Technologies</h6>
                                        <span class="text-muted small">Manage the orbiting cards around the center icon in the homepage hero area.</span>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill" id="add-satellite-btn">
                                        <i class="fa-solid fa-plus me-1"></i> Add New Satellite
                                    </button>
                                </div>
                                <div class="card-body px-0">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-striped table-hover border-secondary border-opacity-10 align-middle" id="satellites-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30%;">Technology Name</th>
                                                    <th style="width: 40%;">Icon Class (FontAwesome / Remix Icon + styling colors)</th>
                                                    <th style="width: 20%;">Spin Speed / Duration (seconds)</th>
                                                    <th style="width: 10%;" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="satellites-container">
                                                @php
                                                    $satellites = json_decode($settings['hero_satellites'] ?? '[]', true);
                                                    if (empty($satellites)) {
                                                        $satellites = [
                                                            ['name' => 'Laravel', 'icon' => 'fa-brands fa-laravel text-danger', 'duration' => 20],
                                                            ['name' => 'MySQL', 'icon' => 'fa-solid fa-database text-info', 'duration' => 25],
                                                        ];
                                                    }
                                                @endphp
                                                @foreach($satellites as $index => $sat)
                                                    <tr class="satellite-row" data-index="{{ $index }}">
                                                        <td>
                                                            <input type="text" name="satellites[{{ $index }}][name]" class="form-control text-white border-secondary border-opacity-25" placeholder="e.g. Laravel" value="{{ $sat['name'] }}" required style="background: rgba(255,255,255,0.02);">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="satellites[{{ $index }}][icon]" class="form-control text-white border-secondary border-opacity-25 icon-class-input" placeholder="e.g. fa-brands fa-laravel text-danger" value="{{ $sat['icon'] }}" required style="background: rgba(255,255,255,0.02);">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="satellites[{{ $index }}][duration]" class="form-control text-white border-secondary border-opacity-25" placeholder="e.g. 20" value="{{ $sat['duration'] ?? 20 }}" min="5" max="120" required style="background: rgba(255,255,255,0.02);">
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-outline-danger btn-sm remove-satellite-btn"><i class="fa-solid fa-trash-can"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-text text-muted small mt-2">
                                        <i class="fa-solid fa-circle-info me-1 text-info"></i> Icons can use FontAwesome (e.g. <code>fa-brands fa-laravel text-danger</code>, <code>fa-brands fa-react text-info</code>) or Remix Icons (e.g. <code>ri-instance-fill text-warning</code>, <code>ri-flutter-fill text-primary</code>). You can combine icon classes with bootstrap text color helpers like <code>text-danger</code>, <code>text-info</code>, <code>text-success</code>, <code>text-warning</code> etc.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-5 pt-3 border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-primary px-5 py-2-5"><i class="fa-solid fa-floppy-disk me-2"></i> Save Hero Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let satelliteIndex = {{ count($satellites) }};

        // Add row
        $('#add-satellite-btn').on('click', function() {
            let rowHtml = `
                <tr class="satellite-row" data-index="${satelliteIndex}">
                    <td>
                        <input type="text" name="satellites[${satelliteIndex}][name]" class="form-control text-white border-secondary border-opacity-25" placeholder="e.g. Vue.js" required style="background: rgba(255,255,255,0.02);">
                    </td>
                    <td>
                        <input type="text" name="satellites[${satelliteIndex}][icon]" class="form-control text-white border-secondary border-opacity-25 icon-class-input" placeholder="e.g. fa-brands fa-vuejs text-success" required style="background: rgba(255,255,255,0.02);">
                    </td>
                    <td>
                        <input type="number" name="satellites[${satelliteIndex}][duration]" class="form-control text-white border-secondary border-opacity-25" placeholder="e.g. 20" value="20" min="5" max="120" required style="background: rgba(255,255,255,0.02);">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-satellite-btn"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `;
            $('#satellites-container').append(rowHtml);
            satelliteIndex++;
        });

        // Remove row
        $(document).on('click', '.remove-satellite-btn', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection
