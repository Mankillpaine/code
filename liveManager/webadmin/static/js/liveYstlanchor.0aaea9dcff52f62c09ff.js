webpackJsonp([11,24],{

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

/***/ 518:
/***/ function(module, exports, __webpack_require__) {

	var __vue_exports__, __vue_options__
	var __vue_styles__ = {}

	/* script */
	__vue_exports__ = __webpack_require__(519)

	/* template */
	var __vue_template__ = __webpack_require__(524)
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
	__vue_options__.__file = "E:\\www\\pro\\liveManager\\webadmin\\src\\components\\seldate.vue"
	__vue_options__.render = __vue_template__.render
	__vue_options__.staticRenderFns = __vue_template__.staticRenderFns

	/* hot reload */
	if (false) {(function () {
	  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  module.hot.accept()
	  if (!module.hot.data) {
	    hotAPI.createRecord("data-v-f6d9d25a", __vue_options__)
	  } else {
	    hotAPI.reload("data-v-f6d9d25a", __vue_options__)
	  }
	})()}
	if (__vue_options__.functional) {console.error("[vue-loader] seldate.vue: functional components are not supported and should be defined in plain js files using render functions.")}

	module.exports = __vue_exports__


/***/ },

/***/ 519:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	__webpack_require__(520);

	var _flatpickr = __webpack_require__(522);

	var _flatpickr2 = _interopRequireDefault(_flatpickr);

	var _zh = __webpack_require__(523);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	var dateCont = void 0;

	/**
	 * <seldate></seldate> —— 日期选择组件
	 * prop: 
	 *     placeholder(String) - input没有内容时展示的信息，默认为：请选择日期
	 *     options(Object) - flatpickr插件的配置信息，详见：https://chmln.github.io/flatpickr/
	 * 备注：
	 *     1、该组件依赖插件：flatpickr，可以使用npm install flatpickr --save 来安装该插件
	 *     2、该组件UI依赖 miaoyu.reset.less、miaoyu.class.less 样式文件
	 */
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

	exports.default = {
	    name: 'co-seldate',
	    props: {
	        // 默认显示的内容
	        placeholder: {
	            type: String,
	            default: '请选择日期'
	        },
	        // flatpickr插件的配置信息，详见：https://chmln.github.io/flatpickr/
	        options: {
	            type: Object,
	            default: function _default() {
	                return {};
	            }
	        }
	    },
	    methods: {
	        // 触发了input事件
	        updateInput: function updateInput(_ref) {
	            var value = _ref.target.value;

	            this.$emit('updateDate', value);
	        }
	    },
	    directives: {
	        myflatpickr: {
	            // 生成实例
	            inserted: function inserted(el, _ref2) {
	                var value = _ref2.value;
	                return dateCont = new _flatpickr2.default(el, Object.assign({ locale: _zh.zh }, value));
	            },
	            // 释放索引
	            unbind: function unbind() {
	                return dateCont = null;
	            }
	        }
	    }
	};

/***/ },

/***/ 520:
/***/ function(module, exports, __webpack_require__) {

	// style-loader: Adds some css to the DOM by adding a <style> tag

	// load the styles
	var content = __webpack_require__(521);
	if(typeof content === 'string') content = [[module.id, content, '']];
	// add the styles to the DOM
	var update = __webpack_require__(5)(content, {});
	if(content.locals) module.exports = content.locals;
	// Hot Module Replacement
	if(false) {
		// When the styles change, update the <style> tags
		if(!content.locals) {
			module.hot.accept("!!./../../../.0.26.1@css-loader/index.js!./airbnb.css", function() {
				var newContent = require("!!./../../../.0.26.1@css-loader/index.js!./airbnb.css");
				if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
				update(newContent);
			});
		}
		// When the module is disposed, remove the <style> tags
		module.hot.dispose(function() { update(); });
	}

/***/ },

/***/ 521:
/***/ function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(4)();
	// imports


	// module
	exports.push([module.id, ".flatpickr-calendar{background:transparent;overflow:hidden;max-height:0;opacity:0;visibility:hidden;text-align:center;padding:0;-webkit-animation:none;animation:none;direction:ltr;border:0;font-size:14px;line-height:24px;border-radius:5px;position:absolute;width:293.75px;box-sizing:border-box;-webkit-transition:top .1s cubic-bezier(0,1,.5,1);transition:top .1s cubic-bezier(0,1,.5,1);z-index:99999999;background:#fff;box-shadow:1px 0 0 #eee,-1px 0 0 #eee,0 1px 0 #eee,0 -1px 0 #eee,0 3px 13px rgba(0,0,0,.08)}.flatpickr-calendar.inline,.flatpickr-calendar.open{opacity:1;visibility:visible;overflow:visible;max-height:640px}.flatpickr-calendar.open{display:inline-block;-webkit-animation:flatpickrFadeInDown .3s cubic-bezier(0,1,.5,1);animation:flatpickrFadeInDown .3s cubic-bezier(0,1,.5,1)}.flatpickr-calendar.inline{display:block;position:relative;top:2px}.flatpickr-calendar.static{position:relative;top:2px}.flatpickr-calendar.static.open{display:block}.flatpickr-calendar.hasWeeks{width:auto}.flatpickr-calendar.dateIsPicked.hasTime .flatpickr-time{height:40px;border-top:1px solid #eee}.flatpickr-calendar.noCalendar.hasTime .flatpickr-time{height:auto}.flatpickr-calendar:after,.flatpickr-calendar:before{position:absolute;display:block;pointer-events:none;border:solid transparent;content:\"\";height:0;width:0;left:22px}.flatpickr-calendar.rightMost:after,.flatpickr-calendar.rightMost:before{left:auto;right:22px}.flatpickr-calendar:before{border-width:5px;margin:0 -5px}.flatpickr-calendar:after{border-width:4px;margin:0 -4px}.flatpickr-calendar.arrowTop:after,.flatpickr-calendar.arrowTop:before{bottom:100%}.flatpickr-calendar.arrowTop:before{border-bottom-color:#eee}.flatpickr-calendar.arrowTop:after{border-bottom-color:#fff}.flatpickr-calendar.arrowBottom:after,.flatpickr-calendar.arrowBottom:before{top:100%}.flatpickr-calendar.arrowBottom:before{border-top-color:#eee}.flatpickr-calendar.arrowBottom:after{border-top-color:#fff}.flatpickr-month{background:transparent;color:#3c3f40;fill:#3c3f40;height:28px;line-height:24px;text-align:center;position:relative;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.flatpickr-next-month,.flatpickr-prev-month{text-decoration:none;cursor:pointer;position:absolute;top:10px;height:16px;line-height:16px}.flatpickr-next-month i,.flatpickr-prev-month i{position:relative}.flatpickr-next-month.flatpickr-prev-month,.flatpickr-prev-month.flatpickr-prev-month{left:calc(3.57% - 1.5px)}.flatpickr-next-month.flatpickr-next-month,.flatpickr-prev-month.flatpickr-next-month{right:calc(3.57% - 1.5px)}.flatpickr-next-month:hover,.flatpickr-prev-month:hover{color:#f64747}.flatpickr-next-month:hover svg,.flatpickr-prev-month:hover svg{fill:#f64747}.flatpickr-next-month svg,.flatpickr-prev-month svg{width:14px}.flatpickr-next-month svg path,.flatpickr-prev-month svg path{-webkit-transition:fill .1s;transition:fill .1s;fill:inherit}.numInputWrapper{position:relative;height:auto}.numInputWrapper input,.numInputWrapper span{display:inline-block}.numInputWrapper input{width:100%}.numInputWrapper span{position:absolute;right:0;width:14px;padding:0 4px 0 2px;height:50%;line-height:50%;opacity:0;cursor:pointer;border:1px solid rgba(64,72,72,.05);box-sizing:border-box}.numInputWrapper span:hover{background:rgba(0,0,0,.1)}.numInputWrapper span:active{background:rgba(0,0,0,.2)}.numInputWrapper span:after{display:block;content:\"\";position:absolute;top:33%}.numInputWrapper span.arrowUp{top:0;border-bottom:0}.numInputWrapper span.arrowUp:after{border-left:4px solid transparent;border-right:4px solid transparent;border-bottom:4px solid rgba(64,72,72,.6)}.numInputWrapper span.arrowDown{top:50%}.numInputWrapper span.arrowDown:after{border-left:4px solid transparent;border-right:4px solid transparent;border-top:4px solid rgba(64,72,72,.6)}.numInputWrapper span svg{width:inherit;height:auto}.numInputWrapper span svg path{fill:rgba(60,63,64,.5)}.numInputWrapper:hover{background:rgba(0,0,0,.05)}.numInputWrapper:hover span{opacity:1}.flatpickr-current-month{font-size:135%;line-height:inherit;font-weight:300;color:inherit;position:absolute;width:75%;left:12.5%;top:5px;display:inline-block;text-align:center}.flatpickr-current-month span.cur-month{font-family:inherit;font-weight:700;color:inherit;display:inline-block;padding-left:7px}.flatpickr-current-month .numInputWrapper{width:6ch;width:7ch\\0;display:inline-block}.flatpickr-current-month .numInputWrapper span.arrowUp:after{border-bottom-color:#3c3f40}.flatpickr-current-month .numInputWrapper span.arrowDown:after{border-top-color:#3c3f40}.flatpickr-current-month input.cur-year{background:transparent;box-sizing:border-box;color:inherit;cursor:default;padding:0 0 0 .5ch;margin:0;display:inline;font-size:inherit;font-family:inherit;font-weight:300;line-height:inherit;height:auto;border:0;border-radius:0;vertical-align:initial}.flatpickr-current-month input.cur-year:focus{outline:0}.flatpickr-current-month input.cur-year[disabled],.flatpickr-current-month input.cur-year[disabled]:hover{font-size:100%;color:rgba(60,63,64,.5);background:transparent;pointer-events:none}.flatpickr-weekdays{background:transparent;text-align:center;overflow:hidden}.flatpickr-days,.flatpickr-weeks{padding:1px 0 0}.flatpickr-days{padding:0 2.375px;outline:0;text-align:left;width:293.75px;box-sizing:border-box;display:inline-block;display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-pack:distribute;justify-content:space-around}.flatpickr-day{background:none;border:1px solid transparent;border-radius:150px;box-sizing:border-box;color:#404848;cursor:pointer;font-weight:400;width:14.2857143%;-ms-flex-preferred-size:14.2857143%;flex-basis:14.2857143%;max-width:38px;height:38px;line-height:38px;margin:0;display:inline-block;position:relative;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;text-align:center}.flatpickr-day.inRange,.flatpickr-day.nextMonthDay.inRange,.flatpickr-day.nextMonthDay.today.inRange,.flatpickr-day.nextMonthDay:focus,.flatpickr-day.nextMonthDay:hover,.flatpickr-day.prevMonthDay.inRange,.flatpickr-day.prevMonthDay.today.inRange,.flatpickr-day.prevMonthDay:focus,.flatpickr-day.prevMonthDay:hover,.flatpickr-day.today.inRange,.flatpickr-day:focus,.flatpickr-day:hover{cursor:pointer;outline:0;background:#e9e9e9;border-color:#e9e9e9}.flatpickr-day.today{border-color:#f64747}.flatpickr-day.today:focus,.flatpickr-day.today:hover{border-color:#f64747;background:#f64747;color:#fff}.flatpickr-day.endRange,.flatpickr-day.endRange.nextMonthDay,.flatpickr-day.endRange.prevMonthDay,.flatpickr-day.endRange:focus,.flatpickr-day.endRange:hover,.flatpickr-day.selected,.flatpickr-day.selected.nextMonthDay,.flatpickr-day.selected.prevMonthDay,.flatpickr-day.selected:focus,.flatpickr-day.selected:hover,.flatpickr-day.startRange,.flatpickr-day.startRange.nextMonthDay,.flatpickr-day.startRange.prevMonthDay,.flatpickr-day.startRange:focus,.flatpickr-day.startRange:hover{background:#4f99ff;color:#fff;border-color:#4f99ff}.flatpickr-day.endRange.startRange,.flatpickr-day.selected.startRange,.flatpickr-day.startRange.startRange{border-radius:50px 0 0 50px}.flatpickr-day.endRange.endRange,.flatpickr-day.selected.endRange,.flatpickr-day.startRange.endRange{border-radius:0 50px 50px 0}.flatpickr-day.inRange{border-radius:0;box-shadow:-3.75px 0 0 #e9e9e9,3.75px 0 0 #e9e9e9}.flatpickr-day.disabled,.flatpickr-day.disabled:hover{pointer-events:none}.flatpickr-day.disabled,.flatpickr-day.disabled:hover,.flatpickr-day.nextMonthDay,.flatpickr-day.notAllowed,.flatpickr-day.notAllowed.nextMonthDay,.flatpickr-day.notAllowed.prevMonthDay,.flatpickr-day.prevMonthDay{color:rgba(0,0,0,.15);background:transparent;border-color:#e9e9e9;cursor:default}span.flatpickr-weekday{cursor:default;font-size:90%;color:hsla(0,0%,46%,.54);height:27.166666666666668px;line-height:24px;background:transparent;text-align:center;display:block;float:left;width:14.28%;font-weight:700;margin:0;padding-top:3.166666666666667px}.rangeMode .flatpickr-day{margin-top:1px}.flatpickr-weekwrapper{display:inline-block;float:left}.flatpickr-weekwrapper .flatpickr-weeks{padding:1px 12px 0;box-shadow:1px 0 0 #eee}.flatpickr-weekwrapper .flatpickr-weekday{float:none;width:100%}.flatpickr-weekwrapper span.flatpickr-day{display:block;width:100%;max-width:none}.flatpickr-innerContainer{display:block;display:-webkit-box;display:-ms-flexbox;display:flex;box-sizing:border-box;overflow:hidden}.flatpickr-rContainer{display:inline-block;padding:0;box-sizing:border-box}.flatpickr-time{text-align:center;outline:0;display:block;height:0;line-height:40px;max-height:40px;box-sizing:border-box;overflow:hidden;-webkit-transition:height .33s cubic-bezier(0,1,.5,1);transition:height .33s cubic-bezier(0,1,.5,1);display:-webkit-box;display:-ms-flexbox;display:flex}.flatpickr-time:after{content:\"\";display:table;clear:both}.flatpickr-time .numInputWrapper{-webkit-box-flex:1;-ms-flex:1;flex:1 1 0%;width:40%;height:40px;float:left}.flatpickr-time .numInputWrapper span.arrowUp:after{border-bottom-color:#404848}.flatpickr-time .numInputWrapper span.arrowDown:after{border-top-color:#404848}.flatpickr-time.hasSeconds .numInputWrapper{width:26%}.flatpickr-time.time24hr .numInputWrapper{width:49%}.flatpickr-time input{background:transparent;box-shadow:none;border:0;border-radius:0;text-align:center;margin:0;padding:0;height:inherit;line-height:inherit;cursor:pointer;color:#404848;font-size:14px;position:relative;box-sizing:border-box}.flatpickr-time input.flatpickr-hour{font-weight:700}.flatpickr-time input.flatpickr-minute,.flatpickr-time input.flatpickr-second{font-weight:400}.flatpickr-time input:focus{outline:0;border:0}.flatpickr-time .flatpickr-am-pm,.flatpickr-time .flatpickr-time-separator{height:inherit;display:inline-block;float:left;line-height:inherit;color:#404848;font-weight:700;width:2%;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.flatpickr-time .flatpickr-am-pm{outline:0;width:18%;cursor:pointer;text-align:center;font-weight:400}.flatpickr-time .flatpickr-am-pm:focus,.flatpickr-time .flatpickr-am-pm:hover{background:#f3f3f3}.hasTime .flatpickr-days,.hasWeeks .flatpickr-days{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.hasWeeks .flatpickr-days{border-left:0}@media (-ms-high-contrast:none){.flatpickr-month{padding:0}.flatpickr-month svg{top:0!important}}@-webkit-keyframes flatpickrFadeInDown{0%{opacity:0;-webkit-transform:translate3d(0,-20px,0);transform:translate3d(0,-20px,0)}to{opacity:1;-webkit-transform:none;transform:none}}@keyframes flatpickrFadeInDown{0%{opacity:0;-webkit-transform:translate3d(0,-20px,0);transform:translate3d(0,-20px,0)}to{opacity:1;-webkit-transform:none;transform:none}}.flatpickr-calendar{width:293.75px}.flatpickr-days{padding:0;border-right:0}span.flatpickr-day{border-radius:0!important;border:1px solid #e9e9e9;margin:-1px 0 0 -1px;max-width:none;-ms-flex-preferred-size:calc(14.28571% + 1px);flex-basis:calc(14.28571% + 1px);width:calc(14.28571% + 1px)}span.flatpickr-day:nth-child(7n){border-right:0}span.flatpickr-day:nth-child(n+36){border-bottom:0}span.flatpickr-day.today:not(.selected){border-color:#e9e9e9;border-bottom-color:#f64747}span.flatpickr-day.today:not(.selected):hover{border-color:#f64747}span.flatpickr-day.endRange,span.flatpickr-day.startRange{border-color:#4f99ff}span.flatpickr-day.selected,span.flatpickr-day.today{z-index:2}.rangeMode .flatpickr-day{margin-top:-1px}.flatpickr-weekwrapper .flatpickr-weeks{box-shadow:none}.flatpickr-weekwrapper span.flatpickr-day{border:0;margin:-1px 0 0 -1px}.hasWeeks .flatpickr-days{border-right:0}", ""]);

	// exports


/***/ },

