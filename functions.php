<?php
/**
 * Mokore functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mokore
 */
 //检测主题更新 wpdaxue.com
 require_once(TEMPLATEPATH . '/theme-update-checker.php');
 $wpdaxue_update_checker = new ThemeUpdateChecker(
 	'Mokore', //主题名字
 	'http://img0.dfjcx.cn/mokore/info.json'  //info.json 的访问地址
 );

define( 'MOKORE_VERSION', '1.1' );

if ( !function_exists( 'mokore_setup' ) ) :
/*
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}



function mokore_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mokore, use a find and replace
	 * to change 'mokore' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mokore', get_template_directory() . '/languages' );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( '导航菜单', 'mokore' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'status',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mokore_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_filter('pre_option_link_manager_enabled','__return_true');

	// 优化代码
	//去除头部冗余代码
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
	   remove_action( 'wp_head', 'wp_generator' ); //隐藏wordpress版本
    remove_filter('the_content', 'wptexturize'); //取消标点符号转义

	remove_action('rest_api_init', 'wp_oembed_register_route');
	remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
	remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	// Remove the Link header for the WP REST API
	// [link] => <http://cnzhx.net/wp-json/>; rel="https://api.w.org/"
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

	function coolwp_remove_open_sans_from_wp_core() {
		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );
		wp_enqueue_style('open-sans','');
	}
	add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );

	/**
	* Disable the emoji's
	*/
	function disable_emojis() {
	 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	 remove_action( 'wp_print_styles', 'print_emoji_styles' );
	 remove_action( 'admin_print_styles', 'print_emoji_styles' );
	 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	}
	add_action( 'init', 'disable_emojis' );

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 *
	 * @param    array  $plugins
	 * @return   array             Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
	 if ( is_array( $plugins ) ) {
	 return array_diff( $plugins, array( 'wpemoji' ) );
	 } else {
	 return array();
	 }
	}

	// 移除菜单冗余代码
	add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
	add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
	add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
	function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
	}

}
endif;
add_action( 'after_setup_theme', 'mokore_setup' );

function admin_lettering(){
    echo'<style type="text/css">body{font-family: Microsoft YaHei;}</style>';
}
add_action('admin_head', 'admin_lettering');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mokore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mokore_content_width', 640 );
}
add_action( 'after_setup_theme', 'mokore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function mokore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mokore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mokore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mokore_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function mokore_scripts() {
	wp_enqueue_style( 'mokore', get_stylesheet_uri(), array(), MOKORE_VERSION );
	wp_enqueue_script( 'jq', get_template_directory_uri() . '/js/jquery.min.js', array(), MOKORE_VERSION, true );
	wp_enqueue_script( 'pjax-libs', get_template_directory_uri() . '/js/jquery.pjax.js', array(), MOKORE_VERSION, true );
	wp_enqueue_script( 'input', get_template_directory_uri() . '/js/input.min.js', array(), MOKORE_VERSION, true );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array(), MOKORE_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// 20161116 @Louie
	$mv_live = mokore_option('focus_mvlive') ? 'open' : 'close';
	$movies = mokore_option('focus_amv') ? array('url' => mokore_option('amv_url'), 'name' => mokore_option('amv_title'), 'live' => $mv_live) : 'close';
	$auto_height = mokore_option('focus_height') ? 'fixed' : 'auto';
	$code_lamp = mokore_option('open_prism_codelamp') ? 'open' : 'close';
	if(wp_is_mobile()) $auto_height = 'fixed'; //拦截移动端
	wp_localize_script( 'app', 'Poi' , array(
		'pjax' => mokore_option('poi_pjax'),
		'movies' => $movies,
		'windowheight' => $auto_height,
		'codelamp' => $code_lamp,
		'ajaxurl' => admin_url('admin-ajax.php'),
		'order' => get_option('comment_order'), // ajax comments
		'formpostion' => 'bottom' // ajax comments 默认为bottom，如果你的表单在顶部则设置为top。
	));
}
add_action( 'wp_enqueue_scripts', 'mokore_scripts' );

/**
 * load .php.
 */
require get_template_directory() .'/inc/decorate.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * function update
 */
require get_template_directory() . '/inc/mokore-update.php';
require get_template_directory() . '/inc/categories-images.php';

/**
 * aboutjcx.
 */
require get_template_directory() . '/inc/aboutjcx.php';


/**
 * COMMENT FORMATTING
 */
if(!function_exists('mokore_comment_format')){
	function mokore_comment_format($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
			<div class="contents">
				<div class="comment-arrow">
					<div class="main shadow">
						<div class="profile">
							<a href="<?php comment_author_url(); ?>"><?php echo get_avatar( $comment->comment_author_email, '80', '', get_comment_author() ); ?></a>
						</div>
						<div class="commentinfo">
							<section class="commeta">
								<div class="left">
									<h4 class="author"><a href="<?php comment_author_url(); ?>"><?php echo get_avatar( $comment->comment_author_email, '24', '', get_comment_author() ); ?><?php comment_author(); ?> <span class="isauthor" title="<?php esc_attr_e('Author', 'mokore'); ?>">博主</span></a></h4>
								</div>
								<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
								<div class="right">
									<div class="info"><time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date_gmt), true );//comment_date(get_option('date_format')); ?></time><?php echo mokore_get_useragent($comment->comment_agent); ?></div>
								</div>
							</section>
						</div>
						<div class="body">
							<?php comment_text(); ?>
						</div>
					</div>
					<div class="arrow-left"></div>
				</div>
			</div>
			<hr>
		<?php
	}
}


