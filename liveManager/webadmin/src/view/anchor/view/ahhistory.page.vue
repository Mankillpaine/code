/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-ahhistory">
		<section class="history-main">
			<ul class="list">
				<li class="list-item clear" v-for="(item, key) of anchorLiveHistry">
					<div class="item-left fl">
						<time class="db font-16 rel">{{ key | convertMD }}</time>
					</div>
					<div class="item-right clear">
						<div class="user-info clear rel" v-for="info of item">
							<img class="fl" :src="info.cover" 
											:alt="info.title">
							<p class="username font-16 text-hidden">{{ info.title }}</p>
							<p class="outer font-14 text-hidden">{{ key }}开播，时长{{ info.workTime }}小时，{{ info.onlineMax }}人观看。</p>
						</div>
					</div>
				</li>
			</ul>
		</section>
    </div>
</template>


<script>
import { closePgloading } from './../../../service/pageloading.service.js';

// vm对象
const vm = {
	// 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
	created() {
		closePgloading();
        const
            vm = this,
            API_LIVEHISTRY = vm.$store.state.api.anchor.livehistry,
            { platform, platformid } = vm.$route.params;

        // 请求主播直播历史数据
        vm.$http.post(API_LIVEHISTRY, {
        	platformid,
        	platform,
        	page: 1,
        	total: 100
        }).then(({body: {data: {data}}}) => {
        	const patt = /^([0-9]+-[0-9]+-[0-9]+)\s/;

        	let obj = {};

        	data.forEach(({title, workTime, onlineMax, cover, starttime}) => {
        		if (patt.test(starttime)) {
        			if (!obj[RegExp.$1]) {
        				obj[RegExp.$1] = [{title, workTime, onlineMax, cover}]
        			} else {
        				obj[RegExp.$1].push({title, workTime, onlineMax, cover});
        			};
        		};
        	});

        	vm.anchorLiveHistry = obj;
        }, ({body: {msg}}) => console.log(msg)); 
	},
	data: () => ({
       	anchorLiveHistry: [], // 主播直播历史
	}),
	filters: {
		// 转换年月日
		convertMD: (val) => {
			const patt = /^[0-9]+-([0-9]+)-([0-9]+)/;

			let m, s;

			if (patt.test(val)) {
				m = RegExp.$1.substring(0, 1) === '0' ? RegExp.$1.substr(1, 1) : RegExp.$1;
				s = RegExp.$2.substring(0, 1) === '0' ? RegExp.$2.substr(1, 1) : RegExp.$2;
			};

			return `${m}月${s}日`;
		}
	}
};


// 暴露组件配置
export default Object.assign({ name: 'p-ahhistory' }, vm);
</script>


<style lang="less" scoped>
    #p-ahhistory {
		/*内容主体*/
		.history-main {
			margin: 20px;
			background: #fff;
			border-top: 2px solid #ff597c;

			.list {
				margin-left: 191px;
				margin-top: 25px;
			}
			.item-left {
				width: 86px;

				time {
					height: 19px;
					color: #333c44;
					line-height: 19px;

					/*装饰圆点*/
					&:after {
						content: '';
						position: absolute;
						top: 0;
						right: 0;
						width: 13px;
						height: 13px;
						margin-right: -10px;
						background: #ff597c;
						border: 3px solid #ffbdcb;
						border-radius: 50%;
					}
				}
			}
			.item-right {
				margin-left: 86px;
				border-left: 1px solid #ff597c;
		
				&:before {
					content: '';
					display: block;
					height: 23px;
				}

				.user-info {
					&:before {
						content: '';
						display: block;
						position: absolute;
						top: 50%;
						left: -4px;
						width: 5px;
						height: 5px;
						margin-top: -2.5px;
						border: 1px solid #ff597c;
						border-radius: 50%;
					}

					img {
						width: 63px;
						height: 63px;
						margin-top: 16px;
						margin-bottom: 16px;
						margin-left: 50px;
					}
					.username {
						height: 58px;
						margin-left: 123px;
						line-height: 58px;
					}
					.outer {
						height: 19px;
						margin-left: 123px;
						color: #aaa;
						line-height: 19px;
					}
				}
			}
		}
    }
</style>