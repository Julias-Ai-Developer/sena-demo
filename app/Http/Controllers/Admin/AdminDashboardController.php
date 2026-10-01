<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicProgram;
use App\Models\AdmissionRequirement;
use App\Models\GalleryItem;
use App\Models\Inquiry;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin CMS overview dashboard.
     */
    public function index(): Response
    {
        $stats = [
            'total_programs' => AcademicProgram::count(),
            'active_programs' => AcademicProgram::where('is_active', true)->count(),
            'total_photos' => GalleryItem::count(),
            'active_photos' => GalleryItem::where('is_active', true)->count(),
            'total_requirements' => AdmissionRequirement::count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
            'contacted_inquiries' => Inquiry::where('status', 'contacted')->count(),
        ];

        $recentInquiries = Inquiry::latest()->take(6)->get();
        $recentGallery = GalleryItem::latest()->take(4)->get();
        $settings = SiteSetting::getAllMapped();

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'recentInquiries' => $recentInquiries,
            'recentGallery' => $recentGallery,
            'settings' => $settings,
        ]);
    }
}
