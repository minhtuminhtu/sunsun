<div class="booking-field">
    <div class="booking-field-label">
    </div>
    <div class="booking-field-content">
        <p class="node-text text-md-left mb-2">断食プランには、1時間程度のミニ講座が含まれます。</p>
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.sex.label')}}</p>
    </div>
    <div class="booking-field-content">
        <select name="sex" class="form-control">
            @foreach(config('booking.sex.options') as $key => $value)
            <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="booking-field mb-2">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.age.label')}}</p>
    </div>
    <div class="booking-field-content">
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

<div class="row">
    <div class="col-5">
        <p class="text-md-left pt-2">{{config('booking.range_date_eat.label')}}</p>
    </div>
</div>
<input name="plan_date_start-view" id="plan_date_start-view" type="hidden" value="2019年9月20日(金)">
<input name="plan_date_end-view" id="plan_date_end-view" type="hidden" value="2019年9月20日(金)">
<div class="booking-field">
    <div class="booking-field input-daterange" id="choice-range-day">
        <div class="field-start-day">
            <p class="">開始日</p>
            <input name="plan_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input range_date" id="plan_date_start" value="">
        </div>
        <div class="">
            <p class="">&nbsp;</p>
            <p class="character-date">～</p>
        </div>
        <div class="field-end-day">
            <p class="">終了日</p>
            <input name="plan_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input range_date" id="plan_date_end" value="">
        </div>

    </div>
    <div class="">
        <pre class="mb-0">&nbsp;</pre>
        <span class="add-on ml-3">
            <i class="fa fa-calendar-alt fa-2x mt-1"></i>
        </span>
    </div>
</div>

<div>
    <div class="booking-field-100">
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
<div class="booking-field">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.pet.label')}}</p>
    </div>
    <div class="booking-field-content">
        <select name="pet" class="form-control">
            @foreach(config('booking.pet.options') as $key => $value)
            <option>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.room.label')}}</p>
    </div>
    <div class="booking-field-content">
        <select name="room" id="room" class="form-control">
            @foreach(config('booking.room.options') as $key => $value)
            <option>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="booking-field room" style="display:none;">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.number_guests_stay.label')}}</p>
    </div>
    <div class="booking-field-content">
        <select name="number_guests_stay" class="form-control">
            @foreach(config('booking.number_guests_stay.options') as $key => $value)
            <option>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="booking-field-content room" style="display:none;">
    <div class="">
        <p class="text-md-left pt-2">{{config('booking.range_date.label')}}</p>
    </div>
</div>
<input name="range_date_start-view" id="range_date_start-view" type="hidden" value="2019年9月20日(金)">
<input name="range_date_end-view" id="range_date_end-view" type="hidden" value="2019年9月20日(金)">
<div class="booking-field room"  style="display:none;">
    <div class="booking-field input-daterange" id="choice-range-day">
        <div class="field-start-day">
            <p class="">{{config('booking.range_date.checkin')}}</p>
            <input name="range_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input room_range_date" id="range_date_start" value="">
        </div>
        <div class="">
            <p class="">&nbsp;</p>
            <p class="character-date mt-1">～</p>
        </div>
        <div class="field-end-day">
            <p class="">{{config('booking.range_date.checkout')}}</p>
            <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input room_range_date" id="range_date_end" value="">
        </div>

    </div>
    <div class="">
        <pre class="mb-0">&nbsp;</pre>
        <span class="add-on ml-3">
            <i class="fa fa-calendar-alt fa-2x mt-1"></i>
        </span>
    </div>
</div>