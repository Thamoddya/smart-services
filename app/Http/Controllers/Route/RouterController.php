<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OurServices;
use App\Models\Service;
use App\Models\ServiceCenter;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller
{


    public function deleteOurService(Request $request)
    {
        $ourService = OurServices::find($request->id);
        if ($ourService) {
            $ourService->delete();
        }
        return redirect()->back();
    }

    public function OurServices()
    {
        $userData = Auth::user();
        $serviceCenter = ServiceCenter::where('users_id', $userData->id)->first();
        return view("admin.ourServices", compact([
            'userData',
            'serviceCenter'
        ]));
    }

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
        //Get all services of this service center last services first by created_at
        $services = $serviceCenter->services()->orderBy('created_at', 'asc')->get();
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


        //Total services count in this month
        $servicesCount = Service::whereMonth('created_at', date('m'))->count();

        //TOtal vehicles in all service centers
        $totalVehicles = Vehicle::count();
        return view("superAdmin.index", compact([
            'userData',
            'serviceCenters',
            'serviceCenterCount',
            'customersInThisMonth',
            'totalVehicles',
            'servicesCount'
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

        // Get last 5 months' total sum of service cost
        $monthlyRevenue = [];
        for ($i = 4; $i >= 0; $i--) {
            $month = now()->subMonths($i)->month;
            $year = now()->subMonths($i)->year;
            $totalForMonth = $serviceCenter->services()
                ->whereMonth('service_date', $month)
                ->whereYear('service_date', $year)
                ->sum('full_cost');
            $monthlyRevenue[] = $totalForMonth;
        }

        // Get all vehicle types and their counts
        $vehicleTypes = VehicleType::select('vehicle_types.name', DB::raw('count(vehicles.id) as count'))
            ->join('vehicles', 'vehicles.type_id', '=', 'vehicle_types.id')
            ->where('vehicles.service_center_id', $serviceCenter->id)
            ->groupBy('vehicle_types.name')
            ->get();

        $vehicleTypeLabels = $vehicleTypes->pluck('name');
        $vehicleTypeCounts = $vehicleTypes->pluck('count');

        $customers = $serviceCenter->customers()->get();
        $customerCount = $serviceCenter->customers()->count();
        $customersInThisMonth = $serviceCenter->customers()->whereMonth('created_at', date('m'))->count();
        $totalRevenue = $serviceCenter->services()->sum('full_cost');
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
            'totalVehiclesinServiceCenter',
            'monthlyRevenue',
            'vehicleTypeLabels',
            'vehicleTypeCounts'
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
