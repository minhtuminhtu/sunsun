<div class="booking-block">
    <input name="date-view" id="date-view" type="hidden" value="2019年9月20日(金)">
    <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-md-left pt-2">{{config('booking.date.label')}}</p>
        </div>
        <div class="booking-field-content">
            <div class="timedate-block date-warp">
                <input name="date" id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input" id="pwd" value="" />
            </div>
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-md-left pt-2">{{config('booking.time.label')}}</p>
        </div>
        <div class="booking-field-content">
            <div class="timedate-block set-time">
                <input name="time_room" type="text" class="form-control time js-set-time" id="" value="13:45 ~ 15:45">
            </div>

        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
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
            <p class="text-md-left pt-2">{{config('booking.pet_type.label')}}</p>
        </div>
        <div class="booking-field-content">
            <textarea class="form-control" name='pet_type' rows="3"></textarea>
        </div>
    </div>
</div>
