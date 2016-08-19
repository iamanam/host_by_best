<?php

function easyweb_webnus_countdown( $attributes, $content = null ) {
 	
	extract(shortcode_atts(array(
	"type"      => 'modern',
	'datetime' => '',
	'done' => '',
	
	
		), $attributes));


	$data_until = esc_attr( strtotime( $datetime ) );
	$data_done = esc_attr( $done );
	if($type=="minimal"){
		$label = array(
			'day' => esc_html__('DAYS', 'easyweb_webnus_framework'), 
			'hours' => esc_html__('HRS', 'easyweb_webnus_framework'), 
			'minutes' => esc_html__('MIN', 'easyweb_webnus_framework'), 
			'seconds' => esc_html__('SEC', 'easyweb_webnus_framework')
		);
	} else{
		$label = array(
			'day' => esc_html__('Days', 'easyweb_webnus_framework'), 
			'hours' => esc_html__('Hours', 'easyweb_webnus_framework'), 
			'minutes' => esc_html__('Minutes', 'easyweb_webnus_framework'), 
			'seconds' => esc_html__('Seconds', 'easyweb_webnus_framework')
		);
	}
	
 	$out  = '<div class="countdown-w ctd-' . $type . '" data-until="'. $data_until .'" data-done="'. $data_done .'" data-respond>';
	$out .= '<div class="days-w block-w"><i class="icon-w li_calendar"></i><div class="count-w"></div><div class="label-w">'. $label['day'] .'</div></div>';
	$out .= '<div class="hours-w block-w"><i class="icon-w fa-clock-o"></i><div class="count-w"></div><div class="label-w">'. $label['hours'] .'</div></div>';
	$out .= '<div class="minutes-w block-w"><i class="icon-w li_clock"></i><div class="count-w"></div><div class="label-w">'. $label['minutes'] .'</div></div>';
	$out .= '<div class="seconds-w block-w"><i class="icon-w li_heart"></i><div class="count-w"></div><div class="label-w">'. $label['seconds'] .'</div></div>';
	$out .= '</div>';
	
	return $out;

}

add_shortcode('countdown', 'easyweb_webnus_countdown');		
?>