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
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/sunsun/admin/js/day.js":
/*!*************************************************!*\
  !*** ./resources/assets/sunsun/admin/js/day.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var main_head__top = $('.main-head__top'),
      current_day = $('.current-date'),
      date_day = current_day.datepicker({
    language: 'ja',
    dateFormat: 'yyyy/mm/dd',
    autoclose: true,
    onSelect: function onSelect() {
      var mon = $(this).datepicker('getDate');
      mon.setDate(mon.getDate() + 1 - (mon.getDay() || 7));
      var sun = new Date(mon.getTime());
      sun.setDate(sun.getDate() + 6);
    }
  });
  current_day.on('input change', 'input', function (e) {
    var date = $(this).val().split('/').join('');
    window.location.href = $curent_url + "?date=" + date;
  });

  if (current_day.find('input').val() === '') {
    date_day.datepicker("setDate", new Date());
    current_day.find('input').trigger("input");
  }

  main_head__top.on('click', '.prev-date', function (e) {
    var date = date_day.datepicker('getDate');
    date.setTime(date.getTime() - 1000 * 60 * 60 * 24);
    date_day.datepicker("setDate", date);
    current_day.find('input').trigger("input");
  });
  main_head__top.on('click', '.next-date', function (e) {
    var date = date_day.datepicker('getDate');
    date.setTime(date.getTime() + 1000 * 60 * 60 * 24);
    date_day.datepicker("setDate", date);
    current_day.find('input').trigger("input");
  });
  var booking_edit = $('#edit_booking');

  var show_booking = function show_booking(booking_id) {
    $.ajax({
      url: '/admin/edit_booking',
      type: 'POST',
      data: {
        'new': 0,
        'booking_id': booking_id
      },
      dataType: 'text',
      beforeSend: function beforeSend() {
        loader.css({
          'display': 'block'
        });
      },
      success: function success(html) {
        booking_edit.find('.mail-booking').html(html);
        booking_edit.modal('show');
      },
      complete: function complete() {
        loader.css({
          'display': 'none'
        });
      }
    });
  };

  $('.main-col__data').not(".bg-free").off('click');
  $('.main-col__data').not(".bg-free").on('click', function (e) {
    var booking_id = $(this).find('.booking-id').val();
    show_booking(booking_id);
  });
  $('.main-col__pet').not(".space-white").not(".head").off('click');
  $('.main-col__pet').not(".space-white").not(".head").on('click', function (e) {
    var booking_id = $(this).find('.booking-id').val();
    show_booking(booking_id);
  });
  $('.main-col__wt').not(".not-wt").not(".head").off('click');
  $('.main-col__wt').not(".not-wt").not(".head").on('click', function (e) {
    var booking_id = $(this).find('.booking-id').val();
    show_booking(booking_id);
  });
  $('#edit_booking').on('click', '.btn-cancel', function (e) {
    $('#edit_booking').modal('hide');
  });
  $('#edit_booking').on('click', '.btn-update', function (e) {
    e.preventDefault();
    $.ajax({
      url: $site_url + '/admin/update_booking',
      type: 'POST',
      data: $('form.booking').serializeArray(),
      dataType: 'JSON',
      beforeSend: function beforeSend() {
        loader.css({
          'display': 'block'
        });
      },
      success: function success(r) {
        $('#edit_booking').modal('hide');
        window.location.reload();
      },
      error: function error() {
        alert("error!");
      },
      complete: function complete() {
        loader.css({
          'display': 'none'
        });
      }
    });
  }); // $('#edit_booking').on('click','.show_history',function (e) {
  //     e.preventDefault();
  //     let current_booking_id = $('#edit_booking').find("#booking_id").val();
  //     let show_history = $('#history_modal');
  //     $.ajax({
  //         url: $site_url +'/admin/show_history',
  //         type: 'POST',
  //         data: {
  //             'booking_id' : current_booking_id
  //         },
  //         dataType: 'text',
  //         beforeSend: function () {
  //             loader.css({'display': 'block'});
  //         },
  //         success: function (html) {
  //             $('#modal_second').find('.modal_second-body').html(html);
  //             $('#modal_second').modal('show'); 
  //         },
  //         complete: function () {
  //             loader.css({'display': 'none'});
  //         },
  //     });
  // })

  $('#edit_booking').on('change', '#course_history', function (e) {
    var current_booking_id = $('#edit_booking').find("#booking_id").val();
    var course_history = $("#course_history").val();

    if (course_history != 0) {
      $.ajax({
        url: $site_url + '/admin/booking_history',
        type: 'POST',
        data: {
          'new': 0,
          'current_booking_id': current_booking_id,
          'course_history': course_history
        },
        dataType: 'text',
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(html) {
          booking_edit.find('.mail-booking').html(html);
          booking_edit.modal('show');
        },
        // error: function () {
        //     // alert("error!");
        // },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    }

    e.preventDefault();
  });
  $('#edit_booking').on('click', '#credit-card', function (e) {
    return false;
  });
});

/***/ }),

/***/ 9:
/*!*******************************************************!*\
  !*** multi ./resources/assets/sunsun/admin/js/day.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\minhtu.EQ8VH23ACB52NJV\docker\src\sunsun\resources\assets\sunsun\admin\js\day.js */"./resources/assets/sunsun/admin/js/day.js");


/***/ })

/******/ });