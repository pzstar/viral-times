<?php

/**
 * Viral Times Theme Customizer
 *
 * @package Viral Times
 */
/* GENERAL SETTINGS PANEL */
$wp_customize->add_panel('viral_times_general_settings_panel', array(
    'title' => esc_html__('General Settings', 'viral-times'),
    'priority' => 1
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

$wp_customize->add_setting('viral_times_general_options_upgrade_text', array(
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control(new Viral_Times_Upgrade_Info_Control($wp_customize, 'viral_times_general_options_upgrade_text', array(
    'section' => 'viral_times_general_options_section',
    'label' => esc_html__('For more options,', 'viral-times'),
    'choices' => array(
        esc_html__('16 animated preloaders, or upload your own image', 'viral-times'),
        esc_html__('Admin page custom logo', 'viral-times')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Unlock in Viral Pro', 'viral-times'),
    'upgrade_url' => viral_times_upgrade_url('general-options', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
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

$wp_customize->add_setting('viral_times_backtotop_upgrade_text', array(
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control(new Viral_Times_Upgrade_Info_Control($wp_customize, 'viral_times_backtotop_upgrade_text', array(
    'section' => 'viral_times_backtotop_section',
    'label' => esc_html__('For advanced settings,', 'viral-times'),
    'choices' => array(
        esc_html__('Set custom top icon', 'viral-times'),
        esc_html__('Set custom height, width, position & icon size', 'viral-times'),
        esc_html__('Set custom normal & hover color', 'viral-times')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Unlock in Viral Pro', 'viral-times'),
    'upgrade_url' => viral_times_upgrade_url('back-to-top', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
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
    'title' => esc_html__('SEO and Performance', 'viral-times'),
    'panel' => 'viral_times_general_settings_panel',
    'priority' => 1000
));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-preloader-upgrade-section', array(
    'title' => esc_html__('Preloader Settings', 'viral-times'),
    'panel' => 'viral_times_general_settings_panel',
    'priority' => 1001,
    'upgrade_text' => esc_html__('Get Pro', 'viral-times'),
    'class' => 'ht--single-row ht--pro-row',
    'upgrade_url' => viral_times_upgrade_url('sec-preloader', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-toc-upgrade-section', array(
    'title' => esc_html__('Table of Contents', 'viral-times'),
    'panel' => 'viral_times_general_settings_panel',
    'priority' => 1002,
    'upgrade_text' => esc_html__('Get Pro', 'viral-times'),
    'class' => 'ht--single-row ht--pro-row',
    'upgrade_url' => viral_times_upgrade_url('sec-table-of-contents', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

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


// Seasonal campaigns swap the banner copy automatically - see viral_times_get_active_campaign().
$viral_times_campaign = viral_times_get_active_campaign();
$viral_times_banner_title = $viral_times_campaign ? $viral_times_campaign['title'] : esc_html__('One-time payment. Unlimited sites. Lifetime updates.', 'viral-times');
$viral_times_banner_button = $viral_times_campaign ? $viral_times_campaign['button'] : esc_html__('Get Viral Pro - $69', 'viral-times');

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-pro-section', array(
    'priority' => -10,
    'title' => $viral_times_banner_title,
    'upgrade_text' => $viral_times_banner_button,
    'upgrade_url' => viral_times_upgrade_url($viral_times_campaign ? 'banner-' . $viral_times_campaign['id'] : 'banner', 'viral-times-customizer-button'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-doc-section', array(
    'title' => esc_html__('Documentation', 'viral-times'),
    'priority' => 1000,
    'class' => 'ht--single-row',
    'upgrade_text' => esc_html__('View', 'viral-times'),
    'upgrade_url' => 'https://hashthemes.com/documentation/viral-times-documentation/'
)));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-demo-import-section', array(
    'title' => esc_html__('Import Demo Content', 'viral-times'),
    'priority' => 999,
    'class' => 'ht--single-row',
    'upgrade_text' => esc_html__('Import', 'viral-times'),
    'upgrade_url' => admin_url('admin.php?page=viral-times-welcome')
)));

$viral_pro_features = '<p><strong>' . esc_html__("$69 once. No subscription, no renewal fees.", "viral-times") . '</strong><br>' . esc_html__("Use Viral Pro on unlimited websites, keep every future update free, and get support replies in 10 hours or less.", "viral-times") . '</p>
    <ul class="upsell-features">
	<li>' . esc_html__("17 ready-made demos that can be imported with one click", 'viral-times') . '</li>
        <li>' . esc_html__("Elementor widgets built into the theme - no companion plugin needed", 'viral-times') . '</li>
	<li>' . esc_html__("50+ magazine blocks for customizer", 'viral-times') . '</li>
	<li>' . esc_html__("Customizer home page section reorder", 'viral-times') . '</li>
	<li>' . esc_html__("45+ magazine widgets for Elementor", 'viral-times') . '</li>
        <li>' . esc_html__("Ajax Tabs and Ajax Paginations for all Elementor widgets", 'viral-times') . '</li>
	<li>' . esc_html__("12 title bar styles and 10 thumbnail hover effects for magazine blocks", 'viral-times') . '</li>
	<li>' . esc_html__("7 header layouts with advanced settings", 'viral-times') . '</li>
        <li>' . esc_html__("7 differently designed Blog/Archive layouts", 'viral-times') . '</li>
	<li>' . esc_html__("7 differently designed Article/Post layouts", 'viral-times') . '</li>
	<li>' . esc_html__("23 custom widgets", 'viral-times') . '</li>
	<li>' . esc_html__("Table of contents for single posts", 'viral-times') . '</li>
	<li>' . esc_html__("NewsArticle structured data in JSON-LD with speakable markup", 'viral-times') . '</li>
	<li>' . esc_html__("Google News sitemap", 'viral-times') . '</li>
	<li>' . esc_html__("Speculative loading - the next article opens instantly", 'viral-times') . '</li>
	<li>' . esc_html__("Icon library and Google font loading control", 'viral-times') . '</li>
	<li>' . esc_html__("Print stylesheet for articles", 'viral-times') . '</li>
	<li>' . esc_html__("GDPR compliance & cookies consent", 'viral-times') . '</li>
	<li>' . esc_html__("In-built megaMenu", 'viral-times') . '</li>
	<li>' . esc_html__("Advanced typography options", 'viral-times') . '</li>
	<li>' . esc_html__("Advanced color options", 'viral-times') . '</li>
	<li>' . esc_html__("Preloader option", 'viral-times') . '</li>
	<li>' . esc_html__("Advanced blog & article settings", 'viral-times') . '</li>
	<li>' . esc_html__("Advanced footer setting", 'viral-times') . '</li>
	<li>' . esc_html__("Advanced advertising & monetization options", 'viral-times') . '</li>
	<li>' . esc_html__("WooCommerce compatible", 'viral-times') . '</li>
	<li>' . esc_html__("Polylang compatible", 'viral-times') . '</li>
	<li>' . esc_html__("Fully RTL(right to left) languages compatible", 'viral-times') . '</li>
        <li>' . esc_html__("Maintenance mode option", 'viral-times') . '</li>
        <li>' . esc_html__("Remove footer credit text", 'viral-times') . '</li>
	<li>' . esc_html__("Unlimited custom widget areas", "viral-times") . '</li>
	<li>' . esc_html__("16 SVG shape dividers between front page sections", "viral-times") . '</li>
	</ul>
	<a class="ht-implink button button-primary" href="' . esc_url(viral_times_upgrade_url('why-upgrade-cta', 'viral-times-customizer')) . '" target="_blank">' . esc_html__("Get Viral Pro - $69", 'viral-times') . '</a>
	<p style="text-align:center;margin:10px 0 0"><a href="' . admin_url('admin.php?page=viral-times-welcome&section=free_vs_pro') . '" target="_blank">' . esc_html__("Compare Free vs Pro", 'viral-times') . '</a></p>';

/* ============PRO FEATURES============ */
$wp_customize->add_section('viral_pro_feature_section', array(
    'title' => esc_html__('Why Upgrade to Viral Pro?', 'viral-times'),
    'priority' => -1
));

$wp_customize->add_setting('viral_times_hide_upgrade_notice', array(
    'sanitize_callback' => 'viral_times_sanitize_checkbox',
    'default' => false,
));

$wp_customize->add_control(new Viral_Times_Toggle_Control($wp_customize, 'viral_times_hide_upgrade_notice', array(
    'section' => 'viral_pro_feature_section',
    'priority' => 20,
    'label' => esc_html__('Hide all Upgrade Notices from Customizer', 'viral-times'),
    'description' => esc_html__('If you don\'t want to upgrade to premium version then you can turn off all the upgrade notices. However you can turn it on anytime if you make mind to upgrade to premium version.', 'viral-times')
)));

$wp_customize->add_setting('viral_pro_features', array(
    'sanitize_callback' => 'viral_times_sanitize_text',
));

$wp_customize->add_control(new Viral_Times_Upgrade_Info_Control($wp_customize, 'viral_pro_features', array(
    'settings' => 'viral_pro_features',
    'section' => 'viral_pro_feature_section',
    'priority' => 10,
    'description' => $viral_pro_features,
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

/* ============CONTEXTUAL UPSELLS & PRO TEASER SECTIONS============ */

$wp_customize->add_setting('viral_times_google_font_upgrade_text', array(
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control(new Viral_Times_Upgrade_Info_Control($wp_customize, 'viral_times_google_font_upgrade_text', array(
    'section' => 'viral_times_google_font_section',
    'label' => esc_html__('For more font and icon control,', 'viral-times'),
    'choices' => array(
        esc_html__('Switch off the icon libraries you do not use - they leave the page and the icon picker', 'viral-times'),
        esc_html__('Request only the Google font weights your site actually uses', 'viral-times'),
        esc_html__('Preconnect to the Google font hosts for a faster first paint', 'viral-times')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Unlock in Viral Pro', 'viral-times'),
    'upgrade_url' => viral_times_upgrade_url('google-fonts', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

$wp_customize->add_setting('viral_times_seo_upgrade_text', array(
    'sanitize_callback' => 'viral_times_sanitize_text'
));

$wp_customize->add_control(new Viral_Times_Upgrade_Info_Control($wp_customize, 'viral_times_seo_upgrade_text', array(
    'section' => 'viral_times_seo_section',
    'label' => esc_html__('For more SEO options,', 'viral-times'),
    'choices' => array(
        esc_html__('NewsArticle structured data in JSON-LD with speakable markup', 'viral-times'),
        esc_html__('Google News sitemap so your posts get picked up faster', 'viral-times'),
        esc_html__('Speculative loading - the next article opens instantly', 'viral-times'),
        esc_html__('Print stylesheet for articles', 'viral-times')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Unlock in Viral Pro', 'viral-times'),
    'upgrade_url' => viral_times_upgrade_url('seo', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-site-tools-upgrade-section', array(
    'title' => esc_html__('GDPR & Maintenance', 'viral-times'),
    'priority' => 56,
    'upgrade_text' => esc_html__('Get Pro', 'viral-times'),
    'class' => 'ht--single-row ht--pro-row',
    'upgrade_url' => viral_times_upgrade_url('sec-gdpr-maintenance', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

$wp_customize->add_section(new Viral_Times_Upgrade_Section($wp_customize, 'viral-times-ads-upgrade-section', array(
    'title' => esc_html__('Advertising & Monetization', 'viral-times'),
    'priority' => 55,
    'upgrade_text' => esc_html__('Get Pro', 'viral-times'),
    'class' => 'ht--single-row ht--pro-row',
    'upgrade_url' => viral_times_upgrade_url('sec-advertising', 'viral-times-customizer'),
    'active_callback' => 'viral_times_is_upgrade_notice_active'
)));

