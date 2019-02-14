<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mokore
 */

 ?>
 <html>
 <head>
 <meta charset="UTF-8">
 <title>404了/(ㄒoㄒ)/~~</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <!-- 自定义CSS开始 -->
 <?php if(mokore_option('head_css')){ ?>
 <link rel="stylesheet" href="<?php echo mokore_option('head_css'); ?>">
 <?php } ?>
 <!-- 自定义CSS结束 -->
 </head>
 <body>
     <div class="notfoud-container">
         <div class="img-404">
         </div>
         <p class="notfound-p">哎呀迷路了...</p>
         <div class="notfound-reason">
             <p>可能的原因：</p>
             <ul>
                 <li>原来的页面不存在了</li>
               	 <li>你查找的方式有误</li>
                 <li>服务器被外星人劫持了</li>
             </ul>
         </div>
         <div class="notfound-btn-container">
 				<a class="notfound-btn" href=javascript:history.go(-1);>BACK</a>
           	<a class="notfound-btn" href="/">INDEX</a>
         </div>
     </div>
 	<embed src="<?php bloginfo('template_url'); ?>/404.mp3" width="0" height="0" type=audio/mpeg loop="0" autostart="1" volume="0">
 </body>
 </html>
