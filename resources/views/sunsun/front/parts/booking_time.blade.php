
<div>
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
                <td>{{$time_slide->kubun_value}}～</td>
                @foreach($data['bed'] as $bed)
                    <td>
                        <div class="">
                            <input type="radio" name="time" value="{{$time_slide->kubun_value}}">
                        </div>
                @endforeach
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
