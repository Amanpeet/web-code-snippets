<?php

/**
 * Send email when user updates profile.
 * Excludes when admin makes changes.
 */
add_action( 'personal_options_update', 'notify_admin_on_update' );
add_action( 'edit_user_profile_update','notify_admin_on_update');
function notify_admin_on_update(){
  global $current_user;
  get_currentuserinfo();

  if (!current_user_can( 'administrator' )){// avoid sending if admin is updating users
    $to = 'admin@email.com';
    $subject = 'user updated profile';
    $message = "the user : " .$current_user->display_name . " has updated his profile with:\n";
    foreach($_POST as $key => $value){
      $message .= $key . ": ". $value ."\n";
    }
    wp_mail( $to, $subject, $message);
  }
}

/**
 * Hook just after the Triggers are registered.
 * REQUIRES NOTIFICATION PLUGIN
 */
add_action( 'notification/trigger/registered', function( $trigger ) {

  // Check if registered Trigger is the one we need.
  if ( $trigger->get_slug() != 'wordpress/user_profile_updated' ) {
    return;
  }

  $trigger->add_merge_tag( new BracketSpace\Notification\Defaults\MergeTag\StringTag( array(
    'slug'        => 'custom_um_account_status',
    'name'        => __( 'UM Account Status', 'textdomain' ),
    'resolver'    => function( $trigger ) {
      return get_user_meta( $trigger->user_object->ID, 'account_status', true );
    },
  ) ) );

} );
