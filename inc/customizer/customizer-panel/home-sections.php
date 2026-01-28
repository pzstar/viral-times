<?php

/**
 * Viral Times Theme Customizer
 *
 * @package Viral Times
 */
/* ============FRONT PAGE PANEL============ */
$wp_customize->add_panel('viral_times_front_page_panel', array(
    'title' => esc_html__('Front Page Sections', 'viral-times'),
    'description' => esc_html__('Drag and Drop to Reorder', 'viral-times') . '<img class="viral-times-drag-spinner" src="' . admin_url('/images/spinner.gif') . '">',
    'priority' => 20
));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-frontpage-notice', array(
    'title' => sprintf(esc_html('Important! Front Page Sections are not enabled. Enable it %1shere%2s.', 'viral-times'), '<a href="javascript:wp.customize.section( \'static_front_page\' ).focus()">', '</a>'),
    'panel' => 'viral_times_front_page_panel',
    'priority' => -99,
    'active_callback' => 'viral_times_check_frontpage'
)));


/* ============MINI NEWS MODULE============ */
$wp_customize->add_section(new Viral_Times_Toggle_Section($wp_customize, 'viral_times_frontpage_mininews_section', array(
    'title' => esc_html__('Mini News Module', 'viral-times'),
    'panel' => 'viral_times_front_page_panel',
    'priority' => viral_times_get_section_position('viral_times_frontpage_mininews_section'),
    'hiding_control' => 'viral_times_frontpage_mininews_section_disable'
)));

$wp_customize->add_setting('viral_times_frontpage_mininews_section_disable', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Viral_Times_Switch_Control($wp_customize, 'viral_times_frontpage_mininews_section_disable', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('Disable Section', 'viral-times'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-times'),
        'off' => esc_html__('No', 'viral-times')
    ),
    'class' => 'ht--switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('viral_times_frontpage_mininews_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Times_Tab_Control($wp_customize, 'viral_times_frontpage_mininews_nav', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_mininews_cat',
                'viral_times_mininews_display_author',
                'viral_times_mininews_display_cat',
                'viral_times_mininews_display_date',
                'viral_times_mininews_post_count_big',
                'viral_times_mininews_post_count',
                'viral_times_mininews_fullwidth',
                'viral_times_mininews_style',
                'viral_times_mininews_image_size',
                'viral_times_mininews_widget_heading',
                'viral_times_mininews_top_widget',
                'viral_times_mininews_bottom_widget'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'viral-times'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_times_mininews_cs_heading',
                'viral_times_mininews_title_color',
                'viral_times_mininews_text_color',
                'viral_times_mininews_link_color',
                'viral_times_mininews_block_color_seperator',
                'viral_times_mininews_overwrite_block_title_color',
                'viral_times_mininews_block_title_color',
                'viral_times_mininews_block_title_background_color',
                'viral_times_mininews_block_title_border_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'viral-times'),
            'icon' => 'dashicons dashicons-admin-tools',
            'fields' => array(
                'viral_times_mininews_enable_fullwindow',
                'viral_times_mininews_align_item',
                'viral_times_mininews_fw_seperator',
                'viral_times_mininews_bg_type',
                'viral_times_mininews_bg_color',
                'viral_times_mininews_bg_gradient',
                'viral_times_mininews_bg_image',
                'viral_times_mininews_parallax_effect',
                'viral_times_mininews_bg_video',
                'viral_times_mininews_overlay_color',
                'viral_times_mininews_cs_seperator',
                'viral_times_mininews_padding',
                'viral_times_mininews_margin',
                'viral_times_mininews_seperator0',
                'viral_times_mininews_section_seperator',
                'viral_times_mininews_seperator1',
                'viral_times_mininews_top_seperator',
                'viral_times_mininews_ts_color',
                'viral_times_mininews_ts_height',
                'viral_times_mininews_seperator2',
                'viral_times_mininews_bottom_seperator',
                'viral_times_mininews_bs_color',
                'viral_times_mininews_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('viral_times_mininews_cat', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new Viral_Times_Taxonomy_Multiple_Checkbox_Control($wp_customize, 'viral_times_mininews_cat', array(
    'label' => esc_html__('Select Category', 'viral-times'),
    'section' => 'viral_times_frontpage_mininews_section',
    'taxonomy' => 'category',
    'description' => esc_html__('All latest post will display if no category is selected', 'viral-times')
)));

$wp_customize->add_setting('viral_times_mininews_display_cat', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_mininews_display_cat', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('Display Category', 'viral-times')
)));

$wp_customize->add_setting('viral_times_mininews_display_author', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_mininews_display_author', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('Display Author', 'viral-times')
)));

$wp_customize->add_setting('viral_times_mininews_display_date', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_mininews_display_date', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('Display Date', 'viral-times')
)));

$wp_customize->add_setting('viral_times_mininews_fullwidth', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage',
    'default' => false
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_mininews_fullwidth', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('Enable Full Width', 'viral-times')
)));

