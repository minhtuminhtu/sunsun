$(function () {
    var weekpicker, start_date, end_date, url, input_start = $('#date_start_week') ;
    function set_week_picker(date) {
        start_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
        end_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
        weekpicker.datepicker('update', start_date);
        weekpicker.find('input').val(moment(start_date).format('YYYY/MM/DD')+ ' - ' + moment(end_date).format('YYYY/MM/DD')).trigger("input");
        let date_from = moment(start_date).format('YYYYMMDD');
        let date_to = moment(end_date).format('YYYYMMDD');
        url = $curent_url+"?date_from="+date_from+"&date_to=" + date_to;
        console.log(url);
    }

    function load_url () {
        window.location.href = url;
    }

    weekpicker = $('.week-picker');
    weekpicker.datepicker({
        dateFormat: 'yyyy/mm/dd',
        language: 'ja',
        autoclose: true,
        forceParse: false,
        container: '#week-picker-wrapper',
    }).on("changeDate", function(e) {
        set_week_picker(e.date);
    });
    $('.week-prev').on('click', function() {
        var prev = new Date(start_date.getTime());
        prev.setDate(prev.getDate() - 1);
        set_week_picker(prev);
        load_url ();
    });
    $('.week-next').on('click', function() {
        var next = new Date(end_date.getTime());
        next.setDate(next.getDate() + 1);
        set_week_picker(next);
        load_url ();
    });
    let date_start = input_start.val().split('/');
    set_week_picker(new Date(date_start[0],date_start[1] -1,date_start[2]));
    weekpicker.on('change','input',function () {
        load_url ();
    })


});
