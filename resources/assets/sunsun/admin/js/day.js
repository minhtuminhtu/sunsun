
$(function () {
    let main_head__top = $('.main-head__top'),
        current_day = $('#input-current__date'),
        date_day = current_day.datepicker({
        language: 'ja',
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

    

    

    let show_booking = function (booking_id) {
        $.ajax({
            url: '/admin/edit_booking',
            type: 'POST',
            data: {
                'new' : 0,
                'booking_id' : booking_id
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
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    };


    $('.main-col__data').not(".bg-free").off('click');
    $('.main-col__data').not(".bg-free").on('click', function (e) {
        if(!$(this).find('.control-align_center').text()){
            var booking_id = $(this).find('.booking-id').val();
            show_booking(booking_id);
        }
    });

    $('.main-col__pet').not(".space-white").not(".head").off('click');
    $('.main-col__pet').not(".space-white").not(".head").on('click', function (e) {
        var booking_id = $(this).find('.booking-id').val();
        show_booking(booking_id);

    });
    $('.main-col__wt').not(".not-wt").not(".head").off('click');
    $('.main-col__wt').not(".not-wt").not(".head").on('click', function (e) {
        var booking_id = $(this).find('.booking-id').val();
        show_booking(booking_id);

    });

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
                console.log(html);
                if((html.status == false) && (html.type == 'validate')){
                    make_color_input_error(html.message.booking);
                    make_payment_validate(html.message.payment);
                    Swal.fire({
                        icon: 'warning',
                        // title: 'エラー',
                        text: '入力した情報を再確認してください。',
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

                }
                // $('#edit_booking').modal('hide');
                // window.location.reload();
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
                    case 'name': $('#'+item).parent().after('<p class="note-error node-text"> 入力されている名前は無効になっています。</p>');
                        break;
                    case 'phone': $('#'+item).parent().after('<p class="note-error node-text"> 電話番号は無効になっています。</p>');
                        break;
                    case 'email': $('#'+item).parent().after('<p class="note-error node-text"> ﾒｰﾙｱﾄﾞﾚｽは無効になっています。</p>');
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
                input_error_transport.parent().after('<p class="note-error node-text"> 予約時間は洲本ICのバスの送迎時間以降にならないといけないのです。</p>');
                $('#bus_arrive_time_slide').closest('button').css({'border': 'solid 1px #f50000'});
            })
        }
        if (typeof json.error_time_gender  !== "undefined") {
            $.each(json.error_time_gender, function (index, item) {
                let input_error_gender = $('#'+item.element);
                input_error_gender.css({'border': 'solid 1px #f50000'});
                input_error_gender.parent().after('<p class="note-error node-text"> 予約時間は選択された性別に適当していません。</p>');
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
            $('#range_date_start').parent().parent().after('<p class="note-error node-text booking-laber-padding"> 宿泊日の時間が無効になっています。</p>');
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
                console.log(name);
                console.log(expert);
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
                    console.log(day.format('Y/M/D'));
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
                    text: ' 入力した情報を再確認してください。',
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

});

