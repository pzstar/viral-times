<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
            the_archive_title('<h1 class="ht-main-title">', '</h1>');
            the_archive_description('<div class="taxonomy-description">', '</div>');
        }

        do_action('viral_times_breadcrumbs');
        ?>
    </div>
</header><!-- .entry-header -->

<div class="ht-main-content ht-clearfix ht-container">
    <div class="ht-site-wrapper">
        <div id="primary" class="content-area" <?php echo viral_times_get_schema_attribute('blog'); ?>>

            <?php if (have_posts()): ?>

                <div class="site-main-loop">
                    <?php while (have_posts()):
                        the_post(); ?>

                        <?php
                        get_template_part('template-parts/content', 'summary');
                        ?>

                    <?php endwhile; ?>
                </div>
                <?php
                the_posts_pagination(array(
                    'prev_text' => esc_html__('Prev', 'viral-times'),
                    'next_text' => esc_html__('Next', 'viral-times'),
                )
                );
                ?>

            <?php else: ?>

                <?php get_template_part('template-parts/content', 'none'); ?>

            <?php endif; ?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
