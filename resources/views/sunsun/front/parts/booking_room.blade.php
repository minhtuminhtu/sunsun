<table class="table-statistics">
    <thead>
    <tr>
        <th></th>
        @foreach($data['bed'] as $bed)
            <th>ベッド <br>{{ config('const.laber.bed')[$bed->sort_no] }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @php
    function check_disable_time($data, $time){
        if($time < $data['repeat_time_check']){
            return false;
        }
        if((isset($data['whitening_check'])) && !((($time + 130) <= $data['whitening_check'] ) || (($time - 15) >= ($data['whitening_check'] + 30)))){
            return false;
        }
        return true;
    }
    @endphp
    @foreach($data['time_slide_room'] as $time_slide_room)
        @if(check_disable_time($data, $time_slide_room->notes))
        <tr>
            <td>{{ $time_slide_room->kubun_value }}</td>
            @foreach($data['bed'] as $bed)
            <td>
                <div class="">
                    <input type="hidden" class="bed" value="{{ $bed->kubun_value }}">
                    <input type="radio" name="time" value="{{ $time_slide_room->kubun_value }}">
                    <input type="hidden" class="data-json" name="data-json" value="{{json_encode($bed)}}">
                </div>
            </td>
            @endforeach
        </tr>
        @else
        <tr>
            <td>{{ $time_slide_room->kubun_value }}</td>
            @foreach($data['bed'] as $bed)
            <td>
                <div class="">×</div>
            </td>
            @endforeach
        </tr>
        @endif
    @endforeach

    </tbody>
</table>
