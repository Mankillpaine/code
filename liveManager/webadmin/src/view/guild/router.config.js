/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// 经纪人设置
const p_agentset = resolve => 
		require.ensure(['./view/agentset.page.vue'], require => 
			resolve(require('./view/agentset.page.vue')), 'guildAgentset');

// 主播设置
const p_anchorset = resolve => 
		require.ensure(['./view/anchorset.page.vue'], require => 
			resolve(require('./view/anchorset.page.vue')), 'guildAnchorset');

// 主播级别设置
const p_levelset = resolve => 
		require.ensure(['./view/levelset.page.vue'], require => 
			resolve(require('./view/levelset.page.vue')), 'guildLevel');

// 自刷账号设置
const p_brushset = resolve => 
		require.ensure(['./view/brushset.page.vue'], require => 
			resolve(require('./view/brushset.page.vue')), 'guildBrushset');

// 修改密码
const p_updatepass = resolve => 
		require.ensure(['./view/updatepass.page.vue'], require => 
			resolve(require('./view/updatepass.page.vue')), 'guildPpdatepass');


// guild 模块路配置
const config = [
	{   // 经纪人设置
		path: 'agentset',
		component: p_agentset
	},
	{   // 主播设置
		path: 'anchorset',
		component: p_anchorset
	},
	{   // 主播级别设置
		path: 'levelset',
		component: p_levelset
	},
	{   // 自刷账号设置
		path: 'brushset',
		component: p_brushset
	},
	{   // 修改密码
		path: 'updatepass',
		component: p_updatepass
	}
];

// 导出模块
export { config };