webpackJsonp([21,24],{

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

/***/ 607:
/***/ function(module, exports, __webpack_require__) {

	var __vue_exports__, __vue_options__
	var __vue_styles__ = {}

	/* styles */
	__webpack_require__(608)

	/* script */
	__vue_exports__ = __webpack_require__(610)

	/* template */
	var __vue_template__ = __webpack_require__(611)
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
	__vue_options__.__file = "E:\\www\\pro\\liveManager\\webadmin\\src\\view\\guild\\view\\levelset.page.vue"
	__vue_options__.render = __vue_template__.render
	__vue_options__.staticRenderFns = __vue_template__.staticRenderFns
	__vue_options__._scopeId = "data-v-03adb1f2"

	/* hot reload */
	if (false) {(function () {
	  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  module.hot.accept()
	  if (!module.hot.data) {
	    hotAPI.createRecord("data-v-03adb1f2", __vue_options__)
	  } else {
	    hotAPI.reload("data-v-03adb1f2", __vue_options__)
	  }
	})()}
	if (__vue_options__.functional) {console.error("[vue-loader] levelset.page.vue: functional components are not supported and should be defined in plain js files using render functions.")}

	module.exports = __vue_exports__


/***/ },

/***/ 608:
/***/ function(module, exports, __webpack_require__) {

	// style-loader: Adds some css to the DOM by adding a <style> tag

	// load the styles
	var content = __webpack_require__(609);
	if(typeof content === 'string') content = [[module.id, content, '']];
	// add the styles to the DOM
	var update = __webpack_require__(32)(content, {});
	if(content.locals) module.exports = content.locals;
	// Hot Module Replacement
	if(false) {
		// When the styles change, update the <style> tags
		if(!content.locals) {
			module.hot.accept("!!./../../../../node_modules/.0.26.1@css-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-03adb1f2&scoped=true!./../../../../node_modules/.2.2.3@less-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./levelset.page.vue", function() {
				var newContent = require("!!./../../../../node_modules/.0.26.1@css-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/style-rewriter.js?id=data-v-03adb1f2&scoped=true!./../../../../node_modules/.2.2.3@less-loader/index.js!./../../../../node_modules/.10.0.2@vue-loader/lib/selector.js?type=styles&index=0!./levelset.page.vue");
				if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
				update(newContent);
			});
		}
		// When the module is disposed, remove the <style> tags
		module.hot.dispose(function() { update(); });
	}

/***/ },

/***/ 609:
/***/ function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(4)();
	// imports


	// module
	exports.push([module.id, "\n#p_levelset[data-v-03adb1f2] {\n  /*头部样式*/\n  /*功能块样式*/\n  /*表格样式*/\n  /*弹出框样式*/\n}\n#p_levelset .header[data-v-03adb1f2] {\n  height: 50px;\n  background: #fff;\n}\n#p_levelset .header .title[data-v-03adb1f2] {\n  margin-left: 20px;\n  line-height: 50px;\n}\n#p_levelset .fn-block[data-v-03adb1f2] {\n  height: 50px;\n  margin: 20px;\n  line-height: 50px;\n  background: #fff;\n}\n#p_levelset .fn-block .btn-add[data-v-03adb1f2] {\n  width: 24px;\n  height: 24px;\n  line-height: 25px;\n  vertical-align: middle;\n  background: #05bcd4;\n}\n#p_levelset .fn-block p[data-v-03adb1f2] {\n  color: #05bcd4;\n  vertical-align: middle;\n}\n#p_levelset .table[data-v-03adb1f2] {\n  margin: 20px;\n  background: #fff;\n}\n#p_levelset .table .table-thead[data-v-03adb1f2] {\n  height: 56px;\n  border-bottom: 2px solid #eaeaea;\n}\n#p_levelset .table .table-tr[data-v-03adb1f2] {\n  height: 78px;\n  border-bottom: 1px solid #eaeaea;\n}\n#p_levelset .table .table-th[data-v-03adb1f2]:nth-child(1),\n#p_levelset .table .table-td[data-v-03adb1f2]:nth-child(1) {\n  width: 20%;\n}\n#p_levelset .table .table-th[data-v-03adb1f2]:nth-child(2),\n#p_levelset .table .table-td[data-v-03adb1f2]:nth-child(2) {\n  width: 20%;\n}\n#p_levelset .table .table-th[data-v-03adb1f2]:nth-child(3),\n#p_levelset .table .table-td[data-v-03adb1f2]:nth-child(3) {\n  width: 20%;\n}\n#p_levelset .table .table-th[data-v-03adb1f2]:nth-child(4),\n#p_levelset .table .table-td[data-v-03adb1f2]:nth-child(4) {\n  width: 20%;\n}\n#p_levelset .table .table-th[data-v-03adb1f2]:nth-child(5),\n#p_levelset .table .table-td[data-v-03adb1f2]:nth-child(5) {\n  width: 20%;\n}\n#p_levelset .table .table-th[data-v-03adb1f2] {\n  line-height: 56px;\n}\n#p_levelset .table .table-td[data-v-03adb1f2] {\n  line-height: 78px;\n  color: #333c44;\n}\n#p_levelset .table .table-td .btn-edit[data-v-03adb1f2],\n#p_levelset .table .table-td .btn-del[data-v-03adb1f2] {\n  color: #05bcd4;\n}\n#p_levelset .table .table-td .btn-edit[data-v-03adb1f2] {\n  padding-right: 10px;\n}\n#p_levelset .table .table-footer[data-v-03adb1f2] {\n  height: 72px;\n}\n#p_levelset .pupup-title-slot[data-v-03adb1f2] {\n  color: #81868b;\n}\n#p_levelset .pupup-main-slot .ly-input[data-v-03adb1f2] {\n  width: 298px;\n  height: 48px;\n  border: 1px solid #05bcd4;\n  border-radius: 6px;\n}\n#p_levelset .pupup-main-slot label[data-v-03adb1f2] {\n  padding: 0 11px;\n  line-height: 48px;\n}\n#p_levelset .pupup-main-slot #agent_user[data-v-03adb1f2] {\n  width: 238px;\n  padding: 16px 0;\n  height: 16px;\n}\n#p_levelset .edit-cont[data-v-03adb1f2] {\n  height: 45px;\n}\n#p_levelset .edit-label[data-v-03adb1f2] {\n  width: 80px;\n  padding-right: 10px;\n}\n#p_levelset .edit-input[data-v-03adb1f2] {\n  width: 180px;\n  height: 30px;\n  color: #000;\n  line-height: 30px;\n  text-indent: 1em;\n  border: 1px solid #05bcd4;\n  border-radius: 6px;\n}\n#p_levelset .edit-input[readonly][data-v-03adb1f2] {\n  color: #757b81;\n}\n", ""]);

	// exports


/***/ },

/***/ 610:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _pages = __webpack_require__(493);

	var _pages2 = _interopRequireDefault(_pages);

	var _popup = __webpack_require__(57);

	var _popup2 = _interopRequireDefault(_popup);

	var _morhFilter = __webpack_require__(487);

	var _pageloadingService = __webpack_require__(47);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	// 请求主播等级列表
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//

	var postLevelList = function postLevelList(API, vm, cb) {
	    vm.$http.post(API, {
	        page: vm.pagesOp.index
	    }).then(function (_ref) {
	        var _ref$body$data = _ref.body.data,
	            pageNum = _ref$body$data.pageNum,
	            data = _ref$body$data.data;

	        // 挂载数据
	        vm.levelS = data;

	        // 如果回调存在执行回调
	        if (cb) cb(pageNum);
	    }, function (_ref2) {
	        var msg = _ref2.body.msg;
	        return console.log(msg);
	    });
	};

	// data
	var data = function data() {
	    return {
	        pagesOp: { // 经纪人分页配置
	            index: 1, //—— 当前的页码
	            limit: 10, //—— 翻页的条数
	            total: 10 },
	        popupOp: { // 弹出框配置
	            show: false, //—— 是否弹出框
	            content: null, //—— 弹出框的文本内容
	            btnCon: { //—— 确认按钮配置
	                show: true, //—— 是否显示按钮
	                text: '确定', //—— 按钮名称
	                cb: function cb(vm, next) {
	                    //—— 执行函数内部的next回调
	                    console.log(vm.popupOp.content);

	                    next();
	                }
	            },
	            btnCan: { //—— 取消按钮配置
	                show: true, //—— 是否显示按钮
	                text: '取消', //—— 按钮名称
	                cb: function cb(vm, next) {
	                    return next();
	                } //—— 执行函数内部的next回调
	            }
	        },
	        addForm: {
	            name: null, // 等级名称
	            month_income: null, // 月收入
	            day_work: null, // 日时长
	            moth_work: null, // 月时长
	            day_income: null // 日收入
	        },
	        editForm: {},
	        levelS: [] };
	};

	// 方法集合
	var methods = {
	    // 切换分页
	    switchPage: function switchPage(index) {
	        var vm = this,
	            API_ALLLEVELLIST = vm.$store.state.api.guild.allLevelList;

	        // 打开加载层
	        (0, _pageloadingService.openPgloading)();

	        vm.pagesOp.index = index;

	        // 请求分页数据
	        postLevelList(API_ALLLEVELLIST, vm, function () {
	            // 关闭弹出层
	            (0, _pageloadingService.closePgloading)();
	        });
	    },

	    // 添加等级
	    addAgent: function addAgent() {
	        this.popupOp.show = true;
	        this.popupOp.showCont = '添加';
	        this.popupOp.btnCon.cb = function (vm, next) {
	            var _vm$addForm = vm.addForm,
	                name = _vm$addForm.name,
	                day_income = _vm$addForm.day_income,
	                month_income = _vm$addForm.month_income,
	                day_work = _vm$addForm.day_work,
	                moth_work = _vm$addForm.moth_work,
	                _vm$$store$state$api$ = vm.$store.state.api.guild,
	                API_ALLLEVEL = _vm$$store$state$api$.addLevel,
	                API_ALLLEVELLIST = _vm$$store$state$api$.allLevelList;


	            if (name && day_income && month_income && day_work && moth_work) {

	                // 开启加载层
	                (0, _pageloadingService.openPgloading)();

	                // 添加主播
	                vm.$http.post(API_ALLLEVEL, {
	                    name: name, day_income: day_income, month_income: month_income, day_work: day_work, moth_work: moth_work
	                }).then(function (_ref3) {
	                    var data = _ref3.body.data;

	                    if (data) {
	                        alert('添加成功!');

	                        vm.pagesOp.index = 1;

	                        // 刷新签约主播列表
	                        postLevelList(API_ALLLEVELLIST, vm, function (pageNum) {
	                            vm.pagesOp.total = vm.pagesOp.limit * pageNum;

	                            // 关闭弹出层
	                            (0, _pageloadingService.closePgloading)();
	                        });
	                    } else {
	                        alert('添加失败!');

	                        // 关闭弹出层
	                        (0, _pageloadingService.closePgloading)();
	                    };
	                }, function (_ref4) {
	                    var msg = _ref4.body.msg;
	                    return console.log(msg);
	                });
	            };

	            next();
	        };
	    },

	    // 编辑等级
	    editAgent: function editAgent(info) {
	        this.editForm = info;
	        this.popupOp.show = true;
	        this.popupOp.showCont = '编辑';
	        this.popupOp.btnCon.cb = function (vm, next) {
	            var _vm$$store$state$api$2 = vm.$store.state.api.guild,
	                API_EDITLEVEL = _vm$$store$state$api$2.editLevel,
	                API_ALLLEVELLIST = _vm$$store$state$api$2.allLevelList;

	            // 开启加载层

	            (0, _pageloadingService.openPgloading)();

	            // 编辑经纪人
	            vm.$http.post(API_EDITLEVEL, {
	                leveid: info.id,
	                monthincome: info.month_income,
	                daywork: info.day_work,
	                monthwork: info.month_work,
	                dayincome: info.day_income
	            }).then(function (_ref5) {
	                var data = _ref5.body.data;


	                if (data) {
	                    alert('修改成功!');

	                    vm.pagesOp.index = 1;

	                    // 刷新签约主播列表
	                    postLevelList(API_ALLLEVELLIST, vm, function (pageNum) {
	                        vm.pagesOp.total = vm.pagesOp.limit * pageNum;

	                        // 关闭弹出层
	                        (0, _pageloadingService.closePgloading)();
	                    });
	                } else {
	                    alert('修改失败!');

	                    // 关闭弹出层
	                    (0, _pageloadingService.closePgloading)();
	                };
	            }, function (_ref6) {
	                var msg = _ref6.body.msg;
	                return console.log(msg);
	            });

	            next();
	        };
	    },

	    // 删除等级
	    delLevel: function delLevel(info) {
	        this.editForm = info;
	        this.popupOp.show = true;
	        this.popupOp.showCont = '删除';
	        this.popupOp.btnCon.cb = function (vm, next) {
	            var _vm$$store$state$api$3 = vm.$store.state.api.guild,
	                API_DELLEVEL = _vm$$store$state$api$3.delLevel,
	                API_ALLLEVELLIST = _vm$$store$state$api$3.allLevelList;

	            // 开启加载层

	            (0, _pageloadingService.openPgloading)();

	            // 删除等级
	            vm.$http.post(API_DELLEVEL, {
	                levelid: info.id
	            }).then(function (_ref7) {
	                var data = _ref7.body.data;


	                if (data) {
	                    alert('删除成功!');

	                    vm.pagesOp.index = 1;

	                    // 刷新签约主播列表
	                    postLevelList(API_ALLLEVELLIST, vm, function (pageNum) {
	                        vm.pagesOp.total = vm.pagesOp.limit * pageNum;

	                        // 关闭弹出层
	                        (0, _pageloadingService.closePgloading)();
	                    });
	                } else {
	                    alert('删除失败!');

	                    // 关闭弹出层
	                    (0, _pageloadingService.closePgloading)();
	                };
	            }, function (_ref8) {
	                var msg = _ref8.body.msg;
	                return console.log(msg);
	            });

	            next();
	        };
	    },

	    // 是否关闭弹出框
	    // 如果组件内部返回false就是关闭遮罩层
	    isClosePopup: function isClosePopup(close) {
	        if (!close) this.popupOp.show = false;
	    }
	};

	// 过滤器集合
	var filters = {
	    // 分或小时
	    morh: _morhFilter.morh
	};

	// 引用组件
	var components = { coPages: _pages2.default, coPopup: _popup2.default };

	// 组件创建完成后的钩子
	// 这里获取到页面渲染所需的数据
	var created = function created() {
	    var vm = this,
	        API_ALLLEVELLIST = vm.$store.state.api.guild.allLevelList;

	    // 获取主播等级列表
	    postLevelList(API_ALLLEVELLIST, vm, function (pageNum) {
	        vm.pagesOp.total = vm.pagesOp.limit * pageNum;

	        // 关闭遮罩层
	        (0, _pageloadingService.closePgloading)();
	    });
	};

	// 暴露组件配置
	exports.default = Object.assign({ name: 'p_levelset' }, { data: data, methods: methods, filters: filters, components: components, created: created });

/***/ },

