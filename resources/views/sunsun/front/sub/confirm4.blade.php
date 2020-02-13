@php
    $gender = json_decode($data['gender']);
    $age_value = isset($data['age_value'])?$data['age_value']:"";
@endphp
<div class="linex">
    <p>性別：{{ $gender->kubun_value }}</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
<div class="linex">
    <p>年齢：{{ $age_value }}歳</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
<div class="linex">
    <p>コース: {{ $course->kubun_value }}</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
<div class="line">
    <div class="line1">
    予約日:
    </div>
    <div class="line2">
        <p>{{ $data['plan_date_start-view'] }}～</p>
        <p>{{ $data['plan_date_end-view'] }}</p>
    </div>
</div>
<div class="line">
    <div class="line1">
    入浴時間
    </div>
    <div class="line2">
        @if(isset($data['date']))
            @foreach ($data['date'] as $d)
                <p>{{ $d['day']['view'] }} &#160;&#160;&#160; {{ $d['from']['view'] }} &#160;&#160;&#160; {{ $d['to']['view'] }}</p>
            @endforeach
        @endif
    </div>
</div>
@php
    $pet_keeping = (json_decode($data['pet_keeping'])->kubun_value == "追加しない")?"":"追加する";
@endphp
@if($pet_keeping != "")
<hr class="line-x">
<div class="line">
    <div class="line1">
    オプション
    </div>
    <div class="line2">
        <p>{{ ($pet_keeping != "")?"ペット預かり：" . $pet_keeping:"" }}</p>
    </div>
</div>
@endif
@if($key == 0)
    @php
        $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
        $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
    @endphp
    @if($stay_room_type->kubun_value != config('booking.room.options.no'))
    <hr class="line-x">
    <div class="line">
        <div class="line1">
        宿泊
        </div>
        <div class="line2">
            <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
            <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
            <p>宿泊日</p>
            <div class="line3">
                <p class="node-text">チェックイン：{{ $data['range_date_start-view'] }}～</p>
                <p class="node-text">チェックアウト：{{ $data['range_date_end-view'] }}</p>
            </div>
        </div>
    </div>
    @endif
@endif