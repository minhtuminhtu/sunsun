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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
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
      modal_choice_time = $('#choice_date_time');
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  var today = moment();
  var tomorrow = moment(today).add(1, 'days');

  var load_event = function load_event() {
    var check = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    var d = new Date();
    var strToday = today.format('Y') + "/" + today.format('MM') + "/" + today.format('DD');
    var strTomorrow = tomorrow.format('Y') + "/" + tomorrow.format('MM') + "/" + tomorrow.format('DD');

    if ($('#date').val() == "") {
      $('#date').val(strToday + "(" + days_short[moment(strToday).weekday()] + ")");
    }

    if ($('#range_date_start').val() == "") {
      $('#range_date_start').val(strToday);
    }

    if ($('#range_date_end').val() == "") {
      $('#range_date_end').val(strTomorrow);
    }

    if ($('#plan_date_start').val() == "") {
      $('#plan_date_start').val(strToday);
    }

    if ($('#plan_date_end').val() == "") {
      $('#plan_date_end').val(strTomorrow);
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
    $('#room').on('change', function () {
      var room = JSON.parse($('#room').val());

      if (room.kubun_id == '01') {
        $('.room').hide();
      } else {
        $('.room').show();
      }
    });
    $('#whitening').on('change', function () {
      var whitening = JSON.parse($('#whitening').val());

      if (whitening.kubun_id == '01') {
        $('.whitening').hide();
      } else {
        $('.whitening').show();
      }
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
    $('.agecheck').on('click', function () {
      $('.agecheck').removeClass('color-active');
      $('.agecheck').addClass('btn-outline-warning');
      $(this).addClass('color-active');
      $(this).removeClass('btn-outline-warning');
      $('#agecheck').val($(this).val());

      if ($(this).val() == '1' || $(this).val() == '2') {
        $('#age_value').empty();

        for (var i = 0; i < 19; i++) {
          $('#age_value').append('<option value="' + i + '">' + i + '</option>');
          $('#age_value').val("18");
        }
      } else if ($(this).val() == '3') {
        $('#age_value').empty();

        for (var _i = 18; _i < 100; _i++) {
          $('#age_value').append('<option value="' + _i + '">' + _i + '</option>');
          $('#age_value').val("18");
        }
      }
    });
    $('#date').on('change blur', function () {
      var check = moment($('#date').val());
      $('#date').val(check.format('YYYY') + "/" + check.format('MM') + "/" + check.format('DD') + "(" + days_short[check.weekday()] + ")");
      $('#date-value').val(check.format('YYYYMMDD'));
      $('#date-view').val(check.format('YYYY') + "年" + check.format('MM') + "月" + check.format('DD') + "日(" + days_short[check.weekday()] + ")");
    });

    function change_day() {
      var check = moment($('#date').val());
      $('#date').val(check.format('YYYY') + "/" + check.format('MM') + "/" + check.format('DD') + "(" + days_short[check.weekday()] + ")");
      $('#date-value').val(check.format('YYYYMMDD'));
      $('#date-view').val(check.format('YYYY') + "年" + check.format('MM') + "月" + check.format('DD') + "日(" + days_short[check.weekday()] + ")");
    }

    $(".room_range_date").on('change blur', function () {
      var check2 = moment($('#range_date_start').val());
      var check1 = moment($('#range_date_end').val());
      $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
      $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
      $('#range_date_start-value').val(check2.format('YYYYMMDD'));
      $('#range_date_end-value').val(check1.format('YYYYMMDD'));
    });
    load_pick_time();
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
          modal_choice_time.find('.modal-body-time').html(html);
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
        url: $site_url + '/book_time_room_pet',
        type: 'POST',
        data: {
          'gender': $('select[name=date]').val()
        },
        dataType: 'text',
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(html) {
          set_time_click.closest('.set-time').addClass('edit');
          modal_choice_time.find('.modal-body-time').html(html);
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
    $('#time-value').val('1345');
    modal_choice_time.modal('hide');
  });

  var get_service = function get_service() {
    var data = {
      'service': $('#course').val()
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
        load_date_before();
        load_time_list();
      },
      complete: function complete() {
        loader.css({
          'display': 'none'
        });
      }
    });
  };

  $('#course').on('change', function () {
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
  var input_daterange = $('.input-daterange');
  input_daterange.datepicker({
    language: 'ja',
    dateFormat: 'yyyy/mm/dd',
    startDate: new Date()
  });

  var load_time_list = function load_time_list() {
    var check = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

    if (!check) {
      $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')</label><input name="date[' + 0 + '][day]" value="' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + 0 + '][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + 0 + '][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
      $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')</label><input name="date[' + 1 + '][day]" value="' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + 1 + '][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + 1 + '][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
    }

    $(".range_date").change(function () {
      var date_arr = getDates($('#plan_date_start').val(), $('#plan_date_end').val());
      $('.time-list').empty();
      moment.locale('ja');
      date_arr.forEach(function (element, index) {
        var check = moment(element);
        var month = check.format('MM');
        var day = check.format('DD');
        var week_day = check.weekday();
        $('.time-list').append('<div class="booking-field choice-time"><div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label><input name="date[' + index + '][day]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + index + '][from]" type="text" class="time form-control js-set-time" id="" value="9:45" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + index + '][to]" type="text" class="time form-control js-set-time" id="" value="13:45" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
      });
      var check2 = moment($('#plan_date_start').val());
      var check1 = moment($('#plan_date_end').val());
      $('#plan_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
      $('#plan_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
      load_event();
    });
    load_event();
  };

  load_time_list();
});

var load_time_list_event = function load_time_list_event() {
  $('.svg-button').on('click', function () {
    var r = confirm("Are you sure to delete this time?");

    if (r == true) {
      $($(this).parent().parent().remove());
    }
  });
};

var load_pick_time = function load_pick_time() {
  modal_choice_time = $('#choice_date_time');
  var set_time = $('.js-set-time');
  set_time.click(function (e) {
    var set_time_click = $(this);
    $.ajax({
      url: '/get_time_room',
      type: 'POST',
      data: {
        'gender': $('select[name=gender]').val()
      },
      dataType: 'text',
      beforeSend: function beforeSend() {
        loader.css({
          'display': 'block'
        });
      },
      success: function success(html) {
        set_time_click.closest('.set-time').addClass('edit');
        modal_choice_time.find('.modal-body-time').html(html);
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

var load_date_before = function load_date_before() {
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  var today = moment();
  var tomorrow = moment(today).add(1, 'days');
  $('#add-time').on('click', function () {
    var num = $('.booking-time').length;
    $(".time-content").append('<div class="block-content-1 margin-top-mini"> <div class="block-content-1-left"><div class="timedate-block set-time">    <input name="time[' + num + ']" type="text" class="form-control time js-set-time booking-time bg-white" readonly="readonly" id="" value="13:45" /></div> </div> <div class="block-content-1-right"><img class="svg-button" src="/sunsun/svg/close.svg" alt="Close" /></div>           </div>');
    load_time_list_event();
    load_pick_time();
  });
  $('#age_value').val("18");
  $('#date-value').val(today.format('YYYYMMDD'));
  $('#date-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
  $('#range_date_start-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
  $('#range_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('MM') + "月" + tomorrow.format('DD') + "日(" + days_short[tomorrow.weekday()] + ")");
  $('#range_date_start-value').val(today.format('YYYYMMDD'));
  $('#range_date_end-value').val(tomorrow.format('YYYYMMDD'));
  $('#plan_date_start-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
  $('#plan_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('MM') + "月" + tomorrow.format('DD') + "日(" + days_short[tomorrow.weekday()] + ")");
};

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

$('#transport').on('change', function () {
  var transport = JSON.parse($('#transport').val());

  if (transport.kubun_id == '01') {
    $('.bus').hide();
  } else {
    $('.bus').show();
  }
});
$('#date').on('change blur', function () {
  var check = moment($('#date').val());
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  $('#date').val(check.format('YYYY') + "/" + check.format('MM') + "/" + check.format('DD') + "(" + days_short[check.weekday()] + ")");
  $('#date-view').val(check.format('YYYY') + "年" + check.format('MM') + "月" + check.format('DD') + "日(" + days_short[check.weekday()] + ")");
  $('#date-value').val(check.format('YYYYMMDD'));
});
$(".room_range_date").on('change blur', function () {
  var check2 = moment($('#range_date_start').val());
  var check1 = moment($('#range_date_end').val());
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
  $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
  $('#range_date_start-value').val(check2.format('YYYYMMDD'));
  $('#range_date_end-value').val(check1.format('YYYYMMDD'));
});
$('#confirm').on('change', function () {
  if ($(this).is(":checked")) {
    $(".confirm-rules").prop("disabled", false);
  } else {
    $(".confirm-rules").prop("disabled", true);
  }
});

/***/ }),

/***/ 2:
/*!***********************************************************!*\
  !*** multi ./resources/assets/sunsun/front/js/booking.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\minhtu.EQ8VH23ACB52NJV\docker\src\sunsun\resources\assets\sunsun\front\js\booking.js */"./resources/assets/sunsun/front/js/booking.js");


/***/ })

/******/ });