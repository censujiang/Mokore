<!--首页盒子，用来显示各种杂七杂八的社交账号  -->
<?php
$image_file = get_random_bg_url() ? 'background-image: url('.get_random_bg_url().');' : '';
$bg_style = mokore_option('focus_height') ? 'background-position: center center;background-attachment: inherit;' : '';
?>
<figure id="centerbg" class="centerbg" style="<?php echo $image_file.$bg_style ?>">
	<?php if(!mokore_option('focus_slant')){ ?>
		<div class="slant-left"></div>
		<div class="slant-right"></div>
	<?php } ?>
	<?php if ( !mokore_option('focus_infos') ){ ?>
	<div class="focusinfo">
   		<?php if (mokore_option('focus_logo')):?>
	     <div class="header-tou"><a href="<?php bloginfo('url');?>" ><img src="<?php echo mokore_option('focus_logo', ''); ?>"></a></div>
	  	<?php else :?>
         <div class="header-tou" ><a href="<?php bloginfo('url');?>"><img src="//wx2.sinaimg.cn/small/006rG8asly1fzte28fllej30dw0dv75c.jpg"></a></div>
      	<?php endif; ?>
		<div class="header-info"><p><?php echo mokore_option('admin_des', 'Carpe Diem and Do what I like'); ?></p></div>
		<div class="top-social">
			<?php if (mokore_option('imgbox_music')){ ?>
				<audio src="<?php echo mokore_option('imgbox_music',''); ?>" preload="meta" loop autoplay id="bgmusic"></audio>
			<?php } ?>
			<!--上面是音乐，下面是社交组件-->
		<?php if (mokore_option('wechat')){ ?>
		<li class="wechat"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/sns/wechat.png"/></a>
			<div class="wechatInner">
				<img src="<?php echo mokore_option('wechat', ''); ?>" alt="微信公众号">
			</div>
		</li>
		<?php } ?>
		<?php if (mokore_option('sina')){ ?>
			<li><a href="<?php echo mokore_option('sina', ''); ?>" target="_blank" class="social-sina" title="sina"><img src="<?php bloginfo('template_url'); ?>/images/sns/sina.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('qq')){ ?>
			<li class="qq"><a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo mokore_option('qq', ''); ?>&site=qq&menu=yes" target="_blank" title="Initiate chat ?"><img src="<?php bloginfo('template_url'); ?>/images/sns/qq.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('qzone')){ ?>
			<li><a href="<?php echo mokore_option('qzone', ''); ?>" target="_blank" class="social-dofan" title="dofan"><img src="<?php bloginfo('template_url'); ?>/images/sns/qzone.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('dofan')){ ?>
			<li><a href="<?php echo mokore_option('dofan', ''); ?>" target="_blank" class="social-dofan" title="dofan"><img src="<?php bloginfo('template_url'); ?>/images/sns/dofan.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('github')){ ?>
			<li><a href="<?php echo mokore_option('github', ''); ?>" target="_blank" class="social-github" title="github"><img src="<?php bloginfo('template_url'); ?>/images/sns/github.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('toutiao')){ ?>
			<li><a href="<?php echo mokore_option('toutiao', ''); ?>" target="_blank" class="social-github" title="toutiao"><img src="<?php bloginfo('template_url'); ?>/images/sns/toutiao.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('kandian')){ ?>
			<li><a href="<?php echo mokore_option('kandian', ''); ?>" target="_blank" class="social-github" title="kandian"><img src="<?php bloginfo('template_url'); ?>/images/sns/kandian.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('lofter')){ ?>
			<li><a href="<?php echo mokore_option('lofter', ''); ?>" target="_blank" class="social-lofter" title="lofter"><img src="<?php bloginfo('template_url'); ?>/images/sns/lofter.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('bili')){ ?>
			<li><a href="<?php echo mokore_option('bili', ''); ?>" target="_blank" class="social-bili" title="bili"><img src="<?php bloginfo('template_url'); ?>/images/sns/bilibili.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('youku')){ ?>
			<li><a href="<?php echo mokore_option('youku', ''); ?>" target="_blank" class="social-youku" title="youku"><img src="<?php bloginfo('template_url'); ?>/images/sns/youku.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('alipay')){ ?>
			<li class="wechat"><a href=""><img src="<?php bloginfo('template_url'); ?>/images/alipay.png"/></a>
		<div class="wechatInner">
			<img src="<?php echo mokore_option('alipay', ''); ?>" alt="支付宝二维码">
		</div>
		</li>
		<?php } ?>
	<?php if (mokore_option('dribbble')){ ?>
			<li><a href="<?php echo mokore_option('dribbble', ''); ?>" target="_blank" class="social-dribbble" title="dribbble"><img src="<?php bloginfo('template_url'); ?>/images/sns/dribbble.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('tieba')){ ?>
			<li><a href="<?php echo mokore_option('tieba', ''); ?>" target="_blank" class="social-tieba" title="tieba"><img src="<?php bloginfo('template_url'); ?>/images/sns/tieba.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('twitter')){ ?>
			<li><a href="<?php echo mokore_option('twitter', ''); ?>" target="_blank" class="social-twitter" title="twitter"><img src="<?php bloginfo('template_url'); ?>/images/sns/twitter.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('zcool')){ ?>
			<li><a href="<?php echo mokore_option('zcool', ''); ?>" target="_blank" class="social-zcool" title="zcool"><img src="<?php bloginfo('template_url'); ?>/images/sns/zcool.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('zhihu')){ ?>
			<li><a href="<?php echo mokore_option('zhihu', ''); ?>" target="_blank" class="social-zhihu" title="zhihu"><img src="<?php bloginfo('template_url'); ?>/images/sns/zhihu.png"/></a></li>
	<?php } ?>
	<?php if (mokore_option('facebook')){ ?>
		<li><a href="<?php echo mokore_option('facebook', ''); ?>" target="_blank" class="social-wangyiyun" title="Facebook"><img src="<?php bloginfo('template_url'); ?>/images/sns/facebook.png"/></a></li>
		<?php } ?>
	<?php if (mokore_option('googleplus')){ ?>
		<li><a href="<?php echo mokore_option('googleplus', ''); ?>" target="_blank" class="social-wangyiyun" title="Google+"><img src="<?php bloginfo('template_url'); ?>/images/sns/googleplus.png"/></a></li>
	<?php } ?>
	<?php if (mokore_option('jianshu')){ ?>
		<li><a href="<?php echo mokore_option('jianshu', ''); ?>" target="_blank" class="social-wangyiyun" title="简书"><img src="<?php bloginfo('template_url'); ?>/images/sns/jianshu.png"/></a></li>
	<?php } ?>
	<?php if (mokore_option('csdn')){ ?>
		<li><a href="<?php echo mokore_option('csdn', ''); ?>" target="_blank" class="social-wangyiyun" title="CSDN"><img src="<?php bloginfo('template_url'); ?>/images/sns/csdn.png"/></a></li>
	<?php } ?>
	  	</div>
	</div>
	<?php } ?>
</figure>
<?php
echo bgvideo(); //BGVideo
