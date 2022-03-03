<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
        $username = Auth::user()->name;
        $page = 'Appointments';

        if ($request->ajax()) {
            $data = Appointment::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->where('lawyer_id', Auth::id())
                ->get(['id', 'title', 'start', 'end', 'user_id', 'lawyer_id', 'color']);
            return response()->json($data);
        }

        return view('appointments.index')->with(['username' => $username, 'page' => $page]);
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $event = '';
                if($request->title == "available"){
                    $event = Appointment::create([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                        'lawyer_id' => Auth::id(),
                        'user_id' => null,
                        'color' => '#4BB543'
                    ]);
                }

                elseif ($request->title == "Booking") {
                    $event = Appointment::create([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                        'lawyer_id' => Auth::id(),
                        'user_id' => null,
                        'color' => '#FF6347'
                    ]);
                }

                return response()->json($event);
            }
            if ($request->type == 'update') {
                $event = Appointment::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
            }
            if ($request->type == 'delete') {
                $event = Appointment::find($request->id)->delete();
                return response()->json($event);
            }
            if ($request->type == 'details'){
                $event = '';
                $appointment = Appointment::where('id',$request->id)->first();
                $lawyer = User::where('id',$appointment->lawyer_id)->first();
                $user = User::where('id',$appointment->user_id)->first();
                $booking = Booking::where('appointment_id',$appointment->id)->first();
                if ($appointment && $lawyer && $user &&$booking ){
                    $event = [
                        'status'=>$appointment->title,
                        'start'=>$appointment->start,
                        'end'=>$appointment->end,
                        'color'=>$appointment->color,
                        'lawyer'=>$lawyer->name,
                        'user'=>$user->name,
                        'subject'=>$booking->subject,
                        'details'=>$booking->details
                    ];
                    return response()->json($event);
                }elseif($appointment && $lawyer){
                    $event= [
                        'status'=>$appointment->title,
                        'start'=>$appointment->start,
                        'end'=>$appointment->end,
                        'color'=>$appointment->color,
                        'lawyer'=>$lawyer->name,
                        'user'=>'',
                        'subject'=>'',
                        'details'=>''
                    ];
                    return response($event);
                }
            }
        }
    }
}
