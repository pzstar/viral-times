<?php
/**
 * @package Viral Times
 */
add_action('viral_times_mobile_header', 'viral_times_responsive_navigation', 100);
add_action('viral_times_mobile_header', 'viral_times_header_social_icons', 30);
add_action('viral_times_mobile_header', 'viral_times_search_button', 40);

add_action('viral_times_header', 'viral_times_header_styles');
add_action('viral_times_top_header', 'viral_times_top_left_header');
add_action('viral_times_top_header', 'viral_times_top_right_header');
add_action('viral_times_social_icons', 'viral_times_social_icons');

function viral_times_header_styles() {
    $header_style = get_theme_mod('viral_times_mh_layout', 'header-style5');

    switch ($header_style) {
        case 'header-style2':
            get_template_part('inc/header/header', 'two');
            break;

        case 'header-style5':
            get_template_part('inc/header/header', 'five');
            break;

        case 'header-style6':
            get_template_part('inc/header/header', 'six');
            break;

        default:
            get_template_part('inc/header/header', 'five');
            break;
    }
}

function viral_times_header_logo() {
    $hide_title = get_theme_mod('viral_times_hide_title');
    $hide_tagline = get_theme_mod('viral_times_hide_tagline');

    if (function_exists('has_custom_logo') && has_custom_logo()) {
        the_custom_logo();
    }

    if (!$hide_title || !$hide_tagline) {
        ?>
        <div class="ht-site-title-tagline">
            <?php
            if (!$hide_title) {
                if (is_front_page()):
                    ?>
                    <h1 class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php else: ?>
                    <p class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php
                endif;
            }

            if (!$hide_tagline) {
                ?>
                <p class="ht-site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('description'); ?></a></p>
                <?php
            }
            ?>
        </div>
        <?php
    }
}

function viral_times_main_navigation() {
    $walker_args = array(
        'theme_location' => 'primary',
        'container_class' => 'ht-menu ht-clearfix',
        'menu_class' => 'ht-clearfix',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'fallback_cb' => false
    );

    wp_nav_menu($walker_args);
}

function viral_times_responsive_navigation() {
    $walker_args = array(
        'theme_location' => 'primary',
        'container_id' => 'ht-mobile-menu',
        'menu_id' => 'ht-responsive-menu',
        'items_wrap' => '<button class="menu-collapser"><div class="collapse-button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div></button><ul id="%1$s" class="%2$s">%3$s</ul>',
        'fallback_cb' => false
    );

    wp_nav_menu($walker_args);
}

function viral_times_top_header_menu() {
    $menu_id = get_theme_mod('viral_times_th_menu');

    if (!empty($menu_id)) {
        wp_nav_menu(array(
            'menu' => $menu_id,
            'container' => NULL,
            'menu_class' => 'ht-clearfix',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
        ));
    }
}

function viral_times_top_header_widget() {
    $widget_id = get_theme_mod('viral_times_th_widget');

    if (!empty($widget_id) && is_active_sidebar($widget_id)) {
        dynamic_sidebar($widget_id);
    }
}

function viral_times_top_header_text() {
    $text = get_theme_mod('viral_times_th_text', esc_html__('California, TX 70240 | (1800) 456 7890', 'viral-times'));

    if (!empty($text)) {
        echo wp_kses_post(force_balance_tags($text));
    }
}

function viral_times_top_header_date() {
    echo '<span><i class="mdi mdi-calendar"></i>';
    echo date_i18n('l, F j', time());
    echo '</span>';
    echo '<span><i class="mdi mdi-clock-time-four-outline"></i>';
    echo '<span class="vl-time"></span>';
    echo '</span>';
}

function viral_times_top_header_ticker() {
    $ticker_category = get_theme_mod('viral_times_th_ticker_category', '-1');
    if ($ticker_category) {
        $args = array(
            'cat' => $ticker_category,
            'posts_per_page' => 5,
            'sticky_post' => false
        );
        $query = new WP_Query($args);
        if ($query->have_posts()):
            ?>
            <div class="vl-header-ticker">
                <span class="vl-header-ticker-title">
                    <?php
                    $ticker_title = get_theme_mod('viral_times_th_ticker_title', esc_html__('Breaking News', 'viral-times'));
                    if ($ticker_title) {
                        echo esc_html($ticker_title);
                    } else {
                        echo get_cat_name($ticker_category);
                    }
                    ?>
                </span>
                <div class="vl-header-ticker-carousel">
                    <div class="owl-carousel">
                        <?php
                        while ($query->have_posts()):
                            $query->the_post();
                            echo '<a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a>';
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <?php
        endif;
    ?>
    <?php
    }
}

