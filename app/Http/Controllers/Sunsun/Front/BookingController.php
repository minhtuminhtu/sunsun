<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MsKubun;
use Illuminate\Support\Collection;

class BookingController extends Controller
{
    private $session_info = 'SESSION_INFO_USER';

    public function index(Request $request){
        $request->session()->forget($this->session_info);
        return view('sunsun.front.booking.index');
    }

    public function booking(Request $request){

        $MsKubun = MsKubun::all();
        $data = [];
        foreach ($MsKubun as $key => $value) {
            $data[$key]['kubun_type'] = $value->kubun_type;
            $data[$key]['kubun_id'] = $value->kubun_id;
            $data[$key]['kubun_value'] = $value->kubun_value;
            $data[$key]['sort_no'] = $value->sort_no;
        }
        $multiplied = collect($data);

        $filtered = $MsKubun->where('kubun_type','001')->sortBy('sort_no');

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
        if (isset($data['transportation'])) {
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
            $info_customer['transportation'] =  $data['transportation'];
            if ($data['transportation'] !== config('booking.transportation.options.car')) {
                $info_customer['bus_arrival'] = $data['bus_arrival'];
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
        $data['customer']['info'] = array_values($data['customer']['info']);
        return view('sunsun.front.confirm',$data);

    }

    public function payment(Request $request){
        $data = $request->all();
        $request->session()->forget($this->session_info);
        // dd($data);
        return view('sunsun.front.payment',['data' => $data]);
    }

    public function get_time_room(Request $request){
        $data = $request->all();
        $room_time_data = config('data_tmp.time_room');
        return view('sunsun.front.parts.booking_time',
            [
                'data' => $data,
                'room_time_data' => $room_time_data
            ])
            ->render();
    }

    public function book_room (Request $request) {
        $data = $request->all();
        $room_data = config('data_tmp.room');
        return view('sunsun.front.parts.booking_room',
            [
                'data' => $data,
                'room_data' => $room_data
            ])
            ->render();
    }

    public function book_time_room_pet (Request $request) {
        $data = $request->all();
        $room_pet = config('data_tmp.room_pet');
        return view('sunsun.front.parts.booking_room_pet',
            [
                'data' => $data,
                'room_pet' => $room_pet
            ])
            ->render();
    }

    public function get_service(Request $request){
        $data['request_post'] = $request->all();

        if ($data['request_post']['service'] == config('booking.services.options.normal')) {
            return view('sunsun.front.parts.enzyme_bath',$data)->render();
        } elseif ($data['request_post']['service'] == config('booking.services.options.day')) {
            return view('sunsun.front.parts.oneday_bath',$data)->render();
        } elseif ($data['request_post']['service'] == config('booking.services.options.eat')) {
            return view('sunsun.front.parts.enzyme_room_bath',$data)->render();
        } elseif ($data['request_post']['service'] == config('booking.services.options.no')) {
            return view('sunsun.front.parts.fasting_plan',$data)->render();
        } elseif ($data['request_post']['service'] == config('booking.services.options.pet')) {
            return view('sunsun.front.parts.pet_enzyme_bath',$data)->render();
        }
    }
}
