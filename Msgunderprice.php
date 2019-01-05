function sv_change_product_price_cart( $price, $cart_item, $cart_item_key ) {
    global $cart_msg_custom;
    $price .= '<p>Discounted price</p>';

    return $price;
}