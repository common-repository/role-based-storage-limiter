<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://nowebsite.yet
 * @since      1.0.0
 *
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/includes
 * @author     Marc Luther Capulong <mlccapulong@gmail.com>
 */
class Role_Based_Storage_Limiter_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Delete all user's meta data
		foreach ( get_users() as $user ) {
			delete_user_meta( $user->ID, 'rbsl_used_storage_space' );
		}

		delete_option( 'role_based_storage_limiter' );
	}

}
