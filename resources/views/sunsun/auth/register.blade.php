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
        (function($) {
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    }
                });
            };

            $('#tel').inputFilter(function(value) {
                if ( (1 < value.length <= 3) || (4 < value.length <= 7) || (7 < value.length <= 10)) {
                    let value_check = value.substring(1,3) + value.substring(5,7) + value.substring(8,10)

                    let check = /^\d*$/.test(value_check);

                    if (check === false) {
                        return  false;
                    }

                }
                console.log(format_phone);
                return format_phone;
            });
        }(jQuery));

    </script>
@endsection

