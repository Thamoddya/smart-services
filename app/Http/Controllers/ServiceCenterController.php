<?php

namespace App\Http\Controllers;

use App\Models\ServiceCenter;
use Illuminate\Http\Request;

class ServiceCenterController extends Controller
{
    public function index()
    {
        $serviceCenters = ServiceCenter::all();
        return response()->json($serviceCenters);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:45',
            'address' => 'nullable|string|max:45',
            'mobile' => 'nullable|string|max:45',
            'email' => 'nullable|string|max:45',
            'total_access_vehicles' => 'nullable|string|max:45',
            'users_id' => 'required|exists:users,id',
        ]);

        $serviceCenter = ServiceCenter::create($request->all());
        return response()->json($serviceCenter, 201);
    }

    public function show($id)
    {
        $serviceCenter = ServiceCenter::findOrFail($id);
        return response()->json($serviceCenter);
    }

    public function update(Request $request, $id)
    {
        $serviceCenter = ServiceCenter::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:45',
            'address' => 'nullable|string|max:45',
            'mobile' => 'nullable|string|max:45',
            'email' => 'nullable|string|max:45',
            'total_access_vehicles' => 'nullable|string|max:45',
            'users_id' => 'required|exists:users,id',
        ]);

        $serviceCenter->update($request->all());
        return response()->json($serviceCenter);
    }

    public function destroy($id)
    {
        $serviceCenter = ServiceCenter::findOrFail($id);
        $serviceCenter->delete();
        return response()->json(null, 204);
    }
}
