@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1 class="title-menu">ユーザー登録</h1>
        </div>
        <div class="container">
            @include('sunsun.front.users._form', ["new" => 1, "name" => "", "email" => ""])
            <div class="user-warp">
                <div class="row">
                    <div class="col-6 offset-3">
                        <a class= "no-effect">
                            <button type="button" class="btn btn-block btn-booking text-white confirm-rules">登録</button>
                        </a>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <a href="/login" class= "no-effect">ログイン</a>
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
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.css')}}"></script>
@endsection

