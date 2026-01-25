<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Viral Times
 */

$viral_times_sidebar_layout = "right-sidebar";

if (is_singular('page')) {
    $viral_times_sidebar_layout = get_theme_mod('viral_times_page_layout', 'right-sidebar');
} elseif (is_singular('post')) {
    $viral_times_sidebar_layout = get_theme_mod('viral_times_post_layout', 'right-sidebar');
} elseif (is_archive() && !is_home() && !is_search()) {
    $viral_times_sidebar_layout = get_theme_mod('viral_times_archive_layout', 'right-sidebar');
} elseif (is_home()) {
    $viral_times_sidebar_layout = get_theme_mod('viral_times_home_blog_layout', 'right-sidebar');
} elseif (is_search()) {
    $viral_times_sidebar_layout = get_theme_mod('viral_times_search_layout', 'right-sidebar');
}

if ($viral_times_sidebar_layout == "no-sidebar" || $viral_times_sidebar_layout == "no-sidebar-narrow") {
    return;
}

if (is_active_sidebar('viral-times-right-sidebar')) {
    ?>
    <div id="secondary" class="widget-area" <?php echo viral_times_get_schema_attribute('sidebar'); ?>>
        <div class="theiaStickySidebar">
            <?php dynamic_sidebar('viral-times-right-sidebar'); ?>
        </div>
    </div><!-- #secondary -->
    <?php
}