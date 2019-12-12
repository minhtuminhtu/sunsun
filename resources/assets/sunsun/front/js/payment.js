$(function() {
    $('.payment-method').off('change');
    $('.payment-method').on('change', function() {
        if($(this).prop("id") == 'credit-card'){
            $('.credit-card').show();
        }else{
            $('.credit-card').hide();
        }
    });
    $('#card-expire').off('keypress');
    $('#card-expire').on('keypress', function() {
        if($(this).val().length == 2 ){
            $('#card-expire').val($('#card-expire').val() + "/");
        }
    });

    
    $('#make_payment').off('click');
    $('#make_payment').on('click', function() {
        let data = $('form.booking').serializeArray();
        $.ajax({
            url: '/make_payment',
            type: 'POST',
            data:  data,
            dataType: 'text',
            beforeSend: function () {
                loader.css({'display': 'block'});
            },
            success: function (html) {
                html = JSON.parse(html);
                if (typeof html.error !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        confirmButtonText: 'Try again!'
                    })
                    $.each(html.error, function (index, item) {
                        $('#'+item).css({'border': 'solid 1px #f50000'});
                    })
                    $.each(html.clear, function (index, item) {
                        $('#'+item).css({'border': 'solid 1px #ced4da'});
                    })
                }else{
                    if ((typeof html.status !== 'undefined') && (html.status == 'success')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!'
                        })
                    }else if ((typeof html.status !== 'undefined') && (html.status == 'error')){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: html.message,
                            confirmButtonText: 'Try again!'
                        })
                    }
                    
                }
            },
            complete: function () {
                loader.css({'display': 'none'});
            },
        });
    });

});
