<?php

namespace App\Http\Controllers\Sunsun\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create (Request $request) {
        $data = $request->all();
        return view('sunsun.front.users.create',
            [
                'data' => $data
            ])
            ->render();
    }
}
