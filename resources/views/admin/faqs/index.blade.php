@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-primary">Manage FAQs</h5>
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add FAQ</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faqs as $faq)
                                <tr>
                                    <td><strong>{{ Str::limit($faq->question, 50) }}</strong></td>
                                    <td>{{ Str::limit($faq->answer, 60) }}</td>
                                    <td>{{ $faq->sort_order }}</td>
                                    <td>
                                        @if($faq->status)
                                            <span class="status-badge active">Active</span>
                                        @else
                                            <span class="status-badge inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 me-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
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
                                    <td colspan="5" class="text-center py-4 text-muted">No FAQs found. Click "Add FAQ" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($faqs->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $faqs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
