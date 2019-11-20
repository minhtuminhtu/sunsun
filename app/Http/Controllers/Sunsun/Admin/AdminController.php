<?php

namespace App\Http\Controllers\Sunsun\Admin;

use App\Http\Controllers\Controller;
use App\Models\Yoyaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MsKubun;
use App\Http\Controllers\Sunsun\Front\BookingController;

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

        $data['data_date'] = Yoyaku::where('service_date_start',$date)->get();
        $data['pick_up'] = $data['data_date']->where('pick_up','01');
        $data['lunch'] = $data['data_date']->where('lunch','02');
        $data['kubun'] = MsKubun::where('kubun_type', '013')->get();

        $time_value = $this->get_time_value_array();

        $data['time_range'] = config('const.time_admin');
        // $data['time_data'] = DB::table('tr_yoyaku')
        //     ->select(['email as title', 'service_date_start as start', 'service_date_start as end'])
        //     ->whereYear('service_date_start',2019)
        //     ->whereMonth('service_date_start',11)
        //     ->get();

        
        // $time_data = DB::table('tr_yoyaku')
        //     ->select(['booking_id', 'service_time_1 as time1', 'service_time_2 as time2'])
        //     ->where('course','01')
        //     ->get();
              
        

        $this->set_course($data, $date, $time_value);
        $this->set_stay_room($data, $date);
        $this->set_lunch($data, $date);
        $this->set_pick_up($data, $date);
        
        
        // dd($data);

        return view('sunsun.admin.day',$data);
    }




    private function set_stay_room(&$data, $date){
        $stay_room_raw = DB::select("
        SELECT	main.name,
				main.stay_room_type,
                main.stay_guest_num,
                main.breakfast
        FROM		tr_yoyaku as main
        WHERE 	main.stay_room_type <> '01' AND main.stay_room_type IS NOT NULL AND main.stay_checkin_date <= $date AND main.stay_checkout_date >= $date
        ");
        
        for($i = 0; $i < count($stay_room_raw); $i++){
            $stay_room = MsKubun::where('kubun_type','012')->where('kubun_id', $stay_room_raw[$i]->stay_guest_num)->first();
            $stay_room_raw[$i]->stay_guest_num = $stay_room->kubun_value;

            if($stay_room_raw[$i]->breakfast != '01'){
                $stay_room_raw[$i]->breakfast = preg_replace('/[^0-9]+/', '', $stay_room_raw[$i]->stay_guest_num);
            }else{
                $stay_room_raw[$i]->breakfast = NULL;
            }
        }
        $collect_stay_room = collect($stay_room_raw);
        $data['stay_room']['A'] =  $collect_stay_room->firstWhere('stay_room_type', '02');
        $data['stay_room']['B'] =  $collect_stay_room->firstWhere('stay_room_type', '03');
        $data['stay_room']['C'] =  $collect_stay_room->firstWhere('stay_room_type', '04');

        // dd($stay_room_raw);
    }

    private function set_lunch(&$data, $date){
        $data['lunch'] = DB::select("
        SELECT	main.name,
                main.lunch,
                main.ref_booking_id,
				main.lunch_guest_num
        FROM	tr_yoyaku as main
        WHERE   (main.lunch <> '01' OR main.lunch_guest_num <> '01') AND main.service_date_start = $date
        ");

        for($i = 0; $i < count($data['lunch']); $i++){
            if($data['lunch'][$i]->lunch_guest_num != NULL){
                $lunch_guest_num = MsKubun::where('kubun_type','023')->where('kubun_id', $data['lunch'][$i]->lunch_guest_num)->first();
                $data['lunch'][$i]->lunch = preg_replace('/[^0-9]+/', '', $lunch_guest_num->kubun_value);
            }
        }
        // dd($data['lunch']);
    }

    private function set_pick_up(&$data, $date){
        $data['pick_up'] = DB::select("
        SELECT 	main.booking_id,
                main.bus_arrive_time_slide,
                main.name,
                main.service_guest_num,
                cou.num_user
        FROM 	tr_yoyaku main
        LEFT JOIN (
        SELECT	tr_yoyaku.ref_booking_id,
                COUNT(*) as num_user
        FROM	tr_yoyaku
        WHERE tr_yoyaku.ref_booking_id IS NOT NULL
        GROUP BY tr_yoyaku.ref_booking_id
        ) cou ON cou.ref_booking_id = main.booking_id
        WHERE main.transport = '02' AND main.ref_booking_id IS NULL AND main.pick_up = '01' AND main.service_date_start = $date
        ORDER BY main.bus_arrive_time_slide
        ");
        for($i = 0; $i < count($data['pick_up']); $i++){
            $bus_slide = MsKubun::where('kubun_type','003')->where('kubun_id', $data['pick_up'][$i]->bus_arrive_time_slide)->first();
            $data['pick_up'][$i]->bus_arrive_time_slide = ltrim(explode("着", $bus_slide->kubun_value)[0], '0');

            if($data['pick_up'][$i]->service_guest_num != NULL){
                $service_guest_num = MsKubun::where('kubun_type','015')->where('kubun_id', $data['pick_up'][$i]->service_guest_num)->first();
                $data['pick_up'][$i]->num_user = preg_replace('/[^0-9]+/', '', $service_guest_num->kubun_value);
            }
        }
    }
    private function set_course(&$data, $date, $time_value){
        
        $course_1_to_4_query = DB::select("
        (
            SELECT	main.booking_id
                  , main.ref_booking_id
                  , main.repeat_user
                  , main.course
                  , main.gender
                  , main.age_value
                  , main.name
                  , main.transport
                  , main.bus_arrive_time_slide
                  , main.pick_up
                  , main.lunch
                  , main.whitening
                  , main.pet_keeping
                  , main.stay_room_type
                  , main.phone
                  , main.payment_method
                  , time.service_date
                  , time.service_time_1 as time
                  , SUBSTRING(time.notes, 1, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '01'  AND time.service_date = $date
        )
        UNION
        (
            SELECT	main.booking_id
					, main.ref_booking_id
                    , main.repeat_user
                    , main.course
                    , main.gender
                    , main.age_value
                    , main.name
                    , main.transport
                    , main.bus_arrive_time_slide
                    , main.pick_up
                    , main.lunch
                    , main.whitening
                    , main.pet_keeping
                    , main.stay_room_type
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    , main.service_time_1 as time
                    , SUBSTRING(main.bed, 1, 1) as bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '02' AND main.service_date_start = $date
        )
        UNION
        (
            SELECT	main.booking_id
					, main.ref_booking_id
                    , main.repeat_user
                    , main.course
                    , main.gender
                    , main.age_value
                    , main.name
                    , main.transport
                    , main.bus_arrive_time_slide
                    , main.pick_up
                    , main.lunch
                    , main.whitening
                    , main.pet_keeping
                    , main.stay_room_type
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    , main.service_time_2 as time
                    , SUBSTRING(main.bed, 3, 1) as bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '02' AND main.service_date_start = $date
        )
        UNION
        (
            SELECT	main.booking_id
					, main.ref_booking_id
                    , main.repeat_user
                    , main.course
                    , '01' AS gender
                    , main.age_value
                    , main.name
                    , main.transport
                    , main.bus_arrive_time_slide
                    , main.pick_up
                    , main.lunch
                    , main.whitening
                    , main.pet_keeping
                    , main.stay_room_type
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    , main.service_time_1 as time
                    , main.bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '03' AND main.service_date_start = $date
        )
        UNION
        (
            SELECT	main.booking_id
                  , main.ref_booking_id
                  , main.repeat_user
                  , main.course
                  , main.gender
                  , main.age_value
                  , main.name
                  , main.transport
                  , main.bus_arrive_time_slide
                  , main.pick_up
                  , main.lunch
                  , main.whitening
                  , main.pet_keeping
                  , main.stay_room_type
                  , main.phone
                  , main.payment_method
                  , time.service_date
                  , time.service_time_1 as time
                  , SUBSTRING(time.notes, 1, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '04'  AND time.service_date = $date
        )
        UNION
        (
            SELECT	main.booking_id
                  , main.ref_booking_id
                  , main.repeat_user
                  , main.course
                  , main.gender
                  , main.age_value
                  , main.name
                  , main.transport
                  , main.bus_arrive_time_slide
                  , main.pick_up
                  , main.lunch
                  , main.whitening
                  , main.pet_keeping
                  , main.stay_room_type
                  , main.phone
                  , main.payment_method
                  , time.service_date
                  , time.service_time_2 as time
                  , SUBSTRING(time.notes, 3, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '04'  AND time.service_date = $date
        )
        ");
        $course_1_to_4 = collect($course_1_to_4_query);

        // dd( $course_1_to_4);

        for($i = 0; $i < count($course_1_to_4); $i++){
            switch($course_1_to_4[$i]->course){
                case '01': $course_1_to_4[$i]->course = '入浴'; break;
                case '02': $course_1_to_4[$i]->course = 'リ'; break;
                case '03': $course_1_to_4[$i]->course = '貸切'; break;
                case '04': $course_1_to_4[$i]->course = '断食'; break;
            }
            switch($course_1_to_4[$i]->repeat_user){
                case '01': $course_1_to_4[$i]->repeat_user = '新規'; break;
                case '02': $course_1_to_4[$i]->repeat_user = NULL; break;
            }
            switch($course_1_to_4[$i]->gender){
                case '01': $course_1_to_4[$i]->gender = '男性'; break;
                case '02': $course_1_to_4[$i]->gender = '女性'; break;
            }
            switch($course_1_to_4[$i]->transport){
                case '01': {
                    $course_1_to_4[$i]->transport = '自動車';
                    $course_1_to_4[$i]->bus_arrive_time_slide = NULL;
                    $course_1_to_4[$i]->pick_up = NULL;
                    break;
                } 
                case '02': {
                    $course_1_to_4[$i]->transport = 'バス';
                    $bus_slide = MsKubun::where('kubun_type','003')->where('kubun_id',$course_1_to_4[$i]->bus_arrive_time_slide)->first();
                    $course_1_to_4[$i]->bus_arrive_time_slide = ltrim(explode("着", $bus_slide->kubun_value)[0], '0')."着";
                    switch($course_1_to_4[$i]->pick_up){
                        case '01': $course_1_to_4[$i]->pick_up = '送迎有'; break;
                        case '02': $course_1_to_4[$i]->pick_up = NULL; break;
                    }    
                    break;
                }
            }
            
            switch($course_1_to_4[$i]->lunch){
                case '01': $course_1_to_4[$i]->lunch = NULL; break;
                case '02': $course_1_to_4[$i]->lunch = '昼食'; break;
            }
            switch($course_1_to_4[$i]->lunch){
                case '01': $course_1_to_4[$i]->lunch = NULL; break;
                case '02': $course_1_to_4[$i]->lunch = '昼食'; break;
            }
            switch($course_1_to_4[$i]->pet_keeping){
                case '01': $course_1_to_4[$i]->pet_keeping = NULL; break;
                case '02': $course_1_to_4[$i]->pet_keeping = 'ﾍﾟｯﾄ預かり'; break;
            }
            switch($course_1_to_4[$i]->stay_room_type){
                case '01': $course_1_to_4[$i]->stay_room_type = NULL; break;
                default: $course_1_to_4[$i]->stay_room_type = '宿泊'; break;
            }
            switch($course_1_to_4[$i]->payment_method){
                case '1': $course_1_to_4[$i]->payment_method = 'クレカ'; break;
                case '2': $course_1_to_4[$i]->payment_method = '現金'; break;
                case '3': $course_1_to_4[$i]->payment_method = '回数券'; break;
            }
        }

        $course_5_query = DB::select("
            SELECT	main.booking_id
                    , main.ref_booking_id
                    , main.repeat_user
                    , main.course
                    , main.age_value
                    , main.name
                    , main.transport
                    , main.bus_arrive_time_slide
                    , main.pick_up
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    ,CONCAT(main.service_time_1, '-', main.service_time_2) as time
            FROM		tr_yoyaku as main
            WHERE 	main.course = '05' AND main.service_date_start = $date
        ");
        $course_5 = collect($course_5_query);
        for($i = 0; $i < count($course_5); $i++){
            switch($course_5[$i]->transport){
                case '01': {
                    $course_5[$i]->transport = '自動車';
                    $course_5[$i]->bus_arrive_time_slide = NULL;
                    $course_5[$i]->pick_up = NULL;
                    break;
                } 
                case '02': {
                    $course_5[$i]->transport = 'バス';
                    $bus_slide = MsKubun::where('kubun_type','003')->where('kubun_id',$course_5[$i]->bus_arrive_time_slide)->first();
                    $course_5[$i]->bus_arrive_time_slide = ltrim(explode("着", $bus_slide->kubun_value)[0], '0')."着";
                    switch($course_5[$i]->pick_up){
                        case '01': $course_5[$i]->pick_up = '送迎有'; break;
                        case '02': $course_5[$i]->pick_up = NULL; break;
                    }    
                    break;
                }
            }
            switch($course_5[$i]->payment_method){
                case '1': $course_5[$i]->payment_method = 'クレカ'; break;
                case '2': $course_5[$i]->payment_method = '現金'; break;
                case '3': $course_5[$i]->payment_method = '回数券'; break;
            }
        }

        $course_wt_query = DB::select("
            SELECT	main.booking_id
                    , main.ref_booking_id
                    , main.repeat_user
                    , main.course
                    , main.age_value
                    , main.name
                    , main.transport
                    , main.bus_arrive_time_slide
                    , main.pick_up
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    , main.whitening_time as time
            FROM	tr_yoyaku as main
            WHERE 	main.service_date_start = $date
        ");
        $course_wt = collect($course_wt_query);
        for($i = 0; $i < count($course_wt); $i++){
            switch($course_wt[$i]->transport){
                case '01': {
                    $course_wt[$i]->transport = '自動車';
                    $course_wt[$i]->bus_arrive_time_slide = NULL;
                    $course_wt[$i]->pick_up = NULL;
                    break;
                } 
                case '02': {
                    $course_wt[$i]->transport = 'バス';
                    $bus_slide = MsKubun::where('kubun_type','003')->where('kubun_id',$course_wt[$i]->bus_arrive_time_slide)->first();
                    $course_wt[$i]->bus_arrive_time_slide = ltrim(explode("着", $bus_slide->kubun_value)[0], '0')."着";
                    switch($course_wt[$i]->pick_up){
                        case '01': $course_wt[$i]->pick_up = '送迎有'; break;
                        case '02': $course_wt[$i]->pick_up = NULL; break;
                    }    
                    break;
                }
            }
            switch($course_wt[$i]->payment_method){
                case '1': $course_wt[$i]->payment_method = 'クレカ'; break;
                case '2': $course_wt[$i]->payment_method = '現金'; break;
                case '3': $course_wt[$i]->payment_method = '回数券'; break;
            }
        }

        

        for($i = 0; $i < count($time_value) ; $i++){
            $data['time_range'][$i]['data']['male_1'] = $course_1_to_4->where('time',  $data['time_range'][$i]['time_value'])->where('gender', '男性')->firstWhere('bed', '1');
            $data['time_range'][$i]['data']['male_2'] = $course_1_to_4->where('time',  $data['time_range'][$i]['time_value'])->where('gender', '男性')->firstWhere('bed', '2');
            $data['time_range'][$i]['data']['male_3'] = $course_1_to_4->where('time',  $data['time_range'][$i]['time_value'])->where('gender', '男性')->firstWhere('bed', '3');
            $data['time_range'][$i]['data']['female_1'] = $course_1_to_4->where('time',  $data['time_range'][$i]['time_value'])->where('gender', '女性')->firstWhere('bed', '1');
            $data['time_range'][$i]['data']['female_2'] = $course_1_to_4->where('time',  $data['time_range'][$i]['time_value'])->where('gender', '女性')->firstWhere('bed', '2');
            $data['time_range'][$i]['data']['female_3'] = $course_1_to_4->where('time',  $data['time_range'][$i]['time_value'])->where('gender', '女性')->firstWhere('bed', '3');
            $data['time_range'][$i]['data']['female_4'] = $course_1_to_4->where('time',  $data['time_range'][$i]['time_value'])->where('gender', '女性')->firstWhere('bed', '4');

            $data['time_range'][$i]['data']['pet'] = $course_5->firstWhere('time',   $data['time_range'][$i]['other_time_value']);
            $data['time_range'][$i]['data']['wt'] = $course_wt->firstWhere('time',   $data['time_range'][$i]['other_time_value']);
            
        }




        // dd($data['time_range']);
    } 
    private function get_time_value_array(){
        $time_range = config('const.time_admin');
        $time_value = [];
        foreach($time_range as $time){
            $time_value[] = $time['time_value'];
        }
        return $time_value;
    }

    public function edit_booking (Request $request) {
        $data = $request->all();
        $booking = new BookingController();
        $booking->fetch_kubun_data($data);
        return view('sunsun.admin.parts.booking',$data)->render();
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

        $data['day_range'] = $this->get_list_days($data['date_from'], $data['date_to']);



        $data['time_range'] = config('const.time_admin');
        // dd($data);






        $data['data_date'] = DB::table('tr_yoyaku')->where([['service_date_start','>=',$date_from_sql],['service_date_start','<=',$date_to_sql]])->get();
        return view('sunsun.admin.weekly',$data);
    }

    private function get_list_days($from , $to){
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $dates = [];
        for($d = $from; $d->lte($to); $d->addDay()) {
            $dates[$d->format('Ymd')]['full_date'] = $d->format('Ymd');
            $dates[$d->format('Ymd')]['day'] = ltrim($d->format('d'), "0");
            $dates[$d->format('Ymd')]['week_day'] = $this->get_week_day($d->format('Y/m/d'));
            
        }
        return array_values($dates);
    }
    private function get_week_day($day){
        $weekMap = [
            0 => '日',
            1 => '月',
            2 => '火',
            3 => '水',
            4 => '木',
            5 => '金',
            6 => '土',
        ];
        $day_of_week = Carbon::parse($day)->dayOfWeek;
        return $weekMap[$day_of_week];
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

        // $number_month_day = date("t",mktime(0,0,0,$month,1,$year)); 
        // for($i = 1; $i <= $number_month_day; $i++){
        //     $month = sprintf("%02d", $month);
        //     $day = sprintf("%02d", $i);
        //     $data['month']['number_first_day'] = 
        //     $data['month']['number_week'] = $this->week_of_month(\DateTime::createFromFormat('m/Y', $month . "/" .$year), $number_month_day);
        //     $data['day'][$year.$month.$day]['day'] = $year.$month.$day;
        //     $data['day'][$year.$month.$day]['weekday'] = date('w', strtotime($year . "/" . $month . "/" . $day));
        // }

        

        $data['week'] = $this->get_month($month,$year);
        for($i = 0 ; $i < count($data['week']); $i++){
            $data['week_range'][$i] = $this->get_list_dates($data['week'][$i]['start'], $data['week'][$i]['end'], $month);
        } 
        return view('sunsun.admin.monthly',['data' => $data, 'month' => $month, 'year' => $year]);
    }


    private function get_list_dates($from , $to, $month){
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $dates = [];
        for($d = $from; $d->lte($to); $d->addDay()) {
            if($d->format('m') == $month){
                $dates[$d->format('Ymd')]['full_date'] = $d->format('Ymd');
                $dates[$d->format('Ymd')]['day'] = ltrim($d->format('d'), "0");
            }else{
                $dates[$d->format('Ymd')]['full_date'] = NULL;
            }
            
        }
        return array_values($dates);
    }

    

    private function get_month ($month, $year){
        $date = Carbon::createFromDate($year,$month);
        $data = [];
        for ($i=1; $i <= $date->daysInMonth ; $i++) {
            Carbon::createFromDate($year,$month,$i);
            $week_num = Carbon::createFromDate($year,$month,$i)->format('W');
            $data[$week_num]['start']= Carbon::createFromDate($year,$month,$i)->startOfWeek()->format('Y/m/d');
            $data[$week_num]['end']= Carbon::createFromDate($year,$month,$i)->endOfweek()->format('Y/m/d');
        }
        return array_values($data);
    }
    public function setting() {
        $data = config('const.db.kubun_type');
        return view('sunsun.admin.setting',['data' => $data]);
    }
    public function get_setting_type(Request $request) {
        $data = $request->all();
        $MsKubun = MsKubun::all();
        $data['kubun_type'] = $MsKubun->where('kubun_type',$data['kubun_type'])->sortBy('sort_no');
        return view('sunsun.admin.parts.setting_type',$data)->render();
    }
    public function get_setting_kubun_type(Request $request) {
        $data = $request->all();
        if($data['new'] == 0){
            $MsKubun = MsKubun::all();
            $data['kubun_id'] = $MsKubun->where('kubun_type',$data['kubun_type'])->where('kubun_id',$data['kubun_id']);
        }
        // dd($data);
        return view('sunsun.admin.parts.setting_kubun_type',$data)->render();
    }

    public function update_setting_sort_no(Request $request) {

        $data = $request->all();
        // dd($data);
        if($data['type'] == 'up'){
            MsKubun::where('kubun_type',$data['kubun_type'])->where('sort_no', $data['sort_no'])->update(['sort_no' =>'-1']);
            MsKubun::where('kubun_type',$data['kubun_type'])->where('sort_no', $data['sort_no'] - 1)->update(['sort_no' =>$data['sort_no']]);
            MsKubun::where('kubun_type',$data['kubun_type'])->where('sort_no', '-1')->update(['sort_no' =>$data['sort_no'] -1]);
        }else{
            MsKubun::where('kubun_type',$data['kubun_type'])->where('sort_no', $data['sort_no'])->update(['sort_no' =>'-1']);
            MsKubun::where('kubun_type',$data['kubun_type'])->where('sort_no', $data['sort_no'] + 1)->update(['sort_no' =>$data['sort_no']]);
            MsKubun::where('kubun_type',$data['kubun_type'])->where('sort_no', '-1')->update(['sort_no' =>$data['sort_no'] +1]);
        }
    }
    public function update_setting_kubun_type(Request $request) {
        $data = $request->all();

        $notes = NULL;
        if(($data['kubun_type'] == '013') || ($data['kubun_type'] == '012')){
            $notes = preg_replace('/[^0-9]/', '', $data['kubun_value']);
        }elseif($data['kubun_type'] == '014'){
            $temp = preg_replace('/[^0-9]/', '', $data['kubun_value']);
            $notes = substr($temp,0,4)."-".substr($temp,4,8);
        }elseif($data['kubun_type'] == '003'){
            $str = explode(":",$data['kubun_value']);
            $temp = sprintf('%02d', preg_replace('/[^0-9]/', '',$str[0]) );
            $temp1 = sprintf('%02d', preg_replace('/[^0-9]/', '',$str[1]) );

            $notes = $temp.$temp1;
        }


        if((strlen($data['kubun_id']) == 0 )  || (strlen($data['kubun_id']) > 2 ) || (strlen($data['kubun_value']) == 0 ) || (strlen($data['kubun_value']) > 255 )){
            return response()->json([
                    'msg' => "length error!",
                ], 400);
        }


        if($data['new'] == 1){
            if (MsKubun::where('kubun_type', $data['kubun_type'])->where('kubun_id', $data['kubun_id'])->count() > 0) {
                return response()->json([
                    'msg' => "kubun_id exist!",
                ], 400);
            }
            $MsKubun = MsKubun::create(['kubun_type' => $data['kubun_type'],'kubun_id' => $data['kubun_id'], 'kubun_value' => $data['kubun_value'],'sort_no' => $data['sort_no'], 'notes'=> $notes]);
        }else{
            MsKubun::where('kubun_type', $data['kubun_type'])->where('kubun_id', $data['kubun_id'])->update(['kubun_value' => $data['kubun_value'], 'notes'=> $notes]);
        }
    }
    public function delete_setting_kubun_type(Request $request) {
        $data = $request->all();
        foreach ($data['arr_delete'] as $value) {
            MsKubun::where('kubun_type', $data['kubun_type'])->where('kubun_id', $value)->delete();
        }
        return response()->json([
                'msg' => 'success',
            ], 200);
    }

}
