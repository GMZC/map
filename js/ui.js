/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
	$(window).on('scroll', function() {
		if ($(this).scrollTop() > 120) {
			$('.site-branding').addClass('sticky');
		} else {
			$('.site-branding').removeClass('sticky');
		}
	});

	$(document).on('change', '.variation-radios input', function() {
		$('select[name="' + $(this).attr('name') + '"]')
			.val($(this).val())
			.trigger('change');
	});

	var windowSize = $(window).width();
	console.log(windowSize);

	var cartLink = 'ul#site-header-cart.site-header-cart li a.cart-contents';
	var cartHeader = 'ul#site-header-cart.site-header-cart';
	$(document).on('click', cartLink, function(e) {
		// OK marche
		e.preventDefault();
		$(cartHeader)
			.find('.widget')
			.toggleClass('is-active');
	});

	var menuToggle = $('.hamburger');
	menuToggle.click(function() {
		$(this).toggleClass('is-active');
	});

	var labels = $('.variation-radios label');

	labels.click(function() {
		$(this)
			.parent()
			.find(labels)
			.removeAttr('checked');
		$(this).attr('checked', 'checked');
	});

	$('a.reset_variations').click(function() {
		labels.removeAttr('checked');
	});

	$('select').blur(function() {
		var variationId = $('input.variation_id').val();
		console.log('variation : ' + variationId);
	});

	var isAGift = function(itemId) {
		return itemId == 2212 || itemId == 2214 || itemId == 2220 || itemId == 2222;
	};

	var isEmptyCart = function() {
		return $('li.woocommerce-mini-cart-item.mini_cart_item').length === 0;
	};

	var subscriptionAlreadyInCart = function() {
		var cart = $('li.woocommerce-mini-cart-item.mini_cart_item');
		var subscriptions = cart.find('a.remove').filter(function() {
			return $(this).data('product_id') == 2149;
		});
		return subscriptions.length > 0;
	};

	var cartForm = 'form.variations_form.cart';
	$(document).on('click', '.single_add_to_cart_button', function(e) {
		console.log(e);
		e.preventDefault();
		// var variationId = $('input.variation_id').val();
		// // trying to add a gift on a non empty cart
		// if (isAGift(variationId) && !isEmptyCart()) {
		// 	e.preventDefault();
		// 	alert('Cadeau');
		// 	// TODO: put a toaster
		// 	return;
		// }
		// // trying to add a subscription in a cart already containing one
		// if (subscriptionAlreadyInCart()) {
		// 	e.preventDefault();
		// 	alert('Il y a déjà un abonnement dans le panier');
		// 	// TODO: put a toaster
		// 	return;
		// }
	});

	$(document.body).on('removed_from_cart', function() {
		toastr.options = {
			progressBar: true,
			positionClass: 'toast-bottom-full-width',
		};
		setTimeout(function() {
			toastr.success($('.woocommerce-message').html());
		}, 100);
	});
})(jQuery);
