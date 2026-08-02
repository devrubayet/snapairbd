<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirlinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airlines = Airline::all();
        //  return json_encode($airlines);
        return view('admin.pages.all-airlines', compact('airlines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAir()
    {
        return view('admin.components.create-airline');
    }

    /**
     * Store a newly created resource in storage.
     */
    function storeAir(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',

            'image' => "required|mimes:png,jpg"

        ]);




        $airlines = new Airline();
        $airlines->name = $request->name;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:png,jpg'
            ]);
            $path =  $request->file('image')->store('airlines/', 'public');
            $airlines->image = $path;
        } else {
            $airlines->image = $request->image;
        }

        $airlines->save();
        flash()
            ->option('position', 'top-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Airline has been saved!');
        return redirect()->route('create-airline');

        // return response()->json([
        //     'message' => "success"
        // ]);
    }
    function editAir($id)
    {
        $airline = Airline::findOrFail($id);
        return view('admin.components.create-airline', compact('airline'));
    }
    function updateAir(Request $request, $id)
    {
        $airline = Airline::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // update name
        $airline->name = $validated['name'];

        // update image only if uploaded
        if ($request->hasFile('image')) {

            // delete old image (optional but recommended)
            if ($airline->image && Storage::disk('public')->exists($airline->image)) {
                Storage::disk('public')->delete($airline->image);
            }

            $path = $request->file('image')->store('airlines', 'public');
            $airline->image = $path;
        }

        $airline->save();

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 5000)
            ->success('Airline has been updated!');

        return redirect()->route('showAirlines');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the testimonial by ID
        $airlines = Airline::findOrFail($id);

        // Delete the avatar image from storage if it exists
        if ($airlines->image && Storage::disk('public')->exists($airlines->image)) {
            Storage::disk('public')->delete($airlines->image);
        }

        // Delete the testimonial record from the database
        $airlines->delete();

        // Redirect back to the testimonial list with a success message
        return redirect()->route('showAirlines')->with('success', 'Airline deleted successfully!');
    }
}
