<?php

namespace App\Http\Controllers\Sunsun\Auth;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class MsUserController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = 'home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register() {
        return view('sunsun.auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:ms_user'],
            'tel' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:1'], //'confirmed'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function create(Request $request)
    {
        $data = $request->all();
        $validation = $this->validator($data);

        if ($validation->fails()) {
            dd($validation->errors());
            return redirect()->back()->withErrors($validation->errors());
        }
        MsUser::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'gender' => $data['gender'],
            'birth_year' => $data['birth_year'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect('/login');
    }

    public function edit($ms_user_id) {

        $user = MsUser::find($ms_user_id)->first();

        return view('sunsun.users.edit')->with(compact('user'));
    }

    public function update (Request $request, $user_id) {
        $data = $request->all();
        $current_password = \Auth::User()->password;
        $user_id = \Auth::User()->id;

        $validation = $this->validator($data, $user_id);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }


        if(\Hash::check($request->input('password_old'), $current_password))
        {
            $obj_user = MsUser::find($user_id);
            $obj_user->password = \Hash::make($request->input('password'));
            $obj_user->save();
            return redirect()->back()->with("success","Password changed successfully !");
        }
        else
        {

            $data['error'] = 'Mật khẩu cũ nhập không đúng';
            return redirect()->back()->with($data);
        }


    }


    public function changepassword (Request $request) {
        $data = $request->all();
        return view('sunsun.auth.changepassword',
            [
                'data' => $data
            ]);
    }
}
