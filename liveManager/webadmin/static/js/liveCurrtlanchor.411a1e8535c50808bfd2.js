webpackJsonp([10,24],{487:function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=e.morh=function(t){if(!t)return 0;if(t>60){var e=t%60,a=Math.floor(t/60)+"小时";return e&&(a+=e+"分钟"),a}return t+"分钟"};e.default={morh:a}},493:function(t,e,a){var r,n;a(494),r=a(496);var i=a(497);n=r=r||{},"object"!=typeof r.default&&"function"!=typeof r.default||(n=r=r.default),"function"==typeof n&&(n=n.options),n.render=i.render,n.staticRenderFns=i.staticRenderFns,n._scopeId="data-v-34f00a4f",t.exports=r},494:function(t,e,a){var r=a(495);"string"==typeof r&&(r=[[t.id,r,""]]);a(32)(r,{});r.locals&&(t.exports=r.locals)},495:function(t,e,a){e=t.exports=a(4)(),e.push([t.id,"#co-pages[data-v-34f00a4f]{display:table}#co-pages .pages-cont[data-v-34f00a4f]{display:table-cell;line-height:0;vertical-align:middle}#co-pages .btn-n-w[data-v-34f00a4f]{transition:transform .6s}#co-pages .btn[data-v-34f00a4f]{min-width:30px;height:30px;margin:0 5px;padding:0 9px;color:#757b81;line-height:30px;border:1px solid #eaeaea;border-radius:4px}#co-pages .btn.btn-is[data-v-34f00a4f]{min-width:auto;width:30px;height:30px;padding:0}#co-pages .btn.sel[data-v-34f00a4f]{transition:all .6s;color:#fff;background:#05bcd4;border-color:#05bcd4}#co-pages .btn.dis[data-v-34f00a4f]{transition:all .6s;color:#fff;background:#aaa;border-color:#aaa;cursor:not-allowed}#co-pages .to-page[data-v-34f00a4f]{width:32px;height:32px;margin:0 5px;text-indent:0;border:1px solid #eaeaea}#co-pages .label-normal[data-v-34f00a4f]{width:22px;color:#757b81;line-height:32px}#co-pages .label-explain[data-v-34f00a4f]{color:#aaa;line-height:32px}",""])},496:function(t,e){"use strict";function a(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}Object.defineProperty(e,"__esModule",{value:!0});var r,n=void 0,i=void 0,l=void 0,o=void 0,s={props:{index:{type:Number,default:1},limit:{type:Number,default:20},total:{type:Number,required:!0},initPage:{type:Number,default:5}},watch:(r={},a(r,"index",function(t){this.currIndex=t-1}),a(r,"total",function(t){var e=this.initPage,a=this.allPageS,r=e<a?l*e:l*a;n.style.width=r+"px",i.style.width=l*a+"px"}),r),data:function(){return{currIndex:this.index-1,selIndex:null}},methods:{selPage:function(t,e){this.currIndex!==e&&this.$emit("switchPage",e+1)},prePage:function(){var t=this.currIndex;t>0&&(--t,this.currIndex=t,this.$emit("switchPage",t+1))},nextPage:function(){var t=this.currIndex,e=this.allPageS;t<e-1&&(++t,this.currIndex=t,this.$emit("switchPage",t+1))},jumpPage:function(){var t=this.selIndex,e=this.allPageS,a=/^[0-9]+$/,r=void 0;a.test(t)&&(r=t-1,r>=e&&(r=e-1),r<0&&(r=0),this.currIndex=r,this.$emit("switchPage",r+1))}},computed:{allPageS:function(){return Math.ceil((this.total||10)/this.limit)},outerShow:function(){return this.allPageS>5}},directives:{slideBtn:{inserted:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:binding,a=e.value,r=a.initPage,s=a.allPageS;n=t,i=t.querySelector(".btn-n-w"),l=i.querySelector(".btn").offsetWidth+10,o=r<s?(s-r)*-l:0},update:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:binding,a=e.value.currIndex,r=a*-l;r<o&&(r=o),i.style["-webkit-transform"]="translate3d("+r+"px,0,0)",i.style["-moz-transform"]="translate3d("+r+"px,0,0)",i.style["-ms-transform"]="translate3d("+r+"px,0,0)",i.style["-o-transform"]="translate3d("+r+"px,0,0)",i.style.transform="translate3d("+r+"px,0,0)"}}}};e.default=Object.assign({name:"co-pages"},s)},497:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"wh-100",attrs:{id:"co-pages"}},[a("div",{staticClass:"pages-cont text-center"},[a("div",{staticClass:"pages-main di"},[t.outerShow?a("span",{staticClass:"btn db font-14 fl",class:{dis:0===t.currIndex},on:{click:t.prePage}},[t._v("上一页")]):t._e(),t._v(" "),a("div",{directives:[{name:"slide-btn",rawName:"v-slide-btn",value:{initPage:t.initPage,allPageS:t.allPageS,currIndex:t.currIndex},expression:"{initPage: initPage, allPageS: allPageS, currIndex: currIndex}"}],staticClass:"btn-w fl hidden"},[a("div",{staticClass:"btn-n-w clear rel"},t._l(t.allPageS,function(e,r){return a("span",{staticClass:"btn btn-is db font-14 fl",class:{sel:t.currIndex===r},on:{click:function(a){t.selPage(e,r)}}},[t._v(t._s(e))])}))]),t._v(" "),t.outerShow&&t.currIndex<t.allPageS-5?a("span",{staticClass:"label-normal db fl"},[t._v("···")]):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"btn db font-14 fl",class:{dis:t.currIndex===t.allPageS-1},on:{click:t.nextPage}},[t._v("下一页")]):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"label-explain db fl"},[t._v("共"+t._s(t.allPageS)+"页，到第")]):t._e(),t._v(" "),t.outerShow?a("input",{directives:[{name:"model",rawName:"v-model.trim.number",value:t.selIndex,expression:"selIndex",modifiers:{trim:!0,number:!0}}],staticClass:"to-page font-14 text-center db fl",attrs:{type:"text"},domProps:{value:t._s(t.selIndex)},on:{input:function(e){e.target.composing||(t.selIndex=t._n(e.target.value.trim()))},blur:function(e){t.$forceUpdate()}}}):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"label-explain db fl"},[t._v("页")]):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"btn db font-14 fl",on:{click:t.jumpPage}},[t._v("确定")]):t._e()])])])},staticRenderFns:[]}},546:function(t,e,a){var r,n;a(547),r=a(549);var i=a(550);n=r=r||{},"object"!=typeof r.default&&"function"!=typeof r.default||(n=r=r.default),"function"==typeof n&&(n=n.options),n.render=i.render,n.staticRenderFns=i.staticRenderFns,n._scopeId="data-v-45079651",t.exports=r},547:function(t,e,a){var r=a(548);"string"==typeof r&&(r=[[t.id,r,""]]);a(32)(r,{});r.locals&&(t.exports=r.locals)},548:function(t,e,a){e=t.exports=a(4)(),e.push([t.id,"#p-currtlanchor .curr-header[data-v-45079651]{height:50px;background:#fff}#p-currtlanchor .curr-header .title[data-v-45079651]{margin-left:20px;line-height:50px}#p-currtlanchor .curr-header .autoref[data-v-45079651]{margin-top:19px;margin-right:20px;color:#757b81;1line-height:14px}#p-currtlanchor .curr-header .autoref .ico[data-v-45079651]{animation:refrotate 3s linear infinite}@keyframes refrotate{0%{transform:rotate(0deg)}50%{transform:rotate(180deg)}to{transform:rotate(1turn)}}#p-currtlanchor .curr-main[data-v-45079651]{margin:20px;background:#fff}#p-currtlanchor .table-tr[data-v-45079651]{height:78px;border-bottom:1px solid #eaeaea}#p-currtlanchor .table-tr[data-v-45079651]:hover{transition:all .2s;border-bottom-color:#fff;box-shadow:0 5px 5px -3px rgba(0,0,0,.3)}#p-currtlanchor .table-td[data-v-45079651]:first-child,#p-currtlanchor .table-th[data-v-45079651]:first-child{width:36%}#p-currtlanchor .table-td[data-v-45079651]:nth-child(2),#p-currtlanchor .table-th[data-v-45079651]:nth-child(2){width:19%}#p-currtlanchor .table-td[data-v-45079651]:nth-child(3),#p-currtlanchor .table-th[data-v-45079651]:nth-child(3){width:20%}#p-currtlanchor .table-td[data-v-45079651]:nth-child(4),#p-currtlanchor .table-th[data-v-45079651]:nth-child(4){width:10%}#p-currtlanchor .table-td[data-v-45079651]:nth-child(5),#p-currtlanchor .table-th[data-v-45079651]:nth-child(5){width:15%}#p-currtlanchor .table-th[data-v-45079651]{height:56px;line-height:56px;border-bottom:2px solid #eaeaea}#p-currtlanchor .table-td[data-v-45079651]{line-height:78px}#p-currtlanchor .table-td img[data-v-45079651]{width:52px;height:52px;color:#333c44;margin-top:12px;margin-left:20px}#p-currtlanchor .table-td .username[data-v-45079651]{margin-left:93px}#p-currtlanchor .table-td .game[data-v-45079651]{height:27px;margin-top:11px;line-height:27px}#p-currtlanchor .table-td .rmb[data-v-45079651]{height:25px;color:#aaa;line-height:25px}#p-currtlanchor .table-footer[data-v-45079651]{height:72px}",""])},549:function(t,e,a){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function n(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}Object.defineProperty(e,"__esModule",{value:!0});var i=a(493),l=r(i),o=a(81),s=r(o),c=a(487),d=a(46),f=a(39),u=a(48),h=void 0,p=function(t,e){var a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:function(){};a=Object.assign(a,{startTime:(0,f.dateNumFilter)(Date.parse(new Date),"yyyy-MM-dd hh:mm:ss")}),e.$http.post(t,a).then(function(t){var e=t.body.data,a=e.pageNum,n=e.data;r(a,n),(0,u.closePgloading)()},function(t){var e=t.body.msg;return console.log(e)})},v=function(){return{index:1,limit:10,total:10,refTime:90,maxLive:[]}},g=n({},"refTime",function(t){var e=this;if(90===t&&e.openRefTime(),0===t){var a=e.$store.state.api.todayall.maxLive;e.closeRefTime(),e.index=1,(0,u.openPgloading)(),p(a,e,{total:e.limit,page:e.index},function(t,a){e.total=e.limit*t,e.maxLive=a,e.refTime=90})}}),m={spareUrl:function(){return(0,d.setUrl)("/webadmin/static/images/anchor-default-img.png")}},x={openRefTime:function(){var t=this;h=setInterval(function(){t.refTime=--t.refTime},1e3)},closeRefTime:function(){clearInterval(h)},switchPage:function(t){var e=this,a=e.$store.state.api.todayall.maxLive;(0,u.openPgloading)(),p(a,e,{total:e.limit,page:t},function(a,r){e.index=t,e.maxLive=r})}},b={morh:c.morh},_={coPages:l.default,coContainer:s.default},w=function(){var t=this,e=t.$store.state.api.todayall.maxLive;p(e,t,{total:t.limit,page:t.index},function(e,a){t.total=t.limit*e,t.maxLive=a,t.openRefTime()})},P={name:"p-currtlanchor",data:v,watch:g,computed:m,components:_,filters:b,methods:x,created:w};e.default=P},550:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{attrs:{id:"p-currtlanchor"}},[a("header",{staticClass:"curr-header"},[a("span",{staticClass:"title h-100 font-18 font-bold fl"},[t._v("今日上播时长最高主播")]),t._v(" "),a("div",{staticClass:"autoref font-14 fr"},[a("span",[t._v(t._s(t.refTime)+"秒后刷新数据")]),t._v(" "),a("span",{staticClass:"ico icon-refresh"})])]),t._v(" "),a("section",{staticClass:"curr-main"},[t._m(0),t._v(" "),a("co-container",{attrs:{isShow:0===t.maxLive.length,h:"300px"}},[a("ul",{staticClass:"table-tbody"},t._l(t.maxLive,function(e){return a("router-link",{staticClass:"table-tr c-pointer clear",attrs:{to:"/admin/ahdetail/"+e.platform+"/"+e.platformid,tag:"li"}},[a("div",{staticClass:"table-td h-100 font-16 fl"},[a("img",{staticClass:"userimg arc fl",attrs:{src:e.avatar||t.spareUrl,alt:e.remark||e.nickname}}),t._v(" "),a("div",{staticClass:"username h-100 text-hidden"},[t._v(t._s(e.remark||e.nickname))])]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v("+"+t._s(t._f("morh")(e.workTime)))]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v(t._s(e.platname))]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v(t._s(e.levename))]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v(t._s(e.agentname||"-"))])])}))]),t._v(" "),a("div",{staticClass:"table-footer"},[a("co-pages",{attrs:{index:t.index,limit:t.limit,total:t.total},on:{switchPage:t.switchPage}})],1)],1)])},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"table-thead clear"},[a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("主播")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("时长")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("平台")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("等级")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("经纪人")])])}]}}});