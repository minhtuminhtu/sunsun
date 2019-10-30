@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
    <style>
        .help-block {
            font-size: 0.85rem;
            color: red;
        }
    </style>
@endsection
@section('page_title', 'ログイン')
@section('main')
    <main class="main-body">
        <div class="container">
            <div class="user-warp">
            {!! Form::open(['action' => ['Sunsun\Auth\LoginController@login'], 'method' => 'POST', 'class' => 'form']) !!}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="form-group">
                    <!-- <div class="form-label">
                        {!! Form::label('email', 'Eメール') !!}
                        <p class="text-md-left pt-2"></p>
                    </div> -->
                    <div class="form-input">
                        {!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Eメール']) !!}
                    </div>
                </div>
                <div class="form-group pt-4">
                    <!-- <div class="form-label">
                        {!! Form::label('password', 'パスワード') !!}
                    </div> -->
                    <div class="form-input">
                        {!! Form::password('password', ['class' => 'form-control','placeholder' => 'パスワード']) !!}
                    </div>
                </div>
                <div class="form-group text-right" style="margin-top: 15px">
                    <a href="/register" class="right-link">パスワードを忘れたの方</a>
                </div>
                <div class="form-group" style="margin-top: 40px">
                    <div class="form-input">
                        {{Form::button('ログイン', ['type'=> 'submit','class'=>'btn btn-block btn-booking text-white confirm-rules'])}}
                    </div>
                </div>
                <div class="pt-3">
                    <div class="form-group text-center pb-0 mb-0 mt-5" style="margin-top: 15px">
                        アカウントを持っていない？
                    </div>
                    <div class="form-group text-center pt-0 mt-0" style="margin-top: 15px">
                        <a href="/register" class="center-link">ユーザー登録</a>
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </main>
    <hr class="footer-space">
@endsection

@section('footer')
    @parent
@endsection

@section('script')

    @parent
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.css')}}"></script>
@endsection

