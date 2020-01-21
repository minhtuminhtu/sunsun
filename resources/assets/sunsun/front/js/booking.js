$(function() {
    let modal_choice_time = $('#choice_date_time');
    var days_short = ["日","月","火","水","木","金","土"];
    var today = moment();
    if(today.weekday() == 3){
        today = moment(today).add(2, 'days');
    }else if(today.weekday() == 4){
        today = moment(today).add(1, 'days');
    }
    var tomorrow = moment(today).add(1, 'days');



    let get_service = function(course, course_data, course_time) {
        // delete validate color
        $('#bus_arrive_time_slide').closest('button').css({'border': 'solid 1px #ced4da'});
        // end validate color

        if(course == ""){
            course = $('#course').val();
        }
        let data = {
            'service': course,
            'course_data' : course_data,
            'course_time' : course_time
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
                load_event(true);
                load_after_ajax();
                load_time_list();
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    }
    $('#course').on('change', function() {
        get_service($('#course').val(), $('#course_data').val(), $('#course_time').val());
    });
    get_service($('#pick_course').val(), $('#course_data').val(), $('#course_time').val());




    let load_event = function(date_check = false) {
        var strToday = today.format('Y') + "/" + today.format('MM') + "/" + today.format('DD');
        var strTomorrow = tomorrow.format('Y') + "/" + tomorrow.format('MM') + "/" + tomorrow.format('DD');

        if(($('#date').val() == "") && ($('#date').val() !== undefined)){

            $('#date').val(strToday);
        }


        if($('#plan_date_start').val() == ""){
            $('#plan_date_start').val(strToday);
        }
        if($('#plan_date_end').val() == ""){
            $('#plan_date_end').val(strTomorrow);
        }

        $('#room').off('change');
        $('#room').on('change', function() {
            var room =  JSON.parse($('#room').val());
            if(room.kubun_id == '01'){
                $('.room').hide();
            }else{
                $.ajax({
                    url: $site_url +'/get_free_room',
                    type: 'POST',
                    data:  {
                        room: room.kubun_id
                    },
                    dataType: 'text',
                    beforeSend: function () {
                        loader.css({'display': 'block'});
                    },
                    success: function (html) {
                        console.log(html);
                        html = JSON.parse(html);
                        console.log(html.now);
                        $('.input-daterange').datepicker('destroy');
                        $('#range_date_start').val(html.now);
                        let valid_date = moment(new Date(html.now));
                        console.log(valid_date.weekday());
                        if(valid_date.weekday() == 2){
                            $('#range_date_end').val(valid_date.add(3, 'days').format('Y/MM/DD'));
                        }else{
                            $('#range_date_end').val(valid_date.add(1, 'days').format('Y/MM/DD'));
                        }


                        $('.input-daterange').datepicker({
                            language: 'ja',
                            dateFormat: 'yyyy/mm/dd',
                            autoclose: true,
                            startDate: new Date(),
                            daysOfWeekDisabled: "3,4",
                            datesDisabled: html.date_selected,
                            weekStart: 1,
                            orientation: 'bottom',
                        });

                        let range_start = moment(new Date($('#range_date_start').val()));
                        let range_end = moment(new Date($('#range_date_end').val()));
                        $('#range_date_start-view').val(range_start.format('YYYY') + "年" + range_start.format('MM') + "月" + range_start.format('DD') + "日(" + days_short[range_start.weekday()] + ")");
                        $('#range_date_end-view').val(range_end.format('YYYY') + "年" + range_end.format('MM') + "月" + range_end.format('DD') + "日(" + days_short[range_end.weekday()] + ")");

                        $('#range_date_start-value').val(range_start.format('YYYYMMDD'));
                        $('#range_date_end-value').val(range_end.format('YYYYMMDD'));

                        $('.room').show();
                    },
                    complete: function () {
                        loader.css({'display': 'none'});
                    },
                });

            }
        });

        $('#whitening').off('change');
        $('#whitening').on('change', function() {
            var whitening =  JSON.parse($('#whitening').val());
            if(whitening.kubun_id == '01'){
                $('.whitening').hide();
            }else{
                $('.whitening').show();
            }
        });

        DatePicker = {
            hideOldDays: function(){
                var x = $('td.old.day');
                if(x.length > 0){
                    x.css('visibility', 'hidden');
                    if(x.length === 7){
                        x.parent().hide();
                    }
                }
            },
            hideNewDays: function(){
                var x = $('td.new.day');
                if(x.length > 0){
                    x.hide();
                }
            },
            hideOtherMonthDays: function(){
                DatePicker.hideOldDays();
                DatePicker.hideNewDays();
            }
        };

        if(window.location.href.includes("admin")){
            console.log('admin');
            $('#date').datepicker({
                container: '.mail-booking',
                language: 'ja',
                dateFormat: "yyyy/mm/dd",
                startDate: new Date(),
                autoclose: true,
                daysOfWeekDisabled: "3,4",
                weekStart: 1,
                orientation: 'bottom',
            });
        }else{
            $('#date').datepicker({
                language: 'ja',
                dateFormat: "yyyy/mm/dd",
                startDate: new Date(),
                autoclose: true,
                daysOfWeekDisabled: "3,4",
                weekStart: 1,
                orientation: 'bottom',
                // datesDisabled: ['2019-12-17','2019-12-16'],
            });
        }

        $('#date').datepicker().off('hide');
        $('#date').datepicker().on('hide', function(e) {
            change_day();
        });
        $('#date').datepicker().on('show', function(e) {
            DatePicker.hideOtherMonthDays();
        });



        if(date_check){
            if(($('#date').val() !== undefined) && ($('#date').val() != '')){
                let date_value = moment(new Date($('#date').val()));
                // console.log('begin1');
                // console.log(date_value);
                // console.log($('#date').val());
                // console.log('end1');
                //
                // let date_pick = date_value.format('Y') + "/" + date_value.format('MM') + "/" + date_value.format('DD');
                // // $('#date').val(date_pick + "(" + days_short[moment(new Date(date_pick)).weekday()] + ")");
                //
                //
                //
                let current_date = date_value.format('Y') + '/' + date_value.format('MM') + '/' + date_value.format('DD') + "(" + days_short[date_value.weekday()] + ")";
                $('#date').val(current_date);
                // console.log(date_value.weekday());
                //
                //
                // // $('#date').val();
            }

        }



        if(window.location.href.includes("admin")){
            $('.input-daterange').datepicker({
                container: '.mail-booking',
                language: 'ja',
                dateFormat: 'yyyy/mm/dd',
                autoclose: true,
                startDate: new Date(),
                daysOfWeekDisabled: "3,4",
                // daysOfWeekHighlighted: "1,2",
                weekStart: 1,
                orientation: 'bottom',
            });

        }else{
            $('.input-daterange').datepicker({
                language: 'ja',
                dateFormat: 'yyyy/mm/dd',
                autoclose: true,
                startDate: new Date(),
                daysOfWeekDisabled: "3,4",
                // daysOfWeekHighlighted: "1,2",
                weekStart: 1,
                orientation: 'bottom',
            });
        }


        let get_end_date = function(){
            var start_date = moment(new Date($('#plan_date_start').val()));
            var end_date;
            if(start_date.weekday() == 5){
                end_date = start_date.add(4, 'days').toDate();
            }else{
                end_date = start_date.add(6, 'days').toDate();
            }

            return end_date;
        }

        if(window.location.href.includes("admin")){
            $('#plan_date_start').datepicker({
                container: '.mail-booking',
                language: 'ja',
                dateFormat: 'yyyy/mm/dd',
                autoclose: true,
                startDate: new Date(),
                daysOfWeekDisabled: "3,4",
                // daysOfWeekHighlighted: "1,2",
                weekStart: 1,
                orientation: 'bottom',
            });

        }else{
            $('#plan_date_start').datepicker({
                language: 'ja',
                dateFormat: 'yyyy/mm/dd',
                autoclose: true,
                startDate: new Date(),
                daysOfWeekDisabled: "3,4",
                // daysOfWeekHighlighted: "1,2",
                weekStart: 1,
                orientation: 'bottom',
            });
        }


        if(window.location.href.includes("admin")){
            $('#plan_date_end').datepicker({
                container: '.mail-booking',
                language: 'ja',
                dateFormat: 'yyyy/mm/dd',
                autoclose: true,
                startDate: new Date(),
                endDate: get_end_date(),
                daysOfWeekDisabled: "3,4",
                weekStart: 1,
                orientation: 'bottom',
            });

        }else{
            $('#plan_date_end').datepicker({
                language: 'ja',
                dateFormat: 'yyyy/mm/dd',
                autoclose: true,
                startDate: new Date(),
                endDate: get_end_date(),
                daysOfWeekDisabled: "3,4",
                weekStart: 1,
                orientation: 'bottom',
            });
        }

        var range_date_temp = [];



        $('#range_date_start').datepicker().on('hide', function () {
            // $('#range_date_end').focus();
        });
        $('#plan_date_start').datepicker().on('hide', function () {
            $('#plan_date_end').datepicker('destroy');
            if($.inArray(moment(new Date($('#plan_date_start').val())).format('YYYY-MM-DD'), range_date_temp) == -1){
                $('#plan_date_end').val(moment(new Date($('#plan_date_start').val())).add(0, 'days').format('YYYY/MM/DD'));
            }


            if(window.location.href.includes("admin")){
                $('#plan_date_end').datepicker({
                    container: '.mail-booking',
                    language: 'ja',
                    dateFormat: 'yyyy/mm/dd',
                    autoclose: true,
                    startDate: new Date($('#plan_date_start').val()),
                    endDate: get_end_date(),
                    daysOfWeekDisabled: "3,4",
                    weekStart: 1,
                    orientation: 'bottom',
                });
            }else{
                $('#plan_date_end').datepicker({
                    language: 'ja',
                    dateFormat: 'yyyy/mm/dd',
                    autoclose: true,
                    startDate: new Date($('#plan_date_start').val()),
                    endDate: get_end_date(),
                    daysOfWeekDisabled: "3,4",
                    weekStart: 1,
                    orientation: 'bottom',
                });
            }
            $('#plan_date_end').focus();
        });
        let highlight = function(start){
            var highlight = get_dates($('#plan_date_start').val(), $('#plan_date_end').val());

            highlight.forEach(function(element,index) {
                let date_hl = moment(element + " 00:00 +0000", 'YYYY-MM-DD HH:mm Z').utc().format("X") + "000";
                if((index == 0) || (index == (highlight.length - 1))){
                    if(((start)&&(index == 0)) || ((!start)&&(index == (highlight.length - 1)))){
                        $( "td[data-date='" + date_hl + "']" ).css('background-image','linear-gradient(to bottom, #08c, #0044cc)');
                    }else{
                        $( "td[data-date='" + date_hl + "']" ).css('background','#9e9e9e');
                    }
                    $( "td[data-date='" + date_hl + "']" ).css('color','#fff');
                }else{
                    $( "td[data-date='" + date_hl + "']" ).css('background','#eee');
                    $( "td[data-date='" + date_hl + "']" ).css('border-radius','unset');
                    $( "td[data-date='" + date_hl + "']" ).css('color','#212529');
                }
            });
        }




        $('#plan_date_start').datepicker().on('show', function(e) {
            DatePicker.hideOtherMonthDays();
            highlight(true);
        });
        $('#plan_date_end').datepicker().on('show', function(e) {
            DatePicker.hideOtherMonthDays();
            highlight(false);
        });
        $('#plan_date_end').datepicker().on('hide', function(e) {
            range_date_temp = get_dates($('#plan_date_start').val(), $('#plan_date_end').val());
        });







        $('.input-daterange').datepicker().on('show', function(e) {
            DatePicker.hideOtherMonthDays();

        });

        $('.agecheck').on('click', function() {
            $('.agecheck').removeClass('color-active');
            $('.agecheck').addClass('btn-outline-warning');
            $(this).addClass('color-active');
            $(this).removeClass('btn-outline-warning');

            $('#agecheck').val($(this).val())

            if(($(this).val() == '1') || ($(this).val() == '2')){
                $('.age-left').css("visibility", "hidden");
            }else if($(this).val() == '3'){
                $('.age-left').css("visibility", "visible");
            }
        });

        function change_day(){
            $('#error_time_0').val('－');
            $('#time\\[0\\]\\[value\\]').val(0);
            $('#time\\[0\\]\\[bed\\]').val(0);
            $('#time\\[0\\]\\[json\\]').val('');
            $('.time-content').empty();

            $('#time1-value').val(0);
            $('#time1-bed').val(0);
            $('#time1-view').val('－');
            $('#time\\[0\\]\\[json\\]').val('');

            $('#time2-value').val(0);
            $('#time2-bed').val(0);
            $('#time2-view').val('－');
            $('#time\\[1\\]\\[json\\]').val('');

            $('#time_room_value').val(0);
            $('#time_room_bed').val(0);
            $('#time_room_view').val('－');
            $('#time\\[0\\]\\[json\\]').val('');

            $('#time_room_time1').val('0');
            $('#time_room_time2').val('0');
            $('#time_room_pet_0').val('－');
            $('#time_room_pet_json').val('');

            $('#whitening-time_view').val('－');
            $('#whitening-time_value').val('0');
            $('#whitening_data\\[json\\]').val('');







            let new_day = moment(new Date($('#date').val()));
            let days_short = new Array("日","月","火","水","木","金","土");
            $('#date').val(new_day.format('YYYY') + "/" + new_day.format('MM') + "/" + new_day.format('DD') + "(" + days_short[new_day.weekday()] + ")");
            $('#date-value').val(new_day.format('YYYYMMDD'));
            $('#date-view').val(new_day.format('YYYY') + "年" + new_day.format('MM') + "月" + new_day.format('DD') + "日(" + days_short[new_day.weekday()] + ")");
        }

        $(".room_range_date").on('change blur', function() {
            let range_start = moment(new Date($('#range_date_start').val()));
            let range_end = moment(new Date($('#range_date_end').val()));
            $('#range_date_start-view').val(range_start.format('YYYY') + "年" + range_start.format('MM') + "月" + range_start.format('DD') + "日(" + days_short[range_start.weekday()] + ")");
            $('#range_date_end-view').val(range_end.format('YYYY') + "年" + range_end.format('MM') + "月" + range_end.format('DD') + "日(" + days_short[range_end.weekday()] + ")");
            $('#range_date_start-value').val(range_start.format('YYYYMMDD'));
            $('#range_date_end-value').val(range_end.format('YYYYMMDD'));
        });
        load_pick_time_event();
        load_pick_time_room_event();
        load_pick_time_wt_event();
        load_pick_time_pet_event();
    };
    load_event();

    modal_choice_time.on('show.bs.modal', function (e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog modal-dialog-centered zoomIn  animated faster');
    })
    modal_choice_time.on('hide.bs.modal', function (e) {
        if(window.location.href.includes("admin")){
            console.log("admin");
        }else{


            // setTimeout(function(){ alert("Hello"); }, 5000);
        }
    })

    let modal_time_hidden = function(){
        if(window.location.href.includes("admin")){
            $('.modal .modal-dialog').first().attr('class', 'modal-dialog  modal-dialog-centered  zoomOut  animated faster');
        }else{
            $('.modal .modal-dialog').attr('class', 'modal-dialog  modal-dialog-centered  zoomOut  animated faster');
            $('.modal-backdrop.show').css('opacity', '0');
        }
        setTimeout(function(){
            modal_choice_time.modal('hide');
        }, 500);
    }

    $('#btn-cancel').off('click');
    $('#btn-cancel').on('click', function(e) {
        modal_time_hidden();
    });

    modal_choice_time.off('hidden.bs.modal');
    modal_choice_time.on('hidden.bs.modal', function () {
        modal_choice_time.find('.modal-body-time').empty();
        $('.set-time').removeClass('edit');

        if(window.location.href.includes("admin")){
            $('#edit_booking').css("z-index", "");
            $('body').addClass('modal-open');
        }
    });
    modal_choice_time.draggable({
        handle: ".title-table-time"
    });

    modal_choice_time.off('click','#js-save-time');
    modal_choice_time.on('click','#js-save-time',function (e) {
        let time = modal_choice_time.find('input[name=time]:checked').val();
        let bed = modal_choice_time.find('input[name=time]:checked').closest('div').find('.bed').val();
        let data_json = modal_choice_time.find('input[name=time]:checked').closest('div').find('input[name=data-json]').val();
        var num = $('.booking-time').length;
        var time_value = time_value = time.replace(/[^0-9]/g,'');


        if($('#new-time').val() == 1){
            let $html = $('' +
                '<div class="block-content-1 margin-top-mini"> ' +
                '<div class="block-content-1-left"><div class="timedate-block set-time">    ' +
                '<input name="time[' + num + '][view]" type="text" class="form-control time js-set-time booking-time bg-white" id="error_time_' + num + '" readonly="readonly"  value="" />' +
                '<input name="time[' + num + '][value]" class="time_value" id="time[' + num + '][value]" type="hidden" value="">' +
                '<input name="time[' + num + '][bed]" class="time_bed" id="time[' + num + '][bed]" type="hidden" value="">' +
                '<input name="time[' + num + '][json]" class="data-json_input" id="time[' + num + '][json]" type="hidden" >' +
                '<input name="time[' + num + '][element]" id="" type="hidden" value="error_time_' + num + '">'+
                '</div> </div> <div class="block-content-1-right"><img class="svg-button" src="/sunsun/svg/close.svg" alt="Close" /></div>           </div>');
            $html.find('.data-json_input').val(data_json);
            $(".time-content").append($html);
            load_time_delete_event();
            load_pick_time_event();
            $('.booking-time').last().val(time);
            $('.time_value').last().val(time_value);
            $('.time_bed').last().val(bed);

        }else{
            // console.log('set time');
            // console.log($('.set-time.edit input.time').parent());
            $('.set-time.edit input.time').val(time);
            $('.set-time.edit input.time').parent().find('.time_value').val(time_value);
            $('.set-time.edit input.time').parent().find('.time_bed').val(bed);
        }
        $('.set-time.edit input.time').parent().find('#time1-value').val(time_value);
        $('.set-time.edit input.time').parent().find('#time2-value').val(time_value);
        $('.set-time.edit input.time').parent().find('#time1-bed').val(bed);
        $('.set-time.edit input.time').parent().find('#time2-bed').val(bed);
        $('.set-time.edit input.time').parent().find('#time_room_value').val(pad(time_value, 4));
        $('.set-time.edit input.time').parent().find('#time_room_bed').val(bed);


        $('.set-time.edit input.time').parent().find('.time_from').val(time_value);
        $('.set-time.edit input.time').parent().find('.time_to').val(time_value);
        $('.set-time.edit input.time').parent().find('.time_bed').val(bed);

        $('.set-time.edit input.time').parent().find('.data-json_input').val(data_json);

        //console.log(modal_choice_time.find('input[name=time]:checked').parent().find('input[name=data-json]'));
        function pad(n, width) {
            n = n + '';
            return n.length >= width ? n :
                new Array(width - n.length + 1).join('0') + n;
        }

        if(time.includes("～")){
            var res = time.split("～");
            $('.set-time.edit input.time').parent().find('#time_room_time1').val(pad(res[0].replace(/[^0-9]/g,''), 4));
            $('.set-time.edit input.time').parent().find('#time_room_time2').val(pad(res[1].replace(/[^0-9]/g,''), 4));
            $('.set-time.edit input.time').parent().find('#whitening-time_value').val(pad(res[0].replace(/[^0-9]/g,''), 4) + '-' + pad(res[1].replace(/[^0-9]/g,''), 4));
        }

        modal_time_hidden();
    })

    $('li.dropdown-item').off('click');
    $('li.dropdown-item').on('click', function() {
        $('li.dropdown-item').removeClass('active');
        $(this).addClass('active');
        $('#bus_arrive_time_slide').val($(this).find('.bus_arrive_time_slide').val());
        $("#bus_time_first").text($(this).find(".bus_time_first").text());
        $("#bus_time_second").text($(this).find(".bus_time_second").text());
        let btn_click = $(this);
        $.ajax({
            url: $site_url +'/validate_before_booking',
            type: 'POST',
            data: $('form.booking').serializeArray(),
            dataType: 'JSON',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (json) {
                console.log(json);
                make_color_input_error(json , false);
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });

    $('#repeat_user').off('change');
    $('#repeat_user').on('change', function(e) {
        let repeat_user = JSON.parse($('#repeat_user').val());
        if(repeat_user.kubun_id == '01'){
            $('#hint-repeat').text('※バスの場合、到着時間から30分以内の予約はできません。希望時間が選択できない場合は　バス到着時間をご確認ください。');
        }else{
            $('#hint-repeat').text('※バスの場合、到着時間から15分以内の予約はできません。希望時間が選択できない場合は　バス到着時間をご確認ください。');
        }
        let btn_click = $(this);
        $.ajax({
            url: $site_url +'/validate_before_booking',
            type: 'POST',
            data: $('form.booking').serializeArray(),
            dataType: 'JSON',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (json) {
                console.log(json);
                make_color_input_error(json , false);
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });



    $('#transport').off('change');
    $('#transport').on('change', function(e) {
        var transport =  JSON.parse($('#transport').val());
        if(transport.kubun_id == '01'){
            $('.bus').hide();
        }else{
            $('.bus').show();
        }
        let btn_click = $(this);
        $.ajax({
            url: $site_url +'/validate_before_booking',
            type: 'POST',
            data: $('form.booking').serializeArray(),
            dataType: 'JSON',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (json) {
                console.log(json);
                make_color_input_error(json , false);
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });

    $('.btn-booking').off('click');
    $('.btn-booking').on('click', function(e) {
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
            success: function (json) {
                console.log(json);
                if (json.status == "OK") {
                    if (btn_click.hasClass('add-new-people')) {
                        window.location.href = $site_url +'/booking?add_new_user=on';
                    } else {
                        window.location.href = $site_url +'/confirm';
                    }
                } else {
                    make_color_input_error(json)
                }

            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });

    let make_color_input_error = (json, type = true) => {
        $('p.note-error').remove();
        // if (typeof json.clear_border_red !== "undefined" ) {
        //     $.each(json.clear_border_red, function (index, item) {
        //         $('#'+item.element).css({'border': 'solid 1px #ced4da'});
        //         $('#bus_arrive_time_slide').closest('button').css({'border': 'solid 1px #ced4da'});
        //         $('select[name=gender]').css({'border': 'solid 1px #ced4da'});
        //     })
        // }

        $('.validate_failed').removeClass('validate_failed');
        if (((typeof json.error_time_transport !== "undefined" )
            || (typeof json.error_time_gender  !== "undefined")
            || (typeof json.error_time_empty  !== "undefined")
            || (typeof json.room_select_error  !== "undefined")
            || (typeof json.error_fasting_plan_holyday  !== "undefined")
        ) && (type)){
            Swal.fire({
                icon: 'warning',
                text: '入力した内容を確認してください。',
                confirmButtonColor: '#d7751e',
                confirmButtonText: '閉じる',
                width: 350,
                showClass: {
                    popup: 'animated zoomIn faster'
                },
                hideClass: {
                    popup: 'animated zoomOut faster'
                },
                allowOutsideClick: false
            })
        }

        if (typeof json.error_time_transport !== "undefined" ) {
            $.each(json.error_time_transport, function (index, item) {
                let input_error_transport = $('#'+item.element);
                input_error_transport.addClass('validate_failed');
                let repeat_user = JSON.parse($('#repeat_user').val());
                if(repeat_user.kubun_id == '01'){
                    input_error_transport.parent().after('<p class="note-error node-text">バス停からの移動と初回説明の時間があるので、バスの到着時間から30分以内の予約はできません。</p>');
                }else if(repeat_user.kubun_id == '02'){
                    input_error_transport.parent().after('<p class="note-error node-text">バス停からの移動があるので、バスの到着時間から15分以内の予約はできません。</p>');
                }
                $('#bus_arrive_time_slide').closest('button').addClass('validate_failed');
            })
        }
        if (typeof json.error_time_gender  !== "undefined") {
            $.each(json.error_time_gender, function (index, item) {
                let input_error_gender = $('#'+item.element);
                input_error_gender.addClass('validate_failed');
                input_error_gender.parent().after('<p class="note-error node-text"> 選択された時間は予約できません。</p>');
                $('select[name=gender]').addClass('validate_failed');
            })
        }
        if ((typeof json.error_time_empty  !== "undefined") && (type)) {
            $.each(json.error_time_empty, function (index, item) {
                let input_error_required = $('#'+item.element);
                input_error_required.addClass('validate_failed');
                input_error_required.parent().after('<p class="note-error node-text"> 予約時間を選択してください。</p>');
            })
        }
        if (typeof json.room_select_error  !== "undefined") {
            $.each(json.room_select_error, function (index, item) {
                $('#'+item.element).addClass('validate_failed');
            })
            var text_err = "選択された日は予約できません";
            if (json.room_error_holiday == "1")
                text_err = "定休日が含まれているため予約できません";
            $('#range_date_start').parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+text_err+'。</p>');
        }
        if (typeof json.error_fasting_plan_holyday  !== "undefined") {
            $.each(json.error_fasting_plan_holyday, function (index, item) {
                $('#'+item.element).addClass('validate_failed');
            });
            var text_err = "定休日が含まれているため予約できません";
            $('#plan_date_start').parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+text_err+'。</p>');
        }
    };

    let load_time_list = function(check = null) {
        let check_admin_set = $(".time-list").attr("value");
        if((!check) && !(check_admin_set == 1)){
            $('.time-list').append('' +
                '<div class="booking-field choice-time">' +
                '<input value="0" class="time_index" type="hidden" >' +
                '<div class="booking-field-label label-data pt-2">' +
                '<label class="">' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')</label>' +
                '<input name="date['+ 0 +'][day][view]" value="' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')" type="hidden" >' +
                '<input name="date['+ 0 +'][day][value]" value="'  + today.format('YYYY') + today.format('MM') +  today.format('DD') +'" type="hidden" >' +
                '</div>    <div class="booking-field-content date-time">' +
                '<div class="choice-data-time set-time time-start">    ' +
                '<div class="set-time">' +
                '<input name="date['+ 0 +'][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" />' +
                '<input name="date['+ 0 +'][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" />' +
                '<input name="date['+ 0 +'][from][view]" type="text" id="time_bath_10" class="time form-control js-set-time bg-white" data-date_value="'  + today.format('YYYY') + today.format('MM') +  today.format('DD') +'" data-date_type="form" readonly="readonly"  value="－" />    ' +
                '<input name="time['+ 0 +'][from][json]" type="hidden" class="data-json_input" value="" />' +
                '<input name="time['+ 0 +'][from][element]" type="hidden" value="time_bath_10" />' +
                '<input class="bus_first" type="hidden" value="1">' +
                '</div>    <div class="icon-time mt-1">' +
                '</div>' +
                '</div>' +
                '<div class="choice-data-time set-time time-end">    ' +
                '<div class="set-time">' +
                '<input name="date['+ 0 +'][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" />' +
                '<input name="date['+ 0 +'][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" />' +
                '<input name="date['+ 0 +'][to][view]" type="text" id="time_bath_11" class="time form-control js-set-time bg-white" data-date_value="'  + today.format('YYYY') + today.format('MM') +  today.format('DD') +'" data-date_type="to"  readonly="readonly"  value="－" />    ' +
                '<input name="time['+ 0 +'][to][json]" type="hidden" class="data-json_input" value="" />' +
                '<input name="time['+ 0 +'][to][element]" type="hidden" value="time_bath_11" />' +
                '<input class="bus_first" type="hidden" value="1">' +
                '</div>    <div class="icon-time mt-1"></div></div>    </div></div>');
            $('.time-list').append('' +
                '<div class="booking-field choice-time">' +
                '<input value="1" class="time_index" type="hidden" >' +
                '<div class="booking-field-label label-data pt-2">' +
                '<label class="">' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')</label>' +
                '<input name="date['+ 1 +'][day][view]" value="' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')" type="hidden" >' +
                '<input name="date['+ 1 +'][day][value]" value="' + today.format('YYYY') + tomorrow.format('MM') +  tomorrow.format('DD') +'" type="hidden" ></div>    <div class="booking-field-content date-time">' +
                '<div class="choice-data-time set-time time-start">    <div class="set-time">' +
                '<input name="date['+ 1 +'][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" />' +
                '<input name="date['+ 1 +'][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" />' +
                '<input name="date['+ 1 +'][from][view]" type="text" id="time_bath_21" class="time form-control js-set-time bg-white" data-date_value="' + tomorrow.format('YYYY') + tomorrow.format('MM') +  tomorrow.format('DD') +'"  data-date_type="form"  readonly="readonly"  value="－" />   ' +
                '<input name="time['+ 1 +'][from][json]" id="" type="hidden" class="data-json_input" value="" />' +
                '<input name="time['+ 1 +'][from][element]" type="hidden" value="time_bath_21" />' +
                ' </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time">' +
                '<input name="date['+ 1 +'][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" />' +
                '<input name="date['+ 1 +'][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" />' +
                '<input name="time['+ 1 +'][to][json]" type="hidden" class="data-json_input" value="" />' +
                '<input name="time['+ 1 +'][to][element]" type="hidden" value="time_bath_22" />' +
                '<input name="date['+ 1 +'][to][view]" type="text" id="time_bath_22" class="time form-control js-set-time bg-white" data-date_value="' + tomorrow.format('YYYY') + tomorrow.format('MM') +  tomorrow.format('DD') +'"  data-date_type="to" readonly="readonly"  value="－" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');

        }
        $(".range_date").change(function(){
            var date_arr = get_dates($('#plan_date_start').val(), $('#plan_date_end').val());
            $('.time-list').empty();
            moment.locale('ja');
            date_arr.forEach(function(element,index) {
                let check = moment(element)
                let year = check.format('YYYY');
                let month = check.format('MM');
                let day   = check.format('DD');
                let week_day =  check.weekday();
                let bus_first = '';
                if(index === 0){
                    bus_first = '<input class="bus_first" type="hidden" value="1">';
                }
                $('.time-list').append('<div class="booking-field choice-time">' +
                    '<input value="' + index + '" class="time_index" type="hidden" >' +
                    '<div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label>' +
                    '<input name="date['+ index +'][day][view]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" >' +
                    '<input name="date['+ index +'][day][value]" value="' + year + month +  day +'" type="hidden" ></div>   ' +
                    ' <div class="booking-field-content date-time"><div class="choice-data-time set-time time-start">    <div class="set-time">' +
                    '<input name="date['+ index +'][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" />' +
                    '<input name="date['+ index +'][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" />' +
                    '<input name="date['+ index +'][from][view]" type="text" id="time_bath_'+ index +'1"  class="time form-control js-set-time bg-white" data-date_value="' + year + month +  day +'" data-date_type="form"  readonly="readonly"  value="－" />    ' +
                    '<input name="time['+ index +'][from][element]" type="hidden" value="time_bath_'+ index +'1" />' +
                    bus_first +
                    '<input name="time['+ index +'][from][json]" type="hidden" class="data-json_input" value="" />' +
                    '</div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time">' +
                    '<input name="date['+ index +'][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" />' +
                    '<input name="date['+ index +'][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" />' +
                    '<input name="time['+ index +'][to][json]" type="hidden" class="data-json_input" value="" />' +
                    '<input name="time['+ index +'][to][element]" type="hidden" value="time_bath_'+ index +'2" />' +
                    bus_first +
                    '<input name="date['+ index +'][to][view]" type="text" id="time_bath_'+ index +'2" class="time form-control js-set-time bg-white" data-date_value="' + year + month +  day +'" data-date_type="to"  readonly="readonly"  value="－" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
            });
            let check2 = moment(new Date($('#plan_date_start').val()));
            let check1 = moment(new Date($('#plan_date_end').val()));
            $('#plan_date_start-value').val(check2.format('YYYY') + check2.format('MM') + check2.format('DD'));
            $('#plan_date_end-value').val(check1.format('YYYY') + check1.format('MM') + check1.format('DD'));
            $('#plan_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
            $('#plan_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
            load_event();
        });
        load_event();
    };
    load_time_list();
});


let load_time_delete_event = function(){
    $('.svg-button').off('click');
    $('.svg-button').on('click', function() {
        if (window.location.href.includes("admin")) {
            Swal.fire({
                target: '#edit_booking',
                text: "予約時間を削除します、よろしいですか?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d7751e',
                cancelButtonColor: '#343a40',
                confirmButtonText: 'はい',
                cancelButtonText: 'いいえ',
                width: 350,
                showClass: {
                    popup: 'animated zoomIn faster'
                },
                hideClass: {
                    popup: 'animated zoomOut faster'
                },
                // customClass: {
                //     popup: 'modal-dialog'
                // },
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                $($(this).parent().parent().remove());
                }
            })
        } else {
            Swal.fire({
                text: "予約時間を削除します、よろしいですか?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d7751e',
                cancelButtonColor: '#343a40',
                confirmButtonText: 'はい',
                cancelButtonText: 'いいえ',
                width: 350,
                showClass: {
                    popup: 'animated zoomIn faster'
                },
                hideClass: {
                    popup: 'animated zoomOut faster'
                },
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                $($(this).parent().parent().remove());
                }
            })
        }
    });
}

function pad(n, width) {
    n = n + '';
    return n.length >= width ? n :
        new Array(width - n.length + 1).join('0') + n;
}

let load_pick_time_event = function(){
    let modal_choice_time = $('#choice_date_time');
    let set_time = $('.js-set-time');

    set_time.off('click');
    set_time.on('click', function() {
        let bus_first = $(this).parent().find('.bus_first').val();
        let set_time_click = $(this);
        if(bus_first !== undefined){
            $('#bus_first').val(1);
        }else{
            $('#bus_first').val(0);
        }
        let $data = $('form.booking').serializeArray();
        let $get_date = {};
        $get_date.name = "data_get_attr";
        let $value = {};
        $value.date = set_time_click.attr('data-date_value');
        $value.date_type = set_time_click.attr('data-date_type');
        $get_date.value = JSON.stringify($value);
        $data.push($get_date);
        $.ajax({
            url: '/get_time_room',
            type: 'POST',
            data:  $data,
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                set_time_click.closest('.set-time').addClass('edit')
                if(window.location.href.includes("admin")){
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal({
                        show: true,
                        backdrop: false,
                        keyboard: false
                    });
                    $('#edit_booking').css("z-index", "0");
                }else{
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false
                    });
                }
            },
                complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });
}
let load_pick_time_room_event = function(){
    let modal_choice_time = $('#choice_date_time');
    let get_room = $('.js-set-room');
    get_room.off('click');
    get_room.on('click', function() {

        let set_time_click = $(this);
        let $data = $('form.booking').serializeArray();
        let $get_date = {};
        $get_date.name = "data_get_attr";
        let $value = {};
        $value.date = set_time_click.attr('data-date_value');
        $value.date_type = set_time_click.attr('data-date_type');
        $get_date.value = JSON.stringify($value);
        $data.push($get_date);
        $.ajax({
            url: $site_url +'/book_room',
            type: 'POST',
            data: $data ,
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                set_time_click.closest('.set-time').addClass('edit')
                if(window.location.href.includes("admin")){
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal({
                        show: true,
                        backdrop: false,
                        keyboard: false
                    });
                    $('#edit_booking').css("z-index", "0");
                }else{
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false
                    });
                }
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });
}
let load_pick_time_wt_event = function(){
    let modal_choice_time = $('#choice_date_time');
    let get_room_wt = $('.js-set-room_wt');
    get_room_wt.off('click');
    get_room_wt.on('click', function() {
        let set_time_click = $(this);
        let $data = $('form.booking').serializeArray();
        let $get_date = {};
        $get_date.name = "data_get_attr";
        $data.push($get_date);

        $.ajax({
            url: $site_url +'/book_time_room_wt',
            type: 'POST',
            data: $data ,
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                set_time_click.closest('.set-time').addClass('edit')
                if(window.location.href.includes("admin")){
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal({
                        show: true,
                        backdrop: 'static',
                        backdrop: false
                    });
                    $('#edit_booking').css("z-index", "0");
                }else{
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal('show');
                }
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });
}
let load_pick_time_pet_event = function(){
    let modal_choice_time = $('#choice_date_time');
    let get_room_pet = $('.js-set-room_pet');
    get_room_pet.off('click');
    get_room_pet.on('click', function() {
        let set_time_click = $(this);
        let $data = $('form.booking').serializeArray();
        let $get_date = {};
        $get_date.name = "data_get_attr";
        let $value = {};
        $value.date = set_time_click.attr('data-date_value');
        $value.date_type = set_time_click.attr('data-date_type');
        $get_date.value = JSON.stringify($value);
        $data.push($get_date);
        $.ajax({
            url: $site_url +'/book_time_room_pet',
            type: 'POST',
            data: $data,
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                set_time_click.closest('.set-time').addClass('edit')
                if(window.location.href.includes("admin")){
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal({
                        show: true,
                        backdrop: 'static',
                        backdrop: false
                    });
                    $('#edit_booking').css("z-index", "0");
                }else{
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal('show');
                }
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });
}

let load_after_ajax = function(){
    let modal_choice_time = $('#choice_date_time');
    load_time_delete_event();
    var days_short = ["日","月","火","水","木","金","土"];
    var today = moment();
    if(today.weekday() == 3){
        today = moment(today).add(2, 'days');
    }else if(today.weekday() == 4){
        today = moment(today).add(1, 'days');
    }
    var tomorrow = moment(today).add(1, 'days');

    $('#add-time').off('click');
    $('#add-time').on('click', function() {

        let set_time_click = $(this);
        let $data = $('form.booking').serializeArray();
        let $get_date = {};
        $get_date.name = "data_get_attr";
        let $value = {};
        $value.date = set_time_click.attr('data-date_value');
        $value.date_type = set_time_click.attr('data-date_type');
        $value.new = 1;
        $get_date.value = JSON.stringify($value);
        $data.push($get_date);
        $.ajax({
            url: '/get_time_room',
            type: 'POST',
            data: $data,
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                set_time_click.closest('.set-time').addClass('edit')
                if(window.location.href.includes("admin")){
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal({
                        show: true,
                        backdrop: false
                    });
                    $('#edit_booking').css("z-index", "0");
                }else{
                    modal_choice_time.find('.modal-body-time').html(html);
                    modal_choice_time.modal('show');
                }
            },
                complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });

    $('#gender').off('change');
    $('#gender').on('change', function(e) {
        let btn_click = $(this);
        $.ajax({
            url: $site_url +'/validate_before_booking',
            type: 'POST',
            data: $('form.booking').serializeArray(),
            dataType: 'JSON',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (json) {
                console.log(json);
                make_color_input_error(json , false);
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });
    let make_color_input_error = (json, type = true) => {
        $('p.note-error').remove();
        // if (typeof json.clear_border_red !== "undefined" ) {
        //     $.each(json.clear_border_red, function (index, item) {
        //         $('#'+item.element).css({'border': 'solid 1px #ced4da'});
        //         $('#bus_arrive_time_slide').closest('button').css({'border': 'solid 1px #ced4da'});
        //         $('select[name=gender]').css({'border': 'solid 1px #ced4da'});
        //     })
        // }

        $('.validate_failed').removeClass('validate_failed');
        if (((typeof json.error_time_transport !== "undefined" )
            || (typeof json.error_time_gender  !== "undefined")
            || (typeof json.error_time_empty  !== "undefined")
            || (typeof json.room_select_error  !== "undefined")
            || (typeof json.error_fasting_plan_holyday  !== "undefined")
        ) && (type)){
            Swal.fire({
                icon: 'warning',
                text: '入力した内容を確認してください。',
                confirmButtonColor: '#d7751e',
                confirmButtonText: '閉じる',
                width: 350,
                showClass: {
                    popup: 'animated zoomIn faster'
                },
                hideClass: {
                    popup: 'animated zoomOut faster'
                },
                allowOutsideClick: false
            })
        }

        if (typeof json.error_time_transport !== "undefined" ) {
            $.each(json.error_time_transport, function (index, item) {
                let input_error_transport = $('#'+item.element);
                input_error_transport.addClass('validate_failed');

                let repeat_user = JSON.parse($('#repeat_user').val());
                if(repeat_user.kubun_id == '01'){
                    input_error_transport.parent().after('<p class="note-error node-text">バス停からの移動と初回説明の時間があるので、バスの到着時間から30分以内の予約はできません。</p>');
                }else if(repeat_user.kubun_id == '02'){
                    input_error_transport.parent().after('<p class="note-error node-text">バス停からの移動があるので、バスの到着時間から15分以内の予約はできません。</p>');
                }

                $('#bus_arrive_time_slide').closest('button').addClass('validate_failed');
            })
        }
        if (typeof json.error_time_gender  !== "undefined") {
            $.each(json.error_time_gender, function (index, item) {
                let input_error_gender = $('#'+item.element);
                input_error_gender.addClass('validate_failed');
                input_error_gender.parent().after('<p class="note-error node-text"> 選択された時間は予約できません。</p>');
                $('select[name=gender]').addClass('validate_failed');
            })
        }
        if ((typeof json.error_time_empty  !== "undefined") && (type)) {
            $.each(json.error_time_empty, function (index, item) {
                let input_error_required = $('#'+item.element);
                input_error_required.addClass('validate_failed');
                input_error_required.parent().after('<p class="note-error node-text"> 予約時間を選択してください。</p>');
            })
        }
        if (typeof json.room_select_error  !== "undefined") {
            $.each(json.room_select_error, function (index, item) {
                $('#'+item.element).addClass('validate_failed');
            })
            var text_err = "選択された日は予約できません";
            if (json.room_error_holiday == "1")
                text_err = "定休日が含まれているため予約できません";
            $('#range_date_start').parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+text_err+'。</p>');
        }
        if (typeof json.error_fasting_plan_holyday  !== "undefined") {
            $.each(json.error_fasting_plan_holyday, function (index, item) {
                $('#'+item.element).addClass('validate_failed');
            });
            var text_err = "定休日が含まれているため予約できません";
            $('#plan_date_start').parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+text_err+'。</p>');
        }

    };


    // $('.collapse-top').off('hidden.bs.collapse');
    // $('.collapse-top').on('hidden.bs.collapse', function () {
    //     $('#btn-collapse-top').attr("src","/sunsun/svg/plus.svg");
    // })
    // $('.collapse-top').off('shown.bs.collapse');
    // $('.collapse-top').on('shown.bs.collapse', function () {
    //     $('#btn-collapse-top').attr("src","/sunsun/svg/hide.svg");
    // })

    $('.collapse-between').off('hidden.bs.collapse');
    $('.collapse-between').on('hidden.bs.collapse', function () {
        $('#btn-collapse-between').attr("src","/sunsun/svg/plus.svg");
    })
    $('.collapse-between').off('shown.bs.collapse');
    $('.collapse-between').on('shown.bs.collapse', function () {
        $('#btn-collapse-between').attr("src","/sunsun/svg/hide.svg");
    })


    $('.collapse-finish').off('hidden.bs.collapse');
    $('.collapse-finish').on('hidden.bs.collapse', function () {
        $('#btn-collapse-finish').attr("src","/sunsun/svg/plus.svg");
    })
    $('.collapse-finish').off('shown.bs.collapse');
    $('.collapse-finish').on('shown.bs.collapse', function () {
        $('#btn-collapse-finish').attr("src","/sunsun/svg/hide.svg");
    })





    $('#edit_booking').off('click','.show_history');
    $('#edit_booking').on('click','.show_history',function (e) {
        e.preventDefault();
        let current_booking_id = $('#edit_booking').find("#booking_id").val();
        // let show_history = $('#history_modal');
        $.ajax({
            url: $site_url +'/admin/show_history',
            type: 'POST',
            data: {
                'booking_id' : current_booking_id,
                'is_history' : true
            },
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                modal_choice_time.find('.modal-body-time').html(html);
                modal_choice_time.modal({
                    show: true,
                    backdrop: false
                });
                $('#edit_booking').css("z-index", "0");
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    })

    $(document).on('touchmove', function () {
        $('#date').blur();
        $('#range_date_start').blur();
        $('#range_date_end').blur();
        $('#plan_date_start').blur();
        $('#plan_date_end').blur();
    });

    $('#date-value').val(today.format('YYYYMMDD'));
    $('#date-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");




    $('#plan_date_start-value').val(today.format('YYYY') + today.format('MM') + today.format('DD'));
    $('#plan_date_end-value').val(tomorrow.format('YYYY') + tomorrow.format('MM') + tomorrow.format('DD'));
    $('#plan_date_start-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
    $('#plan_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('MM') + "月" + tomorrow.format('DD') + "日(" + days_short[tomorrow.weekday()] + ")");
}

function get_dates(startDate, stopDate) {
    var dateArray = [];
    var currentDate = moment(new Date(startDate));
    var stopDate = moment(new Date(stopDate));
    while (currentDate <= stopDate) {
        if((moment(currentDate).weekday() != 3) && (moment(currentDate).weekday() != 4)){
            dateArray.push( moment(currentDate).format('YYYY-MM-DD'))
        }
        currentDate = moment(currentDate).add(1, 'days');
    }
    return dateArray;
}



