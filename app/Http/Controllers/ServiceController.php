<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_date' => 'nullable|string|max:45',
            'service_type' => 'nullable|string|max:45',
            'service_details' => 'nullable|string|max:45',
            'service_duration' => 'nullable|string|max:45',
            'service_technician' => 'nullable|string|max:45',
            'full_cost' => 'nullable|string|max:45',
            'invoice_number' => 'nullable|string|max:45',
            'vehicles_id' => 'required|exists:vehicles,id',
        ]);

        $service = Service::create($request->all());
        return response()->json($service, 201);
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'service_date' => 'nullable|string|max:45',
            'service_type' => 'nullable|string|max:45',
            'service_details' => 'nullable|string|max:45',
            'service_duration' => 'nullable|string|max:45',
            'service_technician' => 'nullable|string|max:45',
            'full_cost' => 'nullable|string|max:45',
            'invoice_number' => 'nullable|string|max:45',
            'vehicles_id' => 'required|exists:vehicles,id',
        ]);

        $service->update($request->all());
        return response()->json($service);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(null, 204);
    }
}
