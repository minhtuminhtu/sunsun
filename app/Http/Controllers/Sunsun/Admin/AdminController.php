<?php

namespace App\Http\Controllers\Sunsun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function day(Request $request) {
        $data = [];
        if ($request->has('date') && $request->date != '') {
            $datetime = new Carbon($request->date);
            $data['date'] =  $datetime->format('Y/m/d');
            $date = $datetime->format('Ymd');
        } else {
            $time_now = Carbon::now();
            $data['date'] =  $time_now->format('Y/m/d');
            $date = $time_now->format('Ymd');
        }

        $data['data_date'] = DB::table('tr_yoyaku')->where('service_date_start',$date)->get();
        $data['pick_up'] = $data['data_date']->where('pick_up','01');
        $data['lunch'] = $data['data_date']->where('lunch','02');
        return view('sunsun.admin.day',$data);
    }

    public function weekly(Request $request) {
        $data = [];
        if ($request->has('date_from') && $request->has('date_to') && $request->date_from != '' && $request->date_to != '') {
            $date_from = new Carbon($request->date_from);
            $date_to = new Carbon($request->date_to);
            $data['date_from'] =  $date_from->format('Y/m/d');
            $data['date_to'] =  $date_to->format('Y/m/d');
            $date_from_sql = $date_from->format('Ymd');
            $date_to_sql = $date_to->format('Ymd');
        } else {
            $time_now = Carbon::now();
            $data['date_from'] =  $time_now->startOfWeek()->format('Y/m/d');
            $data['date_to'] =  $time_now->endOfWeek()->format('Y/m/d');
            $date_from_sql = $time_now->startOfWeek()->format('Ymd');
            $date_to_sql = $time_now->endOfWeek()->format('Ymd');
        }
        $data['data_date'] = DB::table('tr_yoyaku')->where([['service_date_start','>=',$date_from_sql],['service_date_start','<=',$date_to_sql]])->get();
        return view('sunsun.admin.weekly',$data);
    }

    public function monthly() {
        return view('sunsun.admin.monthly');
    }
}
