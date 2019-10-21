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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/sunsun/front/js/booking.js":
/*!*****************************************************!*\
  !*** ./resources/assets/sunsun/front/js/booking.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var service = $('.service-warp'),
      modal_choice_time = $('#choice_date_time'),
      days_short = ["日", "月", "火", "水", "木", "金", "土"];

  var load_event = function load_event() {
    var date_book = $('.date-book');
    date_book.datepicker({
      language: 'ja'
    });
    date_book.on('changeDate', function () {
      var edit = $(this);
      edit.closest('.date-warp').find('.date-book-input').val(edit.datepicker('getFormattedDate'));
    });
    $('.date-book-input').datepicker({
      language: 'ja'
    });
    var input_daterange = $('.input-daterange');
    input_daterange.datepicker({
      language: 'ja',
      dateFormat: 'yyyy/mm/dd',
      autoclose: true,
      minDate: moment().toArray()
    });
    input_daterange.on('changeDate', function () {});

    function getDates(startDate, stopDate) {
      var dateArray = [];
      var currentDate = moment(startDate);
      var stopDate = moment(stopDate);

      while (currentDate <= stopDate) {
        dateArray.push(moment(currentDate).format('YYYY-MM-DD'));
        currentDate = moment(currentDate).add(1, 'days');
      }

      return dateArray;
    }

    $(".range_date").change(function () {
      var date_arr = getDates($('#plan_date_start').val(), $('#plan_date_end').val());
      $('.time-list').empty();
      moment.locale('ja');
      date_arr.forEach(function (element, index) {
        var check = moment(element);
        var month = check.format('M');
        var day = check.format('D');
        var year = check.format('YYYY');
        var week_day = check.weekday();
        $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label><input name="date[' + index + '][day]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="input-time"><input name="date[' + index + '][from]" type="text" class="time form-control" id="" value="9:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div><div class="choice-data-time set-time">    <div class="data"><input name="date[' + index + '][to]" type="text" class="form-control time" id="" value="13:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div>    </div></div>');
      });
      load_event();
    });
    $('.agecheck').click(function () {
      $('.agecheck').removeClass('btn-warning');
      $(this).addClass('btn-warning');
      $('#agecheck').val($(this).text());
    });
    $('#room').on('change', function () {
      if (this.value == '無し') {
        $('.room').hide();
      } else {
        $('.room').show();
      }
    });
    var set_time = $('.js-set-time');
    set_time.click(function (e) {
      var set_time_click = $(this);
      $.ajax({
        url: $site_url + '/get_time_room',
        type: 'POST',
        data: {
          'sex': $('select[name=sex]').val()
        },
        dataType: 'text',
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(html) {
          set_time_click.closest('.set-time').addClass('edit');
          modal_choice_time.find('.modal-body-time').append(html);
          modal_choice_time.modal('show');
        },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    });
  };

  load_event();
  modal_choice_time.on('hidden.bs.modal', function () {
    modal_choice_time.find('.modal-body-time').empty();
    $('.set-time').removeClass('edit');
  });
  modal_choice_time.on('click', '#js-save-time', function (e) {
    var time = modal_choice_time.find('input[name=time]:checked').val();
    $('.set-time.edit input.time').val(time);
    modal_choice_time.modal('hide');
  });
  $('#services').on('change', function () {
    $('.service-warp').empty();
    $.ajax({
      url: $site_url + '/get_service',
      type: 'POST',
      data: {
        'service': this.value
      },
      dataType: 'text',
      beforeSend: function beforeSend() {
        loader.css({
          'display': 'block'
        });
        $('.service-warp').empty();
      },
      success: function success(html) {
        $('.service-warp').append(html);
        load_event();
      },
      complete: function complete() {
        loader.css({
          'display': 'none'
        });
      }
    });
  });
});
$('.agecheck').click(function () {
  $('.agecheck').removeClass('btn-warning');
  $(this).addClass('btn-warning');
  $('#agecheck').val($(this).text());
});
$('#transportation').on('change', function () {
  if (this.value == '車​') {
    $('.bus').hide();
  } else {
    $('.bus').show();
  }
});
$('#room').on('change', function () {
  if (this.value == '無し') {
    $('.room').hide();
  } else {
    $('.room').show();
  }
});
$('#confirm').on('change', function () {
  if ($(this).is(":checked")) {
    $(":submit").attr("disabled", false);
  } else {
    $(":submit").attr("disabled", true);
  }
});

/***/ }),

/***/ 1:
/*!***********************************************************!*\
  !*** multi ./resources/assets/sunsun/front/js/booking.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/sunsun/resources/assets/sunsun/front/js/booking.js */"./resources/assets/sunsun/front/js/booking.js");


/***/ })

/******/ });