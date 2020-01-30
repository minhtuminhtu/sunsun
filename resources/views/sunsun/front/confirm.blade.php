@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
@endsection
@section('page_title', '予約確認')
@section('main')
    <main class="main-body confirm">
        <div class="">
            <form action="{{route('.payment')}}" method="POST" class="booking">
                @csrf
                <div class="booking-warp confirm">
                    <!-- <div class="header-confirm">

                    </div> -->
                    <div class="body-confirm">
                        <div>
                            @php
                            $i = 0;
                            @endphp

                            @foreach($customer['info'] as $key => $data)

                                @if((!isset($data['fake_booking'])) || ($data['fake_booking'] != '1'))
                                    @if($key > 0)
                                        <hr class="line-line">
                                    @endif
                                    @php
                                        $course = json_decode($data['course']);
                                        $repeat_user = json_decode($data['repeat_user']);
                                        $i++;
                                    @endphp
                                    @if($course->kubun_id == '01')
                                        <div class="linex mt-0">
                                            @if($i != 1)
                                            <p class="font-weight-bold">予約{{ $i }}</p>
                                            <br>
                                            @endif
                                            <p>ご利用： {{ $repeat_user->kubun_value }}</p>
                                            @if($repeat_user->kubun_id != '02')
                                                <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                            @endif


                                        </div>
                                        @if($key == 0)
                                            @php
                                                $transport = json_decode($customer['transport']);
                                            @endphp

                                            @if($transport->kubun_id == '01' )
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                @php
                                                    $bus_arrive_time_slide = json_decode($customer['bus_arrive_time_slide']);
                                                    $pick_up = json_decode($customer['pick_up']);
                                                @endphp
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                        <p>{{ $bus_arrive_time_slide->kubun_value }}</p>
                                                        @if($pick_up->kubun_id == '01')
                                                            <p>送迎あり</p>
                                                        @else
                                                            <p>送迎なし</p>
                                                        @endif

                                                    </div>
                                                </div>
                                            @endif
                                            <div class="linex">
                                                <p>予約日: {{ $data['date-view'] }}</p>
                                                <div class="line1"></div>
                                                <div class="line2"></div>
                                            </div>

                                        @endif


                                        @php
                                            $gender = isset($data['gender'])?json_decode($data['gender']):"";
                                            $age_value = isset($data['age_value'])?$data['age_value']:"";
                                            $age_type = isset($data['age_type'])?$data['age_type']:"";

                                        @endphp

                                        <div class="linex">
                                            <p>性別：{{ $gender->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>

                                        @if($age_type == '3')
                                        <div class="linex">
                                            <p>年齢：大人 {{ $age_value }}歳</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        @elseif($age_type == '1')
                                        <div class="linex">
                                            <p>年齢：小学生</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        @elseif($age_type == '2')
                                        <div class="linex">
                                            <p>年齢：学生<span class="node-text">(中学生以上)</span></p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        @endif


                                        <div class="linex">
                                            <p>コース: {{ $course->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="line1">
                                            予約時間:
                                            </div>
                                            <div class="line2">
                                            @foreach($data['time'] as $time)
                                            <p>{{ $time['view'] }}～</p>
                                            @endforeach
                                            </div>
                                        </div>


                                        @php
                                            $lunch = (json_decode($data['lunch'])->kubun_value == "無し")?"":"1名";
                                            $whitening = json_decode($data['whitening']);
                                            $whitening_repeat = ($data['whitening_repeat'] == 1)?"（はじめて）":"（リピート）";;
                                            $whitening_data = ($whitening->kubun_id == '02')?$data['whitening-time_view'] . $whitening_repeat:"";
                                            $pet_keeping = (json_decode($data['pet_keeping'])->kubun_value == "追加しない")?"":"追加する";
                                        @endphp

                                        @if(($lunch != "") || ($whitening_data != "") || ($pet_keeping != ""))
                                        <hr class="line-x">
                                        <div class="line">
                                            <div class="line1">
                                            オプション
                                            </div>
                                            <div class="line2">
                                                <p>{{ ($lunch != "")?"ランチ：" . $lunch:"" }}</p>
                                                <p>{{ ($whitening_data != "")?"ホワイトニング：" . $whitening_data:"" }}</p>
                                                <p>{{ ($pet_keeping != "")?"ペット預かり：" . $pet_keeping:"" }}</p>
                                            </div>
                                        </div>
                                        @endif

                                        @if($key == 0)
                                            @php
                                                $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
                                                $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
                                                $breakfast = isset($data['breakfast'])&&(json_decode($data['breakfast'])->kubun_value == "無し")?"":json_decode($data['breakfast'])->kubun_value;
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                            <hr class="line-x">
                                            <div class="line">
                                                <div class="line1">
                                                宿泊
                                                </div>
                                                <div class="line2">
                                                    <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                    <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                    <p>宿泊日</p>
                                                    <div class="line3">
                                                        <p class="node-text">チェックイン：{{ $data['range_date_start-view'] }}～</p>
                                                        <p class="node-text">チェックアウト：{{ $data['range_date_end-view'] }}</p>
                                                    </div>
                                                    <p>{{ ($breakfast != "")?"モーニング:". $breakfast:"" }}</p>
                                                </div>
                                            </div>
                                            @endif
                                        @endif

                                    @elseif($course->kubun_id == '02')
                                        <div class="linex  mt-0">
                                            @if($i != 1)
                                                <p class="font-weight-bold">予約{{ $i }}</p>
                                                <br>
                                            @endif
                                            <p>ご利用： {{ $repeat_user->kubun_value }}</p>
                                            @if($repeat_user->kubun_id != '02')
                                                <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                            @endif


                                        </div>
                                        @if($key == 0)
                                            @php
                                                $transport = json_decode($customer['transport']);
                                            @endphp

                                            @if($transport->kubun_id == '01' )
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                @php
                                                    $bus_arrive_time_slide = json_decode($customer['bus_arrive_time_slide']);
                                                    $pick_up = json_decode($customer['pick_up']);
                                                @endphp
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                        <p>{{ $bus_arrive_time_slide->kubun_value }}</p>
                                                        @if($pick_up->kubun_id == '01')
                                                            <p>送迎あり</p>
                                                        @else
                                                            <p>送迎なし</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="linex">
                                                <p>予約日: {{ $data['date-view'] }}</p>
                                                <div class="line1">

                                                </div>
                                                <div class="line2">

                                                </div>
                                            </div>

                                        @endif


                                        @php
                                            $gender = isset($data['gender'])?json_decode($data['gender']):"";
                                            $age_value = isset($data['age_value'])?$data['age_value']:"";
                                        @endphp

                                        <div class="linex">
                                            <p>性別：{{ $gender->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">
                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>年齢：{{ $age_value }}歳</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">
                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>コース: {{ $course->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="line1">
                                            予約時間:
                                            </div>
                                            <div class="line2">
                                                <p>{{ $data['time1-view'] }}～</p>
                                                <p>{{ $data['time2-view'] }}～</p>
                                            </div>
                                        </div>

                                        @php
                                            $whitening = json_decode($data['whitening']);
                                            $whitening_repeat = ($data['whitening_repeat'] == 1)?"（はじめて）":"（リピート）";;
                                            $whitening_data = ($whitening->kubun_id == '02')?$data['whitening-time_view'] . $whitening_repeat:"";
                                            $pet_keeping = (json_decode($data['pet_keeping'])->kubun_value == "追加しない")?"":"追加する";
                                        @endphp
                                        @if(($whitening_data != "") || ($pet_keeping != ""))
                                        <hr class="line-x">
                                        <div class="line">
                                            <div class="line1">
                                            オプション
                                            </div>
                                            <div class="line2">
                                                <p>{{ ($whitening_data != "")?"ホワイトニング：" . $whitening_data:"" }}</p>
                                                <p>{{ ($pet_keeping != "")?"ペット預かり：" . $pet_keeping:"" }}</p>
                                            </div>
                                        </div>
                                        @endif
                                        @if($key == 0)
                                            @php
                                                $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
                                                $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
                                                $breakfast = isset($data['breakfast'])&&(json_decode($data['breakfast'])->kubun_value == "無し")?"":json_decode($data['breakfast'])->kubun_value;
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                            <hr class="line-x">
                                            <div class="line">
                                                <div class="line1">
                                                宿泊
                                                </div>
                                                <div class="line2">
                                                    <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                    <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                    <p>宿泊日</p>
                                                    <div class="line3">
                                                        <p class="node-text">チェックイン：{{ $data['range_date_start-view'] }}～</p>
                                                        <p class="node-text">チェックアウト：{{ $data['range_date_end-view'] }}</p>
                                                    </div>
                                                    <p>{{ ($breakfast != "")?"モーニング:". $breakfast:"" }}</p>
                                                </div>
                                            </div>
                                            @endif
                                        @endif

                                    @elseif($course->kubun_id == '03')
                                        <div class="linex  mt-0">
                                            @if($i != 1)
                                                <p class="font-weight-bold">予約{{ $i }}</p>
                                                <br>
                                            @endif
                                            <p>ご利用： {{ $repeat_user->kubun_value }}</p>
                                            @if($repeat_user->kubun_id != '02')
                                                <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                            @endif
                                        </div>
                                        @if($key == 0)
                                            @php
                                                $transport = json_decode($customer['transport']);
                                            @endphp

                                            @if($transport->kubun_id == '01' )
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                @php
                                                    $bus_arrive_time_slide = json_decode($customer['bus_arrive_time_slide']);
                                                    $pick_up = json_decode($customer['pick_up']);
                                                @endphp
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                        <p>{{ $bus_arrive_time_slide->kubun_value }}</p>
                                                        @if($pick_up->kubun_id == '01')
                                                            <p>送迎あり</p>
                                                        @else
                                                            <p>送迎なし</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="linex">
                                                <p>予約日: {{ $data['date-view'] }}</p>
                                                <div class="line1">

                                                </div>
                                                <div class="line2">

                                                </div>
                                            </div>

                                        @endif


                                        @php
                                            $age_value = isset($data['age_value'])?$data['age_value']:"";
                                            $service_guest_num = isset($data['service_guest_num'])?json_decode($data['service_guest_num']):"";
                                        @endphp

                                        <div class="linex">
                                            <p>コース: {{ $course->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>予約時間: {{ $data['time_room_view'] }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">
                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>人数：{{ $service_guest_num->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>

                                        @php
                                            $lunch_guest_num = (json_decode($data['lunch_guest_num'])->kubun_value == "無し")?"":json_decode($data['lunch_guest_num'])->kubun_value;
                                            $whitening = json_decode($data['whitening']);
                                            $whitening_repeat = ($data['whitening_repeat'] == 1)?"（はじめて）":"（リピート）";;
                                            $whitening_data = ($whitening->kubun_id == '02')?$data['whitening-time_view'] . $whitening_repeat:"";
                                            $pet_keeping = (json_decode($data['pet_keeping'])->kubun_value == "追加しない")?"":"追加する";
                                        @endphp
                                        @if(($lunch_guest_num != "") || ($whitening_data != "") || ($pet_keeping != ""))
                                        <hr class="line-x">
                                        <div class="line">
                                            <div class="line1">
                                            オプション
                                            </div>
                                            <div class="line2">
                                                <p>{{ ($lunch_guest_num != "")?"ランチ：" . $lunch_guest_num:"" }}</p>
                                                <p>{{ ($whitening_data != "")?"ホワイトニング：" . $whitening_data:"" }}</p>
                                                <p>{{ ($pet_keeping != "")?"ペット預かり：" . $pet_keeping:"" }}</p>
                                            </div>
                                        </div>
                                        @endif

                                        @if($key == 0)
                                            @php
                                                $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
                                                $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
                                                $breakfast = isset($data['breakfast'])&&(json_decode($data['breakfast'])->kubun_value == "無し")?"":json_decode($data['breakfast'])->kubun_value;
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                            <hr class="line-x">
                                            <div class="line">
                                                <div class="line1">
                                                宿泊
                                                </div>
                                                <div class="line2">
                                                    <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                    <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                    <p>宿泊日</p>
                                                    <div class="line3">
                                                        <p class="node-text">チェックイン：{{ $data['range_date_start-view'] }}～</p>
                                                        <p class="node-text">チェックアウト：{{ $data['range_date_end-view'] }}</p>
                                                    </div>
                                                    <p>{{ ($breakfast != "")?"モーニング:". $breakfast:"" }}</p>
                                                </div>
                                            </div>
                                            @endif
                                        @endif
                                    @elseif($course->kubun_id == '04')
                                        <div class="linex  mt-0">
                                            @if($i != 1)
                                                <p class="font-weight-bold">予約{{ $i }}</p>
                                                <br>
                                            @endif
                                            <p>ご利用： {{ $repeat_user->kubun_value }}</p>
                                            @if($repeat_user->kubun_id != '02')
                                                <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                            @endif


                                        </div>
                                        @if($key == 0)
                                            @php
                                                $transport = json_decode($customer['transport']);
                                            @endphp

                                            @if($transport->kubun_id == '01' )
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                @php
                                                    $bus_arrive_time_slide = json_decode($customer['bus_arrive_time_slide']);
                                                    $pick_up = json_decode($customer['pick_up']);
                                                @endphp
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                        <p>{{ $bus_arrive_time_slide->kubun_value }}</p>
                                                        @if($pick_up->kubun_id == '01')
                                                            <p>送迎あり</p>
                                                        @else
                                                            <p>送迎なし</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                        @php
                                            $gender = json_decode($data['gender']);
                                            $age_value = isset($data['age_value'])?$data['age_value']:"";
                                        @endphp

                                        <div class="linex">

                                            <p>性別：{{ $gender->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>年齢：{{ $age_value }}歳</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>コース: {{ $course->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="line1">
                                            予約日:
                                            </div>
                                            <div class="line2">
                                                <p>{{ $data['plan_date_start-view'] }}～</p>
                                                <p>{{ $data['plan_date_end-view'] }}</p>
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="line1">
                                            入浴時間
                                            </div>
                                            <div class="line2">
                                                @if(isset($data['date']))
                                                    @foreach ($data['date'] as $d)
                                                        <p>{{ $d['day']['view'] }} &#160;&#160;&#160; {{ $d['from']['view'] }} &#160;&#160;&#160; {{ $d['to']['view'] }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        @php
                                            $pet_keeping = (json_decode($data['pet_keeping'])->kubun_value == "追加しない")?"":"追加する";
                                        @endphp
                                        @if($pet_keeping != "")
                                        <hr class="line-x">
                                        <div class="line">
                                            <div class="line1">
                                            オプション
                                            </div>
                                            <div class="line2">
                                                <p>{{ ($pet_keeping != "")?"ペット預かり：" . $pet_keeping:"" }}</p>
                                            </div>
                                        </div>
                                        @endif

                                        @if($key == 0)
                                            @php
                                                $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
                                                $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                            <hr class="line-x">
                                            <div class="line">
                                                <div class="line1">
                                                宿泊
                                                </div>
                                                <div class="line2">
                                                    <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                    <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                    <p>宿泊日</p>
                                                    <div class="line3">
                                                        <p class="node-text">チェックイン：{{ $data['range_date_start-view'] }}～</p>
                                                        <p class="node-text">チェックアウト：{{ $data['range_date_end-view'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endif
                                    @elseif($course->kubun_id == '05')
                                        <div class="linex mt-0">
                                            @if($i != 1)
                                                <p class="font-weight-bold">予約{{ $i }}</p>
                                                <br>
                                            @endif
                                            <p>ご利用： {{ $repeat_user->kubun_value }}</p>
                                            @if($repeat_user->kubun_id != '02')
                                                <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                            @endif


                                        </div>
                                        @if($key == 0)
                                            @php
                                                $transport = json_decode($customer['transport']);
                                            @endphp

                                            @if($transport->kubun_id == '01' )
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                @php
                                                    $bus_arrive_time_slide = json_decode($customer['bus_arrive_time_slide']);
                                                    $pick_up = json_decode($customer['pick_up']);
                                                @endphp
                                                <div class="line">
                                                    <div class="line1">
                                                    交通手段 :
                                                    </div>
                                                    <div class="line2">
                                                        <p>{{ $transport->kubun_value }}</p>
                                                        <p>{{ $bus_arrive_time_slide->kubun_value }}</p>
                                                        @if($pick_up->kubun_id == '01')
                                                            <p>送迎あり</p>
                                                        @else
                                                            <p>送迎なし</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        <div class="linex">
                                            <p>コース: {{ $course->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">
                                            </div>
                                        </div>

                                        @php
                                            $service_pet_num = json_decode($data['service_pet_num']);
                                            $notes = $data['notes'];
                                        @endphp
                                        <div class="linex">
                                            <p>予約時間: {{ $data['time_room'] }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">
                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>ペット数：{{ $service_pet_num->kubun_value }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        <div class="linex">
                                            <p>ペット種類：{{ $notes }}</p>
                                            <div class="line1">
                                            </div>
                                            <div class="line2">

                                            </div>
                                        </div>
                                        @if($key == 0)
                                            <div class="linex">
                                                予約日: {{ $data['date-view'] }}
                                                <div class="line1">

                                                </div>
                                                <div class="line2">
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="foot-confirm">
                    <div class="confirm-button">
                        <div class="button-left">
                            <button type="button" class="btn btn-block btn-booking text-white add-new-people btn-confirm-left">予約追加
                            </button>
                        </div>
                        <div class="button-right">
                            <button type="submit" class="btn btn-block btn-booking text-white">お支払い入力へ</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection


@section('script')
    @parent
    <script src="{{asset('sunsun/front/js/add_user_booking.js').config('version_files.html.css')}}"></script>
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.css')}}"></script>
    <script src="{{asset('sunsun/front/js/confirm.js').config('version_files.html.css')}}"></script>
@endsection

