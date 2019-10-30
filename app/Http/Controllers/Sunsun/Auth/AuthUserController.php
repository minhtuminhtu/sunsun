<?php

namespace App\Http\Controllers\Sunsun\Auth;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit() {
        $user_id = Auth::id();
        $user = MsUser::find($user_id)->first();
        return view('sunsun.auth.edit')->with(compact('user'));
    }

    public function update (Request $request) {
        $data = $request->all();
        $user_id = Auth::id();
        $user = MsUser::find($user_id);
        $user->username = $data['username'];
        $user->gender = $data['gender'];
        $user->tel = $data['tel'];
        $user->birth_year = $data['birth_year'];
        $user->save();

        $data['user'] = $user;
        $data['mess'] = 'Change successfully';
        return view('sunsun.auth.edit')->with($data);

    }


    public function changepassword (Request $request) {
        if ($request->isMethod('get')) {
            return view('sunsun.auth.changepassword');
        }
        $data = $request->all();
        $current_password = \Auth::User()->password;
        $user_id = \Auth::User()->id;


        if(\Hash::check($request->input('password'), $current_password))
        {
            $obj_user = MsUser::find($user_id);
            $obj_user->password = \Hash::make($data['password_new']);
            $obj_user->save();
            return redirect()->back()->with("mess","Password changed successfully !");
        }
        else
        {
            $data['error'] = 'Mật khẩu cũ nhập không đúng';
            return redirect()->back()->with($data);
        }

    }
}
