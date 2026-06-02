@extends('layouts.admin')

@section('content')
<div class="row">
    <!-- Services Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2" style="border-left: 4px solid var(--primary-accent) !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px; color: var(--primary-accent);">Services Offered</div>
                        <div class="h5 mb-0 font-weight-bold text-white" style="font-size: 1.8rem; font-weight: 700;">{{ $servicesCount }}</div>
                    </div>
                    <div class="col-auto text-primary opacity-50">
                        <i class="ri-server-line fa-2x" style="color: var(--primary-accent);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2" style="border-left: 4px solid var(--secondary-accent) !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px; color: var(--secondary-accent);">Portfolio Projects</div>
                        <div class="h5 mb-0 font-weight-bold text-white" style="font-size: 1.8rem; font-weight: 700;">{{ $projectsCount }}</div>
                    </div>
                    <div class="col-auto text-success opacity-50">
                        <i class="ri-gallery-line fa-2x" style="color: var(--secondary-accent);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blogs Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2" style="border-left: 4px solid #ffc107 !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Blog Articles</div>
                        <div class="h5 mb-0 font-weight-bold text-white" style="font-size: 1.8rem; font-weight: 700;">{{ $blogsCount }}</div>
                    </div>
                    <div class="col-auto text-warning opacity-50">
                        <i class="ri-book-read-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inquiries Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2" style="border-left: 4px solid #dc3545 !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Contact Inquiries</div>
                        <div class="h5 mb-0 font-weight-bold text-white" style="font-size: 1.8rem; font-weight: 700;">{{ $inquiriesCount }}</div>
                    </div>
                    <div class="col-auto text-danger opacity-50">
                        <i class="ri-mail-send-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Recent Inquiries Table -->
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-white font-weight-600">Recent Customer Inquiries</h5>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-primary">View All Inquiries</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Service Needed</th>
                                <th>Submitted Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInquiries as $inquiry)
                                <tr>
                                    <td class="text-white"><strong>{{ $inquiry->name }}</strong></td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td>{{ $inquiry->phone }}</td>
                                    <td>
                                        <span class="badge bg-secondary" style="font-family: 'JetBrains Mono', monospace; font-size: 0.7rem;">{{ $inquiry->service ?? 'General Inquiry' }}</span>
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
                                                <button type="submit" class="btn btn-sm btn-outline-success py-1 px-2" title="Mark as Read">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No inquiries received yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
