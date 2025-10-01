<?php
/**
 * Template part for displaying related posts under posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package undercustoms
 */
?>

<div class="related-posts">
  <h3 class="text-center">Check Similar Posts</h3>
  <div class="row mt-4 card-deckxxx">
    
    <?php

    /* RELATED POSTS BY TAGS */
    /*
    $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);
     
    if ($tags) {
      $tag_ids = array();
      foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
      $args=array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=>3, // Number of related posts to display.
        'caller_get_posts'=>1
      );
      //till here
      */

    /* RELATED POSTS BY CATEGORY */
    $orig_post = $post;
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
      $category_ids = array();
      foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

      $args=array(
      'category__in' => $category_ids,
      'post__not_in' => array($post->ID),
      'posts_per_page'=> 3, // Number of related posts to display.
      'caller_get_posts'=>1
      );
      // till here
       
      $my_query = new wp_query( $args ); 
      while( $my_query->have_posts() ) {
        $my_query->the_post();
        ?> 
        <div class="col-md-4 col-sm-6">
          <div class="card related-card text-center">
            <?php
            $post_img = "";
            if ( has_post_thumbnail() ) {
              $post_img = get_the_post_thumbnail_url($post->ID, 'large');
            }
            else {
              $post_img = get_template_directory_uri() .'/img/placeholder.jpg';
            }
            ?>
            <a href="<?php the_permalink(); ?>">
              <img class="card-img-top" src="<?php echo $post_img; ?>" alt="post image">
            </a>
            <div class="card-body">
              <h6 class="card-date entry-meta">
                <?php 
                  /* //post time */
                  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
                  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
                  }
                  $time_string = sprintf( $time_string,
                    esc_attr( get_the_date( 'c' ) ),
                    esc_html( get_the_date() ),
                    esc_attr( get_the_modified_date( 'c' ) ),
                    esc_html( get_the_modified_date() )
                  );
                  $posted_on = sprintf(
                    esc_html_x( ' %s', 'post date', 'undercustoms' ),
                    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
                  );
                  echo '<span class="posted-on">' . $time_string . '</span>';                          
                ?>
              </h6>
              <h5 class="card-title">
                <a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a>
              </h5>
              <div class="card-text text-justify">
                <?php the_excerpt(); ?>
              </div>
              <!-- <a class="more-link" href="<?php //the_permalink(); ?>" title="Read more">Read More</a> -->
            </div>
          </div>        
        </div>
      <? }
    }
    $post = $orig_post;
    wp_reset_query();
  ?>

  </div>
</div>