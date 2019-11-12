@extends('sunsun.admin.template')
@section('title', '予約管理サイト（週間表示）')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/weekly.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="container">
        <div class="breadcrumb-sunsun">
            @include('sunsun.admin.layouts.breadcrumb')
        </div>
        <div class="main-head">
        </div>
        <div class="main-content">
            <div class="main-content-head">
                <div class="left-content">
                <span class="datepicker-control week-picker" id="week-picker-wrapper">
                        ≪ <input type="text" value="{{$date_from.' - '.$date_to}}" class="" style="width: 12.8rem;"> ≫
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
                        <li>ー：定休日</li>
                    </ul>
                </div>
            </div>

            <table class="table-weekly">
                <thead>
                <tr>
                    <th class=""></th>
                    <th class="">9(月)</th>
                    <th class="">10(火)</th>
                    <th class=""></th>
                    <th class="">13(金)</th>
                    <th class="">14(土)</th>
                    <th class="">15(日)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>

                    </td>
                    <td>
                        <div class="table-weekly__thead">
                            <div class="item item-1">
                                <span class="male-head">
                                    男
                                </span>
                            </div>
                            <div class="item item-2">
                                <span class="female-head">
                                    女
                                </span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-head">
                                    Pet
                                </span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-head">
                                    WT
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__thead">
                            <div class="item item-1">
                                <span class="male-head">
                                    男
                                </span>
                            </div>
                            <div class="item item-2">
                                <span class="female-head">
                                    女
                                </span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-head">
                                    Pet
                                </span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-head">
                                    WT
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="node-day-off">
                            <span>水</span> <br>
                            <span>・</span> <br>
                            <span>木</span> <br>
                            <span></span> <br>
                            <span>定</span> <br>
                            <span>休</span> <br>
                            <span>日</span>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__thead">
                            <div class="item item-1">
                                <span class="male-head">
                                    男
                                </span>
                            </div>
                            <div class="item item-2">
                                <span class="female-head">
                                    女
                                </span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-head">
                                    Pet
                                </span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-head">
                                    WT
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__thead">
                            <div class="item item-1">
                                <span class="male-head">
                                    男
                                </span>
                            </div>
                            <div class="item item-2">
                                <span class="female-head">
                                    女
                                </span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-head">
                                    Pet
                                </span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-head">
                                    WT
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__thead">
                            <div class="item item-1">
                                <span class="male-head">
                                    男
                                </span>
                            </div>
                            <div class="item item-2">
                                <span class="female-head">
                                    女
                                </span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-head">
                                    Pet
                                </span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-head">
                                    WT
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="head-content" colspan="3">朝</td>
                    <td></td>
                    <td class="head-content" colspan="3">朝</td>
                </tr>
                <tr>
                    <td>9:45 <br>
                        (10:00～11:30)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-x">ー</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-x">ー</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-x">ー</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-x">ー</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-x">ー</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-x">ー</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-x">ー</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-x">ー</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-x">ー</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-x">ー</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>10:15
                        <br>(10:30～12:00)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>10:45
                        <br>(11:00～12:30)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>

                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="head-content" colspan="3">昼</td>
                    <td></td>
                    <td class="head-content" colspan="3">昼</td>
                </tr>
                <tr>
                    <td>13:15
                        <br>(13:30～15:00)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>13:45
                        <br>(14:00～15:30)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>

                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>14:15
                        <br>(14:30～16:00)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="head-content" colspan="3">メンテナンス</td>
                    <td></td>
                    <td class="head-content" colspan="3">メンテナンス</td>
                </tr>
                <tr>
                    <td>15:15
                        <br>(15:30～17:00)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>15:45
                        <br>(16:00～17:30)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>

                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>16:15
                        <br>(16:30～18:00
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="head-content" colspan="3">夜</td>
                    <td></td>
                    <td class="head-content" colspan="3">夜</td>
                </tr>
                <tr>
                    <td>17:45
                        <br>(18:00～19:30)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>

                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>18:15
                        <br>(18:30～20:00)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">x</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">c</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-0">x</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-0">x</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content  color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>18:45
                        <br>(19:00～20:30)
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>

                    <td></td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">x</span>
                            </div>
                        </div>
                    </td>
                    <td>

                        <div class="table-weekly__content">
                            <div class="item item-1">
                                <span class="male-content color-male-1">2</span>
                            </div>
                            <div class="item item-2">
                                <span class="female-content color-female-1">〇</span>
                            </div>
                            <div class="item item-3">
                                <span class="pet-content color-pet-1" rowspan="2">〇</span>
                            </div>
                            <div class="item item-4">
                                <span class="wt-content color-wt" rowspan="2">〇</span>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>


            <div class="main-content-content" style="display: none">
                <div class="line1">
                    <div class="bo-bottom">&#160;</div>
                    <div class="title-time">&#160;</div>
                    <div class="title-time">9:30</div>
                    <div class="title-time">10:00</div>
                    <div class="title-time">10:30</div>
                    <div class="title-time">11:00</div>
                    <div class="title-time">13:30</div>
                    <div class="title-time">14:00</div>
                    <div class="title-time">14:30</div>
                    <div class="title-time">15:30</div>
                    <div class="title-time">16:00</div>
                    <div class="title-time">16:30</div>
                    <div class="title-time">18:00</div>
                    <div class="title-time">18:30</div>
                    <div class="title-time title-bottom">19:00</div>
                </div>
                <div class="line2 bo-left">
                    <div class="bo-bottom">9 (月)</div>
                    <table>
                        <thead>
                        <tr class="content-head">
                            <th class="male-head">男</th>
                            <th class="female-head">女</th>
                            <th class="pet-head">Pet</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="content-content">
                            <td class="male-content color-x">ー</td>
                            <td class="female-content color-x">ー</td>
                            <td class="pet-content color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">×</td>
                            <td class="female-content color-female-0">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">２</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">１</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">３</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content  color-male-0">〇</td>
                            <td class="female-content color-female-0">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="line3 bo-left">
                    <div class="bo-bottom">10 (火)</div>
                    <table>
                        <thead>
                        <tr class="content-head">
                            <th class="male-head">男</th>
                            <th class="female-head">女</th>
                            <th class="pet-head">Pet</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="content-content">
                            <td class="male-content color-x">ー</td>
                            <td class="female-content color-x">ー</td>
                            <td class="pet-content color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">×</td>
                            <td class="female-content color-female-0">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">２</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">１</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">３</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content  color-male-0">〇</td>
                            <td class="female-content color-female-0">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="line4 bo-left">
                    <div class="bo-bottom">11 (水)</div>
                    <table>
                        <thead>
                        <tr class="content-head">
                            <th class="male-head">男</th>
                            <th class="female-head">女</th>
                            <th class="pet-head">Pet</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="content-content">
                            <td class="male-content color-x">ー</td>
                            <td class="female-content color-x">ー</td>
                            <td class="pet-content color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">×</td>
                            <td class="female-content color-female-0">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">２</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">１</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">３</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content  color-male-0">〇</td>
                            <td class="female-content color-female-0">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="line5 bo-left">
                    <div class="bo-bottom">12(木)</div>
                    <table>
                        <thead>
                        <tr class="content-head">
                            <th class="male-head">男</th>
                            <th class="female-head">女</th>
                            <th class="pet-head">Pet</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="content-content">
                            <td class="male-content color-x">ー</td>
                            <td class="female-content color-x">ー</td>
                            <td class="pet-content color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">×</td>
                            <td class="female-content color-female-0">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">２</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">１</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">３</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content  color-male-0">〇</td>
                            <td class="female-content color-female-0">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="line6 bo-left">
                    <div class="bo-bottom">13(金)</div>
                    <table>
                        <thead>
                        <tr class="content-head">
                            <th class="male-head">男</th>
                            <th class="female-head">女</th>
                            <th class="pet-head">Pet</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="content-content">
                            <td class="male-content color-x">ー</td>
                            <td class="female-content color-x">ー</td>
                            <td class="pet-content color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">×</td>
                            <td class="female-content color-female-0">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">２</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">１</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">３</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content  color-male-0">〇</td>
                            <td class="female-content color-female-0">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="line7 bo-left">
                    <div class="bo-bottom">14 (土)</div>
                    <table>
                        <thead>
                        <tr class="content-head">
                            <th class="male-head">男</th>
                            <th class="female-head">女</th>
                            <th class="pet-head">Pet</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="content-content">
                            <td class="male-content color-x">ー</td>
                            <td class="female-content color-x">ー</td>
                            <td class="pet-content color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">×</td>
                            <td class="female-content color-female-0">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">２</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">１</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">３</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content  color-male-0">〇</td>
                            <td class="female-content color-female-0">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="line8 bo-left">
                    <div class="bo-bottom">15 (日)</div>
                    <table>
                        <thead>
                        <tr class="content-head">
                            <th class="male-head">男</th>
                            <th class="female-head">女</th>
                            <th class="pet-head">Pet</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="content-content">
                            <td class="male-content color-x">ー</td>
                            <td class="female-content color-x">ー</td>
                            <td class="pet-content color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">×</td>
                            <td class="female-content color-female-0">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">２</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">×</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">２</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">１</td>
                            <td class="female-content color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">２</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">３</td>
                            <td class="pet-content  color-pet-1" rowspan="2">〇</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">３</td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-0">〇</td>
                            <td class="female-content  color-female-0">〇</td>
                            <td class="pet-content  color-pet-0"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content  color-male-0">〇</td>
                            <td class="female-content color-female-0">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        <tr class="content-content">
                            <td class="male-content color-male-1">〇</td>
                            <td class="female-content color-female-1">〇</td>
                            <td class="pet-content color-x"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
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

