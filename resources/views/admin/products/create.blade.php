@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Create New Product</h5>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Product Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Smart Society Management System" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Detailed product descriptions, features, and key specifications..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category" class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" placeholder="e.g. SaaS, CRM, Mobile App">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold">Product Graphic / Preview Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                                <div class="form-text small text-muted">A clear, modern banner screenshot or visual mockup. Maximum file size 3MB.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="demo_url" class="form-label fw-bold">Live Demo / Product URL</label>
                                <input type="url" class="form-control @error('demo_url') is-invalid @enderror" id="demo_url" name="demo_url" value="{{ old('demo_url') }}" placeholder="https://example.com/demo-product">
                                @error('demo_url')
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
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
