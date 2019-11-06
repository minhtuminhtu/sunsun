$(function() {
    let service = $('.service-warp'),
        modal_choice_time = $('#choice_date_time');
    var days_short = ["日","月","火","水","木","金","土"];
    var today = moment();
    var tomorrow = moment(today).add(1, 'days');


    
    let load_event = function(check = null) {
        var d = new Date();
        var strToday = today.format('Y') + "/" + today.format('M') + "/" + today.format('D');
        var strTomorrow = tomorrow.format('Y') + "/" + tomorrow.format('M') + "/" + tomorrow.format('D');

        
        if($('#date').val() == ""){
            $('#date').val(strToday + "(" + days_short[moment(strToday).weekday()] + ")");
        }
        if($('#range_date_start').val() == ""){
            $('#range_date_start').val(strToday);
        }
        if($('#range_date_end').val() == ""){
            $('#range_date_end').val(strTomorrow);
        }
        if($('#plan_date_start').val() == ""){
            $('#plan_date_start').val(strToday);
        }
        if($('#plan_date_end').val() == ""){
            $('#plan_date_end').val(strTomorrow);
        }
        let date_book =  $('.date-book');
        date_book.datepicker({
            language: 'ja',
            startDate: new Date()
        });
        date_book.on('changeDate', function() {
            let edit = $(this);
            edit.closest('.date-warp').find('.date-book-input').val(
                edit.datepicker('getFormattedDate')
            );
            change_day();
        });


        $('#room').on('change', function() {
            var room =  JSON.parse($('#room').val());
            if(room.kubun_id == '01'){
                $('.room').hide();
            }else{
                $('.room').show();
            }
        });

        

        $('#date').datepicker({
            language: 'ja',
            dateFormat: "yyyy/mm/dd",
            startDate: new Date()

        });

        let input_daterange = $('.input-daterange');
        input_daterange.datepicker({
            language: 'ja',
            dateFormat: 'yyyy/mm/dd',
            // autoclose: true,
            startDate: new Date()
        });
        input_daterange.on('changeDate', function() {

        });
        $('.agecheck').click(function(){
            $('.agecheck').removeClass('color-active');
            $('.agecheck').addClass('btn-outline-warning');
            $(this).addClass('color-active');
            $(this).removeClass('btn-outline-warning');
            $('#agecheck').val($(this).text())
        });


        $('#date').on('change blur', function() {
            var check = moment($('#date').val());
            $('#date').val(check.format('YYYY') + "/" + check.format('M') + "/" + check.format('D') + "(" + days_short[check.weekday()] + ")");
            $('#date-view').val(check.format('YYYY') + "年" + check.format('M') + "月" + check.format('D') + "日(" + days_short[check.weekday()] + ")");
        });
        function change_day(){
            var check = moment($('#date').val());
            $('#date').val(check.format('YYYY') + "/" + check.format('M') + "/" + check.format('D') + "(" + days_short[check.weekday()] + ")");
            $('#date-view').val(check.format('YYYY') + "年" + check.format('M') + "月" + check.format('D') + "日(" + days_short[check.weekday()] + ")");
        }


        $(".room_range_date").on('change blur', function() {
            var check2 = moment($('#range_date_start').val());
            var check1 = moment($('#range_date_end').val());
            $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('M') + "月" + check2.format('D') + "日(" + days_short[check2.weekday()] + ")");
            $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('M') + "月" + check1.format('D') + "日(" + days_short[check1.weekday()] + ")");
        });


        let set_time = $('.js-set-time');
        set_time.click(function (e) {
            let set_time_click = $(this);
            $.ajax({
                url: '/get_time_room',
                type: 'POST',
                data: {
                    'gender': $('select[name=gender]').val()
                },
                dataType: 'text',
                beforeSend: function () {
                    loader.css({'display': 'block'});
                },
                success: function (html) {
                    set_time_click.closest('.set-time').addClass('edit')
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal('show');
                },
                complete: function () {
                    loader.css({'display': 'none'});
                },
            });
        });

        let get_room = $('.js-set-room');
        get_room.click(function (e) {
            let set_time_click = $(this);
            $.ajax({
                url: $site_url +'/book_room',
                type: 'POST',
                data: {
                    'sex': $('select[name=date]').val()
                },
                dataType: 'text',
                beforeSend: function () {
                    loader.css({'display': 'block'});
                },
                success: function (html) {
                    set_time_click.closest('.set-time').addClass('edit')
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal('show');
                },
                complete: function () {
                    loader.css({'display': 'none'});
                },
            });
        });

        let get_room_pet = $('.js-set-room_pet');
        get_room_pet.click(function (e) {
            let set_time_click = $(this);
            $.ajax({
                url: $site_url +'/book_room',
                type: 'POST',
                data: {
                    'gender': $('select[name=date]').val()
                },
                dataType: 'text',
                beforeSend: function () {
                    loader.css({'display': 'block'});
                },
                success: function (html) {
                    set_time_click.closest('.set-time').addClass('edit')
                    modal_choice_time.find('.modal-body-time').html(html);
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



    let get_service = function() {
        let data = {
            'service': $('#course').val()
        };
        if ($('input[name=add_new_user]').val() == 'on' ) {
            data.add_new_user = 'on';
        }
        $.ajax({
            url: $site_url +'/get_service',
            type: 'POST',
            data:  data,
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                $('.service-warp').empty().append(html).hide().fadeIn('slow');
                load_event();
                load_date_before();
                load_time_list();
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    }
    $('#course').on('change', function() {
        get_service();
    });
    get_service();


    $('.btn-booking').click(function (e) {
        e.preventDefault();
        let btn_click = $(this);
        $.ajax({
            url: $site_url +'/save_booking',
            type: 'POST',
            data: $('form.booking').serializeArray(),
            dataType: 'JSON',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (r) {
                if (btn_click.hasClass('add-new-people')) {
                    window.location.href = $site_url +'/booking?add_new_user=on';
                } else {
                    window.location.href = $site_url +'/confirm';
                }
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });











    let input_daterange = $('.input-daterange');
    input_daterange.datepicker({
        language: 'ja',
        dateFormat: 'yyyy/mm/dd',
        startDate: new Date()
    });

    let load_time_list = function(check = null) {
        if(!check){
            $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + today.format('M') + '/' + today.format('D') + '(' + days_short[today.weekday()] + ')</label><input name="date['+ 0 +'][day]" value="' + today.format('M') + '/' + today.format('D') + '(' + days_short[today.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 0 +'][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 0 +'][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
            $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + tomorrow.format('M') + '/' + tomorrow.format('D') + '(' + days_short[tomorrow.weekday()] + ')</label><input name="date['+ 1 +'][day]" value="' + tomorrow.format('M') + '/' + tomorrow.format('D') + '(' + days_short[tomorrow.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 1 +'][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 1 +'][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
        }
        $(".range_date").change(function(){
            var date_arr = getDates($('#plan_date_start').val(), $('#plan_date_end').val());
            $('.time-list').empty();
            moment.locale('ja');
            date_arr.forEach(function(element,index) {
                var check = moment(element)
                var month = check.format('M');
                var day   = check.format('D');
                var week_day =  check.weekday();
                $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label><input name="date['+ index +'][day]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ index +'][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ index +'][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
            });
            let check2 = moment($('#plan_date_start').val());
            let check1 = moment($('#plan_date_end').val());
            $('#plan_date_start-view').val(check2.format('YYYY') + "年" + check2.format('M') + "月" + check2.format('D') + "日(" + days_short[check2.weekday()] + ")");
            $('#plan_date_end-view').val(check1.format('YYYY') + "年" + check1.format('M') + "月" + check1.format('D') + "日(" + days_short[check1.weekday()] + ")");
            load_event();
        });
        load_event();
    };
    load_time_list();
});

let load_date_before = function(){
    var days_short = ["日","月","火","水","木","金","土"];
    var today = moment();
    var tomorrow = moment(today).add(1, 'days');

    $('#date-view').val(today.format('YYYY') + "年" + today.format('M') + "月" + today.format('D') + "日(" + days_short[today.weekday()] + ")");

    $('#range_date_start-view').val(today.format('YYYY') + "年" + today.format('M') + "月" + today.format('D') + "日(" + days_short[today.weekday()] + ")");
    $('#range_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('M') + "月" + tomorrow.format('D') + "日(" + days_short[tomorrow.weekday()] + ")");

    $('#plan_date_start-view').val(today.format('YYYY') + "年" + today.format('M') + "月" + today.format('D') + "日(" + days_short[today.weekday()] + ")");
    $('#plan_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('M') + "月" + tomorrow.format('D') + "日(" + days_short[tomorrow.weekday()] + ")");
}

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


$('#transport').on('change', function() {
    var transport =  JSON.parse($('#transport').val());
    if(transport.kubun_id == '01'){
        $('.bus').hide();
    }else{
        $('.bus').show();
    }
    
});



$('.agecheck').click(function(){
    $('.agecheck').removeClass('color-active');
    $(this).addClass('color-active');
    $('#agecheck').val($(this).text())
});
$('#date').on('change blur', function() {
    var check = moment($('#date').val());
    var month = check.format('M');
    var day   = check.format('D');
    var year  = check.format('YYYY');
    var week_day =  check.weekday();
    var days_short = ["日","月","火","水","木","金","土"];
    $('#date').val(year + "/" + month + "/" + day + "(" + days_short[week_day] + ")");
    $('#date-view').val(year + "年" + month + "月" + day + "日(" + days_short[week_day] + ")");
});
$(".room_range_date").on('change blur', function() {
    var check2 = moment($('#range_date_start').val());
    var check1 = moment($('#range_date_end').val());
    var days_short = ["日","月","火","水","木","金","土"];
    $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('M') + "月" + check2.format('D') + "日(" + days_short[check2.weekday()] + ")");
    $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('M') + "月" + check1.format('D') + "日(" + days_short[check1.weekday()] + ")");
});


$('#confirm').on('change', function() {
    if($(this).is(":checked")){
        $(".confirm-rules").prop("disabled", false);
    }else{
        $(".confirm-rules").prop("disabled", true);
    }
});






