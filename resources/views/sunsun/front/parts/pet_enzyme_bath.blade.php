<div class="booking-block">
    
    <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.date.label')}}</p>
        </div>
        <input name="date-view" id="date-view" type="hidden" value="">
        <input name="date-value" id="date-value" type="hidden" value="">
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
        <input name="time-view" id="time-view" type="hidden" value="">
        <input name="time-value" id="time-value" type="hidden" value="1230">
        <div class="booking-field-content">
            <div class="timedate-block set-time">
                <input name="time_room" type="text" class="form-control time js-set-room_pet" id="" value="13:45 ~ 15:45">
            </div>

        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.number_pet.label')}}</p>
        </div>
        <div class="booking-field-content">
            <select name="service_pet_num" id="number_pet" class="form-control">
                @foreach($service_pet_num as $value)
                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.pet_type.label')}}</p>
        </div>
        <div class="booking-field-content">
            <textarea class="form-control" name='notes' rows="3"></textarea>
        </div>
    </div>
</div>
