<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AdminSiteSettingController extends Controller
{
    /**
     * Display the site settings management page.
     */
    public function index(Request $request): Response
    {
        $tab = $request->query('tab', 'general');
        $settings = SiteSetting::getAllMapped();

        // Convert local stored paths in settings to full asset URLs for preview
        $imageKeys = ['crest_url', 'hero_image', 'headmaster_image'];
        $imageUrls = [];
        foreach ($imageKeys as $imgKey) {
            if (isset($settings[$imgKey]) && !empty($settings[$imgKey])) {
                if (str_starts_with($settings[$imgKey], 'http://') || str_starts_with($settings[$imgKey], 'https://')) {
                    $imageUrls[$imgKey] = $settings[$imgKey];
                } else {
                    $imageUrls[$imgKey] = asset('storage/' . ltrim($settings[$imgKey], '/'));
                }
            } else {
                $imageUrls[$imgKey] = '';
            }
        }

        return Inertia::render('admin/SiteSettings', [
            'settings' => $settings,
            'imageUrls' => $imageUrls,
            'activeTab' => $tab,
        ]);
    }

    /**
     * Update site settings including handling media uploads.
     */
    public function update(Request $request): RedirectResponse
    {
        $data = $request->all();

        // Handle File Uploads
        $imageFields = [
            'crest_file' => ['key' => 'crest_url', 'group' => 'general'],
            'hero_file' => ['key' => 'hero_image', 'group' => 'hero'],
            'headmaster_file' => ['key' => 'headmaster_image', 'group' => 'headmaster'],
        ];

        foreach ($imageFields as $fileInput => $config) {
            if ($request->hasFile($fileInput)) {
                $request->validate([
                    $fileInput => 'image|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
                ]);

                $file = $request->file($fileInput);
                $path = $file->store('media/settings', 'public');
                SiteSetting::set($config['key'], $path, $config['group'], 'image');
            } elseif (isset($data[$config['key']]) && is_string($data[$config['key']])) {
                // If direct URL was provided and no new file was uploaded
                SiteSetting::set($config['key'], $data[$config['key']], $config['group'], 'image');
            }
        }

        // Text and Textarea settings
        $textSettings = [
            // General
            'school_name' => 'general',
            'school_tagline' => 'general',
            'school_motto' => 'general',
            'announcement_badge' => 'general',
            'announcement_text' => 'general',
            'campus_location' => 'general',
            'uneb_center_no' => 'general',

            // Contact
            'phone_primary' => 'contact',
            'phone_secondary' => 'contact',
            'email_primary' => 'contact',
            'address_full' => 'contact',

            // Hero
            'hero_badge' => 'hero',
            'hero_title_highlight' => 'hero',
            'hero_title_prefix' => 'hero',
            'hero_title_suffix' => 'hero',
            'hero_paragraph' => 'hero',
            'hero_badge_corner' => 'hero',
            'hero_card_title' => 'hero',
            'hero_card_desc' => 'hero',

            // Stats
            'stat1_value' => 'stats',
            'stat1_label' => 'stats',
            'stat2_value' => 'stats',
            'stat2_label' => 'stats',
            'stat3_value' => 'stats',
            'stat3_label' => 'stats',
            'stat4_value' => 'stats',
            'stat4_label' => 'stats',

            // Headmaster
            'headmaster_name' => 'headmaster',
            'headmaster_title' => 'headmaster',
            'headmaster_experience' => 'headmaster',
            'headmaster_qualifications' => 'headmaster',
            'headmaster_section_title' => 'headmaster',
            'headmaster_quote' => 'headmaster',
            'headmaster_welcome_text' => 'headmaster',
            'headmaster_card1_title' => 'headmaster',
            'headmaster_card1_desc' => 'headmaster',
            'headmaster_card2_title' => 'headmaster',
            'headmaster_card2_desc' => 'headmaster',
            'headmaster_card3_title' => 'headmaster',
            'headmaster_card3_desc' => 'headmaster',

            // Admissions
            'admissions_title' => 'admissions',
            'admissions_subtitle' => 'admissions',
            'admissions_s1_status' => 'admissions',
            'admissions_s5_status' => 'admissions',
            'admissions_transfer_status' => 'admissions',
            'admissions_bursary_title' => 'admissions',
            'admissions_bursary_desc' => 'admissions',
            'admissions_hotline' => 'admissions',
        ];

        foreach ($textSettings as $key => $group) {
            if (array_key_exists($key, $data)) {
                $type = in_array($key, ['hero_paragraph', 'headmaster_quote', 'headmaster_welcome_text', 'admissions_subtitle', 'admissions_bursary_desc', 'address_full'])
                    ? 'textarea'
                    : 'text';
                SiteSetting::set($key, $data[$key] ?? '', $group, $type);
            }
        }

        return back()->with('success', 'Site settings and content successfully updated!');
    }
}
