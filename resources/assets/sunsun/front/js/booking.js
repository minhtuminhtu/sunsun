$(function() {
    let service = $('.service-warp'),
        modal_choice_time = $('#choice_date_time'),
        days_short = ["日","月","火","水","木","金","土"];

    let load_event = function() {
        let date_book =  $('.date-book');
        date_book.datepicker({
            language: 'ja'
        });
        date_book.on('changeDate', function() {
            let edit = $(this);
            edit.closest('.date-warp').find('.date-book-input').val(
                edit.datepicker('getFormattedDate')
            );
        });

        $('.date-book-input').datepicker({
            language: 'ja'
        });

        let input_daterange = $('.input-daterange');
        input_daterange.datepicker({
            language: 'ja',
            dateFormat: 'yyyy/mm/dd',
            autoclose: true,
            minDate: moment().toArray()
        });
        input_daterange.on('changeDate', function() {

        });




        function getDates(startDate, stopDate) {
            var dateArray = [];
            var currentDate = moment(startDate);
            var stopDate = moment(stopDate);
            while (currentDate <= stopDate) {
                dateArray.push( moment(currentDate).format('YYYY-MM-DD') )
                currentDate = moment(currentDate).add(1, 'days');
            }
            return dateArray;
        }

        $(".range_date").change(function(){
            var date_arr = getDates($('#plan_date_start').val(), $('#plan_date_end').val());
            $('.time-list').empty();
            moment.locale('ja');
            date_arr.forEach(function(element,index) {
                var check = moment(element)
                var month = check.format('M');
                var day   = check.format('D');
                var year  = check.format('YYYY');
                var week_day =  check.weekday();
                $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label><input name="date['+ index +'][day]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="input-time"><input name="date['+ index +'][from]" type="text" class="time form-control" id="" value="9:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div><div class="choice-data-time set-time">    <div class="data"><input name="date['+ index +'][to]" type="text" class="form-control time" id="" value="13:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div>    </div></div>');
            });
            load_event();
        });

        $('.agecheck').click(function(){
            $('.agecheck').removeClass('btn-warning');
            $(this).addClass('btn-warning');
            $('#agecheck').val($(this).text())
        });
        $('#room').on('change', function() {
            if(this.value == '無し'){
                $('.room').hide();
            }else{
                $('.room').show();
            }
        });
        let set_time = $('.js-set-time');
        set_time.click(function (e) {
            let set_time_click = $(this);
            $.ajax({
                url: $site_url +'/get_time_room',
                type: 'POST',
                data: {
                    'sex': $('select[name=sex]').val()
                },
                dataType: 'text',
                beforeSend: function () {
                    loader.css({'display': 'block'});
                },
                success: function (html) {
                    set_time_click.closest('.set-time').addClass('edit')
                    modal_choice_time.find('.modal-body-time').append(html);
                    modal_choice_time.modal('show');
                },
                complete: function () {
                    loader.css({'display': 'none'});
                },
            });
        });
    };
    load_event();

    modal_choice_time.on('hidden.bs.modal', function () {
        modal_choice_time.find('.modal-body-time').empty();
        $('.set-time').removeClass('edit');
    });
    modal_choice_time.on('click','#js-save-time',function (e) {
        let time = modal_choice_time.find('input[name=time]:checked').val();
        $('.set-time.edit input.time').val(time);
        modal_choice_time.modal('hide');
    })


    $('#services').on('change', function() {
        $('.service-warp').empty();
        $.ajax({
            url: $site_url +'/get_service',
            type: 'POST',
            data: {
                'service': this.value
            },
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
                $('.service-warp').empty();
            },
            success: function (html) {
                $('.service-warp').append(html);
                load_event();
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });


    });



});
$('.agecheck').click(function(){
    $('.agecheck').removeClass('btn-warning');
    $(this).addClass('btn-warning');
    $('#agecheck').val($(this).text())
});


$('#transportation').on('change', function() {
    if(this.value == '車​'){
        $('.bus').hide();
    }else{
        $('.bus').show();
    }
});
$('#room').on('change', function() {
    if(this.value == '無し'){
        $('.room').hide();
    }else{
        $('.room').show();
    }
});
$('#confirm').on('change', function() {
    if($(this).is(":checked")){
        $(":submit").attr("disabled", false);
    }else{
        $(":submit").attr("disabled", true);
    }
});