/***/ 522:
/***/ function(module, exports, __webpack_require__) {

	var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

	/*! flatpickr v2.3.4, @license MIT */
	function Flatpickr(element, config) {
		var self = this;

		function init() {
			if (element._flatpickr) destroy(element._flatpickr);

			element._flatpickr = self;

			self.element = element;
			self.instanceConfig = config || {};

			setupFormats();

			parseConfig();
			setupLocale();
			setupInputs();
			setupDates();
			setupHelperFunctions();

			self.isOpen = self.config.inline;
			self.changeMonth = changeMonth;
			self.clear = clear;
			self.close = close;
			self.destroy = destroy;
			self.formatDate = formatDate;
			self.jumpToDate = jumpToDate;
			self.open = open;
			self.redraw = redraw;
			self.set = set;
			self.setDate = setDate;
			self.toggle = toggle;

			self.isMobile = !self.config.disableMobile && !self.config.inline && self.config.mode === "single" && !self.config.disable.length && !self.config.enable.length && !self.config.weekNumbers && /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

			if (!self.isMobile) build();

			bind();

			if (!self.isMobile) {
				Object.defineProperty(self, "dateIsPicked", {
					set: function set(bool) {
						if (bool) return self.calendarContainer.classList.add("dateIsPicked");
						self.calendarContainer.classList.remove("dateIsPicked");
					}
				});
			}

			self.dateIsPicked = self.selectedDates.length > 0 || self.config.noCalendar;

			if (self.selectedDates.length) {
				if (self.config.enableTime) setHoursFromDate();
				updateValue();
			}

			if (self.config.weekNumbers) {
				self.calendarContainer.style.width = self.days.clientWidth + self.weekWrapper.clientWidth + "px";
			}

			triggerEvent("Ready");
		}

		function updateTime(e) {
			if (self.config.noCalendar && !self.selectedDates.length)
				// picking time only
				self.selectedDates = [self.now];

			timeWrapper(e);

			if (!self.selectedDates.length) return;

			if (!self.minDateHasTime || e.type !== "input" || e.target.value.length >= 2) {
				setHoursFromInputs();
				updateValue();
			} else {
				setTimeout(function () {
					setHoursFromInputs();
					updateValue();
				}, 1000);
			}
		}

		function setHoursFromInputs() {
			if (!self.config.enableTime) return;

			var hours = parseInt(self.hourElement.value, 10) || 0,
			    minutes = parseInt(self.minuteElement.value, 10) || 0,
			    seconds = self.config.enableSeconds ? parseInt(self.secondElement.value, 10) || 0 : 0;

			if (self.amPM) hours = hours % 12 + 12 * (self.amPM.textContent === "PM");

			if (self.minDateHasTime && compareDates(self.latestSelectedDateObj, self.config.minDate) === 0) {

				hours = Math.max(hours, self.config.minDate.getHours());
				if (hours === self.config.minDate.getHours()) minutes = Math.max(minutes, self.config.minDate.getMinutes());
			} else if (self.maxDateHasTime && compareDates(self.latestSelectedDateObj, self.config.maxDate) === 0) {
				hours = Math.min(hours, self.config.maxDate.getHours());
				if (hours === self.config.maxDate.getHours()) minutes = Math.min(minutes, self.config.maxDate.getMinutes());
			}

			setHours(hours, minutes, seconds);
		}

		function setHoursFromDate(dateObj) {
			var date = dateObj || self.latestSelectedDateObj;

			if (date) setHours(date.getHours(), date.getMinutes(), date.getSeconds());
		}

		function setHours(hours, minutes, seconds) {
			if (self.selectedDates.length) {
				self.latestSelectedDateObj.setHours(hours % 24, minutes, seconds || 0, 0);
			}

			if (!self.config.enableTime || self.isMobile) return;

			self.hourElement.value = self.pad(!self.config.time_24hr ? (12 + hours) % 12 + 12 * (hours % 12 === 0) : hours);

			self.minuteElement.value = self.pad(minutes);

			if (!self.config.time_24hr && self.selectedDates.length) self.amPM.textContent = self.latestSelectedDateObj.getHours() >= 12 ? "PM" : "AM";

			if (self.config.enableSeconds) self.secondElement.value = self.pad(seconds);
		}

		function onYearInput(event) {
			if (event.target.value.length === 4) {
				self.currentYearElement.blur();
				handleYearChange(event.target.value);
				event.target.value = self.currentYear;
			}
		}

		function bind() {
			if (self.config.wrap) {
				["open", "close", "toggle", "clear"].forEach(function (el) {
					try {
						self.element.querySelector("[data-" + el + "]").addEventListener("click", self[el]);
					} catch (e) {
						//
					}
				});
			}

			if (window.document.createEvent !== undefined) {
				self.changeEvent = window.document.createEvent("HTMLEvents");
				self.changeEvent.initEvent("change", false, true);
			}

			if (self.isMobile) return setupMobile();

			self.debouncedResize = debounce(onResize, 50);
			self.triggerChange = function () {
				triggerEvent("Change");
			};
			self.debouncedChange = debounce(self.triggerChange, 300);

			if (self.config.mode === "range" && self.days) self.days.addEventListener("mouseover", onMouseOver);

			window.document.addEventListener("keydown", onKeyDown);

			if (!self.config.inline && !self.config.static) window.addEventListener("resize", self.debouncedResize);

			if (window.ontouchstart) window.document.addEventListener("touchstart", documentClick);

			window.document.addEventListener("click", documentClick);
			window.document.addEventListener("blur", documentClick);

			if (self.config.clickOpens) (self.altInput || self.input).addEventListener("focus", open);

			if (!self.config.noCalendar) {
				self.prevMonthNav.addEventListener("click", function () {
					return changeMonth(-1);
				});
				self.nextMonthNav.addEventListener("click", function () {
					return changeMonth(1);
				});

				self.currentYearElement.addEventListener("wheel", function (e) {
					return debounce(yearScroll(e), 50);
				});
				self.currentYearElement.addEventListener("focus", function () {
					self.currentYearElement.select();
				});

				self.currentYearElement.addEventListener("input", onYearInput);
				self.currentYearElement.addEventListener("increment", onYearInput);

				self.days.addEventListener("click", selectDate);
			}

			if (self.config.enableTime) {
				self.timeContainer.addEventListener("transitionend", positionCalendar);
				self.timeContainer.addEventListener("wheel", function (e) {
					return debounce(updateTime(e), 5);
				});
				self.timeContainer.addEventListener("input", updateTime);
				self.timeContainer.addEventListener("increment", updateTime);
				self.timeContainer.addEventListener("increment", self.debouncedChange);

				self.timeContainer.addEventListener("wheel", self.debouncedChange);
				self.timeContainer.addEventListener("input", self.triggerChange);

				self.hourElement.addEventListener("focus", function () {
					self.hourElement.select();
				});
				self.minuteElement.addEventListener("focus", function () {
					self.minuteElement.select();
				});

				if (self.secondElement) {
					self.secondElement.addEventListener("focus", function () {
						self.secondElement.select();
					});
				}

				if (self.amPM) {
					self.amPM.addEventListener("click", function (e) {
						updateTime(e);
						self.triggerChange(e);
					});
				}
			}
		}

		function jumpToDate(jumpDate) {
			jumpDate = jumpDate ? self.parseDate(jumpDate) : self.latestSelectedDateObj || (self.config.minDate > self.now ? self.config.minDate : self.config.maxDate && self.config.maxDate < self.now ? self.config.maxDate : self.now);

			try {
				self.currentYear = jumpDate.getFullYear();
				self.currentMonth = jumpDate.getMonth();
			} catch (e) {
				console.error(e.stack);
				console.warn("Invalid date supplied: " + jumpDate);
			}

			self.redraw();
		}

		function incrementNumInput(e, delta) {
			var input = e.target.parentNode.childNodes[0];
			input.value = parseInt(input.value, 10) + delta * (input.step || 1);

			try {
				input.dispatchEvent(new Event("increment", { "bubbles": true }));
			} catch (e) {
				var ev = window.document.createEvent("CustomEvent");
				ev.initCustomEvent("increment", true, true, {});
				input.dispatchEvent(ev);
			}
		}

		function createNumberInput(inputClassName) {
			var wrapper = createElement("div", "numInputWrapper"),
			    numInput = createElement("input", "numInput " + inputClassName),
			    arrowUp = createElement("span", "arrowUp"),
			    arrowDown = createElement("span", "arrowDown");

			numInput.type = "text";
			wrapper.appendChild(numInput);
			wrapper.appendChild(arrowUp);
			wrapper.appendChild(arrowDown);

			arrowUp.addEventListener("click", function (e) {
				return incrementNumInput(e, 1);
			});
			arrowDown.addEventListener("click", function (e) {
				return incrementNumInput(e, -1);
			});
			return wrapper;
		}

		function build() {
			var fragment = window.document.createDocumentFragment();
			self.calendarContainer = createElement("div", "flatpickr-calendar");
			self.numInputType = navigator.userAgent.indexOf("MSIE 9.0") > 0 ? "text" : "number";

			if (!self.config.noCalendar) {
				fragment.appendChild(buildMonthNav());
				self.innerContainer = createElement("div", "flatpickr-innerContainer");

				if (self.config.weekNumbers) self.innerContainer.appendChild(buildWeeks());

				self.rContainer = createElement("div", "flatpickr-rContainer");
				self.rContainer.appendChild(buildWeekdays());
				self.rContainer.appendChild(buildDays());
				self.innerContainer.appendChild(self.rContainer);
				fragment.appendChild(self.innerContainer);
			}

			if (self.config.enableTime) fragment.appendChild(buildTime());

			if (self.config.mode === "range") self.calendarContainer.classList.add("rangeMode");

			self.calendarContainer.appendChild(fragment);

			if (self.config.inline || self.config.static) {
				self.calendarContainer.classList.add(self.config.inline ? "inline" : "static");
				positionCalendar();

				if (self.config.appendTo && self.config.appendTo.nodeType) self.config.appendTo.appendChild(self.calendarContainer);else {
					self.element.parentNode.insertBefore(self.calendarContainer, (self.altInput || self.input).nextSibling);
				}
			} else window.document.body.appendChild(self.calendarContainer);
		}

		function createDay(className, date, dayNumber) {
			var dateIsEnabled = isEnabled(date, true),
			    dayElement = createElement("span", "flatpickr-day " + className, date.getDate());

			dayElement.dateObj = date;

			if (compareDates(date, self.now) === 0) dayElement.classList.add("today");

			if (dateIsEnabled) {
				dayElement.tabIndex = 0;

				if (isDateSelected(date)) {
					dayElement.classList.add("selected");

					if (self.config.mode === "range") {
						dayElement.classList.add(compareDates(date, self.selectedDates[0]) === 0 ? "startRange" : "endRange");
					} else self.selectedDateElem = dayElement;
				}
			} else {
				dayElement.classList.add("disabled");
				if (self.selectedDates[0] && date > self.minRangeDate && date < self.selectedDates[0]) self.minRangeDate = date;else if (self.selectedDates[0] && date < self.maxRangeDate && date > self.selectedDates[0]) self.maxRangeDate = date;
			}

			if (self.config.mode === "range") {
				if (isDateInRange(date) && !isDateSelected(date)) dayElement.classList.add("inRange");

				if (self.selectedDates.length === 1 && (date < self.minRangeDate || date > self.maxRangeDate)) dayElement.classList.add("notAllowed");
			}

			if (self.config.weekNumbers && className !== "prevMonthDay" && dayNumber % 7 === 1) {
				self.weekNumbers.insertAdjacentHTML("beforeend", "<span class='disabled flatpickr-day'>" + self.config.getWeek(date) + "</span>");
			}

			triggerEvent("DayCreate", dayElement);

			return dayElement;
		}

		function buildDays() {
			if (!self.days) {
				self.days = createElement("div", "flatpickr-days");
				self.days.tabIndex = -1;
			}

			self.firstOfMonth = (new Date(self.currentYear, self.currentMonth, 1).getDay() - self.l10n.firstDayOfWeek + 7) % 7;

			self.prevMonthDays = self.utils.getDaysinMonth((self.currentMonth - 1 + 12) % 12);

			var daysInMonth = self.utils.getDaysinMonth(),
			    days = window.document.createDocumentFragment();

			var dayNumber = self.prevMonthDays + 1 - self.firstOfMonth;

			if (self.config.weekNumbers && self.weekNumbers.firstChild) self.weekNumbers.textContent = "";

			if (self.config.mode === "range") {
				// const dateLimits = self.config.enable.length || self.config.disable.length || self.config.mixDate || self.config.maxDate;
				self.minRangeDate = new Date(self.currentYear, self.currentMonth - 1, dayNumber);
				self.maxRangeDate = new Date(self.currentYear, self.currentMonth + 1, (42 - self.firstOfMonth) % daysInMonth);
			}

			if (self.days.firstChild) self.days.textContent = "";

			// prepend days from the ending of previous month
			for (var i = 0; dayNumber <= self.prevMonthDays; i++, dayNumber++) {
				days.appendChild(createDay("prevMonthDay", new Date(self.currentYear, self.currentMonth - 1, dayNumber), dayNumber));
			}

			// Start at 1 since there is no 0th day
			for (dayNumber = 1; dayNumber <= daysInMonth; dayNumber++) {
				days.appendChild(createDay("", new Date(self.currentYear, self.currentMonth, dayNumber), dayNumber));
			}

			// append days from the next month
			for (var dayNum = daysInMonth + 1; dayNum <= 42 - self.firstOfMonth; dayNum++) {
				days.appendChild(createDay("nextMonthDay", new Date(self.currentYear, self.currentMonth + 1, dayNum % daysInMonth), dayNum));
			}

			self.days.appendChild(days);
			return self.days;
		}

		function buildMonthNav() {
			var monthNavFragment = window.document.createDocumentFragment();
			self.monthNav = createElement("div", "flatpickr-month");

			self.prevMonthNav = createElement("span", "flatpickr-prev-month");
			self.prevMonthNav.innerHTML = self.config.prevArrow;

			self.currentMonthElement = createElement("span", "cur-month");

			var yearInput = createNumberInput("cur-year");
			self.currentYearElement = yearInput.childNodes[0];
			self.currentYearElement.title = self.l10n.scrollTitle;

			if (self.config.minDate) self.currentYearElement.min = self.config.minDate.getFullYear();

			if (self.config.maxDate) {
				self.currentYearElement.max = self.config.maxDate.getFullYear();

				self.currentYearElement.disabled = self.config.minDate && self.config.minDate.getFullYear() === self.config.maxDate.getFullYear();
			}

			self.nextMonthNav = createElement("span", "flatpickr-next-month");
			self.nextMonthNav.innerHTML = self.config.nextArrow;

			self.navigationCurrentMonth = createElement("span", "flatpickr-current-month");
			self.navigationCurrentMonth.appendChild(self.currentMonthElement);
			self.navigationCurrentMonth.appendChild(yearInput);

			monthNavFragment.appendChild(self.prevMonthNav);
			monthNavFragment.appendChild(self.navigationCurrentMonth);
			monthNavFragment.appendChild(self.nextMonthNav);
			self.monthNav.appendChild(monthNavFragment);

			updateNavigationCurrentMonth();

			return self.monthNav;
		}

		function buildTime() {
			self.calendarContainer.classList.add("hasTime");
			if (self.config.noCalendar) self.calendarContainer.classList.add("noCalendar");
			self.timeContainer = createElement("div", "flatpickr-time");
			self.timeContainer.tabIndex = -1;
			var separator = createElement("span", "flatpickr-time-separator", ":");

			var hourInput = createNumberInput("flatpickr-hour");
			self.hourElement = hourInput.childNodes[0];

			var minuteInput = createNumberInput("flatpickr-minute");
			self.minuteElement = minuteInput.childNodes[0];

			self.hourElement.tabIndex = self.minuteElement.tabIndex = 0;
			self.hourElement.pattern = self.minuteElement.pattern = "\\d*";

			self.hourElement.value = self.pad(self.latestSelectedDateObj ? self.latestSelectedDateObj.getHours() : self.config.defaultHour);

			self.minuteElement.value = self.pad(self.latestSelectedDateObj ? self.latestSelectedDateObj.getMinutes() : self.config.defaultMinute);

			self.hourElement.step = self.config.hourIncrement;
			self.minuteElement.step = self.config.minuteIncrement;

			self.hourElement.min = self.config.time_24hr ? 0 : 1;
			self.hourElement.max = self.config.time_24hr ? 23 : 12;

			self.minuteElement.min = 0;
			self.minuteElement.max = 59;

			self.hourElement.title = self.minuteElement.title = self.l10n.scrollTitle;

			self.timeContainer.appendChild(hourInput);
			self.timeContainer.appendChild(separator);
			self.timeContainer.appendChild(minuteInput);

			if (self.config.time_24hr) self.timeContainer.classList.add("time24hr");

			if (self.config.enableSeconds) {
				self.timeContainer.classList.add("hasSeconds");

				var secondInput = createNumberInput("flatpickr-second");
				self.secondElement = secondInput.childNodes[0];

				self.secondElement.pattern = self.hourElement.pattern;
				self.secondElement.value = self.latestSelectedDateObj ? self.pad(self.latestSelectedDateObj.getSeconds()) : "00";

				self.secondElement.step = self.minuteElement.step;
				self.secondElement.min = self.minuteElement.min;
				self.secondElement.max = self.minuteElement.max;

				self.timeContainer.appendChild(createElement("span", "flatpickr-time-separator", ":"));
				self.timeContainer.appendChild(secondInput);
			}

			if (!self.config.time_24hr) {
				// add self.amPM if appropriate
				self.amPM = createElement("span", "flatpickr-am-pm", ["AM", "PM"][self.hourElement.value > 11 | 0]);
				self.amPM.title = self.l10n.toggleTitle;
				self.amPM.tabIndex = 0;
				self.timeContainer.appendChild(self.amPM);
			}

			return self.timeContainer;
		}

		function buildWeekdays() {
			if (!self.weekdayContainer) self.weekdayContainer = createElement("div", "flatpickr-weekdays");

			var firstDayOfWeek = self.l10n.firstDayOfWeek;
			var weekdays = self.l10n.weekdays.shorthand.slice();

			if (firstDayOfWeek > 0 && firstDayOfWeek < weekdays.length) {
				weekdays = [].concat(weekdays.splice(firstDayOfWeek, weekdays.length), weekdays.splice(0, firstDayOfWeek));
			}

			self.weekdayContainer.innerHTML = "\n\t\t<span class=flatpickr-weekday>\n\t\t\t" + weekdays.join("</span><span class=flatpickr-weekday>") + "\n\t\t</span>\n\t\t";

			return self.weekdayContainer;
		}

		/* istanbul ignore next */
		function buildWeeks() {
			self.calendarContainer.classList.add("hasWeeks");
			self.weekWrapper = createElement("div", "flatpickr-weekwrapper");
			self.weekWrapper.appendChild(createElement("span", "flatpickr-weekday", self.l10n.weekAbbreviation));
			self.weekNumbers = createElement("div", "flatpickr-weeks");
			self.weekWrapper.appendChild(self.weekNumbers);

			return self.weekWrapper;
		}

		function changeMonth(value, is_offset) {
			self.currentMonth = typeof is_offset === "undefined" || is_offset ? self.currentMonth + value : value;

			handleYearChange();
			updateNavigationCurrentMonth();
			buildDays();

			if (!self.config.noCalendar) self.days.focus();

			triggerEvent("MonthChange");
		}

		function clear(triggerChangeEvent) {
			self.input.value = "";

			if (self.altInput) self.altInput.value = "";

			if (self.mobileInput) self.mobileInput.value = "";

			self.selectedDates = [];
			self.latestSelectedDateObj = null;
			self.dateIsPicked = false;

			self.redraw();

			if (triggerChangeEvent !== false)
				// triggerChangeEvent is true (default) or an Event
				triggerEvent("Change");
		}

		function close() {
			self.isOpen = false;

			if (!self.isMobile) {
				self.calendarContainer.classList.remove("open");
				(self.altInput || self.input).classList.remove("active");
			}

			triggerEvent("Close");
		}

		function destroy(instance) {
			instance = instance || self;
			instance.clear(false);

			window.document.removeEventListener("keydown", onKeyDown);
			window.removeEventListener("resize", instance.debouncedResize);

			window.document.removeEventListener("click", documentClick);
			window.document.removeEventListener("touchstart", documentClick);
			window.document.removeEventListener("blur", documentClick);

			if (instance.timeContainer) instance.timeContainer.removeEventListener("transitionend", positionCalendar);

			if (instance.mobileInput && instance.mobileInput.parentNode) instance.mobileInput.parentNode.removeChild(instance.mobileInput);else if (instance.calendarContainer && instance.calendarContainer.parentNode) instance.calendarContainer.parentNode.removeChild(instance.calendarContainer);

			if (instance.altInput) {
				instance.input.type = "text";
				if (instance.altInput.parentNode) instance.altInput.parentNode.removeChild(instance.altInput);
			}

			instance.input.type = instance.input._type;
			instance.input.classList.remove("flatpickr-input");
			instance.input.removeEventListener("focus", open);
			instance.input.removeAttribute("readonly");

			delete instance.input._flatpickr;
		}

		function isCalendarElem(elem) {
			var e = elem;
			while (e) {
				if (/flatpickr-day|flatpickr-calendar/.test(e.className)) return true;
				e = e.parentNode;
			}

			return false;
		}

		function documentClick(e) {
			var isInput = self.element.contains(e.target) || e.target === self.input || e.target === self.altInput || e.path && (~e.path.indexOf(self.input) || ~e.path.indexOf(self.altInput));

			if (self.isOpen && !self.config.inline && !isCalendarElem(e.target) && !isInput) {
				e.preventDefault();
				self.close();

				if (self.config.mode === "range" && self.selectedDates.length === 1) {
					self.clear();
					self.redraw();
				}
			}
		}

		function formatDate(frmt, dateObj) {
			if (self.config.formatDate) return self.config.formatDate(frmt, dateObj);

			var chars = frmt.split("");
			return chars.map(function (c, i) {
				return self.formats[c] && chars[i - 1] !== "\\" ? self.formats[c](dateObj) : c !== "\\" ? c : "";
			}).join("");
		}

		function handleYearChange(newYear) {
			if (self.currentMonth < 0 || self.currentMonth > 11) {
				self.currentYear += self.currentMonth % 11;
				self.currentMonth = (self.currentMonth + 12) % 12;

				triggerEvent("YearChange");
			} else if (newYear && (!self.currentYearElement.min || newYear >= self.currentYearElement.min) && (!self.currentYearElement.max || newYear <= self.currentYearElement.max)) {
				self.currentYear = parseInt(newYear, 10) || self.currentYear;

				if (self.config.maxDate && self.currentYear === self.config.maxDate.getFullYear()) {
					self.currentMonth = Math.min(self.config.maxDate.getMonth(), self.currentMonth);
				} else if (self.config.minDate && self.currentYear === self.config.minDate.getFullYear()) {
					self.currentMonth = Math.max(self.config.minDate.getMonth(), self.currentMonth);
				}

				self.redraw();
				triggerEvent("YearChange");
			}
		}

		function isEnabled(date, timeless) {
			var ltmin = compareDates(date, self.config.minDate, typeof timeless !== "undefined" ? timeless : !self.minDateHasTime) < 0;
			var gtmax = compareDates(date, self.config.maxDate, typeof timeless !== "undefined" ? timeless : !self.maxDateHasTime) > 0;

			if (ltmin || gtmax) return false;

			if (!self.config.enable.length && !self.config.disable.length) return true;

			var dateToCheck = self.parseDate(date, true); // timeless

			var bool = self.config.enable.length > 0,
			    array = bool ? self.config.enable : self.config.disable;

			for (var i = 0, d; i < array.length; i++) {
				d = array[i];

				if (d instanceof Function && d(dateToCheck)) // disabled by function
					return bool;else if (d instanceof Date && d.getTime() === dateToCheck.getTime())
					// disabled by date
					return bool;else if (typeof d === "string" && self.parseDate(d, true).getTime() === dateToCheck.getTime())
					// disabled by date string
					return bool;else if ( // disabled by range
				(typeof d === "undefined" ? "undefined" : _typeof(d)) === "object" && d.from && d.to && dateToCheck >= d.from && dateToCheck <= d.to) return bool;
			}

			return !bool;
		}

		function onKeyDown(e) {
			if (self.isOpen) {
				switch (e.which) {
					case 13:
						if (self.timeContainer && self.timeContainer.contains(e.target)) updateValue();else selectDate(e);

						break;

					case 27:
						// escape
						self.clear();
						self.redraw();
						self.close();
						break;

					case 37:
						if (e.target !== self.input & e.target !== self.altInput) changeMonth(-1);
						break;

					case 38:
						e.preventDefault();

						if (self.timeContainer && self.timeContainer.contains(e.target)) updateTime(e);else {
							self.currentYear++;
							self.redraw();
						}

						break;

					case 39:
						if (e.target !== self.input & e.target !== self.altInput) changeMonth(1);
						break;

					case 40:
						e.preventDefault();
						if (self.timeContainer && self.timeContainer.contains(e.target)) updateTime(e);else {
							self.currentYear--;
							self.redraw();
						}

						break;

					default:
						break;
				}
			}
		}

		function onMouseOver(e) {
			if (self.selectedDates.length !== 1 || !e.target.classList.contains("flatpickr-day")) return;

			var hoverDate = e.target.dateObj,
			    initialDate = self.parseDate(self.selectedDates[0], true),
			    rangeStartDate = Math.min(hoverDate.getTime(), self.selectedDates[0].getTime()),
			    rangeEndDate = Math.max(hoverDate.getTime(), self.selectedDates[0].getTime()),
			    containsDisabled = false;

			for (var t = rangeStartDate; t < rangeEndDate; t += self.utils.duration.DAY) {
				if (!isEnabled(new Date(t))) {
					containsDisabled = true;
					break;
				}
			}

			for (var timestamp = self.days.childNodes[0].dateObj.getTime(), i = 0; i < 42; i++, timestamp += self.utils.duration.DAY) {
				var outOfRange = timestamp < self.minRangeDate.getTime() || timestamp > self.maxRangeDate.getTime();

				if (outOfRange) {
					self.days.childNodes[i].classList.add("notAllowed");
					self.days.childNodes[i].classList.remove("inRange", "startRange", "endRange");
					continue;
				} else if (containsDisabled && !outOfRange) continue;

				self.days.childNodes[i].classList.remove("startRange", "inRange", "endRange", "notAllowed");

				var minRangeDate = Math.max(self.minRangeDate.getTime(), rangeStartDate),
				    maxRangeDate = Math.min(self.maxRangeDate.getTime(), rangeEndDate);

				e.target.classList.add(hoverDate < self.selectedDates[0] ? "startRange" : "endRange");

				if (initialDate > hoverDate && timestamp === initialDate.getTime()) self.days.childNodes[i].classList.add("endRange");else if (initialDate < hoverDate && timestamp === initialDate.getTime()) self.days.childNodes[i].classList.add("startRange");else if (timestamp > minRangeDate && timestamp < maxRangeDate) self.days.childNodes[i].classList.add("inRange");
			}
		}

		function onResize() {
			if (self.isOpen && !self.config.static && !self.config.inline) positionCalendar();
		}

		function open(e) {
			if (self.isMobile) {
				if (e) {
					e.preventDefault();
					e.target.blur();
				}

				setTimeout(function () {
					self.mobileInput.click();
				}, 0);

				triggerEvent("Open");
				return;
			} else if (self.isOpen || (self.altInput || self.input).disabled || self.config.inline) return;

			self.calendarContainer.classList.add("open");

			if (!self.config.static && !self.config.inline) positionCalendar();

			self.isOpen = true;

			if (!self.config.allowInput) {
				(self.altInput || self.input).blur();
				(self.config.noCalendar ? self.timeContainer : self.selectedDateElem ? self.selectedDateElem : self.days).focus();
			}

			(self.altInput || self.input).classList.add("active");
			triggerEvent("Open");
		}

		function minMaxDateSetter(type) {
			return function (date) {
				var dateObj = self.config["_" + type + "Date"] = self.parseDate(date);
				var inverseDateObj = self.config["_" + (type === "min" ? "max" : "min") + "Date"];

				if (self.selectedDates) {
					self.selectedDates = self.selectedDates.filter(isEnabled);
					updateValue();
				}

				if (self.days) redraw();

				if (!self.currentYearElement) return;

				if (date && dateObj instanceof Date) {
					self[type + "DateHasTime"] = dateObj.getHours() || dateObj.getMinutes() || dateObj.getSeconds();

					self.currentYearElement[type] = dateObj.getFullYear();
				} else self.currentYearElement.removeAttribute(type);

				self.currentYearElement.disabled = inverseDateObj && dateObj && inverseDateObj.getFullYear() === dateObj.getFullYear();
			};
		}

		function parseConfig() {
			var boolOpts = ["utc", "wrap", "weekNumbers", "allowInput", "clickOpens", "time_24hr", "enableTime", "noCalendar", "altInput", "shorthandCurrentMonth", "inline", "static", "enableSeconds", "disableMobile"];
			self.config = Object.create(Flatpickr.defaultConfig);

			Object.defineProperty(self.config, "minDate", {
				get: function get() {
					return this._minDate;
				},
				set: minMaxDateSetter("min")
			});

			Object.defineProperty(self.config, "maxDate", {
				get: function get() {
					return this._maxDate;
				},
				set: minMaxDateSetter("max")
			});

			var userConfig = _extends({}, self.instanceConfig, JSON.parse(JSON.stringify(self.element.dataset || {})));

			_extends(self.config, userConfig);

			for (var i = 0; i < boolOpts.length; i++) {
				self.config[boolOpts[i]] = self.config[boolOpts[i]] === true || self.config[boolOpts[i]] === "true";
			}if (!userConfig.dateFormat && userConfig.enableTime) {
				self.config.dateFormat = self.config.noCalendar ? "H:i" + (self.config.enableSeconds ? ":S" : "") : Flatpickr.defaultConfig.dateFormat + " H:i" + (self.config.enableSeconds ? ":S" : "");
			}

			if (userConfig.altInput && userConfig.enableTime && !userConfig.altFormat) {
				self.config.altFormat = self.config.noCalendar ? "h:i" + (self.config.enableSeconds ? ":S K" : " K") : Flatpickr.defaultConfig.altFormat + (" h:i" + (self.config.enableSeconds ? ":S" : "") + " K");
			}
		}

		function setupLocale() {
			if (_typeof(self.config.locale) !== "object" && typeof Flatpickr.l10ns[self.config.locale] === "undefined") console.warn("flatpickr: invalid locale " + self.config.locale);

			self.l10n = _extends(Object.create(Flatpickr.l10ns.default), _typeof(self.config.locale) === "object" ? self.config.locale : self.config.locale !== "default" ? Flatpickr.l10ns[self.config.locale] || {} : {});
		}

		function positionCalendar(e) {
			if (e && e.target !== self.timeContainer) return;

			var calendarHeight = self.calendarContainer.offsetHeight,
			    calendarWidth = self.calendarContainer.offsetWidth,
			    input = self.altInput || self.input,
			    inputBounds = input.getBoundingClientRect(),
			    distanceFromBottom = window.innerHeight - inputBounds.bottom + input.offsetHeight;

			var top = void 0;

			if (distanceFromBottom < calendarHeight + 60) {
				top = window.pageYOffset - calendarHeight + inputBounds.top - 2;
				self.calendarContainer.classList.remove("arrowTop");
				self.calendarContainer.classList.add("arrowBottom");
			} else {
				top = window.pageYOffset + input.offsetHeight + inputBounds.top + 2;
				self.calendarContainer.classList.remove("arrowBottom");
				self.calendarContainer.classList.add("arrowTop");
			}

			if (!self.config.static && !self.config.inline) {
				self.calendarContainer.style.top = top + "px";

				var left = window.pageXOffset + inputBounds.left;
				var right = window.document.body.offsetWidth - inputBounds.right;

				if (left + calendarWidth <= window.document.body.offsetWidth) {
					self.calendarContainer.style.left = left + "px";
					self.calendarContainer.style.right = "auto";

					self.calendarContainer.classList.remove("rightMost");
				} else {
					self.calendarContainer.style.left = "auto";
					self.calendarContainer.style.right = right + "px";

					self.calendarContainer.classList.add("rightMost");
				}
			}
		}

		function redraw() {
			if (self.config.noCalendar || self.isMobile) return;

			buildWeekdays();
			updateNavigationCurrentMonth();
			buildDays();
		}

		function selectDate(e) {
			e.preventDefault();
			if (self.config.allowInput && e.which === 13 && e.target === (self.altInput || self.input)) return self.setDate((self.altInput || self.input).value), e.target.blur();

			if (!e.target.classList.contains("flatpickr-day") || e.target.classList.contains("disabled") || e.target.classList.contains("notAllowed")) return;

			var selectedDate = self.latestSelectedDateObj = new Date(e.target.dateObj.getTime());

			self.selectedDateElem = e.target;

			if (self.config.mode === "single") self.selectedDates = [selectedDate];else if (self.config.mode === "multiple") {
				var selectedIndex = isDateSelected(selectedDate);
				if (selectedIndex) self.selectedDates.splice(selectedIndex, 1);else self.selectedDates.push(selectedDate);
			} else if (self.config.mode === "range") {
				if (self.selectedDates.length === 2) self.clear();

				self.selectedDates.push(selectedDate);
				self.selectedDates.sort(function (a, b) {
					return a.getTime() - b.getTime();
				});
			}

			setHoursFromInputs();

			if (selectedDate.getMonth() !== self.currentMonth && self.config.mode !== "range") {
				self.currentYear = selectedDate.getFullYear();
				self.currentMonth = selectedDate.getMonth();
				updateNavigationCurrentMonth();
			}

			buildDays();

			if (self.minDateHasTime && self.config.enableTime && compareDates(selectedDate, self.config.minDate) === 0) setHoursFromDate(self.config.minDate);

			updateValue();

			setTimeout(function () {
				return self.dateIsPicked = true;
			}, 50);

			if (self.config.mode === "range" && self.selectedDates.length === 1) onMouseOver(e);

			if (self.config.mode === "single" && !self.config.enableTime) self.close();

			triggerEvent("Change");
		}

		function set(option, value) {
			self.config[option] = value;
			self.redraw();
			jumpToDate();
		}

		function setSelectedDate(inputDate) {
			if (Array.isArray(inputDate)) self.selectedDates = inputDate.map(self.parseDate);else if (inputDate) {
				switch (self.config.mode) {
					case "single":
						self.selectedDates = [self.parseDate(inputDate)];
						break;

					case "multiple":
						self.selectedDates = inputDate.split("; ").map(self.parseDate);
						break;

					case "range":
						self.selectedDates = inputDate.split(self.l10n.rangeSeparator).map(self.parseDate);
						break;

					default:
						break;
				}
			}

			self.selectedDates = self.selectedDates.filter(function (d) {
				return d instanceof Date && d.getTime() && isEnabled(d, false);
			});

			self.selectedDates.sort(function (a, b) {
				return a.getTime() - b.getTime();
			});
		}

		function setDate(date, triggerChange) {
			if (!date) return self.clear();

			setSelectedDate(date);

			if (self.selectedDates.length > 0) {
				self.dateIsPicked = true;
				self.latestSelectedDateObj = self.selectedDates[0];
			} else self.latestSelectedDateObj = null;

			self.redraw();
			jumpToDate();

			setHoursFromDate();
			updateValue();

			if (triggerChange === true) triggerEvent("Change");
		}

		function setupDates() {
			function parseDateRules(arr) {
				for (var i = arr.length; i--;) {
					if (typeof arr[i] === "string" || +arr[i]) arr[i] = self.parseDate(arr[i], true);else if (arr[i] && arr[i].from && arr[i].to) {
						arr[i].from = self.parseDate(arr[i].from);
						arr[i].to = self.parseDate(arr[i].to);
					}
				}

				return arr.filter(function (x) {
					return x;
				}); // remove falsy values
			}

			self.selectedDates = [];
			self.now = new Date();

			setSelectedDate(self.config.defaultDate || self.input.value);

			if (self.config.disable.length) self.config.disable = parseDateRules(self.config.disable);

			if (self.config.enable.length) self.config.enable = parseDateRules(self.config.enable);

			var initialDate = self.selectedDates.length ? self.selectedDates[0] : self.config.minDate && self.config.minDate.getTime() > self.now ? self.config.minDate : self.config.maxDate && self.config.maxDate.getTime() < self.now ? self.config.maxDate : self.now;

			self.currentYear = initialDate.getFullYear();
			self.currentMonth = initialDate.getMonth();

			if (self.selectedDates.length) self.latestSelectedDateObj = self.selectedDates[0];

			self.minDateHasTime = self.config.minDate && (self.config.minDate.getHours() || self.config.minDate.getMinutes() || self.config.minDate.getSeconds());

			self.maxDateHasTime = self.config.maxDate && (self.config.maxDate.getHours() || self.config.maxDate.getMinutes() || self.config.maxDate.getSeconds());

			Object.defineProperty(self, "latestSelectedDateObj", {
				get: function get() {
					return self._selectedDateObj || self.selectedDates[self.selectedDates.length - 1] || null;
				},
				set: function set(date) {
					self._selectedDateObj = date;
				}
			});
		}

		function setupHelperFunctions() {
			self.utils = {
				duration: {
					DAY: 86400000
				},
				getDaysinMonth: function getDaysinMonth(month, yr) {
					month = typeof month === "undefined" ? self.currentMonth : month;

					yr = typeof yr === "undefined" ? self.currentYear : yr;

					if (month === 1 && (yr % 4 === 0 && yr % 100 !== 0 || yr % 400 === 0)) return 29;

					return self.l10n.daysInMonth[month];
				},
				monthToStr: function monthToStr(monthNumber, shorthand) {
					shorthand = typeof shorthand === "undefined" ? self.config.shorthandCurrentMonth : shorthand;

					return self.l10n.months[(shorthand ? "short" : "long") + "hand"][monthNumber];
				}
			};
		}

		/* istanbul ignore next */
		function setupFormats() {
			self.formats = {
				// weekday name, short, e.g. Thu
				D: function D(date) {
					return self.l10n.weekdays.shorthand[self.formats.w(date)];
				},

				// full month name e.g. January
				F: function F(date) {
					return self.utils.monthToStr(self.formats.n(date) - 1, false);
				},

				// hours with leading zero e.g. 03
				H: function H(date) {
					return Flatpickr.prototype.pad(date.getHours());
				},

				// day (1-30) with ordinal suffix e.g. 1st, 2nd
				J: function J(date) {
					return date.getDate() + self.l10n.ordinal(date.getDate());
				},

				// AM/PM
				K: function K(date) {
					return date.getHours() > 11 ? "PM" : "AM";
				},

				// shorthand month e.g. Jan, Sep, Oct, etc
				M: function M(date) {
					return self.utils.monthToStr(date.getMonth(), true);
				},

				// seconds 00-59
				S: function S(date) {
					return Flatpickr.prototype.pad(date.getSeconds());
				},

				// unix timestamp
				U: function U(date) {
					return date.getTime() / 1000;
				},

				// full year e.g. 2016
				Y: function Y(date) {
					return date.getFullYear();
				},

				// day in month, padded (01-30)
				d: function d(date) {
					return Flatpickr.prototype.pad(self.formats.j(date));
				},

				// hour from 1-12 (am/pm)
				h: function h(date) {
					return date.getHours() % 12 ? date.getHours() % 12 : 12;
				},

				// minutes, padded with leading zero e.g. 09
				i: function i(date) {
					return Flatpickr.prototype.pad(date.getMinutes());
				},

				// day in month (1-30)
				j: function j(date) {
					return date.getDate();
				},

				// weekday name, full, e.g. Thursday
				l: function l(date) {
					return self.l10n.weekdays.longhand[self.formats.w(date)];
				},

				// padded month number (01-12)
				m: function m(date) {
					return Flatpickr.prototype.pad(self.formats.n(date));
				},

				// the month number (1-12)
				n: function n(date) {
					return date.getMonth() + 1;
				},

				// seconds 0-59
				s: function s(date) {
					return date.getSeconds();
				},

				// number of the day of the week
				w: function w(date) {
					return date.getDay();
				},

				// last two digits of year e.g. 16 for 2016
				y: function y(date) {
					return String(self.formats.Y(date)).substring(2);
				}
			};
		}

		function setupInputs() {
			self.input = self.config.wrap ? self.element.querySelector("[data-input]") : self.element;

			if (!self.input) return console.warn("Error: invalid input element specified", self.input);

			self.input._type = self.input.type;
			self.input.type = "text";
			self.input.classList.add("flatpickr-input");

			if (self.config.altInput) {
				// replicate self.element
				self.altInput = createElement(self.input.nodeName, self.input.className + " " + self.config.altInputClass);
				self.altInput.placeholder = self.input.placeholder;
				self.altInput.type = "text";

				self.input.type = "hidden";
				if (self.input.parentNode) self.input.parentNode.insertBefore(self.altInput, self.input.nextSibling);
			}

			if (!self.config.allowInput) (self.altInput || self.input).setAttribute("readonly", "readonly");
		}

		function setupMobile() {
			var inputType = self.config.enableTime ? self.config.noCalendar ? "time" : "datetime-local" : "date";

			self.mobileInput = createElement("input", self.input.className + " flatpickr-mobile");
			self.mobileInput.step = "any";
			self.mobileInput.tabIndex = 1;
			self.mobileInput.type = inputType;
			self.mobileInput.disabled = self.input.disabled;

			self.mobileFormatStr = inputType === "datetime-local" ? "Y-m-d\\TH:i:S" : inputType === "date" ? "Y-m-d" : "H:i:S";

			if (self.selectedDates.length) {
				self.mobileInput.defaultValue = self.mobileInput.value = formatDate(self.mobileFormatStr, self.selectedDates[0]);
			}

			if (self.config.minDate) self.mobileInput.min = formatDate("Y-m-d", self.config.minDate);

			if (self.config.maxDate) self.mobileInput.max = formatDate("Y-m-d", self.config.maxDate);

			self.input.type = "hidden";
			if (self.config.altInput) self.altInput.type = "hidden";

			try {
				self.input.parentNode.insertBefore(self.mobileInput, self.input.nextSibling);
			} catch (e) {
				//
			}

			self.mobileInput.addEventListener("change", function (e) {
				self.latestSelectedDateObj = self.parseDate(e.target.value);
				self.setDate(self.latestSelectedDateObj);
				triggerEvent("Change");
				triggerEvent("Close");
			});
		}

		function toggle() {
			if (self.isOpen) self.close();else self.open();
		}

		function triggerEvent(event, data) {
			if (self.config["on" + event]) {
				var hooks = Array.isArray(self.config["on" + event]) ? self.config["on" + event] : [self.config["on" + event]];

				for (var i = 0; i < hooks.length; i++) {
					hooks[i](self.selectedDates, self.input.value, self, data);
				}
			}

			if (event === "Change") {
				if (typeof Event === "function" && Event.constructor) {
					self.input.dispatchEvent(new Event("change", { "bubbles": true }));

					// many front-end frameworks bind to the input event
					self.input.dispatchEvent(new Event("input", { "bubbles": true }));
				} else {
					if (window.document.createEvent !== undefined) return self.input.dispatchEvent(self.changeEvent);

					self.input.fireEvent("onchange");
				}
			}
		}

		function isDateSelected(date) {
			for (var i = 0; i < self.selectedDates.length; i++) {
				if (compareDates(self.selectedDates[i], date) === 0) return "" + i;
			}

			return false;
		}

		function isDateInRange(date) {
			if (self.config.mode !== "range" || self.selectedDates.length < 2) return false;
			return compareDates(date, self.selectedDates[0]) >= 0 && compareDates(date, self.selectedDates[1]) <= 0;
		}

		function updateNavigationCurrentMonth() {
			if (self.config.noCalendar || self.isMobile || !self.monthNav) return;

			self.currentMonthElement.textContent = self.utils.monthToStr(self.currentMonth) + " ";
			self.currentYearElement.value = self.currentYear;

			if (self.config.minDate) {
				var hidePrevMonthArrow = self.currentYear === self.config.minDate.getFullYear() ? self.currentMonth <= self.config.minDate.getMonth() : self.currentYear < self.config.minDate.getFullYear();

				self.prevMonthNav.style.display = hidePrevMonthArrow ? "none" : "block";
			} else self.prevMonthNav.style.display = "block";

			if (self.config.maxDate) {
				var hideNextMonthArrow = self.currentYear === self.config.maxDate.getFullYear() ? self.currentMonth + 1 > self.config.maxDate.getMonth() : self.currentYear > self.config.maxDate.getFullYear();

				self.nextMonthNav.style.display = hideNextMonthArrow ? "none" : "block";
			} else self.nextMonthNav.style.display = "block";
		}

		function updateValue() {
			if (!self.selectedDates.length) return self.clear();

			if (self.isMobile) {
				self.mobileInput.value = self.selectedDates.length ? formatDate(self.mobileFormatStr, self.latestSelectedDateObj) : "";
			}

			var joinChar = self.config.mode !== "range" ? "; " : self.l10n.rangeSeparator;

			self.input.value = self.selectedDates.map(function (dObj) {
				return formatDate(self.config.dateFormat, dObj);
			}).join(joinChar);

			if (self.config.altInput) {
				self.altInput.value = self.selectedDates.map(function (dObj) {
					return formatDate(self.config.altFormat, dObj);
				}).join(joinChar);
			}

			triggerEvent("ValueUpdate");
		}

		function yearScroll(e) {
			e.preventDefault();

			var delta = Math.max(-1, Math.min(1, e.wheelDelta || -e.deltaY)),
			    newYear = parseInt(e.target.value, 10) + delta;

			handleYearChange(newYear);
			e.target.value = self.currentYear;
		}

		function createElement(tag, className, content) {
			var e = window.document.createElement(tag);
			className = className || "";
			content = content || "";

			e.className = className;

			if (content) e.textContent = content;

			return e;
		}

		/* istanbul ignore next */
		function debounce(func, wait, immediate) {
			var timeout = void 0;
			return function () {
				for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
					args[_key] = arguments[_key];
				}

				var context = this;
				var later = function later() {
					timeout = null;
					if (!immediate) func.apply(context, args);
				};

				clearTimeout(timeout);
				timeout = setTimeout(later, wait);
				if (immediate && !timeout) func.apply(context, args);
			};
		}

		function compareDates(date1, date2, timeless) {
			if (!(date1 instanceof Date) || !(date2 instanceof Date)) return false;

			if (timeless !== false) {
				return new Date(date1.getTime()).setHours(0, 0, 0, 0) - new Date(date2.getTime()).setHours(0, 0, 0, 0);
			}

			return date1.getTime() - date2.getTime();
		}

		function timeWrapper(e) {
			e.preventDefault();
			if (e && ((e.target.value || e.target.textContent).length >= 2 || // typed two digits
			e.type !== "keydown" && e.type !== "input" // scroll event
			)) e.target.blur();

			if (self.amPM && e.target === self.amPM) return e.target.textContent = ["AM", "PM"][e.target.textContent === "AM" | 0];

			var min = Number(e.target.min),
			    max = Number(e.target.max),
			    step = Number(e.target.step),
			    curValue = parseInt(e.target.value, 10),
			    delta = Math.max(-1, Math.min(1, e.wheelDelta || -e.deltaY));

			var newValue = Number(curValue);

			switch (e.type) {
				case "wheel":
					newValue = curValue + step * delta;
					break;

				case "keydown":
					newValue = curValue + step * (e.which === 38 ? 1 : -1);
					break;
			}

			if (e.type !== "input" || e.target.value.length === 2) {
				if (newValue < min) {
					newValue = max + newValue + (e.target !== self.hourElement) + (e.target === self.hourElement && !self.amPM);
				} else if (newValue > max) {
					newValue = e.target === self.hourElement ? newValue - max - !self.amPM : min;
				}

				if (self.amPM && e.target === self.hourElement && (step === 1 ? newValue + curValue === 23 : Math.abs(newValue - curValue) > step)) self.amPM.textContent = self.amPM.textContent === "PM" ? "AM" : "PM";

				e.target.value = self.pad(newValue);
			} else e.target.value = newValue;
		}

		init();
		return self;
	}

	/* istanbul ignore next */
	Flatpickr.defaultConfig = {

		mode: "single",

		/* if true, dates will be parsed, formatted, and displayed in UTC.
	 preloading date strings w/ timezones is recommended but not necessary */
		utc: false,

		// wrap: see https://chmln.github.io/flatpickr/#strap
		wrap: false,

		// enables week numbers
		weekNumbers: false,

		// allow manual datetime input
		allowInput: false,

		/*
	 	clicking on input opens the date(time)picker.
	 	disable if you wish to open the calendar manually with .open()
	 */
		clickOpens: true,

		// display time picker in 24 hour mode
		time_24hr: false,

		// enables the time picker functionality
		enableTime: false,

		// noCalendar: true will hide the calendar. use for a time picker along w/ enableTime
		noCalendar: false,

		// more date format chars at https://chmln.github.io/flatpickr/#dateformat
		dateFormat: "Y-m-d",

		// altInput - see https://chmln.github.io/flatpickr/#altinput
		altInput: false,

		// the created altInput element will have this class.
		altInputClass: "flatpickr-input form-control input",

		// same as dateFormat, but for altInput
		altFormat: "F j, Y", // defaults to e.g. June 10, 2016

		// defaultDate - either a datestring or a date object. used for datetimepicker"s initial value
		defaultDate: null,

		// the minimum date that user can pick (inclusive)
		minDate: null,

		// the maximum date that user can pick (inclusive)
		maxDate: null,

		// dateparser that transforms a given string to a date object
		parseDate: null,

		// dateformatter that transforms a given date object to a string, according to passed format
		formatDate: null,

		getWeek: function getWeek(givenDate) {
			var date = new Date(givenDate.getTime());
			date.setHours(0, 0, 0, 0);

			// Thursday in current week decides the year.
			date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
			// January 4 is always in week 1.
			var week1 = new Date(date.getFullYear(), 0, 4);
			// Adjust to Thursday in week 1 and count number of weeks from date to week1.
			return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7);
		},

		// see https://chmln.github.io/flatpickr/#disable
		enable: [],

		// see https://chmln.github.io/flatpickr/#disable
		disable: [],

		// display the short version of month names - e.g. Sep instead of September
		shorthandCurrentMonth: false,

		// displays calendar inline. see https://chmln.github.io/flatpickr/#inline-calendar
		inline: false,

		// position calendar inside wrapper and next to the input element
		// leave at false unless you know what you"re doing
		static: false,

		// DOM node to append the calendar to in *static* mode
		appendTo: null,

		// code for previous/next icons. this is where you put your custom icon code e.g. fontawesome
		prevArrow: "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M5.207 8.471l7.146 7.147-0.707 0.707-7.853-7.854 7.854-7.853 0.707 0.707-7.147 7.146z' /></svg>",
		nextArrow: "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M13.207 8.472l-7.854 7.854-0.707-0.707 7.146-7.146-7.146-7.148 0.707-0.707 7.854 7.854z' /></svg>",

		// enables seconds in the time picker
		enableSeconds: false,

		// step size used when scrolling/incrementing the hour element
		hourIncrement: 1,

		// step size used when scrolling/incrementing the minute element
		minuteIncrement: 5,

		// initial value in the hour element
		defaultHour: 12,

		// initial value in the minute element
		defaultMinute: 0,

		// disable native mobile datetime input support
		disableMobile: false,

		// default locale
		locale: "default",

		// onChange callback when user selects a date or time
		onChange: null, // function (dateObj, dateStr) {}

		// called every time calendar is opened
		onOpen: null, // function (dateObj, dateStr) {}

		// called every time calendar is closed
		onClose: null, // function (dateObj, dateStr) {}

		// called after calendar is ready
		onReady: null, // function (dateObj, dateStr) {}

		onValueUpdate: null,

		onDayCreate: null
	};

	/* istanbul ignore next */
	Flatpickr.l10ns = {
		en: {
			weekdays: {
				shorthand: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
				longhand: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
			},
			months: {
				shorthand: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				longhand: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
			},
			daysInMonth: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
			firstDayOfWeek: 0,
			ordinal: function ordinal(nth) {
				var s = nth % 100;
				if (s > 3 && s < 21) return "th";
				switch (s % 10) {
					case 1:
						return "st";
					case 2:
						return "nd";
					case 3:
						return "rd";
					default:
						return "th";
				}
			},
			rangeSeparator: " to ",
			weekAbbreviation: "Wk",
			scrollTitle: "Scroll to increment",
			toggleTitle: "Click to toggle"
		}
	};

	Flatpickr.l10ns.default = Object.create(Flatpickr.l10ns.en);
	Flatpickr.localize = function (l10n) {
		return _extends(Flatpickr.l10ns.default, l10n || {});
	};
	Flatpickr.setDefaults = function (config) {
		return _extends(Flatpickr.defaultConfig, config || {});
	};

	Flatpickr.prototype = {
		pad: function pad(number) {
			return ("0" + number).slice(-2);
		},
		parseDate: function parseDate(date, timeless) {
			if (!date) return null;

			var dateTimeRegex = /(\d+)/g,
			    timeRegex = /^(\d{1,2})[:\s](\d\d)?[:\s]?(\d\d)?\s?(a|p)?/i,
			    timestamp = /^(\d+)$/g,
			    date_orig = date;

			if (date.toFixed || timestamp.test(date)) // timestamp
				date = new Date(date);else if (typeof date === "string") {
				date = date.trim();

				if (date === "today") {
					date = new Date();
					timeless = true;
				} else if (this.config && this.config.parseDate) date = this.config.parseDate(date);else if (timeRegex.test(date)) {
					// time picker
					var m = date.match(timeRegex),
					    hours = !m[4] ? m[1] // military time, no conversion needed
					: m[1] % 12 + (m[4].toLowerCase() === "p" ? 12 : 0); // am/pm

					date = new Date();
					date.setHours(hours, m[2] || 0, m[3] || 0);
				} else if (/Z$/.test(date) || /GMT$/.test(date)) // datestrings w/ timezone
					date = new Date(date);else if (dateTimeRegex.test(date) && /^[0-9]/.test(date)) {
					var d = date.match(dateTimeRegex);
					date = new Date(d[0] + "/" + (d[1] || 1) + "/" + (d[2] || 1) + " " + (d[3] || 0) + ":" + (d[4] || 0) + ":" + (d[5] || 0));
				} else // fallback
					date = new Date(date);
			} else if (date instanceof Date) date = new Date(date.getTime()); // create a copy

			if (!(date instanceof Date)) {
				console.warn("flatpickr: invalid date " + date_orig);
				console.info(this.element);
				return null;
			}

			if (this.config && this.config.utc && !date.fp_isUTC) date = date.fp_toUTC();

			if (timeless === true) date.setHours(0, 0, 0, 0);

			return date;
		}
	};

	function _flatpickr(nodeList, config) {
		var nodes = Array.prototype.slice.call(nodeList); // static list
		var instances = [];
		for (var i = 0; i < nodes.length; i++) {
			try {
				nodes[i]._flatpickr = new Flatpickr(nodes[i], config || {});
				instances.push(nodes[i]._flatpickr);
			} catch (e) {
				console.warn(e, e.stack);
			}
		}

		return instances.length === 1 ? instances[0] : instances;
	}

	if (typeof HTMLElement !== "undefined") {
		// browser env
		HTMLCollection.prototype.flatpickr = NodeList.prototype.flatpickr = function (config) {
			return _flatpickr(this, config);
		};

		HTMLElement.prototype.flatpickr = function (config) {
			return _flatpickr([this], config);
		};
	}

	function flatpickr(selector, config) {
		return _flatpickr(window.document.querySelectorAll(selector), config);
	}

	if (typeof jQuery !== "undefined") {
		jQuery.fn.flatpickr = function (config) {
			return _flatpickr(this, config);
		};
	}

	Date.prototype.fp_incr = function (days) {
		return new Date(this.getFullYear(), this.getMonth(), this.getDate() + parseInt(days, 10));
	};

	Date.prototype.fp_isUTC = false;
	Date.prototype.fp_toUTC = function () {
		var newDate = new Date(this.getUTCFullYear(), this.getUTCMonth(), this.getUTCDate(), this.getUTCHours(), this.getUTCMinutes(), this.getUTCSeconds());

		newDate.fp_isUTC = true;
		return newDate;
	};

	// IE9 classList polyfill
	/* istanbul ignore next */
	if (!window.document.documentElement.classList && Object.defineProperty && typeof HTMLElement !== "undefined") {
		Object.defineProperty(HTMLElement.prototype, "classList", {
			get: function get() {
				var self = this;
				function update(fn) {
					return function (value) {
						var classes = self.className.split(/\s+/),
						    index = classes.indexOf(value);

						fn(classes, index, value);
						self.className = classes.join(" ");
					};
				}

				var ret = {
					add: update(function (classes, index, value) {
						if (!~index) classes.push(value);
					}),

					remove: update(function (classes, index) {
						if (~index) classes.splice(index, 1);
					}),

					toggle: update(function (classes, index, value) {
						if (~index) classes.splice(index, 1);else classes.push(value);
					}),

					contains: function contains(value) {
						return !!~self.className.split(/\s+/).indexOf(value);
					},

					item: function item(i) {
						return self.className.split(/\s+/)[i] || null;
					}
				};

				Object.defineProperty(ret, "length", {
					get: function get() {
						return self.className.split(/\s+/).length;
					}
				});

				return ret;
			}
		});
	}

	if (true) module.exports = Flatpickr;


