<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceCenter;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function StoreService(Request $request)
    {
        // Add this line to debug incoming data
        \Log::info($request->all());
        // Define validation rules
        $rules = [
            'beforeServiceMilage' => 'required|integer',
            'serviceMilage' => 'required|integer|gt:beforeServiceMilage',
            'serviceVehicleID' => 'required|exists:vehicles,vehicle_id',
            'serviceType' => 'required|string|max:255',
            'serviceDate' => 'required|date',
            'servicePrice' => 'required|string|max:255',
            'serviceDescription' => 'required|string|max:255',
        ];

        // Validate the incoming request data
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200);
        }
        $vehicle = Vehicle::where('vehicle_id', $request->serviceVehicleID)->first();

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not found'
            ], 404);
        }

        //update vehjicle table
        $vehicle->last_service_km = $request->beforeServiceMilage;
        $vehicle->next_service_km = $request->serviceMilage;
        $vehicle->save();


        try {
            $service = Service::create([
                'service_date' => $request->serviceDate,
                'service_type' => $request->serviceType,
                'service_details' => $request->serviceDescription,
                'full_cost' => $request->servicePrice,
                'invoice_number' => 'INV' . time(),
                'vehicles_id' => $vehicle->id,
                'service_centers_id' => $vehicle->service_center_id,
                'service_milage' => $request->beforeServiceMilage
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Service added successfully',
                'data' => $service
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while adding the service'
            ], 500);
        }

    }
    public function StoreVehicle(Request $request)
    {


        // Validation rules
        $rules = [
            'customerNic' => 'required|string|max:255|exists:customers,nic',
            'vehicleTypeId' => 'required|exists:vehicle_types,id',
            'vehicleID' => 'required|string|max:255|unique:vehicles,vehicle_id',
            'vehicleNumber' => 'required|string|max:255',
            'chassisNumber' => 'required|string|max:255',
            'lastServiceDate' => 'nullable|date',
            'lastServiceMilage' => 'nullable|integer',
            'nextServiceMilage' => 'nullable|integer',
            'vehiclePhoto' => 'required|image', // 2MB Max
            'vehicleVideo' => 'sometimes|mimetypes:video/avi,video/mpeg,video/mp4|max:10240', // 10MB Max
            'cerviceCenterId' => 'required|exists:service_center,id',
        ];

        // Validate the incoming request data
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200);
        }

        // Store the image and video
        $vehiclePhotoPath = null;
        if ($request->hasFile('vehiclePhoto')) {
            $vehiclePhotoPath = $request->file('vehiclePhoto')->store('vehicles/photos', 'public');
        }

        $vehicleVideoPath = null;
        if ($request->hasFile('vehicleVideo')) {
            $vehicleVideoPath = $request->file('vehicleVideo')->store('vehicles/videos', 'public');
        }

        // Create the vehicle record in the database
        try {
            $vehicle = Vehicle::create([
                'customer_id' => Customer::where('nic', $request->customerNic)->first()->id,
                'type_id' => $request->vehicleTypeId,
                'vehicle_id' => $request->vehicleID,
                'vehicle_number' => $request->vehicleNumber,
                'chassis_number' => $request->chassisNumber,
                'last_service_km' => $request->lastServiceMilage,
                'next_service_km' => $request->nextServiceMilage,
                'last_service_date' => $request->lastServiceDate,
                'vehicle_photo' => $vehiclePhotoPath,
                'vehicle_video' => $vehicleVideoPath,
                'service_center_id' => $request->cerviceCenterId,
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle added successfully',
                'data' => $vehicle
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while adding the vehicle',
            ], 500);
        }
    }
    public function StoreServiceCenter(Request $request)
    {
        // Define validation rules
        $rules = [
            'adminSelect' => 'required|exists:users,id',
            'serviceCenterName' => 'required|string|max:255',
            'serviceCenterMobile' => 'required|string|max:15',
            'serviceCenterEmail' => 'sometimes|email|unique:service_center,email',
            'serviceCenterAddress' => 'required|string|max:255',
            'total_access_vehicles' => 'sometimes|integer',
            'logo' => 'sometimes|file|mimes:jpeg,png,jpg,gif|max:2048' // Validate logo as an image file
        ];

        // Validate the incoming request data
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200);
        }

        // Handle the file upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos', 'public'); // Store the file in the 'logos' directory in public storage
        } else {
            $logoPath = null;
        }

        try {
            $serviceCenter = ServiceCenter::create([
                'name' => $request->serviceCenterName,
                'address' => $request->serviceCenterAddress,
                'mobile' => $request->serviceCenterMobile,
                'email' => $request->serviceCenterEmail,
                'users_id' => $request->adminSelect,
                'total_access_vehicles' => $request->total_access_vehicles,
                'logo_path' => $logoPath // Save the path of the uploaded logo
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Service center created successfully',
                'data' => $serviceCenter
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the service center'
            ], 500);
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

    public function StoreCustomer(Request $request)
    {
        // Define validation rules
        $rules = [
            'serviceCenterId' => 'required|exists:service_center,id',
            'customerName' => 'required|string|max:255',
            'customerEmail' => 'required|email|unique:customers,email',
            'customerPhone' => 'required|string|max:10|unique:customers,phone',
            'customerNIC' => 'required|string|max:12|unique:customers,nic',
            'customerAddress' => 'required|string|max:255',
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

        // Store the customer data in the database
        try {
            $customer = Customer::create([
                'service_center_id' => $request->serviceCenterId,
                'name' => $request->customerName,
                'email' => $request->customerEmail,
                'phone' => $request->customerPhone,
                'address' => $request->customerAddress,
                'nic' => $request->customerNIC,
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Customer added successfully',
                'data' => $customer
            ], 201); // Created status code

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while adding the customer'
            ], 200); // Internal Server Error status code
        }
    }

    public function getVehicleTypes()
    {
        $vehicleTypes = VehicleType::all();

        return response()->json([
            'status' => 'success',
            'data' => $vehicleTypes
        ], 200);
    }

}
