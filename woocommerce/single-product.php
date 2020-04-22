<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>


		<?php while ( have_posts() ) : the_post(); ?>

			<p class="mt-3 mb-0 mx-4" style="display: block;"><a class="text-green" href="<?php echo get_home_url(); ?>/#assortiment">&nbsp;Каталог</a> / <?php echo the_title(); ?></p>

			
			<h1 class="pt-3 mx-4 font-weight-medium ubuntu-font"><?php echo the_title(); ?></h1>
			</div>
			
			<div class="container mt-3">
				<div class="mx-4 white-background mx-mobile-0">
					<div class="row m-3">
						<div class="col-md-6 mt-3">
							<?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>
							
							<div id="singleProductCarouselImages" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">

								<?php $index = 0; ?>
								<?php foreach ($attachment_ids as $attachment_id) : ?>

								<?php $urlOfImage = wp_get_attachment_url($attachment_id); ?>
								<?php ($index == 0) ? $active = 'active' : $active = ''; ?>

									<div class="carousel-item <?php echo $active ?>">
										<img src="<?php echo $urlOfImage; ?>" class="d-block w-100" alt="">
									</div>

								<?php $index++; ?>
								<?php endforeach ?>

								</div>
								<ol class="carousel-indicators my-4">

								<?php $index = 0; ?>
								<?php foreach ($attachment_ids as $attachment_id) : ?>
								<?php $urlOfImage = wp_get_attachment_url($attachment_id); ?>
								<?php ($index == 0) ? $active = 'active' : $active = ''; ?>
								
									<li data-target="#singleProductCarouselImages" data-slide-to="<?php echo $index ?>" class="<?php echo $active ?> text-center">
										<img src="<?php echo $urlOfImage; ?>" class="d-block w-100" alt="">
										<p class="mt-2"><?php echo get_the_title($attachment_id); ?></p>
									</li>
									

								<?php $index++; ?>
								<?php endforeach ?>

								</ol>
							</div>
							<div class="row">
								<div class="col-lg-8">
									<?php if (count($product->get_attributes()) > 2) : ?>
										<div class="attributes dotted-spaced-top py-2 mb-3">
											<p class="font-weight-bold font-size-18 my-2">Размеры на схеме</p>
											<?php echo $product->list_attributes(); ?>
										</div>
									<?php endif ?>
								</div>
							</div>
							
							
						</div>
						<div class="col-md-6">
							<?php  wc_get_template_part( 'content', 'single-product' ); ?>
						</div>
					</div>
				</div>
			</div>


			

		<?php endwhile; // end of the loop. ?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
