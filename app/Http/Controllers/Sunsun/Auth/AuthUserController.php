<?php

namespace App\Http\Controllers\Sunsun\Auth;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'tel' => 'required|string|max:255|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',
        ]);
    }

    public function edit(Request $request) {
        $data = [];
        if($request->isMethod('post')) {
            $data_request = $request->all();
            $validation = $this->validator($data_request);
            if ($validation->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validation->errors())
                    ->withInput($request->all());
            }
            $this->update($data, $data_request);
        }
        $ms_user_id = Auth::user()->ms_user_id;
        $data['user'] = MsUser::find($ms_user_id);

        return view('sunsun.auth.edit')->with($data);
    }


    public function update ( &$data, $data_request) {
        $user_id = Auth::id();
        $user = MsUser::find($user_id);
        $user->username = $data_request['username'];
        $user->gender = $data_request['gender'];
        $user->tel = $data_request['tel'];
        $user->birth_year = $data_request['birth_year'];
        $user->save();
        $data['success'] = 'Change successfully';
    }


    public function changepassword (Request $request) {
        if ($request->isMethod('get')) {
            return view('sunsun.auth.changepassword');
        }
        $data = $request->all();
        $current_password = \Auth::User()->password;
        $ms_user_id = \Auth::User()->ms_user_id;


        if(\Hash::check($request->input('password'), $current_password))
        {
            $obj_user = MsUser::find($ms_user_id);
            $obj_user->password = \Hash::make($data['password_new']);
            $obj_user->save();
            return redirect()->back()->with("success","Password changed successfully !");
        }
        else
        {
            $error['password'] = 'Wrong Password';
            return redirect()->back()->withErrors($error);
        }

    }
}
