@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Create FAQ</h5>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="question" class="form-label fw-bold">FAQ Question</label>
                        <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}" placeholder="e.g. What technologies do you use?" required>
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label fw-bold">FAQ Answer</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="5" placeholder="Detail the answer fully here..." required>{{ old('answer') }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="sort_order" class="form-label fw-bold">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" required>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-4">
                            <label class="form-label fw-bold d-block">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked style="width: 50px; height: 25px;">
                                <label class="form-check-label ms-2 mt-1" for="status">Active (Show on Frontend)</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-floppy-disk me-2"></i> Save FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