/***/ },

/***/ 523:
/***/ function(module, exports, __webpack_require__) {

	/* Mandarin locals for flatpickr */
	var Flatpickr = Flatpickr || { l10ns: {} };
	Flatpickr.l10ns.zh = {};

	Flatpickr.l10ns.zh.weekdays = {
		shorthand: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
		longhand: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六']
	};

	Flatpickr.l10ns.zh.months = {
		shorthand: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
		longhand: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
	};

	if (true) {
		module.exports = Flatpickr.l10ns;
	}

/***/ },

/***/ 524:
/***/ function(module, exports, __webpack_require__) {

	module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('input', {
	    directives: [{
	      name: "myflatpickr",
	      rawName: "v-myflatpickr",
	      value: (_vm.options),
	      expression: "options"
	    }],
	    staticClass: "font-14 c-pointer text-center",
	    attrs: {
	      "id": "co-seldate",
	      "type": "text",
	      "placeholder": _vm.placeholder
	    },
	    on: {
	      "input": _vm.updateInput
	    }
	  })
	},staticRenderFns: []}
	module.exports.render._withStripped = true
	if (false) {
	  module.hot.accept()
	  if (module.hot.data) {
	     require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-f6d9d25a", module.exports)
	  }
	}

/***/ },

/***/ 551:
/***/ function(module, exports, __webpack_require__) {

	var __vue_exports__, __vue_options__
	var __vue_styles__ = {}

	/* styles */
	__webpack_require__(552)

	/* script */
	__vue_exports__ = __webpack_require__(554)

	/* template */
	var __vue_template__ = __webpack_require__(555)
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
	__vue_options__.__file = "E:\\www\\pro\\liveManager\\webadmin\\src\\view\\live\\view\\ystlanchor.page.vue"
	__vue_options__.render = __vue_template__.render
	__vue_options__.staticRenderFns = __vue_template__.staticRenderFns
	__vue_options__._scopeId = "data-v-123485ae"

	/* hot reload */
	if (false) {(function () {
	  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  module.hot.accept()
	  if (!module.hot.data) {
	    hotAPI.createRecord("data-v-123485ae", __vue_options__)
	  } else {
	    hotAPI.reload("data-v-123485ae", __vue_options__)
	  }
	})()}
	if (__vue_options__.functional) {console.error("[vue-loader] ystlanchor.page.vue: functional components are not supported and should be defined in plain js files using render functions.")}

	module.exports = __vue_exports__


/***/ },

