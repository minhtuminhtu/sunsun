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

/***/ "./resources/assets/sunsun/admin/js/setting.js":
/*!*****************************************************!*\
  !*** ./resources/assets/sunsun/admin/js/setting.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var get_setting_kubun_type = function get_setting_kubun_type() {
    $('#new').click(function () {
      var kubun_type = $('#setting-type').val(); // AJAX request

      $.ajax({
        url: '/admin/get_setting_kubun_type',
        type: 'post',
        data: {
          "new": 1,
          kubun_type: kubun_type
        },
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(response) {
          // Add response in Modal body
          $('.modal-body').html(response); // Display Modal

          $('#setting_update').modal('show');
          load_modal_function();
        },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    });
    $('#check_all').on('change', function () {
      if ($(this).prop('checked')) {
        $('.checkbox').prop('checked', true);
        $('.update-edit').show();
      } else {
        $('.checkbox').prop('checked', false);
        $('.update-edit').hide();
      }
    });
    $('.checkbox').on('change', function () {
      if ($('.checkbox').filter(':checked').length > 0) {
        $('.update-edit').show();
      } else {
        $('.update-edit').hide();
      }

      if ($('.checkbox').filter(':checked').length == $('.checkbox').length) {
        $('#check_all').prop('checked', true);
      } else {
        $('#check_all').prop('checked', false);
      }
    });
    $('.kubun_value').click(function () {
      var parent = $(this).parent().parent();
      var kubun_id = parent.find('.kubun_id').text();
      var kubun_type = $('#setting-type').val();
      $.ajax({
        url: '/admin/get_setting_kubun_type',
        type: 'post',
        data: {
          "new": 0,
          kubun_id: kubun_id,
          kubun_type: kubun_type
        },
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(response) {
          // Add response in Modal body
          $('.modal-body').html(response); // Display Modal

          $('#setting_update').modal('show');
          load_modal_function();
        },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    });
    $('#btn-update').click(function () {
      var kubun_id = $('.checkbox').filter(':checked').first().val();
      var kubun_type = $('#setting-type').val();
      $.ajax({
        url: '/admin/get_setting_kubun_type',
        type: 'post',
        data: {
          "new": 0,
          kubun_id: kubun_id,
          kubun_type: kubun_type
        },
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(response) {
          // Add response in Modal body
          $('.modal-body').html(response); // Display Modal

          $('#setting_update').modal('show');
          load_modal_function();
        },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    });
    $('#btn-delete').click(function () {
      var string_delete = "";
      var arr_delete = [];
      $('.checkbox').filter(':checked').each(function (index) {
        string_delete += "\n" + $(this).val() + " - " + $(this).parent().parent().find('.kubun_value').text();
        arr_delete.push($(this).val());
      });
      var r = confirm("Are you sure to delete this item?" + string_delete);

      if (r == true) {
        var kubun_type = $('#setting-type').val();
        $.ajax({
          url: '/admin/delete_setting_kubun_type',
          type: 'delete',
          data: {
            arr_delete: arr_delete,
            kubun_type: kubun_type
          },
          beforeSend: function beforeSend() {
            loader.css({
              'display': 'block'
            });
          },
          success: function success(response) {
            get_setting_type($('#setting-type').val());
          },
          complete: function complete() {
            loader.css({
              'display': 'none'
            });
          }
        });
      }
    });
    $('.btn-up').click(function () {
      var sort_no = $(this).parent().parent().find('.sort_no').text();
      $.ajax({
        url: '/admin/update_setting_sort_no',
        type: 'post',
        data: {
          type: 'up',
          sort_no: sort_no
        },
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(response) {
          get_setting_type($('#setting-type').val());
        },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    });
    $('.btn-down').click(function () {
      var sort_no = $(this).parent().parent().find('.sort_no').text();
      $.ajax({
        url: '/admin/update_setting_sort_no',
        type: 'post',
        data: {
          type: 'down',
          sort_no: sort_no
        },
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(response) {
          get_setting_type($('#setting-type').val());
        },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    });
  };

  var load_modal_function = function load_modal_function() {
    $('.btn-cancel').click(function () {
      $('#setting_update').modal('hide');
    });
    $('.btn-save').click(function () {
      var kubun_type = $('#setting-type').val();
      var kubun_id = $('#kubun_id').val();
      var kubun_value = $('#kubun_value').val();
      var sort_no = $('.kubun_value').length + 1;
      var new_check = $('#new_check').val();
      $.ajax({
        url: '/admin/update_setting_kubun_type',
        type: 'post',
        data: {
          "new": new_check,
          kubun_id: kubun_id,
          kubun_value: kubun_value,
          kubun_type: kubun_type,
          sort_no: sort_no
        },
        beforeSend: function beforeSend() {
          loader.css({
            'display': 'block'
          });
        },
        success: function success(response) {
          $('#setting_update').modal('hide');
          get_setting_type($('#setting-type').val());
        },
        error: function error(response) {
          var err = JSON.parse(response.responseText);
          $('.setting-validate').text(err.msg);
        },
        complete: function complete() {
          loader.css({
            'display': 'none'
          });
        }
      });
    });
  };

  var get_setting_type = function get_setting_type() {
    var kubun_type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    $('#setting-head').text($('#setting-type').val() + " | " + $('#setting-type option:selected').text());

    if (kubun_type == null) {
      kubun_type = $('#setting-type').val();
    }

    $.ajax({
      url: '/admin/get_setting_type',
      type: 'post',
      data: {
        kubun_type: kubun_type
      },
      beforeSend: function beforeSend() {
        loader.css({
          'display': 'block'
        });
      },
      success: function success(response) {
        $('.setting-right').html(response);
        get_setting_kubun_type();
      },
      complete: function complete() {
        loader.css({
          'display': 'none'
        });
      }
    });
  };

  $('#setting-type').on('change', function () {
    get_setting_type();
  });
  get_setting_type();
});

/***/ }),

/***/ 3:
/*!***********************************************************!*\
  !*** multi ./resources/assets/sunsun/admin/js/setting.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\minhtu.EQ8VH23ACB52NJV\docker\src\sunsun\resources\assets\sunsun\admin\js\setting.js */"./resources/assets/sunsun/admin/js/setting.js");


/***/ })

/******/ });