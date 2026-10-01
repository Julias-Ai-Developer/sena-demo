<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminInquiryController extends Controller
{
    /**
     * Display all admission inquiries with filter support.
     */
    public function index(Request $request): Response
    {
        $status = $request->query('status');
        $query = Inquiry::latest();

        if ($status && in_array($status, ['new', 'contacted', 'enrolled', 'closed'])) {
            $query->where('status', $status);
        }

        $inquiries = $query->paginate(20)->withQueryString();

        $statusCounts = [
            'all' => Inquiry::count(),
            'new' => Inquiry::where('status', 'new')->count(),
            'contacted' => Inquiry::where('status', 'contacted')->count(),
            'enrolled' => Inquiry::where('status', 'enrolled')->count(),
            'closed' => Inquiry::where('status', 'closed')->count(),
        ];

        return Inertia::render('admin/Inquiries', [
            'inquiries' => $inquiries,
            'statusCounts' => $statusCounts,
            'currentFilter' => $status ?? 'all',
        ]);
    }

    /**
     * Update inquiry status or notes.
     */
    public function update(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:new,contacted,enrolled,closed',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $inquiry->update($validated);

        return back()->with('success', 'Inquiry updated successfully.');
    }

    /**
     * Delete an inquiry.
     */
    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return back()->with('success', 'Inquiry deleted.');
    }
}
