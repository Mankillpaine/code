 /**
 * Created by miaoyu on 2016/12/16 0016.
 */
// 主播管理
const p_ahManage = resolve => 
		require.ensure(['./view/ahmanage.page.vue'], require => 
			resolve(require('./view/ahmanage.page.vue')), 'anchorAhManage');

// 主播详情
const p_ahDetail = resolve => 
		require.ensure(['./view/ahdetail.page.vue'], require => 
			resolve(require('./view/ahdetail.page.vue')), 'anchorAhdetail');

// 直播历史
const p_ahHistory = resolve => 
		require.ensure(['./view/ahhistory.page.vue'], require => 
			resolve(require('./view/ahhistory.page.vue')), 'anchorAhhistory');

// 日直播记录
const p_ahRecord = resolve => 
		require.ensure(['./view/ahrecord.page.vue'], require => 
			resolve(require('./view/ahrecord.page.vue')), 'anchorAhrecord');


// live 模块路配置
const config = [
	{	// 主播管理
		path: 'ahmanage',
		component: p_ahManage
	}, 
	{	// 主播详情
		path: 'ahdetail/:platform/:platformid',
		component: p_ahDetail
	}, 
	{	// 直播历史
		path: 'ahhistory/:platform/:platformid',
		component: p_ahHistory
	}, 
	{	// 日直播记录
		name: 'ahrecord',
		path: 'ahrecord/:platform/:platformid',
		component: p_ahRecord
	}
];


// 导出模块
export { config };