<?php
function easyweb_webnus_customize_register( $wp_customize ) {

	class Easyweb_Webnus_Customize_Description_Control extends WP_Customize_Control {
		public $type = 'description';

		public function render_content() { ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->label ); ?></span>
			<?php
		}
	}

// Logo Settings
	$wp_customize->add_section( 'logo_settings', array(
		'title'		=> esc_html__( 'Logo', 'easyweb' ),
		'priority'	=> 21,
		'description'=> esc_html__('To access more options please go to Appearance > Theme Options > Header Options', 'easyweb' ),
	) );

	// Logo
	$wp_customize->add_setting( 'logo_image', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_logo', array(
		'label'		=> esc_html__( 'Upload Logo Image', 'easyweb' ),
		'settings'	=> 'logo_image',
		'section'	=> 'logo_settings',
	) ) );

	// Transparent Logo
	$wp_customize->add_setting( 'transparent_logo_image', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_transparent_logo', array(
		'label'		=> esc_html__( 'Upload Transparent Logo Image and Header Type 11', 'easyweb' ),
		'settings'	=> 'transparent_logo_image',
		'section'	=> 'logo_settings',
	) ) );

	// Sticky Logo
	$wp_customize->add_setting( 'sticky_logo_image', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_sticky_logo', array(
		'label'		=> esc_html__( 'Upload Sticky Logo Image', 'easyweb' ),
		'settings'	=> 'sticky_logo_image',
		'section'	=> 'logo_settings',
	) ) );

	// Logo width
	$wp_customize->add_setting( 'logo_width', array(
		'default'	=> '',
		'sanitize_callback' => 'easyweb_webnus_sanitize_number',
	) );

	$wp_customize->add_control( 'logo_width', array(
		'label'		=> esc_html__( 'Logo width', 'easyweb' ),
		'type'		=> 'number',
		'section'	=> 'logo_settings',
	) );

	// Transparent header logo width
	$wp_customize->add_setting( 'transparent_logo_width', array(
		'default'	=> '',
		'sanitize_callback' => 'easyweb_webnus_sanitize_number',
	) );

	$wp_customize->add_control( 'transparent_logo_width', array(
		'label'		=> esc_html__( 'Transparent header logo width', 'easyweb' ),
		'type'		=> 'number',
		'section'	=> 'logo_settings',
	) );

	// Sticky header logo width
	$wp_customize->add_setting( 'sticky_logo_width', array(
		'default'	=> '60',
		'sanitize_callback' => 'easyweb_webnus_sanitize_number',
	) );

	$wp_customize->add_control( 'sticky_logo_width', array(
		'label'		=> esc_html__( 'Sticky header logo width', 'easyweb' ),
		'type'		=> 'number',
		'section'	=> 'logo_settings',
	) );

	$wp_customize->add_setting( 'logo_description', array(
		'sanitize_callback' => 'easyweb_webnus_sanitize',
	) );
	$wp_customize->add_control( new Easyweb_Webnus_Customize_Description_Control( $wp_customize, 'logo_description', array(
		'label'		=> wp_kses( __( '<span style="color: red; font-weight: bold;">Note: </span>if elements which are available both in customizar and theme options get a change in customizer they\'ll be deactivated in theme options and priority is with customizer.', 'easyweb' ), array( 'span' => array( 'style' => array() ) ) ),
		'settings'	=> 'logo_description',
		'section'	=> 'logo_settings',
	) ) );

// Colorskin
	$wp_customize->add_section( 'colorskin', array(
		'title'		=> esc_html__( 'Colorskin', 'easyweb' ),
		'priority'	=> 22,
		'description'=> esc_html__('To access more options please go to Appearance > Theme Options > Styling Options', 'easyweb' ),
	) );

	// Predefined Colorskin
	$wp_customize->add_setting( 'predefined_colorskin', array(
		'default' => false,
		'sanitize_callback' => 'easyweb_webnus_sanitize',
		'priority'	=> 3,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'predefined_colorskin', array(
		'label'		=> esc_html__( 'Predefined Colorskin', 'easyweb' ),
		'type'           => 'radio',
		'choices'        => array(
			false   => esc_html__( 'None', 'easyweb' ),
			'1'		=> esc_html__( 'Teal', 'easyweb' ),
			'2'		=> esc_html__( 'Blue', 'easyweb' ),
			'3'		=> esc_html__( 'Red', 'easyweb' ),
			'4'		=> esc_html__( 'Yellow', 'easyweb' ),
			'5'		=> esc_html__( 'Pink', 'easyweb' ),
			'6'		=> esc_html__( 'Green', 'easyweb' ),
			'7'		=> esc_html__( 'Orchid', 'easyweb' ),
			'8'		=> esc_html__( 'Jade', 'easyweb' ),
			'9'		=> esc_html__( 'SkyBlue', 'easyweb' ),
			'10'	=> esc_html__( 'Orange', 'easyweb' ),
			'11'	=> esc_html__( 'Light Brown', 'easyweb' ),
			'12'	=> esc_html__( 'DarkBlue', 'easyweb' ),
			'13'	=> esc_html__( 'CoralPink', 'easyweb' ),
			'14'	=> esc_html__( 'Brown', 'easyweb' ),
			'15'	=> esc_html__( 'GreenYellow ', 'easyweb' ),
			'16'	=> esc_html__( 'SplashBlue ', 'easyweb' ),
			'17'	=> esc_html__( 'Light Green ', 'easyweb' ),
			'18'	=> esc_html__( 'Cyan ', 'easyweb' ),
			'19'	=> esc_html__( 'Vine ', 'easyweb' ),
			'20'	=> esc_html__( 'SplashRed ', 'easyweb' ),
		),
		'settings'	=> 'predefined_colorskin',
		'section'	=> 'colorskin',
	) ) );

	$wp_customize->add_setting( 'colorskin_description', array(
		'sanitize_callback' => 'easyweb_webnus_sanitize',
	) );
	$wp_customize->add_control( new Easyweb_Webnus_Customize_Description_Control( $wp_customize, 'colorskin_description', array(
		'label'		=> wp_kses( __( '<span style="color: red; font-weight: bold;">Note: </span>if elements which are available both in customizar and theme options get a change in customizer they\'ll be deactivated in theme options and priority is with customizer.', 'easyweb' ), array( 'span' => array( 'style' => array() ) ) ),
		'settings'	=> 'colorskin_description',
		'section'	=> 'colorskin',
	) ) );
}
add_action( 'customize_register', 'easyweb_webnus_customize_register' );

// Sanitize number options
if ( ! function_exists( 'easyweb_webnus_sanitize_number' ) ) :
function easyweb_webnus_sanitize_number( $value ) {
	return ( is_numeric( $value ) ) ? $value : intval( $value );
}
endif;

// Sanitize checkbox options
if ( ! function_exists( 'easyweb_webnus_sanitize_checkbox' ) ) :
function easyweb_webnus_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && ( true == $checked || 'on' == $checked ) ) ? true : false );
}
endif;

// Sanitize description options
if ( ! function_exists( 'easyweb_webnus_sanitize' ) ) :
function easyweb_webnus_sanitize( $value ) {
	return ( ( isset( $value ) ) ? $value : '' );
}
endif;