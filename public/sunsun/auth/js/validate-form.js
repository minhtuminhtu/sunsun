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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/sunsun/auth/js/validate-form.js":
/*!**********************************************************!*\
  !*** ./resources/assets/sunsun/auth/js/validate-form.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  $.fn.inputFilter = function (inputFilter) {
    return this.on("keydown keyup", function (event) {
      if (event.key !== 'Backspace' && event.key !== 'undefined') {
        var curchr = this.value.length;
        var curval = $(this).val();
        var phone_format;

        if (curchr < 3 && curval.indexOf("(") <= -1) {
          phone_format = "(" + curval;
        } else if (curchr == 4 && curval.indexOf("(") > -1) {
          phone_format = curval + ")-";
        } else if (curchr == 5) {
          if (event.key != ")") {
            phone_format = this.oldValue + ")-" + event.key;
          } else {
            phone_format = curval;
          }
        } else if (curchr == 6 && curval.indexOf("-") <= -1) {
          if (event.key != "-") {
            phone_format = this.oldValue + '-' + event.key;
          } else {
            phone_format = curval;
          }
        } else if (curchr == 9) {
          phone_format = curval + "-";
          $(this).attr('maxlength', '14');
        } else if (curchr == 10) {
          console.log(event.key);

          if (event.key != "-") {
            phone_format = this.oldValue + '-' + event.key;
          } else {
            phone_format = curval;
          }
        } else {
          phone_format = curval;
        }

        var regex = /^[\+]?[(]?[0-9]{0,3}[)]?[-\s\.]?[0-9]{0,3}[-\s\.]?[0-9]{0,6}$/im;
        var test = regex.test(phone_format);

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

  $('#tel').inputFilter(function (value) {
    return true;
  });
})(jQuery);

/***/ }),

/***/ 5:
/*!****************************************************************!*\
  !*** multi ./resources/assets/sunsun/auth/js/validate-form.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

<<<<<<< HEAD
module.exports = __webpack_require__(/*! C:\Users\minhtu.EQ8VH23ACB52NJV\docker\src\sunsun\resources\assets\sunsun\auth\js\validate-form.js */"./resources/assets/sunsun/auth/js/validate-form.js");
=======
module.exports = __webpack_require__(/*! C:\Users\tranv\docker\src\sunsun\resources\assets\sunsun\auth\js\validate-form.js */"./resources/assets/sunsun/auth/js/validate-form.js");
>>>>>>> master


/***/ })

/******/ });