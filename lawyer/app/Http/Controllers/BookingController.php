<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index(){
        return view('Dashboard_user.appointments');
    }

    public function allData(){
        $data = User::role('lawyer')->get();
        return response()->json($data);
    }

    public function getBookingLawyer($id){
        $data = Appointment::where('lawyer_id',$id)->whereDate('end','>=',Carbon::now())->where('title','available')->get();
        return response()->json($data);
    }
    public function getBooking($id){

        $data = Appointment::findOrFail($id);
        return response()->json($data);
    }

    public function Booking(BookingRequest $request){
        $data1 = Booking::create([
           'subject' => $request->subject,
            'details'=>$request->details,
            'appointment_id'=>$request->id
        ]);
        Appointment::findOrFail($request->id)->update([
            'title'=>'Booking',
            'user_id'=>Auth::id(),
            'color'=>'#FF6347'
        ]);
        $lawyer = Appointment::findOrFail($request->id);
           $data =[
               'subject' => $data1->subject,
               'details'=>$data1->details,
               'appointment_id'=>$data1->id,
               'lawyer_id'=>$lawyer->lawyer_id
        ];
        return response()->json($data);
    }

    public function addData(Request $request){

        $data = Appointment::insert([
            'name'=>$request->name,
            'subject'=>$request->subject,
            'created_at'=>Carbon::now('l')
        ]);
        return response()->json($data);
    }

    public function editData($id){
        $data = Appointment::findOrFail($id);
        return response()->json($data);
    }

    public function updateData(Request $request ,$id){


        $data = Appointment::findOrFail($id)->update([
            'name'=>$request->name,
            'subject'=>$request->subject,
        ]);

        return response()->json($data);
    }

    public function deleteData($id){
        $data = Appointment::findOrFail($id)->delete();
        return response()->json($data);
    }
}
