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
    <div class="row pb-0">
        <input id="agecheck" name='agecheck' type="hidden" value="{{config('booking.age.age3')}}">
        <div class="col-4 pl-0">
            <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 agecheck">{{config('booking.age.age1')}}</button>
            <button type="button" class="btn btn-block btn-outline-warning  btn-warning text-dark mt-1 mx-0 agecheck">{{config('booking.age.age3')}}</button>
        </div>
        <div class="col-8 pl-0">
            <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0 agecheck">{{config('booking.age.age2')}}</button>
            <div class="row age mt-1">
                <div class="col-6">
                    <select name="age" class="form-control">
                        @foreach(config('booking.age.options') as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<div class="booking-field">
<div class="booking-field-label">
    <p class="text-md-left pt-2">{{config('booking.date.label')}}</p>
</div>
<div class="booking-field-content">
    <div class="row date-warp">
        <div class="col-10">
            <input name='date' data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="pwd" value="2019/9/20(金)" />
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
<div class="booking-field-label">
    <p class="text-md-left pt-2">{{config('booking.time.label')}}</p>
</div>
<div class="booking-field-content">
    <div class="row set-time">
        <div class="col-10">
            <input name='time' type="text" class="form-control time" id="" value="13:45" />
        </div>

        <div class="col-2 pl-0">
            <span class="icon-clock">
                <i class="far fa-clock fa-2x js-set-time"></i>
            </span>
        </div>
    </div>
</div>
</div>
<div class="booking-field">
<div class="booking-field-label">
    <p class="text-md-left pt-2">{{config('booking.lunch.label')}}</p>
</div>
<div class="booking-field-content">
    <select name="lunch" class="form-control">
        @foreach(config('booking.lunch.options') as $key => $value)
        <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
    <p class="node-text text-md-left mt-2 mb-2">ランチは11:30からです</p>
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
<div class="booking-field-content room" style="display:none;">
<div class="">
    <p class="text-md-left pt-2">{{config('booking.range_date.label')}}</p>
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
$('.agecheck').click(function () {
    $('.agecheck').removeClass('btn-warning');
    $(this).addClass('btn-warning');
    $('#agecheck').val($(this).text());
});
</script>