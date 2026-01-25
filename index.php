<?php
/**
 * The main template file.
 *
 * @package Viral Times
 */
get_header();

$viral_times_enable_frontpage = get_theme_mod('viral_times_enable_frontpage', false);

if ($viral_times_enable_frontpage) {
    $sections = viral_times_frontpage_sections();

    foreach ($sections as $section) {
        $section();
    }
} else {
    $container_class = array('ht-main-content', 'ht-clearfix');
    $viral_times_show_title = get_theme_mod('viral_times_show_title', true);

    if (is_home() && !is_front_page()) {

        if ('page' == get_option('show_on_front')) {
            $blog_page_id = get_option('page_for_posts');
            $title = get_the_title($blog_page_id);
        }
        ?>
        <header class="ht-main-header">
            <div class="ht-container">
                <?php
                if ($viral_times_show_title) {
                    ?>
                    <h1 class="ht-main-title"><?php echo esc_html($title); ?></h1>
                    <?php
                }

                do_action('viral_times_breadcrumbs');
                ?>
            </div>
        </header><!-- .entry-header -->
        <?php
        $container_class[] = 'ht-container';

    } else {
        ?>
        <header class="ht-main-header">
            <div class="ht-container">
                <?php
                if ($viral_times_show_title) {
                    ?>
                    <h1 class="ht-main-title"><?php esc_html_e('Blog Post', 'viral-times'); ?></h1>
                    <?php
                }
                ?>
            </div>
        </header><!-- .entry-header -->
        <?php
        $container_class[] = 'ht-container';
    }
    ?>
    <div class="<?php echo implode(' ', $container_class); ?>">
        <div class="ht-site-wrapper">
            <div id="primary" class="content-area">

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
                    the_posts_pagination(
                        array(
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
}

get_footer();
