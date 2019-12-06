<div class="booking-block">
    <div class="collapse collapse-top show" id="">
        <div class="booking-field">
            <div class="booking-field-label">
            </div>
            <div class="booking-field-content">
                <p class="node-text text-left mt-1 mb-0">入浴時間約30分</p>
                <p class="node-text text-left mb-2">(全体の滞在時間約90分)</p>
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

        <div class="booking-field">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.age.label')}}</p>
            </div>
            <div class="booking-field-content">
                <div class="button-age">
                    <input id="agecheck" name='age_type' type="hidden" value="3">
                    <div class="button-age-left">
                        <button type="button" class="btn btn-block form-control text-dark mx-0 agecheck @if(isset($course_data['age_type']) && ($course_data['age_type'] == 1)) color-active @else btn-outline-warning   @endif" value="1">{{config('booking.age.age1')}}</button>
                        <button type="button" class="btn btn-block form-control text-dark  margin-top-mini mx-0 agecheck @if(isset($course_data['age_type']) && (($course_data['age_type'] == 1) || ($course_data['age_type'] == 2))) btn-outline-warning @else  color-active  @endif" value="3">{{config('booking.age.age3')}}</button>
                    </div>
                    <div class="button-age-right">
                        <button type="button" class="btn btn-block form-control btn-outline-warning text-dark mx-0 agecheck @if(isset($course_data['age_type']) && ($course_data['age_type'] == 2)) color-active @else btn-outline-warning   @endif" value="2">学生<span class="node-text">(中学生以上)</span></button>
                        <div class="age-col margin-top-mini">
                            <div class="age-left">
                                <select id="age_value" name="age_value" class="form-control">
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
            </div>
        </div>
        @if(!isset($add_new_user))

            @php
                $booking_date = '';
                if(isset($course_data['service_date_start'])){
                    $booking_date = substr($course_data['service_date_start'], 0, 4).'/'.substr($course_data['service_date_start'], 4, 2).'/'.substr($course_data['service_date_start'], 6, 2);
                }
            @endphp
            <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}} ">
                <div class="booking-field-label  booking-laber-padding">
                    <p class="text-left pt-2">{{config('booking.date.label')}}</p>
                </div>
                <input name="date-view" id="date-view" type="hidden" value="">
                <input name="date-value" id="date-value" type="hidden" value="">
                <div class="booking-field-content">
                    <input id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input bg-white" readonly="readonly"  id="pwd" value="{{ $booking_date }}" />
                </div>
            </div>
        @endif


        @php
            $first_time = NULL;
            $first_time_data = NULL;
            if(is_array($course_time)){
                foreach($course_time as $first_time){
                    break;
                }
                if(isset($first_time['service_time_1'])){
                    $first_time_data = substr($first_time['service_time_1'], 0, 2) . ":" . substr($first_time['service_time_1'], 2, 2);
                }
            }
        @endphp
        <div class="booking-field">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.time.label')}}</p>
            </div>

            @if(is_array($course_time))
                @php 
                $i = 0;
                @endphp
                @foreach($course_time as $s_time)
                    @php
                        $s_time_data = substr($s_time['service_time_1'], 0, 2) . ":" . substr($s_time['service_time_1'], 2, 2);
                    @endphp
                    @if($i == 0)
                    <div class="booking-field-content">
                        <div class="timedate-block set-time">
                            <input name="time[0][view]" type="text" class="form-control time js-set-time booking-time bg-white" readonly="readonly" value="{{ $s_time_data }}" />
                            <input name="time[0][value]" class="time_value" id="time[0][value]" type="hidden" value="{{ $s_time['service_time_1'] }}">
                            <input name="time[0][bed]" class="time_bed" id="time[0][bed]" type="hidden" value="{{ $s_time['notes'] }}">
                            <input name="time[0][gender]" class="time_gender" id="time[0][gender]" type="hidden" value="0">
                        </div>
                        <div class="time-content">
                    @else
                        <div class="block-content-1 margin-top-mini">
                            <div class="block-content-1-left">
                                <div class="timedate-block set-time">
                                    <input name="time[{{ $i }}][view]" type="text" class="form-control time js-set-time booking-time bg-white" readonly="readonly" value="{{ $s_time_data }}" />
                                    <input name="time[{{ $i }}][value]" class="time_value" id="time[{{ $i }}][value]" type="hidden" value="{{ $s_time['service_time_1'] }}">
                                    <input name="time[{{ $i }}][bed]" class="time_bed" id="time[{{ $i }}][bed]" type="hidden" value="{{ $s_time['notes'] }}">
                                </div>
                            </div>
                            <div class="block-content-1-right"><img class="svg-button" src="/sunsun/svg/close.svg" alt="Close" /></div>
                        </div>
                    @endif
                    @php
                        $i++;
                    @endphp
                @endforeach
                    </div>
                </div>
            @else
            <div class="booking-field-content">
                <div class="timedate-block set-time">
                    <input name="time[0][view]" type="text" class="form-control time js-set-time booking-time bg-white" readonly="readonly" value="00:00" />
                    <input name="time[0][value]" class="time_value" id="time[0][value]" type="hidden" value="0">
                    <input name="time[0][bed]" class="time_bed" id="time[0][bed]" type="hidden" value="0">
                    <input name="time[0][gender]" class="time_gender" id="time[0][gender]" type="hidden" value="0">
                    <input name="time[0][data-json]" class="data-json_input" id="time[0][data-json]" type="hidden" value="">
                    <input name="time[0][element]" id="time[0][element]" type="hidden" value="js-set-time">
                </div>
                <div class="time-content">
                </div>
            </div>
            @endif
        </div>
        <div class="booking-field pb-0">
            <div class="node-text booking-laber-padding">
                <div>※バスの場合、到着時間の30分以内は選択できません。希望時間が選択できない場合は　バス到着時間をご確認ください。</div>
                <div>※酵素浴を1日2回以上利用される場合は[酵素浴　追加]をクリックし、2回目の時間を選択してください。</div>
            </div>
        </div>
        <div class="booking-field">
            <div class="booking-field-label">
            </div>
            <div class="booking-field-content">
                <div class="block-content-2 margin-top-mini">
                    <div class="block-content-2-left"></div>
                    <div class="block-content-2-right">
                        <button type="button" class="btn btn-block form-control color-active text-dark" id="add-time">時間追加</button>
                    </div>
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
                <div class="booking-field-label booking-laber-padding">
                    <p class="text-left pt-2">{{config('booking.lunch.label')}}</p>
                </div>
                <div class="booking-field-content">
                    <select name="lunch" class="form-control">
                        @foreach($lunch as $value)
                            @if(isset($course_data['lunch']) && ($value->kubun_id == $course_data['lunch']))
                                <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                            @else
                                <option value='@json($value)'>{{ $value->kubun_value }}</option>
                            @endif
                        @endforeach
                    </select>
                    <p class="node-text text-left mt-2 mb-2">ランチは11:30～12:30にご用意させていただきます</p>
                </div>
            </div>
            <div class="booking-field">
                <div class="booking-field-label booking-laber-padding">
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
                        <option value='1'>はじめて</option>
                        <option value='0'>リピート</option>
                    </select>
                </div>
            </div>
            <div class="booking-field whitening"  @if($display_whitening) style="display:none;" @endif>
                <div class="booking-field-label booking-laber-padding">

                </div>
                <div class="booking-field-content">
                    <div class="node-text">ホワイトニング時間</div>
                    <div class="timedate-block set-time">
                        <input name='whitening-time_view' type="text" class="form-control time js-set-room_wt bg-white"  readonly="readonly" value="{{ isset($course_data['whitening_time'])?$course_data['whitening_time']:'00:00～00:00' }}" />
                        <input name='whitening-time_value' id="whitening-time_value" type="hidden" value="0"/>
                        <input name="whitening_time" class="data-json_input" id="" type="hidden" value="">
                        <input name="whitening_time_element" id="time[0][element]" type="hidden" value="js-set-time">
                    </div>
                </div>
            </div>
            <div class="booking-field">
                <div class="booking-field-label booking-laber-padding">
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
                    <div class="booking-field-label booking-laber-padding">
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
                    <div class="booking-field-label booking-laber-padding">
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
                <div class="booking-field-content room" @if($room_whitening) style="display:none;" @endif>
                    <div class="booking-laber-padding">
                        <p class="text-left pt-2">{{config('booking.range_date.label')}}</p>
                    </div>
                </div>
                <div class="booking-field room"  @if($room_whitening) style="display:none;" @endif>
                    <input name="range_date_start-view" id="range_date_start-view" type="hidden" value="">
                    <input name="range_date_end-view" id="range_date_end-view" type="hidden" value="">
                    <input name="range_date_start-value" id="range_date_start-value" type="hidden" value="">
                    <input name="range_date_end-value" id="range_date_end-value" type="hidden" value="">
                    <div class="booking-field booking-room input-daterange  date-range_block" id="choice-range-day">
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
                <div class="booking-field room" @if($room_whitening) style="display:none;" @endif>
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
