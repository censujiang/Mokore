<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mokore
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title itemprop="name"><?php global $page, $paged;wp_title( '-', true, 'right' );
bloginfo( 'name' );$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) ) echo " - $site_description";if ( $paged >= 2 || $page >= 2 ) echo ' - ' . sprintf( __( '第 %s 页'), max( $paged, $page ) );?>
</title>
<?php
if (mokore_option('mokore_meta') == true) {
	$keywords = '';
	$description = '';
	if ( is_singular() ) {
		$keywords = '';
		$tags = get_the_tags();
		$categories = get_the_category();
		if ($tags) {
			foreach($tags as $tag) {
				$keywords .= $tag->name . ',';
			};
		};
		if ($categories) {
			foreach($categories as $category) {
				$keywords .= $category->name . ',';
			};
		};
		$description = mb_strimwidth( str_replace("\r\n", '', strip_tags($post->post_content)), 0, 240, '…');
	} else {
		$keywords = mokore_option('mokore_meta_keywords');
		$description = mokore_option('mokore_meta_description');
	};
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if(mokore_option('mokore_logo_ico')){ ?>
<link rel="shortcut icon" href="<?php echo mokore_option('mokore_logo_ico'); ?>"/>
<?php } ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/inc/css/share.min.css">
<!-- 自定义CSS开始 -->
<?php if(mokore_option('head_css')){ ?>
<link rel="stylesheet" href="<?php echo mokore_option('head_css'); ?>">
<?php } ?>
<!-- 自定义CSS结束 -->
<style>
	.row { padding: 20px 0 0 20px }
	.row-pad { padding: 20px 0 0 60px }
</style>
<?php wp_head(); ?>
<script type="text/javascript">
if (!!window.ActiveXObject || "ActiveXObject" in window) { //is IE?
  alert('您的浏览器为IE内核，请使用Chrome浏览器或切换您的浏览器内核，否则某些页面无法正常显示。');
}
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?a5ddc931c4e93dcc1834e89b4b003cbd";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
<!-- 自定义head开始 -->
<?php if(mokore_option('head_code')){ ?>
<?php echo mokore_option('head_code'); ?>
<?php } ?>
<!-- 自定义head结束 -->
</head>
<body <?php body_class(); ?>>
	<section id="main-container">
		<?php
		if(!mokore_option('head_focus')){
		$filter = mokore_option('focus_img_filter');
		?>
		<div class="headertop">
			<?php get_template_part('layouts/imgbox'); ?>
		</div>
		<?php } ?>
		<div id="page" class="site wrapper">
			<header class="site-header" role="banner">
				<div class="site-top">
					<div class="site-branding">
						<?php if (mokore_option('mokore_logo')){ ?>
						<div class="site-title"><a href="<?php bloginfo('url');?>" ><img src="<?php echo mokore_option('mokore_logo'); ?>"></a></div>
						<?php }else{ ?>
						<h1 class="site-title"><a href="<?php bloginfo('url');?>" ><?php bloginfo('name');?></a></h1>
						<?php } ?><!-- logo end -->
					</div><!-- .site-branding -->
					<?php header_user_menu(); if(mokore_option('top_search') == 'yes') { ?>
					<div class="searchbox"><i class="iconfont js-toggle-search iconsearch">&#xe65c;</i></div>
					<?php } ?>
					<div class="lower"><?php if(!mokore_option('shownav')){ ?>
						<div id="show-nav" class="showNav">
							<div class="line line1"></div>
							<div class="line line2"></div>
							<div class="line line3"></div>
						</div><?php } ?>
						<nav><?php wp_nav_menu( array( 'depth' => 2, 'theme_location' => 'primary', 'container' => false ) ); ?></nav><!-- #site-navigation -->
					</div>
				</div>
			</header><!-- #masthead -->
			<?php the_headPattern(); ?>
		    <div id="content" class="site-content">
