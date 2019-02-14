<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mokore
 */

$i=0; while ( have_posts() ) : the_post(); $i++;
$class = ($i%2 == 0) ? 'post-list-thumb-left' : ''; // 如果为偶数
if(has_post_thumbnail()){
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	$post_img = $large_image_url[0];
}else{
	$post_img = get_bloginfo('template_url') . 'http://wx2.sinaimg.cn/small/006rG8asly1fzte2eg8hvj30jg0chaao.jpg';
}
$the_cat = get_the_category();
?>
	<article class="post post-list-thumb <?php echo $class; ?>" itemscope="" itemtype="http://schema.org/BlogPosting">
		<div class="post-thumb">
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo $post_img; ?>);"></a>
		</div><!-- thumbnail-->
		<div class="post-content-wrap">
			<div class="post-content">
				<div class="post-date">
					<i class="iconfont">&#xe65f;</i><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?>
					<?php if(is_sticky()) : ?>
					&nbsp;<i class="iconfont hotpost">&#xe758;</i>
			 		<?php endif ?>
				</div>
				<a href="<?php the_permalink(); ?>" class="post-title"><h3><?php the_title();?></h3></a>
				<div class="post-meta">
					<span><i class="iconfont">&#xe73d;</i><?php echo get_post_views(get_the_ID()); ?> 热度</span>
					<span class="comments-number"><i class="iconfont">&#xe731;</i><?php comments_popup_link('NOTHING', '1 条评论', '% 条评论'); ?></span>
					<span><i class="iconfont">&#xe739;</i><a href="<?php echo esc_url(get_category_link($the_cat[0]->cat_ID)); ?>"><?php echo $the_cat[0]->cat_name; ?></a>
					</span>
				</div>
				<div class="float-content">
					<?php the_excerpt(); ?>
					<div class="post-bottom">
						<a href="<?php the_permalink(); ?>" class="button-normal"><i class="iconfont">&#xe6a0;</i></a>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
endwhile;
