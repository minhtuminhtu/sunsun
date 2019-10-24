@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1 class="title-menu">ログイン</h1>
        </div>
        <div class="container">
            <div class="user-warp">
                <div class="row">
                    <div class="col-3">
                        <p class="text-md-left pt-2">Eメール</p>
                    </div>
                    <div class="col-9">
                        <input name="email" type="text" id="email" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <p class="text-md-left pt-2">パスワード</p>
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
                            <button type="button" class="btn btn-block btn-booking text-white confirm-rules">ログイン</button>
                        </a>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <a href="/create" class= "no-effect">ユーザー登録</a>
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
    <script src="{{asset('sunsun/lib/meanmenu/jquery.meanmenu.js')}}" charset="UTF-8"></script>
    <script>
        $(function() {
            $('header nav').meanmenu();
        });
    </script>
@endsection

