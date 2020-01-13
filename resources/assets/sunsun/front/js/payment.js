$(function() {
    $('.payment-method').off('change');
    $('.payment-method').on('change', function() {
        if($(this).prop("id") == 'credit-card'){
            $('.credit-card').show();
        }else{
            $('.credit-card').hide();
        }
    });


    $('#card-number, #card-expire, #card-secret').off('keypress');
    $('#card-number, #card-expire, #card-secret').on('keypress', function(e){
        if (e.which < 48 || e.which > 57){
            e.preventDefault();
        }
    })


    function sleep (time) {
        return new Promise((resolve) => setTimeout(resolve, time));
    }

    $('.card').on('show.bs.collapse', function () {
        $(this).find('.payment-method').prop('checked',true);
    })

    $(`[data-toggle="collapse"]`).on('click',function(e){
        if ( $(this).parents('.accordion').find('.collapse.show') ){
            var idx = $(this).index('[data-toggle="collapse"]');
            if (idx == $('.collapse.show').index('.collapse')) {
                // prevent collapse
                e.stopPropagation();
            }
        }
    });

    $('.custom-link').off('click');
    $('.custom-link').on('click', function() {
        Swal.fire({
            confirmButtonColor: '#d7751e',
            html:
                '<div class="hint-content"><div><div class="hint-head">セキュリティコードとは、カード裏面の署名欄やカード表面のカード番号近くに記載されている3桁または4桁の数字です</div>'
                + '<div  class="hint-title">VISA/Mastercard/JCB/Diners</div>'
                + '<div class="hint-align"><img src="sunsun/imgs/hint-visa.png" /></div>'
                + '<div  class="hint-title">American Express</div>'
                + '<div class="hint-align"><img src="sunsun/imgs/hint-ame.png" /></div></div></div>'
            ,
            showCloseButton: true,
            showConfirmButton: false,
            customClass: 'swal-height',
            confirmButtonText: '閉じる',
            showClass: {
                popup: 'animated fadeInDown faster'
            },
            hideClass: {
                popup: 'animated fadeOutUp faster'
            },
            cancelButtonText:
                '<i class="fa fa-thumbs-down"></i>',
            allowOutsideClick: false
        })
    });

    let cardType;
    $('#card-number').off('keyup');
    $('#card-number').on('keyup', function(e) {

        if($('#card-number').val().length !== 0){
            $('#card-number').val($('#card-number').val().replace(/\D/g, '').replace(/(\d{4})/g, '$1 ').trim());
            switch (getCardType($('#card-number').val().replace(/\D/g, ''))) {
                case "VISA": {
                    if(cardType !== "VISA"){
                        $(".card-img").html('<img src="sunsun/svg/cc-visa.svg" class="img-fluid scale-image" alt="">');
                    }

                    cardType = "VISA";
                    break;
                }
                case "MASTERCARD": {
                    if(cardType !== "MASTERCARD"){
                        $(".card-img").html('<img src="sunsun/svg/cc-mastercard.svg" class="img-fluid scale-image" alt="">');
                    }

                    cardType = "MASTERCARD";
                    break;
                }
                case "AMEX": {
                    if(cardType !== "AMEX"){
                        $(".card-img").html('<img src="sunsun/svg/cc-amex.svg" class="img-fluid scale-image" alt="">');
                    }

                    cardType = "AMEX";
                    break;
                }
                case "JCB": {
                    if(cardType !== "JCB"){
                        $(".card-img").html('<img src="sunsun/svg/cc-jcb.svg" class="img-fluid scale-image" alt="">');
                    }

                    cardType = "JCB";
                    break;
                }
                default: {
                    if(cardType !== "NONE"){
                        $(".card-img").html('<img src="sunsun/svg/cc-blank.svg" class="img-fluid scale-image" alt="">');
                    }

                    cardType = "NONE";
                    break;
                }
            }

            $(this).parent().find('span:first-child').css('display', 'inline');
            $(this).removeClass('typing-none');
            $(this).addClass('typing');
        }else{
            console.log("bbb");
            $(this).parent().find('span:first-child').css('display', 'none')
            $(this).removeClass('typing');
            $(this).addClass('typing-none');
        }
    });
    function getCardType(cardNum) {
        if(!luhnCheck(cardNum)){
            return "";
        }
        var payCardType = "";
        var regexMap = [
            {regEx: /^4[0-9]{5}/ig,cardType: "VISA"},
            {regEx: /^5[1-5][0-9]{4}/ig,cardType: "MASTERCARD"},
            {regEx: /^3[47][0-9]{3}/ig,cardType: "AMEX"},
            // {regEx: /^(5[06-8]\d{4}|6\d{5})/ig,cardType: "MAESTRO"},
            {regEx: /^(?:2131|1800|35\d{3})\d{11}$/ig,cardType: "JCB"}

        ];

        for (var j = 0; j < regexMap.length; j++) {
            if (cardNum.match(regexMap[j].regEx)) {
                payCardType = regexMap[j].cardType;
                break;
            }
        }

        if (cardNum.indexOf("50") === 0 || cardNum.indexOf("60") === 0 || cardNum.indexOf("65") === 0) {
            var g = "508500-508999|606985-607984|608001-608500|652150-653149";
            var i = g.split("|");
            for (var d = 0; d < i.length; d++) {
                var c = parseInt(i[d].split("-")[0], 10);
                var f = parseInt(i[d].split("-")[1], 10);
                if ((cardNum.substr(0, 6) >= c && cardNum.substr(0, 6) <= f) && cardNum.length >= 6) {
                    payCardType = "RUPAY";
                    break;
                }
            }
        }
        return payCardType;
    }


    function luhnCheck(cardNum){
        // Luhn Check Code from https://gist.github.com/4075533
        // accept only digits, dashes or spaces
        var numericDashRegex = /^[\d\-\s]+$/
        if (!numericDashRegex.test(cardNum)) return false;

        // The Luhn Algorithm. It's so pretty.
        var nCheck = 0, nDigit = 0, bEven = false;
        var strippedField = cardNum.replace(/\D/g, "");

        for (var n = strippedField.length - 1; n >= 0; n--) {
            var cDigit = strippedField.charAt(n);
            nDigit = parseInt(cDigit, 10);
            if (bEven) {
                if ((nDigit *= 2) > 9) nDigit -= 9;
            }

            nCheck += nDigit;
            bEven = !bEven;
        }

        return (nCheck % 10) === 0;
    }


    $('#card-secret').off('keyup');
    $('#card-secret').on('keyup', function() {
        if($('#card-secret').val().length !== 0){
            $(this).parent().find('span:first-child').css('display', 'inline');
            $(this).removeClass('typing-none');
            $(this).addClass('typing');
            let  secretCard = $('#card-secret').val().replace(/\D/g,'');
            $('#card-secret').val(secretCard);
        }else{
            $(this).parent().find('span:first-child').css('display', 'none')
            $(this).removeClass('typing');
            $(this).addClass('typing-none');
        }
    });


    $('#make_payment').off('click');
    $('#make_payment').on('click', function() {
        makePayment();
    });
    let makePayment = function () {
        if($('input[type=radio][name=payment-method]:checked').val() === '1'){
            doPurchase();
        }else{
            callBackMakePayment();
        }
    }
});

