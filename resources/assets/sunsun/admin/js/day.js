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


    $('.main-col__data').off('click');
    $('.main-col__data').on('click', function (e) {
        var booking_id = $(this).find('.booking-id').val();
        if(booking_id == undefined){
            booking_id = 0;
        }
        show_booking(booking_id);
        
    });

    
    
});