/**
 * post views.
 * @bigfa
 */
function restyle_text($number) {
    if($number >= 1000) {
        return round($number/1000,2) . 'k';
    }else{
        return $number;
    }
}

function set_post_views() {
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if(is_single() || is_page()) {
        if(!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}
add_action('get_header', 'set_post_views');

function get_post_views($post_id) {
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if($views == '') {
        return 0;
    }else{
        return restyle_text($views);
    }
}


/*
 * Ajax点赞
 */
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $specs_raters = get_post_meta($id,'specs_zan',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('specs_zan_'.$id,$id,$expire,'/',$domain,false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        }
        else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id,'specs_zan',true);
    }
    die;
}


/*
 * 友情链接
 */
function get_the_link_items($id = null){
  $bookmarks = get_bookmarks('orderby=date&category=' .$id );
  $output = '';
  if ( !empty($bookmarks) ) {
      $output .= '<ul class="link-items fontSmooth">';
      foreach ($bookmarks as $bookmark) {
        $output .=  '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" ><span class="sitename">'. $bookmark->link_name .'</span><div class="linkdes">'. $bookmark->link_description .'</div></a></li>';
      }
      $output .= '</ul>';
  }
  return $output;
}

function get_link_items(){
  $linkcats = get_terms( 'link_category' );
  	if ( !empty($linkcats) ) {
      	foreach( $linkcats as $linkcat){
        	$result .=  '<h3 class="link-title">'.$linkcat->name.'</h3>';
        	if( $linkcat->description ) $result .= '<div class="link-description">' . $linkcat->description . '</div>';
        	$result .=  get_the_link_items($linkcat->term_id);
      	}
  	} else {
    	$result = get_the_link_items();
  	}
  return $result;
}


/*
 * Gravatar头像使用中国服务器
 */
function gravatar_cn( $url ){
	$gravatar_url = array('0.gravatar.com','1.gravatar.com','2.gravatar.com');
	return str_replace( $gravatar_url, 'cn.gravatar.com', $url );
}
add_filter( 'get_avatar_url', 'gravatar_cn', 4 );


/*
 * 阻止站内文章互相Pingback
 */
function theme_noself_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) )
	unset($links[$l]);
}
add_action('pre_ping','theme_noself_ping');


/*
 * 订制body类
*/
function mokore_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }
  return $classes;
}
add_filter( 'body_class', 'mokore_body_classes' );


/*
 * 图片七牛云缓存
 */
add_filter( 'upload_dir', 'wpjam_custom_upload_dir' );
function wpjam_custom_upload_dir( $uploads ) {
	$upload_path = '';
	$upload_url_path = mokore_option('qiniu_cdn');

	if ( empty( $upload_path ) || 'wp-content/uploads' == $upload_path ) {
		$uploads['basedir']  = WP_CONTENT_DIR . '/uploads';
	} elseif ( 0 !== strpos( $upload_path, ABSPATH ) ) {
		$uploads['basedir'] = path_join( ABSPATH, $upload_path );
	} else {
		$uploads['basedir'] = $upload_path;
	}

	$uploads['path'] = $uploads['basedir'].$uploads['subdir'];

	if ( $upload_url_path ) {
		$uploads['baseurl'] = $upload_url_path;
		$uploads['url'] = $uploads['baseurl'].$uploads['subdir'];
	}
	return $uploads;
}


/*
 * 删除自带小工具
*/
function unregister_default_widgets() {
	unregister_widget("WP_Widget_Pages");
	unregister_widget("WP_Widget_Calendar");
	unregister_widget("WP_Widget_Archives");
	unregister_widget("WP_Widget_Links");
	unregister_widget("WP_Widget_Meta");
	unregister_widget("WP_Widget_Search");
	unregister_widget("WP_Widget_Text");
	unregister_widget("WP_Widget_Categories");
	unregister_widget("WP_Widget_Recent_Posts");
	unregister_widget("WP_Widget_Recent_Comments");
	unregister_widget("WP_Widget_RSS");
	unregister_widget("WP_Widget_Tag_Cloud");
	unregister_widget("WP_Nav_Menu_Widget");
}
add_action("widgets_init", "unregister_default_widgets", 11);


/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function mokore_jetpack_setup() {
  // Add theme support for Infinite Scroll.
  add_theme_support( 'infinite-scroll', array(
    'container' => 'main',
    'render'    => 'mokore_infinite_scroll_render',
    'footer'    => 'page',
  ) );

  // Add theme support for Responsive Videos.
  add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'mokore_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function mokore_infinite_scroll_render() {
  while ( have_posts() ) {
    the_post();
    if ( is_search() ) :
        get_template_part( 'tpl/content', 'search' );
    else :
        get_template_part( 'tpl/content', get_post_format() );
    endif;
  }
}


