@extends('sunsun.admin.template')
@section('title', '予約管理サイト（週間表示）')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/admin.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/weekly.css').config('version_files.html.css')}}">
@endsection

@section('main')
<main class="container-fluid">
    <div class="main-head">
    </div>
    <div class="main-content">
        <div class="main-content-head">
            <div class="left-content">
                <a href="" class="week-title">≪</a>
                <span class="week-title">2019/8/20</span>
                <a href="" class="week-title">≫</a>
                <a href="" class="week-icon"><i class="fas fa-calendar-alt fa-2x"></i></a>
                <button type="button" class="btn week-button-control">≪前週</button>
                <button type="button" class="btn week-button-control">翌週≫</button>
            </div>
            <div class="right-content">
                <ul>
                    <li>〇：全床空き</li>
                    <li>２：残床数</li>
                    <li>ー：定休日</li>
                </ul>
            </div>
        </div>
        <div class="main-content-content">
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
    <script src="{{asset('sunsun/admin/js/admin.js').config('version_files.html.css')}}"></script>
    <script src="{{asset('sunsun/admin/js/weekly.js').config('version_files.html.css')}}"></script>
@endsection

