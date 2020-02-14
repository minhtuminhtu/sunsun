$(function () {
    let main_head__top = $('.main-head__top'),
        current_day = $('#input-current__date'),
        date_day = current_day.datepicker({
        language: 'ja',
        weekStart: 1,
        dateFormat: 'yyyy/mm/dd',
        autoclose: true,
        onSelect: function() {
            var mon = $(this).datepicker('getDate');
            mon.setDate(mon.getDate() + 1 - (mon.getDay() || 7));
            var sun = new Date(mon.getTime());
            sun.setDate(sun.getDate() + 6);
        }
    });
    $('#button-current__date').off('click');
    $('#button-current__date').on('click', function(e) {
        $('#input-current__date').focus();
    });
    current_day.on('input change',function (e) {
        let date = $(this).val().split('/').join('');
        window.location.href = $curent_url+"?date="+date;
    });
    if (current_day.val() === '') {
        date_day.datepicker("setDate", new Date());
        current_day.trigger("input");
    }
    main_head__top.on('click','.prev-date',function (e) {
        var date = date_day.datepicker('getDate');
        date.setTime(date.getTime() - (1000*60*60*24));
        date_day.datepicker("setDate", date);
        current_day.trigger("input");
    });
    main_head__top.on('click','.next-date',function (e) {
        var date = date_day.datepicker('getDate');
        date.setTime(date.getTime() + (1000*60*60*24));
        date_day.datepicker("setDate", date);
        current_day.trigger("input");
    });
    let booking_edit = $('#edit_booking');
    booking_edit.on('show.bs.modal', function (e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog modal-dialog-centered zoomIn  animated faster');
    })
    // booking_edit.on('hide.bs.modal', function (e) {
    // })
    let booking_edit_hidden = function(){
        $('.modal .modal-dialog').attr('class', 'modal-dialog modal-dialog-centered zoomOut  animated faster');
        setTimeout(function(){
            booking_edit.modal('hide');
        }, 500);
    }
    $('#edit_booking').off('click','.btn-cancel');
    $('#edit_booking').on('click','.btn-cancel',function (e) {
        booking_edit_hidden();
    });
    let show_booking = function (obj,type) {
        var booking_id = $(obj).find('.booking-id').val();
        // var id_row = obj.parentElement.parentElement.id; //get time
        var id_sex = "01";
        if (type == "01") {
            var list_class = obj.parentElement.classList;
            for (var i = 0; i< list_class.length; i++) {
                if (list_class[i].indexOf("famale") > 0) {
                    id_sex = "02";
                    break;
                }
            }
        }
        var date_admin = "";
        if (booking_id == "" || booking_id == null) {
            date_admin = $("#input-current__date").val();
            if (type == "02") return;
        }
        $.ajax({
            url: '/admin/edit_booking',
            type: 'POST',
            data: {
                'new' : 0,
                'booking_id' : booking_id,
                'type_admin' : type,
                'sex_admin' : id_sex,
                'date_admin' : date_admin,
            },
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                booking_edit.find('.mail-booking').html(html);
                booking_edit.modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false
                });
                load_payment_event();
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    };
    $('.main-col__data').not(".bg-free").not(".bg-dis").off('click');
    $('.main-col__data').not(".bg-free").not(".bg-dis").on('click', function (e) {
        if(!$(this).find('.control-align_center').text()){
            show_booking(this,"01");
        }
    });
    $('.main-col__pet').not(".space-white").not(".head").not(".bg-dis").off('click');
    $('.main-col__pet').not(".space-white").not(".head").not(".bg-dis").on('click', function (e) {
        show_booking(this,"05");
    });
    $('.main-col__wt').not(".not-wt").not(".head").not(".bg-dis").off('click');
    $('.main-col__wt').not(".not-wt").not(".head").not(".bg-dis").on('click', function (e) {
        show_booking(this,"02");
    });
    $('#go-weekly').off('click');
    $('#go-weekly').on('click',function (e) {
        let date = date_day.datepicker('getDate');
        let currentDate = moment(date);
        let weekStart = currentDate.clone().startOf('isoweek');
        let start_weekly = moment(weekStart).add(0, 'days').format("YMMDD");
        let end_weekly = moment(weekStart).add(6, 'days').format("YMMDD");
        let weekly_url = $curent_url.substring(0, $curent_url.length - 3) + "weekly";
        window.location.href = weekly_url + "?date_from=" + start_weekly + "&date_to=" + end_weekly;
    })
    $('#go-monthly').off('click');
    $('#go-monthly').on('click',function (e) {
        let date = date_day.datepicker('getDate');
        let currentDate = moment(date);
        let monthly = currentDate.format("YMM");
        let monthly_url = $curent_url.substring(0, $curent_url.length - 3) + "monthly";
        window.location.href = monthly_url + "?date=" + monthly;
    })
    $('#go-user').off('click');
    $('#go-user').on('click',function (e) {
        let user_url = $curent_url.substring(0, $curent_url.length - 9) + "admin/msuser";
        window.location.href = user_url;
    })
    $('#edit_booking').off('click','.btn-update');
    $('#edit_booking').on('click','.btn-update',function (e) {
        e.preventDefault();
        let data = $('form.booking').serializeArray();
        // console.log(data);
        $.ajax({
            url: $site_url +'/admin/update_booking',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                // console.log(html);
                if((html.status == false) && (html.type == 'validate')){
                    make_color_input_error(html.message.booking);
                    make_payment_validate(html.message.payment);
                    Swal.fire({
                        icon: 'warning',
                        // title: 'エラー',
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
                }else{
                    $('#edit_booking').modal('hide');
                    window.location.reload();
                }
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    })
    $('#edit_booking').on('click','#credit-card',function (e) {
        return false;
    })
    let make_payment_validate = (array) => {
            $('p.note-error').remove();
            $.each(array.error, function (index, item) {
                $('#'+item).css({'border': 'solid 1px #f50000'});
                switch(item) {
                    case 'name': $('#'+item).parent().after('<p class="note-error node-text"> お名前をカタカナで入力してください。</p>');
                        break;
                    case 'phone': $('#'+item).parent().after('<p class="note-error node-text"> 電話番号は数字のみを入力してください。</p>');
                        break;
                    case 'email': $('#'+item).parent().after('<p class="note-error node-text"> 入力したメールアドレスを確認してください。</p>');
                        break;
                }
            })
            $.each(array.clear, function (index, item) {
                $('#'+item).css({'border': 'solid 1px #ced4da'});
            })
    }
    let make_color_input_error = (json) => {
        $('p.note-error').remove();
        if (typeof json.clear_border_red !== "undefined" ) {
            $.each(json.clear_border_red, function (index, item) {
                $('#'+item.element).css({'border': 'solid 1px #ced4da'});
                $('#bus_arrive_time_slide').closest('button').css({'border': 'solid 1px #ced4da'});
                $('select[name=gender]').css({'border': 'solid 1px #ced4da'});
            })
        }
        if (typeof json.error_time_transport !== "undefined" ) {
            $.each(json.error_time_transport, function (index, item) {
                let input_error_transport = $('#'+item.element);
                input_error_transport.css({'border': 'solid 1px #f50000'});
                let repeat_user = JSON.parse($('#repeat_user').val());
                if(repeat_user.kubun_id == '01'){
                    input_error_transport.parent().after('<p class="note-error node-text">バス停からの移動と初回説明の時間があるので、バスの到着時間から30分以内の予約はできません。</p>');
                }else if(repeat_user.kubun_id == '02'){
                    input_error_transport.parent().after('<p class="note-error node-text">バス停からの移動があるので、バスの到着時間から15分以内の予約はできません。</p>');
                }
                $('#bus_arrive_time_slide').closest('button').css({'border': 'solid 1px #f50000'});
            })
        }
        if (typeof json.error_time_gender  !== "undefined") {
            $.each(json.error_time_gender, function (index, item) {
                let input_error_gender = $('#'+item.element);
                input_error_gender.css({'border': 'solid 1px #f50000'});
                input_error_gender.parent().after('<p class="note-error node-text"> 選択された時間は予約できません。</p>');
                $('select[name=gender]').css({'border': 'solid 1px #f50000'});
            })
        }
        if (typeof json.error_time_empty  !== "undefined") {
            $.each(json.error_time_empty, function (index, item) {
                let input_error_required = $('#'+item.element);
                input_error_required.css({'border': 'solid 1px #f50000'});
                input_error_required.parent().after('<p class="note-error node-text"> 予約時間を選択してください。</p>');
            })
        }
        if (typeof json.room_select_error  !== "undefined") {
            $.each(json.room_select_error, function (index, item) {
                $('#'+item.element).css({'border': 'solid 1px #f50000'});
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
    // $('.search-button').off('click');
    // $('.search-button').on('click',function (e) {
    //     $('#search').val('');
    //     $('#result').html('');
    //     $('.search-button').html('');
    // });
    if ((typeof load_search_event) === 'undefined') {
        load_search_event = function(){
            $('.list-group-item').off('click');
            $('.list-group-item').on('click',function (e) {
                var name = $(this).find('.search-element').val();
                var expert = JSON.parse($(this).find('.search-expert').val());
                // console.log(name);
                // console.log(expert);
                var data_expert = '';
                $.each(expert, function(key, value) {
                    var check_re = value.ref_booking_id == null ? '' : '同行者';
                    var course_re = '';
                    switch(value.course) {
                        case '01':
                            course_re = '入浴';
                            break;
                        case '02':
                            course_re = 'リ';
                            break;
                        case '03':
                            course_re = '貸切';
                            break;
                        case '04':
                            course_re = '断食';
                            break;
                        case '05':
                            course_re = 'Pet';
                            break;
                        default:
                            course_re = '';
                            break;
                    }
                    var day = moment(value.service_date);
                    // console.log(day.format('Y/M/D'));
                    var date = day.format('Y/M/D')
                    var hour = parseInt(value.time.substr(0, 2), 10);
                    var minute = value.time.substr(2, 2);
                    data_expert += '<li class="list-group-item link-class list-body">'
                    + value.name
                    + check_re
                    + " ["
                    + course_re
                    + "] "
                    + date
                    + " "
                    + hour
                    + ":"
                    + minute
                    + '</li>';
                })
                Swal.fire({
                    html:
                    '<ul><li class="list-group-item link-class list-head">' + name + '</li>'
                    + data_expert
                    + '</ul>',
                    text: ' 入力した内容を確認してください。',
                    confirmButtonColor: '#d7751e',
                    confirmButtonText: '閉じる',
                    width: 500,
                    showClass: {
                        popup: 'animated zoomIn faster'
                    },
                    hideClass: {
                        popup: 'animated zoomOut faster'
                    },
                    allowOutsideClick: false
                })
                $('#search').val('');
                $('#result').html('');
                $('.search-button').html('');
            });
        };
    }


    let load_payment_event = function () {
        $('#collapseOne').collapse('hide');
        $('#headingOne').on('click', function (e) {
            e.preventDefault();
        });
        $('.card').on('show.bs.collapse', function () {
            $(this).find('.payment-method').prop('checked',true);
        });
        $(`[data-toggle="collapse"]`).on('click',function(e){
            if ($(this).attr('id') !== 'nav') {
                var idx = $(this).index('[data-toggle="collapse"]');
                if(idx === 0){
                    e.stopPropagation();
                }else if ( $(this).parents('.accordion').find('.collapse.show') ){
                    if (idx === $('.collapse.show').index('.collapse')) {
                        // console.log(idx);
                        e.stopPropagation();
                    }
                }
            }
        });
    }
});
