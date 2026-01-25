<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Viral Times
 */

if (has_post_thumbnail()) {
    ?>
    <figure class="entry-figure">
        <?php
        $viral_times_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-times-840x420');
        ?>
        <img src="<?php echo esc_url($viral_times_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
    </figure>
<?php }
?>

<div class="entry-content">
    <?php the_content(); ?>
    <?php
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral-times'),
        'after' => '</div>',
    ));
    ?>
</div><!-- .entry-content -->