<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Viral Times
 */
if (!function_exists('viral_times_posted_on')) {

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_times_posted_on() {

        $single_author = get_theme_mod('viral_times_single_author', true);
        $single_date = get_theme_mod('viral_times_single_date', true);
        $single_comment_count = get_theme_mod('viral_times_single_comment_count', true);
        $single_reading_time = get_theme_mod('viral_times_single_reading_time', true);
        $is_updated_date = get_theme_mod('viral_times_display_date_option', 'posted') == 'updated' ? true : false;

        if ($single_author) {
            $avatar = get_avatar(get_the_author_meta('ID'), 32);
            $author = $avatar . '<span class="author vcard">' . esc_html(get_the_author()) . '</span>';

            echo '<span class="entry-author"> ' . $author . '</span>';
        }

        if ($single_date) {
            $ago_format = get_theme_mod('viral_times_display_time_ago', false);

            $get_the_modified_date = get_the_modified_date();
            $get_the_date = $is_updated_date ? $get_the_modified_date : get_the_date();

            if ($ago_format) {
                $get_the_modified_date = sprintf(_x('%s ago', '%s = human-readable time difference', 'viral-times'), human_time_diff(get_the_modified_date('U'), current_time('timestamp')));
                $get_the_date = $is_updated_date ? $get_the_modified_date : sprintf(_x('%s ago', '%s = human-readable time difference', 'viral-times'), human_time_diff(get_the_time('U'), current_time('timestamp')));
            }

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

            if ((get_the_time('U') !== get_the_modified_time('U') && !$is_updated_date)) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf(
                $time_string, esc_attr(($is_updated_date ? get_the_modified_date(DATE_W3C) : get_the_date(DATE_W3C))), esc_html($get_the_date), esc_attr(get_the_modified_date(DATE_W3C)), esc_html($get_the_modified_date)
            );

            echo '<span class="entry-post-date"><i class="mdi mdi-clock-time-four-outline"></i>' . $time_string . '</span>';
        }

        if ($single_comment_count) {
            $comment_count = get_comments_number(); // get_comments_number returns only a numeric value

            if (comments_open()) {
                if ($comment_count == 0) {
                    $comments = esc_html__('0 Comments', 'viral-times');
                } elseif ($comment_count > 1) {
                    $comments = $comment_count . esc_html__(' Comments', 'viral-times');
                } else {
                    $comments = esc_html__('1 Comment', 'viral-times');
                }
                $comment_link = $comments;
            } else {
                $comment_link = "";
            }

            echo '<span class="entry-comment"><i class="mdi mdi-comment-outline"></i>' . $comment_link . '</span>';
        }

        if ($single_reading_time) {
            echo '<span class="entry-read-time"><i class="mdi mdi-book-open"></i>' . viral_times_calculate_reading_time() . '</span>';
        }
    }

}

if (!function_exists('viral_times_post_author')) {

    function viral_times_post_author() {
        echo '<span class="vl-posted-by" ' . viral_times_get_schema_attribute('author_name') . '><i class="mdi mdi-account"></i>' . esc_html(get_the_author()) . '</span>';
    }

}


if (!function_exists('viral_times_post_date')) {

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_times_post_date() {
        $is_updated_date = get_theme_mod('viral_times_display_date_option', 'posted') == 'updated' ? true : false;
        $ago_format = get_theme_mod('viral_times_display_time_ago', false);
        $time_string = $is_updated_date ? get_the_modified_date() : get_the_date();

        if ($ago_format) {
            $time_string = sprintf(_x('%s ago', '%s = human-readable time difference', 'viral-times'), human_time_diff(($is_updated_date ? get_the_modified_time('U') : get_the_time('U')), current_time('timestamp')));
        }

        echo '<span class="vl-posted-on" ' . viral_times_get_schema_attribute('publish_date') . '><i class="mdi mdi-clock-time-four-outline"></i>' . $time_string . '</span>'; // WPCS: XSS OK.
    }

}

if (!function_exists('viral_times_post_primary_category')) {

    function viral_times_post_primary_category($class = "vl-primary-cat-block") {
        $post_categories = viral_times_get_post_primary_category(get_the_ID());

        if (!empty($post_categories)) {
            $category_obj = $post_categories['primary_category'];
            $category_link = get_category_link($category_obj->term_id);
            echo '<div class="' . esc_attr($class) . '">';
            echo '<a class="vl-primary-cat vl-category-' . esc_attr($category_obj->term_id) . '" href="' . esc_url($category_link) . '">' . esc_html($category_obj->name) . '</a>';
            echo '</div>';
        }
    }

}

if (!function_exists('viral_times_get_the_category_list')) {

    function viral_times_get_the_category_list() {
        $post_categories = viral_times_get_post_primary_category(get_the_ID(), 'category', true);

        if (!empty($post_categories)) {
            echo '<ul class="vl-post-categories">';
            $category_ids = $post_categories['all_categories'];
            foreach ($category_ids as $category_id) {
                echo '<li><a class="vl-category vl-category-' . esc_attr($category_id) . '" href="' . esc_url(get_category_link($category_id)) . '">' . esc_html(get_cat_name($category_id)) . '</a></li>';
            }
            echo '</ul>';
        }
    }

}

