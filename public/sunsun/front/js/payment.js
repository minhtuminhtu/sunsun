/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/sunsun/front/js/payment.js":
/*!*****************************************************!*\
  !*** ./resources/assets/sunsun/front/js/payment.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $('.payment-method').off('change');
  $('.payment-method').on('change', function () {
    if ($(this).prop("id") == 'credit-card') {
      $('.credit-card').show();
    } else {
      $('.credit-card').hide();
    }
  });
  $('#card-number, #card-expire, #card-secret').off('keypress');
  $('#card-number, #card-expire, #card-secret').on('keypress', function (e) {
    if (e.which < 48 || e.which > 57) {
      e.preventDefault();
    }
  });
  /*$('#phone').off('keypress');
  $('#phone').on('keypress', function(e){
      // let phone = $('#phone').val().replace(/[^0-9０-９()-（）－]/,'');
      // if(phone.replace(/[^0-9]/,'').length == 11){
      //     $(this).parent().parent().find('.note-error').remove();
      //     $(this).addClass('validate_failed');
      //     $(this).parent().after('<p class="note-error node-text"> 電話番号は無効になっています。</p>');
      //     e.preventDefault();
      // }
  })*/

  /*$('#phone').off('keyup keydown change');
  $('#phone').on('keyup keydown change', function(e){
      let phone = $('#phone').val().replace(/[^0-9０-９()-（）－]/,'');
      let temp_phone = "";
      if(phone.length != get_number_byte_str(phone)){
          for(let i = 0; i < phone.length; i++){
              if(get_number_byte_str(phone.charAt(i)) == 2){
                  temp_phone += convert_2byte_2_1byte(phone.charAt(i));
              }else{
                  temp_phone += phone.charAt(i);
              }
          }
      }else{
          temp_phone = phone;
      }
      temp_phone = temp_phone.replace(/[^0-9()-]/,'');
      $("#phone").val(temp_phone);
  })*/

  $('#email').off('keypress keyup keydown change');
  $('#email').on('keypress keyup keydown change', function (e) {
    var email = $('#email').val().replace(/[^0-9a-zA-Z@.０-９Ａ-Ｚａ-ｚ＠]/, '');
    var temp_str = "";

    if (email.length != get_number_byte_str(email)) {
      for (var i = 0; i < email.length; i++) {
        if (get_number_byte_str(email.charAt(i)) == 2) {
          temp_str += convert_2byte_2_1byte(email.charAt(i));
        } else {
          temp_str += email.charAt(i);
        }
      }
    } else {
      temp_str = email;
    }

    temp_str = temp_str.replace(/[^0-9a-zA-Z@.]/, '');
    $("#email").val(temp_str);
  });

  function convert_2byte_2_1byte(str) {
    var char_code = str.charCodeAt(0) - 65248;
    return String.fromCharCode(char_code);
  }

  function get_number_byte_str(str) {
    var b = str.match(/[^\x00-\xff]/g);
    return str.length + (!b ? 0 : b.length);
  }

  $('.card').on('show.bs.collapse', function () {
    $(this).find('.payment-method').prop('checked', true);
  });
  $("[data-toggle=\"collapse\"]").on('click', function (e) {
    if ($(this).parents('.accordion').find('.collapse.show')) {
      var idx = $(this).index('[data-toggle="collapse"]');

      if (idx == $('.collapse.show').index('.collapse')) {
        // prevent collapse
        e.stopPropagation();
      }
    }
  });
  $('.custom-link').off('click');
  $('.custom-link').on('click', function () {
    Swal.fire({
      confirmButtonColor: '#d7751e',
      html: '<div class="hint-content"><div><div class="hint-head">セキュリティコードとは、カード裏面の署名欄やカード表面のカード番号近くに記載されている3桁または4桁の数字です</div>' + '<div  class="hint-title">VISA/Mastercard/JCB/Diners</div>' + '<div class="hint-align"><img src="sunsun/imgs/hint-visa.png" /></div>' + '<div  class="hint-title">American Express</div>' + '<div class="hint-align"><img src="sunsun/imgs/hint-ame.png" /></div></div></div>',
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
      cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
      allowOutsideClick: false
    });
  });
  var cardType;
  $('#card-number').off('keyup');
  $('#card-number').on('keyup', function (e) {
    if ($('#card-number').val().length !== 0) {
      $('#card-number').val($('#card-number').val().replace(/\D/g, '').replace(/(\d{4})/g, '$1 ').trim());

      switch (getCardType($('#card-number').val().replace(/\D/g, ''))) {
        case "VISA":
          {
            if (cardType !== "VISA") {
              $(".card-img").html('<img src="sunsun/svg/cc-visa.svg" class="img-fluid scale-image" alt="">');
            }

            cardType = "VISA";
            break;
          }

        case "MASTERCARD":
          {
            if (cardType !== "MASTERCARD") {
              $(".card-img").html('<img src="sunsun/svg/cc-mastercard.svg" class="img-fluid scale-image" alt="">');
            }

            cardType = "MASTERCARD";
            break;
          }

        case "AMEX":
          {
            if (cardType !== "AMEX") {
              $(".card-img").html('<img src="sunsun/svg/cc-amex.svg" class="img-fluid scale-image" alt="">');
            }

            cardType = "AMEX";
            break;
          }

        case "JCB":
          {
            if (cardType !== "JCB") {
              $(".card-img").html('<img src="sunsun/svg/cc-jcb.svg" class="img-fluid scale-image" alt="">');
            }

            cardType = "JCB";
            break;
          }

        default:
          {
            if (cardType !== "NONE") {
              $(".card-img").html('<img src="sunsun/svg/cc-blank.svg" class="img-fluid scale-image" alt="">');
            }

            cardType = "NONE";
            break;
          }
      }

      $(this).parent().find('span:first-child').css('display', 'inline');
      $(this).removeClass('typing-none');
      $(this).addClass('typing');
    } else {
      console.log("bbb");
      $(this).parent().find('span:first-child').css('display', 'none');
      $(this).removeClass('typing');
      $(this).addClass('typing-none');
    }
  });

  function getCardType(cardNum) {
    if (!luhnCheck(cardNum)) {
      return "";
    }

    var payCardType = "";
    var regexMap = [{
      regEx: /^4[0-9]{5}/ig,
      cardType: "VISA"
    }, {
      regEx: /^5[1-5][0-9]{4}/ig,
      cardType: "MASTERCARD"
    }, {
      regEx: /^3[47][0-9]{3}/ig,
      cardType: "AMEX"
    }, // {regEx: /^(5[06-8]\d{4}|6\d{5})/ig,cardType: "MAESTRO"},
    {
      regEx: /^(?:2131|1800|35\d{3})\d{11}$/ig,
      cardType: "JCB"
    }];

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

        if (cardNum.substr(0, 6) >= c && cardNum.substr(0, 6) <= f && cardNum.length >= 6) {
          payCardType = "RUPAY";
          break;
        }
      }
    }

    return payCardType;
  }

  function luhnCheck(cardNum) {
    // Luhn Check Code from https://gist.github.com/4075533
    // accept only digits, dashes or spaces
    var numericDashRegex = /^[\d\-\s]+$/;
    if (!numericDashRegex.test(cardNum)) return false; // The Luhn Algorithm. It's so pretty.

    var nCheck = 0,
        nDigit = 0,
        bEven = false;
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

    return nCheck % 10 === 0;
  }

  $('#card-secret').off('keyup');
  $('#card-secret').on('keyup', function () {
    if ($('#card-secret').val().length !== 0) {
      $(this).parent().find('span:first-child').css('display', 'inline');
      $(this).removeClass('typing-none');
      $(this).addClass('typing');
      var secretCard = $('#card-secret').val().replace(/\D/g, '');
      $('#card-secret').val(secretCard);
    } else {
      $(this).parent().find('span:first-child').css('display', 'none');
      $(this).removeClass('typing');
      $(this).addClass('typing-none');
    }
  });
  $('#make_payment').off('click');
  $('#make_payment').on('click', function () {
    makePayment();
  });

  var makePayment = function makePayment() {
    if ($('input[type=radio][name=payment-method]:checked').val() === '1') {
      doPurchase();
    } else {
      callBackMakePayment();
    }
  };
});

