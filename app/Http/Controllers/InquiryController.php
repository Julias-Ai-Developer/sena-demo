<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Store a newly submitted admissions inquiry.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:50',
            'parent_email' => 'required|email|max:255',
            'class_level' => 'required|string|max:50',
            'boarding_status' => 'required|string|max:50',
            'message' => 'nullable|string|max:2000',
            'consent' => 'required|accepted',
        ]);

        Inquiry::create([
            'student_name' => $validated['student_name'],
            'parent_name' => $validated['parent_name'],
            'parent_phone' => $validated['parent_phone'],
            'parent_email' => $validated['parent_email'],
            'class_level' => $validated['class_level'],
            'boarding_status' => $validated['boarding_status'],
            'message' => $validated['message'] ?? null,
            'consent' => true,
            'status' => 'new',
        ]);

        return back()->with('success', 'Thank you! Your admission inquiry has been received. Our team will contact you soon.');
    }
}
