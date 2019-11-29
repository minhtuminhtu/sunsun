@extends('sunsun.front.template')

@section('head')
    @parent
    <link  rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
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
            <form action="{{route('.make_payment')}}" method="POST" class="booking">
                @csrf
                <div class="booking-warp payment">
                    <div class="booking-field">
                        <div class="">
                            <p class="text-md-left pt-2 mb-1 font-weight-bold">個人情報</p>
                        </div>
                    </div>
                    @include('sunsun.front.parts.payment_form', ['new' => '1'])
                    <div class="booking-field">
                        <div class="">
                            <p class="text-md-left pt-4 mb-1 font-weight-bold">{{config('booking.services_used.label')}}</p>
                        </div>
                    </div>

                    <div class="">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-left">入酵料</td>
                                <td class="text-right">2</td>
                                <td class="text-right">6,780</td>
                            </tr>
                            <tr>
                                <td class="text-left">ランチ</td>
                                <td class="text-right">2</td>
                                <td class="text-right">2,400</td>
                            </tr>
                            <tr>
                                <td class="text-left">宿泊 A</td>
                                <td class="text-right">1</td>
                                <td class="text-right">7,000</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col" style="width: 50%" class="text-left price-laber">{{config('booking.total.label')}}</th>
                                <th scope="col" style="width: 15%" class="text-right price-laber"></th>
                                <th scope="col" style="width: 35%" class="text-right price-laber">16,180</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    @include('sunsun.front.parts.payment_method', ['new' => '1'])

                    <div class="pl-4 pr-1">
                        <p class="text-left pt-2">回数券をご利用の場合は、回数券ご利用分以外は、当日現地でお支払いください。</p>
                    </div>
                </div>
                <div class="foot-confirm">
                    <div class="confirm-button-payment">
                        <button type="submit" class="btn btn-block btn-booking text-white">確認</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    @parent
    <script>
        $('.payment-method').on('change', function() {
            if($(this).prop("id") == 'credit-card'){
                $('.credit-card').show();
            }else{
                $('.credit-card').hide();
            }
        });
        $('#card-expire').on('keypress', function() {
            if($(this).val().length == 2 ){
                $('#card-expire').val($('#card-expire').val() + "/");
            }
        });
    </script>
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.css')}}"></script>
@endsection

