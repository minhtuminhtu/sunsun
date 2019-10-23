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

<div class="booking-field mb-1">
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
<input name="date-view" id="date-view" type="hidden" value="2019年9月20日(金)">
<div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.date.label')}}</p>
    </div>
    <div class="booking-field-content">
        <div class="row date-warp">
            <div class="col-10">
                <input name='date' id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="pwd" value="" />
            </div>

            <div class="col-2 pl-0 mt-1">
                <span class="add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar-alt fa-2x date-book" ></i>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="booking-field">
    <div class="">
        <p class="text-md-left pt-2 mb-0">{{config('booking.time.label')}}</p>
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label pl-1">
        <p class="text-md-left pt-2">{{config('booking.time.laber1')}}</p>
    </div>
    <div class="booking-field-content">
        <div class="row set-time">
            <div class="col-10">
                <input name="time1" type="text" class="form-control time" id="" value="13:45">
            </div>

            <div class="col-2 pl-0 mt-1">
                <span class="icon-clock">
                    <i class="far fa-clock fa-2x js-set-time"></i>
                </span>
            </div>
        </div>

    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label pl-1">
        <p class="text-md-left pt-2">{{config('booking.time.laber2')}}</p>
    </div>
    <div class="booking-field-content">
        <div class="row set-time">
            <div class="col-10">
                <input name="time2" type="text" class="form-control time" id="" value="13:45">
            </div>

            <div class="col-2 pl-0 mt-1">
                <span class="icon-clock">
                    <i class="far fa-clock fa-2x js-set-time"></i>
                </span>
            </div>
        </div>

    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.whitening.label')}}</p>
    </div>
    <div class="booking-field-content">
        <select name="whitening" class="form-control">
            @foreach(config('booking.whitening.options') as $key => $value)
            <option>{{ $value }}</option>
            @endforeach
        </select>
    </div>
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
            <p class="character-date">～</p>
        </div>
        <div class="field-end-day">
            <p class="">{{config('booking.range_date.checkout')}}</p>
            <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input room_range_date" id="range_date_end" value="">
        </div>

    </div>
    <div class="">
        <pre class="mb-0">&nbsp;</pre>
        <span class="add-on ml-3">
            <i class="fa fa-calendar-alt fa-2x "></i>
        </span>
    </div>
</div>
