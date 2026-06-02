@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Customer Inquiries</h5>
                <a href="{{ route('admin.inquiries.export') }}" class="btn btn-success"><i class="fa-solid fa-file-csv me-1"></i> Export to CSV</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Service Type</th>
                                <th>Message</th>
                                <th>Submitted Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inquiries as $inquiry)
                                <tr>
                                    <td><strong>{{ $inquiry->name }}</strong></td>
                                    <td><a href="mailto:{{ $inquiry->email }}" class="text-decoration-none">{{ $inquiry->email }}</a></td>
                                    <td>{{ $inquiry->phone }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $inquiry->country_code ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $inquiry->service ?? 'General' }}</span>
                                    </td>
                                    <td>
                                        <!-- Trigger Modal for full message -->
                                        <span class="d-inline-block text-truncate" style="max-width: 200px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#inquiryModal{{ $inquiry->id }}" title="Click to view full message">
                                            {{ $inquiry->message }}
                                        </span>

                                        <!-- Inquiry Modal -->
                                        <div class="modal fade" id="inquiryModal{{ $inquiry->id }}" tabindex="-1" aria-labelledby="inquiryModalLabel{{ $inquiry->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title fw-bold text-primary" id="inquiryModalLabel{{ $inquiry->id }}">Inquiry Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="mb-3">
                                                            <strong>Client Name:</strong> <p class="text-muted m-0">{{ $inquiry->name }}</p>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <strong>Email:</strong> <p class="text-muted m-0">{{ $inquiry->email }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <strong>Phone:</strong> <p class="text-muted m-0">{{ $inquiry->phone }} ({{ $inquiry->country_code }})</p>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Requested Service:</strong> <p class="text-muted m-0">{{ $inquiry->service ?? 'General Inquiry' }}</p>
                                                        </div>
                                                        <hr>
                                                        <div class="mb-0">
                                                            <strong>Full Message:</strong>
                                                            <p class="text-muted bg-light p-3 rounded mt-2 border-start border-primary border-4" style="white-space: pre-wrap; font-size: 0.92rem;">{{ $inquiry->message }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light border-0">
                                                        @if($inquiry->status == 'unread')
                                                            <form action="{{ route('admin.inquiries.read', $inquiry->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check me-1"></i> Mark as Read</button>
                                                            </form>
                                                        @endif
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $inquiry->created_at ? $inquiry->created_at->format('M d, Y h:i A') : '-' }}</td>
                                    <td>
                                        @if($inquiry->status == 'unread')
                                            <span class="status-badge inactive">Unread</span>
                                        @else
                                            <span class="status-badge active">Read</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($inquiry->status == 'unread')
                                            <form action="{{ route('admin.inquiries.read', $inquiry->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success py-1 px-2 me-1" title="Mark as Read">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
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
                                    <td colspan="9" class="text-center py-4 text-muted">No inquiries received yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($inquiries->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $inquiries->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
