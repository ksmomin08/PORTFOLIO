@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Edit Team Member: {{ $teamMember->name }}</h5>
                <a href="{{ route('admin.team.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.team.update', $teamMember->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $teamMember->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label fw-bold">Designation</label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $teamMember->designation) }}" required>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sort_order" class="form-label fw-bold">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $teamMember->sort_order) }}" required>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="photo" class="form-label fw-bold">Profile Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                                <div class="form-text small text-muted">Leave blank if you don't want to change the image. Max size 2MB.</div>
                                @if($teamMember->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $teamMember->photo) }}" alt="{{ $teamMember->name }}" class="rounded-circle" style="height: 60px; width: 60px; object-fit: cover;">
                                        <span class="text-muted small ms-2">Current Photo</span>
                                    </div>
                                @endif
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="linkedin" class="form-label fw-bold">LinkedIn Profile URL</label>
                                <input type="url" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin" value="{{ old('linkedin', $teamMember->linkedin) }}" placeholder="https://linkedin.com/in/username">
                                @error('linkedin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $teamMember->status ? 'checked' : '' }} style="width: 50px; height: 25px;">
                                    <label class="form-check-label ms-2 mt-1" for="status">Active (Show on Frontend)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Update Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
