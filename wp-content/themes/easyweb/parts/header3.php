<div id="vertical-header-wrapper"  style="<?php echo (7 == easyweb_webnus_options::easyweb_webnus_header_menu_type())? 'left : -250px;' : ''; ?>">
<?php
	if (7 == easyweb_webnus_options::easyweb_webnus_header_menu_type()) {
?>
	<div id="toggle-icon">
		<span class="mn-ext1"></span>
		<span class="mn-ext2"></span>
		<span class="mn-ext3"></span>
	</div>
	<ul class="vertical-socials">
<?php
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_facebook())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_facebook_ID() .'" class="facebook"><i class="fa-facebook"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_twitter())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_twitter_ID() .'" class="twitter"><i class="fa-twitter"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_dribbble())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_dribbble_ID().'" class="dribble"><i class="fa-dribbble"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_pinterest())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_pinterest_ID() .'" class="pinterest"><i class="fa-pinterest"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_vimeo())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_vimeo_ID() .'" class="vimeo"><i class="fa-vimeo-square"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_youtube())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_youtube_ID() .'" class="youtube"><i class="fa-youtube"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_google())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_google_ID() .'" class="google"><i class="fa-google"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_linkedin())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_linkedin_ID() .'" class="linkedin"><i class="fa-linkedin"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_rss())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_rss_ID() .'" class="rss"><i class="fa-rss-square"></i></a></li>';
    if(easyweb_webnus_options::easyweb_webnus_top_social_icons_instagram())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_instagram_ID() .'" class="instagram"><i class="fa-instagram"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_flickr())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_flickr_ID() .'" class="other-social"><i class="fa-flickr"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_reddit())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_reddit_ID() .'" class="other-social"><i class="fa-reddit"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_delicious())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_delicious_ID() .'" class="other-social"><i class="fa-delicious"></i></a></li>';		
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_lastfm())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_lastfm_ID() .'" class="other-social"><i class="fa-lastfm-square"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_tumblr())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_tumblr_ID() .'" class="other-social"><i class="fa-tumblr-square"></i></a></li>';
	if(easyweb_webnus_options::easyweb_webnus_top_social_icons_skype())
		echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_skype_ID() .'" class="other-social"><i class="fa-skype"></i></a></li>';	
?>
	</ul>
<?php
}
	$header_background = (easyweb_webnus_options::easyweb_webnus_header_background())? 'style="background-size:cover; background-image: url(\''.easyweb_webnus_options::easyweb_webnus_header_background().'\')"':'';
	$menu_icon = (easyweb_webnus_options::easyweb_webnus_header_menu_icon())? 'sm-rgt-mn ':'';
?>
	<header id="header" <?php echo $header_background; ?> class="vertical-w <?php echo esc_attr( $menu_icon );?>">
	<div class="container vheader-container">
	<div class="col-md-3 col-sm-3 logo-wrap">
	<h1 class="logo">
	<?php
	/* Check if there is one logo exists at least. */
	$has_logo = false;
	$logo ='';
	$logo_width = '';
	$logo = ( get_theme_mod( 'logo_image' ) ) ? get_theme_mod( 'logo_image' ) : easyweb_webnus_options::easyweb_webnus_logo();
	$logo_width = preg_replace('#[^0-9]#','',strip_tags(easyweb_webnus_options::easyweb_webnus_logo_width()));
	if( !empty($logo) ) $has_logo = true;
	if((TRUE === $has_logo)){
	if(!empty($logo))
		echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($logo_width)?$logo_width:""). '" id="img-logo-w1" alt="'.get_bloginfo( "name" ).'" class="img-logo-w1" style="width: '. ( !empty($logo_width) ? $logo_width . 'px': "" ). '"></a>';
	}else{ ?>
	<a id="site-title" href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
	<span class="site-slog">
	<a href="<?php echo esc_url(home_url( '/' )); ?>">
	<?php           
		$slogan = easyweb_webnus_options::easyweb_webnus_slogan();
		if( empty($slogan))
			bloginfo( 'description' );
		else
			echo esc_html($slogan);             
	?>
	</a></span>
	<?php } ?></h1></div>
	<nav id="nav-wrap" class="col-md-9 col-sm-9 nav-wrap3">
		<div class="container">
			<?php // OnePage Menu
			$onepage_menu = '';
			if(is_page()){
				$onepage_menu = rwmb_meta( 'easyweb_onepage_menu_meta' );
			}

				if($onepage_menu){
					if ( has_nav_menu( 'onepage-header-menu' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'onepage-header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker()) );	
					}
				}else{
					if ( has_nav_menu( 'header-menu' ) )
					{
						wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker()) );
					}
				}
			?>
		</div>
	</nav>
	<?php
	if(easyweb_webnus_options::easyweb_webnus_header_search_enable()) {
	?>
	<div id="search-form">
		<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
			<input type="text" class="search-text-box" id="search-box" name="s">
		</form>
	</div>
	<?php } ?>
	<div class="socials-wrapper">
	<ul class="socials">
	<?php
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_facebook())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_facebook_ID() .'" class="facebook"><i class="fa-facebook"></i></a></li>';
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_twitter())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_twitter_ID() .'" class="twitter"><i class="fa-twitter"></i></a></li>';
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_dribbble())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_dribbble_ID().'" class="dribble"><i class="fa-dribbble"></i></a></li>';
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_pinterest())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_pinterest_ID() .'" class="pinterest"><i class="fa-pinterest"></i></a></li>';
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_vimeo())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_vimeo_ID() .'" class="vimeo"><i class="fa-vimeo-square"></i></a></li>';
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_youtube())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_youtube_ID() .'" class="youtube"><i class="fa-youtube"></i></a></li>';		
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_google())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_google_ID() .'" class="google"><i class="fa-google"></i></a></li>';		
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_linkedin())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_linkedin_ID() .'" class="linkedin"><i class="fa-linkedin"></i></a></li>';		
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_rss())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_rss_ID() .'" class="rss"><i class="fa-rss-square"></i></a></li>';
	    if(easyweb_webnus_options::easyweb_webnus_top_social_icons_instagram())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_instagram_ID() .'" class="instagram"><i class="fa-instagram"></i></a></li>';		
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_flickr())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_flickr_ID() .'" class="other-social"><i class="fa-flickr"></i></a></li>';		
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_reddit())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_reddit_ID() .'" class="other-social"><i class="fa-reddit"></i></a></li>';	
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_delicious())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_delicious_ID() .'" class="other-social"><i class="fa-delicious"></i></a></li>';		
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_lastfm())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_lastfm_ID() .'" class="other-social"><i class="fa-lastfm-square"></i></a></li>';	
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_tumblr())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_tumblr_ID() .'" class="other-social"><i class="fa-tumblr-square"></i></a></li>';
		if(easyweb_webnus_options::easyweb_webnus_top_social_icons_skype())
			echo '<li><a href="'. easyweb_webnus_options::easyweb_webnus_skype_ID() .'" class="other-social"><i class="fa-skype"></i></a></li>';	
	?>
	</ul></div>
	</div>
	</header>
</div>
<!-- end-header -->
