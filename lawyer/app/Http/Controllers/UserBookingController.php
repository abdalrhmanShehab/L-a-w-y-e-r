<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    public function getMyAppointment(){
        $appointments = array();
        $appois = Appointment::where('user_id',Auth::id())->whereNull('deleted_at')->get();
        foreach ($appois as $appoi) {
            $lawyer = User::where('id', $appoi->lawyer_id)->whereNull('deleted_at')->first();
            $appointments [] = [
                'id'=>$appoi->id,
                'title' => $appoi->title,
                'start' => $appoi->start,
                'end' => $appoi->start,
                'color'=>$appoi->color,
                'lawyer' => $lawyer->name
            ];
        }

        return view('Dashboard_user.myAppointments',compact(['appointments']));
    }
    public function cancelBooking($id){
        $appointment = Appointment::findOrFail($id)->whereNull('deleted_at')->update([
            'title'=>'available',
            'color'=>'#4BB543',
            'user_id'=>null
        ]);
        if ($appointment){
            Booking::where('appointment_id',$id)->delete();
            return redirect()->back()->with('success' , 'Appointment canceled Successfully');
        }

    }
}
