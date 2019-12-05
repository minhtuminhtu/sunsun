@php
    $course_data = json_decode($course_data, true);
    $course_time = json_decode($course_time, true);
@endphp
<div class="booking-block">
    @if(!isset($add_new_user))
        <input name="date-view" id="date-view" type="hidden" value="">
        <input name="date-value" id="date-value" type="hidden" value="">
        <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.date.label')}}</p>
            </div>
            <div class="booking-field-content">
                <div class="timedate-block date-warp">
                    <input name="date" id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input bg-white"  readonly="readonly" id="pwd" value="" />
                </div>
            </div>
        </div>
    @endif
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.time.label')}}</p>
        </div>
        <input name="time-view" id="time-view" type="hidden" value="1230">
        <input name="time-value" id="time-value" type="hidden" value="1230">
        <div class="booking-field-content">
            <div class="timedate-block set-time">
                <input name="time_room_value" id="time_room_value" type="hidden" value="0">
                <input name="time_room_bed" id="time_room_bed" type="hidden" value="1">
                <input name="time_room_view" type="text" class="form-control time js-set-room bg-white"  readonly="readonly" id="" value="00:00～">
                <input name="time[0][data-json]" class="data-json_input" id="time[0][data-json]" type="hidden" value="">
            </div>

        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.number_guests_book.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="service_guest_num" class="form-control">
                @foreach($service_guest_num as $value)
                    @if(isset($course_data['service_guest_num']) && ($value->kubun_id == $course_data['service_guest_num']))
                        <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                    @else
                        <option value='@json($value)'>{{ $value->kubun_value }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="booking-line font-weight-bold mt-3">
    <div class="booking-line-laber">
        オプション
    </div>
    <!-- <hr class="booking-line-line"> -->
</div>
<div class="booking-block-between">
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.number_lunch_book.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="lunch_guest_num" class="form-control">
                @foreach($lunch_guest_num as $value)
                    @if(isset($course_data['lunch_guest_num']) && ($value->kubun_id == $course_data['lunch_guest_num']))
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
            <p class="text-left pt-2 custom-font-size">{{config('booking.whitening.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="whitening" id="whitening"  class="form-control">
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
                <input type="hidden" name="data-json-white" class="data-json_input">
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
@if(!isset($add_new_user))
    <div class="booking-line font-weight-bold mt-3">
        <div class="booking-line-laber">
            宿泊
        </div>
        <!-- <hr class="booking-line-line"> -->
    </div>
    <div class="booking-block-finish">
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
                <select name="breakfast"  class="form-control">
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
@endif