$wp_customize->add_setting('viral_times_mininews_post_count_big', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage',
    'default' => 5
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'viral_times_mininews_post_count_big', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('No of Posts In Bigger Screen', 'viral-times'),
    'description' => esc_html__('Displays in the screen bigger than 1400px', 'viral-times'),
    'input_attrs' => array(
        'min' => 4,
        'max' => 10,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_times_mininews_post_count', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage',
    'default' => 3
));

$wp_customize->add_control(new Viral_Times_Range_Slider_Control($wp_customize, 'viral_times_mininews_post_count', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('No of Posts', 'viral-times'),
    'description' => esc_html__('Displays in the screen smaller than 1400px', 'viral-times'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 6,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_times_mininews_style', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Times_Selector_Control($wp_customize, 'viral_times_mininews_style', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'label' => esc_html__('Mini News Style', 'viral-times'),
    'class' => 'ht--full-width',
    'options' => array(
        'style1' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/mini-news/style1.png',
        'style2' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/mini-news/style2.png'
    )
)));

$wp_customize->add_setting('viral_times_mininews_image_size', array(
    'default' => 'viral-times-150x150',
    'transport' => 'postMessage',
    'sanitize_callback' => 'viral_times_sanitize_choices'
));

$wp_customize->add_control('viral_times_mininews_image_size', array(
    'section' => 'viral_times_frontpage_mininews_section',
    'type' => 'select',
    'label' => esc_html__('Image Size', 'viral-times'),
    'choices' => viral_times_get_image_sizes()
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_fullwidth", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_cat", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_display_cat", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_display_author", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_display_date", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_post_count_big", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_post_count", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_style", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_top_widget", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_bottom_widget", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_mininews_image_size", array(
    'selector' => ".ht-mininews-container",
    'render_callback' => "viral_times_frontpage_mininews_content",
    'container_inclusive' => false
));

/* ============FRONT PAGE SLIDER SECTION============ */
$wp_customize->add_section(new Viral_Times_Toggle_Section($wp_customize, 'viral_times_frontpage_slider1_section', array(
    'title' => esc_html__('Slider Module', 'viral-times'),
    'panel' => 'viral_times_front_page_panel',
    'priority' => viral_times_get_section_position('viral_times_frontpage_slider1_section'),
    'hiding_control' => 'viral_times_frontpage_slider1_section_disable'
)));

$wp_customize->add_setting('viral_times_frontpage_slider1_section_disable', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Viral_Times_Switch_Control($wp_customize, 'viral_times_frontpage_slider1_section_disable', array(
    'section' => 'viral_times_frontpage_slider1_section',
    'label' => esc_html__('Disable Section', 'viral-times'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-times'),
        'off' => esc_html__('No', 'viral-times')
    ),
    'class' => 'ht--switch-section',
    'priority' => -1,
)));


$wp_customize->add_setting('viral_times_frontpage_slider1_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Times_Tab_Control($wp_customize, 'viral_times_frontpage_slider1_nav', array(
    'section' => 'viral_times_frontpage_slider1_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_frontpage_slider1_blocks',
                'viral_times_slider1_widget_heading',
                'viral_times_slider1_top_widget',
                'viral_times_slider1_bottom_widget'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'viral-times'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_times_slider1_cs_heading',
                'viral_times_slider1_title_color',
                'viral_times_slider1_text_color',
                'viral_times_slider1_link_color',
                'viral_times_slider1_block_color_seperator',
                'viral_times_slider1_overwrite_block_title_color',
                'viral_times_slider1_block_title_color',
                'viral_times_slider1_block_title_background_color',
                'viral_times_slider1_block_title_border_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'viral-times'),
            'icon' => 'dashicons dashicons-admin-tools',
            'fields' => array(
                'viral_times_slider1_enable_fullwindow',
                'viral_times_slider1_align_item',
                'viral_times_slider1_fw_seperator',
                'viral_times_slider1_bg_type',
                'viral_times_slider1_bg_color',
                'viral_times_slider1_bg_gradient',
                'viral_times_slider1_bg_image',
                'viral_times_slider1_parallax_effect',
                'viral_times_slider1_bg_video',
                'viral_times_slider1_overlay_color',
                'viral_times_slider1_cs_seperator',
                'viral_times_slider1_padding',
                'viral_times_slider1_margin',
                'viral_times_slider1_seperator0',
                'viral_times_slider1_section_seperator',
                'viral_times_slider1_seperator1',
                'viral_times_slider1_top_seperator',
                'viral_times_slider1_ts_color',
                'viral_times_slider1_ts_height',
                'viral_times_slider1_seperator2',
                'viral_times_slider1_bottom_seperator',
                'viral_times_slider1_bs_color',
                'viral_times_slider1_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('viral_times_frontpage_slider1_blocks', array(
    'sanitize_callback' => 'viral_times_sanitize_repeater',
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'title' => '',
            'category' => '',
            'layout' => 'style1',
            'display_cat' => 'yes',
            'display_author' => 'yes',
            'display_date' => 'yes',
            'post_count' => 5,
            'enable' => 'on'
        )
    ))
));

