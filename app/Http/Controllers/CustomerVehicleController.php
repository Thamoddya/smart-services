<?php

namespace App\Http\Controllers;

use App\Models\CustomerVehicle;
use Illuminate\Http\Request;

class CustomerVehicleController extends Controller
{
    public function index()
    {
        $customerVehicles = CustomerVehicle::all();
        return response()->json($customerVehicles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customers_id' => 'required|exists:customers,id',
            'vehicles_id' => 'required|exists:vehicles,id',
        ]);

        $customerVehicle = CustomerVehicle::create($request->all());
        return response()->json($customerVehicle, 201);
    }

    public function show($customerId, $vehicleId)
    {
        $customerVehicle = CustomerVehicle::where('customers_id', $customerId)
            ->where('vehicles_id', $vehicleId)
            ->firstOrFail();
        return response()->json($customerVehicle);
    }

    public function update(Request $request, $customerId, $vehicleId)
    {
        $customerVehicle = CustomerVehicle::where('customers_id', $customerId)
            ->where('vehicles_id', $vehicleId)
            ->firstOrFail();

        $request->validate([
            'customers_id' => 'required|exists:customers,id',
            'vehicles_id' => 'required|exists:vehicles,id',
        ]);

        $customerVehicle->update($request->all());
        return response()->json($customerVehicle);
    }

    public function destroy($customerId, $vehicleId)
    {
        $customerVehicle = CustomerVehicle::where('customers_id', $customerId)
            ->where('vehicles_id', $vehicleId)
            ->firstOrFail();
        $customerVehicle->delete();
        return response()->json(null, 204);
    }
}
