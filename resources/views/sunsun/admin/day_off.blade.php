@extends('sunsun.admin.template')
@section('title', 'Day Off')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <style>
        .main-content-result{
            width: 100%;
            margin: 2% 0;
        }
        .col-items-date{
            margin: 10px 10px 10px 0;
            padding: .5%;
            background-color: #f9f6eb;
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
            font-size: 13px;
            text-transform: uppercase;
            color: white;
            border-radius: .25rem;
        }
        .datepicker-inline{
            width: 100%;
        }
        form#formSubmitDayOff .table-condensed>thead>tr:nth-child(2){
            display: none;
        }
        .active-date{
            background-color: #d7751e !important;
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
                <div class="control-input__date">
                    <input type="text" id="input-current__date">
                </div>
            </div>
            <div class="main-content" style="display: flex">
                <div class="main-content-result">
                    <form id="formSubmitDayOff" method="post" action="{{ route('admin.create_dayoff') }}">
                        @csrf
                        <div class="col-items-date">
                            <div id="date_1"></div>
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
    <script type="text/javascript">
        (function($) {
                var date = new Date();
                var year = date.getFullYear();
                $('#input-current__date').val(year);
                current_day = $('#input-current__date'),
                date_day = current_day.datepicker({
                language: 'ja',
                autoclose: false,
                weekStart: 1,
                format: "yyyy",
                minViewMode: "years",
                }).on("changeYear", function(e) {
                    console.log("Year changed: ", e.date.getFullYear());
                });

                $('#date_1').datepicker({
                    language: 'ja',
                    format: 'dd',
                    autoclose: true,
                    weekStart: 1,
                    maxViewMode: 0,
                });

                $("#date_1 td.day").on('click', function(e){
                    e.preventDefault();
                    e.stopPropagation(); // Ngăn chặn sự lan rộng của sự kiện hiện tại tới thằng khác.
                    e.stopImmediatePropagation(); // ngăn chặn những listeners cũng đang đang lắng nghe cùng event được gọi.
                    $('#date_1 td.day.active-date').not(this).removeClass('active-date');    
                    $(this).toggleClass('active-date');
                    console.log(123);
                });

                $(document).on("click", "#submitButton", function(){
                    $('#formSubmitDayOff').submit();
                });

        })(jQuery);
    </script>
@endsection