$wp_customize->add_control(new Viral_Times_Repeater_Control($wp_customize, 'viral_times_frontpage_slider1_blocks', array(
    'label' => esc_html__('Slider Blocks', 'viral-times'),
    'section' => 'viral_times_frontpage_slider1_section',
    'box_label' => esc_html__('News Section', 'viral-times'),
    'add_label' => esc_html__('Add Section', 'viral-times'),
), array(
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'viral-times'),
        'description' => esc_html__('Optional - Leave blank to hide Title', 'viral-times')
    ),
    'category' => array(
        'type' => 'taxonomycheckbox',
        'label' => esc_html__('Select Category', 'viral-times'),
        'default' => '',
        'taxonomy' => 'category',
        'description' => esc_html__('All latest post will display if no category is selected', 'viral-times')
    ),
    'layout' => array(
        'type' => 'selector',
        'label' => esc_html__('Layouts', 'viral-times'),
        'description' => esc_html__('Select the Block Layout', 'viral-times'),
        'options' => array(
            'style1' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/slider/style1.png',
            'style3' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/slider/style3.png',
        ),
        'default' => 'style2'
    ),
    'display_cat' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Categories', 'viral-times'),
        'default' => 'yes'
    ),
    'display_author' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Author', 'viral-times'),
        'default' => 'yes'
    ),
    'display_date' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Date', 'viral-times'),
        'default' => 'yes'
    ),
    'post_count' => array(
        'type' => 'range',
        'label' => esc_html__('No of Posts', 'viral-times'),
        'options' => array(
            'val' => 5,
            'min' => 1,
            'max' => 20,
            'step' => 1,
            'unit' => ''
        )
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_html__('Enable Section', 'viral-times'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));

$wp_customize->selective_refresh->add_partial("viral_times_frontpage_slider1_blocks", array(
    'selector' => ".ht-slider1-container",
    'render_callback' => "viral_times_frontpage_slider1_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_slider1_top_widget", array(
    'selector' => ".ht-slider1-container",
    'render_callback' => "viral_times_frontpage_slider1_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_slider1_bottom_widget", array(
    'selector' => ".ht-slider1-container",
    'render_callback' => "viral_times_frontpage_slider1_content",
    'container_inclusive' => false
));

/* ============FRONT PAGE NEWS SECTION - RIGHT SIDEBAR============ */
$wp_customize->add_section(new Viral_Times_Toggle_Section($wp_customize, 'viral_times_frontpage_leftnews_section', array(
    'title' => esc_html__('News Module - Right Sidebar', 'viral-times'),
    'panel' => 'viral_times_front_page_panel',
    'priority' => viral_times_get_section_position('viral_times_frontpage_leftnews_section'),
    'hiding_control' => 'viral_times_frontpage_leftnews_section_disable'
)));

$wp_customize->add_setting('viral_times_frontpage_leftnews_section_disable', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Viral_Times_Switch_Control($wp_customize, 'viral_times_frontpage_leftnews_section_disable', array(
    'section' => 'viral_times_frontpage_leftnews_section',
    'label' => esc_html__('Disable Section', 'viral-times'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-times'),
        'off' => esc_html__('No', 'viral-times')
    ),
    'class' => 'ht--switch-section',
    'priority' => -1,
)));


$wp_customize->add_setting('viral_times_frontpage_leftnews_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Times_Tab_Control($wp_customize, 'viral_times_frontpage_leftnews_nav', array(
    'section' => 'viral_times_frontpage_leftnews_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_frontpage_leftnews_sticky_sidebar',
                'viral_times_frontpage_leftnews_blocks',
                'viral_times_leftnews_widget_heading',
                'viral_times_leftnews_top_widget',
                'viral_times_leftnews_bottom_widget'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'viral-times'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_times_leftnews_cs_heading',
                'viral_times_leftnews_title_color',
                'viral_times_leftnews_text_color',
                'viral_times_leftnews_link_color',
                'viral_times_leftnews_block_color_seperator',
                'viral_times_leftnews_overwrite_block_title_color',
                'viral_times_leftnews_block_title_color',
                'viral_times_leftnews_block_title_background_color',
                'viral_times_leftnews_block_title_border_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'viral-times'),
            'icon' => 'dashicons dashicons-admin-tools',
            'fields' => array(
                'viral_times_leftnews_enable_fullwindow',
                'viral_times_leftnews_align_item',
                'viral_times_leftnews_fw_seperator',
                'viral_times_leftnews_bg_type',
                'viral_times_leftnews_bg_color',
                'viral_times_leftnews_bg_gradient',
                'viral_times_leftnews_bg_image',
                'viral_times_leftnews_parallax_effect',
                'viral_times_leftnews_bg_video',
                'viral_times_leftnews_overlay_color',
                'viral_times_leftnews_cs_seperator',
                'viral_times_leftnews_padding',
                'viral_times_leftnews_margin',
                'viral_times_leftnews_seperator0',
                'viral_times_leftnews_section_seperator',
                'viral_times_leftnews_seperator1',
                'viral_times_leftnews_top_seperator',
                'viral_times_leftnews_ts_color',
                'viral_times_leftnews_ts_height',
                'viral_times_leftnews_seperator2',
                'viral_times_leftnews_bottom_seperator',
                'viral_times_leftnews_bs_color',
                'viral_times_leftnews_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('viral_times_frontpage_leftnews_sticky_sidebar', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_frontpage_leftnews_sticky_sidebar', array(
    'section' => 'viral_times_frontpage_leftnews_section',
    'label' => esc_html__('Sticky Sidebar', 'viral-times'),
    'description' => esc_html__('A sidebar will stick at the top on scrolling down', 'viral-times')
)));

$wp_customize->add_setting('viral_times_frontpage_leftnews_blocks', array(
    'sanitize_callback' => 'viral_times_sanitize_repeater',
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'title' => esc_html__('Title', 'viral-times'),
            'category' => '',
            'layout' => 'style1',
            'display_cat' => 'yes',
            'display_author' => 'yes',
            'display_date' => 'yes',
            'enable' => 'on'
        )
    ))
));

