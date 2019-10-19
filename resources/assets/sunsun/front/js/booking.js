$(function() {
    let service = $('.service-warp');
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

        let input_daterange = $('.input-daterange');
        input_daterange.datepicker({
            language: 'ja',
            dateFormat: 'yyyy/mm/dd',
            autoclose: true,
            minDate: moment().toArray()
        });
        input_daterange.on('changeDate', function() {

        });
    };
    load_event();

    let modal_choice_time = $('#choice_date_time');
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

        if(this.value == '酵素浴'){
            $('.service_2').hide();
            $('.service_3').hide();
            $('.service_4').hide();
            $('.service_5').hide();
            $('.service_1').show();
        }else if(this.value == '1日リフレッシュプラン'){
            $('.service_1').hide();
            $('.service_3').hide();
            $('.service_4').hide();
            $('.service_5').hide();
            $('.service_2').show();
        }else if(this.value == '酵素部屋貸切プラン'){
            $('.service_1').hide();
            $('.service_2').hide();
            $('.service_4').hide();
            $('.service_5').hide();
            $('.service_3').show();
        }else if(this.value == '断食プラン'){
            $('.service_1').hide();
            $('.service_2').hide();
            $('.service_3').hide();
            $('.service_5').hide();
            $('.service_4').show();
        }else if(this.value == 'ペット酵素浴'){
            $('.service_1').hide();
            $('.service_2').hide();
            $('.service_3').hide();
            $('.service_4').hide();
            $('.service_5').show();
        }
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
