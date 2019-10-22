<div class="booking-field">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.date.label')}}</p>
    </div>
    <div class="booking-field-content">
        <div class="row date-warp">
            <div class="col-10">
                <input name="date" id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="pwd" value="2019/09/20(金)" />
                <input name="date-view" id="date-view" type="hidden" value="2019年9月20日(金)">
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
                <input name="time_room" type="text" class="form-control time" id="" value="13:45 ~ 15:45">
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
        <p class="text-md-left pt-2">{{config('booking.number_pet.label')}}</p>
    </div>
    <div class="booking-field-content">
        <select name="number_pet" id="number_pet" class="form-control">
            @foreach(config('booking.number_pet.options') as $key => $value)
            <option>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label">
        <p class="text-md-left pt-2">{{config('booking.pet_type.label')}}</p>
    </div>
    <div class="booking-field-content">
        <textarea class="form-control" name='pet_type' rows="3"></textarea>
    </div>
</div>