/***/ 552:
/***/ function(module, exports, __webpack_require__) {

	// style-loader: Adds some css to the DOM by adding a <style> tag

	// load the styles
	var content = __webpack_require__(553);
	if(typeof content === 'string') content = [[module.id, content, '']];
	// add the styles to the DOM
	var update = __webpack_require__(32)(content, {});
	if(content.locals) module.exports = content.locals;
	// Hot Module Replacement
	if(false) {
		// When the styles change, update the <style> tags
		if(!content.locals) {
			module.hot.accept("!!./../../../../node_modules/.0.26.1@css-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-123485ae&scoped=true!./../../../../node_modules/.2.2.3@less-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./ystlanchor.page.vue", function() {
				var newContent = require("!!./../../../../node_modules/.0.26.1@css-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-123485ae&scoped=true!./../../../../node_modules/.2.2.3@less-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./ystlanchor.page.vue");
				if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
				update(newContent);
			});
		}
		// When the module is disposed, remove the <style> tags
		module.hot.dispose(function() { update(); });
	}

/***/ },

/***/ 553:
/***/ function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(4)();
	// imports


	// module
	exports.push([module.id, "\n#p-ystlanchor[data-v-123485ae] {\n  /*头部样式*/\n  /*内部样式*/\n}\n#p-ystlanchor .ys-header[data-v-123485ae] {\n  height: 50px;\n  background: #fff;\n}\n#p-ystlanchor .ys-header .title[data-v-123485ae] {\n  margin-left: 20px;\n  line-height: 50px;\n}\n#p-ystlanchor .ys-header .seldate[data-v-123485ae] {\n  width: 118px;\n  height: 28px;\n  margin-top: 11px;\n  margin-right: 20px;\n  background: #f7f7f7;\n  border-radius: 18px;\n}\n#p-ystlanchor .ys-header .sel-input[data-v-123485ae] {\n  width: 100%;\n  height: 14px;\n  padding: 7px 0;\n  color: #05bcd4;\n  background: transparent;\n}\n#p-ystlanchor .ys-main[data-v-123485ae] {\n  margin: 20px;\n  background: #fff;\n}\n#p-ystlanchor .table-tr[data-v-123485ae] {\n  height: 78px;\n  border-bottom: 1px solid #eaeaea;\n}\n#p-ystlanchor .table-tr[data-v-123485ae]:hover {\n  transition: all .2s;\n  border-bottom-color: #fff;\n  box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.3);\n}\n#p-ystlanchor .table-th[data-v-123485ae]:nth-child(1),\n#p-ystlanchor .table-td[data-v-123485ae]:nth-child(1) {\n  width: 36%;\n}\n#p-ystlanchor .table-th[data-v-123485ae]:nth-child(2),\n#p-ystlanchor .table-td[data-v-123485ae]:nth-child(2) {\n  width: 19%;\n}\n#p-ystlanchor .table-th[data-v-123485ae]:nth-child(3),\n#p-ystlanchor .table-td[data-v-123485ae]:nth-child(3) {\n  width: 20%;\n}\n#p-ystlanchor .table-th[data-v-123485ae]:nth-child(4),\n#p-ystlanchor .table-td[data-v-123485ae]:nth-child(4) {\n  width: 10%;\n}\n#p-ystlanchor .table-th[data-v-123485ae]:nth-child(5),\n#p-ystlanchor .table-td[data-v-123485ae]:nth-child(5) {\n  width: 15%;\n}\n#p-ystlanchor .table-th[data-v-123485ae] {\n  height: 56px;\n  line-height: 56px;\n  border-bottom: 2px solid #eaeaea;\n}\n#p-ystlanchor .table-td[data-v-123485ae] {\n  line-height: 78px;\n}\n#p-ystlanchor .table-td img[data-v-123485ae] {\n  width: 52px;\n  height: 52px;\n  color: #333c44;\n  margin-top: 12px;\n  margin-left: 20px;\n}\n#p-ystlanchor .table-td .username[data-v-123485ae] {\n  margin-left: 93px;\n}\n#p-ystlanchor .table-td .game[data-v-123485ae] {\n  height: 27px;\n  margin-top: 11px;\n  line-height: 27px;\n}\n#p-ystlanchor .table-td .rmb[data-v-123485ae] {\n  height: 25px;\n  color: #aaa;\n  line-height: 25px;\n}\n#p-ystlanchor .table-footer[data-v-123485ae] {\n  height: 72px;\n}\n", ""]);

	// exports


