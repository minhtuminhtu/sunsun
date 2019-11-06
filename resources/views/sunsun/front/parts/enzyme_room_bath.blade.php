<div class="booking-block">
    <input name="date-view" id="date-view" type="hidden" value="2019年9月20日(金)">
    <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.date.label')}}</p>
        </div>
        <div class="booking-field-content">
            <div class="timedate-block date-warp">
                <input name="date" id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="pwd" value="" />
            </div>
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.time.label')}}</p>
        </div>
        <div class="booking-field-content">
            <div class="timedate-block set-time">
                <input name="time_room" type="text" class="form-control time js-set-room" id="" value="13:45 ~ 15:45">
            </div>

        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.number_guests_book.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="number_guests_book" class="form-control">
                @foreach(config('booking.number_guests_book.options') as $key => $value)
                <option value="{{ $value }}">{{ $value }}</option>
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
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
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
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.pet.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="pet_keeping" class="form-control">
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
        <div class="booking-field-label  booking-laber-padding">
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
        <div class="booking-field-label  booking-laber-padding">
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
