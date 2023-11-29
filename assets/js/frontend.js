jQuery(function ($) {
    let mcw_ajx_url = mcw_frontend_script_data.ajax_url;
    let mcw_is_cart = (mcw_frontend_script_data.is_cart == '1');
    let mcw_nonce = mcw_frontend_script_data.mcw_nonce || '';
    let mcw_is_checkout = (mcw_frontend_script_data.is_checkout == '1');
    let mcw_has_cart_block = (mcw_frontend_script_data.has_cart_block == '1');
    let mcw_has_checkout_block = (mcw_frontend_script_data.has_checkout_block == '1');

    // to prevent double loading
    let prevent_double_loading =  false;

    window.mcw_spinner = {
        // show spinner
        show: function (section) {
            if (typeof section === 'string') {
                section = $(section).first();
            }
            if (section.block) {
                $(section).block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });
            }
        },

        // hide spinner
        hide: function (section) {
            if (typeof section === 'string') {
                section = $(section).first();
            }
            if (section.unblock) {
                $(section).unblock();
            }
        }
    }

    window.mcw_actions = {

        // to update page fragments.
        update_fragments: function () {
            if (mcw_is_cart) {
                jQuery(document.body).trigger('wc_update_cart');
            } else if (mcw_is_checkout) {
                jQuery(document.body).trigger('update_checkout');
            } else {
                jQuery(document.body).trigger('wc_fragment_refresh');
            }

            if (mcw_has_cart_block || mcw_has_checkout_block) {
                setTimeout(function () {
                    jQuery(document.body).trigger('added_to_cart', {});
                }, 0);
            }
        },

        // remove item from cart.
        remove_item_from_cart: function (product, content) {
            let cart_item_key = product.data('cart_item_key');
            if (!cart_item_key) {
                return;
            }

            $.ajax({
                type: 'post',
                url: mcw_ajx_url,
                data: {
                    action: 'mcw_ajax',
                    method: 'remove_item_from_cart',
                    cart_item_key: cart_item_key,
                    nonce: mcw_nonce || '',
                },
                beforeSend: function () {
                    mcw_spinner.show(content);
                },
                success : function (response) {
                    if (response.data.cart_item_removed && response.data.sidebar_content != '') {
                        mcw_actions.update_fragments();
                        content.html(response.data.sidebar_content);
                        prevent_double_loading = true;
                    }
                },
                complete: function () {
                    mcw_spinner.hide(content);
                },
            });
        },

        // to update Quantity.
        update_item_quantity: function (product, content, action) {
            let cart_item_key = product.data('cart_item_key');
            let current_quantity = parseInt(product.find('.mcw-quantity-input').val());
            if (!cart_item_key) {
                return;
            }

            if (!isNaN(current_quantity)) {
                $.ajax({
                    type: 'post',
                    url: mcw_ajx_url,
                    data: {
                        action: 'mcw_ajax',
                        method: 'update_quantity',
                        cart_item_key: cart_item_key,
                        current_quantity: current_quantity,
                        quantity_action: action,
                        nonce: mcw_nonce || '',
                    },
                    beforeSend: function () {
                        mcw_spinner.show(content);
                    },
                    success : function (response) {
                        if (response.data.is_quantity_set && response.data.sidebar_content != '') {
                            mcw_actions.update_fragments();
                            content.html(response.data.sidebar_content);
                            prevent_double_loading = true;
                        }
                    },
                    complete: function () {
                        mcw_spinner.hide(content);
                    },
                });

            }
        },

        // to apply coupon
        apply_coupon: function(content) {
            const coupon_code = content.find('#mcw-coupon-text').val();
            if (!coupon_code) {
                return;
            }

            $.ajax({
                type: 'post',
                url: mcw_ajx_url,
                data: {
                    action: 'mcw_ajax',
                    method: 'apply_coupon',
                    coupon_code: coupon_code,
                    nonce: mcw_nonce || '',
                },
                beforeSend: function () {
                    mcw_spinner.show(content);
                },
                success : function (response) {
                    if (response.data.is_coupon_applied && response.data.sidebar_content != '') {
                        mcw_actions.update_fragments();
                        content.html(response.data.sidebar_content);
                        prevent_double_loading = true;
                    }
                },
                complete: function () {
                    mcw_spinner.hide(content);
                },
            });
        },

        // to apply coupon
        remove_coupon: function(section, content) {
            const coupon_code = section.data('coupon');
            if (!coupon_code) {
                return;
            }

            $.ajax({
                type: 'post',
                url: mcw_ajx_url,
                data: {
                    action: 'mcw_ajax',
                    method: 'remove_coupon',
                    coupon_code: coupon_code,
                    nonce: mcw_nonce || '',
                },
                beforeSend: function () {
                    mcw_spinner.show(content);
                },
                success : function (response) {
                    if (response.data) {
                        if (response.data.is_coupon_removed && response.data.sidebar_content != '') {
                            mcw_actions.update_fragments();
                            content.html(response.data.sidebar_content);
                            prevent_double_loading = prevent_double_loading ? false : true;
                        }
                    }
                },
                complete: function () {
                    mcw_spinner.hide(content);
                },
            });
        },

        // to refresh cart.
        refresh_mini_cart: function(content) {
            if (content == '') {
                return;
            }

            $.ajax({
                type: 'post',
                url: mcw_ajx_url,
                data: {
                    action: 'mcw_ajax',
                    method: 'refresh_mini_cart',
                    nonce: mcw_nonce || '',
                },
                beforeSend: function () {
                    mcw_spinner.show(content);
                },
                success : function (response) {
                    if (response.data != '') {
                        content.html(response.data);
                    }
                },
                complete: function () {
                    mcw_spinner.hide(content);
                },
            });
        },
    }

    // to remove product from cart.
    $(document).on("click", '.mcw-products .mcw-product .mcw-remove-product ', function() {
       mcw_actions.remove_item_from_cart($(this).closest('.mcw-product'), $(this).closest('#mcw-cart-sidebar'));
    });

    // to add quantity (add).
    $(document).on("click", '.mcw-products .mcw-product .mcw-quantity-container .mcw-quantity-plus' ,function(event) {
        mcw_actions.update_item_quantity($(this).closest('.mcw-product'), $(this).closest('#mcw-cart-sidebar'), 'plus');
    });

    // to remove quantity (minus).
    $(document).on("click", '.mcw-products .mcw-product .mcw-quantity-container .mcw-quantity-minus' ,function() {
        mcw_actions.update_item_quantity($(this).closest('.mcw-product'), $(this).closest('#mcw-cart-sidebar'), 'minus');
    });

    // preform action when change quantity by input.
    $(document).on("change", '.mcw-products .mcw-product .mcw-quantity-container .mcw-quantity-input' ,function() {
        mcw_actions.update_item_quantity($(this).closest('.mcw-product'), $(this).closest('#mcw-cart-sidebar'), 'custom');
    });

    // to apply coupon
    $(document).on("click", '#mcw-cart-sidebar #mcw-apply-coupon' ,function() {
        mcw_actions.apply_coupon($(this).closest('#mcw-cart-sidebar'));
    });

    // to remove coupon
    $(document).on("click", '#mcw-cart-sidebar #mcw-remove-coupon' ,function() {
        mcw_actions.remove_coupon($(this), $(this).closest('#mcw-cart-sidebar'));
    });

    // display add coupon filed
    $(document).on("click", '#mcw-cart-sidebar #mcw-add-coupon' ,function() {
        $("#mcw-add-coupon-field").toggle();
        $(".mcw-coupon-option").toggle();
        $("#mcw-coupon-list").toggle();
    });

    // to refresh mini-cart when product added.
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, button) {
        if ($(button).hasClass('add_to_cart_button')) {
            mcw_actions.refresh_mini_cart($("#mcw-cart-sidebar"));
        }
    });

    // to refresh mini-cart when cart updated.
    $(document.body).on('updated_cart_totals', function() {

        // check for prevent double loading
        let when_update_by_ajax = prevent_double_loading ? false : true;
        let when_update_by_cart = prevent_double_loading ? true : false;

        if (when_update_by_ajax && !when_update_by_cart) {
            mcw_actions.refresh_mini_cart($("#mcw-cart-sidebar"));
        }

        // reset the double loading
        prevent_double_loading = false;
    });

    // to refresh mini-cart when checkout page updated.
    $(document.body).on('updated_checkout', function() {

        // check for prevent double loading
        let when_update_by_ajax = prevent_double_loading ? false : true;
        let when_update_by_cart = prevent_double_loading ? true : false;

        if (when_update_by_ajax && !when_update_by_cart) {
            mcw_actions.refresh_mini_cart($("#mcw-cart-sidebar"));
        }

        // reset the double loading
        prevent_double_loading = false;
    });

    // to toggle sidebar
    $(document).on("click", '.widget-container, #mcw-close-cart', function() {
        const sidebar = $('#mcw-cart-sidebar');
        sidebar.css('left', sidebar.css('left') === '0px' ? '-1000px' : '0px');
    });

    $(document.body).on('wc_fragments_refreshed', function(event, fragments, cart_hash, button) {
        mcw_actions.refresh_mini_cart($("#mcw-cart-sidebar"));
    });
});