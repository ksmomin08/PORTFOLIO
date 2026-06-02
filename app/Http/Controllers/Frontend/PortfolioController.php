<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Service;
use App\Models\TechStack;
use App\Models\Project;
use App\Models\Product;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Inquiry;

class PortfolioController extends Controller
{
    /**
     * Public Home Page.
     */
    public function home()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $services = Service::where('status', true)->get();
        $techStacks = TechStack::where('status', true)->orderBy('sort_order')->get();
        $projects = Project::where('status', true)->latest()->get();
        $testimonials = Testimonial::where('status', true)->get();
        $latestBlogs = Blog::where('status', true)->latest()->limit(3)->get();
        $faqs = Faq::where('status', true)->orderBy('sort_order')->get();

        return view('frontend.home', compact(
            'settings',
            'services',
            'techStacks',
            'projects',
            'testimonials',
            'latestBlogs',
            'faqs'
        ));
    }

    /**
     * About Us Page.
     */
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $teamMembers = TeamMember::where('status', true)->orderBy('sort_order')->get();

        return view('frontend.about', compact('settings', 'teamMembers'));
    }

    /**
     * Services Listing Page.
     */
    public function services()
    {
        $services = Service::where('status', true)->latest()->get();
        return view('frontend.services', compact('services'));
    }

    /**
     * Projects Grid Page.
     */
    public function projects()
    {
        $projects = Project::where('status', true)->latest()->get();
        $categories = Project::where('status', true)->distinct()->pluck('category')->all();
        return view('frontend.projects', compact('projects', 'categories'));
    }

    /**
     * Products Grid Page.
     */
    public function products()
    {
        $products = Product::where('status', true)->latest()->get();
        return view('frontend.products', compact('products'));
    }

    /**
     * Blog Index Page.
     */
    public function blog()
    {
        $blogs = Blog::with('category')->where('status', true)->latest()->paginate(9);
        return view('frontend.blog', compact('blogs'));
    }

    /**
     * Single Blog Detail Page.
     */
    public function blogSingle($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->where('status', true)->firstOrFail();
        $relatedBlogs = Blog::where('status', true)->where('blog_category_id', $blog->blog_category_id)->where('id', '!=', $blog->id)->latest()->limit(3)->get();
        
        return view('frontend.blog-single', compact('blog', 'relatedBlogs'));
    }

    /**
     * Contact Us Page.
     */
    public function contact()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('frontend.contact', compact('settings'));
    }

    /**
     * Handle Inquiry form submission.
     */
    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'country_code' => 'nullable|string|max:10',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $data['status'] = 'unread';

        Inquiry::create($data);

        // Flash message for frontend toast
        return redirect()->back()->with('success', 'Your inquiry has been successfully sent! Our team will contact you shortly.');
    }

    /**
     * XML Sitemap dynamic response.
     */
    public function sitemap()
    {
        $blogs = Blog::where('status', true)->get();
        $projects = Project::where('status', true)->get();
        $services = Service::where('status', true)->get();

        $content = view('frontend.sitemap', compact('blogs', 'projects', 'services'))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    /**
     * robots.txt dynamic response.
     */
    public function robots()
    {
        $sitemapUrl = route('frontend.sitemap');
        
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /vendor/\n";
        $content .= "\n";
        $content .= "Sitemap: " . $sitemapUrl . "\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
