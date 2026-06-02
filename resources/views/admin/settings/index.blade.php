@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 text-primary">Manage General Settings</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <!-- Left Navigation Sidebar -->
                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <div class="nav flex-column nav-pills gap-2 p-2 rounded-4" id="settingsTabs" role="tablist" style="background-color: rgba(255,255,255,0.01); border: 1px solid var(--border-glow);">
                                <button class="nav-link active text-start py-3 px-3" id="branding-tab" data-bs-toggle="tab" data-bs-target="#branding" type="button" role="tab" aria-controls="branding" aria-selected="true">
                                    <i class="fa-solid fa-wand-magic-sparkles me-2"></i> Branding & Accent
                                </button>
                                <button class="nav-link text-start py-3 px-3" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    <i class="fa-solid fa-address-book me-2"></i> Contact Details
                                </button>
                                <button class="nav-link text-start py-3 px-3" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer" type="button" role="tab" aria-controls="footer" aria-selected="false">
                                    <i class="fa-solid fa-window-restore me-2"></i> Footer Config
                                </button>
                                <button class="nav-link text-start py-3 px-3" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i> SEO Parameters
                                </button>
                                <button class="nav-link text-start py-3 px-3" id="widgets-tab" data-bs-toggle="tab" data-bs-target="#widgets" type="button" role="tab" aria-controls="widgets" aria-selected="false">
                                    <i class="fa-solid fa-cubes me-2"></i> Widgets & Scripts
                                </button>
                                <button class="nav-link text-start py-3 px-3" id="socials-tab" data-bs-toggle="tab" data-bs-target="#socials" type="button" role="tab" aria-controls="socials" aria-selected="false">
                                    <i class="fa-solid fa-share-nodes me-2"></i> Social Channels
                                </button>
                            </div>
                        </div>

                        <!-- Right Panel Contents -->
                        <div class="col-lg-9">
                            <div class="card bg-black bg-opacity-20 border-0 rounded-4 shadow-none m-0">
                                <div class="card-body p-4">
                                    <div class="tab-content" id="settingsTabsContent">
                                        <!-- 1. Branding & Accent -->
                                        <div class="tab-pane fade show active tab-content-container" id="branding" role="tabpanel" aria-labelledby="branding-tab">
                                            <h6 class="text-uppercase text-muted fw-bold mb-4 small" style="letter-spacing: 0.5px;">Branding & Accent Color</h6>
                                            
                                            <div class="mb-3">
                                                <label for="site_name" class="form-label">Site Name</label>
                                                <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? '' }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="site_tagline" class="form-label">Site Tagline</label>
                                                <input type="text" class="form-control" id="site_tagline" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}">
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <label for="site_logo" class="form-label">Upload Site Logo</label>
                                                    <input type="file" class="form-control" id="site_logo" name="site_logo">
                                                    @if(isset($settings['site_logo']))
                                                        <div class="mt-2 p-2 border border-secondary border-opacity-10 rounded d-inline-block" style="background-color: rgba(255,255,255,0.01);">
                                                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="img-thumbnail" style="max-height: 40px; background: transparent; border: none;">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <label for="site_favicon" class="form-label">Favicon (.ico/.png)</label>
                                                    <input type="file" class="form-control" id="site_favicon" name="site_favicon">
                                                    @if(isset($settings['site_favicon']))
                                                        <div class="mt-2 p-2 border border-secondary border-opacity-10 rounded d-inline-block" style="background-color: rgba(255,255,255,0.01);">
                                                            <img src="{{ asset('storage/' . $settings['site_favicon']) }}" alt="Favicon" class="img-thumbnail" style="max-height: 25px; background: transparent; border: none;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="primary_color" class="form-label">Theme Accent / Primary Color</label>
                                                <div class="d-flex align-items-center gap-3">
                                                    <input type="color" class="form-control form-control-color border-0" id="primary_color" name="primary_color" value="{{ $settings['primary_color'] ?? '#0d6efd' }}" title="Choose primary theme color" style="width: 60px; height: 42px; border-radius: 8px; cursor: pointer;">
                                                    <input type="text" class="form-control font-monospace" id="primary_color_text" value="{{ $settings['primary_color'] ?? '#0d6efd' }}" readonly style="max-width: 120px;">
                                                </div>
                                                <div class="form-text small text-muted">All active links, custom buttons, and dynamic highlights on both the user and admin side will immediately shift to this accent!</div>
                                            </div>
                                        </div>

                                        <!-- 2. Contact Info -->
                                        <div class="tab-pane fade tab-content-container" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <h6 class="text-uppercase text-muted fw-bold mb-4 small" style="letter-spacing: 0.5px;">Contact Information</h6>
                                            
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <label for="phone_1" class="form-label">Primary Phone Number</label>
                                                    <input type="text" class="form-control" id="phone_1" name="phone_1" value="{{ $settings['phone_1'] ?? '' }}">
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <label for="phone_2" class="form-label">Alternative Phone</label>
                                                    <input type="text" class="form-control" id="phone_2" name="phone_2" value="{{ $settings['phone_2'] ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <label for="email" class="form-label">Official Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $settings['email'] ?? '' }}">
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <label for="whatsapp_number" class="form-label">WhatsApp Number (e.g. 919876543210)</label>
                                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="address" class="form-label">Office Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="map_link" class="form-label">Google Maps Embed Link (iframe src url)</label>
                                                <input type="text" class="form-control" id="map_link" name="map_link" value="{{ $settings['map_link'] ?? '' }}">
                                            </div>
                                        </div>

                                         <!-- 3. Footer Config -->
                                         <div class="tab-pane fade tab-content-container" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                                             <h6 class="text-uppercase text-muted fw-bold mb-4 small" style="letter-spacing: 0.5px;">Footer Layout Configurations</h6>
                                             
                                             <div class="row">
                                                 <div class="col-md-6 mb-3">
                                                     <label for="footer_logo_text" class="form-label">Footer Logo Text (Text Fallback)</label>
                                                     <input type="text" class="form-control" id="footer_logo_text" name="footer_logo_text" value="{{ $settings['footer_logo_text'] ?? 'NARJIS INFOTECH' }}">
                                                 </div>
                                                 <div class="col-md-6 mb-3">
                                                     <label for="footer_copyright" class="form-label">Footer Copyright text</label>
                                                     <input type="text" class="form-control" id="footer_copyright" name="footer_copyright" value="{{ $settings['footer_copyright'] ?? '' }}">
                                                 </div>
                                             </div>

                                             <div class="mb-4">
                                                 <label for="footer_attribution" class="form-label">Footer Attribution Text</label>
                                                 <input type="text" class="form-control" id="footer_attribution" name="footer_attribution" value="{{ $settings['footer_attribution'] ?? 'Made with ❤️ in Surat' }}">
                                             </div>

                                             <hr class="border-secondary border-opacity-10 my-4">

                                             <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 0.5px;">Footer Element Visibility (On / Off Switches)</h6>
                                             
                                             <div class="row g-3">
                                                 <!-- Logo & Branding Block Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_logo" name="footer_show_logo" value="1" {{ ($settings['footer_show_logo'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_logo" style="cursor: pointer;">Show Logo Branding</label>
                                                     </div>
                                                 </div>

                                                 <!-- Tagline Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_tagline" name="footer_show_tagline" value="1" {{ ($settings['footer_show_tagline'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_tagline" style="cursor: pointer;">Show Site Tagline</label>
                                                     </div>
                                                 </div>

                                                 <!-- Social Media Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_socials" name="footer_show_socials" value="1" {{ ($settings['footer_show_socials'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_socials" style="cursor: pointer;">Show Social Links</label>
                                                     </div>
                                                 </div>

                                                 <!-- Company Links Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_company" name="footer_show_company" value="1" {{ ($settings['footer_show_company'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_company" style="cursor: pointer;">Show Company Links</label>
                                                     </div>
                                                 </div>

                                                 <!-- Solutions Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_solutions" name="footer_show_solutions" value="1" {{ ($settings['footer_show_solutions'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_solutions" style="cursor: pointer;">Show Solutions Links</label>
                                                     </div>
                                                 </div>

                                                 <!-- Address Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_address" name="footer_show_address" value="1" {{ ($settings['footer_show_address'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_address" style="cursor: pointer;">Show HQ Address</label>
                                                     </div>
                                                 </div>

                                                 <!-- Phone Number Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_phone" name="footer_show_phone" value="1" {{ ($settings['footer_show_phone'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_phone" style="cursor: pointer;">Show Phone Numbers</label>
                                                     </div>
                                                 </div>

                                                 <!-- Email Switch -->
                                                 <div class="col-sm-6 col-md-4">
                                                     <div class="form-check form-switch p-3 rounded-3" style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-glow);">
                                                         <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="footer_show_email" name="footer_show_email" value="1" {{ ($settings['footer_show_email'] ?? 1) ? 'checked' : '' }} style="cursor: pointer;">
                                                         <label class="form-check-label text-white small" for="footer_show_email" style="cursor: pointer;">Show Contact Email</label>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>

                                        <!-- 4. SEO Parameters -->
                                        <div class="tab-pane fade tab-content-container" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                            <h6 class="text-uppercase text-muted fw-bold mb-4 small" style="letter-spacing: 0.5px;">Search Engine Optimization (SEO)</h6>
                                            
                                            <div class="mb-3">
                                                <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $settings['meta_title'] ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                                                <textarea class="form-control" id="meta_description" name="meta_description" rows="4">{{ $settings['meta_description'] ?? '' }}</textarea>
                                            </div>
                                        </div>

                                        <!-- 5. Integration Code & Widgets -->
                                        <div class="tab-pane fade tab-content-container" id="widgets" role="tabpanel" aria-labelledby="widgets-tab">
                                            <h6 class="text-uppercase text-muted fw-bold mb-4 small" style="letter-spacing: 0.5px;">Widgets & Integrations</h6>
                                            
                                            <div class="mb-3">
                                                <label for="google_analytics" class="form-label">Google Analytics Code (or scripts)</label>
                                                <textarea class="form-control font-monospace" id="google_analytics" name="google_analytics" rows="4" style="font-size: 0.82rem;">{{ $settings['google_analytics'] ?? '' }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="cookie_consent_text" class="form-label">Cookie Consent Overlay Text</label>
                                                <input type="text" class="form-control" id="cookie_consent_text" name="cookie_consent_text" value="{{ $settings['cookie_consent_text'] ?? '' }}">
                                            </div>
                                        </div>

                                        <!-- 6. Social Channels -->
                                        <div class="tab-pane fade tab-content-container" id="socials" role="tabpanel" aria-labelledby="socials-tab">
                                            <h6 class="text-uppercase text-muted fw-bold mb-4 small" style="letter-spacing: 0.5px;">Social Media Pages</h6>
                                            
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <label for="social_facebook" class="form-label"><i class="fa-brands fa-facebook text-primary me-1"></i> Facebook URL</label>
                                                    <input type="url" class="form-control" id="social_facebook" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}">
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <label for="social_instagram" class="form-label"><i class="fa-brands fa-instagram text-danger me-1"></i> Instagram URL</label>
                                                    <input type="url" class="form-control" id="social_instagram" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <label for="social_linkedin" class="form-label"><i class="fa-brands fa-linkedin text-info me-1"></i> LinkedIn URL</label>
                                                    <input type="url" class="form-control" id="social_linkedin" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}">
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <label for="social_twitter" class="form-label"><i class="fa-brands fa-x-twitter text-dark me-1"></i> Twitter / X URL</label>
                                                    <input type="url" class="form-control" id="social_twitter" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end mt-4 pt-3 border-top border-secondary border-opacity-10">
                                        <button type="submit" class="btn btn-primary px-5 py-2-5"><i class="fa-solid fa-floppy-disk me-2"></i> Save Configurations</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    #settingsTabs .nav-link {
        color: var(--text-secondary);
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 12px;
        transition: all 0.25s ease;
    }
    #settingsTabs .nav-link:hover {
        color: #ffffff;
        background-color: rgba(255,255,255,0.03);
        border-color: rgba(255,255,255,0.03);
    }
    #settingsTabs .nav-link.active {
        color: #ffffff !important;
        background: linear-gradient(135deg, var(--primary-accent) 0%, var(--secondary-accent) 100%) !important;
        box-shadow: 0 4px 15px rgba(108, 99, 255, 0.2) !important;
        border-color: transparent !important;
    }
    .tab-content-container {
        animation: tabFadeIn 0.35s ease-out;
    }
    @keyframes tabFadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Sync color picker with text value
        $('#primary_color').on('input', function() {
            $('#primary_color_text').val($(this).val());
        });
    });
</script>
@endsection
