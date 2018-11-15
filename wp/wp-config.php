<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/u1059/ace/workspace/php/appcode/webroot/htdocs/wp/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'r867x6v6f7');

/** MySQL数据库用户名 */
define('DB_USER', 'r867x6v6f7');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'Toubuweb2709');

/** MySQL主机 */
define('DB_HOST', 'rm-bp1m239x9fuh7y15f.mysql.rds.aliyuncs.com');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',!PJUs>Ghx(|va:Q=&1bJGUxM#l_=UxF55C1^S&7f w6`vsz3NckzTmA33jI/?M=');
define('SECURE_AUTH_KEY',  '&jK0Wa+hI76y(xf3]bJdtsBO c26$BPzkRe9A_q7r,L$QP^zm+A0F #_kh(+Zqf{');
define('LOGGED_IN_KEY',    '8 Ge|C0[ZV~)lx=AMYbT3ELhuNw}i3ei]=6v<@bl/.c)3LkIrq8G^3!swgg53&c0');
define('NONCE_KEY',        '7t ]re5ooH*RNa/9;!?=fd_D@*e#jw=8}^SA}p|Ou_WCc_2,+wwf3@}IO?[4=QYS');
define('AUTH_SALT',        '[0!(`Z_*d+|pv*5ku ks!U,C9,15tPu_BtPqXmcYkh`7rdG<[L+5RRp]7AH^9K8O');
define('SECURE_AUTH_SALT', '*/`[%>&Xb?!x!}W12jJ/>fhQK1yOkPq@r70^.e6jz}_`JyG(@Lv:2UU$K4hSDz1J');
define('LOGGED_IN_SALT',   'DZ;vMJ%Ku6,uaA2>+5zHFvx}).ExY}BE{a.l]*U3]`u>;9+&1Qrh~ EZgjKP[qm4');
define('NONCE_SALT',       'L0)Du_7i;BfOxr-1]V[ynM9=IHz/(CBcnQ>@]kk%6{bDwvfyPt]dE#I-q/yv-Fk7');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'tb_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
//关闭核心程序、主题、插件及翻译自动更新
define( 'AUTOMATIC_UPDATER_DISABLED', true );
/**禁用后台主题/插件 编辑噿*/
define( 'DISALLOW_FILE_EDIT', true );
/**禁止对外部服务器发出请求*/
define('WP_HTTP_BLOCK_EXTERNAL', true);
ini_set('display_errors', false);
