@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage Testimonials</h5>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Testimonial</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Client Name</th>
                                <th>Company</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonials as $testimonial)
                                <tr>
                                    <td>
                                        @if($testimonial->profile_photo)
                                            <img src="{{ asset('storage/' . $testimonial->profile_photo) }}" alt="{{ $testimonial->client_name }}" class="rounded-circle" style="height: 40px; width: 40px; object-fit: cover;">
                                        @else
                                            <i class="fa-solid fa-circle-user fa-2x text-muted"></i>
                                        @endif
                                    </td>
                                    <td><strong>{{ $testimonial->client_name }}</strong></td>
                                    <td>{{ $testimonial->company ?? '-' }}</td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.75rem;"></i>
                                        @endfor
                                    </td>
                                    <td>{{ Str::limit($testimonial->review_text, 60) }}</td>
                                    <td>
                                        @if($testimonial->status)
                                            <span class="status-badge active">Active</span>
                                        @else
                                            <span class="status-badge inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this client review?');">
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
                                    <td colspan="7" class="text-center py-4 text-muted">No testimonials found. Click "Add Testimonial" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($testimonials->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
