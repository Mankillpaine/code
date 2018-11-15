webpackJsonp([10,24],{

/***/ 486:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.setUrl = undefined;

	var _vue = __webpack_require__(18);

	var _vue2 = _interopRequireDefault(_vue);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	var RESOURCE = _vue2.default.config.optionMergeStrategies.constant.RESOURCE;

	/**
	 * 设置url
	 * 参数：
	 * 		url(string) - 设置设置相对的url路径
	 * 返回：
	 * 		string，返回包括域名在内的完整域名
	 */
	/**
	 * Created by miaoyu on 2016/12/16 0016.
	 */

	var setUrl = exports.setUrl = function setUrl(url) {
	  return RESOURCE + url;
	};

	// 暴露方法
	exports.default = { setUrl: setUrl };

/***/ },

/***/ 487:
/***/ function(module, exports) {

	"use strict";

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	/**
	 * Created by miaoyu on 2016/12/16 0016.
	 */

	/*
	 * 显示分钟或者小时
	 * 备注：
	 * 		如果参数满足60，单位将会转换为小时 or 分钟
	 * 参数：
	 * 		val(number) - 需要转换的分钟数
	 * 	返回：
	 * 		string，转换后的时间
	 */
	var morh = exports.morh = function morh(val) {
	  if (!val) return 0;

	  if (val > 60) {
	    var yu = val % 60;

	    var reStr = Math.floor(val / 60) + "\u5C0F\u65F6";

	    // 有余数则显示分钟
	    if (yu) reStr += yu + "\u5206\u949F";

	    return reStr;
	  } else {
	    return val + "\u5206\u949F";
	  };
	};

	// 暴露默认方法
	exports.default = { morh: morh };

/***/ },

/***/ 493:
/***/ function(module, exports, __webpack_require__) {

	var __vue_exports__, __vue_options__
	var __vue_styles__ = {}

	/* styles */
	__webpack_require__(494)

	/* script */
	__vue_exports__ = __webpack_require__(496)

	/* template */
	var __vue_template__ = __webpack_require__(497)
	__vue_options__ = __vue_exports__ = __vue_exports__ || {}
	if (
	  typeof __vue_exports__.default === "object" ||
	  typeof __vue_exports__.default === "function"
	) {
	if (Object.keys(__vue_exports__).some(function (key) { return key !== "default" && key !== "__esModule" })) {console.error("named exports are not supported in *.vue files.")}
	__vue_options__ = __vue_exports__ = __vue_exports__.default
	}
	if (typeof __vue_options__ === "function") {
	  __vue_options__ = __vue_options__.options
	}
	__vue_options__.__file = "E:\\www\\pro\\liveManager\\webadmin\\src\\components\\pages.vue"
	__vue_options__.render = __vue_template__.render
	__vue_options__.staticRenderFns = __vue_template__.staticRenderFns
	__vue_options__._scopeId = "data-v-34f00a4f"

	/* hot reload */
	if (false) {(function () {
	  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  module.hot.accept()
	  if (!module.hot.data) {
	    hotAPI.createRecord("data-v-34f00a4f", __vue_options__)
	  } else {
	    hotAPI.reload("data-v-34f00a4f", __vue_options__)
	  }
	})()}
	if (__vue_options__.functional) {console.error("[vue-loader] pages.vue: functional components are not supported and should be defined in plain js files using render functions.")}

	module.exports = __vue_exports__


/***/ },

/***/ 494:
/***/ function(module, exports, __webpack_require__) {

	// style-loader: Adds some css to the DOM by adding a <style> tag

	// load the styles
	var content = __webpack_require__(495);
	if(typeof content === 'string') content = [[module.id, content, '']];
	// add the styles to the DOM
	var update = __webpack_require__(32)(content, {});
	if(content.locals) module.exports = content.locals;
	// Hot Module Replacement
	if(false) {
		// When the styles change, update the <style> tags
		if(!content.locals) {
			module.hot.accept("!!./../../node_modules/.0.26.1@css-loader/index.js!./../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-34f00a4f&scoped=true!./../../node_modules/.2.2.3@less-loader/index.js!./../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./pages.vue", function() {
				var newContent = require("!!./../../node_modules/.0.26.1@css-loader/index.js!./../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-34f00a4f&scoped=true!./../../node_modules/.2.2.3@less-loader/index.js!./../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./pages.vue");
				if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
				update(newContent);
			});
		}
		// When the module is disposed, remove the <style> tags
		module.hot.dispose(function() { update(); });
	}

/***/ },

/***/ 495:
/***/ function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(4)();
	// imports


	// module
	exports.push([module.id, "\n#co-pages[data-v-34f00a4f] {\n  display: table;\n}\n#co-pages .pages-cont[data-v-34f00a4f] {\n  display: table-cell;\n  line-height: 0;\n  vertical-align: middle;\n}\n#co-pages .btn-n-w[data-v-34f00a4f] {\n  transition: transform .6s;\n}\n#co-pages .btn[data-v-34f00a4f] {\n  min-width: 30px;\n  height: 30px;\n  margin: 0 5px;\n  padding: 0 9px;\n  color: #757b81;\n  line-height: 30px;\n  border: 1px solid #eaeaea;\n  border-radius: 4px;\n}\n#co-pages .btn.btn-is[data-v-34f00a4f] {\n  min-width: auto;\n  width: 30px;\n  height: 30px;\n  padding: 0;\n}\n#co-pages .btn.sel[data-v-34f00a4f] {\n  transition: all .6s;\n  color: #fff;\n  background: #05bcd4;\n  border-color: #05bcd4;\n}\n#co-pages .btn.dis[data-v-34f00a4f] {\n  transition: all .6s;\n  color: #fff;\n  background: #aaa;\n  border-color: #aaa;\n  cursor: not-allowed;\n}\n#co-pages .to-page[data-v-34f00a4f] {\n  width: 32px;\n  height: 32px;\n  margin: 0 5px;\n  text-indent: 0;\n  border: 1px solid #eaeaea;\n}\n#co-pages .label-normal[data-v-34f00a4f] {\n  width: 22px;\n  color: #757b81;\n  line-height: 32px;\n}\n#co-pages .label-explain[data-v-34f00a4f] {\n  color: #aaa;\n  line-height: 32px;\n}\n", ""]);

	// exports


/***/ },

