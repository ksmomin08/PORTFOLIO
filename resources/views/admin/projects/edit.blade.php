@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Edit Project: {{ $project->title }}</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Project Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}" placeholder="e.g. E-Commerce Platform" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Describe the project objective, features, and key challenges solved..." required>{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category" class="form-label fw-bold">Category</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="Web" {{ $project->category == 'Web' ? 'selected' : '' }}>Web Development</option>
                                    <option value="Mobile" {{ $project->category == 'Mobile' ? 'selected' : '' }}>Mobile Apps</option>
                                    <option value="UI/UX" {{ $project->category == 'UI/UX' ? 'selected' : '' }}>UI/UX Design</option>
                                    <option value="SaaS" {{ $project->category == 'SaaS' ? 'selected' : '' }}>SaaS Product</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold">Project Banner / Preview Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                <div class="form-text small text-muted">Leave blank if you don't want to change the image. Maximum file size 3MB.</div>
                                @if($project->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-height: 80px; max-width: 120px; object-fit: cover;">
                                        <span class="text-muted small ms-2">Current Image</span>
                                    </div>
                                @endif
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="project_url" class="form-label fw-bold">Live Project Link / Demo URL</label>
                                <input type="url" class="form-control @error('project_url') is-invalid @enderror" id="project_url" name="project_url" value="{{ old('project_url', $project->project_url) }}" placeholder="https://example.com/project">
                                @error('project_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $project->status ? 'checked' : '' }} style="width: 50px; height: 25px;">
                                    <label class="form-check-label ms-2 mt-1" for="status">Active (Show on Frontend)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
