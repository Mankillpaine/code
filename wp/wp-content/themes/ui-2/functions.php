<?php
//single kuozhan
include( 'includes/metabox.php' );
//theme options
include( 'admin-option/theme-option.php' );
//seo
$DX_seo = get_option( 'other-2' );
if( $DX_seo[0] == 'on' ) include( 'includes/seo/seo.php' );
//theme info
include( 'includes/info.php' );


//谷歌字体
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

//移除顶部多余信息
remove_action( 'wp_head', 'wp_enqueue_scripts', 1 ); //Javascript的调用
remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
remove_action('wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action('publish_future_post','check_and_publish_future_post',10, 1 );
remove_action( 'wp_head', 'noindex', 1 );
remove_action( 'wp_head', 'wp_print_styles', 8 );//载入css
remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
global $wp_widget_factory;
remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ,'recent_comments_style'));
}
//禁止加载WP自带的jquery.js
if ( !is_admin() ) { // 后台不禁止
function my_init_method() {
wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定义
}
add_action('init', 'my_init_method'); 
}
wp_deregister_script( 'l10n' );

//注册导航
register_nav_menus(
      array(
       'main' => __( '主菜单导航' ),'menu2'=>_('菜单2'),'menu3'=>_('菜单3')
      )
   );
   
//禁止代码标点转换
remove_filter('the_content', 'wptexturize');

//编辑器增强
 function enable_more_buttons($buttons) {
     $buttons[] = 'hr';
     $buttons[] = 'del';
     $buttons[] = 'sub';
     $buttons[] = 'sup';
     $buttons[] = 'fontselect';
     $buttons[] = 'fontsizeselect';
     $buttons[] = 'cleanup';
     $buttons[] = 'styleselect';
     $buttons[] = 'wp_page';
     $buttons[] = 'anchor';
     $buttons[] = 'backcolor';
     return $buttons;
     }
add_filter("mce_buttons_3", "enable_more_buttons");

//给文章图片自动添加alt和title信息
add_filter('the_content', 'imagesalt');
function imagesalt($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
//add_filter('pre_site_transient_update_core',    create_function('$a', "return null;")); // 关闭核心提示
//add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;")); // 关闭插件提示
//add_filter('pre_site_transient_update_themes',  create_function('$a', "return null;")); // 关闭主题提示
//remove_action('admin_init', '_maybe_update_core');    // 禁止 WordPress 检查更新
//remove_action('admin_init', '_maybe_update_plugins'); // 禁止 WordPress 更新插件
//remove_action('admin_init', '_maybe_update_themes');  // 禁止 WordPress 更新主题
////关闭核心程序、主题、插件及翻译自动更新
//add_filter( 'automatic_updater_disabled', '__return_true' );


//近期无法显示Gravatar头像的解决办法
function suxingme_replace_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "secure.gravatar.com", $avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'suxingme_replace_avatar', 10, 3 );


//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');


function search_word_replace($buffer){
    if(is_search()){
        $arr = explode(" ", get_search_query());
        $arr = array_unique($arr);
        foreach($arr as $v)
            if($v)
                $buffer = preg_replace("/(".$v.")/i", "<span style=\"background-color:#ff0;\"><strong>$1</strong></span>", $buffer);
    }
    return $buffer;
}
add_filter("the_title", "search_word_replace", 200);
add_filter("the_excerpt", "search_word_replace", 200);
add_filter("the_content", "search_word_replace", 200);


//输出缩略图地址
function post_thumbnail_src(){
	global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
	} else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		if(!empty($matches[1][0])){
			$post_thumbnail_src = $matches[1][0];   //获取该图片 src
		}else{	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 5);
			$post_thumbnail_src = get_template_directory_uri().'/images/random/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//$post_thumbnail_src = get_template_directory_uri().'/images/default_thumb.jpg';
		}
	};
	echo $post_thumbnail_src;
}

// my_add_pages() 为 'admin_menu' 钩子的回调函数
function my_add_pages() {
    // 第一个参数'Help page'为菜单名称，第二个参数'使用帮助'为菜单标题
    // 'manage_options' 参数为用户权限
    // 'my_toplevel_page' 参数用于调用my_toplevel_page()函数，来显示菜单内容
    add_menu_page('pcbanner', '头部PCbanner图管理', 'manage_options', __FILE__, 'my_toplevel_page');
}

// my_toplevel_page() 用于显示菜单的内容，填写菜单页面的HTML代码即可
function my_toplevel_page() {


}
