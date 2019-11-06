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
    @foreach($data['time_slide_room'] as $time_slide_room)
        <tr>
            <td>{{ $time_slide_room->kubun_value }}</td>
            @foreach($data['bed'] as $bed)
            <td>
                <div class="">
                    <input type="radio" name="time" value="{{ $time_slide_room->kubun_value }}">
                </div>
            </td>
            @endforeach
            
        </tr>
    @endforeach

    </tbody>
</table>
