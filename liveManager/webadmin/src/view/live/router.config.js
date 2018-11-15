/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// 今日总览
const p_todayall = resolve => 
		require.ensure(['./view/todayall.page.vue'], require => 
			resolve(require('./view/todayall.page.vue')), 'liveToadyall');

// 收入分析
const p_income = resolve => 
		require.ensure(['./view/income.page.vue'], require => 
			resolve(require('./view/income.page.vue')), 'liveIncome');

// 增粉分析
const p_addfans = resolve => 
		require.ensure(['./view/addfans.page.vue'], require => 
			resolve(require('./view/addfans.page.vue')), 'liveAddfans');

// 当前在线最高主播
const p_currolanchor = resolve => 
		require.ensure(['./view/currolanchor.page.vue'], require => 
			resolve(require('./view/currolanchor.page.vue')), 'liveCurrolanchor');

// 昨日在线最高主播
const p_ysolanchor = resolve => 
		require.ensure(['./view/ysolanchor.page.vue'], require => 
			resolve(require('./view/ysolanchor.page.vue')), 'liveYsolanchor');

// 当前收入最高主播
const p_curricanchor = resolve => 
		require.ensure(['./view/curricanchor.page.vue'], require => 
			resolve(require('./view/curricanchor.page.vue')), 'liveCurricanchor');

// 昨日收入最高主播
const p_ysicanchor = resolve => 
		require.ensure(['./view/ysicanchor.page.vue'], require => 
			resolve(require('./view/ysicanchor.page.vue')), 'liveYsicanchor');

// 当前增粉最高主播
const p_currafanchor = resolve => 
		require.ensure(['./view/currafanchor.page.vue'], require => 
			resolve(require('./view/currafanchor.page.vue')), 'liveCurrafanchor');

// 昨日增粉最高主播
const p_ysafanchor = resolve => 
		require.ensure(['./view/ysafanchor.page.vue'], require => 
			resolve(require('./view/ysafanchor.page.vue')), 'liveYsafanchor');

// 当前上播时间最长主播
const p_currtlanchor = resolve => 
		require.ensure(['./view/currtlanchor.page.vue'], require => 
			resolve(require('./view/currtlanchor.page.vue')), 'liveCurrtlanchor');

// 昨日上播时间最长主播
const p_ystlanchor = resolve => 
		require.ensure(['./view/ystlanchor.page.vue'], require => 
			resolve(require('./view/ystlanchor.page.vue')), 'liveYstlanchor');


// live 模块路配置
const config = [
	{   // 今日总览
		path: 'todayall',
		component: p_todayall
	}, 
	{   // 收入分析
		path: 'income',
		component: p_income
	}, 
	{   // 增粉分析
		path: 'addfans',
		component: p_addfans
	}, 
	{   // 当前在线最高
		path: 'currolanchor',
		component: p_currolanchor
	}, 
	{   // 昨日在线最高
		path: 'ysolanchor',
		component: p_ysolanchor
	}, 
	{   // 当前收入最高
		path: 'curricanchor',
		component: p_curricanchor
	}, 
	{   // 昨日收入最高
		path: 'ysicanchor',
		component: p_ysicanchor
	}, 
	{   // 当前增粉最多
		path: 'currafanchor',
		component: p_currafanchor
	}, 
	{	// 昨日增粉最多
		path: 'ysafanchor',
		component: p_ysafanchor
	}, 
	{	// 当前上播最多
		path: 'currtlanchor',
		component: p_currtlanchor
	}, 
	{	// 昨日上播最多
		path: 'ystlanchor',
		component: p_ystlanchor
	}
];

// 导出模块
export { config };