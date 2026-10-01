<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the gallery items.
     */
    public function index(): Response
    {
        $gallery = GalleryItem::orderBy('order_index')->get();

        return Inertia::render('admin/Gallery', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Store a newly created gallery item with media upload support.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:academics,sports,arts,campus',
            'category_label' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:15360',
            'image_url_input' => 'nullable|string',
            'alt_text' => 'nullable|string|max:500',
            'span_class' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $categoryLabels = [
            'academics' => 'Academics',
            'sports' => 'Sports & Games',
            'arts' => 'Arts & Culture',
            'campus' => 'Campus Grounds',
        ];

        $imagePath = '';
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('media/gallery', 'public');
        } elseif (!empty($validated['image_url_input'])) {
            $imagePath = $validated['image_url_input'];
        } else {
            return back()->withErrors(['image_file' => 'Please provide an image file or direct image URL.']);
        }

        GalleryItem::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'category_label' => $validated['category_label'] ?: ($categoryLabels[$validated['category']] ?? 'Campus Grounds'),
            'description' => $validated['description'] ?? '',
            'image_path' => $imagePath,
            'alt_text' => $validated['alt_text'] ?? $validated['title'],
            'span_class' => $validated['span_class'] ?: 'lg:col-span-4',
            'order_index' => $validated['order_index'] ?? (GalleryItem::max('order_index') + 1),
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return back()->with('success', 'Gallery media uploaded and published successfully!');
    }

    /**
     * Update the specified gallery item.
     */
    public function update(Request $request, GalleryItem $galleryItem): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:academics,sports,arts,campus',
            'category_label' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:15360',
            'image_url_input' => 'nullable|string',
            'alt_text' => 'nullable|string|max:500',
            'span_class' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $categoryLabels = [
            'academics' => 'Academics',
            'sports' => 'Sports & Games',
            'arts' => 'Arts & Culture',
            'campus' => 'Campus Grounds',
        ];

        $imagePath = $galleryItem->image_path;
        if ($request->hasFile('image_file')) {
            // Delete previous local file if applicable
            if (
                !empty($galleryItem->image_path) &&
                !str_starts_with($galleryItem->image_path, 'http://') &&
                !str_starts_with($galleryItem->image_path, 'https://')
            ) {
                Storage::disk('public')->delete($galleryItem->image_path);
            }
            $imagePath = $request->file('image_file')->store('media/gallery', 'public');
        } elseif (!empty($validated['image_url_input'])) {
            $imagePath = $validated['image_url_input'];
        }

        $galleryItem->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'category_label' => $validated['category_label'] ?: ($categoryLabels[$validated['category']] ?? 'Campus Grounds'),
            'description' => $validated['description'] ?? '',
            'image_path' => $imagePath,
            'alt_text' => $validated['alt_text'] ?? $validated['title'],
            'span_class' => $validated['span_class'] ?: $galleryItem->span_class,
            'order_index' => $validated['order_index'] ?? $galleryItem->order_index,
            'is_active' => $validated['is_active'] ?? $galleryItem->is_active,
        ]);

        return back()->with('success', 'Gallery item updated successfully.');
    }

    /**
     * Remove the specified gallery item.
     */
    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        if (
            !empty($galleryItem->image_path) &&
            !str_starts_with($galleryItem->image_path, 'http://') &&
            !str_starts_with($galleryItem->image_path, 'https://')
        ) {
            Storage::disk('public')->delete($galleryItem->image_path);
        }

        $galleryItem->delete();

        return back()->with('success', 'Gallery media deleted successfully.');
    }
}
