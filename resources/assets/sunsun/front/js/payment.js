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
                        title: 'エラー',
                        text: 'Something went wrong!',
                        confirmButtonColor: '#d7751e',
                        confirmButtonText: 'もう一度やり直してください。',
                        allowOutsideClick: false
                    })
                    $('p.note-error').remove();
                    $.each(html.error, function (index, item) {
                        $('#'+item).css({'border': 'solid 1px #f50000'});
                        switch(item) {
                            case 'name': $('#'+item).parent().after('<p class="note-error"> 入力されている名前は無効になっています。</p>');
                                    break;
                            case 'phone': $('#'+item).parent().after('<p class="note-error"> 電話番号は無効になっています。</p>');
                                    break;
                            case 'email': $('#'+item).parent().after('<p class="note-error"> ﾒｰﾙｱﾄﾞﾚｽは無効になっています。</p>');
                                    break;
                        }
                        
                    })
                    $.each(html.clear, function (index, item) {
                        $('#'+item).css({'border': 'solid 1px #ced4da'});
                    })
                }else{
                    if ((typeof html.status !== 'undefined') && (html.status == 'success')) {
                        Swal.fire({
                            icon: 'success',
                            title: '成功'
                        })
                    }else if ((typeof html.status !== 'undefined') && (html.status == 'error')){
                        Swal.fire({
                            icon: 'error',
                            title: 'エラー',
                            text: html.message,
                            confirmButtonColor: '#d7751e',
                            confirmButtonText: 'もう一度やり直してください。',
                            allowOutsideClick: false
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
