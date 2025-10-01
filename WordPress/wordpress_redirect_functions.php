<?php


// REDIRECTING BACK TO LOGIN PAGE
add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login
function my_front_end_login_fail( $username ) {
   // where did the post submission come from?
   $referrer = $_SERVER['HTTP_REFERER']; 
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );
      exit;
   }
}



// BLOCKING DASHBOARD FOR ALL NON-ADMINS
add_action( 'init', 'blockusers_init' );
function blockusers_init() {
	if ( is_admin() && ! current_user_can( 'administrator' ) &&! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}
}



//PERMA REDIRECT FROM ORIGINAL WP-LOGIN.PHP page
function custom_login_page() {
  $new_login_page_url = home_url( '/loginsignup/' ); // new login page
  global $pagenow;
  if( $pagenow == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($new_login_page_url);
    exit;
  }
}
if(!is_user_logged_in()){
  add_action('init','custom_login_page');
}
//lost pass link: https://www.duvora.com/agents/wp-login.php?action=lostpassword



/*
* SEARCH USERS IN WORDPRESS SEARCH
* Gets example.com?s=search
*
*
*/

$search_string = esc_attr( trim( get_query_var('s') ) );

$users = new WP_User_Query( array(
    'search'         => "*{$search_string}*",
    'search_columns' => array(
        'user_login',
        'user_nicename',
        'user_email',
        'user_url',
    ),
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key'     => 'first_name',
            'value'   => $search_string,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'last_name',
            'value'   => $search_string,
            'compare' => 'LIKE'
        )
    )
) );
$users_found = $users->get_results();

foreach ($users_found as $key => $suser) {
  echo $suser->ID;
  echo $suser->user_email;
  echo $suser->user_login;
}
?>