@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Edit Blog Category</h5>
                <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-categories.update', $blogCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $blogCategory->name) }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-floppy-disk me-2"></i> Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
