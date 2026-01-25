<?php

/**
 * @package Viral Times
 */
function viral_times_frontpage_leftnews_section() {
    $disable_section = get_theme_mod('viral_times_frontpage_leftnews_section_disable', 'off');
    $sticky_sidebar = get_theme_mod('viral_times_frontpage_leftnews_sticky_sidebar', true);
    $overwrite = get_theme_mod('viral_times_leftnews_overwrite_block_title_color', false);
    $class = array();
    $class[] = $sticky_sidebar ? 'ht-enable-sticky-sidebar' : '';
    $class[] = $overwrite ? 'ht-overwrite-color' : '';

    if ($disable_section == 'on') {
        return;
    }
    ?>
    <section id="ht-leftnews-section" class="ht-section ht-leftnews-section <?php echo esc_attr(implode(' ', $class)); ?>">
        <div class="ht-section-wrap">
            <div class="ht-container ht-leftnews-container ht-clearfix">
                <?php viral_times_frontpage_leftnews_content(); ?>
            </div>
        </div>
    </section>
    <?php
}

function viral_times_frontpage_leftnews_content() {
    ?>
    <div class="primary">
        <?php

        $leftnews_blocks = get_theme_mod('viral_times_frontpage_leftnews_blocks', json_encode(array(
            array(
                'title' => esc_html__('Title', 'viral-times'),
                'category' => '',
                'layout' => 'style1',
                'display_cat' => 'yes',
                'display_author' => 'yes',
                'display_date' => 'yes',
                'enable' => 'on'
            )
        )));

        if ($leftnews_blocks) {
            $leftnews_blocks = json_decode($leftnews_blocks);
            foreach ($leftnews_blocks as $leftnews_block) {
                if ($leftnews_block->enable == 'on') {
                    $args = array(
                        'cat' => $leftnews_block->category,
                        'layout' => $leftnews_block->layout,
                        'display_cat' => $leftnews_block->display_cat,
                        'display_author' => $leftnews_block->display_author,
                        'display_date' => $leftnews_block->display_date,
                        'title' => $leftnews_block->title
                    );

                    do_action('viral_times_leftnews_section', $args);
                }
            }
        }

        ?>
    </div>

    <div class="secondary widget-area">
        <div class="theiaStickySidebar">
            <?php dynamic_sidebar('viral-times-frontpage-right-sidebar') ?>
        </div>
    </div>
    <?php
}
