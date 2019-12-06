<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sunsun\Front\BookingRequest;
use Illuminate\Http\Request;

use App\Models\MsKubun;
use App\Models\Yoyaku;
use App\Models\YoyakuDanjikiJikan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

        //$gender = $data['gender'];

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


        /*if ($course['kubun_id'] == config('const.db.kubun_id_value.course.NORMAL') || $course['kubun_id'] == config('const.db.kubun_id_value.course.1_DAY_REFRESH')) { // tắm bình thường 01
            $time_customer_choice = $data['time'];
            foreach ($time_customer_choice as $key => $time) {
                $data_json_time = json_decode($time['data-json'], true );
                if ($data_json_time == null) { // check nếu chưa chọn time
                    $error['error_time_transport'][$key]['element'] = $time['element'];
                } else {
                    if ($check_bus) { // validate nếu đi xe bus
                        if ($data_json_time['notes'] < $time_required) { // check required time. time choice always >= time required
                            $error['error_time_transport'][$key]['data'] = $data_json_time;
                            $error['error_time_transport'][$key]['element'] = $time['element'];
                        }
                        // check room gender
                    }
                }

                //$error['data_json_time'] = $data_json_time;
            }
        }*/


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

    public function get_price_option ($booking, &$bill) {
        $course = json_decode($booking['course'], true);
        $data_option_price = MsKubun::where('kubun_type','029')->get(); // get all options price
        if (isset($booking['lunch_guest_num'])) { // an trua 01
            $price_luch = 0;
            $lunch = json_decode($booking['lunch_guest_num'], true);
            if ($lunch['kubun_id'] !== "01") {
                $price_lunch_each_people = $data_option_price->where('kubun_id','01')->first();
                $price_luch = (int) $lunch['notes'] * (int) $price_lunch_each_people->kubun_value; //$lunch->notes => number people || $price_lunch_each_people->kubun_value => price for each people

                if (isset($bill['options']['01']['price'])) {
                    $bill['options']['01']['price'] += $price_luch;
                    ++ $bill['options']['01']['quantity'];
                } else {
                    $bill['options']['01']['quantity'] = 1;
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
                    $days = $booking['range_date_end-value'] - $booking['range_date_start-value']; // chua tính những ngày nghỉ
                    $price_stay = $price_stay * $days;
                    if (isset($bill['options']['02_03']['price'])) {
                        ++ $bill['options']['02_03']['quantity'];
                        $bill['options']['02_03']['price'] += $price_stay;
                    } else {
                        $bill['options']['02_03']['room'] = $stay_room_type['kubun_value'];
                        $bill['options']['02_03']['quantity'] = 1;
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
                    $course_price_op = MsKubun::where([['kubun_type','024'],['kubun_id','01']])->get()->first();
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

        $data['customer'] = $this->get_booking($request);
        if(count($data['customer']['info']) == 0){
            return redirect("/booking");
        }

        $this->update_or_new_booking($data);
        // dd($data);
        echo "Thanks!";

        // $request->session()->forget($this->session_info);
    }


    public function update_or_new_booking($data){
        //Update
        if(isset($data['booking_id'])){
            $booking_id = $this->new_booking($data);

            Yoyaku::where('booking_id', $data['booking_id'])->update(['history_id' => $booking_id]);
            Yoyaku::where('history_id', $data['booking_id'])->update(['history_id' => $booking_id]);

        //New
        }else{
            $this->new_booking($data);
        }
    }

    private function new_booking($data){
        $parent = true;
        $parent_id = NULL;
        $parent_date = NULL;
        foreach($data['customer']['info'] as $customer){
            $Yoyaku = new Yoyaku;
            if($parent){
                $parent_id = $Yoyaku->booking_id = $this->get_booking_id();
                $parent_date = isset($customer['date-value'])?$customer['date-value']:NULL;
                $parent_date = !isset($parent_date)?$customer['plan_date_start-value']:$parent_date;
                $Yoyaku->ref_booking_id = NULL;
                $this->set_booking_course($Yoyaku, $data, $customer,$parent, NULL);
                $this->set_yoyaku_danjiki_jikan($customer, $parent, $parent_id, $parent_date);
                $parent = false;
            }else{
                $booking_id = $Yoyaku->booking_id = $this->get_booking_id();
                $Yoyaku->ref_booking_id = $parent_id;
                $this->set_booking_course($Yoyaku, $data, $customer,$parent, $parent_date);
                $this->set_yoyaku_danjiki_jikan($customer, $parent, $booking_id, $parent_date);
            }
            $Yoyaku->save();
        }
        return  $Yoyaku->booking_id;
    }




    public function set_yoyaku_danjiki_jikan($customer, $parent, $parent_id, $parent_date){
        $course = json_decode($customer['course']);
        if($course->kubun_id == '01'){
            foreach($customer['time'] as $time){
                $YoyakuDanjikiJikan = new YoyakuDanjikiJikan;
                $YoyakuDanjikiJikan->booking_id = $parent_id;
                $YoyakuDanjikiJikan->service_date = $parent_date;
                $YoyakuDanjikiJikan->service_time_1 = $time['value'];
                $YoyakuDanjikiJikan->notes = $time['bed'];
                $YoyakuDanjikiJikan->save();
            }
        }elseif($course->kubun_id == '04'){
            $plan_date_start = isset($customer['plan_date_start-value'])?$customer['plan_date_start-value']:"";
            $plan_date_end = isset($customer['plan_date_end-value'])?$customer['plan_date_end-value']:"";

            foreach($customer['date'] as $date){
                $YoyakuDanjikiJikan = new YoyakuDanjikiJikan;
                $YoyakuDanjikiJikan->booking_id = $parent_id;
                $YoyakuDanjikiJikan->service_date = $date['day']['value'];
                $YoyakuDanjikiJikan->service_time_1 = $date['from']['value'];
                $YoyakuDanjikiJikan->service_time_2 = $date['to']['value'];
                $YoyakuDanjikiJikan->notes = $date['from']['bed'] . "-" . $date['to']['bed'];

                $YoyakuDanjikiJikan->save();
            }
        }
    }




    public function set_booking_course(&$Yoyaku, $data, $customer,$parent, $parent_date){
        $name = $data['name'];
        $phone = $data['phone'];
        $email = $data['email'];
        $payment_method = $data['payment-method'];
        $repeat_user = json_decode($customer['repeat_user']);
        $transport = json_decode($data['customer']['transport']);
        $bus_arrive_time_slide = json_decode($data['customer']['bus_arrive_time_slide']);
        $pick_up = json_decode($data['customer']['pick_up']);

        $course = json_decode($customer['course']);

        $gender = isset($customer['gender'])?json_decode($customer['gender']):"";
        $age_type = isset($customer['age_type'])?$customer['age_type']:"";
        $age_value = isset($customer['age_value'])?$customer['age_value']:"";

        $bed = isset($customer['bed'])?json_decode($customer['bed']):"";
        $service_guest_num = isset($customer['service_guest_num'])?json_decode($customer['service_guest_num']):"";
        $service_pet_num = isset($customer['service_pet_num'])?json_decode($customer['service_pet_num']):"";
        $lunch = isset($customer['lunch'])?json_decode($customer['lunch']):"";
        $lunch_guest_num = isset($customer['lunch_guest_num'])?json_decode($customer['lunch_guest_num']):"";
        $whitening = isset($customer['whitening'])?json_decode($customer['whitening']):"";
        $pet_keeping = isset($customer['pet_keeping'])?json_decode($customer['pet_keeping']):"";
        $stay_room_type = isset($customer['stay_room_type'])?json_decode($customer['stay_room_type']):"";
        $stay_guest_num = isset($customer['stay_guest_num'])?json_decode($customer['stay_guest_num']):"";
        $stay_checkin_date = isset($customer['stay_checkin_date'])?json_decode($customer['stay_checkin_date']):"";
        $stay_checkout_date = isset($customer['stay_checkout_date'])?json_decode($customer['stay_checkout_date']):"";
        $service_guest_num = isset($customer['service_guest_num'])?json_decode($customer['service_guest_num']):"";
        $stay_checkout_date = isset($customer['notes'])?json_decode($customer['notes']):"";
        $service_pet_num = isset($customer['service_pet_num'])?json_decode($customer['service_pet_num']):"";
        $breakfast = isset($customer['breakfast'])?json_decode($customer['breakfast']):"";


        $Yoyaku->name = $name;
        $Yoyaku->phone = $phone;
        $Yoyaku->email = $email;
        $Yoyaku->payment_method = $payment_method;
        $Yoyaku->repeat_user = $repeat_user->kubun_id;
        $Yoyaku->transport = $transport->kubun_id;

        if($transport->kubun_id == '02'){
            $Yoyaku->bus_arrive_time_slide = $bus_arrive_time_slide->kubun_id;
            $Yoyaku->pick_up = $pick_up->kubun_id;
        }

        $Yoyaku->course = $course->kubun_id;
        if($course->kubun_id == '01'){
            $date = isset($customer['date-value'])?$customer['date-value']:"";
            $bed = isset($customer['bed'])?$customer['bed']:"";
            $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
            $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";

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
                    $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                    $Yoyaku->stay_checkin_date = $stay_checkin_date;
                    $Yoyaku->stay_checkout_date = $stay_checkout_date;
                    $Yoyaku->breakfast = $breakfast->kubun_id;
                }
            }else{
                $Yoyaku->service_date_start = $parent_date;
            }



        }elseif($course->kubun_id == '02'){
            $date = isset($customer['date-value'])?$customer['date-value']:"";
            $time1 = isset($customer['time1-value'])?$customer['time1-value']:"";
            $time2 = isset($customer['time2-value'])?$customer['time2-value']:"";
            $bed1 = isset($customer['time1-bed'])?$customer['time1-bed']:"";
            $bed2 = isset($customer['time2-bed'])?$customer['time2-bed']:"";
            $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
            $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";

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
                    $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                    $Yoyaku->stay_checkin_date = $stay_checkin_date;
                    $Yoyaku->stay_checkout_date = $stay_checkout_date;
                    $Yoyaku->breakfast = $breakfast->kubun_id;
                }
            }else{
                $Yoyaku->service_date_start = $parent_date;
            }

        }elseif($course->kubun_id == '03'){
            $date = isset($customer['date-value'])?$customer['date-value']:"";
            $time = isset($customer['time_room_value'])?$customer['time_room_value']:"";
            $bed = isset($customer['time_room_bed'])?$customer['time_room_bed']:"";
            $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
            $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";

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
                    $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                    $Yoyaku->stay_checkin_date = $stay_checkin_date;
                    $Yoyaku->stay_checkout_date = $stay_checkout_date;
                    $Yoyaku->breakfast = $breakfast->kubun_id;
                }
            }else{
                $Yoyaku->service_date_start = $parent_date;
            }

        }elseif($course->kubun_id == '04'){
            $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
            $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";

            $plan_date_start = isset($customer['plan_date_start-value'])?$customer['plan_date_start-value']:"";
            $plan_date_end = isset($customer['plan_date_end-value'])?$customer['plan_date_end-value']:"";

            $Yoyaku->gender = $gender->kubun_id;
            $Yoyaku->age_value = $age_value;
            $Yoyaku->pet_keeping = $pet_keeping->kubun_id;

            $Yoyaku->service_date_start = $plan_date_start;
            $Yoyaku->service_date_end = $plan_date_end;
            if($parent){
                $Yoyaku->stay_room_type = $stay_room_type->kubun_id;
                if($stay_room_type->kubun_id != '01'){
                    $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                    $Yoyaku->stay_checkin_date = $stay_checkin_date;
                    $Yoyaku->stay_checkout_date = $stay_checkout_date;
                }
            }else{
                $Yoyaku->service_date_start = $parent_date;
            }
        }elseif($course->kubun_id == '05'){
            $date = isset($customer['date-value'])?$customer['date-value']:"";
            $time1 = isset($customer['time_room_time1'])?$customer['time_room_time1']:"";
            $time2 = isset($customer['time_room_time2'])?$customer['time_room_time2']:"";
            $notes = isset($customer['notes'])?$customer['notes']:"";

            $Yoyaku->service_time_1 = $time1;
            $Yoyaku->service_time_2 = $time2;
            $Yoyaku->service_pet_num = $service_pet_num->kubun_id;
            $Yoyaku->notes = $notes;

            if($parent){
                $Yoyaku->service_date_start = $date;
            }else{
                $Yoyaku->service_date_start = $parent_date;
            }
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
        $gender = json_decode($data['gender'], true);
        $course = json_decode($data['course'], true);
        $data_get_attr = json_decode($data['data_get_attr'], true);
        $validate_time = null;

        $sections_booking = $this->get_booking($request);
        //dd($sections_booking);
        if (count($sections_booking) > 0) { // Th add thêm người
            $transport = json_decode($sections_booking['transport'], true);
            $bus_arrive_time_slide = json_decode($sections_booking['bus_arrive_time_slide'], true);
            $day_book_time = $sections_booking['date-value'];
            if (isset($sections_booking['date-value'])) { // date Tắm bình thường 1 day refresh
                $day_book_time = $sections_booking['date-value'];
            }
        } else { // th booking mới
            $transport = json_decode($data['transport'], true);
            $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);
            if (isset($data['date-value'])) { // date Tắm bình thường 1 day refresh
                $day_book_time = $data['date-value'];
            }
        }


        $this->fetch_kubun_data($data);

        if ($course['kubun_id'] == config('const.db.kubun_id_value.course.NORMAL')) { // Tắm bình thường
            if ((count($data['time']) > 0 && isset($data_get_attr['new'])) || (count($data['time']) > 1)) {
                $time_vali = collect($data['time'])->max('value');
                if ($time_vali != '0') {
                    $validate_time = $this->plus_time_string($time_vali, 120); // plus 2h between 2 times shower
                }
            }
        } else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.1_DAY_REFRESH')) { // 1 day refresh
            if ($data_get_attr['date_type'] == 'shower_1' && $data['time2-value'] != '0') {
                $validate_time = $this->plus_time_string($data['time2-value'], 120); // plus 2h between 2 times shower
            } else if ($data_get_attr['date_type'] == 'shower_2' && $data['time1-value'] != '0') {
                $validate_time = $this->plus_time_string($data['time1-value'], 120); // plus 2h between 2 times shower
            }
            //dd($data);
        } else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.FASTING_PLAN')) { // fasting plan
            $type = $data_get_attr['date_type'];
            $date_select = $data['date'];
            $day_book_time = $date_select;
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

                $validate_time = $this->plus_time_string($time_validate, 120); // plus 2h between 2 times shower
            }

        }
        // check time bus
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false && $validate_time < $check_bus) {
                $validate_time = $check_bus;
            }
        }

        $kubun_type_time = config('const.db.kubun_type_value.TIME'); // 013 kubun_type
        $data_time = [];
        if($gender['kubun_id'] == '01'){ // for man
            $kubun_type_bed_male = config('const.db.kubun_type_value.bed_male'); // 017 kubun_type
            $data_time['beds'] = $data['bed_male'];
            $data_time_room = $this->get_time_room_booking($kubun_type_time, $kubun_type_bed_male, $validate_time);
        }else{ //for woman
            $kubun_type_bed_female = config('const.db.kubun_type_value.bed_female'); // 018 kubun_type
            $data_time['beds'] = $data['bed_female'];
            $data_time_room = $this->get_time_room_booking($kubun_type_time, $kubun_type_bed_female, $validate_time);
        }
        //dd($data_time_room);
        $tmp_time_room = [];
        foreach ($data_time_room as $key => $time_room) {
            $tmp_time_room[$time_room->kubun_id][] = $time_room;
        }
        $data_time['time_room'] = $tmp_time_room;
        //dd($data);
        $data_time['gender'] = $gender;
        if (isset($data_get_attr['new'])) {
            $data_time['new'] = 1;
        }
        return view('sunsun.front.parts.booking_time',$data_time)->render();
    }



    public function book_room (Request $request) {
        $data = $request->all();
        $repeat_user = json_decode($data['repeat_user'], true);
        $transport = json_decode($data['transport'], true);
        $course = json_decode($data['course'], true);
        $data_get_attr = json_decode($data['data_get_attr'], true);
        $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);
        $validate_time = null;

        // check time bus
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false && $validate_time < $check_bus) {
                $validate_time = $check_bus;
            }
        }
        // dd($data);
        $time_kubun_type_book_room = config('const.db.kubun_type_value.TIME_BOOK_ROOM'); //014
        $kubun_type_bed_male = config('const.db.kubun_type_value.bed_male'); // 017
        $data_time_room = $this->get_time_booking_all_room($time_kubun_type_book_room, $kubun_type_bed_male, $validate_time);
        $tmp_time_room = [];
        foreach ($data_time_room as $key => $time_room) {
            $tmp_time_room[$time_room->kubun_id][] = $time_room;
        }
        //dd($tmp_time_wt);
        $data_time['time_book_all_room'] = $tmp_time_room;
        $MsKubun = MsKubun::all();
        $data_time['beds'] = $MsKubun->where('kubun_type','017')->sortBy('sort_no');
        return view('sunsun.front.parts.booking_room',$data_time)->render();

    }

    public function get_time_booking_all_room ($time_kubun_type, $room_kubun_type, $time_bath = null) {
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
            ORDER BY  mk2.sort_no, mk1.sort_no
        ";

        return DB::select($sql, $data_sql);
    }

    /**
     * @param $time_kubun_type
     * @param $room_kubun_type
     * @param null $time_bath is the time validate if shower many times
     * @return array
     */
    public function get_time_room_booking ($time_kubun_type, $room_kubun_type, $time_bath = null) {
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
            ORDER BY  mk2.sort_no, mk1.sort_no
        ";

        return DB::select($sql, $data_sql);
    }
    public function book_time_room_wt (Request $request) {
        $data = $request->all();
        $repeat_user = json_decode($data['repeat_user'], true);
        $whitening_repeat = $data['whitening_repeat'];
        $transport = json_decode($data['transport'], true);
        $course = json_decode($data['course'], true);
        $data_get_attr = json_decode($data['data_get_attr'], true);
        $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);
        $validate_time = null;
        if ($course['kubun_id'] == config('const.db.kubun_id_value.course.NORMAL')) { // Tắm bình thường
            $day_book_time = $data['date-value'];
            $time_vali = collect($data['time'])->max('value');
            if ($time_vali != '0') {
                $validate_time = $this->plus_time_string($time_vali, 120); // plus 2h between 2 times shower
            }
        } else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.1_DAY_REFRESH')) { // 1 day refresh
            $day_book_time = $data['date-value'];
            $validate_time_1 = $this->plus_time_string($data['time1-value'], 15 + 45);  // 15 + 45 p tắm bt
            $validate_time_2 = $this->plus_time_string($data['time2-value'], 15 + 45);  // 15 + 45 p tắm bt
            $validate_time = collect([$validate_time_1,$validate_time_2])->max();

            //dd($data);
        } else if ($course['kubun_id'] == config('const.db.kubun_id_value.course.BOTH_ALL_ROOM')) { // All room
            $day_book_time = $data['date-value'];
            $validate_time = $this->plus_time_string($data['time_room_value'], 15 + 45); // 15 + 45 p tắm bt

        }
        // check time bus
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false && $validate_time < $check_bus) {
                $validate_time = $check_bus;
            }
        }
        // dd($data);
        $time_kubun_type_whitening = config('const.db.kubun_type_value.TIME_WHITENING'); //021
        $kubun_type_bed_male = config('const.db.kubun_type_value.bed_pet'); // 19
        $data_time_room = $this->get_time_room_whitening($time_kubun_type_whitening, $kubun_type_bed_male, $validate_time,$repeat_user, $whitening_repeat);
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

    public function get_time_room_whitening ($time_kubun_type, $room_kubun_type, $time_bath = null, $repeat_user, $whitening_repeat) {
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
            ORDER BY  mk2.sort_no, mk1.sort_no
        ";

        return DB::select($sql, $data_sql);
    }

    public function book_time_room_pet (Request $request) {
        $data = $request->all();
        $repeat_user = json_decode($data['repeat_user'], true);
        $transport = json_decode($data['transport'], true);
        $course = json_decode($data['course'], true);
        $data_get_attr = json_decode($data['data_get_attr'], true);
        $bus_arrive_time_slide = json_decode($data['bus_arrive_time_slide'], true);
        $validate_time = null;
        // check time bus
        if ($bus_arrive_time_slide != null) {
            $check_bus = $this->get_time_validate_bus($repeat_user, $transport, $bus_arrive_time_slide );
            if ($check_bus !== false && $validate_time < $check_bus) {
                $validate_time = $check_bus;
            }
        }
        $MsKubun = MsKubun::all();
        $data_time['beds'] = $MsKubun->where('kubun_type','019')->sortBy('sort_no');
        $time_kubun_type_pet = config('const.db.kubun_type_value.TIME_PET'); //020
        $kubun_type_bed_pet = config('const.db.kubun_type_value.bed_pet'); // 19
        $data_time_room_pet = $this->get_time_room_pet($time_kubun_type_pet, $kubun_type_bed_pet, $validate_time);
        $tmp_time_pet = [];
        foreach ($data_time_room_pet as $key => $time_room) {
            $tmp_time_pet[$time_room->kubun_id][] = $time_room;
        }
        //dd($tmp_time_wt);
        $data_time['time_pet'] = $tmp_time_pet;

        return view('sunsun.front.parts.booking_room_pet',$data_time)->render();
    }

    public function get_time_room_pet ($time_kubun_type, $room_kubun_type, $time_bath = null) {
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
    }

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

}
