<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\ServiceCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller
{

    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('super-admin')) {
                return redirect()->route('superAdmin.index');
            } else {
                echo "Admin";
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
        return view("superAdmin.index", compact([
            'userData',
            'serviceCenters'
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
}
