<?php 
//添加主题选项
function web589_theme_form(){
	include_once('theme-form.php');
}
function web589_theme_option(){
//	add_menu_page('主题设置选项','主题选项','manage_options','theme_options','web589_theme_form','',6);
//	add_submenu_page('主题设置选项','主题选项','manage_options','theme_options','web589_theme_form','',6);
	add_submenu_page( 'edit.php','Banner图','Banner图','edit_pages','theme_options','web589_theme_form','',6);

//	add_submenu_page( '文章', 'Banner图', 'Banner图', 'manage_options', 'theme_options', 'web589_theme_form' );
}
add_action('admin_menu','web589_theme_option');

//添加文件上传
function web589_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}

function web589_admin_styles() {
	wp_enqueue_style('thickbox');
}
if(isset($_GET['page']) && $_GET['page']=='theme_options'){
	add_action('admin_print_scripts', 'web589_admin_scripts');
	add_action('admin_print_styles', 'web589_admin_styles');
}
?>