$wp_customize->add_control(new Viral_Times_Repeater_Control($wp_customize, 'viral_times_frontpage_leftnews_blocks', array(
    'label' => esc_html__('News Blocks', 'viral-times'),
    'section' => 'viral_times_frontpage_leftnews_section',
    'settings' => 'viral_times_frontpage_leftnews_blocks',
    'box_label' => esc_html__('News Section', 'viral-times'),
    'add_label' => esc_html__('Add Section', 'viral-times'),
), array(
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'viral-times'),
        'default' => esc_html__('Title', 'viral-times'),
        'description' => esc_html__('Optional - Leave blank to hide Title', 'viral-times')
    ),
    'category' => array(
        'type' => 'taxonomycheckbox',
        'label' => esc_html__('Select Category', 'viral-times'),
        'default' => '',
        'taxonomy' => 'category',
        'description' => esc_html__('All latest post will display if no category is selected', 'viral-times')
    ),
    'layout' => array(
        'type' => 'selector',
        'label' => esc_html__('Layouts', 'viral-times'),
        'class' => 'ht--one-third-width',
        'description' => esc_html__('Select the Block Layout', 'viral-times'),
        'options' => array(
            'style1' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style1.png',
            'style2' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style2.png',
            'style3' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style3.png',
            'style10' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style10.png',
            'style11' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style11.png',
            'style12' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style12.png',
        ),
        'default' => 'style1'
    ),
    'display_cat' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Category', 'viral-times'),
        'default' => 'yes'
    ),
    'display_author' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Author', 'viral-times'),
        'default' => 'yes'
    ),
    'display_date' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Date', 'viral-times'),
        'default' => 'yes'
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_attr__('Enable Section', 'viral-times'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));

