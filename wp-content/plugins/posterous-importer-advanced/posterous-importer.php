<?php
/*
Plugin Name: Posterous Importer Advanced
Description: Import posts, comments, tags, attachments, and audio from a Posterous.com blog
Author: WPMUDEV
Author URI: http://premium.wpmudev.org/
Version: 1.0.1
Text Domain: posterous-importer
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

if ( ! defined( 'WP_LOAD_IMPORTERS' ) )
	return;

/** Display verbose errors */
if (!defined('IMPORT_DEBUG')) define( 'IMPORT_DEBUG', false );

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';

if ( ! class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
		require $class_wp_importer;
}

if ( ! class_exists( 'WXR_Parser' ) ) {
	// include WXR file parsers
	require dirname( __FILE__ ) . '/parsers.php';
}

/**
 * Posterous WordPress Importer class for managing the import process of a WXR file
 *
 * @package WordPress
 * @subpackage Importer
 */
if ( class_exists( 'WP_Importer' ) ) {
class Posterous_WP_Importer extends WP_Importer {
	var $max_wxr_version = 1.2; // max. supported WXR version

	var $id; // WXR attachment ID

	// information to import from WXR file
	var $version;
	var $authors = array();
	var $posts = array();
	var $terms = array();
	var $categories = array();
	var $tags = array();
	var $base_url = '';

	// mappings from old information to new
	var $processed_authors = array();
	var $author_mapping = array();
	var $processed_terms = array();
	var $processed_posts = array();
	var $post_orphans = array();
	var $processed_menu_items = array();
	var $menu_item_orphans = array();
	var $missing_menu_items = array();

	var $fetch_attachments = false;
	var $url_remap = array();
	var $featured_images = array();
	var $processed_audio = array();
	
	var $attachments = array();
	var $posterous_site_id = 0;
	var $auth = false;

	function Posterous_WP_Importer() {
		add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
	}
	
	function WP_Import() { /* nothing */ }
	
	function admin_enqueue_scripts($hook) {
		if( 'admin.php' != $hook )
			return;
		
		wp_enqueue_script( 'jquery' );
	}

	/**
	 * Registered callback function for the WordPress Importer
	 *
	 * Manages the three separate stages of the WXR import process
	 */
	function dispatch() {
		$this->header();

		$step = empty( $_GET['step'] ) ? 0 : (int) $_GET['step'];
		switch ( $step ) {
			case 0:
				$this->greet();
				break;
			case 1:
				check_admin_referer( 'import-upload' );
				if ( $this->handle_upload() )
					$this->import_options();
				break;
			case 2:
				check_admin_referer( 'import-posterous' );
				$this->fetch_attachments = ( ! empty( $_POST['fetch_attachments'] ) && $this->allow_fetch_attachments() );
				$this->id = (int) $_POST['import_id'];
				if ( file_exists(get_attached_file( $this->id ) ) ) {
					// Do the magic
					$this->get_author_mapping();
					$this->import_async();
				} else {
					// Looks like we have finished
					$this->import_finished();
				}
				break;
			case 3:
				$this->fetch_attachments = ( ! empty( $_REQUEST['fetch_attachments'] ) && $this->allow_fetch_attachments() );
				$this->id = (int) $_REQUEST['import_id'];
				$file = get_attached_file( $this->id );
				set_time_limit(0);
				$this->import( $file );
				break;
			case 4:
				$this->fix_import_audio();
				break;
		}

		$this->footer();
	}
	
	function get_posterous_site_id() {
		if (get_option('posterous_site_id_'.md5($this->base_url), 'none') == 'none') {
			$site_content = wp_remote_get($this->base_url);
			
			preg_match('/data-site-id="([0-9]+)"/', $site_content['body'], $site_id_arr);
			update_option('posterous_site_id_'.md5($this->base_url), $site_id_arr[1]);
		}
		
		return get_option('posterous_site_id_'.md5($this->base_url), 'none');
	}	

	/**
	 * The main controller for the actual import stage.
	 *
	 * @param string $file Path to the WXR file for importing
	 */
	function import( $file ) {
		add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );
		
		$this->attachments = $this->get_imported_attachments( 'posterous' );
		$this->processed_posts = $this->get_imported_posts( 'posterous' ); 
		
		$this->import_start( $file );
		
		$this->posterous_site_id = $this->get_posterous_site_id();
		
		$this->author_mapping = get_option('posterous_author_mapping', array());
		if (!$this->author_mapping) {
			$this->author_mapping = array();
		}
		
		wp_suspend_cache_invalidation( true );
		$this->process_categories();
		$this->process_tags();
		$this->process_terms();
		$this->process_posts();
		wp_suspend_cache_invalidation( false );

		// update incorrect/missing information in the DB
		$this->backfill_parents();
		$this->remap_featured_images();

		$this->import_end();
	}
	
	function fix_import_audio() {
		$this->attachments = $this->get_imported_attachments( 'posterous' );
		$this->processed_posts = $this->get_imported_posts( 'posterous' );
		$this->processed_audio = $this->get_imported_audio( 'posterous' );
		
		$this->url_remap = $this->build_audio_url_remap();
		
		wp_suspend_cache_invalidation( true );
		foreach ($this->processed_audio as $post_id => $_aurl) {
			$post = get_post($post_id);
			
			if (preg_match('/class=["\']+p_embed p_audio_embed["\']+/', $post->post_content) > 0) {
				$post->post_content = preg_replace('/class=["\']p_embed p_audio_embed["\']>[\r|\n|\s|\r\n]*<a[\s]*href=["\']\S*["\']>/i', 'class="p_embed p_audio_embed"><a href="'.$_aurl.'">', $post->post_content);
				$this->backfill_attachment_urls($post);
			}
		}
		wp_suspend_cache_invalidation( false );
		
		$this->import_end();
	}
	
	function build_audio_url_remap() {
		
		$hashtable = array ();
		
		foreach ($this->attachments as $old_url => $attachment_id) {
			$hashtable[$old_url] = wp_get_attachment_url($attachment_id);
		}
		
		return $hashtable;
	}
	
	function get_imported_audio( $importer_name ) {
		global $wpdb;

		$hashtable = array ();

		// Get all attachments
		$sql = $wpdb->prepare( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '%s'", $importer_name . '_audio' );
		$results = $wpdb->get_results( $sql );

		if (! empty( $results )) {
			foreach ( $results as $r ) {
				// Set permalinks into array
				$hashtable[(int) $r->post_id] = $r->meta_value;
			}
		}

		// unset to save memory
		unset( $results, $r );

		return $hashtable;
	}
	
	function get_imported_posts( $importer_name ) {
		global $wpdb;

		$hashtable = array ();

		// Get all attachments
		$sql = $wpdb->prepare( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '%s'", $importer_name . '_post' );
		$results = $wpdb->get_results( $sql );

		if (! empty( $results )) {
			foreach ( $results as $r ) {
				// Set permalinks into array
				$hashtable[$r->meta_value] = (int) $r->post_id;
			}
		}

		// unset to save memory
		unset( $results, $r );

		return $hashtable;
	}
	
	/**
	 * Set array with imported attachments from WordPress database
	 *
	 * @param string $importer_name
	 * @param string $bid
	 * @return array
	 */
	function get_imported_attachments( $importer_name ) {
		global $wpdb;

		$hashtable = array ();

		// Get all attachments
		$sql = $wpdb->prepare( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '%s'", $importer_name . '_attachment' );
		$results = $wpdb->get_results( $sql );

		if (! empty( $results )) {
			foreach ( $results as $r ) {
				// Set permalinks into array
				$hashtable[$r->meta_value] = (int) $r->post_id;
			}
		}

		// unset to save memory
		unset( $results, $r );

		return $hashtable;
	}

	/**
	 * Parses the WXR file and prepares us for the task of processing parsed data
	 *
	 * @param string $file Path to the WXR file for importing
	 */
	function import_start( $file ) {
		if ( ! is_file($file) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'wordpress-importer' ) . '</strong><br />';
			echo __( 'The file does not exist, please try again.', 'wordpress-importer' ) . '</p>';
			$this->footer();
			die();
		}

		$import_data = $this->parse( $file );

		if ( is_wp_error( $import_data ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'wordpress-importer' ) . '</strong><br />';
			echo esc_html( $import_data->get_error_message() ) . '</p>';
			$this->footer();
			die();
		}

		$this->version = $import_data['version'];
		$this->get_authors_from_import( $import_data );
		$this->posts = $import_data['posts'];
		$this->terms = $import_data['terms'];
		$this->categories = $import_data['categories'];
		$this->tags = $import_data['tags'];
		$this->base_url = esc_url( $import_data['base_url'] );

		wp_defer_term_counting( true );
		wp_defer_comment_counting( true );

		do_action( 'import_start' );
	}

	/**
	 * Performs post-import cleanup of files and the cache
	 */
	function import_end() {
		wp_import_cleanup( $this->id );

		wp_cache_flush();
		foreach ( get_taxonomies() as $tax ) {
			delete_option( "{$tax}_children" );
			_get_term_hierarchy( $tax );
		}

		wp_defer_term_counting( false );
		wp_defer_comment_counting( false );

		echo '<p>' . __( 'All done.', 'wordpress-importer' ) . ' <a href="' . admin_url() . '">' . __( 'Have fun!', 'wordpress-importer' ) . '</a>' . '</p>';
		echo '<p>' . __( 'Remember to update the passwords and roles of imported users.', 'wordpress-importer' ) . '</p>';

		
		delete_option('posterous_username');
		delete_option('posterous_password');
		do_action( 'import_end' );
	}

	/**
	 * Handles the WXR upload and initial parsing of the file to prepare for
	 * displaying author import options
	 *
	 * @return bool False if error uploading or invalid file, true otherwise
	 */
	function handle_upload() {
		$file = wp_import_handle_upload();

		if ( isset( $file['error'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'wordpress-importer' ) . '</strong><br />';
			echo esc_html( $file['error'] ) . '</p>';
			return false;
		} else if ( ! file_exists( $file['file'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'wordpress-importer' ) . '</strong><br />';
			printf( __( 'The export file could not be found at <code>%s</code>. It is likely that this was caused by a permissions problem.', 'wordpress-importer' ), esc_html( $file['file'] ) );
			echo '</p>';
			return false;
		}

		$this->id = (int) $file['id'];
		$import_data = $this->parse( $file['file'] );
		if ( is_wp_error( $import_data ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'wordpress-importer' ) . '</strong><br />';
			echo esc_html( $import_data->get_error_message() ) . '</p>';
			return false;
		}

		$this->version = $import_data['version'];
		if ( $this->version > $this->max_wxr_version ) {
			echo '<div class="error"><p><strong>';
			printf( __( 'This WXR file (version %s) may not be supported by this version of the importer. Please consider updating.', 'wordpress-importer' ), esc_html($import_data['version']) );
			echo '</strong></p></div>';
		}

		$this->get_authors_from_import( $import_data );

		return true;
	}

	/**
	 * Retrieve authors from parsed WXR data
	 *
	 * Uses the provided author information from WXR 1.1 files
	 * or extracts info from each post for WXR 1.0 files
	 *
	 * @param array $import_data Data returned by a WXR parser
	 */
	function get_authors_from_import( $import_data ) {
		if ( ! empty( $import_data['authors'] ) ) {
			$this->authors = $import_data['authors'];
		// no author information, grab it from the posts
		} else {
			foreach ( $import_data['posts'] as $post ) {
				$login = sanitize_user( $post['post_author'], true );
				if ( empty( $login ) ) {
					printf( __( 'Failed to import author %s. Their posts will be attributed to the current user.', 'wordpress-importer' ), esc_html( $post['post_author'] ) );
					echo '<br />';
					continue;
				}

				if ( ! isset($this->authors[$login]) )
					$this->authors[$login] = array(
						'author_login' => $login,
						'author_display_name' => $post['post_author']
					);
			}
		}
	}
	
	function test_user_pass( $username, $password ) {
		$username = strtolower( $username );

		$this->username = $username;
		$this->password = $password;
		$this->auth = true;
		$url = 'http://posterous.com/api/getsites';
		$data = $this->get_page( $url, $this->username, $this->password );
		if ( is_wp_error( $data ) ) {
			delete_option('posterous_username');
			delete_option('posterous_password');
			echo "Error:\n" . $data->get_error_message() . "\n";
			return false;
		}

		$code = (int) $data['response']['code'];
		unset( $data );
		return true;
	}
	
	function import_async() {
		$username = trim( stripslashes( strtolower( $_POST['username'] ) ) );
		update_option( 'posterous_username', $username );
		$password = trim( stripslashes( $_POST['password'] ) );
		update_option( 'posterous_password', $password );
		
			$import_url = admin_url( 'admin.php?import=posterous-wxr&amp;step=3&import_id='.$this->id.'&fetch_attachments=' );
			
			if ($this->fetch_attachments) {
				$import_url .= '1';
			} else {
				$import_url .= '0';
			}
			?>
			<h3><?php _e( 'Importing ...', 'posterous-importer' ); ?></h3>
			<?php
			if (strtotime('2013-05-01') > time() && !$this->test_user_pass($username, $password)) {
			?>
			<p><?php _e( 'Invalid username or password, going ahead without audio.', 'wordpress-importer' ); ?></p>
			<?php
			}
			?>
			<p><?php _e( 'Please hold on while we bring your content from Posterous over to your sparky new blog.', 'posterous-importer' ); ?></p>
			<div id="posterous-pb"><div class="posterous-pb-overlay"></div></div>
			<div id="posterous-progress"></div>
			<p style="text-align: center">
				<a href="https://premium.wpmudev.org/join/"><img href="<?php echo plugins_url('posterous-importer-advanced/img/wpmudev.jpg', __FILE__); ?>" style="border:none;"/></a>
			</p>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					_posterous_process();
				});
				function _posterous_process() {
					jQuery.post(
						'<?php echo admin_url( 'admin.php?import=posterous-wxr&step=3' ); ?>',
						'import_id=<?php echo $this->id; ?>&fetch_attachments=<?php echo intval($this->fetch_attachments); ?>',
						function(data) {
							if (data.match(/<strong>Sorry, there has been an error/)) {
								jQuery('#posterous-progress').append('<p><?php _e('Finished', 'posterous-importer'); ?></p>');
								jQuery('#posterous-pb').hide();
								window.location = '<?php echo admin_url( 'admin.php?import=posterous-wxr&step=4' ); ?>';
							} else if (data.match(/All done./)) {
								jQuery('#posterous-progress').append(jQuery(data).find('.posterous-wrap'));
								jQuery('#posterous-pb').hide();
								window.location = '<?php echo admin_url( 'admin.php?import=posterous-wxr&step=4' ); ?>';
							} else {
								jQuery('#posterous-progress').append(jQuery(data).find('.posterous-wrap'));
								_posterous_process();
							}
						}
					);
				}
			</script>
			<style type="text/css">
				#posterous-pb {
					width: 500px;
					height: 2em;
					border-bottom-right-radius: 4px;
					border-bottom-left-radius: 4px;
					border-top-right-radius: 4px;
					border-top-left-radius: 4px;
					border: 1px solid #aaaaaa;
					background: #cccccc 50% 50% repeat-x;
					margin: 0 0 5px 0;
				}
				.posterous-pb-overlay {
					background: url(<?php echo plugins_url('posterous-importer-advanced/img/animated-overlay.gif', __FILE__); ?>);
					width: 100%;
					height: 100%;
					opacity: 0.5;
				}
			</style>
			<noscript>
				<iframe src="<?php echo $import_url; ?>"></iframe>
			</noscript>
			<?php
	}
	
	function import_finished() {
		?>
		<h3><?php _e( 'Completed Import', 'posterous-importer' ); ?></h3>
		<p><?php _e( 'We have succesfully imported your content from Posterous.', 'wordpress-importer' ); ?></p>
		<p><?php _e( 'Happy Blogging!', 'wordpress-importer' ); ?></p>
		<p style="text-align: center">
			<a href="https://premium.wpmudev.org/join/"><img href="<?php echo plugins_url('posterous-importer-advanced/img/wpmudev.jpg', __FILE__); ?>" style="border:none;"/></a>
		</p>
		<?php
		
		delete_option('posterous_username');
		delete_option('posterous_password');
	}

	/**
	 * Display pre-import options, author importing/mapping and option to
	 * fetch attachments
	 */
	function import_options() {
		$j = 0;
		$username = get_option( 'posterous_username' );
?>
<form action="<?php echo admin_url( 'admin.php?import=posterous-wxr&amp;step=2' ); ?>" method="post">
	<?php wp_nonce_field( 'import-posterous' ); ?>
	<input type="hidden" name="import_id" value="<?php echo $this->id; ?>" />

<?php if ( ! empty( $this->authors ) ) : ?>
	<h3><?php _e( 'Assign Authors', 'wordpress-importer' ); ?></h3>
	<p><?php _e( 'To make it easier for you to edit and save the imported content, you may want to reassign the author of the imported item to an existing user of this site. For example, you may want to import all the entries as <code>admin</code>s entries.', 'wordpress-importer' ); ?></p>
<?php if ( $this->allow_create_users() ) : ?>
	<p><?php printf( __( 'If a new user is created by WordPress, a new password will be randomly generated and the new user&#8217;s role will be set as %s. Manually changing the new user&#8217;s details will be necessary.', 'wordpress-importer' ), esc_html( get_option('default_role') ) ); ?></p>
<?php endif; ?>
	<ol id="authors">
<?php foreach ( $this->authors as $author ) : ?>
		<li><?php $this->author_select( $j++, $author ); ?></li>
<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php if ( $this->allow_fetch_attachments() ) : ?>
	<h3><?php _e( 'Import Attachments', 'wordpress-importer' ); ?></h3>
	<p>
		<input type="checkbox" value="1" name="fetch_attachments" id="import-attachments" />
		<label for="import-attachments"><?php _e( 'Download and import file attachments', 'wordpress-importer' ); ?></label>
	</p>
<?php endif; ?>

<?php if (strtotime('2013-05-01') > time()) { ?>
	<h3><?php _e( 'Posterous Authentication', 'wordpress-importer' ); ?></h3>
	<label><?php _e( 'Email Address' ); ?></label> <input id="username" name="username" type="text" value="<?php echo esc_attr( $username ); ?>" /><br />
	<label><?php _e( 'Password' ); ?></label> <input id="password" name="password" type="password" value="" /><br />
<?php } ?>
	<p class="submit"><input type="submit" class="button" value="<?php esc_attr_e( 'Submit', 'wordpress-importer' ); ?>" /></p>
</form>
<?php
	}

	/**
	 * Display import options for an individual author. That is, either create
	 * a new user based on import info or map to an existing user
	 *
	 * @param int $n Index for each author in the form
	 * @param array $author Author information, e.g. login, display name, email
	 */
	function author_select( $n, $author ) {
		_e( 'Import author:', 'wordpress-importer' );
		echo ' <strong>' . esc_html( $author['author_display_name'] );
		if ( $this->version != '1.0' ) echo ' (' . esc_html( $author['author_login'] ) . ')';
		echo '</strong><br />';

		if ( $this->version != '1.0' )
			echo '<div style="margin-left:18px">';

		$create_users = $this->allow_create_users();
		if ( $create_users ) {
			if ( $this->version != '1.0' ) {
				_e( 'or create new user with login name:', 'wordpress-importer' );
				$value = '';
			} else {
				_e( 'as a new user:', 'wordpress-importer' );
				$value = esc_attr( sanitize_user( $author['author_login'], true ) );
			}

			echo ' <input type="text" name="user_new['.$n.']" value="'. $value .'" /><br />';
		}

		if ( ! $create_users && $this->version == '1.0' )
			_e( 'assign posts to an existing user:', 'wordpress-importer' );
		else
			_e( 'or assign posts to an existing user:', 'wordpress-importer' );
		wp_dropdown_users( array( 'name' => "user_map[$n]", 'multi' => true, 'show_option_all' => __( '- Select -', 'wordpress-importer' ) ) );
		echo '<input type="hidden" name="imported_authors['.$n.']" value="' . esc_attr( $author['author_login'] ) . '" />';

		if ( $this->version != '1.0' )
			echo '</div>';
	}

	/**
	 * Map old author logins to local user IDs based on decisions made
	 * in import options form. Can map to an existing user, create a new user
	 * or falls back to the current user in case of error with either of the previous
	 */
	function get_author_mapping() {
		if ( ! isset( $_POST['imported_authors'] ) )
			return;

		$create_users = $this->allow_create_users();

		foreach ( (array) $_POST['imported_authors'] as $i => $old_login ) {
			// Multisite adds strtolower to sanitize_user. Need to sanitize here to stop breakage in process_posts.
			$santized_old_login = sanitize_user( $old_login, true );
			$old_id = isset( $this->authors[$old_login]['author_id'] ) ? intval($this->authors[$old_login]['author_id']) : false;

			if ( ! empty( $_POST['user_map'][$i] ) ) {
				$user = get_userdata( intval($_POST['user_map'][$i]) );
				if ( isset( $user->ID ) ) {
					if ( $old_id )
						$this->processed_authors[$old_id] = $user->ID;
					$this->author_mapping[$santized_old_login] = $user->ID;
				}
			} else if ( $create_users ) {
				if ( ! empty($_POST['user_new'][$i]) ) {
					$user_id = wp_create_user( $_POST['user_new'][$i], wp_generate_password() );
				} else if ( $this->version != '1.0' ) {
					$user_data = array(
						'user_login' => $old_login,
						'user_pass' => wp_generate_password(),
						'user_email' => isset( $this->authors[$old_login]['author_email'] ) ? $this->authors[$old_login]['author_email'] : '',
						'display_name' => $this->authors[$old_login]['author_display_name'],
						'first_name' => isset( $this->authors[$old_login]['author_first_name'] ) ? $this->authors[$old_login]['author_first_name'] : '',
						'last_name' => isset( $this->authors[$old_login]['author_last_name'] ) ? $this->authors[$old_login]['author_last_name'] : '',
					);
					$user_id = wp_insert_user( $user_data );
				}

				if ( ! is_wp_error( $user_id ) ) {
					if ( $old_id )
						$this->processed_authors[$old_id] = $user_id;
					$this->author_mapping[$santized_old_login] = $user_id;
				} else {
					printf( __( 'Failed to create new user for %s. Their posts will be attributed to the current user.', 'wordpress-importer' ), esc_html($this->authors[$old_login]['author_display_name']) );
					if ( defined('IMPORT_DEBUG') && IMPORT_DEBUG )
						echo ' ' . $user_id->get_error_message();
					echo '<br />';
				}
			}

			// failsafe: if the user_id was invalid, default to the current user
			if ( ! isset( $this->author_mapping[$santized_old_login] ) ) {
				if ( $old_id )
					$this->processed_authors[$old_id] = (int) get_current_user_id();
				$this->author_mapping[$santized_old_login] = (int) get_current_user_id();
			}
		}
		
		update_option('posterous_author_mapping', $this->author_mapping);
	}

	/**
	 * Create new categories based on import information
	 *
	 * Doesn't create a new category if its slug already exists
	 */
	function process_categories() {
		if ( empty( $this->categories ) )
			return;

		foreach ( $this->categories as $cat ) {
			// if the category already exists leave it alone
			$term_id = term_exists( $cat['category_nicename'], 'category' );
			if ( $term_id ) {
				if ( is_array($term_id) ) $term_id = $term_id['term_id'];
				if ( isset($cat['term_id']) )
					$this->processed_terms[intval($cat['term_id'])] = (int) $term_id;
				continue;
			}

			$category_parent = empty( $cat['category_parent'] ) ? 0 : category_exists( $cat['category_parent'] );
			$category_description = isset( $cat['category_description'] ) ? $cat['category_description'] : '';
			$catarr = array(
				'category_nicename' => $cat['category_nicename'],
				'category_parent' => $category_parent,
				'cat_name' => $cat['cat_name'],
				'category_description' => $category_description
			);

			$id = wp_insert_category( $catarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset($cat['term_id']) )
					$this->processed_terms[intval($cat['term_id'])] = $id;
			} else {
				printf( __( 'Failed to import category %s', 'wordpress-importer' ), esc_html($cat['category_nicename']) );
				if ( defined('IMPORT_DEBUG') && IMPORT_DEBUG )
					echo ': ' . $id->get_error_message();
				echo '<br />';
				continue;
			}
		}

		unset( $this->categories );
	}

	/**
	 * Create new post tags based on import information
	 *
	 * Doesn't create a tag if its slug already exists
	 */
	function process_tags() {
		if ( empty( $this->tags ) )
			return;

		foreach ( $this->tags as $tag ) {
			// if the tag already exists leave it alone
			$term_id = term_exists( $tag['tag_slug'], 'post_tag' );
			if ( $term_id ) {
				if ( is_array($term_id) ) $term_id = $term_id['term_id'];
				if ( isset($tag['term_id']) )
					$this->processed_terms[intval($tag['term_id'])] = (int) $term_id;
				continue;
			}

			$tag_desc = isset( $tag['tag_description'] ) ? $tag['tag_description'] : '';
			$tagarr = array( 'slug' => $tag['tag_slug'], 'description' => $tag_desc );

			$id = wp_insert_term( $tag['tag_name'], 'post_tag', $tagarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset($tag['term_id']) )
					$this->processed_terms[intval($tag['term_id'])] = $id['term_id'];
			} else {
				printf( __( 'Failed to import post tag %s', 'wordpress-importer' ), esc_html($tag['tag_name']) );
				if ( defined('IMPORT_DEBUG') && IMPORT_DEBUG )
					echo ': ' . $id->get_error_message();
				echo '<br />';
				continue;
			}
		}

		unset( $this->tags );
	}

	/**
	 * Create new terms based on import information
	 *
	 * Doesn't create a term its slug already exists
	 */
	function process_terms() {
		if ( empty( $this->terms ) )
			return;

		foreach ( $this->terms as $term ) {
			// if the term already exists in the correct taxonomy leave it alone
			$term_id = term_exists( $term['slug'], $term['term_taxonomy'] );
			if ( $term_id ) {
				if ( is_array($term_id) ) $term_id = $term_id['term_id'];
				if ( isset($term['term_id']) )
					$this->processed_terms[intval($term['term_id'])] = (int) $term_id;
				continue;
			}

			if ( empty( $term['term_parent'] ) ) {
				$parent = 0;
			} else {
				$parent = term_exists( $term['term_parent'], $term['term_taxonomy'] );
				if ( is_array( $parent ) ) $parent = $parent['term_id'];
			}
			$description = isset( $term['term_description'] ) ? $term['term_description'] : '';
			$termarr = array( 'slug' => $term['slug'], 'description' => $description, 'parent' => intval($parent) );

			$id = wp_insert_term( $term['term_name'], $term['term_taxonomy'], $termarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset($term['term_id']) )
					$this->processed_terms[intval($term['term_id'])] = $id['term_id'];
			} else {
				printf( __( 'Failed to import %s %s', 'wordpress-importer' ), esc_html($term['term_taxonomy']), esc_html($term['term_name']) );
				if ( defined('IMPORT_DEBUG') && IMPORT_DEBUG )
					echo ': ' . $id->get_error_message();
				echo '<br />';
				continue;
			}
		}

		unset( $this->terms );
	}
	
	function parse_galleries($post_content) {
		return preg_replace('/<div.*class=[\'"]p_embed p_image_embed[\'"]>\s*(<a.*><img.*><\/a>\s*)+\s*<\/div>/i', '[gallery]', $post_content);
	}

	/**
	 * Create new posts based on import information
	 *
	 * Posts marked as having a parent which doesn't exist will become top level items.
	 * Doesn't create a new post if: the post type doesn't exist, the given post ID
	 * is already noted as imported or a post with the same title and date already exists.
	 * Note that new/updated terms, comments and meta are imported for the last of the above.
	 */
	function process_posts() {
		
		// Save the embeds
		remove_filter('content_save_pre', 'wp_filter_post_kses');
		remove_filter('excerpt_save_pre', 'wp_filter_post_kses');
		remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
		
		foreach ( $this->posts as $post ) {
			if ( ! post_type_exists( $post['post_type'] ) ) {
				printf( __( 'Failed to import &#8220;%s&#8221;: Invalid post type %s', 'wordpress-importer' ),
					esc_html($post['post_title']), esc_html($post['post_type']) );
				echo '<br />';
				continue;
			}

			if ( isset( $this->processed_posts[$post['post_id']] ) && ! empty( $post['post_id'] ) )
				continue;

			if ( $post['status'] == 'auto-draft' )
				continue;

			if ( 'nav_menu_item' == $post['post_type'] ) {
				$this->process_menu_item( $post );
				continue;
			}

			$post_type_object = get_post_type_object( $post['post_type'] );
			
			$post['post_date'] = date('Y-m-d H:i:s', strtotime($post['post_date']));
			$post['post_date_gmt'] = gmdate('Y-m-d H:i:s', strtotime($post['post_date']));

			$post_exists = post_exists( $post['post_title'], '', $post['post_date'] );
			if ( $post_exists && get_post_type( $post_exists ) == $post['post_type'] ) {
				printf( __('%s &#8220;%s&#8221; already exists.', 'wordpress-importer'), $post_type_object->labels->singular_name, esc_html($post['post_title']) );
				echo '<br />';
				$comment_post_ID = $post_id = $post_exists;
				
				$new_post = get_post($post_id);
			} else {
				$post_parent = (int) $post['post_parent'];
				if ( $post_parent ) {
					// if we already know the parent, map it to the new local ID
					if ( isset( $this->processed_posts[$post_parent] ) ) {
						$post_parent = $this->processed_posts[$post_parent];
					// otherwise record the parent for later
					} else {
						$this->post_orphans[intval($post['post_id'])] = $post_parent;
						$post_parent = 0;
					}
				}

				// map the post author
				$author = sanitize_user( $post['post_author'], true );
				if ( isset( $this->author_mapping[$author] ) )
					$author = $this->author_mapping[$author];
				else
					$author = (int) get_current_user_id();

				$postdata = array(
					'import_id' => $post['post_id'], 'post_author' => $author, 'post_date' => $post['post_date'],
					'post_date_gmt' => $post['post_date_gmt'], 'post_content' => $this->parse_galleries($post['post_content']),
					'post_excerpt' => $post['post_excerpt'], 'post_title' => $post['post_title'],
					'post_status' => $post['status'], 'post_name' => $post['post_name'],
					'comment_status' => $post['comment_status'], 'ping_status' => $post['ping_status'],
					'guid' => $post['guid'], 'post_parent' => $post_parent, 'menu_order' => $post['menu_order'],
					'post_type' => $post['post_type'], 'post_password' => $post['post_password']
				);

				$comment_post_ID = $post_id = wp_insert_post( $postdata, true );

				if ( is_wp_error( $post_id ) ) {
					printf( __( 'Failed to import %s &#8220;%s&#8221;', 'wordpress-importer' ),
						$post_type_object->labels->singular_name, esc_html($post['post_title']) );
					if ( defined('IMPORT_DEBUG') && IMPORT_DEBUG )
						echo ': ' . $post_id->get_error_message();
					echo '<br />';
					continue;
				}

				if ( $post['is_sticky'] == 1 )
					stick_post( $post_id );
					
				$new_post = get_post($post_id);
				
				// Now get the embeds
				$attachments = $this->extract_post_media($post['post_content'], $post['post_id']);
				
				$this->process_attachment($new_post, $attachments);
			}
			
			add_post_meta( $post_id, 'posterous_post', intval($post['post_id']), true );
			
			// map pre-import ID to local ID
			$this->processed_posts[intval($post['post_id'])] = (int) $post_id;
			
			// add categories, tags and other terms
			if ( ! empty( $post['terms'] ) ) {
				$terms_to_set = array();
				foreach ( $post['terms'] as $term ) {
					// back compat with WXR 1.0 map 'tag' to 'post_tag'
					$taxonomy = ( 'tag' == $term['domain'] ) ? 'post_tag' : $term['domain'];
					$term_exists = term_exists( $term['slug'], $taxonomy );
					$term_id = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
					if ( ! $term_id ) {
						$t = wp_insert_term( $term['name'], $taxonomy, array( 'slug' => $term['slug'] ) );
						if ( ! is_wp_error( $t ) ) {
							$term_id = $t['term_id'];
						} else {
							printf( __( 'Failed to import %s %s', 'wordpress-importer' ), esc_html($taxonomy), esc_html($term['name']) );
							if ( defined('IMPORT_DEBUG') && IMPORT_DEBUG )
								echo ': ' . $t->get_error_message();
							echo '<br />';
							continue;
						}
					}
					$terms_to_set[$taxonomy][] = intval( $term_id );
				}

				foreach ( $terms_to_set as $tax => $ids ) {
					$tt_ids = wp_set_post_terms( $post_id, $ids, $tax );
				}
				unset( $post['terms'], $terms_to_set );
			}

			// add/update comments
			if ( ! empty( $post['comments'] ) ) {
				$num_comments = 0;
				$inserted_comments = array();
				foreach ( $post['comments'] as $comment ) {
					$comment_id	= $comment['comment_id'];
					$newcomments[$comment_id]['comment_post_ID']      = $comment_post_ID;
					$newcomments[$comment_id]['comment_author']       = $comment['comment_author'];
					$newcomments[$comment_id]['comment_author_email'] = $comment['comment_author_email'];
					$newcomments[$comment_id]['comment_author_IP']    = $comment['comment_author_IP'];
					$newcomments[$comment_id]['comment_author_url']   = $comment['comment_author_url'];
					$newcomments[$comment_id]['comment_date']         = $comment['comment_date'];
					$newcomments[$comment_id]['comment_date_gmt']     = $comment['comment_date_gmt'];
					$newcomments[$comment_id]['comment_content']      = $comment['comment_content'];
					$newcomments[$comment_id]['comment_approved']     = $comment['comment_approved'];
					$newcomments[$comment_id]['comment_type']         = $comment['comment_type'];
					$newcomments[$comment_id]['comment_parent'] 	  = $comment['comment_parent'];
					$newcomments[$comment_id]['commentmeta']          = isset( $comment['commentmeta'] ) ? $comment['commentmeta'] : array();
					if ( isset( $this->processed_authors[$comment['comment_user_id']] ) )
						$newcomments[$comment_id]['user_id'] = $this->processed_authors[$comment['comment_user_id']];
				}
				ksort( $newcomments );

				foreach ( $newcomments as $key => $comment ) {
					// if this is a new post we can skip the comment_exists() check
					if ( ! $post_exists || ! comment_exists( $comment['comment_author'], $comment['comment_date'] ) ) {
						if ( isset( $inserted_comments[$comment['comment_parent']] ) )
							$comment['comment_parent'] = $inserted_comments[$comment['comment_parent']];
						$comment = wp_filter_comment( $comment );
						$inserted_comments[$key] = wp_insert_comment( $comment );

						foreach( $comment['commentmeta'] as $meta ) {
							$value = maybe_unserialize( $meta['value'] );
							add_comment_meta( $inserted_comments[$key], $meta['key'], $value );
						}

						$num_comments++;
					}
				}
				unset( $newcomments, $inserted_comments, $post['comments'] );
			}

			// add/update post meta
			if ( isset( $post['postmeta'] ) ) {
				foreach ( $post['postmeta'] as $meta ) {
					$key = apply_filters( 'import_post_meta_key', $meta['key'] );
					$value = false;

					if ( '_edit_last' == $key ) {
						if ( isset( $this->processed_authors[intval($meta['value'])] ) )
							$value = $this->processed_authors[intval($meta['value'])];
						else
							$key = false;
					}

					if ( $key ) {
						// export gets meta straight from the DB so could have a serialized string
						if ( ! $value )
							$value = maybe_unserialize( $meta['value'] );

						add_post_meta( $post_id, $key, $value );
						do_action( 'import_post_meta', $post_id, $key, $value );

						// if the post has a featured image, take note of this in case of remap
						if ( '_thumbnail_id' == $key )
							$this->featured_images[$post_id] = (int) $value;
					}
				}
			}
		}

		unset( $this->posts );
	}

	/**
	 * Attempt to create a new menu item from import data
	 *
	 * Fails for draft, orphaned menu items and those without an associated nav_menu
	 * or an invalid nav_menu term. If the post type or term object which the menu item
	 * represents doesn't exist then the menu item will not be imported (waits until the
	 * end of the import to retry again before discarding).
	 *
	 * @param array $item Menu item details from WXR file
	 */
	function process_menu_item( $item ) {
		// skip draft, orphaned menu items
		if ( 'draft' == $item['status'] )
			return;

		$menu_slug = false;
		if ( isset($item['terms']) ) {
			// loop through terms, assume first nav_menu term is correct menu
			foreach ( $item['terms'] as $term ) {
				if ( 'nav_menu' == $term['domain'] ) {
					$menu_slug = $term['slug'];
					break;
				}
			}
		}

		// no nav_menu term associated with this menu item
		if ( ! $menu_slug ) {
			_e( 'Menu item skipped due to missing menu slug', 'wordpress-importer' );
			echo '<br />';
			return;
		}

		$menu_id = term_exists( $menu_slug, 'nav_menu' );
		if ( ! $menu_id ) {
			printf( __( 'Menu item skipped due to invalid menu slug: %s', 'wordpress-importer' ), esc_html( $menu_slug ) );
			echo '<br />';
			return;
		} else {
			$menu_id = is_array( $menu_id ) ? $menu_id['term_id'] : $menu_id;
		}

		foreach ( $item['postmeta'] as $meta )
			$$meta['key'] = $meta['value'];

		if ( 'taxonomy' == $_menu_item_type && isset( $this->processed_terms[intval($_menu_item_object_id)] ) ) {
			$_menu_item_object_id = $this->processed_terms[intval($_menu_item_object_id)];
		} else if ( 'post_type' == $_menu_item_type && isset( $this->processed_posts[intval($_menu_item_object_id)] ) ) {
			$_menu_item_object_id = $this->processed_posts[intval($_menu_item_object_id)];
		} else if ( 'custom' != $_menu_item_type ) {
			// associated object is missing or not imported yet, we'll retry later
			$this->missing_menu_items[] = $item;
			return;
		}

		if ( isset( $this->processed_menu_items[intval($_menu_item_menu_item_parent)] ) ) {
			$_menu_item_menu_item_parent = $this->processed_menu_items[intval($_menu_item_menu_item_parent)];
		} else if ( $_menu_item_menu_item_parent ) {
			$this->menu_item_orphans[intval($item['post_id'])] = (int) $_menu_item_menu_item_parent;
			$_menu_item_menu_item_parent = 0;
		}

		// wp_update_nav_menu_item expects CSS classes as a space separated string
		$_menu_item_classes = maybe_unserialize( $_menu_item_classes );
		if ( is_array( $_menu_item_classes ) )
			$_menu_item_classes = implode( ' ', $_menu_item_classes );

		$args = array(
			'menu-item-object-id' => $_menu_item_object_id,
			'menu-item-object' => $_menu_item_object,
			'menu-item-parent-id' => $_menu_item_menu_item_parent,
			'menu-item-position' => intval( $item['menu_order'] ),
			'menu-item-type' => $_menu_item_type,
			'menu-item-title' => $item['post_title'],
			'menu-item-url' => $_menu_item_url,
			'menu-item-description' => $item['post_content'],
			'menu-item-attr-title' => $item['post_excerpt'],
			'menu-item-target' => $_menu_item_target,
			'menu-item-classes' => $_menu_item_classes,
			'menu-item-xfn' => $_menu_item_xfn,
			'menu-item-status' => $item['status']
		);

		$id = wp_update_nav_menu_item( $menu_id, 0, $args );
		if ( $id && ! is_wp_error( $id ) )
			$this->processed_menu_items[intval($item['post_id'])] = (int) $id;
	}

	/**
	 * Import and processes each attachment
	 *
	 * @param object $post
	 * @param array $fullsizes
 	 * @param array $thumbs
	 * @return void
	 */
	function process_attachment( $post, $attachments ) {
		
		if ( empty( $attachments ) )
			return;

		foreach ( $attachments as $a_type => $a_objs) {
			if ($a_type == 'thumb') continue;
			
			foreach ( $a_objs as $id => $fullsize ) {
				if( $this->is_user_over_quota() )
					return false;
				
				if ($a_type == 'fullsizes' && count($attachments['thumb']) > 0 && isset($attachments['thumb'][$id])) {
					$thumb = $attachments['thumbs'][$id];
				}
				// Skip duplicates
				if ( isset( $this->attachments[$fullsize] ) ) {
					$post_id = $this->attachments[$fullsize];
					printf( "<em>%s</em><br />\n", __( 'Skipping duplicate' ) . ' ' . $fullsize );
					// Get new attachment URL
					$attachment_url = wp_get_attachment_url( $post_id );
	
					// Update url_remap array
					$this->url_remap[$fullsize] = $attachment_url;
					if ($a_type == 'fullsizes' && count($attachments['thumb']) > 0 && isset($attachments['thumb'][$id])) {
						$sized = image_downsize( $post_id, 'medium' );
						if ( isset( $sized[0] ) ) {
							$this->url_remap[$thumb] = $sized[0];
						}
					}
	
					continue;
				}
	
				echo '<em>Importing attachment ' . htmlspecialchars( $fullsize ) . "...</em>";
				$upload = $this->fetch_remote_file( $fullsize, $post );
				
				if ( is_wp_error( $upload ) ) {
					printf( "<em>%s</em><br />\n", __( 'Remote file error:' ) . ' ' . htmlspecialchars( $upload->get_error_message() ) );
					continue;
				} else {
					printf( "<em> (%s)</em><br />\n", size_format( filesize( $upload['file'] ) ) );
				}
	
				if ( 0 == filesize( $upload['file'] ) ) {
					print __( "Zero length file, deleting..." ) . "<br />\n";
					@unlink( $upload['file'] );
					continue;
				}
	
				$info = wp_check_filetype( $upload['file'] );
				if ( false === $info['ext'] ) {
					printf( "<em>%s</em><br />\n", $upload['file'] . __( 'has an invalid file type') );
					@unlink( $upload['file'] );
					continue;
				}
	
				// as per wp-admin/includes/upload.php
				$attachment = array ( 
					'post_title' => $post->post_title, 
					'post_content' => '', 
					'post_status' => 'inherit', 
					'guid' => $upload['url'], 
					'post_mime_type' => $info['type'],
					'post_author' => $post->post_author,
					);
		
				$post_id = (int) wp_insert_attachment( $attachment, $upload['file'], $post->ID );
				$attachment_meta = @wp_generate_attachment_metadata( $post_id, $upload['file'] );
				wp_update_attachment_metadata( $post_id, $attachment_meta );						
	
				// Add remote_url to post_meta
				add_post_meta( $post_id, 'posterous_attachment', $fullsize, true );
				// Add remote_url to hash table
				$this->attachments[$fullsize] = $post_id;
				
				// Get new attachment URL
				$attachment_url = wp_get_attachment_url( $post_id );
				// Update url_remap array
				$this->url_remap[$fullsize] = $attachment_url;
				if ($a_type == 'audio') {
					add_post_meta( $post->ID, 'posterous_audio', $fullsize, true );
				}
				if ($a_type == 'fullsizes' && count($attachments['thumb']) > 0 && isset($attachments['thumb'][$id])) {
					$sized = image_downsize( $post_id, 'medium' );
					if ( isset( $sized[0] ) ) {
						$this->url_remap[$thumb] = $sized[0];
					}
				}
			}
		}
		
		$this->backfill_attachment_urls( $post );
	}

	/**
	 * Update url references in post bodies to point to the new local files
	 *
	 * @return void
	 */
	function backfill_attachment_urls( $post = false ) {
		if ( false === $post )
			return;

		// make sure we do the longest urls first, in case one is a substring of another
		uksort( $this->url_remap, array( &$this, 'cmpr_strlen') );

		$from_urls = array_keys( $this->url_remap );
		$to_urls = array_values( $this->url_remap );

		$hash_1 = md5( $post->post_content );
		
		if (preg_match('/class=["\']+p_embed p_audio_embed["\']+/', $post->post_content) > 0) {
			// haz audio embed
			$_aurl = get_post_meta( $post->ID, 'posterous_audio', true);
			if ($_aurl) {
				$post->post_content = preg_replace('/class=["\']p_embed p_audio_embed["\']>[\r|\n|\s|\r\n]*<a[\s]*href=["\']\S*["\']>/i', 'class="p_embed p_audio_embed"><a href="'.$_aurl.'">', $post->post_content);
			}
		}
		
		$post->post_content = str_replace( $from_urls, $to_urls, $post->post_content );
		$hash_2 = md5( $post->post_content );
		
		
		if ( $hash_1 !== $hash_2 )
			wp_update_post( $post );
	}
	
	/**
	 * Return array of images from the post
	 *
	 * @param string $post_content
	 * @return array
	 */
	function extract_post_media( $post_content, $post_id ) {
		$post_content = stripslashes( $post_content );
		$post_content = str_replace( "\n", '', $post_content );
		$post_content = $this->min_whitespace( $post_content );
		$attachments = array();
		$attachments['thumb'] = array();
		$attachments['fullsize'] = array();
		$attachments['single'] = array();
		$attachments['poster'] = array();
		$attachments['audiovideo'] = array();
		$attachments['audio'] = array();

		// Find all linked images
		$matches = array();
		preg_match_all( '|<a.*?href=[\'"](.*?)[\'"].*?><img.*?src=[\'"](.*?)[\'"].*?>|i', $post_content, $matches );
		foreach ( $matches[1] as $i => $url ) {
			if ( strstr( $url, 'posterous.com' ) && !in_array( $url, $attachments['thumb'] ) && !in_array( $url, $attachments['fullsize'] ) && !in_array( $url, $attachments['poster'] ) ) {
				$attachments['thumb'][$i] = $matches[2][$i];
				$attachments['fullsize'][$i] = $url;
			}
		}

		// Find all not linked images
		$matches = array();
		preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post_content, $matches );
		foreach ( $matches[1] as $i => $url ) {
			if ( strstr( $url, 'posterous.com' ) && !in_array( $url, $attachments['thumb'] ) && !in_array( $url, $attachments['fullsize'] ) && !in_array( $url, $attachments['poster'] ) ) {
				$attachments['single'][$i] = $url;
			}
		}
		$attachments['single'] = array_unique( $attachments['single'] );
		
		// Find all posters
		$matches = array();
		preg_match_all( '|<video.*?poster=[\'"](.*?)[\'"].*?>|i', $post_content, $matches );
		foreach ( $matches[1] as $i => $url ) {
			if ( strstr( $url, 'posterous.com' ) && !in_array( $url, $attachments['thumb'] ) && !in_array( $url, $attachments['fullsize'] ) && !in_array( $url, $attachments['poster'] ) ) {
				$attachments['poster'][$i] = $url;
			}
		}
		$attachments['poster'] = array_unique( $attachments['poster'] );

		// Find all linked mp3s and videos
		$matches = array();
		preg_match_all( '!(href|src)=(\'|")(http:\/\/[a-zA-Z0-9\-+%\&\?#\/\.]+\/[a-zA-Z]+\/[a-zA-Z]+\.posterous\.com\/[a-zA-Z0-9\-+%_&\?#\/\.]+\.(mp3|m4v|mp4|mov|avi|wmv|3gv|3g2))(\'|")!i', $post_content, $matches );
		if ( !empty( $matches[3] ) ) {
			foreach ( $matches[3] as $i => $url ) {
				$attachments['audiovideo'][$i] = $url;
			}
		}
		
		if (preg_match( '/p_audio_embed/', $post_content ) > 0 && get_option( 'posterous_username', 'none' ) != 'none') {
			// Fetch nasty/expensive audio URLs
			$_response = @$this->get_page("http://posterous.com/api/2/sites/{$this->posterous_site_id}/posts/{$post_id}/audio_files?api_token=egxAwFjyqEajvfqjDjmkgHvjdaGAsxhq", get_option( 'posterous_username' ), get_option( 'posterous_password' ));
			usleep( 1100000 ); 
		
			if (!is_wp_error($_response)) {
				$_audio_album = @json_decode($_response['body']);
				
				if (count($_audio_album) > 0) {
					foreach($_audio_album as $_audio) {
						$_apath = parse_url($_audio->url, PHP_URL_PATH);
						$_abasename = basename($_apath);
						$attachments['audio'][$_abasename] = $_audio->url;
					}
				}
			}
		}
		
		unset( $post_content, $matches );

		return $attachments;
	}

	/**
	 * Download remote file, keep track of URL map
	 *
	 * @param object $post
	 * @param string $url
	 * @return array
	 */
	function fetch_remote_file( $url, $post ) {
		global $switched, $switched_stack, $blog_id;
		
		if (count($switched_stack) == 1 && in_array($blog_id, $switched_stack))
			$switched = false;
			
		// Increase the timeout
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );

		// $parts = parse_url( $url );
		$filename = basename( $url );
		
		// get placeholder file in the upload dir with a unique sanitized filename
		$upload = wp_upload_bits( $filename, 0, '', $post->post_date );
		
		if ( $upload['error'] )
			return new WP_Error( 'upload_dir_error', $upload['error'] );

		// fetch the remote url and write it to the placeholder file
		$headers = wp_get_http( $url, $upload['file'] );

		// make sure the fetch was successful
		if ( $headers['response'] != '200' ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', sprintf( __( 'Remote file returned error response %d' ), intval( $headers['response'] ) ) );
		}

		// keep track of the old and new urls so we can substitute them later
		$this->url_remap[$url] = $upload['url'];
		// if the remote url is redirected somewhere else, keep track of the destination too
		if ( isset( $headers['x-final-location'] ) && $headers['x-final-location'] != $url )
			$this->url_remap[$headers['x-final-location']] = $upload['url'];

		return apply_filters( 'wp_handle_upload', $upload );
	}

	/**
	 * Attempt to associate posts and menu items with previously missing parents
	 *
	 * An imported post's parent may not have been imported when it was first created
	 * so try again. Similarly for child menu items and menu items which were missing
	 * the object (e.g. post) they represent in the menu
	 */
	function backfill_parents() {
		global $wpdb;

		// find parents for post orphans
		foreach ( $this->post_orphans as $child_id => $parent_id ) {
			$local_child_id = $local_parent_id = false;
			if ( isset( $this->processed_posts[$child_id] ) )
				$local_child_id = $this->processed_posts[$child_id];
			if ( isset( $this->processed_posts[$parent_id] ) )
				$local_parent_id = $this->processed_posts[$parent_id];

			if ( $local_child_id && $local_parent_id )
				$wpdb->update( $wpdb->posts, array( 'post_parent' => $local_parent_id ), array( 'ID' => $local_child_id ), '%d', '%d' );
		}

		// all other posts/terms are imported, retry menu items with missing associated object
		$missing_menu_items = $this->missing_menu_items;
		foreach ( $missing_menu_items as $item )
			$this->process_menu_item( $item );

		// find parents for menu item orphans
		foreach ( $this->menu_item_orphans as $child_id => $parent_id ) {
			$local_child_id = $local_parent_id = 0;
			if ( isset( $this->processed_menu_items[$child_id] ) )
				$local_child_id = $this->processed_menu_items[$child_id];
			if ( isset( $this->processed_menu_items[$parent_id] ) )
				$local_parent_id = $this->processed_menu_items[$parent_id];

			if ( $local_child_id && $local_parent_id )
				update_post_meta( $local_child_id, '_menu_item_menu_item_parent', (int) $local_parent_id );
		}
	}

	/**
	 * Update _thumbnail_id meta to new, imported attachment IDs
	 */
	function remap_featured_images() {
		// cycle through posts that have a featured image
		foreach ( $this->featured_images as $post_id => $value ) {
			if ( isset( $this->processed_posts[$value] ) ) {
				$new_id = $this->processed_posts[$value];
				// only update if there's a difference
				if ( $new_id != $value )
					update_post_meta( $post_id, '_thumbnail_id', $new_id );
			}
		}
	}

	/**
	 * Parse a WXR file
	 *
	 * @param string $file Path to WXR file for parsing
	 * @return array Information gathered from the WXR file
	 */
	function parse( $file ) {
		$parser = new WXR_Parser();
		return $parser->parse( $file );
	}

	// Display import page title
	function header() {
		echo '<div class="wrap">';
		screen_icon();
		echo '<h2>' . __( 'Import Posterous WXR', 'wordpress-importer' ) . '</h2>';
		
		echo '<div class="posterous-wrap">';
		$updates = get_plugin_updates();
		$basename = plugin_basename(__FILE__);
		if ( isset( $updates[$basename] ) ) {
			$update = $updates[$basename];
			echo '<div class="error"><p><strong>';
			printf( __( 'A new version of this importer is available. Please update to version %s to ensure compatibility with newer export files.', 'wordpress-importer' ), $update->update->new_version );
			echo '</strong></p></div>';
		}
	}

	// Close div.wrap
	function footer() {
		echo '</div></div>';
	}

	/**
	 * Display introductory text and file upload form
	 */
	function greet() {
		echo '<div class="narrow">';
		echo '<p>'.__( 'Howdy! Upload your WordPress eXtended RSS (WXR) file in the Posterous backup file and we&#8217;ll import the posts, pages, comments, custom fields, categories, and tags into this site.', 'wordpress-importer' ).'</p>';
		echo '<p>'.__( 'Choose a WXR (.xml) file to upload, then click Upload file and import.', 'wordpress-importer' ).'</p>';
		wp_import_upload_form( 'admin.php?import=posterous-wxr&amp;step=1' );
		echo '</div>';
	}

	/**
	 * Decide if the given meta key maps to information we will want to import
	 *
	 * @param string $key The meta key to check
	 * @return string|bool The key if we do want to import, false if not
	 */
	function is_valid_meta_key( $key ) {
		// skip attachment metadata since we'll regenerate it from scratch
		// skip _edit_lock as not relevant for import
		if ( in_array( $key, array( '_wp_attached_file', '_wp_attachment_metadata', '_edit_lock' ) ) )
			return false;
		return $key;
	}

	/**
	 * Decide whether or not the importer is allowed to create users.
	 * Default is true, can be filtered via import_allow_create_users
	 *
	 * @return bool True if creating users is allowed
	 */
	function allow_create_users() {
		return apply_filters( 'import_allow_create_users', true );
	}

	/**
	 * Decide whether or not the importer should attempt to download attachment files.
	 * Default is true, can be filtered via import_allow_fetch_attachments. The choice
	 * made at the import options screen must also be true, false here hides that checkbox.
	 *
	 * @return bool True if downloading attachments is allowed
	 */
	function allow_fetch_attachments() {
		return apply_filters( 'import_allow_fetch_attachments', true );
	}

	/**
	 * Decide what the maximum file size for downloaded attachments is.
	 * Default is 0 (unlimited), can be filtered via import_attachment_size_limit
	 *
	 * @return int Maximum attachment file size to import
	 */
	function max_attachment_size() {
		return apply_filters( 'import_attachment_size_limit', 0 );
	}

	/**
	 * Added to http_request_timeout filter to force timeout at 60 seconds during import
	 * @return int 60
	 */
	function bump_request_timeout() {
		if ($this->auth) {
			return 2;
		}
		return 60;
	}

	// return the difference in length between two strings
	function cmpr_strlen( $a, $b ) {
		return strlen($b) - strlen($a);
	}
}

} // class_exists( 'Posterous_WP_Importer' )

function posterous_wp_importer_init() {
	load_plugin_textdomain( 'posterous-wp-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	/**
	 * WordPress Importer object for registering the import callback
	 * @global WP_Import $wp_import
	 */
	$GLOBALS['posterous_wp_import'] = new Posterous_WP_Importer();
	register_importer( 'posterous-wxr', 'Posterous XML', __('Import <strong>posts, pages, comments, custom fields, categories, and tags</strong> from a WordPress export file from Posterous.com.', 'posterous-wp-importer'), array( $GLOBALS['posterous_wp_import'], 'dispatch' ) );
}
add_action( 'admin_init', 'posterous_wp_importer_init' );