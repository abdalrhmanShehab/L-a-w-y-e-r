<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
        $username = Auth::user()->name;
        $page = 'Appointments';

        if ($request->ajax()){
            $data = Appointment::whereDate('start', '>=', $request->start)
                                ->whereDate('end', '<=' , $request->end)
                                ->get(['id','title','start','end','user_id','lawyer_id']);
            return response()->json($data);
        }

        return view('appointments.index')->with(['username'=>$username,'page'=>$page]);
    }

   public function action(Request $request)
   {
       if ($request->ajax()){
           if ($request->type == 'add')
           {
               $event = Appointment::create([
                   'title'=>$request->title,
                   'start'=>$request->start,
                   'end'=>$request->end,
                   'lawyer_id'=>Auth::id(),
                   'user_id'=>null
               ]);
               return response()->json($event);
           }
           if ($request->type == 'update')
           {
               $event = Appointment::find($request->id)->update([
                   'title'=>$request->title,
                   'start'=>$request->start,
                   'end'=>$request->end,
               ]);
               return response()->json($event);
           }
           if ($request->type == 'delete')
           {
               $event = Appointment::find($request->id)->delete();
               return response()->json($event);
           }
       }
   }
}
