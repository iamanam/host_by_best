<?php $hideheader = '';
if( is_page())
{
$hideheader =rwmb_meta( 'easyweb_hide_header_meta' );
}
?>
<header id="header"  class="duplex-hd horizontal-w <?php
$menu_icon = easyweb_webnus_options::easyweb_webnus_header_menu_icon();
if(!empty($menu_icon)) echo ' sm-rgt-mn ';
echo ($hideheader)? ' hi-header ' : '';
echo ' '.easyweb_webnus_options::easyweb_webnus_header_color_type()
 ?>">
	<div class="container">
		<nav class="nav-wrap1 col-md-4 duplex-menu dm-left">
			<div class="container">	
				<?php
					if ( has_nav_menu( 'duplex-menu-left' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker() ) );}
				?>
			</div>
		</nav>
	<div class="col-md-4 logo-wrap center">
			<h1 class="logo">
<?php
/* Check if there is one logo exists at least. */
$has_logo = false;
$logo ='';
$logo_width = '';
$transparent_logo = '';
$transparent_logo_width = '150';
$sticky_logo = '';
$sticky_logo_width = '150';
$logo = easyweb_webnus_options::easyweb_webnus_logo();
$logo_width = preg_replace('#[^0-9]#','',strip_tags(easyweb_webnus_options::easyweb_webnus_logo_width()));
$transparent_logo = easyweb_webnus_options::easyweb_webnus_transparent_logo();
$transparent_logo_width = preg_replace('#[^0-9]#','',strip_tags(easyweb_webnus_options::easyweb_webnus_transparent_logo_width()));
$sticky_logo = easyweb_webnus_options::easyweb_webnus_sticky_logo();
$sticky_logo_width = preg_replace('#[^0-9]#','',strip_tags(easyweb_webnus_options::easyweb_webnus_sticky_logo_width()));
if( !empty($logo) || !empty($transparent_logo) || !empty($sticky_logo) ) $has_logo = true;
if((TRUE === $has_logo)){
if(!empty($logo))
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($logo_width)?$logo_width:"150"). '" id="img-logo-w1" alt="'.get_bloginfo( "name" ).'" class="img-logo-w1" style="width: '. ( !empty($logo_width) ? $logo_width . 'px': "150px" ). '"></a>';
if(!empty($transparent_logo))
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($transparent_logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:"150"). '" id="img-logo-w2" alt="'.get_bloginfo( "name" ).'" class="img-logo-w2" style="width: '. ( !empty($transparent_logo_width) ? $transparent_logo_width . 'px': "150px" ). '"></a>';
else 
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:$logo_width). '" id="img-logo-w2" alt="'.get_bloginfo( "name" ).'" class="img-logo-w2" style="width: '. ( !empty($transparent_logo_width) ? $transparent_logo_width . 'px': $logo_width. 'px' ). '"></a>';
if(!empty($sticky_logo))
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($sticky_logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:"150"). '" id="img-logo-w3" alt="'.get_bloginfo( "name" ).'" class="img-logo-w3"></a></span>';
else 
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:$logo_width). '" id="img-logo-w3" alt="'.get_bloginfo( "name" ).'" class="img-logo-w3"></a></span>'; 
}else{ ?>
<a id="site-title" href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
<span class="site-slog"><a href="<?php echo esc_url(home_url( '/' )); ?>">
<?php             
	$slogan = easyweb_webnus_options::easyweb_webnus_slogan();
	if( empty($slogan))
		bloginfo( 'description' );
	else
		echo esc_html($slogan);                      
?>
</a></span>
<?php } ?>
		</h1></div>
	<nav class="nav-wrap1 col-md-4 duplex-menu dm-right">
		<div class="container">	
			<?php
				if ( has_nav_menu( 'duplex-menu-right' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker() ) );}
			?>
		</div>
	</nav>
	<nav id="nav-wrap" class="full-menu-duplex">
		<div class="container">	
		<ul id="nav" class="main-menu"><?php
				if ( has_nav_menu( 'duplex-menu-left' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new easyweb_webnus_description_walker() ) );}
				if ( has_nav_menu( 'duplex-menu-right' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new easyweb_webnus_description_walker() ) );}
			?></ul>
		</div>
	</nav>
</div>	
</header>
<!-- end-header -->