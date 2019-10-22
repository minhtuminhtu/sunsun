<table class="table-statistics">
    <thead>
    <tr>
        <th></th>
        <th>ベッド <br> ①</th>
    </tr>
    </thead>
    <tbody>
    @foreach($room_pet as $room)
        <tr>
            <td>{{$room['time_from']}}～{{$room['time_to']}}</td>
            <td>
                @if($room['room1']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{$room['time_from']}}～{{$room['time_to']}}">
                    </div>
                @else
                    x
                @endif

            </td>
        </tr>
    @endforeach

    </tbody>
</table>
