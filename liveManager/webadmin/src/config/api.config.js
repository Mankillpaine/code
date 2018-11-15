/**
 * Created by miaoyu on 2016/12/16 0016.
 * api查询地址：http://www.manager.com/api
 */
const api = {
	// 今日总览接口
	todayall: {
		alltoday: '/company_sum/pageIndex',	   //—— 总览（实时数据、日平台数据分布）
		incomeImg: '/companyDaily/income', 	   //—— 月收入趋势（曲线图）
		followerImg: '/companyDaily/follower', //—— 月粉丝趋势（曲线图） 
		topOnline: '/starDaily/topOnline',	   //—— 在线最高主播 
		topFans: '/starDaily/topFans',		   //—— 日增粉最多主播
		topIncome: '/starDaily/topIncome',     //—— 日收入最高主播
		topLivetime: '/starDaily/TopLivetime'  //—— 日时长最高主播
	},
	// 收入分析接口
	income: {
		incomeImg: '/companyDaily/income', 	          //—— 月收入趋势（趋势图/月收入明细）
		pageIncome: '/company_sum/pageIncome',        //—— 本月收入/累计收入
		groupIncome: '/company_sum/groupIncome',      //—— 小组贡献榜
		rateStar: '/company_sum/rateStar',		      //—— 达标主播榜
		pagePlatincome: '/company_sum/pagePlatincome' //—— 平台贡献榜
	},
	// 增粉分析接口
	addfans: {
		followerImg: '/companyDaily/follower',     		  //—— 月粉丝趋势（曲线图/增粉明细） 
		pageFollower: '/company_sum/pageFollower', 		  //—— 本月增粉/累计增粉
		pageFllowerPlat: '/company_sum/pageFllower_plat', //—— 平台增粉榜
		groupFollower: '/company_sum/groupFollower',	  //—— 小组增粉榜
		monthStarfans: '/company_sum/monthStarfans'		  //—— 主播增粉榜
	},
	// 日考勤报表
	dayCheck: {
		pageWork: '/company_sum/pageWork',   //—— 日考勤总览
		starRate: '/starDaily/Starrate',     //—— 日达标考勤
		unrateStar: '/starDaily/unrateStar', //—— 日未达标考勤
		gourps: '/starDaily/gourps'			 //—— 小组考勤
	},
	// 月考勤报表
	monthCheck: {
		pagemonthWork: '/company_sum/pagemonthWork', //—— 月考勤总览
		monthDetail: '/company_sum/monthDetail',     //—— 月考勤明细
		rateStar: '/company_sum/rateStar',		     //—— 全勤主播
		unrateStar: '/company_sum/unrateStar',       //—— 缺勤主播
		monthWork: '/company_sum/monthWork'		     //—— 本月小组考勤
	},
	// 主播管理
	anchor: {
		starManager: '/company_sum/starManager',   //—— 主播管理总览
		menu: '/stars/menu',					   //—— 筛选器数据
		filter: '/stars/filter',			       //—— 主播信息
		search: '/company_sum/search',			   //—— 主播信息搜索
		starDetail: '/company_sum/starDetail',     //—— 主播详情
		starLiveState: '/starDaily/starLiveState', //—— 直播的状态
		liveUrl: '/company_sum/liveUrl',     	   //—— 直播链接
		livehistry: '/starDaily/livehistry', 	   //—— 直播历史
		livehistrys: '/company_sum/livehistrys',   //—— 直播记录
		livelog: '/company_sum/livelog'             //—— 日直播时长
	},
	// 用户接口
	user: {
		login: '/login', //—— 登陆
		reset: '/reset'  //—— 重置密码
	}
};


// 暴露API配置
export default api;