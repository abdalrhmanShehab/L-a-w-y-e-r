<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $page = 'Appointments';
        $username = Auth::user()->name;
        $events = array();
        $bookings = Appointment::all();

        foreach ($bookings as $booking) {
            $events [] = [
                'lawyer_id' => $booking->lawyer_id,
                'title' => $booking->event_name,
                'start' => $booking->event_start,
                'end' => $booking->event_end,
                'user_id' => $booking->user_id
            ];

        }
        return view('appointments.index', ['events' => $events])->with(['page' => $page, 'username' => $username]);
    }

    public function create(Request $request)
    {

        $request->validate([
            'title'=>'required'
        ]);
        $data = Appointment::create([
            'lawyer_id'=>Auth::id(),
            'event_name'=>$request->title,
            'event_start'=>$request->start,
            'event_end'=>$request->end,
            'user_id'=>null,
        ]);

        return response()->json($data);
    }


}
