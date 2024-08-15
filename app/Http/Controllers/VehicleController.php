<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return response()->json($vehicles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:vehicle_type,id',
            'vehicle_number' => 'nullable|string|max:45',
            'last_service_date' => 'nullable|date',
            'total_servies_count' => 'nullable|integer',
            'next_service_date' => 'nullable|string|max:45',
            'vehicle_photo' => 'nullable|string|max:45',
            'vehicle_video' => 'nullable|string|max:45',
        ]);

        $vehicle = Vehicle::create($request->all());
        return response()->json($vehicle, 201);
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return response()->json($vehicle);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'type_id' => 'required|exists:vehicle_type,id',
            'vehicle_number' => 'nullable|string|max:45',
            'last_service_date' => 'nullable|date',
            'total_servies_count' => 'nullable|integer',
            'next_service_date' => 'nullable|string|max:45',
            'vehicle_photo' => 'nullable|string|max:45',
            'vehicle_video' => 'nullable|string|max:45',
        ]);

        $vehicle->update($request->all());
        return response()->json($vehicle);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return response()->json(null, 204);
    }
}
