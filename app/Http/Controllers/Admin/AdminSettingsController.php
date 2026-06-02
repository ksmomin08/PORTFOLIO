<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    /**
     * Display general settings.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'phone_1' => 'nullable|string|max:50',
            'phone_2' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
            'map_link' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
            'footer_copyright' => 'nullable|string',
            'footer_attribution' => 'nullable|string|max:255',
            'footer_logo_text' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:7',
            'google_analytics' => 'nullable|string',
            'cookie_consent_text' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'site_favicon' => 'nullable|image|mimes:png,ico|max:10240',
        ]);

        // Explicitly parse and handle all boolean layout switches
        $switches = [
            'footer_show_logo',
            'footer_show_tagline',
            'footer_show_socials',
            'footer_show_company',
            'footer_show_solutions',
            'footer_show_address',
            'footer_show_phone',
            'footer_show_email',
        ];
        foreach ($switches as $sw) {
            $data[$sw] = $request->has($sw) ? 1 : 0;
        }

        // Upload Logo if exists
        if ($request->hasFile('site_logo')) {
            // Delete old if exists
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $logoPath);
        }

        // Upload Favicon if exists
        if ($request->hasFile('site_favicon')) {
            // Delete old if exists
            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $faviconPath);
        }

        // Prevent file inputs from overwriting with null if no new file is selected
        unset($data['site_logo'], $data['site_favicon']);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings')->with('success', 'General settings updated successfully.');
    }

    /**
     * Display hero settings.
     */
    public function hero()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.hero', compact('settings'));
    }

    /**
     * Update hero settings.
     */
    public function heroUpdate(Request $request)
    {
        $data = $request->validate([
            'hero_title' => 'required|string',
            'hero_subtitle' => 'nullable|string',
            'hero_tagline' => 'nullable|string',
            'hero_typewriter_words' => 'nullable|string',
            'hero_badge_1_text' => 'nullable|string|max:255',
            'hero_badge_1_icon' => 'nullable|string|max:255',
            'hero_badge_2_text' => 'nullable|string|max:255',
            'hero_badge_2_icon' => 'nullable|string|max:255',
            'hero_badge_3_text' => 'nullable|string|max:255',
            'hero_badge_3_icon' => 'nullable|string|max:255',
            'stat_years' => 'nullable|string',
            'stat_projects' => 'nullable|string',
            'stat_clients' => 'nullable|string',
            'stat_team' => 'nullable|string',
            'hero_cta_1_text' => 'nullable|string|max:255',
            'hero_cta_1_link' => 'nullable|string|max:255',
            'hero_cta_2_text' => 'nullable|string|max:255',
            'hero_cta_2_link' => 'nullable|string|max:255',
            'hero_marquee_text' => 'nullable|string',
            'hero_bg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'satellites' => 'nullable|array',
            'satellites.*.name' => 'required|string|max:100',
            'satellites.*.icon' => 'required|string|max:100',
            'satellites.*.duration' => 'nullable|integer|min:5|max:120',
        ]);

        // Save satellites as serialized JSON string
        if ($request->has('satellites')) {
            Setting::set('hero_satellites', json_encode($request->satellites));
        } else {
            Setting::set('hero_satellites', json_encode([]));
        }
        unset($data['satellites']);

        // Handle boolean configuration switches for hero visibility layout
        $switches = [
            'hero_show_badges',
            'hero_show_typewriter',
        ];
        foreach ($switches as $sw) {
            $data[$sw] = $request->has($sw) ? 1 : 0;
        }

        if ($request->hasFile('hero_bg')) {
            $oldBg = Setting::get('hero_bg');
            if ($oldBg) {
                Storage::disk('public')->delete($oldBg);
            }
            $bgPath = $request->file('hero_bg')->store('settings', 'public');
            Setting::set('hero_bg', $bgPath);
        }

        // Prevent file input from overwriting with null if no new file is selected
        unset($data['hero_bg']);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.hero')->with('success', 'Hero Section stats and content updated.');
    }

    /**
     * Display about us settings.
     */
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.about', compact('settings'));
    }

    /**
     * Update about us settings.
     */
    public function aboutUpdate(Request $request)
    {
        $data = $request->validate([
            'about_text' => 'required|string',
            'about_mission' => 'nullable|string',
            'about_vision' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('about_image')) {
            $oldImg = Setting::get('about_image');
            if ($oldImg) {
                Storage::disk('public')->delete($oldImg);
            }
            $imgPath = $request->file('about_image')->store('settings', 'public');
            Setting::set('about_image', $imgPath);
        }

        // Prevent file input from overwriting with null if no new file is selected
        unset($data['about_image']);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.about')->with('success', 'About Us text, mission, and vision updated.');
    }
}
