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

                        @if($customer['transportation'] == config('booking.transportation.options.car') )
                        <p class="text-center">{{ $customer['transportation']??'' }}</p>
                        @else
                            <div class="linex">
                                <p>{{ $customer['transportation'] }} 洲本IC着：{{ $customer['bus_arrival'] }}</p>
                                <p>送迎：{{ $customer['pick_up'] }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="body-confirm">
                        <div>
                            @foreach($customer['info'] as $key => $data)
                                <p class="text-center"><span class="font-weight-bold">選択コース:&#160;&#160;</span>

                                @if($data['services'] == config('booking.services.options.eat'))
                                    酵素部屋1部屋貸切プラン</p>
                                @elseif($data['services'] == config('booking.services.options.no'))
                                    断食プラン</p>
                                @else
                                    {{ $data['services'] }}</p>
                                @endif 


                                <div class="linex">
                                    @if($data['services'] != config('booking.services.options.pet')) 
                                        @if($data['used'] == config('booking.used.options.yes'))
                                            <p>ご利用回数： {{ $data['used'] }}</p>
                                        @else
                                            <p>ご利用回数： {{ $data['used'] }}</p>
                                            <p>※<span class="text-red">開始時間の15分前まで</span>にお越しください。
                                            </p>
                                        @endif
                                    @endif 
                                </div>
                                

                                <div class="line"> 
                                    <div class="line1">
                                    基本情報
                                    </div>
                                    <div class="line2">
                                        @if(($data['services'] == config('booking.services.options.normal')) || ($data['services'] == config('booking.services.options.no')) || ($data['services'] == config('booking.services.options.day')))
                                            <p>{{ $data['sex'] }} : {{ $data['age'] }}歳</p>
                                        @endif


                                        @if($data['services'] == config('booking.services.options.normal'))
                                            <p>{{ $data['date-view'] }}</p>
                                            <p>{{ $data['time'] }}～</p>
                                        @elseif($data['services'] == config('booking.services.options.day'))
                                            <p>{{ $data['date-view'] }}</p>
                                            <p class="line3">入浴1回目 {{ $data['time1'] }}～</p>
                                            <p class="line3">入浴2回目 {{ $data['time2'] }}～</p>
                                        @elseif(($data['services'] == config('booking.services.options.eat')) || ($data['services'] == config('booking.services.options.pet')))
                                            <p>{{ $data['date-view'] }}</p>
                                            <p>{{ $data['time_room']??'' }}</p>
                                        @endif


                                        @if($data['services'] == config('booking.services.options.no'))
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

                                

                                
                                @if($data['services'] == config('booking.services.options.day'))
                                    <p class="text-md-left pl-2 mb-0 ">［酵素風呂2回とお食事付き］</p>
                                @endif 
                                
                                
                                

                                <hr class="line-x">


                                <div class="line"> 
                                    <div class="line1">
                                    オプション
                                    </div>
                                    <div class="line2">
                                        @if($data['services'] != config('booking.services.options.pet')) 
                                            @if($data['services'] != config('booking.services.options.no')) 
                                                @if($data['services'] == config('booking.services.options.eat')) 
                                                    @if($data['number_lunch_book'] != config('booking.number_lunch_book.options.no'))
                                                    <p>
                                                    昼食: {{ $data['number_lunch_book']??'' }}</p>
                                                    @endif 
                                                @elseif($data['services'] != config('booking.services.options.day')) 

                                                    @if($data['lunch'] != config('booking.lunch.options.no'))
                                                        <p>昼食: {{ $data['lunch']??'' }}</p>
                                                    @endif 
                                                @endif 
                                            @endif
                                        @endif 

                                        <p>ﾎﾜｲﾄﾆﾝｸ ：有り </p>
                                        <p>ﾍﾟｯﾄ預かり：有り </p>
                                        @if($data['services'] == config('booking.services.options.pet'))
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

                                        @if(isset($data['room']))
                                            @if($data['room'] != config('booking.room.options.no'))
                                                <p>宿泊：有り</p>
                                                <p>部屋ﾀｲﾌﾟ：{{ $data['room']??'' }}</p>
                                                <p>宿泊人数：{{ $data['number_guests_stay']??'' }}</p>
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