/***/ 496:
/***/ function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
		value: true
	});

	var _watch;

	function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//

	var ele = void 0,
	    container = void 0,
	    btnW = void 0,
	    maxDistance = void 0;

	// vm对象
	var vm = {
		props: {
			// 当前的页码，1代表第一位
			index: {
				type: Number,
				default: 1
			},
			// 翻页的条数
			limit: {
				type: Number,
				default: 20
			},
			// 总条数，这值必须大于1传入
			total: {
				type: Number,
				required: true
			},
			// 初始显示的页面按钮数
			initPage: {
				type: Number,
				default: 5
			}
		},
		watch: (_watch = {}, _defineProperty(_watch, 'index', function index(curr) {
			this.currIndex = curr - 1;
		}), _defineProperty(_watch, 'total', function total(curr) {
			var initPage = this.initPage,
			    allPageS = this.allPageS;


			var elDistance = initPage < allPageS ? btnW * initPage : btnW * allPageS;

			// 设置按钮容器宽度
			ele.style.width = elDistance + 'px';
			container.style.width = btnW * allPageS + 'px';
		}), _watch),
		data: function data() {
			return {
				// 当前页码
				currIndex: this.index - 1,
				// 选择页码
				selIndex: null
			};
		},

		methods: {
			// 选择页面
			selPage: function selPage(val, key) {
				// 如果当前点击的页面不是等于已经被点击了就可以执行
				if (this.currIndex !== key) {
					// this.currIndex = key;
					this.$emit('switchPage', key + 1);
				};
			},

			// 上一页
			prePage: function prePage() {
				var currIndex = this.currIndex;

				// 当前的页面必须大于0才能翻到上一页

				if (currIndex > 0) {
					--currIndex;

					this.currIndex = currIndex;
					this.$emit('switchPage', currIndex + 1);
				};
			},

			// 下一页
			nextPage: function nextPage() {
				var currIndex = this.currIndex,
				    allPageS = this.allPageS;

				// 当前的页面必须小于总页数才能翻到下一页

				if (currIndex < allPageS - 1) {
					++currIndex;

					this.currIndex = currIndex;
					this.$emit('switchPage', currIndex + 1);
				};
			},

			// 跳转分页
			jumpPage: function jumpPage() {
				var selIndex = this.selIndex,
				    allPageS = this.allPageS,
				    patt = /^[0-9]+$/;


				var index = void 0;

				// 验证通过可以跳转
				if (patt.test(selIndex)) {
					index = selIndex - 1;

					if (index >= allPageS) index = allPageS - 1;
					if (index < 0) index = 0;

					this.currIndex = index;
					this.$emit('switchPage', index + 1);
				};
			}
		},
		computed: {
			// 总页数
			allPageS: function allPageS() {
				return Math.ceil((this.total || 10) / this.limit);
			},

			// 其他控件是否显示
			outerShow: function outerShow() {
				return this.allPageS > 5;
			}
		},
		directives: {
			// 滑动按钮框
			slideBtn: {
				inserted: function inserted(el) {
					var _ref = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : binding,
					    _ref$value = _ref.value,
					    initPage = _ref$value.initPage,
					    allPageS = _ref$value.allPageS;

					ele = el, container = el.querySelector('.btn-n-w');
					btnW = container.querySelector('.btn').offsetWidth + 10;
					maxDistance = initPage < allPageS ? (allPageS - initPage) * -btnW : 0;

					// let elDistance = initPage < allPageS ? btnW * initPage : btnW * allPageS;

					// // 设置按钮容器宽度
					// el.style.width = `${elDistance}px`;
					// container.style.width = `${btnW * allPageS}px`;
				},
				update: function update(el) {
					var _ref2 = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : binding,
					    currIndex = _ref2.value.currIndex;

					var currDistance = currIndex * -btnW;

					// 如果当前距离大于最远距离的话，当前距离就等于最远距离
					if (currDistance < maxDistance) currDistance = maxDistance;

					// 执行动画推移
					container.style['-webkit-transform'] = 'translate3d(' + currDistance + 'px,0,0)';
					container.style['-moz-transform'] = 'translate3d(' + currDistance + 'px,0,0)';
					container.style['-ms-transform'] = 'translate3d(' + currDistance + 'px,0,0)';
					container.style['-o-transform'] = 'translate3d(' + currDistance + 'px,0,0)';
					container.style['transform'] = 'translate3d(' + currDistance + 'px,0,0)';
				}
			}
		}
	};

	// 暴露组件配置
	exports.default = Object.assign({ name: 'co-pages' }, vm);

