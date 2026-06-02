@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Edit Service: {{ $service->title }}</h5>
                <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Service Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title) }}" placeholder="e.g. Web Development" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="short_description" class="form-label fw-bold">Short Description (for Home Page cards)</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="A brief summary of this service..." required>{{ old('short_description', $service->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="full_description" class="form-label fw-bold">Full Detailed Description (for Services detail page)</label>
                                <textarea class="form-control @error('full_description') is-invalid @enderror" id="full_description" name="full_description" rows="6" placeholder="A full comprehensive description of the service and our methodology..." required>{{ old('full_description', $service->full_description) }}</textarea>
                                @error('full_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="icon_class" class="form-label fw-bold">FontAwesome Icon Class</label>
                                <input type="text" class="form-control @error('icon_class') is-invalid @enderror" id="icon_class" name="icon_class" value="{{ old('icon_class', $service->icon_class) }}" placeholder="e.g. fa-solid fa-server" required>
                                <div class="form-text small text-muted">Use any class from FontAwesome 6 (e.g. <code>fa-solid fa-code</code>, <code>fa-solid fa-mobile-screen-button</code>).</div>
                                @error('icon_class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $service->status ? 'checked' : '' }} style="width: 50px; height: 25px;">
                                    <label class="form-check-label ms-2 mt-1" for="status">Active (Show on Frontend)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
