@extends('sunsun.admin.template')
@section('title', '予約不可設定')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <style>
        .main-content-result{
            width: 100%;
            margin: 2% 0;
        }
        .col-items-date{
            margin: 10px 10px 10px 0;
            padding: .5%;
            flex: 1;
            overflow-y: auto;
            width: 24%;
            float: left;
        }
        .btn-submit{
            width: 100%;
            float: left;
            margin-top: 2%;
        }
        #submitButton{
            width: 18%;
            margin: 0 auto;
        }
        #submitButton>a{
            width: 100%;
            padding: 4%;
            background-color: #d7751e;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            font-size: 1.15vw;
            text-transform: uppercase;
            color: white;
            border-radius: .25rem;
        }
        .datepicker-inline{
            width: 100%;
        }
        form#formSubmitDayOff .table-condensed>thead>tr:nth-child(2) .next{
            display: none;
        }
        form#formSubmitDayOff .table-condensed>thead>tr:nth-child(2) .prev{
            display: none;
        }
        form#formSubmitDayOff .table-condensed>thead>tr:nth-child(2){
        }
        .active-date{
            background-color: #99999952 !important;
        }
        .control-input__date{
            width: 6%;
        }
        #input-current__date{
            width: 71%;
            text-align: center;
            border: none;
            cursor: pointer;
        }
        #input-current__date:focus{
            border: none;
            outline: none;
        }
        .control-input__date span{
            margin-right: 1%;
        }
        .datepicker table tr td.active.active{
            background: none !important;
            color: #212529;
            border-color: none;
            text-shadow: none;
        }
        .datepicker table tr td.active.active.disabled{
            color: #999;
            border-color: none;
            text-shadow: none;
        }
    </style>
