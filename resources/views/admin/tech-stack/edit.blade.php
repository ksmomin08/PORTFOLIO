@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Edit Technology / Skill: {{ $techStack->name }}</h5>
                <a href="{{ route('admin.tech-stack.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tech-stack.update', $techStack->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Technology Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $techStack->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label fw-bold">Category</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="Frontend" {{ $techStack->category == 'Frontend' ? 'selected' : '' }}>Frontend</option>
                                    <option value="Backend" {{ $techStack->category == 'Backend' ? 'selected' : '' }}>Backend</option>
                                    <option value="Database" {{ $techStack->category == 'Database' ? 'selected' : '' }}>Database</option>
                                    <option value="Version Control" {{ $techStack->category == 'Version Control' ? 'selected' : '' }}>Version Control</option>
                                    <option value="App" {{ $techStack->category == 'App' ? 'selected' : '' }}>Mobile App / Desktop</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sort_order" class="form-label fw-bold">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $techStack->sort_order) }}" required>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card bg-light border-0 mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3"><i class="fa-solid fa-icons text-primary me-2"></i> Technology Icon</h6>
                                    
                                    <div class="mb-3">
                                        <label for="icon" class="form-label small">Option 1: FontAwesome Class (e.g. <code>fa-brands fa-laravel</code>)</label>
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', !Str::startsWith($techStack->icon, 'tech_stacks/') ? $techStack->icon : '') }}" placeholder="fa-brands fa-html5">
                                    </div>

                                    <div class="mb-2">
                                        <label for="icon_file" class="form-label small">Option 2: Upload Custom SVG/PNG Image Logo</label>
                                        <input type="file" class="form-control" id="icon_file" name="icon_file">
                                        @if(Str::startsWith($techStack->icon, 'tech_stacks/'))
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $techStack->icon) }}" alt="{{ $techStack->name }}" class="img-thumbnail" style="max-height: 40px; max-width: 40px; object-fit: contain;">
                                                <span class="text-muted small ms-2">Current Logo</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $techStack->status ? 'checked' : '' }} style="width: 50px; height: 25px;">
                                    <label class="form-check-label ms-2 mt-1" for="status">Active (Show on Frontend)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Update Technology</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
