jQuery(function ($) {
    $(document).on('click', '.viral-times-install-plugin', function () {
        event.preventDefault();
        var $button = $(this);

        if ($button.hasClass('updating-message')) {
            return;
        }

        wp.updates.installPlugin({
            slug: $button.data('slug')
        });
    });

    $(document).on('click', '.viral-times-activate-plugin', function () {
        event.preventDefault();
        var $button = $(this);
        $button.addClass('updating-message').html(importer_params.activating_text);

        viral_times_activate_plugin($button);

    });

    $(document).on('wp-plugin-installing', function (event, args) {
        event.preventDefault();

        $('.viral-times-install-plugin').addClass('updating-message').html(importer_params.installing_text);

    });

    $(document).on('wp-plugin-install-success', function (event, response) {

        event.preventDefault();
        var $button = $('.viral-times-install-plugin');

        $button.html(importer_params.activating_text);

        setTimeout(function () {
            viral_times_activate_plugin($button);
        }, 1000);

    });

    function viral_times_activate_plugin($button) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'viral_times_activate_plugin',
                slug: $button.data('slug'),
                file: $button.data('filename'),
                security: importer_params.ajax_nonce
            },
        }).done(function (result) {
            var result = JSON.parse(result)
            if (result.success) {
                window.location.href = importer_params.importer_url;
            } else {
                $button.removeClass('updating-message').html(importer_params.error);
            }

        });
    }
});