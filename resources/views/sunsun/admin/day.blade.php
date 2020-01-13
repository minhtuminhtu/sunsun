@extends('sunsun.admin.template')
@section('title', '予約管理サイト（１日表示）')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/day.css')}}">

@endsection
@section('main')
    @include('sunsun.front.parts.booking_modal')
    <main>
        <div class="container">
        </div>
        <div class="container-90">
            <div class="breadcrumb-sunsun">
                @include('sunsun.admin.layouts.breadcrumb')
            </div>
            <div class="main-head">
                <div class="main-head__top" style="display: flex;justify-content: space-between;">
                    <div class="">
                    </div>
                    <div class="">
                        <div class="control-view">
                            <div class="control-align_center button-control">
                                <button class="btn btn-block btn-main control-date" id="go-weekly">週間表示</button>
                            </div>
                            <div class="control-align_center button-control">
                                <button class="btn btn-block btn-main control-date" id="go-monthly">月間表示</button>
                            </div>
                            <div class="control-align_center button-control">
                                <button class="btn btn-block btn-main control-date" id="go-user">ユーザー 管理</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-head__top" style="display: flex;">
                    <div class="main-head__left">
                        <div class="control-view">
                            <div class="control-align_center">
                                <button class="btn btn-block btn-main control-date control-date-left prev-date" href="javascript:void(0)">〈  前日</button>
                            </div>
                            <div class="control-align_center day-width__value">
                                <span class="">
                                    <input class="bg-white input-date__value" id="input-current__date" readonly="readonly" type="text" value="{{$date}}">
                                </span>
                            </div>
                            <div class="control-align_center">
                                <span class="" id="button-current__date">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar-alt icon-calendar"></i>
                                </span>
                            </div>
                            <div class="control-align_center">
                                <button class="btn btn-block btn-main control-date control-date-right next-date" href="javascript:void(0)">翌日 〉</button>
                            </div>
                        </div>
                        <div class="node-day">
                            <div class="text-right">入浴：酵素浴　リ：1日リフレッシュプラン</div>
                            <div class="text-right">貸切：酵素部屋1部屋貸切プラン　断食：断食プラン</div>
                        </div>
                    </div>
                    <div class="main-head_right">
                        <div class="bs-example">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="予約名前" name="search" id="search" disabled>
                                    <div class="input-group-append search-button"></div>
                                </div>
                                <ul class="list-group name-search list-result" id="result">
                                </ul>
                        </div>
                    </div>
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
                    <div class="main-col__time head">時間</div>
                    <div class="main-col__male">
                        <div class="main-col__item head bg-title__male js-edit-booking">
                        男性①
                        </div>
                        <div class="main-col__item head bg-title__male">
                        男性②
                        </div>
                        <div class="main-col__item head bg-title__male">
                        男性③
                        </div>
                    </div>
                    <div class="main-col__space-1 head"></div>
                    <div class="main-col__famale">
                        <div class="main-col__item head bg-title__female first">
                        女性①
                        </div>
                        <div class="main-col__item head bg-title__female">
                        女性②
                        </div>
                        <div class="main-col__item head bg-title__female">
                        女性③
                        </div>
                        <div class="main-col__item head bg-title__female last">
                        女性④
                        </div>
                    </div>
                    <div class="main-col__space-2 head"></div>
                    <div class="main-col__wt head bg-title__wt">ホワイトニング</div>
                    <div class="main-col__space-3"></div>
                    <div class="main-col__pet head bg-title__pet">ペット酵素浴</div>
                </div>
                @php $i = 1; @endphp
                @foreach($time_range as $time)
                    @php $i++; @endphp
                    <div class="main-content__table">
                        <div class="main-col__time d-flex justify-content-center align-items-center
                            @php
                            if($i == (count($time_range) + 1) ){ echo ' bottom'; }
                            if(isset($time['first_free'])){
                                echo ' first_free';
                            }
                            if(isset($time['begin_free'])){
                                echo ' begin_free ';
                            }
                            if($i%2 == 0){ echo ' bg-time '; }
                            if(isset($time['begin_time'])){
                                echo ' bg-time ';
                            }



                            @endphp">

                            <div class="">
                                <div class="time">{{ $time['time'] }}</div>
                                @if($time['time_range'] != '')
                                    <div class="time_range">{{ '(' . $time['time_range'] . ')' }}</div>
                                @else
                                    <div class="time_range" style="visibility: hidden;">.</div>
                                @endif
                            </div>
                        </div>
                        @if($time['time'] == '')
                            <div class="main-col__male">
                                <div class="main-col__item main-col__data bg-free
                                    @if(isset($time['first_free'])) first_free @endif
                                    @php
                                    if(isset($time['body_free'])){
                                        echo ' body_free';
                                    }
                                    @endphp
                                ">
                                </div>
                                <div class="main-col__item main-col__data bg-free
                                    @if(isset($time['first_free'])) first_free @endif
                                    @php
                                        if(isset($time['body_free'])){
                                            echo ' body_free';
                                        }
                                    @endphp
                                ">
                                </div>
                                <div class="main-col__item main-col__data bg-free
                                    @if(isset($time['first_free'])) first_free @endif
                                     @php
                                    if(isset($time['body_free'])){
                                            echo ' body_free';
                                        }
                                    @endphp
                                ">
                                </div>
                            </div>
                            <div class="main-col__space-1 bg-free
                                @if(isset($time['first_free'])) first_free @endif
                                @php
                                    if(isset($time['body_free'])){
                                        echo ' body_free';
                                    }
                                @endphp
                            "></div>
                            <div class="main-col__famale">
                                <div class="main-col__item main-col__data bg-free
                                    @if(isset($time['first_free'])) first_free @endif
                                    @php
                                    if(isset($time['body_free'])){
                                        echo ' body_free';
                                    }
                                    @endphp
                                ">
                                @if(isset($time['begin_time']))
                                    <div class="begin_time_font">{{ $time['begin_time'] }}</div>
                                @endif
                                </div>
                                <div class="main-col__item main-col__data bg-free
                                    @if(isset($time['first_free'])) first_free @endif
                                    @php
                                        if(isset($time['body_free'])){
                                            echo ' body_free';
                                        }
                                    @endphp
                                ">
                                </div>
                                <div class="main-col__item main-col__data bg-free
                                    @if(isset($time['first_free'])) first_free @endif
                                    @php
                                        if(isset($time['body_free'])){
                                            echo ' body_free';
                                        }
                                    @endphp
                                ">
                                </div>
                                <div class="main-col__item main-col__data bg-free
                                    @if(isset($time['first_free'])) first_free @endif last
                                     @php
                                        if(isset($time['body_free'])){
                                            echo ' body_free';
                                        }
                                     @endphp
                                ">
                                </div>
                            </div>
                        @else
                            <div class="main-col__male">
                                <div class="main-col__item main-col__data
                                    @php
                                    if($i%2 == 0){ echo 'bg-male'; }
                                    if($i == (count($time_range) + 1) ){ echo ' bottom'; }
                                    if(isset($time['begin_free'])){
                                        echo 'begin_free';
                                    }
                                    @endphp
                                    ">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'male_1'])
                                </div>
                                <div class="main-col__item main-col__data
                                    @php
                                    if($i%2 == 0){ echo 'bg-male'; }
                                    if($i == (count($time_range) + 1) ){ echo ' bottom'; }
                                    if(isset($time['begin_free'])){
                                        echo 'begin_free';
                                    }
                                    @endphp
                                    ">
                                    @include('sunsun.admin.layouts.day_data', ['row' => 'male_2'])
                                </div>
                                <div class="main-col__item main-col__data
                                    @php if($i%2 == 0){ echo 'bg-male'; }
                                    if($i == (count($time_range) + 1) ){ echo ' bottom'; }
                                    if(isset($time['begin_free'])){
                                        echo 'begin_free';
                                    }
                                    @endphp
                                    ">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'male_3'])
                                </div>
                            </div>
                            <div class="main-col__space-1
                                @php
                                if($i == (count($time_range) + 1) ){
                                    echo ' bottom';
                                }
                                @endphp
                                "></div>
                            <div class="main-col__famale">
                                <div class="main-col__item main-col__data
                                    @php
                                    if($i%2 == 0){ echo 'bg-female'; }
                                    if($i == (count($time_range) + 1) ){
                                        echo ' bottom';
                                    }
                                    if(isset($time['begin_free'])){
                                        echo 'begin_free';
                                    }
                                    @endphp
                                    first">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'female_1'])
                                </div>
                                <div class="main-col__item main-col__data
                                    @php
                                    if($i%2 == 0){ echo 'bg-female'; }
                                    if($i == (count($time_range) + 1) ){
                                        echo ' bottom';
                                    }
                                    if(isset($time['begin_free'])){
                                        echo 'begin_free';
                                    }
                                    @endphp
                                    ">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'female_2'])
                                </div>
                                <div class="main-col__item main-col__data
                                    @php
                                    if($i%2 == 0){ echo 'bg-female'; }
                                    if($i == (count($time_range) + 1) ){
                                        echo ' bottom';
                                    }
                                    if(isset($time['begin_free'])){
                                        echo 'begin_free';
                                    }
                                    @endphp
                                    ">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'female_3'])
                                </div>
                                <div class="main-col__item main-col__data
                                    @php
                                    if($i%2 == 0){ echo ' bg-female'; }
                                    if($i == (count($time_range) + 1) ){
                                        echo ' bottom';
                                    }
                                    if(isset($time['begin_free'])){
                                        echo 'begin_free';
                                    }
                                    @endphp
                                    last">
                                @include('sunsun.admin.layouts.day_data', ['row' => 'female_4'])
                                </div>
                            </div>
                        @endif
                        <div class="main-col__space-2
                            @php
                            if(isset($time['begin_free'])){
                                echo 'begin_free';
                            }
                            @endphp
                            ">
                        </div>
                        @if(!isset($time['not_wt']))
                        <div class="main-col__wt
                            @php
                            if($i == (count($time_range) + 1) ){
                                echo ' bottom';
                            }
                            if(isset($time['begin_free'])){
                                echo 'begin_free';
                            }
                            if($i%2 == 0){
                                echo ' bg-wt ';
                            }
                            if(isset($time['wt_new_user'])){
                                echo ' wt-new_user ';
                            }

                            if(isset($time['begin_new_user'])){
                                echo ' begin_new_user ';
                            }
                            @endphp
                            @if(isset($time['first_free']))
                            first_free
                            @endif
                            @if(isset($time['end_new_user']))
                            end_new_user
                            @endif

                            ">
                            <div class="
                            @php
                            if(isset($time['wt_new_user'])){
                                echo ' wt-new_user ';
                            }
                            @endphp
                            " style="height: 100%;">
                            @include('sunsun.admin.layouts.day_data', ['row' => 'wt'])
                            </div>
                        </div>
                        @else
                        <div class="main-col__wt not-wt
                        @php
                            if($i == (count($time_range) + 1) ){
                                echo ' bottom';
                            }
                            if(isset($time['begin_free'])){
                                echo 'begin_free';
                            }
                            if($i%2 == 0){
                                echo ' bg-wt ';
                            }
                            if(isset($time['wt_new_user'])){
                                echo ' wt-new_user ';
                            }

                            if(isset($time['begin_new_user'])){
                                echo ' begin_new_user ';
                            }
                            @endphp
                            @if(isset($time['first_free']))
                            first_free
                            @endif
                            @if(isset($time['end_new_user']))
                            end_new_user
                            @endif">
                        </div>
                        @endif
                        <div class="main-col__space-3"></div>
                        @if(isset($time['pet_time_type']))
                            @if($time['pet_time_type'] == 1)
                            <div class="main-col__pet pet-col_first @if($i == 2) head-col_pet @endif">
                                <div class="pet-top_ele">
                                    <div class="pet-top_head">{{ $time['pet_time'] }}</div>
                                    <div class="pet-top_content">
                                        <div>
                                            @if(is_object($time['data']['pet']))
                                                @if(isset($time['data']['pet']->booking_id))
                                                    <input type="hidden" class="booking-id" value="{{ $time['data']['pet']->booking_id }}">
                                                @endif
                                                @if(isset($time['data']['pet']->ref_booking_id))
                                                    <span>{{ $time['data']['pet']->name }}同行者様</span>
                                                @else
                                                    <span>{{ $time['data']['pet']->name }}様</span>
                                                @endif
                                                <span class="text-red">{{ $time['data']['pet']->repeat_user }}</span>

                                                @if(isset($time['data']['pet']->booking_id))
                                                    <input type="hidden" class="booking-id" value="{{ $time['data']['pet']->booking_id }}">
                                                @endif

                                                @if(!isset($time['data']['pet']->ref_booking_id))
                                                    <br>
                                                    <span>{{ $time['data']['pet']->transport }}</span>
                                                    <span>{{ $time['data']['pet']->bus_arrive_time_slide }}</span>
                                                    <span class="text-red">{{ $time['data']['pet']->pick_up }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="main-col__pet pet-col_second">
                                <div class="pet-bottom_content">
                                    <div class="pet-bottom_content">
                                    @if(is_object($time['data']['pet']))
                                        @if(isset($time['data']['pet']->booking_id))
                                            <input type="hidden" class="booking-id" value="{{ $time['data']['pet']->booking_id }}">
                                        @endif
                                        <span>{{ $time['data']['pet']->service_pet_num }}匹 {{ $time['data']['pet']->notes }}</span>
                                        @if(!isset($time['data']['pet']->ref_booking_id))
                                            <br>
                                            <span>{{ $time['data']['pet']->phone }}</span>
                                            <br>
                                            <span>支払：{{ $time['data']['pet']->payment_method }}</span>
                                        @endif
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="main-col__pet pet-col_white space-white">
                            </div>
                        @endif

                    </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').prop("disabled", false);
            $('#search').keyup(function(event) {
                var searchField = $('#search').val();
                console.log(searchField.length);
                if(searchField.length == 0){
                    $('#result').html('');
                    // $('.search-button').html('');
                }else{
                    $('#result').html('');
                    var expression = new RegExp(searchField, "i");
                    var data =  @json($search);
                    $.each(data, function(key, value) {
                        if (value.name.search(expression) != -1){
                            $('#result').append('<li class="list-group-item link-class">'
                                                + "<input type='hidden' class='search-expert' value='" + JSON.stringify(value.expert_data) + "' />"
                                                + "<input type='hidden' class='search-element' value='" + value.name + "' />"
                                                + '<div class="name-field">' + value.name + '</div>'
                                                + '</li>');
                            load_search_event();

                        }
                    });
                    // $('.search-button').html('<div class="input-group-text"><i class="fas fa-times"></i></div>');
                }
            });
        });


    </script>


@endsection


