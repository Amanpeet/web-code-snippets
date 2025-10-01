<?php



// PREVENT WP-LOGIN PAGE but allow pass reset
function custom_login_page() {
  $new_login_page_url = home_url( '/loginsignup/' ); // new login page
  global $pagenow;
  if( $pagenow == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
				if( $_GET['action']=="logout" || $_GET['action']=="lostpassword" || $_GET['action']=="rp" ){
					//nothing
				} else {
			    wp_redirect($new_login_page_url);
			    exit; 
				}
  }
}
if(!is_user_logged_in()){
  add_action('init','custom_login_page');
}


?>