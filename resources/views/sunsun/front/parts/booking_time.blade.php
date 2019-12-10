
<div>
    <input type="hidden" id="new-time" value="{{ isset($new)?$new:'' }}">
    <div class="title-table-time">
        <span class="font-weight-bold">{{isset($gender['kubun_value'])?$gender['kubun_value']:'ホワイトニング時間'}}</span> {{----}}
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
