@if($row == 'pet')
    @if(is_object($time['data']['pet']))
        @if(isset($time['data'][$row]->ref_booking_id))
            <span>{{ $time['data'][$row]->name }}同行者様</span>
        @else
            <span>{{ $time['data'][$row]->name }}様</span>
        @endif
        @if(!isset($time['data'][$row]->ref_booking_id))
        <br>
        <span>{{ $time['data'][$row]->transport }}</span>
        <span>{{ $time['data'][$row]->bus_arrive_time_slide }}</span>
        <span class="text-red">{{ $time['data'][$row]->pick_up }}</span>
        <br>
        <span>{{ $time['data'][$row]->phone }}</span>
        <br>
        <span>支払：{{ $time['data'][$row]->payment_method }}</span>
        @endif
    @endif
@elseif($row == 'wt')
    @if(is_object($time['data']['wt']))
        @if(isset($time['data'][$row]->ref_booking_id))
            <span>{{ $time['data'][$row]->name }}同行者様</span>
        @else
            <span>{{ $time['data'][$row]->name }}様</span>
        @endif
        @if(!isset($time['data'][$row]->ref_booking_id))
        <br>
        <span>{{ $time['data'][$row]->transport }}</span>
        <span>{{ $time['data'][$row]->bus_arrive_time_slide }}</span>
        <span class="text-red">{{ $time['data'][$row]->pick_up }}</span>
        <br>
        <span>{{ $time['data'][$row]->phone }}</span>
        <br>
        <span>支払：{{ $time['data'][$row]->payment_method }}</span>
        @endif
    @endif
@else
    @if(is_object($time['data'][$row]))
        <span>[{{ $time['data'][$row]->course }}]</span>
        <span>{{ $time['data'][$row]->gender }}</span>
        <span>{{ isset($time['data'][$row]->age_value)?'('.$time['data'][$row]->age_value.'歳)':'' }}</span>
        <span class="text-red">{{ $time['data'][$row]->repeat_user }}</span>
        <br>
        
        @if(isset($time['data'][$row]->ref_booking_id))
        <span>{{ $time['data'][$row]->name }}同行者様</span>
        @else
        <span>{{ $time['data'][$row]->name }}様</span>
        @endif

        @if(!isset($time['data'][$row]->ref_booking_id))
        <br>
        <span>{{ $time['data'][$row]->transport }}</span>
        <span>{{ $time['data'][$row]->bus_arrive_time_slide }}</span>
        <span class="text-red">{{ $time['data'][$row]->pick_up }}</span>
        @endif


        @if(($time['data'][$row]->lunch != NULL)||($time['data'][$row]->stay_room_type != NULL)||($time['data'][$row]->pet_keeping != NULL))
        <br>
        <span>{{ $time['data'][$row]->lunch }}</span>
        <span>{{ $time['data'][$row]->pet_keeping }}</span>
            @if(!isset($time['data'][$row]->ref_booking_id))
            <span>{{ $time['data'][$row]->stay_room_type }}</span>
            @endif
        @endif
        @if(!isset($time['data'][$row]->ref_booking_id))
        <br>
        <span>{{ $time['data'][$row]->phone }}</span>
        <br>
        <span>支払：{{ $time['data'][$row]->payment_method }}</span>
        @endif
    @endif
@endif