@extends('sunsun.front.template')
@section('head')
    @parent
    <style>
        @media only screen and (min-width: 768px) {
            .mean-bar {
                display: none;
            }
        }
        .breadc, .main-body-head {
            display: none;
        }
        .btn:hover {
            opacity: 0.7;
            color: #ffffff;
        }
        a:hover {
            text-decoration: none;
        }
        .warp-content {
            text-align: center;
        }
        h2.success-title {
            font-size: 1.8rem;
            padding: 19px 0 0 0;
        }
        .success-detail {
            padding: 15px 0 15px 0;
        }
        .btn-back-home {
            background: #d7751e;
            color: #ffffff;
        }
    </style>
@endsection
@section('page_title', '予約確認')
@section('main')
    <main>
        <div class="container">
            <div class="row  d-flex justify-content-center">
                <div class="col-11">
                    <div class="warp-content">
                        <div class="icon-success">
                            <img src="{{asset('sunsun/imgs/icons/success.svg')}}" alt="success" width="50px">
                        </div>
                        <h2 class="success-title">THANK YOU FOR YOUR PURCHASE</h2>
                        <p class="success-detail">Your order number is {{ $bookingID  }}</p>
                        <p class="success-detail">Your payment number is {{ $tranID  }}</p>
                        <a href="http://sun-sun33.com/"><button class="btn btn-back-home">Go home</button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    @parent

@endsection
