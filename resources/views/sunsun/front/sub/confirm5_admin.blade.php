@php
    $service_pet_num = $admin_value_customer[$i - 1]['service_pet_num'];
    $notes = $data->notes;
@endphp
<div class="linex">
    <p>コース：<span style="display: none">mark_space</span>{{ $admin_value_customer[$i - 1]['course'] }}</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
@if($key == 0)
    <div class="linex">
        予約日: <span style="display: none">mark_space</span>{{ substr($data->service_date_start, 0, 4) . "/" . substr($data->service_date_start, 4, 2) . "/" . substr($data->service_date_start, 6, 2) }}
        <div class="line1">
        </div>
        <div class="line2">
        </div>
    </div>
@endif
<div class="linex">
    <p>予約時間: <span style="display: none">mark_space</span>{{ substr($data->service_time_1, 0, 2) . ":" . substr($data->service_time_1, 2, 2) . "～" . substr($data->service_time_2, 0, 2) . ":" . substr($data->service_time_2, 2, 2)  }}</p>
    <div class="line1">
    </div>
    <div class="line2">
    </div>
</div>
<div class="linex">
    <p>ペット数：{{ $service_pet_num }}</p>
    <div class="line1">
    </div>
    <div class="line2">

    </div>
</div>
<div class="linex">
    <p>ペット種類：{{ $notes }}</p>
    <div class="line1">
    </div>
    <div class="line2">

    </div>
</div>
