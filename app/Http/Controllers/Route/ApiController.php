<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Models\ServiceCenter;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function StoreServiceCenter(Request $request)
    {
        // Define validation rules
        $rules = [
            'adminSelect' => 'required|exists:users,id', // Ensure the admin exists in the users table
            'serviceCenterName' => 'required|string|max:255',
            'serviceCenterMobile' => 'required|string|max:15', // Adjust max length as needed
            'serviceCenterEmail' => 'sometimes|email|unique:service_center,email', // Ensure the email is unique in service_center table
            'serviceCenterAddress' => 'required|string|max:255',
            'total_access_vehicles' => 'sometimes|integer' // Ensure the total_access_vehicles is an integer
        ];

        // Validate the incoming request data
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200); // Unprocessable Entity status code
        }

        // Insert data into the database
        try {
            $serviceCenter = ServiceCenter::create([
                'name' => $request->serviceCenterName,
                'address' => $request->serviceCenterAddress,
                'mobile' => $request->serviceCenterMobile,
                'email' => $request->serviceCenterEmail,
                'users_id' => $request->adminSelect,
                'total_access_vehicles' => $request->total_access_vehicles
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Service center created successfully',
                'data' => $serviceCenter
            ], 201); // Created status code
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the service center'
            ], 500); // Internal Server Error status code
        }
    }
    public function StoreAdmin(Request $request)
    {

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:4'
        ];

        // Validate the incoming request data
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200); // Unprocessable Entity status code
        }

        try {
            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);
            $user->assignRole('admin');

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Admin created successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the admin'
            ], 200);
        }

    }

    public function GetAdmins()
    {
        $admins = User::role('admin')
            ->whereDoesntHave('serviceCenter')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $admins
        ], 200);
    }
}
