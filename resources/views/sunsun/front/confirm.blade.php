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
                    <div class="header-confirm">
                        <p class="text-center font-weight-bold mb-0">交通手段</p>
                        @php 
                            $transport = json_decode($customer['transport']);
                        @endphp

                        @if($transport->kubun_id == '01' )

                        <p class="text-center">{{ $transport->kubun_value }}</p>
                        @else
                            @php 
                                $bus_arrive_time_slide = json_decode($customer['bus_arrive_time_slide']);
                                $pick_up = json_decode($customer['pick_up']);
                            @endphp
                            <div class="linex">
                                <p>{{ $transport->kubun_value }} 洲本IC着：{{ $bus_arrive_time_slide->kubun_value }}</p>
                                <p>送迎：{{ $pick_up->kubun_value }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="body-confirm">
                        <div>
                            
                            @foreach($customer['info'] as $key => $data)

                                @php 
                                    $course = json_decode($data['course']);
                                    $repeat_user = json_decode($data['repeat_user']);
                                @endphp
                    
                                <p class="text-center"><span class="font-weight-bold">選択コース:&#160;&#160;</span>

                                @if($course->kubun_id == '03')
                                    酵素部屋1部屋貸切プラン</p>
                                @elseif($course->kubun_id == '04')
                                    断食プラン</p>
                                @else
                                    {{ $course->kubun_value }}</p>
                                @endif 


                                <div class="linex">
                                    @if($course->kubun_id != '05') 
                                        <p>ご利用回数： {{ $repeat_user->kubun_value }}</p>
                                        @if($repeat_user->kubun_id != '02')
                                            <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                                        @endif
                                    @endif 
                                </div>
                                

                                @php 
                                    $gender = json_decode($data['gender']);
                                    $repeat_user = json_decode($data['repeat_user']);
                                    $age_value = $data['age_value'];
                                @endphp

                                <div class="line"> 
                                    <div class="line1">
                                    基本情報
                                    </div>
                                    <div class="line2">
                                        @if(($course->kubun_id == '01') || ($course->kubun_id == '04') || ($course->kubun_id == '02'))
                                            <p>{{ $gender->kubun_value }} : {{ $age_value }}歳</p>
                                        @endif
                                        

                                        @if($course->kubun_id == '01')
                                            <p>{{ $data['date-view'] }}</p>
                                            <p>{{ $data['time'] }}～</p>
                                        @elseif($course->kubun_id == '02')
                                            <p>{{ $data['date-view'] }}</p>
                                            <p class="line3">入浴1回目 {{ $data['time1'] }}～</p>
                                            <p class="line3">入浴2回目 {{ $data['time2'] }}～</p>
                                        @elseif(($course->kubun_id == '03') || ($course->kubun_id == '05'))
                                            <p>{{ $data['date-view'] }}</p>
                                            <p>{{ $data['time_room']??'' }}</p>
                                        @endif


                                        @if($course->kubun_id == '04')
                                            <p class="text-md-left pl-4 mb-0 font-weight-bold">利用期間</p>
                                            <p class="text-md-left pl-5 mb-0 ">開始日：{{ $data['plan_date_start-view'] }}</p>
                                            <p class="text-md-left pl-5 mb-0 ">終了日：{{ $data['plan_date_end-view'] }}</p>
                                            <p class="text-md-left pl-4 mb-0 font-weight-bold">入浴時間</p>
                                            @if(isset($data['date'])) 
                                                @foreach ($data['date'] as $d)
                                                    <p class="text-md-left pl-5 mb-0 ">{{ $d['day'] }} &#160;&#160;&#160; {{ $d['from'] }} &#160;&#160;&#160; {{ $d['to'] }}</p>
                                                @endforeach 
                                            @endif 
                                        @endif


                                    </div>
                                </div>

                                

                                
                                @if($course->kubun_id == '02')
                                    <p class="text-md-left pl-2 mb-0 ">［酵素風呂2回とお食事付き］</p>
                                @endif 
                                
                                
                                

                                <hr class="line-x">


                                <div class="line"> 
                                    <div class="line1">
                                    オプション
                                    </div>
                                    <div class="line2">
                                        @php 
                                            $lunch = json_decode($data['lunch']);
                                        @endphp
                                        @if($course->kubun_id != '05') 
                                            @if($course->kubun_id != '04') 
                                                @if($course->kubun_id == '03') 
                                                    @if($data['number_lunch_book'] != config('booking.number_lunch_book.options.no'))
                                                    <p>
                                                    昼食: {{ $data['number_lunch_book']??'' }}</p>
                                                    @endif 
                                                @elseif($course->kubun_id != '02') 

                                                    @if($data['lunch'] != config('booking.lunch.options.no'))
                                                        <p>昼食: {{ $lunch->kubun_value }}</p>
                                                    @endif 
                                                @endif 
                                            @endif
                                        @endif 

                                        <p>ﾎﾜｲﾄﾆﾝｸ ：有り </p>
                                        <p>ﾍﾟｯﾄ預かり：有り </p>
                                        @if($course->kubun_id == '05')
                                            <p>ペット数：{{ $data['number_pet']??'' }}</p>
                                            <p>ペット種類：{{ $data['pet_type']??'' }}</p>
                                            
                                        @endif 

                                        <p>ペット預かり</p>

                                    </div>
                                </div>
                                                                

                                <hr class="line-x">




                                <div class="line"> 
                                    <div class="line1">
                                    宿泊
                                    </div>
                                    <div class="line2">
                                        @php 
                                            $room = json_decode($data['room']);
                                            $stay_guest_num = json_decode($data['stay_guest_num']);
                                            
                                        @endphp
                                        @if(isset($data['room']))
                                            @if($data['room'] != config('booking.room.options.no'))
                                                <p>宿泊：有り</p>
                                                <p>部屋ﾀｲﾌﾟ：{{ $room->kubun_value }}</p>
                                                <p>宿泊人数：{{ $stay_guest_num->kubun_value }}</p>
                                                <p>宿泊日</p>
                                                <div class="line3">
                                                    <p class="small-text">ﾁｪｯｸｲﾝ ：{{ $data['range_date_start-view']??'' }}</p>
                                                    <p class="small-text">ﾁｪｯｸｱｳﾄ：{{ $data['range_date_end-view']??'' }}</p>
                                                </div>
                                            @else
                                                <p>
                                                なし
                                                </p>
                                            @endif 
                                        @else
                                            <p>
                                            なし
                                            </p>
                                        @endif 
                                        
                                    </div>
                                </div>
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

