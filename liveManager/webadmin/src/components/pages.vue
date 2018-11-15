/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="co-pages" class="wh-100">
		<div class="pages-cont text-center">
			<div class="pages-main di">
				<span class="btn db font-14 fl" 
					  v-if="outerShow"
					  :class="{'dis': currIndex === 0}"
					  @click="prePage">上一页</span>
				<div class="btn-w fl hidden" 
					 v-slide-btn="{initPage: initPage, allPageS: allPageS, currIndex: currIndex}">
					<div class="btn-n-w clear rel">
						<span class="btn btn-is db font-14 fl" 
						  	  v-for="(val, key) of allPageS"
						  	  :class="{'sel': currIndex === key}"
						  	  @click="selPage(val, key)">{{ val }}</span>
					</div>
				</div>
				<span class="label-normal db fl" v-if="outerShow && currIndex < allPageS - 5">···</span>
				<span class="btn db font-14 fl" 
					  v-if="outerShow"
					  :class="{'dis': currIndex === allPageS - 1}"
					  @click="nextPage">下一页</span>
				<span class="label-explain db fl" v-if="outerShow">共{{ allPageS }}页，到第</span>
				<input class="to-page font-14 text-center db fl" 
					   v-if="outerShow"
					   type="text"
					   v-model.trim.number="selIndex">
				<span class="label-explain db fl" v-if="outerShow">页</span>
				<span class="btn db font-14 fl"
					  v-if="outerShow"
				      @click="jumpPage">确定</span>
			</div>
		</div>
    </div>
</template>


<script>
let ele, container, btnW, maxDistance;

// vm对象
const vm = {
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
	watch: {
        ['total'](curr) {
        	const {initPage, allPageS} = this;
        	
        	let elDistance = initPage < allPageS ? btnW * initPage : btnW * allPageS;

        	// 设置按钮容器宽度
        	ele.style.width = `${elDistance}px`;
        	container.style.width = `${btnW * allPageS}px`;
        }
    },
	data() {
		return {
			// 当前页码
			currIndex: this.index - 1,
			// 选择页码
			selIndex: null
		};
	},
	methods: {
		// 选择页面
		selPage(val, key) {
			// 如果当前点击的页面不是等于已经被点击了就可以执行
			if (this.currIndex !== key) {
				this.currIndex = key;
				this.$emit('switchPage', key + 1);
			};
		},
		// 上一页
		prePage() {
			let { currIndex } = this;

			// 当前的页面必须大于0才能翻到上一页
			if (currIndex > 0) {
				--currIndex;

				this.currIndex = currIndex;
				this.$emit('switchPage', currIndex + 1);
			};
		},
		// 下一页
		nextPage() {
			let { currIndex, allPageS } = this;

			// 当前的页面必须小于总页数才能翻到下一页
			if (currIndex < allPageS - 1) {
				++currIndex;
				
				this.currIndex = currIndex;
				this.$emit('switchPage', currIndex + 1);
			};
		},
		// 跳转分页
		jumpPage() {
			const 
				{ selIndex, allPageS } = this,
				patt = /^[0-9]+$/;

			let index;

			// 验证通过可以跳转
			if (patt.test(selIndex)) {
				index = selIndex - 1

				if (index >= allPageS) index = allPageS - 1;
				if (index < 0) index = 0;

				this.currIndex = index;
				this.$emit('switchPage', index + 1);
			};
		}
	},
	computed: {
		// 总页数
		allPageS() {
			return Math.ceil((this.total || 10) / this.limit);			
		},
		// 其他控件是否显示
		outerShow() {
			return this.allPageS > 5;
		}
	},
	directives: {
		// 滑动按钮框
		slideBtn: {
			inserted: (el, {value: {initPage, allPageS}} = binding) => {
				ele = el,
				container = el.querySelector('.btn-n-w');
				btnW = container.querySelector('.btn').offsetWidth + 10;
				maxDistance = initPage < allPageS ? (allPageS - initPage) * -btnW : 0;

				let elDistance = initPage < allPageS ? btnW * initPage : btnW * allPageS;
					
				// 设置按钮容器宽度
				el.style.width = `${elDistance}px`;
				container.style.width = `${btnW * allPageS}px`;
    		},
    		update: (el, {value: {currIndex}} = binding) => {
    			let currDistance = currIndex * -btnW;

    			// 如果当前距离大于最远距离的话，当前距离就等于最远距离
    			if (currDistance < maxDistance) currDistance = maxDistance;

				// 执行动画推移
				container.style['-webkit-transform'] = `translate3d(${currDistance}px,0,0)`;
				container.style['-moz-transform'] = `translate3d(${currDistance}px,0,0)`;
				container.style['-ms-transform'] = `translate3d(${currDistance}px,0,0)`;
				container.style['-o-transform'] = `translate3d(${currDistance}px,0,0)`;
				container.style['transform'] = `translate3d(${currDistance}px,0,0)`;    			
    		}
		}
	}
};


// 暴露组件配置
export default Object.assign({ name: 'co-pages' }, vm);
</script>


<style lang="less" scoped>
    #co-pages {
		display: table;

		.pages-cont {
			display: table-cell;
			line-height: 0;
			vertical-align: middle;
		}
		
		.btn-n-w {
			transition: transform .6s;
		}
		.btn {
			min-width: 30px;
			height: 30px;
			margin: 0 5px;
			padding: 0 9px;
			color: #757b81;
			line-height: 30px;
			border: 1px solid #eaeaea;

			&.btn-is {
				min-width: auto;
				width: 30px;
				height: 30px;
				padding: 0;
			}
			&.sel {
				transition: all .6s;
				color: #fff;
				background: #05bcd4;
				border-color: #05bcd4;
			}
			&.dis {
				transition: all .6s;
				color: #fff;
				background: #aaa;
				border-color: #aaa;
				cursor: not-allowed;
			}
		}
		.to-page {
			width: 32px;
			height: 32px;
			margin: 0 5px;
			text-indent: 0;
			border: 1px solid #eaeaea;
		}
		.label-normal {
			width: 22px;
			color: #757b81;
			line-height: 32px;
		}
		.label-explain {
			color: #aaa;
			line-height: 32px;
		}
	}
</style>