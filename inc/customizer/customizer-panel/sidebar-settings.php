<?php

/**
 * Viral Times Theme Customizer
 *
 * @package Viral Times
 */
//LAYOUT OPTIONS
$wp_customize->add_section('viral_times_layout_options_section', array(
    'title' => esc_html__('Sidebar Settings', 'viral-times'),
    'priority' => 16
));

$wp_customize->add_setting('viral_times_sidebar_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Times_Tab_Control($wp_customize, 'viral_times_sidebar_nav', array(
    'section' => 'viral_times_layout_options_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Layouts', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_sticky_sidebar',
                'viral_times_page_layout',
                'viral_times_post_layout',
                'viral_times_archive_layout',
                'viral_times_home_blog_layout',
                'viral_times_search_layout',
                'viral_times_shop_layout'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Styles', 'viral-times'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_times_sticky_sidebar',
                'viral_times_sidebar_style',
                'viral_times_content_widget_title_color'
            ),
        )
    ),
)));

$wp_customize->add_setting('viral_times_sticky_sidebar', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_sticky_sidebar', array(
    'section' => 'viral_times_layout_options_section',
    'label' => esc_html__('Sticky Sidebar', 'viral-times'),
    'description' => esc_html__('The sidebar will stick at the top on scrolling', 'viral-times')
)));

$wp_customize->add_setting('viral_times_page_layout', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Times_Selector_Control($wp_customize, 'viral_times_page_layout', array(
    'section' => 'viral_times_layout_options_section',
    'label' => esc_html__('Page Layout', 'viral-times'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to all the General Pages and Portfolio Pages.', 'viral-times'),
    'options' => array(
        'right-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_times_post_layout', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Times_Selector_Control($wp_customize, 'viral_times_post_layout', array(
    'section' => 'viral_times_layout_options_section',
    'label' => esc_html__('Post Layout', 'viral-times'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to all the Posts.', 'viral-times'),
    'options' => array(
        'right-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_times_archive_layout', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Times_Selector_Control($wp_customize, 'viral_times_archive_layout', array(
    'section' => 'viral_times_layout_options_section',
    'label' => esc_html__('Archive Page Layout', 'viral-times'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to all Archive Pages.', 'viral-times'),
    'options' => array(
        'right-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_times_home_blog_layout', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Times_Selector_Control($wp_customize, 'viral_times_home_blog_layout', array(
    'section' => 'viral_times_layout_options_section',
    'label' => esc_html__('Blog Page Layout', 'viral-times'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to Blog Page.', 'viral-times'),
    'options' => array(
        'right-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_times_search_layout', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Times_Selector_Control($wp_customize, 'viral_times_search_layout', array(
    'section' => 'viral_times_layout_options_section',
    'label' => esc_html__('Search Page Layout', 'viral-times'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to Search Page.', 'viral-times'),
    'options' => array(
        'right-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_times_content_widget_title_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_times_content_widget_title_color', array(
    'section' => 'viral_times_layout_options_section',
    'label' => esc_html__('Sidebar Widget Title Color', 'viral-times')
)));