@php
    if( (!isset($course_data['course'])) || ($course_data['course'] != '05') ){
        $course_data = NULL;
    }
@endphp
<div class="booking-block">

    @if(!isset($add_new_user))
        @php
            $booking_date = '';
            if(isset($course_data['service_date_start'])){
                $booking_date = substr($course_data['service_date_start'], 0, 4).'/'.substr($course_data['service_date_start'], 4, 2).'/'.substr($course_data['service_date_start'], 6, 2);
            }
        @endphp
        <div class="booking-field {{(isset($request_post['add_new_user']) && $request_post['add_new_user'] == 'on')?'hidden':''}}">
            <div class="booking-field-label  booking-laber-padding">
                <p class="text-left pt-2">{{config('booking.date.label')}}</p>
            </div>
            <input name="date-view" id="date-view" type="hidden" value="">
            <input name="date-value" id="date-value" type="hidden" value="">
            <div class="booking-field-content">
                <div class="timedate-block date-warp">
                    <input name="date" id="date" data-format="yyyy/MM/dd" type="text" class="form-control date-book-input bg-white"  readonly="readonly" id="pwd" value="{{ $booking_date }}" />
                </div>
            </div>
        </div>
    @endif
    @php
        if(isset($course_data['service_time_1'])){
            $time = substr($course_data['service_time_1'], 0, 2) . ":" . substr($course_data['service_time_1'], 2, 2) . "～"
            . substr($course_data['service_time_2'], 0, 2) . ":" . substr($course_data['service_time_2'], 2, 2);
        }
    @endphp
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.time.label')}}</p>
        </div>
        <input name="time-view" id="time-view" type="hidden" value="">
        <input name="time-value" id="time-value" type="hidden" value="1230">
        <div class="booking-field-content">
            <div class="timedate-block set-time">

                <input name="time_room_time1" id="time_room_time1" type="hidden" value="{{ isset($course_data['service_time_1'])?$course_data['service_time_1']:'0' }}">
                <input name="time_room_time2" id="time_room_time2" type="hidden" value="{{ isset($course_data['service_time_2'])?$course_data['service_time_2']:'0' }}">
                <input name="time_room" type="text" class="form-control time js-set-room_pet bg-white"  id="time_room_pet_0"   readonly="readonly" id="" value="{{ isset($time)?$time:'00:00～00:00' }}">
                <input name="time[0][json]" class="data-json_input" id="time_room_pet_json" type="hidden" value="{{ isset($course_data['time_json'])?$course_data['time_json']:'0' }}">
                <input name="time[0][element]" id="" type="hidden" value="time_room_pet_0">
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
                    @if(isset($course_data['service_pet_num']) && ($value->kubun_id == $course_data['service_pet_num']))
                        <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                    @else
                        <option value='@json($value)'>{{ $value->kubun_value }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="booking-field">
        <div class="booking-field-label  booking-laber-padding">
            <p class="text-left pt-2">{{config('booking.pet_type.label')}}</p>
        </div>
        <div class="booking-field-content">
            <textarea class="form-control" maxlength="255" name='notes' rows="3">{{ isset($course_data['notes'])?$course_data['notes']:'' }}</textarea>
        </div>
    </div>
</div>
