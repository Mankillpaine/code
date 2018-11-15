/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// 日考勤报表s
const p_ckday = resolve => 
		require.ensure(['./view/ckday.page.vue'], require => 
			resolve(require('./view/ckday.page.vue')), 'checkCkday');

// 月考勤报表
const p_ckmonth = resolve => 
		require.ensure(['./view/ckmonth.page.vue'], require => 
			resolve(require('./view/ckmonth.page.vue')), 'checkCkmonth');


// live 模块路配置
const config = [
	{   // 日考勤报表
		path: 'ckday',
		component: p_ckday
	}, 
	{   // 月考勤报表
		path: 'ckmonth',
		component: p_ckmonth
	}
];


// 导出模块
export { config };