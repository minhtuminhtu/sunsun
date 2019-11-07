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
                            
                            @foreach($customer['info'] as $key => $data)

                                @php 
                                    $course = json_decode($data['course']);
                                    $repeat_user = json_decode($data['repeat_user']);
                                @endphp


                                @if($course->kubun_id == '01')
                                    <div class="linex">
                                        <p>ご利用回数： {{ $repeat_user->kubun_value }}</p>
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
                                                    <p>{{ $pick_up->kubun_value }}</p>
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
                                        <p> 年齢：{{ $age_value }}歳</p>
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
                                    <div class="linex"> 
                                        <p>予約時間: {{ $data['time'] }}～</p>
                                        <div class="line1"> 
                                        </div>
                                        <div class="line2">
                                        </div>
                                    </div>

                                    
                                    
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        オプション
                                        </div>
                                        <div class="line2">
                                            @php 
                                                $lunch = json_decode($data['lunch']);
                                                $whitening = json_decode($data['whitening']);
                                                $pet_keeping = json_decode($data['pet_keeping']);
                                            @endphp
                                            <p>昼食: {{ $lunch->kubun_value }}</p> 
                                            <p>ﾎﾜｲﾄﾆﾝｸ ：{{ $whitening->kubun_value }}</p>
                                            <p>ﾍﾟｯﾄ預かり：{{ $pet_keeping->kubun_value }}</p>
                                        </div>
                                    </div>
                                    @if($key == 0)
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        宿泊
                                        </div>
                                        <div class="line2">
                                            @php 
                                                $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
                                                $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
                                                
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                                <p>宿泊：有り</p>
                                                <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                <p>宿泊日</p>
                                                <div class="line3">
                                                    <p class="node-text">ﾁｪｯｸｲﾝ ：{{ $data['range_date_start-view'] }}～</p>
                                                    <p class="node-text">ﾁｪｯｸｱｳﾄ：{{ $data['range_date_end-view'] }}</p>
                                                </div>
                                            @else
                                                <p>なし</p>
                                            @endif  
                                        </div>
                                    </div>
                                    @endif
                                @elseif($course->kubun_id == '02')
                                    <div class="linex">
                                        <p>ご利用回数： {{ $repeat_user->kubun_value }}</p>
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
                                                    <p>{{ $pick_up->kubun_value }}</p>
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
                                        <p> 年齢：{{ $age_value }}歳</p>
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
                                    <div class="linex"> 
                                        <p>予約時間: {{ $data['time'] }}～</p>
                                        <div class="line1"> 
                                        </div>
                                        <div class="line2">
                                        </div>
                                    </div>

                                    
                                    
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        オプション
                                        </div>
                                        <div class="line2">
                                            @php 
                                                $whitening = json_decode($data['whitening']);
                                                $pet_keeping = json_decode($data['pet_keeping']);
                                            @endphp
                                            <p>ﾎﾜｲﾄﾆﾝｸ ：{{ $whitening->kubun_value }}</p>
                                            <p>ﾍﾟｯﾄ預かり：{{ $pet_keeping->kubun_value }}</p>
                                        </div>
                                    </div>
                                    @if($key == 0)
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        宿泊
                                        </div>
                                        <div class="line2">
                                            @php 
                                                $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
                                                $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
                                                
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                                <p>宿泊：有り</p>
                                                <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                <p>宿泊日</p>
                                                <div class="line3">
                                                    <p class="node-text">ﾁｪｯｸｲﾝ ：{{ $data['range_date_start-view'] }}～</p>
                                                    <p class="node-text">ﾁｪｯｸｱｳﾄ：{{ $data['range_date_end-view'] }}</p>
                                                </div>
                                            @else
                                                <p>なし</p>
                                            @endif  
                                        </div>
                                    </div>
                                    @endif
                                @elseif($course->kubun_id == '03')
                                    <p class="text-center">
                                        <span class="font-weight-bold">選択コース:&#160;&#160;</span>酵素部屋1部屋貸切プラン
                                    </p>
                                    <div class="linex">
                                        <p>ご利用回数： {{ $repeat_user->kubun_value }}</p>
                                            @if($repeat_user->kubun_id != '02')
                                                <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                            @endif
                                    </div>
                                    @php 
                                        $gender = isset($data['gender'])?json_decode($data['gender']):"";
                                        $age_value = isset($data['age_value'])?$data['age_value']:"";
                                    @endphp

                                    <div class="line"> 
                                        <div class="line1">
                                        基本情報
                                        </div>
                                        <div class="line2">
                                            <p>{{ $data['date-view'] }}</p>
                                            <p>{{ $data['time_room'] }}</p>
                                        </div>
                                    </div>
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        オプション
                                        </div>
                                        <div class="line2">
                                            @php 
                                                
                                                $whitening = json_decode($data['whitening']);
                                                $pet_keeping = json_decode($data['pet_keeping']);
                                                $lunch_guest_num = json_decode($data['lunch_guest_num']);
                                            @endphp
                                            <p>昼食 ：{{ $lunch_guest_num->kubun_value }}</p>
                                            <p>ﾎﾜｲﾄﾆﾝｸ ：{{ $whitening->kubun_value }}</p>
                                            <p>ﾍﾟｯﾄ預かり：{{ $pet_keeping->kubun_value }}</p>
                                        </div>
                                    </div>
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        宿泊
                                        </div>
                                        <div class="line2">
                                            @php 
                                                $stay_room_type = isset($data['stay_room_type'])?json_decode($data['stay_room_type']):"";
                                                $stay_guest_num = isset($data['stay_guest_num'])?json_decode($data['stay_guest_num']):"";
                                                
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                                <p>宿泊：有り</p>
                                                <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                <p>宿泊日</p>
                                                <div class="line3">
                                                    <p class="node-text">ﾁｪｯｸｲﾝ ：{{ $data['range_date_start-view'] }}～</p>
                                                    <p class="node-text">ﾁｪｯｸｱｳﾄ：{{ $data['range_date_end-view'] }}</p>
                                                </div>
                                            @else
                                                <p>なし</p>
                                            @endif
                                        </div>
                                    </div>
                                @elseif($course->kubun_id == '04')
                                    <p class="text-center">
                                        <span class="font-weight-bold">選択コース:&#160;&#160;</span>断食プラン
                                    </p>
                                    <div class="linex">
                                        <p>ご利用回数： {{ $repeat_user->kubun_value }}</p>
                                        @if($repeat_user->kubun_id != '02')
                                            <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                        @endif
                                    </div>
                                    @php 
                                        $gender = json_decode($data['gender']);
                                        $age_value = $data['age_value'];
                                    @endphp

                                    <div class="line"> 
                                        <div class="line1">
                                        基本情報
                                        </div>
                                        <div class="line2">
                                            <p>{{ $gender->kubun_value }} : {{ $age_value }}歳</p>
                                            <p class="text-left mb-0">利用期間</p>
                                            <div class="line3">
                                                <p class="node-text">開始日：{{ $data['plan_date_start-view'] }}</p>
                                                <p class="node-text">終了日：{{ $data['plan_date_end-view'] }}</p>
                                            </div>
                                            <p class="text-left mb-0">入浴時間</p>
                                            <div class="line3">
                                               @if(isset($data['date'])) 
                                                    @foreach ($data['date'] as $d)
                                                        <p class="node-text">{{ $d['day'] }} &#160;&#160;&#160; {{ $d['from'] }} &#160;&#160;&#160; {{ $d['to'] }}</p>
                                                    @endforeach 
                                                @endif  
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        オプション
                                        </div>
                                        <div class="line2">
                                            @php 
                                                $pet_keeping = json_decode($data['pet_keeping']);
                                            @endphp
                                            <p>ﾍﾟｯﾄ預かり：{{ $pet_keeping->kubun_value }}</p>
                                        </div>
                                    </div>
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        宿泊
                                        </div>
                                        <div class="line2">
                                            @php 
                                                $stay_room_type = json_decode($data['stay_room_type']);
                                                $stay_guest_num = json_decode($data['stay_guest_num']);
                                                
                                            @endphp
                                            @if($stay_room_type->kubun_value != config('booking.room.options.no'))
                                                <p>宿泊：有り</p>
                                                <p>部屋ﾀｲﾌﾟ：{{ $stay_room_type->kubun_value }}</p>
                                                <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                <p>宿泊日</p>
                                                <div class="line3">
                                                    <p class="node-text">ﾁｪｯｸｲﾝ ：{{ $data['range_date_start-view'] }}～</p>
                                                    <p class="node-text">ﾁｪｯｸｱｳﾄ：{{ $data['range_date_end-view'] }}</p>
                                                </div>
                                            @else
                                                <p>なし</p>
                                            @endif    
                                        </div>
                                    </div>
                                @elseif($course->kubun_id == '05')
                                    <p class="text-center">
                                        <span class="font-weight-bold">選択コース:&#160;&#160;</span>{{ $course->kubun_value }}
                                    </p>
                                    <div class="linex">
                                    </div>
                                    @php 
                                        $service_pet_num = json_decode($data['service_pet_num']);
                                        $notes = $data['notes'];
                                    @endphp
                                    <div class="line"> 
                                        <div class="line1">
                                        基本情報
                                        </div>
                                        <div class="line2">                                         
                                            <p>{{ $data['date-view'] }}</p>
                                            <p>{{ $data['time_room'] }}</p>
                                        </div>
                                    </div>
                                    <hr class="line-x">
                                    <div class="line"> 
                                        <div class="line1">
                                        オプション
                                        </div>
                                        <div class="line2">
                                            <p>ペット数：{{ $service_pet_num->kubun_value }}</p>
                                            <p>ペット種類：{{ $notes }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($key >= 0)
                                    @if($key != count($customer['info']) - 1)
                                    <hr class="line-line">
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
@endsection

