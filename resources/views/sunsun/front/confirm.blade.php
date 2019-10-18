@extends('sunsun.front.template')

@section('head')
    @parent
@endsection

@section('main')
<main id="mainArea">
<div class="container-fluid">
        <div class="row ">
            <form action="{{route('.confirm')}}" method="POST" style="width: 100%">
                @csrf
                <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-4 offset-xl-4 pb-3 border-left border-bottom border-right">
                    <p class="text-md-left mt-2 mb-0">≪交通手段≫</p>
                    @if($data['transportation'] == "car")
                        <p class="text-md-left pl-4 mb-0">{{ config('booking.transportation.options.car') }}</p>
                    @else
                        <p class="text-md-left pl-4 mb-0">{{ config('booking.transportation.options.bus')  }} 洲本IC着：{{ $data['bus_arrival']  }}</p>
                        <p class="text-md-left pl-4 mb-0">送迎：{{ $data['pick_up']  }}</p>
                    @endif

                    <p class="text-md-left mt-2 mb-0">≪選択コース≫</p>
                    <p class="text-md-left font-weight-bold pt-2 pl-2 mb-0 bg-warning">{{ $data['services']  }}</p>

                    @if($data['used'] == "yes")
                        <p class="text-md-left pl-4 mb-0 bg-warning">ご利用回数： {{ config('booking.used.options.yes') }}</p>
                    @else
                        <p class="text-md-left pl-4 mb-0 bg-warning">ご利用回数： {{ config('booking.used.options.no') }}</p>
                        <p class="text-md-left pl-4 mb-0 bg-warning">※開始時間の15分前までにお越しください。</p>
                    @endif

                    <p class="text-md-left pl-4 mb-0 bg-warning">{{ $data['sex'] }} : {{ $data['age'] }}歳</p>
                    <p class="text-md-left pl-4 mb-0 bg-warning">{{ $data['date'] }}  {{ $data['time'] }}歳</p>
                    <p class="text-md-left pl-4 mb-0 bg-warning">［オプション］</p>

                    <p class="text-md-left pl-5 mb-0 bg-warning">昼食: {{ $data['lunch'] }}</p>



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
    </div>
</main>
@endsection

@section('script')
    @parent

@endsection

