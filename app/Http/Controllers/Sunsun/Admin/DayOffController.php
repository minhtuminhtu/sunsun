<?php

namespace App\Http\Controllers\Sunsun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayOffController extends Controller
{
    public function Create(Request $request)
    {
        return view('sunsun.admin.day_off');
    }

    public function Submit(Request $request)
    {
        dd('hanlde code submit');
    }
}