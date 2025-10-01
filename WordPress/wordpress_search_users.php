<?php

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