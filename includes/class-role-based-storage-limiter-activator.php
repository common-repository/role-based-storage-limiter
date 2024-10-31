<?php

/**
 * Fired during plugin activation
 *
 * @link       http://nowebsite.yet
 * @since      1.0.0
 *
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/includes
 * @author     Marc Luther Capulong <mlccapulong@gmail.com>
 */
class Role_Based_Storage_Limiter_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Updates old meta
		foreach ( get_users() as $user ) {
			update_user_meta( $user->ID, 'rbsl_used_storage_space', 0 );
		}

		// Get all attachments
		$attachments = get_posts(array('post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' => 'any', 'post_parent' => null));

		// Update user meta data
		foreach ( $attachments as $attachment ) {
			$file_size = filesize( get_attached_file( $attachment->ID ) );
			$used_storage_space = get_user_meta( $attachment->post_author, 'rbsl_used_storage_space', $single = true );

			if ( !$used_storage_space )
				$used_storage_space = $file_size;
			else
				$used_storage_space += $file_size;

			update_user_meta( $attachment->post_author, 'rbsl_used_storage_space', $used_storage_space );
		}

		// Set default options
		$default = array();
		foreach( wp_roles()->roles as $role_key => $role ) {
			$default[ $role_key ] = 'unlimited';
		}
	    update_option( 'role_based_storage_limiter', $default );
	}

}
