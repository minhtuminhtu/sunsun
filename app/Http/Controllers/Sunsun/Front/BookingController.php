<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MsKubun;
use App\Models\Yoyaku;
use App\Models\YoyakuDanjikiJikan;
use Illuminate\Support\Collection;

class BookingController extends Controller
{
    private $session_info = 'SESSION_BOOKING_USER';

    public function index(Request $request){
        $request->session()->forget($this->session_info);
        return view('sunsun.front.booking.index');
    }

    public function booking(Request $request){

        $data = $request->all();
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
        $this->save_session($request, $request->all());
        return ['status'=> 'OK'];
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
        return view('sunsun.front.payment',['data' => $data]);
    }

    public function make_payment(Request $request){
        $data = $request->all();
        
        $data['customer'] = $this->get_booking($request);
        if(count($data['customer']['info']) == 0){
            return redirect("/booking");
        }


        // dd($data);
        $parent = true;
        $parent_id = NULL;
        $parent_date = NULL;
        foreach($data['customer']['info'] as $customer){
            $Yoyaku = new Yoyaku;
            if($parent){
                $parent_id = $Yoyaku->booking_id = $this->get_booking_id();
                $parent_date = isset($customer['date-value'])?$customer['date-value']:"";
                $Yoyaku->ref_booking_id = NULL;
                $this->set_booking_course($Yoyaku, $data, $customer,$parent);
                $this->set_yoyaku_danjiki_jikan($customer, $parent, $parent_id, $parent_date);
                $parent = false;
            }else{
                $booking_id = $Yoyaku->booking_id = $this->get_booking_id();
                $Yoyaku->ref_booking_id = $parent_id;
                $this->set_booking_course($Yoyaku, $data, $customer,$parent);
                $this->set_yoyaku_danjiki_jikan($customer, $parent, $booking_id, $parent_date);
            }
            $Yoyaku->save();
        }

        echo "Thanks you!";
        
        // $request->session()->forget($this->session_info);
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




    public function set_booking_course(&$Yoyaku, $data, $customer,$parent){
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
            $Yoyaku->age_value = $age_value;
            $Yoyaku->bed = $bed;
            $Yoyaku->lunch = $lunch->kubun_id;
            $Yoyaku->whitening = $whitening->kubun_id;
            if($whitening->kubun_id == '02'){
                $whitening_time = isset($customer['whitening-time_value'])?$customer['whitening-time_value']:"";
                $Yoyaku->whitening_time = $whitening_time;
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
                $Yoyaku->whitening_time = $whitening_time;
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
                $Yoyaku->whitening_time = $whitening_time;
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
            }

        }elseif($course->kubun_id == '04'){
            $stay_checkin_date = isset($customer['range_date_start-value'])?$customer['range_date_start-value']:"";
            $stay_checkout_date = isset($customer['range_date_end-value'])?$customer['range_date_end-value']:"";

            $plan_date_start = isset($customer['plan_date_start-value'])?$customer['plan_date_start-value']:"";
            $plan_date_end = isset($customer['plan_date_end-value'])?$customer['plan_date_end-value']:"";

            $Yoyaku->gender = $gender->kubun_id;
            $Yoyaku->age_value = $age_value;
            $Yoyaku->pet_keeping = $pet_keeping->kubun_id;

            if($parent){
                $Yoyaku->service_date_start = $plan_date_start;
                $Yoyaku->service_date_end = $plan_date_end;
                $Yoyaku->stay_room_type = $stay_room_type->kubun_id;
                if($stay_room_type->kubun_id != '01'){
                    $Yoyaku->stay_guest_num = $stay_guest_num->kubun_id;
                    $Yoyaku->stay_checkin_date = $stay_checkin_date;
                    $Yoyaku->stay_checkout_date = $stay_checkout_date;
                }
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
            }
        }
        
        
    }


    public function get_booking_id(){
        $like_booking_id = date("Ymd");
        $result = Yoyaku::query()->where('booking_id', 'LIKE', $like_booking_id."%");
        return $like_booking_id.sprintf('%04d', ($result->count() + 1) );
    }


    public function get_time_room(Request $request){
        $data = $request->all();
        $result = json_decode($data['gender']);
        $this->fetch_kubun_data($data);
        $data['gender'] = $result->kubun_value;

        if($result->kubun_id == '01'){
            $data['bed'] = $data['bed_male'];
        }else{
            $data['bed'] = $data['bed_female'];
        }
        return view('sunsun.front.parts.booking_time',
            [
                'data' => $data
            ])
            ->render();
    }

    public function book_room (Request $request) {
        $data = $request->all();
        $this->fetch_kubun_data($data);
        $data['bed'] = $data['bed_male'];
        return view('sunsun.front.parts.booking_room',
            [
                'data' => $data
            ])
            ->render();
    }

    public function book_time_room_pet (Request $request) {
        $data = $request->all();
        $this->fetch_kubun_data($data);
        $data['bed'] = $data['bed_pet'];
        return view('sunsun.front.parts.booking_room_pet',
            [
                'data' => $data
            ])
            ->render();
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

        $data['breakfast'] = $MsKubun->where('kubun_type','022')->sortBy('sort_no');
    }

    public function get_service(Request $request){
        $data = $request->all();
        $this->fetch_kubun_data($data);
        $json = json_decode($data['service']);

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
