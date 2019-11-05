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
            <div class="breadcrumb-sunsun">
                @include('sunsun.admin.layouts.breadcrumb')
            </div>
            <div class="main-head">
                <div class="main-head__top">
                    <span class="datepicker-control current-date">
                        ≪ <input type="text" value="{{$date}}"> ≫
                        <span class="icon-calendar">
                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"
                               class="fa fa-calendar-alt">
                            </i>
                        </span>
                    </span>
                    <a class="control-date prev-date" href="javascript:void(0)">≪前日</a>
                    <a class="control-date next-date" href="javascript:void(0)">翌日≫</a>
                    <span class="node-day">入浴：酵素浴　リ：リフレッシュプラン</span>
                </div>
                <div class="main-head__middle">
                    <div class="middle_box">
                        <div class="item">
                            <span class="customer-name">【送迎】</span> <br>
                            <span class="customer-time">9:29　渋野日向子 様　同行者1名</span>

                        </div>
                    </div>
                    <div class="middle_box">
                        <div class="item">
                            <span>【昼食】　３食</span> <br>
                            <span>渋野日向子 様</span> <br>
                            <span>渋野日向子同行者 様</span> <br>
                            <span>石川遼 様</span>
                        </div>
                    </div>
                    <div class="middle_box">
                        <div class="item">
                            <span>【宿泊】</span> <br>
                            <span>A：渋野日向子 様　2名</span> <br>
                            <span>B：</span> <br>
                            <span>C：</span> <br>
                        </div>
                    </div>

                </div>
            </div>
            <div class="main-content">
                <div class="main-content__table">
                    <div class="table-human">
                        <table>
                            <thead>
                            <tr>
                                <th class="man odd"></th>
                                <th class="man odd">男性①</th>
                                <th class="man odd">男性②</th>
                                <th class="man odd">男性③</th>
                                <th class="odd space-table"></th>
                                <th class="women odd">女性①</th>
                                <th class="women odd">女性②</th>
                                <th class="women odd">女性③</th>
                                <th class="women odd">女性④</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="man even">9:45 <br> (10:00 -11:30)</td>
                                <td class="man even"></td>
                                <td class="man even"></td>
                                <td class="man even"></td>
                                <td class="even space-table"></td>
                                <td class="women even"></td>
                                <td class="women even"></td>
                                <td class="women even"></td>
                                <td class="women even">
                                </td>
                            </tr>
                            <tr>
                                <td class="man odd">
                                    10:15
                                    <br> (10:30 -12:00)
                                </td>
                                <td class="man odd">
                                    <div class="info">
                                        <span class="info-name">［入浴］男性(49歳)</span> <br>
                                        <span>渋野日向子同行者様</span> <br>
                                        <span>バス　9:29着　<span class="text-red">送迎有</span></span>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="man odd"></td>
                                <td class="man odd"></td>
                                <td class="odd space-table"></td>
                                <td class="women odd">
                                    <div class="info">
                                        <span class="info-name">［入浴］女性(21歳)</span> <br>
                                        <span>渋野日向子様</span> <br>
                                        <span>バス　9:29着 <span class="text-red">送迎有</span></span> <br>
                                        <span>昼食　宿泊</span> <br>
                                        <span>090-1234-5678</span> <br>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="women odd"></td>
                                <td class="women odd"></td>
                                <td class="women odd">
                                </td>
                            </tr>
                            <tr>
                                <td class="man even">
                                    10:45<br> (11:00 -12:30)
                                </td>
                                <td class="man even">
                                    <div class="info">
                                        <span class="info-name">［リ①］男性(27歳)</span> <br>
                                        <span>石川遼様</span> <br>
                                        <span>自動車</span>
                                        <span>090-1234-5678</span>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="man even"></td>
                                <td class="man even"></td>
                                <td class="even space-table"></td>
                                <td class="women even">

                                </td>
                                <td class="women even"></td>
                                <td class="women even"></td>
                                <td class="women even">
                                </td>
                            </tr>
                            <tr>
                                <td class="man odd">
                                    13:15<br> (13:30 - 15:00)
                                </td>
                                <td class="man odd">
                                    <div class="info">
                                        <span class="info-name">[貸切] 男性 (29歳)</span> <br>
                                        <span>錦織圭様</span> <br>
                                        <span>自動車</span>
                                        <span>090-1234-5678</span>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="man odd">ー</td>
                                <td class="man odd">ー</td>
                                <td class="odd space-table"></td>
                                <td class="women odd">
                                    <div class="info">
                                        <span class="info-name">[入浴]女性(21歳) <span class="text-red">新規</span></span> <br>
                                        <span>大阪なおみ様</span> <br>
                                        <span>自動車</span> <br>
                                        <span>ﾍﾟｯﾄ預かり</span> <br>
                                        <span>080-1111-2222</span> <br>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="women odd"></td>
                                <td class="women odd"></td>
                                <td class="women odd">
                                </td>
                            </tr>
                            <tr>
                                <td class="man even">
                                    13:45<br> (14:00 - 15:00)
                                </td>
                                <td class="man even">
                                    <div class="info">
                                        <span class="info-name">［入浴②］男性(49歳)</span> <br>
                                        <span>渋野日向子同行者様</span> <br>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="man even"></td>
                                <td class="man even"></td>
                                <td class="even space-table"></td>
                                <td class="women even">
                                    <div class="info">
                                        <span class="info-name">［入浴②］女性(21歳)</span> <br>
                                        <span>渋野日向子様</span> <br>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="women even"></td>
                                <td class="women even"></td>
                                <td class="women even"></td>
                            </tr>
                            <tr>
                                <td class="man odd">
                                    14:15<br> (14:30 - 16:00)
                                </td>
                                <td class="man odd">
                                    <div class="info">
                                        <span class="info-name">［リ②］男性(27歳)</span> <br>
                                        <span>渋野日向子同行者様</span> <br>
                                    </div>
                                    <div class="info-detail" style="display: none">
                                        <div class="detail-title">

                                        </div>
                                        <div class="detail-content">
                                            <div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【名前】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="渋野日向子">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【交通手段】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">バス</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【洲本IC着】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">9:29着</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【性別】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="21">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【電話番号】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <input type="text" value="09012345678">
                                                    </div>
                                                </div>
                                                <div class="field-info">
                                                    <div class="field-info-label">
                                                        <label for="">【コース】</label>
                                                    </div>
                                                    <div class="field-info-content">
                                                        <select name="" id="">
                                                            <option value="">酵素浴</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="man odd"></td>
                                <td class="man odd"></td>
                                <td class="odd space-table"></td>
                                <td class="women odd">

                                </td>
                                <td class="women odd"></td>
                                <td class="women odd"></td>
                                <td class="women odd">
                                </td>
                            </tr>
                            <tr>
                                <td class="man even">
                                    15:15<br> (15:30-17:00)
                                </td>
                                <td class="man even">
                                </td>
                                <td class="man even"></td>
                                <td class="man even"></td>
                                <td class="even space-table"></td>
                                <td class="women even">

                                </td>
                                <td class="women even"></td>
                                <td class="women even"></td>
                                <td class="women even">
                                </td>
                            </tr>
                            <tr>
                                <td class="man odd">
                                    15:45
                                    <br> (16:00-17:30)
                                </td>
                                <td class="man odd">
                                </td>
                                <td class="man odd"></td>
                                <td class="man odd"></td>
                                <td class="odd space-table"></td>
                                <td class="women odd">

                                </td>
                                <td class="women odd"></td>
                                <td class="women odd"></td>
                                <td class="women odd">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-pet">
                        <table>
                            <thead>
                            <th class="odd">ペット</th>
                            </thead>
                            <tbody>
                            <tr class="even">
                                <td>9：30～10：30</td>
                            </tr>
                            <tr class="odd">
                                <td>○</td>
                            </tr>
                            <tr class="even">
                                <td>11：00～12：00</td>
                            </tr>
                            <tr class="odd">
                                <td>○</td>
                            </tr>
                            <tr class="even">
                                <td>14：00～15：00</td>
                            </tr>
                            <tr class="odd">
                                <td>○</td>
                            </tr>
                            <tr class="even">
                                <td>15：30～16：30</td>
                            </tr>
                            <tr class="odd">
                                <td>
                                    <div class="info">
                                        <span>大阪なおみ様</span> <br>
                                        <span>自動車</span> <br>
                                        <span>080-1111-2222</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="main-footer">
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
    <script src="{{asset('sunsun/admin/js/day.js').config('version_files.html.js')}}"></script>
@endsection

