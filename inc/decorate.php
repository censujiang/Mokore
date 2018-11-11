<?php
function customizer_css() { ?>
<style type="text/css">
<?php // Style Settings
if ( mokore_option('shownav') ) { ?>
.site-top .lower nav {display: block !important;}
<?php } // Style Settings ?>
<?php // theme-skin
if ( mokore_option('theme_skin') ) { ?>
.author-profile i , .post-like a , .post-share .show-share , .sub-text , .we-info a , span.sitename , .post-more i:hover , #pagination a:hover , .post-content a:hover , .float-content i:hover{ color: <?php echo mokore_option('theme_skin'); ?> }
.feature i , .feature-title span , .download , .navigator i:hover , .links ul li:before , .ar-time i , span.ar-circle , .object , .comment .comment-reply-link , .mokore-checkbox-radio:checked + .mokore-checkbox-radioInput:after { background: <?php echo mokore_option('theme_skin'); ?> }
::-webkit-scrollbar-thumb { background: <?php echo mokore_option('theme_skin'); ?> }
.download , .navigator i:hover , .link-title , .links ul li:hover , #pagination a:hover , .comment-respond input[type='submit']:hover { border-color: <?php echo mokore_option('theme_skin'); ?> }
.entry-content a:hover , .site-info a:hover , .comment h4 a , #comments-navi a.prev , #comments-navi a.next , .comment h4 a:hover , .site-top ul li a:hover , .entry-title a:hover , #archives-temp h3 , span.page-numbers.current , .sorry li a:hover , .site-title a:hover , i.iconfont.js-toggle-search.iconsearch:hover , .comment-respond input[type='submit']:hover { color: <?php echo mokore_option('theme_skin'); ?> }
<?php } // theme-skin ?>
<?php // Custom style
if ( mokore_option('site_custom_style') ) {
  echo mokore_option('site_custom_style');
} 
// Custom style end ?>
<?php // liststyle
if ( mokore_option('list_type') == 'square') { ?>
.feature img{ border-radius: 0px; !important; }
.feature i { border-radius: 0px; !important; }
<?php } // liststyle ?>
<?php // comments
if ( mokore_option('toggle-menu') == 'no') { ?>
.comments .comments-main {display:block !important;}
.comments .comments-hidden {display:none !important;}
<?php } // comments ?>
</style>
<?php }
add_action('wp_head', 'customizer_css');