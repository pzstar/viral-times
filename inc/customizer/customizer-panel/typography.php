<?php

// Add the typography panel.
$wp_customize->add_panel('viral_times_typography_panel', array(
    'priority' => 2,
    'title' => esc_html__('Typography Settings', 'viral-times')
));

// Add the body typography section.
$wp_customize->add_section('body_typography', array(
    'panel' => 'viral_times_typography_panel',
    'title' => esc_html__('Body', 'viral-times')
));

$wp_customize->add_setting('body_font_family', array(
    'default' => 'Roboto',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('body_font_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('body_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('body_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('body_font_size', array(
    'default' => '15',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('body_line_height', array(
    'default' => '1.6',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('body_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('body_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Typography_Control($wp_customize, 'body_typography', array(
    'label' => esc_html__('Body Typography', 'viral-times'),
    'description' => esc_html__('Select how you want your body to appear.', 'viral-times'),
    'section' => 'body_typography',
    'settings' => array(
        'family' => 'body_font_family',
        'style' => 'body_font_style',
        'text_decoration' => 'body_text_decoration',
        'text_transform' => 'body_text_transform',
        'size' => 'body_font_size',
        'line_height' => 'body_line_height',
        'letter_spacing' => 'body_letter_spacing',
        'color' => 'body_color'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 40,
        'step' => 1
    )
)));

// Add H1 typography section.
$wp_customize->add_section('header_typography', array(
    'panel' => 'viral_times_typography_panel',
    'title' => esc_html__('Headers(H1, H2, H3, H4, H5, H6)', 'viral-times')
));

// Add H typography section.
$wp_customize->add_setting('h_font_family', array(
    'default' => 'Roboto',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('h_font_style', array(
    'default' => '700',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('h_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('h_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('h_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('h_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Typography_Control($wp_customize, 'h_typography', array(
    'label' => esc_html__('Header Typography', 'viral-times'),
    'description' => esc_html__('Select how you want your Header to appear.', 'viral-times'),
    'section' => 'header_typography',
    'settings' => array(
        'family' => 'h_font_family',
        'style' => 'h_font_style',
        'text_decoration' => 'h_text_decoration',
        'text_transform' => 'h_text_transform',
        'line_height' => 'h_line_height',
        'letter_spacing' => 'h_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 20,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('h_typography_seperator', array(
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control(new Viral_Times_Separator_Control($wp_customize, 'h_typography_seperator', array(
    'section' => 'header_typography'
)));

$wp_customize->add_setting('hh1_font_size', array(
    'sanitize_callback' => 'absint',
    'default' => 38,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'hh1_font_size', array(
    'section' => 'header_typography',
    'label' => esc_html__('H1 Font Size', 'viral-times'),
    'input_attrs' => array(
        'min' => 14,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('hh2_font_size', array(
    'sanitize_callback' => 'absint',
    'default' => 34,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'hh2_font_size', array(
    'section' => 'header_typography',
    'label' => esc_html__('H2 Font Size', 'viral-times'),
    'input_attrs' => array(
        'min' => 14,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('hh3_font_size', array(
    'sanitize_callback' => 'absint',
    'default' => 30,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'hh3_font_size', array(
    'section' => 'header_typography',
    'label' => esc_html__('H3 Font Size', 'viral-times'),
    'input_attrs' => array(
        'min' => 14,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('hh4_font_size', array(
    'sanitize_callback' => 'absint',
    'default' => 26,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'hh4_font_size', array(
    'section' => 'header_typography',
    'label' => esc_html__('H4 Font Size', 'viral-times'),
    'input_attrs' => array(
        'min' => 14,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('hh5_font_size', array(
    'sanitize_callback' => 'absint',
    'default' => 22,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'hh5_font_size', array(
    'section' => 'header_typography',
    'label' => esc_html__('H5 Font Size', 'viral-times'),
    'input_attrs' => array(
        'min' => 14,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('hh6_font_size', array(
    'sanitize_callback' => 'absint',
    'default' => 18,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'hh6_font_size', array(
    'section' => 'header_typography',
    'label' => esc_html__('H6 Font Size', 'viral-times'),
    'input_attrs' => array(
        'min' => 14,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral_times_more_typography_section', array(
    'title' => esc_html__('Other Typography', 'viral-times'),
    'panel' => 'viral_times_typography_panel',
    'priority' => 1000,
    'class' => 'ht--boxed',
    'options' => array(
        '<a href="javascript:wp.customize.section(\'viral_times_menu_section\').focus();">' . esc_html__('Menu & Sub Menu', 'viral-times') . '</a>',
        '<a href="javascript:wp.customize.section(\'viral_times_title_bar_section\').focus();">' . esc_html__('Page Banner (Header Title)', 'viral-times') . '</a>',
        '<a href="javascript:wp.customize.section(\'viral_times_frontpage_settings\').focus();">' . esc_html__('Front Page Block Title', 'viral-times') . '</a>',
        '<a href="javascript:wp.customize.section(\'viral_times_frontpage_settings\').focus();">' . esc_html__('Front Page Post Title', 'viral-times') . '</a>',
    )
)));
