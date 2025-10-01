<!-- woocommerce loop -->
<?php
  // The tax query
  $tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'name',
    'terms'    => 'featured',
    'operator' => 'IN', // or 'NOT IN' to exclude feature products
  );
  // The query
  $args = array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'DESC',
    // 'tax_query'      => $tax_query, //only if using above tax query
    // 'product_cat'    => 'shoes',
    // 'product_tag' 	 => 'fashion',
  );
  $loop = new WP_Query( $args );
  if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) : $loop->the_post();
      ?>
      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card product-card shadow-card h-100">
          <a href="<?php echo get_permalink(); ?>"><img class="card-img-top" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="" /></a>
          <div class="card-body text-center d-nonex">
            <h6 class="card-title"><a href="<?php echo get_permalink(); ?>"><?php echo $product->get_title(); ?></a></h6>
            <div class="card-text">
              <h6>
                <?php
                // $regular_price = $product->get_regular_price();
                // $sale_price = $product->get_sale_price();
                $regular_price = wc_price( get_post_meta( get_the_ID(), '_regular_price', true ));
                $sale_price = wc_price( get_post_meta( get_the_ID(), '_sale_price', true ));
                if( $product->is_on_sale() ){ ?>
                  <strike class="text-muted"><?php echo $regular_price; ?></strike> <?php echo $sale_price; ?>
                <?php } else { ?>
                  <?php echo $regular_price; ?>
                <?php } ?>
              </h6>
            </div>
            <div class="add-to-cart">
              <?php
                echo sprintf( '<a href="%s" data-quantity="1" class="btn btn-primary btn-sm %s" %s>%s</a>',
                  esc_url( $product->add_to_cart_url() ),
                  esc_attr( implode( ' ', array_filter( array(
                    'button', 'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                  ) ) ) ),
                  wc_implode_html_attributes( array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                  ) ),
                  esc_html( $product->add_to_cart_text() )
                );
              ?>
            </div>
          </div>
        </div>
      </div>
      <?php
    endwhile;
  } else {
    echo __( 'No products found' );
  }
  wp_reset_postdata();
?>