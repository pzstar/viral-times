<?php

/**
 * Viral Times Theme Customizer
 *
 * @package Viral Times
 */
$wp_customize->add_section('viral_times_blog_options_section', array(
    'title' => esc_html__('Blog/Single Post Settings', 'viral-times'),
    'priority' => 30
));

$wp_customize->add_setting('viral_times_blog_sec_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Times_Tab_Control($wp_customize, 'viral_times_blog_sec_nav', array(
    'section' => 'viral_times_blog_options_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('BLog Page', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_display_frontpage_sections',
                'viral_times_blog_layout',
                'viral_times_blog_cat',
                'viral_times_archive_content',
                'viral_times_archive_excerpt_length',
                'viral_times_archive_readmore',
                'viral_times_blog_display_date_option',
                'viral_times_blog_date',
                'viral_times_blog_author',
                'viral_times_blog_comment',
                'viral_times_blog_category',
                'viral_times_blog_tag',
                'viral_times_blog_upgrade_text'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Single Post', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_single_layout',
                'viral_times_display_date_option',
                'viral_times_single_categories',
                'viral_times_single_seperator1',
                'viral_times_single_author',
                'viral_times_single_date',
                'viral_times_single_comment_count',
                'viral_times_single_reading_time',
                'viral_times_single_seperator2',
                'viral_times_single_tags',
                'viral_times_single_seperator3',
                'viral_times_single_prev_next_post',
                'viral_times_single_comments',
                'viral_times_single_related_heading',
                'viral_times_single_related_post_title',
                'viral_times_single_related_post_style',
                'viral_times_single_related_post_count',
                'viral_times_single_upgrade_text'
            ),
        ),
    ),
)));

$wp_customize->add_setting('viral_times_blog_layout', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'layout7'
));

$wp_customize->add_control(new Viral_Times_Image_Selector_Control($wp_customize, 'viral_times_blog_layout', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Blog & Archive Layout', 'viral-times'),
    'image_path' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/blog-layouts/',
    'image_type' => 'png',
    'choices' => array(
        'layout4' => esc_html__('Layout 1', 'viral-times'),
        'layout7' => esc_html__('Layout 2', 'viral-times')
    )
)));

$wp_customize->add_setting('viral_times_blog_cat', array(
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control(new Viral_Times_Taxonomy_Multiple_Checkbox_Control($wp_customize, 'viral_times_blog_cat', array(
    'label' => esc_html__('Exclude Category', 'viral-times'),
    'section' => 'viral_times_blog_options_section',
    'taxonomy' => 'category',
    'description' => esc_html__('Post with selected category will not display in the blog page', 'viral-times')
)));

$wp_customize->add_setting('viral_times_archive_content', array(
    'default' => 'excerpt',
    'sanitize_callback' => 'viral_times_sanitize_choices'
));

$wp_customize->add_control('viral_times_archive_content', array(
    'section' => 'viral_times_blog_options_section',
    'type' => 'radio',
    'label' => esc_html__('Archive Content', 'viral-times'),
    'choices' => array(
        'full-content' => esc_html__('Full Content', 'viral-times'),
        'excerpt' => esc_html__('Excerpt', 'viral-times')
    )
));

$wp_customize->add_setting('viral_times_archive_excerpt_length', array(
    'sanitize_callback' => 'absint',
    'default' => 100
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'viral_times_archive_excerpt_length', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Excerpt Length (words)', 'viral-times'),
    'input_attrs' => array(
        'min' => 50,
        'max' => 200,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_times_archive_readmore', array(
    'default' => esc_html__('Read More', 'viral-times'),
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control('viral_times_archive_readmore', array(
    'section' => 'viral_times_blog_options_section',
    'type' => 'text',
    'label' => esc_html__('Read More Text', 'viral-times')
));

$wp_customize->add_setting('viral_times_blog_display_date_option', array(
    'default' => 'posted',
    'sanitize_callback' => 'viral_times_sanitize_choices'
));

$wp_customize->add_control('viral_times_blog_display_date_option', array(
    'section' => 'viral_times_blog_options_section',
    'type' => 'radio',
    'label' => esc_html__('Display Posted/Updated Date', 'viral-times'),
    'choices' => array(
        'posted' => esc_html__('Posted Date', 'viral-times'),
        'updated' => esc_html__('Updated Date', 'viral-times')
    )
));

$wp_customize->add_setting('viral_times_blog_date', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_blog_date', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Posted Date', 'viral-times')
)));

$wp_customize->add_setting('viral_times_blog_author', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_blog_author', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Author', 'viral-times')
)));

$wp_customize->add_setting('viral_times_blog_comment', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_blog_comment', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Comment', 'viral-times')
)));

$wp_customize->add_setting('viral_times_blog_category', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_blog_category', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Category', 'viral-times')
)));

$wp_customize->add_setting('viral_times_blog_tag', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_blog_tag', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Tag', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_layout', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'layout7'
));

$wp_customize->add_control(new Viral_Times_Image_Selector_Control($wp_customize, 'viral_times_single_layout', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Single Post Layout', 'viral-times'),
    'description' => esc_html__('This option can be overwritten in single page settings.', 'viral-times'),
    'image_path' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/single-layouts/',
    'image_type' => 'png',
    'choices' => array(
        'layout2' => esc_html__('Layout 1', 'viral-times'),
        'layout7' => esc_html__('Layout 2', 'viral-times')
    )
)));

$wp_customize->add_setting('viral_times_display_date_option', array(
    'default' => 'posted',
    'sanitize_callback' => 'viral_times_sanitize_choices'
));

$wp_customize->add_control('viral_times_display_date_option', array(
    'section' => 'viral_times_blog_options_section',
    'type' => 'radio',
    'label' => esc_html__('Display Posted/Updated Date', 'viral-times'),
    'choices' => array(
        'posted' => esc_html__('Posted Date', 'viral-times'),
        'updated' => esc_html__('Updated Date', 'viral-times')
    )
));

$wp_customize->add_setting('viral_times_single_categories', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_categories', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Categories', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_seperator1', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Separator_Control($wp_customize, 'viral_times_single_seperator1', array(
    'section' => 'viral_times_blog_options_section',
)));

$wp_customize->add_setting('viral_times_single_author', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_author', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Author', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_date', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_date', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Posted Date', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_comment_count', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_comment_count', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Comment Count', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_reading_time', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_reading_time', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Reading Time', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_seperator2', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Separator_Control($wp_customize, 'viral_times_single_seperator2', array(
    'section' => 'viral_times_blog_options_section',
)));

$wp_customize->add_setting('viral_times_single_tags', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_tags', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Tags', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_seperator3', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Separator_Control($wp_customize, 'viral_times_single_seperator3', array(
    'section' => 'viral_times_blog_options_section',
)));

$wp_customize->add_setting('viral_times_single_prev_next_post', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_prev_next_post', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Prev/Next Post', 'viral-times')
)));

$wp_customize->add_setting('viral_times_single_comments', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_single_comments', array(
    'section' => 'viral_times_blog_options_section',
    'label' => esc_html__('Display Comments', 'viral-times')
)));
