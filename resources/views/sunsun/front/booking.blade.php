@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="container">
            <form action="{{route('.confirm')}}" method="POST" class="booking">
                <div class="row">
                    @csrf
                    <div class="booking-warp">
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
                        <div class="booking-field">
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
                            <div class="booking-field">
                                <div class="booking-field-label">
                                </div>
                                <div class="booking-field-content">
                                    <p class="node-text text-md-left mt-2 mb-0">入浴時間約30分</p>
                                    <p class="node-text text-md-left mb-2">(全体の滞在時間約90分)</p>
                                </div>
                            </div>
                            <div class="booking-field">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.sex.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <select name="sex" class="form-control">
                                        @foreach(config('booking.sex.options') as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="booking-field mb-2">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.age.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <div class="row pb-0">
                                        <input id="agecheck" name='agecheck' type="hidden"
                                               value="{{config('booking.age.age3')}}">
                                        <div class="col-4 pl-0">
                                            <button type="button"
                                                    class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 agecheck">{{config('booking.age.age1')}}</button>
                                            <button type="button"
                                                    class="btn btn-block btn-outline-warning  btn-warning text-dark mt-1 mx-0 agecheck">{{config('booking.age.age3')}}</button>
                                        </div>
                                        <div class="col-8 pl-0">
                                            <button type="button"
                                                    class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 agecheck">{{config('booking.age.age2')}}</button>
                                            <div class="row age mt-1">
                                                <div class="col-6">
                                                    <select name="age" class="form-control">
                                                        @foreach(config('booking.age.options') as $key => $value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-field">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.date.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <div class="row date-warp">
                                        <div class="col-10">
                                            <input name='date' id="date" data-format="yyyy/MM/dd" type="text"
                                                   class="form-control date-book-input" id="pwd" value="2019/9/20(金)"/>
                                            <input name="date-view" id="date-view" type="hidden" value="2019年9月20日(金)">
                                        </div>

                                        <div class="col-2 pl-0 mt-1">
                                        <span class="add-on">
                                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"
                                               class="fa fa-calendar-alt fa-2x date-book"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-field">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.time.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <div class="row set-time">
                                        <div class="col-10">
                                            <input name='time' type="text" class="form-control time" id=""
                                                   value="13:45"/>
                                        </div>

                                        <div class="col-2 pl-0 mt-1">
                                        <span class="icon-clock">
                                            <i class="far fa-clock fa-2x js-set-time"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-field">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.lunch.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <select name="lunch" class="form-control">
                                        @foreach(config('booking.lunch.options') as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p class="node-text text-md-left mt-2 mb-2">ランチは11:30からです</p>
                                </div>
                            </div>
                            <div class="booking-field">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.whitening.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <select name="whitening" class="form-control">
                                        @foreach(config('booking.whitening.options') as $key => $value)
                                            <option>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="booking-field">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.pet.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <select name="pet" class="form-control">
                                        @foreach(config('booking.pet.options') as $key => $value)
                                            <option>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="booking-field">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.room.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <select name="room" id="room" class="form-control">
                                        @foreach(config('booking.room.options') as $key => $value)
                                            <option>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="booking-field-content room" style="display:none;">
                                <div class="">
                                    <p class="text-md-left pt-2">{{config('booking.range_date.label')}}</p>
                                </div>
                            </div>
                            <div class="booking-field room" style="display:none;">
                                <div class="booking-field-label">
                                    <p class="text-md-left pt-2">{{config('booking.number_guests_stay.label')}}</p>
                                </div>
                                <div class="booking-field-content">
                                    <select name="number_guests_stay" class="form-control">
                                        @foreach(config('booking.number_guests_stay.options') as $key => $value)
                                            <option>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="booking-field room" style="display:none;">
                                <div class="booking-field input-daterange" id="choice-range-day">
                                    <div class="field-start-day">
                                        <p class="">{{config('booking.range_date.checkin')}}</p>
                                        <input name="range_date_start" data-format="yyyy/MM/dd" type="text"
                                               class=" form-control date-book-input room_range_date" id="range_date_start"
                                               value="2019/9/20">
                                        <input name="range_date_start-view" id="range_date_start-view" type="hidden" value="2019年9月20日(金)">
                                    </div>
                                    <div class="">
                                        <p class="">&nbsp;</p>
                                        <p class="character-date">～</p>
                                    </div>
                                    <div class="field-end-day">
                                        <p class="">{{config('booking.range_date.checkout')}}</p>
                                        <input name="range_date_end" data-format="yyyy/MM/dd" type="text"
                                               class="form-control date-book-input room_range_date" id="range_date_end"
                                               value="2019/9/20">
                                        <input name="range_date_end-view" id="range_date_end-view" type="hidden" value="2019年9月20日(金)">
                                    </div>

                                </div>
                                <div class="">
                                    <pre class="mb-0">&nbsp;</pre>
                                    <span class="add-on ml-3">
                                    <i class="fa fa-calendar-alt fa-2x mt-1"></i>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-6">
                                <button type="button" class="btn btn-block btn-warning text-white">予約追加</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-block btn-warning text-white">予約確認へ</button>
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
    <script src="{{asset('sunsun/front/js/booking.js').config('version_files.html.css')}}"></script>
@endsection

