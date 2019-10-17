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
@endsection
@section('script')
    <script src="{{mix('js/app.js')}}"></script>
@endsection

