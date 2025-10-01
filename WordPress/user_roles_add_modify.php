<?php

/*
*	DIGIPOST user role created.
* NO NEED TO RUN FUNCTION AGAIN EVER.
*/
function add_roles_on_plugin_activation() {
  add_role( 'digipost', 'Digipost', array( 'read' => true, 'edit_posts' => true, 'delete_posts' => false, ) );
}
add_action( 'init', 'add_roles_on_plugin_activation' );


/*
* ADD CAPABILTIES TO DIGIPOST USER ROLE
* This only works, because it accesses the class instance. would allow the author to edit others' posts for current theme only
* NO NEED TO RUN FUNCTION AGAIN EVER.
*/
function add_theme_caps() {
    $role = get_role( 'digipost' );

    $role->add_cap( 'delete_posts' ); 
    $role->add_cap( 'delete_published_posts' ); 
    $role->add_cap( 'edit_posts' ); 
    $role->add_cap( 'edit_published_posts' ); 
    $role->add_cap( 'publish_posts' ); 
    $role->add_cap( 'edit_others_posts' ); 
    $role->add_cap( 'read' ); 
}
add_action( 'init', 'add_theme_caps');

?>