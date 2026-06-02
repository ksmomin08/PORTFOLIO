<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PortfolioController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminTechStackController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminBlogCategoryController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminInquiryController;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::name('frontend.')->group(function () {
    Route::get('/', [PortfolioController::class, 'home'])->name('home');
    Route::get('/about-us', [PortfolioController::class, 'about'])->name('about');
    Route::get('/services', [PortfolioController::class, 'services'])->name('services');
    Route::get('/portfolio', [PortfolioController::class, 'projects'])->name('projects');
    Route::get('/products', [PortfolioController::class, 'products'])->name('products');
    Route::get('/blog', [PortfolioController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [PortfolioController::class, 'blogSingle'])->name('blog.single');
    Route::get('/contact-us', [PortfolioController::class, 'contact'])->name('contact');
    Route::post('/contact-submit', [PortfolioController::class, 'contactSubmit'])->name('contact.submit');
    
    // SEO Dynamic Routes
    Route::get('/sitemap.xml', [PortfolioController::class, 'sitemap'])->name('sitemap');
    Route::get('/robots.txt', [PortfolioController::class, 'robots'])->name('robots');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Secure Admin Panel Group
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index']);
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Settings, Hero, and About Us
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
        Route::get('/settings/hero', [AdminSettingsController::class, 'hero'])->name('hero');
        Route::post('/settings/hero', [AdminSettingsController::class, 'heroUpdate'])->name('hero.update');
        Route::get('/settings/about', [AdminSettingsController::class, 'about'])->name('about');
        Route::post('/settings/about', [AdminSettingsController::class, 'aboutUpdate'])->name('about.update');

        // Resources CRUD
        Route::resource('services', AdminServiceController::class)->except(['show']);
        Route::resource('tech-stack', AdminTechStackController::class)->except(['show']);
        Route::resource('projects', AdminProjectController::class)->except(['show']);
        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::resource('team', AdminTeamController::class)->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('blog-categories', AdminBlogCategoryController::class)->except(['show']);
        Route::resource('blogs', AdminBlogController::class)->except(['show']);
        Route::resource('faqs', AdminFaqController::class)->except(['show']);

        // Inquiries management
        Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::post('/inquiries/{inquiry}/read', [AdminInquiryController::class, 'markRead'])->name('inquiries.read');
        Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');
        Route::get('/inquiries/export', [AdminInquiryController::class, 'export'])->name('inquiries.export');

        // Navigation menu customization
        Route::get('/menus', [AdminMenuController::class, 'index'])->name('menus.index');
        Route::post('/menus/update', [AdminMenuController::class, 'update'])->name('menus.update');
    });
});
