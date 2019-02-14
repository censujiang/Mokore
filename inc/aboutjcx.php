<?php

function mokore_add_admin_menu_page(){
		add_menu_page('aboutjcx', '关于江程训', 'edit_themes', 'mokore_admin_page_root', 'mokore_admin_page', 'dashicons-flag', 100);
	}

function mokore_admin_page(){
    echo '</br>
<p style="text-align: center;"><img class="size-medium aligncenter" src="https://a1.kuyingfang.cn/2018/07/640.jpg" width="100" height="100" /></p>
<h1 style="text-align: center;"><strong>江程训</strong></h1>
<p style="text-align: center;">技术宅，漫宅和伪娘于一身的废萌聚合体</p>
<p style="text-align: center;">经常写前端的后端工程师并兼职产品狗和设计师</p>
<p style="text-align: center;">性别男，爱好女</p>
<p style="text-align: center;">逗帆团队的产品经理老司机，同时也是社长</p>
<p style="text-align: center;">小时候想着Change the World，但是最后被世界改变</p>
<p style="text-align: center;">一天没什么远大的理想，当个死宅算了（删掉）</p>
<p style="text-align: center;">所以还是非常感谢您使用Mokore主题</p>
<p style="text-align: center;">如果有什么问题可以进群交流<a href="http://shang.qq.com/wpa/qunwpa?idkey=d99e5a83cbba65cd3054bd38b0c9b6bb8cc524b32d269ccb5d67e6d46723f569" target="_blank" rel="noopener noreferrer"><i class="fab fa-qq">346363551</i></a></p>
<p style="text-align: center;"><a href="https://github.com/censujiang/Mokore">Mokore主题Github（欢迎Star）</a></p>
<p style="text-align: center;"><a href="https://dfjcx.cn/">江程训个人博客链接（如果您在Wordpress建站过程中有啥不懂得可以来这里看看哦）</a></p>';
}
add_action('admin_menu', 'mokore_add_admin_menu_page');

/**
	 *  Enque admin styles for mokore and page
	 *
	 */
	function mokore_admin_enqueue_style(){
		wp_register_style('mokore_admin_css', get_template_directory_uri() . '/inc/css/admin.css', false);
		wp_enqueue_style('mokore_admin_css');
	}
	add_action('admin_enqueue_scripts', 'mokore_admin_enqueue_style');
