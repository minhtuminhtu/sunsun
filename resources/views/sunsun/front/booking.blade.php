@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
    <style>
        .data-field-day {
            background: rgb(251,229,214);
            margin-bottom: 15px;
            line-height: 2.5rem;
            font-size: 1.2rem;
            text-align: center;
            margin-left: -10px;
            margin-right: -10px;
        }
    </style>
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1 class="title-menu">予約入力  </h1>
        </div>
        <div class="container">
            <form action="{{route('.confirm')}}" method="POST" class="booking">
                <div class="row">
                    @csrf
                    <div class="booking-warp">

                        @if(isset($add_new_user) && $add_new_user == 'on')
                            <div class="data-field-day">
                                  <span>
                                @if (isset($customer['date-view']))
                                    {{$customer['date-view']}}
                                @else
                                    {{$customer['date-view-from']}} <br>
                                    {{$customer['date-view-to']}}
                                @endif
                                </span>  &nbsp;  &nbsp;
                                <span>
                                    予約追加
                                </span>
                            </div>
                        @endif


                        <div class="booking-field">
                            <div class="booking-field-label">
                                <p class="text-md-left pt-2">{{config('booking.used.label')}}</p>
                            </div>
                            <div class="booking-field-content">
                                <select name="used" class="form-control">
                                    @foreach(config('booking.used.options') as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="booking-field {{(isset($add_new_user) && $add_new_user == 'on')?'hidden':''}}">
                            <div class="booking-field-label">
                                <p class="text-md-left pt-2">{{config('booking.transportation.label')}}</p>
                            </div>
                            <div class="booking-field-content">
                                <select name="transportation" id='transportation' class="form-control">
                                    @foreach(config('booking.transportation.options') as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="booking-field bus" style="display:none;">
                            <div class="booking-field-label">
                                <p class="text-md-left pt-2">{{config('booking.bus_arrival.label')}}</p>
                            </div>
                            <div class="booking-field-content">
                                <select name="bus_arrival" class="form-control">
                                    @foreach(config('booking.bus_arrival.options') as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="booking-field bus" style="display:none">
                            <div class="booking-field-label">
                                <p class="text-md-left pt-2">{{config('booking.pick_up.label')}}</p>
                            </div>
                            <div class="booking-field-content">
                                <select name="pick_up" class="form-control">
                                    @foreach(config('booking.pick_up.options') as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <p class="text-md-left mt-2 mb-2">バスの方は洲本ICのバス停に送迎を行います。</p>
                            </div>
                        </div>
                        <div class="booking-field">
                            <div class="booking-field-label">
                                <p class="text-md-left pt-2">{{config('booking.services.label')}}</p>
                            </div>
                            <div class="booking-field-content">
                                <select name="services" id="services" class="form-control">
                                    @foreach(config('booking.services.options') as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="service-warp">

                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                @if(isset($add_new_user) && $add_new_user == 'on')
                                    <input type="hidden" name="add_new_user" value="on">
                                @endif
                                <button type="button" class="btn btn-block text-white btn-booking add-new-people">予約追加</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-block text-white btn-booking">予約確認へ</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('footer')
    @parent
    <!-- The Modal -->
    <div class="modal" id="choice_date_time">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body-time">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer" style="padding: 6px;">
                    <button type="button" class="btn btn-outline-primary" id="js-save-time" style="padding: 2px 13px;">
                        Save
                    </button>
                    <button type="button" class="btn btn-outline-dark" style="padding: 2px 13px;"
                            data-dismiss="choice_date_time" data-target="#choice_date_time" data-toggle="modal"
                            data-backdrop="static" data-keyboard="false">Close
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/moment.min.js')}}" charset="UTF-8"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}"
            charset="UTF-8"></script>
    <script src="{{asset('sunsun/front/js/booking.js').config('version_files.html.js')}}"></script>
@endsection

