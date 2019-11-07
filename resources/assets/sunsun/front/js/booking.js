$(function() {
    let service = $('.service-warp'),
        modal_choice_time = $('#choice_date_time');
    var days_short = ["日","月","火","水","木","金","土"];
    var today = moment();
    var tomorrow = moment(today).add(1, 'days');


    
    let load_event = function(check = null) {
        var d = new Date();
        var strToday = today.format('Y') + "/" + today.format('MM') + "/" + today.format('DD');
        var strTomorrow = tomorrow.format('Y') + "/" + tomorrow.format('MM') + "/" + tomorrow.format('DD');

        
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

        $('#whitening').on('change', function() {
            var whitening =  JSON.parse($('#whitening').val());
            if(whitening.kubun_id == '01'){
                $('.whitening').hide();
            }else{
                $('.whitening').show();
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
        $('.agecheck').on('click', function() {
            $('.agecheck').removeClass('color-active');
            $('.agecheck').addClass('btn-outline-warning');
            $(this).addClass('color-active');
            $(this).removeClass('btn-outline-warning');

            $('#agecheck').val($(this).val())

            if(($(this).val() == '1') || ($(this).val() == '2')){
                $('#age_value').empty();
                for(let i = 0; i < 19; i++){
                    $('#age_value').append('<option value="' + i + '">' + i + '</option>');
                    $('#age_value').val("18");
                }
            }else if($(this).val() == '3'){
                $('#age_value').empty();
                for(let i = 18; i < 100; i++){
                    $('#age_value').append('<option value="' + i + '">' + i + '</option>');
                    $('#age_value').val("18");
                }
            }
        });


        $('#date').on('change blur', function() {
            var check = moment($('#date').val());
            $('#date').val(check.format('YYYY') + "/" + check.format('MM') + "/" + check.format('DD') + "(" + days_short[check.weekday()] + ")");
            $('#date-value').val(check.format('YYYYMMDD'));
            $('#date-view').val(check.format('YYYY') + "年" + check.format('MM') + "月" + check.format('DD') + "日(" + days_short[check.weekday()] + ")");
        });
        function change_day(){
            var check = moment($('#date').val());
            $('#date').val(check.format('YYYY') + "/" + check.format('MM') + "/" + check.format('DD') + "(" + days_short[check.weekday()] + ")");
            $('#date-value').val(check.format('YYYYMMDD'));
            $('#date-view').val(check.format('YYYY') + "年" + check.format('MM') + "月" + check.format('DD') + "日(" + days_short[check.weekday()] + ")");
        }


        $(".room_range_date").on('change blur', function() {
            var check2 = moment($('#range_date_start').val());
            var check1 = moment($('#range_date_end').val());
            $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
            $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
            $('#range_date_start-value').val(check2.format('YYYYMMDD'));
            $('#range_date_end-value').val(check1.format('YYYYMMDD'));
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
                url: $site_url +'/book_time_room_pet',
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
        $('#time-value').val('1345');
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
            $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')</label><input name="date['+ 0 +'][day]" value="' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 0 +'][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 0 +'][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
            $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')</label><input name="date['+ 1 +'][day]" value="' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 1 +'][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ 1 +'][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
        }
        $(".range_date").change(function(){
            var date_arr = getDates($('#plan_date_start').val(), $('#plan_date_end').val());
            $('.time-list').empty();
            moment.locale('ja');
            date_arr.forEach(function(element,index) {
                var check = moment(element)
                var month = check.format('MM');
                var day   = check.format('DD');
                var week_day =  check.weekday();
                $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label><input name="date['+ index +'][day]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ index +'][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date['+ index +'][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
            });
            let check2 = moment($('#plan_date_start').val());
            let check1 = moment($('#plan_date_end').val());
            $('#plan_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
            $('#plan_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
            load_event();
        });
        load_event();
    };
    load_time_list();
});

let load_time_list_event = function(){
    $('.svg-button').on('click', function() {
        var r = confirm("Are you sure to delete this time?");
        if (r == true) {
            $($(this).parent().parent().remove());
        }
    });
}


let load_date_before = function(){
    var days_short = ["日","月","火","水","木","金","土"];
    var today = moment();
    var tomorrow = moment(today).add(1, 'days');

    $('#add-time').on('click', function() {
        $(".time-content").append('<div class="block-content-1 margin-top-mini"> <div class="block-content-1-left"><div class="timedate-block set-time">    <input name="time" type="text" class="form-control time js-set-time" id="" value="13:45" /></div> </div> <div class="block-content-1-right"><img class="svg-button" src="/sunsun/svg/close.svg" alt="Close" /></div>           </div>');
        load_time_list_event();
    });

    

    

    $('#age_value').val("18");

    
    $('#date-value').val(today.format('YYYYMMDD'));
    $('#date-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");

    $('#range_date_start-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
    $('#range_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('MM') + "月" + tomorrow.format('DD') + "日(" + days_short[tomorrow.weekday()] + ")");

    $('#range_date_start-value').val(today.format('YYYYMMDD'));
    $('#range_date_end-value').val(tomorrow.format('YYYYMMDD'));


    $('#plan_date_start-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
    $('#plan_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('MM') + "月" + tomorrow.format('DD') + "日(" + days_short[tomorrow.weekday()] + ")");
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



$('#date').on('change blur', function() {
    var check = moment($('#date').val());
    var days_short = ["日","月","火","水","木","金","土"];
    $('#date').val(check.format('YYYY') + "/" + check.format('MM') + "/" + check.format('DD') + "(" + days_short[check.weekday()] + ")");
    $('#date-view').val(check.format('YYYY') + "年" + check.format('MM') + "月" + check.format('DD') + "日(" + days_short[check.weekday()] + ")");
    $('#date-value').val(check.format('YYYYMMDD'));
});
$(".room_range_date").on('change blur', function() {
    var check2 = moment($('#range_date_start').val());
    var check1 = moment($('#range_date_end').val());
    var days_short = ["日","月","火","水","木","金","土"];
    $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
    $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
    $('#range_date_start-value').val(check2.format('YYYYMMDD'));
    $('#range_date_end-value').val(check1.format('YYYYMMDD'));
});


$('#confirm').on('change', function() {
    if($(this).is(":checked")){
        $(".confirm-rules").prop("disabled", false);
    }else{
        $(".confirm-rules").prop("disabled", true);
    }
});