/***/ },

/***/ 497:
/***/ function(module, exports, __webpack_require__) {

	module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('div', {
	    staticClass: "wh-100",
	    attrs: {
	      "id": "co-pages"
	    }
	  }, [_c('div', {
	    staticClass: "pages-cont text-center"
	  }, [_c('div', {
	    staticClass: "pages-main di"
	  }, [(_vm.outerShow) ? _c('span', {
	    staticClass: "btn db font-14 fl",
	    class: {
	      'dis': _vm.currIndex === 0
	    },
	    on: {
	      "click": _vm.prePage
	    }
	  }, [_vm._v("上一页")]) : _vm._e(), _vm._v(" "), _c('div', {
	    directives: [{
	      name: "slide-btn",
	      rawName: "v-slide-btn",
	      value: ({
	        initPage: _vm.initPage,
	        allPageS: _vm.allPageS,
	        currIndex: _vm.currIndex
	      }),
	      expression: "{initPage: initPage, allPageS: allPageS, currIndex: currIndex}"
	    }],
	    staticClass: "btn-w fl hidden"
	  }, [_c('div', {
	    staticClass: "btn-n-w clear rel"
	  }, _vm._l((_vm.allPageS), function(val, key) {
	    return _c('span', {
	      staticClass: "btn btn-is db font-14 fl",
	      class: {
	        'sel': _vm.currIndex === key
	      },
	      on: {
	        "click": function($event) {
	          _vm.selPage(val, key)
	        }
	      }
	    }, [_vm._v(_vm._s(val))])
	  }))]), _vm._v(" "), (_vm.outerShow && _vm.currIndex < _vm.allPageS - 5) ? _c('span', {
	    staticClass: "label-normal db fl"
	  }, [_vm._v("···")]) : _vm._e(), _vm._v(" "), (_vm.outerShow) ? _c('span', {
	    staticClass: "btn db font-14 fl",
	    class: {
	      'dis': _vm.currIndex === _vm.allPageS - 1
	    },
	    on: {
	      "click": _vm.nextPage
	    }
	  }, [_vm._v("下一页")]) : _vm._e(), _vm._v(" "), (_vm.outerShow) ? _c('span', {
	    staticClass: "label-explain db fl"
	  }, [_vm._v("共" + _vm._s(_vm.allPageS) + "页，到第")]) : _vm._e(), _vm._v(" "), (_vm.outerShow) ? _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model.trim.number",
	      value: (_vm.selIndex),
	      expression: "selIndex",
	      modifiers: {
	        "trim": true,
	        "number": true
	      }
	    }],
	    staticClass: "to-page font-14 text-center db fl",
	    attrs: {
	      "type": "text"
	    },
	    domProps: {
	      "value": _vm._s(_vm.selIndex)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.selIndex = _vm._n($event.target.value.trim())
	      },
	      "blur": function($event) {
	        _vm.$forceUpdate()
	      }
	    }
	  }) : _vm._e(), _vm._v(" "), (_vm.outerShow) ? _c('span', {
	    staticClass: "label-explain db fl"
	  }, [_vm._v("页")]) : _vm._e(), _vm._v(" "), (_vm.outerShow) ? _c('span', {
	    staticClass: "btn db font-14 fl",
	    on: {
	      "click": _vm.jumpPage
	    }
	  }, [_vm._v("确定")]) : _vm._e()])])])
	},staticRenderFns: []}
	module.exports.render._withStripped = true
	if (false) {
	  module.hot.accept()
	  if (module.hot.data) {
	     require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-34f00a4f", module.exports)
	  }
	}

