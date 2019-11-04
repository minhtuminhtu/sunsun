<?php

namespace App\Http\Controllers\Sunsun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function day() {
        return view('sunsun.admin.day');
    }

    public function weekly() {
        return view('sunsun.admin.weekly');
    }

    public function monthly() {
        return view('sunsun.admin.monthly');
    }
    public function setting() {
        return view('sunsun.admin.setting');
    }
}
