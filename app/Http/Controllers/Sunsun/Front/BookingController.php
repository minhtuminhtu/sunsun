<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        return view('sunsun.front.booking.index');
    }

    public function booking(Request $request){
        $data = $request->all();
        // dd($data);
        return view('sunsun.front.booking',['data' => $data]);

    }

    public function confirm(Request $request){
        $data = $request->all();
        // dd($data);
        return view('sunsun.front.confirm',['data' => $data]);

    }

    public function payment(Request $request){
        $data = $request->all();
        // dd($data);
        return view('sunsun.front.payment',['data' => $data]);
    }

    public function get_time_room(Request $request){
        return view('sunsun.front.parts.booking_time')->render();
    }

    public function get_service(Request $request){
        $data = $request->all();
        if ($data['service'] == config('booking.services.options.normal')) {
            return view('sunsun.front.parts.enzyme_bath')->render();
        } elseif ($data['service'] == config('booking.services.options.day')) {
            return view('sunsun.front.parts.oneday_bath')->render();
        } elseif ($data['service'] == config('booking.services.options.eat')) {
            return view('sunsun.front.parts.enzyme_room_bath')->render();
        } elseif ($data['service'] == config('booking.services.options.no')) {
            return view('sunsun.front.parts.fasting_plan')->render();
        } elseif ($data['service'] == config('booking.services.options.pet')) {
            return view('sunsun.front.parts.pet_enzyme_bath')->render();
        }
    }
}
