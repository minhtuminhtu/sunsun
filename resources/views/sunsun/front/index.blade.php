@extends('sunsun.front.template')

@section('head')
    @parent

@endsection

@section('main')

<main id="mainArea">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-4 offset-xl-4 pb-5 border-left border-bottom border-right">
                <div class="row mt-4">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">{{config('title.is_used')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            @foreach(config('select.is_used') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">{{config('title.transportation')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            @foreach(config('select.transportation') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">{{config('title.bus_arrival')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>9:29着（三宮発）​</option>
                            <option value="2">10:29着（三宮発）</option>
                            <option value="2">11:14着（三宮発）</option>
                            <option value="2">12:38着（舞子）</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【送迎】​</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>希望する</option>
                            <option value="2">​希望しない​</option>
                        </select>
                        <p class="text-md-left mt-2 mb-0">バスの方は洲本ICのバス停に送迎を行います。</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【コース】​</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>酵素浴</option>
                            <option value="2">​1日リフレッシュプラン​</option>
                            <option value="2">酵素部屋貸切プラン​</option>
                            <option value="2">断食プラン​</option>
                            <option value="2">ペット酵素浴​</option>
                        </select>
                        <p class="text-md-left mt-2 mb-0">入浴時間約30分</p>
                        <p class="text-md-left">(全体の滞在時間約90分)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【性別】</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>男性​</option>
                            <option value="2">​女性​</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p class="text-md-left mt-3 pt-2">【年齢】</p>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-4 pl-0">
                                <button type="button" class="btn btn-block btn-outline-warning text-dark mt-3 mx-0">小学生</button>
                                <button type="button" class="btn btn-block btn-warning text-dark mt-3">大人</button>
                            </div>
                            <div class="col-8 pl-0">
                                <button type="button" class="btn btn-block btn-outline-warning text-dark mt-3 mx-0">学生(中学生以上)</button>
                                <div class="row">
                                    <div class="col-6">
                                        <select class="custom-select mt-3">
                                            <option selected>21</option>
                                            <option value="2">22</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【予約日】</p>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control mt-3" id="pwd" value="2019/9/20(金)" />
                            </div>
                            
                            <div class="col-2 pl-0 ">
                                <button  class="btn mt-3 p-0">
                                    <i class="fa fa-calendar-alt fa-2x"></i> 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【予約時間】</p>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control mt-3" id="pwd" value="13:45" />
                            </div>
                            
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【ランチ】</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>無し​</option>
                            <option value="2">有り</option>
                        </select>
                        <p class="text-md-left mt-2">ランチは11:30からです</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【ﾎﾜｲﾄﾆﾝｸﾞ】</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>追加しない</option>
                            <option value="2">追加する</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【ﾍﾟｯﾄ預かり】</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>追加しない</option>
                            <option value="2">追加する</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【宿泊(部屋ﾀｲﾌﾟ)】</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>無し</option>
                            <option value="2">A：１～３名（畳）</option>
                            <option value="2">B：１～２名（ツイン）</option>
                            <option value="2">C：１名（セミダブル）</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left mt-3 pt-2">【宿泊(部屋ﾀｲﾌﾟ)】</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select mt-3">
                            <option selected>無し</option>
                            <option value="2">A：１～３名（畳）</option>
                            <option value="2">B：１～２名（ツイン）</option>
                            <option value="2">C：１名（セミダブル）</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
    @parent

@endsection

