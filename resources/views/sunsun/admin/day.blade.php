@extends('sunsun.admin.template')
@section('title', '予約管理サイト（１日表示）')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/day.css')}}">
@endsection
@section('main')
    <main>
        <div class="container">   
        </div>
        <div class="container-90">
            <div class="breadcrumb-sunsun">
                @include('sunsun.admin.layouts.breadcrumb')
            </div>
            <div class="main-head">
                <div class="main-head__top" style="display: flex">
                    <span class="datepicker-control current-date">
                        ≪ <input type="text" value="{{$date}}"> ≫
                        <span class="icon-calendar">
                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"
                               class="fa fa-calendar-alt">
                            </i>
                        </span>
                    </span>
                    <span style="    margin-left: 5px;margin-right: 5px;"> <a class="control-date prev-date" href="javascript:void(0)">≪前日</a></span>
                   <span><a class="control-date next-date" href="javascript:void(0)">翌日≫</a></span>
                    <span class="node-day">
                        <span>入浴：酵素浴　リ：1日リフレッシュプラン</span> <br>
                        <span>貸切：酵素部屋1部屋貸切プラン　断食：断食プラン</span>
                    </span>
                </div>
                <div class="main-head__middle">
                    <div class="middle_box">
                        <div class="item">
                            <span class="customer-name">【送迎】</span> <br>
                            @foreach($pick_up as $pu)
                            <span class="customer-time">{{  $pu->bus_arrive_time_slide }}　{{  $pu->name }} 様　@if($pu->num_user!=NULL) 同行者{{ $pu->num_user }}名 @endif</span><br>
                            @endforeach
                        </div>
                    </div>
                    <div class="middle_box">
                        <div class="item">
                            @php
                            $number_lunch = count($lunch);
                            foreach($lunch as $lu){
                                if(isset($lu->lunch_guest_num)){
                                    $number_lunch += $lu->lunch;
                                    $number_lunch -= 1;
                                }
                            }
                            @endphp
                            <span>【昼食】　{{ $number_lunch }}食</span> <br>
                            @foreach($lunch as $lu)
                            @if(isset($lu->ref_booking_id))
                            <span>{{ $lu->name }} 同行者 様　{{ isset($lu->lunch_guest_num)?"同行者".$lu->lunch."名":""}}</span> <br>
                            @else
                            <span>{{ $lu->name }} 様　{{ isset($lu->lunch_guest_num)?"同行者".$lu->lunch."名":""}}</span> <br>
                            @endif
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="middle_box">
                        <div class="item">
                            <span>【宿泊】</span> <br>
                            <span>A：{{ isset($stay_room['A'])?$stay_room['A']->name." 様     ".$stay_room['A']->stay_guest_num:"" }}</span> <br>
                            <span>B：{{ isset($stay_room['B'])?$stay_room['B']->name." 様     ".$stay_room['B']->stay_guest_num:"" }}</span> <br>
                            <span>C：{{ isset($stay_room['C'])?$stay_room['C']->name." 様     ".$stay_room['C']->stay_guest_num:"" }}</span> <br>
                        </div>
                    </div>
                    <div class="middle_box">
                        <div class="item">
                            @php
                            $room_a = isset($stay_room['A']->breakfast)?$stay_room['A']->breakfast:intval(0);
                            $room_b = isset($stay_room['B']->breakfast)?$stay_room['B']->breakfast:intval(0);
                            $room_c = isset($stay_room['C']->breakfast)?$stay_room['C']->breakfast:intval(0);
                            @endphp
                            <span>【モーニング】　{{ $room_a + $room_b + $room_c }}食</span> <br>
                            <span>A：{{ isset($stay_room['A']->breakfast)?$stay_room['A']->name." 様     ".$stay_room['A']->breakfast."名":"" }}</span> <br>
                            <span>B：{{ isset($stay_room['B']->breakfast)?$stay_room['B']->name." 様     ".$stay_room['B']->breakfast."名":"" }}</span> <br>
                            <span>C：{{ isset($stay_room['C']->breakfast)?$stay_room['C']->name." 様     ".$stay_room['C']->breakfast."名":"" }}</span> <br>
                        </div>
                    </div>

                </div>
            </div>
            <div class="main-content">
                <div class="main-content__table">
                    <div class="main-col__time head bg-time-male">時間</div>
                    <div class="main-col__male">
                        <div class="main-col__item head bg-time-male js-edit-booking">
                        男性①
                        </div>
                        <div class="main-col__item head bg-time-male">
                        男性②
                        </div>
                        <div class="main-col__item head bg-time-male">
                        男性③
                        </div>
                    </div>
                    <div class="main-col__space-1"></div>
                    <div class="main-col__famale">
                        <div class="main-col__item head bg-female">
                        女性①
                        </div>
                        <div class="main-col__item head bg-female">
                        女性②
                        </div>
                        <div class="main-col__item head bg-female">
                        女性③
                        </div>
                        <div class="main-col__item head bg-female">
                        女性④
                        </div>
                    </div>
                    <div class="main-col__space-2"></div>
                    <div class="main-col__pet head bg-pet-wt">ペット浴</div>
                    <div class="main-col__space-3"></div>
                    <div class="main-col__wt head bg-pet-wt">ホワイトニング</div>
                </div>
                @php $i = 0; @endphp
                @foreach($time_range as $time)
                    @php $i++; @endphp
                    @if($time['begin_time'] == NULL)
                    <div class="main-content__table">
                        <div class="main-col__time @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp d-flex justify-content-center align-items-center">
                            <div class="">
                                <div class="time">{{ $time['time'] }}</div>
                                <div class="time_range">{{ '(' . $time['time_range'] . ')' }}</div>
                            </div>
                        </div>
                        <div class="main-col__male">
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_1'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_2'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_3'])
                            </div>
                        </div>
                        <div class="main-col__space-1"></div>
                        <div class="main-col__famale">
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_1'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_2'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_3'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_4'])
                            </div>
                        </div>
                        <div class="main-col__space-2"></div>
                        @if($time['other_time'] != NULL)
                        <div class="main-col__pet">
                            <div class="main-col__pet__header">
                                <div class="heading-pet-wt">
                                    <div class="heading-pet-wt-data">
                                    {{$time['other_time']}}
                                    </div>
                                </div>
                            </div>
                            <div class="main-col__pet__body main-col__data">
                                <div class="padding-pet-wt">
                                    @include('sunsun.admin.layouts.day_data', ['row' => 'pet'])
                                </div>
                            </div>
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt">
                            <div class="main-col__pet__header">
                                <div class="heading-pet-wt">
                                    <div class="heading-pet-wt-data">
                                    {{$time['other_time']}}
                                    </div>
                                </div>
                            </div>
                            <div class="main-col__pet__body main-col__data">
                                <div class="padding-pet-wt">
                                    @include('sunsun.admin.layouts.day_data', ['row' => 'wt'])
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="main-col__pet space-white">
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt space-white">
                        </div>
                        @endif
                    </div>
                    @elseif($time['begin_time'] == 1)
                    <div class="main-content__table">
                        <div class="main-col__time @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp d-flex justify-content-center align-items-center">
                            <div class="">
                                <div class="time">{{ $time['time'] }}</div>
                                <div class="time_range">{{ '(' . $time['time_range'] . ')' }}</div>
                            </div>
                        </div>
                        <div class="main-col__male">
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_1'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_2'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_3'])
                            </div>
                        </div>
                        <div class="main-col__space-1"></div>
                        <div class="main-col__famale">
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_1'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_2'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_3'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_4'])
                            </div>
                        </div>
                        <div class="main-col__space-2"></div>
                        @if($time['other_time'] != NULL)
                        <div class="main-col__pet">
                            <div class="main-col__pet__header">
                                <div class="heading-pet-wt">
                                    <div class="heading-pet-wt-data">
                                    {{$time['other_time']}}
                                    </div>
                                </div>
                            </div>
                            <div class="main-col__pet__body main-col__data">
                                <div class="padding-pet-wt">
                                    @include('sunsun.admin.layouts.day_data', ['row' => 'pet'])
                                </div>
                            </div>
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt">
                            <div class="main-col__pet__header">
                                <div class="heading-pet-wt">
                                    <div class="heading-pet-wt-data">
                                    {{$time['other_time']}}
                                    </div>
                                </div>
                            </div>
                            <div class="main-col__pet__body main-col__data">
                                <div class="padding-pet-wt">
                                    @include('sunsun.admin.layouts.day_data', ['row' => 'wt'])
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="main-col__pet space-white">
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt space-white">
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="main-content__table">
                        <div class="main-col__time-male">
                            <div class="begin_time">
                            {{ $time['begin_time'] }}
                            </div>
                        </div>
                        <div class="main-col__space-1"></div>
                        <div class="main-col__new-famale">
                            <div class="begin_time new">
                            {{ $time['begin_time'] }}
                            </div>
                        </div>
                        <div class="main-col__space-2"></div>
                        @if($time['other_time'] != NULL)
                        <div class="main-col__pet">
                            <div class="heading-pet-wt">
                                <div class="heading-pet-wt-data">
                                {{$time['other_time']}}
                                </div>
                            </div>
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt">
                            <div class="heading-pet-wt">
                                <div class="heading-pet-wt-data">
                                {{$time['other_time']}}
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="main-col__pet space-white">
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt space-white">
                        </div>
                        @endif
                    </div>
                    <div class="main-content__table">
                        <div class="main-col__time @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp d-flex justify-content-center align-items-center">
                            <div class="">
                                <div class="time">{{ $time['time'] }}</div>
                                <div class="time_range">{{ '(' . $time['time_range'] . ')' }}</div>
                            </div>
                        </div>
                        <div class="main-col__male">
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_1'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_2'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-time-male'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'male_3'])
                            </div>
                        </div>
                        <div class="main-col__space-1"></div>
                        <div class="main-col__famale">
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_1'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_2'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_3'])
                            </div>
                            <div class="main-col__item main-col__data @php if($i%2 == 0){ echo 'bg-female'; } @endphp">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'female_4'])
                            </div>
                        </div>
                        <div class="main-col__space-2"></div>
                        @if($time['pin_time'] == 1)
                        <div class="main-col__pet bg-pet-wt main-col__data">
                            <div class="padding-pet-wt">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'pet'])
                            </div>
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt bg-pet-wt main-col__data">
                            <div class="padding-pet-wt">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'wt'])
                            </div>
                        </div>
                        @else
                        <div class="main-col__pet space-white">
                        </div>
                        <div class="main-col__space-3"></div>
                        <div class="main-col__wt space-white">
                        </div>
                        @endif
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="main-footer">
            </div>
        </div>
    </main>

@endsection


@section('footer')
    @parent
    <div class="modal" id="edit_booking">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-view">
                <!-- Modal body -->
                <div class="mail-booking">

                </div>

                <!-- Modal footer -->
               {{-- <div class="modal-footer" style="padding: 10px;">
                    <button type="button" class="btn btn-modal-left text-white color-primary" id="edit_booking" style="padding: 0.375rem 2rem;">
                        保存
                    </button>
                    <button type="button" class="btn btn-outline-dark  btn-modal-right" style="padding: 0.375rem 1rem;"
                            data-dismiss="choice_date_time" data-target="#edit_booking" data-toggle="modal"
                            data-backdrop="static" data-keyboard="false">
                        閉じる
                    </button>
                </div>--}}

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
    <script src="{{asset('sunsun/admin/js/day.js').config('version_files.html.js')}}"></script>
@endsection

