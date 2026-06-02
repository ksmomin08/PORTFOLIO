@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage Projects / Portfolio</h5>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Project</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Project URL</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td>
                                        @if($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-height: 48px; max-width: 70px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $project->title }}</strong></td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $project->category }}</span>
                                    </td>
                                    <td>
                                        @if($project->project_url)
                                            <a href="{{ $project->project_url }}" target="_blank" class="small text-decoration-none"><i class="fa-solid fa-arrow-up-right-from-square"></i> Live Link</a>
                                        @else
                                            <span class="text-muted small">None</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($project->status)
                                            <span class="status-badge active">Active</span>
                                        @else
                                            <span class="status-badge inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
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
                                    <td colspan="6" class="text-center py-4 text-muted">No projects found. Click "Add Project" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($projects->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
