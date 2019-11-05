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
    <style>

        body {
            font-family: "\30D2\30E9\30AE\30CE\89D2\30B4   Pro W3", "Hiragino Kaku Gothic Pro", "\30E1\30A4\30EA\30AA", Meiryo, "\FF2D\FF33   \FF30\30B4\30B7\30C3\30AF", sans-serif;
        }

        #js-loading {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            z-index: 1051;
            background-color: rgba(0, 0, 0, 0.2);
        }

        #js-loading img {
            position: absolute;
            width: 100px;
            height: 100px;
            top: calc(50vh - 50px);
            left: calc(50vw - 50px);
        }

    </style>
    <link rel="stylesheet" href="{{asset('sunsun/admin/css/admin.css').config('version_files.html.css')}}">
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


