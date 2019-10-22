<table class="table-statistics">
    <thead>
    <tr>
        <th></th>
        <th>ベッド <br> ①</th>
        <th>ベッド <br> ②</th>
        <th>ベッド <br> ②</th>
        <th>ベッド <br> ④</th>
    </tr>
    </thead>
    <tbody>
    @foreach($room_data as $room)
        <tr>
            <td>{{$room['time']}}～</td>
            <td>
                @if($room['room1']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{$room['time']}}">
                    </div>
                @else
                    x
                @endif

            </td>
            <td>
                @if($room['room2']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{$room['time']}}">
                    </div>
                @else
                    x
                @endif
            </td>
            <td>
                @if($room['room3']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{$room['time']}}">
                    </div>
                @else
                    x
                @endif
            </td>
            <td>
                @if($room['room4']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{$room['time']}}">
                    </div>
                @else
                    x
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
