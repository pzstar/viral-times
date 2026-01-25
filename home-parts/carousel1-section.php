<?php

/**
 * @package Viral Times
 */
function viral_times_frontpage_carousel1_section() {
    $disable_section = get_theme_mod('viral_times_frontpage_carousel1_section_disable', 'off');
    $overwrite = get_theme_mod('viral_times_carousel1_overwrite_block_title_color', false);
    $class = $overwrite ? 'ht-overwrite-color' : '';

    if ($disable_section == 'on') {
        return;
    }
    ?>
    <section id="ht-carousel1-section" class="ht-section ht-carousel1-section <?php echo esc_attr($class); ?>">
        <div class="ht-section-wrap">
            <div class="ht-container ht-carousel1-container">
                <?php viral_times_frontpage_carousel1_content(); ?>
            </div>
        </div>
    </section>
    <?php
}

function viral_times_frontpage_carousel1_content() {

    $carousel1_blocks = get_theme_mod('viral_times_frontpage_carousel1_blocks', json_encode(array(
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
    )));

    if ($carousel1_blocks) {
        $carousel1_blocks = json_decode($carousel1_blocks);
        foreach ($carousel1_blocks as $carousel1_block) {
            if ($carousel1_block->enable == 'on') {
                $title = $carousel1_block->title;
                $category = $carousel1_block->category;
                $layout = $carousel1_block->layout;
                $display_cat = $carousel1_block->display_cat;
                $display_author = $carousel1_block->display_author;
                $display_date = $carousel1_block->display_date;
                $post_count = $carousel1_block->post_count;
                $slide_count = $carousel1_block->slide_count;
                $slide_pause = $carousel1_block->slide_pause;
                $auto_slide = $carousel1_block->auto_slide;
                $image_size = $carousel1_block->image_size;
                $title_size = $carousel1_block->title_size;
                $gap = $carousel1_block->gap;

                $args = array(
                    'title' => $title,
                    'cat' => $category,
                    'layout' => $layout,
                    'display_cat' => $display_cat,
                    'display_author' => $display_author,
                    'display_date' => $display_date,
                    'post_count' => $post_count,
                    'slide_count' => $slide_count,
                    'slide_pause' => $slide_pause,
                    'auto_slide' => $auto_slide,
                    'image_size' => $image_size,
                    'title_size' => $title_size,
                    'gap' => $gap,
                );

                do_action('viral_times_carousel1_section', $args);
            }
        }
    }

}
