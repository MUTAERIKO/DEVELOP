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

/***/ "./resources/js/pagedisplay.js":
/*!*************************************!*\
  !*** ./resources/js/pagedisplay.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($, window) {
  $(function () {
    $('paginateのどこかクラスとか？').submit(function () {
      var scroll_top = $(window).scrollTop(); //送信時の位置情報を取得

      $('input.st', this).prop('value', scroll_top); //隠しフィールドに位置情報を設定
    });
    var params = location.href.split('?');

    if (params.length > 1) {
      $('html,body').animate({
        scrollTop: $('#comment').offset().top
      });
    }
  });
  document.addEventListener('DOMContentLoaded', function () {
    var elem = document.getElementById('modal-1');
    new Modal(elem);
  });
  /**
   * モーダルウィンドウ
   * @property {HTMLElement} modal モーダル要素
   * @property {NodeList} openers モーダルを開く要素
   * @property {NodeList} closers モーダルを閉じる要素
   */

  function Modal(modal) {
    this.modal = modal;
    var id = this.modal.id;
    this.openers = document.querySelectorAll('[data-modal-open="' + id + '"]');
    this.closers = this.modal.querySelectorAll('[data-modal-close]');
    this.handleOpen();
    this.handleClose();
  }
  /**
   * 開くボタンのイベント登録
   */


  Modal.prototype.handleOpen = function () {
    var _this = this;

    if (this.openers.length === 0) {
      return false;
    }

    this.openers.forEach(function (opener) {
      opener.addEventListener('click', _this.open.bind(_this));
    });
  };
  /**
   * 閉じるボタンのイベント登録
   */


  Modal.prototype.handleClose = function () {
    var _this2 = this;

    if (this.closers.length === 0) {
      return false;
    }

    this.closers.forEach(function (closer) {
      closer.addEventListener('click', _this2.close.bind(_this2));
    });
  };
  /**
   * モーダルを開く
   */


  Modal.prototype.open = function () {
    this.modal.classList.add('is-open');
  };
  /**
   * モーダルを閉じる
   */


  Modal.prototype.close = function () {
    this.modal.classList.remove('is-open');
  };
})(jQuery, window);

/***/ }),

/***/ 1:
/*!*******************************************!*\
  !*** multi ./resources/js/pagedisplay.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/develop/resources/js/pagedisplay.js */"./resources/js/pagedisplay.js");


/***/ })

/******/ });