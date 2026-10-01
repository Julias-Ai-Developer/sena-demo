<?php

use App\Http\Controllers\Admin\AdminAcademicProgramController;
use App\Http\Controllers\Admin\AdminAdmissionRequirementController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

// Admin Panel Routes
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Site Settings (General, Hero, Headmaster, Contact, Stats)
    Route::get('/site-settings', [AdminSiteSettingController::class, 'index'])->name('admin.settings');
    Route::post('/site-settings', [AdminSiteSettingController::class, 'update'])->name('admin.settings.update');

    // Academic Programs CRUD
    Route::resource('/programs', AdminAcademicProgramController::class)->names('admin.programs');

    // Gallery & Media Uploads CRUD
    Route::resource('/gallery', AdminGalleryController::class)->names('admin.gallery');

    // Admissions & Requirements
    Route::resource('/admissions', AdminAdmissionRequirementController::class)->names('admin.admissions');

    // Parent Inquiries Management
    Route::resource('/inquiries', AdminInquiryController::class)->only(['index', 'update', 'destroy'])->names('admin.inquiries');
});

require __DIR__.'/settings.php';

