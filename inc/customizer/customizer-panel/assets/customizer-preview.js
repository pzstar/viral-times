/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

function viral_times_dynamic_css(control, style) {
    jQuery('style.' + control).remove();

    jQuery('head').append(
        '<style class="' + control + '">' + style + '</style>'
    );
}

function viral_times_get_contrast(hexcolor) {
    var hex = String(hexcolor).replace(/[^0-9a-f]/gi, '');
    if (hex.length < 6) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    var r = parseInt(hex.substr(0, 2), 16);
    var g = parseInt(hex.substr(2, 2), 16);
    var b = parseInt(hex.substr(4, 2), 16);
    var contrast = ((r * 299) + (g * 587) + (b * 114)) / 1000;
    return contrast;
}

function viral_times_convert_hex(hexcolor, opacity) {
    var hex = String(hexcolor).replace(/[^0-9a-f]/gi, '');
    if (hex.length < 6) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    r = parseInt(hex.substring(0, 2), 16);
    g = parseInt(hex.substring(2, 4), 16);
    b = parseInt(hex.substring(4, 6), 16);

    result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
    return result;
}

(function ($) {
    wp.customize.bind('preview-ready', function () {
        wp.customize.preview.bind('viral-times-gdpr-add-class', function (data) {
            if (true === data.expanded) {
                $('body').addClass('customizer-gdpr-section');
            }
        });

        wp.customize.preview.bind('viral-times-gdpr-remove-class', function (data) {
            $('body').removeClass('customizer-gdpr-section');
        });
    });

    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.ht-site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.ht-site-description').text(to);
        });
    });

    wp.customize('viral_times_tagline_position', function (value) {
        value.bind(function (to) {
            $('#ht-masthead').removeClass('ht-tagline-inline-logo ht-tagline-below-logo').addClass(to);
        });
    });

    wp.customize('viral_times_website_layout', function (value) {
        value.bind(function (to) {
            $('body').removeClass('ht-boxed ht-wide ht-fluid');
            $('body').addClass('ht-' + to);
        });
    });

    wp.customize('viral_times_th_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header{background:' + to + '}';
            css += '.th-menu ul ul{background:' + to + '}';
            viral_times_dynamic_css('viral_times_th_bg_color', css);
        });
    });

    wp.customize('viral_times_th_bottom_border_color', function (value) {
        value.bind(function (to) {
            if (to) {
                var css = '.ht-site-header .ht-top-header{border-bottom:1px solid ' + to + '}';
            } else {
                var css = '.ht-site-header .ht-top-header{border-bottom:none}';
            }
            viral_times_dynamic_css('viral_times_th_bottom_border_color', css);
        });
    });

    wp.customize('viral_times_th_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header{color:' + to + '}';
            viral_times_dynamic_css('viral_times_th_text_color', css);
        });
    });

    wp.customize('viral_times_th_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header a,.ht-site-header .ht-top-header a:hover,.ht-site-header .ht-top-header a i,.ht-site-header .ht-top-header a:hover i{color:' + to + '}';
            viral_times_dynamic_css('viral_times_th_anchor_color', css);
        });
    });

    wp.customize('viral_times_th_height', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header .ht-container{height:' + to + 'px}';
            css += '.th-menu > ul > li > a{line-height: ' + to + 'px;}';

            viral_times_dynamic_css('viral_times_th_height', css);
        });
    });

    wp.customize('viral_times_th_disable_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $('#ht-masthead').addClass('ht-topheader-mobile-disable');
            } else {
                $('#ht-masthead').removeClass('ht-topheader-mobile-disable');
            }
        });
    });

    wp.customize('viral_times_mh_bg_color_mobile', function (value) {
        value.bind(function (to) {
            var responsiveWidth = wp.customize('viral_times_responsive_width').get();
            var css = '@media screen and (max-width:' + responsiveWidth + 'px){.ht-header-two .ht-header .ht-main-navigation, .ht-header-five .ht-main-navigation{background:' + to + '}}';
            viral_times_dynamic_css('viral_times_mh_bg_color_mobile', css);
        });
    });

    wp.customize('viral_times_mh_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-header,.ht-header-five .ht-header{background:' + to + '}';
            viral_times_dynamic_css('viral_times_mh_bg_color', css);
        });
    });

    wp.customize('viral_times_mh_height', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-header .ht-container,.ht-header-five .ht-header .ht-container{height:' + to + 'px}';
            css += '.hover-style6 .ht-menu > ul > li.menu-item > a{line-height:' + to + 'px}';

            viral_times_dynamic_css('viral_times_mh_height', css);
        });
    });

    wp.customize('viral_times_logo_height', function (value) {
        value.bind(function (to) {
            var responsive_width = wp.customize('viral_times_responsive_width').get();
            var css = '#ht-site-branding img{height:' + to + 'px}';
            css += '@media screen and (max-width:' + responsive_width + 'px){.ht-header-two #ht-site-branding img, .ht-header-five #ht-site-branding img{height: auto;max-height: ' + to + 'px;}}';
            viral_times_dynamic_css('viral_times_logo_height', css);
        });
    });

    wp.customize('viral_times_logo_padding', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two #ht-site-branding, .ht-header-five #ht-site-branding{padding-top:' + to + 'px;padding-bottom:' + to + 'px}';
            viral_times_dynamic_css('viral_times_logo_padding', css);
        });
    });

    wp.customize('viral_times_mh_border', function (value) {
        value.bind(function (to) {
            $('#ht-masthead').removeClass('ht-no-border ht-top-border ht-bottom-border ht-top-bottom-border').addClass(to);
        });
    });

    wp.customize('viral_times_mh_border_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header.ht-header-two .ht-header,.ht-site-header.ht-header-five .ht-header{border-color:' + to + '}';
            viral_times_dynamic_css('viral_times_mh_border_color', css);
        });
    });

    wp.customize('viral_times_mh_button_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-middle-header-left a, .ht-header-two .ht-middle-header-right>div>a{color:' + to + ' !important}';
            viral_times_dynamic_css('viral_times_mh_button_color', css);
        });
    });

    wp.customize('viral_times_website_width', function (value) {
        value.bind(function (container_width) {
            var container_padding = wp.customize('viral_times_container_padding').get();
            var full_container_padding = wp.customize('viral_times_container_padding').get() * 2;
            var boxed_container_width = parseInt(container_width) + parseInt(full_container_padding);
            var css = '.ht-container,.ht-slide-caption{max-width:' + container_width + 'px}';
            css += 'body.ht-boxed #ht-page{max-width:' + boxed_container_width + 'px;}';
            css += 'body.ht-boxed .ht-fullwidth-container{margin-left:-' + container_padding + 'px !important;margin-right:-' + container_padding + 'px !important;}';
            viral_times_dynamic_css('viral_times_website_width', css);
        });
    });

    wp.customize('viral_times_fluid_container_width', function (value) {
        value.bind(function (container_width) {
            var css = 'body.ht-fluid .ht-container,body.ht-fluid .ht-slide-caption{max-width:' + container_width + '%}';
            viral_times_dynamic_css('viral_times_fluid_container_width', css);
        });
    });

    wp.customize('viral_times_container_padding', function (value) {
        value.bind(function (container_padding) {
            var container_width = wp.customize('viral_times_website_width').get();
            var boxed_container_width = parseInt(container_width) + parseInt(container_padding) * 2;
            var css = '.ht-container,.ht-slide-caption{max-width:' + container_width + 'px}';
            css += 'body.ht-boxed #ht-page{max-width:' + boxed_container_width + 'px;}';
            css += 'body.ht-boxed .ht-fullwidth-container{margin-left:-' + container_padding + 'px !important;margin-right:-' + container_padding + 'px !important;}';
            viral_times_dynamic_css('viral_times_container_padding', css);
        });
    });

    wp.customize('viral_times_sidebar_width', function (value) {
        value.bind(function (to) {
            var primary = 100 - 4 - parseInt(to);
            var css = '#primary{width:' + primary + '%}';
            css += '#secondary{width:' + to + '%;}';
            viral_times_dynamic_css('viral_times_sidebar_width', css);
        });
    });

    wp.customize('viral_times_mh_menu_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu > ul > li.menu-item > a,.ht-search-button a,.ht-header-social-icons a{color:' + to + '}';
            viral_times_dynamic_css('viral_times_mh_menu_color', css);
        });
    });

    wp.customize('viral_times_mh_menu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-search-button a:hover,.ht-header-social-icons a:hover,.ht-menu > ul > li.menu-item:hover > a,.ht-menu > ul > li.menu-item:hover > a > i,.ht-menu > ul > li.menu-item.current_page_item > a,.ht-menu > ul > li.menu-item.current-menu-item > a,.ht-menu > ul > li.menu-item.current_page_ancestor > a,.ht-menu > ul > li.menu-item.current > a{color:' + to + '}';
            css += '.hover-style6 .ht-menu > ul > li.menu-item:hover > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current_page_item > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current-menu-item > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current_page_ancestor > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current > a:before{background:' + to + '}';
            viral_times_dynamic_css('viral_times_mh_menu_hover_color', css);
        });
    });

    wp.customize('viral_times_mh_submenu_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu ul ul,.menu-item-ht-cart .widget_shopping_cart,#ht-responsive-menu{background:' + to + '}';
            viral_times_dynamic_css('viral_times_mh_submenu_bg_color', css);
        });
    });

    wp.customize('viral_times_mh_submenu_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu ul ul li.menu-item>a,.menu-item-ht-cart .widget_shopping_cart a,.menu-item-ht-cart .widget_shopping_cart,#ht-responsive-menu li.menu-item>a,#ht-responsive-menu li.menu-item>a i,#ht-responsive-menu li .dropdown-nav{color:' + to + '}';
            viral_times_dynamic_css('viral_times_mh_submenu_color', css);
        });
    });

    wp.customize('viral_times_mh_submenu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu ul ul li.menu-item>a:hover i,.menu-item-ht-cart .widget_shopping_cart a:hover{color:' + to + '}';
            viral_times_dynamic_css('viral_times_mh_submenu_hover_color', css);
        });
    });

    wp.customize('viral_times_menu_dropdown_padding', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu>ul>li.menu-item{padding-top:' + to + 'px;padding-bottom:' + to + 'px}';
            viral_times_dynamic_css('viral_times_menu_dropdown_padding', css);
        });
    });

    wp.customize('viral_times_footer_bg_url', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-image:url(' + to + ')}';
            viral_times_dynamic_css('viral_times_footer_bg_url', css);
        });
    });

    wp.customize('viral_times_footer_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-repeat:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_bg_repeat', css);
        });
    });

    wp.customize('viral_times_footer_bg_size', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-size:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_bg_size', css);
        });
    });

    wp.customize('viral_times_footer_bg_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = '#ht-colophon{background-position:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_bg_position', css);
        });
    });

    wp.customize('viral_times_footer_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-attachment:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_bg_attach', css);
        });
    });

    wp.customize('viral_times_footer_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-footer:before{background-color:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_bg_color', css);
        });
    });

    wp.customize('viral_times_footer_title_color', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon .widget-title{color:' + to + '}';
            css += '.ht-sidebar-style6 .ht-site-footer .widget-title:after{background-color:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_title_color', css);
        });
    });

    wp.customize('viral_times_footer_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-footer *{color:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_text_color', css);
        });
    });

    wp.customize('viral_times_footer_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-footer a,.ht-site-footer a *{color:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_anchor_color', css);
        });
    });

    wp.customize('viral_times_footer_border_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-footer .ht-container{border-color:' + to + '}';
            viral_times_dynamic_css('viral_times_footer_border_color', css);
        });
    });

    wp.customize('viral_times_footer_copyright', function (value) {
        value.bind(function (to) {
            $('.ht-site-info').html(to);
        });
    });

    var settingIds = ['slider1', 'mininews', 'leftnews', 'rightnews', 'carousel1'];

    $.each(settingIds, function (i, settingId) {
        wp.customize('viral_times_' + settingId + '_overwrite_block_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                if (to) {
                    $(sectionClass).addClass('ht-overwrite-color');
                } else {
                    $(sectionClass).removeClass('ht-overwrite-color');
                }
            });
        });

        wp.customize('viral_times_' + settingId + '_bg_type', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                if ('color-bg' == to) {
                    var color = wp.customize('viral_times_' + settingId + '_bg_color').get();
                    var css = sectionClass + '{background-color:' + color + '}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_color', css);

                    var css = sectionClass + ' .ht-section-wrap{background-color:transparent}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_overlay_color', css);

                    var css = sectionClass + '{background-image:none}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_url', css);

                } else if ('image-bg' == to) {
                    var image = wp.customize('viral_times_' + settingId + '_bg_image_url').get();
                    var css = sectionClass + '{background-image:url(' + image + ')}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_url', css);

                    var image_repeat = wp.customize('viral_times_' + settingId + '_bg_image_repeat').get();
                    var css = sectionClass + '{background-repeat:' + image_repeat + '}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_repeat', css);

                    var image_size = wp.customize('viral_times_' + settingId + '_bg_image_size').get();
                    var css = sectionClass + '{background-size:' + image_size + '}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_size', css);

                    var image_position = wp.customize('viral_times_' + settingId + '_bg_position').get();
                    image_position = image_position.replace('-', ' ');
                    var css = sectionClass + '{background-position:' + image_position + '}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_position', css);

                    var image_attach = wp.customize('viral_times_' + settingId + '_bg_image_attach').get();
                    var css = sectionClass + '{background-attachment:' + image_attach + '}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_attach', css);

                    var color = wp.customize('viral_times_' + settingId + '_bg_color').get();
                    var css = sectionClass + '{background-color:' + color + '}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_bg_color', css);

                    var color_overlay = wp.customize('viral_times_' + settingId + '_overlay_color').get();
                    var css = sectionClass + ' .ht-section-wrap{background-color:' + color_overlay + '}';
                    viral_times_dynamic_css('viral_times_' + settingId + '_overlay_color', css);
                }
            });
        });

        wp.customize('viral_times_' + settingId + '_bg_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-color:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_bg_color', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_bg_image_url', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-image:url(' + to + ')}';
                viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_url', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_bg_image_repeat', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-repeat:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_repeat', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_bg_image_size', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-size:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_size', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_bg_position', function (value) {
            value.bind(function (to) {
                to = to.replace('-', ' ');
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-position:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_bg_position', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_bg_image_attach', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-attachment:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_bg_image_attach', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_overlay_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-wrap{background-color:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_overlay_color', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' h1, ' + sectionClass + ' h2, ' + sectionClass + ' h3, ' + sectionClass + ' h4, ' + sectionClass + ' h5, ' + sectionClass + ' h6{color:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_title_color', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_text_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-wrap{color:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_text_color', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_link_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' a{color:' + to + '}';
                if (settingId == "carousel1" || settingId == "carousel2") {
                    css += sectionClass + ' .vl-carousel-block.style1 .vl-carousel-heading .vl-primary-cat,' + sectionClass + ' .vl-carousel-block.style3 .vl-carousel-heading .vl-primary-cat{color:' + to + '}';
                }
                viral_times_dynamic_css('viral_times_' + settingId + '_link_color', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_block_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title{color:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_block_title_color', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_block_title_background_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = '.ht-block-title-style9 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style9 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title:before{background-color:' + to + '}';
                css += '.ht-block-title-style9 ' + sectionClass + '.ht-overwrite-color .vl-block-header{border-color:' + to + '}';
                viral_times_dynamic_css('viral_times_' + settingId + '_block_title_background_color', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }

                var tablet = wp.customize('viral_times_' + settingId + '_tablet_padding_top').get();
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_tablet_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_padding_top').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_mobile_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_padding_top').get();
                var tablet = wp.customize('viral_times_' + settingId + '_tablet_padding_top').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_times_' + settingId + '_tablet_padding_bottom').get();
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_tablet_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_padding_bottom').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_mobile_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_padding_bottom').get();
                var tablet = wp.customize('viral_times_' + settingId + '_tablet_padding_bottom').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_times_' + settingId + '_tablet_margin_top').get();
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_margin_top').get();

                var css = sectionClass + ' .ht-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_tablet_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_margin_top').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_margin_top').get();

                var css = sectionClass + ' .ht-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_mobile_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_margin_top').get();
                var tablet = wp.customize('viral_times_' + settingId + '_tablet_margin_top').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_times_' + settingId + '_tablet_margin_bottom').get();
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_margin_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_tablet_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_margin_bottom').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_times_' + settingId + '_mobile_margin_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_times_' + settingId + '_mobile_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_times_' + settingId + '_margin_bottom').get();
                var tablet = wp.customize('viral_times_' + settingId + '_tablet_margin_bottom').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_times_dynamic_css('viral_times_' + settingId + '_margin_bottom', css);
            });
        });

    });

    wp.customize('viral_times_content_header_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-main-content h1, .ht-main-content h2, .ht-main-content h3, .ht-main-content h4, .ht-main-content h5, .ht-main-content h6, .ht-main-content .widget-title{color:" + to + "}";
            viral_times_dynamic_css('viral_times_content_header_color', css);
        });
    });

    wp.customize('viral_times_content_text_color', function (value) {
        value.bind(function (to) {
            var lightColor = viral_times_convert_hex(to, 10);
            var css = ".ht-main-content{color:" + to + "}";
            css += ".single-entry-tags a, .widget-area .tagcloud a{border-color:" + to + "}";
            css += '.comment-list .sp-comment-content, .post-navigation, .post-navigation .nav-next{border-color:' + lightColor + '}';
            viral_times_dynamic_css('viral_times_content_text_color', css);
        });
    });

    wp.customize('viral_times_content_link_color', function (value) {
        value.bind(function (to) {
            var css = "a{color:" + to + "}";
            viral_times_dynamic_css('viral_times_content_link_color', css);
        });
    });

    wp.customize('viral_times_content_link_hov_color', function (value) {
        value.bind(function (to) {
            var css = "a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .breadcrumb-trail a:hover{color:" + to + "}";
            viral_times_dynamic_css('viral_times_content_link_hov_color', css);
        });
    });

    wp.customize('viral_times_content_widget_title_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-main-content .widget-title{color:" + to + "}";
            css += '.ht-sidebar-style6 .ht-site-wrapper .widget-title:after {background-color:' + to + '}';
            viral_times_dynamic_css('viral_times_content_widget_title_color', css);
        });
    });

    wp.customize('viral_times_block_title_color', function (value) {
        value.bind(function (to) {
            var css = ".vl-block-title span.vl-title{color:" + to + "}";
            viral_times_dynamic_css('viral_times_block_title_color', css);
        });
    });

    wp.customize('viral_times_block_title_background_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-block-title-style9 .vl-block-header .vl-block-title span.vl-title{background-color:' + to + '}';
            css += '.ht-block-title-style9 .vl-block-header {border-color:' + to + '}';
            viral_times_dynamic_css('viral_times_block_title_background_color', css);
        });
    });

    wp.customize('viral_times_frontpage_section_spacing', function (value) {
        value.bind(function (to) {
            var css = '#vl-video-playlist, .vl-carousel-block, .vl-slider-block, .vl-news-block, .ht-mininews-section .ht-non-fullwidth-container, .ht-mininews-section .ht-fullwidth-container, .ht-section .widget{margin-bottom:' + to + 'px}';
            viral_times_dynamic_css('viral_times_frontpage_section_spacing', css);
        });
    });

    wp.customize('viral_times_toggle_button_color', function (value) {
        value.bind(function (to) {
            var css = ".collapse-button{border-color:" + to + "}";
            css += ".collapse-button .icon-bar{background:" + to + "}";
            viral_times_dynamic_css('viral_times_toggle_button_color', css);
        });
    });

    /* Typography */
    wp.customize(
        'body_font_style',
        function (value) {
            value.bind(
                function (to) {
                    var weight = to.replace(/\D/g, '');
                    var style = to.replace(/\d+/g, '');
                    if ('' == style) {
                        style = 'normal';
                    }
                    var css = 'html, body, button, input, select, textarea{font-weight:' + weight + ';font-style:' + style + '}';
                    viral_times_dynamic_css('body_font_style', css);
                }
            );
        }
    );

    wp.customize(
        'body_text_transform',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'html, body, button, input, select, textarea{text-transform:' + to + '}';
                    viral_times_dynamic_css('body_text_transform', css);
                }
            );
        }
    );

    wp.customize(
        'body_text_decoration',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'html, body, button, input, select, textarea{text-decoration:' + to + '}';
                    viral_times_dynamic_css('body_text_decoration', css);
                }
            );
        }
    );

    wp.customize(
        'body_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'html, body, button, input, select, textarea{font-size:' + to + 'px}';
                    viral_times_dynamic_css('body_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'body_line_height',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'html, body, button, input, select, textarea{line-height:' + to + '}';
                    viral_times_dynamic_css('body_line_height', css);
                }
            );
        }
    );

    wp.customize(
        'body_letter_spacing',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.html, body, button, input, select, textarea{letter-spacing:' + to + 'px}';
                    viral_times_dynamic_css('body_letter_spacing', css);
                }
            );
        }
    );

    wp.customize(
        'body_color',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'html, body, button, input, select, textarea{color:' + to + '}';
                    viral_times_dynamic_css('body_color', css);
                }
            );
        }
    );

    /*=== Menu ===*/
    wp.customize(
        'menu_font_style',
        function (value) {
            value.bind(
                function (to) {
                    var weight = to.replace(/\D/g, '');
                    var style = to.replace(/\d+/g, '');
                    if ('' == style) {
                        style = 'normal';
                    }
                    var css = '.ht-menu > ul > li > a{font-weight:' + weight + ';font-style:' + style + '}';
                    viral_times_dynamic_css('menu_font_style', css);
                }
            );
        }
    );

    wp.customize(
        'menu_text_transform',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-menu > ul > li > a{text-transform:' + to + '}';
                    viral_times_dynamic_css('menu_text_transform', css);
                }
            );
        }
    );

    wp.customize(
        'menu_text_decoration',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-menu > ul > li > a{text-decoration:' + to + '}';
                    viral_times_dynamic_css('menu_text_decoration', css);
                }
            );
        }
    );

    wp.customize(
        'menu_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-main-navigation, .ht-menu > ul > li > a{font-size:' + to + 'px}';
                    viral_times_dynamic_css('menu_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'menu_line_height',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-menu > ul > li > a{line-height:' + to + '}';
                    viral_times_dynamic_css('menu_line_height', css);
                }
            );
        }
    );

    wp.customize(
        'menu_letter_spacing',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-menu > ul > li > a{letter-spacing:' + to + 'px}';
                    viral_times_dynamic_css('menu_letter_spacing', css);
                }
            );
        }
    );

    /*=== Page Title ===*/
    wp.customize(
        'page_title_font_style',
        function (value) {
            value.bind(
                function (to) {
                    var weight = to.replace(/\D/g, '');
                    var style = to.replace(/\d+/g, '');
                    if ('' == style) {
                        style = 'normal';
                    }
                    var css = '.ht-main-title, .single-post .entry-title{font-weight:' + weight + ';font-style:' + style + '}';
                    viral_times_dynamic_css('page_title_font_style', css);
                }
            );
        }
    );

    wp.customize(
        'page_title_text_transform',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-main-title, .single-post .entry-title{text-transform:' + to + '}';
                    viral_times_dynamic_css('page_title_text_transform', css);
                }
            );
        }
    );

    wp.customize(
        'page_title_text_decoration',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-main-title, .single-post .entry-title{text-decoration:' + to + '}';
                    viral_times_dynamic_css('page_title_text_decoration', css);
                }
            );
        }
    );

    wp.customize(
        'page_title_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-main-title, .single-post .entry-title{font-size:' + to + 'px}';
                    viral_times_dynamic_css('page_title_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'page_title_line_height',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-main-title, .single-post .entry-title{line-height:' + to + '}';
                    viral_times_dynamic_css('page_title_line_height', css);
                }
            );
        }
    );

    wp.customize(
        'page_title_color',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-main-title, .single-post .entry-title{color:' + to + '}';
                    viral_times_dynamic_css('page_title_color', css);
                }
            );
        }
    );

    wp.customize(
        'page_title_letter_spacing',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.ht-main-title, .single-post .entry-title{letter-spacing:' + to + 'px}';
                    viral_times_dynamic_css('page_title_letter_spacing', css);
                }
            );
        }
    );

    /*=== Front Page Post Title ===*/
    wp.customize(
        'frontpage_title_font_style',
        function (value) {
            value.bind(
                function (to) {
                    var weight = to.replace(/\D/g, '');
                    var style = to.replace(/\d+/g, '');
                    if ('' == style) {
                        style = 'normal';
                    }
                    var css = 'h3.vl-post-title{font-weight:' + weight + ';font-style:' + style + '}';
                    viral_times_dynamic_css('frontpage_title_font_style', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_title_text_transform',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h3.vl-post-title{text-transform:' + to + '}';
                    viral_times_dynamic_css('frontpage_title_text_transform', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_title_text_decoration',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h3.vl-post-title{text-decoration:' + to + '}';
                    viral_times_dynamic_css('frontpage_title_text_decoration', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_title_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h3.vl-post-title{font-size:' + to + 'px}';
                    viral_times_dynamic_css('frontpage_title_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_title_line_height',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h3.vl-post-title{line-height:' + to + '}';
                    viral_times_dynamic_css('frontpage_title_line_height', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_title_letter_spacing',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h3.vl-post-title{letter-spacing:' + to + 'px}';
                    viral_times_dynamic_css('frontpage_title_letter_spacing', css);
                }
            );
        }
    );

    /*=== Front Page Block Title ===*/
    wp.customize(
        'frontpage_block_title_font_style',
        function (value) {
            value.bind(
                function (to) {
                    var weight = to.replace(/\D/g, '');
                    var style = to.replace(/\d+/g, '');
                    if ('' == style) {
                        style = 'normal';
                    }
                    var css = '.vl-block-title span.vl-title, .vp-block-title span.vl-title{font-weight:' + weight + ';font-style:' + style + '}';
                    viral_times_dynamic_css('frontpage_block_title_font_style', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_block_title_text_transform',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.vl-block-title span.vl-title, .vp-block-title span.vl-title{text-transform:' + to + '}';
                    viral_times_dynamic_css('frontpage_block_title_text_transform', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_block_title_text_decoration',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.vl-block-title span.vl-title, .vp-block-title span.vl-title{text-decoration:' + to + '}';
                    viral_times_dynamic_css('frontpage_block_title_text_decoration', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_block_title_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.vl-block-title span.vl-title, .vp-block-title span.vl-title{font-size:' + to + 'px}';
                    viral_times_dynamic_css('frontpage_block_title_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_block_title_line_height',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.vl-block-title span.vl-title, .vp-block-title span.vl-title{line-height:' + to + '}';
                    viral_times_dynamic_css('frontpage_block_title_line_height', css);
                }
            );
        }
    );

    wp.customize(
        'frontpage_block_title_letter_spacing',
        function (value) {
            value.bind(
                function (to) {
                    var css = '.vl-block-title span.vl-title, .vp-block-title span.vl-title{letter-spacing:' + to + 'px}';
                    viral_times_dynamic_css('frontpage_block_title_letter_spacing', css);
                }
            );
        }
    );

    /* === <h> === */
    wp.customize(
        'h_font_style',
        function (value) {
            value.bind(
                function (to) {
                    var weight = to.replace(/\D/g, '');
                    var style = to.replace(/\d+/g, '');
                    if ('' == style) {
                        style = 'normal';
                    }
                    var css = 'h1, h2, h3, h4, h5, h6, .ht-site-title{font-weight:' + weight + ';font-style:' + style + '}';
                    viral_times_dynamic_css('h_font_style', css);
                }
            );
        }
    );

    wp.customize(
        'h_text_transform',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h1, h2, h3, h4, h5, h6, .ht-site-title{text-transform:' + to + '}';
                    viral_times_dynamic_css('h_text_transform', css);
                }
            );
        }
    );

    wp.customize(
        'h_text_decoration',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h1, h2, h3, h4, h5, h6, .ht-site-title{text-decoration:' + to + '}';
                    viral_times_dynamic_css('h_text_decoration', css);
                }
            );
        }
    );

    wp.customize(
        'h_line_height',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h1, .ht-site-title, .entry-header div.entry-title, h2, h3, h4, h5, h6{line-height:' + to + '}';
                    viral_times_dynamic_css('h_line_height', css);
                }
            );
        }
    );

    wp.customize(
        'h_letter_spacing',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h1, h2, h3, h4, h5, h6, .ht-site-title{letter-spacing:' + to + 'px}';
                    viral_times_dynamic_css('h_letter_spacing', css);
                }
            );
        }
    );

    wp.customize(
        'hh1_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h1, .ht-site-title{font-size:' + to + 'px}';
                    viral_times_dynamic_css('hh1_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'hh2_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h2{font-size:' + to + 'px}';
                    viral_times_dynamic_css('hh2_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'hh3_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h3{font-size:' + to + 'px}';
                    viral_times_dynamic_css('hh3_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'hh4_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h4{font-size:' + to + 'px}';
                    viral_times_dynamic_css('hh4_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'hh5_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h5{font-size:' + to + 'px}';
                    viral_times_dynamic_css('hh5_font_size', css);
                }
            );
        }
    );

    wp.customize(
        'hh6_font_size',
        function (value) {
            value.bind(
                function (to) {
                    var css = 'h6{font-size:' + to + 'px}';
                    viral_times_dynamic_css('hh6_font_size', css);
                }
            );
        }
    );

})(jQuery);