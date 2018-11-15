/**
 * Created by miaoyu on 2016/12/16 0016.
 */
import vue from 'vue';
import vueResource from 'vue-resource';
import store from './../store/store.config.js';

// 声明依赖
vue.use(vueResource);


// ajax请求前的钩子，可以拿到req对象
vue.http.interceptors.push((req, next) => {
	const 
		url = req.url,
		{ token, companyId } = store.state.user;


	// 如果用户登陆成功了，将会提取token和companyId传到参数里面
	if (token) Object.assign(req.body, { token, companyId });


	// 是否请求公共api域名
	// 如果没带参数就默认走公共API域名，带了参数就走参数的
	if (!/^https?:\/\//i.test(url)) req.url = vue.config.optionMergeStrategies.constant.API_URL + url;


	// 请求回数据的钩子，可以拿到res对象
	next(res => {
		const { code } = res.body;

		// token失效了的操作
		if (code === 9001) {
			res.ok = false;
		};

		// 逻辑操作失误码（前端传参失误）
		if (code === 9901) {
			res.ok = false;
		};

		// 其他报错
		if (code !== 200) {
			res.ok = false;
		};
	});
});


// 是否启用json传输
// vue.http.options.emulateJSON = false;
// 修改为通用请求头
vue.http.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
// 添加token头
// vue.http.headers.common['Authorization'] = 'xzyrzeurygpze';