/***/ },

/***/ 546:
/***/ function(module, exports, __webpack_require__) {

	var __vue_exports__, __vue_options__
	var __vue_styles__ = {}

	/* styles */
	__webpack_require__(547)

	/* script */
	__vue_exports__ = __webpack_require__(549)

	/* template */
	var __vue_template__ = __webpack_require__(550)
	__vue_options__ = __vue_exports__ = __vue_exports__ || {}
	if (
	  typeof __vue_exports__.default === "object" ||
	  typeof __vue_exports__.default === "function"
	) {
	if (Object.keys(__vue_exports__).some(function (key) { return key !== "default" && key !== "__esModule" })) {console.error("named exports are not supported in *.vue files.")}
	__vue_options__ = __vue_exports__ = __vue_exports__.default
	}
	if (typeof __vue_options__ === "function") {
	  __vue_options__ = __vue_options__.options
	}
	__vue_options__.__file = "E:\\www\\pro\\liveManager\\webadmin\\src\\view\\live\\view\\currtlanchor.page.vue"
	__vue_options__.render = __vue_template__.render
	__vue_options__.staticRenderFns = __vue_template__.staticRenderFns
	__vue_options__._scopeId = "data-v-45079651"

	/* hot reload */
	if (false) {(function () {
	  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  module.hot.accept()
	  if (!module.hot.data) {
	    hotAPI.createRecord("data-v-45079651", __vue_options__)
	  } else {
	    hotAPI.reload("data-v-45079651", __vue_options__)
	  }
	})()}
	if (__vue_options__.functional) {console.error("[vue-loader] currtlanchor.page.vue: functional components are not supported and should be defined in plain js files using render functions.")}

	module.exports = __vue_exports__


/***/ },

