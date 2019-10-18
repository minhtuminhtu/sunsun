@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
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
                            <div class="row pb-0">
                                <input id="agecheck" name='agecheck' type="hidden" value="{{config('booking.age.age3')}}">
                                <div class="col-4 pl-0">
                                    <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 age">{{config('booking.age.age1')}}</button>
                                    <button type="button" class="btn btn-block btn-outline-warning  btn-warning text-dark mt-1 mx-0 age">{{config('booking.age.age3')}}</button>
                                </div>
                                <div class="col-8 pl-0">
                                    <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 age">{{config('booking.age.age2')}}</button>
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
                            <div class="row">
                                <div class="col-10">
                                    <input name='time' type="text" class="form-control" id="pwd" value="13:45" />
                                </div>

                                <div class="col-2">
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

@section('script')
    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}" charset="UTF-8"></script>
    <script>
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
        });

        $('.age').click(function(){
            $('.age').removeClass('btn-warning');
            $(this).addClass('btn-warning');
            $('#agecheck').val($(this).text())
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

