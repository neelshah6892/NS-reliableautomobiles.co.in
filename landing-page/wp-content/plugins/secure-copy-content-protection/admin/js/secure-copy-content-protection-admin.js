(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(document).ready(function () {
        $(document).on("input", 'input', function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
        $(document).on("keydown", function(e) {
            if (e.target.nodeName == "TEXTAREA") {
                return true;
            }
            if (e.keyCode == 13) {
                return false;
            }
        });

        let $_navTabs = $(document).find('.nav-tab'),
            $_navTabContent = $(document).find('.nav-tab-content');
        $(document).find('#sccp_post_types').select2();
        $(document).find('#sccp_post_types_1').select2();
        $(document).find('#sccp_post_types_2').select2();

        $_navTabs.on('click', function (e) {
            e.preventDefault();
            let active_tab = $(this).attr('data-tab');
            $_navTabs.each(function () {
                $(this).removeClass('nav-tab-active');
            });
            $_navTabContent.each(function () {
                $(this).removeClass('nav-tab-content-active');
            });
            $(this).addClass('nav-tab-active');
            $(document).find('.nav-tab-content' + $(this).attr('href')).addClass('nav-tab-content-active');
            $(document).find("[name='sccp_tab']").val(active_tab);
        });

        $(document).find('#blocked_ips').DataTable();

        $('[data-toggle="tooltip"]').tooltip();

        var checkbox = $('.modern-checkbox-options');
        for (var i = 0; i < checkbox.length; i++) {

            var classname = checkbox[i].className.split(' ');
            if (checkbox[i].checked == true) {
                $('.' + classname[1] + '-mess').attr('disabled', false);
                $('.' + classname[1] + '-audio').attr('disabled', false);
            } else {
                $('.' + classname[1] + '-mess').attr('disabled', true);
                $('.' + classname[1] + '-audio').attr('disabled', true);
            }
        }
        checkbox.change(function () {

            var classname = this.className.split(' ');
            console.log(classname);
            if (this.checked == true) {
                $('.' + classname[1] + '-mess').attr('disabled', false);
                $('.' + classname[1] + '-audio').attr('disabled', false);
            } else {
                $('.' + classname[1] + '-mess').attr('checked', false);
                $('.' + classname[1] + '-mess').attr('disabled', true);
                $('.' + classname[1] + '-audio').attr('checked', false);
                $('.' + classname[1] + '-audio').attr('disabled', true);
            }

        })

        $(document).on('click', '.upload_audio', function (e) {
            openSCCPMediaUploader(e, $(this));
        });


//--------------preview

        $('#reset_to_default').on('click', function () {
            $('#bg_color').val('#ffffff').change()
            $('#text_color').val('#ff0000').change()
            $('#border_color').val('#b7b7b7').change()
            $('#font_size').val(12).change()
            $('#border_width').val(1).change()
            $('#border_radius').val(3).change()
            $('#border_style').val('solid').change()
            $('#tooltip_position').val('mouse').change()
            $('#sccp_custom_css').val('')
            $('#sscp_timeout').val(1000)
        })

        $('#bg_color').change(function () {
            let color = $(this).val();
            $('#ays_tooltip').css('background-color', color)
        });
        $('#text_color').change(function () {
            let color = $(this).val();
            $('#ays_tooltip').css('color', color)
        });
        $('#font_size').on('change', function () {
            let val = $(this).val()
            $('#ays_tooltip').children().css('font-size', val + 'px')
        });
        $('#border_color').change(function () {
            let color = $(this).val();
            $('#ays_tooltip').css('border-color', color)
        });
        $('#border_width').on('change', function () {
            let val = $(this).val()
            $('#ays_tooltip').css('border-width', val + 'px')
        });
        $('#border_radius').on('change', function () {
            let val = $(this).val()
            $('#ays_tooltip').css('border-radius', val + 'px')
        });
        $('#border_style').on('change', function () {
            let val = $(this).val()
            $('#ays_tooltip').css('border-style', val)
        });

        // $('#sccp_custom_css').on('change', function () {
        //     let newCss = $(this).val();
        //     $('#ays-sccp-custom-styles').html(newCss);
        // });

        $('#ays_tooltip').children().css('font-size', $('#font_size').val() + 'px');
        $('#ays_tooltip').children().css('margin', "0");


//----------end preview


        function openSCCPMediaUploader(e, element) {
            e.preventDefault();
            let aysUploader = wp.media({
                title: 'Upload',
                button: {
                    text: 'Upload'
                },
                multiple: false
            }).on('select', function () {
                let attachment = aysUploader.state().get('selection').first().toJSON();
                $('.sccp_upload_audio').html('<audio id="sccp_audio" controls><source src="' + attachment.url + '" type="audio/mpeg"></audio>')
                console.log(attachment.url);
                $('.upload_audio_url').val(attachment.url);
            }).open();

            return false;
        }

    });
})(jQuery);
