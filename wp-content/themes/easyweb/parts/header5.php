<?php
// define variables
$hideheader = '';

if( is_page()){
	$hideheader =rwmb_meta( 'easyweb_hide_header_meta' );
}

$menu_icon 		= easyweb_webnus_options::easyweb_webnus_header_menu_icon();
$menu_type 		= easyweb_webnus_options::easyweb_webnus_header_menu_type();
$header_class 	= '';
$header_class  	= !empty($menu_icon) ? ' sm-rgt-mn' : '';
$header_class  .= $hideheader ? ' hi-header' : '';
$header_class  .= $menu_type == '11' ? ' w-header-type-11' : '';
?>

<!-- header components - display: @media only screen and (max-width: 767px) -->
<div class="container">
	<div class="components phones-components clearfix">
		<?php
			$logo_rightside = easyweb_webnus_options::easyweb_webnus_header_logo_rightside();
			if( $logo_rightside == 1 ) { ?>
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
					<input name="s" type="text" placeholder="<?php esc_html_e('Search...','easyweb') ?>" class="header-saerch" >
				</form>
			<?php }
			elseif( $logo_rightside == 2 ) {
				$allowed_html = array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array() ); ?>
				<h6 class="col-sm-4"><i class="sl-location-pin"></i><span><?php echo wp_kses( easyweb_webnus_options::easyweb_webnus_header_address(), $allowed_html ); ?></span></h6>
				<h6 class="col-sm-4"><i class="sl-phone"></i><span><?php echo easyweb_webnus_options::easyweb_webnus_header_phone(); ?></span></h6>
				<h6 class="col-sm-4"><i class="sl-envelope-open"></i><span><?php echo easyweb_webnus_options::easyweb_webnus_header_email(); ?></span></h6>
			<?php }
			elseif( $logo_rightside == 3 ) {
				if(is_active_sidebar('header-advert'))
				dynamic_sidebar('header-advert');
				if(is_active_sidebar('woocommerce_header'))
				dynamic_sidebar('woocommerce_header');
			}
		?>
	</div>
</div>

