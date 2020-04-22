<?php  

/** Поддержка Woocommerce **/
add_theme_support( 'woocommerce' );

/** Перечень стилей и скриптов **/
function load_style_script () {
	wp_enqueue_style('bootstrap.min', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');

	wp_enqueue_script('jquery-3.3.1', '//code.jquery.com/jquery-3.3.1.js');
	wp_enqueue_script('popper.min', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
	wp_enqueue_script('bootstrap.min', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
	wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
}

/** Загрузка стилей и скриптов **/
add_action('wp_enqueue_scripts', 'load_style_script');

/** отключаем хуки из woocommerce **/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

/* Меняем сообщения woocommerce */
add_filter( 'wc_add_to_cart_message_html', 'bbloomer_custom_add_to_cart_message' );
function bbloomer_custom_add_to_cart_message() {
	$message = 'Товар добавлен в корзину! <br> <a class="text-green" href="/cart">Перейтик оформлению</a>' ; 
	return $message;
}

/** Отключаем визуальный редактор **/
function remove_editor() {
  remove_post_type_support('page', 'editor');
}
add_action('admin_init', 'remove_editor');

/* Включаем галлереи */
add_theme_support( 'wc-product-gallery-lightbox' ); //для включения лайтбокса
add_theme_support( 'wc-product-gallery-slider' ); //для включения слайдера
add_theme_support( 'wc-product-gallery-zoom' ); //для включения масштабирования

/* Выключаем оплату */
add_filter( 'woocommerce_cart_needs_payment', '__return_false' );


/* Убираем "Выбрать опцию" */
add_filter('woocommerce_dropdown_variation_attribute_options_args','my_variation_attribute_options_args',10,1);
function my_variation_attribute_options_args($args){
 $args['show_option_none'] = 'Выбрать';
 return $args;
}

/* Проверка наличия товаров в корзине */
function is_product_in_cart() {
    foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
        $cart_product = $values['data'];

        if( get_the_ID() == $cart_product->id ) {
            return true;
        }
    }

    return false;
}


add_filter('wc_add_to_cart_message', 'handler_function_name', 10, 2);
function handler_function_name($message, $product_id) {
    return "Thank you for adding product" . $product_id;
}


?>


