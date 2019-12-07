$(function () {
    let main_head__top = $('.main-head__top'),
        current_day = $('.current-date'),
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
    current_day.on('input change','input',function (e) {
        let date = $(this).val().split('/').join('');
        window.location.href = $curent_url+"?date="+date;
    });
    if (current_day.find('input').val() === '') {
        date_day.datepicker("setDate", new Date());
        current_day.find('input').trigger("input");
    }

    main_head__top.on('click','.prev-date',function (e) {
        var date = date_day.datepicker('getDate');
        date.setTime(date.getTime() - (1000*60*60*24));
        date_day.datepicker("setDate", date);
        current_day.find('input').trigger("input");
    });
    main_head__top.on('click','.next-date',function (e) {
        var date = date_day.datepicker('getDate');
        date.setTime(date.getTime() + (1000*60*60*24));
        date_day.datepicker("setDate", date);
        current_day.find('input').trigger("input");
    });
    let booking_edit = $('#edit_booking');
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
                booking_edit.modal('show');
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    };


    $('.main-col__data').not(".bg-free").off('click');
    $('.main-col__data').not(".bg-free").on('click', function (e) {
        var booking_id = $(this).find('.booking-id').val();
        show_booking(booking_id);
        
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

    
    $('#edit_booking').on('click','.btn-cancel',function (e) {
        $('#edit_booking').modal('hide');
    })

    $('#edit_booking').on('click','.btn-update',function (e) {
        e.preventDefault();
        $.ajax({
            url: $site_url +'/admin/update_booking',
            type: 'POST',
            data: $('form.booking').serializeArray(),
            dataType: 'JSON',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (r) {
                $('#edit_booking').modal('hide');
                window.location.reload(); 
            },
            error: function () {
                alert("error!");
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    })

    $('#edit_booking').on('click','.show_history',function (e) {
        e.preventDefault();
        let current_booking_id = $('#edit_booking').find("#booking_id").val();
        let show_history = $('#history_modal');
        $.ajax({
            url: $site_url +'/admin/show_history',
            type: 'POST',
            data: {
                'booking_id' : current_booking_id
            },
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                booking_edit.find('.modal-body-history').html(html);
                show_history.modal('show'); 
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    })

    $('#edit_booking').on('change','#course_history',function (e) {
        let current_booking_id = $('#edit_booking').find("#booking_id").val();
        let course_history = $("#course_history").val();
        if(course_history != 0){
            $.ajax({
                url: $site_url +'/admin/booking_history',
                type: 'POST',
                data: {
                    'new' : 0,
                    'current_booking_id': current_booking_id,
                    'course_history' : course_history
                },
                dataType: 'text',
                beforeSend: function () {
                    loader.css({'display': 'block'});
                },
                success: function (html) {
                    booking_edit.find('.mail-booking').html(html);
                    booking_edit.modal('show');
                },
                // error: function () {
                //     // alert("error!");
                // },
                complete: function () {
                    loader.css({'display': 'none'});
                },
            });
        }
        e.preventDefault();
        
    })

    $('#edit_booking').on('click','#credit-card',function (e) {
        return false;
    })

    
    
    
});
