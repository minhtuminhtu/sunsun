$(function () {
    var weekpicker, 
        start_date, 
        end_date, 
        url, 
        input_start = $('#date_start_week') ;
    function set_week_picker(date) {
        start_date = moment(date, "YYYY/MM/DD").day(1).format("YYYY/MM/DD");
        end_date =  moment(date, "YYYY/MM/DD").add(7, 'days').day(0).format("YYYY/MM/DD");
        weekpicker.datepicker('update', start_date);
        weekpicker.find('input').val(start_date + ' - ' + end_date).trigger("input");
        let date_from = moment(start_date).format('YYYYMMDD');
        let date_to = moment(end_date).format('YYYYMMDD');
        url = $curent_url+"?date_from="+date_from+"&date_to=" + date_to;
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
        weekStart: 1,
        container: '#week-picker-wrapper',
    }).on("changeDate", function(e) {
        set_week_picker(e.date);
    });
    $('.week-prev').on('click', function() {
        var new_date = moment(start_date, "YYYY/MM/DD").subtract(7, 'days').day(0).format("YYYY/MM/DD");
        set_week_picker(new_date);
        load_url ();
    });
    $('.week-next').on('click', function() {
        var new_date = moment(start_date, "YYYY/MM/DD").add(7, 'days').day(0).format("YYYY/MM/DD");
        set_week_picker(new_date);
        load_url ();
    });
    let date_start = input_start.val();

    set_week_picker(new Date(date_start));
    weekpicker.on('change','input',function () {
        load_url ();
    })


});