if (!function_exists('viral_times_get_post_primary_category')) {

    function viral_times_get_post_primary_category($post_id, $term = 'category', $return_all_categories = false) {
        $return = array();

        if (class_exists('WPSEO_Primary_Term')) {
            // Show Primary category by Yoast if it is enabled & set
            $wpseo_primary_term = new WPSEO_Primary_Term($term, $post_id);
            $primary_term = get_term($wpseo_primary_term->get_primary_term());

            if (!is_wp_error($primary_term)) {
                $return['primary_category'] = $primary_term;
            }
        }

        if (empty($return['primary_category']) || $return_all_categories) {
            $categories_list = get_the_terms($post_id, $term);

            if (empty($return['primary_category']) && !empty($categories_list)) {
                $return['primary_category'] = $categories_list[0];  //get the first category
            }

            if ($return_all_categories) {
                $return['all_categories'] = array();

                if (!empty($categories_list)) {
                    foreach ($categories_list as &$category) {
                        $return['all_categories'][] = $category->term_id;
                    }
                }
            }
        }

        return $return;
    }

}

if (!function_exists('viral_times_get_all_image_sizes')) {

    function viral_times_get_all_image_sizes() {
        global $_wp_additional_image_sizes;

        $sizes = array();

        foreach (get_intermediate_image_sizes() as $_size) {
            if (in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
                $sizes[$_size]['width'] = get_option("{$_size}_size_w");
                $sizes[$_size]['height'] = get_option("{$_size}_size_h");
                $sizes[$_size]['crop'] = (bool) get_option("{$_size}_crop");
            } elseif (isset($_wp_additional_image_sizes[$_size])) {
                $sizes[$_size] = array(
                    'width' => $_wp_additional_image_sizes[$_size]['width'],
                    'height' => $_wp_additional_image_sizes[$_size]['height'],
                    'crop' => $_wp_additional_image_sizes[$_size]['crop'],
                );
            }
        }

        return $sizes;
    }

}

if (!function_exists('viral_times_post_featured_image')) {

    function viral_times_post_featured_image($image_size = 'full', $default_lazy_load = true) {

        $placeholder_image = get_theme_mod('viral_times_placeholder_image');
        $lazy_load = get_theme_mod('viral_times_lazy_load', false);
        $get_all_image_sizes = viral_times_get_all_image_sizes();

        if ($image_size == 'full') {
            $image_url = get_template_directory_uri() . '/images/placeholder.jpg';
        } elseif ($image_size == 'large') {
            $image_url = get_template_directory_uri() . '/images/placeholder-1300x540.jpg';
        } elseif ($image_size == 'medium') {
            $image_url = get_template_directory_uri() . '/images/placeholder-500x500.jpg';
        } elseif ($image_size == 'thumbnail') {
            $image_url = get_template_directory_uri() . '/images/placeholder-150x150.jpg';
        } else {
            if (in_array($image_size, $get_all_image_sizes)) {
                $image_width = $get_all_image_sizes[$image_size]['width'];
                $image_height = $get_all_image_sizes[$image_size]['height'];
                $image_url = get_template_directory_uri() . '/images/placeholder-' . $image_width . 'x' . $image_height . '.jpg';
            }
        }

        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
            $image_url = $image[0];
        } else {
            if ($placeholder_image) {
                $placeholder_image_id = attachment_url_to_postid($placeholder_image);
                $image = wp_get_attachment_image_src($placeholder_image_id, $image_size);
                $image_url = $image[0];
            }
        }

        if ($default_lazy_load && $lazy_load && !is_customize_preview() && !viral_times_is_amp()) {
            echo '<img class="vl-lazy" alt="' . esc_attr(get_the_title()) . '" src="' . esc_url(get_template_directory_uri()) . '/images/empty-image.png" data-src="' . esc_url($image_url) . '"/>';
        } else {
            echo '<img alt="' . esc_attr(get_the_title()) . '" src="' . esc_url($image_url) . '"/>';
        }
    }

}

/* Single Page Content Functions */

if (!function_exists('viral_times_single_featured_image')) {

    function viral_times_single_featured_image() {
        if (has_post_thumbnail()) {
            ?>
            <figure class="single-entry-figure">
                <?php
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-times-840x420');
                ?>
                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
            </figure>
            <?php
        }
    }

}

if (!function_exists('viral_times_single_post_meta')) {

    function viral_times_single_post_meta() {
        $single_author = get_theme_mod('viral_times_single_author', true);
        $single_date = get_theme_mod('viral_times_single_date', true);
        $single_comment_count = get_theme_mod('viral_times_single_comment_count', true);
        $single_reading_time = get_theme_mod('viral_times_single_reading_time', true);

        if ('post' === get_post_type() && ($single_author || $single_date || $single_comment_count || $single_reading_time)) {
            ?>
            <div class="single-entry-meta">
                <?php viral_times_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
        }
    }

}


