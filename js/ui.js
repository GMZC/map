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

	var cartLink = 'ul#site-header-cart.site-header-cart li a.cart-contents';
	var cartHeader = 'ul#site-header-cart.site-header-cart';
  var cartToggle = 'ul#site-header-cart.site-header-cart p#mini_cart_toggle a.cartClose';

	$(document).on('click', cartLink, function(e) {
		// OK marche
		e.preventDefault();
		$(cartHeader)
			.find('.widget')
			.toggleClass('is-active');
	});

  $(document).on('click', cartToggle, function(e) {
    // OK marche
    e.preventDefault();
    $(cartHeader)
      .find('.widget')
      .removeClass('is-active');
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

	$(document.body).on('removed_from_cart', function() {
		toastr.options = {
			progressBar: true,
			positionClass: 'toast-top-right',
		};
		setTimeout(function() {
			var msg =
				$('.woocommerce-message').html() ||
				'Le produit a bien été supprimé du panier.';
			toastr.success(msg);
		}, 100);
	});
	$(document.body).on('added_to_cart', function() {
		toastr.options = {
			progressBar: true,
			positionClass: 'toast-top-right',
		};
		setTimeout(function() {
			var msg =
				$('.woocommerce-message').html() ||
				'Le produit a bien été ajouté au panier.';
			toastr.success(msg);
		}, 100);
	});
})(jQuery);
