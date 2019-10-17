<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        return view('sunsun.front.booking.index');
    }

    public function confirm(){

        return view('sunsun.front.confirm',['data' => 1]);

    }
}
