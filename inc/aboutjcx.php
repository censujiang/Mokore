<?php

function mokore_add_admin_menu_page(){
		add_menu_page('aboutjcx', '关于江程训', 'edit_themes', 'mokore_admin_page_root', 'mokore_admin_page', 'dashicons-flag', 100);
	}

function mokore_admin_page(){
    echo '<a href="https://dfjcx.cn/about">戳我了解江程训</a>';
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