/*
 * 编辑器增强
 */
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
// 下载按钮
function download($atts, $content = null) {
return '<a class="download" href="'.$content.'" rel="external"
target="_blank" title="下载地址">
<span><i class="iconfont down">&#xe69f;</i>Download</span></a>';}
add_shortcode("download", "download");

add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');
function bolo_after_wp_tiny_mce($mce_settings) {
?>
<script type="text/javascript">
QTags.addButton( 'download', '下载按钮', "[download]下载地址[/download]" );
function bolo_QTnextpage_arg1() {
}
</script>
<?php }


/*
 * 后台登录页
 * @M.J
 */
//登录页规则
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/inc/login.css" />'."\n";
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/jquery.min.js"></script>'."\n";
}
add_action('login_head', 'custom_login');

//Login Page Title
function custom_headertitle ( $title ) {
	return get_bloginfo('name');
}
add_filter('login_headertitle','custom_headertitle');

//Login Page Link
function custom_loginlogo_url($url) {
	return esc_url( home_url('/') );
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

//Login Page Footer
function custom_html() {
	if ( mokore_option('login_bg') ) {
		$loginbg = mokore_option('login_bg');
	}else{
		$loginbg = get_bloginfo('template_directory').'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1549344693088&di=6a1850d7cff47286425b6fe2a8469d86&imgtype=0&src=http%3A%2F%2Fpic1.win4000.com%2Fwallpaper%2F7%2F592004e368ee1.jpg%3Fdown';
	}
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/login.js"></script>'."\n";
	echo '<script type="text/javascript">'."\n";
	echo 'jQuery(\'#bg\').children(\'img\').attr(\'src\', \''.$loginbg.'\').load(function(){'."\n";
	echo '	resizeImage(\'bg\');'."\n";
	echo '	jQuery(window).bind("resize", function() { resizeImage(\'bg\'); });'."\n";
	echo '	jQuery(\'.loading\').fadeOut();'."\n";
	echo '});';
	echo '</script>'."\n";
}
add_action('login_footer', 'custom_html');


/*
 * 评论邮件回复
 */
function comment_mail_notify($comment_id){
	$mail_user_name = mokore_option('mail_user_name') ? mokore_option('mail_user_name') : 'poi';
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if(($parent_id != '') && ($spam_confirmed != 'spam')){
    $wp_email = $mail_user_name . '@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '你在 [' . get_option("blogname") . '] 的留言有了回应';
    $message = '
    <table border="1" cellpadding="0" cellspacing="0" width="600" align="center" style="border-collapse: collapse; border-style: solid; border-width: 1;border-color:#ddd;">
	<tbody>
          <tr>
            <td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="48" >
                    <tbody><tr>
                        <td width="100" align="center" style="border-right:1px solid #ddd;">
                            <a href="'.home_url().'/" target="_blank">'. get_option("blogname") .'</a></td>
                        <td width="300" style="padding-left:20px;"><strong>您有一条来自 <a href="'.home_url().'" target="_blank" style="color:#6ec3c8;text-decoration:none;">' . get_option("blogname") . '</a> 的回复</strong></td>
						</tr>
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td  style="padding:15px;"><p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 你好!</span>
              <p>你在《' . get_the_title($comment->comment_post_ID) . '》的留言:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
        . trim(get_comment($parent_id)->comment_content) . '</p><p>
              ' . trim($comment->comment_author) . ' 给你的回复:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
        . trim($comment->comment_content) . '</p>
        <center ><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="background-color:#6ec3c8; border-radius:10px; display:inline-block; color:#fff; padding:15px 20px 15px 20px; text-decoration:none;margin-top:20px; margin-bottom:20px;">点击查看完整内容</a></center>
</td>
          </tr>
          <tr>
            <td align="center" valign="center" height="38" style="font-size:0.8rem; color:#999;">Copyright © '.get_option("blogname").'</td>
          </tr>
		  </tbody>
  </table>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
  }
}
add_action('comment_post', 'comment_mail_notify');

//文章目录
function article_index($content) {
$matches = array();
$ul_li = '';
$r = '/<h([1-4]).*?\>(.*?)<\/h[1-4]>/is';//匹配的H元素到底是多少
if(is_single() && preg_match_all($r, $content, $matches)) {
foreach($matches[1] as $key => $value) {
$title = trim(strip_tags($matches[2][$key]));
$content = str_replace($matches[0][$key], '<h' . $value . ' id="title-' . $key . '">'.$title.'</h2>', $content);
$ul_li .= '<li><a href="#title-'.$key.'" title="'.$title.'">'.$title."</a></li>\n";//内部目录#链接的属性
}
$content = "\n<div id=\"article-index\">
<strong>文章目录</strong>
<ul id=\"index-ul\">\n" . $ul_li . "</ul>
</div>\n" . $content;
}
return $content;
}
add_filter( 'the_content', 'article_index' );

//code end
