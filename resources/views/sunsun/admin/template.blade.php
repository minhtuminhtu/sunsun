@extends("sunsun.template")

@section('title', 'SUN-SUN Admin')

@section("head")
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('common/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/admin.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/base.css').config('version_files.html.css')}}">
    <script src="{{asset('sunsun/lib/sweetalert2/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('sunsun/lib/sweetalert2/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('sunsun/lib/animate.css/animate.min.css')}}"/>
    @yield('admincss')
@endsection

@section("header")
    @include('sunsun.admin.layouts.header')
@endsection


@section("footer")
    @include('sunsun.admin.layouts.footer')
    <div id="js-loading">
        <img src="{{asset('sunsun/imgs/icons/Spinner-1s-200px.svg')}}" alt="">
    </div>
@endsection
@section('script')
    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{asset('sunsun/lib/jquery-3.4.1/jquery-ui.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var loader = $('#js-loading');
        var $site_url = '{{url('/')}}';
        var $curent_url = '{{url()->current()}}';

    </script>
@endsection


