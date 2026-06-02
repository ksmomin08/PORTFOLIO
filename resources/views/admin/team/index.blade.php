@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage Team Members</h5>
                <a href="{{ route('admin.team.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Team Member</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>LinkedIn</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teamMembers as $member)
                                <tr>
                                    <td>
                                        @if($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="rounded-circle" style="height: 40px; width: 40px; object-fit: cover;">
                                        @else
                                            <i class="fa-solid fa-user-tie fa-2x text-muted"></i>
                                        @endif
                                    </td>
                                    <td><strong>{{ $member->name }}</strong></td>
                                    <td>{{ $member->designation }}</td>
                                    <td>
                                        @if($member->linkedin)
                                            <a href="{{ $member->linkedin }}" target="_blank" class="text-info"><i class="fa-brands fa-linkedin fa-lg"></i></a>
                                        @else
                                            <span class="text-muted small">None</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->sort_order }}</td>
                                    <td>
                                        @if($member->status)
                                            <span class="status-badge active">Active</span>
                                        @else
                                            <span class="status-badge inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this team member?');">
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
                                    <td colspan="7" class="text-center py-4 text-muted">No team members found. Click "Add Team Member" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($teamMembers->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $teamMembers->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
