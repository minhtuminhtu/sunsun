@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1>Login  </h1>
        </div>
        <div class="container">
            <div class="booking-warp">
                <div class="row">
                    <div class="col-3">
                        <p class="text-md-left pt-2">Email</p>
                    </div>
                    <div class="col-9">
                        <input name="email" type="text" id="email" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <p class="text-md-left pt-2">Password</p>
                    </div>
                    <div class="col-9">
                        <input name="password" type="password" id="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="booking-warp">
                <div class="row">
                    <div class="col-6 offset-3">
                        <a>
                            <button type="button" class="btn btn-block btn-booking text-white confirm-rules">Login</button>
                        </a>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <a href="/create">Create new?</a>
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

