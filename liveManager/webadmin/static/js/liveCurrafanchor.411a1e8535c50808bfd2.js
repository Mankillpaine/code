webpackJsonp([8,24],{493:function(t,e,a){var n,r;a(494),n=a(496);var i=a(497);r=n=n||{},"object"!=typeof n.default&&"function"!=typeof n.default||(r=n=n.default),"function"==typeof r&&(r=r.options),r.render=i.render,r.staticRenderFns=i.staticRenderFns,r._scopeId="data-v-34f00a4f",t.exports=n},494:function(t,e,a){var n=a(495);"string"==typeof n&&(n=[[t.id,n,""]]);a(32)(n,{});n.locals&&(t.exports=n.locals)},495:function(t,e,a){e=t.exports=a(4)(),e.push([t.id,"#co-pages[data-v-34f00a4f]{display:table}#co-pages .pages-cont[data-v-34f00a4f]{display:table-cell;line-height:0;vertical-align:middle}#co-pages .btn-n-w[data-v-34f00a4f]{transition:transform .6s}#co-pages .btn[data-v-34f00a4f]{min-width:30px;height:30px;margin:0 5px;padding:0 9px;color:#757b81;line-height:30px;border:1px solid #eaeaea;border-radius:4px}#co-pages .btn.btn-is[data-v-34f00a4f]{min-width:auto;width:30px;height:30px;padding:0}#co-pages .btn.sel[data-v-34f00a4f]{transition:all .6s;color:#fff;background:#05bcd4;border-color:#05bcd4}#co-pages .btn.dis[data-v-34f00a4f]{transition:all .6s;color:#fff;background:#aaa;border-color:#aaa;cursor:not-allowed}#co-pages .to-page[data-v-34f00a4f]{width:32px;height:32px;margin:0 5px;text-indent:0;border:1px solid #eaeaea}#co-pages .label-normal[data-v-34f00a4f]{width:22px;color:#757b81;line-height:32px}#co-pages .label-explain[data-v-34f00a4f]{color:#aaa;line-height:32px}",""])},496:function(t,e){"use strict";function a(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}Object.defineProperty(e,"__esModule",{value:!0});var n,r=void 0,i=void 0,l=void 0,o=void 0,s={props:{index:{type:Number,default:1},limit:{type:Number,default:20},total:{type:Number,required:!0},initPage:{type:Number,default:5}},watch:(n={},a(n,"index",function(t){this.currIndex=t-1}),a(n,"total",function(t){var e=this.initPage,a=this.allPageS,n=e<a?l*e:l*a;r.style.width=n+"px",i.style.width=l*a+"px"}),n),data:function(){return{currIndex:this.index-1,selIndex:null}},methods:{selPage:function(t,e){this.currIndex!==e&&this.$emit("switchPage",e+1)},prePage:function(){var t=this.currIndex;t>0&&(--t,this.currIndex=t,this.$emit("switchPage",t+1))},nextPage:function(){var t=this.currIndex,e=this.allPageS;t<e-1&&(++t,this.currIndex=t,this.$emit("switchPage",t+1))},jumpPage:function(){var t=this.selIndex,e=this.allPageS,a=/^[0-9]+$/,n=void 0;a.test(t)&&(n=t-1,n>=e&&(n=e-1),n<0&&(n=0),this.currIndex=n,this.$emit("switchPage",n+1))}},computed:{allPageS:function(){return Math.ceil((this.total||10)/this.limit)},outerShow:function(){return this.allPageS>5}},directives:{slideBtn:{inserted:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:binding,a=e.value,n=a.initPage,s=a.allPageS;r=t,i=t.querySelector(".btn-n-w"),l=i.querySelector(".btn").offsetWidth+10,o=n<s?(s-n)*-l:0},update:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:binding,a=e.value.currIndex,n=a*-l;n<o&&(n=o),i.style["-webkit-transform"]="translate3d("+n+"px,0,0)",i.style["-moz-transform"]="translate3d("+n+"px,0,0)",i.style["-ms-transform"]="translate3d("+n+"px,0,0)",i.style["-o-transform"]="translate3d("+n+"px,0,0)",i.style.transform="translate3d("+n+"px,0,0)"}}}};e.default=Object.assign({name:"co-pages"},s)},497:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"wh-100",attrs:{id:"co-pages"}},[a("div",{staticClass:"pages-cont text-center"},[a("div",{staticClass:"pages-main di"},[t.outerShow?a("span",{staticClass:"btn db font-14 fl",class:{dis:0===t.currIndex},on:{click:t.prePage}},[t._v("上一页")]):t._e(),t._v(" "),a("div",{directives:[{name:"slide-btn",rawName:"v-slide-btn",value:{initPage:t.initPage,allPageS:t.allPageS,currIndex:t.currIndex},expression:"{initPage: initPage, allPageS: allPageS, currIndex: currIndex}"}],staticClass:"btn-w fl hidden"},[a("div",{staticClass:"btn-n-w clear rel"},t._l(t.allPageS,function(e,n){return a("span",{staticClass:"btn btn-is db font-14 fl",class:{sel:t.currIndex===n},on:{click:function(a){t.selPage(e,n)}}},[t._v(t._s(e))])}))]),t._v(" "),t.outerShow&&t.currIndex<t.allPageS-5?a("span",{staticClass:"label-normal db fl"},[t._v("···")]):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"btn db font-14 fl",class:{dis:t.currIndex===t.allPageS-1},on:{click:t.nextPage}},[t._v("下一页")]):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"label-explain db fl"},[t._v("共"+t._s(t.allPageS)+"页，到第")]):t._e(),t._v(" "),t.outerShow?a("input",{directives:[{name:"model",rawName:"v-model.trim.number",value:t.selIndex,expression:"selIndex",modifiers:{trim:!0,number:!0}}],staticClass:"to-page font-14 text-center db fl",attrs:{type:"text"},domProps:{value:t._s(t.selIndex)},on:{input:function(e){e.target.composing||(t.selIndex=t._n(e.target.value.trim()))},blur:function(e){t.$forceUpdate()}}}):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"label-explain db fl"},[t._v("页")]):t._e(),t._v(" "),t.outerShow?a("span",{staticClass:"btn db font-14 fl",on:{click:t.jumpPage}},[t._v("确定")]):t._e()])])])},staticRenderFns:[]}},536:function(t,e,a){var n,r;a(537),n=a(539);var i=a(540);r=n=n||{},"object"!=typeof n.default&&"function"!=typeof n.default||(r=n=n.default),"function"==typeof r&&(r=r.options),r.render=i.render,r.staticRenderFns=i.staticRenderFns,r._scopeId="data-v-01fe2df8",t.exports=n},537:function(t,e,a){var n=a(538);"string"==typeof n&&(n=[[t.id,n,""]]);a(32)(n,{});n.locals&&(t.exports=n.locals)},538:function(t,e,a){e=t.exports=a(4)(),e.push([t.id,"#p-currafanchor .curr-header[data-v-01fe2df8]{height:50px;background:#fff}#p-currafanchor .curr-header .title[data-v-01fe2df8]{margin-left:20px;line-height:50px}#p-currafanchor .curr-header .autoref[data-v-01fe2df8]{margin-top:19px;margin-right:20px;color:#757b81;1line-height:14px}#p-currafanchor .curr-header .autoref .ico[data-v-01fe2df8]{animation:refrotate 3s linear infinite}@keyframes refrotate{0%{transform:rotate(0deg)}50%{transform:rotate(180deg)}to{transform:rotate(1turn)}}#p-currafanchor .curr-main[data-v-01fe2df8]{margin:20px;background:#fff}#p-currafanchor .table-tr[data-v-01fe2df8]{height:78px;border-bottom:1px solid #eaeaea}#p-currafanchor .table-tr[data-v-01fe2df8]:hover{transition:all .2s;border-bottom-color:#fff;box-shadow:0 5px 5px -3px rgba(0,0,0,.3)}#p-currafanchor .table-td[data-v-01fe2df8]:first-child,#p-currafanchor .table-th[data-v-01fe2df8]:first-child{width:30%}#p-currafanchor .table-td[data-v-01fe2df8]:nth-child(2),#p-currafanchor .table-th[data-v-01fe2df8]:nth-child(2){width:16%}#p-currafanchor .table-td[data-v-01fe2df8]:nth-child(3),#p-currafanchor .table-th[data-v-01fe2df8]:nth-child(3){width:21%}#p-currafanchor .table-td[data-v-01fe2df8]:nth-child(4),#p-currafanchor .table-th[data-v-01fe2df8]:nth-child(4){width:14%}#p-currafanchor .table-td[data-v-01fe2df8]:nth-child(5),#p-currafanchor .table-th[data-v-01fe2df8]:nth-child(5){width:7%}#p-currafanchor .table-td[data-v-01fe2df8]:nth-child(6),#p-currafanchor .table-th[data-v-01fe2df8]:nth-child(6){width:12%}#p-currafanchor .table-th[data-v-01fe2df8]{height:56px;line-height:56px;border-bottom:2px solid #eaeaea}#p-currafanchor .table-td[data-v-01fe2df8]{line-height:78px}#p-currafanchor .table-td img[data-v-01fe2df8]{width:52px;height:52px;color:#333c44;margin-top:12px;margin-left:20px}#p-currafanchor .table-td .username[data-v-01fe2df8]{margin-left:93px}#p-currafanchor .table-td .game[data-v-01fe2df8]{height:27px;margin-top:11px;line-height:27px}#p-currafanchor .table-td .rmb[data-v-01fe2df8]{height:25px;color:#aaa;line-height:25px}#p-currafanchor .table-footer[data-v-01fe2df8]{height:72px}",""])},539:function(t,e,a){"use strict";function n(t){return t&&t.__esModule?t:{default:t}}function r(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}Object.defineProperty(e,"__esModule",{value:!0});var i=a(493),l=n(i),o=a(81),s=n(o),d=a(46),c=a(39),f=a(48),h=void 0,u=function(t,e){var a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:function(){};a=Object.assign(a,{startTime:(0,c.dateNumFilter)(Date.parse(new Date),"yyyy-MM-dd hh:mm:ss")}),e.$http.post(t,a).then(function(t){var e=t.body.data,a=e.pageNum,r=e.data;n(a,r),(0,f.closePgloading)()},function(t){var e=t.body.msg;return console.log(e)})},p=function(){return{index:1,limit:10,total:10,refTime:90,maxFans:[]}},v=r({},"refTime",function(t){var e=this;if(90===t&&e.openRefTime(),0===t){var a=e.$store.state.api.todayall.maxAddfans;e.closeRefTime(),e.index=1,(0,f.openPgloading)(),u(a,e,{total:e.limit,page:e.index},function(t,a){e.total=e.limit*t,e.maxFans=a,e.refTime=90})}}),g={spareUrl:function(){return(0,d.setUrl)("/webadmin/static/images/anchor-default-img.png")}},x={openRefTime:function(){var t=this;h=setInterval(function(){t.refTime=--t.refTime},1e3)},closeRefTime:function(){clearInterval(h)},switchPage:function(t){var e=this,a=e.$store.state.api.todayall.maxAddfans;(0,f.openPgloading)(),u(a,e,{total:e.limit,page:t},function(a,n){e.index=t,e.maxFans=n})}},b={coPages:l.default,coContainer:s.default},m=function(){var t=this,e=t.$store.state.api.todayall.maxAddfans;u(e,t,{total:t.limit,page:t.index},function(e,a){t.total=t.limit*e,t.maxFans=a,t.openRefTime()})},_={name:"p-currafanchor",data:p,watch:v,computed:g,components:b,methods:x,created:m};e.default=_},540:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{attrs:{id:"p-currafanchor"}},[a("header",{staticClass:"curr-header"},[a("span",{staticClass:"title h-100 font-18 font-bold fl"},[t._v("今日增粉最高主播")]),t._v(" "),a("div",{staticClass:"autoref font-14 fr"},[a("span",[t._v(t._s(t.refTime)+"秒后刷新数据")]),t._v(" "),a("span",{staticClass:"ico icon-refresh"})])]),t._v(" "),a("section",{staticClass:"curr-main"},[t._m(0),t._v(" "),a("co-container",{attrs:{isShow:0===t.maxFans.length,h:"300px"}},[a("ul",{staticClass:"table-tbody"},t._l(t.maxFans,function(e){return a("router-link",{staticClass:"table-tr c-pointer clear",attrs:{to:"/admin/ahdetail/"+e.platform+"/"+e.platformid,tag:"li"}},[a("div",{staticClass:"table-td h-100 font-16 fl"},[a("img",{staticClass:"userimg arc fl",attrs:{src:e.avatar||t.spareUrl,alt:e.remark||e.nickname}}),t._v(" "),a("div",{staticClass:"username h-100 text-hidden"},[t._v(t._s(e.remark||e.nickname))])]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v("+"+t._s(e.increase_follower)+"人")]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v(t._s(e.follower)+"人")]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v(t._s(e.platname))]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v(t._s(e.levename))]),t._v(" "),a("div",{staticClass:"table-td h-100 font-16 text-center text-hidden fl"},[t._v(t._s(e.agentname||"-"))])])}))]),t._v(" "),a("div",{staticClass:"table-footer"},[a("co-pages",{attrs:{index:t.index,limit:t.limit,total:t.total},on:{switchPage:t.switchPage}})],1)],1)])},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"table-thead clear"},[a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("主播")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("增粉")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("总增粉")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("平台")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("等级")]),t._v(" "),a("div",{staticClass:"table-th font-16 font-bold text-center fl"},[t._v("经纪人")])])}]}}});