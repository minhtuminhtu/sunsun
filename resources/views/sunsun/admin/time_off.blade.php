@extends('sunsun.admin.template')
@section('title', '予約不可設定')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/holiday.css')}}">
    <link rel="stylesheet" href="{{asset('css/on-off-switch.css')}}">
@endsection
@section('main')
    <main>
        <div class="container">
            <div class="breadcrumb-sunsun">
                @include('sunsun.admin.layouts.breadcrumb')
            </div>
            <div class="main-head">
            </div>
            <div class="main-content" style="display: flex">
                <div class="main-content-left-date">
                    <div id="show_current_date"></div>
                </div>
                <div class="main-content-result">
                    <form id="formSubmit" style="width:100%" method="post" action="{{ route('admin.submit_time_off') }}">
                        <input type="hidden" name="date_search" id="date_search" value="<?php echo date('Y-m-d'); ?>">
                        @csrf
                        <div class="col-items">
                            <div class="row-title">酵素浴</div>
                            <div class="row-content" id="div1">
                            </div>
                        </div>
                        <div class="col-items even">
                            <div class="row-title">ペット酵素浴</div>
                            <div class="row-content" id="div2">
                            </div>
                        </div>
                        <div class="col-items">
                            <div class="row-title">ホワイトニング</div>
                            <div class="row-content" id="div3">
                            </div>
                        </div>
                        <div class="btn-submit">
                            <div id="submitButton">
                                <a href="javascript:void(0)">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="main-footer">
            </div>
        </div>
    </main>
@endsection
@section('script')
    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('sunsun/lib/togglebutton/on-off-switch.js')}}"></script>
    <script type="text/javascript" src="{{asset('sunsun/lib/togglebutton/on-off-switch-onload.js')}}"></script>
    <script type="text/javascript">
        var list_kubun = <?php echo json_encode($list_kubun); ?>;
        var list_holiday = <?php echo json_encode($list_holiday); ?>;
        var count_list = list_kubun.length;
        var count_holiday = list_holiday.length;
        var listCombo = [];
        (function($) {
            Date.prototype.addDays = function(days) {
                var date = new Date(this.valueOf());
                date.setDate(date.getDate() + days);
                return date;
            }
            // start page
            createListKubun();
            var today = new Date();
            var day = today.getDay();
            if (day == 3 || day == 4) {
                today = (day == 3) ? today.addDays(2) : today.addDays(1);
            }
            $('#show_current_date').datepicker({
                language: 'ja',
                weekStart: 1,
                daysOfWeekDisabled: "3,4",
                datesDisabled: _date_holiday,
                dateFormat: 'yyyy/mm/dd'
            }).on("changeDate", function(e) {
                searchDate(e.date);
            }).datepicker("setDate", today);
            function searchDate(date_select) {
                var _date_search = date_select.getFullYear()+"-"+(date_select.getMonth()+1)+"-"+date_select.getDate();
                $("#date_search").val(_date_search);
                refeshPage();
            }
            $(document).on("click", "#submitButton", function(){
                var _data = [];
                for (var i =0 ; i < count_list ; i++) {
                    var id_cmb = "#"+listCombo[i];
                    if ($(id_cmb).val() == "off") {
                        _data.push(listCombo[i].replace("cmb_", ""));
                    }
                }
                $.ajax({
                    url: $site_url +'/admin/submit_time_off',
                    type: 'POST',
                    data: {
                        date_search : $("#date_search").val(),
                        data : _data
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        loader.css({'display': 'block'});
                    },
                    success: function (html) {
                        if (html.status == true) {
                            alert("save finish");
                        }
                    },
                    complete: function () {
                        loader.css({'display': 'none'});
                    },
                });
            });
            // function
            function createListKubun() {
                var listhtml = [];
                listCombo = [];
                for (var i = 0; i<count_list; i++) {
                    var data = list_kubun[i];
                    var type = data.type_holiday;
                    var id = type+"_"+data.time_holiday;
                    var id_cmb = "cmb_"+id;
                    var id_tr = "tr_"+type+"_"+data.time_holiday;
                    listCombo.push(id_cmb);
                    var html = " \
                            <tr id='"+id_tr+"'> \
                                <td class='name_holiday'>"
                                    + data.kubun_value +
                                "</td> \
                                <td class='value_holiday' align='right'> \
                                    <div class='checkbox-container'> \
                                        <input type='checkbox' id='"+id_cmb+"' name='"+id_cmb+"' checked> \
                                    </div> \
                                </td> \
                            </tr>";
                    if (listhtml[type] == undefined) listhtml[type] = html;
                    else listhtml[type] += html;
                }
                listhtml.forEach(_listKubun);
                listCombo.forEach(_listCombo);
            }
            function _listKubun(item, index) {
                var html = "<table>" + item + "</table>";
                $("#div"+index).html(html);
            }
            function _listCombo(item, index) {
                new DG.OnOffSwitch({
                    el: "#"+item,
                    height: 20,
                    textOn:'ON',
                    textOff:'OFF',
                    listener:function(name, checked){
                        var id_tr = "#"+name.replace("cmb_", "tr_");
                        if (!checked) {
                            $("#"+name).val("off");
                            $(id_tr).addClass("tr_disable");
                        }
                        else {
                            $("#"+name).val("on");
                            $(id_tr).removeClass("tr_disable");
                        }
                    }
                });
                setDefaultCombo(item);
            }
            function setDefaultCombo(item) {
                var id = "#"+item;
                var arr = item.split("_");
                var type = arr[1];
                var time_holiday = arr[2];
                for (var i = 0; i<count_holiday; i++) {
                    var row = list_holiday[i];
                    if (row.type_holiday == type && row.time_holiday == time_holiday) {
                        $(id).click();
                    }
                }
            }
            function refeshPage() {
                $.ajax({
                    url: $site_url +'/admin/ajax_time_off',
                    type: 'POST',
                    data: {
                        date_search : $("#date_search").val()
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        loader.css({'display': 'block'});
                    },
                    success: function (html) {
                        if (html.status == true) {
                            var _data = html.data;
                            list_kubun = html.data.list_kubun;
                            list_holiday =  html.data.list_holiday;
                            count_list = list_kubun.length;
                            count_holiday = list_holiday.length;
                            createListKubun();
                        }
                    },
                    complete: function () {
                        loader.css({'display': 'none'});
                    },
                });
            }
        })(jQuery);
    </script>
@endsection