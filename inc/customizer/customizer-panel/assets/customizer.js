jQuery(document).ready(function ($) {

    'use strict';

    $('body').on('click', '#customize-control-viral_times_maintenance_social a, #customize-control-viral_times_social_link a, #customize-control-viral_times_contact_social_link a', function () {
        wp.customize.section('viral_times_social_section').expand();
        return false;
    });

    $('#sub-accordion-panel-viral_times_front_page_panel').sortable({
        axis: 'y',
        helper: 'clone',
        cursor: 'move',
        items: '> li.control-section:not(#accordion-section-viral-times-frontpage-notice)',
        delay: 150,
        update: function (event, ui) {
            $('#sub-accordion-panel-viral_times_front_page_panel').find('.viral-times-drag-spinner').show();
            viral_times_sections_order('#sub-accordion-panel-viral_times_front_page_panel');
            $('.wp-full-overlay-sidebar-content').scrollTop(0);
        }
    });

    // Homepage section - control visiblity toggle
    var settingIds = ['ticker', 'slider1', 'slider2', 'featured', 'tile1', 'tile2', 'mininews', 'leftnews', 'rightnews', 'fwcarousel', 'carousel1', 'carousel2', 'video', 'fwnews1', 'fwnews2', 'threecol'];

    $.each(settingIds, function (i, settingId) {
        wp.customize('viral_times_' + settingId + '_bg_type', function (setting) {
            var setupControlColorBg = function (control) {
                var visibility = function () {
                    if ('color-bg' === setting.get() || 'image-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlImageBg = function (control) {
                var visibility = function () {
                    if ('image-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlVideoBg = function (control) {
                var visibility = function () {
                    if ('video-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlGradientBg = function (control) {
                var visibility = function () {
                    if ('gradient-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlOverlay = function (control) {
                var visibility = function () {
                    if ('color-bg' === setting.get() || 'gradient-bg' === setting.get()) {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('viral_times_' + settingId + '_bg_color', setupControlColorBg);
            wp.customize.control('viral_times_' + settingId + '_bg_image', setupControlImageBg);
            wp.customize.control('viral_times_' + settingId + '_parallax_effect', setupControlImageBg);
            wp.customize.control('viral_times_' + settingId + '_bg_video', setupControlVideoBg);
            wp.customize.control('viral_times_' + settingId + '_bg_gradient', setupControlGradientBg);
            wp.customize.control('viral_times_' + settingId + '_overlay_color', setupControlOverlay);
        });
    });

    $.each(settingIds, function (i, settingId) {
        wp.customize('viral_times_' + settingId + '_section_seperator', function (setting) {

            var setupTopSeparator = function (control) {
                var visibility = function () {
                    if ('top' === setting.get() || 'top-bottom' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupBottomSeparator = function (control) {
                var visibility = function () {
                    if ('bottom' === setting.get() || 'top-bottom' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('viral_times_' + settingId + '_seperator1', setupTopSeparator);
            wp.customize.control('viral_times_' + settingId + '_top_seperator', setupTopSeparator);
            wp.customize.control('viral_times_' + settingId + '_ts_color', setupTopSeparator);
            wp.customize.control('viral_times_' + settingId + '_ts_height', setupTopSeparator);
            wp.customize.control('viral_times_' + settingId + '_seperator2', setupBottomSeparator);
            wp.customize.control('viral_times_' + settingId + '_bottom_seperator', setupBottomSeparator);
            wp.customize.control('viral_times_' + settingId + '_bs_color', setupBottomSeparator);
            wp.customize.control('viral_times_' + settingId + '_bs_height', setupBottomSeparator);
        });
    });

    $.each(settingIds, function (i, settingId) {
        wp.customize('viral_times_' + settingId + '_enable_fullwindow', function (setting) {

            var setupControlFullWindow = function (control) {
                var visibility = function () {
                    if ('off' === setting.get()) {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('viral_times_' + settingId + '_align_item', setupControlFullWindow);
        });
    });

    $.each(settingIds, function (i, settingId) {
        wp.customize('viral_times_' + settingId + '_overwrite_block_title_color', function (setting) {

            var setupControlHide = function (control) {
                var visibility = function () {
                    if (setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('viral_times_' + settingId + '_block_title_color', setupControlHide);
            wp.customize.control('viral_times_' + settingId + '_block_title_background_color', setupControlHide);
            wp.customize.control('viral_times_' + settingId + '_block_title_border_color', setupControlHide);
        });
    });

    wp.customize('viral_times_blog_layout', function (setting) {
        var setupControlArchiveContentAndLength = function (control) {
            var visibility = function () {
                if ('layout1' === setting.get() || 'layout2' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlAuthorCommentCatTag = function (control) {
            var visibility = function () {
                if ('layout3' === setting.get()) {
                    control.container.addClass('customizer-hidden');
                } else {
                    control.container.removeClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlReadMore = function (control) {
            var visibility = function () {
                if ('layout5' === setting.get() || 'layout6' === setting.get()) {
                    control.container.addClass('customizer-hidden');
                } else {
                    control.container.removeClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_archive_content', setupControlArchiveContentAndLength);
        wp.customize.control('viral_times_archive_excerpt_length', setupControlArchiveContentAndLength);
        wp.customize.control('viral_times_blog_author', setupControlAuthorCommentCatTag);
        wp.customize.control('viral_times_blog_comment', setupControlAuthorCommentCatTag)
        wp.customize.control('viral_times_blog_category', setupControlAuthorCommentCatTag);
        wp.customize.control('viral_times_blog_tag', setupControlAuthorCommentCatTag);
        wp.customize.control('viral_times_archive_readmore', setupControlReadMore);
    });

    wp.customize('viral_times_mh_layout', function (setting) {
        var setupControlHeaderBg = function (control) {
            var visibility = function () {
                if ('header-style7' === setting.get() || 'header-style4' === setting.get() || 'header-style5' === setting.get() || 'header-style2' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlLogo = function (control) {
            var visibility = function () {
                if ('header-style2' === setting.get() || 'header-style4' === setting.get() || 'header-style5' === setting.get() || 'header-style7' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlButtonColor = function (control) {
            var visibility = function () {
                if ('header-style2' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_mh_header_bg', setupControlHeaderBg);

        wp.customize.control('viral_times_logo_padding', setupControlLogo);

        wp.customize.control('viral_times_mh_button_color', setupControlButtonColor);
    });

    wp.customize('viral_times_maintenance_bg_type', function (setting) {
        var setupControlSlider = function (control) {
            var visibility = function () {
                if ('slider' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlShortcode = function (control) {
            var visibility = function () {
                if ('revolution' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBanner = function (control) {
            var visibility = function () {
                if ('banner' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlVideo = function (control) {
            var visibility = function () {
                if ('video' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_maintenance_banner', setupControlBanner);
        wp.customize.control('viral_times_maintenance_slider_shortcode', setupControlShortcode);
        wp.customize.control('viral_times_maintenance_sliders', setupControlSlider);
        wp.customize.control('viral_times_maintenance_slider_info', setupControlSlider);
        wp.customize.control('viral_times_maintenance_slider_pause', setupControlSlider);
        wp.customize.control('viral_times_maintenance_video', setupControlVideo);
    });

    wp.customize('show_on_front', function (setting) {
        var setupControl = function (control) {
            var visibility = function () {
                if ('posts' == setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_display_frontpage_sections', setupControl);
    });

    wp.customize('viral_times_mininews_fullwidth', function (setting) {
        var setupControl = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_mininews_post_count_big', setupControl);
    });

    wp.customize('viral_times_block_title_style', function (setting) {
        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style2' == setting.get() || 'style5' == setting.get() || 'style7' == setting.get() || 'style8' == setting.get() || 'style9' == setting.get() || 'style10' == setting.get() || 'style11' == setting.get() || 'style12' == setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBorder = function (control) {
            var visibility = function () {
                if ('style1' == setting.get() || 'style8' == setting.get() || 'style9' == setting.get() || 'style10' == setting.get() || 'style11' == setting.get() || 'style12' == setting.get()) {
                    control.container.addClass('customizer-hidden');
                } else {
                    control.container.removeClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_block_title_background_color', setupControlBackground);
        wp.customize.control('viral_times_block_title_border_color', setupControlBorder);

        var setupSectionControlBackground = function (control) {
            var visibility = function () {
                if ('style2' == setting.get() || 'style5' == setting.get() || 'style7' == setting.get() || 'style8' == setting.get() || 'style9' == setting.get() || 'style10' == setting.get() || 'style11' == setting.get() || 'style12' == setting.get()) {
                    control.container.removeClass('customizer-section-hidden');
                } else {
                    control.container.addClass('customizer-section-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupSectionControlBorder = function (control) {
            var visibility = function () {
                if ('style1' == setting.get() || 'style8' == setting.get() || 'style9' == setting.get() || 'style10' == setting.get() || 'style11' == setting.get() || 'style12' == setting.get()) {
                    control.container.addClass('customizer-section-hidden');
                } else {
                    control.container.removeClass('customizer-section-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        $.each(settingIds, function (i, settingId) {
            wp.customize.control('viral_times_' + settingId + '_block_title_background_color', setupSectionControlBackground);
            wp.customize.control('viral_times_' + settingId + '_block_title_border_color', setupSectionControlBorder);
        });
    });

    wp.customize('viral_times_website_layout', function (setting) {
        var setupWideLayout = function (control) {
            var visibility = function () {
                if ('wide' === setting.get() || 'boxed' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupBoxedLayout = function (control) {
            var visibility = function () {
                if ('boxed' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupFluidLayout = function (control) {
            var visibility = function () {
                if ('fluid' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_website_width', setupWideLayout);
        wp.customize.control('viral_times_container_padding', setupBoxedLayout);
        wp.customize.control('viral_times_fluid_container_width', setupFluidLayout);
    });

    wp.customize('viral_times_scroll_top_position', function (setting) {
        var setupControlLeft = function (control) {
            var visibility = function () {
                if (setting.get() == 'left') {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlRight = function (control) {
            var visibility = function () {
                if (setting.get() == 'right') {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_times_scroll_top_offset_left', setupControlLeft);
        wp.customize.control('viral_times_scroll_top_offset_right', setupControlRight);
    });

    // Scroll to section
    $('body').on('click', '#sub-accordion-panel-viral_times_front_page_panel .control-subsection .accordion-section-title', function (event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection(section_id);
    });

    // Scroll to Footer
    $('body').on('click', '#accordion-section-viral_times_footer_section .accordion-section-title', function (event) {
        var preview_section_id = "ht-colophon";
        var $contents = jQuery('#customize-preview iframe').contents();

        if ($contents.find('#' + preview_section_id).length > 0) {
            $contents.find("html, body").animate({
                scrollTop: $contents.find("#" + preview_section_id).offset().top
            }, 1000);
        }
    });

    function scrollToSection(section_id) {
        var preview_section_id = "ht-home-slider-section";

        var $contents = $('#customize-preview iframe').contents();

        switch (section_id) {
            case 'accordion-section-viral_times_frontpage_ticker_section':
                preview_section_id = "ht-ticker-section";
                break;

            case 'accordion-section-viral_times_frontpage_mininews_section':
                preview_section_id = "ht-mininews-section";
                break;

            case 'accordion-section-viral_times_frontpage_slider1_section':
                preview_section_id = "ht-slider1-section";
                break;

            case 'accordion-section-viral_times_frontpage_slider2_section':
                preview_section_id = "ht-slider2-section";
                break;

            case 'accordion-section-viral_times_frontpage_featured_section':
                preview_section_id = "ht-featured-section";
                break;

            case 'accordion-section-viral_times_frontpage_tile1_section':
                preview_section_id = "ht-tile1-section";
                break;

            case 'accordion-section-viral_times_frontpage_tile2_section':
                preview_section_id = "ht-tile2-section";
                break;

            case 'accordion-section-viral_times_frontpage_leftnews_section':
                preview_section_id = "ht-leftnews-section";
                break;

            case 'accordion-section-viral_times_frontpage_rightnews_section':
                preview_section_id = "ht-rightnews-section";
                break;

            case 'accordion-section-viral_times_frontpage_fwcarousel_section':
                preview_section_id = "ht-fwcarousel-section";
                break;

            case 'accordion-section-viral_times_frontpage_carousel1_section':
                preview_section_id = "ht-carousel1-section";
                break;

            case 'accordion-section-viral_times_frontpage_carousel2_section':
                preview_section_id = "ht-carousel2-section";
                break;

            case 'accordion-section-viral_times_frontpage_fwnews1_section':
                preview_section_id = "ht-fwnews1-section";
                break;

            case 'accordion-section-viral_times_frontpage_fwnews2_section':
                preview_section_id = "ht-fwnews2-section";
                break;

            case 'accordion-section-viral_times_frontpage_threecol_section':
                preview_section_id = "ht-threecol-section";
                break;

            case 'accordion-section-viral_times_frontpage_video_section':
                preview_section_id = "ht-video-section";
                break;

        }

        if ($contents.find('#' + preview_section_id).length > 0) {
            $contents.find("html, body").animate({
                scrollTop: $contents.find("#" + preview_section_id).offset().top - 100
            }, 1000);
        }

    }

    // Homepage Section Sortable
    function viral_times_sections_order(container) {
        var sections = $(container).sortable('toArray');
        var s_ordered = [];
        $.each(sections, function (index, s_id) {
            s_id = s_id.replace("accordion-section-", "");
            s_ordered.push(s_id);
        });

        $.ajax({
            url: ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                action: 'viral_times_order_sections',
                sections: s_ordered,
                secure: viral_times_ajax_data.nonce
            }
        }).done(function (data) {
            $.each(s_ordered, function (key, value) {
                wp.customize.section(value).priority(key);
            });
            $(container).find('.viral-times-drag-spinner').hide();
            wp.customize.previewer.refresh();
        });
    }
});

(function ($) {
    wp.customize.bind('ready', function () {
        wp.customize.section('viral_times_gdpr_section', function (section) {

            section.expanded.bind(function (isExpanding) {

                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                if (isExpanding) {
                    wp.customize.previewer.send('viral-times-gdpr-add-class', {
                        expanded: isExpanding
                    });
                } else {
                    wp.customize.previewer.send('viral-times-gdpr-remove-class', {
                        home_url: wp.customize.settings.url.home
                    });
                }
            });

        });
    });
})(jQuery);