/***/ 547:
/***/ function(module, exports, __webpack_require__) {

	// style-loader: Adds some css to the DOM by adding a <style> tag

	// load the styles
	var content = __webpack_require__(548);
	if(typeof content === 'string') content = [[module.id, content, '']];
	// add the styles to the DOM
	var update = __webpack_require__(32)(content, {});
	if(content.locals) module.exports = content.locals;
	// Hot Module Replacement
	if(false) {
		// When the styles change, update the <style> tags
		if(!content.locals) {
			module.hot.accept("!!./../../../../node_modules/.0.26.1@css-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-45079651&scoped=true!./../../../../node_modules/.2.2.3@less-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./currtlanchor.page.vue", function() {
				var newContent = require("!!./../../../../node_modules/.0.26.1@css-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-45079651&scoped=true!./../../../../node_modules/.2.2.3@less-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./currtlanchor.page.vue");
				if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
				update(newContent);
			});
		}
		// When the module is disposed, remove the <style> tags
		module.hot.dispose(function() { update(); });
	}

/***/ },

/***/ 548:
/***/ function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(4)();
	// imports


	// module
	exports.push([module.id, "\n#p-currtlanchor[data-v-45079651] {\n  /*头部样式*/\n  /*内部样式*/\n}\n#p-currtlanchor .curr-header[data-v-45079651] {\n  height: 50px;\n  background: #fff;\n  /*今日总览刷新*/\n}\n#p-currtlanchor .curr-header .title[data-v-45079651] {\n  margin-left: 20px;\n  line-height: 50px;\n}\n#p-currtlanchor .curr-header .autoref[data-v-45079651] {\n  margin-top: 19px;\n  margin-right: 20px;\n  color: #757b81;\n  1line-height: 14px;\n}\n#p-currtlanchor .curr-header .autoref .ico[data-v-45079651] {\n  animation: refrotate 3s linear infinite;\n}\n@keyframes refrotate {\n0% {\n    transform: rotate(0deg);\n}\n50% {\n    transform: rotate(180deg);\n}\n100% {\n    transform: rotate(360deg);\n}\n}\n#p-currtlanchor .curr-main[data-v-45079651] {\n  margin: 20px;\n  background: #fff;\n}\n#p-currtlanchor .table-tr[data-v-45079651] {\n  height: 78px;\n  border-bottom: 1px solid #eaeaea;\n}\n#p-currtlanchor .table-tr[data-v-45079651]:hover {\n  transition: all .2s;\n  border-bottom-color: #fff;\n  box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.3);\n}\n#p-currtlanchor .table-th[data-v-45079651]:nth-child(1),\n#p-currtlanchor .table-td[data-v-45079651]:nth-child(1) {\n  width: 36%;\n}\n#p-currtlanchor .table-th[data-v-45079651]:nth-child(2),\n#p-currtlanchor .table-td[data-v-45079651]:nth-child(2) {\n  width: 19%;\n}\n#p-currtlanchor .table-th[data-v-45079651]:nth-child(3),\n#p-currtlanchor .table-td[data-v-45079651]:nth-child(3) {\n  width: 20%;\n}\n#p-currtlanchor .table-th[data-v-45079651]:nth-child(4),\n#p-currtlanchor .table-td[data-v-45079651]:nth-child(4) {\n  width: 10%;\n}\n#p-currtlanchor .table-th[data-v-45079651]:nth-child(5),\n#p-currtlanchor .table-td[data-v-45079651]:nth-child(5) {\n  width: 15%;\n}\n#p-currtlanchor .table-th[data-v-45079651] {\n  height: 56px;\n  line-height: 56px;\n  border-bottom: 2px solid #eaeaea;\n}\n#p-currtlanchor .table-td[data-v-45079651] {\n  line-height: 78px;\n}\n#p-currtlanchor .table-td img[data-v-45079651] {\n  width: 52px;\n  height: 52px;\n  color: #333c44;\n  margin-top: 12px;\n  margin-left: 20px;\n}\n#p-currtlanchor .table-td .username[data-v-45079651] {\n  margin-left: 93px;\n}\n#p-currtlanchor .table-td .game[data-v-45079651] {\n  height: 27px;\n  margin-top: 11px;\n  line-height: 27px;\n}\n#p-currtlanchor .table-td .rmb[data-v-45079651] {\n  height: 25px;\n  color: #aaa;\n  line-height: 25px;\n}\n#p-currtlanchor .table-footer[data-v-45079651] {\n  height: 72px;\n}\n", ""]);

	// exports


