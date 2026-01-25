<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Viral Times
 */
get_header();

$viral_times_show_title = get_theme_mod('viral_times_show_title', true);
?>
<header class="ht-main-header">
    <div class="ht-container">
        <?php
        if ($viral_times_show_title) {
            ?>
            <h1 class="ht-main-title"><?php esc_html_e('404 Error', 'viral-times'); ?></h1>
            <?php
        }

        do_action('viral_times_breadcrumbs');
        ?>
    </div>
</header><!-- .entry-header -->

<div class="ht-container">
    <div class="oops-text"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'viral-times'); ?></div>
    <div class="oops-image">
        <img alt="<?php esc_attr_e('404 Error', 'viral-times'); ?>" src="<?php echo esc_url(get_template_directory_uri() . '/images/404.png'); ?>" />
    </div>
</div>

<?php get_footer(); ?>