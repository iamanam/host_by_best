<?php $hideheader = '';
if( is_page()){
$hideheader =rwmb_meta( 'easyweb_hide_header_meta' );
} ?>
<header id="header" class="horizontal-w <?php 
$menu_icon = easyweb_webnus_options::easyweb_webnus_header_menu_icon();
$menu_type = easyweb_webnus_options::easyweb_webnus_header_menu_type();
if(!empty($menu_icon)) echo ' sm-rgt-mn ';
if($menu_type==10) echo ' w-header-type-10 ';
echo ($hideheader)? ' hi-header ' : '';
echo ' '.easyweb_webnus_options::easyweb_webnus_header_color_type()
 ?>">
<div class="container">
<div class="col-md-3 col-sm-3 logo-wrap">
<h1 class="logo">
<?php
/* Check if there is one logo exists at least. */
$has_logo = false;
$logo ='';
$logo_width = '';
$transparent_logo = '';
$transparent_logo_width = '';
$sticky_logo = '';
$sticky_logo_width = '150';
$logo = ( get_theme_mod( 'logo_image' ) ) ? get_theme_mod( 'logo_image' ) : easyweb_webnus_options::easyweb_webnus_logo();
$logo_width = preg_replace('#[^0-9]#','',strip_tags(easyweb_webnus_options::easyweb_webnus_logo_width()));
$transparent_logo = ( get_theme_mod( 'transparent_logo_image' ) ) ? get_theme_mod( 'transparent_logo_image' ) : easyweb_webnus_options::easyweb_webnus_transparent_logo();
$transparent_logo_width = preg_replace('#[^0-9]#','',strip_tags(easyweb_webnus_options::easyweb_webnus_transparent_logo_width()));
$sticky_logo = ( get_theme_mod( 'sticky_logo_image' ) ) ? get_theme_mod( 'sticky_logo_image' ) : easyweb_webnus_options::easyweb_webnus_sticky_logo();
$sticky_logo_width = preg_replace('#[^0-9]#','',strip_tags(easyweb_webnus_options::easyweb_webnus_sticky_logo_width()));
if( !empty($logo) || !empty($transparent_logo) || !empty($sticky_logo) ) $has_logo = true;
if((TRUE === $has_logo)){
if(!empty($logo))
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($logo_width)?$logo_width:""). '" id="img-logo-w1" alt="'.get_bloginfo( "name" ).'" class="img-logo-w1" style="width: '. ( !empty($logo_width) ? $logo_width . 'px': "" ). '"></a>';
if(!empty($transparent_logo))
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($transparent_logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:""). '" id="img-logo-w2" alt="'.get_bloginfo( "name" ).'" class="img-logo-w2" style="width: '. ( !empty($transparent_logo_width) ? $transparent_logo_width . 'px': "" ). '"></a>';
else 
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:$logo_width). '" id="img-logo-w2" alt="'.get_bloginfo( "name" ).'" class="img-logo-w2" style="width: '. ( !empty($transparent_logo_width) ? $transparent_logo_width . 'px': $logo_width. 'px' ). '"></a>';

if(!empty($sticky_logo))
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($sticky_logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:"150"). '" id="img-logo-w3" alt="'.get_bloginfo( "name" ).'" class="img-logo-w3"></a></span>';
else 
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:$logo_width). '" id="img-logo-w3" alt="'.get_bloginfo( "name" ).'" class="img-logo-w3"></a></span>'; 
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
</a>
</span>
<?php } ?></h1></div>
<nav id="nav-wrap" class="nav-wrap1 col-md-9 col-sm-9">
	<div class="container">
		<?php 
		if(is_active_sidebar('woocommerce_header')) {
			dynamic_sidebar('woocommerce_header');
		} 
		if(easyweb_webnus_options::easyweb_webnus_header_search_enable()){			
		?>
		<div id="search-form">
		<a href="javascript:void(0)" class="search-form-icon"><i id="searchbox-icon" class="fa-search"></i></a>
	<div id="search-form-box" class="search-form-box">
			<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
				<input type="text" class="search-text-box" id="search-box" name="s">
			</form>
			</div>
		</div>
		<?php }

// OnePage Menu
			$onepage_menu = '';
			if(is_page()){
				$onepage_menu = rwmb_meta( 'easyweb_onepage_menu_meta' );
			}

			if($onepage_menu){
				if ( has_nav_menu( 'onepage-header-menu' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'onepage-header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker()) );	
				}
			}
			else{
				if ( has_nav_menu( 'header-menu' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker()) );
				}
			}
			?>
	</div>
</nav>
</div>
</header>
<!-- end-header -->