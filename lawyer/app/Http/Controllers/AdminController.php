<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Appointment;
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
    public function getMyAppointment(){
        $appointments = array();
        $appois = Appointment::where('user_id',Auth::id())->get();
        foreach ($appois as $appoi) {
            $lawyer = User::where('id', $appoi->lawyer_id)->first();
            $appointments [] = [
                'title' => $appoi->title,
                'start' => $appoi->start,
                'end' => $appoi->start,
                'color'=>$appoi->color,
                'lawyer' => $lawyer->name
            ];
        }

        return view('Dashboard_user.myAppointments',compact('appointments'));
    }

}
