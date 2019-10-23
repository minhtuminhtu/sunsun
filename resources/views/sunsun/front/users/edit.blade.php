@extends('sunsun.front.template')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('sunsun/lib/checkbox/build.css').config('version_files.html.css')}}">
    <link rel="stylesheet" href="{{asset('sunsun/front/css/booking.css').config('version_files.html.css')}}">
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1 class="title-menu">Edit  </h1>
        </div>
        <div class="container">
            @include('sunsun.front.users._form', ["new" => 0, "name" => "Pham Van A", "email" => "testemail@gmail.com"])
            <div class="user-warp">
                <div class="row">
                    <div class="col-6 offset-3">
                        <a>
                            <button type="button" class="btn btn-block btn-booking text-white confirm-rules">Update</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection

@section('script')

    @parent

@endsection

