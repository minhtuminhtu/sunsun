<?php

namespace App\Http\Controllers\Sunsun\Auth;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
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

    public function edit() {
        $user_id = Auth::id();
        $user = MsUser::find($user_id)->first();
        return view('sunsun.auth.edit')->with(compact('user'));
    }


    public function update (Request $request) {
        $data = $request->all();
        $validation = $this->validator($data);
        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withErrors($validation->errors())
                ->withInput($request->all());
        }
        $data = $request->all();
        $user_id = Auth::id();
        $user = MsUser::find($user_id);
        $user->username = $data['username'];
        $user->gender = $data['gender'];
        $user->tel = $data['tel'];
        $user->birth_year = $data['birth_year'];
        $user->save();

        $data['user'] = $user;
        $data['success'] = 'Change successfully';
        return view('sunsun.auth.edit')->with($data);

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
