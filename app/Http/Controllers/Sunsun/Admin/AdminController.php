<?php

namespace App\Http\Controllers\Sunsun\Admin;

use App\Http\Controllers\Controller;
use App\Models\Yoyaku;
use App\Models\YoyakuDanjikiJikan;
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
        WHERE 	main.stay_room_type <> '01' 
        AND main.stay_room_type IS NOT NULL 
        AND main.stay_checkin_date <= $date 
        AND main.stay_checkout_date >= $date
        AND main.history_id IS NULL 
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
        WHERE   (main.lunch <> '01' OR main.lunch_guest_num <> '01') 
        AND main.service_date_start = $date
        AND main.history_id IS NULL 
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
        WHERE main.transport = '02' 
        AND main.ref_booking_id IS NULL 
        AND main.pick_up = '01' 
        AND main.service_date_start = $date
        AND main.history_id IS NULL 
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
                  , main.lunch_guest_num
                  , main.whitening
                  , main.pet_keeping
                  , main.stay_room_type
                  , main.stay_guest_num
                  , main.breakfast
                  , main.phone
                  , main.payment_method
                  , time.service_date
                  , time.service_time_1 as time
                  , 0 as turn
                  , SUBSTRING(time.notes, 1, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '01'  AND main.history_id IS NULL AND time.service_date = $date
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
                    , main.lunch_guest_num
                    , main.whitening
                    , main.pet_keeping
                    , main.stay_room_type
                    , main.stay_guest_num
                    , main.breakfast
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    , main.service_time_1 as time
                    , 1 as turn
                    , SUBSTRING(main.bed, 1, 1) as bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '02' AND main.history_id IS NULL AND main.service_date_start = $date
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
                    , NULL as transport
                    , NULL as bus_arrive_time_slide
                    , NULL as pick_up
                    , NULL as lunch
                    , main.lunch_guest_num
                    , NULL as whitening
                    , NULL as pet_keeping
                    , NULL as stay_room_type
                    , main.stay_guest_num
                    , NULL as breakfast
                    , NULL as phone
                    , NULL as payment_method
                    , main.service_date_start
                    , main.service_time_2 as time
                    , 2 as turn
                    , SUBSTRING(main.bed, 3, 1) as bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '02' AND main.history_id IS NULL AND main.service_date_start = $date
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
                    , main.lunch_guest_num
                    , main.whitening
                    , main.pet_keeping
                    , main.stay_room_type
                    , main.stay_guest_num
                    , main.breakfast
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    , main.service_time_1 as time
                    , 0 as turn
                    , main.bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '03' AND main.history_id IS NULL AND main.service_date_start = $date
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
                  , main.lunch_guest_num
                  , main.whitening
                  , main.pet_keeping
                  , main.stay_room_type
                  , main.stay_guest_num
                  , main.breakfast
                  , main.phone
                  , main.payment_method
                  , time.service_date
                  , time.service_time_1 as time
                  , 1 as turn
                  , SUBSTRING(time.notes, 1, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '04'  AND main.history_id IS NULL AND time.service_date = $date
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
                  , NULL as transport
                  , NULL as bus_arrive_time_slide
                  , NULL as pick_up
                  , NULL as lunch
                  , main.lunch_guest_num
                  , NULL as whitening
                  , NULL as pet_keeping
                  , NULL as stay_room_type
                  , main.stay_guest_num
                  , NULL as breakfast
                  , NULL as phone
                  , NULL as payment_method
                  , time.service_date
                  , time.service_time_2 as time
                  , 2 as turn
                  , SUBSTRING(time.notes, 3, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '04'  AND main.history_id IS NULL AND time.service_date = $date
        )
        ");
        $course_1_to_4 = collect($course_1_to_4_query);
        $course_1_unique_id = $course_1_to_4->where('course', '01')->unique('booking_id');

        foreach($course_1_unique_id as $c_1_u_id){
            $temp_set_turn = $course_1_to_4->where('booking_id', $c_1_u_id->booking_id);
            $turn = 1;
            foreach($temp_set_turn as $temp){
                if($turn == 1){
                    $temp->turn = 0;
                }else{
                    $temp->turn = $turn;
                    $temp->transport = NULL;
                    $temp->bus_arrive_time_slide = NULL;
                    $temp->pick_up = NULL; 
                    $temp->lunch = NULL; 
                    $temp->whitening = NULL;
                    $temp->pet_keeping = NULL;
                    $temp->stay_room_type = NULL;
                    $temp->breakfast = NULL;
                    $temp->phone = NULL;
                    $temp->payment_method = NULL;
                }
                $turn++;
            }
            
        }
        
        // dd($course_1_to_4);

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
                    $course_1_to_4[$i]->transport = '車';
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

            if(((isset($course_1_to_4[$i]->lunch)) && ($course_1_to_4[$i]->lunch != '01')) || ((isset($course_1_to_4[$i]->lunch_guest_num)) && ($course_1_to_4[$i]->lunch_guest_num != '01'))){
                $course_1_to_4[$i]->lunch = '昼食';
            }else{
                $course_1_to_4[$i]->lunch = NULL;
            }
            
            switch($course_1_to_4[$i]->whitening){
                case '01': $course_1_to_4[$i]->whitening = NULL; break;
                case '02': $course_1_to_4[$i]->whitening = '歯白'; break;
            }
            switch($course_1_to_4[$i]->pet_keeping){
                case '01': $course_1_to_4[$i]->pet_keeping = NULL; break;
                case '02': $course_1_to_4[$i]->pet_keeping = 'Pet'; break;
            }
            switch($course_1_to_4[$i]->stay_room_type){
                case '01': $course_1_to_4[$i]->stay_room_type = NULL; break;
                case '02': {
                    $temp_kubun = MsKubun::where('kubun_type','011')->where('kubun_id',$course_1_to_4[$i]->stay_room_type)->first();
                    $course_1_to_4[$i]->stay_room_type =  substr($temp_kubun->kubun_value, 0, 1);
                    break;
                } 
                case '03': {
                    $temp_kubun = MsKubun::where('kubun_type','011')->where('kubun_id',$course_1_to_4[$i]->stay_room_type)->first();
                    $course_1_to_4[$i]->stay_room_type =  substr($temp_kubun->kubun_value, 0, 1);
                    break;
                } 
                case '04': {
                    $temp_kubun = MsKubun::where('kubun_type','011')->where('kubun_id',$course_1_to_4[$i]->stay_room_type)->first();
                    $course_1_to_4[$i]->stay_room_type =  substr($temp_kubun->kubun_value, 0, 1);
                    break;
                } 
            }
            switch($course_1_to_4[$i]->stay_guest_num){
                case '01': {
                    $temp_kubun = MsKubun::where('kubun_type','012')->where('kubun_id',$course_1_to_4[$i]->stay_guest_num)->first();
                    $course_1_to_4[$i]->stay_guest_num =  $temp_kubun->notes;
                    break;
                } 
                case '02': {
                    $temp_kubun = MsKubun::where('kubun_type','012')->where('kubun_id',$course_1_to_4[$i]->stay_guest_num)->first();
                    $course_1_to_4[$i]->stay_guest_num =  $temp_kubun->notes;
                    break;
                } 
                case '03': {
                    $temp_kubun = MsKubun::where('kubun_type','012')->where('kubun_id',$course_1_to_4[$i]->stay_guest_num)->first();
                    $course_1_to_4[$i]->stay_guest_num =  $temp_kubun->notes;
                    break;
                } 
            }

            switch($course_1_to_4[$i]->breakfast){
                case '01': $course_1_to_4[$i]->breakfast = NULL; break;
                case '02': $course_1_to_4[$i]->breakfast = '朝食有'; break;
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
                    , main.service_pet_num
                    , main.notes
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    ,CONCAT(main.service_time_1, '-', main.service_time_2) as time
            FROM		tr_yoyaku as main
            WHERE 	main.course = '05' AND main.history_id IS NULL AND main.service_date_start = $date
        ");
        $course_5 = collect($course_5_query);
        for($i = 0; $i < count($course_5); $i++){
            switch($course_5[$i]->transport){
                case '01': {
                    $course_5[$i]->transport = '車';
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
            switch($course_5[$i]->repeat_user){
                case '01': $course_5[$i]->repeat_user = '新規'; break;
                case '02': $course_5[$i]->repeat_user = NULL; break;
            }
            switch($course_5[$i]->payment_method){
                case '1': $course_5[$i]->payment_method = 'クレカ'; break;
                case '2': $course_5[$i]->payment_method = '現金'; break;
                case '3': $course_5[$i]->payment_method = '回数券'; break;
            }
            switch($course_5[$i]->service_pet_num){
                case '01': $course_5[$i]->service_pet_num = 1; break;
                case '02': $course_5[$i]->service_pet_num = 2; break;
                case '03': $course_5[$i]->service_pet_num = 3; break;
            }
        }

        $course_wt_query = DB::select("
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
                    , main.phone
                    , main.payment_method
                    , main.service_date_start
                    , main.whitening_time as time
            FROM	tr_yoyaku as main
            WHERE 	main.service_date_start = $date AND main.history_id IS NULL 
        ");
        $course_wt = collect($course_wt_query);
        for($i = 0; $i < count($course_wt); $i++){
            switch($course_wt[$i]->transport){
                case '01': {
                    $course_wt[$i]->transport = '車';
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
            switch($course_wt[$i]->course){
                case '01': $course_wt[$i]->course = '入浴'; break;
                case '02': $course_wt[$i]->course = 'リ'; break;
                case '03': $course_wt[$i]->course = '貸切'; break;
                case '04': $course_wt[$i]->course = '断食'; break;
            }
            switch($course_wt[$i]->repeat_user){
                case '01': $course_wt[$i]->repeat_user = '新規'; break;
                case '02': $course_wt[$i]->repeat_user = NULL; break;
            }
            switch($course_wt[$i]->payment_method){
                case '1': $course_wt[$i]->payment_method = 'クレカ'; break;
                case '2': $course_wt[$i]->payment_method = '現金'; break;
                case '3': $course_wt[$i]->payment_method = '回数券'; break;
            }
            switch($course_wt[$i]->gender){
                case '01': $course_wt[$i]->gender = '男性'; break;
                case '02': $course_wt[$i]->gender = '女性'; break;
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

            $data['time_range'][$i]['data']['pet'] = $course_5->firstWhere('time',   $data['time_range'][$i]['pet_time_value']);
            $data['time_range'][$i]['data']['wt'] = $course_wt->firstWhere('time',   $data['time_range'][$i]['wt_time_value']);

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
        if(isset($data['booking_id']) &&($data['booking_id'] != 0)){
            $data['data_booking'] = Yoyaku::where('booking_id', $data['booking_id'])->first();
            $data['data_time'] = YoyakuDanjikiJikan::where('booking_id', $data['booking_id'])->get();
            $data['history_booking'] = Yoyaku::where('history_id', $data['booking_id'])->orderBy('booking_id', 'DESC')->get();
        }else{
            $data['data_booking'] = [];
            $data['data_time'] =  [];
            $data['booking_id'] = NULL;
        }
        // dd($data);
        return view('sunsun.admin.parts.booking',$data)->render();
    }


    public function booking_history(Request $request){
        $data = $request->all();
        $booking = new BookingController();
        $booking->fetch_kubun_data($data);
        $data['data_booking'] = Yoyaku::where('booking_id', $data['course_history'])->first();
        $data['data_time'] = YoyakuDanjikiJikan::where('booking_id', $data['course_history'])->get();
        $data['history_booking'] = Yoyaku::where('history_id', $data['current_booking_id'])->orderBy('booking_id', 'DESC')->get();
        $data['booking_id'] = $data['current_booking_id'];
        // dd($data['data_booking']->booking_id);
        return view('sunsun.admin.parts.booking',$data)->render();
    }

    public function update_booking (Request $request){
        $data = $request->all();
        $data['customer'] = $data;
        $data['customer']['info'] = ['0' => $data];

        $booking = new BookingController();
        $booking->update_or_new_booking($data);
        return \Response::json(array('success'=>true,'result'=>$data));
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

        $day_range = [];
        $day_range_normal = [];
        $day_range_type = [
            'male' => NULL,
            'female' => '×',
            'pet' => '×',
            'wt' => '×',
        ];
        foreach($data['day_range'] as $dr){
            $day_range[$dr['full_date']] = $day_range_type;
            $day_range_normal[] = $dr['full_date'];
        }

        $data['time_range'] = config('const.time_admin');
        for($i = 0; $i < count($data['time_range']); $i++){
            $data['time_range'][$i]['day'] = $day_range;
        }

        // dd($data);

        $this->set_week_course($data, $day_range_normal);




        $data['data_date'] = DB::table('tr_yoyaku')->where([['service_date_start','>=',$date_from_sql],['service_date_start','<=',$date_to_sql]])->get();
        return view('sunsun.admin.weekly',$data);
    }

    private function set_week_course(&$data, $day_range_normal){
        $week_course_query = DB::select("
            (
                SELECT	main.booking_id
                    , main.course
                    , main.gender
                    , time.service_date
                    , time.service_time_1 as time
                    , SUBSTRING(time.notes, 1, 1) as bed
                FROM		tr_yoyaku as main
                LEFT JOIN tr_yoyaku_danjiki_jikan as time
                ON			main.booking_id = time.booking_id
                WHERE 	main.course = '01' AND main.history_id IS NULL 
            )
            UNION
            (
                SELECT	main.booking_id
                    , main.course
                    , main.gender
                    , time.service_date
                    , time.service_time_1 as time
                    , SUBSTRING(time.notes, 1, 1) as bed
                FROM		tr_yoyaku as main
                LEFT JOIN tr_yoyaku_danjiki_jikan as time
                ON			main.booking_id = time.booking_id
                WHERE 	main.course = '04' AND main.history_id IS NULL 
            )
            UNION
            (
                SELECT	main.booking_id
                    , main.course
                    , main.gender
                    , time.service_date
                    , time.service_time_2 as time
                    , SUBSTRING(time.notes, 3, 1) as bed
                FROM		tr_yoyaku as main
                LEFT JOIN tr_yoyaku_danjiki_jikan as time
                ON			main.booking_id = time.booking_id
                WHERE 	main.course = '04' AND main.history_id IS NULL 
            )
            UNION
            (
                SELECT	main.booking_id
                    , main.course
                    , main.gender
                    , main.service_date_start as service_date
                    , main.service_time_1 as time
                    , SUBSTRING(main.bed, 1, 1) as bed
                FROM		tr_yoyaku as main
                WHERE 	main.course = '02' AND main.history_id IS NULL 
            )
            UNION
            (
                SELECT	main.booking_id
                    , main.course
                    , main.gender
                    , main.service_date_start as service_date
                    , main.service_time_2 as time
                    , SUBSTRING(main.bed, 3, 1) as bed
                FROM		tr_yoyaku as main
                WHERE 	main.course = '02' AND main.history_id IS NULL 
            )
            UNION
            (
                SELECT	main.booking_id
                    , main.course
                    , '01' as gender
                    , main.service_date_start as service_date
                    , main.service_time_1 as time
                    , main.bed
                FROM		tr_yoyaku as main
                WHERE 	main.course = '03' AND main.history_id IS NULL 
            )
        ");
        $week_course = collect($week_course_query);

        $course_5_query = DB::select("
            SELECT	main.booking_id
                    , main.course
                    , main.service_date_start as service_date
                    ,CONCAT(main.service_time_1, '-', main.service_time_2) as time
            FROM	tr_yoyaku as main
            WHERE 	main.course = '05' AND main.history_id IS NULL 
        ");

        $course_5 = collect($course_5_query);


        $course_wt_query = DB::select("
            SELECT	main.booking_id
                    , main.course
                    , main.service_date_start as service_date
                    , main.whitening_time as time
            FROM	tr_yoyaku as main
            WHERE main.whitening <> '01' AND main.history_id IS NULL 
        ");

        $course_wt = collect($course_wt_query);

        $check_room = [];
        foreach($day_range_normal as $day){
            for($i = 0; $i < count($data['time_range']); $i++){
                // $check = $week_course->where('gender', '01')->where('service_date', $day)->where('time', $data['time_range'][$i]['time_value'])->where('course','03');
                // if(count($check)){
                //     $check_room[] = $check;
                //     $data['time_range'][$i]['day'][$day]['male'] = ['1','2','3'];
                // }else{

                // }
                $data['time_range'][$i]['day'][$day]['male'] = $week_course->where('gender', '01')->where('service_date', $day)->where('time', $data['time_range'][$i]['time_value']);
                $data['time_range'][$i]['day'][$day]['female'] = $week_course->where('gender', '02')->where('service_date', $day)->where('time', $data['time_range'][$i]['time_value']);
                $data['time_range'][$i]['day'][$day]['pet'] = $course_5->where('service_date', $day)->where('time', $data['time_range'][$i]['pet_time_value']);
                $data['time_range'][$i]['day'][$day]['wt'] = $course_wt->where('service_date', $day)->where('time', $data['time_range'][$i]['wt_time_value']);
            }
        }





    }

    private function get_list_days($from , $to){
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $dates = [];
        for($d = $from; $d->lte($to); $d->addDay()) {
            $dates[$d->format('Ymd')]['full_date'] = $d->format('Ymd');
            $dates[$d->format('Ymd')]['day'] = ltrim($d->format('d'), "0");
            $dates[$d->format('Ymd')]['month'] = ltrim($d->format('m'), "0");
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

        $this->set_monthly_course($data);

        // dd($data);
        return view('sunsun.admin.monthly',['data' => $data, 'month' => $month, 'year' => $year]);
    }

    private function set_monthly_course(&$data){
        $week_course_query = DB::select("
        (SELECT	main.booking_id
                  , main.course
                  , main.gender
                  , time.service_date
                  , time.service_time_1 as time
                  , SUBSTRING(time.notes, 1, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '01' AND main.history_id IS NULL 
        )
        UNION
        (
            SELECT	main.booking_id
                    , main.course
                    , main.gender
                    , main.service_date_start
                    , main.service_time_1 as time
                    , SUBSTRING(main.bed, 1, 1) as bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '02' AND main.history_id IS NULL 
        )
        UNION
        (
            SELECT	main.booking_id
                    , main.course
                    , main.gender
                    , main.service_date_start
                    , main.service_time_2 as time
                    , SUBSTRING(main.bed, 3, 1) as bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '02' AND main.history_id IS NULL 
        )
        UNION
        (
            SELECT	main.booking_id
                    , main.course
                    , '01' AS gender
                    , main.service_date_start
                    , main.service_time_1 as time
                    , main.bed
            FROM		tr_yoyaku as main
            WHERE 	main.course = '03' AND main.history_id IS NULL 
        )
        UNION
        (
            SELECT	main.booking_id
                  , main.course
                  , main.gender
                  , time.service_date
                  , time.service_time_1 as time
                  , SUBSTRING(time.notes, 1, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '04' AND main.history_id IS NULL 
        )
        UNION
        (
            SELECT	main.booking_id
                  , main.course
                  , main.gender
                  , time.service_date
                  , time.service_time_2 as time
                  , SUBSTRING(time.notes, 3, 1) as bed
            FROM		tr_yoyaku as main
            LEFT JOIN tr_yoyaku_danjiki_jikan as time
            ON			main.booking_id = time.booking_id
            WHERE 	main.course = '04' AND main.history_id IS NULL 
        )
        ");

        $week_course = collect($week_course_query);

        $course_5_query = DB::select("
            SELECT	main.booking_id
                    , main.course
                    , main.service_date_start as service_date
                    , main.service_time_1 as time
            FROM	tr_yoyaku as main
            WHERE 	main.course = '05' AND main.history_id IS NULL 
        ");

        $course_5 = collect($course_5_query);


        $course_wt_query = DB::select("
            SELECT	main.booking_id
                    , main.course
                    , main.service_date_start as service_date
                    , SUBSTRING(main.whitening_time, 1, 4) as time
            FROM	tr_yoyaku as main
            WHERE main.whitening <> '01' AND main.history_id IS NULL 
        ");

        $course_wt = collect($course_wt_query);


        $monthly_data = [];
        $week_list_day = [];
        foreach($week_course as $course){
            $week_list_day[] = $course->service_date;
        }
        foreach($course_5 as $course){
            $week_list_day[] = $course->service_date;
        }
        foreach($course_wt as $course){
            $week_list_day[] = $course->service_date;
        }


        foreach($week_list_day as $day){
            $monthly_data[$day]['male'][0] = $week_course->where('service_date', $day)->where('gender', '01')->where('time','>=' , '0930')->where('time','<=' , '1330');
            $monthly_data[$day]['female'][0] = $week_course->where('service_date', $day)->where('gender', '02')->where('time','>=' , '0930')->where('time','<=' , '1330');
            $monthly_data[$day]['male'][1] = $week_course->where('service_date', $day)->where('gender', '01')->where('time','>=' , '1330')->where('time','<=' , '1800');
            $monthly_data[$day]['female'][1] = $week_course->where('service_date', $day)->where('gender', '02')->where('time','>=' , '1330')->where('time','<=' , '1800');
            $monthly_data[$day]['male'][2] = $week_course->where('service_date', $day)->where('gender', '01')->where('time','>=' , '1800')->where('time','<=' , '2030');
            $monthly_data[$day]['female'][2] = $week_course->where('service_date', $day)->where('gender', '02')->where('time','>=' , '1800')->where('time','<=' , '2030');

            $monthly_data[$day]['pet'][0] = $course_5->where('service_date', $day)->where('time','>=' , '0930')->where('time','<=' , '1330');
            $monthly_data[$day]['pet'][1] = $course_5->where('service_date', $day)->where('time','>=' , '1330')->where('time','<=' , '1800');

            $monthly_data[$day]['wt'][0] = $course_wt->where('service_date', $day)->where('time','>=' , '0930')->where('time','<=' , '1330');
            $monthly_data[$day]['wt'][1] = $course_wt->where('service_date', $day)->where('time','>=' , '1330')->where('time','<=' , '1800');

        }


        // dd($week_list_day);

        $data['monthly_data'] = $monthly_data;

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

}
