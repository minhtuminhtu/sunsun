<div class="linex mt-0">
    @if($i != 1)
        <p class="font-weight-bold">予約{{ $i }}</p>
        <br>
    @endif
    <p>ご利用： {{ $repeat_user->kubun_value }}</p>
    @if($repeat_user->kubun_id != '02')
        <p>{!! config('const.message.please_15_minus') !!}</p>
    @endif


</div>
@if($key == 0)
    @php
        $transport = json_decode($customer['transport']);
    @endphp

    @if($transport->kubun_id == '01' )
        <div class="line">
            <div class="line1">
            交通手段 :
            </div>
            <div class="line2">
                <p>{{ $transport->kubun_value }}</p>
            </div>
        </div>
    @else
        @php
            $bus_arrive_time_slide = json_decode($customer['bus_arrive_time_slide']);
            $pick_up = json_decode($customer['pick_up']);
        @endphp
        <div class="line">
            <div class="line1">
            交通手段 :
            </div>
            <div class="line2">
                <p>{{ $transport->kubun_value }}</p>
                <p>{{ $bus_arrive_time_slide->kubun_value }}</p>
                @if($pick_up->kubun_id == '01')
                    <p>送迎あり</p>
                @else
                    <p>送迎なし</p>
                @endif
            </div>
        </div>
    @endif
    @if($course->kubun_id == '01' || $course->kubun_id == '02' || $course->kubun_id == '03')
    <div class="linex">
        <p>予約日: {{ $data['date-view'] }}</p>
        <div class="line1"></div>
        <div class="line2"></div>
    </div>
    @endif
@endif
@if($course->kubun_id == '01')
    @include('sunsun.front.sub.confirm1')
@elseif($course->kubun_id == '02')
    @include('sunsun.front.sub.confirm2')
@elseif($course->kubun_id == '03')
    @include('sunsun.front.sub.confirm3')
@elseif($course->kubun_id == '04')
    @include('sunsun.front.sub.confirm4')
@elseif($course->kubun_id == '05')
    @include('sunsun.front.sub.confirm5')
@endif