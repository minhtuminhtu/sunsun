@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
    <style>
        .data-field-day {
            background: rgb(251,229,214);
            margin-bottom: 15px;
            line-height: 2.5rem;
            font-size: 1.2rem;
            text-align: center;
            margin-left: -10px;
            margin-right: -10px;
        }
    </style>
@endsection
@section('page_title', '予約入力')

@section("booking_form")
    @include('sunsun.front.parts.booking_form')
@endsection
@section("booking_modal")
    @include('sunsun.front.parts.booking_modal')
@endsection

@section('main')
    <main class="main-body">
        @yield('booking_form')
    </main>
@endsection

@section('footer')
    @parent
    <!-- The Modal -->
    @yield('booking_modal')
@endsection
@section('script')
    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/moment.min.js')}}" charset="UTF-8"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('sunsun/lib/bootstrap-datepicker-master/locales/bootstrap-datepicker.ja.min.js')}}"
            charset="UTF-8"></script>
    <script src="{{asset('sunsun/front/js/booking.js').config('version_files.html.js')}}"></script>
    <script src="{{asset('sunsun/front/js/base.js').config('version_files.html.js')}}"></script>
@endsection

