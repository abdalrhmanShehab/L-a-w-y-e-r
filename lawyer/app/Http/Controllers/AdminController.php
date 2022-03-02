<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Dashboad';
        $username = Auth::user()->name;
        return view('layouts.admin.dashboard',compact('username','page'));
    }

    public function userindex(){
        return view('layouts.user.dashboard');
    }


}
