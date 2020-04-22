<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
	<?php $allStals = $product->get_attribute('stal'); ?>
	<?php $stals = explode(", ", $allStals); ?>
	<nav>
		<div class="nav nav-tabs pt-3 pb-4" id="stal-tab" role="tablist">
			<?php foreach ($stals as $stal ) : ?>
				<a style="position: relative;" class="nav-item nav-link <?php echo ($stal == 304) ? 'active' : ''; ?> mr-2" id="nav-<?php echo $stal; ?>-tab" data-toggle="tab" href="#nav-<?php echo $stal; ?>" role="tab" aria-controls="nav-<?php echo $stal; ?>" aria-selected="<?php echo ($stal == 304) ? 'true' : 'false' ?>">Сталь <?php echo $stal; ?></a>
			<?php endforeach ?>
		</div>
	</nav>

	<div class="tab-content" id="nav-tabContent">

	<?php foreach ($stals as $stal) : ?>

	<div class="tab-pane fade <?php echo ($stal == 304) ? 'show active' : '' ?>" id="nav-<?php echo $stal; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $stal; ?>-tab">

	<table cellspacing="0" class="woocommerce-grouped-product-list group_table" width="100%">
		<tbody>


			<tr class="dotted-spaced-bottom">
				<th id="column-size" class="text-green py-3">Размер</th>
				<th id="column-price" class="text-green">Цена</th>
				<th id="column-cart-have" class="text-center text-gray">Уже в корзине</th>
				<th id="column-quantity" class=""></th>
			</tr>

			<?php
			$quantites_required      = true;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters( 'woocommerce_grouped_product_columns', array(
				'quantity',
				'label',
				'price',
			), $product ); ?>



		<?	foreach ( $grouped_products as $grouped_product_child ) {
				if ($grouped_product_child->get_attribute('stal') == $stal) { //ПРИДУМАТЬ КАК ОРГАНИЗОВАТЬ ТУТ
					$post_object        = get_post( $grouped_product_child->get_id() );
					$quantites_required = true;
					$post               = $post_object; // WPCS: override ok.
					setup_postdata( $post );

					echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item dotted-spaced-bottom ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';
					?>
						<td class="column-td-size"><?php echo $grouped_product_child->get_attribute('razmer'); ?></td>
						<td><?php echo $grouped_product_child->get_price_html(); ?></td>

						<?
						$quantity_has = "&mdash;";
						foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
							if ($values['data']->get_id() == $grouped_product_child->get_id()) {
								$quantity_has = $values['quantity'];
							}
						}
						?>

						<td class="text-center"><?php echo $quantity_has; ?></td>

							<?php 
								ob_start();

								// if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
								// 	woocommerce_template_loop_add_to_cart();
								// } elseif ( $grouped_product_child->is_sold_individually() ) {
								// 	echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
								// } else {
									do_action( 'woocommerce_before_add_to_cart_quantity' );

									woocommerce_quantity_input( array(
										'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
										'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : 0, // WPCS: CSRF ok, input var okay, sanitization ok.
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
									) );

									do_action( 'woocommerce_after_add_to_cart_quantity' );
								// }

								$value = ob_get_clean();
								?>
									
								<?echo '<td class="d-flex woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">';?>
									<?php $product_id = $grouped_product_child->get_id(); ?>
									<a href="#0" class="add-remove" id="minus<?php echo $product_id; ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/img/minus.png" alt="" style="top: 50%;">
									</a>
								<?echo apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child );?>
									<a href="#0" class="add-remove" id="plus<?php echo $product_id; ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/img/plus.png" alt="">
									</a>
								<?echo '</td>';?>

								<script>
									$(document).ready(function(){
										$('input[name="quantity[<?php echo $product_id; ?>]"]').val(0);
										$('#plus<?php echo $product_id; ?>').click(function(){
											let currentQuant = $('input[name="quantity[<?php echo $product_id; ?>]"]').val();
											currentQuant++;
											$('input[name="quantity[<?php echo $product_id; ?>]"]').val('');
											$('input[name="quantity[<?php echo $product_id; ?>]"]').val(currentQuant);
										});
										$('#minus<?php echo $product_id; ?>').click(function(){
											let currentQuant = $('input[name="quantity[<?php echo $product_id; ?>]"]').val();
											currentQuant--;
											$('input[name="quantity[<?php echo $product_id; ?>]"]').val('');
											$('input[name="quantity[<?php echo $product_id; ?>]"]').val(currentQuant);
										});
									});
								</script>


					<?echo '</tr>';
				}
			}?>



			<?
			$post = $previous_post; // WPCS: override ok.
			setup_postdata( $post );
			?>
		</tbody>
	</table>

			</div>

			<?php endforeach ?>	

			</div>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />



		<div class="my-3 d-flex justify-content-end">
			<button type="submit" class="single_add_to_cart_button button alt btn col-lg-6 ajax_add_to_cart"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		</div>


</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
