@if(isset($data['monthly_data'][$day['full_date']]))
    @if($type == 'male')
        @if((count($data['monthly_data'][$day['full_date']][$type][$time]) == 12) && ($time == 0))
        ×
        @elseif((count($data['monthly_data'][$day['full_date']][$type][$time]) == 18) && ($time == 1))
        ×
        @elseif((count($data['monthly_data'][$day['full_date']][$type][$time]) == 6) && ($time == 2))
        ×
        @elseif(count($data['monthly_data'][$day['full_date']][$type][$time]) == 0)
        ●
        @else
        ▲
        @endif
    @elseif($type == 'female')
        @if((count($data['monthly_data'][$day['full_date']][$type][$time]) == 16) && ($time == 0))
        ×
        @elseif((count($data['monthly_data'][$day['full_date']][$type][$time]) == 24) && ($time == 1))
        ×
        @elseif((count($data['monthly_data'][$day['full_date']][$type][$time]) == 8) && ($time == 2))
        ×
        @elseif(count($data['monthly_data'][$day['full_date']][$type][$time]) == 0)
        ●
        @else
        ▲
        @endif
    @elseif($type == 'pet')
        @if(count($data['monthly_data'][$day['full_date']][$type][$time]) == 2)
        ×
        @elseif(count($data['monthly_data'][$day['full_date']][$type][$time]) == 0)
        ●
        @else
        ▲
        @endif
    @elseif($type == 'wt')
        @if((count($data['monthly_data'][$day['full_date']][$type][$time]) == 6) && ($time == 0))
        ×
        @elseif((count($data['monthly_data'][$day['full_date']][$type][$time]) == 5) && ($time == 1))
        ×
        @elseif(count($data['monthly_data'][$day['full_date']][$type][$time]) == 0)
        ●
        @else
        ▲
        @endif
    @endif
@else
●
@endif
