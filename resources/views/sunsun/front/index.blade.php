@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css')}}">
    <style>
        #choice_date_time  table{
            width: 100%;
        }
        #choice_date_time th, #choice_date_time td {
            border: 1px solid #ccc;
            vertical-align: middle;
            text-align: center;
        }
        #choice_date_time .title-table-time {
            text-align: center;
            background: rgb(255,204,255);
        }
        #choice_date_time .modal-footer {
        }
    </style>
@endsection

@section('main')
<main id="mainArea">
    <div class="container-fluid">
        <div class="row ">
            <form action="{{route('.confirm')}}" method="POST" style="width: 100%">
                @csrf
                <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-4 offset-xl-4 pb-3 border-left border-bottom border-right">
                    <div class="row mt-4">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.used.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="used" class="custom-select">
                                @foreach(config('booking.used.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.transportation.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="transportation" id='transportation' class="custom-select">
                                @foreach(config('booking.transportation.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row bus" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.bus_arrival.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="bus_arrival" class="custom-select">
                                @foreach(config('booking.bus_arrival.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row bus" style="display:none">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.pick_up.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="pick_up" class="custom-select">
                                @foreach(config('booking.pick_up.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <p class="text-md-left mt-2 mb-2">バスの方は洲本ICのバス停に送迎を行います。</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.services.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="services" class="custom-select">
                                @foreach(config('booking.services.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <p class="text-md-left mt-2 mb-0">入浴時間約30分</p>
                            <p class="text-md-left mb-2">(全体の滞在時間約90分)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.sex.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="sex" class="custom-select">
                                @foreach(config('booking.sex.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>





                    <div class="row mb-2">
                        <div class="col-3">
                            <p class="text-md-left pt-2">{{config('booking.age.label')}}</p>
                        </div>
                        <div class="col-9">
                            <!-- <div class="btn-group btn-group-toggle" data-toggle="buttons"> -->
                            <div class="row pb-0">
                                    <div class="col-4 pl-0">
                                        <label class="btn btn-block btn-outline-warning text-dark mt-1 mx-0">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked>{{config('booking.age.age1')}}
                                        </label>
                                        <label class="btn btn-block btn-warning text-dark mt-2">
                                            <input type="radio" name="options" id="option2" autocomplete="off">{{config('booking.age.age3')}}
                                        </label>
                                    </div>
                                    <div class="col-8 pl-0">
                                        <label class="btn btn-block btn-outline-warning text-dark mt-1 mx-0">
                                            <input type="radio" name="options" id="option3" autocomplete="off">{{config('booking.age.age2')}}
                                        </label>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <select name="age" class="custom-select">
                                                    @foreach(config('booking.age.options') as $key => $value)
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.date.label')}}</p>
                        </div>
                        <div class="col-7">
                            <div class="row carousel-warp">
                                <div class="col-10">
                                    <input name='date'  data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="pwd" value="2019/9/20(金)" />
                                </div>

                                <div class="col-2 pl-0 ">
                                     <span class="add-on">
                                      <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar-alt fa-2x " id="date-book"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.time.label')}}</p>
                        </div>
                        <div class="col-7">
                            <div class="row set-time">
                                <div class="col-10">
                                    <input name='time' type="text" class="form-control" id="" value="13:45" />
                                </div>

                                <div class="col-2 pl-0">
                                    <span class="icon-clock">
                                      <i class="far fa-clock fa-2x js-set-time"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.lunch.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="lunch" class="custom-select">
                                @foreach(config('booking.lunch.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <p class="text-md-left mt-2 mb-2">ランチは11:30からです</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.whitening.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="whitening" class="custom-select">
                                @foreach(config('booking.whitening.options') as $key => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.pet.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="pet" class="custom-select">
                                @foreach(config('booking.pet.options') as $key => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.room.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="room" class="custom-select">
                                @foreach(config('booking.room.options') as $key => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
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
            </form>
        </div>
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
                    <button type="button" class="btn btn-outline-primary" id="js-save-time" style="padding: 2px 13px;">Save</button>
                    <button type="button" class="btn btn-outline-dark"  style="padding: 2px 13px;" data-dismiss="choice_date_time" data-target="#choice_date_time" data-toggle="modal" data-backdrop="static" data-keyboard="false">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/moment.min.js')}}" charset="UTF-8"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}" charset="UTF-8"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/daterangepicker.min.js')}}" charset="UTF-8"></script>
    <script>
        var $site_url = '{{url('/')}}';
        /**
         * Japanese translation for bootstrap-datepicker
         * Norio Suzuki <https://github.com/suzuki/>
         */
        $(function() {

            $('#date-book').datepicker({
                language: 'ja'
            });
            $('#date-book').on('changeDate', function() {
                $('.date-book-input').val(
                    $('#date-book').datepicker('getFormattedDate')
                );
            });

            let modal_choice_time = $('#choice_date_time');
            let set_time = $('.js-set-time');
            set_time.click(function (e) {
                let set_time_click = $(this);
                $.ajax({
                    url: $site_url +'/get_time_room',
                    type: 'POST',
                    data: {
                        'sex': $('select[name=sex]').val()
                    },
                    dataType: 'text',
                    beforeSend: function () {
                        loader.css({'display': 'block'});
                    },
                    success: function (html) {
                        set_time_click.closest('.set-time').addClass('edit')
                        modal_choice_time.find('.modal-body-time').append(html);
                        modal_choice_time.modal('show');
                    },
                    complete: function () {
                        loader.css({'display': 'none'});
                    },
                });
            });

            modal_choice_time.on('hidden.bs.modal', function () {
                modal_choice_time.find('.modal-body-time').empty();
            });
            modal_choice_time.on('click','#js-save-time',function (e) {
                let time = modal_choice_time.find('input[name=time]:checked').val();
                $('.set-time.edit input[name=time]').val(time);
                modal_choice_time.modal('hide');
            })
        });



        $('#transportation').on('change', function() {
            if(this.value == '車​'){
                $('.bus').hide();
            }else{
                $('.bus').show();
            }
        });
    </script>
@endsection

