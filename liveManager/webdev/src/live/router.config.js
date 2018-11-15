/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// 今日总览
const todayall = resolve => 
		require.ensure(['./components/todayall.vue'], require => 
			resolve(require('./components/todayall.vue')), 'liveToadyall');

// 收入分析
const income = resolve => 
		require.ensure(['./components/income.vue'], require => 
			resolve(require('./components/income.vue')), 'liveIncome');

// 增粉分析
const addfans = resolve => 
		require.ensure(['./components/addfans.vue'], require => 
			resolve(require('./components/addfans.vue')), 'liveAddfans');


// live 模块路配置
const config = [{
	path: 'todayall',
	component: todayall
}, {
	path: 'income',
	component: income
}, {
	path: 'addfans',
	component: addfans
}];


// 导出模块
export { config };