<?php

namespace App\Http\Controllers\Sunsun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MsKubun;

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
            $MsKubun = MsKubun::create(['kubun_type' => $data['kubun_type'],'kubun_id' => $data['kubun_id'], 'kubun_value' => $data['kubun_value'],'sort_no' => $data['sort_no']]);
        }else{
            MsKubun::where('kubun_type', $data['kubun_type'])->where('kubun_id', $data['kubun_id'])->update(['kubun_value' => $data['kubun_value']]);
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
