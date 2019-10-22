@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="container">
            <div class="main-body-head text-center">
                <h1>事前注意 </h1>
            </div>
            <div class="booking">
                <div class="row">
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
                                        <li><span class="text-red">新規のお客様</span>は、入酵前に問診、説明等ございますので、<span class="text-red">予約時間の15分前に到着</span>をお願いします。</li>
                                        <li>酵素浴は、お着替えなどを含めると、<span class="text-red">入浴自体は1時間ぐらい</span>かかります。お子様やペットを交代で面倒みられる場合、1時間以上間隔をあけてください。</li>
                                        <li><span class="text-red">5才以下のお子様</span>は、他のお客様のご迷惑になる場合がありますので、貸切のご利用をご検討ください。</li>
                                        <li>次の動作がお一人では難しい場合、<span class="text-red">お客様で介助</span>をお願いいたします。
                                            <ul class="pl-3">
                                                <li>50cm以上の段差を越える</li>
                                                <li>一人でシャワーを浴びる</li>
                                                <li>一人で立ち上がる</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="index-field-foot">
                                <input type="checkbox" class="form-check-input" id="confirm">
                                <label class="form-check-label" for="confirm">上記注意事項を確認し、同意いたします。</label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6 offset-3">
                                <a href="{{route('.booking')}}">
                                    <button type="button" class="btn btn-block btn-booking text-white confirm-rules" disabled>予約入力へ</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection

@section('script')

    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/moment.min.js')}}" charset="UTF-8"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}"
            charset="UTF-8"></script>
    <script src="{{asset('sunsun/front/js/booking.js').config('version_files.html.js')}}"></script>
@endsection

