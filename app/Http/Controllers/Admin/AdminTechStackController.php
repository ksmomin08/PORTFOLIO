<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTechStackController extends Controller
{
    public function index()
    {
        $techStacks = TechStack::orderBy('sort_order')->orderBy('name')->paginate(15);
        return view('admin.tech-stack.index', compact('techStacks'));
    }

    public function create()
    {
        return view('admin.tech-stack.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Frontend,Backend,Database,Version Control,App',
            'icon' => 'nullable|string|max:255',
            'icon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('icon_file')) {
            $data['icon'] = $request->file('icon_file')->store('tech_stacks', 'public');
        }

        unset($data['icon_file']);

        TechStack::create($data);

        return redirect()->route('admin.tech-stack.index')->with('success', 'Technology added successfully.');
    }

    public function edit(TechStack $techStack)
    {
        return view('admin.tech-stack.edit', compact('techStack'));
    }

    public function update(Request $request, TechStack $techStack)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Frontend,Backend,Database,Version Control,App',
            'icon' => 'nullable|string|max:255',
            'icon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('icon_file')) {
            if ($techStack->icon && Storage::disk('public')->exists($techStack->icon)) {
                Storage::disk('public')->delete($techStack->icon);
            }
            $data['icon'] = $request->file('icon_file')->store('tech_stacks', 'public');
        }

        unset($data['icon_file']);

        $techStack->update($data);

        return redirect()->route('admin.tech-stack.index')->with('success', 'Technology updated successfully.');
    }

    public function destroy(TechStack $techStack)
    {
        if ($techStack->icon && Storage::disk('public')->exists($techStack->icon)) {
            Storage::disk('public')->delete($techStack->icon);
        }
        $techStack->delete();
        return redirect()->route('admin.tech-stack.index')->with('success', 'Technology deleted successfully.');
    }
}
