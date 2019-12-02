@extends('sunsun.admin.template')
@section('title', '予約管理サイト（週間表示）')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/weekly.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main>
        <div class="container"></div>
        <div class="container-90">
            <div class="breadcrumb-sunsun">
                @include('sunsun.admin.layouts.breadcrumb')
            </div>
            <div class="main-head">
            </div>
            <div class="main-content">
                <div class="main-content-head">
                    <div class="left-content">
                    <span class="datepicker-control week-picker" id="week-picker-wrapper">
                            ≪ <input type="text" readonly="readonly" value="{{$date_from.' - '.$date_to}}" class="bg-white" style="width: 12.8rem;"> ≫
                            <span class="icon-calendar">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"
                                class="fa fa-calendar-alt js-calendar-day">
                                </i>
                            </span>
                    </span>
                        <a class="control-date week-prev" href="javascript:void(0)">≪前週</a>
                        <a class="control-date week-next" href="javascript:void(0)">翌週≫</a>
                        <input type="hidden" value="{{$date_from}}" id="date_start_week">
                    </div>
                    <div class="right-content">
                        <ul>
                            <li>〇：全床空き</li>
                            <li>２：残床数</li>
                            <li>×：満床</li>
                        </ul>
                    </div>
                </div>
                <div class="weekly">
                    <div class="weekly-time first head"></div>
                    <div class="weekly-table">
                        <div class="table-header head">
                            @foreach($day_range as $day)
                                @if(($day['week_day'] != '水') && ($day['week_day'] != '木'))
                                <div class="table-col first">
                                    <div class="font-bold">{{ $day['month'] .'月' . $day['day'] . '日' . '(' . $day['week_day'] . ')' }}</div>
                                </div>
                                @elseif($day['week_day'] == '水')
                                <div class="table-col-none first">
                                    <div class="free_time">水<br>・<br>木<br><br>定<br>休<br>日</div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="weekly">
                    <div class="weekly-time body">
                        <div>
                        時間
                        </div>
                    </div>
                    <div class="weekly-table body">
                        <div class="table-header">
                            @foreach($day_range as $day)
                                @if(($day['week_day'] != '水') && ($day['week_day'] != '木'))
                                <div class="title table-col">
                                    <div class="table-data">
                                        <div class="data-col title male-title">
                                        男
                                        </div>
                                        <div class="data-col title female-title">
                                        女
                                        </div>
                                        <div class="data-col title wt-title">
                                        WT 
                                        </div>
                                        <div class="data-col title pet-title">
                                        Pet
                                        </div>
                                    </div>
                                </div>
                                @elseif($day['week_day'] == '水')
                                <div class="title table-col-none">
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @php $i = 0; @endphp
                @foreach($time_range as $key => $time)
                    @php $i++; @endphp
                    @if(($time['time'] != '') || ($time['time_range'] != '')) 
                        <div class="weekly">
                            <div class="weekly-time body-content content 
                            @php 
                            if($key == (count($time_range) - 1)){ 
                                echo ' last '; 
                            }  
                            if(isset($time['week_bottom'])){ 
                                if($time['week_bottom'] == 2){
                                    echo ' week_bottom_boder '; 
                                }else{
                                    echo ' week_bottom '; 
                                }
                            }
                            @endphp">
                                @if($time['time'] != '')
                                    <div class="time">{{ $time['time'] }}</div>
                                @else
                                    <div class="time" style="visibility: hidden;">.</div>
                                @endif
                                <div class="time_range">{{ '(' . $time['time_range'] . ')' }}</div>
                            </div>
                            <div class="weekly-table">
                                <div class="table-header content">
                                    @foreach($day_range as $day)
                                        @if(($day['week_day'] != '水') && ($day['week_day'] != '木'))
                                        <div class="table-col body-content content @php if($key == (count($time_range) - 1)){ echo 'last'; }  @endphp">
                                            <div class="table-data">
                                                @if($time['time'] == '')
                                                    <div class="data-col bg-free 
                                                    @php
                                                    if(isset($time['week_bottom'])){ 
                                                        if($time['week_bottom'] == 2){
                                                            echo ' week_bottom_boder '; 
                                                        }else{
                                                            echo ' week_bottom '; 
                                                        }
                                                    }
                                                    @endphp"></div>
                                                    <div class="data-col bg-free 
                                                    @php
                                                    if(isset($time['week_bottom'])){ 
                                                        if($time['week_bottom'] == 2){
                                                            echo ' week_bottom_boder '; 
                                                        }else{
                                                            echo ' week_bottom '; 
                                                        }
                                                    }
                                                    @endphp"></div>
                                                @else
                                                    <div class="data-col bg-male 
                                                        @php 
                                                        if($i%2 == 0){ 
                                                            echo 'bg-male-new'; 
                                                        }
                                                        if($key == (count($time_range) - 1)){ 
                                                            echo ' last '; 
                                                        }
                                                        if(isset($time['week_bottom'])){ 
                                                            if($time['week_bottom'] == 2){
                                                                echo ' week_bottom_boder '; 
                                                            }else{
                                                                echo ' week_bottom '; 
                                                            }
                                                        }
                                                        
                                                        @endphp">
                                                        @include('sunsun.admin.layouts.weekly_data', ['type' => 'male'])
                                                    </div>
                                                    <div class="data-col bg-female 
                                                        @php 
                                                        if($i%2 == 0){ 
                                                            echo 'bg-female-new'; 
                                                        } 
                                                        if($key == (count($time_range) - 1)){ 
                                                            echo ' last '; 
                                                        }
                                                        if(isset($time['week_bottom'])){ 
                                                            if($time['week_bottom'] == 2){
                                                                echo ' week_bottom_boder '; 
                                                            }else{
                                                                echo ' week_bottom '; 
                                                            }
                                                        }
                                                        @endphp">
                                                        @include('sunsun.admin.layouts.weekly_data', ['type' => 'female'])
                                                    </div>
                                                @endif
                                                
                                                @if(isset($time['not_wt']))
                                                <div class="data-col bg-wt_free 
                                                    @php 
                                                    if($key == (count($time_range) - 1)){ 
                                                        echo ' last '; 
                                                    }  
                                                    if(isset($time['week_bottom'])){ 
                                                        if($time['week_bottom'] == 2){
                                                            echo ' week_bottom_boder '; 
                                                        }else{
                                                            echo ' week_bottom '; 
                                                        }
                                                    }
                                                    @endphp">
                                                </div>
                                                @else
                                                <div class="data-col bg-wt 
                                                    @php 
                                                    if($i%2 == 1){ 
                                                        echo 'bg-wt-new'; 
                                                    } 
                                                    if(isset($time['week_bottom'])){ 
                                                        if($time['week_bottom'] == 2){
                                                            echo ' week_bottom_boder '; 
                                                        }else{
                                                            echo ' week_bottom '; 
                                                        }
                                                    }
                                                    @endphp">
                                                    @include('sunsun.admin.layouts.weekly_data', ['type' => 'wt'])
                                                </div>
                                                @endif
                                                

                                                @if(isset($time['pet_time_type']))
                                                    @if($time['pet_time_type'] == 1)
                                                    <div class="data-col bg-pet pet-col_first">
                                                        <div class="pet-data_ab">
                                                            <div>
                                                            @include('sunsun.admin.layouts.weekly_data', ['type' => 'pet'])
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="data-col bg-pet pet-col_second
                                                    @php
                                                    if(isset($time['week_bottom'])){ 
                                                        if($time['week_bottom'] == 2){
                                                            echo ' week_bottom_boder '; 
                                                        }else{
                                                            echo ' week_bottom '; 
                                                        }
                                                    }
                                                    @endphp
                                                    ">
                                                    </div>
                                                    @endif
                                                @else
                                                <div class="data-col 
                                                    @if(isset($time['pet_begin'])) pet_begin @endif
                                                    @php
                                                    if(isset($time['week_bottom'])){ 
                                                        if($time['week_bottom'] == 2){
                                                            echo ' week_bottom_boder '; 
                                                        }else{
                                                            echo ' week_bottom '; 
                                                        }
                                                    }
                                                    @endphp
                                                    ">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @elseif($day['week_day'] == '水')
                                        <div class="table-col-none @php if($key == (count($time_range) - 1)){ echo ' last '; }  @endphp"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        
        <div class="main-footer">

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
    <script src="{{asset('sunsun/admin/js/admin.js').config('version_files.html.js')}}"></script>
    <script src="{{asset('sunsun/admin/js/weekly.js').config('version_files.html.js')}}"></script>

@endsection

