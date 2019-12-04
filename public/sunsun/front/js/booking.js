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
  var modal_choice_time = $('#choice_date_time');
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  var today = moment();

  if (today.weekday() == 3) {
    today = moment(today).add(2, 'days');
  } else if (today.weekday() == 4) {
    today = moment(today).add(1, 'days');
  }

  var tomorrow = moment(today).add(1, 'days');
  load_once_time();

  var get_service = function get_service(course, course_data, course_time) {
    if (course == "") {
      course = $('#course').val();
    }

    var data = {
      'service': course,
      'course_data': course_data,
      'course_time': course_time
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
        load_after_ajax();
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
    get_service($('#course').val(), $('#course_data').val(), $('#course_time').val());
  });
  get_service($('#pick_course').val(), $('#course_data').val(), $('#course_time').val());

  var load_event = function load_event() {
    var check = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    var strToday = today.format('Y') + "/" + today.format('MM') + "/" + today.format('DD');
    var strTomorrow = tomorrow.format('Y') + "/" + tomorrow.format('MM') + "/" + tomorrow.format('DD');

    if ($('#date').val() == "") {
      $('#date').val(strToday);
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
    DatePicker = {
      hideOldDays: function hideOldDays() {
        var x = $('td.old.day');

        if (x.length > 0) {
          x.css('visibility', 'hidden');

          if (x.length === 7) {
            x.parent().hide();
          }
        }
      },
      hideNewDays: function hideNewDays() {
        var x = $('td.new.day');

        if (x.length > 0) {
          x.hide();
        }
      },
      hideOtherMonthDays: function hideOtherMonthDays() {
        DatePicker.hideOldDays();
        DatePicker.hideNewDays();
      }
    };
    $('#date').datepicker({
      language: 'ja',
      dateFormat: "yyyy/mm/dd",
      startDate: new Date(),
      autoclose: true,
      daysOfWeekDisabled: "3,4",
      weekStart: 1,
      orientation: 'bottom'
    });
    $('#date').datepicker().off('hide');
    $('#date').datepicker().on('hide', function (e) {
      change_day();
    });
    $('#date').datepicker().on('show', function (e) {
      DatePicker.hideOtherMonthDays();
    });

    if ($('#date').val() != "") {
      var date_value = moment(new Date($('#date').val()));
      var date_pick = date_value.format('Y') + "/" + date_value.format('MM') + "/" + date_value.format('DD');
      $('#date').val(date_pick + "(" + days_short[moment(new Date(date_pick)).weekday()] + ")");
    }

    $('.input-daterange').datepicker({
      language: 'ja',
      dateFormat: 'yyyy/mm/dd',
      autoclose: true,
      startDate: new Date(),
      daysOfWeekDisabled: "3,4",
      // daysOfWeekHighlighted: "1,2",
      weekStart: 1,
      orientation: 'bottom'
    });

    var get_end_date = function get_end_date() {
      var start_date = moment(new Date($('#plan_date_start').val()));
      var end_date;

      if (start_date.weekday() == 5) {
        end_date = start_date.add(4, 'days').toDate();
      } else {
        end_date = start_date.add(6, 'days').toDate();
      }

      return end_date;
    };

    $('#plan_date_start').datepicker({
      language: 'ja',
      dateFormat: 'yyyy/mm/dd',
      autoclose: true,
      startDate: new Date(),
      daysOfWeekDisabled: "3,4",
      // daysOfWeekHighlighted: "1,2",
      weekStart: 1,
      orientation: 'bottom'
    });
    $('#plan_date_end').datepicker({
      language: 'ja',
      dateFormat: 'yyyy/mm/dd',
      autoclose: true,
      startDate: new Date(),
      endDate: get_end_date(),
      daysOfWeekDisabled: "3,4,5,6",
      weekStart: 1,
      orientation: 'bottom'
    });
    var range_date_temp = [];
    $('#range_date_start').datepicker().on('hide', function () {
      $('#range_date_end').focus();
    });
    $('#plan_date_start').datepicker().on('hide', function () {
      $('#plan_date_end').datepicker('destroy');

      if ($.inArray(moment(new Date($('#plan_date_start').val())).format('YYYY-MM-DD'), range_date_temp) == -1) {
        $('#plan_date_end').val(moment(new Date($('#plan_date_start').val())).add(0, 'days').format('YYYY/MM/DD'));
      }

      $('#plan_date_end').datepicker({
        language: 'ja',
        dateFormat: 'yyyy/mm/dd',
        autoclose: true,
        startDate: new Date($('#plan_date_start').val()),
        endDate: get_end_date(),
        daysOfWeekDisabled: "3,4",
        weekStart: 1,
        orientation: 'bottom'
      });
      $('#plan_date_end').focus();
    });

    var highlight = function highlight(start) {
      var highlight = get_dates($('#plan_date_start').val(), $('#plan_date_end').val());
      highlight.forEach(function (element, index) {
        var date_hl = moment(element + " 00:00 +0000", 'YYYY-MM-DD HH:mm Z').utc().format("X") + "000";

        if (index == 0 || index == highlight.length - 1) {
          if (start && index == 0 || !start && index == highlight.length - 1) {
            $("td[data-date='" + date_hl + "']").css('background-image', 'linear-gradient(to bottom, #08c, #0044cc)');
          } else {
            $("td[data-date='" + date_hl + "']").css('background', '#9e9e9e');
          }

          $("td[data-date='" + date_hl + "']").css('color', '#fff');
        } else {
          $("td[data-date='" + date_hl + "']").css('background', '#eee');
          $("td[data-date='" + date_hl + "']").css('border-radius', 'unset');
          $("td[data-date='" + date_hl + "']").css('color', '#212529');
        }
      });
    };

    $('#plan_date_start').datepicker().on('show', function (e) {
      DatePicker.hideOtherMonthDays();
      highlight(true);
    });
    $('#plan_date_end').datepicker().on('show', function (e) {
      DatePicker.hideOtherMonthDays();
      highlight(false);
    });
    $('#plan_date_end').datepicker().on('hide', function (e) {
      range_date_temp = get_dates($('#plan_date_start').val(), $('#plan_date_end').val());
    });
    $('.input-daterange').datepicker().on('show', function (e) {
      DatePicker.hideOtherMonthDays();
    });
    $('.agecheck').on('click', function () {
      $('.agecheck').removeClass('color-active');
      $('.agecheck').addClass('btn-outline-warning');
      $(this).addClass('color-active');
      $(this).removeClass('btn-outline-warning');
      $('#agecheck').val($(this).val());

      if ($(this).val() == '1' || $(this).val() == '2') {
        $('.age-left').css("visibility", "hidden");
      } else if ($(this).val() == '3') {
        $('.age-left').css("visibility", "visible");
      }
    });

    function change_day() {
      var check = moment(new Date($('#date').val()));
      var days_short = new Array("日", "月", "火", "水", "木", "金", "土");
      $('#date').val(check.format('YYYY') + "/" + check.format('MM') + "/" + check.format('DD') + "(" + days_short[check.weekday()] + ")");
      $('#date-value').val(check.format('YYYYMMDD'));
      $('#date-view').val(check.format('YYYY') + "年" + check.format('MM') + "月" + check.format('DD') + "日(" + days_short[check.weekday()] + ")");
    }

    $(".room_range_date").on('change blur', function () {
      var check2 = moment(new Date($('#range_date_start').val()));
      var check1 = moment(new Date($('#range_date_end').val()));
      $('#range_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
      $('#range_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
      $('#range_date_start-value').val(check2.format('YYYYMMDD'));
      $('#range_date_end-value').val(check1.format('YYYYMMDD'));
    });
    load_pick_time_event();
    load_pick_time_room_event();
    load_pick_time_wt_event();
    load_pick_time_pet_event();
  };

  load_event();
  modal_choice_time.on('hidden.bs.modal', function () {
    modal_choice_time.find('.modal-body-time').empty();
    $('.set-time').removeClass('edit');
  });
  modal_choice_time.off('click', '#js-save-time');
  modal_choice_time.on('click', '#js-save-time', function (e) {
    var time = modal_choice_time.find('input[name=time]:checked').val();
    var bed = modal_choice_time.find('input[name=time]:checked').parent().find('.bed').val();
    var num = $('.booking-time').length;
    var time_value = time_value = time.replace(/[^0-9]/g, '');

    if ($('#new-time').val() == 1) {
      $(".time-content").append('<div class="block-content-1 margin-top-mini"> <div class="block-content-1-left"><div class="timedate-block set-time">    <input name="time[' + num + '][view]" type="text" class="form-control time js-set-time booking-time bg-white" readonly="readonly"  value="" /><input name="time[' + num + '][value]" class="time_value" id="time[' + num + '][value]" type="hidden" value=""><input name="time[' + num + '][bed]" class="time_bed" id="time[' + num + '][bed]" type="hidden" value=""></div> </div> <div class="block-content-1-right"><img class="svg-button" src="/sunsun/svg/close.svg" alt="Close" /></div>           </div>');
      load_time_delete_event();
      load_pick_time_event();
      $('.booking-time').last().val(time);
      $('.time_value').last().val(time_value);
      $('.time_bed').last().val(bed);
    } else {
      $('.set-time.edit input.time').val(time);
      $('.set-time.edit input.time').parent().find('.time_value').val(time_value);
      $('.set-time.edit input.time').parent().find('.time_bed').val(bed);
    }

    $('.set-time.edit input.time').parent().find('#time1-value').val(time_value);
    $('.set-time.edit input.time').parent().find('#time2-value').val(time_value);
    $('.set-time.edit input.time').parent().find('#time1-bed').val(bed);
    $('.set-time.edit input.time').parent().find('#time2-bed').val(bed);
    $('.set-time.edit input.time').parent().find('#time_room_value').val(pad(time_value, 4));
    $('.set-time.edit input.time').parent().find('#time_room_bed').val(bed);
    $('.set-time.edit input.time').parent().find('.time_from').val(time_value);
    $('.set-time.edit input.time').parent().find('.time_to').val(time_value);
    $('.set-time.edit input.time').parent().find('.time_bed').val(bed);

    function pad(n, width) {
      n = n + '';
      return n.length >= width ? n : new Array(width - n.length + 1).join('0') + n;
    }

    if (time.includes("～")) {
      var res = time.split("～");
      $('.set-time.edit input.time').parent().find('#time_room_time1').val(pad(res[0].replace(/[^0-9]/g, ''), 4));
      $('.set-time.edit input.time').parent().find('#time_room_time2').val(pad(res[1].replace(/[^0-9]/g, ''), 4));
      $('.set-time.edit input.time').parent().find('#whitening-time_value').val(pad(res[0].replace(/[^0-9]/g, ''), 4) + '-' + pad(res[1].replace(/[^0-9]/g, ''), 4));
    }

    modal_choice_time.modal('hide');
  });
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

  var load_time_list = function load_time_list() {
    var check = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

    if (!check) {
      $('.time-list').append('<div class="booking-field choice-time"><input value="0" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')</label><input name="date[' + 0 + '][day][view]" value="' + today.format('MM') + '/' + today.format('DD') + '(' + days_short[today.weekday()] + ')" type="hidden" ><input name="date[' + 0 + '][day][value]" value="' + today.format('YYYY') + today.format('MM') + today.format('DD') + '" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + 0 + '][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date[' + 0 + '][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[' + 0 + '][from][view]" type="text" class="time form-control js-set-time bg-white"  readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date[' + 0 + '][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date[' + 0 + '][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[' + 0 + '][to][view]" type="text" class="time form-control js-set-time bg-white"  readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
      $('.time-list').append('<div class="booking-field choice-time"><input value="1" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')</label><input name="date[' + 1 + '][day][view]" value="' + tomorrow.format('MM') + '/' + tomorrow.format('DD') + '(' + days_short[tomorrow.weekday()] + ')" type="hidden" ><input name="date[' + 1 + '][day][value]" value="' + today.format('YYYY') + tomorrow.format('MM') + tomorrow.format('DD') + '" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + 1 + '][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date[' + 1 + '][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[' + 1 + '][from][view]" type="text" class="time form-control js-set-time bg-white"  readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date[' + 1 + '][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date[' + 1 + '][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[' + 1 + '][to][view]" type="text" class="time form-control js-set-time bg-white"  readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
    }

    $(".range_date").change(function () {
      var date_arr = get_dates($('#plan_date_start').val(), $('#plan_date_end').val());
      $('.time-list').empty();
      moment.locale('ja');
      date_arr.forEach(function (element, index) {
        var check = moment(element);
        var year = check.format('YYYY');
        var month = check.format('MM');
        var day = check.format('DD');
        var week_day = check.weekday();
        $('.time-list').append('<div class="booking-field choice-time"><input value="' + index + '" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">' + month + '/' + day + '(' + days_short[week_day] + ')</label><input name="date[' + index + '][day][view]" value="' + month + '/' + day + '(' + days_short[week_day] + ')" type="hidden" ><input name="date[' + index + '][day][value]" value="' + year + month + day + '" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time">    <div class="set-time"><input name="date[' + index + '][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date[' + index + '][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[' + index + '][from][view]" type="text" class="time form-control js-set-time bg-white"  readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date[' + index + '][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date[' + index + '][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[' + index + '][to][view]" type="text" class="time form-control js-set-time bg-white"  readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>');
      });
      var check2 = moment(new Date($('#plan_date_start').val()));
      var check1 = moment(new Date($('#plan_date_end').val()));
      $('#plan_date_start-value').val(check2.format('YYYY') + check2.format('MM') + check2.format('DD'));
      $('#plan_date_end-value').val(check1.format('YYYY') + check1.format('MM') + check1.format('DD'));
      $('#plan_date_start-view').val(check2.format('YYYY') + "年" + check2.format('MM') + "月" + check2.format('DD') + "日(" + days_short[check2.weekday()] + ")");
      $('#plan_date_end-view').val(check1.format('YYYY') + "年" + check1.format('MM') + "月" + check1.format('DD') + "日(" + days_short[check1.weekday()] + ")");
      load_event();
    });
    load_event();
  };

  load_time_list();
});

var load_time_delete_event = function load_time_delete_event() {
  $('.svg-button').off('click');
  $('.svg-button').on('click', function () {
    var r = confirm("Are you sure to delete this time?");

    if (r == true) {
      $($(this).parent().parent().remove());
    }
  });
};

function pad(n, width) {
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join('0') + n;
}

var load_pick_time_event = function load_pick_time_event() {
  modal_choice_time = $('#choice_date_time');
  var set_time = $('.js-set-time');
  set_time.off('click');
  set_time.on('click', function () {
    var course = JSON.parse($('#course').val());
    console.log(course.kubun_id);
    var repeat_user = JSON.parse($('#repeat_user').val());
    var transport = JSON.parse($('#transport').val());
    var repeat_time_check = 0;

    if (transport.kubun_id != '01') {
      var bus_arrive_time_slide = JSON.parse($('#bus_arrive_time_slide').val());
      repeat_time_check = bus_arrive_time_slide.notes;

      if (repeat_user.kubun_id == '01') {
        repeat_time_check = parseInt(repeat_time_check) + 45;
      } else {
        repeat_time_check = parseInt(repeat_time_check) + 30;
      }

      repeat_time_check = pad(repeat_time_check, 4);
    }

    if (course.kubun_id == '01') {
      var disable_time_2h = [document.getElementById('time\[0\]\[value\]').value];

      for (var i = 1; i <= $('.block-content-1 ').length; i++) {
        disable_time_2h.push(document.getElementById('time\[' + i + '\]\[value\]').value);
      }

      var index = disable_time_2h.indexOf($(this).parent().find('.time_value').val());
      disable_time_2h.splice(index, 1);
    } else if (course.kubun_id == '02') {
      var disable_time_2h = [$('#time1-value').val(), $('#time2-value').val()];

      var _index = disable_time_2h.indexOf($(this).parent().find('.time_value').val());

      disable_time_2h.splice(_index, 1);
    } else if (course.kubun_id == '04') {
      var time_index = $(this).parent().parent().parent().parent().find('.time_index').val();
      var disable_time_2h = [$(this).parent().parent().parent().find('.time_from').val(), $(this).parent().parent().parent().find('.time_to').val()];

      var _index2 = disable_time_2h.indexOf($(this).parent().find('.time_value').val());

      disable_time_2h.splice(_index2, 1);
    }

    if (course.kubun_id == '01' || course.kubun_id == '02' || course.kubun_id == '03') {
      var whitening = JSON.parse($('#whitening').val());
      console.log(whitening.kubun_id);

      if (whitening.kubun_id == '02') {
        console.log($('#whitening-time_value').val());

        if ($('#whitening-time_value').val().length != 1) {
          var whitening_check = $('#whitening-time_value').val().substr(0, 4);
        }
      }
    } // console.log(repeat_time_check);


    console.log(disable_time_2h);
    console.log(time_index);
    var set_time_click = $(this);
    $.ajax({
      url: '/get_time_room',
      type: 'POST',
      data: {
        'gender': $('select[name=gender]').val(),
        'repeat_user': repeat_user,
        'disable_time_2h': disable_time_2h,
        'repeat_time_check': repeat_time_check,
        'time_index': time_index,
        'whitening_check': whitening_check
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

var load_pick_time_room_event = function load_pick_time_room_event() {
  var get_room = $('.js-set-room');
  get_room.off('click');
  get_room.on('click', function () {
    var repeat_user = JSON.parse($('#repeat_user').val());
    var transport = JSON.parse($('#transport').val());
    var repeat_time_check = 0;

    if (transport.kubun_id != '01') {
      var bus_arrive_time_slide = JSON.parse($('#bus_arrive_time_slide').val());
      repeat_time_check = bus_arrive_time_slide.notes;

      if (repeat_user.kubun_id == '01') {
        repeat_time_check = parseInt(repeat_time_check) + 45;
      } else {
        repeat_time_check = parseInt(repeat_time_check) + 30;
      }

      repeat_time_check = pad(repeat_time_check, 4);
    }

    console.log(repeat_time_check);
    var whitening = JSON.parse($('#whitening').val());
    console.log(whitening.kubun_id);

    if (whitening.kubun_id == '02') {
      console.log($('#whitening-time_value').val());

      if ($('#whitening-time_value').val().length != 1) {
        var whitening_check = $('#whitening-time_value').val().substr(0, 4);
      }
    }

    var set_time_click = $(this);
    $.ajax({
      url: $site_url + '/book_room',
      type: 'POST',
      data: {
        'sex': $('select[name=date]').val(),
        'repeat_time_check': repeat_time_check,
        'whitening_check': whitening_check
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

var load_pick_time_wt_event = function load_pick_time_wt_event() {
  var get_room_wt = $('.js-set-room_wt');
  get_room_wt.off('click');
  get_room_wt.on('click', function () {
    // console.log($('#repeat_user').val());
    var repeat_user = JSON.parse($('#repeat_user').val());
    var transport = JSON.parse($('#transport').val());
    var repeat_time_check = 0;

    if (transport.kubun_id != '01') {
      var bus_arrive_time_slide = JSON.parse($('#bus_arrive_time_slide').val());
      repeat_time_check = bus_arrive_time_slide.notes;

      if (repeat_user.kubun_id == '01') {
        repeat_time_check = parseInt(repeat_time_check) + 45;
      } else {
        repeat_time_check = parseInt(repeat_time_check) + 30;
      }

      repeat_time_check = pad(repeat_time_check, 4);
    }

    console.log(repeat_time_check);
    console.log(repeat_user.kubun_id);
    var course = JSON.parse($('#course').val());
    console.log(course.kubun_id);

    if (course.kubun_id == '01') {
      var disable_time_15min = [document.getElementById('time\[0\]\[value\]').value];

      for (var i = 1; i <= $('.block-content-1 ').length; i++) {
        disable_time_15min.push(document.getElementById('time\[' + i + '\]\[value\]').value);
      }
    } else if (course.kubun_id == '02') {
      var disable_time_15min = [$('#time1-value').val(), $('#time2-value').val()];
    } else if (course.kubun_id == '03') {
      var disable_time_15min = [$('#time_room_value').val()];
    }

    console.log(disable_time_15min);
    var set_time_click = $(this);
    $.ajax({
      url: $site_url + '/book_time_room_wt',
      type: 'POST',
      data: {
        'rp_user': repeat_user.kubun_id,
        'repeat_time_check': repeat_time_check,
        'disable_time_15min': disable_time_15min
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

var load_pick_time_pet_event = function load_pick_time_pet_event() {
  var get_room_pet = $('.js-set-room_pet');
  get_room_pet.off('click');
  get_room_pet.on('click', function () {
    var set_time_click = $(this);
    var repeat_user = JSON.parse($('#repeat_user').val());
    var transport = JSON.parse($('#transport').val());
    var repeat_time_check = 0;

    if (transport.kubun_id != '01') {
      var bus_arrive_time_slide = JSON.parse($('#bus_arrive_time_slide').val());
      repeat_time_check = bus_arrive_time_slide.notes;

      if (repeat_user.kubun_id == '01') {
        repeat_time_check = parseInt(repeat_time_check) + 45;
      } else {
        repeat_time_check = parseInt(repeat_time_check) + 30;
      }

      repeat_time_check = pad(repeat_time_check, 4);
    }

    console.log(repeat_time_check);
    $.ajax({
      url: $site_url + '/book_time_room_pet',
      type: 'POST',
      data: {
        'gender': $('select[name=date]').val(),
        'repeat_time_check': repeat_time_check
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

var load_after_ajax = function load_after_ajax() {
  var days_short = ["日", "月", "火", "水", "木", "金", "土"];
  var today = moment();

  if (today.weekday() == 3) {
    today = moment(today).add(2, 'days');
  } else if (today.weekday() == 4) {
    today = moment(today).add(1, 'days');
  }

  var tomorrow = moment(today).add(1, 'days');
  $('#add-time').off('click');
  $('#add-time').on('click', function () {
    var disable_time_2h = [document.getElementById('time\[0\]\[value\]').value];

    for (var i = 1; i <= $('.block-content-1 ').length; i++) {
      disable_time_2h.push(document.getElementById('time\[' + i + '\]\[value\]').value);
    }

    console.log(disable_time_2h);
    var repeat_user = JSON.parse($('#repeat_user').val());
    var transport = JSON.parse($('#transport').val());
    var repeat_time_check = 0;

    if (transport.kubun_id != '01') {
      var bus_arrive_time_slide = JSON.parse($('#bus_arrive_time_slide').val());
      repeat_time_check = bus_arrive_time_slide.notes;

      if (repeat_user.kubun_id == '01') {
        repeat_time_check = parseInt(repeat_time_check) + 45;
      } else {
        repeat_time_check = parseInt(repeat_time_check) + 30;
      }

      repeat_time_check = pad(repeat_time_check, 4);
    }

    var whitening = JSON.parse($('#whitening').val());
    console.log(whitening.kubun_id);

    if (whitening.kubun_id == '02') {
      console.log($('#whitening-time_value').val());

      if ($('#whitening-time_value').val().length != 1) {
        var whitening_check = $('#whitening-time_value').val().substr(0, 4);
      }
    }

    var set_time_click = $(this);
    $.ajax({
      url: '/get_time_room',
      type: 'POST',
      data: {
        'gender': $('select[name=gender]').val(),
        'new': 1,
        'disable_time_2h': disable_time_2h,
        'repeat_time_check': repeat_time_check,
        'whitening_check': whitening_check
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
  $('.collapse-top').off('hide.bs.collapse');
  $('.collapse-top').on('hide.bs.collapse', function () {
    $('#btn-collapse-top').attr("src", "/sunsun/svg/plus.svg");
  });
  $('.collapse-top').off('show.bs.collapse');
  $('.collapse-top').on('show.bs.collapse', function () {
    $('#btn-collapse-top').attr("src", "/sunsun/svg/hide.svg");
  });
  $('.collapse-between').off('hide.bs.collapse');
  $('.collapse-between').on('hide.bs.collapse', function () {
    $('#btn-collapse-between').attr("src", "/sunsun/svg/plus.svg");
  });
  $('.collapse-between').off('show.bs.collapse');
  $('.collapse-between').on('show.bs.collapse', function () {
    $('#btn-collapse-between').attr("src", "/sunsun/svg/hide.svg");
  });
  $('.collapse-finish').off('hide.bs.collapse');
  $('.collapse-finish').on('hide.bs.collapse', function () {
    $('#btn-collapse-finish').attr("src", "/sunsun/svg/plus.svg");
  });
  $('.collapse-finish').off('show.bs.collapse');
  $('.collapse-finish').on('show.bs.collapse', function () {
    $('#btn-collapse-finish').attr("src", "/sunsun/svg/hide.svg");
  });
  $('#date-value').val(today.format('YYYYMMDD'));
  $('#date-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
  $('#range_date_start-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
  $('#range_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('MM') + "月" + tomorrow.format('DD') + "日(" + days_short[tomorrow.weekday()] + ")");
  $('#range_date_start-value').val(today.format('YYYYMMDD'));
  $('#range_date_end-value').val(tomorrow.format('YYYYMMDD'));
  $('#plan_date_start-value').val(today.format('YYYY') + today.format('MM') + today.format('DD'));
  $('#plan_date_end-value').val(tomorrow.format('YYYY') + tomorrow.format('MM') + tomorrow.format('DD'));
  $('#plan_date_start-view').val(today.format('YYYY') + "年" + today.format('MM') + "月" + today.format('DD') + "日(" + days_short[today.weekday()] + ")");
  $('#plan_date_end-view').val(tomorrow.format('YYYY') + "年" + tomorrow.format('MM') + "月" + tomorrow.format('DD') + "日(" + days_short[tomorrow.weekday()] + ")");
};

function get_dates(startDate, stopDate) {
  var dateArray = [];
  var currentDate = moment(new Date(startDate));
  var stopDate = moment(new Date(stopDate));

  while (currentDate <= stopDate) {
    if (moment(currentDate).weekday() != 3 && moment(currentDate).weekday() != 4) {
      dateArray.push(moment(currentDate).format('YYYY-MM-DD'));
    }

    currentDate = moment(currentDate).add(1, 'days');
  }

  return dateArray;
}

var load_once_time = function load_once_time() {
  $('#transport').on('change', function () {
    var transport = JSON.parse($('#transport').val());

    if (transport.kubun_id == '01') {
      $('.bus').hide();
    } else {
      $('.bus').show();
    }
  });
  $('li.dropdown-item').off('click');
  $('li.dropdown-item').on('click', function () {
    $('li.dropdown-item').removeClass('active');
    $(this).addClass('active');
    $('#bus_arrive_time_slide').val($(this).find('.bus_arrive_time_slide').val());
    $("#bus_time_first").text($(this).find(".bus_time_first").text());
    $("#bus_time_second").text($(this).find(".bus_time_second").text());
  });
};

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