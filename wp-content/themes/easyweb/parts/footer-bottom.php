<?php
$w_fbl_type = easyweb_webnus_options::easyweb_webnus_footer_bottom_left();
$w_fbr_type = easyweb_webnus_options::easyweb_webnus_footer_bottom_right();
$w_fb_logo = '<img src="'.esc_url(easyweb_webnus_options::easyweb_webnus_footer_logo()).'" width="65" alt="'.get_bloginfo( "name" ).'">';
if (has_nav_menu('footer-menu')){
	$menuParameters = array('theme_location'=>'footer-menu','container' => false,'echo' => false,'items_wrap' => '%3$s','depth' => 0,);
	$w_fb_menu = strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
}
$w_fb_text = esc_html(easyweb_webnus_options::easyweb_webnus_footer_copyright());
?>
<section class="footbot">
<div class="container">
	<div class="col-md-6">
	<div class="footer-navi">
	<?php switch ($w_fbl_type){
		case 1: echo $w_fb_logo;
		break;
		case 2:	echo $w_fb_menu;
		break;
		case 3:	echo $w_fb_text;
		break;
	} ?>
	</div>
	</div>
	<div class="col-md-6">
	<div class="footer-navi floatright">
	<?php switch ($w_fbr_type){
		case 1: echo $w_fb_logo;
		break;
		case 2:	echo $w_fb_menu;
		break;
		case 3:	echo $w_fb_text;
		break;
	} ?>
	</div>
	</div>
</div>
</section>