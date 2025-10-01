RUN IT IN FUNCTIONS.PHP ONLY ONCE

<?php

/**
 * PRIVATE POSTS VISIBLE TO SUBSCRIBERS
 *  RUN ONCE
 *	if Executed, no need to run again
 */

function be_private_posts_subscribers() {
  $subRole = get_role( 'subscriber' );
	 $subRole->add_cap( 'read_private_posts' );
}
add_action( 'init', 'be_private_posts_subscribers' );