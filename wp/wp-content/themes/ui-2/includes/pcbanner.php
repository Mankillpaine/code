<?php
//类ClassicOptions
class ClassicOptions {
    /* -- getOptions函数获取选项组 -- */
    function getOptions() {
        // 在数据库中获取选项组
        $options = get_option('classic_options');
        // 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库
        if (!is_array($options)) {
            //初始默认数据
            $options['ashu_copy_right'] = '阿树工作室';

            //这里可添加更多设置选项

            update_option('classic_options', $options);
        }
        // 返回选项组
        return $options;
    }
    /* -- init函数 初始化 -- */
    function init() {
        // 如果是 POST 提交数据, 对数据进行限制, 并更新到数据库
        if(isset($_POST['classic_save'])) {
            // 获取选项组, 因为有可能只修改部分选项, 所以先整个拿下来再进行更改
            $options = ClassicOptions::getOptions();
            // 数据处理
            $options['ashu_copy_right'] = stripslashes($_POST['ashu_copy_right']);

            //在这追加其他选项的限制处理

            // 更新数据
            update_option('classic_options', $options);

        } else {
            // 否则, 重新获取选项组, 也就是对数据进行初始化
            ClassicOptions::getOptions();
        }

        //添加设置页面
        add_theme_page("主题设置", "主题设置", 'edit_themes', basename(__FILE__), array('ClassicOptions', 'display'));
    }
    /* -- 标签页 -- */
    function display() {
        //加载upload.js文件
        wp_enqueue_script('my-upload', get_bloginfo( 'stylesheet_directory' ) . '/js/upload.js');
        //加载上传图片的js(wp自带)
        wp_enqueue_script('thickbox');
        //加载css(wp自带)
        wp_enqueue_style('thickbox');
        $options = ClassicOptions::getOptions(); ?>
        <form method="post" enctype="multipart/form-data" name="classic_form" id="classic_form">
            <div class="wrap">
                <h2><?php _e('阿树工作室主题设置'); ?></h2>
                <p>
                    <label>
                        <input type="text" size="80" name="ashu_logo" id="ashu_logo" value="<?php echo($options['ashu_logo']); ?>"/>
                        <input type="button" value="上传" class="ashu_bottom"/>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="text" size="80" name="ashu_ico" id="ashu_ico" value="<?php echo($options['ashu_ico']); ?>"/>
                        <input type="button" value="上传" class="ashu_bottom"/>
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="classic_save" value="<?php _e('保存设置'); ?>" />
                </p>
            </div>
        </form>
        <?php
    }
}

/*初始化，执行ClassicOptions类的init函数*/
add_action('admin_menu', array('ClassicOptions', 'init'));
?>