<header id="header"  class="horizontal-w<?php echo esc_attr( $header_class ); ?>">
	<div class="container">

		<!-- logo -->
		<div class="col-sm-3 logo-wrap">
			<h1 class="logo">
			<?php
				/* Check if there is one logo exists at least. */
				$has_logo = false;
				$logo = $logo_width = $transparent_logo = $transparent_logo_width = $sticky_logo = '';
				$sticky_logo_width = '150';
				
				$logo = ( get_theme_mod( 'logo_image' ) ) ? get_theme_mod( 'logo_image' ) : easyweb_webnus_options::easyweb_webnus_logo();
				$logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'logo_width' ) ? get_theme_mod( 'logo_width' ) : easyweb_webnus_options::easyweb_webnus_logo_width() ) );
				$transparent_logo = ( get_theme_mod( 'transparent_logo_image' ) ) ? get_theme_mod( 'transparent_logo_image' ) : easyweb_webnus_options::easyweb_webnus_transparent_logo();
				$transparent_logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'transparent_logo_width' ) ? get_theme_mod( 'transparent_logo_width' ) : easyweb_webnus_options::easyweb_webnus_transparent_logo_width() ) );
				$sticky_logo = ( get_theme_mod( 'sticky_logo_image' ) ) ? get_theme_mod( 'sticky_logo_image' ) : easyweb_webnus_options::easyweb_webnus_sticky_logo();
				$sticky_logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'sticky_logo_width' ) ? get_theme_mod( 'sticky_logo_width' ) : easyweb_webnus_options::easyweb_webnus_sticky_logo_width() ) );

				if( !empty($logo) || !empty($transparent_logo) || !empty($sticky_logo) )
					$has_logo = true;

				if( $has_logo === TRUE ) {
					if(!empty($transparent_logo))
						echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($transparent_logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:""). '" id="img-logo-w1" alt="'.get_bloginfo( "name" ).'" class="img-logo-w1" style="width: '. ( !empty($transparent_logo_width) ? $transparent_logo_width . 'px': "" ). '"></a>';
					else 
						echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:$logo_width). '" id="img-logo-w1" alt="'.get_bloginfo( "name" ).'" class="img-logo-w1" style="width: '. ( !empty($transparent_logo_width) ? $transparent_logo_width . 'px': $logo_width. 'px' ). '"></a>';

					if(!empty($sticky_logo))
						echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($sticky_logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:"150"). '" id="img-logo-w3" alt="'.get_bloginfo( "name" ).'" class="img-logo-w3"></a></span>';
					else 
						echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:$logo_width). '" id="img-logo-w3" alt="'.get_bloginfo( "name" ).'" class="img-logo-w3"></a></span>'; 
				} else { ?>
					<span id="site-title"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a></span>
						<span class="site-slog">
							<a href="<?php echo esc_url(home_url( '/' )); ?>">
								<?php
									$slogan = easyweb_webnus_options::easyweb_webnus_slogan();
									if( empty($slogan)) bloginfo( 'description' ); else echo esc_html($slogan);                       
								?>
							</a>
						</span>
					<?php
				}
			?>
			</h1> <!-- end logo -->
		</div> <!-- end logo-wrap -->

		<!-- nav and component -->
		<div class="col-sm-9 nav-components">
			<!-- header components -->
			<div class="components clearfix">
				<?php
					$logo_rightside = easyweb_webnus_options::easyweb_webnus_header_logo_rightside();
					if( $logo_rightside == 1 ) { ?>
						<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
							<input name="s" type="text" placeholder="<?php esc_html_e('Search...','easyweb') ?>" class="header-saerch" >
						</form>
					<?php }
					elseif( $logo_rightside == 2 ) {
						$allowed_html = array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array() ); ?>
						<h6><i class="sl-location-pin"></i><span><?php echo wp_kses( easyweb_webnus_options::easyweb_webnus_header_address(), $allowed_html ); ?></span></h6>
						<h6><i class="sl-phone"></i><span><?php echo easyweb_webnus_options::easyweb_webnus_header_phone(); ?></span></h6>
						<h6><i class="sl-envelope-open"></i><span><?php echo easyweb_webnus_options::easyweb_webnus_header_email(); ?></span></h6>
					<?php }
					elseif( $logo_rightside == 3 ) {
						if(is_active_sidebar('header-advert'))
						dynamic_sidebar('header-advert');
						if(is_active_sidebar('woocommerce_header'))
						dynamic_sidebar('woocommerce_header');
					}
					if ( class_exists( 'WooCommerce' ) && easyweb_webnus_options::easyweb_webnus_header_woocart_enable() ) {
						the_widget( 'Woocommerce_Header_Cart' );
					}
				?>
			</div>
			<!-- navigation -->
			<nav id="nav-wrap" class="nav-wrap1">
				<div class="container">	
				<?php
					$onepage_menu = '';
					if(is_page()){
						$onepage_menu = rwmb_meta( 'easyweb_onepage_menu_meta' );
					}
					$menu_location = '';
					if( easyweb_webnus_options::easyweb_webnus_header_menu_type() == 0 ) {
						$menu_location = 'header-top-menu';
					} elseif($onepage_menu) {
						$menu_location = 'onepage-header-menu';
					} else {					
						$menu_location = 'header-menu';
					}
					// nav
					if ( has_nav_menu( $menu_location ) ) {
						wp_nav_menu( array( 'theme_location' => $menu_location, 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker() ) );
					} ?>
				</div>  <!-- end container -->
			</nav> <!-- end nav-wrap -->
			<!-- search -->
			<?php if( easyweb_webnus_options::easyweb_webnus_header_search_enable() ) : ?>
				<form id="w-header-type-11-search" role="search" action="<?php echo esc_url(home_url( '/' )); ?>" method="get" >
					<i id="header11_search_icon" class="sl-magnifier"></i>
					<input name="s" type="text">
				</form>
			<?php endif; ?>
		</div> <!-- end col-md-9 -->

	</div> <!-- end container -->
</header> <!-- end header -->