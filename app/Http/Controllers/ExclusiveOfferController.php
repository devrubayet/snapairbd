<?php

namespace App\Http\Controllers;

use App\Models\ExclusiveOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExclusiveOfferController extends Controller
{
    // INDEX
    public function index()
    {
        $sliders = ExclusiveOffer::latest()->get();
        return view('admin.pages.all-slider', compact('sliders'));
    }

    function create(){
        return view('admin.components.create-ourservice');
    }
    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ], [
            'img.image' => 'File must be an image.',
            'img.mimes' => 'Only JPG, JPEG, PNG, WEBP allowed.',
            'img.max' => 'Image must be less than 4MB.',
        ]);

        // IMAGE UPLOAD
        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('exclusive', 'public');
        }

        // SHORT DESC
        $validated['short_desc'] = !empty($validated['description'])
            ? Str::limit(strip_tags($validated['description']), 150)
            : null;

        ExclusiveOffer::create($validated);

        return back()->with('success', 'Slider created successfully!');
    }

    // EDIT
    public function edit($id)
    {
        $slider = ExclusiveOffer::findOrFail($id);
        return view('admin.components.create-ourservice', compact('slider'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $offer = ExclusiveOffer::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ], [
            'img.image' => 'File must be an image.',
            'img.mimes' => 'Only JPG, JPEG, PNG, WEBP allowed.',
            'img.max' => 'Image must be less than 4MB.',
        ]);

        // IMAGE UPDATE
        if ($request->hasFile('img')) {

            // delete old image
            if ($offer->img && Storage::disk('public')->exists($offer->img)) {
                Storage::disk('public')->delete($offer->img);
            }

            $validated['img'] = $request->file('img')->store('exclusive', 'public');
        }

        // SHORT DESC
        $validated['short_desc'] = !empty($validated['description'])
            ? Str::limit(strip_tags($validated['description']), 150)
            : null;

        $offer->update($validated);

        return back()->with('success', 'Slider updated successfully!');
    }

    // DELETE
    public function destroy($id)
    {
        $offer = ExclusiveOffer::findOrFail($id);

        if ($offer->img && Storage::disk('public')->exists($offer->img)) {
            Storage::disk('public')->delete($offer->img);
        }

        $offer->delete();
        
        return redirect()->back()->with('warning', "deleted successfull");
    }
     public function toggle($id)
{
    $slider = ExclusiveOffer::findOrFail($id);
    $slider->status = $slider->status === 'active' ? 'deactive' : 'active';
    $slider->save();

    return back()->with('success', 'Slider status updated!');
}
}