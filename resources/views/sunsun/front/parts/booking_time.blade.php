
<div>
    <input type="hidden" id="new-time" value="{{ isset($data['new'])?$data['new']:'' }}">
    <div class="title-table-time">
        <span class="font-weight-bold">{{$data['gender']}}</span> {{----}}
    </div>
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
        @foreach($data['time_slide'] as $time_slide)
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
                            </div>
                        </div>
                    </td>
                @endforeach
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
