@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
@endsection
@section('page_title', '事前注意')
@section('main')
    <main class="main-body">
        <div class="container">
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
                                        <li class="new-line"><span class="text-red">新規のお客様</span>は、入酵前に問診、説明等ございますので、<span class="text-red">予約時間の15分前に到着</span>をお願いします。</li>
                                        <li class="new-line">酵素浴は、お着替えなどを含めると、<span class="text-red">入浴自体は1時間ぐらい</span>かかります。お子様やペットを交代で面倒みられる場合、1時間以上間隔をあけてください。</li>
                                        <li class="new-line"><span class="text-red">5才以下のお子様</span>は、他のお客様のご迷惑になる場合がありますので、貸切のご利用をご検討ください。</li>
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
                                <a class= "no-effect" href="{{route('.booking')}}">
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
    <script>
        $('#confirm').on('change', function() {
            if($(this).is(":checked")){
                $(".confirm-rules").prop("disabled", false);
            }else{
                $(".confirm-rules").prop("disabled", true);
            }
        });
    </script>
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.css')}}"></script>
@endsection