var callBackMakePayment = function callBackMakePayment() {
  var data = $('form.booking').serializeArray();
  $('#Token').val("");
  console.log(data);
  $.ajax({
    url: '/make_payment',
    type: 'POST',
    data: data,
    dataType: 'text',
    beforeSend: function beforeSend() {
      loader.css({
        'display': 'block'
      });
    },
    success: function success(html) {
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
        });
        $('p.note-error').remove();
        $('.validate_failed').removeClass('validate_failed');
        $.each(html.error, function (index, item) {
          $('#' + item).addClass('validate_failed');
          console.log(item);

          switch (item) {
            case 'name':
              $('#' + item).parent().after('<p class="note-error node-text"> 入力されている名前は無効になっています。</p>');
              break;

            case 'phone':
              $('#' + item).parent().after('<p class="note-error node-text"> 電話番号は無効になっています。</p>');
              break;

            case 'email':
              $('#' + item).parent().after('<p class="note-error node-text"> ﾒｰﾙｱﾄﾞﾚｽは無効になっています。</p>');
              break;
          }
        });
        $.each(html.clear, function (index, item) {
          $('#' + item).removeClass('validate_failed');
        });
      } else {
        if (typeof html.status !== 'undefined' && html.status == 'success') {
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
          $('#completeForm').submit(); // window.location.href = $site_url+"/complete";
        } else if (typeof html.status !== 'undefined' && html.status == 'error') {
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
          });
        }
      }
    },
    complete: function complete() {
      loader.css({
        'display': 'none'
      });
    }
  });
};

