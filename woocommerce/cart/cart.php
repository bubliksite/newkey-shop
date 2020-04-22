<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;?>

	<h1 class="pt-3 mt-5 font-weight-medium ubuntu-font"><?php echo the_title(); ?></h1>
</div>

<?php $totalsum = 0; ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<div class="row">
		<div class="col-lg-6">
			<?php do_action( 'woocommerce_before_cart' ); ?>
		</div>
		<div class="col-lg-6 actions px-0 d-flex justify-content-end">
			<button type="submit" class="button btn" name="update_cart" disabled value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
		</div>
	</div>

	<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents mx-2">
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>

					<div class="row border-bottom-dashed woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<div class="col-md-3 product-name d-flex align-items-center">
							<?php echo $_product->get_title(); ?>
						</div>
						<div class="col-md-2 col-6 product-razmer d-flex align-items-center">
							<?php echo $_product->get_attribute('razmer'); ?>
						</div>
						<div class="col-md-1 col-6 product-stal d-flex align-items-center">
							<?php echo "Сталь " . $_product->get_attribute('stal'); ?>
						</div>
						<div class="col-md-2 product-quantity d-flex align-items-center justify-content-center" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<a href="#0" class="add-remove align-items-center d-flex justify-content-center" id="minus<?php echo $_product->get_id(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/img/minus.png" alt="">
							</a>
							<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
										'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text', 'qty'.$_product->get_id() ), $product ),
									),
									$_product,
									false
								);
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>
							<a href="#0" class="add-remove align-items-center d-flex justify-content-center" id="plus<?php echo $_product->get_id(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/img/plus.png" alt="">
							</a>

							

						</div>
						<div class="col-md-2 product-remove d-flex align-items-center justify-content-center">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove d-flex align-items-center" aria-label="%s" data-product_id="%s" data-product_sku="%s" style="color: #fff;"><img src="' .  get_template_directory_uri() . '/img/delete.png" alt="">&nbsp;<span style="color: #ED0B0B;"> Удалить</span></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</div>
						<div class="col-md-2 product-subtotal d-flex align-items-center justify-content-end">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								$totalsum = $totalsum;
								
							?>
						</div>
					</div>

							<script>
								$(document).ready(function(){
									$('#plus<?php echo $_product->get_id(); ?>').click(function(){
										let currentQuant = $('.qty<?php echo $_product->get_id(); ?>').val();
										currentQuant++;
										$('.qty<?php echo $_product->get_id(); ?>').val('');
										$('.qty<?php echo $_product->get_id(); ?>').val(currentQuant);
										$('button.button').prop("disabled", false);
									});
									$('#minus<?php echo $_product->get_id(); ?>').click(function(){
										let currentQuant = $('.qty<?php echo $_product->get_id(); ?>').val();
										currentQuant--;
										if (currentQuant < 1) {currentQuant = 1};
										$('.qty<?php echo $_product->get_id(); ?>').val('');
										$('.qty<?php echo $_product->get_id(); ?>').val(currentQuant);
										$('button.button').prop("disabled", false);
									});
								});
							</script>


					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<div class="row sum">
				<div class="col-lg-6 d-flex justify-content-start">
					Итого
				</div>
				<div class="col-lg-6 d-flex justify-content-end total-sum">
					<?php echo WC()->cart->get_cart_subtotal(); ?>
				</div>
			</div>
			


			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals pb-3 px-4 d-flex justify-content-end align-items-center">
	<a href="/checkout" class="btn">Оформить заказ</a>
</div>


<?php do_action( 'woocommerce_after_cart' ); ?>

<style>
	#bg-in-footer {
		display: none;
	}
</style>


	<div class="container my-3 py-5">
			<p>
				© ООО «Ньюкей»<br>
				Запорная арматура из нержавеющей стали.
			</p>
		</div>
	</div>

