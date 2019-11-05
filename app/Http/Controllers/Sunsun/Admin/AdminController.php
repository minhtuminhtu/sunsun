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

    public function monthly(Request $request) {
        $data = [];
        if ($request->has('date') && $request->date != '') {
            $month = substr($request->date,4);
            $year = substr($request->date,0,4);
            $datetime = Carbon::createFromDate($year, $month, 1);
            $data['date'] =  $datetime->format('Y/m');
            $date = $datetime->format('Ym');

        } else {
            $time_now = Carbon::now();
            $data['date'] =  $time_now->format('Y/m');
            $date = $time_now->format('Ym');
        }
        $year = substr($date,0,4);
        $month = substr($date,4);

        $data['data_date'] = DB::table('tr_yoyaku')
            ->select(['email as title', 'service_date_start as start', 'service_date_start as end'])
            ->whereYear('service_date_start',$year)
            ->whereMonth('service_date_start',$month)
            ->get()
            /*->groupBy(function($date) {
                return Carbon::parse($date->service_date_start)->format('W');
            })*/;
        //$num_weeks = $this->get_month($month, $year);
        //dd($data['data_date']->all());
        return view('sunsun.admin.monthly',$data);
    }

    private function get_month ($month, $year){
        $date = Carbon::createFromDate($year,$month);
        $data = [];
        for ($i=1; $i <= $date->daysInMonth ; $i++) {
            Carbon::createFromDate($year,$month,$i);
            $week_num = Carbon::createFromDate($year,$month,$i)->format('W');
            $data[$week_num]['start']= (array)Carbon::createFromDate($year,$month,$i)->startOfWeek()->toDateString();
            $data[$week_num]['end']= (array)Carbon::createFromDate($year,$month,$i)->endOfweek()->toDateString();
            $i+=7;
        }
        return $data;
    }
}
