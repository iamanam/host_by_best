<?php
vc_map( array(
    'name' =>'Webnus GoogleMap',
    'base' => 'gmap',
	'description' => 'Google map',
    'icon' => 'webnus_map',
	'category' => esc_html__( 'Webnus Shortcodes', 'easyweb' ),
    'params'=>array(
			array(
				'heading' => esc_html__('Address (optional)', 'easyweb') ,
				'description' => wp_kses( __('Please enter your desired address to be show on the map unless you\'ve used the Latitude and Longitude options.<br/><br/>', 'easyweb'), array( 'br' => array() ) ),
				'param_name' => 'address',
				'type' => 'textfield',
			) ,
			array(
				'heading' => esc_html__('Latitude', 'easyweb') ,
				'description' => wp_kses( __('This option is not necessary if an address is set.<br/><br/>', 'easyweb'), array( 'br' => array() ) ),
				'param_name' => 'latitude',
				'type' => 'textfield',
			) ,
			array(
				'heading' => esc_html__('Longitude', 'easyweb') ,
				'description' => wp_kses( __('This option is not necessary if an address is set.<br/><br/>', 'easyweb'), array( 'br' => array() ) ),
				'param_name' => 'longitude',
				'type' => 'textfield',
			) ,
			array(
				'heading' => esc_html__('Zoom', 'easyweb') ,
				'description' => wp_kses( __('Default map zoom level. (1-19)<br/><br/>', 'easyweb'), array( 'br' => array() ) ),
				'param_name' => 'zoom',
				'std' => '17',
				'type' => 'textfield'
			) ,
			array(
				'heading' => esc_html__('Marker', 'easyweb') ,
				'description' => wp_kses( __('Enable an arrow pointing at the address.<br/><br/>', 'easyweb'), array( 'br' => array() ) ),
				'param_name' => 'marker',
				'value' => array( esc_html__( 'Enable', 'easyweb' ) => 'enable'),
				'type' => 'checkbox',
				'std' => 'enable',
			) ,
			array(
				'heading' => esc_html__('Popup Marker Content', 'easyweb') ,
				'description' => wp_kses( __('Content to be shown in a popup above the marker.<br/><br/>', 'easyweb'), array( 'br' => array() ) ),
				'param_name' => 'html',
				'type' => 'textarea',
			) ,
			array(
				'heading' => esc_html__('Popup Marker Display', 'easyweb') ,
				'description' => wp_kses( __('Enable to open the popup above the marker by default.<br/><br/>', 'easyweb'), array( 'br' => array() ) ),
				'param_name' => 'popup',
				'value' => array( esc_html__( 'Enable', 'easyweb' ) => 'enable' ),
				'type' => 'checkbox'
			) ,
			array(
				'heading' => esc_html__('Controls (optional)', 'easyweb') ,
				'description' => sprintf(wp_kses( __('This option is proper for advanced users only. Please refer to the <a href="%s" title="Google Maps API documentation">API documentation</a> for details.<br/><br/>', 'easyweb'), array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array() ) ), 'https://developers.google.com/maps/documentation/javascript/controls'),
				'param_name' => 'controls',
				'type' => 'textarea',
			) ,
			array(
				'heading' => esc_html__('Scrollwheel', 'easyweb') ,
				'param_name' => 'scrollwheel',
				'description' => '<br/>',
				'value' => array( esc_html__( 'Enable', 'easyweb' ) => 'enable' ),
				'type' => 'checkbox'
			) ,
			array(
				'heading' => esc_html__('MapType', 'easyweb') ,
				'param_name' => 'maptype',
				'description' => '<br/>',
				'std' => 'ROADMAP',
				"value" => array(
				"Default road map"=>'ROADMAP',
				"Google Earth satellite"=>'SATELLITE',
				"Mixture of normal and satellite"=>'HYBRID',
				"Physical map"=>'TERRAIN',
				),
				'type' => 'dropdown',
			) ,

			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Hue (optional)', 'easyweb'),
				"param_name"=> "hue",
				"description" => wp_kses( __('Defines the overall hue for the map.<br/><br/>', 'easyweb'), array( 'br' => array() ) )
			),
			array(
				'heading' => esc_html__('Width (optional)', 'easyweb') ,
				'description' => wp_kses( __('Set to 0 is the full width. (0-960)<br/><br/>', 'easyweb'), array( 'br' => array() ) ) ,
				'param_name' => 'width',
				'std' => '0',
				'type' => 'textfield'
			) ,	
			
			array(
				'heading' => esc_html__('Height', 'easyweb') ,
				'description' => wp_kses( __('Default is 400.<br/><br/>', 'easyweb'), array( 'br' => array() ) ) ,
				'param_name' => 'height',
				'std' => '400',
				'type' => 'textfield'
				
			) ,
		),
        
    ) );
?>