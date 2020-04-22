$(document).ready(function(){
	$('button.navbar-toggler').click(function(){
		$('#phones').toggle();
	});

	$('#singleProductCarouselImages').carousel({
		interval: false
	});

	$('select').change(function() {
		let currentQuant = $('.qty').val();
		$('.qty').val('');
		$('.qty').val(1);
	});
	
	$('#plus').click(function(){
		let currentQuant = $('.qty').val();
		currentQuant++;
		$('.qty').val('');
		$('.qty').val(currentQuant);
		let currentPrice = $('#hidden-price').find('span.amount').text();
		currentPrice = currentPrice.replace(/ /g, '');
		currentPrice = parseInt(currentPrice);
		let newPrice = number_format(currentQuant * currentPrice, 0, ',', ' ');
		$('.woocommerce-variation-price').find('span.amount').text(newPrice + ' ₽');
	});
	$('#minus').click(function(){
		let currentQuant = $('.qty').val();
		currentQuant--;
		if (currentQuant < 1) {currentQuant = 1};
		$('.qty').val('');
		$('.qty').val(currentQuant);
		let currentPrice = $('#hidden-price').find('span.amount').text();
		currentPrice = currentPrice.replace(/ /g, '');
		currentPrice = parseInt(currentPrice);
		let newPrice = number_format(currentQuant * currentPrice, 0, ',', ' ');
		$('.woocommerce-variation-price').find('span.amount').text(newPrice + ' ₽');
	});
	
	function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
	}

	$('.ttt-pnwc-message br').after('<div class="row"><div class="col-lg-7"><button class="message-to-cart-white btn text-green border-green white-background px-3" aria-label="Close modal" data-micromodal-close>Продолжить покупки</button></div><div class="col-lg-5"><a href="/cart" class="message-to-cart-green btn">Оформить</a></div></div>');
})