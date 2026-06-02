@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 text-primary">Manage About Us Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <!-- About story text -->
                        <div class="col-md-7 mb-3">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Company Bio / Story</h6>
                            
                            <div class="mb-3">
                                <label for="about_text" class="form-label">About Us Story Description</label>
                                <textarea class="form-control" id="about_text" name="about_text" rows="8" required>{{ $settings['about_text'] ?? '' }}</textarea>
                                <div class="form-text small">Tell the story of how your agency started, your core values, and what drives you.</div>
                            </div>
                        </div>

                        <!-- Side column: image, mission, vision -->
                        <div class="col-md-5 mb-3">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Mission, Vision & Media</h6>

                            <div class="mb-3">
                                <label for="about_mission" class="form-label">Our Mission Statement</label>
                                <textarea class="form-control" id="about_mission" name="about_mission" rows="3">{{ $settings['about_mission'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="about_vision" class="form-label">Our Vision Statement</label>
                                <textarea class="form-control" id="about_vision" name="about_vision" rows="3">{{ $settings['about_vision'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="about_image" class="form-label">About Us Banner/Image</label>
                                <input type="file" class="form-control" id="about_image" name="about_image">
                                @if(isset($settings['about_image']))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="About Us" class="img-thumbnail" style="max-height: 120px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Save About Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
