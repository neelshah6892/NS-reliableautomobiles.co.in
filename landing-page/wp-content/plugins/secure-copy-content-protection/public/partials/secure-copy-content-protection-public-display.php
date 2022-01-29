<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://ays-pro.com/
 * @since      1.0.0
 *
 * @package    Secure_Copy_Content_Protection
 * @subpackage Secure_Copy_Content_Protection/public/partials
 */
global $wpdb;
$result                 = $wpdb->get_row("SELECT * FROM " . SCCP_TABLE . " WHERE id = 1", ARRAY_A);
$data                   = json_decode($result["options"], true);
$styles                 = json_decode($result["styles"], true);
$enable_left_click      = ((isset($data["left_click"]) && ($data["left_click"] == "checked"))) ? true : false;
$enable_developer_tools = ((isset($data["developer_tools"]) && ($data["developer_tools"] == "checked")) || !isset($data["left_click"])) ? true : false;
$enable_context_menu    = ((isset($data["context_menu"]) && ($data["context_menu"] == "checked")) || !isset($data["context_menu"])) ? true : false;
$enable_drag_start      = ((isset($data["drag_start"]) && ($data["drag_start"] == "checked")) || !isset($data["drag_start"])) ? true : false;
$enable_ctrlc           = ((isset($data["ctrlc"]) && ($data["ctrlc"] == "checked")) || !isset($data["ctrlc"])) ? true : false;
$enable_ctrlv           = ((isset($data["ctrlv"]) && ($data["ctrlv"] == "checked")) || !isset($data["ctrlv"])) ? true : false;
$enable_ctrls           = ((isset($data["ctrls"]) && ($data["ctrls"] == "checked")) || !isset($data["ctrls"])) ? true : false;
$enable_ctrla           = ((isset($data["ctrla"]) && ($data["ctrla"] == "checked")) || !isset($data["ctrla"])) ? true : false;
$enable_ctrlx           = ((isset($data["ctrlx"]) && ($data["ctrlx"] == "checked")) || !isset($data["ctrlx"])) ? true : false;
$enable_ctrlu           = ((isset($data["ctrlu"]) && ($data["ctrlu"] == "checked")) || !isset($data["ctrlu"])) ? true : false;
$enable_ctrlf           = ((isset($data["ctrlf"]) && ($data["ctrlf"] == "checked")) || !isset($data["ctrlf"])) ? true : false;
$enable_f12             = ((isset($data["f12"]) && ($data["f12"] == "checked")) || !isset($data["f12"])) ? true : false;
$enable_printscreen     = ((isset($data["printscreen"]) && ($data["printscreen"] == "checked")) || !isset($data["printscreen"])) ? true : false;

$enable_left_click_mess      = ((isset($data["left_click_mess"]) && ($data["left_click_mess"] == "checked"))) ? true : false;
$enable_developer_tools_mess = (isset($data["developer_tools_mess"]) && ($data["developer_tools_mess"] == "checked") || (!isset($data["developer_tools_mess"]))) ? true : false;
$enable_context_menu_mess    = (isset($data["context_menu_mess"]) && ($data["context_menu_mess"] == "checked") || (!isset($data["context_menu_mess"]))) ? true : false;
$enable_drag_start_mess      = (isset($data["drag_start_mess"]) && ($data["drag_start_mess"] == "checked") || (!isset($data["drag_start_mess"]))) ? true : false;
$enable_ctrlc_mess           = (isset($data["ctrlc_mess"]) && ($data["ctrlc_mess"] == "checked") || (!isset($data["ctrlc_mess"]))) ? true : false;
$enable_ctrlv_mess           = (isset($data["ctrlv_mess"]) && ($data["ctrlv_mess"] == "checked") || (!isset($data["ctrlv_mess"]))) ? true : false;
$enable_ctrls_mess           = (isset($data["ctrls_mess"]) && ($data["ctrls_mess"] == "checked") || (!isset($data["ctrls_mess"]))) ? true : false;
$enable_ctrla_mess           = (isset($data["ctrla_mess"]) && ($data["ctrla_mess"] == "checked") || (!isset($data["ctrla_mess"]))) ? true : false;
$enable_ctrlx_mess           = (isset($data["ctrlx_mess"]) && ($data["ctrlx_mess"] == "checked") || (!isset($data["ctrlx_mess"]))) ? true : false;
$enable_ctrlu_mess           = (isset($data["ctrlu_mess"]) && ($data["ctrlu_mess"] == "checked") || (!isset($data["ctrlu_mess"]))) ? true : false;
$enable_ctrlf_mess           = (isset($data["ctrlf_mess"]) && ($data["ctrlf_mess"] == "checked") || (!isset($data["ctrlf_mess"]))) ? true : false;
$enable_f12_mess             = (isset($data["f12_mess"]) && ($data["f12_mess"] == "checked") || (!isset($data["f12_mess"]))) ? true : false;
$enable_printscreen_mess     = (isset($data["printscreen_mess"]) && ($data["printscreen_mess"] == "checked") || (!isset($data["printscreen_mess"]))) ? true : false;