/***/ },

/***/ 549:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _pages = __webpack_require__(493);

	var _pages2 = _interopRequireDefault(_pages);

	var _container = __webpack_require__(80);

	var _container2 = _interopRequireDefault(_container);

	var _morhFilter = __webpack_require__(487);

	var _seturlService = __webpack_require__(486);

	var _dateFilter = __webpack_require__(39);

	var _pageloadingService = __webpack_require__(47);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; } //
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//

	var InterId = void 0;

	// 请求当前上播时长最高主播
	var postMaxLivetime = function postMaxLivetime(API, vm) {
	    var query = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
	    var cb = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : function () {};


	    query = Object.assign(query, {
	        startTime: (0, _dateFilter.dateNumFilter)(Date.parse(new Date()), 'yyyy-MM-dd hh:mm:ss')
	    });

	    // 发起请求
	    vm.$http.post(API, query).then(function (_ref) {
	        var _ref$body$data = _ref.body.data,
	            pageNum = _ref$body$data.pageNum,
	            data = _ref$body$data.data;

	        cb(pageNum, data);

	        // 关闭加载层
	        (0, _pageloadingService.closePgloading)();
	    }, function (_ref2) {
	        var msg = _ref2.body.msg;
	        return console.log(msg);
	    });
	};

	/********** vm对象配置 *********/
	// 绑定数据集合
	var data = function data() {
	    return {
	        index: 1, //—— 当前的页码
	        limit: 10, //—— 翻页的条数
	        total: 10, //—— 总条数
	        refTime: 90, //—— 定时刷新时长
	        maxLive: [] //—— 当前上播时长最高主播数据
	    };
	};

	// 监听数据集合
	var watch = _defineProperty({}, 'refTime', function refTime(curr) {
	    var vm = this;

	    // 重新启动时间倒计时器
	    if (curr === 90) vm.openRefTime();

	    // 异步调用新数据
	    if (curr === 0) {
	        var API_MAXLIVE = vm.$store.state.api.todayall.maxLive;

	        vm.closeRefTime();
	        vm.index = 1;

	        // 打开遮罩层
	        (0, _pageloadingService.openPgloading)();

	        postMaxLivetime(API_MAXLIVE, vm, {
	            total: vm.limit,
	            page: vm.index
	        }, function (pageNum, data) {
	            vm.total = vm.limit * pageNum;
	            vm.maxLive = data;
	            vm.refTime = 90;
	        });
	    };
	});

	// 计算属性集合
	var computed = {
	    // 备用的头像url
	    spareUrl: function spareUrl() {
	        return (0, _seturlService.setUrl)('/webadmin/static/images/anchor-default-img.png');
	    }
	};

	// 方法集合
	var methods = {
	    // 开启时长刷新器
	    openRefTime: function openRefTime() {
	        var vm = this;

	        InterId = setInterval(function () {
	            vm.refTime = --vm.refTime;
	        }, 1000);
	    },

	    // 关闭时长刷新器
	    closeRefTime: function closeRefTime() {
	        clearInterval(InterId);
	    },

	    // 切换分页
	    switchPage: function switchPage(index) {
	        var vm = this,
	            API_MAXLIVE = vm.$store.state.api.todayall.maxLive;

	        // 打开遮罩层
	        (0, _pageloadingService.openPgloading)();

	        // 请求数据
	        postMaxLivetime(API_MAXLIVE, vm, {
	            total: vm.limit,
	            page: index
	        }, function (pageNum, data) {
	            vm.index = index;
	            vm.maxLive = data;
	        });
	    }
	};

	// 过滤器集合
	var filters = {
	    // 分或小时
	    morh: _morhFilter.morh
	};

	// 组件集合
	var components = {
	    coPages: _pages2.default,
	    coContainer: _container2.default
	};

	// 组件创建完成后的钩子
	// 这里获取到页面渲染所需的数据
	var created = function created() {
	    var vm = this,
	        API_MAXLIVE = vm.$store.state.api.todayall.maxLive;

	    postMaxLivetime(API_MAXLIVE, vm, {
	        total: vm.limit,
	        page: vm.index
	    }, function (pageNum, data) {
	        vm.total = vm.limit * pageNum;
	        vm.maxLive = data;
	        vm.openRefTime();
	    });
	};

	// vm对象
	var vm = {
	    name: 'p-currtlanchor',
	    data: data,
	    watch: watch,
	    computed: computed,
	    components: components,
	    filters: filters,
	    methods: methods,
	    created: created
	};

	// 暴露组件配置
	exports.default = vm;

