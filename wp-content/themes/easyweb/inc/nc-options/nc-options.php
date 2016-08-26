<?php
if (!class_exists('NHP_Options')) {
    require_once( get_template_directory() . '/inc/nc-options/options/noptions.php' );
}
defined('easyweb') or define('easyweb', 'easyweb');
function add_another_section($sections) {
    $sections[] = array(
        'title' => esc_html__('A Section added by hook', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'icon' => trailingslashit(get_template_directory_uri()) . 'options/img/glyphicons/glyphicons_062_attach.png',
        'fields' => array()
    );
    return $sections;
}
function change_framework_args($args) {
    return $args;
}
function easyweb_webnus_setup_framework_options() {
    $theme_dir = get_template_directory_uri() . '/';
    $args = array();
    $theme_img_dir = $theme_dir . 'images/';
    $theme_img_bg_dir = $theme_img_dir . 'bgs/';
    $args['dev_mode'] = false;
    $args['intro_text'] = wp_kses( __('<p>webnus theme options. all about theme option which can be edited is here.</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) );
    $args['share_icons']['twitter'] = null;
    $args['share_icons']['linked_in'] = null;
    $args['show_import_export'] = true;
    $args['opt_name'] = 'easyweb_webnus_options';
    $args['menu_title'] = esc_html__('Theme Options', 'easyweb');
    $args['page_title'] = esc_html__('Theme Options', 'easyweb');
    $args['page_slug'] = 'easyweb_webnus_theme_options';
    $args['page_parent'] = 'themes.php';
    $args['page_type'] = 'submenu';
    $args['page_position'] = 250;
    $categories = array();
    $categories = get_categories();
    $category_slug_array = array('');
    foreach($categories as $category){$category_slug_array[] = $category->slug;}
    
    $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
    $contact_forms = array();
    if ($cf7) {
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->ID ] = $cform->post_title;
        }
    } else {
        $contact_forms[ esc_html__( 'No contact forms found', 'easyweb' ) ] = 0;
    }
        
        
    $args['show_theme_info'] = false;
    $sections = array();
    $sections[] = array(
        'title' => esc_html__('General', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">Here are general settings of the theme:</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'icon' => NHP_OPTIONS_URL . 'img/admin-general.png',
        'fields' => array(
        array(
            'id' => 'easyweb_webnus_maintenance_mode',
            'type' => 'button_set',
            'title' => esc_html__('Maintenance Mode', 'easyweb'),
            'desc'=> esc_html__('Status of Maintenance Mode', 'easyweb'),
            'options' => array('1' => 'Enable', '0' => 'Disable'),
            'std' => '0'
        ),
        array(
            'id' => 'easyweb_webnus_maintenance_page',
            'type' => 'text',
            'title' => esc_html__('Maintenance Page ID', 'easyweb'),
            'desc'=> esc_html__('ID of Maintenance Page', 'easyweb'),
        ),
        array(
                'id' => 'easyweb_webnus_enable_responsive',
                'type' => 'button_set',
                'title' => esc_html__('Responsive', 'easyweb'),
                'desc'=> wp_kses( __('<br>Disable this option in case you don\'t need a responsive website.','easyweb'), array( 'br' => array() ) ),
                'options' => array('1' => 'Enable', '0' => 'Disable'),
                'std' => '1'
            ),
            array(
                'id'      => 'easyweb_webnus_css_minifier',
                'type'    => 'button_set',
                'title'   => esc_html__('CSS Minifyer', 'easyweb'),
                'options' => array('1' => 'Enable', '0' => 'Disable'),
                'desc'=> wp_kses( __('<br>Enable this option to minify your style-sheets. It\'ll decrease size of your style-sheet files to speed up your website.','easyweb'), array( 'br' => array() ) ),
                'std'     => '1'
            ),
            array(
                'id' => 'easyweb_webnus_enable_smoothscroll',
                'type' => 'button_set',
                'title' => esc_html__('Smooth Scroll', 'easyweb'),
                'desc'=> esc_html__('By enabling this option, your page will have smoth scrolling effect.','easyweb'),
                'options' => array('0' => 'Disable', '1' => 'Enable'),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_background_layout',
                'type' => 'button_set',
                'title' => esc_html__('Layout', 'easyweb'),
                'options' => array('' => 'Wide', 'boxed-wrap' => 'Boxed'),
                'desc'=> wp_kses( __('<br>Select boxed or wide layout.','easyweb'), array( 'br' => array() ) ),
                'std' => ''
            ),
            array(
                'id' => 'easyweb_webnus_container_width',
                'type' => 'text',
                'title' => esc_html__('Container max-width', 'easyweb'),
                'desc'=> wp_kses( __('<br>You can define width of your website. ( Max width: 100% or 1170px )','easyweb'), array( 'br' => array() ) ),
            ),
            array(
                'id' => 'easyweb_webnus_favicon',
                'type' => 'upload',
                'title' => esc_html__('Custom Favicon', 'easyweb'),
                'desc'=> wp_kses( __('<br>An icon that will show in your browser tab near to your websites title, icon size is : (16 X 16)px','easyweb'), array( 'br' => array() ) ),
            ),
            array(
                'id' => 'easyweb_webnus_apple_iphone_icon',
                'type' => 'upload',
                'title' => esc_html__('Apple iPhone Icon', 'easyweb'),
                'desc' => esc_html__('Icon for Apple iPhone (57px x 57px)', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_apple_ipad_icon',
                'type' => 'upload',
                'title' => esc_html__('Apple iPad Icon', 'easyweb'),
                'desc' => esc_html__('Icon for Apple iPad (72px x 72px)', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_recaptcha_site_key',
                'type' => 'text',
                'title' => esc_html__('reCaptcha Site key', 'easyweb'),
                'desc' => wp_kses( __('<p class="description">Register your website and get Secret Key.Very first thing you need to do is register your website on Google recaptcha to do that click <a href="https://www.google.com/recaptcha/admin#list" target="_blank">here</a>.</p>', 'easyweb'), array( 'p' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'target' => array() ) ) ),
            ),
            array(
                'id' => 'easyweb_webnus_recaptcha_secret_key',
                'type' => 'text',
                'title' => esc_html__('reCaptcha Secret key', 'easyweb'),
                'desc' => '',
            ),
           array(
                'id' => 'easyweb_webnus_admin_login_logo',
                'type' => 'upload',
                'title' => esc_html__('Admin Login Logo', 'easyweb'),
                'desc'=> wp_kses( __('<br>It belongs to the back-end of your website to log-in to admin panel.','easyweb'), array( 'br' => array() ) ),
            ),   
            array(
                'id' => 'easyweb_webnus_toggle_toparea_enable',
                'type' => 'button_set',
                'title' => esc_html__('Toggle Top Area', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'desc'=> wp_kses( __('<br>It loads a small plus icon to the top right corner of your website.By clicking on it, it opens and shows your content that you set before.','easyweb'), array( 'br' => array() ) ),
                'std' => '0'
            ),
           array(
                'id' => 'easyweb_webnus_enable_breadcrumbs',
                'type' => 'button_set',
                'title' => esc_html__('Breadcrumbs', 'easyweb'),
                'options' => array('0' => 'Hide', '1' => 'Show'),
                'desc'=> wp_kses( __('<br>It allows users to keep track of their locations within pages.','easyweb'), array( 'br' => array() ) ),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_enable_livesearch',
                'type' => 'button_set',
                'title' => esc_html__('Live Search', 'easyweb'),
                'options' => array('0' => 'Disable', '1' => 'Enable'),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_space_before_head',
                'type' => 'textarea',
                'title' => esc_html__('Space Before &lt;/head&gt;', 'easyweb'),
                'desc' => esc_html__('Add code before the &lt;/head&gt; tag.', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_space_before_body',
                'type' => 'textarea',
                'title' => esc_html__('Space Before &lt;/body&gt;', 'easyweb'),
                'desc' => esc_html__('Add code before the &lt;/body&gt; tag.', 'easyweb'),
            ),
        )
    );
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-header.png',
        'title' => esc_html__('Header Options', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">Everything about headers, Logo, Menus and contact information are here:</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
            array(
                'id' => 'easyweb_webnus_logo',
                'type' => 'upload',
                'title' => esc_html__('Logo', 'easyweb'),
                'desc' => esc_html__('Choose an image file for your logo. For Retina displays please add Image in large size and set custom width.', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_logo_width',
                'type' => 'text',
                'title' => esc_html__('Logo width', 'easyweb'),
                'std' => '210',
            ),
            array(
                'id' => 'easyweb_webnus_transparent_logo',
                'type' => 'upload',
                'title' => esc_html__('Transparent header logo and Header Type 11', 'easyweb'),
            ),
             array(
                'id' => 'easyweb_webnus_transparent_logo_width',
                'type' => 'text',
                'title' => esc_html__('Transparent header logo width', 'easyweb'),
                'std' => '280'
            ),
            array(
                'id' => 'easyweb_webnus_sticky_logo',
                'type' => 'upload',
                'title' => esc_html__('Sticky header logo', 'easyweb'),
                'desc'=> wp_kses( __('<br>Use this option to upload a logo which will be used when header is on sticky state.Sticky state is a fixed header when scrolling.','easyweb'), array( 'br' => array() ) ),
            ),
             array(
                'id' => 'easyweb_webnus_sticky_logo_width',
                'type' => 'text',
                'title' => esc_html__('Sticky header logo width', 'easyweb'),
                'std' => '60'
            ),
            array(
                'id' => 'easyweb_webnus_header_padding_top',
                'type' => 'text',
                'title' => esc_html__('Header padding-top', 'easyweb'),
                'desc'=> wp_kses( __('<br>This option controls the space between header top with content or elements that is in top of the header.','easyweb'), array( 'br' => array() ) ),
            ),
            array(
                'id' => 'easyweb_webnus_header_padding_bottom',
                'type' => 'text',
                'title' => esc_html__('Header padding-bottom', 'easyweb'),
                'desc'=> wp_kses( __('<br>This option controls the space between header bottom with content or elements that is in bottom of the header.','easyweb'), array( 'br' => array() ) ),
            ),
            array(
                'id' => 'easyweb_webnus_slogan',
                'type' => 'text',
                'title' => esc_html__('Slogan text', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_page_menu_sp',
                'type' => 'seperator',
                'desc' => esc_html__('Header Menu', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_header_sticky',
                'type' => 'button_set',
                'title' => esc_html__('Sticky Menu', 'easyweb'),
                'options' => array('0' => esc_html__('Disable', 'easyweb'), '1' => esc_html__('Enable', 'easyweb')),
                'desc'=> wp_kses( __('<br>Sticky menu is a fixed header when scrolling the page. By enabling this option when you are scrolling, the header menu will scroll too.','easyweb'), array( 'br' => array() ) ),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_header_sticky_scrolls',
                'type' => 'text',
                'title' => esc_html__('Scrolls value to sticky the header', 'easyweb'),
                'desc'=> wp_kses( __('<br>Fill your desired amount which by scrolling that amount, sticky menu will appear.','easyweb'), array( 'br' => array() ) ),
                'std' => '380',
            ),
            array(
                'id' => 'easyweb_webnus_header_menu_type',
                'type' => 'radio_img',
                'title' => esc_html__('Select Header Layout', 'easyweb'),
                'options' => array(
                    '0' => array('title' => esc_html__('Header Type 0', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu0.png'),
                    '1' => array('title' => esc_html__('Header Type 1', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu1.png'),
                    '2' => array('title' => esc_html__('Header Type 2', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu2.png'),
                    '3' => array('title' => esc_html__('Header Type 3', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu3.png'),
                    '4' => array('title' => esc_html__('Header Type 4', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu4.png'),
                    '5' => array('title' => esc_html__('Header Type 5', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu5.png'),
                    '6' => array('title' => esc_html__('Header Type 6', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu6.png'),
                    '7' => array('title' => esc_html__('Header Type 7', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu7.png'),
                    '8' => array('title' => esc_html__('Header Type 8', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu8.png'),
                    '9' => array('title' => esc_html__('Header Type 9', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu9.png'),
                    '10' => array('title' => esc_html__('Header Type 10', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu10.png'),
                    '11' => array('title' => esc_html__('Header Type 11', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu11.png'),
                ),
                'std' => '11'
            ),
            array(
                'id' => 'easyweb_webnus_dark_submenu',
                'type' => 'button_set',
                'title' => esc_html__('Dark Submenu', 'easyweb'),
                'desc' => esc_html__('For Header Menu and Topbar Menu','easyweb'),
                'options' => array('0' => esc_html__('Disable', 'easyweb'), '1' => esc_html__('Enable', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_header_background',
                'type' => 'upload',
                'title' => esc_html__('Header Background Image', 'easyweb'),
                'desc' => esc_html__('For Header Type 6', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_header_logo_alignment',
                'type' => 'button_set',
                'title' => esc_html__('Logo Alignment', 'easyweb'),
                'desc'=> wp_kses( __('<br>This option changes the position of the logo on top of the header.<br>For header type: 2, 3, 4, 5 and 9','easyweb'), array( 'br' => array() ) ),
                'options' => array('1' => 'Left', '2' => 'Center', '3' => 'Right'),
                'std' => '2'
            ),
            array(
                'id' => 'easyweb_webnus_header_search_enable',
                'type' => 'button_set',
                'title' => esc_html__('Search in Header', 'easyweb'),
                'desc'=> wp_kses( __('<br>This option shows a search icon at the end of the header menu for header type 1','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Disable', 'easyweb'), '1' => esc_html__('Enable', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_header_woocart_enable',
                'type' => 'button_set',
                'title' => esc_html__('Wocommerce cart in Header', 'easyweb'),
                'desc'=> wp_kses( __('<br>This option shows a woocommerce cart icon at top of the header menu for header type 11','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Disable', 'easyweb'), '1' => esc_html__('Enable', 'easyweb')),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_header_logo_rightside',
                'type' => 'select',
                'title' => esc_html__('Header Next Side Space', 'easyweb'),
                'desc'=> wp_kses( __('<br>For header type: 2, 3, 4, 5, 9<br><br>Contact information: you can put phone number and email address by fill the information boxes in the next part.','easyweb'), array( 'br' => array() ) ),
                'options' => array(0 => esc_html__('None','easyweb'), 1 => esc_html__('Search Box','easyweb'), 2 => esc_html__('Contact Information','easyweb'), 3 => esc_html__('Header Sidebar','easyweb')),
                'std' => '2'
            ),
            array(
                'id' => 'easyweb_webnus_header_address',
                'type' => 'textarea',
                'title' => esc_html__('Header Address', 'easyweb'),
                'std' => '<strong>1234 North Avenue Luke Lane</strong><br>South Bend, IN 360001'
            ),
            array(
                'id' => 'easyweb_webnus_header_phone',
                'type' => 'textarea',
                'title' => esc_html__('Header Phone Number', 'easyweb'),
                'std' => '<strong>987.654.3216</strong><br>987.654.3217'
            ),
            array(
                'id' => 'easyweb_webnus_header_email',
                'type' => 'textarea',
                'title' => esc_html__('Header Email Address', 'easyweb'),
                'std' => '<strong>info@easyseo.com</strong><br>support@easyseo.com'
            ),
              array(
                'id' => 'easyweb_webnus_header_menu_icon',
                'type' => 'radio_img',
                'title' => esc_html__('Responsive header', 'easyweb'),
                'desc'=> wp_kses( __('<br>Choose between two type of responsive menu navigation for mobile and tablet sizes.','easyweb'), array( 'br' => array() ) ),
                'options' => array(
                    'sm-rgt-ms' => array('title' => esc_html__('Modern', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu-icon1.png'),
                    '' => array('title' => esc_html__('Classic', 'easyweb'), 'img' => $theme_img_dir . 'menutype/menu-icon2.png'),
                ),
                'std' => 'sm-rgt-ms'
            ),
            array(
                'id' => 'easyweb_webnus_news_ticker_sp',
                'type' => 'seperator',
                'desc' => esc_html__('News Ticker', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_news_ticker',
                'type' => 'button_set',
                'title' => esc_html__('Active', 'easyweb'),
                'desc' => '',
                'options' => array('0' => esc_html__('Disable', 'easyweb'), '1' => esc_html__('Enable', 'easyweb')),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_nt_show',
                'type' => 'button_set',
                'title' => esc_html__('Show in', 'easyweb'),
                'desc' => '',
                'options' => array('0' => esc_html__('Home', 'easyweb'), '1' => esc_html__('All Page', 'easyweb')),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_nt_title',
                'type' => 'text',
                'title' => esc_html__('News Ticker Title', 'easyweb'),
                'std' => 'Latest Posts'
            ),
            array(
                'id' => 'easyweb_webnus_nt_cat',
                'type' => 'select',
                'title' => esc_html__('Category', 'easyweb'),
                'options' => $category_slug_array,
                'desc' => wp_kses( __('<br><br>Select specific category, leave blank to show all categories.', 'easyweb'), array( 'br' => array() ) ),
                'std' => ''
            ),
            array(
                'id' => 'easyweb_webnus_nt_count',
                'type' => 'text',
                'title' => esc_html__('Post Count', 'easyweb'),
                'std' => '5'
            ),
            array(
                'id' => 'easyweb_webnus_nt_effect',
                'type' => 'button_set',
                'title' => esc_html__('Animation Type', 'easyweb'),
                'options' => array('reveal' => esc_html__('Reveal', 'easyweb'), 'fade' => esc_html__('Fade', 'easyweb')),
                'std' => 'reveal'
            ),
            array(
                'id' => 'easyweb_webnus_nt_speed',
                'type' => 'text',
                'title' => esc_html__('Animation Speed', 'easyweb'),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_nt_pause',
                'type' => 'text',
                'title' => esc_html__('Pause On Items', 'easyweb'),
                'std' => '2'
            ),
    ));
        /** TOPBAR **/  
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-topbar.png',
        'title' => esc_html__('Topbar Options', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">Top bar is the topmost location in your website that you can place special elements in such as Login Modal, Donate Modal, Menu, Social Icons, Cantact Informations, TagLine and WPML Language bar.</p><p>Note: when you choose menu, you should create Topbar Menu from apearance > menus.</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
            array(
                'id' => 'easyweb_webnus_header_topbar_enable',
                'type' => 'button_set',
                'title' => esc_html__('Show/Hide TopBar', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_topbar_background_color',
                'type' => 'color',
                'title' => esc_html__('Background Color', 'easyweb'),
                'desc'=> wp_kses( __('<br>This option changes the background color of Topbar.','easyweb'), array( 'br' => array() ) ),
                'std' => ''
            ),
            array(
                'id' => 'easyweb_webnus_topbar_fixed',
                'type' => 'button_set',
                'title' => esc_html__('Fixed Topbar', 'easyweb'),
                'options' => array('0' => esc_html__('Disable', 'easyweb'), '1' => esc_html__('Enable', 'easyweb')),
                'std' => '0'
            ),  
            
            array(
                'id' => 'easyweb_webnus_topbar_search',
                'type' => 'button_set',
                'title' => esc_html__('Search Bar', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'std' => ''
            ),          

            array(
                'id' => 'easyweb_webnus_topbar_login',
                'type' => 'button_set',
                'title' => esc_html__('Login Modal', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'desc' => wp_kses( __('<br>Login Modal Link in Topbar','easyweb'), array( 'br' => array() ) ),
                'std' => 'right'
            ),

            array(
                'id' => 'easyweb_webnus_topbar_login_text',
                'type' => 'text',
                'title' => esc_html__('Login Modal Text', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'desc' => wp_kses( __('<br>Login Modal Link Text','easyweb'), array( 'br' => array() ) ),
                'std' => 'Login / Register'
            ),
            
            array(
                'id' => 'easyweb_webnus_topbar_donate',
                'type' => 'button_set',
                'title' => esc_html__('Donate Modal', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'desc' => wp_kses( __('<br>Donate Modal Link in Topbar','easyweb'), array( 'br' => array() ) ),
            ),

            array(
                'id' => 'easyweb_webnus_topbar_contact',
                'type' => 'button_set',
                'title' => esc_html__('Contact Modal', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'desc' => wp_kses( __('<br>Contact Modal Link in Topbar','easyweb'), array( 'br' => array() ) ),
                'std' => ''
            ),
            
            array(
                'id' => 'easyweb_webnus_topbar_form',
                'type' => 'select',
                'title' => esc_html__('Select Contact Form', 'easyweb'),
                'options' => $contact_forms,
                'desc' => wp_kses( __('<br>Choose previously created contact form from the drop down list.', 'easyweb'), array( 'br' => array() ) ),
            ),
            

            array(
                'id' => 'easyweb_webnus_topbar_info',
                'type' => 'button_set',
                'title' => esc_html__('Contact Information', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
            ),

            array(
                'id' => 'easyweb_webnus_topbar_address',
                'type' => 'textarea',
                'title' => esc_html__('Topbar Address', 'easyweb'),
                'std' => ''
            ),
            array(
                'id' => 'easyweb_webnus_topbar_phone',
                'type' => 'text',
                'title' => esc_html__('Topbar Phone Number', 'easyweb'),
                'std' => '+1 234 56789'
            ),
            array(
                'id' => 'easyweb_webnus_topbar_email',
                'type' => 'text',
                'title' => esc_html__('Topbar Email Address', 'easyweb'),
                'std' => 'info@site.com'
            ),
            
            array(
                'id' => 'easyweb_webnus_topbar_menu',
                'type' => 'button_set',
                'title' => esc_html__('Topbar Menu', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'std' => 'left'
            ),

            array(
                'id' => 'easyweb_webnus_topbar_custom_button',
                'type' => 'button_set',
                'title' => esc_html__('Custom Button', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'std' => 'right'
            ),

            array(
                'id' => 'easyweb_webnus_topbar_button_text',
                'type' => 'text',
                'title' => esc_html__('Topbar Button Text', 'easyweb'),
            ),

            array(
                'id' => 'easyweb_webnus_topbar_button_link',
                'type' => 'text',
                'title' => esc_html__('Topbar Button Link URL', 'easyweb'),
            ),
            
            array(
                'id' => 'easyweb_webnus_topbar_custom',
                'type' => 'button_set',
                'title' => esc_html__('Custom Text', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
            ),
            
            array(
                'id' => 'easyweb_webnus_topbar_text',
                'type' => 'text',
                'title' => esc_html__('Topbar Custom Text', 'easyweb'),
                'desc' => wp_kses( __('<br>Insert Any Text You Want Here', 'easyweb'), array( 'br' => array() ) ),
            ),

            array(
                'id' => 'easyweb_webnus_topbar_language',
                'type' => 'button_set',
                'title' => esc_html__('Language Bar', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
                'desc' => wp_kses( __('<br>WPML Language Bar in Topbar','easyweb'), array( 'br' => array() ) ),
            ),
            
            array(
                'id' => 'easyweb_webnus_topbar_social',
                'type' => 'button_set',
                'title' => esc_html__('Social Icons', 'easyweb'),
                'options' => array('' => esc_html__('None', 'easyweb'), 'left' => esc_html__('Left', 'easyweb'), 'right' => esc_html__('Right', 'easyweb')),
'desc'=> wp_kses( __('<br>Set in Social Networks Tab.','easyweb'), array( 'br' => array() ) ),
                'std' => 'right'
            ),
    ));
    
        
    //background options
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-background.png',
        'title' => esc_html__('Background', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">This section is about the background of your whole website.', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
            /* Enable Disable Header Social */
            array(
                'id' => 'easyweb_webnus_background',
                'type' => 'upload',
                'title' => esc_html__('Background Image', 'easyweb'),
                'desc' => esc_html__('Please choose an image or insert an image url to use for the backgroud.', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_background_100',
                'type' => 'checkbox',
                'title' => esc_html__('100% Background Image', 'easyweb'),
                'desc' => esc_html__('Check the box to have the background image always at 100% in width and height and scale according to the browser size.', 'easyweb'),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_background_repeat',
                'type' => 'select',
                'title' => esc_html__('Background Repeat', 'easyweb'),
                'options' => array('1' => esc_html__('repeat', 'easyweb'), '2' => esc_html__('repeat-x', 'easyweb'), '3' => esc_html__('repeat-y', 'easyweb'), '0' => esc_html__('no-repeat', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_background_color',
                'type' => 'color',
                'title' => esc_html__('Background Color', 'easyweb'),
                'sub_desc' => esc_html__('Pick a background color', 'easyweb'),
                'std' => ''
            ),
            array(
                'id' => 'easyweb_webnus_background_pattern', //must be unique
                'type' => 'radio_img', //the field type
                'title' => esc_html__('Background Pattern', 'easyweb'),
                'options' => array('none' => array('title' => esc_html__('None', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/none.jpg'),
                    $theme_img_dir . 'bdbg1.png' => array('title' => esc_html__('Default BG', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/bdbg1.png'), $theme_img_bg_dir . 'gray-jean.png' => array('title' => esc_html__('Gray Jean', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/gray-jean.png'), $theme_img_bg_dir . 'light-wool.png' => array('title' => esc_html__('Light Wool', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/light-wool.png'),
                    $theme_img_bg_dir . 'subtle_freckles.png' => array('title' => esc_html__('Subtle Freckles', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/subtle_freckles.png'),
                    $theme_img_bg_dir . 'subtle_freckles2.png' => array('title' => esc_html__('Subtle Freckles 2', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/subtle_freckles2.png'),
                    $theme_img_bg_dir . 'green-fibers.png' => array('title' => esc_html__('Green Fibers', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/green-fibers.png'),
                    $theme_img_bg_dir . 'dust.png' => array('title' => esc_html__('Dust', 'easyweb'), 'img' => $theme_img_bg_dir . 'bg-pattern/dust.png')),
                'std' => $theme_img_dir . 'bdbg1.png'//this should be the key as defined above
            )
    ));
    /* custom fonts */
    include_once get_template_directory() . '/inc/nc-options/gfonts/gfonts.php';
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-typography.png',
        'title' => esc_html__('Typography', 'easyweb'),
        'fields' => array(
            array(
                'id' => 'sep1',
                'type' => 'seperator',
                'desc' => esc_html__('Custom font 1', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_custom_font1_woff',
                'type' => 'upload',
                'title' => esc_html__('Custom font 1 .woff', 'easyweb'),
                'desc' => esc_html__('Upload the .woff font file for custom font 1', 'easyweb'),
                'options' => $fontArray
            ),
            array(
                'id' => 'easyweb_webnus_custom_font1_ttf',
                'type' => 'upload',
                'title' => esc_html__('Custom font 1 .ttf', 'easyweb'),
                'desc' => esc_html__('Upload the .ttf font file for custom font 1', 'easyweb'),
                'options' => $fontArray
            ),         
            array(
                'id' => 'easyweb_webnus_custom_font1_eot',
                'type' => 'upload',
                'title' => esc_html__('custom font 1 .eot', 'easyweb'),
                'desc' => esc_html__('Upload the .eot font file for custom font 1', 'easyweb'),
                'options' => $fontArray
            ),
            /* custom font 2*/ 
            array(
                'id' => 'sep1',
                'type' => 'seperator',
                'desc' => esc_html__('Custom font 2', 'easyweb'),
            ),            
            array(
                'id' => 'easyweb_webnus_custom_font2_woff',
                'type' => 'upload',
                'title' => esc_html__('Custom font 2 .woff', 'easyweb'),
                'desc' => esc_html__('Upload the .woff font file for custom font 2', 'easyweb'),
                'options' => $fontArray
            ),
            array(
                'id' => 'easyweb_webnus_custom_font2_ttf',
                'type' => 'upload',
                'title' => esc_html__('Custom font 2 .ttf', 'easyweb'),
                'desc' => esc_html__('Upload the .ttf font file for custom font 2', 'easyweb'),
                'options' => $fontArray
            ),  
            array(
                'id' => 'easyweb_webnus_custom_font2_eot',
                'type' => 'upload',
                'title' => esc_html__('custom font 2 .eot', 'easyweb'),
                'desc' => esc_html__('Upload the .eot font file for custom font 2', 'easyweb'),
                'options' => $fontArray
            ),
            /* custom font 3*/ 
            array(
                'id' => 'sep1',
                'type' => 'seperator',
                'desc' => esc_html__('Custom font 3', 'easyweb'),
            ),            
            array(
                'id' => 'easyweb_webnus_custom_font3_woff',
                'type' => 'upload',
                'title' => esc_html__('Custom font 3 .woff', 'easyweb'),
                'desc' => esc_html__('Upload the .woff font file for custom font 3', 'easyweb'),
                'options' => $fontArray
            ),
            array(
                'id' => 'easyweb_webnus_custom_font3_ttf',
                'type' => 'upload',
                'title' => esc_html__('Custom font 3 .ttf', 'easyweb'),
                'desc' => esc_html__('Upload the .ttf font file for custom font 3', 'easyweb'),
                'options' => $fontArray
            ),          
            array(
                'id' => 'easyweb_webnus_custom_font3_eot',
                'type' => 'upload',
                'title' => esc_html__('custom font 3 .eot', 'easyweb'),
                'desc' => esc_html__('Upload the .eot font file for custom font 3', 'easyweb'),
                'options' => $fontArray
            ),
            /* Adobe Typekit*/ 
            array(
                'id' => 'sep4',
                'type' => 'seperator',
                'desc' => esc_html__('Adobe Typekit', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_typekit_id',
                'type' => 'text',
                'title' => esc_html__('Typekit Kit ID', 'easyweb'),
                'desc'=> wp_kses( __('<br>You can learn more about Adobe Typekit from here.','easyweb'), array( 'br' => array() ) ),
            ),
            array(
                'id' => 'easyweb_webnus_typekit_font1',
                'type' => 'text',
                'title' => esc_html__('Typekit Font Family 1', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_typekit_font2',
                'type' => 'text',
                'title' => esc_html__('Typekit Font Family 2', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_typekit_font3',
                'type' => 'text',
                'title' => esc_html__('Typekit Font Family 3', 'easyweb'),
            ),
             /* select font*/ 
            array(
                'id' => 'sep5',
                'type' => 'seperator',
                'desc' =>  esc_html__( 'Select Font Family', 'easyweb'),
            ),
             array(
                'id' => 'easyweb_webnus_body_font',
                'type' => 'select',
                'title' => esc_html__('Select Body Font Family', 'easyweb'),
                'desc' => esc_html__('Select a font family for body text', 'easyweb'),
                'options' => $fontArray
            ),
            array(
                'id' => 'easyweb_webnus_heading_font',
                'type' => 'select',
                'title' => esc_html__('Select Headings Font', 'easyweb'),
                'desc' => esc_html__('Select a font family for headings', 'easyweb'),
                'options' => $fontArray
            ),
            array(
                'id' => 'easyweb_webnus_p_font',
                'type' => 'select',
                'title' => esc_html__('Select Paragraph Font', 'easyweb'),
                'desc' => esc_html__('Select a font family for paragraphs', 'easyweb'),
                'options' => $fontArray
            ),  
              array(
                'id' => 'easyweb_webnus_menu_font',
                'type' => 'select',
                'title' => esc_html__('Select Menu Font', 'easyweb'),
                'desc' => esc_html__('Select a font family for menu', 'easyweb'),
                'options' => $fontArray
            ),  
            array(
                'id' => 'sep1',
                'type' => 'seperator',
                'desc' => esc_html__('Header Menu Links Typography', 'easyweb'),
            ),
            /* NAV */    
            array(
                'id' => 'easyweb_webnus_topnav_font_size',
                'type' => 'slider',
                'title' => esc_html__('Header Menu font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_topnav_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('Header Menu letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_topnav_line_height',
                'type' => 'slider',
                'title' => esc_html__('Header Menu line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            /* END Menu */
            array(
                'id' => 'sep1',
                'type' => 'seperator',
                'desc' => esc_html__('Paragraph and Headings Typography', 'easyweb'),
            ),
             /* P */   
            array(
                'id' => 'easyweb_webnus_p_font_size',
                'type' => 'slider',
                'title' => esc_html__('P font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_p_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('P letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_p_line_height',
                'type' => 'slider',
                'title' => esc_html__('P line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_p_font_color',
                'type' => 'color',
                'title' => esc_html__('P font-color', 'easyweb'),
            ),
             /* END P */
            /* H1 */   
            array(
                'id' => 'easyweb_webnus_h1_font_size',
                'type' => 'slider',
                'title' => esc_html__('H1 font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h1_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('H1 letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h1_line_height',
                'type' => 'slider',
                'title' => esc_html__('H1 line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h1_font_color',
                'type' => 'color',
                'title' => esc_html__('H1 font-color', 'easyweb'),
            ),
             /* END H1 */
              /* H2 */  
            array(
                'id' => 'easyweb_webnus_h2_font_size',
                'type' => 'slider',
                'title' => esc_html__('H2 font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h2_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('H2 letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h2_line_height',
                'type' => 'slider',
                'title' => esc_html__('H2 line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h2_font_color',
                'type' => 'color',
                'title' => esc_html__('H2 font-color', 'easyweb'),
            ),
             /* END H2 */
              /* H3 */  
            array(
                'id' => 'easyweb_webnus_h3_font_size',
                'type' => 'slider',
                'title' => esc_html__('H3 font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h3_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('H3 letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h3_line_height',
                'type' => 'slider',
                'title' => esc_html__('H3 line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h3_font_color',
                'type' => 'color',
                'title' => esc_html__('H3 font-color', 'easyweb'),
            ),
            /* END H3 */
            /* H4 */ 
            array(
                'id' => 'easyweb_webnus_h4_font_size',
                'type' => 'slider',
                'title' => esc_html__('H4 font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h4_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('H4 letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h4_line_height',
                'type' => 'slider',
                'title' => esc_html__('H4 line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h4_font_color',
                'type' => 'color',
                'title' => esc_html__('H4 font-color', 'easyweb'),
            ),
            /* END H4 */
            /* H5 */ 
            array(
                'id' => 'easyweb_webnus_h5_font_size',
                'type' => 'slider',
                'title' => esc_html__('H5 font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h5_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('H5 letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h5_line_height',
                'type' => 'slider',
                'title' => esc_html__('H5 line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h5_font_color',
                'type' => 'color',
                'title' => esc_html__('H5 font-color', 'easyweb'),
            ),
            /* END H5 */
            /* H6 */ 
            array(
                'id' => 'easyweb_webnus_h6_font_size',
                'type' => 'slider',
                'title' => esc_html__('H6 font-size', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h6_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('H6 letter-spacing', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h6_line_height',
                'type' => 'slider',
                'title' => esc_html__('H6 line-height', 'easyweb'),
                'value' => array('min'=>1,'max'=>100),
            ),
            array(
                'id' => 'easyweb_webnus_h6_font_color',
                'type' => 'color',
                'title' => esc_html__('H6 font-color', 'easyweb'),
            ),
        )
    );
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-style.png',
        'title' => esc_html__('Styling Options', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">You can manage every style that you see in the theme from here.</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
        array(
                'id' => 'easyweb_webnus_color_skin', //must be unique
                'type' => 'radio_img', //the field type
                'title' => esc_html__('Predefined Color Skin', 'easyweb'),
                'options' => array(
                 '1' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color3-ss.png')
                ,'2' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color1-ss.png')
                ,'3' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color4-ss.png')
                ,'4' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color2-ss.png')
                ,'5' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color5-ss.png')
                ,'6' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color6-ss.png')
                ,'7' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color7-ss.png')
                ,'8' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color8-ss.png')
                ,'9' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color9-ss.png')
                ,'10' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color10-ss.png')
                ,'11' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color11-ss.png')
                ,'12' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color12-ss.png')
                ,'13' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color13-ss.png')
                ,'14' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color14-ss.png')
                ,'15' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color15-ss.png')
                ,'16' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color16-ss.png')
                ,'17' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color17-ss.png')
                ,'18' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color18-ss.png')
                ,'19' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color19-ss.png')
                ,'20' => array('title' =>'','img' => NHP_OPTIONS_URL . 'img/color20-ss.png')
                ),
                'desc' => esc_html__('This option changes the default color scheme of your theme such as links, titles & etc. It will automatically change to the defined color.', 'easyweb'),
                'std' => ''//this should be the key as defined above
            ),
            array(
                'id' => 'easyweb_webnus_custom_color_sep',
                'type' => 'seperator',
                'desc' => esc_html__('Custom Color Skin', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_custom_color_skin_enable',
                'type' => 'button_set',
                'title' => esc_html__('Custom Color Skin Enable/Disable', 'easyweb'),
                'options' => array(1 => esc_html__('Enable','easyweb'), 0 => esc_html__('Disable','easyweb')),
                'desc' => esc_html__('To choose your own color scheme, enable this.', 'easyweb'),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_custom_color_skin',
                'type' => 'color',
                'title' => esc_html__('Custom Color Skin', 'easyweb'),
                'desc' => esc_html__('Choose your desire color scheme.', 'easyweb'),
                'std' => ''
            ),
            array(
                'id' => 'mainstyle-sep1',
                'type' => 'seperator',
                'desc' => esc_html__('Link Base Color', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_link_color',
                'type' => 'color',
                'title' => esc_html__('Unvisited Link Color', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_hover_link_color',
                'type' => 'color',
                'title' => esc_html__('Mouse Over Link Color', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_visited_link_color',
                'type' => 'color',
                'title' => esc_html__('Visited Link Color ', 'easyweb'),
            ),
            array(
                'id' => 'mainstyle-sep1',
                'type' => 'seperator',
                'desc' => esc_html__('Header Menu Colors', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_menu_link_color',
                'type' => 'color',
                'title' => esc_html__('Header Menu Link Color', 'easyweb'),
            ),
            array(
                'id'=>'easyweb_webnus_menu_hover_link_color',
                'type'=>'color',
                'title'=> esc_html__('Header Menu Link Hover Color','easyweb'),            
            ),
            array(
                'id'=>'easyweb_webnus_menu_selected_link_color',
                'type'=>'color',
                'title'=> esc_html__('Header Menu Link Selected Color','easyweb'),         
            ),
            array(
                'id'=>'easyweb_webnus_menu_selected_border_color',
                'type'=>'color',
                'title'=> esc_html__('Header Menu Selected Border Color','easyweb'),           
            ),
            array(
                'id'=>'easyweb_webnus_resoponsive_menu_icon_color',
                'type'=>'color',
                'title'=> esc_html__('Responsive Menu Icon Color','easyweb'),
                'desc'=> esc_html__('This menu icon appears in mobile & tablet view','easyweb'),
            ),
            //Icon Box Colors
            array(
                'id' => 'mainstyle-sep2',
                'type' => 'seperator',
                'desc' => esc_html__('Icon Box Colors', 'easyweb'),
            ),
            array(
                'id'=>'easyweb_webnus_iconbox_base_color',
                'type'=>'color',
                'title'=>esc_html__('Iconbox base color', 'easyweb'),      
            ),
            array(
                'id'=>'easyweb_webnus_learnmore_link_color',
                'type'=>'color',
                'title'=>esc_html__('Learn more link color', 'easyweb'),       
            ),
            array(
                'id'=>'easyweb_webnus_learnmore_hover_link_color',
                'type'=>'color',
                'title'=>esc_html__('Learn more hover link color', 'easyweb'),     
            ),
            /*
             * Scroll to top
             */
            array(
                'id' => 'mainstyle-sep11',
                'type' => 'seperator',
                'desc' => esc_html__('Scroll to top', 'easyweb'),
            ),
            array(
                'id'=>'easyweb_webnus_scroll_to_top_hover_background_color',
                'type'=>'color',
                'title'=>esc_html__('Scroll to top hover background color ', 'easyweb'),   
            ),
            /*
             * Contact form
             */
            array(
                'id' => 'mainstyle-sep11',
                'type' => 'seperator',
                'desc' => esc_html__('Footer Contact form', 'easyweb'),
            ),
            array(
                'id'=>'easyweb_webnus_contactform_button_color',
                'type'=>'color',
                'title'=>esc_html__('Contact form button color ', 'easyweb'),      
            ),
            array(
                'id'=>'easyweb_webnus_contactform_button_hover_color',
                'type'=>'color',
                'title'=>esc_html__('Contact form button hover color ', 'easyweb'),            
            ),
        )
    );
    /*
     *
     *
     * BLOG Options
     *
     *
     */
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-blog.png',
        'title' => esc_html__('Blog Options', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">This section is about everything belong to blog page and blog posts.', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
             array(
                'id' => 'easyweb_webnus_blog_template',
                'type' => 'select',
                'title' => esc_html__('BlogTemplate', 'easyweb'),
                'desc'=> wp_kses( __('<br>For styling your blog page you can choose among these template layouts.','easyweb'), array( 'br' => array() ) ),
                'options' => array(
                    '1' => esc_html__('Large Posts', 'easyweb'),
                    '2' => esc_html__('List Posts', 'easyweb'),
                    '3' => esc_html__('Grid Posts', 'easyweb'),
                    '4' => esc_html__('First Large then List', 'easyweb'),
                    '5' => esc_html__('First Large then Grid', 'easyweb'),
                    '6' => esc_html__('Masonry', 'easyweb'),
                    '7' => esc_html__('Timeline', 'easyweb')
                ),
                'std' => '2'
            ),
             array(
                'id' => 'easyweb_webnus_blog_page_title_enable',
                'type' => 'button_set',
                'title' => esc_html__('Blog Page Title Show/Hide', 'easyweb'),
                'desc'=> wp_kses( __('<br>By hiding this option, blog Page title will be disappearing.','easyweb'), array( 'br' => array() ) ),
                'std' => '1',
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
            ),
             array(
                'id' => 'easyweb_webnus_blog_page_title',
                'type' => 'text',
                'title' => esc_html__('Blog Page Title', 'easyweb'),
                'std' => 'Blog',
            ),
            array(
                'id' => 'easyweb_webnus_blog_sidebar',
                'type' => 'button_set',
                'title' => esc_html__('Blog Sidebar Position', 'easyweb'),
                'options' => array('none'=>'None','left' => 'Left', 'right' => 'Right', 'both' => 'Both'),
                'std' => 'right',
            ),
            array(
                'id' => 'easyweb_webnus_blog_featuredimage_enable',
                'type' => 'button_set',
                'title' => esc_html__('Featured Image on Blog', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'desc'=> wp_kses( __('<br>By disabling this option, all blog feature images will be disappearing.','easyweb'), array( 'br' => array() ) ),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_no_image',
                'type' => 'button_set',
                'title' => esc_html__('Default Blank Featured Image', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_no_image_src',
                'type' => 'upload',
                'title' => esc_html__('Custom Default Blank Featured Image', 'easyweb'),
            ),
             array(
                'id' => 'easyweb_webnus_blog_posttitle_enable',
                'type' => 'button_set',
                'title' => esc_html__('Post Title on Blog', 'easyweb'),
                'desc'=> wp_kses( __('<br>By disabling this option, all post title images will be disappearing.','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
             array(
                'id' => 'easyweb_webnus_blog_excerptfull_enable',
                'type' => 'button_set',
                'title' => esc_html__('Excerpt Or Full Blog Content', 'easyweb'),
                'desc'=> wp_kses( __('<br>You can show all text of your posts in blog page or a fixed amount of characters to show for each post.','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Excerpt', 'easyweb'), '1' => esc_html__('&nbsp;&nbsp;&nbsp;Full&nbsp;&nbsp;&nbsp;', 'easyweb')),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_blog_excerpt_large',
                'type' => 'text',
                'title' => esc_html__('Excerpt Length for Large Posts', 'easyweb'),
                'desc'=> wp_kses( __('<br>Type the number of characters you want to show in the blog page for each post.','easyweb'), array( 'br' => array() ) ),
                'std' => '93',
            ),
            array(
                'id' => 'easyweb_webnus_blog_excerpt_list',
                'type' => 'text',
                'title' => esc_html__('Excerpt Length for List Posts', 'easyweb'),
                'desc'=> wp_kses( __('<br>Type the number of characters you want to show in the blog page for each post.','easyweb'), array( 'br' => array() ) ),
                'std' => '17',
            ),
            array(
                'id' => 'easyweb_webnus_blog_readmore_text',
                'type' => 'text',
                'title' => esc_html__('Read More Text', 'easyweb'),
                'desc'=> wp_kses( __('<br>You can set another name instead of read more link.','easyweb'), array( 'br' => array() ) ),
                'std' => 'Continue Reading',
            ),
         array(
                'id' => 'easyweb_webnus_custom_color_sep',
                'type' => 'seperator',
                'desc' => esc_html__('Metadata Options', 'easyweb'),
                'sub_desc' => esc_html__('on Single Post', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_blog_meta_gravatar_enable',
                'type' => 'button_set',
                'title' => esc_html__('Metadata Gravatar', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
             array(
                'id' => 'easyweb_webnus_blog_meta_author_enable',
                'type' => 'button_set',
                'title' => esc_html__('Metadata Author', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_blog_meta_date_enable',
                'type' => 'button_set',
                'title' => esc_html__('Metadata Date', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
             array(
                'id' => 'easyweb_webnus_blog_meta_category_enable',
                'type' => 'button_set',
                'title' => esc_html__('Metadata Category', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
             array(
                'id' => 'easyweb_webnus_blog_meta_comments_enable',
                'type' => 'button_set',
                'title' => esc_html__('Metadata Comments', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_blog_meta_views_enable',
                'type' => 'button_set',
                'title' => esc_html__('Metadata Views', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
             array(
                'id' => 'easyweb_webnus_custom_color_sep',
                'type' => 'seperator',
                'desc' => esc_html__('Single Post Options', 'easyweb'),
            ),
             array(
                'id' => 'easyweb_webnus_blog_singlepost_sidebar',
                'type' => 'button_set',
                'title' => esc_html__('Single Post Sidebar Position', 'easyweb'),
                'options' => array('none'=>'None','left' => 'Left', 'right' => 'Right'),
                'std' => 'right',
            ),
            array(
                'id' => 'easyweb_webnus_blog_sinlge_featuredimage_enable',
                'type' => 'button_set',
                'title' => esc_html__('Featured Image on Single Post', 'easyweb'),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_blog_social_share',
                'type' => 'button_set',
                'title' => esc_html__('Social Share Links', 'easyweb'),
                'desc'=> wp_kses( __('<br>By enabling this feature your visitors can share the post to social networks such as Facebook, Twitter and...','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_blog_single_authorbox_enable',
                'type' => 'button_set',
                'title' => esc_html__('Single post Authorbox', 'easyweb'),
                'desc'=> wp_kses( __('<br>This feature shows a picture of post author and some info about author.','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
             array(
                'id' => 'easyweb_webnus_recommended_posts',
                'type' => 'button_set',
                'title' => esc_html__('Recommended Posts', 'easyweb'),
                'desc'=> wp_kses( __('<br>This feature recommends related post to visitors.','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Off', 'easyweb'), '1' => esc_html__('On', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'blog_font_options',
                'type' => 'seperator',
                'desc' => esc_html__('Post Title Font Options', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_blog_title_font_family',
                'type' => 'select',
                'title' => esc_html__('Post Title Font Family', 'easyweb'),
                'options' =>$fontArray, 
            ),
            array(
                'id' => 'easyweb_webnus_blog_loop_title_font_size',
                'type' => 'slider',
                'title' => esc_html__('Post Title font-size on Blog', 'easyweb'),
                'value' =>array('min'=>0, 'max'=>100),
                'suffix'=>'px' 
            ),
           array(
                'id' => 'easyweb_webnus_blog_loop_title_line_height',
                'type' => 'slider',
                'title' => esc_html__('Post Title line-height on Blog', 'easyweb'),
                'value' =>array('min'=>0, 'max'=>100) ,
                'suffix'=>'px' 
            ),
           array(
                'id' => 'easyweb_webnus_blog_loop_title_font_weight',
                'type' => 'slider',
                'title' => esc_html__('Post Title font-weight on Blog', 'easyweb'),
                'value' =>array('min'=>1, 'max'=>900), 
                'suffix'=>'' ,
                'step'=>100
            ),
           array(
                'id' => 'easyweb_webnus_blog_loop_title_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('Post Title letter-spacing on Blog', 'easyweb'),
                'value' =>array('min'=>0, 'max'=>100) ,
                'suffix'=>'px' 
            ),
            array(
                'id' => 'easyweb_webnus_blog_loop_title_color',
                'type' => 'color',
                'title' => esc_html__('Post Title Color on Blog', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_blog_loop_title_hover_color',
                'type' => 'color',
                'title' => esc_html__('Post Title Hover Color on Blog', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_blog_single_post_title_font_size',
                'type' => 'slider',
                'title' => esc_html__('Post Title font-size on Single Post', 'easyweb'),
                'value' =>array('min'=>0, 'max'=>100)  ,
                'suffix'=>'px' 
            ),
            array(
                'id' => 'easyweb_webnus_blog_single_title_line_height',
                'type' => 'slider',
                'title' => esc_html__('Post Title line-height on Single Post', 'easyweb'),
                'value' =>array('min'=>0, 'max'=>100) ,
                'suffix'=>'px' 
            ),
            array(
                'id' => 'easyweb_webnus_blog_single_title_font_weight',
                'type' => 'slider',
                'title' => esc_html__('Post Title font-weight on Single Post', 'easyweb'),
                'value' =>array('min'=>1, 'max'=>900) ,
                'suffix'=>'' ,
                'step'=>100
            ),
           array(
                'id' => 'easyweb_webnus_blog_single_title_letter_spacing',
                'type' => 'slider',
                'title' => esc_html__('Post Title letter-spacing on Single Post', 'easyweb'),
                'value' =>array('min'=>1, 'max'=>100) ,
                'suffix'=>'px' 
            ),
            array(
                'id' => 'easyweb_webnus_blog_single_title_color',
                'type' => 'color',
                'title' => esc_html__('Post Title color on Single Post', 'easyweb'),
            ),
        )
    );
    //Social Network Accounts
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-social.png',
        'title' => esc_html__('Social Networks', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">Customize The Social Network Accounts</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
            array(
                'id' => 'easyweb_webnus_social_first',
                'type' => 'text',
                'title' => esc_html__('1st Social Name', 'easyweb'),
                'std' => 'facebook',
            ),
            array(
                'id' => 'easyweb_webnus_social_first_url',
                'type' => 'text',
                'title' => esc_html__('1st Social URL', 'easyweb'),
                'std' => '#',
            ),
            array(
                'id' => 'easyweb_webnus_social_second',
                'type' => 'text',
                'title' => esc_html__('2nd Social Name', 'easyweb'),
                'std' => 'twitter'
            ),
            array(
                'id' => 'easyweb_webnus_social_second_url',
                'type' => 'text',
                'title' => esc_html__('2nd Social URL', 'easyweb'),
                'std' => '#',
            ),
            array(
                'id' => 'easyweb_webnus_social_third',
                'type' => 'text',
                'title' => esc_html__('3rd Social Name', 'easyweb'),
                'std' => 'linkedin'
            ),
            array(
                'id' => 'easyweb_webnus_social_third_url',
                'type' => 'text',
                'title' => esc_html__('3rd Social URL', 'easyweb'),
                'std' => '#',
            ),
            array(
                'id' => 'easyweb_webnus_social_fourth',
                'type' => 'text',
                'title' => esc_html__('4th Social Name', 'easyweb'),
                'std' => 'google-plus'
            ),
            array(
                'id' => 'easyweb_webnus_social_fourth_url',
                'type' => 'text',
                'title' => esc_html__('4th Social URL', 'easyweb'),
                'std' => '#',
            ),
            array(
                'id' => 'easyweb_webnus_social_fifth',
                'type' => 'text',
                'title' => esc_html__('5th Social Name', 'easyweb'),
                'std' => 'youtube',

            ),
            array(
                'id' => 'easyweb_webnus_social_fifth_url',
                'type' => 'text',
                'title' => esc_html__('5th Social URL', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_social_sixth',
                'type' => 'text',
                'title' => esc_html__('6th Social Name', 'easyweb'),
                'std' => 'pinterest',
            ),
            array(
                'id' => 'easyweb_webnus_social_sixth_url',
                'type' => 'text',
                'title' => esc_html__('6th Social URL', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_social_seventh',
                'type' => 'text',
                'title' => esc_html__('7th Social Name', 'easyweb'),
                'std' => 'instagram',
            ),
            array(
                'id' => 'easyweb_webnus_social_seventh_url',
                'type' => 'text',
                'title' => esc_html__('7th Social URL', 'easyweb'),
            ),
        )
    );
   /* Footer  */
   $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-footer.png',
        'title' => esc_html__('Footer Options', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">Customize Footer</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
            array(
                'id' => 'easyweb_webnus_footer_instagram_bar',
                'type' => 'button_set',
                'title' => esc_html__('Footer Instagram Bar', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std' => '0'
            ),  
             array(
                'id' => 'easyweb_webnus_footer_instagram_username',
                'type' => 'text',
                'title' => esc_html__('Instagram Username', 'easyweb'),
                'std' => ''
            ),
             array(
                'id' => 'easyweb_webnus_footer_instagram_access',
                'type' => 'text',
                'title' => esc_html__('Instagram Access Token', 'easyweb'),
                'sub_desc' => wp_kses( __('Get the this information <a target="_blank" href="http://www.pinceladasdaweb.com.br/instagram/access-token/">here</a>.', 'easyweb'), array( 'p' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'target' => array() ) ) ),
                'std' => ''
            ),
            array(
                'id' => 'easyweb_webnus_footer_social_bar',
                'type' => 'button_set',
                'title' => esc_html__('Footer Social Bar', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'sub_desc' => esc_html__('Set in Social Networks Tab.', 'easyweb'),
                'std' => '0'
            ),  
            array(
                'id' => 'easyweb_webnus_footer_subscribe_bar',
                'type' => 'button_set',
                'title' => esc_html__('Footer Subscribe Bar', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std' => '0'
            ),
            array(
                'id' => 'easyweb_webnus_footer_subscribe_text',
                'type' => 'text',
                'title' => esc_html__('Footer Subscribe Text', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std' => ''
            ),
             array(
                'id' => 'easyweb_webnus_footer_subscribe_type',
                'type' => 'select',
                'title' => esc_html__('Subscribe Service', 'easyweb'),
                'options' => array('FeedBurner' => esc_html__('FeedBurner', 'easyweb'), 'MailChimp' => esc_html__('MailChimp', 'easyweb')),
                'std' => 'FeedBurner'
            ),              
             array(
                'id' => 'easyweb_webnus_footer_feedburner_id',
                'type' => 'text',
                'title' => esc_html__('Feedburner ID', 'easyweb'),
                'std' => ''
            ),  
             array(
                'id' => 'easyweb_webnus_footer_mailchimp_url',
                'type' => 'text',
                'title' => esc_html__('Mailchimp URL', 'easyweb'),
                'sub_desc' => esc_html__('Mailchimp form action URL', 'easyweb'),
                'std' => ''
            ),              
            array(
                'id' => 'easyweb_webnus_footer_bottom_enable',
                'type' => 'button_set',
                'title' => esc_html__('Footer Bottom', 'easyweb'),
                'desc'=> wp_kses( __('<br>This option shows a section below the footer that you can put copyright menu and logo in it.','easyweb'), array( 'br' => array() ) ),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std' => '0'
            ),      
            array(
                'id' => 'easyweb_webnus_footer_background_color',
                'type' => 'color',
                'title' => esc_html__('Footer background color', 'easyweb'),
                'sub_desc' => esc_html__('Pick a background color', 'easyweb'),
                'std' => ''
            ),
            array(
                'id' => 'easyweb_webnus_footer_bottom_background_color',
                'type' => 'color',
                'title' => esc_html__('Footer bottom background color', 'easyweb'),
                'sub_desc' => esc_html__('Pick a background color', 'easyweb'),
                'std' => ''
            ),
           array(
                'id' => 'easyweb_webnus_footer_color',
                'type' => 'button_set',
                'title' => esc_html__('Footer Color Style', 'easyweb'),
                'desc'=> wp_kses( __('<br>When you choose dark the text color will be white and when you choose light the text color will be dark.','easyweb'), array( 'br' => array() ) ),
                'options' => array('1' => esc_html__('Dark', 'easyweb'), '2' => esc_html__('Light', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_footer_bottom_left',
                'type' => 'select',
                'title' => esc_html__('Footer Bottom Left', 'easyweb'),
                'options' => array('1' => esc_html__('Logo', 'easyweb'), '2' => esc_html__('Menu', 'easyweb'),'3' => esc_html__('Custom Text', 'easyweb'),'4' => esc_html__('Social Icons', 'easyweb')),
                'std' => '3'
            ),
            array(
                'id' => 'easyweb_webnus_footer_bottom_right',
                'type' => 'select',
                'title' => esc_html__('Footer Bottom Right', 'easyweb'),
                'options' => array('1' => esc_html__('Logo', 'easyweb'), '2' => esc_html__('Menu', 'easyweb'),'3' => esc_html__('Custom Text', 'easyweb'),'4' => esc_html__('Social Icons', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_footer_logo',
                'type' => 'upload',
                'title' => esc_html__('Footer Logo', 'easyweb'),
                'desc' => esc_html__('Please choose an image file for footer logo.', 'easyweb'),
            ),
            array(
                'id' => 'easyweb_webnus_footer_copyright',
                'type' => 'text',
                'title' => esc_html__('Footer Copyright Text', 'easyweb'),
            ),
             array(
                'id' => 'easyweb_webnus_footer_type',
                'type' => 'radio_img',
                'title' => esc_html__('Footer Type', 'easyweb'),
                'desc'=> wp_kses( __('<br>Choose among these structures (1column, 2column, 3column and 4column) for your footer section.<br>To filling these column sections you should go to appearance > widget.<br>And put every widget that you want in these sections.','easyweb'), array( 'br' => array() ) ),
                'options' => array('1' => array('title' => esc_html__('Footer Layout 1', 'easyweb'), 'img' => $theme_img_dir . 'footertype/footer1.png'),
                    '2' => array('title' => esc_html__('Footer Layout 2', 'easyweb'), 'img' => $theme_img_dir . 'footertype/footer2.png'),
                    '3' => array('title' => esc_html__('Footer Layout 3', 'easyweb'), 'img' => $theme_img_dir . 'footertype/footer3.png'),
                    '4' => array('title' => esc_html__('Footer Layout 4', 'easyweb'), 'img' => $theme_img_dir . 'footertype/footer4.png'),
                    '5' => array('title' => esc_html__('Footer Layout 5', 'easyweb'), 'img' => $theme_img_dir . 'footertype/footer5.png'),
                    '6' => array('title' => esc_html__('Footer Layout 6', 'easyweb'), 'img' => $theme_img_dir . 'footertype/footer6.png'),
                ),
                'std' => '1'
            ),
    ));
      /*
     * 404 PAGE
     */
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-404.png',
        'title' => esc_html__('404 Page', 'easyweb'),
        'desc'=> wp_kses( __('<br>This page will be shown when a user types a wrong URL or link that does not exist.','easyweb'), array( 'br' => array() ) ),
        'fields' => array(
            array(
                'id' => 'easyweb_webnus_404_text',
                'type' => 'textarea',
                'title' => esc_html__('Text To Display', 'easyweb'),
                'std' => '<h3>We\'re sorry, but the page you were looking for doesn\'t exist.</h3>'
            ),
    ));
/*
        Custom css
*/
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-css.png',
        'title' => esc_html__('Custom CSS', 'easyweb'),
        'desc' => wp_kses( __('<p class="description">Any custom CSS from the user should go in this field, it will override the theme CSS.</p>', 'easyweb'), array( 'p' => array( 'class' => array() ) ) ),
        'fields' => array(
            array(
                'id' => 'easyweb_webnus_custom_css',
                'type' => 'textarea',
                'title' => esc_html__('Your CSS Code', 'easyweb'),
            ),
        )
    );
    /*
        Woocommerce 
*/
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-woo.png',
        'title' => esc_html__('Woocommerce', 'easyweb'),
        'fields' => array(
            array(
                'id' => 'easyweb_webnus_woo_shop_title_enable',
                'type' => 'button_set',
                'title' => esc_html__('Shop title Show/Hide', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_woo_shop_title',
                'type' => 'text',
                'title' => esc_html__('Shop page title', 'easyweb'),
                'std'=>'Shop'
            ),
            array(
                'id' => 'easyweb_webnus_woo_product_title_enable',
                'type' => 'button_set',
                'title' => esc_html__('Product page title Show/Hide', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std' => '1'
            ),
            array(
                'id' => 'easyweb_webnus_woo_product_title',
                'type' => 'text',
                'title' => esc_html__('Product page title', 'easyweb'),
                'std'=>'Product'
            ),
            array(
                'id' => 'easyweb_webnus_woo_sidebar_enable',
                'type' => 'button_set',
                'title' => esc_html__('Show/Hide Sidebar', 'easyweb'),
                'options' => array('0' => esc_html__('Hide', 'easyweb'), '1' => esc_html__('Show', 'easyweb')),
                'std'=>'1'
            ),
        )
    );
    $tabs = array();
    if (function_exists('wp_get_theme')) {
        $theme_data = wp_get_theme();
        $theme_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    } else {
        $theme_data = wp_get_theme(get_template_directory());
        $theme_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
    }
    $theme_info = '<div class="nhp-opts-section-desc">';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-uri">' . wp_kses( __('<strong>Theme URL:</strong> ', 'easyweb'), array( 'strong' => array() ) ) . '<a href="' . $theme_uri . '" target="_blank">' . $theme_uri . '</a></p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-author">' . wp_kses( __('<strong>Author:</strong> ', 'easyweb'), array( 'strong' => array() ) ) . $author . '</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-version">' . wp_kses( __('<strong>Version:</strong> ', 'easyweb'), array( 'strong' => array() ) ) . $version . '</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-description">' . $description . '</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-tags">' . wp_kses( __('<strong>Tags:</strong> ', 'easyweb'), array( 'strong' => array() ) ) . implode(', ', $tags) . '</p>';
    $theme_info .= '</div>';
    $tabs['theme_info'] = array(
        'icon' => NHP_OPTIONS_URL . 'img/admin-info.png',
        'title' => esc_html__('Theme Information', 'easyweb'),
        'content' => $theme_info
    );
    global $NHP_Options;
    $NHP_Options = new NHP_Options($sections, $args, $tabs);
}
add_action('init', 'easyweb_webnus_setup_framework_options', 0);
/*
 *
 * Custom function for the callback referenced above
 *
 */
function easyweb_webnus_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}
/*
 *
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value = 'just testing';
    $return['value'] = $value;
    if ($error == true) {
        $return['error'] = $field;
    }
    return $return;
}
?>