$wp_customize->selective_refresh->add_partial("viral_times_frontpage_leftnews_blocks", array(
    'selector' => ".ht-leftnews-container",
    'render_callback' => "viral_times_frontpage_leftnews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_frontpage_leftnews_sticky_sidebar", array(
    'selector' => ".ht-leftnews-section",
    'render_callback' => "viral_times_frontpage_leftnews_section",
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial("viral_times_leftnews_top_widget", array(
    'selector' => ".ht-leftnews-section",
    'render_callback' => "viral_times_frontpage_leftnews_section",
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial("viral_times_leftnews_bottom_widget", array(
    'selector' => ".ht-leftnews-section",
    'render_callback' => "viral_times_frontpage_leftnews_section",
    'container_inclusive' => true
));

/* ============FRONT PAGE NEWS SECTION - LEFT SIDEBAR============ */
$wp_customize->add_section(new Viral_Times_Toggle_Section($wp_customize, 'viral_times_frontpage_rightnews_section', array(
    'title' => esc_html__('News Module - Left Sidebar', 'viral-times'),
    'panel' => 'viral_times_front_page_panel',
    'priority' => viral_times_get_section_position('viral_times_frontpage_rightnews_section'),
    'hiding_control' => 'viral_times_frontpage_rightnews_section_disable'
)));

$wp_customize->add_setting('viral_times_frontpage_rightnews_section_disable', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Viral_Times_Switch_Control($wp_customize, 'viral_times_frontpage_rightnews_section_disable', array(
    'section' => 'viral_times_frontpage_rightnews_section',
    'label' => esc_html__('Disable Section', 'viral-times'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-times'),
        'off' => esc_html__('No', 'viral-times')
    ),
    'class' => 'ht--switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('viral_times_frontpage_rightnews_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Times_Tab_Control($wp_customize, 'viral_times_frontpage_rightnews_nav', array(
    'section' => 'viral_times_frontpage_rightnews_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_frontpage_rightnews_sticky_sidebar',
                'viral_times_frontpage_rightnews_blocks',
                'viral_times_rightnews_widget_heading',
                'viral_times_rightnews_top_widget',
                'viral_times_rightnews_bottom_widget'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'viral-times'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_times_rightnews_cs_heading',
                'viral_times_rightnews_title_color',
                'viral_times_rightnews_text_color',
                'viral_times_rightnews_link_color',
                'viral_times_rightnews_block_color_seperator',
                'viral_times_rightnews_overwrite_block_title_color',
                'viral_times_rightnews_block_title_color',
                'viral_times_rightnews_block_title_background_color',
                'viral_times_rightnews_block_title_border_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'viral-times'),
            'icon' => 'dashicons dashicons-admin-tools',
            'fields' => array(
                'viral_times_rightnews_enable_fullwindow',
                'viral_times_rightnews_align_item',
                'viral_times_rightnews_fw_seperator',
                'viral_times_rightnews_bg_type',
                'viral_times_rightnews_bg_color',
                'viral_times_rightnews_bg_gradient',
                'viral_times_rightnews_bg_image',
                'viral_times_rightnews_parallax_effect',
                'viral_times_rightnews_bg_video',
                'viral_times_rightnews_overlay_color',
                'viral_times_rightnews_cs_seperator',
                'viral_times_rightnews_padding',
                'viral_times_rightnews_margin',
                'viral_times_rightnews_seperator0',
                'viral_times_rightnews_section_seperator',
                'viral_times_rightnews_seperator1',
                'viral_times_rightnews_top_seperator',
                'viral_times_rightnews_ts_color',
                'viral_times_rightnews_ts_height',
                'viral_times_rightnews_seperator2',
                'viral_times_rightnews_bottom_seperator',
                'viral_times_rightnews_bs_color',
                'viral_times_rightnews_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('viral_times_frontpage_rightnews_sticky_sidebar', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'transport' => 'postMessage',
    'default' => true
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_frontpage_rightnews_sticky_sidebar', array(
    'section' => 'viral_times_frontpage_rightnews_section',
    'label' => esc_html__('Sticky Sidebar', 'viral-times'),
    'description' => esc_html__('A sidebar will stick at the top on scrolling down', 'viral-times')
)));

$wp_customize->add_setting('viral_times_frontpage_rightnews_blocks', array(
    'sanitize_callback' => 'viral_times_sanitize_repeater',
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'title' => esc_html__('Title', 'viral-times'),
            'category' => '',
            'layout' => 'style1',
            'display_cat' => 'yes',
            'display_author' => 'yes',
            'display_date' => 'yes',
            'enable' => 'on'
        )
    ))
));

$wp_customize->add_control(new Viral_Times_Repeater_Control($wp_customize, 'viral_times_frontpage_rightnews_blocks', array(
    'label' => esc_html__('News Blocks', 'viral-times'),
    'section' => 'viral_times_frontpage_rightnews_section',
    'settings' => 'viral_times_frontpage_rightnews_blocks',
    'box_label' => esc_html__('News Section', 'viral-times'),
    'add_label' => esc_html__('Add Section', 'viral-times'),
), array(
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'viral-times'),
        'default' => esc_html__('Title', 'viral-times'),
        'description' => esc_html__('Optional - Leave blank to hide Title', 'viral-times')
    ),
    'category' => array(
        'type' => 'taxonomycheckbox',
        'label' => esc_html__('Select Category', 'viral-times'),
        'default' => '',
        'taxonomy' => 'category',
        'description' => esc_html__('All latest post will display if no category is selected', 'viral-times')
    ),
    'layout' => array(
        'type' => 'selector',
        'label' => esc_html__('Layouts', 'viral-times'),
        'class' => 'ht--one-third-width',
        'description' => esc_html__('Select the Block Layout', 'viral-times'),
        'options' => array(
            'style1' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style1.png',
            'style2' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style2.png',
            'style3' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style3.png',
            'style10' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style10.png',
            'style11' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style11.png',
            'style12' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/news/style12.png',
        ),
        'default' => 'style1'
    ),
    'display_cat' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Category', 'viral-times'),
        'default' => 'yes'
    ),
    'display_author' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Author', 'viral-times'),
        'default' => 'yes'
    ),
    'display_date' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Date', 'viral-times'),
        'default' => 'yes'
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_attr__('Enable Section', 'viral-times'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));

$wp_customize->selective_refresh->add_partial("viral_times_frontpage_rightnews_blocks", array(
    'selector' => ".ht-rightnews-container",
    'render_callback' => "viral_times_frontpage_rightnews_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_frontpage_rightnews_sticky_sidebar", array(
    'selector' => ".ht-rightnews-section",
    'render_callback' => "viral_times_frontpage_rightnews_section",
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial("viral_times_rightnews_top_widget", array(
    'selector' => ".ht-rightnews-section",
    'render_callback' => "viral_times_frontpage_rightnews_section",
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial("viral_times_rightnews_bottom_widget", array(
    'selector' => ".ht-rightnews-section",
    'render_callback' => "viral_times_frontpage_rightnews_section",
    'container_inclusive' => true
));

/* ============FRONT PAGE CAROUSEL SECTION============ */
$wp_customize->add_section(new Viral_Times_Toggle_Section($wp_customize, 'viral_times_frontpage_carousel1_section', array(
    'title' => esc_html__('Carousel Module', 'viral-times'),
    'panel' => 'viral_times_front_page_panel',
    'priority' => viral_times_get_section_position('viral_times_frontpage_carousel1_section'),
    'hiding_control' => 'viral_times_frontpage_carousel1_section_disable'
)));

$wp_customize->add_setting('viral_times_frontpage_carousel1_section_disable', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Viral_Times_Switch_Control($wp_customize, 'viral_times_frontpage_carousel1_section_disable', array(
    'section' => 'viral_times_frontpage_carousel1_section',
    'label' => esc_html__('Disable Section', 'viral-times'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-times'),
        'off' => esc_html__('No', 'viral-times')
    ),
    'class' => 'ht--switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('viral_times_frontpage_carousel1_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Times_Tab_Control($wp_customize, 'viral_times_frontpage_carousel1_nav', array(
    'section' => 'viral_times_frontpage_carousel1_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'viral-times'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_times_frontpage_carousel1_blocks',
                'viral_times_carousel1_widget_heading',
                'viral_times_carousel1_top_widget',
                'viral_times_carousel1_bottom_widget'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'viral-times'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_times_carousel1_cs_heading',
                'viral_times_carousel1_title_color',
                'viral_times_carousel1_text_color',
                'viral_times_carousel1_link_color',
                'viral_times_carousel1_block_color_seperator',
                'viral_times_carousel1_overwrite_block_title_color',
                'viral_times_carousel1_block_title_color',
                'viral_times_carousel1_block_title_background_color',
                'viral_times_carousel1_block_title_border_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'viral-times'),
            'icon' => 'dashicons dashicons-admin-tools',
            'fields' => array(
                'viral_times_carousel1_enable_fullwindow',
                'viral_times_carousel1_align_item',
                'viral_times_carousel1_fw_seperator',
                'viral_times_carousel1_bg_type',
                'viral_times_carousel1_bg_color',
                'viral_times_carousel1_bg_gradient',
                'viral_times_carousel1_bg_image',
                'viral_times_carousel1_parallax_effect',
                'viral_times_carousel1_bg_video',
                'viral_times_carousel1_overlay_color',
                'viral_times_carousel1_cs_seperator',
                'viral_times_carousel1_padding',
                'viral_times_carousel1_margin',
                'viral_times_carousel1_seperator0',
                'viral_times_carousel1_section_seperator',
                'viral_times_carousel1_seperator1',
                'viral_times_carousel1_top_seperator',
                'viral_times_carousel1_ts_color',
                'viral_times_carousel1_ts_height',
                'viral_times_carousel1_seperator2',
                'viral_times_carousel1_bottom_seperator',
                'viral_times_carousel1_bs_color',
                'viral_times_carousel1_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('viral_times_frontpage_carousel1_blocks', array(
    'sanitize_callback' => 'viral_times_sanitize_repeater',
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'title' => '',
            'category' => '',
            'layout' => 'style1',
            'display_cat' => 'yes',
            'display_author' => 'yes',
            'display_date' => 'yes',
            'post_count' => 5,
            'slide_count' => 4,
            'slide_pause' => 5,
            'auto_slide' => 'on',
            'image_size' => 'viral-times-650x500',
            'title_size' => 'vl-small-title',
            'gap' => '20',
            'enable' => 'on'
        )
    ))
));

$wp_customize->add_control(new Viral_Times_Repeater_Control($wp_customize, 'viral_times_frontpage_carousel1_blocks', array(
    'label' => esc_html__('Carousel Blocks', 'viral-times'),
    'section' => 'viral_times_frontpage_carousel1_section',
    'settings' => 'viral_times_frontpage_carousel1_blocks',
    'box_label' => esc_html__('News Section', 'viral-times'),
    'add_label' => esc_html__('Add Section', 'viral-times'),
), array(
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'viral-times'),
        'description' => esc_html__('Optional - Leave blank to hide Title', 'viral-times')
    ),
    'category' => array(
        'type' => 'taxonomycheckbox',
        'label' => esc_html__('Select Category', 'viral-times'),
        'default' => '',
        'taxonomy' => 'category',
        'description' => esc_html__('All latest post will display if no category is selected', 'viral-times')
    ),
    'layout' => array(
        'type' => 'selector',
        'label' => esc_html__('Layouts', 'viral-times'),
        'description' => esc_html__('Select the Block Layout', 'viral-times'),
        'options' => array(
            'style1' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/carousel/style1.png',
            'style3' => VIRAL_TIMES_CUSTOMIZER_URL . 'customizer-panel/images/carousel/style3.png',
        ),
        'default' => 'style2'
    ),
    'display_cat' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Category', 'viral-times'),
        'default' => 'yes'
    ),
    'display_author' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Author', 'viral-times'),
        'default' => 'yes'
    ),
    'display_date' => array(
        'type' => 'toggle',
        'label' => esc_html__('Display Date', 'viral-times'),
        'default' => 'yes'
    ),
    'post_count' => array(
        'type' => 'range',
        'label' => esc_html__('No of Posts', 'viral-times'),
        'options' => array(
            'val' => 5,
            'min' => 2,
            'max' => 20,
            'step' => 1,
            'unit' => ''
        )
    ),
    'slide_count' => array(
        'type' => 'range',
        'label' => esc_html__('No of slides', 'viral-times'),
        'options' => array(
            'val' => 4,
            'min' => 2,
            'max' => 6,
            'step' => 1,
            'unit' => ''
        )
    ),
    'slide_pause' => array(
        'type' => 'range',
        'label' => esc_html__('Slides Pause Duration(Seconds)', 'viral-times'),
        'options' => array(
            'val' => 5,
            'min' => 4,
            'max' => 20,
            'step' => 1,
            'unit' => ''
        )
    ),
    'auto_slide' => array(
        'type' => 'toggle',
        'label' => esc_html__('Auto Slide', 'viral-times'),
        'default' => 'yes'
    ),
    'image_size' => array(
        'type' => 'select',
        'label' => esc_html__('Image Size', 'viral-times'),
        'options' => viral_times_get_image_sizes(),
        'default' => 'viral-times-650x500'
    ),
    'title_size' => array(
        'type' => 'select',
        'label' => esc_html__('Title Font Size', 'viral-times'),
        'options' => array(
            'vl-small-title' => esc_html__('Normal', 'viral-times'),
            'vl-mid-title' => esc_html__('Medium', 'viral-times'),
            'vl-big-title' => esc_html__('Big', 'viral-times'),
        ),
        'default' => 'vl-small-title'
    ),
    'gap' => array(
        'type' => 'select',
        'label' => esc_html__('Space Between Slides', 'viral-times'),
        'options' => array(
            '0' => esc_html__('No Space', 'viral-times'),
            '10' => esc_html__('10px', 'viral-times'),
            '20' => esc_html__('20px', 'viral-times'),
            '30' => esc_html__('30px', 'viral-times'),
        ),
        'default' => '20'
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_html__('Enable Section', 'viral-times'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));

$wp_customize->selective_refresh->add_partial("viral_times_frontpage_carousel1_blocks", array(
    'selector' => ".ht-carousel1-container",
    'render_callback' => "viral_times_frontpage_carousel1_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_carousel1_top_widget", array(
    'selector' => ".ht-carousel1-container",
    'render_callback' => "viral_times_frontpage_carousel1_content",
    'container_inclusive' => false
));

$wp_customize->selective_refresh->add_partial("viral_times_carousel1_bottom_widget", array(
    'selector' => ".ht-carousel1-container",
    'render_callback' => "viral_times_frontpage_carousel1_content",
    'container_inclusive' => false
));

/* ============DESIGN SETTINGS============ */

$home_sections = viral_times_frontpage_sections();

foreach ($home_sections as $home_section) {
    $id = str_replace(array('viral_times_frontpage_', '_section'), array('', ''), $home_section);

    $wp_customize->add_setting("viral_times_{$id}_bg_type", array(
        'default' => 'color-bg',
        'sanitize_callback' => 'viral_times_sanitize_choices',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control("viral_times_{$id}_bg_type", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Background Type', 'viral-times'),
        'choices' => array(
            'color-bg' => esc_html__('Color Background', 'viral-times'),
            'image-bg' => esc_html__('Image Background', 'viral-times'),
        ),
        'priority' => 15
    ));

    $wp_customize->add_setting("viral_times_{$id}_bg_color", array(
        'default' => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_times_{$id}_bg_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'label' => esc_html__('Background Color', 'viral-times'),
        'priority' => 20
    )));

    $wp_customize->add_setting("viral_times_{$id}_bg_image_url", array(
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_bg_image_id", array(
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_bg_image_repeat", array(
        'default' => 'no-repeat',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_bg_image_size", array(
        'default' => 'cover',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_bg_position", array(
        'default' => 'center-center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_bg_image_attach", array(
        'default' => 'fixed',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Viral_Times_Background_Image_Control($wp_customize, "viral_times_{$id}_bg_image", array(
        'label' => esc_html__('Background Image', 'viral-times'),
        'section' => "viral_times_frontpage_{$id}_section",
        'settings' => array(
            'image_url' => "viral_times_{$id}_bg_image_url",
            'image_id' => "viral_times_{$id}_bg_image_id",
            'repeat' => "viral_times_{$id}_bg_image_repeat", // Use false to hide the field
            'size' => "viral_times_{$id}_bg_image_size",
            'position' => "viral_times_{$id}_bg_position",
            'attachment' => "viral_times_{$id}_bg_image_attach"
        ),
        'priority' => 30
    )));

    $wp_customize->add_setting("viral_times_{$id}_overlay_color", array(
        'default' => 'rgba(255,255,255,0)',
        'sanitize_callback' => 'viral_times_sanitize_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Viral_Times_Alpha_Color_Control($wp_customize, "viral_times_{$id}_overlay_color", array(
        'label' => esc_html__('Background Overlay Color', 'viral-times'),
        'section' => "viral_times_frontpage_{$id}_section",
        'priority' => 45
    )));

    $wp_customize->add_setting("viral_times_{$id}_cs_heading", array(
        'sanitize_callback' => 'viral_times_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_Times_Heading_Control($wp_customize, "viral_times_{$id}_cs_heading", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'label' => esc_html__('Color Settings', 'viral-times'),
        'priority' => 50
    )));

    $wp_customize->add_setting("viral_times_{$id}_title_color", array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_times_{$id}_title_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'label' => esc_html__('Section Title Color(H1, H2, H3, H4, H5, H6)', 'viral-times'),
        'priority' => 55
    )));

    $wp_customize->add_setting("viral_times_{$id}_text_color", array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_times_{$id}_text_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'label' => esc_html__('Section Text Color', 'viral-times'),
        'priority' => 55
    )));

    $wp_customize->add_setting("viral_times_{$id}_link_color", array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_times_{$id}_link_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'label' => esc_html__('Section Link Color', 'viral-times'),
        'priority' => 55
    )));

    $wp_customize->add_setting("viral_times_{$id}_block_color_seperator", array(
        'sanitize_callback' => 'viral_times_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_Times_Separator_Control($wp_customize, "viral_times_{$id}_block_color_seperator", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'priority' => 55
    )));

    $wp_customize->add_setting("viral_times_{$id}_overwrite_block_title_color", array(
        'sanitize_callback' => 'viral_times_sanitize_text',
        'default' => false,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, "viral_times_{$id}_overwrite_block_title_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'priority' => 55,
        'label' => esc_html__('OverWrite Block Title Colors', 'viral-times')
    )));

    $wp_customize->add_setting("viral_times_{$id}_block_title_color", array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_times_{$id}_block_title_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'priority' => 55,
        'label' => esc_html__('Block Title Color', 'viral-times')
    )));

    $wp_customize->add_setting("viral_times_{$id}_block_title_background_color", array(
        'default' => '#f97c00',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_times_{$id}_block_title_background_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'priority' => 55,
        'label' => esc_html__('Block Title Background Color', 'viral-times')
    )));

    $wp_customize->add_setting("viral_times_{$id}_block_title_border_color", array(
        'default' => '#f97c00',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_times_{$id}_block_title_border_color", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'priority' => 55,
        'label' => esc_html__('Block Title Border Color', 'viral-times')
    )));

    $wp_customize->add_setting("viral_times_{$id}_cs_seperator", array(
        'sanitize_callback' => 'viral_times_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_Times_Separator_Control($wp_customize, "viral_times_{$id}_cs_seperator", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'priority' => 80
    )));

    $wp_customize->add_setting("viral_times_{$id}_padding_top", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'default' => 20,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_padding_bottom", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'default' => 20,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_tablet_padding_top", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_tablet_padding_bottom", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_mobile_padding_top", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_mobile_padding_bottom", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Viral_Times_Dimensions_Control($wp_customize, "viral_times_{$id}_padding", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'label' => esc_html__('Top & Bottom Paddings (px)', 'viral-times'),
        'settings' => array(
            'desktop_top' => "viral_times_{$id}_padding_top",
            'desktop_bottom' => "viral_times_{$id}_padding_bottom",
            'tablet_top' => "viral_times_{$id}_tablet_padding_top",
            'tablet_bottom' => "viral_times_{$id}_tablet_padding_bottom",
            'mobile_top' => "viral_times_{$id}_mobile_padding_top",
            'mobile_bottom' => "viral_times_{$id}_mobile_padding_bottom",
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 400,
            'step' => 1,
        ),
        'priority' => 85
    )));

    $wp_customize->add_setting("viral_times_{$id}_margin_top", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_margin_bottom", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_tablet_margin_top", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_tablet_margin_bottom", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_mobile_margin_top", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("viral_times_{$id}_mobile_margin_bottom", array(
        'sanitize_callback' => 'viral_times_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Viral_Times_Dimensions_Control($wp_customize, "viral_times_{$id}_margin", array(
        'section' => "viral_times_frontpage_{$id}_section",
        'label' => esc_html__('Top & Bottom Margin (px)', 'viral-times'),
        'settings' => array(
            'desktop_top' => "viral_times_{$id}_margin_top",
            'desktop_bottom' => "viral_times_{$id}_margin_bottom",
            'tablet_top' => "viral_times_{$id}_tablet_margin_top",
            'tablet_bottom' => "viral_times_{$id}_tablet_margin_bottom",
            'mobile_top' => "viral_times_{$id}_mobile_margin_top",
            'mobile_bottom' => "viral_times_{$id}_mobile_margin_bottom",
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 400,
            'step' => 1,
        ),
        'priority' => 85
    )));

    $wp_customize->selective_refresh->add_partial("viral_times_{$id}_bg_type", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "viral_times_frontpage_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("viral_times_{$id}_parallax_effect", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "viral_times_frontpage_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("viral_times_{$id}_section_seperator", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "viral_times_frontpage_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("viral_times_{$id}_top_seperator", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "viral_times_frontpage_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("viral_times_{$id}_bottom_seperator", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "viral_times_frontpage_{$id}_section",
        'container_inclusive' => true
    ));
}