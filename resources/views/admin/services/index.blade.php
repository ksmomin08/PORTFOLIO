@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage Services</h5>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Service</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td><i class="{{ $service->icon_class ?? 'fa-solid fa-server' }} fa-lg text-primary"></i></td>
                                    <td><strong>{{ $service->title }}</strong></td>
                                    <td>{{ Str::limit($service->short_description, 70) }}</td>
                                    <td>
                                        @if($service->status)
                                            <span class="status-badge active">Active</span>
                                        @else
                                            <span class="status-badge inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                                    <td colspan="5" class="text-center py-4 text-muted">No services found. Click "Add Service" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($services->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
