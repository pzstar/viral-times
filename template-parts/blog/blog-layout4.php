<?php
/**
 * Template part for displaying posts.
 *
 * @package Viral Times
 */
$viral_times_archive_content = get_theme_mod('viral_times_archive_content', 'excerpt');
$viral_times_blog_date = get_theme_mod('viral_times_blog_date', true);
$viral_times_blog_author = get_theme_mod('viral_times_blog_author', true);
$viral_times_blog_comment = get_theme_mod('viral_times_blog_comment', true);
$viral_times_blog_category = get_theme_mod('viral_times_blog_category', true);
$viral_times_blog_tag = get_theme_mod('viral_times_blog_tag', true);
$viral_times_archive_excerpt_length = get_theme_mod('viral_times_archive_excerpt_length', '100');
$viral_times_archive_readmore = get_theme_mod('viral_times_archive_readmore', esc_html__('Read More', 'viral-times'));
$viral_times_is_updated_date = get_theme_mod('viral_times_blog_display_date_option', 'posted') == 'updated' ? true : false;
$current_post_count = $wp_query->current_post;
$total_post_count = $wp_query->post_count;
$imagesize = ($current_post_count == 0) ? 'viral-times-800x500' : 'viral-times-500x500';
$default_image = ($current_post_count == 0) ? get_template_directory_uri() . '/images/placeholder-800x500.jpg' : get_template_directory_uri() . '/images/placeholder-500x500.jpg';
$post_class = ($current_post_count == 0) ? 'blog-layout4 blog-layout4-first' : 'blog-layout4';
if ($current_post_count == 1) {
    echo '<div class="viral-times-hentry-wrap">';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('viral-times-hentry', $post_class)); ?> <?php echo viral_times_get_schema_attribute('article'); ?>>
    <div class="ht-article-wrap">
        <figure class="entry-figure">
            <?php
            if (has_post_thumbnail()) {
                $viral_times_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $imagesize);
                $viral_times_image_url = $viral_times_image[0];
            } else {
                $viral_times_image_url = $default_image;
            }
            ?>
            <a href="<?php the_permalink(); ?>">
                <div class="entry-thumb-container">
                    <img src="<?php echo esc_url($viral_times_image_url); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
                </div>
            </a>
            <?php
            $post_date = $viral_times_is_updated_date ? get_the_modified_date('d') : get_the_date('d');
            $post_month = $viral_times_is_updated_date ? get_the_modified_date('M') : get_the_date('M');
            if ('post' == get_post_type() && $viral_times_blog_date) {
                ?>
                <div class="ht-post-date">
                    <div class="ht-day"><?php echo $post_date; ?></div>
                    <div class="ht-month"><?php echo $post_month; ?></div>
                </div>
                <?php
            }
            ?>
        </figure>

        <div class="ht-post-content">
            <?php if ('post' == get_post_type() && ($viral_times_blog_category || $viral_times_blog_tag)) { ?>
                <div class="entry-meta">
                    <?php
                    if ($viral_times_blog_category) {
                        echo viral_times_entry_category();
                    }

                    if ($viral_times_blog_tag) {
                        echo viral_times_entry_tag();
                    }
                    ?>
                </div>
            <?php } ?>

            <header class="entry-header">
                <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
            </header><!-- .entry-header -->

            <?php if ('post' == get_post_type() && ($viral_times_blog_author || $viral_times_blog_comment)): ?>
                <div class="entry-meta">
                    <?php
                    if ($viral_times_blog_author) {
                        viral_times_entry_author();
                    }

                    if ($viral_times_blog_comment) {
                        echo viral_times_comment_link();
                    }
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>

            <div class="entry-content">
                <?php
                echo wp_trim_words(strip_shortcodes(get_the_content()), 30);
                ?>
            </div><!-- .entry-content -->

            <div class="entry-readmore">
                <a href="<?php the_permalink(); ?>"><?php echo $viral_times_archive_readmore; ?></a>
            </div>
        </div>
    </div>
</article><!-- #post-## -->

<?php
if ($total_post_count != 1 && $total_post_count == ($current_post_count + 1)) {
    echo '</div>';
}