$enable_left_click_audio      = (isset($data["left_click_audio"]) && ($data["left_click_audio"] == "checked")) ? true : false;
$right_click_audio            = (isset($data["right_click_audio"]) && ($data["right_click_audio"] == "checked")) ? true : false;
$enable_developer_tools_audio = (isset($data["developer_tools_audio"]) && ($data["developer_tools_audio"] == "checked")) ? true : false;
$enable_drag_start_audio      = (isset($data["drag_start_audio"]) && ($data["drag_start_audio"] == "checked")) ? true : false;
$enable_ctrlc_audio           = (isset($data["ctrlc_audio"]) && ($data["ctrlc_audio"] == "checked")) ? true : false;
$enable_ctrlv_audio           = (isset($data["ctrlv_audio"]) && ($data["ctrlv_audio"] == "checked")) ? true : false;
$enable_ctrls_audio           = (isset($data["ctrls_audio"]) && ($data["ctrls_audio"] == "checked")) ? true : false;
$enable_ctrla_audio           = (isset($data["ctrla_audio"]) && ($data["ctrla_audio"] == "checked")) ? true : false;
$enable_ctrlx_audio           = (isset($data["ctrlx_audio"]) && ($data["ctrlx_audio"] == "checked")) ? true : false;
$enable_ctrlu_audio           = (isset($data["ctrlu_audio"]) && ($data["ctrlu_audio"] == "checked")) ? true : false;
$enable_ctrlf_audio           = (isset($data["ctrlf_audio"]) && ($data["ctrlf_audio"] == "checked")) ? true : false;
$enable_f12_audio             = (isset($data["f12_audio"]) && ($data["f12_audio"] == "checked")) ? true : false;
$enable_printscreen_audio     = (isset($data["printscreen_audio"]) && ($data["printscreen_audio"] == "checked")) ? true : false;

$enable_text_selecting = (isset($data["enable_text_selecting"]) && ($data["enable_text_selecting"] == "checked")) ? true : false;
$timeout               = (isset($data["timeout"]) && $data["timeout"] > 0) ? absint($data["timeout"]) : 1000;

$tooltip_position = (isset($styles["tooltip_position"])) ? $styles["tooltip_position"] : "mouse";

