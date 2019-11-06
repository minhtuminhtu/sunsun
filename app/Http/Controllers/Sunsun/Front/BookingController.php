<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MsKubun;
use App\Models\Yoyaku;
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
        // dd($filtered);
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

        // $parent = true;
        // $parent_id = NULL;
        // foreach($data['customer']['info'] as $customer){
        //     // $Yoyaku = new Yoyaku;

        //     // if($parent){
        //     //     $parent_id = $Yoyaku->booking_id = date("Ymd")."001";
        //     //     $Yoyaku->course = 'b';
        //     //     $parent = false;

        //     // }else{
        //     //     $Yoyaku->booking_id = date("Ymd")."002";
        //     //     $Yoyaku->ref_booking_id = $parent_id;
        //     //     $Yoyaku->course = 'c';
        //     // }

        //     // $Yoyaku->save();
        //     $booking_id = $this->get_booking_id();


        // }

        $booking_id = date("Ymd");
        $a = Yoyaku::where('booking_id', 'LIKE', "%a%")->get();
        print_r($a);

        // $request->session()->forget($this->session_info);
        return view('sunsun.front.payment',['data' => $data]);
    }


    public function get_booking_id(){
        $booking_id = date("Ymd")."%";
        $result = Yoyaku::where('booking_id', 'LIKE', $booking_id);
        return $result;
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

        $data['lunch_guest_num'] = $MsKubun->where('kubun_type','015')->sortBy('sort_no');
        $data['service_guest_num'] = $MsKubun->where('kubun_type','015')->sortBy('sort_no');
        $data['service_pet_num'] = $MsKubun->where('kubun_type','016')->sortBy('sort_no');

        $data['bed_male'] = $MsKubun->where('kubun_type','017')->sortBy('sort_no');
        $data['bed_female'] = $MsKubun->where('kubun_type','018')->sortBy('sort_no');
        $data['bed_pet'] = $MsKubun->where('kubun_type','019')->sortBy('sort_no');
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
            return view('sunsun.front.parts.pet_enzyme_bath',$data)->render();
        } elseif ($json->kubun_id == "05") {
            return view('sunsun.front.parts.fasting_plan',$data)->render();
        }
    }

}
