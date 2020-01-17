@extends('sunsun.front.template')

@section('head')
    @parent
    <link  rel="stylesheet" href="{{asset('sunsun/front/css/base.css').config('version_files.html.css')}}">
    <link  rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
    <script src="{{asset('sunsun/lib/sweetalert2/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('sunsun/lib/sweetalert2/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('sunsun/lib/animate.css/animate.min.css')}}"/>
    <script  type="text/javascript" src="https://stg.static.mul-pay.jp/ext/js/token.js" ></script>
    <style>
        th {
            background-image: url("http://sun-sun33.com/wordpress/wp-content/themes/sun-sun/image/menu/bg.png");
            color: #000;
        }
        tr {
            background-image: url('/sunsun/imgs/bg.png');
            color: #000;
        }
        .price-laber{
            font-weight: bold;
        }

    </style>
@endsection
@section('page_title', '支払い入力')
@section('main')
    <main class="main-body">
        <div class="">
            <form style="display: none" action="/complete" method="POST" id="completeForm">
                @csrf
                <input type="hidden" id="bookingID" name="bookingID" value=""/>
                <input type="hidden" id="tranID" name="tranID" value=""/>
            </form>
            <form action="{{route('.make_payment')}}" method="POST" class="booking">
                @csrf
                <div class="booking-warp payment">
                    <!-- <div class="booking-field">
                        <div class="">
                            <p class="text-md-left pt-2 mb-1 font-weight-bold">個人情報</p>
                        </div>
                    </div> -->
                    <div class="booking-field">
                        <div class="">
                            <p class="text-md-left mb-1 font-weight-bold">{{config('booking.services_used.label')}}</p>
                        </div>
                    </div>

                    <div class="">
                        <table class="table table-bordered">
                            <tbody>
                            @if($bill['course_1']['quantity'] != 0)
                            <tr>
                                <td class="text-left">{{ $bill['course_1']['name'] }}</td>
                                <td class="text-right">{{ $bill['course_1']['quantity'] }}回</td>
                                <td class="text-right">{{number_format($bill['course_1']['price'])}}</td>
                            </tr>
                            @endif

                            @if($bill['course_2']['quantity'] != 0)
                                <tr>
                                    <td class="text-left">{{ $bill['course_2']['name'] }}</td>
                                    <td class="text-right">{{ $bill['course_2']['quantity'] }}回</td>
                                    <td class="text-right">{{number_format($bill['course_2']['price'])}}</td>
                                </tr>
                            @endif

                            @if($bill['course_3']['quantity'] != 0)
                                <tr>
                                    <td class="text-left">{{ $bill['course_3']['name'] }}</td>
                                    <td class="text-right">{{ $bill['course_3']['quantity'] }}回</td>
                                    <td class="text-right">{{number_format($bill['course_3']['price'])}}</td>
                                </tr>
                            @endif

                            @if($bill['course_4']['quantity'] != 0)
                                <tr>
                                    <td class="text-left">{{ $bill['course_4']['name'] }}</td>
                                    <td class="text-right">{{ $bill['course_4']['quantity'] }}日</td>
                                    <td class="text-right">{{number_format($bill['course_4']['price'])}}</td>
                                </tr>
                            @endif

                            @if($bill['course_5']['quantity'] != 0)
                                <tr>
                                    <td class="text-left">{{ $bill['course_5']['name'] }}</td>
                                    <td class="text-right">{{ $bill['course_5']['quantity'] }}回</td>
                                    <td class="text-right">{{number_format($bill['course_5']['price'])}}</td>
                                </tr>
                            @endif


                            @foreach($bill['options'] as $key => $option)
                                @if($key == '02_03')
                                    <tr>
                                        <td class="text-left">宿泊 {{$option['room']}}</td>
                                        <td class="text-right">{{$option['quantity']}}回</td>
                                        <td class="text-right">{{number_format($option['price'])}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="text-left">{{$option['name']}}</td>
                                        <td class="text-right">{{$option['quantity']}}人</td>
                                        <td class="text-right">{{number_format($option['price'])}}</td>
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col" style="width: 50%" class="text-left price-laber">{{config('booking.total.label')}}</th>
                                <th scope="col" style="width: 15%" class="text-right price-laber"></th>
                                <th scope="col" style="width: 35%" class="text-right price-laber">{{number_format($bill['total'])}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    @include('sunsun.front.parts.payment_form', ['new' => '1'])
                    @include('sunsun.front.parts.payment_method', ['new' => '1'])

                    <div class="pl-4 pr-1">
                        <p class="text-left pt-2">回数券をご利用の場合は、回数券ご利用分以外は、当日現地でお支払いください。</p>
                    </div>
                </div>
                <div class="foot-confirm">
                    <div class="confirm-button-payment">
                        <button id="make_payment" type="button" class="btn btn-block btn-booking text-white">確認</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    <script>
        function payment_init() {
            Multipayment.init('{{ env("SHOP_ID")  }}');
        }
    </script>
    @parent
    <script  type="text/javascript" src="{{asset('sunsun/front/js/base.js').config('version_files.html.css')}}"></script>
    <script  type="text/javascript" src="{{asset('sunsun/front/js/payment.js').config('version_files.html.css')}}"></script>
@endsection

