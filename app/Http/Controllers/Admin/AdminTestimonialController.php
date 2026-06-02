<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'review_text' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'boolean',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'review_text' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'boolean',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('profile_photo')) {
            if ($testimonial->profile_photo && Storage::disk('public')->exists($testimonial->profile_photo)) {
                Storage::disk('public')->delete($testimonial->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->profile_photo && Storage::disk('public')->exists($testimonial->profile_photo)) {
            Storage::disk('public')->delete($testimonial->profile_photo);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
