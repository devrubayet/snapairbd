<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialsController extends Controller
{
    function index(){
        $testimonials = Testimonial::all();
        return view('admin.pages.all-feedback', compact('testimonials'));
    }
     function createTestimonials(){
        return view('admin.components.testimonial-create');
    }

    function storeTestimonial(Request $request){
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string|max:255',
            'message' => 'required|string',
            'avatar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->bio = $request->bio;
        $testimonial->message = $request->message;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $testimonial->avatar = $path;
        }
        // ❌ else block একদম remove করে দাও

        $testimonial->save();

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 5000)
            ->option('ltr', true)
            ->success('Testimonial has been saved!');

        return redirect()->route('create-testi');

    } catch (\Exception $e) {
        flash()->addError('Something went wrong: ' . $e->getMessage());
        return redirect()->back();
    }
}
    function edit($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.components.testimonial-create',compact('testimonial'));
    }
    public function update(Request $request, string $id)
{
    // Find the testimonial by ID
    $testimonial = Testimonial::findOrFail($id);

    // Validate incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:500',
        'message' => 'required|string',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Initialize $data from request so it always exists
    $data = $request->only(['name', 'bio', 'message']);

    // ✅ Handle avatar file upload if provided
    if ($request->hasFile('avatar')) {
        // Delete old avatar if exists
        if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        // Store new avatar
        $data['avatar'] = $request->file('avatar')->store('testimonial-avatars', 'public');
    }

    // Update the record with the new data
    $testimonial->update($data);

    // Redirect back to the testimonial list with a success message
    return redirect()->route('all-testi')->with('success', 'Testimonial updated successfully!');
}
public function destroy(string $id)
{
    // Find the testimonial by ID
    $testimonial = Testimonial::findOrFail($id);

    // Delete the avatar image from storage if it exists
    if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
        Storage::disk('public')->delete($testimonial->avatar);
    }

    // Delete the testimonial record from the database
    $testimonial->delete();

    // Redirect back to the testimonial list with a success message
    return redirect()->route('all-testi')->with('success', 'Testimonial deleted successfully!');
}
}
