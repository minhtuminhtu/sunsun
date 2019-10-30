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
                        {!! Form::text('username', null, ['class' => '', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('tel', 'Tel') !!}
                        <p class="text-md-left pt-2"></p>
                    </div>
                    <div class="form-input">
                        {!! Form::text('tel', null, ['class' => '', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('email', 'Eメール') !!}
                        <p class="text-md-left pt-2"></p>
                    </div>
                    <div class="form-input">
                        {!! Form::text('email', null, ['class' => '', 'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('password', 'パスワード') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::password('password', ['class' => '', 'required' => 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('gender', '性別') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::select('gender', ['female' => 'Female', 'male' => 'Male'], 'female', ['class' => "", 'required' => 'required']) !!}

                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        {!! Form::label('birth_year', '年齢') !!}
                    </div>
                    <div class="form-input">
                        {!! Form::selectRange('birth_year', 1930, 2019, 1986,['class' => "", 'required' => 'required'] ) !!}
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
        (function ($) {
            $.fn.inputFilter = function (inputFilter) {
                return this.on("keydown keyup", function (event) {
                    if ((event.key !== 'Backspace') && (event.key !== 'undefined')) {
                        let curchr = this.value.length;
                        let curval = $(this).val();
                        let phone_format;
                        if (curchr < 3 && curval.indexOf("(") <= -1) {
                            phone_format = "(" + curval;
                        } else if (curchr == 4 && curval.indexOf("(") > -1) {
                            phone_format = curval + ")-";
                        } else if (curchr == 5) {
                            if (event.key != ")") {
                                phone_format = this.oldValue + ")-" + event.key
                            } else {
                                phone_format = curval;
                            }
                        } else if (curchr == 6 && curval.indexOf("-") <= -1) {
                            if (event.key != "-") {
                                phone_format = this.oldValue + '-' + event.key
                            } else {
                                phone_format = curval;
                            }
                        } else if (curchr == 9) {
                            phone_format = curval + "-";
                            $(this).attr('maxlength', '14');
                        } else if (curchr == 10) {
                            console.log(event.key);
                            if (event.key != "-") {
                                phone_format = this.oldValue + '-' + event.key
                            } else {
                                phone_format = curval;
                            }
                        } else {
                            phone_format = curval;
                        }
                        let regex = /^[\+]?[(]?[0-9]{0,3}[)]?[-\s\.]?[0-9]{0,3}[-\s\.]?[0-9]{0,6}$/im;
                        let test = regex.test(phone_format);
                        if (test === true) {
                            $(this).val(phone_format);
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                            this.value = this.oldValue;
                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        }
                    } else {
                        this.oldValue = $(this).val();
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    }

                });
            };

            $('#tel').inputFilter(function (value) {
                return true;
            });
        }(jQuery));

    </script>
@endsection

