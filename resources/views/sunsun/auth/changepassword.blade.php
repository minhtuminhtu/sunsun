@extends('sunsun.front.template')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
    <style>
        .has-error .help-block {
            font-size: 0.85rem;
            color: red;
        }
    </style>
@endsection
@section('page_title', 'Change Password')
@section('main')
    <main class="main-body">
        <div class="">
            <div class="user-warp">
                {!! Form::open(['action' => ['Sunsun\Auth\AuthUserController@changepassword'], 'method' => 'POST', 'class' => 'form']) !!}
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                @endif
                <div class="row mt-2">
                    <div class="col-3">
                        <p class="text-md-left pt-2">Old Password</p>
                    </div>
                    <div class="col-9">
                        <input name="password" type="password" id="password" class="form-control" required autofocus >
                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <p class="text-md-left pt-2">New Password</p>
                    </div>
                    <div class="col-9">
                        <input name="password_new" type="password" id="password_new" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3">
                        <a class= "no-effect">
                            <button type="submit" class="btn btn-block btn-booking text-white confirm-rules">Update</button>
                        </a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection

@section('script')

    @parent
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.css')}}"></script>
@endsection

