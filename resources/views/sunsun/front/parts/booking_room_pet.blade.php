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
        return true;
    }
    @endphp
    @foreach($data['time_slide_pet'] as $time_slide_pet)
        @if(check_disable_time($data, substr($time_slide_pet->notes, 0, 4)))
        <tr>
            <td>{{ $time_slide_pet->kubun_value }}</td>
            @foreach($data['bed'] as $bed)
            <td>
                <div class="">
                    <input type="radio" name="time" value="{{ $time_slide_pet->kubun_value }}">
                </div>
            </td>
            @endforeach
            
        </tr>
        @else
        <tr>
            <td>{{ $time_slide_pet->kubun_value }}</td>
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
