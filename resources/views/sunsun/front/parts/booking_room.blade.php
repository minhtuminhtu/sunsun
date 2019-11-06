<table class="table-statistics">
    <thead>
    <tr>
        <th></th>
        @foreach($data['bed'] as $room)
            <th>ベッド <br>{{ $room->kubun_value }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($data['time_slide_room'] as $room)
        <tr>
            <td>{{ $room->kubun_value }}</td>
            <td>
                @if($room['room1']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{ $room->kubun_value }}">
                    </div>
                @else
                    x
                @endif

            </td>
            <td>
                @if($room['room2']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{ $room->kubun_value }}">
                    </div>
                @else
                    x
                @endif
            </td>
            <td>
                @if($room['room3']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{ $room->kubun_value }}">
                    </div>
                @else
                    x
                @endif
            </td>
            <td>
                @if($room['room4']['status'] != '1')
                    <div class="">
                        <input type="radio" name="time" value="{{ $room->kubun_value }}">
                    </div>
                @else
                    x
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
