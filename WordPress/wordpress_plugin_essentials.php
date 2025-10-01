<?php
/*
Plugin Name: Custom One-Page-Checkout
Plugin URI: http://www.hurrik.com/
Description: Custom created one page checkout for woocommerce.
Version: 0.1
Author: Amanz
Author URI: http://www.hurrik.com/
License: GPLv2 or later

*/


/**
 * Make sure we don't expose any info if called directly
 **/
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I am very shy to be called directly.';
	exit;
}

/*
* in every head
*/
add_action( 'wp_head', 'copc_facebook_tags' );
function copc_facebook_tags() {
  echo 'I am in the head section';
}

/*
* add styles
*/
add_action( 'wp_enqueue_scripts', 'copc_enqueued_assets' );
function copc_enqueued_assets() {
	wp_enqueue_style( 'copc-font', '//fonts.googleapis.com/css?family=Roboto' );
}

/*
* add scripts
*/
add_action( 'wp_enqueue_scripts', 'copc_enqueued_assets' );
function copc_enqueued_assets() {
	wp_enqueue_script( 'copc-script', plugin_dir_url( __FILE__ ) . '/js/copc-script.js', array( 'jquery' ), '1.0', true );
}

/*
* add admin menu entry
*/
add_action('admin_menu', 'copc_plugin_menu');
function copc_plugin_menu() {
	add_menu_page('One Page Checkout Settings', 'One Page Checkout', 'administrator', 'copc-plugin-settings', 'copc_plugin_settings_page', 'dashicons-admin-generic');
}

/*
* the page settings page
*/
function copc_plugin_settings_page() {
  // load the settings page
  include_once( 'copc-page-settings.php' );
}

/*
* add option to wpdb on activation
*/
register_activation_hook( __FILE__, 'copc_plugin_activation' );
function copc_plugin_activation() {
  add_option( 'copc_plugin_activated', time() );

	/* ADDITIONAL SECURITY ENABLED */
  if ( ! current_user_can( 'activate_plugins' ) ) {
  	return;
  }
  $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
  check_admin_referer( "activate-plugin_{$plugin}" );

}


/*
* Create Table and plugin db version
* create funciton to add data
*/
global $copc_db_version;
$copc_db_version = '1.0';
function copc_install() {
	global $wpdb;
	global $copc_db_version;

	$table_name = $wpdb->prefix . 'copc_data';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'copc_db_version', $copc_db_version );
}


function copc_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPres';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'copc_data';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}

register_activation_hook( __FILE__, 'copc_install' );
register_activation_hook( __FILE__, 'copc_install_data' );


/*
* Dependency Checks
*/
register_activation_hook( __FILE__, 'copc_plugin_activation' );
function copc_plugin_activation() {
	global $wp_version;

	$php = '5.3';
	$wp  = '4.0';

	/* Check php version	*/
	if ( version_compare( PHP_VERSION, $php, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'This plugin can not be activated because it requires a PHP version greater than %1$s. Your PHP version can be updated by your hosting company.', 'copc_plugin' ),
				$php
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'copc_plugin' ) . '</a>'
		);
	}

	/* Check wordpress version	*/
	if ( version_compare( $wp_version, $wp, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'This plugin can not be activated because it requires a WordPress version greater than %1$s. Please go to Dashboard &#9656; Updates to gran the latest version of WordPress .', 'copc_plugin' ),
				$php
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'copc_plugin' ) . '</a>'
		);
	}

	/* Check if WooCommerce is active	*/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		echo "Woocommerce plugin found!";
	} else {
		echo 'Woocommerce not found!';
	}	

}//end



/*
* on Deactivation of plugin
*/
register_deactivation_hook( __FILE__, 'my_plugin_deactivation' );
function my_plugin_deactivation() {
  // Deactivation rules here


	/* ADDITIONAL SECURITY ENABLED */
  if ( ! current_user_can( 'activate_plugins' ) ) {
  	return;
  }
  $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
  check_admin_referer( "deactivate-plugin_{$plugin}" );

}

/*
* on UNINSTALLATION of plugin
* USE uninstall.php FILE INSTEAD THIS!
* uninstall.php will be used if found 
*/
register_uninstall_hook( __FILE__, 'my_plugin_uninstall' );
function my_plugin_uninstall() {
  // Uninstallation stuff here
}