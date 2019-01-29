/* global wc_add_to_cart_params */
jQuery(function($) {
	if (typeof wc_add_to_cart_params === 'undefined') {
		return false;
	}

	var cartIsOK = function(clickedButton) {
		// @see: https://stackoverflow.com/questions/11852570/override-woocommerce-frontend-javascript

		var isAGift = function(itemId) {
			return (
				itemId == 2212 ||
				itemId == 2214 ||
				itemId == 2220 ||
				itemId == 2222
			);
		};

		var isASubscription = function(itemId) {
			return (
				itemId == 2211 ||
				itemId == 2213 ||
				itemId == 2219 ||
				itemId == 2221
			);
		};

		var isEmptyCart = function() {
			return (
				$('li.woocommerce-mini-cart-item.mini_cart_item').length === 0
			);
		};

		var subscriptionAlreadyInCart = function() {
			var cart = $('li.woocommerce-mini-cart-item.mini_cart_item');
			var subscriptions = cart.find('a.remove').filter(function() {
				return $(this).data('product_id') == 2149;
			});
			return subscriptions.length > 0;
		};

		var variationId = $('input.variation_id').val();
		// trying to add a gift on a non empty cart
		toastr.options = {
			progressBar: true,
			positionClass: 'toast-bottom-full-width',
		};
		if (isAGift(variationId) && !isEmptyCart()) {
			setTimeout(function() {
				toastr.error(
					"Votre panier contient d'autres produits. Les abonnements que vous offrez doivent faire l'objet d'une commande séparée."
				);
			}, 100);
			return false;
		}

		// trying to add a subscription in a cart already containing one
		if (
			subscriptionAlreadyInCart() &&
			isASubscription(clickedButton.data('product_id'))
		) {
			setTimeout(function() {
				toastr.error(
					'Il y a déjà un abonnement dans votre panier. Merci de compléter une commande par abonnement.'
				);
			}, 100);
			return false;
		}
		return true;
	};

	/**
	 * AddToCartHandler class.
	 */
	var AddToCartHandler = function() {
		$(document.body)
			.on('click', '.add_to_cart_button', this.onAddToCart)
			.on('click', '.remove_from_cart_button', this.onRemoveFromCart)
			.on('added_to_cart', this.updateButton)
			.on('added_to_cart', this.updateCartPage)
			.on('added_to_cart removed_from_cart', this.updateFragments)
			.on('click', '#soutien', this.onAddSoutien)
			.on('cart_totals_refreshed', this.unblock);
	};

	/**
	 * Handle the add to cart event.
	 */
	AddToCartHandler.prototype.onAddToCart = function(e) {
		var $thisbutton = $(this);

		if ($thisbutton.is('.ajax_add_to_cart')) {
			if (!$thisbutton.attr('data-product_id')) {
				return true;
			}

			e.preventDefault();

			if (!cartIsOK($thisbutton)) return;

			$thisbutton.removeClass('added');
			$thisbutton.addClass('loading');

			var data = {};

			$.each($thisbutton.data(), function(key, value) {
				data[key] = value;
			});
			// remplace le product id si le variation id est présent
			// (pour les abonnements)
			var variationId = $('input[name="variation_id"]').val();
			if (variationId) data.product_id = variationId;

			// Trigger event.
			$(document.body).trigger('adding_to_cart', [$thisbutton, data]);

			// Ajax action.
			$.post(
				wc_add_to_cart_params.wc_ajax_url
					.toString()
					.replace('%%endpoint%%', 'add_to_cart'),
				data,
				function(response) {
					if (!response) {
						return;
					}

					if (response.error && response.product_url) {
						window.location = response.product_url;
						return;
					}

					// Redirect to cart option
					if (
						wc_add_to_cart_params.cart_redirect_after_add === 'yes'
					) {
						window.location = wc_add_to_cart_params.cart_url;
						return;
					}

					// Trigger event so themes can refresh other areas.
					$(document.body).trigger('added_to_cart', [
						response.fragments,
						response.cart_hash,
						$thisbutton,
					]);
				}
			);
		}
	};

	/**
	 * Handle the add to cart event.
	 */
	AddToCartHandler.prototype.onAddSoutien = function(e) {
		var $thisbutton = $(this);
		var $label = $('label[for="soutien"]');

		if (!$thisbutton.attr('data-product_id')) {
			return true;
		}

		if ($thisbutton.prop('checked')) {
			var data = {
				product_id: 72,
				quantity: 1,
			};
			var $form = $thisbutton.parents('form');
			$form.block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6,
				},
			});
			$('.cart_totals').block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6,
				},
			});
			// Trigger event.
			$(document.body).trigger('adding_to_cart', [$thisbutton, data]);

			// Ajax action.
			$.ajax({
				type: 'POST',
				url: wc_add_to_cart_params.wc_ajax_url
					.toString()
					.replace('%%endpoint%%', 'add_to_cart'),
				data,
				success: function(response) {
					$thisbutton.hide();
					$label.hide();
					// Trigger event so themes can refresh other areas.
					$(document.body).trigger('added_to_cart', [
						response.fragments,
						response.cart_hash,
						$thisbutton,
					]);
				},
			});
		}
	};

	AddToCartHandler.prototype.unblock = function() {
		$('form.woocommerce-cart-form').unblock();
		$('div.cart_totals').unblock();
	};

	/**
	 * Update fragments after remove from cart event in mini-cart.
	 */
	AddToCartHandler.prototype.onRemoveFromCart = function(e) {
		var $thisbutton = $(this),
			$row = $thisbutton.closest('.woocommerce-mini-cart-item');

		e.preventDefault();

		$row.block({
			message: null,
			overlayCSS: {
				opacity: 0.6,
			},
		});

		$.post(
			wc_add_to_cart_params.wc_ajax_url
				.toString()
				.replace('%%endpoint%%', 'remove_from_cart'),
			{ cart_item_key: $thisbutton.data('cart_item_key') },
			function(response) {
				if (!response || !response.fragments) {
					window.location = $thisbutton.attr('href');
					return;
				}
				$(document.body).trigger('removed_from_cart', [
					response.fragments,
					response.cart_hash,
					$thisbutton,
				]);
			}
		).fail(function() {
			window.location = $thisbutton.attr('href');
			return;
		});
	};

	/**
	 * Update cart page elements after add to cart events.
	 */
	AddToCartHandler.prototype.updateButton = function(
		e,
		fragments,
		cart_hash,
		$button
	) {
		$button = typeof $button === 'undefined' ? false : $button;

		if ($button) {
			$button.removeClass('loading');
			$button.addClass('added');

			// View cart text.
			if (
				!wc_add_to_cart_params.is_cart &&
				$button.parent().find('.added_to_cart').length === 0
			) {
				$button.after(
					' <a href="' +
						wc_add_to_cart_params.cart_url +
						'" class="added_to_cart wc-forward" title="' +
						wc_add_to_cart_params.i18n_view_cart +
						'">' +
						wc_add_to_cart_params.i18n_view_cart +
						'</a>'
				);
			}

			$(document.body).trigger('wc_cart_button_updated', [$button]);
		}
	};

	/**
	 * Update cart page elements after add to cart events.
	 */
	AddToCartHandler.prototype.updateCartPage = function() {
		var page = window.location
			.toString()
			.replace('add-to-cart', 'added-to-cart');

		$('.shop_table.cart').load(
			page + ' .shop_table.cart:eq(0) > *',
			function() {
				$('.shop_table.cart')
					.stop(true)
					.css('opacity', '1')
					.unblock();
				$(document.body).trigger('cart_page_refreshed');
			}
		);

		$('.cart_totals').load(page + ' .cart_totals:eq(0) > *', function() {
			$('.cart_totals')
				.stop(true)
				.css('opacity', '1')
				.unblock();
			$(document.body).trigger('cart_totals_refreshed');
		});
	};

	/**
	 * Update fragments after add to cart events.
	 */
	AddToCartHandler.prototype.updateFragments = function(e, fragments) {
		if (fragments) {
			$.each(fragments, function(key) {
				$(key)
					.addClass('updating')
					.fadeTo('400', '0.6')
					.block({
						message: null,
						overlayCSS: {
							opacity: 0.6,
						},
					});
			});

			$.each(fragments, function(key, value) {
				$(key).replaceWith(value);
				$(key)
					.stop(true)
					.css('opacity', '1')
					.unblock();
			});

			$(document.body).trigger('wc_fragments_loaded');
		}
	};

	/**
	 * Init AddToCartHandler.
	 */
	new AddToCartHandler();
});
