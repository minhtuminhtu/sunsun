@extends('sunsun.admin.template')
@section('title', 'Time Off')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <style>
        .main-content-left-date{
            width: 30%;
            float: left;
        }
        .main-content-result{
            width: 70%;
            float: right;
        }
        .col-items{
            width: 30%;
            float: left;
            background-color: #f9f6eb;
            padding: .5%;
        }
        .row-title{
            text-align: center;
            border-bottom: 1px solid;
            padding: 1% 0;
            font-size: 13px;
        }
        .row-content{
            height: 150px;
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
        .even{
            margin: 0 5%;
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
                
            </div>
            <div class="main-content" style="display: flex">
                <div class="main-content-left-date">
                    <div id="show_current_date"></div>
                </div>
                <div class="main-content-result">
                    <form id="formSubmit" style="width:100%" method="post" action="{{ route('admin.create_timeoff') }}">
                        @csrf
                        <div class="col-items">
                            <div class="row-title">Loại 1</div>
                            <div class="row-content">

                            </div>
                        </div>
                        <div class="col-items even">
                            <div class="row-title">Loại 1</div>
                            <div class="row-content">

                            </div>
                        </div>
                        <div class="col-items">
                            <div class="row-title">Loại 1</div>
                            <div class="row-content">

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
    <script type="text/javascript">
        (function($) {
                current_day = $('#show_current_date'),
                date_day = current_day.datepicker({
                language: 'ja',
                weekStart: 1,
                dateFormat: 'yyyy/mm/dd',
                onSelect: function(dateText, inst) {
                
                }
                }).datepicker("setDate", "0");

                
                $(document).on("click", "#submitButton", function(){
                    $('#formSubmit').submit();
                });

        })(jQuery);
    </script>
@endsection
