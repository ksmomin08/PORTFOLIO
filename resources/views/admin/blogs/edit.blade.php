@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Edit Blog Post: {{ $blog->title }}</h5>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Left Column: Content -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Post Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $blog->title) }}" placeholder="e.g. 5 Design Trends to Watch in 2026" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content_editor" class="form-label fw-bold">Article Content</label>
                                <textarea class="form-control" id="content_editor" name="content" rows="15">{{ old('content', $blog->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Side Right Column: Meta & Details -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="blog_category_id" class="form-label fw-bold">Category</label>
                                <select class="form-select @error('blog_category_id') is-invalid @enderror" id="blog_category_id" name="blog_category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('blog_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label fw-bold">Thumbnail Image</label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">
                                <div class="form-text small text-muted">Leave blank if you don't want to change the image. Max size 3MB.</div>
                                @if($blog->thumbnail)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-thumbnail" style="max-height: 80px; max-width: 120px; object-fit: cover;">
                                        <span class="text-muted small ms-2">Current Thumbnail</span>
                                    </div>
                                @endif
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="published_date" class="form-label fw-bold">Published Date</label>
                                <input type="date" class="form-control @error('published_date') is-invalid @enderror" id="published_date" name="published_date" value="{{ old('published_date', $blog->published_date ? $blog->published_date->format('Y-m-d') : date('Y-m-d')) }}">
                                @error('published_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tags" class="form-label fw-bold">Tags (comma separated)</label>
                                <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', $blog->tags) }}" placeholder="Web, Design, PHP">
                            </div>

                            <div class="card bg-light border-0 mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3"><i class="fa-solid fa-search text-primary me-2"></i> SEO Parameters</h6>
                                    
                                    <div class="mb-2">
                                        <label for="meta_title" class="form-label small">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" placeholder="Custom browser tab title">
                                    </div>

                                    <div class="mb-2">
                                        <label for="meta_description" class="form-label small">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Summary for search engines...">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $blog->status ? 'checked' : '' }} style="width: 50px; height: 25px;">
                                    <label class="form-check-label ms-2 mt-1" for="status">Published (Show on Frontend)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- TinyMCE Rich Text Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content_editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 500,
        branding: false,
        promotion: false
    });
</script>
@endsection
