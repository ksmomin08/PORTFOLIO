@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage Blog Categories</h5>
                <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Category</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td><code>{{ $category->slug }}</code></td>
                                    <td>
                                        <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.blog-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category? All posts in it will be unassigned.');">
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
                                    <td colspan="3" class="text-center py-4 text-muted">No categories found. Click "Add Category" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($categories->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