if (!function_exists('viral_times_single_category')) {

    function viral_times_single_category() {
        $single_categories = get_theme_mod('viral_times_single_categories', true);

        if ($single_categories && 'post' === get_post_type()) {
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo '<div class="single-entry-category">';
                echo $categories_list;
                echo '</div>';
            }
        }
    }

}

if (!function_exists('viral_times_single_tag')) {

    function viral_times_single_tag() {
        $single_tags = get_theme_mod('viral_times_single_tags', true);

        if ($single_tags && 'post' === get_post_type()) {
            $tags_list = get_the_tag_list('', '');
            if ($tags_list) {
                echo '<div class="single-entry-tags">';
                echo $tags_list;
                echo '</div>';
            }
        }
    }

}


if (!function_exists('viral_times_single_pagination')) {

    function viral_times_single_pagination() {
        $single_prev_next_post = get_theme_mod('viral_times_single_prev_next_post', true);

        if ($single_prev_next_post) {
            ?>
            <nav class="navigation post-navigation" role="navigation">
                <div class="nav-links">
                    <div class="nav-previous ht-clearfix">
                        <?php
                        if ($prev_post = get_previous_post()) {
                            $prev_post_thumb = get_the_post_thumbnail($prev_post->ID, 'viral-times-150x150');
                            previous_post_link('%link', $prev_post_thumb . '<span>' . esc_html__('Previous Post', 'viral-times') . '</span>%title');
                        }
                        ?>
                    </div>

                    <div class="nav-next ht-clearfix">
                        <?php
                        if ($next_post = get_next_post()) {
                            $next_post_thumb = get_the_post_thumbnail($next_post->ID, 'viral-times-150x150');
                            next_post_link('%link', $next_post_thumb . '<span>' . esc_html__('Next Post', 'viral-times') . '</span>%title');
                        }
                        ?>
                    </div>
                </div>
            </nav>
            <?php
        }
    }

}

if (!function_exists('viral_times_single_comment')) {

    function viral_times_single_comment() {
        $single_comments = get_theme_mod('viral_times_single_comments', true);
        // If comments are open or we have at least one comment, load up the comment template.
        if ($single_comments && (comments_open() || get_comments_number())):
            comments_template();
        endif;
    }

}

if (!function_exists('viral_times_entry_author')) {

    function viral_times_entry_author() {
        $author = '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"><i class="mdi mdi-account"></i>' . esc_html(get_the_author()) . '</a></span>';
        echo '<span class="entry-author">' . $author . '</span>';
    }

}

if (!function_exists('viral_times_entry_date')) {

    function viral_times_entry_date() {
        $is_updated_date = get_theme_mod('viral_times_blog_display_date_option', 'posted') == 'updated' ? true : false;
        $post_date = '<a href="' . esc_url(get_permalink()) . '"><i class="mdi mdi-clock-time-four-outline"></i>' . ($is_updated_date ? get_the_modified_date() : get_the_date()) . '</a>';
        echo '<span class="entry-date">' . $post_date . '</span>';
    }

}

if (!function_exists('viral_times_entry_category')) {

    function viral_times_entry_category() {
        $categories_list = get_the_category_list(', ');
        if ($categories_list) {
            echo '<span class="entry-categories">';
            echo '<i class="mdi mdi-folder"></i>' . $categories_list;
            echo '</span>';
        }
    }

}

if (!function_exists('viral_times_entry_tag')) {

    function viral_times_entry_tag() {
        $tags_list = get_the_tag_list('<i class="mdi mdi-bookmark"></i>', ', ');
        if ($tags_list) {
            echo '<span class="entry-tags">';
            echo $tags_list;
            echo '</span>';
        }
    }

}

if (!function_exists('viral_times_comment_link')) {

    function viral_times_comment_link() {
        $comment_count = get_comments_number(); // get_comments_number returns only a numeric value
        $comment_link = "";

        if (comments_open()) {
            if ($comment_count == 0) {
                $comments = esc_html__('0 Comments', 'viral-times');
            } elseif ($comment_count > 1) {
                $comments = $comment_count . esc_html__(' Comments', 'viral-times');
            } else {
                $comments = esc_html__('1 Comment', 'viral-times');
            }
            $comment_link .= '<span class="entry-comment">';
            $comment_link .= '<a class="comment-link" href="' . get_comments_link() . '"><i class="mdi mdi-comment"></i>' . $comments . '</a>';
            $comment_link .= '</span>';
        }

        return $comment_link;
    }

}


if (!function_exists('viral_times_get_comment_author_link')) {

    function viral_times_get_comment_author_link() {
        global $comment;
        if ($comment->user_id == '0') {
            $url = '#';
        } else {
            $url = get_author_posts_url($comment->user_id);
        }

        return "<a href=\"" . esc_url($url) . "\">" . get_comment_author() . "</a>";
    }

}