<div class="booking-block">
    <div class="collapse collapse-top show" id="">
        @if(!isset($add_new_user))
            @php
                $booking_date = '';
                if(isset($course_data['service_date_start'])){
                    $booking_date = substr($course_data['service_date_start'], 0, 4).'/'.substr($course_data['service_date_start'], 4, 2).'/'.substr($course_data['service_date_start'], 6, 2);
                }
            @endphp
            <input name="date-view" id="date-view" type="hidden" value="">
            <input name="date-value" id="date-value" type="hidden" value="">
            <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
                <div class="booking-field-label  booking-laber-padding">
                    <p class="text-left pt-2">{{config('booking.date.label')}}</p>
                </div>
                <div class="booking-field-content">
                    <div class="timedate-block date-warp">
                        <input name="date" id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input bg-white"  readonly="readonly" id="pwd" value="{{ $booking_date }}" />
                    </div>
                </div>
            </div>
        @endif
        @php
            if(isset($course_data['service_time_1'])){
                $time = ltrim(substr($course_data['service_time_1'], 0, 2), '0') . ":" . substr($course_data['service_time_1'], 2, 2);
                $bed = substr($course_data['bed'], 0, 1);
            }
        @endphp
        <div class="booking-field">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.time.label')}}</p>
            </div>
            <input name="time-view" id="time-view" type="hidden" value="1230">
            <input name="time-value" id="time-value" type="hidden" value="1230">
            <div class="booking-field-content">
                <div class="timedate-block set-time">

                    <input name="time_room_value" id="time_room_value"  id="time_room_view" type="hidden" value="{{ isset($course_data['service_time_1'])?$course_data['service_time_1']:'0' }}">
                    <input name="time_room_bed" id="time_room_bed" type="hidden" value="{{ isset($bed)?$bed:'0' }}">
                    <input name="time_room_view" type="text" class="form-control time js-set-room bg-white"  readonly="readonly" id="" value="{{ isset($time)?$time.'～':'00:00～' }}">
                    <input name="time[0][json]" class="data-json_input"  type="hidden" value="">
                    <input name="time[0][element]" type="hidden" value="time_room_view">
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
<div class="booking-block-between">
    <div class="collapse collapse-between show" id="">
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
        @php
            $display_whitening = true;
            if(isset($course_data["whitening"]) && ($course_data['whitening'] == '02')){
                $display_whitening = false;
            }
        @endphp
        <div class="booking-field whitening"  @if($display_whitening) style="display:none;" @endif>
            <div class="booking-field-label booking-laber-padding">
            </div>
            <div class="booking-field-content">
                <div class="node-text">ご利用</div>
                <select name="whitening_repeat" id="whitening_repeat" class="form-control">
                    @if(isset($course_data['whitening_repeat']) && ($course_data['whitening_repeat'] == 1))
                        <option selected value='1'>はじめて</option>
                        <option value='0'>リピート</option>
                    @else
                        <option value='1'>はじめて</option>
                        <option selected value='0'>リピート</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="booking-field whitening" @if($display_whitening) style="display:none;" @endif>
            <div class="booking-field-label booking-laber-padding">

            </div>
            <div class="booking-field-content">
                <div class="node-text">ホワイトニング時間</div>
                <div class="timedate-block set-time">
                    <input name='whitening-time_view' type="text" class="form-control time js-set-room_wt bg-white" id="whitening-time_view"   readonly="readonly" id="" value="{{ isset($course_data['whitening_time-view'])?$course_data['whitening_time-view']:'00:00～00:00' }}" />
                    <input name='whitening-time_value' type="hidden" value="{{ isset($course_data['whitening_time'])?$course_data['whitening_time']:'0' }}"/>
                    <input name="whitening_data[json]" class="data-json_input" id="" type="hidden" value="">
                    <input name="whitening_data[element]" id="" type="hidden" value="whitening-time_view">
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
    <div class="booking-block-finish">
        <div class="collapse collapse-finish show" id="">
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
                <input name="range_date_start-view" id="range_date_start-view" type="hidden" value="">
                <input name="range_date_end-view" id="range_date_end-view" type="hidden" value="">
                <input name="range_date_start-value" id="range_date_start-value" type="hidden" value="{{ isset($course_data['stay_checkin_date'])?$course_data['stay_checkin_date']:'' }}">
                <input name="range_date_end-value" id="range_date_end-value" type="hidden" value="{{ isset($course_data['stay_checkout_date'])?$course_data['stay_checkout_date']:'' }}">
                <div class="booking-field booking-room input-daterange  date-range_block" id="choice-range-day">
                    <div class="field-start-day  date-range_block_left">
                        <p class="node-text">{{config('booking.range_date.checkin')}}</p>
                        <input name="range_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input room_range_date bg-white"  readonly="readonly" id="range_date_start" value="{{ isset($range_date_start)?$range_date_start:'' }}">
                    </div>
                    <div class=" date-range_block_center">
                        <p>&nbsp;</p>
                        <p class="character-date pt-2">～</p>
                    </div>
                    <div class="field-end-day  date-range_block_right">
                        <p class="node-text">{{config('booking.range_date.checkout')}}</p>
                        <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input room_range_date bg-white"  readonly="readonly" id="range_date_end" value="{{ isset($range_date_end)?$range_date_end:'' }}">
                    </div>

                </div>
            </div>
            <div class="booking-field room" @if($room_whitening) style="display:none;" @endif>
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
    </div>
@endif
