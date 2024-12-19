<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        // Retrieve all photos
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        // Show the form to create a new photo
        return view('photos.create');
    }

    public function store(Request $request)
    {
        // Validate and store a new photo
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $imagePath = $request->file('image')->store('photos', 'public');

        $photo = new Photo();
        $photo->title = $request->title;
        $photo->image = $imagePath;
        $photo->save();

        return redirect()->route('photos.index')
                         ->with('success', 'Photo uploaded successfully');
    }

    public function show(Photo $photo)
    {
        // Display a specific photo
        return view('photos.show', compact('photo'));
    }

    public function edit(Photo $photo)
    {
        // Show the form to edit a specific photo
        return view('photos.edit', compact('photo'));
    }

    public function update(Request $request, Photo $photo)
    {
        // Validate and update a specific photo
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $photo->title = $request->title;

        if ($request->hasFile('image')) {
            // Delete old image if updating with a new one
            Storage::disk('public')->delete($photo->image);

            // Store new image
            $imagePath = $request->file('image')->store('photos', 'public');
            $photo->image = $imagePath;
        }

        $photo->save();

        return redirect()->route('photos.index')
                         ->with('success', 'Photo updated successfully');
    }

    public function destroy(Photo $photo)
    {
        // Delete a specific photo
        Storage::disk('public')->delete($photo->image);
        $photo->delete();

        return redirect()->route('photos.index')
                         ->with('success', 'Photo deleted successfully');
    }
}
