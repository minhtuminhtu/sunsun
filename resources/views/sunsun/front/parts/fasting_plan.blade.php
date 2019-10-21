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
<div class="booking-field">
    <div class="booking-field input-daterange" id="choice-range-day">
        <div class="field-start-day">
            <p class="">開始日</p>
            <input name="range_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input" id="range_date_start" value="2019/9/20">
        </div>
        <div class="">
            <p class="">&nbsp;</p>
            <p class="character-date">～</p>
        </div>
        <div class="field-end-day">
            <p class="">終了日</p>
            <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="range_date_end" value="2019/9/20">
        </div>

    </div>
    <div class="">
        <pre class="mb-0">&nbsp;</pre>
        <span class="add-on ml-3">
            <i class="fa fa-calendar-alt fa-2x "></i>
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
    <div class="booking-field choice-time">
        <div class="booking-field-label label-data">
            <label class="">9/20(金)</label>
        </div>
        <div class="booking-field-content date-time">
            <div class="choice-data-time set-time">
                <div class="input-time">
                    <input name='time' type="text" class="time" id="" value="13:45" />
                </div>
                <div class="icon-time">
                    <span class="icon-clock">
                        <i class="far fa-clock fa-2x js-set-time"></i>
                    </span>
                </div>
            </div>
            <div class="choice-data-time set-time">
                <div class="data">
                    <input name='time' type="text" class="input-time time" id="" value="13:45" />
                </div>
                <div class="icon-time">
                    <span class="icon-clock">
                        <i class="far fa-clock fa-2x js-set-time"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="booking-field choice-time">
        <div class="booking-field-label label-data">
            <label class="">9/20(金)</label>
        </div>
        <div class="booking-field-content date-time">
            <div class="choice-data-time set-time">
                <div class="input-time">
                    <input name='time' type="text" class="time" id="" value="13:45" />
                </div>
                <div class="icon-time">
                    <span class="icon-clock">
                        <i class="far fa-clock fa-2x js-set-time"></i>
                    </span>
                </div>
            </div>
            <div class="choice-data-time set-time">
                <div class="data">
                    <input name='time' type="text" class="input-time time" id="" value="13:45" />
                </div>
                <div class="icon-time">
                    <span class="icon-clock">
                        <i class="far fa-clock fa-2x js-set-time"></i>
                    </span>
                </div>
            </div>
        </div>
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
<div class="booking-field room"  style="display:none;">
    <div class="booking-field input-daterange" id="choice-range-day">
        <div class="field-start-day">
            <p class="">{{config('booking.range_date.checkin')}}</p>
            <input name="range_date_start" data-format="yyyy/MM/dd" type="text" class=" form-control date-book-input" id="range_date_start" value="2019/9/20">
        </div>
        <div class="">
            <p class="">&nbsp;</p>
            <p class="character-date">～</p>
        </div>
        <div class="field-end-day">
            <p class="">{{config('booking.range_date.checkout')}}</p>
            <input name="range_date_end" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="range_date_end" value="2019/9/20">
        </div>

    </div>
    <div class="">
        <pre class="mb-0">&nbsp;</pre>
        <span class="add-on ml-3">
            <i class="fa fa-calendar-alt fa-2x "></i>
        </span>
    </div>
</div>
<script>
    $('#room').on('change', function () {
        if (this.value == '無し') {
            $('.room').hide();
        } else {
            $('.room').show();
        }
    });
</script>