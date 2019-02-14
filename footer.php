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
				<!--<p class="foo-logo" style="background-image: url('<?php bloginfo('template_url'); ?>/images/f-logo.png');"></p>下个版本再改-->
				<p><?php echo mokore_option('footer_info', ''); ?></p>
			</div>
			<div class="footer-device">
			<?php
			$statistics_link = mokore_option('site_statistics_link') ? '<a href="'.mokore_option('site_statistics_link').'" target="_blank" rel="nofollow">Statistics</a>' : '';
			$site_map_link = mokore_option('site_map_link') ? '<a href="'.mokore_option('site_map_link').'" target="_blank" rel="nofollow">Sitemap</a>' : '';
			printf(esc_html__( '%1$s &nbsp; %2$s &nbsp; %3$s &nbsp; %4$s', 'mokore' ), $site_map_link, '<a href="https://wordpress.org/" rel="designer" target="_blank" rel="nofollow">WordPress</a>强力驱动', '/','主题<a href="http://mokore.dfjcx.cn" target="_blank" rel="friend">Mokore</a> BY <a href="https://dfjcx.cn" target="_blank" rel="friend">江程训</a>', $statistics_link);
			?>
			<!-- 站点运行天数开始 -->
			<?php if (mokore_option('web_runtime') != '0') { ?>
					<div class="footer-device">
							<p>本站已稳定运行 <?php echo get_web_buildtime(); ?> 天</p>
					</div>
			<?php } ?>
			<!--站点运行天数结束  -->
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
			<?php $ava = mokore_option('focus_logo') ? mokore_option('focus_logo') : get_template_directory_uri().'http://wx2.sinaimg.cn/small/006rG8asly1fzte28fllej30dw0dv75c.jpg'; ?>
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
	<!-- 搜索代码开始 -->
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
	<!-- 搜索代码结束 -->
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/inc/js/jquery-1.10.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>/inc/js/jquery.share.min.js"></script>
<script>
	$('#share-1').share();
	$('#share-2').share({sites: ['qzone', 'qq', 'weibo','wechat']});
	$('#share-3').share();
	$('#share-4').share();
</script>
<!-- Footer代码开始 -->
<?php if(mokore_option('footer_code')){ ?>
<?php echo mokore_option('footer_code'); ?>
<?php } ?>
<!-- Footer代码结束 -->
</body>
</html>
