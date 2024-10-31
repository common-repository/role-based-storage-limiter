<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://nowebsite.yet
 * @since      1.0.0
 *
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/public
 * @author     Marc Luther Capulong <mlccapulong@gmail.com>
 */
class Role_Based_Storage_Limiter_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Role_Based_Storage_Limiter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Role_Based_Storage_Limiter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/role-based-storage-limiter-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Role_Based_Storage_Limiter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Role_Based_Storage_Limiter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/role-based-storage-limiter-public.js', array( 'jquery' ), $this->version, false );

	}

	public function validate_user_storage_space( $file ) {

		$storage_limits = get_option( $this->plugin_name );

		$user_id = get_current_user_id();
		$user_data = get_userdata( $user_id );
		$user_roles = $user_data->roles;

		$user_limits = array();

		// If user has multiple roles
		foreach ( $user_roles as $role ) {
			array_push( $user_limits, $storage_limits[ $role ] );
		}

		if ( in_array( "unlimited", $user_limits ) )
			return $file;

		// Sorts the limits in ascending order
		sort( $user_limits );

		// returns the highest limit
		$size_limit = end( $user_limits );

		// Convert MB to Bytes
		$size_limit_bytes = $size_limit * pow( 1024, 2 );

		$used_storage_space = get_user_meta( $user_id, 'rbsl_used_storage_space', $single = true );
		$file_size = $file[ 'size' ];

		if ( ( $file_size + $used_storage_space ) > $size_limit_bytes ) {
			$storage_limit_reached = true;
		}
		else {
			$storage_limit_reached = false;
		}

		if ( $storage_limit_reached ) {
			$file['error'] = apply_filters( 'rbsl_sl_error_message', __( 'You\'ve reached the limit of', $this->plugin_name ) . ' ' . $size_limit . 'MB', $size_limit );
		}

		return $file;

	}

	public function add_user_storage_space( $attachment_id ) {
		$user_id = get_post( $attachment_id )->post_author;
		$used_storage_space = get_user_meta( $user_id, 'rbsl_used_storage_space', $single = true );
		$file_size = filesize( get_attached_file( $attachment_id ) );

		update_user_meta( $user_id, 'rbsl_used_storage_space', $used_storage_space + $file_size );

	}

	public function subtract_user_storage_space( $attachment_id ) {
		$user_id = get_post( $attachment_id )->post_author;
		$used_storage_space = get_user_meta( $user_id, 'rbsl_used_storage_space', $single = true );
		$file_size = filesize( get_attached_file( $attachment_id ) );

		update_user_meta( $user_id, 'rbsl_used_storage_space', $used_storage_space - $file_size );

	}

	public function bytesToSize($bytes, $precision = 2) {

	    $kilobyte = 1024;
	    $megabyte = $kilobyte * 1024;
	    $gigabyte = $megabyte * 1024;
	    $terabyte = $gigabyte * 1024;

	    if (($bytes >= 0) && ($bytes < $kilobyte)) {
	        return $bytes . ' B';

	    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
	        return round($bytes / $kilobyte, $precision) . ' KB';

	    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
	        return round($bytes / $megabyte, $precision) . ' MB';

	    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
	        return round($bytes / $gigabyte, $precision) . ' GB';

	    } elseif ($bytes >= $terabyte) {
	        return round($bytes / $terabyte, $precision) . ' TB';
	    } else {
	        return $bytes . ' B';
	    }

	}

}
