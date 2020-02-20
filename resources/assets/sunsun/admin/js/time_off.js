$(function () {
    $('#go-day').off('click');
    $('#go-day').on('click',function (e) {
        let day_url = $curent_url.substring(0, $curent_url.length - 8) + "day";
        window.location.href = day_url;
    })
    $('#go-weekly').off('click');
    $('#go-weekly').on('click',function (e) {
        let weekly_url = $curent_url.substring(0, $curent_url.length - 8) + "weekly";
        window.location.href = weekly_url;
    })
    $('#go-monthly').off('click');
    $('#go-monthly').on('click',function (e) {
        let monthly_url = $curent_url.substring(0, $curent_url.length - 8) + "monthly";
        window.location.href = monthly_url;
    })
});
