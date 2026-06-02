<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->paginate(10);
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:blog_categories,name|max:255',
        ]);

        $data['slug'] = Str::slug($request->name);

        BlogCategory::create($data);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog Category created successfully.');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blogCategory->id,
        ]);

        $data['slug'] = Str::slug($request->name);

        $blogCategory->update($data);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog Category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog Category deleted successfully.');
    }
}
