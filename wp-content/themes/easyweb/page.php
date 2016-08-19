<?php
get_header();

$easyweb_webnus_last_time = get_the_time(get_option( 'date_format' ));


$show_titlebar = null;
$titlebar_fg = null;
$titlebar_bg = null;
$have_sidebar = false;
$sidebar_pos = null;

$show_titlebar	= rwmb_meta( 'easyweb_page_title_bar_meta' );
$titlebar_fg	= rwmb_meta( 'easyweb_page_title_text_color_meta' );
$titlebar_bg	= rwmb_meta( 'easyweb_page_title_bg_color_meta' );
$titlebar_fs	= rwmb_meta( 'easyweb_page_title_font_size_meta' );
$sidebar_pos	= rwmb_meta( 'easyweb_sidebar_position_meta' );
$have_sidebar	= $sidebar_pos ? true : false;

if($show_titlebar):
?>
<section id="headline" style="<?php if(!empty($titlebar_bg)) echo ' background-color:'.$titlebar_bg.';'; ?>">
    <div class="container">
      <h2 style="<?php if(!empty($titlebar_fg)) echo ' color:'.$titlebar_fg.';'; if(!empty($titlebar_fs)) echo ' font-size:'.$titlebar_fs.';';  ?>"><?php the_title(); ?></h2>
    </div>
</section>
<?php if( 1 == easyweb_webnus_options::easyweb_webnus_enable_breadcrumbs() ) { ?>
      <div class="breadcrumbs-w"><div class="container"><?php if('easyweb_webnus_breadcrumbs') easyweb_webnus_breadcrumbs(); ?></div></div>
<?php } ?>
<?php
endif;
?>

<section id="main-content" class="container">
<!-- Start Page Content -->
<?php
/*
	LEFT SIDEBAR
*/

if( ('left' == $sidebar_pos) || ('both' == $sidebar_pos ) ) { ?>
	<aside class="col-md-3 sidebar leftside">
		<?php if( is_active_sidebar( 'Left Sidebar' ) ) dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php }

if( $have_sidebar ) { ?>
<section class="<?php  echo('both' == $sidebar_pos )?'col-md-6 cntt-w':'col-md-9 cntt-w'; ?>">
	<article>
	
<?php 
}
	
	echo '<div class="row-wrapper-x">';
		  if( have_posts() ): while( have_posts() ): the_post();
			the_content();
		  endwhile;
		  endif;
	echo '</div>';
wp_link_pages();
if (comments_open() || get_comments_number() ){
	comments_template();
}
if( $have_sidebar ){
	echo "</article></section>	";
}

if( ('right' == $sidebar_pos) || ('both' == $sidebar_pos) ){?>

<aside class="col-md-3 sidebar">
	<?php if( is_active_sidebar( 'Right Sidebar' ) ) dynamic_sidebar( 'Right Sidebar' ); ?>
</aside>

<?php } ?>
</section>

<?php get_footer(); ?>