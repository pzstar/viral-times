<?php

/**
 * Viral Times Theme Customizer
 *
 * @package Viral Times
 */
/* GENERAL SETTINGS PANEL */
$wp_customize->add_panel('viral_times_general_settings_panel', array(
    'title' => esc_html__('General Settings', 'viral-times'),
    'priority' => 2
));

//GENERAL SETTINGS
$wp_customize->add_section('viral_times_general_options_section', array(
    'title' => esc_html__('General Options', 'viral-times'),
    'panel' => 'viral_times_general_settings_panel'
));

//MOVE BACKGROUND AND COLOR SETTING INTO GENERAL SETTING SECTION
$wp_customize->get_control('background_image')->section = 'viral_times_general_options_section';
$wp_customize->get_control('background_color')->section = 'viral_times_general_options_section';
$wp_customize->get_control('background_preset')->section = 'viral_times_general_options_section';
$wp_customize->get_control('background_position')->section = 'viral_times_general_options_section';
$wp_customize->get_control('background_size')->section = 'viral_times_general_options_section';
$wp_customize->get_control('background_repeat')->section = 'viral_times_general_options_section';
$wp_customize->get_control('background_attachment')->section = 'viral_times_general_options_section';

$wp_customize->get_control('background_color')->priority = 20;
$wp_customize->get_control('background_image')->priority = 20;
$wp_customize->get_control('background_preset')->priority = 20;
$wp_customize->get_control('background_position')->priority = 20;
$wp_customize->get_control('background_size')->priority = 20;
$wp_customize->get_control('background_repeat')->priority = 20;
$wp_customize->get_control('background_attachment')->priority = 20;

$wp_customize->add_setting('viral_times_website_layout', array(
    'default' => 'wide',
    'sanitize_callback' => 'viral_times_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('viral_times_website_layout', array(
    'section' => 'viral_times_general_options_section',
    'type' => 'radio',
    'label' => esc_html__('Website Layout', 'viral-times'),
    'choices' => array(
        'wide' => esc_html__('Wide', 'viral-times'),
        'boxed' => esc_html__('Boxed', 'viral-times'),
        'fluid' => esc_html__('Fluid', 'viral-times')
    )
));


$wp_customize->add_setting('viral_times_fluid_container_width', array(
    'sanitize_callback' => 'absint',
    'default' => 80,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'viral_times_fluid_container_width', array(
    'section' => 'viral_times_general_options_section',
    'label' => esc_html__('Website Container Width (%)', 'viral-times'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_times_website_width', array(
    'sanitize_callback' => 'absint',
    'default' => 1170,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'viral_times_website_width', array(
    'section' => 'viral_times_general_options_section',
    'label' => esc_html__('Website Container Width (px)', 'viral-times'),
    'input_attrs' => array(
        'min' => 900,
        'max' => 1800,
        'step' => 10
    )
)));

$wp_customize->add_setting('viral_times_container_padding', array(
    'sanitize_callback' => 'absint',
    'default' => 40,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'viral_times_container_padding', array(
    'section' => 'viral_times_general_options_section',
    'label' => esc_html__('Website Container Padding (px)', 'viral-times'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 200,
        'step' => 5
    )
)));

$wp_customize->add_setting('viral_times_sidebar_width', array(
    'sanitize_callback' => 'absint',
    'default' => 30,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'viral_times_sidebar_width', array(
    'section' => 'viral_times_general_options_section',
    'label' => esc_html__('Sidebar Width (%)', 'viral-times'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 50,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_times_scroll_animation_seperator', array(
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control(new Viral_Times_Separator_Control($wp_customize, 'viral_times_scroll_animation_seperator', array(
    'section' => 'viral_times_general_options_section'
)));

$wp_customize->add_setting('viral_times_background_heading', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
));

$wp_customize->add_control(new Viral_Times_Heading_Control($wp_customize, 'viral_times_background_heading', array(
    'section' => 'viral_times_general_options_section',
    'label' => esc_html__('Background', 'viral-times'),
)));



/* BACK TO TOP SECTION */
$wp_customize->add_section('viral_times_backtotop_section', array(
    'title' => esc_html__('Scroll Top', 'viral-times'),
    'panel' => 'viral_times_general_settings_panel',
));

$wp_customize->add_setting('viral_times_backtotop', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_backtotop', array(
    'section' => 'viral_times_backtotop_section',
    'label' => esc_html__('Back to Top Button', 'viral-times'),
    'description' => esc_html__('A button on click scrolls to the top of the page.', 'viral-times')
)));


/* GOOGLE FONT SECTION */
$wp_customize->add_section('viral_times_google_font_section', array(
    'title' => esc_html__('Google Fonts', 'viral-times'),
    'panel' => 'viral_times_general_settings_panel',
    'priority' => 1000
));

$wp_customize->add_setting('viral_times_load_google_font_locally', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'off',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Switch_Control($wp_customize, 'viral_times_load_google_font_locally', array(
    'section' => 'viral_times_google_font_section',
    'label' => esc_html__('Load Google Fonts Locally', 'viral-times'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-times'),
        'off' => esc_html__('No', 'viral-times')
    ),
    'description' => esc_html__('It is required to load the Google Fonts locally in order to comply with GDPR. However, if your website is not required to comply with Google Fonts then you can check this field off. Loading the Fonts locally with lots of different Google fonts can decrease the speed of the website slightly.', 'viral-times'),
)));

/* SEO SECTION */
$wp_customize->add_section('viral_times_seo_section', array(
    'title' => esc_html__('SEO', 'viral-times'),
    'panel' => 'viral_times_general_settings_panel',
    'priority' => 1000
));

$wp_customize->add_setting('viral_times_schema_markup', array(
    'sanitize_callback' => 'viral_times_sanitize_checkbox',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_schema_markup', array(
    'section' => 'viral_times_seo_section',
    'label' => esc_html__('Schema.org Markup', 'viral-times'),
    'description' => esc_html__('Enable Schema.org markup feature for your site. You can disable this option if if you use a SEO plugin.', 'viral-times'),
)));

