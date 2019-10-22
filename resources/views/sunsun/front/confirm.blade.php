@extends('sunsun.front.template')

@section('head')
    @parent
    <link  rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="container">
            <form action="{{route('.payment')}}" method="POST" class="booking">
                @csrf
                <div class="booking-warp">

                    <p class="text-md-left mt-2 mb-0">≪交通手段≫</p>

                    @if($data['transportation'] == config('booking.transportation.options.car') )
                        <p class="text-md-left pl-4 mb-0">{{ $data['transportation']??'' }}</p>
                    @else
                        <p class="text-md-left pl-4 mb-0">{{ $data['transportation'] }} 洲本IC着：{{ $data['bus_arrival']  }}</p>
                        <p class="text-md-left pl-4 mb-0">送迎：{{ $data['pick_up']  }}</p>
                    @endif

                    <p class="text-md-left mt-2 mb-0">≪選択コース≫</p>


                    <div class="booking-info pt-2 pb-2">
                        @if($data['services'] == config('booking.services.options.eat'))
                            <p class="text-md-left font-weight-bold pl-2 mb-0 ">酵素部屋1部屋貸切プラン</p>
                        @elseif($data['services'] == config('booking.services.options.no'))
                            <p class="text-md-left font-weight-bold pl-2 mb-0 ">断食プラン</p>
                        @else
                            <p class="text-md-left font-weight-bold pl-2 mb-0 ">{{ $data['services']  }}</p>
                        @endif

                        @if($data['services'] == config('booking.services.options.day'))
                            <p class="text-md-left pl-2 mb-0 ">［酵素風呂2回とお食事付き］</p>
                        @endif



                        @if($data['services'] != config('booking.services.options.pet'))
                            @if($data['used'] == config('booking.used.options.yes'))
                                <p class="text-md-left pl-4 mb-0 ">ご利用回数： {{ $data['used'] }}</p>
                            @else
                                <p class="text-md-left pl-4 mb-0 ">ご利用回数： {{ $data['used'] }}</p>
                                <p class="text-md-left pl-4 mb-0 ">※<span class="text-red">開始時間の15分前まで</span>にお越しください。</p>
                            @endif
                        @endif



                        @if(($data['services'] == config('booking.services.options.normal')) || ($data['services'] == config('booking.services.options.no')) || ($data['services'] == config('booking.services.options.day')))
                            <p class="text-md-left pl-4 mb-0 ">{{ $data['sex'] }} : {{ $data['age'] }}歳</p>
                        @endif

                        @if($data['services'] == config('booking.services.options.no'))
                            <p class="text-md-left pl-4 mb-0 font-weight-bold">利用期間</p>
                            <p class="text-md-left pl-5 mb-0 ">開始日：{{ $data['plan_date_start-view'] }}</p>
                            <p class="text-md-left pl-5 mb-0 ">終了日：{{ $data['plan_date_end-view'] }}</p>
                            <p class="text-md-left pl-4 mb-0 font-weight-bold">入浴時間</p>
                            @if(isset($data['date']))
                                @foreach ($data['date'] as $d)
                                    <p class="text-md-left pl-5 mb-0 ">{{ $d['day'] }}   &#160;&#160;&#160;   {{ $d['from'] }}   &#160;&#160;&#160;     {{ $d['to'] }}</p>
                                @endforeach
                            @endif
                        @endif





                        @if($data['services'] == config('booking.services.options.normal'))
                            <p class="text-md-left pl-4 mb-0 ">{{ $data['date-view'] }}  {{ $data['time'] }}～</p>
                        @elseif($data['services'] == config('booking.services.options.day'))
                            <p class="text-md-left pl-4 mb-0 ">{{ $data['date-view'] }}</p>
                            <p class="text-md-left pl-5 mb-0 ">入浴1回目 {{ $data['time1'] }}～</p>
                            <p class="text-md-left pl-5 mb-0 ">入浴2回目 {{ $data['time2'] }}～</p>
                        @elseif(($data['services'] == config('booking.services.options.eat')) || ($data['services'] == config('booking.services.options.pet')))
                            <p class="text-md-left pl-4 mb-0 ">{{ $data['date-view'] }}</p>
                            <p class="text-md-left pl-5 mb-0 ">{{ $data['time_room']??'' }}</p>
                        @endif

                        @if($data['services'] == config('booking.services.options.pet'))
                            <p class="text-md-left pl-4 mb-0 ">ペット数：{{ $data['number_pet']??'' }}</p>
                            <p class="text-md-left pl-4 mb-0 ">ペット種類：{{ $data['pet_type']??'' }}</p>
                        @endif



                        @if($data['services'] != config('booking.services.options.pet'))
                            <p class="text-md-left pl-4 mb-0 ">［オプション］</p>
                        @endif


                        @if($data['services'] != config('booking.services.options.pet'))
                            @if($data['services'] != config('booking.services.options.no'))
                                @if($data['services'] == config('booking.services.options.eat'))
                                    @if($data['number_lunch_book'] != config('booking.number_lunch_book.options.no'))
                                        <p class="text-md-left pl-5 mb-0">昼食: {{ $data['number_lunch_book']??'' }}</p>
                                    @endif
                                @elseif($data['services'] != config('booking.services.options.day'))
                                    @if($data['lunch'] != config('booking.lunch.options.no'))
                                        <p class="text-md-left pl-5 mb-0">昼食: {{ $data['lunch']??'' }}</p>
                                    @endif
                                @endif
                            @endif
                            @if($data['pet'] == config('booking.pet.options.yes'))
                                <p class="text-md-left pl-5 mb-0">ペット預かり</p>
                            @endif
                            @if($data['room'] != config('booking.room.options.no'))
                                <p class="text-md-left pl-5 mb-0">宿泊：有り</p>
                                <p class="text-md-left pl-5 mb-0">部屋ﾀｲﾌﾟ：{{ $data['room']??'' }}</p>
                                <p class="text-md-left pl-5 mb-0">宿泊人数：{{ $data['number_guests_stay']??'' }}</p>
                                <p class="text-md-left pl-5 mb-0">宿泊日</p>
                                <div class="pl-5 mb-0">
                                    <p class="text-md-left pl-4 mb-0">ﾁｪｯｸｲﾝ ：{{ $data['range_date_start-view']??'' }}</p>
                                    <p class="text-md-left pl-4">ﾁｪｯｸｱｳﾄ：{{ $data['range_date_end-view']??'' }}</p>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <button type="button" class="btn btn-block btn-warning text-white">予約追加</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-warning text-white">予約確認へ</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/moment.min.js')}}" charset="UTF-8"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}"
            charset="UTF-8"></script>
@endsection

