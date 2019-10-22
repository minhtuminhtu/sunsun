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

                    <div class="row pl-4 pr-4">
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

                    <div class="row">
                        <div class="col-5">
                            <p class="text-left pt-2 mb-0">{{config('booking.payment_method.label')}}</p>
                        </div>
                    </div>
                    <div class="row pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="method1" name="method" checked>
                            <label class="custom-control-label" for="method1">クレジットカード</label>
                        </div>
                    </div>
                    <div class="row pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="method2" name="method">
                            <label class="custom-control-label" for="method2">現地現金</label>
                        </div>
                    </div>
                    <div class="row pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="method3" name="method">
                            <label class="custom-control-label" for="method3">回数券</label>
                        </div>
                    </div>
                    <div class="row pl-5 pr-5">
                        <p class="text-left pt-2">回数券をご利用の場合は、回数券ご利用分以外は、当日現地でお支払いください。</p>
                    </div>

                    <div class="row pl-5">
                        <div class="col-6 offset-3">
                            <button type="submit" class="btn btn-block btn-warning text-white">確認</button>
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

