<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ServiceCenter;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller
{


    public function vehicleType()
    {

        $userData = Auth::user();
        $vehicleTypes = VehicleType::all();

        return view('superAdmin.vehicleType', compact([
            'userData',
            'vehicleTypes'
        ]));
    }

    public function AdminServices()
    {
        $userData = Auth::user();
        $serviceCenter = ServiceCenter::where('users_id', $userData->id)->first();
        $services = $serviceCenter->services()->get();
        $serviceCount = $serviceCenter->services()->count();
        return view("admin.services", compact([
            'userData',
            'serviceCenter',
            'services',
            'serviceCount'
        ]));
    }

    public function CustomerHome($vehicleNumber)
    {
        $vehicle = Vehicle::where('vehicle_id', $vehicleNumber)->first();
        if (!$vehicle) {
            echo "Vehicle not found";
            return;
        }
        $serviceCenter = $vehicle->serviceCenter()->first();
        $customer = $vehicle->customer()->first();
        $vehicleServices = $vehicle->services()->get();
        return view('customer.home', compact([
            'vehicle',
            'serviceCenter',
            'customer',
            'vehicleServices'
        ]));
    }

    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('super-admin')) {
                return redirect()->route('superAdmin.index');
            } else if ($user->hasRole('admin')) {

                //CHeck user has service center
                $serviceCenter = ServiceCenter::where('users_id', $user->id)->first();
                if (!$serviceCenter) {
                    return redirect()->route('login')->withErrors(['error' => 'You are not assigned to any service center']);
                }

                return redirect()->route('admin.index');
            } else {
                echo "Please contact the administrator";
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials'])->withInput();
            ;
        }
    }
    public function SuperAdminIndex()
    {
        $userData = Auth::user();
        $serviceCenters = ServiceCenter::all();
        $serviceCenterCount = ServiceCenter::count();
        //Total customers in this month
        $customersInThisMonth = Customer::whereMonth('created_at', date('m'))->count();

        //Get Total sum of full_cost of all services in all service centers in this month
        $totalRevenue = 0;
        $services = ServiceCenter::with('services')->get();
        foreach ($services as $serviceCenter) {
            foreach ($serviceCenter->services as $service) {
                $totalRevenue += $service->full_cost;
            }
        }

        //TOtal vehicles in all service centers
        $totalVehicles = Vehicle::count();
        return view("superAdmin.index", compact([
            'userData',
            'serviceCenters',
            'serviceCenterCount',
            'customersInThisMonth',
            'totalRevenue',
            'totalVehicles'
        ]));
    }
    public function SuperAdminServiceCenters()
    {
        $userData = Auth::user();
        $serviceAdmins = User::role('admin')->get();
        $serviceCenters = ServiceCenter::with('user')->get();
        $serviceCenterCount = ServiceCenter::count();
        return view("superAdmin.serviceCenters", compact([
            'userData',
            'serviceAdmins',
            'serviceCenters',
            'serviceCenterCount'
        ]));
    }
    public function AdminIndex()
    {
        $userData = Auth::user();
        $serviceCenter = ServiceCenter::where('users_id', $userData->id)->first();
        $customers = $serviceCenter->customers()->get();
        $customerCount = $serviceCenter->customers()->count();
        //Totl customers in this month in this service center
        $customersInThisMonth = $serviceCenter->customers()->whereMonth('created_at', date('m'))->count();
        //Get the all services in this service center and calculate the total revenue
        $services = $serviceCenter->services()->get();
        $totalRevenue = 0;
        foreach ($services as $service) {
            $totalRevenue += $service->full_cost;
        }

        $totalVehiclesinServiceCenter = $serviceCenter->vehicles()->count();

        $totalServicesCount = $serviceCenter->services()->count();
        return view("admin.index", compact([
            'userData',
            'serviceCenter',
            'customers',
            'customerCount',
            'customersInThisMonth',
            'totalRevenue',
            'totalServicesCount',
            'totalVehiclesinServiceCenter'
        ]));
    }
    public function AdminCustomers()
    {
        $userData = Auth::user();
        $serviceCenter = ServiceCenter::where('users_id', $userData->id)->first();
        $customers = $serviceCenter->customers()->get();
        $customerCount = $serviceCenter->customers()->count();
        return view("admin.customers", compact([
            'userData',
            'serviceCenter',
            'customers',
            'customerCount'
        ]));
    }
    public function AdminVehicles()
    {
        $userData = Auth::user();
        $serviceCenter = ServiceCenter::where('users_id', $userData->id)->first();
        $vehicles = $serviceCenter->vehicles()->get();
        $vehicleCount = $serviceCenter->vehicles()->count();
        return view("admin.vehicles", compact([
            'userData',
            'serviceCenter',
            'vehicles',
            'vehicleCount'
        ]));
    }
    public function SuperAdminVehicles()
    {
        $userData = Auth::user();
        $vehicles = Vehicle::with('serviceCenter')->get();
        $vehicleCount = Vehicle::count();
        return view("superAdmin.vehicles", compact([
            'userData',
            'vehicles',
            'vehicleCount'
        ]));
    }
    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