function viral_times_top_left_header() {
    $left_header = get_theme_mod('viral_times_th_left_display', 'social');
    ?>
    <div class="ht-th-left th-<?php echo esc_attr($left_header) ?>">
        <?php
        if ($left_header !== 'none') {
            if ($left_header == 'social') {
                do_action('viral_times_social_icons');
            } elseif ($left_header == 'menu') {
                viral_times_top_header_menu();
            } elseif ($left_header == 'widget') {
                viral_times_top_header_widget();
            } elseif ($left_header == 'text') {
                viral_times_top_header_text();
            } elseif ($left_header == 'date') {
                viral_times_top_header_date();
            } elseif ($left_header == 'ticker') {
                viral_times_top_header_ticker();
            }
        }
        ?>
    </div><!-- .ht-th-left -->
    <?php
}

function viral_times_top_right_header() {
    $right_header = get_theme_mod('viral_times_th_right_display', 'text');
    ?>
    <div class="ht-th-right th-<?php echo esc_attr($right_header) ?>">
        <?php
        if ($right_header !== 'none') {
            if ($right_header == 'social') {
                do_action('viral_times_social_icons');
            } elseif ($right_header == 'menu') {
                viral_times_top_header_menu();
            } elseif ($right_header == 'widget') {
                viral_times_top_header_widget();
            } elseif ($right_header == 'text') {
                viral_times_top_header_text();
            } elseif ($right_header == 'date') {
                viral_times_top_header_date();
            }
        }
        ?>
    </div><!-- .ht-th-right -->
    <?php
}

function viral_times_social_icons() {
    $social_icons = get_theme_mod('viral_times_social_icons', json_encode(array(
        array(
            'icon' => 'icofont-facebook',
            'link' => '#',
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-x-twitter',
            'link' => '#',
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-instagram',
            'link' => '#',
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-youtube',
            'link' => '#',
            'enable' => 'on'
        )
    )));
    $social_icons = json_decode($social_icons);

    if (!empty($social_icons)) {
        foreach ($social_icons as $social_icon) {
            if ($social_icon->enable === 'on' && !empty($social_icon->link)) {
                echo '<a href="' . esc_attr($social_icon->link) . '" target="_blank"><i class="' . esc_attr($social_icon->icon) . '"></i></a>';
            }
        }
    }
}


function viral_times_search_button() {
    $enable_button = get_theme_mod('viral_times_mh_show_search', true);
    $header_style = get_theme_mod('viral_times_mh_layout', 'header-style5');

    if ($enable_button && $header_style != 'header-style2') {
        echo '<div class="ht-search-button"><a href="#"><i class="icofont-search-1"></i></a></div>';
    }
}

function viral_times_header_social_icons() {
    $social_icons = get_theme_mod('viral_times_social_icons', json_encode(array(
        array(
            'icon' => 'icofont-facebook',
            'link' => '#',
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-x-twitter',
            'link' => '#',
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-instagram',
            'link' => '#',
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-youtube',
            'link' => '#',
            'enable' => 'on'
        )
    )));
    $social_icons = json_decode($social_icons);

    $enable_button = get_theme_mod('viral_times_mh_show_social', false);
    $header_style = get_theme_mod('viral_times_mh_layout', 'header-style5');

    if ($enable_button && $header_style != 'header-style2') {
        if (!empty($social_icons)) {
            echo '<div class="ht-header-social-icons">';
            foreach ($social_icons as $social_icon) {
                if ($social_icon->enable === 'on' && !empty($social_icon->link)) {
                    echo '<a href="' . esc_attr($social_icon->link) . '" target="_blank"><i class="' . esc_attr($social_icon->icon) . '"></i></a>';
                }
            }
            echo '</div>';
        }
    }
}

if (!function_exists('viral_times_header_search_wrapper')) {

    function viral_times_header_search_wrapper() {
        $enable_search = get_theme_mod('viral_times_mh_show_search', true);
        $placeholder_text = esc_attr__('Enter a keyword to search...', 'viral-times');
        $form = '<div id="htSearchWrapper" class="ht-search-wrapper">';
        $form .= '<div class="ht-search-container">';
        $form .= '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">';
        $form .= '<input autocomplete="off" type="search" class="search-field" placeholder="' . $placeholder_text . '" value="' . get_search_query() . '" name="s" />';
        $form .= '<button type="submit" class="search-submit"><i class="icofont-search"></i></button>';
        $form .= '<div class="ht-search-close"><button class="viral-times-selected-icon"><i class="icofont-close-line-squared"></i></button></div>';
        $form .= '</form>';
        $form .= '</div>';
        $form .= '</div>';

        $result = apply_filters('get_search_form', $form);

        if ($enable_search) {
            echo $result;
        }
    }

}

add_action('wp_footer', 'viral_times_header_search_wrapper');