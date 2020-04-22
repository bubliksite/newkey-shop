<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link type="text/plain" rel="author" href="//newkey.ru/humans.txt" />

    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/ico.png">

    <link href="//fonts.googleapis.com/css?family=Open+Sans|Roboto:300|Ubuntu:300,500,700&display=swap&subset=cyrillic" rel="stylesheet">

    <title><?php bloginfo('name'); wp_title(); ?></title>

	<?php wp_head(); ?>
</head>
<body class="light-gray-background">
	<div class="container">
		<nav class="navbar navbar-expand-lg mt-3 px-0">
			<a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/newkey_logo.svg" alt="Логотип" id="logo" class="navbar-brand"></a>

		<?php $phones = 
		'<ul class="list-unstyled mb-0" style="line-height: 1.2rem;">
			<li>
				<span class="font-weight-bold">+7 (812) 449-00-76</span><br>
				<span class="font-weight-bold">+7 (812) 449-00-78</span><br>
				<span><a href="mailto: info@newkey.ru" class="text-green">info@newkey.ru</a></span>
			</li>
		</ul>'
		 ?>

		<li class="nav-item mx-3 text-center mobile-on" id="cartInHeader">
			<a href="/cart" class="text-decoration-none">
				<img src="<?php echo get_template_directory_uri(); ?>/img/cart.svg" alt=""><span class="text-red font-weight-bold ml-1"><?php echo WC()->cart->cart_contents_count; ?></span>
				<p class="font-size-16 text-black mobile-off">(<?php echo WC()->cart->get_cart_total(); ?>)</p>
			</a>
		</li>

		<div class="mobile-off">
			<?php echo $phones; ?>
		</div>
		
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"><img src="<?php echo get_template_directory_uri(); ?>/img/menu.png" style="height: 40px; margin-top: -10px;" alt=""></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarContent">
				<ul class="navbar-nav ml-auto text-green ubuntu-font font-weight-light font-size-16">
					<li class="nav-item mx-3">
						<a class="nav-link" href="<?php echo get_home_url(); ?>/#assortiment">Каталог</a>
					</li>
					<li class="nav-item mx-3">
						<a class="nav-link" href="<?php echo get_home_url(); ?>/#kontakty">Контакты</a>
					</li>
					<li class="nav-item mx-3 ">
						<a class="nav-link text-green rounded border-green white-background px-3" href="<?php echo get_home_url(); ?>/#feedback">Отправить заявку</a>
					</li>
					<li class="nav-item mx-3 text-center mobile-off">
						<a href="/cart" class="text-decoration-none">
							<img src="<?php echo get_template_directory_uri(); ?>/img/cart.svg" alt=""><span class="text-red font-weight-bold ml-1"><?php echo WC()->cart->cart_contents_count; ?></span>
							<p class="font-size-16 text-black">(<?php echo WC()->cart->get_cart_total(); ?>)</p>
						</a>
					</li>
				</ul>
			</div>
			
		</nav>
		<div class="mobile-on" id="phones">
			<?php echo $phones; ?>
		</div>
	</div>
<div class="background-image">
	<div class="container">