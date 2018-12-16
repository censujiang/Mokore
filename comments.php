<?php

	/**
	 * COMMENTS TEMPLATE
	 */

	/*if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(esc_html__('Please do not load this page directly.', 'mokore'));*/

	if(post_password_required()){
		return;
	}

?>

	<?php if(comments_open()): ?>

	<section id="comments" class="comments">

		<div class="commentwrap comments-hidden">
			<div class="notification"><i class="iconfont">&#xe731;</i><?php esc_html_e('查看评论', 'mokore'); ?> -
			<span class="noticom"><?php comments_number('NOTHING', '1 条评论', '% 条评论'); ?> </span>
			</div>
		</div>

		<div class="comments-main">
		 <h3 id="comments-list-title">COMMENTS | <span class="noticom"><?php comments_number('NOTHING', '1 条评论', '% 条评论'); ?> </span></h3>
		<div id="loading-comments"><span></span></div>
			<?php if(have_comments()): ?>

				<ul class="commentwrap">
					<?php wp_list_comments('type=comment&callback=mokore_comment_format'); ?>
				</ul>

          <nav id="comments-navi">
				<?php paginate_comments_links('prev_text=« Older&next_text=Newer »');?>
			</nav>

			 <?php else : ?>

				<?php if(comments_open()): ?>
					<div class="commentwrap">
						<div class="notification-hidden"><i class="iconfont">&#xe731;</i> <?php esc_html_e('兄Die，确定不抢沙发吗？', 'mokore'); ?></div>

					</div>
				<?php endif; ?>

			<?php endif; ?>

			<?php

				if(comments_open()){
					if(mokore_option('norobot')) $robot_comments = '<label class="mokore-checkbox-label"><input class="mokore-checkbox-radio" type="checkbox" name="no-robot"><span class="mokore-no-robot-checkbox mokore-checkbox-radioInput"></span>滴！网络好卡</label>';
					$private_ms = mokore_option('open_private_message') ? '<label class="mokore-checkbox-label"><input class="mokore-checkbox-radio" type="checkbox" name="is-private"><span class="mokore-is-private-checkbox mokore-checkbox-radioInput"></span>私密评论</label>' : '';
					$args = array(
						'id_form' => 'commentform',
						'id_submit' => 'submit',
						'title_reply' => '',
						'title_reply_to' => '<div class="graybar"><i class="fa fa-comments-o"></i>' . esc_html__('Leave a Reply to', 'mokore') . ' %s' . '</div>',
						'cancel_reply_link' => esc_html__('取消回复', 'mokore'),
						'label_submit' => esc_html__('发表言论', 'mokore'),
						'comment_field' => '<textarea placeholder="' . esc_attr__('期待大佬的精彩发言', 'mokore') . ' ..." name="comment" class="commentbody" id="comment" rows="5" tabindex="4"></textarea>',
						'comment_notes_after' => '',
						'comment_notes_before' => '',
						'fields' => apply_filters( 'comment_form_default_fields', array(
							'author' =>
								'<input type="text" placeholder="' . esc_attr__('昵称', 'mokore') . ' ' . ( $req ?  '(' . esc_attr__('必填项', 'mokore') . ')' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1" ' . ($req ? "aria-required='true'" : '' ). ' />',
							'email' =>
								'<input type="text" placeholder="' . esc_attr__('邮箱', 'mokore') . ' ' . ( $req ? '(' . esc_attr__('必填项', 'mokore') . ')' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1" ' . ($req ? "aria-required='true'" : '' ). ' />',
							'url' =>
								'<input type="text" placeholder="' . esc_attr__('个人网站/博客', 'mokore') . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" />' . $robot_comments . $private_ms
							)
						)
					);
					comment_form($args);
				}

			?>

		</div>


	</section>

<?php endif; ?>
