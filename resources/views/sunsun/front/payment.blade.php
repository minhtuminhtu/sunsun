@extends('sunsun.front.template')

@section('head')
    @parent
    <link  rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <style>
        th {
            background-color: #4472c4;
            color: #fff;
        }
        tr {
            background-color: #e8ebf5;
            color: #000;
        }

    </style>
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1 class="title-menu">支払い入力 </h1>
        </div>
        <div class="container">
            <form action="{{route('.payment')}}" method="POST" class="booking">
                @csrf
                <div class="booking-warp">
                    <div class="booking-field">
                        <div class="booking-field-label">
                            <p class="text-md-left pt-2">{{config('booking.name.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <input type="text" class="form-control date-book-input"  />
                        </div>
                    </div>
                    <div class="booking-field">
                        <div class="booking-field-label">
                            <p class="text-md-left pt-2">{{config('booking.phone.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <input type="text" class="form-control date-book-input"  />
                        </div>
                    </div>
                    <div class="booking-field">
                        <div class="booking-field-label">
                            <p class="text-md-left pt-2">{{config('booking.email.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <input type="text" class="form-control date-book-input"  />
                        </div>
                    </div>
                    <div class="booking-field">
                        <div class="">
                            <p class="text-md-left pt-2 mb-1">{{config('booking.services_used.label')}}</p>
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
                                <td class="text-md-left">宿泊 A</td>
                                <td class="text-md-right">1</td>
                                <td class="text-md-right">7,000</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col" style="width: 50%" class="text-left">{{config('booking.total.label')}}</th>
                                <th scope="col" style="width: 15%" class="text-right"></th>
                                <th scope="col" style="width: 35%" class="text-right">16,180</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="">
                        <div class="">
                            <p class="">{{config('booking.payment_method.label')}}</p>
                        </div>
                    </div>
                    <div class="row pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input payment-method" id="credit-card" name="method" checked>
                            <label class="custom-control-label" for="credit-card">クレジットカード</label>
                        </div>
                    </div>
                    <div class="credit-card">
                        <div class="card-img d-flex justify-content-center align-items-center">
                            <img src="https://galacticglasses.com/image/bank_def.png" class="img-fluid scale-image" alt="">
                        </div>
                        <div class="card-number">
                            <input type="text" id="card-number" class="form-control" placeholder="Card number" maxlength="22">
                        </div>
                        <div class="card-expire">
                            <input type="text" id="card-expire" class="form-control" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="card-secret">
                            <input type="password" id="card-secret" class="form-control" placeholder="CVC" maxlength="3">
                        </div>
                    </div>
                    <div class="row pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input payment-method" id="local-cash" name="method">
                            <label class="custom-control-label" for="local-cash">現地現金</label>
                        </div>
                    </div>
                    <div class="row pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input payment-method" id="coupon" name="method">
                            <label class="custom-control-label" for="coupon">回数券</label>
                        </div>
                    </div>
                    <div class="row pl-5 pr-5">
                        <p class="text-left pt-2">回数券をご利用の場合は、回数券ご利用分以外は、当日現地でお支払いください。</p>
                    </div>

                    <div class="row pl-5 mt-3">
                        <div class="col-6 offset-3">
                            <button type="submit" class="btn btn-block btn-booking text-white">確認</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    @parent
    <script src="{{asset('sunsun/lib/meanmenu/jquery.meanmenu.js')}}" charset="UTF-8"></script>
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
        $(function() {
            $('header nav').meanmenu();
        });
    </script>
@endsection

