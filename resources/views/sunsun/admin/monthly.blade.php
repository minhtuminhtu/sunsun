@extends('sunsun.admin.template')
@section('title', '予約管理サイト（月間表示）')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/monthly.css')}}">
@endsection

@section('main')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-head">
                        <div class="main-head__top">
                            <span class="current-monthly">≪ 2019/8 ≫</span>
                            <span class="icon-calendar">
                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"
                               class="fa fa-calendar-alt"></i>
                        </span>
                            <a class="control-month prev-month" href="">≪前月</a>
                            <a class="control-month next-month" href="">翌月≫</a>
                        </div>
                        <div class="main-head__middle">

                        </div>
                    </div>
                    <div class="main-content">
                        <div class="main-content__table">
                            <div class="table-monthly">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class=""></th>
                                        <th class="" colspan="3">月</th>
                                        <th class="" colspan="3">火</th>
                                        <th class="" colspan="3">水</th>
                                        <th class="" colspan="3">木</th>
                                        <th class="" colspan="3">金</th>
                                        <th class="" colspan="3">土</th>
                                        <th class="" colspan="3">日</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="">9:45 <br> (10:00 -11:30)</td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="main-footer">

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

@endsection

