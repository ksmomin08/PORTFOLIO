@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage Tech Stack & Skills</h5>
                <a href="{{ route('admin.tech-stack.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Technology</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($techStacks as $tech)
                                <tr>
                                    <td>
                                        @if(Str::startsWith($tech->icon, 'tech_stacks/'))
                                            <img src="{{ asset('storage/' . $tech->icon) }}" alt="{{ $tech->name }}" style="max-height: 32px; max-width: 32px; object-fit: contain;">
                                        @else
                                            <i class="{{ $tech->icon ?? 'fa-solid fa-microchip' }} fa-lg text-primary"></i>
                                        @endif
                                    </td>
                                    <td><strong>{{ $tech->name }}</strong></td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $tech->category }}</span>
                                    </td>
                                    <td>{{ $tech->sort_order }}</td>
                                    <td>
                                        @if($tech->status)
                                            <span class="status-badge active">Active</span>
                                        @else
                                            <span class="status-badge inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tech-stack.edit', $tech->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.tech-stack.destroy', $tech->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this technology?');">
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
                                    <td colspan="6" class="text-center py-4 text-muted">No technologies found. Click "Add Technology" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($techStacks->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $techStacks->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
