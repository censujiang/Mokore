<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mokore
 */

?>
	</div><!-- #content -->
	<?php
		if(mokore_option('general_disqus_plugin_support')){
			get_template_part('layouts/duoshuo');
		}else{
			comments_template('', true);
		}
	?>
	</div><!-- #page Pjax container-->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="footertext">
				<p class="foo-logo" style="background-image: url('<?php bloginfo('template_url'); ?>/images/f-logo.png');"></p>
				<p><?php echo mokore_option('footer_info', ''); ?></p>
			</div>
			<div class="footer-device">
			<?php
			$statistics_link = mokore_option('site_statistics_link') ? '<a href="'.mokore_option('site_statistics_link').'" target="_blank" rel="nofollow">Statistics</a>' : '';
			$site_map_link = mokore_option('site_map_link') ? '<a href="'.mokore_option('site_map_link').'" target="_blank" rel="nofollow">Sitemap</a>' : '';
			printf(esc_html__( '%1$s &nbsp; %2$s &nbsp; %3$s &nbsp; %4$s', 'mokore' ), $site_map_link, '本站主题<a href="http://mokore.dfjcx.cn" rel="designer" target="_blank" rel="nofollow">Mokore</a>', '|自豪地使用<a href="https://wordpress.org/" target="_blank" rel="nofollow">WordPress</a>', $statistics_link);
			?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div class="openNav">
		<div class="iconflat">
			<div class="icon"></div>
		</div>
		<div class="site-branding">
			<?php if (mokore_option('mokore_logo')){ ?>
			<div class="site-title"><a href="<?php bloginfo('url');?>" ><img src="<?php echo mokore_option('mokore_logo'); ?>"></a></div>
			<?php }else{ ?>
			<h1 class="site-title"><a href="<?php bloginfo('url');?>" ><?php bloginfo('name');?></a></h1>
			<?php } ?>
		</div>
	</div><!-- m-nav-bar -->
	</section><!-- #section -->
	<!-- m-nav-center -->
	<div id="mo-nav">
		<div class="m-avatar">
			<?php $ava = mokore_option('focus_logo') ? mokore_option('focus_logo') : get_template_directory_uri().'/images/avatar.jpg'; ?>
			<img src="<?php echo $ava ?>">
		</div>
		<div class="m-search">
			<form class="m-search-form" method="get" action="<?php echo home_url(); ?>" role="search">
				<input class="m-search-input" type="search" name="s" placeholder="<?php _e('搜索...', 'mokore') ?>" required>
			</form>
		</div>
		<?php wp_nav_menu( array( 'depth' => 2, 'theme_location' => 'primary', 'container' => false ) ); ?>
	</div><!-- m-nav-center end -->
	<a href="#" class="cd-top"></a>
	<!-- search start -->
	<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
		<div class="search-form__inner">
			<div>
				<p class="micro mb-"><?php _e('大佬你想找什么呢 ...', 'mokore') ?></p>
				<i class="iconfont">&#xe65c;</i>
				<input class="text-input" type="search" name="s" placeholder="<?php _e('Search', 'mokore') ?>" required>
			</div>
		</div>
		<div class="search_close"></div>
	</form>
	<!-- search end -->
<?php wp_footer(); ?>
<?php if(mokore_option('site_statistics')){ ?>
<div class="site-statistics">
<script type="text/javascript"><?php echo mokore_option('site_statistics'); ?></script>
</div>
<?php } ?>
</body>
</html>
