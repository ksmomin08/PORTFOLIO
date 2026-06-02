@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Add New Testimonial</h5>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="client_name" class="form-label fw-bold">Client Name</label>
                                    <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{ old('client_name') }}" placeholder="e.g. Jane Smith" required>
                                    @error('client_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="company" class="form-label fw-bold">Company / Designation</label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}" placeholder="e.g. CEO, TechCorp Inc." required>
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="review_text" class="form-label fw-bold">Client Review / Testimonial Text</label>
                                <textarea class="form-control @error('review_text') is-invalid @enderror" id="review_text" name="review_text" rows="5" placeholder="Copy the feedback exactly here..." required>{{ old('review_text') }}</textarea>
                                @error('review_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="rating" class="form-label fw-bold">Rating Score (1-5 Stars)</label>
                                <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                                    <option value="5" selected>5 Stars (Excellent)</option>
                                    <option value="4">4 Stars (Good)</option>
                                    <option value="3">3 Stars (Average)</option>
                                    <option value="2">2 Stars (Poor)</option>
                                    <option value="1">1 Star (Very Poor)</option>
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="profile_photo" class="form-label fw-bold">Client Profile Photo</label>
                                <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo">
                                <div class="form-text small text-muted">A clear profile picture. Max size 2MB.</div>
                                @error('profile_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked style="width: 50px; height: 25px;">
                                    <label class="form-check-label ms-2 mt-1" for="status">Active (Show on Frontend)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Add Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
