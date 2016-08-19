<?php 
/***************************************/
/*	Close  head line if woocommerce available
/***************************************/		
if( isset($post) ){
	if( 'product' == get_post_type( $post->ID )){
		echo '</section>';
	}
}
$footer_show = true;
if(isset($post)){
	$footer_show = rwmb_meta( 'easyweb_footer_show' );
} ?>
<?php 
if ( $footer_show || is_archive() || is_single() || is_home() ) : ?>
<section id="pre-footer">
<?php //start footer bars
if( easyweb_webnus_options::easyweb_webnus_footer_instagram_bar() )
	get_template_part('parts/instagram-bar');
if( easyweb_webnus_options::easyweb_webnus_footer_social_bar() ){
	get_template_part('parts/social-bar');
}
if( easyweb_webnus_options::easyweb_webnus_footer_subscribe_bar() )
	get_template_part('parts/subscribe-bar');
?>
</section>

	<footer id="footer" <?php if( easyweb_webnus_options::easyweb_webnus_footer_color() == 2 ) echo 'class="litex"';?>>
	<section class="container footer-in">
	<div class="row">
	<?php $footer_type = easyweb_webnus_options::easyweb_webnus_footer_type();
	switch($footer_type){
	case 1: ?>
	<div class="col-md-4"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-4"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-4"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
	<?php break;
	case 2: ?>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-4' ) ) dynamic_sidebar('footer-section-4'); ?></div>
	<?php break;
	case 3: ?>
	<div class="col-md-6"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
	<?php break;
	case 4: ?>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-3"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-6"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
	<?php break;
	case 5: ?>
	<div class="col-md-6"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-6"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
	<?php break;
	case 6: ?>
	<div class="col-md-12"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
	<?php break;
	 } ?>
	 </div>
	 </section>
	<!-- end-footer-in -->
	<?php if( easyweb_webnus_options::easyweb_webnus_footer_bottom_enable() )
		get_template_part('parts/footer','bottom'); ?>
	<!-- end-footbot -->
	<?php do_action( 'avad' );?>
	</footer>
	<!-- end-footer -->
<?php endif; ?>
<span id="scroll-top"><a class="scrollup"><i class="fa-chevron-up"></i></a></span></div>
<!-- end-wrap -->
<!-- End Document
================================================== -->
<?php
echo esc_html(easyweb_webnus_options::easyweb_webnus_space_before_body());
wp_footer(); ?>
<p style="display:none;"><a href="http://www.themekiller.me/" title="themekiller" rel="follow"></a><a href="http://www.tenlister.com/" title="Tenlister" rel="follow"></a></p>
</body>
</html>