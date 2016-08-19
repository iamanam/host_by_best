<?php
$hideheader = '';
if( is_page()){
$hideheader =rwmb_meta( 'easyweb_hide_header_meta' );
} ?>
<header id="header"  class="horizontal-w <?php
$menu_icon = easyweb_webnus_options::easyweb_webnus_header_menu_icon();
$menu_type = easyweb_webnus_options::easyweb_webnus_header_menu_type();
if(!empty($menu_icon)) echo 'sm-rgt-mn ';
if($menu_type==9) echo 'box-menu ';
echo ($hideheader)? 'hi-header ' : '';
echo ' '.easyweb_webnus_options::easyweb_webnus_header_color_type()
 ?>">
	<div  class="container">
		<?php if(!$menu_type==0){
			$logo_alignment = easyweb_webnus_options::easyweb_webnus_header_logo_alignment();
			if( 1 == $logo_alignment ) {
				echo '<div class="col-md-3 logo-wrap">';
			} elseif( 2 == $logo_alignment ) {
				echo '<div class="col-md-3 cntmenu-leftside"></div><div class="col-md-6 logo-wrap center">';
			} elseif( 3 == $logo_alignment ) {
				echo '<div class="col-md-3 logo-wrap right">';
			}
		}
		else {
			echo '<div class="col-md-12 logo-wrap center">';
		}
		?>
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
$logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'logo_width' ) ? get_theme_mod( 'logo_width' ) : easyweb_webnus_options::easyweb_webnus_logo_width() ) );
$transparent_logo = ( get_theme_mod( 'transparent_logo_image' ) ) ? get_theme_mod( 'transparent_logo_image' ) : easyweb_webnus_options::easyweb_webnus_transparent_logo();
$transparent_logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'transparent_logo_width' ) ? get_theme_mod( 'transparent_logo_width' ) : easyweb_webnus_options::easyweb_webnus_transparent_logo_width() ) );
$sticky_logo = ( get_theme_mod( 'sticky_logo_image' ) ) ? get_theme_mod( 'sticky_logo_image' ) : easyweb_webnus_options::easyweb_webnus_sticky_logo();
$sticky_logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'sticky_logo_width' ) ? get_theme_mod( 'sticky_logo_width' ) : easyweb_webnus_options::easyweb_webnus_sticky_logo_width() ) );
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
<?php } ?>
		</h1></div>
	<?php if(!$menu_type==0){
		switch($logo_alignment){
			case 1:
				echo '<div class="col-md-9 alignright"><hr class="vertical-space" />';
			break;
			case 2:
				echo '<div class="col-md-3 right-side">';
			break;
			case 3:
				echo '<div class="col-md-9 left-side"><hr class="vertical-space" />';
			break;
			default:
			echo '';
		}
			$logo_rightside = easyweb_webnus_options::easyweb_webnus_header_logo_rightside();
			if( 1 == $logo_rightside ){
			?>
				<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
				<input name="s" type="text" placeholder="<?php esc_html_e('Search...','easyweb') ?>" class="header-saerch" >
				</form>
			<?php }
			elseif(2 == $logo_rightside)
			{ ?>
				<h6><i class="sl-location-pin"></i><span><?php echo easyweb_webnus_options::easyweb_webnus_header_email(); ?></span></h6>
				<h6><i class="sl-phone"></i><span><?php echo easyweb_webnus_options::easyweb_webnus_header_phone(); ?></span></h6>
				<h6><i class="sl-envelope-open"></i><span><?php echo easyweb_webnus_options::easyweb_webnus_header_address(); ?></span></h6>
			<?php }
			elseif(3 == $logo_rightside)
			{
				if(is_active_sidebar('header-advert'))
				dynamic_sidebar('header-advert');
				if(is_active_sidebar('woocommerce_header'))
				dynamic_sidebar('woocommerce_header');
			}
			?>
		</div>
		<?php } ?>
	</div>
	<?php
	$menu_alignment ='';
	if(!$menu_type==0){ 
		if($logo_alignment==3 ){
			$menu_alignment='left ';
		}elseif($logo_alignment==2 ){
			$menu_alignment='center ';
		}
	}
	?>
	<nav id="nav-wrap" class="nav-wrap2 <?php echo esc_attr( $menu_alignment );
		switch($menu_type){
			case 2:
				echo 'mn4';
				break;
			case 3:
				echo 'mn4 darknavi';
				break;
			case 5:
				echo 'darknavi';
				break;
			default:
				echo '';
		}
	?>">
		<div class="container">	
			<?php
			$onepage_menu = '';
			if(is_page()){
				$onepage_menu = rwmb_meta( 'easyweb_onepage_menu_meta' );
			}
			
				$menu_location = '';
				if(easyweb_webnus_options::easyweb_webnus_header_menu_type()==0){
					$menu_location = 'header-top-menu';
				}elseif($onepage_menu){
					$menu_location = 'onepage-header-menu';
				}else{					
					$menu_location = 'header-menu';
				}
				if ( has_nav_menu( $menu_location ) ) {
					wp_nav_menu( array( 'theme_location' => $menu_location, 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new easyweb_webnus_description_walker() ) );
				}
			?>
		</div>
	</nav>
</header>
<!-- end-header -->