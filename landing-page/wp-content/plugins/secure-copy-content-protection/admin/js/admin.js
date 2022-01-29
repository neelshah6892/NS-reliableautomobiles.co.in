(function ($) {
    'use strict';

    $(document).find('[data-slug="secure-copy-content-protection"]').find('.deactivate').find('a').on('click', function () {
        swal({
            html:"<h2>Please select an action!</h2><ul><li><strong>Upgrade</strong>: Your data will be saved for upgrade to PRO version after deleting the plugin.</li><li><strong>Deactivate</strong>: Your data will not be saved after deleting the plugin.</li></ul>",
            type: 'question',
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upgrade',
            cancelButtonText: 'Deactivate'
        }).then((result) => {
            var upgrade_plugin = false;
            if (result.value) upgrade_plugin = true;
            var data = {action: 'deactivate_sccp_option_sccp', upgrade_plugin: upgrade_plugin};
            $.ajax({
                url: sccp_admin_ajax.ajax_url,
                method: 'post',
                dataType: 'json',
                data: data,
                success:function () {
                    window.location = $(document).find('[data-slug="secure-copy-content-protection"]').find('.deactivate').find('a').attr('href');
                }
            });
        });
        return false;
    });

})(jQuery);