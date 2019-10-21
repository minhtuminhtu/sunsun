@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css')}}">
@endsection

@section('main')
    <main id="mainArea">
        <div class="container">
            <form action="{{route('.booking')}}" method="GET" class="booking">
                <div class="row">
                    @csrf
                    <div class="booking-warp">
                        <div class="index-field">
                            
                        </div>
                        <div class="index-field">
                            <div class="index-field-head">
                                <p>ご予約に際して、以下の注意事項をご確認ください。</p>
                            </div>
                            <div class="index-border">
                                <div class="index-content">
                                    <ol>
                                        <li><div class="text-red">新規のお客様</div>は、入酵前に問診、説明等ございますので、<div class="text-red">予約時間の15分前に到着</div>をお願いします。</li>
                                        <li>酵素浴は、お着替えなどを含めると、<div class="text-red">入浴自体は1時間ぐらい</div>かかります。お子様やペットを交代で面倒みられる場合、1時間以上間隔をあけてください。</li>
                                        <li><div class="text-red">5才以下のお子様</div>は、他のお客様のご迷惑になる場合がありますので、貸切のご利用をご検討ください。</li>
                                        <li>次の動作がお一人では難しい場合、<div class="text-red">お客様で介助</div>をお願いいたします。
                                            <ul class="pl-3">
                                                <li>50cm以上の段差を越える</li>
                                                <li>一人でシャワーを浴びる</li>
                                                <li>一人で立ち上がる</li>
                                            </ul>
                                        </li>
                                    <ol>
                                </div>
                            </div>   
                            <div class="index-field-foot">
                                <input type="checkbox" class="form-check-input" id="confirm">
                                <label class="form-check-label" for="confirm">上記注意事項を確認し、同意いたします。</label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6 offset-3">
                                <button type="submit" class="btn btn-block btn-warning text-white" disabled>予約入力へ</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('footer')
    @parent
    <!-- The Modal -->
    <div class="modal" id="choice_date_time">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body-time">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer" style="padding: 6px;">
                    <button type="button" class="btn btn-outline-primary" id="js-save-time" style="padding: 2px 13px;">
                        Save
                    </button>
                    <button type="button" class="btn btn-outline-dark" style="padding: 2px 13px;"
                            data-dismiss="choice_date_time" data-target="#choice_date_time" data-toggle="modal"
                            data-backdrop="static" data-keyboard="false">Close
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/moment.min.js')}}" charset="UTF-8"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}"
            charset="UTF-8"></script>
    <script src="{{asset('sunsun/front/js/booking.js')}}"></script>
@endsection