@endsection
@section('main')
    <main>
        <div class="container">
            <div class="breadcrumb-sunsun">
                @include('sunsun.admin.layouts.breadcrumb')
            </div>
            <div class="main-head">
                <div class="control-view">
                    <div class="control-input__date">
                        <input type="text" id="input-current__date"><span>年</span>
                    </div>
                    <div class="control-align_center">
                        <span class="" id="button-current__date">
                            <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar-alt icon-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="main-content" style="display: flex">
                <div class="main-content-result">
                    <form id="formSubmitDayOff" method="post" action="{{ route('admin.submit_day_off') }}">
                        @csrf
                        <div class="col-items-date">
                            <div id="date_01"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_02"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_03"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_04"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_05"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_06"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_07"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_08"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_09"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_10"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_11"></div>
                        </div>

                        <div class="col-items-date">
                            <div id="date_12"></div>
                        </div>
                        
                        <div class="btn-submit">
                            <div id="submitButton">
                                <a href="javascript:void(0)">保存</a>
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
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script type="text/javascript">
        var list_holiday = <?php echo json_encode($list_holiday); ?>;
        var count_holiday = list_holiday.length;
        (function($) {
                var date = new Date();
                var year = date.getFullYear();
                Create_month(year);
                ClickToggleClass();
                $('#input-current__date').val(year);
                var column = $(".datepicker-switch");
                column.attr("colspan","7")
                current_day = $('#input-current__date'),
                date_day = current_day.datepicker({
                    language: 'ja',
                    autoclose: false,
                    weekStart: 1,
                    format: "yyyy",
                    minViewMode: "years",
                }).on("changeYear", function(e) {
                    var year = e.date.getFullYear();
                    Create_month(year);
                    changeYear(year);
                    ClickToggleClass();
                });
                
                $('#button-current__date').off('click');
                $('#button-current__date').on('click', function(e) {
                    $('#input-current__date').focus();
                });

                function Create_month(year) {
                    for (var index = 1; index <= 12; index++) {
                        if(index < 10){
                            index = '0'+index;
                        }
                        $('#date_'+index).datepicker({
                        language: 'ja',
                        autoclose: false,
                        weekStart: 1,
                        maxViewMode: 0,
                        daysOfWeekDisabled: "3,4",
                        }).datepicker("setDate", new Date(year, index, null));
                    }
                };

                function setDefaultCombo() {
                    for (var i = 0; i<count_holiday; i++) {
                        var value = list_holiday[i];
                        var arr = value.split("/");
                        var month = arr[1];
                        var day = arr[2];
                        var id_datepicker = "#date_"+month;
                        var arr_day = $(id_datepicker).find(".day");
                        for (let index = 0; index < arr_day.length; index++) {
                            var check_day = arr_day[index].innerText;
                            if (check_day.length < 2) {
                                check_day = '0'+check_day;
                            }
                            if (check_day == day && arr_day[index].className == 'day') 
                            {
                                var obj_dd = $(arr_day[index]).attr("data-date");
                                $("#date_"+month+" [data-date="+obj_dd+"]").addClass('active-date');
                            }   
                        }
                    }
                }
                setDefaultCombo();
                function ClickToggleClass() {
                    for (var index = 1; index <= 12; index++) {
                        if(index < 10){
                            index = '0'+index;
                        }
                        $("#date_"+index+" .table-condensed td.day").on('click', function(e){
                            e.preventDefault();
                            e.stopPropagation(); // Ngăn chặn sự lan rộng của sự kiện hiện tại tới thằng khác.
                            e.stopImmediatePropagation(); // ngăn chặn những listeners cũng đang đang lắng nghe cùng event được gọi. 
                            // lấy tháng hiện tại
                            var year_change = $("#input-current__date").val(); // năm thay đổi
                            var month_now = date.getMonth()+1;
                            var day_now = date.getDate();
                            var year_now = date.getFullYear(); // năm hiện tại
                            if (year_change > year_now) {
                                if (!$(this).hasClass('disabled')) {
                                    $(this).toggleClass('active-date').removeClass('active');
                                }
                            }else if(year_change < year_now){ // kiểm tra năm change mà nhỏ hơn năm hiện tai thì báo lỗi
                                alert('休日が過去の日付に設定できません。');
                                return false;
                            }else{
                                if (month_now < 10) {
                                    month_now = '0'+month_now;
                                }
                                var id_datepicker = "#date_"+month_now;
                                var obj_day = $(id_datepicker).find(".day");
                                for (let index = 0; index < obj_day.length; index++) {
                                    var check_day = obj_day[index].innerText;
                                    if (check_day == day_now) // kiểm tra nếu ngày trong tháng bằng với ngày hiện tại
                                    {
                                        var data_date_now = $(obj_day[index]).attr("data-date"); // lấy data data-date
                                    }   
                                }
                                var data_date_click = $(this).attr("data-date"); // lấy data-date của ngày đang click
                                if (data_date_now < data_date_click) { // so sánh nếu date-date hiện tại nhỏ hơn data date click thì add class
                                    if (!$(this).hasClass('disabled')) {
                                        $(this).toggleClass('active-date').removeClass('active');
                                    }
                                }else{ // ngược lại báo lỗi
                                    alert('休日が過去の日付に設定できません。');
                                    return false;
                                }
                            }
                            
                        });
                    }
                };

                $(document).on("click", "#submitButton", function(){
                    var arr_data = [];
                    var year = $("#input-current__date").val();
                    for (var index = 1; index <= 12; index++) {
                        if(index < 10){
                            index = '0'+index;
                        }
                        var id_datepicker = "#date_"+index;
                        var obj_active = $(id_datepicker).find(".active-date");
                        for (let i = 0; i < obj_active.length; i++) {
                            var day_active = obj_active[i].innerText;
                            if (day_active.length < 2) {
                                day_active = '0'+day_active;
                            }
                            var month = index;
                            var day = day_active;
                            var dateFull = year+month+day;
                            arr_data.push(dateFull);
                        }
                    }
                    var data_holiday = arr_data;
                    hanldSubmitAjax(year,data_holiday)
                });

                function hanldSubmitAjax(year,data) {
                    $.ajax({
                        url: $site_url +'/admin/submit_day_off',
                        type: 'POST',
                        data: {year:year, data:data},
                        dataType: 'JSON',
                        beforeSend: function () {
                            loader.css({'display': 'block'});
                        },
                        success: function (html) {
                            if (html.status == true) {
                                window.location.reload();
                                alert("保存に成功しました。");
                            }
                        },
                        complete: function () {
                            loader.css({'display': 'none'});
                        },
                    });
                }

                function changeYear(year) {
                    $.ajax({
                        url: $site_url +'/admin/ajax_day_off',
                        type: 'POST',
                        data: {
                            year_search : year
                        },
                        dataType: 'JSON',
                        beforeSend: function () {
                            loader.css({'display': 'block'});
                        },
                        success: function (html) {
                            if (html.status == true) {
                                list_holiday =  html.data.list_holiday;
                                count_holiday = list_holiday.length;
                                setDefaultCombo();
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
