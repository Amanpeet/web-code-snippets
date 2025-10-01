
<?php
/**
 * Add theme support for woocommerce
 */
function undercustoms_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'undercustoms_add_woocommerce_support' );
?>

<!-- woocommerce price -->
<?php echo wc_price( get_post_meta( get_the_ID(), '_price', true ) ); ?>



<?php
  // woocommerce products loop with stock
  $args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'meta_query' => array( array(
        'key' => '_stock_status',
        'value' => 'outofstock',
        //'value' => 'instock',
        'compare' => '=',
      )),
    );
  $loop = new WP_Query( $args );
  if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) : $loop->the_post();
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );
      ?>
        <a href="<?php echo get_permalink($loop->post->ID); ?>"> <img class="img-responsive" src="<?php echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>" alt=""> </a>
        <h4> <?php echo get_the_title(); ?> </h4>
      <?php
    endwhile;
  } else {
    echo __( 'No products found' );
  }
  wp_reset_postdata();
?>

<?php
  // The tax query for featured products
  // $tax_query[] = array(
  //     'taxonomy' => 'product_visibility',
  //     'field'    => 'name',
  //     'terms'    => 'featured',
  //     'operator' => 'IN', // or 'NOT IN' to exclude feature products
  // );
  // // The query
  // $query = new WP_Query( array(
  //     'post_type'           => 'product',
  //     'post_status'         => 'publish',
  //     'ignore_sticky_posts' => 1,
  //     'posts_per_page'      => $products,
  //     'orderby'             => $orderby,
  //     'order'               => $order == 'asc' ? 'asc' : 'desc',
  //     'tax_query'           => $tax_query // <===
  // ) );

  $args = array(
    'post_type'      => 'product',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'product_cat'    => 'men',
  );
  $loop = new WP_Query($args);
  if ($loop->have_posts()) {
    while ($loop->have_posts()) : $loop->the_post();
      wc_get_template_part( 'content', 'loop-product' ); //woocommerce/content-loop-product.php
    endwhile;
  } else {
    echo __('No products found');
  }
  wp_reset_postdata();
?>


