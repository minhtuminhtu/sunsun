@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1 class="title-menu">Change Password </h1>
        </div>
        <div class="container">
            <div class="user-warp">
                <div class="row mt-2">
                    <div class="col-3">
                        <p class="text-md-left pt-2">Old Password</p>
                    </div>
                    <div class="col-9">
                        <input name="password" type="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <p class="text-md-left pt-2">New Password</p>
                    </div>
                    <div class="col-9">
                        <input name="password" type="password" id="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="user-warp">
                <div class="row">
                    <div class="col-6 offset-3">
                        <a class= "no-effect">
                            <button type="button" class="btn btn-block btn-booking text-white confirm-rules">Update</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection

@section('script')

    @parent

@endsection

