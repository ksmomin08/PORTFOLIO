<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:100',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status');

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:100',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status');

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
