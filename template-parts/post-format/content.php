<?php
$viral_times_image_size = 'viral-times-800x500';

$viral_times_sidebar_layout = get_theme_mod('viral_times_post_layout', 'right-sidebar');
$viral_times_post_layout = get_theme_mod('viral_times_single_layout', 'layout7');

if ($viral_times_sidebar_layout == 'no-sidebar' || $viral_times_sidebar_layout == 'no-sidebar-narrow' || $viral_times_post_layout == 'layout7') {
    $viral_times_image_size = 'viral-times-1300x540';
}

if (has_post_thumbnail() && ($viral_times_post_layout !== 'layout3' && $viral_times_post_layout !== 'layout4' && $viral_times_post_layout !== 'layout5' && $viral_times_post_layout !== 'layout6')) {
    ?>
    <figure class="single-entry-link">
        <?php echo get_the_post_thumbnail(get_the_ID(), $viral_times_image_size); ?>
    </figure>
    <?php
}