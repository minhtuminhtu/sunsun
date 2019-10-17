@extends('sunsun.front.template')

@section('head')
    @parent

@endsection

@section('main')

<main id="mainArea">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-4 offset-xl-4 pb-3 border-left border-bottom border-right">
                <div class="row mt-4">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.used.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.used.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.transportation.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.transportation.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.bus_arrival.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.bus_arrival.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.pick_up.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.pick_up.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                        <p class="text-md-left mt-2 mb-2">バスの方は洲本ICのバス停に送迎を行います。</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.services.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.services.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                        <p class="text-md-left mt-2 mb-0">入浴時間約30分</p>
                        <p class="text-md-left mb-2">(全体の滞在時間約90分)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.sex.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.sex.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <p class="text-md-left pt-2">{{config('booking.age.label')}}</p>
                    </div>
                    <div class="col-9">
                        <div class="row pb-0">
                            <div class="col-4 pl-0">
                                <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0">{{config('booking.age.age1')}}</button>
                                <button type="button" class="btn btn-block btn-warning text-dark mt-2">{{config('booking.age.age3')}}</button>
                            </div>
                            <div class="col-8 pl-0">
                                <button type="button" class="btn btn-block btn-outline-warning text-dark mt-1 mx-0">{{config('booking.age.age2')}}</button>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <select class="custom-select">
                                            @foreach(config('booking.age.options') as $key => $value)
                                                <option>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.date.label')}}</p>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control" id="pwd" value="2019/9/20(金)" />
                            </div>
                            
                            <div class="col-2 pl-0 ">
                                <button  class="btn p-0">
                                    <i class="fa fa-calendar-alt fa-2x"></i> 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.time.label')}}</p>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control" id="pwd" value="13:45" />
                            </div>
                            
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.lunch.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.lunch.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                        <p class="text-md-left mt-2 mb-2">ランチは11:30からです</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.whitening.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.whitening.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.pet.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.pet.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <p class="text-md-left pt-2">{{config('booking.room.label')}}</p>
                    </div>
                    <div class="col-7">
                        <select class="custom-select">
                            @foreach(config('booking.room.options') as $key => $value)
                                <option>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-6">
                        <button type="button" class="btn btn-block btn-warning text-white">予約追加</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-block btn-warning text-white">予約確認へ</button>
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

