<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\ServiceCenter;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller
{
    public function CustomerHome()
    {
        return view('customer.home');
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
        return view("superAdmin.index", compact([
            'userData',
            'serviceCenters',
            'serviceCenterCount'
        ]));
    }
    public function SuperAdminServiceCenters()
    {
        $userData = Auth::user();
        $serviceAdmins = User::role('admin')->get();
        $serviceCenters = ServiceCenter::with('user')->get();
        return view("superAdmin.serviceCenters", compact([
            'userData',
            'serviceAdmins',
            'serviceCenters'
        ]));
    }
    public function AdminIndex()
    {
        $userData = Auth::user();
        $serviceCenter = ServiceCenter::where('users_id', $userData->id)->first();
        $customers = $serviceCenter->customers()->get();
        $customerCount = $serviceCenter->customers()->count();
        return view("admin.index", compact([
            'userData',
            'serviceCenter',
            'customers',
            'customerCount'
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
