<?php

namespace App\Http\Controllers\Sunsun\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ForgotJob;
use App\Models\MsUser;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller {

    public function index(Request $request) {
        return view('sunsun.auth.forgot_password');
    }

    public function exec (Request $request) {
        $data = [];
        $data['status'] =  false;
        $data['notify'] = 'Unable to find user.';
        $email = $request->email;
        $user = MsUser::where('email', $email)->first();

        if($user){
            $password_reset = PasswordReset::updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => Str::random(60),
            ]);
            if($password_reset){
                ForgotJob::dispatch($email, $password_reset->token, $user);
                $data['status'] =  true;
                $data['notify'] = 'Check your inbox for the next steps. If you don\'t receive an email, and it\'s not in your spam folder this could mean you signed up with a different address.';
            }
        }

        return view('sunsun.auth.forgot_password', $data);
    }

    public function change(Request $request, $token){
        $data = $request->all();
        $data['token'] = $token;
        $data['forgot'] = true;
        return view('sunsun.auth.change_password', $data);
    }

    public function update(Request $request){
        $data = $request->all();
        $data['forgot'] = true;
        if(($data['password_repeat'] !== $data['password']) || (isset($data['password_repeat']) === false) || (isset($data['password']) === false) ){
            $data['status'] = false;
            $data['notify'] = 'Repeat password not match!';
            return view('sunsun.auth.change_password', $data);
        }
        $passwordReset = PasswordReset::where('token', $data['token'])->first();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            $data['notify'] = 'This password reset token is invalid.';
            return view('sunsun.auth.change_password', $data);
        }
        $user = MsUser::where('email', $passwordReset->email)->first();
        $updatePasswordUser = $user->update(['password' => bcrypt($data['password'])]);
        $passwordReset->delete();
        if($updatePasswordUser){
            $data['status'] = true;
            $data['notify'] = 'Update successfully!';
            return view('sunsun.auth.change_password', $data);
        }else{
            $data['status'] = false;
            $data['notify'] = 'Update failed!';
            return view('sunsun.auth.change_password', $data);
        }
    }
}
