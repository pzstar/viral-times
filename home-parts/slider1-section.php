<?php

/**
 * @package Viral Times
 */
function viral_times_frontpage_slider1_section() {
    $disable_section = get_theme_mod('viral_times_frontpage_slider1_section_disable', 'off');
    $overwrite = get_theme_mod('viral_times_slider1_overwrite_block_title_color', false);
    $class = $overwrite ? 'ht-overwrite-color' : '';

    if ($disable_section == 'on') {
        return;
    }
    ?>
    <section id="ht-slider1-section" class="ht-section ht-slider1-section <?php echo esc_attr($class); ?>">
        <div class="ht-section-wrap">
            <div class="ht-container ht-slider1-container">
                <?php viral_times_frontpage_slider1_content(); ?>
            </div>
        </div>
    </section>
    <?php
}

function viral_times_frontpage_slider1_content() {

    $slider_blocks = get_theme_mod('viral_times_frontpage_slider1_blocks', json_encode(array(
        array(
            'title' => '',
            'category' => '',
            'layout' => 'style1',
            'display_cat' => 'yes',
            'display_author' => 'yes',
            'display_date' => 'yes',
            'post_count' => 5,
            'enable' => 'on'
        )
    )));

    if ($slider_blocks) {
        $slider_blocks = json_decode($slider_blocks);
        foreach ($slider_blocks as $slider_block) {
            if ($slider_block->enable == 'on') {
                $title = $slider_block->title;
                $category = $slider_block->category;
                $layout = $slider_block->layout;
                $display_cat = $slider_block->display_cat;
                $display_author = $slider_block->display_author;
                $display_date = $slider_block->display_date;
                $post_count = $slider_block->post_count;

                $args = array(
                    'title' => $title,
                    'cat' => $category,
                    'layout' => $layout,
                    'display_cat' => $display_cat,
                    'display_author' => $display_author,
                    'display_date' => $display_date,
                    'post_count' => $post_count
                );

                do_action('viral_times_slider1_section', $args);
            }
        }
    }

}
