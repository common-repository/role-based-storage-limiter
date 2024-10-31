<?php

/**
 * @link              http://nowebsite.yet
 * @since             1.0.0
 * @package           Role_Based_Storage_Limiter
 *
 * @wordpress-plugin
 * Plugin Name:       Role Based Storage Limiter
 * Plugin URI:        http://nowebsite.yet
 * Description:       Sets a storage limit for each member based on their role.
 * Version:           1.0.0
 * Author:            Marc Luther Capulong
 * Author URI:        http://nowebsite.yet
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       role-based-storage-limiter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-role-based-storage-limiter-activator.php
 */
function activate_role_based_storage_limiter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-role-based-storage-limiter-activator.php';
	Role_Based_Storage_Limiter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-role-based-storage-limiter-deactivator.php
 */
function deactivate_role_based_storage_limiter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-role-based-storage-limiter-deactivator.php';
	Role_Based_Storage_Limiter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_role_based_storage_limiter' );
register_deactivation_hook( __FILE__, 'deactivate_role_based_storage_limiter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-role-based-storage-limiter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_role_based_storage_limiter() {

	$plugin = new Role_Based_Storage_Limiter();
	$plugin->run();

}
run_role_based_storage_limiter();
