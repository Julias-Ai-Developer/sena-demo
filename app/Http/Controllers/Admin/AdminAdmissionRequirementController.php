<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionRequirement;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminAdmissionRequirementController extends Controller
{
    /**
     * Display the admissions configuration and requirements.
     */
    public function index(): Response
    {
        $requirements = AdmissionRequirement::orderBy('order_index')->get();
        $settings = SiteSetting::getAllMapped();

        return Inertia::render('admin/Admissions', [
            'requirements' => $requirements,
            'settings' => $settings,
        ]);
    }

    /**
     * Store a new admission requirement.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'requirement_text' => 'required|string|max:1000',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['order_index'] = $validated['order_index'] ?? (AdmissionRequirement::max('order_index') + 1);
        $validated['is_active'] = $validated['is_active'] ?? true;

        AdmissionRequirement::create($validated);

        return back()->with('success', 'Admission requirement added successfully.');
    }

    /**
     * Update an existing admission requirement.
     */
    public function update(Request $request, AdmissionRequirement $requirement): RedirectResponse
    {
        $validated = $request->validate([
            'requirement_text' => 'required|string|max:1000',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $requirement->update($validated);

        return back()->with('success', 'Admission requirement updated successfully.');
    }

    /**
     * Remove an admission requirement.
     */
    public function destroy(AdmissionRequirement $requirement): RedirectResponse
    {
        $requirement->delete();

        return back()->with('success', 'Admission requirement deleted successfully.');
    }
}
