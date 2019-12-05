
<div>
    <input type="hidden" id="new-time" value="{{ isset($new)?$new:'' }}">
    <div class="title-table-time">
        <span class="font-weight-bold">{{$gender['kubun_value']}}</span> {{----}}
    </div>
    <table class="table-statistics">
        <thead>
        <tr>
            <th></th>
            @foreach($beds as $bed)
                <th>ベッド <br>{{ config('const.laber.bed')[$bed->sort_no] }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        {{--@php
        function check_disable_time($data, $time){

            if(isset($data['disable_time_2h'])){
                foreach($data['disable_time_2h'] as $disable_time_2h){
                    if(($time < ($disable_time_2h + 200) ) && ($time > ($disable_time_2h - 200) )){
                        return false;
                    }
                }
            }

            if((isset($data['time_index']) && ($data['time_index'] == 0)) || (!isset($data['time_index']))){
                if(isset($data['repeat_time_check']) && ($time < $data['repeat_time_check'])){
                    return false;
                }
            }

            if((isset($data['whitening_check'])) && !((($time + 130) <= $data['whitening_check'] ) || (($time - 15) >= ($data['whitening_check'] + 30)))){
                return false;
            }


            return true;
        }
        @endphp
        @foreach($data['time_slide'] as $time_slide)
            @if(check_disable_time($data, $time_slide->notes))
                <tr>
                    <td>
                        <div class="time-col">
                            <div>{{$time_slide->kubun_value}}～</div>
                        </div>
                    </td>
                    @foreach($data['bed'] as $bed)
                        <td>
                            <div class="time-col">
                                <div>
                                    <input type="hidden" class="bed" value="{{ $bed->kubun_value }}">
                                    <input type="radio" name="time" value="{{$time_slide->kubun_value}}">
                                    <input type="hidden" name="data-json" value="{{json_encode($time_slide)}}">
                                </div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @else
                <tr>
                    <td>
                        <div class="time-col">
                            <div>{{$time_slide->kubun_value}}～</div>
                        </div>
                    </td>
                    @foreach($data['bed'] as $bed)
                        <td>
                            <div class="time-col">×</div>
                        </td>
                    @endforeach
                </tr>
            @endif

        @endforeach--}}
        @foreach($time_room as $times)
            <tr>
                <td>
                    <div class="time-col">
                        <div>{{collect($times)->first()->kubun_value}}</div>
                    </div>
                </td>
                @foreach($times as $time)
                    <td>
                        <div class="time-col">
                            @if(isset($time->status_time_validate) && $time->status_time_validate == 0)
                                ×
                            @else
                                <div>
                                    <input type="hidden" class="bed" value="{{ $time->kubun_value_room }}">
                                    <input type="radio" name="time" value="{{$time->kubun_value}}">
                                    <input type="hidden" name="data-json" value="{{json_encode($time)}}">
                                </div>
                            @endif
                        </div>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
