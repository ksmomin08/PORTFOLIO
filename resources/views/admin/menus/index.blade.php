@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 text-primary">Manage Menu / Navigation Items</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small">Enable or disable routes on the public header and configure custom navigation labels and ordering.</p>
                
                <form action="{{ route('admin.menus.update') }}" method="POST">
                    @csrf
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 80px;" class="text-center">Visible</th>
                                    <th>Menu Route / Name</th>
                                    <th>Custom Label</th>
                                    <th style="width: 120px;">Sort Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $index => $menu)
                                    <tr>
                                        <!-- Hidden ID -->
                                        <input type="hidden" name="menu[{{ $index }}][id]" value="{{ $menu->id }}">
                                        
                                        <!-- Visibility Toggle -->
                                        <td class="text-center">
                                            <input class="form-check-input border-secondary" type="checkbox" name="enabled_menus[]" value="{{ $menu->id }}" {{ $menu->is_enabled ? 'checked' : '' }} style="width: 20px; height: 20px;">
                                        </td>
                                        
                                        <!-- Route -->
                                        <td>
                                            <strong>{{ ucfirst(explode('.', $menu->route_name)[1] ?? $menu->route_name) }}</strong>
                                            <div class="text-muted small font-monospace" style="font-size: 0.75rem;">route('{{ $menu->route_name }}')</div>
                                        </td>
                                        
                                        <!-- Label -->
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="menu[{{ $index }}][label]" value="{{ $menu->label }}" required>
                                        </td>
                                        
                                        <!-- Sort Order -->
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="menu[{{ $index }}][sort_order]" value="{{ $menu->sort_order }}" required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-floppy-disk me-2"></i> Save Menu Configuration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
