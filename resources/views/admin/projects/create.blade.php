@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Add New Project</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Project Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. E-Commerce Platform" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Describe the project objective, features, and key challenges solved..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category" class="form-label fw-bold">Category</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="Web">Web Development</option>
                                    <option value="Mobile">Mobile Apps</option>
                                    <option value="UI/UX">UI/UX Design</option>
                                    <option value="SaaS">SaaS Product</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold">Project Banner / Preview Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                                <div class="form-text small text-muted">A clear, modern banner screenshot or visual mockup. Maximum file size 3MB.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="project_url" class="form-label fw-bold">Live Project Link / Demo URL</label>
                                <input type="url" class="form-control @error('project_url') is-invalid @enderror" id="project_url" name="project_url" value="{{ old('project_url') }}" placeholder="https://example.com/project">
                                @error('project_url')
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
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
