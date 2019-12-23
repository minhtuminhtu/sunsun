<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sunsun\Front\BookingRequest;
use App\Models\MsKubun;
use App\Models\Yoyaku;
use App\Models\YoyakuDanjikiJikan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    private $session_info = 'SESSION_BOOKING_USER';

    public function index(Request $request){
        $request->session()->forget($this->session_info);

        return view('sunsun.front.booking.index');
    }

    public function booking(Request $request){
        $data = $request->all();
        $data['new'] = 1;
        $this->fetch_kubun_data($data);
        // dd($data);
        if (isset($request->add_new_user)) {
            $data['add_new_user'] = $request->add_new_user;
        } else {
            $request->session()->forget($this->session_info);
        }
        $data['customer'] = $this->get_booking($request);

        return view('sunsun.front.booking',$data);

    }

    public function add_new_booking(Request $request) {
        $data = $request->all();
        if (isset($data['transport'])) {
            $this->save_session($request, $data);
        }
        return ['status'=> 'OK'];
    }

    public function save_booking(Request $request) {
        $error = $this->validate_booking($request->all());
        if (count($error) > 0) {
            return $error;
        }
        $this->save_session($request, $request->all());
        return ['status'=> 'OK'];
    }

    public function validate_booking($data) {
        $error = [];
        $transport = $data['transport'];
        $transport = json_decode($transport, true);
        $repeat_user = json_decode($data['repeat_user'], true);
        $course = json_decode($data['course'], true);

        $check_bus = false;
        if ($transport['kubun_id'] == config('const.db.kubun_id_value.transport.BUS') ) { // nếu đi xe bus'02'
            if ($repeat_user['kubun_id'] == config('const.db.kubun_id_value.repeat_user.NEW')) { // はじめて
                $time_required_arrived = config('const.db.time_validate.transport.bus.NEW'); // người tắm lần đầu 01
            } else { //　リピート
                $time_required_arrived = config('const.db.time_validate.transport.bus.OLD');  // người cũ 02
            }
            $bus_arrive_time_slide = $data['bus_arrive_time_slide'];
            $bus_arrive_time_slide = json_decode($bus_arrive_time_slide, true);
            $time_bus_arrived = $bus_arrive_time_slide['notes'];
            $time_required = $this->plus_time_string ($time_bus_arrived, $time_required_arrived); // time required go early for BUS
            $check_bus = true;
        }

        $check_gender = false;
        $kubun_type_bed = '';
        if ($course['kubun_id'] == config('const.db.kubun_id_value.course.NORMAL')
            || $course['kubun_id'] == config('const.db.kubun_id_value.course.1_DAY_REFRESH')
            || $course['kubun_id'] == config('const.db.kubun_id_value.course.FASTING_PLAN')) {
            $gender = json_decode($data['gender'], true);
            if($gender['kubun_id'] == '01'){ // for man
                $kubun_type_bed = config('const.db.kubun_type_value.bed_male'); // 017 kubun_type
            }else{ //for woman
                $kubun_type_bed = config('const.db.kubun_type_value.bed_female'); // 018 kubun_type
            }
            $check_gender = true;
        }

        // whitening
        if (isset($data['whitening_data'])) {
            $whitening = json_decode($data['whitening'], true);
            if ($whitening['kubun_id'] == '02') {
                $data_json_time = json_decode($data['whitening_data']['json'], true );
                if ($data_json_time == null) {
                    $error['error_time_empty']['whitening']['element'] = $data['whitening_data']['element'];
                    //return $error;
                } else {
                    if ($check_bus && $whitening['kubun_id'] == '02') {
                        $time_start_whitening = substr($data_json_time['notes'], 0,4);
                        if ($time_start_whitening < $time_required) { // check required time. time choice always >= time required
                            $error['error_time_transport'][]['element'] = $data['whitening_data']['element'];
                        } else {
                            $error['clear_border_red'][]['element'] = $data['whitening_data']['element'];
                        }
                    } else {
                        $error['clear_border_red']['whitening']['element'] = $data['whitening_data']['element'];
                    }

                }

            }
        }

        $time_customer_choice = $data['time'];
        //return $time_customer_choice;
        foreach ($time_customer_choice as $key => $time) {

            if ($course['kubun_id'] == config('const.db.kubun_id_value.course.FASTING_PLAN')) {
                $data_json_time_1 = json_decode($time['from']['json'], true );//dd($time);
                $data_json_time_2 = json_decode($time['to']['json'], true );
                if ($data_json_time_1 == null) {
                    $error['error_time_empty'][]['element'] = $time['from']['element'];
                } else {
                    if ($check_bus) { // validate nếu đi xe bus
                        if ($data_json_time_1['notes'] < $time_required) { // check required time. time choice always >= time required
                            $error['error_time_transport'][]['element'] = $time['from']['element'];
                        } else {
                            $error['clear_border_red'][]['element'] = $time['from']['element'];
                        }
                    }
                    if ($check_gender) {
                        if ($kubun_type_bed != $data_json_time_1['gender_type']) {
                            //$error['error_time_transport'][$key]['data'] = $data_json_time;
                            $error['error_time_gender'][]['element'] = $time['from']['element'];
                        } else {
                            $error['clear_border_red'][]['element'] = $time['from']['element'];
                        }

                    }
                }
                if ($data_json_time_2 == null) {
                    $error['error_time_empty'][]['element'] = $time['to']['element'];
                } else {
                    if ($check_bus) { // validate nếu đi xe bus

                        if ($data_json_time_2['notes'] < $time_required) { // check required time. time choice always >= time required
                            $error['error_time_transport'][]['element'] = $time['to']['element'];
                        } else {
                            $error['clear_border_red'][]['element'] = $time['to']['element'];
                        }
                    }
                    if ($check_gender) {
                        if ($kubun_type_bed < $data_json_time_2['gender_type']) { // check required time. time choice always >= time required
                            $error['error_time_transport'][]['element'] = $time['to']['element'];
                        } else {
                            $error['clear_border_red'][]['element'] = $time['to']['element'];
                        }
                    }
                }


            } else {
                $data_json_time = json_decode($time['json'], true );
                if ($data_json_time == null) { // check nếu chưa chọn time
                    $error['error_time_empty'][$key]['element'] = $time['element'];
                } else {
                    if ($check_bus) { // validate nếu đi xe bus
                        if ($course['kubun_id'] == config('const.db.kubun_id_value.course.PET')){
                            $time_start_whitening = substr($data_json_time['notes'], 0,4);
                            if ($time_start_whitening < $time_required) { // check required time. time choice always >= time required
                                $error['error_time_transport'][$key]['element'] = $time['element'];
                            } else {
                                $error['clear_border_red'][$key]['element'] = $time['element'];
                            }
                        } else {
                            if ($data_json_time['notes'] < $time_required) { // check required time. time choice always >= time required
                                //$error['error_time_transport'][$key]['data'] = $data_json_time;
                                $error['error_time_transport'][$key]['element'] = $time['element'];
                            } else {
                                $error['clear_border_red'][$key]['element'] = $time['element'];
                            }
                        }

                    }

                    if ($check_gender) { // check gender
                        if ($kubun_type_bed != $data_json_time['gender_type']) {
                            $error['error_time_gender'][$key]['element'] = $time['element'];
                        } else {
                            $error['clear_border_red'][$key]['element'] = $time['element'];
                        }
                    }
                }
            }
        }

        $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type'], true)['kubun_id']:'01';
        if($stay_room_type != '01'){
            $range_date_start = $data['range_date_start-value'];
            $range_date_end = $data['range_date_end-value'];

            $number_dup = DB::select("
            SELECT 	main.booking_id,
                    main.stay_checkin_date,
                    main.stay_checkout_date
            FROM	tr_yoyaku main
            WHERE	main.stay_room_type = $stay_room_type
            AND	(   ( main.stay_checkin_date <= $range_date_end AND main.stay_checkout_date >= $range_date_end )
                OR 	( main.stay_checkin_date <= $range_date_start AND main.stay_checkout_date >= $range_date_end )
                OR 	( main.stay_checkin_date <= $range_date_start AND main.stay_checkout_date >= $range_date_start )
                OR 	( main.stay_checkin_date >= $range_date_start AND main.stay_checkout_date <= $range_date_end )
                )
            ");

            if(count($number_dup) != 0){
                $error['room_select_error']['start']['element'] = 'range_date_start';
                $error['room_select_error']['end']['element'] = 'range_date_end';
            }else{
                $error['clear_border_red']['start']['element'] = 'range_date_start';
                $error['clear_border_red']['end']['element'] = 'range_date_end';
            }
        }

        // dd($error);

        if (isset($error['error_time_transport']) == false
            && isset($error['error_time_gender']) == false
            && isset($error['room_select_error']) == false
            && isset($error['error_time_empty']) == false) {
            $error = [];
        }


        return $error;

    }


    public function plus_time_string ($time, $plus) {
        $time_hour = substr($time, 0,2);
        $time_minutes = substr($time, 2,4);
        $bus_minutes_more = (int)$time_minutes + $plus;

        $hours_more = floor($bus_minutes_more / 60);
        $minutes_more = ($bus_minutes_more % 60);
        $time_bus_hour = (int)$time_hour + $hours_more;
        $time_required = (string)sprintf('%02d', $time_bus_hour). (string)sprintf('%02d', $minutes_more);
        return $time_required;
    }

    public function minus_time_string ($time, $minus) {
        $time_hour = (int)substr($time, 0,2);
        $time_minutes = substr($time, 2,4);
        if ($time_minutes < $minus){
            if ($minus > 60) {
                $hours = (int)floor($minus / 60);
                $minutes = ($minus % 60);
                $time_hour = $time_hour - $hours;
                if ($minutes > $time_minutes) {
                    $minutes = $minutes - $time_minutes;
                    $hours = $time_hour - 1;

                } else {
                    $minutes = $time_minutes - $minutes;
                    $hours = $time_hour;
                }
            } else {
                $minutes = $minus - $time_minutes;
                $hours = $time_hour - 1;
            }
        } else {
            $minutes = $time_minutes - $minus;
            $hours = $time_hour;
        }

        $time_required = (string)sprintf('%02d', $hours). (string)sprintf('%02d', $minutes);

        return $time_required;
    }

    /**
     * @param $request Request
     * @return array
     */
    public function get_booking($request) {
        $info = [];
        if ($request->session()->has($this->session_info)) {
            $info = $request->session()->get($this->session_info);
        }
        return $info;
    }

    /**
     * @param $request Request
     * @param $data
     */
    public function save_session($request, $data) {
        $info_customer = [];
        if ($request->session()->exists($this->session_info)) {
            $info_customer = $request->session()->get($this->session_info);
        } else {
            $info_customer['transport'] =  $data['transport'];
            if ($data['transport'] !== config('booking.transport.options.car')) {
                $info_customer['bus_arrive_time_slide'] = $data['bus_arrive_time_slide'];
                $info_customer['pick_up'] = $data['pick_up'];
                $info_customer['pick_up'] = $data['pick_up'];
            }
            if (isset($data['date-view'])) {
                $info_customer['date-view'] = $data['date-view'];
            } else {
                $info_customer['date-view-from'] = $data['plan_date_start-view'];
                $info_customer['date-view-to'] = $data['plan_date_end-view'];
            }

            if (isset($data['date-value'])) { // Tắm bt (01),
                $info_customer['date-value'] = $data['date-value'];
            }

            if (isset($data['date-value'])) {
                $info_customer['date-value'] = $data['date-value'];
            } elseif (isset($data['plan_date_start-value'])){
                $info_customer['date-value'] = $data['plan_date_start-value'];
            };
            if (isset($data['time'])) {
                $info_customer['time_first_booking'] = $data['time'];
            }
        }

        $info_customer['info'][time()] = $data;
        $request->session()->put($this->session_info,$info_customer);
    }

    public function confirm(Request $request){
        $data['customer'] = $this->get_booking($request);
        if (count($data['customer']) == 0) {
            return redirect("/booking");
        }
        // dd($data);
        $data['customer']['info'] = array_values($data['customer']['info']);
        return view('sunsun.front.confirm',$data);

    }

    public function payment(Request $request){
        $data = $request->all();
        $data['customer'] = $this->get_booking($request);
        if($data['customer'] == null) {
            return redirect("/booking");
        }
        $this->make_bill($data);
        //dd($data);
        return view('sunsun.front.payment',$data);
    }

    public function make_bill (&$data) {
        //dd($data);
        $info_booking = $data['customer'];
        $bill = [];
        $bill['course']['quantity'] = 0;
        $bill['course']['price'] = 0;
        $bill['options'] = [];
        $bill['price_option'] = 0;
        foreach ($info_booking['info'] as $booking) {
            ++ $bill['course']['quantity'];
            $bill['course']['price'] += $this->get_price_course($booking, $bill);
            $this->get_price_option($booking, $bill);

            //dd($info_booking['info']);
        }
        //dd($bill);
        $bill['total'] = $bill['course']['price'] + $bill['price_option'];
        $data['bill'] = $bill;
    }

    public function get_free_room(Request $request){
        $data = $request->all();
        $room_type = $data['room'];
        $range_day = DB::select("
        SELECT 	main.stay_checkin_date,
                main.stay_checkout_date
        FROM	tr_yoyaku main
        WHERE	main.stay_room_type = '$room_type'
        ");
        $date_selected = [];
        foreach($range_day as $da){
            foreach($this->get_list_days($da->stay_checkin_date, $da->stay_checkout_date) as $d){
                array_push($date_selected, $d);
            }
        }
        return [
            'now' => $this->get_nearly_active(count($date_selected)!=0?max($date_selected):null, $date_selected),
            'date_selected' => $date_selected
        ];
    }
    private function get_nearly_active($max_date_selected, $date_selected){
        $now = Carbon::now();
        $active_day = Carbon::parse($max_date_selected);
        for($d = $now; $d->lte($active_day->addDay(7)); $d->addDay(1)) {
            if(!in_array($d->format('Y/m/d'), $date_selected) && ($d->dayOfWeek != 3) && ($d->dayOfWeek != 4)){
                return $d->format('Y/m/d');
            }
        }
    }
    private function get_list_days($from , $to){
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $dates = [];
        for($d = $from; $d->lte($to); $d->addDay()) {
            $dates[] = $d->format('Y/m/d');
        }
        return $dates;
    }
    public function get_price_option ($booking, &$bill) {
        $course = json_decode($booking['course'], true);
        $data_option_price = MsKubun::where('kubun_type','029')->get(); // get all options price

        //dd($booking);
        if (isset($booking['lunch']) || isset($booking['lunch_guest_num'])) { // an trua 01
            $price_luch = 0;
            if (isset($booking['lunch'])) {
                $lunch = json_decode($booking['lunch'], true);
            } else { // th book all room 03
                $lunch = json_decode($booking['lunch_guest_num'], true);
            }

            if ($lunch['kubun_id'] !== "01") {
                $price_lunch_each_people = $data_option_price->where('kubun_id','01')->first();
                $num_person = 1;
                if (isset($booking['lunch_guest_num'])) {
                    $num_person = (int) $lunch['notes'];
                }
                $price_luch = $num_person * (int) $price_lunch_each_people->kubun_value;

                if (isset($bill['options']['01']['price'])) {
                    $bill['options']['01']['price'] += $price_luch;
                    $bill['options']['01']['quantity'] += $num_person;
                } else {
                    $bill['options']['01']['quantity'] = $num_person;
                    $bill['options']['01']['price'] = $price_luch;
                    $bill['options']['01']['name'] = 'ランチ';
                }
            }
            $bill['price_option'] += $price_luch;
        }
        if (isset($booking['stay_room_type'])) { // o lai 03 02
            $price_stay = 0;
            $stay_room_type = json_decode($booking['stay_room_type'], true);
            if ($stay_room_type['kubun_id'] !== '01') {
                if (isset($booking['stay_guest_num'])) {
                    $stay_guest_num = json_decode($booking['stay_guest_num'], true);
                    if ($stay_guest_num['notes'] == 1) {
                        $guest_num_price_op = $data_option_price->where('kubun_id','02')->first();
                        $price_stay += $guest_num_price_op->kubun_value;
                    } else {
                        $guest_num_price_op = $data_option_price->where('kubun_id','03')->first();
                        $price_stay += $guest_num_price_op->kubun_value;
                    }
                    $date_end = new Carbon();
                    $date_start = new Carbon();
                    $date_end->setDate(substr($booking['range_date_end-value'], 0 , 4),substr($booking['range_date_end-value'], 4 , 2),substr($booking['range_date_end-value'], 6 , 2));
                    $date_start->setDate(substr($booking['range_date_start-value'], 0 , 4),substr($booking['range_date_start-value'], 4 , 2),substr($booking['range_date_start-value'], 6 , 2));
                    $all_dates = array();
                    while ($date_start->lte($date_end)){
                        $all_dates[] = $date_start->toDateString();
                        if($date_start->dayOfWeek == Carbon::THURSDAY || $date_start->dayOfWeek == Carbon::TUESDAY) {
                            $date_off[] = $date_start;
                        }
                        $date_start->addDay();
                    }
                    //dd($date_off);
                    //$days = $booking['range_date_end-value'] - $booking['range_date_start-value']; // chua tính những ngày nghỉ
                    $price_stay = $price_stay * count($all_dates);
                    if (isset($bill['options']['02_03']['price'])) {
                        ++ $bill['options']['02_03']['quantity'];
                        $bill['options']['02_03']['price'] += $price_stay;
                    } else {
                        $bill['options']['02_03']['room'] = $stay_room_type['kubun_value'];
                        $bill['options']['02_03']['quantity'] = $stay_guest_num['notes'];
                        $bill['options']['02_03']['price'] = $price_stay;
                        $bill['options']['02_03']['name'] = '宿泊(部屋ﾀｲﾌﾟ)';
                    }
                }
            }

            $bill['price_option'] += $price_stay;
        }

        if (isset($booking['pet_keeping'])) { // giữ pet 04 05
            $price_keep_pet = 0;
            $pet_keeping = json_decode($booking['pet_keeping'], true);
            if ($pet_keeping['kubun_id'] !== '01') {
                if ($course['kubun_id'] == '02') { // 1 day refresh
                    $guest_num_price_op = $data_option_price->where('kubun_id','05')->first();
                } else { // 500円 / h
                    $guest_num_price_op = $data_option_price->where('kubun_id','04')->first();
                }
                $keep_pet = $guest_num_price_op->kubun_value;
                $price_keep_pet += $keep_pet; // chưa tính thời gian keep

                if (isset($bill['options']['04_05']['price'])) {
                    ++ $bill['options']['04_05']['quantity'];
                    $bill['options']['04_05']['price'] += $price_keep_pet;
                } else {
                    $bill['options']['04_05']['quantity'] = 1;
                    $bill['options']['04_05']['price'] = $price_keep_pet;
                    $bill['options']['04_05']['name'] = 'ペット預かり';
                }

            }

            $bill['price_option'] += $price_keep_pet;
        }
        if (isset($booking['whitening'])) { // tắm trắng 06
            $price_white = 0;
            $whitening = json_decode($booking['whitening'], true);
            if ($whitening['kubun_id'] !== '01') {
                $whitening_price_op = $data_option_price->where('kubun_id','06')->first();
                $price_white += $whitening_price_op->kubun_value;
                if (isset($bill['options']['06']['price'])) {
                    ++ $bill['options']['06']['quantity'];
                    $bill['options']['06']['price'] += $price_white;
                } else {
                    $bill['options']['06']['quantity'] = 1;
                    $bill['options']['06']['price'] = $price_white;
                    $bill['options']['06']['name'] = 'ホワイトニング';
                }
            }

            $bill['price_option'] += $price_white;
        }
    }

    public function get_price_course ($booking, &$bill) {
        $course = json_decode($booking['course'], true);
        $course_price = 0;
        switch ($course['kubun_id']){
            case '01': // bình thường
                if ($booking['age_type'] == '3') {
                    $course_price_op = MsKubun::where([['kubun_type','024'],['kubun_id','03']])->get()->first();
                    $course_price = $course_price_op->kubun_value;
                }
                else if ($booking['age_type'] == '2') {
                    $course_price_op = MsKubun::where([['kubun_type','024'],['kubun_id','02']])->get()->first();
                    $course_price = $course_price_op->kubun_value;
                }
                else if ($booking['age_type'] == '1') {
                    $course_price_op = MsKubun::where([['kubun_type','024'],['kubun_id','01']])->get()->first();
                    $course_price = $course_price_op->kubun_value;
                }
                break;
            case '02': // 1 day refresh
                $course_price_op = MsKubun::where([['kubun_type','025'],['kubun_id','01']])->get()->first();
                $course_price = $course_price_op->kubun_value;
                break;
            case '03': // nguyên sàn
                $quantity = json_decode( $booking['service_guest_num'], true);
                $number_customer = (int)$quantity['notes'];
                $course_price_op = MsKubun::where([['kubun_type','026']])->get();
                $price_op = $course_price_op->where('kubun_id', '01')->first();
                $price = $price_op->kubun_value;
                if($number_customer > (int)$price_op->notes) {
                    $price_op_more_people = $course_price_op->where('kubun_id', '02')->first();
                    $price_more = (int)$price_op_more_people->kubun_value;
                    $price = $price + ($number_customer - (int)$price_op->notes) * $price_more;

                }
                $course_price = $price;
                break;
            case '04': // ăn kiêng
                $day = count($booking['date']);
                $price_op_fasting =  MsKubun::where('kubun_type','027')->get();
                $one_day = $price_op_fasting->where('kubun_id','01')->first();
                $one_day_price = (int)$one_day->kubun_value;
                $for_special_day = $price_op_fasting->where('kubun_id','02')->first();
                $for_special_day_price = (int)$for_special_day->kubun_value;
                if ($day == 5) { //$for_special_day_price
                    $course_price = $for_special_day_price;
                } else {
                    $course_price = $day * $one_day_price;
                }
                break;
            case "05": // pet
                $course_price_op = MsKubun::where([['kubun_type','028'],['kubun_id','01']])->get()->first();
                $course_price = $course_price_op->kubun_value;
                break;

        }
        return $course_price;
    }


    public function make_payment(Request $request){
        $data = $request->all();
        Log::debug('payment_data');
        Log::debug($data);

        $error = $this->validate_payment_info($data);
        if (isset($error['error']) && (count($error['error']) != 0)){
            return $error;
        }

        $data['customer'] = $this->get_booking($request);
        if(
            (isset($data['customer']['info']) == false)
            || ((isset($data['customer']['info'])) &&(count($data['customer']['info']) == 0))
        ){
            return [
                'status' => 'error',
                'message' => '予約されたデータが見つかりません。'
            ];
        }

        $value = 'success';
        $message = null;
        $success =[
            'status' => $value,
            'message' => $message
        ];
        $result = $this->update_or_new_booking($data);

        $request->session()->forget($this->session_info);
        return isset($result)?$result:$success;
    }

    public function validate_payment_info(&$data){
        $error = [];
        $data['name'] = trim($data['name']);
        if($data['name'] == null){
            $error['error'][] = 'name';
        }else{
            $error['clear'][] = 'name';
        }

        if($data['phone'] == null){
            $error['error'][] = 'phone';
        }else{
            $error['clear'][] = 'phone';
        }

        if($data['email'] == null){
            $error['error'][] = 'email';
        }else{
            $error['clear'][] = 'email';
        }

        return $error;
    }


    public function update_or_new_booking($data){
        $result = [];
        //Update
        if(isset($data['booking_id'])){
            $booking_id = $this->new_booking($data);
            Yoyaku::where('booking_id', $data['booking_id'])->update(['history_id' => $booking_id]);
            Yoyaku::where('history_id', $data['booking_id'])->update(['history_id' => $booking_id]);

        //New
        }else{
            $result = $this->new_booking($data);
        }

        if(isset($result['bookingID'])){
            $result = [
                'status' => 'success',
                'message' => $result
            ];
        }else{
            $result = [
                'status' => 'error',
                'message' => '重複されているから、予約したデータはキャンセルされます。'
            ];
        }

        return  $result;
    }

    private function new_booking($data){
        $parent = true;
        $parent_id = NULL;
        $parent_date = NULL;

        DB::unprepared("LOCK TABLE tr_yoyaku WRITE, tr_yoyaku_danjiki_jikan WRITE");
        try{
            $result = [];
            $return_booking_id = null;
            DB::beginTransaction();
            if(isset($data['customer']['info']) == false){
                throw new \Exception('Course not found!');
            }
            try {
                foreach($data['customer']['info'] as $customer){
                    $Yoyaku = new Yoyaku;
                    if($parent){
                        $parent_id = $Yoyaku->booking_id = $this->get_booking_id();
                        $return_booking_id = $parent_id;
                        $parent_date = isset($customer['date-value'])?$customer['date-value']:NULL;
                        $parent_date = !isset($parent_date)?$customer['plan_date_start-value']:$parent_date;
                        $Yoyaku->ref_booking_id = NULL;
                        Log::debug('set_booking_course ' . $return_booking_id);
                        $this->set_booking_course($Yoyaku, $data, $customer,$parent, NULL);
                        Log::debug('set_yoyaku_danjiki_jikan ' . $return_booking_id);
                        $this->set_yoyaku_danjiki_jikan($customer, $parent, $parent_id, $parent_date);
                        $parent = false;
                    }else{
                        $booking_id = $Yoyaku->booking_id = $this->get_booking_id();
                        $return_booking_id = $booking_id;
                        $Yoyaku->ref_booking_id = $parent_id;
                        Log::debug('set_booking_course ' . $return_booking_id);
                        $this->set_booking_course($Yoyaku, $data, $customer,$parent, $parent_date);
                        Log::debug('set_yoyaku_danjiki_jikan ' . $return_booking_id);
                        $this->set_yoyaku_danjiki_jikan($customer, $parent, $booking_id, $parent_date);
                    }
                    $Yoyaku->save();
                }
                $result = $this->call_payment_api($data, $return_booking_id);
                DB::commit();
            } catch (\Exception $e1) {
                DB::rollBack();
                $this->add_column_null($return_booking_id);
                DB::unprepared("UNLOCK TABLE");
                Log::debug($e1->getMessage());
                return  $result;
            }
        }catch(\Exception $e2){
            Log::debug($e2->getMessage());
        }
        DB::unprepared("UNLOCK TABLE");
        return  $result;
    }

    private function add_column_null($booking_id){
        $Yoyaku = new Yoyaku;
        $Yoyaku->booking_id = $booking_id;
        $Yoyaku->course = 0;
        $Yoyaku->save();
    }

    private function call_payment_api(&$data, $booking_id){
        if($data['payment-method'] == 1){
            if(!isset($data['Token']) || !isset($data['Amount'])){
                throw new \ErrorException('Token error!');
            }
            $amount = preg_replace('~\D~', '', $data['Amount']);
            return $this->create_tran($booking_id, $amount, $data['Token']);
        }else{
            return [
                'bookingID' => $booking_id
            ];
        }

    }

    private function create_tran($booking_id, $amount, $token){
        $headers = array(
            'Connection' => 'keep-alive',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'no-cache',
            'Accept' => 'text/plain, */*; q=0.01',
            'Origin' => 'http://localhost:3000',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Sec-Fetch-Site' => 'cross-site',
            'Sec-Fetch-Mode' => 'cors',
            'Referer' => 'http://localhost:3000/',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7,fr-FR;q=0.6,fr;q=0.5,zh-CN;q=0.4,zh;q=0.3'
        );
        $data = array(
            'ShopID' =>  env("SHOP_ID"),
            'ShopPass' => env("SHOP_PASS"),
            'OrderID' => $booking_id,
            'Amount' => $amount,
            'JobCd' => 'CAPTURE'
        );
        Log::debug('data');
        Log::debug($data);
        $response = \Requests::post('https://pt01.mul-pay.jp/payment/EntryTran.idPass', $headers, $data);
        parse_str($response->body, $params);

        if(!isset($params['AccessID']) || !isset($params['AccessPass'])){
            Log::debug('Create tran body');
            Log::debug($response->body);
            throw new \ErrorException('Create tran error!');
        }
        return $this->exec_tran($params['AccessID'], $params['AccessPass'], $booking_id, $token);
    }
    private function exec_tran($accessID, $accessPass, $booking_id, $token){
        $headers = array(
            'Connection' => 'keep-alive',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'no-cache',
            'Accept' => 'text/plain, */*; q=0.01',
            'Origin' => 'http://localhost:3000',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Sec-Fetch-Site' => 'cross-site',
            'Sec-Fetch-Mode' => 'cors',
            'Referer' => 'http://localhost:3000/',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7,fr-FR;q=0.6,fr;q=0.5,zh-CN;q=0.4,zh;q=0.3'
        );
        $data = array(
            'AccessID' => $accessID,
            'AccessPass' => $accessPass,
            'OrderID' => $booking_id,
            'Method' => '1',
            'PayTimes' => '1',
            'Token' => $token
        );
        $response = \Requests::post('https://pt01.mul-pay.jp/payment/ExecTran.idPass', $headers, $data);
        Log::debug('Exec tran body');
        Log::debug($response->body);
        parse_str($response->body, $params);
        if($params['ACS'] == 0){
            return [
                'tranID' => $params['TranID'],
                'bookingID' => $booking_id
            ];
        }
    }

    private function set_yoyaku_danjiki_jikan($customer, $parent, $parent_id, $parent_date){
        $course = json_decode($customer['course']);
        if($course->kubun_id == '01'){
            $gender = json_decode($customer['gender']);
            foreach($customer['time'] as $time){
                $this->validate_course_human($gender->kubun_id, $parent_date, $time['value'], $time['bed']);

                $YoyakuDanjikiJikan = new YoyakuDanjikiJikan;
                $YoyakuDanjikiJikan->booking_id = $parent_id;
                $YoyakuDanjikiJikan->service_date = $parent_date;
                $YoyakuDanjikiJikan->service_time_1 = $time['value'];
                $YoyakuDanjikiJikan->notes = $time['bed'];
                $YoyakuDanjikiJikan->time_json = $time['json'];

                $YoyakuDanjikiJikan->save();
            }
        }elseif($course->kubun_id == '04'){
            $plan_date_start = isset($customer['plan_date_start-value'])?$customer['plan_date_start-value']:"";
            $plan_date_end = isset($customer['plan_date_end-value'])?$customer['plan_date_end-value']:"";
            $gender = json_decode($customer['gender']);
            foreach($customer['date'] as $date){
                Log::debug('course 4', $customer);
                $this->validate_course_human($gender->kubun_id, $date['day']['value'],  $date['from']['value'], $date['from']['bed']);
                $this->validate_course_human($gender->kubun_id, $date['day']['value'],  $date['to']['value'], $date['to']['bed']);

                $YoyakuDanjikiJikan = new YoyakuDanjikiJikan;
                $YoyakuDanjikiJikan->booking_id = $parent_id;
                $YoyakuDanjikiJikan->service_date = $date['day']['value'];
                $YoyakuDanjikiJikan->service_time_1 = $date['from']['value'];
                $YoyakuDanjikiJikan->service_time_2 = $date['to']['value'];
                $YoyakuDanjikiJikan->notes = $date['from']['bed'] . "-" . $date['to']['bed'];
//                $YoyakuDanjikiJikan->time_json = $time['json'];

                $YoyakuDanjikiJikan->save();
            }
        }
    }

    private function validate_course_human($gender, $date, $time, $bed){
        $course_1_2_4_validate = DB::select("
            (
                SELECT 			main.booking_id
                FROM			tr_yoyaku main
                INNER JOIN 	    tr_yoyaku_danjiki_jikan time
                ON				main.booking_id = time.booking_id
                WHERE			main.course = '01'
                AND             main.gender = $gender
                AND             time.service_date = $date
                AND             time.service_time_1 = $time
                AND             time.notes = $bed
                AND main.history_id IS NULL
            )
            UNION
            (
                SELECT 			main.booking_id
                FROM			tr_yoyaku main
                WHERE			main.course = '02'
                AND             main.gender = $gender
                AND             main.service_date_start = $date
                AND             main.service_time_1 = $time
                AND             SUBSTRING(main.bed, 1, 1) = $bed
                AND main.history_id IS NULL
            )
            UNION
            (
                SELECT 			main.booking_id
                FROM			tr_yoyaku main
                WHERE			main.course = '02'
                AND             main.gender = $gender
                AND             main.service_date_start = $date
                AND             main.service_time_2 = $time
                AND             SUBSTRING(main.bed, 3, 1) = $bed
                AND main.history_id IS NULL
            )
            UNION
            (
                SELECT 			main.booking_id
                FROM			tr_yoyaku main
                INNER JOIN 	    tr_yoyaku_danjiki_jikan time
                ON				main.booking_id = time.booking_id
                WHERE			main.course = '04'
                AND             main.gender = $gender
                AND             time.service_date = $date
                AND             time.service_time_1 = $time
                AND             SUBSTRING(time.notes, 1, 1) = $bed
                AND main.history_id IS NULL
            )
            UNION
            (
                SELECT 			main.booking_id
                FROM			tr_yoyaku main
                INNER JOIN 	    tr_yoyaku_danjiki_jikan time
                ON				main.booking_id = time.booking_id
                WHERE			main.course = '04'
                AND             main.gender = $gender
                AND             time.service_date = $date
                AND             time.service_time_2 = $time
                AND             SUBSTRING(time.notes, 3, 1) = $bed
                AND main.history_id IS NULL
            )

        ");

        if($gender == '01'){
            $course_3_validate = DB::select("
                SELECT 			main.booking_id
                FROM			tr_yoyaku main
                WHERE			main.course = '03'
                AND             main.service_date_start = $date
                AND             main.service_time_1 = $time
                AND             main.bed = $bed
                AND main.history_id IS NULL
            ");
        }


        if(
            (isset($course_1_2_4_validate) && (count($course_1_2_4_validate) != 0))
            || (isset($course_3_validate) && (count($course_3_validate) != 0))
        ){
            throw new \ErrorException('Course error!');
        }
    }





    private function set_booking_course(&$Yoyaku, $data, $customer,$parent, $parent_date){
        //General payment
        $Yoyaku->name = isset($data['name'])?$data['name']:null;
        $Yoyaku->phone = isset($data['phone'])?$data['phone']:null;
        $Yoyaku->email = isset($data['email'])?$data['email']:null;
        $Yoyaku->payment_method = isset($data['payment-method'])?$data['payment-method']:null;

        //General info
        $repeat_user = isset($customer['repeat_user'])?json_decode($customer['repeat_user']):null;
        $transport = isset($customer['transport'])?json_decode($customer['transport']):null;
        $bus_arrive_time_slide = isset($customer['bus_arrive_time_slide'])?json_decode($customer['bus_arrive_time_slide']):null;
        $pick_up = isset($customer['pick_up'])?json_decode($customer['pick_up']):null;

        //Option
        $course = isset($customer['course'])?json_decode($customer['course']):null;

        $Yoyaku->repeat_user = $repeat_user->kubun_id;
        $Yoyaku->transport = $transport->kubun_id;
        if($transport->kubun_id == '02'){
            $Yoyaku->bus_arrive_time_slide = $bus_arrive_time_slide->kubun_id;
            $Yoyaku->pick_up = $pick_up->kubun_id;
        }

        $Yoyaku->course = $course->kubun_id;
        if($course->kubun_id == '01'){
            $this->set_course_1($parent, $parent_date, $customer, $Yoyaku);
        }elseif($course->kubun_id == '02'){
            $this->set_course_2($parent, $parent_date, $customer, $Yoyaku);
        }elseif($course->kubun_id == '03'){
            $this->set_course_3($parent, $parent_date, $customer, $Yoyaku);
        }elseif($course->kubun_id == '04'){
            $this->set_course_4($parent, $parent_date, $customer, $Yoyaku);
        }elseif($course->kubun_id == '05'){
            $this->set_course_5($parent, $parent_date, $customer, $Yoyaku);
        }
    }


    private function validate_stay_room($room_type, $checkin, $checkout){
        Log::debug($room_type);
        Log::debug($checkin);
        Log::debug($checkout);
        $room_validate = DB::select("
            SELECT 	main.booking_id,
                    main.stay_checkin_date,
                    main.stay_checkout_date
            FROM	tr_yoyaku main
            WHERE	main.stay_room_type = $room_type
            AND	(   ( main.stay_checkin_date <= $checkout AND main.stay_checkout_date >= $checkout )
                OR 	( main.stay_checkin_date <= $checkin AND main.stay_checkout_date >= $checkout )
                OR 	( main.stay_checkin_date <= $checkin AND main.stay_checkout_date >= $checkin )
                OR 	( main.stay_checkin_date >= $checkin AND main.stay_checkout_date <= $checkout )
                )
            AND main.history_id IS NULL
        ");
        Log::debug($room_validate);
        if(isset($room_validate) && (count($room_validate) != 0)){
            throw new \ErrorException('Course error!');
        }
    }

    private function whitening_validate($date, $time){
        Log::debug('wt_validate');
        Log::debug($date);
        Log::debug($time);
        $wt_validate = DB::select("
            SELECT 	main.booking_id
            FROM	tr_yoyaku main
            WHERE	main.service_date_start = '$date'
            AND     main.whitening_time = '$time'
            AND main.history_id IS NULL
        ");
        Log::debug($wt_validate);
        if(isset($wt_validate) && (count($wt_validate) != 0)){
            throw new \ErrorException('Course error!');
        }
    }

    private function set_course_1($parent, $parent_date, $customer, &$Yoyaku){
        //Basic
        $gender = isset($customer['gender'])?json_decode($customer['gender']):"";
        $age_type = isset($customer['age_type'])?$customer['age_type']:"";
        $age_value = isset($customer['age_value'])?$customer['age_value']:"";

        //Option
        $lunch = isset($customer['lunch'])?json_decode($customer['lunch']):"";
        $whitening = isset($customer['whitening'])?json_decode($customer['whitening']):"";
        $pet_keeping = isset($customer['pet_keeping'])?json_decode($customer['pet_keeping']):"";

        //Stay
        $stay_room_type = isset($customer['stay_room_type'])?json_decode($customer['stay_room_type']):"";
        $stay_guest_num = isset($customer['stay_guest_num'])?json_decode($customer['stay_guest_num']):"";
        $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
        $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";
        $breakfast = isset($customer['breakfast'])?json_decode($customer['breakfast']):"";

        $date = isset($customer['date-value'])?$customer['date-value']:"";
        $bed = isset($customer['bed'])?$customer['bed']:"";


        $Yoyaku->gender = $gender->kubun_id;
        $Yoyaku->age_type = $age_type;
        if($age_type == 3){
            $Yoyaku->age_value = $age_value;
        }else{
            $Yoyaku->age_value = NULL;
        }

        $Yoyaku->bed = $bed;
        $Yoyaku->lunch = $lunch->kubun_id;
        $Yoyaku->whitening = $whitening->kubun_id;
        if($whitening->kubun_id == '02'){
            $whitening_time = isset($customer['whitening-time_value'])?$customer['whitening-time_value']:"";
            $whitening_repeat = isset($customer['whitening_repeat'])?$customer['whitening_repeat']:"";
            $Yoyaku->whitening_time = $whitening_time;
            $Yoyaku->whitening_repeat = $whitening_repeat;
        }
        $Yoyaku->pet_keeping = $pet_keeping->kubun_id;

        if($parent){
            $Yoyaku->service_date_start = $date;
            $Yoyaku->stay_room_type = $stay_room_type->kubun_id;
            if($stay_room_type->kubun_id != '01'){
                $this->validate_stay_room($stay_room_type->kubun_id, $stay_checkin_date, $stay_checkout_date);
                $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                $Yoyaku->stay_checkin_date = $stay_checkin_date;
                $Yoyaku->stay_checkout_date = $stay_checkout_date;
                $Yoyaku->breakfast = $breakfast->kubun_id;
            }
            if($whitening->kubun_id == '02'){
                $this->whitening_validate($date, $whitening_time);
            }
        }else{
            $Yoyaku->service_date_start = $parent_date;
            if($whitening->kubun_id == '02'){
                $this->whitening_validate($parent_date, $whitening_time);
            }
        }
    }

    private function set_course_2($parent, $parent_date, $customer, &$Yoyaku){
        //Basic
        $gender = isset($customer['gender'])?json_decode($customer['gender']):"";
        $age_value = isset($customer['age_value'])?$customer['age_value']:"";

        //Option
        $whitening = isset($customer['whitening'])?json_decode($customer['whitening']):"";
        $pet_keeping = isset($customer['pet_keeping'])?json_decode($customer['pet_keeping']):"";


        //Stay
        $stay_room_type = isset($customer['stay_room_type'])?json_decode($customer['stay_room_type']):"";
        $stay_guest_num = isset($customer['stay_guest_num'])?json_decode($customer['stay_guest_num']):"";
        $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
        $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";
        $breakfast = isset($customer['breakfast'])?json_decode($customer['breakfast']):"";

        //Date_Time
        $date = isset($customer['date-value'])?$customer['date-value']:"";
        $time1 = isset($customer['time1-value'])?$customer['time1-value']:"";
        $time2 = isset($customer['time2-value'])?$customer['time2-value']:"";
        $bed1 = isset($customer['time1-bed'])?$customer['time1-bed']:"";
        $bed2 = isset($customer['time2-bed'])?$customer['time2-bed']:"";



        $Yoyaku->gender = $gender->kubun_id;
        $Yoyaku->age_value = $age_value;
        $Yoyaku->service_time_1 = $time1;
        $Yoyaku->service_time_2 = $time2;
        $Yoyaku->bed = $bed1 . "-" .  $bed2;
        $Yoyaku->whitening = $whitening->kubun_id;
        if($whitening->kubun_id == '02'){
            $whitening_time = isset($customer['whitening-time_value'])?$customer['whitening-time_value']:"";
            $whitening_repeat = isset($customer['whitening_repeat'])?$customer['whitening_repeat']:"";
            $Yoyaku->whitening_time = $whitening_time;
            $Yoyaku->whitening_repeat = $whitening_repeat;
        }
        $Yoyaku->pet_keeping = $pet_keeping->kubun_id;

        if($parent){
            $Yoyaku->service_date_start = $date;
            $Yoyaku->stay_room_type = $stay_room_type->kubun_id;
            if($stay_room_type->kubun_id != '01'){
                $this->validate_stay_room($stay_room_type->kubun_id, $stay_checkin_date, $stay_checkout_date);
                $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                $Yoyaku->stay_checkin_date = $stay_checkin_date;
                $Yoyaku->stay_checkout_date = $stay_checkout_date;
                $Yoyaku->breakfast = $breakfast->kubun_id;
            }
            $this->validate_course_human($gender->kubun_id, $date,  $time1, $bed1);
            $this->validate_course_human($gender->kubun_id, $date,  $time2, $bed2);
            if($whitening->kubun_id == '02'){
                $this->whitening_validate($date, $whitening_time);
            }
        }else{
            $Yoyaku->service_date_start = $parent_date;
            $this->validate_course_human($gender->kubun_id, $parent_date,  $time1, $bed1);
            $this->validate_course_human($gender->kubun_id, $parent_date,  $time2, $bed2);
            if($whitening->kubun_id == '02'){
                $this->whitening_validate($parent_date, $whitening_time);
            }
        }
    }

    private function set_course_3($parent, $parent_date, $customer, &$Yoyaku){
        //Basic
        $date = isset($customer['date-value'])?$customer['date-value']:"";
        $time = isset($customer['time_room_value'])?$customer['time_room_value']:"";
        $bed = isset($customer['time_room_bed'])?$customer['time_room_bed']:"";
        $service_guest_num = isset($customer['service_guest_num'])?json_decode($customer['service_guest_num']):"";
        $lunch_guest_num = isset($customer['lunch_guest_num'])?json_decode($customer['lunch_guest_num']):"";

        //Option
        $whitening = isset($customer['whitening'])?json_decode($customer['whitening']):"";
        $pet_keeping = isset($customer['pet_keeping'])?json_decode($customer['pet_keeping']):"";

        //Stay
        $stay_room_type = isset($customer['stay_room_type'])?json_decode($customer['stay_room_type']):"";
        $stay_guest_num = isset($customer['stay_guest_num'])?json_decode($customer['stay_guest_num']):"";
        $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
        $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";
        $breakfast = isset($customer['breakfast'])?json_decode($customer['breakfast']):"";

        $Yoyaku->service_time_1 = $time;
        $Yoyaku->bed = $bed;
        $Yoyaku->service_guest_num = $service_guest_num->kubun_id;
        $Yoyaku->lunch_guest_num = $lunch_guest_num->kubun_id;
        $Yoyaku->whitening = $whitening->kubun_id;
        if($whitening->kubun_id == '02'){
            $whitening_time = isset($customer['whitening-time_value'])?$customer['whitening-time_value']:"";
            $whitening_repeat = isset($customer['whitening_repeat'])?$customer['whitening_repeat']:"";
            $Yoyaku->whitening_time = $whitening_time;
            $Yoyaku->whitening_repeat = $whitening_repeat;
        }
        $Yoyaku->pet_keeping = $pet_keeping->kubun_id;

        if($parent){
            $Yoyaku->service_date_start = $date;
            $Yoyaku->stay_room_type = $stay_room_type->kubun_id;
            if($stay_room_type->kubun_id != '01'){
                $this->validate_stay_room($stay_room_type->kubun_id, $stay_checkin_date, $stay_checkout_date);
                $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                $Yoyaku->stay_checkin_date = $stay_checkin_date;
                $Yoyaku->stay_checkout_date = $stay_checkout_date;
                $Yoyaku->breakfast = $breakfast->kubun_id;
            }
            $this->validate_course_human('01', $date,  $time, $bed);
            if($whitening->kubun_id == '02'){
                $this->whitening_validate($date, $whitening_time);
            }
        }else{
            $Yoyaku->service_date_start = $parent_date;
            $this->validate_course_human('01', $parent_date,  $time, $bed);
            if($whitening->kubun_id == '02'){
                $this->whitening_validate($parent_date, $whitening_time);
            }
        }
    }

    private function set_course_4($parent, $parent_date, $customer, &$Yoyaku){
        //Basic
        $gender = isset($customer['gender'])?json_decode($customer['gender']):"";
        $age_value = isset($customer['age_value'])?$customer['age_value']:"";
        $plan_date_start = isset($customer['plan_date_start-value'])?$customer['plan_date_start-value']:"";
        $plan_date_end = isset($customer['plan_date_end-value'])?$customer['plan_date_end-value']:"";

        //Option
        $pet_keeping = isset($customer['pet_keeping'])?json_decode($customer['pet_keeping']):"";

        //Stay
        $stay_room_type = isset($customer['stay_room_type'])?json_decode($customer['stay_room_type']):"";
        $stay_guest_num = isset($customer['stay_guest_num'])?json_decode($customer['stay_guest_num']):"";
        $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
        $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";

        $Yoyaku->gender = $gender->kubun_id;
        $Yoyaku->age_value = $age_value;
        $Yoyaku->pet_keeping = $pet_keeping->kubun_id;

        $Yoyaku->service_date_start = $plan_date_start;
        $Yoyaku->service_date_end = $plan_date_end;

        if($parent){
            $Yoyaku->stay_room_type = $stay_room_type->kubun_id;
            if($stay_room_type->kubun_id != '01'){
                $this->validate_stay_room($stay_room_type->kubun_id, $stay_checkin_date, $stay_checkout_date);
                $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                $Yoyaku->stay_checkin_date = $stay_checkin_date;
                $Yoyaku->stay_checkout_date = $stay_checkout_date;
            }
        }else{
            $Yoyaku->service_date_start = $parent_date;
        }
    }

    private function set_course_5($parent, $parent_date, $customer, &$Yoyaku){
        //Basic
        $date = isset($customer['date-value'])?$customer['date-value']:"";
        $time1 = isset($customer['time_room_time1'])?$customer['time_room_time1']:"";
        $time2 = isset($customer['time_room_time2'])?$customer['time_room_time2']:"";
        $service_pet_num = isset($customer['service_pet_num'])?json_decode($customer['service_pet_num']):"";
        $notes = isset($customer['notes'])?$customer['notes']:"";

        $Yoyaku->service_time_1 = $time1;
        $Yoyaku->service_time_2 = $time2;
        $Yoyaku->service_pet_num = $service_pet_num->kubun_id;
        $Yoyaku->notes = $notes;

        if($parent){
            $result = $this->validate_course_pet($date, $time1, $time2);
            $Yoyaku->service_date_start = $date;
        }else{
            $result = $this->validate_course_pet($parent_date, $time1, $time2);
            $Yoyaku->service_date_start = $parent_date;
        }
    }

    private function validate_course_pet($date, $time1, $time2){
        $course_5_validate = DB::select("
                SELECT 			main.booking_id
                FROM 			tr_yoyaku main
                WHERE			main.course = '05'
                AND             main.service_date_start = $date
                AND             main.service_time_1 = $time1
                AND             main.service_time_2 = $time2
                AND main.history_id IS NULL
        ");
        if(isset($course_5_validate) && (count($course_5_validate) != 0)){
            throw new \ErrorException('Course 4 error');
        }
    }


    public function get_booking_id(){
        $like_booking_id = date("Ymd");
        $result = Yoyaku::query()->where('booking_id', 'LIKE', $like_booking_id."%");
        return $like_booking_id.sprintf('%04d', ($result->count() + 1) );
    }

    public function get_time_validate_bus ($repeat_user, $transport, $bus_arrive_time_slide ) {
        if ($transport['kubun_id'] == config('const.db.kubun_id_value.transport.BUS') ) { // nếu đi xe bus'02'
            if ($repeat_user['kubun_id'] == config('const.db.kubun_id_value.repeat_user.NEW')) { // はじめて
                $time_required_min = config('const.db.time_validate.transport.bus.NEW'); // người tắm lần đầu 01
            } else { //　リピート
                $time_required_min = config('const.db.time_validate.transport.bus.OLD');  // người cũ 02
            }
            $time_bus_arrived = $bus_arrive_time_slide['notes'];
            return $this->plus_time_string ($time_bus_arrived, $time_required_min); // time required go early for BUS
        }
        return false;
    }

    public function get_time_room(Request $request){
        $data = $request->all();
        $repeat_user = json_decode($data['repeat_user'], true);
        $course = json_decode($data['course'], true);
        $data_get_attr = json_decode($data['data_get_attr'], true);
        $validate_time = null;

        if ($course['kubun_id'] == '03') {
            $gender = [];
            $gender['kubun_id'] = '01';
        } else {
            $gender = json_decode($data['gender'], true);
        }

        //dd($sections_booking);
        $day_book_time = '';
        $validate_ss_time = [];
        $range_time_validate = [];
        if ($day_book_time == '')
        if (isset($data['date-value'])) { // date Tắm bình thường 1 day refresh
            $day_book_time = $data['date-value'];
        } else if ($day_book_time == '' && isset($data_get_attr['date']))  {
            $day_book_time = $data_get_attr['date'];
        }
        $sections_booking = $this->get_booking($request);
        if (count($sections_booking) > 0) { // Th add thêm người
            $transport = json_decode($sections_booking['transport'], true);
            $bus_arrive_time_slide = json_decode($sections_booking['bus_arrive_time_slide'], true);
            //dd($sections_booking['info']);
            $day_book_time_ss = $sections_booking['date-value'];
            if ($day_book_time == ''){
                $day_book_time = $day_book_time_ss;
            }
            foreach ($sections_booking['info'] as $key => $booking_ss) {
                $course_ss = json_decode($booking_ss['course'], true);
                if ($course_ss['kubun_id'] !== config('const.db.kubun_id_value.course.PET')) {
                    if ($course_ss['kubun_id'] == config('const.db.kubun_id_value.course.BOTH_ALL_ROOM')) { // fasting plan
                        $gender_ss_id = '01';
                    } else {
                        $gender_ss = json_decode($booking_ss['gender'], true);
                        $gender_ss_id = $gender_ss['kubun_id'];

                    }
                    //dd($gender_ss_id);
                    if ($gender['kubun_id'] == $gender_ss_id) {
                        foreach ($booking_ss['time'] as $k_time => $v_time) {
                            if ($course_ss['kubun_id'] == config('const.db.kubun_id_value.course.FASTING_PLAN')) { // fasting plan
                                $tmp_time = json_decode($v_time['from']['json'], true);
                                if ($tmp_time['date_booking'] == $day_book_time) {
                                    $from = json_decode($v_time['from']['json'], true);
                                    $to = json_decode($v_time['to']['json'], true);
                                    $validate_ss_time[$key]['time_from']['time'] = $from['notes'];
                                    $validate_ss_time[$key]['time_to']['time'] = $to['notes'];
                                    $validate_ss_time[$key]['time_from']['bed'] = $from['kubun_id_room'];
                                    $validate_ss_time[$key]['time_to']['bed'] = $to['kubun_id_room'];
                                }

                            } else {
                                if ($day_book_time == $day_book_time_ss) {
                                    $ss_time = json_decode($v_time['json'], true);
                                    if ($course_ss['kubun_id'] == config('const.db.kubun_id_value.course.BOTH_ALL_ROOM')) {
                                        $range_time_validate[$key]['start_time'] = $ss_time['notes'];
                                        $range_time_validate[$key]['end_time'] =  $this->plus_time_string($ss_time['notes'], 120);
                                        $range_time_validate[$key]['bed'] = $ss_time['kubun_id_room'];
                                    } else {
                                        $validate_ss_time[$key][$k_time]['time'] = $ss_time['notes'];
                                        $validate_ss_time[$key][$k_time]['bed'] = $ss_time['kubun_id_room'];
                                    }

                                }
                            }

                        }

                    }
                    //dd($validate_ss_time);
                }
            }

            //dd($validate_ss_time);
        } else { // th booking mới
            $transport = json_decode($data['transport'], true);
            $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);

        }

        $this->fetch_kubun_data($data);
        $validate_time = [];
        $this->get_validate_time_choice ($course, $data, $data_get_attr, $validate_time, $day_book_time);
        $time_bus = $this->get_time_bus_customer($repeat_user, $transport, $bus_arrive_time_slide);
        $data_time = $this->get_date_time($gender, $data, $validate_time, $day_book_time, $time_bus, $validate_ss_time, $course, $data_get_attr, $range_time_validate);


        return view('sunsun.front.parts.booking_time',$data_time)->render();
    }

    public function get_date_time($gender, $data, $validate_time, $day_book_time, $time_bus, $validate_ss_time, $course, $data_get_attr, $range_time_validate ) {
        $kubun_type_time = config('const.db.kubun_type_value.TIME'); // 013 kubun_type
        $data_time = [];
        if ($course['kubun_id'] == '03') {
            $time_kubun_type_book_room = config('const.db.kubun_type_value.TIME_BOOK_ROOM'); //014
            $kubun_type_bed_male = config('const.db.kubun_type_value.bed_male'); // 017
            $data_time['beds'] = $data['bed_male'];
            $data_time_room = $this->get_time_room_booking($time_kubun_type_book_room, $kubun_type_bed_male, $validate_time, $day_book_time, $time_bus, $validate_ss_time, [], $range_time_validate);
        } else {
            if($gender['kubun_id'] == '01'){ // for man
                $kubun_type_bed_male = config('const.db.kubun_type_value.bed_male'); // 017 kubun_type
                $data_time['beds'] = $data['bed_male'];
                $data_time_room = $this->get_time_room_booking($kubun_type_time, $kubun_type_bed_male, $validate_time, $day_book_time, $time_bus, $validate_ss_time, [], $range_time_validate);
            }else{ //for woman
                $kubun_type_bed_female = config('const.db.kubun_type_value.bed_female'); // 018 kubun_type
                $data_time['beds'] = $data['bed_female'];
                $data_time_room = $this->get_time_room_booking($kubun_type_time, $kubun_type_bed_female, $validate_time, $day_book_time, $time_bus, $validate_ss_time, [], $range_time_validate);
            }
        }
        //dd($data_time_room);
        $tmp_time_room = [];
        foreach ($data_time_room as $key => $time_room) {
            $tmp_time_room[$time_room->kubun_id][$time_room->kubun_value_room] = $time_room;
        }
        $data_time['time_room'] = $tmp_time_room;
        //dd($data);
        $data_time['gender'] = $gender;
        if (isset($data_get_attr['new'])) {
            $data_time['new'] = 1;
        }
        return $data_time;
    }

    public function get_time_bus_customer($repeat_user, $transport, $bus_arrive_time_slide) {
        // check time bus
        $time_bus = null;
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false) {
                $time_bus = $check_bus;
            }
        }
        return $time_bus;
    }

    public function get_validate_time_choice ($course, $data, $data_get_attr, &$validate_time, &$day_book_time) {

        if ($course['kubun_id'] == config('const.db.kubun_id_value.course.NORMAL')) { // Tắm bình thường
            if ((count($data['time']) > 0 && isset($data_get_attr['new'])) || (count($data['time']) > 1)) {
                foreach ($data['time'] as $key => $time_book) {
                    if ($time_book['value'] != '0') {
                        $validate_time[$key]['max'] = $this->plus_time_string($time_book['value'], 120); // plus 2h between 2 times shower
                        $validate_time[$key]['min'] = $this->minus_time_string($time_book['value'], 120); // minus 2h between 2 times shower
                    }
                }

            }
        } else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.1_DAY_REFRESH')) { // 1 day refresh
            if ($data_get_attr['date_type'] == 'shower_1' && $data['time2-value'] != '0') {
                $validate_time['1_DAY_REFRESH']['max'] = $this->plus_time_string($data['time2-value'], 120); // plus 2h between 2 times shower
                $validate_time['1_DAY_REFRESH']['min'] = $this->minus_time_string($data['time2-value'], 120); // plus 2h between 2 times shower
            } else if ($data_get_attr['date_type'] == 'shower_2' && $data['time1-value'] != '0') {
                $validate_time['1_DAY_REFRESH']['max'] = $this->plus_time_string($data['time1-value'], 120); // plus 2h between 2 times shower
                $validate_time['1_DAY_REFRESH']['min'] = $this->minus_time_string($data['time1-value'], 120); // plus 2h between 2 times shower
            }
            //dd($data);
        } else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.FASTING_PLAN')) { // fasting plan
            $type = $data_get_attr['date_type'];
            $day_book_time = $data_get_attr['date'];
            if ($type == 'to') {
                $date_select = $data['date'];
                $tmp_time = [];
                foreach ($date_select as $key => $value) {
                    $date = $data_get_attr['date'];
                    if ($date == $value['day']['value']) {
                        $tmp_time[] = $value['from']['value'];
                    }
                }
                $time_validate = collect($tmp_time)->max();

                $validate_time['FASTING_PLAN']['max'] = $this->plus_time_string($time_validate, 120); // plus 2h between 2 times shower
                $validate_time['FASTING_PLAN']['min'] = $this->minus_time_string($time_validate, 120); // plus 2h between 2 times shower
            }

        }
        //return $validate_time;
    }


    /**
     * @param $time_kubun_type
     * @param $room_kubun_type
     * @param null $time_bath is the time validate if shower many times
     * @param $day_book_time
     * @param $time_bus
     * @param $validate_ss_time
     * @param $data_course array
     * @param $range_time_validate
     * @return array
     */
    public function get_time_room_booking ($time_kubun_type, $room_kubun_type, $time_bath, $day_book_time, $time_bus, $validate_ss_time, $data_course = array(), $range_time_validate = []) {

        $gender = '';
        $sql_join_on = '';
        $sql_where_yoyaku = '';
        $sql_where = '';
        $time_date_booking = $day_book_time;
        if ($room_kubun_type == '017') {
            $gender = '01';
        } else if ($room_kubun_type == '018') {
            $gender = '02';
        } else if ($time_kubun_type == config('const.db.kubun_type_value.TIME_PET')) {
            $sql_join_on = " OR (ytm.course = '05' AND mk1.notes = CONCAT(ytm.service_time_1,'-', ytm.service_time_2)) ";
            $sql_pet_where = " OR (ty.course = '05') ";
            $sql_where_yoyaku = $sql_pet_where;
        } else if ($time_kubun_type == config('const.db.kubun_type_value.TIME_WHITENING'))  { // 021
            $sql_join_on .= " OR SUBSTRING(mk1.notes, 1 ,9) = ytm.whitening_time ";
            $hand_code = $data_course['whitening_repeat'];
            $sql_where .= " AND SUBSTRING(mk1.notes, 11) = $hand_code ";
            if ($hand_code == 0) {
                $sql_where .= "
                OR SUBSTRING(mk1.notes, 11) = '1'
            ";
            }
            $sql_where_yoyaku =  " OR ty.whitening = '02' "; // có chọn tắm trắng
        }
        $sql_get_booking = $this->sql_get_booking_yoyaku($sql_where_yoyaku);
        $sql_get_booking = str_replace(':date_booking', $time_date_booking, $sql_get_booking);
        $sql_get_booking = str_replace(':gender_booking', $gender, $sql_get_booking);


        $data_sql = [
            'time_kubun_type' => $time_kubun_type,
            'room_kubun_type' => $room_kubun_type,
            'bed_male' => '017',
            'bed_female' => '018',
            'date_booking' => $time_date_booking
        ];
        if ($time_bus !== null) {
            $data_sql['time_bus'] = $time_bus;
        }
        $sql_select = "
                -- SELECT time & room
               SELECT
                mk1.*
                , mk2.kubun_id as kubun_id_room
                , mk2.kubun_value as kubun_value_room
                , mk2.notes as notes_room
                , CASE
                    WHEN mk2.kubun_type = :bed_male THEN 'male'
                    WHEN mk2.kubun_type = :bed_female THEN 'female'
                    ELSE 'other'
                    END as gender
                , mk2.kubun_type as gender_type
                , ytm.gender_ytm
                , ytm.course as course_ytm
                , ytm.booking_id
                , :date_booking as date_booking
                , mk2.sort_no

        ";
        $sql_bus = "";
        if ($time_bus !== null) {
            if ($time_kubun_type == config('const.db.kubun_type_value.TIME_WHITENING')) { // 021
                $sql_bus = "
                 AND SUBSTRING(mk1.notes, 1 ,4) > :time_bus
                ";
            } else {
                $sql_bus = "
                 AND mk1.notes > :time_bus
            ";
            }

        }
        $sql_time_path = "";

        if (count($time_bath) > 0) {
            foreach ($time_bath as $time) {
                $time_max = $time['max']; $time_min = $time['min'];
                if ($time_kubun_type == config('const.db.kubun_type_value.TIME_WHITENING')) { // 021
                    $sql_time_path .= " AND ( SUBSTRING(mk1.notes, 1 ,4) > '$time_max' OR SUBSTRING(mk1.notes, 1 ,4) < '$time_min') ";
                } else {
                    $sql_time_path .= " AND ( mk1.notes > '$time_max' OR mk1.notes < '$time_min') ";
                }

            }
        }

        $sql_validate_ss = "";
        if (count($validate_ss_time) > 0) {
            $sql_validate_ss .= "WHEN '01' = '01'  AND (";
            $count = 0;
            foreach ($validate_ss_time as $key_ss_t => $value_ss_t) {
                foreach ($value_ss_t as $key_ss => $value_ss) {
                    $time = $value_ss['time'];  $or = '';
                    $sql_bed = "";
                    if (isset($value_ss['bed']) && $value_ss['bed'] != '') {
                        $bed = $value_ss['bed'];
                        $sql_bed = " AND mk2.kubun_id =  '$bed' ";
                    }
                    if ($count != 0) {
                        $or = " OR ";
                    }
                    $sql_validate_ss .= "
                        $or ( mk1.notes = '$time'  $sql_bed )
                    ";
                    $count ++;
                }
            }
            $sql_validate_ss .= " ) THEN 0 ";
        }

        $sql_range = '';
        if (count($range_time_validate) > 0) { // validate book nguyen room
            $sql_range .= "WHEN '01' = '01'  AND (";
            $count_range = 0;
            foreach ($range_time_validate as $key_range => $value_range) {
                $start_time = $value_range['start_time'];  $or = '';
                $end_time = $value_range['end_time'];
                $bed = $value_range['bed'];

                if ($count_range != 0) {
                    $or = " OR ";
                }
                $sql_range .= "
                        $or ( mk1.notes >= '$start_time' AND mk1.notes <= '$end_time' AND mk2.kubun_id =  '$bed' AND mk2.kubun_type = '017' )
                    ";
                $count_range ++;

            }
            $sql_range .= " ) THEN 0 ";
        }

        $sql_get_check_room_free ="
            , CASE
                    $sql_range
                    $sql_validate_ss
                    WHEN ytm.course IS NULL $sql_bus $sql_time_path THEN 1
                    ELSE 0
                    END as status_time_validate
        ";
        $sql_join = "
            FROM ms_kubun mk1
            INNER JOIN ms_kubun mk2 ON mk2.kubun_type = :room_kubun_type
            LEFT JOIN
                 (
                    $sql_get_booking
                 )as ytm
	            ON
                    (mk1.notes = ytm.service_time_1 AND mk2.kubun_value = ytm.bed_service_1)
                    OR (mk1.notes = ytm.service_time_2 AND mk2.kubun_value = ytm.bed_service_2 )
                    OR (
                            ytm.course = '03' AND mk2.kubun_type = '017' AND mk2.kubun_value = ytm.bed_service_2
                            AND mk1.notes >= ytm.service_time_1 AND mk1.notes <= ytm.service_time_2
                       )
                    $sql_join_on
        ";
        $sql_where = "
            WHERE mk1.kubun_type = :time_kubun_type
            $sql_where
        ";
        $sql_group = "
            GROUP BY mk1.ms_kubun_id, mk1.kubun_type, mk1.kubun_id, mk1.kubun_value, mk1.sort_no, mk1.notes, mk2.kubun_id
                    , mk2.kubun_value, mk2.notes, gender, gender_type, status_time_validate, mk2.sort_no
                    , ytm.booking_id,  ytm.gender_ytm, course_ytm
            ORDER BY mk2.sort_no, mk1.sort_no
        ";
        $sql = "$sql_select
                $sql_get_check_room_free
                $sql_join
                $sql_where
                $sql_group
        ";
        //DB::connection()->enableQueryLog();
        $time_request = DB::select($sql, $data_sql);
        //$queries = DB::getQueryLog();
        //dd($queries);
        return $time_request;
    }


    public function sql_get_booking_yoyaku ($sql_where = "") {
        return "
            SELECT
                CASE
                    WHEN ty.course = '01' OR ty.course = '04' THEN tydj.service_time_1
                    ELSE ty.service_time_1
                    END AS service_time_1
                , CASE
                    WHEN ty.course = '01' OR ty.course = '04' THEN tydj.service_time_2
                    WHEN  ty.course = '03' THEN ty.service_time_1 + '0100'
                    ELSE ty.service_time_2
                    END AS service_time_2

                , CASE
                    WHEN ty.course = '01' OR ty.course = '04'  THEN SUBSTRING(tydj.notes, 1 ,1)
                    ELSE SUBSTRING(ty.bed, 1 ,1)
                    END AS bed_service_1
                , CASE
                    WHEN ty.course = '01' OR ty.course = '04'   THEN SUBSTRING(tydj.notes, 3 ,1)
                    WHEN  ty.course = '03' THEN SUBSTRING(ty.bed, 1 ,1)
                    ELSE SUBSTRING(ty.bed, 3 ,1)
                    END AS bed_service_2
                , CASE
                    WHEN ty.course = '01' OR ty.course = '04'   THEN tydj.service_date
                    ELSE ty.service_date_start
                    END AS service_date
                ,
                   ty.course
                , ty.service_time_1 as service_time_1_ty
                , ty.service_time_2 as service_time_2_ty
                , ty.service_date_start as service_date_start
                , ty.service_date_end as service_date_end
                , tydj.service_time_1 as service_time_1_tydj
                , tydj.service_time_2 as service_time_2_tydj
                , tydj.service_date  as service_date_tydj
                , ty.gender as gender_ytm
                , ty.booking_id
                , ty.whitening
                , ty.whitening_time
			FROM tr_yoyaku  ty
			LEFT JOIN tr_yoyaku_danjiki_jikan tydj ON ty.booking_id = tydj.booking_id
			WHERE (
			        ty.gender = ':gender_booking' -- 01 for male 02 for female
			        OR ( '01' = ':gender_booking' AND	 ty.gender IS NULL AND ty.course = '03'  ) -- book all room for bed male
			        $sql_where
			      )
			AND
			    (
			        ( (ty.course = '01' OR ty.course = '04')  AND tydj.service_date = ':date_booking' )
				    OR (ty.service_date_start =  ':date_booking' )
				    -- OR (ty.service_date_start <=  ':date_booking' AND ty.service_date_end >= ':date_booking' ) check them
			    )
        ";
    }

    /**
     * Combines SQL and its bindings
     *
     * @param \Eloquent $query
     * @return string
     */
    public static function getEloquentSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return  "'{$binding}'";
        })->toArray());
    }

    /*public function book_room (Request $request) {
        $data = $request->all();
        $repeat_user = json_decode($data['repeat_user'], true);
        $course = json_decode($data['course'], true);
        $data_get_attr = json_decode($data['data_get_attr'], true);
        $time_bus = null;
        $time_bath = [];
        $sections_booking = $this->get_booking($request);
        //dd($sections_booking);
        $day_book_time = '';
        $validate_ss_time = [];
        if (count($sections_booking) > 0) { // Th add thêm người
            $transport = json_decode($sections_booking['transport'], true);
            $bus_arrive_time_slide = json_decode($sections_booking['bus_arrive_time_slide'], true);
            //$day_book_time = $sections_booking['date-value'];
            if (isset($sections_booking['date-value'])) { // date Tắm bình thường 1 day refresh
                $day_book_time = $sections_booking['date-value'];
            } else {
                $day_book_time = '01';
            }
        } else { // th booking mới
            $transport = json_decode($data['transport'], true);
            $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);
            if (isset($data['date-value'])) { // date Tắm bình thường 1 day refresh
                $day_book_time = $data['date-value'];
            }
        }


        // check time bus
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false) {
                $time_bus = $check_bus;
            }
        }
        // dd($data);
        $time_kubun_type_book_room = config('const.db.kubun_type_value.TIME_BOOK_ROOM'); //014
        $kubun_type_bed_male = config('const.db.kubun_type_value.bed_male'); // 017
        $data_time_room = $this->get_time_room_booking($time_kubun_type_book_room, $kubun_type_bed_male, $time_bath, $day_book_time, $time_bus, $validate_ss_time);
        $tmp_time_room = [];
        foreach ($data_time_room as $key => $time_room) {
            $tmp_time_room[$time_room->kubun_id][] = $time_room;
        }
        //dd($tmp_time_wt);
        $data_time['time_book_all_room'] = $tmp_time_room;
        $MsKubun = MsKubun::all();
        $data_time['beds'] = $MsKubun->where('kubun_type',$kubun_type_bed_male)->sortBy('sort_no');
        return view('sunsun.front.parts.booking_room',$data_time)->render();

    }*/

    /*public function get_time_booking_all_room ($time_kubun_type, $room_kubun_type, $time_bath, $day_book_time, $time_bus) {
        $sql_get_booking = $this->sql_get_booking_yoyaku();
        $gender = '';
        $time_date_booking = $day_book_time;
        if ($room_kubun_type == '017') {
            $gender = '01';
        } else if ($room_kubun_type == '018') {
            $gender = '02';
        }
        $sql_get_booking = str_replace(':date_booking', $time_date_booking, $sql_get_booking);
        $sql_get_booking = str_replace(':gender_booking', $gender, $sql_get_booking);

        $data_sql = [
            'time_kubun_type' => $time_kubun_type,
            'room_kubun_type' => $room_kubun_type,
            'bed_male' => '017',
            'bed_female' => '018'
        ];
        if ($time_bus !== null) {
            $data_sql['time_bus'] = $time_bus;
        }
        $sql_select = "
                -- SELECT time & room
               SELECT
                mk1.*
                , mk2.kubun_id as kubun_id_room
                , mk2.kubun_value as kubun_value_room
                , mk2.notes as notes_room
                , CASE
                    WHEN mk2.kubun_type = :bed_male THEN 'male'
                    WHEN mk2.kubun_type = :bed_female THEN 'female'
                    ELSE 'other'
                    END as gender
                , mk2.kubun_type as gender_type
                , ytm.gender_ytm
                , ytm.course as course_ytm
                , ytm.booking_id
        ";
        $sql_bus = "";
        if ($time_bus !== null) {
            $sql_bus = "
                 AND mk1.notes > :time_bus
            ";
        }
        $sql_time_path = "";
        if (count($time_bath) > 0) {
            foreach ($time_bath as $time) {
                $time_max = $time['max']; $time_min = $time['min'];
                $sql_time_path .= " AND ( mk1.notes > '$time_max' OR mk1.notes < '$time_min') ";
            }
        }

        $sql_get_check_room_free ="
            , CASE
                    WHEN ytm.course IS NULL $sql_bus $sql_time_path THEN 1
                    ELSE 0
                    END as status_time_validate
        ";
        $sql_join = "
            FROM ms_kubun mk1
            INNER JOIN ms_kubun mk2 ON mk2.kubun_type = :room_kubun_type
            LEFT JOIN
                 (
                    $sql_get_booking
                 )as ytm
	            ON
                    (mk1.notes = ytm.service_time_1 AND mk2.kubun_value = ytm.bed_service_1)
                    OR (mk1.notes = ytm.service_time_2 AND mk2.kubun_value = ytm.bed_service_2 )
                    OR (ytm.course = '03' AND ytm.gender_ytm = '01' AND mk2.kubun_value = ytm.bed_service_2 AND mk1.notes >= ytm.service_time_1 AND mk1.notes <= ytm.service_time_2  )
        ";
        $sql_where = "
            WHERE mk1.kubun_type = :time_kubun_type

        ";
        $sql_group = "
            GROUP BY mk1.ms_kubun_id, mk1.kubun_type, mk1.kubun_id, mk1.kubun_value, mk1.sort_no, mk1.notes, mk2.kubun_id
                    , mk2.kubun_value, mk2.notes, gender, gender_type, status_time_validate, sunsun.mk2.sort_no
                    , ytm.booking_id,  ytm.gender_ytm, course_ytm
            ORDER BY  mk2.sort_no, mk1.sort_no
        ";
        $sql = "$sql_select
                $sql_get_check_room_free
                $sql_join
                $sql_where
                $sql_group
        ";
        //DB::connection()->enableQueryLog();
        $time_request = DB::select($sql, $data_sql);
        //$queries = DB::getQueryLog();
        //dd($queries);
        return $time_request;
    }*/

    public function book_time_room_wt (Request $request) {
        $data = $request->all();
        $repeat_user = json_decode($data['repeat_user'], true);
        $whitening_repeat = $data['whitening_repeat'];
        //$transport = json_decode($data['transport'], true);
        $course = json_decode($data['course'], true);
        $data_get_attr = json_decode($data['data_get_attr'], true);
        //$bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);
        $validate_time = [];
        $day_book_time = '';
        $validate_ss_time = [];
        if (isset($data['date-value'])) { // date Tắm bình thường 1 day refresh
            $day_book_time = $data['date-value'];
        }

        $sections_booking = $this->get_booking($request);
        if (count($sections_booking) > 0) { // Th add thêm người
            $transport = json_decode($sections_booking['transport'], true);
            $bus_arrive_time_slide = json_decode($sections_booking['bus_arrive_time_slide'], true);
            //dd($sections_booking['info']);
            $day_book_time_ss = $sections_booking['date-value'];
            if ($day_book_time == ''){
                $day_book_time = $day_book_time_ss;
            }
            foreach ($sections_booking['info'] as $key_ss => $value_ss) {
                if (isset($value_ss['whitening_data']) && $value_ss['whitening_data']['json'] != null) {
                    $data_whitening = json_decode($value_ss['whitening_data']['json'], true);
                    $validate_ss_time[$key_ss]['data']['time'] = $data_whitening['notes'];
                }

            }

            //dd($validate_ss_time);
        } else { // th booking mới
            $transport = json_decode($data['transport'], true);
            $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);

        }
        //dd($whitening_repeat);
        if ($whitening_repeat == '1') {
            $time_wait = 15;
        } else {
            $time_wait = 30;
        }
        if ($course['kubun_id'] == config('const.db.kubun_id_value.course.NORMAL')) { // Tắm bình thường
            foreach ($data['time'] as $key => $time_book) {
                if ($time_book['value'] != '0') {
                    $validate_time[$key]['max'] = $this->plus_time_string($time_book['value'], 120 + $time_wait); // 120p tắm bt + time wait
                    $validate_time[$key]['min'] = $this->minus_time_string($time_book['value'], 30 + $time_wait); // 30p tắm trang + time wait
                }
            }
        } else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.1_DAY_REFRESH')) { // 1 day refresh
            if ($data_get_attr['date_type'] == 'shower_1' && $data['time2-value'] != '0') {
                $validate_time['1_DAY_REFRESH']['max'] = $this->plus_time_string($data['time2-value'], 120 + $time_wait); // 120p tắm bt + time wait
                $validate_time['1_DAY_REFRESH']['min'] = $this->minus_time_string($data['time2-value'], 30 + $time_wait); // 30p tắm trang + time wait
            } else if ($data_get_attr['date_type'] == 'shower_2' && $data['time1-value'] != '0') {
                $validate_time['1_DAY_REFRESH']['max'] = $this->plus_time_string($data['time1-value'], 120 + $time_wait); // 120p tắm bt + time wait
                $validate_time['1_DAY_REFRESH']['min'] = $this->minus_time_string($data['time1-value'], 30 + $time_wait); // 30p tắm trang + time wait
            }
            //dd($data);
        }  else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.BOTH_ALL_ROOM')) { // All room
            $validate_time['BOTH_ALL_ROOM']['max'] = $this->plus_time_string($data['time_room_value'], 120 + $time_wait); // 120p tắm bt + time wait
            $validate_time['BOTH_ALL_ROOM']['min'] = $this->minus_time_string($data['time_room_value'], 30 + $time_wait); // 30p tắm trang + time wait

        }
        // check time bus
        $time_bus = null;
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false) {
                $time_bus = $check_bus;
            }
        }
        // dd($data);
        $time_kubun_type_whitening = config('const.db.kubun_type_value.TIME_WHITENING'); //021
        $kubun_type_bed = config('const.db.kubun_type_value.bed_pet'); // 19
        $data_course['whitening_repeat'] = $whitening_repeat;
        $data_time_room = $this->get_time_room_booking ($time_kubun_type_whitening, $kubun_type_bed, $validate_time, $day_book_time, $time_bus, $validate_ss_time, $data_course);
        //$data_time_room = $this->get_time_room_whitening($time_kubun_type_whitening, $kubun_type_bed_male, $validate_time,$repeat_user, $whitening_repeat);
        $tmp_time_wt = [];
        foreach ($data_time_room as $key => $time_room) {
            $tmp_time_wt[$time_room->kubun_id][] = $time_room;
        }
        //dd($tmp_time_wt);
        $data_time['time_whitening'] = $tmp_time_wt;
        $MsKubun = MsKubun::all();
        $data_time['beds'] = $MsKubun->where('kubun_type','019')->sortBy('sort_no');
        return view('sunsun.front.parts.booking_room_wt',$data_time)->render();
    }

   /* public function get_time_room_whitening ($time_kubun_type, $room_kubun_type, $time_bath = null, $repeat_user, $whitening_repeat) {
        $data_sql = [
            'time_kubun_type' => $time_kubun_type,
            'room_kubun_type' => $room_kubun_type,
            'bed_male' => '017',
            'bed_female' => '018'
        ];
        if ($time_bath !== null) {
            $data_sql['time_bath'] = $time_bath;
        }

        $data_sql['hand_code'] = $whitening_repeat;

        $sql_select = "
                -- SELECT time & room
               SELECT
                mk1.*
                , mk2.kubun_id as kubun_id_room
                , mk2.kubun_value as kubun_value_room
                , mk2.notes as notes_room
                , SUBSTRING(mk1.notes, 11) as user_type
                , SUBSTRING(mk1.notes, 1, 4) as time_start
                , SUBSTRING(mk1.notes, 6, 4) as end_time
                , CASE
                    WHEN mk2.kubun_type = :bed_male THEN 'male'
                    WHEN mk2.kubun_type = :bed_female THEN 'female'
                    ELSE 'other'
                    END as gender
                , mk2.kubun_type as gender_type
        ";
        if ($time_bath !== null) {
            $sql_select .= "
                 , CASE
                    WHEN mk1.notes > :time_bath THEN 1
                    ELSE 0
                    END as status_time_validate
            ";
        }
        $sql = "$sql_select
            FROM ms_kubun mk1
            INNER JOIN ms_kubun mk2 ON mk2.kubun_type = :room_kubun_type
            WHERE mk1.kubun_type = :time_kubun_type
                AND SUBSTRING(mk1.notes, 11) = :hand_code
        ";
        if ($data_sql['hand_code'] == 0) {
            $sql .= "
                OR SUBSTRING(mk1.notes, 11) = '1'
            ";
        }
        $sql .= "
            ORDER BY  mk2.sort_no, mk1.sort_no
        ";
        return DB::select($sql, $data_sql);
    }*/

    public function book_time_room_pet (Request $request) {
        $data = $request->all();
        $repeat_user = json_decode($data['repeat_user'], true);
        $course = json_decode($data['course'], true);
        //$data_get_attr = json_decode($data['data_get_attr'], true);
        //$bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);
        $validate_time = null;
        $time_bath = [];
        $validate_ss_time = [];
        $time_bus = null;
        $day_book_time = '';
        if (isset($data['date-value'])) {
            $day_book_time = $data['date-value'];
        }

        $sections_booking = $this->get_booking($request);
        if (count($sections_booking) > 0) { // Th add thêm người
            $transport = json_decode($sections_booking['transport'], true);
            $bus_arrive_time_slide = json_decode($sections_booking['bus_arrive_time_slide'], true);
            //dd($sections_booking['info']);
            $day_book_time_ss = $sections_booking['date-value'];
            if ($day_book_time == ''){
                $day_book_time = $day_book_time_ss;
            }
            foreach ($sections_booking['info'] as $key => $booking_ss) {
                $course_ss = json_decode($booking_ss['course'], true);
                if ($course_ss['kubun_id'] == config('const.db.kubun_id_value.course.PET')) {

                    foreach ($booking_ss['time'] as $k_time => $v_time) {
                        if ($day_book_time == $day_book_time_ss) {
                            $ss_time = json_decode($v_time['json'], true);
                            $validate_ss_time[$key][$k_time]['time'] = $ss_time['notes'];
                            $validate_ss_time[$key][$k_time]['bed'] = $ss_time['kubun_id_room'];
                        }

                    }

                    //dd($validate_ss_time);
                }
            }

            //dd($validate_ss_time);
        } else { // th booking mới
            $transport = json_decode($data['transport'], true);
            $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);

        }

        // check time bus
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false ) {
                $time_bus = $check_bus;
            }
        }
        $MsKubun = MsKubun::all();
        $data_time['beds'] = $MsKubun->where('kubun_type','019')->sortBy('sort_no');
        $time_kubun_type_pet = config('const.db.kubun_type_value.TIME_PET'); //020
        $kubun_type_bed_pet = config('const.db.kubun_type_value.bed_pet'); // 19
        $data_time_room_pet = $this->get_time_room_booking ($time_kubun_type_pet, $kubun_type_bed_pet, $time_bath, $day_book_time, $time_bus, $validate_ss_time);
        //$data_time_room_pet = $this->get_time_room_pet($time_kubun_type_pet, $kubun_type_bed_pet, $validate_time);
        $tmp_time_pet = [];
        foreach ($data_time_room_pet as $key => $time_room) {
            $tmp_time_pet[$time_room->kubun_id][] = $time_room;
        }
        //dd($tmp_time_wt);
        $data_time['time_pet'] = $tmp_time_pet;

        return view('sunsun.front.parts.booking_room_pet',$data_time)->render();
    }

    /*public function get_time_room_pet ($time_kubun_type, $room_kubun_type, $time_bath = null) {
        $data_sql = [
            'time_kubun_type' => $time_kubun_type,
            'room_kubun_type' => $room_kubun_type,
            'bed_male' => '017',
            'bed_female' => '018'
        ];
        if ($time_bath !== null) {
            $data_sql['time_bath'] = $time_bath;
        }
        $sql_select = "
                -- SELECT time & room
               SELECT
                mk1.*
                , mk2.kubun_id as kubun_id_room
                , mk2.kubun_value as kubun_value_room
                , mk2.notes as notes_room
                , SUBSTRING(mk1.notes, 1, 4) as time_start
                , SUBSTRING(mk1.notes, 6, 4) as end_time
                , CASE
                    WHEN mk2.kubun_type = :bed_male THEN 'male'
                    WHEN mk2.kubun_type = :bed_female THEN 'female'
                    ELSE 'other'
                    END as gender
                , mk2.kubun_type as gender_type
        ";
        if ($time_bath !== null) {
            $sql_select .= "
                 , CASE
                    WHEN SUBSTRING(mk1.notes, 1, 4) > :time_bath THEN 1
                    ELSE 0
                    END as status_time_validate
            ";
        }
        $sql = "$sql_select
            FROM ms_kubun mk1
            INNER JOIN ms_kubun mk2 ON mk2.kubun_type = :room_kubun_type
            WHERE mk1.kubun_type = :time_kubun_type
            ORDER BY  mk2.sort_no, mk1.sort_no
        ";

        return DB::select($sql, $data_sql);
    }*/

    public function fetch_kubun_data(&$data){
        $MsKubun = MsKubun::all();
        $data['repeat_user'] = $MsKubun->where('kubun_type','001')->sortBy('sort_no');
        $data['transport'] = $MsKubun->where('kubun_type','002')->sortBy('sort_no');
        $data['bus_arrive_time_slide'] = $MsKubun->where('kubun_type','003')->sortBy('sort_no');
        $data['pick_up'] = $MsKubun->where('kubun_type','004')->sortBy('sort_no');
        $data['course'] = $MsKubun->where('kubun_type','005')->sortBy('sort_no');
        $data['gender'] = $MsKubun->where('kubun_type','006')->sortBy('sort_no');
        $data['age_value'] = $MsKubun->where('kubun_type','007')->sortBy('sort_no');
        $data['lunch'] = $MsKubun->where('kubun_type','008')->sortBy('sort_no');
        $data['whitening'] = $MsKubun->where('kubun_type','009')->sortBy('sort_no');
        $data['pet_keeping'] = $MsKubun->where('kubun_type','010')->sortBy('sort_no');
        $data['stay_room_type'] = $MsKubun->where('kubun_type','011')->sortBy('sort_no');
        $data['stay_guest_num'] = $MsKubun->where('kubun_type','012')->sortBy('sort_no');


        $data['time_slide'] = $MsKubun->where('kubun_type','013')->sortBy('sort_no');
        $data['time_slide_room'] = $MsKubun->where('kubun_type','014')->sortBy('sort_no');

        $data['lunch_guest_num'] = $MsKubun->where('kubun_type','023')->sortBy('sort_no');
        $data['service_guest_num'] = $MsKubun->where('kubun_type','015')->sortBy('sort_no');
        $data['service_pet_num'] = $MsKubun->where('kubun_type','016')->sortBy('sort_no');

        $data['bed_male'] = $MsKubun->where('kubun_type','017')->sortBy('sort_no');
        $data['bed_female'] = $MsKubun->where('kubun_type','018')->sortBy('sort_no');
        $data['bed_pet'] = $MsKubun->where('kubun_type','019')->sortBy('sort_no');

        $data['time_slide_pet'] = $MsKubun->where('kubun_type','020')->sortBy('sort_no');
        $data['time_slide_wt'] = $MsKubun->where('kubun_type','021')->sortBy('sort_no');

        $data['breakfast'] = $MsKubun->where('kubun_type','022')->sortBy('sort_no');
    }

    public function get_service(Request $request){
        $data = $request->all();
        $this->fetch_kubun_data($data);
        $json = json_decode($data['service']);

        if(count(json_decode($data['course_time'], true)) == 0){
            $data['course_time'] = NULL;
        }else{
            $data['course_time'] = json_decode($data['course_time'], true);
            $date_arr = [];

            foreach($data['course_time'] as $date){
                $date_arr[$date['service_date']] = NULL;
            }

            $weekMap = [
                0 => '日',
                1 => '月',
                2 => '火',
                3 => '水',
                4 => '木',
                5 => '金',
                6 => '土',
            ];

            foreach($date_arr as $key => $d){
                $dayOfTheWeek = Carbon::createFromFormat('Ymd', $key)->dayOfWeek;
                $day = Carbon::createFromFormat('Ymd', $key)->format('d');
                $month = Carbon::createFromFormat('Ymd', $key)->format('m');
                $date_arr[$key] = $month . "/" . $day ."(" . $weekMap[$dayOfTheWeek] . ")";
            }

            $weekday = $weekMap[$dayOfTheWeek];
            $data['date_unique_time'] = $date_arr;

            // dd($weekday);

        }



        $data['course_data'] = json_decode($data['course_data'], true);

        if(isset( $data['course_data']['whitening_time'])){
            $data['course_data']['whitening_time-view'] =    substr($data['course_data']['whitening_time'], 0, 2) . ":" .
                                                        substr($data['course_data']['whitening_time'], 2, 2) . "～".
                                                        substr($data['course_data']['whitening_time'], 5, 2) . ":".
                                                        substr($data['course_data']['whitening_time'], 7, 2);
        }



        if ($json->kubun_id == "01") {
            return view('sunsun.front.parts.enzyme_bath',$data)->render();
        } elseif ($json->kubun_id == "02") {
            return view('sunsun.front.parts.oneday_bath',$data)->render();
        } elseif ($json->kubun_id == "03") {
            return view('sunsun.front.parts.enzyme_room_bath',$data)->render();
        } elseif ($json->kubun_id == "04") {
            return view('sunsun.front.parts.fasting_plan',$data)->render();
        } elseif ($json->kubun_id == "05") {
            return view('sunsun.front.parts.pet_enzyme_bath',$data)->render();
        }
    }

    public function complete(Request $request) {
        $data = $request->all();
        return view('sunsun.front.complete', $data);
    }

}
