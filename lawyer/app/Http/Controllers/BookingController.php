<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
        public function booking(){
        $lawyers = User::role('lawyer')->get();
        return view('Dashboard_user.appointments',compact('lawyers'));
    }
    public function getAppointments($id){
        $appointmetns = Appointment::where('lawyer_id',$id)->get();
        return view('Dashboard_user.booking',compact('appointmetns'));
    }
}
