<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_center_id' => 'required|exists:service_center,id',
        ]);

        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'service_center_id' => 'required|exists:service_center,id',
        ]);

        $customer->update($request->all());
        return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
