<div class="booking-block">
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
        </div>
        <div class="booking-field-content">
            <p class="node-text text-md-left mb-2">断食プランには、1時間程度のミニ講座が含まれます。</p>
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-md-left pt-2">{{config('booking.sex.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="sex" class="form-control">
                @foreach($gender as $value)
                    <option value="{{ $value->kubun_value }}">{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="booking-field mb-2">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-md-left pt-2">{{config('booking.age.label')}}</p>
        </div>
        <div class="booking-field-content">
            <div class="age-col age mt-1">
                <div class="age-left">
                    <select name="age" class="custom-select">
                            @php
                                $val = [];
                                $i = 0;
                                foreach($age_value as $value){
                                    $val[$i] =  $value->kubun_value;
                                    $i++;
                                    
                                }
                                for($j = $val[0]; $j <= $val[1]; $j++ ){
                                    echo "<option>".$j."</option>";
                                }
                            @endphp
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-5">
            <p class="text-md-left pt-2   booking-laber-padding">{{config('booking.range_date_eat.label')}}</p>
        </div>
    </div>
    <input name="plan_date_start-view" id="plan_date_start-view" type="hidden" value="2019年9月20日(金)">
    <input name="plan_date_end-view" id="plan_date_end-view" type="hidden" value="2019年9月20日(金)">
    <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
        <div class="booking-field booking-room  input-daterange" id="choice-range-day">
            <div class="field-start-day">
                <p class="node-text">開始日</p>
                <input name="plan_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input range_date" id="plan_date_start" value="">
            </div>
            <div class="">
                <p class="">&nbsp;</p>
                <p class="character-date">～</p>
            </div>
            <div class="field-end-day">
                <p class="node-text">終了日</p>
                <input name="plan_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input range_date" id="plan_date_end" value="">
            </div>

        </div>
    </div>

    <div>
        <div class="booking-field-100  booking-laber-padding">
            <p class="text-md-left pt-2">{{config('booking.range_time_eat.label')}}</p>
        </div>
        <div class="booking-field-100">
            <p class="node-text multiple-date">
                1日2回ずつ入浴時間を選択します
                <br> 入浴の間は2時間以上空けてください。
            </p>
        </div>
        <div class="time-list">
        </div>
        <div class="clearfix"></div>
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
            <p class="text-md-left pt-2">{{config('booking.pet.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="pet" class="form-control">
                @foreach($pet_keeping as $value)
                    <option value="{{ $value->kubun_value }}">{{ $value->kubun_value }}</option>
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
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-md-left pt-2">宿泊<span class="node-text">(部屋ﾀｲﾌﾟ)</span></p>
        </div>
        <div class="booking-field-content">
            <select name="room" id="room" class="form-control">
                @foreach($stay_room_type as $value)
                    <option value="{{ $value->kubun_value }}">{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="booking-field room" style="display:none;">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-md-left pt-2">{{config('booking.number_guests_stay.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="number_guests_stay" class="form-control">
                @foreach($stay_guest_num as $value)
                    <option value="{{ $value->kubun_value }}">{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="booking-field room"  style="display:none;">
        <input name="range_date_start-view" id="range_date_start-view" type="hidden" value="2019年9月20日(金)">
        <input name="range_date_end-view" id="range_date_end-view" type="hidden" value="2019年9月20日(金)">
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
