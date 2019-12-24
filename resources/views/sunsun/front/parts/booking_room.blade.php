<div>
    <div class="title-table-time">
        <span class="font-weight-bold">予約時間</span>
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
        @foreach($time_book_all_room as $times)
            <tr>
                <td>
                    <div class="time-col">
                        <span>{{collect($times)->first()->kubun_value}}</span>
                    </div>
                </td>
                @foreach($times as $time)
                    <td>
                        <div class="time-col">
                            @if(isset($time->status_time_validate) && $time->status_time_validate == 0)
                                ×
                            @else
                                <div class="container-radio">
                                    <span class="checkmark"></span>
                                    <input type="hidden" class="bed" value="{{ $time->kubun_value_room }}">
                                    <input type="radio" name="time" value="{{ $time->kubun_value }}">
                                    <input type="hidden" class="data-json" name="data-json" value="{{json_encode($time)}}">
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
