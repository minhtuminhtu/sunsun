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
    var check = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    var d = new Date();
    var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
    var strDate1 = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + (d.getDate() + 1);

    if ($('#date').val() == "") {
      $('#date').val(strDate + "(" + days_short[moment(strDate).weekday()] + ")");
    }

    if ($('#range_date_start').val() == "") {
      $('#range_date_start').val(strDate);
    }

    if ($('#range_date_end').val() == "") {
      $('#range_date_end').val(strDate1);
    }

    if ($('#plan_date_start').val() == "") {
      $('#plan_date_start').val(strDate);
    }

    if ($('#plan_date_end').val() == "") {
      $('#plan_date_end').val(strDate1);
    }

    var date_book = $('.date-book');
    date_book.datepicker({
      language: 'ja',
      startDate: new Date()
    });
    date_book.on('changeDate', function () {
      var edit = $(this);
      edit.closest('.date-warp').find('.date-book-input').val(edit.datepicker('getFormattedDate'));
      change_day();
    });
    $('#date').datepicker({
      language: 'ja',
      dateFormat: "yyyy/mm/dd",
      startDate: new Date()
    });
    var input_daterange = $('.input-daterange');
    input_daterange.datepicker({
      language: 'ja',
      dateFormat: 'yyyy/mm/dd',
      // autoclose: true,
      startDate: new Date()
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

    if (!check) {
      var time = moment(strDate);
      var time1 = moment(strDate1);
      $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + time.format('M') + '/' + time.format('D') + '(' + days_short[time.weekday()] + ')</label><input name="date[' + 0 + '][day]" value="' + time.format('M') + '/' + time.format('D') + '(' + days_short[time.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="input-time"><input name="date[' + 0 + '][from]" type="text" class="time form-control" id="" value="9:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div><div class="choice-data-time set-time">    <div class="data"><input name="date[' + 0 + '][to]" type="text" class="form-control time" id="" value="13:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div>    </div></div>');
      $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + time1.format('M') + '/' + time1.format('D') + '(' + days_short[time1.weekday()] + ')</label><input name="date[' + 1 + '][day]" value="' + time1.format('M') + '/' + time1.format('D') + '(' + days_short[time1.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="input-time"><input name="date[' + 1 + '][from]" type="text" class="time form-control" id="" value="9:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div><div class="choice-data-time set-time">    <div class="data"><input name="date[' + 1 + '][to]" type="text" class="form-control time" id="" value="13:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div>    </div></div>');
    }

    $(".range_date").change(function () {
      var date_arr = getDates($('#plan_date_start').val(), $('#plan_date_end').val());
      $('.time-list').empty();
      moment.locale('ja');
      date_arr.forEach(function (element, index) {
        var check = moment(element);
        var month = check.format('M');
        var day = check.format('D');
        var week_day = check.weekday();
        $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label><input name="date[' + index + '][day]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="input-time"><input name="date[' + index + '][from]" type="text" class="time form-control" id="" value="9:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div><div class="choice-data-time set-time">    <div class="data"><input name="date[' + index + '][to]" type="text" class="form-control time" id="" value="13:45" />    </div>    <div class="icon-time"><span class="icon-clock">    <i class="far fa-clock fa-2x js-set-time mt-1"></i></span>    </div></div>    </div></div>');
      });
      var check2 = moment($('#plan_date_start').val());
      var check1 = moment($('#plan_date_end').val());
      $('#plan_date_start-view').val(check2.format('YYYY') + "年" + check2.format('M') + "月" + check2.format('D') + "日(" + days_short[check2.weekday()] + ")");
      $('#plan_date_end-view').val(check1.format('YYYY') + "年" + check1.format('M') + "月" + check1.format('D') + "日(" + days_short[check1.weekday()] + ")");
      load_event(1);
    });
    $('.agecheck').click(function () {
      $('.agecheck').removeClass('btn-warning');
      $('.agecheck').addClass('btn-outline-warning');
      $(this).addClass('btn-warning');
      $(this).removeClass('btn-outline-warning');
      $('#agecheck').val($(this).text());
    });
    $('#room').on('change', function () {
      if (this.value == '無し') {
        $('.room').hide();
      } else {
        $('.room').show();
      }
    });
    $('#date').on('change blur', function () {
      var check = moment($('#date').val());
      $('#date').val(check.format('YYYY') + "/" + check.format('M') + "/" + check.format('D') + "(" + days_short[check.weekday()] + ")");
      $('#date-view').val(check.format('YYYY') + "年" + check.format('M') + "月" + check.format('D') + "日(" + days_short[check.weekday()] + ")");
    });

    function change_day() {
      var check = moment($('#date').val());
      $('#date').val(check.format('YYYY') + "/" + check.format('M') + "/" + check.format('D') + "(" + days_short[check.weekday()] + ")");
      $('#date-view').val(check.format('YYYY') + "年" + check.format('M') + "月" + check.format('D') + "日(" + days_short[check.weekday()] + ")");
    }

    $(".room_range_date").on('change blur', function () {
      var check2 = moment($('#range_date_start').val());
      var check1 = moment($('#range_date_end').val());
      $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('M') + "月" + check2.format('D') + "日(" + days_short[check2.weekday()] + ")");
      $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('M') + "月" + check1.format('D') + "日(" + days_short[check1.weekday()] + ")");
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
    var get_room = $('.js-set-room');
    get_room.click(function (e) {
      var set_time_click = $(this);
      $.ajax({
        url: $site_url + '/book_room',
        type: 'POST',
        data: {
          'sex': $('select[name=date]').val()
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
    var get_room_pet = $('.js-set-room_pet');
    get_room_pet.click(function (e) {
      var set_time_click = $(this);
      $.ajax({
        url: $site_url + '/book_room',
        type: 'POST',
        data: {
          'sex': $('select[name=date]').val()
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
  var transportation = $('#transportation').val();

  if (transportation === '車​') {
    $('.bus').hide();
  } else {
    $('.bus').show();
  }

  var get_service = function get_service() {
    var data = {
      'service': $('#services').val()
    };

    if ($('input[name=add_new_user]').val() == 'on') {
      data.add_new_user = 'on';
    }

    $.ajax({
      url: $site_url + '/get_service',
      type: 'POST',
      data: data,
      dataType: 'text',
      beforeSend: function beforeSend() {
        loader.css({
          'display': 'block'
        });
      },
      success: function success(html) {
        $('.service-warp').empty().append(html).hide().fadeIn('slow');
        load_event();
      },
      complete: function complete() {
        loader.css({
          'display': 'none'
        });
      }
    });
  };

  $('#services').on('change', function () {
    get_service();
  });
  get_service();
  $('.btn-booking').click(function (e) {
    e.preventDefault();
    var btn_click = $(this);
    $.ajax({
      url: $site_url + '/save_booking',
      type: 'POST',
      data: $('form.booking').serializeArray(),
      dataType: 'JSON',
      beforeSend: function beforeSend() {
        loader.css({
          'display': 'block'
        });
      },
      success: function success(r) {
        if (btn_click.hasClass('add-new-people')) {
          window.location.href = $site_url + '/booking?add_new_user=on';
        } else {
          window.location.href = $site_url + '/confirm';
        }
      },
      complete: function complete() {
        loader.css({
          'display': 'none'
        });
      }
    });
  });
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
$('.agecheck').click(function () {
  $('.agecheck').removeClass('btn-warning');
  $(this).addClass('btn-warning');
  $('#agecheck').val($(this).text());
});
$('#date').on('change blur', function () {
  var check = moment($('#date').val());
  var month = check.format('M');
  var day = check.format('D');
  var year = check.format('YYYY');
  var week_day = check.weekday();
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  $('#date').val(year + "/" + month + "/" + day + "(" + days_short[week_day] + ")");
  $('#date-view').val(year + "年" + month + "月" + day + "日(" + days_short[week_day] + ")");
});
$(".room_range_date").on('change blur', function () {
  var check2 = moment($('#range_date_start').val());
  var check1 = moment($('#range_date_end').val());
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('M') + "月" + check2.format('D') + "日(" + days_short[check2.weekday()] + ")");
  $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('M') + "月" + check1.format('D') + "日(" + days_short[check1.weekday()] + ")");
});
$('#confirm').on('change', function () {
  if ($(this).is(":checked")) {
    $(".confirm-rules").prop("disabled", false);
  } else {
    $(".confirm-rules").prop("disabled", true);
  }
});

/***/ }),

/***/ 1:
/*!***********************************************************!*\
  !*** multi ./resources/assets/sunsun/front/js/booking.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\tranv\docker\src\sunsun\resources\assets\sunsun\front\js\booking.js */"./resources/assets/sunsun/front/js/booking.js");


/***/ })

/******/ });