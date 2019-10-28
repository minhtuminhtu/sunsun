@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
@endsection
@section('page_title', 'ログイン')
@section('main')
    <main class="main-body">
        <div class="container">
            <div class="user-warp">
            {!! Form::open(['action' => ['Sunsun\Auth\MsUserController@create'], 'method' => 'POST', 'class' => 'form']) !!}
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('email', 'Eメール') !!}
                        <p class="text-md-left pt-2"></p>
                    </div>
                    <div class="form-input">
                        {!! Form::text('email', null, ['class' => '']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('password', 'パスワード') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::password('password', ['class' => '']) !!}
                    </div>
                </div>
                <div class="form-group" style="margin-top: 15px">
                    <div class="form-label">
                    </div>
                    <div class="form-input">
                        {{Form::button('ログイン', ['type'=> 'submit','class'=>'btn btn-block btn-booking text-white confirm-rules'])}}
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <a href="/register" class="no-effect">ユーザー登録</a>
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

