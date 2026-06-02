<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Secure Admin
        Admin::updateOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'status' => true,
            ]
        );

        // 2. Seed Navigation Menus
        $menus = [
            ['label' => 'Home', 'route_name' => 'frontend.home', 'sort_order' => 1],
            ['label' => 'About Us', 'route_name' => 'frontend.about', 'sort_order' => 2],
            ['label' => 'Services', 'route_name' => 'frontend.services', 'sort_order' => 3],
            ['label' => 'Portfolio', 'route_name' => 'frontend.projects', 'sort_order' => 4],
            ['label' => 'Products', 'route_name' => 'frontend.products', 'sort_order' => 5],
            ['label' => 'Blog', 'route_name' => 'frontend.blog', 'sort_order' => 6],
            ['label' => 'Contact Us', 'route_name' => 'frontend.contact', 'sort_order' => 7],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['route_name' => $menu['route_name']],
                [
                    'label' => $menu['label'],
                    'is_enabled' => true,
                    'sort_order' => $menu['sort_order'],
                ]
            );
        }

        // 3. Seed General Settings
        $settings = [
            // General
            'site_name' => 'Narjis Infotech',
            'site_tagline' => 'Premium IT Solutions & Digital Services',
            'site_logo' => null,
            'site_favicon' => null,
            'phone_1' => '+91 98765 43210',
            'phone_2' => '+91 98765 01234',
            'email' => 'info@narjisinfotech.com',
            'address' => '123, Dynamic IT Plaza, Software Park, Sector 5, India',
            'map_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.120537446584!2d72.5713621!3d23.022505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDAxJzIxLjAiTiA3MsKwMzQnMTYuOSJFOg!5e0!3m2!1sen!2sin!4v1622548900000!5m2!1sen!2sin',
            'social_facebook' => 'https://facebook.com',
            'social_instagram' => 'https://instagram.com',
            'social_linkedin' => 'https://linkedin.com',
            'social_twitter' => 'https://twitter.com',
            'whatsapp_number' => '919876543210',
            'footer_copyright' => '© 2026 Narjis Infotech. All rights reserved.',
            'primary_color' => '#0d6efd',
            'google_analytics' => '',
            'cookie_consent_text' => 'We use cookies to ensure you get the best experience on our website. By continuing to browse, you agree to our cookie policy.',
            
            // SEO
            'meta_title' => 'Narjis Infotech - Professional Web Development & Mobile App Agency',
            'meta_description' => 'We build premium web solutions, custom mobile applications, and innovative software designs tailored to accelerate your business growth.',
            
            // Hero
            'hero_title' => 'Empowering Brands with Premium Digital Solutions',
            'hero_subtitle' => 'We design, build, and deliver cutting-edge websites, robust mobile applications, and high-performance custom software.',
            'hero_tagline' => 'INNOVATION • EXCELLENCE • SUCCESS',
            'hero_bg' => null,
            'stat_years' => '10+',
            'stat_projects' => '250+',
            'stat_clients' => '180+',
            'stat_team' => '25+',
            
            // About Us
            'about_text' => 'At Narjis Infotech, we are committed to driving digital transformation. With a dedicated team of designers, developers, and strategists, we create state-of-the-art web products and custom mobile solutions that elevate your brand and maximize efficiency.',
            'about_mission' => 'To provide top-tier, reliable, and scalable technology solutions that empower businesses worldwide to excel in their industries.',
            'about_vision' => 'To be a globally recognized leader in digital innovation, renowned for our visual excellence, premium product standards, and client-centric approach.',
            'about_image' => null,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
