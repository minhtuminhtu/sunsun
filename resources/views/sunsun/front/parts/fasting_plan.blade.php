<div class="booking-block">
    <div class="collapse collapse-top show" id="">
        <div class="booking-field">
            <div class="booking-field-label  booking-laber-padding">
            </div>
            <div class="booking-field-content">
                <p class="node-text text-left mb-2">断食プランには、1時間程度のミニ講座が含まれます。</p>
            </div>
        </div>
        <div class="booking-field">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.gender.label')}}</p>
            </div>
            <div class="booking-field-content">
                <select name="gender" class="form-control">
                    @foreach($gender as $value)
                        @if(isset($course_data['gender']) && ($value->kubun_id == $course_data['gender']))
                            <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                        @else
                            <option value='@json($value)'>{{ $value->kubun_value }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>


        <div class="booking-field mb-2">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.age.label')}}</p>
            </div>
            <div class="booking-field-content">
                <div class="age-col age">
                    <div class="age-left">
                        <select id="age_value"  name="age_value" class="form-control">
                            @for($j = 18; $j < 100; $j++ )
                                @if(isset($course_data['age_value']) && ($course_data['age_value'] == $j))
                                    <option selected value='{{ $j }}'>{{ $j }}</option>
                                @else
                                    <option value='{{ $j }}'>{{ $j }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>


        @php
            if(isset($course_data["service_date_start"]) && isset($course_data["service_date_end"])){
                $plan_date_start= substr($course_data['service_date_start'], 0, 4).'/'.substr($course_data['service_date_start'], 4, 2).'/'.substr($course_data['service_date_start'], 6, 2);
                $plan_date_end = substr($course_data['service_date_end'], 0, 4).'/'.substr($course_data['service_date_end'], 4, 2).'/'.substr($course_data['service_date_end'], 6, 2);
            }
        @endphp

        <div class="row">
            <div class="col-5">
                <p class="text-left pt-2   booking-laber-padding">{{config('booking.range_date_eat.label')}}</p>
            </div>
        </div>
        <input name="plan_date_start-value" id="plan_date_start-value" type="hidden" value="">
        <input name="plan_date_end-value" id="plan_date_end-value" type="hidden" value="">
        <input name="plan_date_start-view" id="plan_date_start-view" type="hidden" value="">
        <input name="plan_date_end-view" id="plan_date_end-view" type="hidden" value="">
        <div class="booking-field booking-room date-range_block {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}"  id="choice-range-day">
            <div class="field-start-day date-range_block_left">
                <p class="node-text">開始日</p>
                <input name="plan_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input range_date bg-white"  readonly="readonly" id="plan_date_start" value="{{ isset($plan_date_start)?$plan_date_start:'' }}">
            </div>
            <div class="date-range_block_center">
                <p class="">&nbsp;</p>
                <p class="character-date pt-2">～</p>
            </div>
            <div class="field-end-day date-range_block_right">
                <p class="node-text">終了日</p>
                <input name="plan_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input range_date bg-white"  readonly="readonly" id="plan_date_end" value="{{ isset($plan_date_end)?$plan_date_end:'' }}">
            </div>
        </div>


        <div>
            <div class="booking-field-100  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.range_time_eat.label')}}</p>
            </div>
            <div class="booking-field-100">
                <p class="node-text multiple-date mb-1">
                    1日2回ずつ入浴時間を選択します
                    <br> 入浴の間は2時間以上空けてください。
                </p>
            </div>
            @if(isset($date_unique_time))
            <div class="time-list" value="1">
                @php
                $i = 0;
                @endphp
                @foreach($date_unique_time as $key => $unique_time)
                    @php
                        $time_start = NULL;
                        $time_end = NULL;
                        if(is_array($course_time)){
                            foreach($course_time as $time){
                                if($key == $time['service_date']){
                                    break;
                                }
                            }
                        }
                        $time_start = substr($time['service_time_1'], 0, 2) . ":" . substr($time['service_time_1'], 2, 2);
                        $time_end = substr($time['service_time_2'], 0, 2) . ":" . substr($time['service_time_2'], 2, 2);
                        $bed_start = substr($time['notes'], 0, 1);
                        $bed_end = substr($time['notes'], 2, 3);
                    @endphp
                    <div class="booking-field choice-time">
                        <input value="0" class="time_index" type="hidden">
                        <div class="booking-field-label label-data pt-2">
                            <label class="">{{ $unique_time }}</label>
                            <input name="date[{{ $i }}][day][view]" value="{{ isset($time['service_date'])?$time['service_date']:'' }}" type="hidden">
                            <input name="date[{{ $i }}][day][value]" value="{{ isset($time['service_date'])?$time['service_date']:'' }}" type="hidden">
                        </div>
                        <div class="booking-field-content date-time">
                            <div class="choice-data-time set-time time-start">
                                <div class="set-time">
                                    <input name="date[{{ $i }}][from][value]" type="hidden" class="time_from time_value" readonly="readonly" value="{{ isset($time['service_time_1'])?$time['service_time_1']:'0' }}" />
                                    <input name="date[{{ $i }}][from][bed]" type="hidden" class="time_bed" readonly="readonly" value="{{ isset($bed_start)?$bed_start:'0' }}" />
                                    <input name="date[{{ $i }}][from][view]" type="text" class="time form-control js-set-time bg-white" data-date_value="'  + today.format('YYYY') + today.format('MM') +  today.format('DD') +'" data-date_type="form" readonly="readonly" value="{{ isset($time_start)?$time_start:'00:00' }}" />
                                    <input name="time[{{ $i }}][from][json]" type="hidden" class="data-json_input" value="" />
                                    <input name="time[{{ $i }}][from][element]" type="hidden" value="time_bath_10" />
                                </div>
                                <div class="icon-time mt-1">
                                </div>
                            </div>
                            <div class="choice-data-time set-time time-end">
                                <div class="set-time">
                                    <input name="date[{{ $i }}][to][value]" type="hidden" class="time_to time_value" readonly="readonly" value="{{ isset($time['service_time_2'])?$time['service_time_2']:'0' }}" />
                                    <input name="date[{{ $i }}][to][bed]" type="hidden" class="time_bed" readonly="readonly" value="{{ isset($bed_end)?$bed_end:'0' }}" />
                                    <input name="date[{{ $i }}][to][view]" type="text" class="time form-control js-set-time bg-white" data-date_value="'  + today.format('YYYY') + today.format('MM') +  today.format('DD') +'" data-date_type="to" readonly="readonly" value="{{ isset($time_end)?$time_end:'00:00' }}" />
                                    <input name="time[{{ $i }}][to][json]" type="hidden" class="data-json_input" value="" />
                                    <input name="time[{{ $i }}][to][element]" type="hidden" value="time_bath_11" />
                                </div>
                                <div class="icon-time mt-1"></div>
                            </div>
                        </div>
                    </div>
                @php
                $i++;
                @endphp
                @endforeach
            </div>
            @else
            <div class="time-list">
            </div>
            @endif
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="booking-line font-weight-bold mt-3">
    <div class="booking-line-laber">
        <div class="line-laber">オプション</div>
        <div class="line-button">
            <img class=" btn-collapse btn-collapse-between" id="btn-collapse-between"  data-toggle="collapse" data-target=".collapse-between" src="{{ asset('sunsun/svg/hide.svg') }}" alt="Plus" />
        </div>
    </div>
    <!-- <hr class="booking-line-line"> -->
</div>
<div class="collapse collapse-between show" id="">
    <div class="booking-block-between">
        <div class="" id="">
            <div class="booking-field">
                <div class="booking-field-label  booking-laber-padding">
                    <p class="text-left pt-2">{{config('booking.pet.label')}}</p>
                </div>
                <div class="booking-field-content">
                    <select name="pet_keeping" class="form-control">
                        @foreach($pet_keeping as $value)
                            @if(isset($course_data['pet_keeping']) && ($value->kubun_id == $course_data['pet_keeping']))
                                <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                            @else
                                <option value='@json($value)'>{{ $value->kubun_value }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!isset($add_new_user))
    <div class="booking-line font-weight-bold mt-3">
        <div class="booking-line-laber">
            <div class="line-laber">宿泊</div>
            <div class="line-button">
                <img class=" btn-collapse btn-collapse-finish" id="btn-collapse-finish"  data-toggle="collapse" data-target=".collapse-finish" src="{{ asset('sunsun/svg/hide.svg') }}" alt="Plus" />
            </div>
        </div>
        <!-- <hr class="booking-line-line"> -->
    </div>
    <div class="collapse collapse-finish show" id="">
        <div class="booking-block-finish">
            <div class="" id="">
                <div class="booking-field">
                    <div class="booking-field-label  booking-laber-padding">
                        <p class="text-left pt-2">宿泊<span class="node-text">(部屋ﾀｲﾌﾟ)</span></p>
                    </div>
                    <div class="booking-field-content">
                        <select name="stay_room_type" id="room" class="form-control">
                            @foreach($stay_room_type as $value)
                                @if(isset($course_data['stay_room_type']) && ($value->kubun_id == $course_data['stay_room_type']))
                                    <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                                @else
                                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @php
                    $room_whitening = true;
                    if(isset($course_data["stay_room_type"]) && ($course_data['stay_room_type'] != '01')){
                        $room_whitening = false;
                        $range_date_start= substr($course_data['stay_checkin_date'], 0, 4).'/'.substr($course_data['stay_checkin_date'], 4, 2).'/'.substr($course_data['stay_checkin_date'], 6, 2);
                        $range_date_end = substr($course_data['stay_checkout_date'], 0, 4).'/'.substr($course_data['stay_checkout_date'], 4, 2).'/'.substr($course_data['stay_checkout_date'], 6, 2);
                    }
                @endphp
                <div class="booking-field room" @if($room_whitening) style="display:none;" @endif>
                    <div class="booking-field-label  booking-laber-padding">
                        <p class="text-left pt-2">{{config('booking.stay_guest_num.label')}}</p>
                    </div>
                    <div class="booking-field-content">
                        <select name="stay_guest_num" class="form-control">
                            @foreach($stay_guest_num as $value)
                                @if(isset($course_data['stay_guest_num']) && ($value->kubun_id == $course_data['stay_guest_num']))
                                    <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                                @else
                                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="booking-field room"  @if($room_whitening) style="display:none;" @endif>
                    <div style="width: 100%;">
                        <div style="width: 100%;">
                            <input name="range_date_start-view" id="range_date_start-view" type="hidden" value="">
                            <input name="range_date_end-view" id="range_date_end-view" type="hidden" value="">
                            <input name="range_date_start-value" id="range_date_start-value" type="hidden" value="">
                            <input name="range_date_end-value" id="range_date_end-value" type="hidden" value="">
                            <div class="range_room booking-room input-daterange  date-range_block" id="choice-range-day">
                                <div class="field-start-day date-range_block_left">
                                    <p class="node-text">{{config('booking.range_date.checkin')}}</p>
                                    <input name="range_date_start" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input room_range_date bg-white"  readonly="readonly" id="range_date_start" value="{{ isset($range_date_start)?$range_date_start:'' }}">
                                </div>
                                <div class="field-center date-range_block_center">
                                    <p>&nbsp;</p>
                                    <p class="character-date pt-2">～</p>
                                </div>
                                <div class="field-end-day date-range_block_right">
                                    <p class="node-text">{{config('booking.range_date.checkout')}}</p>
                                    <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input room_range_date bg-white"  readonly="readonly" id="range_date_end" value="{{ isset($range_date_end)?$range_date_end:'' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
