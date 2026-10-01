<?php

namespace App\Http\Controllers;

use App\Models\AcademicProgram;
use App\Models\AdmissionRequirement;
use App\Models\GalleryItem;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the public Sena High School homepage.
     */
    public function index(): Response
    {
        $settings = SiteSetting::getAllMapped();

        // Convert any local stored paths in settings to full asset URLs
        $imageKeys = ['crest_url', 'hero_image', 'headmaster_image'];
        foreach ($imageKeys as $imgKey) {
            if (isset($settings[$imgKey]) && !empty($settings[$imgKey])) {
                if (!str_starts_with($settings[$imgKey], 'http://') && !str_starts_with($settings[$imgKey], 'https://')) {
                    $settings[$imgKey] = asset('storage/' . ltrim($settings[$imgKey], '/'));
                }
            }
        }

        $programs = AcademicProgram::where('is_active', true)
            ->orderBy('order_index')
            ->get();

        $gallery = GalleryItem::where('is_active', true)
            ->orderBy('order_index')
            ->get();

        $admissionRequirements = AdmissionRequirement::where('is_active', true)
            ->orderBy('order_index')
            ->pluck('requirement_text')
            ->toArray();

        return Inertia::render('Index', [
            'settings' => $settings,
            'programs' => $programs,
            'gallery' => $gallery,
            'admissionRequirements' => $admissionRequirements,
        ]);
    }
}
