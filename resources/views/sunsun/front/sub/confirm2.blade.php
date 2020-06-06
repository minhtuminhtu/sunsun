@php
    $gender = isset($data['gender'])?json_decode($data['gender']):"";
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
    予約時間:
    </div>
    <div class="line2">
        <span style="display: none">mark_space</span>
        <p>{{ $data['time1-view'] }}</p>
        <span style="display: none">mark_space</span>
        <p>{{ $data['time2-view'] }}</p>
    </div>
</div>
@php
    $whitening = json_decode($data['whitening']);
    $whitening_repeat = ($data['whitening_repeat'] == 1)?"（はじめて）":"（リピート）";;
    $whitening_data = ($whitening->kubun_id == '02')?$data['whitening-time_view'] . $whitening_repeat:"";
    $pet_keeping = (json_decode($data['pet_keeping'])->kubun_value == "追加しない")?"":"追加する";
@endphp
@if(($whitening_data != "") || ($pet_keeping != ""))
<hr class="line-x">
<span style="display: none">mark_newline</span>
<div class="line">
    <div class="line1">
    オプション
    </div>
    <div class="line2">
        <p>{{ ($whitening_data != "")?config('booking.whitening.label')."：".$whitening_data:"" }}</p>
        <p>{{ ($pet_keeping != "")?"ペット預かり：" . $pet_keeping:"" }}</p>
    </div>
</div>
@endif
@if($key == 0)
    @php
        $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
        $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
        if(isset($data['breakfast'])){
            $breakfast = (json_decode($data['breakfast'])->kubun_value == "無し")?"":json_decode($data['breakfast'])->kubun_value;
        }
    @endphp
    @if(isset($stay_room_type->kubun_value))
        @if($stay_room_type->kubun_value != config('booking.room.options.no'))
        <hr class="line-x">
        <span style="display: none">mark_newline</span>
        <div class="line">
            <div class="line1">
            宿泊
            </div>
            <div class="line2">
                <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                <p>宿泊日</p>
                <div class="line3">
                    <p class="node-text">チェックイン：{{ $data['range_date_start-view'] }}</p>
                    <p class="node-text">チェックアウト：{{ $data['range_date_end-view'] }}</p>
                </div>
                <p>{{ ($breakfast != "")?"モーニング:". $breakfast:"" }}</p>
            </div>
        </div>
        @endif
    @endif    
@endif