let callBackMakePayment = function() {
    let data = $('form.booking').serializeArray();
    $('#Token').val("");
    console.log(data);
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
                    icon: 'warning',
                    text: ' 入力した情報を再確認してください。',
                    confirmButtonColor: '#d7751e',
                    confirmButtonText: '閉じる',
                    width: 350,
                    showClass: {
                        popup: 'animated zoomIn faster'
                    },
                    hideClass: {
                        popup: 'animated zoomOut faster'
                    },
                    allowOutsideClick: false
                })
                $('p.note-error').remove();
                $.each(html.error, function (index, item) {
                    $('#'+item).css({'border': 'solid 1px #f50000'});
                    switch(item) {
                        case 'name': $('#'+item).parent().after('<p class="note-error node-text"> 入力されている名前は無効になっています。</p>');
                            break;
                        case 'phone': $('#'+item).parent().after('<p class="note-error node-text"> 電話番号は無効になっています。</p>');
                            break;
                        case 'email': $('#'+item).parent().after('<p class="note-error node-text"> ﾒｰﾙｱﾄﾞﾚｽは無効になっています。</p>');
                            break;
                    }

                })
                $.each(html.clear, function (index, item) {
                    $('#'+item).css({'border': 'solid 1px #ced4da'});
                })
            }else{
                if ((typeof html.status !== 'undefined') && (html.status == 'success')) {
                    /*Swal.fire({
                        icon: 'success',
                        title: '成功',
                        showClass: {
                            popup: 'animated zoomIn faster'
                        },
                        hideClass: {
                            popup: 'animated zoomOut faster'
                        }
                    })*/
                    // console.log(html.message.bookingID);
                    $('#bookingID').val(html.message.bookingID);
                    $('#tranID').val(html.message.tranID);
                    $('#completeForm').submit();
                    // window.location.href = $site_url+"/complete";
                }else if ((typeof html.status !== 'undefined') && (html.status == 'error')){
                    Swal.fire({
                        icon: 'warning',
                        text: html.message,
                        confirmButtonColor: '#d7751e',
                        confirmButtonText: '閉じる',
                        width: 350,
                        showClass: {
                            popup: 'animated zoomIn faster'
                        },
                        hideClass: {
                            popup: 'animated zoomOut faster'
                        },
                        allowOutsideClick: false
                    })
                }

            }
        },
        complete: function () {
            loader.css({'display': 'none'});
        },
    });
}

