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


        foreach($data['disable_time_15min'] as $disable_time_15min){
            if(!((($disable_time_15min + 130) <= $time) || (($disable_time_15min - 15) >=  ($time + 30)))){
                return false;
            }
        }




        return true;
    }
    @endphp
    @foreach($data['time_slide_wt'] as $time_slide_wt)
        @if(check_disable_time($data, substr($time_slide_wt->notes, 0, 4)))
            @php
            $repeat_check = explode("|",$time_slide_wt->notes);
            @endphp
            @if($data['rp_user'] == '01')
                @if($repeat_check[1] == '1')
                <tr>
                    <td>{{ $time_slide_wt->kubun_value }}</td>
                    @foreach($data['bed'] as $bed)
                    <td>
                        <div class="">
                            <input type="radio" name="time" value="{{ $time_slide_wt->kubun_value }}">
                        </div>
                    </td>
                    @endforeach
                    
                </tr>
                @endif
            @else
            <tr>
                <td>{{ $time_slide_wt->kubun_value }}</td>
                @foreach($data['bed'] as $bed)
                <td>
                    <div class="">
                        <input type="radio" name="time" value="{{ $time_slide_wt->kubun_value }}">
                    </div>
                </td>
                @endforeach
                
            </tr>
            @endif
        @else
        <tr>
            <td>{{ $time_slide_wt->kubun_value }}</td>
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
