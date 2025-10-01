<?php
// https://www.proy.info/woocommerce-allow-only-1-product-per-category/
// Allow only one(or pre-defined) product per category in the cart
// Alternatively, try plugin: https://wordpress.org/plugins/woo-cart-limit/
add_filter( 'woocommerce_add_to_cart_validation', 'allowed_quantity_per_category_in_the_cart', 10, 2 );
function allowed_quantity_per_category_in_the_cart( $passed, $product_id) {

    $max_num_products = 1;// change the maximum allowed in the cart
    $running_qty = 0;

    $restricted_product_cats = array();

    //Restrict particular category/categories by category slug
    $restricted_product_cats[] = 'events';
    //$restricted_product_cats[] = 'cat-slug-two';

    // Getting the current product category slugs in an array
    $product_cats_object = get_the_terms( $product_id, 'product_cat' );
    foreach($product_cats_object as $obj_prod_cat) $current_product_cats[]=$obj_prod_cat->slug;


    // Iterating through each cart item
    foreach (WC()->cart->get_cart() as $cart_item_key=>$cart_item ){

    	// Restrict $max_num_products from each category
        // if( has_term( $current_product_cats, 'product_cat', $cart_item['product_id'] )) {

        // Restrict $max_num_products from restricted product categories
        if( array_intersect($restricted_product_cats, $current_product_cats) && has_term( $restricted_product_cats, 'product_cat', $cart_item['product_id'] )) {

        	// count(selected category) quantity
            $running_qty += (int) $cart_item['quantity'];

            // More than allowed products in the cart is not allowed
            if( $running_qty >= $max_num_products ) {
                wc_add_notice( sprintf( 'You can only register %s '.($max_num_products>1?'people':'person').' at a time for events. If you need to register another person for this event, please complete the payment process first — then come back.',  $max_num_products ), 'error' );
                $passed = false; // don't add the new product to the cart
                // We stop the loop
                break;
          	}

        }
    }
    return $passed;
}