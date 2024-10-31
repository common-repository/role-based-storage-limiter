<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://nowebsite.yet
 * @since      1.0.0
 *
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
    if ( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have the permission the access this page.' ) );
    }
?>

<div id="rbsl" class="wrap">

    <?php $options = get_option( $this->plugin_name ); ?>

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <div class="update-nag">
        <h3>Instructions:</h3>
        <ul>
            <li>Please enter a numeric value or the word "<b>unlimited</b>" for unlimited storage.</li>
            <li>Sizes are in Megabyte (MB).</li>
            <li>Do not include "<b>MB</b>".</li>
        </ul>
    </div>

    <form method="post" name="limiter_options" action="options.php">

        <?php settings_fields( $this->plugin_name ); ?>

        <table class="form-table">

            <?php foreach( wp_roles()->roles as $role_key => $role ) : ?>

                <tr valign="top">
                    <th scope="row">
                        <label for="<?php echo $this->plugin_name . '-' . $role_key; ?>"><?php echo $role[ 'name' ]; ?></label>
                    </th>
                    <td>
                        <input type="text" id="<?php echo $this->plugin_name . '-' . $role_key; ?>" name="<?php echo $this->plugin_name . '[' . $role_key . ']'; ?>" value="<?php echo $options[ $role_key ] ?>">
                        <p class="description">
                            Maximum allowed storage space <b>(in MB)</b> for users with <b><?php echo $role[ 'name' ]; ?></b> role.
                        </p>
                    </td>
                </tr>

            <?php endforeach; ?>

        </table>

        <?php submit_button('Save Changes', 'primary','submit', TRUE); ?>

    </form>

</div>