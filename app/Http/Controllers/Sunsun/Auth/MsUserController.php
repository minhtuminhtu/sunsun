<?php

namespace App\Http\Controllers\Sunsun\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\CompleteJob;
use App\Models\MsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Sunsun\Front\BookingController;

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
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:ms_user',
            'tel' => 'required|string|max:11|min:10|regex:/[0-9]{10,11}/',
            'password' => 'required|string|min:1', //'confirmed'
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
            return redirect()
                ->back()
                ->withErrors($validation->errors())
                ->withInput($request->except('password'));
        }
        //dd($data);
        $bookCon = new BookingController();
        $data['username'] = $bookCon->change_value_kana($data['username']);
        MsUser::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            // 'gender' => $data['gender'],
            // 'birth_year' => $data['birth_year'],
            'password' => Hash::make($data['password']),
        ]);
        CompleteJob::dispatch($user->email, $user);
        return redirect('/login');
    }

}
