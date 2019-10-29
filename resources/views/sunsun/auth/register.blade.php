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

                <div class="form-group mb-3">
                    <div class="form-label">
                        {!! Form::label('username', '名前') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::text('username', null, ['class' => 'form-control mb-0']) !!}
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="form-label">
                        {!! Form::label('tel', '電話番号') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::text('tel', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="form-label">
                        {!! Form::label('email', 'Eメール') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="form-label">
                        {!! Form::label('password', 'パスワード') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="form-label">
                        {!! Form::label('gender', '性別') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::select('gender', ['female' => '女性', 'male' => '男性'], 'female', ['class' => "form-control"]) !!}

                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="form-label">
                        {!! Form::label('birth_year', '年齢') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::selectRange('birth_year', 1930, 2019, 1986,['class' => "form-control"] ) !!}
                    </div>
                </div>
                <div class="form-group" style="margin-top: 30px">
                    <div class="form-label">
                    </div>
                    <div class="form-input">
                        {{Form::button('登録', ['type'=> 'submit','class'=>'btn btn-block btn-booking text-white confirm-rules'])}}
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a class="center-link" href="/login">ログイン</a>
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

