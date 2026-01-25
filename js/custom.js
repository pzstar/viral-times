/**
 * Viral Times Custom JS
 *
 * @package Viral Times
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */

jQuery(function ($) {
    if (navigator.userAgent.indexOf('Mac') > 0) {
        $('body').addClass('ht-mac-os');
    }

    /*---------scroll To Top---------*/
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('#ht-back-top').removeClass('ht-hide');
        } else {
            $('#ht-back-top').addClass('ht-hide');
        }
    });

    $('#ht-back-top').click(function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });

    /*---------Popup Search---------*/
    $('.ht-search-button a').click(function () {
        $('.ht-search-wrapper').addClass('ht-search-triggered');
        setTimeout(function () {
            viralTimesSearchModalFocus($('.ht-search-wrapper'));
        }, 1000);
        return false;
    });

    $('.ht-search-close').click(function () {
        $('.ht-search-wrapper').removeClass('ht-search-triggered');
        return false;
    });

    $(document).keydown(function (e) {
        // ESCAPE key pressed
        if (e.keyCode == 27 && $('.ht-search-wrapper').hasClass('ht-search-triggered')) {
            $('.ht-search-wrapper').removeClass('ht-search-triggered');
        }
    });

    /*---------Header Time---------*/
    startTime();

    /*---------Main Menu Dropdown---------*/
    $('.ht-menu > ul').superfish({
        delay: 500,
        animation: {
            opacity: 'show'
        },
        speed: 'fast'
    });

    $('a.sf-with-ul').append('<div class="dropdown-nav arrow_carrot-down"></div>');

    $('#ht-mobile-menu .menu-collapser').on('click', function () {
        $(this).next('ul').slideToggle();
        viralTimesMenuFocus($(' #ht-mobile-menu'));
    });

    $('#ht-responsive-menu .dropdown-nav').on('click', function () {
        $(this).parents('a').siblings('ul').slideToggle();
        $(this).toggleClass('ht-opened');
        return false;
    })

    /*---------Sticky Header---------*/
    var hHeight = 0;
    var adminbarHeight = 0;

    if ($('body').hasClass('admin-bar')) {
        adminbarHeight = 32;
    }

    var $stickyHeader = $('.ht-header');

    if ($('.ht-sticky-header').length > 0 && $stickyHeader.length > 0) {
        hHeight = $stickyHeader.outerHeight();

        if ($('body').hasClass('ht-header-style4')) {
            hHeight = hHeight + 38
        }
        var hOffset = $stickyHeader.offset().top;

        var offset = hOffset - adminbarHeight;

        $stickyHeader.headroom({
            offset: offset,
            onTop: function () {
                $('#ht-content').css({
                    paddingTop: 0
                });
            },
            onNotTop: function () {
                $('#ht-content').css({
                    paddingTop: hHeight + 'px'
                });
            }
        });

        $('.ht-sticky-sidebar .secondary-wrap').css('top', (hHeight + adminbarHeight + 40) + 'px');
    }

    // *only* if we have anchor on the url
    if (window.location.hash) {
        $(window).load(function () {
            var sectionid = window.location.hash;
            sectionid = sectionid.replace('/', '');
            if ($(sectionid).length > 0) {
                $('html, body').animate({
                    scrollTop: $(sectionid).offset().top - hHeight
                }, 1000);
            }
        });
    }

    /*---------Widgets---------*/
    if ($('.ht-post-carousel').length > 0) {
        $('.ht-post-carousel').owlCarousel({
            rtl: JSON.parse(viral_times_options.rtl),
            items: 1,
            loop: true,
            mouseDrag: false,
            nav: false,
            dots: true,
            autoplayTimeout: 6000,
            autoplay: true,
            smartSpeed: 600,
            margin: 5
        });
    }


    /*---------Selective Refresh Jquery---------*/
    selectiveRefreshJquery();

    var hasSelectiveRefresh = (
        'undefined' !== typeof wp &&
        wp.customize &&
        wp.customize.selectiveRefresh &&
        wp.customize.widgetsPreview &&
        wp.customize.widgetsPreview.WidgetPartial
    );
    if (hasSelectiveRefresh) {
        wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
            selectiveRefreshJquery(placement);
        });
    }

    function selectiveRefreshJquery(placement) {
        if (typeof (placement) == 'undefined') {
            var partial = 'viral_times_all';
            var $container = $('.ht-section');
        } else {
            var partial = placement.partial.id;
            var $container = placement.container;
        }

        var section_class, section_partial;

        if (partial.indexOf('viral_times_') !== -1) {
            var partialArr = partial.split('_');
            if (partialArr[2]) {
                if (partialArr[2] == 'all') {
                    section_class = '.ht-section';
                    section_partial = 'viral_times_' + partialArr[2];
                } else if (partialArr[2] == 'frontpage') {
                    section_class = '.ht-' + partialArr[3] + '-section';
                    section_partial = 'viral_times_' + partialArr[3];
                } else {
                    section_class = '.ht-' + partialArr[2] + '-section';
                    section_partial = 'viral_times_' + partialArr[2];
                }
            }
        }

        //console.log(section_partial);
        //console.log(section_class);
        if ($('.vl-slider-wrap:not(.vl-ele-slider-wrap)').length > 0 && ['viral_times_all', 'viral_times_slider1', 'viral_times_slider2'].includes(section_partial)) {
            $('.vl-slider-wrap:not(.vl-ele-slider-wrap)').owlCarousel({
                rtl: JSON.parse(viral_times_options.rtl),
                items: 1,
                margin: 0,
                loop: true,
                mouseDrag: true,
                autoplay: true,
                nav: true,
                dots: false,
                navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
            });
        }

        if ($('.vl-carousel-wrap:not(.vl-ele-carousel-wrap)').length > 0 && ['viral_times_all', 'viral_times_carousel1', 'viral_times_carousel2'].includes(section_partial)) {
            $('.vl-carousel-wrap:not(.vl-ele-carousel-wrap)').each(function () {
                var c_parameters = $(this).find('.owl-carousel').attr('data-params');
                var c_params = JSON.parse(c_parameters);

                if (parseInt(c_params.items) === 2) {
                    var c_params_item_480 = 1;
                } else {
                    var c_params_item_480 = parseInt(c_params.items) - 2;
                }

                $(this).find('.owl-carousel').owlCarousel({
                    rtl: JSON.parse(viral_times_options.rtl),
                    items: parseInt(c_params.items),
                    margin: parseInt(c_params.margin),
                    loop: true,
                    mouseDrag: true,
                    autoplay: JSON.parse(c_params.autoplay),
                    autoplayTimeout: parseInt(c_params.pause) * 1000,
                    nav: true,
                    dots: false,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                    responsive: {
                        0: {
                            items: 1
                        },
                        480: {
                            items: c_params_item_480
                        },
                        768: {
                            items: parseInt(c_params.items) - 1
                        },
                        1000: {
                            items: parseInt(c_params.items)
                        }
                    }
                });
            });
        }

        if ($('.vl-mininews-block:not(.vl-row)').length > 0 && ['viral_times_all', 'viral_times_mininews'].includes(section_partial)) {
            var sliderGallery = function () {

                /*** Vars ***/
                var gallery = '.vl-mininews-block:not(.vl-row)',
                    slider = false;

                /*** Init ***/
                var init = function () {

                    manage(); // On load (1*)

                    $(window).on('resize', function () { // On resize (2*)
                        manage();
                    });

                };

                /*** Manage slider ***/
                var manage = function () {

                    if (!slider && ($(window).width() < 1000)) { // If mobile and slider not built yet = build
                        build();
                        slider = true;
                    } else if (slider && ($(window).width() > 1000)) { // Not mobile but slider built = destroy
                        destroy();
                        slider = false;
                    }

                };

                /*** Build slider ***/
                var build = function () {
                    var item900 = 3;
                    var item768 = 2;
                    var item580 = 2;
                    var item0 = 1;

                    if ($(gallery).hasClass('style2')) {
                        item900 = 5;
                        item768 = 4;
                        item580 = 3;
                        item0 = 2;
                    }

                    slider = $(gallery).addClass('owl-carousel'); // Add owl slider class (3*)
                    slider.owlCarousel({
                        rtl: JSON.parse(viral_times_options.rtl),
                        items: $(gallery).attr('data-count'),
                        loop: true,
                        margin: 10,
                        mouseDrag: true,
                        autoplay: false,
                        autoplayTimeout: 6000,
                        dots: true,
                        lazyLoad: true,
                        responsive: {
                            0: {
                                items: item0
                            },
                            580: {
                                items: item580
                            },
                            768: {
                                items: item768
                            },
                            900: {
                                items: item900
                            }
                        }
                    });

                };

                /*** Destroy slider ***/
                var destroy = function () {
                    $(gallery).trigger('destroy.owl.carousel'); // Trigger destroy event (4*) 
                    $(gallery).removeClass('owl-carousel'); // Remove owl slider class (3*)
                };

                /*** Public methods***/
                return {
                    init: init
                };

            }();

            sliderGallery.init();
        }

        /*---------Sticky Sidebar---------*/
        $('.ht-sticky-sidebar #secondary').theiaStickySidebar({
            additionalMarginTop: hHeight + adminbarHeight + 40,
            additionalMarginBottom: 40
        });

        /*---------Sticky Sidebar---------*/
        $('.ht-enable-sticky-sidebar .ht-leftnews-container .secondary, .ht-enable-sticky-sidebar .ht-rightnews-container .secondary').theiaStickySidebar({
            additionalMarginTop: hHeight + adminbarHeight + 40,
            additionalMarginBottom: 40
        });
    } //selectiveRefreshJquery Ends

    function checkTime(i) {
        return (i < 10) ? "0" + i : i;
    }

    function startTime() {
        var today = new Date(),
            h = checkTime(today.getHours()),
            m = checkTime(today.getMinutes()),
            s = checkTime(today.getSeconds());
        $('.vl-time').html(h + ":" + m + ":" + s);
        setTimeout(function () {
            startTime()
        }, 500);
    }

    var viralTimesMenuFocus = function (elem) {
        viralTimesKeyboardLoop(elem);

        elem.on('keyup', function (e) {
            if (e.keyCode === 27) {
                $(' #ht-responsive-menu').hide();
                $('.menu-collapser').focus();
            }
        });
    };

    var viralTimesSearchModalFocus = function (elem) {
        viralTimesKeyboardLoop(elem);

        elem.on('keydown', function (e) {
            if (e.keyCode == 27 && elem.hasClass('ht-search-triggered')) {
                elem.removeClass('ht-search-triggered');
                $('.ht-search-button a').focus();
            }
        });
    };

    var viralTimesKeyboardLoop = function (elem) {
        var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');

        var firstTabbable = tabbable.first();
        var lastTabbable = tabbable.last();

        /*set focus on first input*/
        firstTabbable.focus();

        /*redirect last tab to first input*/
        lastTabbable.on('keydown', function (e) {
            if ((e.which === 9 && !e.shiftKey)) {
                e.preventDefault();
                firstTabbable.focus();
            }
        });

        /*redirect first shift+tab to last input*/
        firstTabbable.on('keydown', function (e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });
    }
});