function doPurchase() {
    if(getCardType($('#card-number').val().replace(/\D/g, '')) != ""){
        payment_init();
        // Multipayment.init("tshop00042155");
        let cardNumber = $('#card-number').val().replace(/\D/g, '');
        let cardExpire =  $('#expire-year').val().toString() +  $('#expire-month').val().toString();
        let cardSecure = $('#card-secret').val().replace(/\D/g,'');
        // let cardHoldname = 'HOLDER NAME';



        // console.log(cardNumber);
        // console.log(cardExpire);
        // console.log(cardSecure);
        Multipayment.getToken({
            cardno : cardNumber,
            expire : cardExpire,
            securitycode : cardSecure,
            // holdername : cardHoldname,
            tokennumber : 1
        }, execPurchase);
    }else{
        $('#card-number').addClass('error');
        $('#card-secret').addClass('error');
        $('#expire-month').addClass('error');
        $('#expire-year').addClass('error');

        $('#card-number').after( "<p class=\"note-error node-text\">無効なカード</p>" );
    }
}
function getCardType(cardNum) {
    if(!luhnCheck(cardNum)){
        return "";
    }
    var payCardType = "";
    var regexMap = [
        {regEx: /^4[0-9]{5}/ig,cardType: "VISA"},
        {regEx: /^5[1-5][0-9]{4}/ig,cardType: "MASTERCARD"},
        {regEx: /^3[47][0-9]{3}/ig,cardType: "AMEX"},
        // {regEx: /^(5[06-8]\d{4}|6\d{5})/ig,cardType: "MAESTRO"},
        {regEx: /^(?:2131|1800|35\d{3})\d{11}$/ig,cardType: "JCB"}

    ];

    for (var j = 0; j < regexMap.length; j++) {
        if (cardNum.match(regexMap[j].regEx)) {
            payCardType = regexMap[j].cardType;
            break;
        }
    }

    if (cardNum.indexOf("50") === 0 || cardNum.indexOf("60") === 0 || cardNum.indexOf("65") === 0) {
        var g = "508500-508999|606985-607984|608001-608500|652150-653149";
        var i = g.split("|");
        for (var d = 0; d < i.length; d++) {
            var c = parseInt(i[d].split("-")[0], 10);
            var f = parseInt(i[d].split("-")[1], 10);
            if ((cardNum.substr(0, 6) >= c && cardNum.substr(0, 6) <= f) && cardNum.length >= 6) {
                payCardType = "RUPAY";
                break;
            }
        }
    }
    return payCardType;
}


