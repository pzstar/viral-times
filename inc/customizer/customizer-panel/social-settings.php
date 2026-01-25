<?php

/**
 * Viral Times Theme Customizer
 *
 * @package Viral Times
 */
//SOCIAL SETTINGS
$wp_customize->add_section('viral_times_social_section', array(
    'title' => esc_html__('Social Links', 'viral-times')
));

$wp_customize->add_setting('viral_times_social_icons', array(
    'sanitize_callback' => 'viral_times_sanitize_repeater',
    'default' => json_encode(array(
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
    ))
));

$wp_customize->add_control(new Viral_Times_Repeater_Control($wp_customize, 'viral_times_social_icons', array(
    'label' => esc_html__('Add Social Link', 'viral-times'),
    'section' => 'viral_times_social_section',
    'box_label' => esc_html__('Social Links', 'viral-times'),
    'add_label' => esc_html__('Add New', 'viral-times'),
), array(
    'icon' => array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'viral-times'),
        'default' => 'icofont-facebook'
    ),
    'link' => array(
        'type' => 'text',
        'label' => esc_html__('Add Link', 'viral-times'),
        'default' => ''
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_html__('Enable', 'viral-times'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));
