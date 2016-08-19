<?php
class WebnusContactForm extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'A contact form will be displayed','name'=> 'Webnus-Contact Form',);
		parent::__construct('WebnusContactForm', 'WebnusContactForm', $params);
	}
	public function form($instance){
		extract($instance); ?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:','easyweb') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /><span><?php esc_html_e( 'The title that you want to show for this widget.', 'easyweb' ); ?></span></p>
		<?php 
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		$werrors = array();
		$wisError = false;
		$werrorName = esc_html__( 'Please enter your name.', 'easyweb' );
		$werrorSubject = esc_html__( 'Please enter your subject.', 'easyweb' );
		$werrorEmail = esc_html__( 'Please enter a valid email address.', 'easyweb' );
		$werrorMessage = esc_html__( 'Please enter the message.', 'easyweb' );
		if ( isset( $_POST['wis-submitted'] ) ) {
			$wname    = $_POST['wcName'];
			$wsubject = $_POST['wcSubject'];
			$wemail   = $_POST['wcEmail'];
			$wmessage = $_POST['wcMessage'];
			if ( ! easyweb_webnus_validate_length( $wname, 2 ) ) {
				$wisError             = true;
				$werrors['werrorName'] = $werrorName;
			}
			if ( ! easyweb_webnus_validate_length( $wsubject, 2 ) ) {
				$wisError             = true;
				$werrors['werrorSubject'] = $werrorSubject;
			}
			if ( ! is_email( $wemail ) ) {
				$wisError              = true;
				$werrors['werrorEmail'] = $werrorEmail;
			}
			if ( ! easyweb_webnus_validate_length( $wmessage, 2 ) ) {
				$wisError                = true;
				$werrors['werrorMessage'] = $werrorMessage;
			}
			if ( ! $wisError ) {
				$wemailReceiver = get_option( 'admin_email' );
				$wemailSubject = sprintf( esc_html__( 'You have been contacted by %s', 'easyweb' ), $wname );
				$wemailBody    = sprintf( esc_html__( 'You have been contacted by %1$s. Their message is:', 'easyweb' ), $wname ) . PHP_EOL . PHP_EOL;
				$wemailBody    .= $wmessage . PHP_EOL . PHP_EOL;
				$wemailBody    .= sprintf( esc_html__( 'You can contact %1$s via email at %2$s', 'easyweb' ), $wname, $wemail );
				$wemailBody    .= PHP_EOL . PHP_EOL;
				$wemailHeaders[] = "Reply-To: $wemail" . PHP_EOL;
				add_filter( 'wp_mail_from_name', 'custom_wp_mail_from_name' );
					function custom_wp_mail_from_name( $wname ) {
						return 'Webnus Contact form';
				}
				$wemailIsSent = wp_mail( $wemailReceiver, $wemailSubject, $wemailBody, $wemailHeaders );
			}
		}
		echo $before_widget; ?>
		<div class="contact-inf">
		<?php 
		if(!empty($title))
		echo $before_title.esc_html($title).$after_title; 
		?>
			<form action="#" method="POST" id="wcontact-form" class="frmContact" role="form" novalidate>

				<!-- name -->
				<input type="text" name="wcName" placeholder="<?php esc_html_e( 'Your Name :','easyweb' ); ?>" value="<?php if ( isset( $_POST['wcName'] ) ) { echo esc_html( $_POST['wcName'] ); } ?>" />
				<?php if ( isset( $werrors['werrorName'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorName'] ); ?></span>
				<?php endif; ?>

				<!-- email -->
				<input type="text" name="wcEmail" placeholder="<?php esc_html_e( 'E mail :','easyweb' ); ?>" value="<?php if ( isset( $_POST['wcEmail'] ) ) { echo esc_html( $_POST['wcEmail'] ); } ?>" />
				<?php if ( isset( $werrors['werrorEmail'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorEmail'] ); ?></span>
				<?php endif; ?>

				<!-- subject -->
				<input type="text" name="wcSubject" placeholder="<?php esc_html_e( 'Subject :','easyweb' ); ?>" value="<?php if ( isset( $_POST['wcSubject'] ) ) { echo esc_html( $_POST['wcSubject'] ); } ?>" />
				<?php if ( isset( $werrors['werrorSubject'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorSubject'] ); ?></span>
				<?php endif; ?>

				<!-- message -->
				<textarea name="wcMessage" placeholder="<?php esc_html_e( 'Message :','easyweb' ); ?>"><?php if ( isset( $_POST['wcMessage'] ) ) { echo esc_html( $_POST['wcMessage'] ); } ?></textarea>
				<?php if ( isset( $werrors['werrorMessage'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorMessage'] ); ?></span>
				<?php endif; ?>

				<!-- submit -->
				<input type="hidden" name="wis-submitted" value="true">
				<button type="submit" class="btnSend" ><?php esc_html_e( 'Send Message','easyweb' ); ?></button>

				<!-- alert -->
				<?php if ( isset( $wemailIsSent ) && $wemailIsSent ) { ?>
					<div class="alert alert-success">
						<?php esc_html_e( 'Your message has been sucessfully sent, thank you!', 'easyweb' ); ?>
					</div> <!-- end alert -->
				<?php } elseif ( isset( $wisError ) && $wisError ) { ?>
					<div class="alert-alert-danger">
						<?php esc_html_e( 'Sorry, it seems there was an error.', 'easyweb' ); ?>
					</div> <!-- end alert -->
				<?php } ?>

			</form>
		</div>
		<?php echo $after_widget;
	} 
}
add_action('widgets_init', 'register_webnuscontactform');
function register_webnuscontactform(){
	register_widget('WebnusContactForm');
}