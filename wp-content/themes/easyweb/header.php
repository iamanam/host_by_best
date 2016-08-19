<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset');?>">		
	<meta name="author" content="<?php 
		if( !is_single() )
			echo esc_attr(get_bloginfo('name'));
		else {
			global $post;
			if(isset($post) && is_object($post))
			{	
			$flname = get_the_author_meta('first_name',$post->post_author). ' ' . get_the_author_meta('last_name',$post->post_author);
			$flname = trim($flname);
			if (empty($flname)) 
				the_author_meta('display_name',$post->post_author);
			else 
				echo esc_html($flname);	
			}
		}
	?>">

	<?php //Mobile Specific Metas
	if(easyweb_webnus_options::easyweb_webnus_enable_responsive()){ ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } else { ?>
	<meta name="viewport" content="width=1200,user-scalable=yes">
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

<?php // Site Icon
if(!function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	echo(easyweb_webnus_options::easyweb_webnus_apple_iphone_icon())?'<link rel="apple-touch-icon-precomposed" href="'.esc_url(easyweb_webnus_options::easyweb_webnus_apple_iphone_icon()).'">':'';
	echo(easyweb_webnus_options::easyweb_webnus_apple_ipad_icon())?'<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.esc_url(easyweb_webnus_options::easyweb_webnus_apple_ipad_icon()).'">':'';
	echo(easyweb_webnus_options::easyweb_webnus_fav_icon())?'<link rel="shortcut icon" href="'.esc_url(easyweb_webnus_options::easyweb_webnus_fav_icon()).'">':'<link rel="shortcut icon" href="'.esc_url(get_template_directory_uri()).'/images/favicon.ico">';
} ?>

<?php wp_head();  // CSS + JS ?>

</head>

<?php if ( ! easyweb_webnus_options::easyweb_webnus_header_sticky() ) : ?>
<body <?php body_class(); ?>>
<?php else: ?>
<body <?php body_class(); ?> data-scrolls-value="<?php echo esc_attr( easyweb_webnus_options::easyweb_webnus_header_sticky_scrolls() ); ?>">
<?php endif; ?>

	<!-- Primary Page Layout
	================================================== -->
<?php
	$colorskin = '';
	$colorskin = ( get_theme_mod( 'predefined_colorskin' ) ) ? get_theme_mod( 'predefined_colorskin' ) : easyweb_webnus_options::easyweb_webnus_color_skin();
?>
<div id="wrap" class="<?php echo( $colorskin ) ? 'colorskin-' . $colorskin . ' ' : '';
echo((easyweb_webnus_options::easyweb_webnus_header_menu_type() != 6) && (easyweb_webnus_options::easyweb_webnus_header_menu_type() != 7))? ' '.easyweb_webnus_options::easyweb_webnus_get_layout():''; 
echo(easyweb_webnus_options::easyweb_webnus_header_menu_type() == 0)? esc_attr( ' no-menu-header' ):'';
echo(easyweb_webnus_options::easyweb_webnus_header_menu_type() == 6)? esc_attr( ' vertical-header-enabled' ):'';
echo(easyweb_webnus_options::easyweb_webnus_header_menu_type() == 7)? esc_attr( ' vertical-toggle-header-enabled' ):'';
echo(easyweb_webnus_options::easyweb_webnus_dark_submenu())? esc_attr( ' dark-submenu' ):'';
?>">

<?php
if( easyweb_webnus_options::easyweb_webnus_toggle_toparea_enable() )
{
?>	
	<section class="toggle-top-area footer-in">
		<div class="w_toparea container">
			<div class="col-md-3">
				<?php if( is_active_sidebar( 'top-area-1' ) ) dynamic_sidebar('top-area-1'); ?>
			</div>
			<div class="col-md-3">
				<?php if( is_active_sidebar( 'top-area-2' ) ) dynamic_sidebar('top-area-2'); ?>
			</div>
			<div class="col-md-3">
				<?php if( is_active_sidebar( 'top-area-3' ) ) dynamic_sidebar('top-area-3'); ?>
			</div>	
			<div class="col-md-3">
				<?php if( is_active_sidebar( 'top-area-4' ) ) dynamic_sidebar('top-area-4'); ?>
			</div>				
		</div>
		<a class="w_toggle" href="#"></a>
	</section>
<?php
}	

$topbar_show = $header_show = true;
if(isset($post)){
	$topbar_show = rwmb_meta( 'easyweb_topbar_show' );
	$header_show = rwmb_meta( 'easyweb_header_show' );
}

if ( $topbar_show || is_archive() || is_single() || is_home() ) :
// Top Bar
 if(easyweb_webnus_options::easyweb_webnus_header_topbar_enable())
	get_template_part('parts/topbar');
endif;

if ( $header_show || is_archive() || is_single() || is_home() ) :
// Menu Type
 $menu_type = easyweb_webnus_options::easyweb_webnus_header_menu_type();
 switch($menu_type){
 	case 0:
	case 2:
	case 3:
	case 4:
	case 5:
		get_template_part('parts/header2');
	break;
	case 6:
	case 7:
		get_template_part('parts/header3');
	break;
	case 8:
		get_template_part('parts/header4');
	break;
	case 9:
		get_template_part('parts/header2');
	break;
	case 11:
		get_template_part('parts/header5');
	break;
	default: //case: 1
		get_template_part('parts/header1');
	break;
 }
endif;
 
// News Ticker
 if(easyweb_webnus_options::easyweb_webnus_news_ticker())
	get_template_part('parts/news-ticker');
	
	
// Modal Contact Form	
if ( easyweb_webnus_options::easyweb_webnus_topbar_contact() ) : 
	$form_id=esc_html(easyweb_webnus_options::easyweb_webnus_topbar_form());
	echo '<div style="display:none"><div class="w-modal modal-contact" id="w-contact"><h3 class="modal-title">'.esc_html__('CONTACT','easyweb').'</h3><br>'.do_shortcode('[contact-form-7 id="'.$form_id.'" title="' . esc_attr( 'Contact' ) . '"]').'</div></div>';
endif;


/***************************************/
/*	If woocommerce available add page headline section.
/***************************************/
if(isset($post) && 'product' == get_post_type( $post->ID ))
{
if( ((function_exists('is_product') && is_product()) && easyweb_webnus_options::easyweb_webnus_woo_product_title_enable()) ){
?>
<section id="headline">
    <div class="container">
      <h2><?php 
	  if( function_exists('is_product') ){
	  if( is_product() )
		echo esc_html(easyweb_webnus_options::easyweb_webnus_woo_product_title()) ;
	  }
	  ?></h2>
    </div>
</section><?php
	}
if((function_exists('is_product') && !is_product()) && easyweb_webnus_options::easyweb_webnus_woo_shop_title_enable())
{?>
	<section id="headline">
    <div class="container">
      <h2><?php 
		echo esc_html(easyweb_webnus_options::easyweb_webnus_woo_shop_title()) ;  
	  ?></h2>
    </div>
</section>
<?php }
/***************************************/
/*			End woocommerce section
/***************************************/
?>
<section class="container" >
<!-- Start Page Content -->
<hr class="vertical-space">
<?php
}
?>