/***/ },

/***/ 550:
/***/ function(module, exports, __webpack_require__) {

	module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('div', {
	    attrs: {
	      "id": "p-currtlanchor"
	    }
	  }, [_c('header', {
	    staticClass: "curr-header"
	  }, [_c('span', {
	    staticClass: "title h-100 font-18 font-bold fl"
	  }, [_vm._v("今日上播时长最高主播")]), _vm._v(" "), _c('div', {
	    staticClass: "autoref font-14 fr"
	  }, [_c('span', [_vm._v(_vm._s(_vm.refTime) + "秒后刷新数据")]), _vm._v(" "), _c('span', {
	    staticClass: "ico icon-refresh"
	  })])]), _vm._v(" "), _c('section', {
	    staticClass: "curr-main"
	  }, [_vm._m(0), _vm._v(" "), _c('co-container', {
	    attrs: {
	      "isShow": _vm.maxLive.length === 0,
	      "h": "300px"
	    }
	  }, [_c('ul', {
	    staticClass: "table-tbody"
	  }, _vm._l((_vm.maxLive), function(item) {
	    return _c('router-link', {
	      staticClass: "table-tr c-pointer clear",
	      attrs: {
	        "to": '/admin/ahdetail/' + item.platform + '/' + item.platformid,
	        "tag": "li"
	      }
	    }, [_c('div', {
	      staticClass: "table-td h-100 font-16 fl"
	    }, [_c('img', {
	      staticClass: "userimg arc fl",
	      attrs: {
	        "src": item.avatar || _vm.spareUrl,
	        "alt": item.remark || item.nickname
	      }
	    }), _vm._v(" "), _c('div', {
	      staticClass: "username h-100 text-hidden"
	    }, [_vm._v(_vm._s(item.remark || item.nickname))])]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v("+" + _vm._s(_vm._f("morh")(item.workTime)))]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v(_vm._s(item.platname))]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v(_vm._s(item.levename))]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v(_vm._s(item.agentname || '-'))])])
	  }))]), _vm._v(" "), _c('div', {
	    staticClass: "table-footer"
	  }, [_c('co-pages', {
	    attrs: {
	      "index": _vm.index,
	      "limit": _vm.limit,
	      "total": _vm.total
	    },
	    on: {
	      "switchPage": _vm.switchPage
	    }
	  })], 1)], 1)])
	},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('div', {
	    staticClass: "table-thead clear"
	  }, [_c('div', {
	    staticClass: "table-th font-16 font-bold text-center fl"
	  }, [_vm._v("主播")]), _vm._v(" "), _c('div', {
	    staticClass: "table-th font-16 font-bold text-center fl"
	  }, [_vm._v("时长")]), _vm._v(" "), _c('div', {
	    staticClass: "table-th font-16 font-bold text-center fl"
	  }, [_vm._v("平台")]), _vm._v(" "), _c('div', {
	    staticClass: "table-th font-16 font-bold text-center fl"
	  }, [_vm._v("等级")]), _vm._v(" "), _c('div', {
	    staticClass: "table-th font-16 font-bold text-center fl"
	  }, [_vm._v("经纪人")])])
	}]}
	module.exports.render._withStripped = true
	if (false) {
	  module.hot.accept()
	  if (module.hot.data) {
	     require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-45079651", module.exports)
	  }
	}

/***/ }

});