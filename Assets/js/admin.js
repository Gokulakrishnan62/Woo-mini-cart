jQuery(function ($) {
    let mcw_ajx_url = mcw_admin_script_data.ajax_url;

    $(document).on("click", '.mcw_page #mcw_show_widget #mcw_action_widget', function(e) {
        e.preventDefault();
        $.ajax({
            url: mcw_ajx_url,
            type: 'post',
            data: {
                action: 'mcw_ajax',
                method: 'save_option',
                option: $('#toggleButton').prop('checked') ? 1 : 0,
                key: 'enable_widgets',
            },
            success: function (response) {
                console.log('ok');
            }
        });
    });
});