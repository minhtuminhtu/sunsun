@extends('sunsun.front.template')

@section('head')
    @parent
@endsection

@section('main')
<main id="mainArea">
    <div class="container-fluid">
        <div class="row ">
        </div>
    </div>
</main>
@endsection

@section('script')
    @parent
    <script src="{{asset('sunsun/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        /**
         * Japanese translation for bootstrap-datepicker
         * Norio Suzuki <https://github.com/suzuki/>
         */

        $(function() {
            $('#datetimepicker').datetimepicker({
                pickTime: false,
                locale: 'ja',
            });
        });
    </script>
@endsection

