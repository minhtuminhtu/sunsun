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
                    <div class="booking-field mb-3">
                        <div class="booking-field-label">
                            <p class="text-md-left pt-2">{{config('booking.name.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <input name="name" type="text" class="form-control date-book-input" maxlength="255" required/>
                            <!-- <p class="node-text text-red">Name is required!</p> -->
                        </div>
                    </div>
                    <div class="booking-field">
                        <div class="booking-field-label">
                            <p class="text-md-left pt-2">{{config('booking.phone.label')}}</p>
                            <p class="node-text">当日の連絡先</p>
                        </div>
                        <div class="booking-field-content">
                            <input name="phone" type="text" class="form-control date-book-input" maxlength="255" required/>
                            <!-- <p class="node-text text-red">Phone is required!</p> -->
                        </div>
                    </div>
                    <div class="booking-field">
                        <div class="booking-field-label">
                            <p class="text-md-left pt-2">{{config('booking.email.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <input name="email" type="text" class="form-control date-book-input" maxlength="255" required/>
                            <!-- <p class="node-text text-red">Email is required!</p> -->
                        </div>
                    </div>
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

                    <div class="">
                        <div class="">
                            <p class="font-weight-bold pt-3">{{config('booking.payment_method.label')}}</p>
                        </div>
                    </div>
                    <div class="pl-4 mt-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input payment-method" id="credit-card" name="payment-method" checked>
                            <label class="custom-control-label" for="credit-card">クレジットカード</label>
                        </div>
                    </div>
                    <div class="credit-card">

                        <div class="credit-card-line">
                            <div class="card-img d-flex justify-content-center align-items-center">
                                <img src="https://galacticglasses.com/image/bank_def.png" class="img-fluid scale-image" alt="">
                            </div>
                            <div class="card-number">
                                <input type="text" id="card-number" class="form-control" placeholder="Card number" maxlength="22">
                            </div>
                        </div>
                        <div class="credit-card-line2">
                            <div class="card-expire">
                                <input type="text" id="card-expire" class="form-control" placeholder="MM/YY" maxlength="5">
                            </div>
                            <div class="card-secret">
                                <input type="password" id="card-secret" class="form-control" placeholder="CVC" maxlength="3">
                            </div>
                        </div>
                    </div>
                    <div class="pl-4 mt-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input payment-method" id="local-cash" name="payment-method">
                            <label class="custom-control-label" for="local-cash">現地現金</label>
                        </div>
                    </div>
                    <div class="pl-4 mt-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input payment-method" id="coupon" name="payment-method">
                            <label class="custom-control-label" for="coupon">回数券</label>
                        </div>
                    </div>
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

