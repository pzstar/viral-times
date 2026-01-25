<?php
/**
 * @package Viral Times
 */
$viral_times_mh_menu_hover_style = get_theme_mod('viral_times_mh_menu_hover_style', 'hover-style6');
$viral_times_th_disable_mobile = get_theme_mod('viral_times_th_disable_mobile', false);
$viral_times_tagline_position = get_theme_mod('viral_times_tagline_position', 'ht-tagline-inline-logo');
$viral_times_mh_border = get_theme_mod('viral_times_mh_border', 'ht-no-border');

$header_class = array('ht-site-header', 'ht-header-five', $viral_times_mh_menu_hover_style, $viral_times_tagline_position, $viral_times_mh_border);

if ($viral_times_th_disable_mobile) {
    $header_class[] = 'ht-topheader-mobile-disable';
}
?>

<header id="ht-masthead" class="<?php echo esc_attr(implode(' ', $header_class)); ?>" <?php echo viral_times_get_schema_attribute('header'); ?>>
    <?php
    $viral_times_top_header = get_theme_mod('viral_times_top_header', 'on');
    if ($viral_times_top_header == 'on') {
        ?>
        <div class="ht-top-header">
            <div class="ht-container">
                <?php do_action('viral_times_top_header'); ?>
            </div>
        </div><!-- .ht-top-header -->
    <?php } ?>

    <div class="ht-middle-header">
        <div class="ht-container">
            <div id="ht-site-branding" <?php echo viral_times_get_schema_attribute('logo'); ?>>
                <?php viral_times_header_logo(); ?>
            </div><!-- .site-branding -->

            <?php if (is_active_sidebar('viral-times-header-widget')) { ?>
                <div class="ht-header-widget">
                    <?php dynamic_sidebar('viral-times-header-widget'); ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="ht-header">

        <div class="ht-container">
            <nav id="ht-site-navigation" class="ht-main-navigation" <?php echo viral_times_get_schema_attribute('navigation'); ?>>
                <?php viral_times_main_navigation(); ?>
            </nav><!-- #ht-site-navigation -->
            <?php do_action('viral_times_mobile_header'); ?>
        </div>
    </div>
    <?php do_action('viral_times_header_content') ?>
</header><!-- #ht-masthead -->