@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
@endsection
@section('page_title', 'ユーザー登録')
@section('main')
    <main class="main-body">
        <div class="container">
            <div class="user-warp">
                {!! Form::open(['action' => ['Sunsun\Auth\MsUserController@create'], 'method' => 'POST', 'class' => 'form']) !!}

                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('username', '名称') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::text('username', null, ['class' => '']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('tel', 'Tel') !!}
                        <p class="text-md-left pt-2"></p>
                    </div>
                    <div class="form-input">
                        {!! Form::text('tel', null, ['class' => '']) !!}
                    </div>
                </div>
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

                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('gender', '性別') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::select('gender', ['female' => 'Female', 'male' => 'Male'], 'female', ['class' => ""]) !!}

                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('birth_year', '年齢') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::selectRange('birth_year', 1930, 2019, 1986,['class' => ""] ) !!}
                    </div>
                </div>
                <div class="form-group" style="margin-top: 15px">
                    <div class="form-label">
                    </div>
                    <div class="form-input">
                        {{Form::button('登録', ['type'=> 'submit','class'=>'btn btn-block btn-booking text-white confirm-rules'])}}
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <a href="/login" class="no-effect">ログイン</a>
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
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.js')}}"></script>
    <script>
        var phoneField = $('input[name=tel]');
        phoneField.on('keyup', function(){
            var phoneValue = phoneField.val();
            var output;
            phoneValue = phoneValue.replace(/[^0-9]/g, '');
            var area = phoneValue.substr(0, 3);
            var pre = phoneValue.substr(3, 3);
            var tel = phoneValue.substr(6, 4);
            if (area.length < 3) {
                output = "(" + area;
            } else if (area.length == 3 && pre.length < 3) {
                output = "(" + area + ")" + " " + pre;
            } else if (area.length == 3 && pre.length == 3) {
                output = "(" + area + ")" + " " + pre + " - "+tel;
            }
            phoneField.val() = output;

        });
    </script>
@endsection

