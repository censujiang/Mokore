<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */



function optionsframework_option_name() {

	// 从样式表获取主题名称
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  请阅读:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	// 测试数据
	$test_array = array(
		'one' => __('1', 'options_framework_theme'),
		'two' => __('2', 'options_framework_theme'),
		'three' => __('3', 'options_framework_theme'),
		'four' => __('4', 'options_framework_theme'),
		'five' => __('5', 'options_framework_theme'),
		'six' => __('6', 'options_framework_theme'),
		'seven' => __('7', 'options_framework_theme')
	);


	// 复选框数组
	$multicheck_array = array(
		'one' => __('法国吐司', 'options_framework_theme'),
		'two' => __('薄煎饼', 'options_framework_theme'),
		'three' => __('煎蛋', 'options_framework_theme'),
		'four' => __('绉绸', 'options_framework_theme'),
		'five' => __('感化饼干', 'options_framework_theme')
	);

	// 复选框默认值
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// 背景默认值
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// 版式默认值
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// 版式设置选项
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => '普通','bold' => '粗体' ),
		'color' => false
	);

	// 将所有分类（categories）加入数组
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// 将所有标签（tags）加入数组
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// 如果使用图片单选按钮, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	//基本设置
	$options[] = array(
		'name' => __('基本设置', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
        'name' => __("主题风格", 'mokore'),
        'id' => 'theme_skin',
        'std' => "#23d3e0",
        'desc' => __('自定义主题颜色', ''),
        'type' => "color"
    );

	$options[] = array(
		'name' => __('logo', 'options_framework_theme'),
		'desc' => __('最佳高度尺寸40px，不然可能会在不同屏幕上出现适配出错哦~', 'options_framework_theme'),
		'id' => 'mokore_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('站点图标', 'options_framework_theme'),
		'desc' => __('设置后你将会在标签页上看到此图标', 'options_framework_theme'),
		'id' => 'mokore_logo_ico',
		'std' => '//wx2.sinaimg.cn/small/006rG8asly1fzte28fllej30dw0dv75c.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('登录页LOGO', 'options_framework_theme'),
		'desc' => __('登录页LOGO为你的站点logo，为什么我要在这里单独说呢？因为现在你可以新建一个页面，选择类型为login，然后在主题设置中强制设定那个页面为登录页。', 'options_framework_theme'),
		'id' => 'mokore_logo_login',
		);

	$options[] = array(
		'name' => __('自定义关键词和描述', 'options_framework_theme'),
		'desc' => __('开启之后可自定义填写关键词和描述，默认关闭', 'options_framework_theme'),
		'id' => 'mokore_meta',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('网站关键词', 'options_framework_theme'),
		'desc' => __('各关键字间用英文逗号","分割，关键词在3-10个最佳，否则不利于SEO', 'options_framework_theme'),
		'id' => 'mokore_meta_keywords',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('网站描述', 'options_framework_theme'),
		'desc' => __('用简洁的文字描述本站点，字数建议在120个字以内,否则不利于SEO', 'options_framework_theme'),
		'id' => 'mokore_meta_description',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('展开导航菜单', 'options_framework_theme'),
		'desc' => __('勾选开启，默认收缩', 'options_framework_theme'),
		'id' => 'shownav',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('头部装饰图', 'options_framework_theme'),
		'desc' => __('默认开启，勾选关闭，显示在文章页面，独立页面以及分类页', 'options_framework_theme'),
		'id' => 'patternimg',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('搜索按钮', 'mokore'),
		'id' => 'top_search',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

	$options[] = array(
		'name' => __('首页文章风格', 'mokore'),
		'id' => 'post_list_style',
		'std' => "standard",
		'type' => "radio",
		'options' => array(
			'standard' => __('标准Akina风格', ''),
			'imageflow' => __('图文并茂（如果您是自媒体就推荐用介个）', '')
		));

	$options[] = array(
		'name' => __('首页文章特色图（仅对标准Akina风格生效）', 'mokore'),
		'id' => 'list_type',
		'std' => "round",
		'type' => "radio",
		'options' => array(
			'round' => __('圆形', ''),
			'square' => __('方形', '')
		));

	$options[] = array(
		'name' => __('评论收缩', 'mokore'),
    'desc' => __('启用评论收缩时，网站访客需要点一下“查看评论”按钮才能看到评论。', 'options_framework_theme'),
		'id' => 'toggle-menu',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

	$options[] = array(
		'name' => __('分页模式', 'mokore'),
		'id' => 'pagenav_style',
		'std' => "ajax",
		'type' => "radio",
		'options' => array(
			'ajax' => __('ajax加载', ''),
			'np' => __('上一页和下一页', '')
		));

	$options[] = array(
		'name' => __('博主描述', 'options_framework_theme'),
		'desc' => __('一段自我描述的话', 'options_framework_theme'),
		'id' => 'admin_des',
		'std' => '这里江程训，感谢使用本主题哦~',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('自定义主题CSS地址', 'options_framework_theme'),
		'desc' => __('如果您需要将您的主题的CSS托管在别处，请复制粘贴下方地址的css文件上传到你想托管的地方，再填写托管后的地址，不过请注意，主题升级时可能CSS将发生变动', 'options_framework_theme'),
		'id' => 'head_css',
		'std' => get_template_directory_uri().'/theme.css',
		'type' => 'text');

	$options[] = array(
		'name' => __('版权信息', 'options_framework_theme'),
		'desc' => __('版权信息文字，支持HTML代码', 'options_framework_theme'),
		'id' => 'footer_info',
		'std' => '&copy; 2019',
		'type' => 'textarea');

		$options[] = array(
		'name' => __('Head代码', 'options_framework_theme'),
		'desc' => __('Head代码，放在body底部，支持HTML代码，如果您需要更专业地插入代码请下载header-footer-code-manage', 'options_framework_theme'),
		'id' => 'head_code',
		'std' => '',
		'type' => 'textarea');

		$options[] = array(
		'name' => __('Footer代码', 'options_framework_theme'),
		'desc' => __('Footer代码，放在body底部，支持HTML代码,如果您需要更专业地插入代码请下载header-footer-code-manage', 'options_framework_theme'),
		'id' => 'footer_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('自定义CSS样式', 'options_framework_theme'),
		'desc' => __('直接填写CSS代码，不需要写style标签', 'options_framework_theme'),
		'id' => 'site_custom_style',
		'std' => '',
		'type' => 'textarea');


	//第一屏
	$options[] = array(
		'name' => __('第一屏', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('总开关', 'options_framework_theme'),
		'desc' => __('默认开启，勾选关闭', 'options_framework_theme'),
		'id' => 'head_focus',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Akina倾斜设计', 'options_framework_theme'),
		'desc' => __('默认关闭，勾选关闭', 'options_framework_theme'),
		'id' => 'focus_slant',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('社交信息', 'options_framework_theme'),
		'desc' => __('默认开启，勾选关闭，显示头像、签名、SNS', 'options_framework_theme'),
		'id' => 'focus_infos',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('全屏显示', 'options_framework_theme'),
		'desc' => __('默认开启，勾选关闭', 'options_framework_theme'),
		'id' => 'focus_height',
		'std' => '0',
		'type' => 'checkbox');

	 $options[] = array(
		'name' => __('开启视频', 'options_framework_theme'),
		'desc' => __('勾选开启', 'options_framework_theme'),
		'id' => 'focus_amv',
		'std' => '0',
		'type' => 'checkbox');

	 $options[] = array(
		'name' => __('Live', 'options_framework_theme'),
		'desc' => __('勾选开启，视频自动续播，需要开启Pjax功能', 'options_framework_theme'),
		'id' => 'focus_mvlive',
		'std' => '0',
		'type' => 'checkbox');

	 $options[] = array(
		'name' => __('视频地址', 'options_framework_theme'),
		'desc' => __('视频的来源地址，该地址拼接下面的视频名，地址尾部不需要加斜杠', 'options_framework_theme'),
		'id' => 'amv_url',
		'std' => '',
		'type' => 'text');

	 $options[] = array(
		'name' => __('视频名称', 'options_framework_theme'),
		'desc' => __('abc.mp4 ，只需要填写视频文件名 abc.mp4 即可，多个用英文逗号隔开如 abc.mp4,efg.mp4 ，无需在意顺序，因为加载是随机的抽取的 ', 'options_framework_theme'),
		'id' => 'amv_title',
		'std' => '',
		'type' => 'text');

	 $options[] = array(
		'name' => __('个人头像', 'options_framework_theme'),
		'desc' => __('最佳高度尺寸130px。', 'options_framework_theme'),
		'id' => 'focus_logo',
		'type' => 'upload');

	 $options[] = array(
		'name' => __('背景图', 'options_framework_theme'),
		'desc' => __('最佳尺寸1920*1080', 'options_framework_theme'),
		'id' => 'focus_img_1',
		'type' => 'upload');

	$options[] = array(
		'name' => __('背景图 - 2', 'options_framework_theme'),
		'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
		'id' => 'focus_img_2',
		'type' => 'upload');

	$options[] = array(
		'name' => __('背景图 - 3', 'options_framework_theme'),
		'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
		'id' => 'focus_img_3',
		'type' => 'upload');

	$options[] = array(
		'name' => __('背景图 - 4', 'options_framework_theme'),
		'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
		'id' => 'focus_img_4',
		'type' => 'upload');

	$options[] = array(
		'name' => __('背景图 - 5', 'options_framework_theme'),
		'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
		'id' => 'focus_img_5',
		'type' => 'upload');

	$options[] = array(
		'name' => __('背景图滤镜', 'mokore'),
		'id' => 'focus_img_filter',
		'std' => "filter-nothing",
		'type' => "radio",
		'options' => array(
			'filter-nothing' => __('无', ''),
			'filter-undertint' => __('浅色', ''),
			'filter-dim' => __('暗淡', ''),
			'filter-grid' => __('网格', '')
		));


	//文章页
	$options[] = array(
		'name' => __('文章页', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('文章点赞', 'mokore'),
		'id' => 'post_like',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

	$options[] = array(
		'name' => __('文章分享', 'mokore'),
		'id' => 'post_share',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

	$options[] = array(
		'name' => __('上一篇下一篇', 'mokore'),
		'id' => 'post_nepre',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

	$options[] = array(
		'name' => __('博主信息', 'mokore'),
		'id' => 'author_profile',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

	$options[] = array(
		'name' => __('支付宝打赏', 'options_framework_theme'),
		'desc' => __('支付宝二维码', 'options_framework_theme'),
		'id' => 'alipay_code',
		'type' => 'upload');

	$options[] = array(
		'name' => __('微信打赏', 'options_framework_theme'),
		'desc' => __('微信二维码', 'options_framework_theme'),
		'id' => 'wechat_code',
		'type' => 'upload');


	//社交选项
	$options[] = array(
		'name' => __('社交设置', 'options_framework_theme'),
		'type' => 'heading');


	$options[] = array(
		'name' => __('微信', 'options_framework_theme'),
		'desc' => __('微信二维码', 'options_framework_theme'),
		'id' => 'wechat',
		'type' => 'upload');

		$options[] = array(
		'name' => __('新浪微博', 'options_framework_theme'),
		'desc' => __('新浪微博地址', 'options_framework_theme'),
		'id' => 'sina',
		'std' => 'https://weibo.com/imjcx',
		'type' => 'text');


	$options[] = array(
		'name' => __('腾讯qq', 'options_framework_theme'),
		'desc' => __('qq号码', 'options_framework_theme'),
		'id' => 'qq',
		'std' => '3392324156',
		'type' => 'text');

	$options[] = array(
		'name' => __('qq空间', 'options_framework_theme'),
		'desc' => __('qq空间地址', 'options_framework_theme'),
		'id' => 'qzone',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('逗帆', 'options_framework_theme'),
		'desc' => __('逗帆已于2019年3月清空了数据库，纪念江程训那逝去的在逗帆奋斗的日子', 'options_framework_theme'),
		'id' => 'dofan',
		'std' => 'https://www.dofan.cn/archives/author/2',
		'type' => 'text');

	$options[] = array(
		'name' => __('GitHub', 'options_framework_theme'),
		'desc' => __('GitHub个人主页地址', 'options_framework_theme'),
		'id' => 'github',
		'std' => 'https://github.com/censujiang',
		'type' => 'text');

	$options[] = array(
		'name' => __('今日头条', 'options_framework_theme'),
		'desc' => __('今日头条地址', 'options_framework_theme'),
		'id' => 'toutiao',
		'std' => 'https://www.toutiao.com/c/user/2569886708/',
		'type' => 'text');

		$options[] = array(
		'name' => __('QQ看点（公众号）', 'options_framework_theme'),
		'desc' => __('QQ看点地址', 'options_framework_theme'),
		'id' => 'kandian',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('lofter', 'options_framework_theme'),
		'desc' => __('lofter地址', 'options_framework_theme'),
		'id' => 'lofter',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('哔哩哔哩', 'options_framework_theme'),
		'desc' => __('哔哩哔哩UP主个人空间地址', 'options_framework_theme'),
		'id' => 'bili',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('优酷', 'options_framework_theme'),
		'desc' => __('优酷主播地址', 'options_framework_theme'),
		'id' => 'youku',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('支付宝', 'options_framework_theme'),
		'desc' => __('支付宝添加朋友二维码', 'options_framework_theme'),
		'id' => 'alipay',
		'type' => 'upload');

	$options[] = array(
		'name' => __('dribbble', 'options_framework_theme'),
		'desc' => __('dribbble地址', 'options_framework_theme'),
		'id' => 'dribbble',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('百度贴吧', 'options_framework_theme'),
		'desc' => __('百度贴吧个人主页地址', 'options_framework_theme'),
		'id' => 'tieba',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('twitter', 'options_framework_theme'),
		'desc' => __('推特个人主页地址', 'options_framework_theme'),
		'id' => 'twitter',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('zcool站酷', 'options_framework_theme'),
		'desc' => __('zcool地址', 'options_framework_theme'),
		'id' => 'zcool',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('知乎', 'options_framework_theme'),
		'desc' => __('知乎个人主页地址', 'options_framework_theme'),
		'id' => 'zhihu',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Facebook', 'options_framework_theme'),
		'desc' => __('脸书地址', 'options_framework_theme'),
		'id' => 'facebook',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google+', 'options_framework_theme'),
		'desc' => __('G+个人主页地址', 'options_framework_theme'),
		'id' => 'googleplus',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('简书', 'options_framework_theme'),
		'desc' => __('简书地址', 'options_framework_theme'),
		'id' => 'jianshu',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('CSDN', 'options_framework_theme'),
		'desc' => __('CSND社区地址', 'options_framework_theme'),
		'id' => 'csdn',
		'std' => '',
		'type' => 'text');


	//聚焦图链
	$options[] = array(
		'name' => __('聚焦图', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('是否开启聚焦', 'options_framework_theme'),
		'desc' => __('默认开启', 'options_framework_theme'),
		'id' => 'top_feature',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('聚焦标题', 'options_framework_theme'),
		'desc' => __('默认为聚焦', 'options_framework_theme'),
		'id' => 'feature_title',
		'std' => '聚焦',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('聚焦图一', 'options_framework_theme'),
		'desc' => __('尺寸257px*160px', 'options_framework_theme'),
		'id' => 'feature1_img',
		'std' => 'http://wx4.sinaimg.cn/mw690/006rG8asly1fzte2eg8hvj30jg0chaao.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('聚焦图一标题', 'options_framework_theme'),
		'desc' => __('聚焦图一标题', 'options_framework_theme'),
		'id' => 'feature1_title',
		'std' => 'feature1',
		'type' => 'text');

	$options[] = array(
		'name' => __('聚焦图一链接', 'options_framework_theme'),
		'desc' => __('聚焦图一链接', 'options_framework_theme'),
		'id' => 'feature1_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('聚焦图二', 'options_framework_theme'),
		'desc' => __('尺寸257px*160px', 'options_framework_theme'),
		'id' => 'feature2_img',
		'std' => 'http://wx4.sinaimg.cn/mw690/006rG8asly1fzte2eg8hvj30jg0chaao.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('聚焦图二标题', 'options_framework_theme'),
		'desc' => __('聚焦图二标题', 'options_framework_theme'),
		'id' => 'feature2_title',
		'std' => 'feature2',
		'type' => 'text');

	$options[] = array(
		'name' => __('聚焦图二链接', 'options_framework_theme'),
		'desc' => __('聚焦图二链接', 'options_framework_theme'),
		'id' => 'feature2_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('聚焦图三', 'options_framework_theme'),
		'desc' => __('尺寸257px*160px', 'options_framework_theme'),
		'id' => 'feature3_img',
		'std' => 'http://wx4.sinaimg.cn/mw690/006rG8asly1fzte2eg8hvj30jg0chaao.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('聚焦图三标题', 'options_framework_theme'),
		'desc' => __('聚焦图三标题', 'options_framework_theme'),
		'id' => 'feature3_title',
		'std' => 'feature3',
		'type' => 'text');

	$options[] = array(
		'name' => __('聚焦图三链接', 'options_framework_theme'),
		'desc' => __('聚焦图三链接', 'options_framework_theme'),
		'id' => 'feature3_link',
		'std' => '#',
		'type' => 'text');


	//其他
	$options[] = array(
		'name' => __('其他', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('背景音乐', 'options_framework_theme'),
		'desc' => __('访客第一次访问时可能无法播放音乐,记得提醒访客在不方便时将手机调为静音，否则将会像开发者江程训一样被爸妈发现晚上玩手机', 'options_framework_theme'),
		'id' => 'imgbox_music',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('开启PJAX局部刷新', 'options_framework_theme'),
		'desc' => __('原理与Ajax相同', 'options_framework_theme'),
		'id' => 'poi_pjax',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('开启公告', 'options_framework_theme'),
		'desc' => __('默认不显示，勾选开启', 'options_framework_theme'),
		'id' => 'head_notice',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('公告内容', 'options_framework_theme'),
		'desc' => __('公告内容，文字超出142个字节将会被滚动显示，一个汉字 = 3字节，一个字母 = 1字节，自己计算吧', 'options_framework_theme'),
		'id' => 'notice_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('显示网站运行时间', 'options_framework_theme'),
		'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
		'id' => 'web_runtime',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('建站日期', 'options_framework_theme'),
		'desc' => __('日期格式：2019-2-14（年-月-日）', 'options_framework_theme'),
		'id' => 'web_buildtime',
		'std' => '2019-2-14',
		'type' => 'text');

	$options[] = array(
		'name' => __('首页不显示的分类文章', 'options_framework_theme'),
		'desc' => __('填写分类ID，多个用英文“ , ”分开', 'options_framework_theme'),
		'id' => 'classify_display',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('图片展示分类', 'options_framework_theme'),
		'desc' => __('填写分类ID，多个用英文“ , ”分开', 'options_framework_theme'),
		'id' => 'image_category',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('发件地址前缀', 'options_framework_theme'),
		'desc' => __('用于发送系统邮件，在用户的邮箱中显示的发件人地址，不要使用中文，默认系统邮件地址为 poi@你的域名.com', 'options_framework_theme'),
		'id' => 'mail_user_name',
		'std' => 'poi',
		'type' => 'text');

	$options[] = array(
		'name' => __('允许私密评论', 'options_framework_theme'),
		'desc' => __('允许用户设置自己的评论对其他人不可见', 'options_framework_theme'),
		'id' => 'open_private_message',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('机器人验证', 'options_framework_theme'),
		'desc' => __('开启机器人验证', 'options_framework_theme'),
		'id' => 'norobot',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('评论UA信息', 'options_framework_theme'),
		'desc' => __('勾选开启，用户的浏览器，操作系统信息', 'options_framework_theme'),
		'id' => 'open_useragent',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('开启Prism代码高亮支持', 'options_framework_theme'),
		'desc' => __('仅支持Prism.js的高亮插件，如果你用使用该插件且开启了Pjax，请勾选此项，这不是插件功能，只是帮助插件JS文件进入Pjax重载', 'options_framework_theme'),
		'id' => 'open_prism_codelamp',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('七牛图片cdn', 'options_framework_theme'),
		'desc' => __('！重要:填写格式为 http://你的二级域名（七牛三级域名）/wp-content/uploads', 'options_framework_theme'),
		'id' => 'qiniu_cdn',
		'std' => '',
		'type' => 'text');


	//前台登录
	$options[] = array(
		'name' => __('前台登录', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('指定登录地址', 'options_framework_theme'),
		'desc' => __('强制不使用后台地址登陆，填写新建的登陆页面地址，比如 http://www.xxx.com/login【注意】填写前先测试下你新建的页面是可以正常打开的，以免造成无法进入后台等情况', 'options_framework_theme'),
		'id' => 'exlogin_url',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('指定注册地址', 'options_framework_theme'),
		'desc' => __('该链接使用在登录页面作为注册入口，建议填写', 'options_framework_theme'),
		'id' => 'exregister_url',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('允许用户注册', 'options_framework_theme'),
		'desc' => __('勾选开启，允许用户在前台注册', 'options_framework_theme'),
		'id' => 'ex_register_open',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('登录后自动跳转', 'options_framework_theme'),
		'desc' => __('勾选开启，管理员跳转至后台，用户跳转至主页', 'options_framework_theme'),
		'id' => 'login_urlskip',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('注册验证', 'options_framework_theme'),
		'desc' => __('勾选开启滑动验证(这不是评论验证！只是注册验证', 'options_framework_theme'),
		'id' => 'login_validate',
		'std' => '0',
		'type' => 'checkbox');

	return $options;
}
