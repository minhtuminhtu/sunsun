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
                <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-4 offset-xl-4 pb-4 border-left border-bottom border-right">
                    <div class="row pt-4">
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
                            <select name="services" id="services" class="custom-select">
                                @foreach(config('booking.services.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <p class="text-md-left mt-2 mb-0 service_1">入浴時間約30分</p>
                            <p class="text-md-left mb-2 service_1">(全体の滞在時間約90分)</p>
                            <p class="text-md-left mb-2 service_4" style="display:none">断食プランには、1時間程度のミニ講座が含まれます。</p>
                        </div>
                    </div>
                    <div class="row service_1 service_2 service_4">
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
                    <div class="row mb-2 service_1 service_2 service_4">
                        <div class="col-3">
                            <p class="text-md-left pt-2">{{config('booking.age.label')}}</p>
                        </div>
                        <div class="col-9">
                            <div class="row pb-0">
                                <input id="agecheck" name='agecheck' type="hidden" value="{{config('booking.age.age3')}}">
                                <div class="col-4 pl-0">
                                    <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 service_1 agecheck">{{config('booking.age.age1')}}</button>
                                    <button type="button" class="btn btn-block btn-outline-warning  btn-warning text-dark mt-1 mx-0 service_1 agecheck">{{config('booking.age.age3')}}</button>
                                </div>
                                <div class="col-8 pl-0">
                                    <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 service_1 agecheck">{{config('booking.age.age2')}}</button>
                                    <div class="row age mt-1">
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

                    <div class="row service_4" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.range_date_eat.label')}}</p>
                        </div>
                    </div>
                    <div class="row service_4" style="display:none;">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-5 m-0 pr-0">
                                    <pre class="ml-5 mb-0">{{config('booking.range_date_eat.start')}}</pre>
                                    <input name='range_date_start'  data-format="yyyy/MM/dd" type="text" class="ml-4 form-control date-book-input" id="pwd" value="2019/9/20(金)" />
                                </div>
                                <div class="col-2">
                                    <pre class="mb-0">&#160;</pre>
                                    <p class="text-md-left pt-2 ml-4">～</p>
                                </div>
                                <div class="col-5 m-0 pl-0">
                                    <pre class="ml-5 mb-0">{{config('booking.range_date_eat.end')}}</pre>
                                    <input name='range_date_end'  data-format="yyyy/MM/dd" type="text" class="ml-4 form-control date-book-input" id="pwd" value="2019/9/20(金)" />
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <pre class="mb-0">&#160;</pre>
                            <span class="add-on ml-3">
                                <i class="fa fa-calendar-alt fa-2x "></i>
                            </span>
                        </div>
                    </div>

                    <div class="row service_4" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.range_time_eat.label')}}</p>
                        </div>
                    </div>
                    <div class="row service_4" style="display:none;">
                        <div class="col-10 pl-4">
                            <p class="text-md-left mt-0 mb-0">1日2回ずつ入浴時間を選択します</p>
                            <p class="text-md-left mt-0 mb-0">入浴の間は2時間以上空けてください。</p>
                        </div>
                    </div>
                    <div class="row service_4" style="display:none;">
                        <div class="row">
                            <div class="col-2">
                                <p class="text-md-left pt-2 pl-4">9/20(金)</p>
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-4 pr-2">
                                        <input type="text" class="form-control date-book-input" id="pwd" value="9:45" />
                                    </div>
                                    <div class="col-2 pr-0">
                                        <span class="add-on">
                                            <i class="fa fa-clock fa-2x "></i>
                                        </span>
                                    </div>
                                    <div class="col-4 pl-2">
                                        <input type="text" class="form-control date-book-input" id="pwd" value="13:45" />
                                    </div>
                                    
                                    <div class="col-2 pl-2">
                                        <span class="add-on">
                                            <i class="fa fa-clock fa-2x "></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row service_4" style="display:none;">
                        <div class="row">
                            <div class="col-2">
                                <p class="text-md-left pt-2 pl-4">9/20(金)</p>
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-4 pr-2">
                                        <input type="text" class="form-control date-book-input" id="pwd" value="9:45" />
                                    </div>
                                    <div class="col-2 pr-0">
                                        <span class="add-on">
                                            <i class="fa fa-clock fa-2x "></i>
                                        </span>
                                    </div>
                                    <div class="col-4 pl-2">
                                        <input type="text" class="form-control date-book-input" id="pwd" value="13:45" />
                                    </div>
                                    
                                    <div class="col-2 pl-2">
                                        <span class="add-on">
                                            <i class="fa fa-clock fa-2x "></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row service_1 service_2 service_3 service_5">
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
                    <div class="row service_1">
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
                    <div class="row service_2" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2 mb-0">{{config('booking.time.label')}}</p>
                        </div>
                    </div>
                    <div class="row service_2" style="display:none;">
                        <div class="col-5 offset-1">
                            <p class="text-md-left pt-2">{{config('booking.time.laber1')}}</p>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-10">
                                    <input name='time1' type="text" class="form-control" id="pwd" value="13:45" />
                                </div>

                                <div class="col-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row service_2" style="display:none;">
                        <div class="col-5 offset-1">
                            <p class="text-md-left pt-2">{{config('booking.time.laber2')}}</p>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-10">
                                    <input name='time2' type="text" class="form-control" id="pwd" value="13:45" />
                                </div>

                                <div class="col-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row service_3 service_5" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.time.label')}}</p>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-10">
                                    <input name='time_room' type="text" class="form-control" id="pwd" value="13:45 ~ 15:45" />
                                </div>

                                <div class="col-2 pl-0 ">
                                    <span class="add-on">
                                        <i class="fa fa-clock fa-2x"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row service_3" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.number_guests_book.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="number_guests_book" class="custom-select">
                                @foreach(config('booking.number_guests_book.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row service_3" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.number_lunch_book.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="number_lunch_book" class="custom-select">
                                @foreach(config('booking.number_lunch_book.options') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row service_1">
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
                    <div class="row service_1 service_2 service_3">
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
                    <div class="row service_1 service_2 service_3 service_4">
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
                    <div class="row  service_1 service_2 service_3 service_4">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.room.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="room" id="room" class="custom-select">
                                @foreach(config('booking.room.options') as $key => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row service_5" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.number_pet.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="number_pet" id="number_pet" class="custom-select">
                                @foreach(config('booking.number_pet.options') as $key => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row service_5" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.pet_type.label')}}</p>
                        </div>
                        <div class="col-7">
                            <textarea class="form-control" name='pet_type' rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row room" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.number_guests_stay.label')}}</p>
                        </div>
                        <div class="col-7">
                            <select name="number_guests_stay" class="custom-select">
                                @foreach(config('booking.number_guests_stay.options') as $key => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row room" style="display:none;">
                        <div class="col-5">
                            <p class="text-md-left pt-2">{{config('booking.range_date.label')}}</p>
                        </div>
                    </div>
                    <div class="row room" style="display:none;">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-5 m-0 pr-0">
                                    <pre class="ml-5 mb-0">{{config('booking.range_date.checkin')}}</pre>
                                    <input name='range_date_start'  data-format="yyyy/MM/dd" type="text" class="ml-4 form-control date-book-input" id="pwd" value="2019/9/20(金)" />
                                </div>
                                <div class="col-2">
                                    <pre class="mb-0">&#160;</pre>
                                    <p class="text-md-left pt-2 ml-4">～</p>
                                </div>
                                <div class="col-5 m-0 pl-0">
                                    <pre class="ml-5 mb-0">{{config('booking.range_date.checkout')}}</pre>
                                    <input name='range_date_end'  data-format="yyyy/MM/dd" type="text" class="ml-4 form-control date-book-input" id="pwd" value="2019/9/20(金)" />
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <pre class="mb-0">&#160;</pre>
                            <span class="add-on ml-3">
                                <i class="fa fa-calendar-alt fa-2x "></i>
                            </span>
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

        $('.agecheck').click(function(){
            $('.agecheck').removeClass('btn-warning');
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
        $('#room').on('change', function() {
            if(this.value == '無し'){
                $('.room').hide();
            }else{
                $('.room').show();
            }
        });
        $('#services').on('change', function() {
            if(this.value == '酵素浴'){
                $('.service_2').hide();
                $('.service_3').hide();
                $('.service_4').hide();
                $('.service_5').hide();
                $('.service_1').show();
            }else if(this.value == '1日リフレッシュプラン'){
                $('.service_1').hide();
                $('.service_3').hide();
                $('.service_4').hide();
                $('.service_5').hide();
                $('.service_2').show();
            }else if(this.value == '酵素部屋貸切プラン'){
                $('.service_1').hide();
                $('.service_2').hide();
                $('.service_4').hide();
                $('.service_5').hide();
                $('.service_3').show();
            }else if(this.value == '断食プラン'){
                $('.service_1').hide();
                $('.service_2').hide();
                $('.service_3').hide();
                $('.service_5').hide();
                $('.service_4').show();
            }else if(this.value == 'ペット酵素浴'){
                $('.service_1').hide();
                $('.service_2').hide();
                $('.service_3').hide();
                $('.service_4').hide();
                $('.service_5').show();
            }
        });
    </script>
@endsection