function doPurchase() {
  if (getCardType($('#card-number').val().replace(/\D/g, '')) != "") {
    payment_init(); // Multipayment.init("tshop00042155");

    var cardNumber = $('#card-number').val().replace(/\D/g, '');
    var cardExpire = $('#expire-year').val().toString() + $('#expire-month').val().toString();
    var cardSecure = $('#card-secret').val().replace(/\D/g, ''); // let cardHoldname = 'HOLDER NAME';
    // console.log(cardNumber);
    // console.log(cardExpire);
    // console.log(cardSecure);

    Multipayment.getToken({
      cardno: cardNumber,
      expire: cardExpire,
      securitycode: cardSecure,
      // holdername : cardHoldname,
      tokennumber: 1
    }, execPurchase);
  } else {
    $('#card-number').addClass('error');
    $('#card-secret').addClass('error');
    $('#expire-month').addClass('error');
    $('#expire-year').addClass('error');
    $('#card-number').after("<p class=\"note-error node-text\">無効なカード</p>");
  }
}

function getCardType(cardNum) {
  if (!luhnCheck(cardNum)) {
    return "";
  }

  var payCardType = "";
  var regexMap = [{
    regEx: /^4[0-9]{5}/ig,
    cardType: "VISA"
  }, {
    regEx: /^5[1-5][0-9]{4}/ig,
    cardType: "MASTERCARD"
  }, {
    regEx: /^3[47][0-9]{3}/ig,
    cardType: "AMEX"
  }, // {regEx: /^(5[06-8]\d{4}|6\d{5})/ig,cardType: "MAESTRO"},
  {
    regEx: /^(?:2131|1800|35\d{3})\d{11}$/ig,
    cardType: "JCB"
  }];

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

      if (cardNum.substr(0, 6) >= c && cardNum.substr(0, 6) <= f && cardNum.length >= 6) {
        payCardType = "RUPAY";
        break;
      }
    }
  }

  return payCardType;
}

function luhnCheck(cardNum) {
  // Luhn Check Code from https://gist.github.com/4075533
  // accept only digits, dashes or spaces
  var numericDashRegex = /^[\d\-\s]+$/;
  if (!numericDashRegex.test(cardNum)) return false; // The Luhn Algorithm. It's so pretty.

  var nCheck = 0,
      nDigit = 0,
      bEven = false;
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

  return nCheck % 10 === 0;
}

if (typeof execPurchase === 'undefined') {
  execPurchase = function execPurchase(response) {
    console.log(response);
    $('p.note-error').remove();

    if (response.resultCode != "000") {
      // window.alert("購入処理中にエラーが発生しました");
      $('#card-number').addClass('error');
      $('#card-secret').addClass('error');
      $('#expire-month').addClass('error');
      $('#expire-year').addClass('error');
      $('#card-number').after("<p class=\"note-error node-text\">無効なカード</p>");
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

/***/ }),

/***/ 3:
/*!***********************************************************!*\
  !*** multi ./resources/assets/sunsun/front/js/payment.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\sonmq\docker\src\sunsun\resources\assets\sunsun\front\js\payment.js */"./resources/assets/sunsun/front/js/payment.js");


/***/ })

/******/ });