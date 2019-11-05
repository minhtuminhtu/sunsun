<div class="booking-block">
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
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="booking-field mb-2">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.age.label')}}</p>
        </div>
        <div class="booking-field-content">
            <div class="button-age">
                <input id="agecheck" name='agecheck' type="hidden" value="{{config('booking.age.age3')}}">
                <div class="button-age-left">
                    <button type="button" class="btn btn-block form-control btn-outline-warning text-dark mt-1 mx-0 agecheck">{{config('booking.age.age1')}}</button>
                    <button type="button" class="btn btn-block form-control btn-outline-warning  color-active text-dark mt-1 mx-0 agecheck">{{config('booking.age.age3')}}</button>
                </div>
                <div class="button-age-right">
                    <button type="button" class="btn btn-block form-control btn-outline-warning text-dark mt-1 mx-0 agecheck">学生<span class="node-text">(中学生以上)</span></button>
                    <div class="age-col mt-1">
                        <div class="age-left">
                            <select name="age_value" class="form-control">
                                @php
                                    $val = [];
                                    $i = 0;
                                    foreach($age_value as $value){
                                        $val[$i] =  $value->kubun_value;
                                        $i++;
                                        
                                    }
                                    for($j = $val[0]; $j <= $val[1]; $j++ ){
                                        echo "<option value='".$j."'>".$j."</option>";
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}} ">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.date.label')}}</p>
        </div>
        <input name="date-view" id="date-view" type="hidden" value="2019年9月20日(金)">
        <div class="booking-field-content">
            <input name='date' id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="pwd" value="" />
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.time.label')}}</p>
        </div>
        <div class="booking-field-content">
            <div class="timedate-block set-time">
                <input name='time' type="text" class="form-control time js-set-time" id="" value="13:45" />
            </div>
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
        <div class="booking-field-label booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.lunch.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="lunch" class="form-control">
                @foreach($lunch as $value)
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
            <p class="node-text text-left mt-2 mb-2">ランチは11:30からです</p>
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.whitening.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="whitening" class="form-control">
                @foreach($whitening as $value)
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.pet.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="pet" class="form-control">
                @foreach($pet_keeping as $value)
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="booking-line font-weight-bold mt-3">
    <div class="booking-line-laber">
    宿泊
    </div>
<!-- <hr class="booking-line-line"> -->
</div>
<div class="booking-block-finish">
    <div class="booking-field">
        <div class="booking-field-label booking-laber-padding">
            <p class="text-left pt-2">宿泊<span class="node-text">(部屋ﾀｲﾌﾟ)</span></p>
        </div>
        <div class="booking-field-content">
            <select name="stay_room_type" id="room" class="form-control">
                @foreach($stay_room_type as $value)
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="booking-field room" style="display:none;">
        <div class="booking-field-label booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.stay_guest_num.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="stay_guest_num" class="form-control">
                @foreach($stay_guest_num as $value)
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="booking-field-content room" style="display:none;">
        <div class="booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.range_date.label')}}</p>
        </div>
    </div>
    <div class="booking-field room"  style="display:none;">
        <input name="range_date_start-view" id="range_date_start-view" type="hidden" value="">
        <input name="range_date_end-view" id="range_date_end-view" type="hidden" value="">
        <div class="booking-field booking-room input-daterange" id="choice-range-day">
            <div class="field-start-day">
                <p class="node-text">{{config('booking.range_date.checkin')}}</p>
                <input name="range_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input room_range_date" id="range_date_start" value="">
            </div>
            <div class="">
                <p>&nbsp;</p>
                <p class="character-date mt-1">～</p>
            </div>
            <div class="field-end-day">
                <p class="node-text">{{config('booking.range_date.checkout')}}</p>
                <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input room_range_date" id="range_date_end" value="">
            </div>
        </div>
    </div>
</div>
