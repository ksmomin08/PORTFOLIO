<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Project;
use App\Models\Blog;
use App\Models\Inquiry;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index()
    {
        $servicesCount = Service::count();
        $projectsCount = Project::count();
        $blogsCount = Blog::count();
        $inquiriesCount = Inquiry::count();
        
        $recentInquiries = Inquiry::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'servicesCount',
            'projectsCount',
            'blogsCount',
            'inquiriesCount',
            'recentInquiries'
        ));
    }
}
