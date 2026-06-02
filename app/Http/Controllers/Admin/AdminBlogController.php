<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'content' => 'nullable|string',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'status' => 'boolean',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'content' => 'nullable|string',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'status' => 'boolean',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status');

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
