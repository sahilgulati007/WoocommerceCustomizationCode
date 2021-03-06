add_action( 'wp_footer', 'bbloomer_cart_refresh_update_qty' ); 
 
function bbloomer_cart_refresh_update_qty() { 
    if (is_cart()) { 
        ?> 
        <script type="text/javascript"> 
            jQuery('div.woocommerce').on('change', 'input.qty', function(){ 
//                alert('in');
                jQuery("[name='update_cart']").delay(1000).removeAttr('disabled'); 
                jQuery("[name='update_cart']").delay(1500).trigger("click"); 
            }); 
            jQuery('div.woocommerce').on('click', 'button.plus', function(){ 
//                alert('in2');
//                jQuery("[name='update_cart']").delay(1000).removeAttr('disabled'); 
//                jQuery("[name='update_cart']").delay(1500).click(); 
            }); 
            jQuery('div.woocommerce').on('click', 'button.minus', function(){ 
//                alert('in3');
//                jQuery("[name='update_cart']").delay(1000).trigger("click"); 
            }); 
        </script> 
        <?php 
    } 
}


add_action( 'woocommerce_before_calculate_totals', 'cart_recalculate_price' );

function cart_recalculate_price( $cart_object ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    $newprice = 0;
    foreach ( $cart_object->get_cart() as $hash => $value ) {
        $quantity = 0;
        foreach ( $cart_object->get_cart() as $hash1 => $value1 ) {
            if($value['product_id'] == $value1['product_id']) {
                $quantity += $value1['quantity'];
            }
        }

        if( $quantity >= 150 ) {
            $newprice = $value['data']->get_regular_price() - ($value['data']->get_regular_price()*20/100);
        }
        else if($quantity >= 100)
        {
            $newprice = $value['data']->get_regular_price() - ($value['data']->get_regular_price()*15/100);
        }
        else if($quantity >= 50)
        {
            $newprice = $value['data']->get_regular_price() - ($value['data']->get_regular_price()*10/100);
        }
        else if($quantity >= 20)
        {
            $newprice = $value['data']->get_regular_price() - ($value['data']->get_regular_price()*5/100);
        }
        else {
            $newprice = $value['data']->get_regular_price();
        }

        //$value['data']->set_regular_price($value['data']->get_regular_price());
        $value['data']->set_price($newprice);
        //$value['data']->set_sale_price($newprice);
    }

}