//Elementor plugin conflict solution
if (!isset($_GET['elementor-preview'])): ?>
    <style>
        <?php if(!$enable_text_selecting): ?>

        *::selection {
            background-color: transparent !important;
            color: inherit !important;
        }

        *::-moz-selection {
            background-color: transparent !important;
            color: inherit !important;
        }

        <?php endif; ?>
        @media (max-width: 1024px) {
            *:not(input):not(textarea) {
                -webkit-user-select: none;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }
        }
    </style>
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                let all = $('*').not('script, meta, link, style, noscript, title'),
                    tooltip = $('#ays_tooltip'),
                    tooltipClass = "<?=$tooltip_position?>",
                    scWidth = window.screen.width;
                if (tooltipClass == "mouse") {
                    if (scWidth > 1024) {
                        all.on('mousemove', function (e) {
                            let cordinate_x = e.pageX;
                            let cordinate_y = e.pageY;
                            let windowWidth = $(window).width();
                            if (cordinate_y < tooltip.outerHeight()) {
                                tooltip.css({'top': (cordinate_y + 10) + 'px'});
                            } else {
                                tooltip.css({'top': (cordinate_y - tooltip.outerHeight()) + 'px'});
                            }
                            if (cordinate_x > (windowWidth - tooltip.outerWidth())) {
                                tooltip.css({'left': (cordinate_x - tooltip.outerWidth()) + 'px'});
                            } else {
                                tooltip.css({'left': (cordinate_x + 5) + 'px'});
                            }

                        });
                    } else {
                        let startTime, endTime;
                        all.on('touchstart', function (e) {
                            startTime = new Date().getTime();
                        });

                        all.on('touchend', function (e) {
                            endTime = new Date().getTime();
                            if ((endTime - startTime) / 1000 > 1) {
                                e.preventDefault();
                                let cordinate_x = e.pageX;
                                let cordinate_y = e.pageY;
                                let windowWidth = $(window).width();
                                if (cordinate_y < tooltip.outerHeight()) {
                                    tooltip.css({'top': (cordinate_y + tooltip.outerHeight() - 10) + 'px'});
                                } else {
                                    tooltip.css({'top': (cordinate_y - tooltip.outerHeight()) + 'px'});
                                }
                                if (cordinate_x > (windowWidth - tooltip.outerWidth())) {
                                    tooltip.css({'left': (cordinate_x - tooltip.outerWidth()) + 'px'});
                                } else {
                                    tooltip.css({'left': (cordinate_x + 5) + 'px'});
                                }
                            }

                        });
                    }
                } else {
                    tooltip.addClass(tooltipClass);
                }
				<?php if($enable_printscreen) : ?>
                $(document).on('keyup', function (e) {
                    if (!e) e = window.event;
                    if (e.keyCode == 44) {
                        e.preventDefault();
                        show_tooltip(<?php echo $enable_printscreen_mess?> );
                        audio_play(<?php echo $enable_printscreen_audio ?>);
                    }
                    return false;
                });
				<?php endif; ?>


				<?php if($enable_context_menu) : ?>
                $(document).on('contextmenu', function (e) {
                    let t = e || window.event;
                    let n = t.target || t.srcElement;
                    if (n.nodeName !== "A") {
                        show_tooltip(<?php echo $enable_context_menu_mess?> );
                        audio_play(<?php echo $right_click_audio?>);
                    }
                    return false;
                });

                all.on('taphold', function (e) {
                    e.preventDefault();
                    show_tooltip(<?php echo $enable_context_menu_mess?> );
                    audio_play(<?php echo $right_click_audio?>);
                    return false;
                });
				<?php endif; ?>

				<?php if($enable_drag_start) : ?>
                $(document).on('dragstart', function () {
                    show_tooltip(<?php echo $enable_drag_start_mess?> );
                    audio_play(<?php echo $enable_drag_start_audio?>);
                    return false;
                });
				<?php endif; ?>

				<?php if($enable_left_click) : ?>

                $(document).on('mousedown', function (e) {
                    let event = e || window.event;
                    if (event.which == 1) {
                        show_tooltip(<?php echo $enable_left_click_mess?> );
                        audio_play(<?php echo $enable_left_click_audio?>);
                        return false;
                    }
                });
                all.on('tap', function (e) {
                    let event = e || window.event;
                    if (event.which == 1) {
                        show_tooltip(<?php echo $enable_left_click_mess?> );
                        audio_play(<?php echo $enable_left_click_audio?>);
                        return false;
                    }
                });
				<?php endif; ?>

                $(window).on('keydown', function (event) {
                    var isOpera = (BrowserDetect.browser === "Opera");

                    var isFirefox = (BrowserDetect.browser === 'Firefox');

                    var isSafari = (BrowserDetect.browser === 'Safari');

                    var isIE = (BrowserDetect.browser === 'Explorer');

                    var isChrome = (BrowserDetect.browser === 'Chrome');

                    if (BrowserDetect.OS === 'Windows') {
						<?php if($enable_developer_tools) : ?>
                        if (isChrome) {
                            if (((event.ctrlKey && event.shiftKey) && (
                                event.keyCode === 73 ||
                                event.keyCode === 74 ||
                                event.keyCode === 67))) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
                        if (isFirefox) {
                            if (((event.ctrlKey && event.shiftKey) && (
                                event.keyCode === 73 ||
                                event.keyCode === 74 ||
                                event.keyCode === 67 ||
                                event.keyCode === 75 ||
                                event.keyCode === 69)) ||
                                event.keyCode === 118 ||
                                event.keyCode === 116 ||
                                (event.keyCode === 112 && event.shiftKey) ||
                                (event.keyCode === 115 && event.shiftKey) ||
                                (event.keyCode === 118 && event.shiftKey) ||
                                (event.keyCode === 120 && event.shiftKey)) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
                        if (isOpera) {
                            if (((event.ctrlKey && event.shiftKey) && (
                                event.keyCode === 73 ||
                                event.keyCode === 74 ||
                                event.keyCode === 67 ||
                                event.keyCode === 88 ||
                                event.keyCode === 69))) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
                        if (isIE) {
                            if ((event.keyCode === 123 && event.shiftKey)) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
						<?php endif; ?>

						<?php if($enable_ctrls) : ?>
                        if ((event.keyCode === 83 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrls_mess ?>);
                            audio_play(<?php echo $enable_ctrls_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrla) : ?>
                        if ((event.keyCode === 65 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrla_mess ?>);
                            audio_play(<?php echo $enable_ctrla_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlc) : ?>
                        if (event.keyCode === 67 && event.ctrlKey && !event.shiftKey) {
                            show_tooltip(<?php echo $enable_ctrlc_mess ?>);
                            audio_play(<?php echo $enable_ctrlc_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlv) : ?>
                        if ((event.keyCode === 86 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlv_mess ?>);
                            audio_play(<?php echo $enable_ctrlv_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlx) : ?>
                        if ((event.keyCode === 88 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlx_mess ?> );
                            audio_play(<?php echo $enable_ctrlx_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlu) : ?>
                        if ((event.keyCode === 85 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlu_mess ?> );
                            audio_play(<?php echo $enable_ctrlu_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlf) : ?>
                        if ((event.keyCode === 70 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlu_mess ?> );
                            audio_play(<?php echo $enable_ctrlu_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_f12) : ?>
                        if (event.keyCode === 123 || (event.keyCode === 123 && event.shiftKey)) {
                            show_tooltip(<?php echo $enable_f12_mess ?>);
                            audio_play(<?php echo $enable_f12_audio?>);
                            return false;
                        }
						<?php endif; ?>
                    } else if (BrowserDetect.OS === 'Linux') {
						<?php if($enable_developer_tools) : ?>
                        if (isChrome) {
                            if (
                                (
                                    (event.ctrlKey && event.shiftKey) &&
                                    (event.keyCode === 73 ||
                                        event.keyCode === 74 ||
                                        event.keyCode === 67
                                    )
                                ) ||
                                (event.ctrlKey && event.keyCode === 85)
                            ) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
                        if (isFirefox) {
                            if (((event.ctrlKey && event.shiftKey) && (event.keyCode === 73 || event.keyCode === 74 || event.keyCode === 67 || event.keyCode === 75 || event.keyCode === 69)) || event.keyCode === 118 || event.keyCode === 116 || (event.keyCode === 112 && event.shiftKey) || (event.keyCode === 115 && event.shiftKey) || (event.keyCode === 118 && event.shiftKey) || (event.keyCode === 120 && event.shiftKey) || (event.keyCode === 85 && event.ctrlKey)) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
                        if (isOpera) {
                            if (((event.ctrlKey && event.shiftKey) && (event.keyCode === 73 || event.keyCode === 74 || event.keyCode === 67 || event.keyCode === 88 || event.keyCode === 69)) || (event.ctrlKey && event.keyCode === 85)) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
						<?php endif; ?>

						<?php if($enable_ctrls) : ?>
                        if ((event.keyCode === 83 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrls_mess ?>);
                            audio_play(<?php echo $enable_ctrls_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrla) : ?>
                        if (event.keyCode === 65 && event.ctrlKey) {
                            show_tooltip(<?php echo $enable_ctrla_mess ?>);
                            audio_play(<?php echo $enable_ctrla_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlc) : ?>
                        if (event.keyCode === 67 && event.ctrlKey && !event.shiftKey) {
                            show_tooltip(<?php echo $enable_ctrlc_mess ?>);
                            audio_play(<?php echo $enable_ctrlc_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlv) : ?>
                        if ((event.keyCode === 86 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlv_mess ?>);
                            audio_play(<?php echo $enable_ctrlv_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlx) : ?>
                        if ((event.keyCode === 88 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlx_mess ?>);
                            audio_play(<?php echo $enable_ctrlx_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlu) : ?>
                        if ((event.keyCode === 85 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlu_mess ?> );
                            audio_play(<?php echo $enable_ctrlu_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlf) : ?>
                        if ((event.keyCode === 70 && event.ctrlKey)) {
                            show_tooltip(<?php echo $enable_ctrlu_mess ?> );
                            audio_play(<?php echo $enable_ctrlu_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_f12) : ?>
                        if (event.keyCode === 123 || (event.keyCode === 123 && event.shiftKey)) {
                            show_tooltip(<?php echo $enable_f12_mess ?>);
                            audio_play(<?php echo $enable_f12_audio?>);
                            return false;
                        }
						<?php endif; ?>
                    } else if (BrowserDetect.OS === 'Mac') {
						<?php if($enable_developer_tools) : ?>
                        if (isChrome || isSafari || isOpera || isFirefox) {
                            if (event.metaKey && (
                                event.keyCode === 73 ||
                                event.keyCode === 74 ||
                                event.keyCode === 69 ||
                                event.keyCode === 75)) {
                                show_tooltip(<?php echo $enable_developer_tools_mess ?>);
                                audio_play(<?php echo $enable_developer_tools_audio?>);
                                return false;
                            }
                        }
						<?php endif; ?>

						<?php if($enable_ctrls) : ?>
                        if ((event.keyCode === 83 && event.metaKey)) {
                            show_tooltip(<?php echo $enable_ctrls_mess ?>);
                            audio_play(<?php echo $enable_ctrls_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrla) : ?>
                        if ((event.keyCode === 65 && event.metaKey)) {
                            show_tooltip(<?php echo $enable_ctrla_mess ?>);
                            audio_play(<?php echo $enable_ctrla_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlc) : ?>
                        if ((event.keyCode === 67 && event.metaKey)) {
                            show_tooltip(<?php echo $enable_ctrlc_mess ?>);
                            audio_play(<?php echo $enable_ctrlc_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlv) : ?>
                        if ((event.keyCode === 86 && event.metaKey)) {
                            show_tooltip(<?php echo $enable_ctrlv_mess ?>);
                            audio_play(<?php echo $enable_ctrlv_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlx) : ?>
                        if ((event.keyCode === 88 && event.metaKey)) {
                            show_tooltip(<?php echo $enable_ctrlx_mess ?>);
                            audio_play(<?php echo $enable_ctrlx_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlu) : ?>
                        if ((event.keyCode === 85 && event.metaKey)) {
                            show_tooltip(<?php echo $enable_ctrlu_mess ?> );
                            audio_play(<?php echo $enable_ctrlu_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_ctrlf) : ?>
                        if ((event.keyCode === 70 && event.metaKey)) {
                            show_tooltip(<?php echo $enable_ctrlu_mess ?> );
                            audio_play(<?php echo $enable_ctrlu_audio?>);
                            return false;
                        }
						<?php endif; ?>

						<?php if($enable_f12) : ?>
                        if (event.keyCode === 123) {
                            show_tooltip(<?php echo $enable_f12_mess ?>);
                            audio_play(<?php echo $enable_f12_audio?>);
                            return false;
                        }
						<?php endif; ?>
                    }
                });

                function disableSelection(e) {
                    if (typeof e.onselectstart !== "undefined")
                        e.onselectstart = function () {
                            show_tooltip(<?php echo $enable_left_click_mess ?> );
                            audio_play(<?php echo $enable_left_click_audio?>);
                            return false
                        };
                    else if (typeof e.style.MozUserSelect !== "undefined")
                        e.style.MozUserSelect = "none";
                    else e.onmousedown = function () {
                            show_tooltip(<?php echo $enable_left_click_mess ?>);
                            audio_play(<?php echo $enable_left_click_audio?>);
                            return false
                        };
                    e.style.cursor = "default"
                }

                function show_tooltip(mess) {
                    if (mess) {
                        $('#ays_tooltip').css({'display': 'table'});
                        setTimeout(function () {
                            $('#ays_tooltip').fadeOut(<?=$timeout / 2?>);
                        }, <?=$timeout?>);
                    }
                }

                function audio_play(audio) {
                    if (audio) {
                        var audio = document.getElementById("sccp_public_audio");
                        if (audio) {
                            audio.currentTime = 0;
                            audio.play();
                        }

                    }
                }


            });
        })(jQuery);

        var BrowserDetect = {
            init: function () {
                this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
                this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version";
                this.OS = this.searchString(this.dataOS) || "an unknown OS";
            },
            searchString: function (data) {
                for (var i = 0; i < data.length; i++) {
                    var dataString = data[i].string;
                    var dataProp = data[i].prop;
                    this.versionSearchString = data[i].versionSearch || data[i].identity;
                    if (dataString) {
                        if (dataString.indexOf(data[i].subString) !== -1) return data[i].identity;
                    } else if (dataProp) return data[i].identity;
                }
            },
            searchVersion: function (dataString) {
                var index = dataString.indexOf(this.versionSearchString);
                if (index === -1) return;
                return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
            },
            dataBrowser: [{
                string: navigator.userAgent,
                subString: "Chrome",
                identity: "Chrome"
            }, {
                string: navigator.userAgent,
                subString: "OmniWeb",
                versionSearch: "OmniWeb/",
                identity: "OmniWeb"
            }, {
                string: navigator.vendor,
                subString: "Apple",
                identity: "Safari",
                versionSearch: "Version"
            }, {
                prop: window.opera,
                identity: "Opera",
                versionSearch: "Version"
            }, {
                string: navigator.vendor,
                subString: "iCab",
                identity: "iCab"
            }, {
                string: navigator.vendor,
                subString: "KDE",
                identity: "Konqueror"
            }, {
                string: navigator.userAgent,
                subString: "Firefox",
                identity: "Firefox"
            }, {
                string: navigator.vendor,
                subString: "Camino",
                identity: "Camino"
            }, { // for newer Netscapes (6+)
                string: navigator.userAgent,
                subString: "Netscape",
                identity: "Netscape"
            }, {
                string: navigator.userAgent,
                subString: "MSIE",
                identity: "Explorer",
                versionSearch: "MSIE"
            }, {
                string: navigator.userAgent,
                subString: "Gecko",
                identity: "Mozilla",
                versionSearch: "rv"
            }, { // for older Netscapes (4-)
                string: navigator.userAgent,
                subString: "Mozilla",
                identity: "Netscape",
                versionSearch: "Mozilla"
            }],
            dataOS: [{
                string: navigator.platform,
                subString: "Win",
                identity: "Windows"
            }, {
                string: navigator.platform,
                subString: "Mac",
                identity: "Mac"
            }, {
                string: navigator.userAgent,
                subString: "iPhone",
                identity: "iPhone/iPod"
            }, {
                string: navigator.platform,
                subString: "Linux",
                identity: "Linux"
            }]
        };
        BrowserDetect.init();
    </script>
<?php endif; ?>