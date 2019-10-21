@extends("sunsun.template")

@section('title', 'SUN-SUN')

@section("head")
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('common/css/reset.css')}}">

    <style>
        #js-loading {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            z-index: 1051;
            background-color: rgba(0,0,0,.2);
        }
        #js-loading img {
            position: absolute;
            width: 100px;
            height: 100px;
            top: calc(50vh - 50px);
            left: calc(50vw - 50px);
        }
    </style>
    <style>
        html {
            overflow-y: scroll;
        }
    </style>
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
@yield('admincss')
@endsection

@section("header")
    @include('sunsun.front.layouts.header')
@endsection


@section("footer")
    @include('sunsun.front.layouts.footer')
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
        let loader = $('#js-loading');
        var $site_url = '{{url('/')}}';
    </script>
@endsection

