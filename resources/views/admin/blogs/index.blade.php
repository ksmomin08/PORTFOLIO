@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage Blog Posts</h5>
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Create Post</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Published Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $blog)
                                <tr>
                                    <td>
                                        @if($blog->thumbnail)
                                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-thumbnail" style="max-height: 40px; max-width: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted small">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $blog->title }}</strong>
                                        <div class="small text-muted">/blog/{{ $blog->slug }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $blog->category->name ?? 'Unassigned' }}</span>
                                    </td>
                                    <td>{{ $blog->published_date ? $blog->published_date->format('M d, Y') : '-' }}</td>
                                    <td>
                                        @if($blog->status)
                                            <span class="status-badge active">Published</span>
                                        @else
                                            <span class="status-badge inactive">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No blog posts found. Click "Create Post" to write one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($blogs->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
