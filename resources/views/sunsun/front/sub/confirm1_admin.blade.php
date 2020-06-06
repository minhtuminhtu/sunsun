@php
    $gender = $data->gender;
    $age_value = $data->age_value;
    $age_type = $data->age_type;
    $weekMap = [
        0 => '日',
        1 => '月',
        2 => '火',
        3 => '水',
        4 => '木',
        5 => '金',
        6 => '土',
    ];
@endphp
<div class="linex">
    <p>性別：{{ $admin_value_customer[$i - 1]['gender'] }}</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
@if($age_type == '3')
<div class="linex">
    <p>年齢：大人 {{ $age_value }}歳</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
@elseif($age_type == '1')
<div class="linex">
    <p>年齢：小学生</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
@elseif($age_type == '2')
<div class="linex">
    <p>年齢：学生<span class="node-text">(中学生以上)</span></p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
@endif
<div class="linex">
    <p>コース：<span style="display: none">mark_space</span>{{ $admin_value_customer[$i - 1]['course'] }}</p>
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
    @foreach($admin_value_customer[$i - 1]['time'] as $time)
    <span style="display: none">mark_space</span>
    <p>{{ substr($time->service_time_1, 0, 2) . ":" . substr($time->service_time_1, 2, 2) }}</p>
    @endforeach
    </div>
</div>
@php
    $lunch = ($admin_value_customer[$i - 1]['lunch'] == "無し")?"":"1名";
    $whitening = $data->whitening;
    $whitening_repeat = ($data->whitening_repeat == 1)?"（はじめて）":"（リピート）";
    $whitening_data = ($whitening == '02')?substr($data->whitening_time, 0, 2) . ":" . substr($data->whitening_time, 2, 2) . "～" . substr($data->whitening_time, 5, 2) . ":" . substr($data->whitening_time, 7, 2) . $whitening_repeat:"";
    $pet_keeping = ($admin_value_customer[$i - 1]['pet_keeping'] == "追加しない")?"":"追加する";
@endphp
@if(($lunch != "") || ($whitening_data != "") || ($pet_keeping != ""))
    <hr class="line-x">
    <span style="display: none">mark_newline</span>
    <div class="line">
        <div class="line1">
        オプション
        </div>
        <div class="line2">
            <p>{{ ($lunch != "")?"ランチ：" . $lunch:"" }}</p>
            <p>{{ ($whitening_data != "")?config('booking.whitening.label')."：". $whitening_data:"" }}</p>
            <p>{{ ($pet_keeping != "")?"ペット預かり：" . $pet_keeping:"" }}</p>
        </div>
    </div>
@endif
@if($key == 0)
    @php
        $stay_room_type = $data->stay_room_type;
        $stay_guest_num = $data->stay_guest_num;

        $breakfast = $data->breakfast;

    @endphp
    @if($stay_room_type !== '01')
        <hr class="line-x">
        <span style="display: none">mark_newline</span>
        <div class="line">
            <div class="line1">
            宿泊
            </div>
            <div class="line2">
                <p>部屋ﾀｲﾌﾟ：{{ $admin_value_customer[$i - 1]['stay_room_type'] }}</p>
                <p>宿泊人数：{{ $admin_value_customer[$i - 1]['stay_guest_num'] }}</p>
                <p>宿泊日</p>
                <div class="line3">
                    <p class="node-text">チェックイン：{{ substr($data->stay_checkin_date, 0, 4) . "年" . substr($data->stay_checkin_date, 4, 2) . "月" . substr($data->stay_checkin_date, 6, 2) . "日(" . $weekMap[date('w', strtotime($data->stay_checkin_date))] . ")" }}</p>
                    <p class="node-text">チェックアウト：{{ substr($data->stay_checkout_date, 0, 4) . "年" . substr($data->stay_checkout_date, 4, 2) . "月" . substr($data->stay_checkout_date, 6, 2) . "日(" . $weekMap[date('w', strtotime($data->stay_checkout_date))] . ")" }} </p>
                </div>
                <p>{{ ($admin_value_customer[$i - 1]['breakfast'] != null)?"モーニング:". $admin_value_customer[$i - 1]['breakfast']:"" }}</p>
            </div>
        </div>
    @endif
@endif
