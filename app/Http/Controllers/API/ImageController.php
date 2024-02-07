<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_name' => 'required|image|max:3000|mimes:jpeg,png,jpg,svg',
            'article_id' => 'nullable',
            'location_id' => 'nullable'
        ]);

        $filename = "";
        if ($request->hasFile('image_name')) {
            $filenameWithExt = $request->file('image_name')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_name')->getClientOriginalExtension();
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            $request->file('image_name')->storeAs('public/uploads', $filename);
        }
        $image = Image::create(array_merge($request->all(), ['image_name' => $filename]));

        return response()->json([
            'message' => 'image ajoutée avec succès',
            'data' => $image
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return response()->json($image);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $fileLink = 'public/uploads/' . $image->image_name;
        Storage::delete($fileLink);
        $image->delete();

        return response()->json([
            'message' => 'Suppression de l\'image réussite !!'
        ]);
    }
}
