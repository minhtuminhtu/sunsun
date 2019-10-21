@extends('sunsun.front.template')

@section('head')
    @parent
    <link  rel="stylesheet" href="{{asset('sunsun/front/css/booking.css')}}">
@endsection

@section('main')
<main id="mainArea">
    <div class="container">
        <form action="{{route('.payment')}}" method="POST" class="booking">
                @csrf
                <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-4 offset-xl-4 pb-3 border-left border-bottom border-right">
                                        
                
                
                    <p class="text-md-left mt-2 mb-0">≪交通手段≫</p>

                    @if(isset($data['transportation'])&&($data['transportation'] == "車​"))
                        <p class="text-md-left pl-4 mb-0">{{ $data['transportation']??'' }}</p>
                    @elseif(isset($data['transportation'])&&($data['transportation'] == "​バス​"))
                        <p class="text-md-left pl-4 mb-0">{{ $data['transportation'] }} 洲本IC着：{{ $data['bus_arrival']  }}</p>
                        <p class="text-md-left pl-4 mb-0">送迎：{{ $data['pick_up']??''  }}</p>
                    @endif

                    <p class="text-md-left mt-2 mb-0">≪選択コース≫</p>

                    @if($data['services'] == "酵素部屋貸切プラン")
                        <p class="text-md-left font-weight-bold pt-2 pl-2 mb-0 bg-warning">酵素部屋1部屋貸切プラン</p>
                    @else
                        <p class="text-md-left font-weight-bold pt-2 pl-2 mb-0 bg-warning">{{ $data['services']??''  }}</p>
                    @endif

                    <div class="booking-info">
                        @if($data['services'] == "酵素部屋貸切プラン")
                            <p class="text-md-left font-weight-bold pt-2 pl-2 mb-0 ">酵素部屋1部屋貸切プラン</p>
                        @else
                            <p class="text-md-left font-weight-bold pt-2 pl-2 mb-0 ">{{ $data['services']  }}</p>
                        @endif

                        @if($data['services'] == "1日リフレッシュプラン")
                            <p class="text-md-left pl-2 mb-0 ">［酵素風呂2回とお食事付き］</p>
                        @endif


                    @if($data['services'] != "ペット酵素浴")
                        @if($data['used'] == "​リピート​")
                            <p class="text-md-left pl-4 mb-0 bg-warning">ご利用回数： {{ $data['used']??'' }}</p>
                        @else
                            <p class="text-md-left pl-4 mb-0 bg-warning">ご利用回数： {{ $data['used']??'' }}</p>
                            <p class="text-md-left pl-4 mb-0 bg-warning">※開始時間の15分前までにお越しください。</p>
                        @endif

                    @if(($data['services'] == "酵素浴") || ($data['services'] == "1日リフレッシュプラン"))
                        <p class="text-md-left pl-4 mb-0 bg-warning">{{ $data['sex']??'' }} : {{ $data['age']??'' }}歳</p>
                    @endif


                    @if($data['services'] == "酵素浴")
                        <p class="text-md-left pl-4 mb-0 bg-warning">{{ $data['date']??'' }}  {{ $data['time']??'' }}</p>
                    @elseif($data['services'] == "1日リフレッシュプラン")
                        <p class="text-md-left pl-4 mb-0 bg-warning">{{ $data['date']??'' }}</p>
                        <p class="text-md-left pl-5 mb-0 bg-warning">入浴1回目 {{ $data['time1']??'' }}</p>
                        <p class="text-md-left pl-5 mb-0 bg-warning">入浴2回目 {{ $data['time2']??'' }}</p>
                    @elseif(($data['services'] == "酵素部屋貸切プラン") || ($data['services'] == "ペット酵素浴"))
                        <p class="text-md-left pl-4 mb-0 bg-warning">{{ $data['date']??'' }}</p>
                        <p class="text-md-left pl-5 mb-0 bg-warning">{{ $data['time_room']??'' }}</p>
                    @endif

                    @if($data['services'] == "ペット酵素浴")
                        <p class="text-md-left pl-4 mb-0 bg-warning">ペット数：{{ $data['number_pet']??'' }}</p>
                        <p class="text-md-left pl-4 mb-0 bg-warning">ペット種類：{{ $data['pet_type']??'' }}</p>
                    @endif



                        @if($data['services'] != "ペット酵素浴")
                            <p class="text-md-left pl-4 mb-0 ">［オプション］</p>
                        @endif



                    @if($data['services'] != "ペット酵素浴")
                        @if($data['services'] != "断食プラン")
                            @if(($data['services'] == "酵素部屋貸切プラン") && ($data['number_lunch_book'] != "無し"))
                                <p class="text-md-left pl-5 mb-0 bg-warning">昼食: {{ $data['number_lunch_book']??'' }}</p>
                            @elseif(($data['services'] != "1日リフレッシュプラン") && ($data['lunch'] != "無し"))
                                <p class="text-md-left pl-5 mb-0 bg-warning">昼食: {{ $data['lunch']??'' }}</p>
                            @endif
                        @endif
                        @if($data['pet'] == "追加する")
                            <p class="text-md-left pl-5 mb-0 bg-warning">ペット預かり</p>
                        @endif
                        @if($data['room'] != "無し")
                            <p class="text-md-left pl-5 mb-0 bg-warning">宿泊：有り</p>
                            <p class="text-md-left pl-5 mb-0 bg-warning">部屋ﾀｲﾌﾟ：{{ $data['room']??'' }}</p>
                            <p class="text-md-left pl-5 mb-0 bg-warning">宿泊人数：{{ $data['number_guests_stay']??'' }}</p>
                            <p class="text-md-left pl-5 mb-0 bg-warning">宿泊日</p>
                            <div class="pl-5 mb-0 bg-warning">
                                <p class="text-md-left pl-4 mb-0">ﾁｪｯｸｲﾝ ：{{ $data['range_date_start']??'' }}</p>
                                <p class="text-md-left pl-4">ﾁｪｯｸｱｳﾄ：{{ $data['range_date_end']??'' }}</p>
                            </div>
                        @endif
                    @endif

                    



                    




                    


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

@endsection

