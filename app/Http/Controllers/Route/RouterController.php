<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouterController extends Controller
{

    public function SuperAdminIndex()
    {
        return view('superAdmin.index.superAdmin');
    }
}
