<?php

/**
 * @package Viral Times
 */
function viral_times_frontpage_mininews_section() {
    $disable_section = get_theme_mod('viral_times_frontpage_mininews_section_disable', 'off');
    $overwrite = get_theme_mod('viral_times_mininews_overwrite_block_title_color', false);
    $class = $overwrite ? 'ht-overwrite-color' : '';

    if ($disable_section == 'on') {
        return;
    }
    ?>
    <section id="ht-mininews-section" class="ht-section ht-mininews-section <?php echo esc_attr($class); ?>">
        <div class="ht-section-wrap">
            <div class="ht-container ht-mininews-container">
                <?php viral_times_frontpage_mininews_content(); ?>
            </div>
        </div>
    </section>
    <?php
}

function viral_times_frontpage_mininews_content() {

    $cats = get_theme_mod('viral_times_mininews_cat');
    $display_cat = get_theme_mod('viral_times_mininews_display_cat', true);
    $display_author = get_theme_mod('viral_times_mininews_display_author', true);
    $display_date = get_theme_mod('viral_times_mininews_display_date', true);
    $post_count_big = get_theme_mod('viral_times_mininews_post_count_big', '5');
    $post_count = get_theme_mod('viral_times_mininews_post_count', '3');
    $fullwidth = get_theme_mod('viral_times_mininews_fullwidth', false);
    $layout = get_theme_mod('viral_times_mininews_style', 'style1');
    $class = $fullwidth ? 'ht-fullwidth-container' : 'ht-non-fullwidth-container';
    $image_size = get_theme_mod('viral_times_mininews_image_size', 'viral-times-150x150');
    $post_per_page = $fullwidth ? $post_count_big : $post_count;

    $args = array(
        'cat' => $cats,
        'posts_per_page' => $post_per_page,
        'ignore_sticky_posts' => true
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        ?>
        <div class="<?php echo esc_attr($class); ?>">
            <div class="vl-mininews-block <?php echo esc_attr($layout); ?>" data-count="<?php echo $post_count; ?>">
                <?php
                $i = 0;
                while ($query->have_posts()):
                    $query->the_post();
                    $i++;
                    $item_class = ($post_count < $i) ? ' vl-post-hide' : '';
                    ?>
                    <div class="vl-post-item ht-clearfix<?php echo esc_attr($item_class); ?>">
                        <div class="vl-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                viral_times_post_featured_image($image_size, false);
                                ?>
                            </a>
                        </div>

                        <div class="vl-post-content">
                            <?php
                            if ($display_cat) {
                                echo viral_times_post_primary_category();
                            }
                            ?>
                            <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            if ($display_author || $display_date) {
                                echo '<div class="vl-post-metas">';
                                if ($display_author) {
                                    echo viral_times_post_author();
                                }

                                if ($display_date) {
                                    echo viral_times_post_date();
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}
