jQuery(function ($) {
    let mcw_ajx_url = mcw_admin_script_data.ajax_url;
    let mcw_default_data = mcw_admin_script_data.template_data;
    let mcw_nonce = mcw_admin_script_data.mcw_nonce;

    const mcw_admin_view = {
        init: function () {
            this.event_listeners();
        },

        save_option: function () {
            $.ajax({
                url: mcw_ajx_url,
                type: 'post',
                data: {
                    action: 'mcw_ajax',
                    method: 'save_option',
                    key: 'settings',
                    option: $('#mcw-show-widget').serialize(),
                    nonce: mcw_nonce || '',
                },
                success: function (response) {
                    location.reload(true);
                }
            });
        },

        event_listeners: function () {
            // to save function.
            $("#mcw-admin-page #mcw-action-widget").click( function () {
                mcw_admin_view.save_option();
            });

            // to display color picker value as hex value.
            $('#mcw-admin-page .mcw-color-inputs .mcw-color-picker').on('input', function () {
                $(this).closest('.mcw-color-inputs').find('.mcw-color-input').val($(this).val()).trigger('input');
            });

            // to display color of hex value.
            $('#mcw-admin-page .mcw-color-inputs .mcw-color-input').on('input blur', function () {
                if ($(this).val() && !/^#[0-9a-fA-F]{6}$/i.test($(this).val())) {
                    $(this).addClass('border-danger');
                } else {
                    $(this).removeClass('border-danger');
                }
                $(this).closest('.mcw-color-inputs').find('.mcw-color-picker').val($(this).val());
            }).trigger('input');

            // to show cart button.
            $('#mcw-admin-page .mcw-show-cart-button').change(function () {
                if ($(this).is(':checked')) {
                    $(".mcw-cart-button-cta").show()
                    $(".mcw-show-cart-button").val(1)
                } else {
                    $(".mcw-cart-button-cta").hide()
                }
            });

            // to reset the values.
            $('#mcw-admin-page #mcw-reset-button').click(function () {
                let admin_data = $("#mcw-show-widget");
                $.each(mcw_default_data, function (name, value) {
                    if(name === 'style') {
                        $.each(value, function (section_name, section_property){
                            $.each(section_property, function (property_name, property_value) {
                                admin_data.find('[name="'+ name +'[' + section_name + ']['+ property_name +']"]').val(property_value);
                            } );
                        })
                        $('#mcw-admin-page .mcw-color-inputs .mcw-color-input').trigger('input');
                    } else {
                        admin_data.find('[name="' + name + '"]').val(value);
                        admin_data.find('[name="' + name + '"]:checkbox').prop("checked", value !== '' ? true : false);
                        $('#mcw-admin-page .mcw-show-cart-button').trigger('change');
                    }
                });
            });
        }
    }

    /* Init */
    $(document).ready(function () {
        mcw_admin_view.init();
    });
});