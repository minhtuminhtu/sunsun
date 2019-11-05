$(function () {
    let main_head__top = $('.main-head__top');
    let current_day = $('.current-date');
    let date_day = current_day.datepicker({
        language: 'ja',
        format: "yyyy/mm",
        startView: "year",
        minViewMode: "months",
        autoclose: true,

    });
    current_day.on('input change','input',function (e) {
        let date = $(this).val().split('/').join('');
        window.location.href = $curent_url+"?date="+date;
    });
    if (current_day.find('input').val() === '') {
        date_day.datepicker("setDate", new Date());
        current_day.find('input').trigger("input");
    }

    main_head__top.on('click','.prev-month',function (e) {
        let date = date_day.datepicker('getDate');
        let time_moment = moment(date);
        let time_mement_prev = time_moment.subtract(1,'month').format('YYYY/MM');
        date_day.datepicker('update', time_mement_prev);

        current_day.find('input').trigger("input");
    });
    main_head__top.on('click','.next-month',function (e) {
        let date = date_day.datepicker('getDate');
        let time_moment = moment(date);
        let time_mement_next = time_moment.add(1,'month').format('YYYY/MM');
        date_day.datepicker('update', time_mement_next);
        current_day.find('input').trigger("input");
    });

});
