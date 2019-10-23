@extends('sunsun.front.template')

@section('head')
    @parent
@endsection

@section('main')
    <main class="main-body">
        <div class="main-body-head text-center">
            <h1>Edit  </h1>
        </div>
        <div class="container">
            @include('cms.admin.email._form')
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection

@section('script')

    @parent

@endsection

