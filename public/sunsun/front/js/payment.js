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
  $('#card-number').off('keyup');
  $('#card-number').on('keyup', function (e) {
    if ($('#card-number').val().length !== 0) {
      $('#card-number').val($('#card-number').val().replace(/\s/g, '').replace(/(\d{4})/g, '$1 ').trim());

      switch (getCardType($('#card-number').val().replace(/\s/g, ''))) {
        case "VISA":
          {
            $(".card-img").html('<i class="fab fa-cc-visa fa-2x"></i>');
            break;
          }

        case "MASTERCARD":
          {
            $(".card-img").html('<i class="fab fa-cc-mastercard fa-2x"></i>');
            break;
          }

        case "AMEX":
          {
            $(".card-img").html('<i class="fab fa-cc-amex fa-2x"></i>');
            break;
          }
        // case "MAESTRO": {
        //     $(".card-img").html("MAESTRO");
        //     break;
        // }

        case "JCB":
          {
            $(".card-img").html('<i class="fab fa-cc-jcb fa-2x"></i>');
            break;
          }

        default:
          {
            $(".card-img").html('<img src="https://galacticglasses.com/image/bank_def.png" class="img-fluid scale-image" alt="">');
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
    }, {
      regEx: /^(5[06-8]\d{4}|6\d{5})/ig,
      cardType: "MAESTRO"
    }, {
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

  $('#card-expire').off('keyup');
  $('#card-expire').on('keyup', function () {
    if ($('#card-expire').val().length !== 0) {
      $(this).parent().find('span:first-child').css('display', 'inline');
      $(this).removeClass('typing-none');
      $(this).addClass('typing');
      var expiredDate = $('#card-expire').val().replace(/\D/g, '').replace(/(\d{2})/g, '$1/').trim();

      if (expiredDate.length == 6 || expiredDate.length == 3) {
        expiredDate = expiredDate.slice(0, -1);
      }

      $('#card-expire').val(expiredDate);
    } else {
      $(this).parent().find('span:first-child').css('display', 'none');
      $(this).removeClass('typing');
      $(this).addClass('typing-none');
    }
  });
  $('#card-secret').off('keyup');
  $('#card-secret').on('keyup', function () {
    if ($('#card-secret').val().length !== 0) {
      console.log("aaa");
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
  $('#make_payment').off('click');
  $('#make_payment').on('click', function () {
    var data = $('form.booking').serializeArray();
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
            icon: 'error',
            title: 'エラー',
            text: ' 入力した情報を再確認してください。',
            confirmButtonColor: '#d7751e',
            confirmButtonText: 'もう一度やり直してください。',
            showClass: {
              popup: 'animated zoomIn faster'
            },
            hideClass: {
              popup: 'animated zoomOut faster'
            },
            allowOutsideClick: false
          });
          $('p.note-error').remove();
          $.each(html.error, function (index, item) {
            $('#' + item).css({
              'border': 'solid 1px #f50000'
            });

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
            $('#' + item).css({
              'border': 'solid 1px #ced4da'
            });
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
            makePayment(); // window.location.href = $site_url+"/complete";
          } else if (typeof html.status !== 'undefined' && html.status == 'error') {
            Swal.fire({
              icon: 'error',
              title: 'エラー',
              text: html.message,
              confirmButtonColor: '#d7751e',
              confirmButtonText: html.message,
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
  });

  var makePayment = function makePayment() {
    if ($('input[type=radio][name=payment-method]:checked').val() === '1') {
      console.log("abc");
      doPurchase();
    }
  };
});

function doPurchase(cardno, expire, securitycode, holdername, tokennumber) {
  Multipayment.init("tshop00042155");
  Multipayment.getToken({
    cardno: '48545',
    expire: '201501',
    securitycode: '111',
    holdername: 'ABCXYZ',
    tokennumber: 1
  }, execPurchase);
}

/***/ }),

/***/ 3:
/*!***********************************************************!*\
  !*** multi ./resources/assets/sunsun/front/js/payment.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\minhtu.EQ8VH23ACB52NJV\docker\src\sunsun\resources\assets\sunsun\front\js\payment.js */"./resources/assets/sunsun/front/js/payment.js");


/***/ })

/******/ });