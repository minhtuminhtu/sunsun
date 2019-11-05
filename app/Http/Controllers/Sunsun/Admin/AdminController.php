<?php

namespace App\Http\Controllers\Sunsun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MsKubun;

class AdminController extends Controller
{
    public function day() {
        return view('sunsun.admin.day');
    }

    public function weekly() {
        return view('sunsun.admin.weekly');
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
        if($data['type'] == 'up'){
            MsKubun::where('sort_no', $data['sort_no'])->update(['sort_no' =>'-1']);
            MsKubun::where('sort_no', $data['sort_no'] - 1)->update(['sort_no' =>$data['sort_no']]);
            MsKubun::where('sort_no', '-1')->update(['sort_no' =>$data['sort_no'] -1]);  
        }else{
            MsKubun::where('sort_no', $data['sort_no'])->update(['sort_no' =>'-1']);
            MsKubun::where('sort_no', $data['sort_no'] + 1)->update(['sort_no' =>$data['sort_no']]);
            MsKubun::where('sort_no', '-1')->update(['sort_no' =>$data['sort_no'] +1]); 
        }
    }
    public function update_setting_kubun_type(Request $request) {
        $data = $request->all();

        if (MsKubun::where('kubun_type', $data['kubun_type'])->where('kubun_id', $data['kubun_id'])->count() > 0) {
            return response()->json([
                'msg' => "kubun_id exist!",
            ], 400);
        }

        if($data['new'] == 1){
            $MsKubun = MsKubun::create(['kubun_type' => $data['kubun_type'],'kubun_id' => $data['kubun_id'], 'kubun_value' => $data['kubun_value'],'sort_no' => $data['sort_no']]);
        }else{
            MsKubun::where('kubun_type', $data['kubun_type'])->where('kubun_id', $data['kubun_id'])->update(['kubun_value' => $data['kubun_value']]);
        }
        // dd($data); 
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
