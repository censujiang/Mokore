<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mokore
 */

 get_header(); ?>

 	<div id="primary" class="content-area">
 		<main id="main" class="site-main" role="main">

 		<?php
 		if ( have_posts() ) : ?>
 		<?php if( !z_taxonomy_image_url()) { ?>
 			<header class="page-header">
 				<h1 class="cat-title"><?php single_cat_title('', true); ?></h1>
 			<span class="cat-des">
 			<?php
 				if(category_description() !== ""){
 					echo "" . category_description();
 				}
 			?>
 			</span>
 			</header><!-- .page-header -->
 		<?php }  ?>

 			<?php
 			/* Start the Loop */
 			while ( have_posts() ) : the_post();
 			?>

 			<?php
 					/*
 					* 如果选择分类ID  那么这个页面将输出works样式
 					*/
 				if ( akina_option('works_multicheck') && is_category(explode(',',akina_option('works_multicheck'))) ){
 					include(TEMPLATEPATH . '/template-parts/works-list.php');
 				} else {
 					/*
 					* Include the Post-Format-specific template for the content.
 					* If you want to override this in a child theme, then include a file
 					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
 					*/
 					get_template_part( 'template-parts/content', get_post_format() );
 				}

 				endwhile; ?>
 				<div class="clearer"></div>

 			<nav class="navigator">
         <?php previous_posts_link('<i class="iconfont">&#xe611;</i>') ?><?php next_posts_link('<i class="iconfont">&#xe60f;</i>') ?>
 	</nav>

 	<?php	else :

 			get_template_part( 'template-parts/content', 'none' );

 		endif; ?>

		</main><!-- #main -->
		<?php if ( mokore_option('pagenav_style') == 'ajax') { ?>
		<div id="pagination" <?php if(mokore_option('image_category') && is_category(explode(',',mokore_option('image_category')))) echo 'class="pagination-archive"'; ?>><?php next_posts_link(__('Previous')); ?></div>
		<?php }else{ ?>
		<nav class="navigator">
        <?php previous_posts_link('<i class="iconfont">&#xe679;</i>') ?><?php next_posts_link('<i class="iconfont">&#xe6a3;</i>') ?>
		</nav>
		<?php } ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
