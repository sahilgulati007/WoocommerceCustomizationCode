function is_product_in_same_cat($valid, $product_id, $quantity) {
    global $woocommerce;
    //if($woocommerce->cart->cart_contents_count == 0){ return true;}
    if($woocommerce->cart->cart_contents_count > 0){
        foreach($woocommerce->cart->get_cart() as $key => $val ) {
            $_product = $val['data'];
            if($product_id == $_product->id ) {
                $url = WC()->cart->get_cart_url();
                echo "<script>alert('Already In cart');</script>";

                wp_redirect($url);
                exit;
            }
        }
    }
    return $valid;
}
add_filter( 'woocommerce_add_to_cart_validation', 'is_product_in_same_cat',11,3);