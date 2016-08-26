<?php

/******************************************/
/**		  WOPTION HELPER CLASS           **/
/**   Get Options From Theme Option		 **/
/**							             **/
/******************************************/

if (!class_exists('easyweb_webnus_options')) {
	class easyweb_webnus_options {

		static public function easyweb_webnus_maintenance_mode() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_maintenance_mode']) ? $thm_options['easyweb_webnus_maintenance_mode'] : 0;
		}

		static public function easyweb_webnus_maintenance_page() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_maintenance_page']) ? $thm_options['easyweb_webnus_maintenance_page'] : null;
		}
		
		static public function easyweb_webnus_enable_responsive() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_enable_responsive']) ? $thm_options['easyweb_webnus_enable_responsive'] : 1;
		}

		static public function easyweb_webnus_css_minifier() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_css_minifier']) ? $thm_options['easyweb_webnus_css_minifier'] : 1;
		}
		
		//Get Admin Login Page Logo
		static public function easyweb_webnus_admin_login_logo() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_admin_login_logo']) ? $thm_options['easyweb_webnus_admin_login_logo'] : null;
		}
		
		static public function easyweb_webnus_container_width() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_container_width']) ? $thm_options['easyweb_webnus_container_width'] : null;
		}	
		
		static public function easyweb_webnus_enable_breadcrumbs() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_enable_breadcrumbs']) ? $thm_options['easyweb_webnus_enable_breadcrumbs'] : null;
		}
		
		static public function easyweb_webnus_enable_livesearch() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_enable_livesearch']) ? $thm_options['easyweb_webnus_enable_livesearch'] : 1;
		}

		static public function easyweb_webnus_enable_smoothscroll() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_enable_smoothscroll']) ? $thm_options['easyweb_webnus_enable_smoothscroll'] : 1;
		}

		//Get Faveicon
		static public function easyweb_webnus_fav_icon() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_favicon']) ? $thm_options['easyweb_webnus_favicon'] : null;
		}

		static public function easyweb_webnus_apple_iphone_icon() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_apple_iphone_icon']) ? $thm_options['easyweb_webnus_apple_iphone_icon'] : null;
		}

		static public function easyweb_webnus_apple_ipad_icon() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_apple_ipad_icon']) ? $thm_options['easyweb_webnus_apple_ipad_icon'] : null;
		}

		/* LOGO */
		static public function easyweb_webnus_logo() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_logo']) ? $thm_options['easyweb_webnus_logo'] : null;
		}

		static public function easyweb_webnus_logo_width() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_logo_width']) ? $thm_options['easyweb_webnus_logo_width'] : null;
		}

		static public function easyweb_webnus_transparent_logo() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_transparent_logo']) ? $thm_options['easyweb_webnus_transparent_logo'] : null;
		}
		
		static public function easyweb_webnus_transparent_logo_width() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_transparent_logo_width']) ? $thm_options['easyweb_webnus_transparent_logo_width'] : null;
		}
		
		static public function easyweb_webnus_sticky_logo() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sticky_logo']) ? $thm_options['easyweb_webnus_sticky_logo'] : null;
		}
		
		static public function easyweb_webnus_sticky_logo_width() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sticky_logo_width']) ? $thm_options['easyweb_webnus_sticky_logo_width'] : null;
		}		
		/* END LOGO */
		

		static public function easyweb_webnus_header_padding_top() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_padding_top']) ? $thm_options['easyweb_webnus_header_padding_top'] : null;
		}

		static public function easyweb_webnus_header_padding_bottom() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_padding_bottom']) ? $thm_options['easyweb_webnus_header_padding_bottom'] : null;
		}		
		
		static public function easyweb_webnus_header_color_type() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_color_type']) ? $thm_options['easyweb_webnus_header_color_type'] : null;
		}
		
		static public function easyweb_webnus_logo_width_dark() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_logo_width_dark']) ? $thm_options['easyweb_webnus_logo_width_dark'] : null;
		}
		
		static public function easyweb_webnus_logo_dark() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_logo_dark']) ? $thm_options['easyweb_webnus_logo_dark'] : null;
		}
		static public function easyweb_webnus_slogan() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_slogan']) ? $thm_options['easyweb_webnus_slogan'] : null;
		}

		static public function easyweb_webnus_toggle_toparea_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_toggle_toparea_enable']) ? $thm_options['easyweb_webnus_toggle_toparea_enable'] : 0;
		}
		static public function easyweb_webnus_booking_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_booking_enable']) ? $thm_options['easyweb_webnus_booking_enable'] : null;
		}
		static public function easyweb_webnus_booking_form() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_booking_form']) ? $thm_options['easyweb_webnus_booking_form'] : null;
		}
		static public function easyweb_webnus_singlesermon_sidebar() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_singlesermon_sidebar']) ? $thm_options['easyweb_webnus_singlesermon_sidebar'] : null;
		}
		static public function easyweb_webnus_sermon_speaker() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_speaker']) ? $thm_options['easyweb_webnus_sermon_speaker'] : null;
		}		
		static public function easyweb_webnus_sermon_date() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_date']) ? $thm_options['easyweb_webnus_sermon_date'] : null;
		}		
		static public function easyweb_webnus_sermon_category() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_category']) ? $thm_options['easyweb_webnus_sermon_category'] : null;
		}		
		static public function easyweb_webnus_sermon_comments() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_comments']) ? $thm_options['easyweb_webnus_sermon_comments'] : null;
		}		
		static public function easyweb_webnus_sermon_views() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_views']) ? $thm_options['easyweb_webnus_sermon_views'] : null;
		}		
		static public function easyweb_webnus_sermon_featuredimage() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_featuredimage']) ? $thm_options['easyweb_webnus_sermon_featuredimage'] : null;
		}		
		static public function easyweb_webnus_sermon_social_share() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_social_share']) ? $thm_options['easyweb_webnus_sermon_social_share'] : null;
		}
		static public function easyweb_webnus_sermon_speakerbox() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_sermon_speakerbox']) ? $thm_options['easyweb_webnus_sermon_speakerbox'] : null;
		}			
		static public function easyweb_webnus_recent_sermons() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_recent_sermons']) ? $thm_options['easyweb_webnus_recent_sermons'] : null;
		}	
		static public function easyweb_webnus_singlecause_sidebar() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_singlecause_sidebar']) ? $thm_options['easyweb_webnus_singlecause_sidebar'] : null;
		}
		static public function easyweb_webnus_donate_form() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_donate_form']) ? $thm_options['easyweb_webnus_donate_form'] : null;
		}
		static public function easyweb_webnus_cause_currency() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_cause_currency']) ? $thm_options['easyweb_webnus_cause_currency'] : '$';
		}
		static public function easyweb_webnus_cause_date() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_cause_date']) ? $thm_options['easyweb_webnus_cause_date'] : null;
		}		
		static public function easyweb_webnus_cause_category() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_cause_category']) ? $thm_options['easyweb_webnus_cause_category'] : null;
		}		
		static public function easyweb_webnus_cause_comments() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_cause_comments']) ? $thm_options['easyweb_webnus_cause_comments'] : null;
		}		
		static public function easyweb_webnus_cause_views() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_cause_views']) ? $thm_options['easyweb_webnus_cause_views'] : null;
		}		
		static public function easyweb_webnus_cause_featuredimage() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_cause_featuredimage']) ? $thm_options['easyweb_webnus_cause_featuredimage'] : null;
		}		
		static public function easyweb_webnus_cause_social_share() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_cause_social_share']) ? $thm_options['easyweb_webnus_cause_social_share'] : null;
		}		
		static public function easyweb_webnus_header_topbar_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_topbar_enable']) ? $thm_options['easyweb_webnus_header_topbar_enable'] : null;
		}

		static public function easyweb_webnus_topbar_background_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_background_color']) ? $thm_options['easyweb_webnus_topbar_background_color'] : null;
		}

		static public function easyweb_webnus_topbar_fixed() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_fixed']) ? $thm_options['easyweb_webnus_topbar_fixed'] : null;
		}
		
		static public function easyweb_webnus_topbar_search() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_search']) ? $thm_options['easyweb_webnus_topbar_search'] : null;
		}



		static public function easyweb_webnus_topbar_social() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_social']) ? $thm_options['easyweb_webnus_topbar_social'] : null;
		}
		
		static public function easyweb_webnus_topbar_login() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_login']) ? $thm_options['easyweb_webnus_topbar_login'] : null;
		}
		
		static public function easyweb_webnus_topbar_login_text() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_login_text']) ? $thm_options['easyweb_webnus_topbar_login_text'] : 'LOGIN';
		}
		
		static public function easyweb_webnus_topbar_donate() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_donate']) ? $thm_options['easyweb_webnus_topbar_donate'] : null;
		}
		
		static public function easyweb_webnus_topbar_contact() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_contact']) ? $thm_options['easyweb_webnus_topbar_contact'] : null;
		}

		static public function easyweb_webnus_topbar_form() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_form']) ? $thm_options['easyweb_webnus_topbar_form'] : null;
		}
		
		static public function easyweb_webnus_topbar_info() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_info']) ? $thm_options['easyweb_webnus_topbar_info'] : null;
		}
		
		static public function easyweb_webnus_topbar_menu() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_menu']) ? $thm_options['easyweb_webnus_topbar_menu'] : null;
		}

		static public function easyweb_webnus_topbar_custom_button() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_custom_button']) ? $thm_options['easyweb_webnus_topbar_custom_button'] : null;
		}

		static public function easyweb_webnus_topbar_button_text() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_button_text']) ? $thm_options['easyweb_webnus_topbar_button_text'] : null;
		}

		static public function easyweb_webnus_topbar_button_link() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_button_link']) ? $thm_options['easyweb_webnus_topbar_button_link'] : null;
		}
		
		static public function easyweb_webnus_topbar_custom() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_custom']) ? $thm_options['easyweb_webnus_topbar_custom'] : null;
		}
		
		static public function easyweb_webnus_topbar_text() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_text']) ? $thm_options['easyweb_webnus_topbar_text'] : null;
		}
		
		static public function easyweb_webnus_topbar_language() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_language']) ? $thm_options['easyweb_webnus_topbar_language'] : null;
		}
		
		static public function easyweb_webnus_header_topbar_leftcontent() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_topbar_leftcontent']) ? $thm_options['easyweb_webnus_header_topbar_leftcontent'] : null;
		}

		static public function easyweb_webnus_header_topbar_rightcontent() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_topbar_rightcontent']) ? $thm_options['easyweb_webnus_header_topbar_rightcontent'] : null;
		}

		static public function easyweb_webnus_header_email() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_email']) ? $thm_options['easyweb_webnus_header_email'] : null;
		}
		
		static public function easyweb_webnus_header_address() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_address']) ? $thm_options['easyweb_webnus_header_address'] : null;
		}

		static public function easyweb_webnus_header_phone() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_phone']) ? $thm_options['easyweb_webnus_header_phone'] : null;
		}

		static public function easyweb_webnus_topbar_email() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_email']) ? $thm_options['easyweb_webnus_topbar_email'] : null;
		}
		
		static public function easyweb_webnus_topbar_phone() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_phone']) ? $thm_options['easyweb_webnus_topbar_phone'] : null;
		}

		static public function easyweb_webnus_topbar_address() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topbar_address']) ? $thm_options['easyweb_webnus_topbar_address'] : null;
		}

		static public function easyweb_webnus_top_social_icons_facebook() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_facebook']) ? $thm_options['easyweb_webnus_top_social_icons_facebook'] : null;
		}

		static public function easyweb_webnus_top_social_icons_twitter() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_twitter']) ? $thm_options['easyweb_webnus_top_social_icons_twitter'] : null;
		}

		static public function easyweb_webnus_top_social_icons_dribbble() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_dribbble']) ? $thm_options['easyweb_webnus_top_social_icons_dribbble'] : null;
		}

		static public function easyweb_webnus_top_social_icons_pinterest() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_pinterest']) ? $thm_options['easyweb_webnus_top_social_icons_pinterest'] : null;
		}

		static public function easyweb_webnus_top_social_icons_vimeo() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_vimeo']) ? $thm_options['easyweb_webnus_top_social_icons_vimeo'] : null;
		}

		static public function easyweb_webnus_top_social_icons_youtube() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_youtube']) ? $thm_options['easyweb_webnus_top_social_icons_youtube'] : null;
		}

		static public function easyweb_webnus_top_social_icons_google() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_google']) ? $thm_options['easyweb_webnus_top_social_icons_google'] : null;
		}

		static public function easyweb_webnus_top_social_icons_linkedin() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_linkedin']) ? $thm_options['easyweb_webnus_top_social_icons_linkedin'] : null;
		}

		static public function easyweb_webnus_top_social_icons_rss() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_rss']) ? $thm_options['easyweb_webnus_top_social_icons_rss'] : null;
		}

		static public function easyweb_webnus_top_social_icons_instagram() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_instagram']) ? $thm_options['easyweb_webnus_top_social_icons_instagram'] : null;
		}

		static public function easyweb_webnus_top_social_icons_flickr() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_flickr']) ? $thm_options['easyweb_webnus_top_social_icons_flickr'] : null;
		}

		static public function easyweb_webnus_top_social_icons_reddit() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_reddit']) ? $thm_options['easyweb_webnus_top_social_icons_reddit'] : null;
		}

		static public function easyweb_webnus_top_social_icons_delicious() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_delicious']) ? $thm_options['easyweb_webnus_top_social_icons_delicious'] : null;
		}

		static public function easyweb_webnus_top_social_icons_lastfm() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_lastfm']) ? $thm_options['easyweb_webnus_top_social_icons_lastfm'] : null;
		}

		static public function easyweb_webnus_top_social_icons_tumblr() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_tumblr']) ? $thm_options['easyweb_webnus_top_social_icons_tumblr'] : null;
		}

		static public function easyweb_webnus_top_social_icons_skype() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_social_icons_skype']) ? $thm_options['easyweb_webnus_top_social_icons_skype'] : null;
		}

		static public function easyweb_webnus_top_left_tagline() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_left_tagline']) ? $thm_options['easyweb_webnus_top_left_tagline'] : null;
		}

		static public function easyweb_webnus_top_right_tagline() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_top_right_tagline']) ? $thm_options['easyweb_webnus_top_right_tagline'] : null;
		}

		static public function easyweb_webnus_header_menu_type() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_menu_type']) ? $thm_options['easyweb_webnus_header_menu_type'] : 10;
		}
		
		static public function easyweb_webnus_dark_submenu() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_dark_submenu']) ? $thm_options['easyweb_webnus_dark_submenu'] : 1;
		}
				
		static public function easyweb_webnus_header_background() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_background']) ? $thm_options['easyweb_webnus_header_background'] : 1;
		}
		
		static public function easyweb_webnus_header_logo_alignment() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_logo_alignment']) ? $thm_options['easyweb_webnus_header_logo_alignment'] : 1;
		}

		static public function easyweb_webnus_header_sticky() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_sticky']) ? $thm_options['easyweb_webnus_header_sticky'] : null;
		}
		
		static public function easyweb_webnus_header_sticky_scrolls() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_sticky_scrolls']) ? $thm_options['easyweb_webnus_header_sticky_scrolls'] : null;
		}
				
		static public function easyweb_webnus_header_search_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_search_enable']) ? $thm_options['easyweb_webnus_header_search_enable'] : null;
		}

		static public function easyweb_webnus_header_woocart_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_woocart_enable']) ? $thm_options['easyweb_webnus_header_woocart_enable'] : null;
		}

		static public function easyweb_webnus_header_logo_rightside() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_logo_rightside']) ? $thm_options['easyweb_webnus_header_logo_rightside'] : null;
		}

		static public function easyweb_webnus_space_before_head() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_space_before_head']) ? $thm_options['easyweb_webnus_space_before_head'] : null;
		}

		static public function easyweb_webnus_space_before_body() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_space_before_body']) ? $thm_options['easyweb_webnus_space_before_body'] : null;
		}

		static public function easyweb_webnus_header_menu_icon() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_header_menu_icon']) ? $thm_options['easyweb_webnus_header_menu_icon'] : null;
		}

		static public function easyweb_webnus_news_ticker() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_news_ticker']) ? $thm_options['easyweb_webnus_news_ticker'] : '1';
		}

		static public function easyweb_webnus_nt_show() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_nt_show']) ? $thm_options['easyweb_webnus_nt_show'] : '0';
		}
		
		static public function easyweb_webnus_nt_title() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_nt_title']) ? $thm_options['easyweb_webnus_nt_title'] : 'Latest Posts';
		}	
		
		static public function easyweb_webnus_nt_cat() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_nt_cat']) ? $thm_options['easyweb_webnus_nt_cat'] : '';
		}	
		
		static public function easyweb_webnus_nt_count() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_nt_count']) ? $thm_options['easyweb_webnus_nt_count'] : '5';
		}	
		
		static public function easyweb_webnus_nt_effect() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_nt_effect']) ? $thm_options['easyweb_webnus_nt_effect'] : 'reveal';
		}	
		
		static public function easyweb_webnus_nt_speed() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_nt_speed']) ? $thm_options['easyweb_webnus_nt_speed'] : '1';
		}
		
		static public function easyweb_webnus_nt_pause() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_nt_pause']) ? $thm_options['easyweb_webnus_nt_pause'] : '2';
		}

		static public function easyweb_webnus_footer_logo() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_logo']) ? $thm_options['easyweb_webnus_footer_logo'] : null;
		}

		/***********************************/
		/***		Page Layouts
		/***********************************/

		static public function easyweb_webnus_get_layout() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_background_layout']) ? $thm_options['easyweb_webnus_background_layout'] : 'wrap';
		}

		static public function easyweb_webnus_background_image_style() {

			$thm_options = get_option('easyweb_webnus_options');
			$repeat = $thm_options['easyweb_webnus_background_repeat'];
			$color = $thm_options['easyweb_webnus_background_color'];
			$percent = isset($thm_options['easyweb_webnus_background_100']) ? $thm_options['easyweb_webnus_background_100'] : null;
			$out = "";
			$out .= '<style type="text/css" media="screen">';
			$out .= 'body{ ';
			if (!empty($color)) {
				$out .= "background-color:{$thm_options['easyweb_webnus_background_color'] };";
			}
			if (!empty($thm_options['easyweb_webnus_background'])) {
				if ($repeat == 1)
					$out .= " background-image:url('{$thm_options['easyweb_webnus_background']}'); background-repeat:repeat;";
				else if ($repeat == 2)
					$out .= " background-image:url('{$thm_options['easyweb_webnus_background']}'); background-repeat:repeat-x;";
				else if ($repeat == 3)
					$out .= " background-image:url('{$thm_options['easyweb_webnus_background']}'); background-repeat:repeat-y;";
				else if ($repeat == 0) {
					if ($percent)
						$out .= " background-image:url('{$thm_options['easyweb_webnus_background']}'); background-repeat:no-repeat; background-size:100% auto; ";
					else
						$out .= " background-image:url('{$thm_options['easyweb_webnus_background']}'); background-repeat:no-repeat; ";
				}
			} else {
				if (isset($thm_options['easyweb_webnus_background_pattern']) && $thm_options['easyweb_webnus_background_pattern'] == 'none') {
					$out .= " background-image:url('');";
				}
				if (!empty($thm_options['easyweb_webnus_background_pattern']) && ($thm_options['easyweb_webnus_background_pattern'] != 'none')) {
					$out .= " background-image:url('{$thm_options['easyweb_webnus_background_pattern']}'); background-repeat:repeat; ";
				}
			}

			if (!empty($percent))
				$out .= 'background-size:cover;-webkit-background-size: cover;
										  -moz-background-size: cover;
										  -o-background-size: cover; background-attachment:fixed;
										  background-position:center; ';
			$out .= ' } </style>';
			return $out;
		}

		static public function easyweb_webnus_color_skin() {
			//this is for custom color skin
			if (easyweb_webnus_options::easyweb_webnus_custom_color_skin_enable())
				return 'custom';
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_color_skin']) ? $thm_options['easyweb_webnus_color_skin'] : null;
		}

		static public function easyweb_webnus_custom_color_skin_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_color_skin_enable']) ? $thm_options['easyweb_webnus_custom_color_skin_enable'] : null;
		}

		static public function easyweb_webnus_custom_css() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_css']) ? $thm_options['easyweb_webnus_custom_css'] : null;
		}


		/***********************************/
		/***		SOCIAL NETWORK
		/***********************************/

		static public function easyweb_webnus_social_first() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_first']) ? $thm_options['easyweb_webnus_social_first'] : null;
		}

		static public function easyweb_webnus_social_first_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_first_url']) ? $thm_options['easyweb_webnus_social_first_url'] : null;
		}

		static public function easyweb_webnus_social_second() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_second']) ? $thm_options['easyweb_webnus_social_second'] : null;
		}		
		
		static public function easyweb_webnus_social_second_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_second_url']) ? $thm_options['easyweb_webnus_social_second_url'] : null;
		}	
		
		static public function easyweb_webnus_social_third() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_third']) ? $thm_options['easyweb_webnus_social_third'] : null;
		}
		
		static public function easyweb_webnus_social_third_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_third_url']) ? $thm_options['easyweb_webnus_social_third_url'] : null;
		}

		static public function easyweb_webnus_social_fourth() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_fourth']) ? $thm_options['easyweb_webnus_social_fourth'] : null;
		}
		
		static public function easyweb_webnus_social_fourth_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_fourth_url']) ? $thm_options['easyweb_webnus_social_fourth_url'] : null;
		}
		
		static public function easyweb_webnus_social_fifth() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_fifth']) ? $thm_options['easyweb_webnus_social_fifth'] : null;
		}
		
		static public function easyweb_webnus_social_fifth_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_fifth_url']) ? $thm_options['easyweb_webnus_social_fifth_url'] : null;
		}

		static public function easyweb_webnus_social_sixth() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_sixth']) ? $thm_options['easyweb_webnus_social_sixth'] : null;
		}
		
		static public function easyweb_webnus_social_sixth_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_sixth_url']) ? $thm_options['easyweb_webnus_social_sixth_url'] : null;
		}

		static public function easyweb_webnus_social_seventh() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_seventh']) ? $thm_options['easyweb_webnus_social_seventh'] : null;
		}
		
		static public function easyweb_webnus_social_seventh_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_social_seventh_url']) ? $thm_options['easyweb_webnus_social_seventh_url'] : null;
		}

		/***********************************/
		/***		BLOG Options
		/***********************************/

		static public function easyweb_webnus_blog_template() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_template']) ? $thm_options['easyweb_webnus_blog_template'] : null;
		}

		static public function easyweb_webnus_blog_page_title() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_page_title']) ? $thm_options['easyweb_webnus_blog_page_title'] : null;
		}
		
		static public function easyweb_webnus_blog_page_title_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_page_title_enable']) ? $thm_options['easyweb_webnus_blog_page_title_enable'] : null;
		}
		
		static public function easyweb_webnus_blog_featuredimage_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_featuredimage_enable']) ? $thm_options['easyweb_webnus_blog_featuredimage_enable'] : null;
		}

		static public function easyweb_webnus_no_image() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_no_image']) ? $thm_options['easyweb_webnus_no_image'] : null;
		}

		static public function easyweb_webnus_no_image_src() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_no_image_src']) ? $thm_options['easyweb_webnus_no_image_src'] : null;
		}
		
		static public function easyweb_webnus_blog_posttitle_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_posttitle_enable']) ? $thm_options['easyweb_webnus_blog_posttitle_enable'] : null;
		}

		static public function easyweb_webnus_blog_meta_date_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_meta_date_enable']) ? $thm_options['easyweb_webnus_blog_meta_date_enable'] : null;
		}

		static public function easyweb_webnus_blog_meta_author_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_meta_author_enable']) ? $thm_options['easyweb_webnus_blog_meta_author_enable'] : null;
		}
		
		static public function easyweb_webnus_blog_meta_gravatar_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_meta_gravatar_enable']) ? $thm_options['easyweb_webnus_blog_meta_gravatar_enable'] : null;
		}
		
		static public function easyweb_webnus_blog_meta_category_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_meta_category_enable']) ? $thm_options['easyweb_webnus_blog_meta_category_enable'] : null;
		}
		
		static public function easyweb_webnus_blog_meta_comments_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_meta_comments_enable']) ? $thm_options['easyweb_webnus_blog_meta_comments_enable'] : null;
		}
		
		static public function easyweb_webnus_blog_meta_views_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_meta_views_enable']) ? $thm_options['easyweb_webnus_blog_meta_views_enable'] : null;
		}
		
		static public function easyweb_webnus_blog_single_authorbox_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_single_authorbox_enable']) ? $thm_options['easyweb_webnus_blog_single_authorbox_enable'] : null;
		}
		
		static public function easyweb_webnus_recommended_posts() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_recommended_posts']) ? $thm_options['easyweb_webnus_recommended_posts'] : 1;
		}

		static public function easyweb_webnus_blog_excerptfull_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_excerptfull_enable']) ? $thm_options['easyweb_webnus_blog_excerptfull_enable'] : null;
		}

		static public function easyweb_webnus_blog_excerpt_large() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_excerpt_large']) ? $thm_options['easyweb_webnus_blog_excerpt_large'] : null;
		}
		
		static public function easyweb_webnus_blog_excerpt_list() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_excerpt_list']) ? $thm_options['easyweb_webnus_blog_excerpt_list'] : null;
		}
		static public function easyweb_webnus_blog_readmore_text() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_readmore_text']) ? $thm_options['easyweb_webnus_blog_readmore_text'] : null;
		}

		static public function easyweb_webnus_blog_sinlge_featuredimage_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_sinlge_featuredimage_enable']) ? $thm_options['easyweb_webnus_blog_sinlge_featuredimage_enable'] : null;
		}

		static public function easyweb_webnus_blog_sidebar() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_sidebar']) ? $thm_options['easyweb_webnus_blog_sidebar'] : null;
		}

		static public function easyweb_webnus_blog_singlepost_sidebar() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_singlepost_sidebar']) ? $thm_options['easyweb_webnus_blog_singlepost_sidebar'] : null;
		}

		static public function easyweb_webnus_blog_social_share() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_social_share']) ? $thm_options['easyweb_webnus_blog_social_share'] : 1;
		}

		static public function easyweb_webnus_blog_type() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_type']) ? $thm_options['easyweb_webnus_blog_type'] : null;
		}
		static public function easyweb_webnus_blog_title_font_family() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_title_font_family']) ? $thm_options['easyweb_webnus_blog_title_font_family'] : null;
		}
		
		static public function easyweb_webnus_blog_loop_title_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_loop_title_font_size']) ? $thm_options['easyweb_webnus_blog_loop_title_font_size'] : null;
		}
		
		static public function easyweb_webnus_blog_loop_title_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_loop_title_line_height']) ? $thm_options['easyweb_webnus_blog_loop_title_line_height'] : null;
		}
		
		static public function easyweb_webnus_blog_loop_title_font_weight() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_loop_title_font_weight']) ? $thm_options['easyweb_webnus_blog_loop_title_font_weight'] : null;
		}
		
		static public function easyweb_webnus_blog_loop_title_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_loop_title_letter_spacing']) ? $thm_options['easyweb_webnus_blog_loop_title_letter_spacing'] : null;
		}
		
		static public function easyweb_webnus_blog_loop_title_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_loop_title_color']) ? $thm_options['easyweb_webnus_blog_loop_title_color'] : null;
		}
		
		static public function easyweb_webnus_blog_loop_title_hover_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_loop_title_hover_color']) ? $thm_options['easyweb_webnus_blog_loop_title_hover_color'] : null;
		}
		
		static public function easyweb_webnus_blog_single_post_title_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_single_post_title_font_size']) ? $thm_options['easyweb_webnus_blog_single_post_title_font_size'] : null;
		}
		
		static public function easyweb_webnus_blog_single_title_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_single_title_line_height']) ? $thm_options['easyweb_webnus_blog_single_title_line_height'] : null;
		}
		
		static public function easyweb_webnus_blog_single_title_font_weight() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_single_title_font_weight']) ? $thm_options['easyweb_webnus_blog_single_title_font_weight'] : null;
		}
		
		static public function easyweb_webnus_blog_single_title_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_single_title_letter_spacing']) ? $thm_options['easyweb_webnus_blog_single_title_letter_spacing'] : null;
		}
		
		static public function easyweb_webnus_blog_single_title_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_blog_single_title_color']) ? $thm_options['easyweb_webnus_blog_single_title_color'] : null;
		}

		

		/***********************************/
		/***		Footer
		/***********************************/

		static public function easyweb_webnus_footer_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_color']) ? $thm_options['easyweb_webnus_footer_color'] : null;
		}

		static public function easyweb_webnus_footer_type() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_type']) ? $thm_options['easyweb_webnus_footer_type'] : null;
		}

		static public function easyweb_webnus_footer_bottom_right() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_bottom_right']) ? $thm_options['easyweb_webnus_footer_bottom_right'] : null;
		}
		
		static public function easyweb_webnus_footer_bottom_left() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_bottom_left']) ? $thm_options['easyweb_webnus_footer_bottom_left'] : null;
		}
		static public function easyweb_webnus_footer_instagram_username() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_instagram_username']) ? $thm_options['easyweb_webnus_footer_instagram_username'] : null;
		}
		static public function easyweb_webnus_footer_instagram_access() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_instagram_access']) ? $thm_options['easyweb_webnus_footer_instagram_access'] : null;
		}
		static public function easyweb_webnus_footer_instagram_bar() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_instagram_bar']) ? $thm_options['easyweb_webnus_footer_instagram_bar'] : null;
		}
		static public function easyweb_webnus_footer_social_bar() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_social_bar']) ? $thm_options['easyweb_webnus_footer_social_bar'] : null;
		}
		static public function easyweb_webnus_footer_feedburner_id() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_feedburner_id']) ? $thm_options['easyweb_webnus_footer_feedburner_id'] : null;
		}
		static public function easyweb_webnus_footer_mailchimp_url() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_mailchimp_url']) ? $thm_options['easyweb_webnus_footer_mailchimp_url'] : null;
		}
		static public function easyweb_webnus_footer_subscribe_type() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_subscribe_type']) ? $thm_options['easyweb_webnus_footer_subscribe_type'] : null;
		}
		static public function easyweb_webnus_footer_subscribe_bar() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_subscribe_bar']) ? $thm_options['easyweb_webnus_footer_subscribe_bar'] : null;
		}
		static public function easyweb_webnus_footer_subscribe_text() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_subscribe_text']) ? $thm_options['easyweb_webnus_footer_subscribe_text'] : null;
		}
		
		static public function easyweb_webnus_footer_bottom_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_bottom_enable']) ? $thm_options['easyweb_webnus_footer_bottom_enable'] : null;
		}

		static public function easyweb_webnus_footer_copyright() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_copyright']) ? $thm_options['easyweb_webnus_footer_copyright'] : null;
		}
		
		static public function easyweb_webnus_footer_background_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_background_color']) ? $thm_options['easyweb_webnus_footer_background_color'] : null;
		}		
		
		static public function easyweb_webnus_footer_bottom_background_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_footer_bottom_background_color']) ? $thm_options['easyweb_webnus_footer_bottom_background_color'] : null;
		}	
		
		/* 404 PAGE	 */
		static public function easyweb_webnus_404_text() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_404_text']) ? $thm_options['easyweb_webnus_404_text'] : null;
		}

		/* Woocommerce */
		static public function easyweb_webnus_woo_shop_title() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_woo_shop_title']) ? $thm_options['easyweb_webnus_woo_shop_title'] : null;
		}

		static public function easyweb_webnus_woo_shop_title_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_woo_shop_title_enable']) ? $thm_options['easyweb_webnus_woo_shop_title_enable'] : null;
		}

		static public function easyweb_webnus_woo_product_title() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_woo_product_title']) ? $thm_options['easyweb_webnus_woo_product_title'] : null;
		}

		static public function easyweb_webnus_woo_product_title_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_woo_product_title_enable']) ? $thm_options['easyweb_webnus_woo_product_title_enable'] : null;
		}

		static public function easyweb_webnus_woo_sidebar_enable() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_woo_sidebar_enable']) ? $thm_options['easyweb_webnus_woo_sidebar_enable'] : 1;
		}

		static public function easyweb_webnus_recaptcha_site_key() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_recaptcha_site_key']) ? $thm_options['easyweb_webnus_recaptcha_site_key'] : null;
		}

		static public function easyweb_webnus_recaptcha_secret_key() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_recaptcha_secret_key']) ? $thm_options['easyweb_webnus_recaptcha_secret_key'] : null;
		}

		static public function easyweb_webnus_typekit_id() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_typekit_id']) ? $thm_options['easyweb_webnus_typekit_id'] : null;
		}
		
		static public function easyweb_webnus_typekit_font1() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_typekit_font1']) ? $thm_options['easyweb_webnus_typekit_font1'] : null;
		}
		
		static public function easyweb_webnus_typekit_font2() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_typekit_font2']) ? $thm_options['easyweb_webnus_typekit_font2'] : null;
		}
		
		static public function easyweb_webnus_typekit_font3() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_typekit_font3']) ? $thm_options['easyweb_webnus_typekit_font3'] : null;
		}
		
		static public function easyweb_webnus_get_google_fonts() {
			$thm_options = get_option('easyweb_webnus_options');
			$fonts_array = array();
			if (isset($thm_options['easyweb_webnus_body_font']) && $thm_options['easyweb_webnus_body_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_body_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_body_font'];
			}
			if (isset($thm_options['easyweb_webnus_menu_font']) && $thm_options['easyweb_webnus_menu_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_menu_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_menu_font'];
			}
			if (isset($thm_options['easyweb_webnus_p_font']) && $thm_options['easyweb_webnus_p_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_p_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_p_font'];
			}
			if (isset($thm_options['easyweb_webnus_heading_font']) && $thm_options['easyweb_webnus_heading_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_heading_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_heading_font'];
			}
			if (isset($thm_options['easyweb_webnus_h2_font']) && $thm_options['easyweb_webnus_h2_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_h2_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_h2_font'];
			}
			if (isset($thm_options['easyweb_webnus_h3_font']) && $thm_options['easyweb_webnus_h3_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_h3_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_h3_font'];
			}
			if (isset($thm_options['easyweb_webnus_h4_font']) && $thm_options['easyweb_webnus_h4_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_h4_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_h4_font'];
			}
			if (isset($thm_options['easyweb_webnus_h5_font']) && $thm_options['easyweb_webnus_h5_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_h5_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_h5_font'];
			}
			if (isset($thm_options['easyweb_webnus_h6_font']) && $thm_options['easyweb_webnus_h6_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_h6_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_h6_font'];
			}
			if (isset($thm_options['easyweb_webnus_blog_title_font_family']) && $thm_options['easyweb_webnus_blog_title_font_family'] != '') {
				if (!in_array($thm_options['easyweb_webnus_blog_title_font_family'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_blog_title_font_family'];
			}
			if (isset($thm_options['easyweb_webnus_blog_single_post_title_font']) && $thm_options['easyweb_webnus_blog_single_post_title_font'] != '') {
				if (!in_array($thm_options['easyweb_webnus_blog_single_post_title_font'], $fonts_array))
					$fonts_array[] = $thm_options['easyweb_webnus_blog_single_post_title_font'];
			}
			$fonts = "";
			if (count($fonts_array) > 0) {
  				$fonts_array = array_diff($fonts_array, array('custom-font-1','custom-font-2','custom-font-3','typekit-font-1','typekit-font-2','typekit-font-3'));					
				$fonts_str = implode('|', $fonts_array);
				if(!empty($fonts_str))
				$fonts = "http://fonts.googleapis.com/css?family=$fonts_str:300,400,600,700";
			}
			return $fonts;
		}

		
		static public function easyweb_webnus_topnav_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topnav_font_size']) ? $thm_options['easyweb_webnus_topnav_font_size'] : null;
		}	
		
		static public function easyweb_webnus_topnav_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topnav_letter_spacing']) ? $thm_options['easyweb_webnus_topnav_letter_spacing'] : null;
		}		
		
		static public function easyweb_webnus_topnav_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_topnav_line_height']) ? $thm_options['easyweb_webnus_topnav_line_height'] : null;
		}		
			
		
		static public function easyweb_webnus_p_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_p_font_size']) ? $thm_options['easyweb_webnus_p_font_size'] : null;
		}	
		
		static public function easyweb_webnus_p_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_p_letter_spacing']) ? $thm_options['easyweb_webnus_p_letter_spacing'] : null;
		}	
		
		static public function easyweb_webnus_p_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_p_line_height']) ? $thm_options['easyweb_webnus_p_line_height'] : null;
		}		
		
		
		static public function easyweb_webnus_p_font_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_p_font_color']) ? $thm_options['easyweb_webnus_p_font_color'] : null;
		}	
		
		static public function easyweb_webnus_h1_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h1_font_size']) ? $thm_options['easyweb_webnus_h1_font_size'] : null;
		}	
		
		static public function easyweb_webnus_h1_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h1_letter_spacing']) ? $thm_options['easyweb_webnus_h1_letter_spacing'] : null;
		}	
		
		static public function easyweb_webnus_h1_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h1_line_height']) ? $thm_options['easyweb_webnus_h1_line_height'] : null;
		}		
		
		
		static public function easyweb_webnus_h1_font_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h1_font_color']) ? $thm_options['easyweb_webnus_h1_font_color'] : null;
		}	
		
		static public function easyweb_webnus_h2_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h2_font_size']) ? $thm_options['easyweb_webnus_h2_font_size'] : null;
		}		
		
		static public function easyweb_webnus_h2_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h2_letter_spacing']) ? $thm_options['easyweb_webnus_h2_letter_spacing'] : null;
		}		
		
		static public function easyweb_webnus_h2_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h2_line_height']) ? $thm_options['easyweb_webnus_h2_line_height'] : null;
		}			
		
		static public function easyweb_webnus_h2_font_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h2_font_color']) ? $thm_options['easyweb_webnus_h2_font_color'] : null;
		}	
		
		static public function easyweb_webnus_h3_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h3_font_size']) ? $thm_options['easyweb_webnus_h3_font_size'] : null;
		}	
		
		static public function easyweb_webnus_h3_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h3_letter_spacing']) ? $thm_options['easyweb_webnus_h3_letter_spacing'] : null;
		}	
		
		static public function easyweb_webnus_h3_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h3_line_height']) ? $thm_options['easyweb_webnus_h3_line_height'] : null;
		}	
		
		static public function easyweb_webnus_h3_font_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h3_font_color']) ? $thm_options['easyweb_webnus_h3_font_color'] : null;
		}	
		
		static public function easyweb_webnus_h4_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h4_font_size']) ? $thm_options['easyweb_webnus_h4_font_size'] : null;
		}	
		
		static public function easyweb_webnus_h4_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h4_letter_spacing']) ? $thm_options['easyweb_webnus_h4_letter_spacing'] : null;
		}		
		
		static public function easyweb_webnus_h4_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h4_line_height']) ? $thm_options['easyweb_webnus_h4_line_height'] : null;
		}		
		
		
		static public function easyweb_webnus_h4_font_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h4_font_color']) ? $thm_options['easyweb_webnus_h4_font_color'] : null;
		}	
		
		static public function easyweb_webnus_h5_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h5_font_size']) ? $thm_options['easyweb_webnus_h5_font_size'] : null;
		}	
		
		static public function easyweb_webnus_h5_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h5_letter_spacing']) ? $thm_options['easyweb_webnus_h5_letter_spacing'] : null;
		}	
		
		static public function easyweb_webnus_h5_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h5_line_height']) ? $thm_options['easyweb_webnus_h5_line_height'] : null;
		}		
		
		static public function easyweb_webnus_h5_font_wieght() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h5_font_wieght']) ? $thm_options['easyweb_webnus_h5_font_wieght'] : null;
		}		
		
		static public function easyweb_webnus_h5_font_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h5_font_color']) ? $thm_options['easyweb_webnus_h5_font_color'] : null;
		}
			
		static public function easyweb_webnus_h6_font_size() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h6_font_size']) ? $thm_options['easyweb_webnus_h6_font_size'] : null;
		}		
		
		static public function easyweb_webnus_h6_letter_spacing() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h6_letter_spacing']) ? $thm_options['easyweb_webnus_h6_letter_spacing'] : null;
		}	
		
		static public function easyweb_webnus_h6_line_height() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h6_line_height']) ? $thm_options['easyweb_webnus_h6_line_height'] : null;
		}	
		
		static public function easyweb_webnus_h6_font_wieght() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h6_font_wieght']) ? $thm_options['easyweb_webnus_h6_font_wieght'] : null;
		}		
		
		static public function easyweb_webnus_h6_font_color() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_h6_font_color']) ? $thm_options['easyweb_webnus_h6_font_color'] : null;
		}		
		
		/* Custom font */ 
		static public function easyweb_webnus_custom_font1_woff() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font1_woff']) ? $thm_options['easyweb_webnus_custom_font1_woff'] : null;
		}		
		
		static public function easyweb_webnus_custom_font1_ttf() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font1_ttf']) ? $thm_options['easyweb_webnus_custom_font1_ttf'] : null;
		}
		
		static public function easyweb_webnus_custom_font1_svg() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font1_svg']) ? $thm_options['easyweb_webnus_custom_font1_svg'] : null;
		}
		
		static public function easyweb_webnus_custom_font1_eot() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font1_eot']) ? $thm_options['easyweb_webnus_custom_font1_eot'] : null;
		}

		/* Font 2 */
		static public function easyweb_webnus_custom_font2_woff() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font2_woff']) ? $thm_options['easyweb_webnus_custom_font2_woff'] : null;
		}		
		
		static public function easyweb_webnus_custom_font2_ttf() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font2_ttf']) ? $thm_options['easyweb_webnus_custom_font2_ttf'] : null;
		}
		
		static public function easyweb_webnus_custom_font2_svg() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font2_svg']) ? $thm_options['easyweb_webnus_custom_font2_svg'] : null;
		}
		
		static public function easyweb_webnus_custom_font2_eot() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font2_eot']) ? $thm_options['easyweb_webnus_custom_font2_eot'] : null;
		}

		/* Font 3 */
		static public function easyweb_webnus_custom_font3_woff() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font3_woff']) ? $thm_options['easyweb_webnus_custom_font3_woff'] : null;
		}		
		
		static public function easyweb_webnus_custom_font3_ttf() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font3_ttf']) ? $thm_options['easyweb_webnus_custom_font3_ttf'] : null;
		}
		
		static public function easyweb_webnus_custom_font3_svg() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font3_svg']) ? $thm_options['easyweb_webnus_custom_font3_svg'] : null;
		}
		
		static public function easyweb_webnus_custom_font3_eot() {
			$thm_options = get_option('easyweb_webnus_options');
			return isset($thm_options['easyweb_webnus_custom_font3_eot']) ? $thm_options['easyweb_webnus_custom_font3_eot'] : null;
		}
		
	}
}

new easyweb_webnus_options();