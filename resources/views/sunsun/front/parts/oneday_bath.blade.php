@php
    $course_data = json_decode($course_data, true);
    $course_time = json_decode($course_time, true);
@endphp
<div class="booking-block">
    <div class="collapse collapse-top show" id="">
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

        <div class="booking-field">
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
        @if(!isset($add_new_user))
        <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.date.label')}}</p>
            </div>
            <input name="date-view" id="date-view" type="hidden" value="">
            <input name="date-value" id="date-value" type="hidden" value="">
            <div class="booking-field-content">
                <div class="timedate-block date-warp">
                    <input name='date' id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input bg-white"  readonly="readonly" id="pwd" value="" />
                </div>
            </div>
        </div>
        @endif
        <div class="booking-field">
            <div class="booking-laber-padding">
                <p class="text-left pt-2 mb-0">{{config('booking.time.label')}}</p>
            </div>
        </div>
        <div class="booking-field">
            <div class="booking-field-label  booking-laber-padding pl-1">
                <p class="text-left pt-2 pl-3  node-text">{{config('booking.time.laber1')}}</p>
            </div>
            <div class="booking-field-content">
                <div class="timedate-block set-time">
                    <input name="time1-value" id="time1-value" class="time_value" type="hidden" value="0">
                    <input name="time1-bed" id="time1-bed" class="time1-bed" type="hidden" value="1">
                    <input name="time1-view" type="text" class="form-control time js-set-time bg-white"  readonly="readonly" id="" value="00:00">
                </div>

            </div>
        </div>
        <div class="booking-field">
            <div class="booking-field-label  booking-laber-padding pl-1">
                <p class="text-left pt-2 pl-3 node-text">{{config('booking.time.laber2')}}</p>
            </div>
            <div class="booking-field-content">
                <div class="timedate-block set-time">
                    <input name="time2-value" id="time2-value" class="time_value" type="hidden" value="0">
                    <input name="time2-bed" id="time2-bed" class="time2-bed" type="hidden" value="1">
                    <input name="time2-view" type="text" class="form-control time js-set-time bg-white"  readonly="readonly" id="" value="00:00">
                </div>

            </div>
        </div>
    </div>
</div>

<div class="booking-line font-weight-bold mt-3">
    <div class="booking-line-laber">
        <div>オプション</div>
        <img class=" btn-collapse btn-collapse-between" id="btn-collapse-between"  data-toggle="collapse" data-target=".collapse-between" src="{{ asset('sunsun/svg/hide.svg') }}" alt="Plus" />
    </div>
    <!-- <hr class="booking-line-line"> -->
</div>
<div class="collapse collapse-between show" id="">
    <div class="booking-block-between">
        <div class="" id="">
            <div class="booking-field">
                <div class="booking-field-label  booking-laber-padding">
                    <p class="text-left pt-2 custom-font-size">{{config('booking.whitening.label')}}</p>
                </div>
                <div class="booking-field-content">
                    <select name="whitening" id="whitening" class="form-control">
                        @foreach($whitening as $value)
                            @if(isset($course_data['whitening']) && ($value->kubun_id == $course_data['whitening']))
                                <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                            @else
                                <option value='@json($value)'>{{ $value->kubun_value }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="booking-field whitening" style="display:none;">
                <div class="booking-field-label booking-laber-padding">
                    
                </div>
                <div class="booking-field-content">
                    <div class="node-text">ホワイトニング時間</div> 
                    <div class="timedate-block set-time">
                        <input name='whitening-time_view' type="text" class="form-control time js-set-room_wt bg-white"  readonly="readonly" id="" value="00:00～00:00" />
                        <input name='whitening-time_value' id="whitening-time_value" type="hidden" value="0"/>
                    </div>
                </div>
            </div>
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
    <div>宿泊</div>
    <img class=" btn-collapse btn-collapse-finish" id="btn-collapse-finish"  data-toggle="collapse" data-target=".collapse-finish" src="{{ asset('sunsun/svg/hide.svg') }}" alt="Plus" />
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
            <div class="booking-field room" style="display:none;">
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
            <div class="booking-field room"  style="display:none;">
                <input name="range_date_start-view" id="range_date_start-view" type="hidden" value="">
                <input name="range_date_end-view" id="range_date_end-view" type="hidden" value="">
                <input name="range_date_start-value" id="range_date_start-value" type="hidden" value="">
                <input name="range_date_end-value" id="range_date_end-value" type="hidden" value="">
                <div class="booking-field booking-room input-daterange" id="choice-range-day">
                    <div class="field-start-day">
                        <p class="node-text">{{config('booking.range_date.checkin')}}</p>
                        <input name="range_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input room_range_date bg-white"  readonly="readonly" id="range_date_start" value="">
                    </div>
                    <div class="">
                        <p>&nbsp;</p>
                        <p class="character-date pt-2">～</p>
                    </div>
                    <div class="field-end-day">
                        <p class="node-text">{{config('booking.range_date.checkout')}}</p>
                        <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input room_range_date bg-white"  readonly="readonly" id="range_date_end" value="">
                    </div>
                </div>
            </div>
            <div class="booking-field room" style="display:none;">
                <div class="booking-field-label booking-laber-padding">
                    <p class="text-left pt-2">モーニング</p>
                </div>
                <div class="booking-field-content">
                    <select name="breakfast" class="form-control">
                        @foreach($breakfast as $value)
                            @if(isset($course_data['breakfast']) && ($value->kubun_id == $course_data['breakfast']))
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
@endif
