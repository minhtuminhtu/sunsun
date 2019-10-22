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
        $data = $request->all();
        $room_time_data = config('data_tmp.time_room');
        return view('sunsun.front.parts.booking_time',
            [
                'data' => $data,
                'room_time_data' => $room_time_data
            ])
            ->render();
    }

    public function book_room (Request $request) {
        $data = $request->all();
        $room_data = config('data_tmp.room');
        return view('sunsun.front.parts.booking_room',
            [
                'data' => $data,
                'room_data' => $room_data
            ])
            ->render();
    }

    public function book_time_room_pet (Request $request) {
        $data = $request->all();
        $room_pet = config('data_tmp.room_pet');
        return view('sunsun.front.parts.booking_room_pet',
            [
                'data' => $data,
                'room_pet' => $room_pet
            ])
            ->render();
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
