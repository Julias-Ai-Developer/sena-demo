<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminAcademicProgramController extends Controller
{
    /**
     * Display a listing of academic programs.
     */
    public function index(): Response
    {
        $programs = AcademicProgram::orderBy('order_index')->get();

        return Inertia::render('admin/Programs', [
            'programs' => $programs,
        ]);
    }

    /**
     * Store a newly created academic program.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tag' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'link_label' => 'nullable|string|max:100',
            'link_url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'accent_bar' => 'nullable|string|max:100',
            'icon_bg' => 'nullable|string|max:100',
            'icon_color' => 'nullable|string|max:100',
            'label_color' => 'nullable|string|max:100',
            'link_color' => 'nullable|string|max:100',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['order_index'] = $validated['order_index'] ?? (AcademicProgram::max('order_index') + 1);
        $validated['is_active'] = $validated['is_active'] ?? true;
        $validated['features'] = $validated['features'] ?? [];
        $validated['link_label'] = $validated['link_label'] ?? 'Learn More';
        $validated['link_url'] = $validated['link_url'] ?? '#admissions';
        $validated['icon'] = $validated['icon'] ?? 'school';
        $validated['accent_bar'] = $validated['accent_bar'] ?? 'bg-primary';
        $validated['icon_bg'] = $validated['icon_bg'] ?? 'bg-primary-fixed';
        $validated['icon_color'] = $validated['icon_color'] ?? 'text-primary';
        $validated['label_color'] = $validated['label_color'] ?? 'text-primary';
        $validated['link_color'] = $validated['link_color'] ?? 'text-primary';

        AcademicProgram::create($validated);

        return back()->with('success', 'Academic program created successfully.');
    }

    /**
     * Update the specified academic program.
     */
    public function update(Request $request, AcademicProgram $program): RedirectResponse
    {
        $validated = $request->validate([
            'tag' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'link_label' => 'nullable|string|max:100',
            'link_url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'accent_bar' => 'nullable|string|max:100',
            'icon_bg' => 'nullable|string|max:100',
            'icon_color' => 'nullable|string|max:100',
            'label_color' => 'nullable|string|max:100',
            'link_color' => 'nullable|string|max:100',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $program->update($validated);

        return back()->with('success', 'Academic program updated successfully.');
    }

    /**
     * Remove the specified academic program.
     */
    public function destroy(AcademicProgram $program): RedirectResponse
    {
        $program->delete();

        return back()->with('success', 'Academic program deleted successfully.');
    }
}
