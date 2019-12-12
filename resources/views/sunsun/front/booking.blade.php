@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/bootstrap-datepicker-master/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking-mobile.css').config('version_files.html.css')}}">
    <script src="{{asset('sunsun/lib/sweetalert2/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('sunsun/lib/sweetalert2/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('sunsun/lib/animate.css/animate.min.css')}}"/>
@endsection
@section('page_title', '予約入力')

@section('main')
    <main class="main-body">
        @include('sunsun.front.parts.booking_form')
    </main>
@endsection

@section('footer')
    @parent
    <!-- The Modal -->
    @include('sunsun.front.parts.booking_modal')
    
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

