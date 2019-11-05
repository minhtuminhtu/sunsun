$(document).ready(function() {

    let get_setting_kubun_type = function() {
        $('#new').click(function() {
            var kubun_type = $('#setting-type').val();
            // AJAX request
            $.ajax({
                url: '/admin/get_setting_kubun_type',
                type: 'post',
                data: {
                    new : 1,
                    kubun_type : kubun_type
                },
                beforeSend: function() {
                    loader.css({
                        'display': 'block'
                    });
                },
                success: function(response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#setting_update').modal('show');
                    load_modal_function();

                },
                complete: function() {
                    loader.css({
                        'display': 'none'
                    });
                },
            });
        });

        $('#check_all').on('change', function(){
            if($(this).prop('checked')){
                $('.checkbox').prop('checked', true);
                $('.update-edit').show();
            }else{
                $('.checkbox').prop('checked', false);
                $('.update-edit').hide();
            }
            
        });

        $('.checkbox').on('change', function(){
            if($('.checkbox').filter(':checked').length > 0){
                $('.update-edit').show();
            }else{
                $('.update-edit').hide();
            }

            if($('.checkbox').filter(':checked').length == $('.checkbox').length){
                $('#check_all').prop('checked', true);
            }else{
                $('#check_all').prop('checked', false);
            }
            
        });


        $('.kubun_value').click(function() {
            var parent = $(this).parent().parent();
            var kubun_id = parent.find('.kubun_id').text();
            var kubun_type = $('#setting-type').val();
            $.ajax({
                url: '/admin/get_setting_kubun_type',
                type: 'post',
                data: {
                    new : 0,
                    kubun_id: kubun_id,
                    kubun_type : kubun_type
                },
                beforeSend: function() {
                    loader.css({
                        'display': 'block'
                    });
                },
                success: function(response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#setting_update').modal('show');
                    load_modal_function();

                },
                complete: function() {
                    loader.css({
                        'display': 'none'
                    });
                },
            });
        });


        
        $('#btn-update').click(function() {
            var kubun_id =$('.checkbox').filter(':checked').first().val();
            var kubun_type = $('#setting-type').val();
            $.ajax({
                url: '/admin/get_setting_kubun_type',
                type: 'post',
                data: {
                    new : 0,
                    kubun_id: kubun_id,
                    kubun_type : kubun_type
                },
                beforeSend: function() {
                    loader.css({
                        'display': 'block'
                    });
                },
                success: function(response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#setting_update').modal('show');
                    load_modal_function();

                },
                complete: function() {
                    loader.css({
                        'display': 'none'
                    });
                },
            });
        });


        $('#btn-delete').click(function() {
            var string_delete ="";
            var arr_delete = [];
            $('.checkbox').filter(':checked').each(function( index ) {
                string_delete += "\n" + $(this).val() + " - " + $(this).parent().parent().find('.kubun_value').text();
                arr_delete.push($(this).val());
            });
            var r = confirm("Are you sure to delete this item?" + string_delete);
            if (r == true) {
                var kubun_type = $('#setting-type').val();
                $.ajax({
                    url: '/admin/delete_setting_kubun_type',
                    type: 'delete',
                    data: {
                        arr_delete: arr_delete,
                        kubun_type : kubun_type
                    },
                    beforeSend: function() {
                        loader.css({
                            'display': 'block'
                        });
                    },
                    success: function(response) {
                        get_setting_type($('#setting-type').val());
                    },
                    complete: function() {
                        loader.css({
                            'display': 'none'
                        });
                    },
                });
            }
            
        });


        $('.btn-up').click(function() {
            var sort_no = $(this).parent().parent().find('.sort_no').text();
            $.ajax( {
                url: '/admin/update_setting_sort_no',
                type: 'post', 
                data: {
                    type: 'up', 
                    sort_no: sort_no
                }
                , beforeSend: function() {
                    loader.css( {
                        'display': 'block'
                    });
                }
                , success: function(response) {
                    get_setting_type($('#setting-type').val());
                }
                , complete: function() {
                    loader.css( {
                        'display': 'none'
                    });
                }
                ,
            });
        });
        $('.btn-down').click(function() {
            var sort_no = $(this).parent().parent().find('.sort_no').text();
            $.ajax( {
                url: '/admin/update_setting_sort_no',
                type: 'post', 
                data: {
                    type: 'down', 
                    sort_no: sort_no
                }
                , beforeSend: function() {
                    loader.css( {
                        'display': 'block'
                    });
                }
                , success: function(response) {
                    get_setting_type($('#setting-type').val());
                }
                , complete: function() {
                    loader.css( {
                        'display': 'none'
                    });
                }
                ,
            });
        });



    };



    let load_modal_function = function(){
        $('.btn-cancel').click(function() {
            $('#setting_update').modal('hide');
        });
        $('.btn-save').click(function() {
            var kubun_type = $('#setting-type').val();
            var kubun_id = $('#kubun_id').val();
            var kubun_value = $('#kubun_value').val();
            var sort_no = $('.kubun_value').length + 1;
            var new_check = $('#new_check').val();

            $.ajax({
                url: '/admin/update_setting_kubun_type',
                type: 'post',
                data: {
                    new : new_check,
                    kubun_id: kubun_id,
                    kubun_value: kubun_value,
                    kubun_type : kubun_type,
                    sort_no : sort_no
                },
                beforeSend: function() {
                    loader.css({
                        'display': 'block'
                    });
                },
                success: function(response) {
                    $('#setting_update').modal('hide');
                    get_setting_type($('#setting-type').val());

                },
                error: function(response) {
                    var err = JSON.parse(response.responseText);
                    $('.setting-validate').text(err.msg);
                },
                complete: function() {
                    loader.css({
                        'display': 'none'
                    });
                },
            });
        });
    }




    let get_setting_type = function(kubun_type = null) {
        $('#setting-head').text($('#setting-type').val() + " | " + $('#setting-type option:selected').text());
        if(kubun_type == null){
            kubun_type = $('#setting-type').val();
        }

        $.ajax({
            url: '/admin/get_setting_type',
            type: 'post',
            data: {
                kubun_type: kubun_type
            },
            beforeSend: function() {
                loader.css({
                    'display': 'block'
                });
            },
            success: function(response) {
                $('.setting-right').html(response);
                get_setting_kubun_type();
            },
            complete: function() {
                loader.css({
                    'display': 'none'
                });
            },
        });
    };
    $('#setting-type').on('change', function() {
        get_setting_type();
    });
    get_setting_type();


    





    
});