@if($row == 'wt')
    @if(is_object($time['data']['wt']))
        @if(isset($time['data'][$row]->booking_id))
            <input type="hidden" class="booking-id" value="{{ $time['data'][$row]->booking_id }}">
            <input type="hidden" class="payment_id" value="{{ isset($payments[$time['data'][$row]->booking_id])?$payments[$time['data'][$row]->booking_id]:"" }}">
        @endif
        <span>[{{ $time['data'][$row]->course }}]</span>
        <span>{{ $time['data'][$row]->gender }}</span>
        <span>{{ isset($time['data'][$row]->age_value)?'('.$time['data'][$row]->age_value.'歳)':'' }}</span>
        <br>
        @if(isset($time['data'][$row]->ref_booking_id))
        <span>{{ $time['data'][$row]->name }}同行者様</span>
        @else
        <span>{{ $time['data'][$row]->name }}様</span>
        @endif
        <span class="text-red">{{ $time['data'][$row]->repeat_user }}</span>
    @endif
@else
    @if(is_object($time['data'][$row]))
        @if((isset($time['data'][$row]->fake_booking_flg)) && ($time['data'][$row]->fake_booking_flg == '1'))
            <div class="control-align_center">
                <div>―</div>
            </div>
        @else
            @if(isset($time['data'][$row]->booking_id))
                <input type="hidden" class="booking-id" value="{{ $time['data'][$row]->booking_id }}">
                <input type="hidden" class="time" value="{{ $time['data'][$row]->time }}">
                <input type="hidden" class="payment_id" value="{{ isset($payments[$time['data'][$row]->booking_id])?$payments[$time['data'][$row]->booking_id]:"" }}">

            @endif
            <span>[{{ $time['data'][$row]->course }}{{  config('const.laber.bed')[$time['data'][$row]->turn] }}]</span>
            <span>{{ $time['data'][$row]->gender }}</span>
            <span>{{ isset($time['data'][$row]->age_value)?'('.$time['data'][$row]->age_value.'歳)':'' }}</span>
            <br>
            @if(isset($time['data'][$row]->ref_booking_id))
            <span>{{ $time['data'][$row]->name }}同行者様</span>
            @else
            <span>{{ $time['data'][$row]->name }}様</span>
            @endif
            <span class="text-red">{{ $time['data'][$row]->repeat_user }}</span>
            @if(!isset($time['data'][$row]->ref_booking_id))
                @if(isset($time['data'][$row]->transport))
                <br>
                <span>{{ $time['data'][$row]->transport }}</span>
                <span>{{ $time['data'][$row]->bus_arrive_time_slide }}</span>
                <span class="text-red">{{ $time['data'][$row]->pick_up }}</span>
                @endif
            @endif
            @if(($time['data'][$row]->lunch != NULL)||($time['data'][$row]->whitening != NULL)||($time['data'][$row]->pet_keeping != NULL)||($time['data'][$row]->stay_room_type != NULL))
                <br>
                @if(isset($time['data'][$row]->lunch))
                <span>{{ $time['data'][$row]->lunch }}</span>
                @endif
                @if(isset($time['data'][$row]->whitening))
                <span>{{ $time['data'][$row]->whitening }}</span>
                @endif
                @if(isset($time['data'][$row]->pet_keeping))
                <span>{{ $time['data'][$row]->pet_keeping }}</span>
                @endif
                @if(!isset($time['data'][$row]->ref_booking_id))
                    @if(isset($time['data'][$row]->stay_room_type))
                        <?php
                            $title_stay = "畳";
                            $type_room = $time['data'][$row]->stay_room_type;
                            if ($type_room == "03") $title_stay = "ツイン";
                            elseif ($type_room == "04") $title_stay = "セミダブル";
                        ?>
                        <span>{{ $title_stay }}({{ $time['data'][$row]->stay_guest_num }})</span>
                        @if(isset($time['data'][$row]->breakfast))
                            <span>{{ $time['data'][$row]->breakfast }}</span>
                        @endif
                    @endif
                @endif
            @endif
            @if(!isset($time['data'][$row]->ref_booking_id))
                @if(isset($time['data'][$row]->phone))
                <br>
                <span>{{ $time['data'][$row]->phone }}</span>
                <br>
                <span>支払：{{ $time['data'][$row]->payment_method }}</span>
                @endif
            @endif
        @endif
    @endif
@endif
