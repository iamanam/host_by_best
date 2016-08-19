<?php

vc_map( array(
        'name' =>'Webnus Countdown',
        'base' => 'countdown',
        "icon" => "icon-wpb-countdown",
		"description" => "Countdown",
        'category' => esc_html__( 'Webnus Shortcodes', 'easyweb' ),
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Type', 'easyweb' ),
							'param_name' => 'type',
							'value' => array(
								"Modern"=>"modern",
								"Simple"=>"simple",



							),
							'description' => esc_html__( 'Select Countdown Type', 'easyweb')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Date and Time', 'easyweb' ),
							'param_name' => 'datetime',
							'value' => '',
							'description' => esc_html__( 'Enter date and time (11October 2015 9:00)', 'easyweb')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Finished text', 'easyweb' ),
							'param_name' => 'done',
							'value' => '',
							'description' => esc_html__( 'Finished text', 'easyweb')
						),
						
        ),
        
    ) );

?>