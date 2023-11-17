jQuery(function ($) {
    let mcw_ajx_url = mcw_frontend_script_data.ajax_url;
    let mcw_is_cart = (mcw_frontend_script_data.is_cart == '1');
    let mcw_is_checkout = (mcw_frontend_script_data.is_checkout == '1');
    let mcw_has_cart_block = (mcw_frontend_script_data.has_cart_block == '1');
    let mcw_has_checkout_block = (mcw_frontend_script_data.has_checkout_block == '1');

    window.mcw_actions = {

        // to update page fragments.
        update_fragments: function (page = '') {
            if (page === 'cart' || mcw_is_cart) {
                jQuery(document.body).trigger('wc_update_cart');
            } else if (page === 'checkout' || mcw_is_checkout) {
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

        // to get cart empty html
        get_cart_empty_html: function (callback) {
            $.ajax({
                type: 'post',
                url: mcw_ajx_url,
                data: {
                    action: 'mcw_ajax',
                    method: 'get_cart_empty_html',
                },
                success : function (response) {
                    callback(response.data);
                }
            });
        },

        // check cart is empty
        is_cart_empty: function (callback) {
            $.ajax({
                type: 'post',
                url: mcw_ajx_url,
                data: {
                    action: 'mcw_ajax',
                    method: 'is_cart_empty',
                },
                success : function (response) {
                    callback(response.data);
                }
            });
        },

        // remove item from cart.
        remove_item_from_cart: function (products_section, product) {
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
                },
                success : function (response) {
                    product.remove();
                    mcw_actions.update_fragments();
                    mcw_actions.is_cart_empty(function(isEmpty) {
                        if (isEmpty) {
                            mcw_actions.get_cart_empty_html(function (empty_cart_html) {
                                products_section.html(empty_cart_html);
                            });
                        }
                    });
                }
            });
        },

        // to update Quantity.
        quantity_update: function (products_section, product, action) {

            let cart_item_key = product.data('cart_item_key');
            let current_quantity = parseInt(product.find('.mcw-quantity-input').val());

            if (!cart_item_key && !current_quantity) {
                return;
            }

            if (current_quantity == 0 || (action === 'minus' && current_quantity === 1)) {
                mcw_actions.remove_item_from_cart(products_section, product);
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
                    },
                    success : function (response) {
                        if (response.data.line_total && response.data.quantity !== null) {
                            mcw_actions.update_fragments();
                            product.find('.mcw-quantity-input').val(response.data.quantity);
                            product.find('.mcw-product-total-price').html(response.data.line_total);
                        }
                    }
                });
            }
        },

        // to refresh cart body.
        refresh_mini_cart_body: function(section) {
            $.ajax({
                type: 'post',
                url: mcw_ajx_url,
                data: {
                    action: 'mcw_ajax',
                    method: 'refresh_mini_cart_body',
                },
                success : function (response) {
                    if (response.data != '') {
                        section.find('.mcw-products').html(response.data);
                    }
                }
            });
        },
    }

    // to remove product from cart.
    $(document).on("click", '.mcw-products .mcw-product .mcw-remove-product ', function() {
       mcw_actions.remove_item_from_cart($(this).closest('.mcw-products'), $(this).closest('.mcw-product'));
    });

    // to add quantity (add).
    $(document).on("click", '.mcw-products .mcw-product .mcw-quantity-container .mcw-quantity-plus' ,function() {
        mcw_actions.quantity_update($(this).closest('.mcw-products'), $(this).closest('.mcw-product'), 'plus');
    });

    // to remove quantity (minus).
    $(document).on("click", '.mcw-products .mcw-product .mcw-quantity-container .mcw-quantity-minus' ,function() {
        if (parseInt($(this).closest('.mcw-quantity-container').find('.mcw-quantity-input').val() == 1)) {
            mcw_actions.remove_item_from_cart($(this).closest('.mcw-products'), $(this).closest('.mcw-product'));
        }
        mcw_actions.quantity_update($(this).closest('.mcw-products'), $(this).closest('.mcw-product'), 'minus');
    });

    // preform action when change quantity by input.
    $(document).on("change", '.mcw-products .mcw-product .mcw-quantity-container .mcw-quantity-input' ,function() {
        mcw_actions.quantity_update($(this).closest('.mcw-products'), $(this).closest('.mcw-product'), 'custom');
    });

    // to refresh mini-cart body when product added in shop page.
    $(document).ready(function($) {
        $(document.body).on('added_to_cart', function(event, fragments, cart_hash, button) {
            if ($(button).hasClass('add_to_cart_button')) {
                mcw_actions.refresh_mini_cart_body($("#mcw-cart-sidebar"));
            }
        });
    });

    $(document).on("click", '.widget-container', function() {
        const sidebar = document.querySelector('#mcw-cart-sidebar');
        sidebar.style.left = sidebar.style.left === '0px' ? '-1000px' : '0px';
    });

});