function luhnCheck(cardNum){
    // Luhn Check Code from https://gist.github.com/4075533
    // accept only digits, dashes or spaces
    var numericDashRegex = /^[\d\-\s]+$/
    if (!numericDashRegex.test(cardNum)) return false;

    // The Luhn Algorithm. It's so pretty.
    var nCheck = 0, nDigit = 0, bEven = false;
    var strippedField = cardNum.replace(/\D/g, "");

    for (var n = strippedField.length - 1; n >= 0; n--) {
        var cDigit = strippedField.charAt(n);
        nDigit = parseInt(cDigit, 10);
        if (bEven) {
            if ((nDigit *= 2) > 9) nDigit -= 9;
        }

        nCheck += nDigit;
        bEven = !bEven;
    }

    return (nCheck % 10) === 0;
}

if ((typeof execPurchase) === 'undefined') {
    execPurchase = function (response) {
        console.log(response);
        $('p.note-error').remove();
        if (response.resultCode != "000") {
            // window.alert("購入処理中にエラーが発生しました");
            $('#card-number').addClass('error');
            $('#card-secret').addClass('error');
            $('#expire-month').addClass('error');
            $('#expire-year').addClass('error');
            $('#card-number').after( "<p class=\"note-error node-text\">無効なカード</p>" );
        } else {
            $('#card-number').removeClass('error');
            $('#card-secret').removeClass('error');
            $('#expire-month').removeClass('error');
            $('#expire-year').removeClass('error');
            $('#Token').val(response.tokenObject.token);
            callBackMakePayment();
        }
    };
}


(function ($) {
    $.fn.phoneFilter = function (phoneFilter) {
        return this.on("keydown keyup", function (event) {
            if ((event.key !== 'Backspace') && (event.key !== 'undefined')) {
                let curchr = this.value.length;
                let curval = $(this).val();
                let phone_format;
                if (curchr < 3 && curval.indexOf("(") <= -1) {
                    phone_format = "(" + curval;
                } else if (curchr == 4 && curval.indexOf("(") > -1) {
                    phone_format = curval + ")-";
                } else if (curchr == 5) {
                    if (event.key != ")") {
                        phone_format = this.oldValue + ")-" + event.key
                    } else {
                        phone_format = curval;
                    }
                } else if (curchr == 6 && curval.indexOf("-") <= -1) {
                    if (event.key != "-") {
                        phone_format = this.oldValue + '-' + event.key
                    } else {
                        phone_format = curval;
                    }
                } else if (curchr == 9) {
                    phone_format = curval + "-";
                    $(this).attr('maxlength', '14');
                } else if (curchr == 10) {
                    console.log(event.key);
                    if (event.key != "-") {
                        phone_format = this.oldValue + '-' + event.key
                    } else {
                        phone_format = curval;
                    }
                } else {
                    phone_format = curval;
                }
                let regex = /^[\+]?[(]?[0-9]{0,3}[)]?[-\s\.]?[0-9]{0,3}[-\s\.]?[0-9]{0,6}$/im;
                let test = regex.test(phone_format);
                if (test === true) {
                    $(this).val(phone_format);
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            } else {
                this.oldValue = $(this).val();
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            }

        });
    };

    $('#tel').phoneFilter(function (value) {
        return true;
    });
}(jQuery));
