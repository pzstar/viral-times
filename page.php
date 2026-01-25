<?php
/**
 * The template for displaying all pages.
 *
 * @package Viral Times
 */
get_header();

$viral_times_enable_frontpage = get_theme_mod('viral_times_enable_frontpage', false);

if (is_front_page() && $viral_times_enable_frontpage) {
    $sections = viral_times_frontpage_sections();

    foreach ($sections as $section) {
        $section();
    }
} else {
$viral_times_show_title = get_theme_mod('viral_times_show_title', true);
$parallax = '';
?>
<header class="ht-main-header">
    <div class="ht-container">
        <?php
        if ($viral_times_show_title) {
            the_title('<h1 class="ht-main-title">', '</h1>');
        }

        do_action('viral_times_breadcrumbs');
        ?>
    </div>
</header><!-- .entry-header -->
<?php

$container_class = array('ht-main-content', 'ht-clearfix', 'ht-container');

do_action('viral_times_before_page_container');
?>
<div class="<?php echo implode(' ', $container_class); ?>">
    <div class="ht-site-wrapper">
        <div id="primary" class="content-area">

            <?php while (have_posts()):
                the_post(); ?>

                <?php get_template_part('template-parts/content', 'page'); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()):
                    comments_template();
                endif;
                ?>

            <?php endwhile; // End of the loop.  ?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
}
get_footer();
