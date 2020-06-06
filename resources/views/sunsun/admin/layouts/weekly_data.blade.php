@if($type == 'female')
    @if(count($time['day'][$day['full_date']][$type]) == 3)
    ×
    @elseif(count($time['day'][$day['full_date']][$type]) == 0)
    〇
    @else
    {{ 3 - count($time['day'][$day['full_date']][$type]) }}
    @endif

@elseif($type == 'male')
    @if(count($time['day'][$day['full_date']][$type]) == 3)
    ×
    @elseif(count($time['day'][$day['full_date']][$type]) == 0)
    〇
    @else
    {{ 3 - count($time['day'][$day['full_date']][$type]) }}
    @endif

@else
    @if(count($time['day'][$day['full_date']][$type]) != 0)
    ×
    @else
    〇
    @endif

@endif