/***/ },

/***/ 554:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _pages = __webpack_require__(493);

	var _pages2 = _interopRequireDefault(_pages);

	var _seldate = __webpack_require__(518);

	var _seldate2 = _interopRequireDefault(_seldate);

	var _container = __webpack_require__(80);

	var _container2 = _interopRequireDefault(_container);

	var _morhFilter = __webpack_require__(487);

	var _seturlService = __webpack_require__(486);

	var _dateFilter = __webpack_require__(39);

	var _pageloadingService = __webpack_require__(47);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	// 昨天时间：年-月-日
	var ysDayTime = (0, _dateFilter.dateNumFilter)(Date.parse(new Date()) - 86400000, 'yyyy-MM-dd');

	// 请求上播时长最高主播数据
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

	var postMaxLive = function postMaxLive(API, vm) {
	    var query = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
	    var cb = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : function () {};


	    query = Object.assign({
	        startTime: ysDayTime
	    }, query);

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
	        dateCF: { // 时间组件配置
	            mode: 'single', //—— 选择的模式
	            maxDate: ysDayTime },
	        currDate: ysDayTime, // 时间组件当前选择的时间
	        index: 1, // 当前的页码
	        limit: 10, // 翻页的条数
	        total: 10, // 总条数
	        ysMaxLive: [] // 当前上播时长最高主播数据
	    };
	};

	// 方法集合
	var methods = {
	    // 修改日期
	    updateDate: function updateDate(dateStr) {
	        var _this = this;

	        // 当前选择的时间 和 日期控件选择的时间不一致才会执行
	        if (dateStr !== this.currDate) {
	            (function () {
	                var vm = _this,
	                    API_MAXLIVE = vm.$store.state.api.todayall.maxLive;

	                // 修改当前选择时间
	                _this.currDate = dateStr;

	                // 打开遮罩层
	                (0, _pageloadingService.openPgloading)();

	                // 发起请求
	                postMaxLive(API_MAXLIVE, vm, {
	                    startTime: dateStr,
	                    total: vm.limit,
	                    page: 1
	                }, function (pageNum, data) {
	                    vm.index = 1;
	                    vm.total = vm.limit * pageNum;
	                    vm.ysMaxLive = data;
	                });
	            })();
	        };
	    },

	    // 切换分页
	    switchPage: function switchPage(index) {
	        var vm = this,
	            API_MAXLIVE = vm.$store.state.api.todayall.maxLive;

	        // 打开遮罩层
	        (0, _pageloadingService.openPgloading)();

	        // 请求数据
	        postMaxLive(API_MAXLIVE, vm, {
	            total: vm.limit,
	            page: index
	        }, function (pageNum, data) {
	            vm.index = index;
	            vm.ysMaxLive = data;
	        });
	    }
	};

	// 过滤器集合
	var filters = {
	    // 分或小时
	    morh: _morhFilter.morh
	};

	// 计算属性集合
	var computed = {
	    // 备用的头像url
	    spareUrl: function spareUrl() {
	        return (0, _seturlService.setUrl)('/webadmin/static/images/anchor-default-img.png');
	    }
	};

	// 组件集合
	var components = {
	    coPages: _pages2.default,
	    coSeldate: _seldate2.default,
	    coContainer: _container2.default
	};

	// 组件创建完成后的钩子
	// 这里获取到页面渲染所需的数据
	var created = function created() {
	    var vm = this,
	        API_MAXLIVE = vm.$store.state.api.todayall.maxLive;

	    // 发起请求
	    postMaxLive(API_MAXLIVE, vm, {
	        total: vm.limit,
	        page: vm.index
	    }, function (pageNum, data) {
	        vm.total = vm.limit * pageNum;
	        vm.ysMaxLive = data;
	    });
	};

	// vm对象
	var vm = {
	    name: 'p-ystlanchor',
	    data: data,
	    methods: methods,
	    filters: filters,
	    computed: computed,
	    components: components,
	    created: created
	};

	// 暴露组件配置
	exports.default = vm;

/***/ },

/***/ 555:
/***/ function(module, exports, __webpack_require__) {

	module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('div', {
	    attrs: {
	      "id": "p-ystlanchor"
	    }
	  }, [_c('header', {
	    staticClass: "ys-header"
	  }, [_c('span', {
	    staticClass: "title h-100 font-18 font-bold fl"
	  }, [_vm._v("昨日上播时常最高主播")]), _vm._v(" "), _c('div', {
	    staticClass: "seldate font-14 fr"
	  }, [_c('co-seldate', {
	    staticClass: "sel-input",
	    attrs: {
	      "options": _vm.dateCF,
	      "placeholder": _vm.currDate
	    },
	    on: {
	      "updateDate": _vm.updateDate
	    }
	  })], 1)]), _vm._v(" "), _c('section', {
	    staticClass: "ys-main"
	  }, [_vm._m(0), _vm._v(" "), _c('co-container', {
	    attrs: {
	      "isShow": _vm.ysMaxLive.length === 0,
	      "h": "300px"
	    }
	  }, [_c('ul', {
	    staticClass: "table-tbody"
	  }, _vm._l((_vm.ysMaxLive), function(item) {
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
	     require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-123485ae", module.exports)
	  }
	}

/***/ }

});