/***/ 611:
/***/ function(module, exports, __webpack_require__) {

	module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('div', {
	    attrs: {
	      "id": "p_levelset"
	    }
	  }, [_vm._m(0), _vm._v(" "), _c('section', {
	    staticClass: "fn-block text-center"
	  }, [_c('span', {
	    staticClass: "btn btn-di btn-add arc",
	    on: {
	      "click": _vm.addAgent
	    }
	  }, [_c('span', {
	    staticClass: "ico icon-add color-white"
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "di font-16 c-pointer",
	    on: {
	      "click": _vm.addAgent
	    }
	  }, [_vm._v("添加级别")])]), _vm._v(" "), _c('section', {
	    staticClass: "table"
	  }, [_vm._m(1), _vm._v(" "), _c('ul', {
	    staticClass: "table-tbody"
	  }, _vm._l((_vm.levelS), function(item) {
	    return _c('li', {
	      staticClass: "table-tr clear"
	    }, [_c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v(_vm._s(item.name))]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v(_vm._s(item.month_income) + "元")]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v(_vm._s(_vm._f("morh")(item.day_work)))]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_vm._v(_vm._s(_vm._f("morh")(item.month_work)))]), _vm._v(" "), _c('div', {
	      staticClass: "table-td h-100 font-16 text-center text-hidden fl"
	    }, [_c('span', {
	      staticClass: "btn btn-edit btn-di",
	      on: {
	        "click": function($event) {
	          _vm.editAgent(item)
	        }
	      }
	    }, [_vm._v("编辑")]), _vm._v(" "), _c('span', {
	      staticClass: "btn btn-del btn-di",
	      on: {
	        "click": function($event) {
	          _vm.delLevel(item)
	        }
	      }
	    }, [_vm._v("删除")])])])
	  })), _vm._v(" "), _c('div', {
	    staticClass: "table-footer"
	  }, [_c('co-pages', {
	    attrs: {
	      "index": _vm.pagesOp.index,
	      "limit": _vm.pagesOp.limit,
	      "total": _vm.pagesOp.total
	    },
	    on: {
	      "switchPage": _vm.switchPage
	    }
	  })], 1)]), _vm._v(" "), _c('co-popup', {
	    attrs: {
	      "openPopup": _vm.popupOp.show,
	      "btnCon": _vm.popupOp.btnCon,
	      "btnCan": _vm.popupOp.btnCan
	    },
	    on: {
	      "closePopup": _vm.isClosePopup
	    }
	  }, [(_vm.popupOp.showCont === '添加') ? _c('div', {
	    staticClass: "pupup-title-slot font-18",
	    slot: "title"
	  }, [_vm._v("添加主播等级")]) : _vm._e(), _vm._v(" "), (_vm.popupOp.showCont === '添加') ? _c('div', {
	    staticClass: "pupup-main-slot text-center"
	  }, [_c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-name"
	    }
	  }, [_vm._v("级别名字 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.addForm.name),
	      expression: "addForm.name"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-name"
	    },
	    domProps: {
	      "value": _vm._s(_vm.addForm.name)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.addForm.name = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-dayincome"
	    }
	  }, [_vm._v("日收入 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.addForm.day_income),
	      expression: "addForm.day_income"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-dayincome"
	    },
	    domProps: {
	      "value": _vm._s(_vm.addForm.day_income)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.addForm.day_income = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-monthincome"
	    }
	  }, [_vm._v("月收入 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.addForm.month_income),
	      expression: "addForm.month_income"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-monthincome"
	    },
	    domProps: {
	      "value": _vm._s(_vm.addForm.month_income)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.addForm.month_income = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-daywork"
	    }
	  }, [_vm._v("日时长 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.addForm.day_work),
	      expression: "addForm.day_work"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-daywork"
	    },
	    domProps: {
	      "value": _vm._s(_vm.addForm.day_work)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.addForm.day_work = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-mothwork"
	    }
	  }, [_vm._v("月时长 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.addForm.moth_work),
	      expression: "addForm.moth_work"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-mothwork"
	    },
	    domProps: {
	      "value": _vm._s(_vm.addForm.moth_work)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.addForm.moth_work = $event.target.value
	      }
	    }
	  })])]) : _vm._e(), _vm._v(" "), (_vm.popupOp.showCont === '编辑') ? _c('div', {
	    staticClass: "pupup-title-slot font-18",
	    slot: "title"
	  }, [_vm._v("编辑主播等级")]) : _vm._e(), _vm._v(" "), (_vm.popupOp.showCont === '编辑') ? _c('div', {
	    staticClass: "pupup-main-slot text-center"
	  }, [_c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-name"
	    }
	  }, [_vm._v("级别名字 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.editForm.name),
	      expression: "editForm.name"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-name",
	      "readonly": ""
	    },
	    domProps: {
	      "value": _vm._s(_vm.editForm.name)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.editForm.name = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-dayincome"
	    }
	  }, [_vm._v("日收入 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.editForm.day_income),
	      expression: "editForm.day_income"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-dayincome"
	    },
	    domProps: {
	      "value": _vm._s(_vm.editForm.day_income)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.editForm.day_income = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-monthincome"
	    }
	  }, [_vm._v("月收入 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.editForm.month_income),
	      expression: "editForm.month_income"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-monthincome"
	    },
	    domProps: {
	      "value": _vm._s(_vm.editForm.month_income)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.editForm.month_income = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-daywork"
	    }
	  }, [_vm._v("日时长 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.editForm.day_work),
	      expression: "editForm.day_work"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-daywork"
	    },
	    domProps: {
	      "value": _vm._s(_vm.editForm.day_work)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.editForm.day_work = $event.target.value
	      }
	    }
	  })]), _vm._v(" "), _c('p', {
	    staticClass: "edit-cont"
	  }, [_c('label', {
	    staticClass: "edit-label di text-right",
	    attrs: {
	      "for": "edit-mothwork"
	    }
	  }, [_vm._v("月时长 : ")]), _vm._v(" "), _c('input', {
	    directives: [{
	      name: "model",
	      rawName: "v-model",
	      value: (_vm.editForm.month_work),
	      expression: "editForm.month_work"
	    }],
	    staticClass: "edit-input",
	    attrs: {
	      "type": "text",
	      "id": "edit-mothwork"
	    },
	    domProps: {
	      "value": _vm._s(_vm.editForm.month_work)
	    },
	    on: {
	      "input": function($event) {
	        if ($event.target.composing) { return; }
	        _vm.editForm.month_work = $event.target.value
	      }
	    }
	  })])]) : _vm._e(), _vm._v(" "), (_vm.popupOp.showCont === '删除') ? _c('div', [_vm._v("\n            是否删除等级?\n        ")]) : _vm._e()])], 1)
	},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('header', {
	    staticClass: "header"
	  }, [_c('span', {
	    staticClass: "title h-100 font-18 font-bold fl"
	  }, [_vm._v("主播级别设置")])])
	},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('div', {
	    staticClass: "table-thead clear"
	  }, [_c('span', {
	    staticClass: "table-th di h-100 font-16 font-bold text-center fl"
	  }, [_vm._v("级别")]), _vm._v(" "), _c('span', {
	    staticClass: "table-th di h-100 font-16 font-bold text-center fl"
	  }, [_vm._v("月收入")]), _vm._v(" "), _c('span', {
	    staticClass: "table-th di h-100 font-16 font-bold text-center fl"
	  }, [_vm._v("日时长")]), _vm._v(" "), _c('span', {
	    staticClass: "table-th di h-100 font-16 font-bold text-center fl"
	  }, [_vm._v("月时长")]), _vm._v(" "), _c('span', {
	    staticClass: "table-th di h-100 font-16 font-bold text-center fl"
	  }, [_vm._v("操作")])])
	}]}
	module.exports.render._withStripped = true
	if (false) {
	  module.hot.accept()
	  if (module.hot.data) {
	     require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-03adb1f2", module.exports)
	  }
	}

/***/ }

});