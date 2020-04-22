 <?php get_header(); ?>


		<h1 class="pt-3 mt-4 font-weight-medium ubuntu-font">Запорная арматура <br><span>из нержавеющей стали</span></h1>
		<h5 class="roboto-font font-weight-light">Новая поставка. Широкий ассортимент. Все позиции в наличии.</h5>
	</div>
	<div class="container mt-5 pt-5">
		<h2 class="text-green font-weight-medium ubuntu-font" id="assortiment">Каталог</h2>
		<div class="row mt-3">
		<?php
		    $loop = new WP_Query (array(
		    	'post_type' => 'product',
		    	'posts_per_page' => 260,
		    	'orderby'=> 'ID',
		    	'order' => 'asc'
		    ));
		?>
		    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
		    <?php if ($product->product_type == 'grouped') : ?>
			<a class="no-link" href="<?php echo get_permalink(); ?>">
		    	<div class="col-lg-4">
					<div class="card mb-4">
						<div class="card-body">
							<h5 class="card-title font-weight-medium ubuntu-font" style="height: 58px;"><?php echo the_title(); ?></h5>
							<img src="<?php echo the_post_thumbnail_url(); ?>" class="rounded mx-auto d-block" alt="<?php echo $catalogue[$i]->title; ?>">
							<hr>
							<div class="row">
								<div class="col-6 font-weight-bold ubuntu-font">
									Сталь: <br>
									Размеры: <br>
									Цена: <br>
								</div>
								<div class="col-6">
									
									<?php global $product; ?>
									
									<?php echo $product->get_attribute('stal'); ?><br>

									<?php $razmery = $product->get_attribute('razmer'); ?> 
									<?php $minRazmer = substr($razmery, strpos($razmery, "(", 1)+1, strpos($razmery, ")", 1)-strpos($razmery, "(", 1)-1); ?>
									<?php $maxRazmer = substr($razmery, strrpos($razmery, "(", -1)+1, strrpos($razmery, ")", 1)-strrpos($razmery, "(", -1)-1); ?>
									от <?php echo $minRazmer ?> до <?php echo $maxRazmer ?> <br>

									от <?php echo $product->get_price(); ?> ₽<br>
								</div>
							</div>
							<a href="<?php echo get_permalink(); ?>" class="btn green-background text-white mt-3">Купить</a>
						</div>
					</div>
				</div>
			</a>
			<?php else : ?>

			<?php endif ?>
		    <?php endwhile ?>


			<?php for ($i = 0; $i < count($catalogue); $i++) : ?>
			<div class="col-lg-4">
				<div class="card mb-4">
					<div class="card-body">
						<h5 class="card-title font-weight-medium ubuntu-font"><?php echo $catalogue[$i]->title; ?></h5>
						<img src="img/armatura/<?php echo $catalogue[$i]->image; ?>" class="rounded mx-auto d-block" alt="<?php echo $catalogue[$i]->title; ?>">
						<hr>
						<div class="row">
							<div class="col-6 font-weight-bold ubuntu-font">
								Сталь: <br>
								Размеры: <br>
								Цена: <br>
							</div>
							<div class="col-6">
								<?php echo $catalogue[$i]->titleSteel; ?> <br>
								<?php echo $catalogue[$i]->titleSize; ?> <br>
								<?php echo $catalogue[$i]->titlePrice; ?> ₽<br>
							</div>
						</div>
						<a href="#" class="btn green-background text-white mt-3" data-toggle="modal" data-target="#modal<?php echo $i; ?>">Подробнее</a>
					</div>
				</div>
			</div>
			<?php endfor ?>
		</div>
	</div>
</div>
<div class="background-map">
	<div class="map">
	<script type="text/javascript" charset="utf-8" async src="//api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A017403bcd6c3e30b4289336fceec3086ca05e6bffa4ca24f0e5a0d29d493bc88&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
	</div>
	<div class="container my-3 py-3">
		<h2 class="font-weight-medium ubuntu-font" id="kontakty">Контакты</h2>
		<div class="row">
			<div class="col-lg-4 green-transparent-background my-3 mx-3">
				<p class="open-sans-font font-weight-regular mx-4 mt-5 mb-3 text-white">
					198097, Санкт-Петербург,<br>
					Трефолева ул, д. 2, литер БН,<br>
					офис 334
				</p>
				<h6 class="ubuntu-font font-weight-bold mx-4 mb-5 mt-3 text-white">
					+7 (812) 449-00-76 <br>
					+7 (812) 449-00-78
				</h6>
			</div>
		</div>
	</div>
</div>


 <?php get_footer(); ?>