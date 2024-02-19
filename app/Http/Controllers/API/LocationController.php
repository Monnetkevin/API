<?php

namespace App\Http\Controllers\API;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::with(['user', 'images', 'category'])->get();
        return response()->json($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:50',
            'location_content' => 'required',
            'location_address' => 'required|string|max:100',
            'location_postal' => 'required|size:5',
            'location_city' => 'required|string|min:4|max:30',
            'location_lat' => 'nullable|string',
            'location_lng' => 'nullable|string',
            'category_id' => 'required',
        ]);

        $location = Location::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        return response()->json([
            'message' => 'Lieu créé avec succès',
            'data' => $location
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return response()->json($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'location_name' => 'required|string|max:50',
            'location_content' => 'required',
            'location_address' => 'required|string|max:100',
            'location_postal' => 'required|size:5',
            'location_city' => 'required|string|min:4|max:30',
            'location_lat' => 'nullable|decimal:2,5',
            'location_lng' => 'nullable|decimal:2,5',
            'category_id' => 'required'
        ]);

        $location->update($request->all());

        return response()->json([
            'message' => 'Mise à jour faite avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json([
            'message' => 'Bien joué, tu as supprimé le lieu !!'
        ]);
    }
}
