<?php

/**
 * NEXT / PREVIOUS POSTS (精华版)
 */

if ( mokore_option('post_nepre') == 'yes') {
?>
<section class="post-squares nextprev">
	<div class="post-nepre <?php if(get_next_post()){echo 'half';}else{echo 'full';} ?> previous">
		<?php previous_post_link('%link','<div class="background" style="background-image:url('.get_prev_thumbnail_url().');"></div><span class="label">看看上一篇文章吧</span><div class="info"><h3>%title</h3><hr></div>') ?>
	</div>
	<div class="post-nepre <?php if(get_previous_post()){echo 'half';}else{echo 'full';} ?> next">
		<?php next_post_link('%link','<div class="background" style="background-image:url('.get_next_thumbnail_url().');"></div><span class="label">下一篇文章更有趣</span><div class="info"><h3>%title</h3><hr></div>') ?>
	</div>
</section>
<?php } ?>
