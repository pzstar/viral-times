<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Viral Times
 */
if (!function_exists('viral_times_excerpt')) {

    function viral_times_excerpt($content, $letter_count) {
        $new_content = strip_shortcodes($content);
        $new_content = wp_strip_all_tags($new_content);
        $content = mb_substr($new_content, 0, $letter_count);

        if (($letter_count !== 0) && (strlen($new_content) > $letter_count)) {
            $content .= "...";
        }
        return $content;
    }

}

function viral_times_comment($comment, $args, $depth) {
    extract($args, EXTR_SKIP);
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    $show_avatars = get_option('show_avatars');
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'parent' : '', $comment); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <?php if (0 != $args['avatar_size'] && $show_avatars) { ?>
                <div class="sp-comment-avatar">
                    <?php echo get_avatar($comment, $args['avatar_size']); ?>
                </div>
            <?php } ?>

            <div class="sp-comment-content">
                <div class="comment-header">
                    <div class="comment-author vcard">
                        <?php
                        echo sprintf('<b class="fn">%s</b>', viral_times_get_comment_author_link());
                        echo " - ";
                        ?>
                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                /* translators: 1: comment date, 2: comment time */
                                printf(__('%1$s', 'viral-times'), get_comment_date('', $comment));
                                ?>
                            </time>
                        </a>
                    </div>

                    <?php
                    comment_reply_link(array_merge($args, array(
                        'add_below' => 'div-comment',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'],
                        'before' => '<div class="reply">',
                        'after' => '</div>'
                    )));
                    ?>

                    <!-- .comment-author -->

                    <?php if ('0' == $comment->comment_approved): ?>
                        <p class="comment-awaiting-moderation">
                            <?php _e('Your comment is awaiting moderation.', 'viral-times'); ?>
                        </p>
                    <?php endif; ?>

                </div>
                <!-- .comment-meta -->

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>
                <!-- .comment-content -->
                <?php edit_comment_link(__('Edit', 'viral-times'), '<div class="edit-link">', '</div>'); ?>
            </div>
            <!-- .comment-metadata -->
        </article>
        <!-- .comment-body -->
        <?php
}

/* Convert hexdec color string to rgb(a) string */

function viral_times_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

function viral_times_color_brightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

function viral_times_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

function viral_times_get_customizer_fonts() {
    $fonts = array(
        'body' => array(
            'font_family' => 'Roboto',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '15',
            'line_height' => '1.6',
            'color' => '#333333',
            'letter_spacing' => '0'
        ),
        'menu' => array(
            'font_family' => 'Default',
            'font_style' => '400',
            'text_transform' => 'uppercase',
            'text_decoration' => 'none',
            'font_size' => '14',
            'line_height' => '3',
            'letter_spacing' => '0'
        ),
        'page_title' => array(
            'font_family' => 'Default',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '40',
            'line_height' => '1.3',
            'color' => '#333333',
            'letter_spacing' => '0'
        ),
        'frontpage_title' => array(
            'font_family' => 'Default',
            'font_style' => '500',
            'text_transform' => 'capitalize',
            'text_decoration' => 'none',
            'font_size' => '16',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        ),
        'frontpage_block_title' => array(
            'font_family' => 'Default',
            'font_style' => '700',
            'text_transform' => 'uppercase',
            'text_decoration' => 'none',
            'font_size' => '20',
            'line_height' => '1.1',
            'letter_spacing' => '0'
        ),
    );

    $fonts['h'] = array(
        'font_family' => 'Roboto',
        'font_style' => '400',
        'text_transform' => 'none',
        'text_decoration' => 'none',
        'line_height' => '1.3',
        'letter_spacing' => '0'
    );

    return $fonts;
}

if (!function_exists('viral_times_is_woocommerce_activated')) {

    function viral_times_is_woocommerce_activated() {
        if (class_exists('woocommerce')) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('attachment_url_to_postid')) {

    function attachment_url_to_postid($attachment_src) {
        global $wpdb;
        $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$attachment_src'";
        $id = $wpdb->get_var($query);
        return $id;
    }

}

function viral_times_get_image_sizes() {

    foreach (get_intermediate_image_sizes() as $_size) {
        if (in_array($_size, array('thumbnail', 'medium', 'large'))) {
            $default_sizes[$_size] = 'Image Size - ' . get_option("{$_size}_size_w") . 'x' . get_option("{$_size}_size_h") . ' (' . ucfirst($_size) . ')';
        }
    }

    $sizes = array(
        'full' => esc_html__('Full Size', 'viral-times'),
        'viral-times-1300x540' => esc_html__('Image Size - 1300x540', 'viral-times'),
        'viral-times-800x500' => esc_html__('Image Size - 800x500', 'viral-times'),
        'viral-times-700x700' => esc_html__('Image Size - 700x700', 'viral-times'),
        'viral-times-650x500' => esc_html__('Image Size - 650x500', 'viral-times'),
        'viral-times-500x500' => esc_html__('Image Size - 500x500', 'viral-times'),
        'viral-times-500x600' => esc_html__('Image Size - 500x600', 'viral-times'),
        'viral-times-360x240' => esc_html__('Image Size - 360x240', 'viral-times'),
        'viral-times-150x150' => esc_html__('Image Size - 150x150', 'viral-times')
    );

    $all_sizes = array_merge($sizes, $default_sizes);

    return $all_sizes;
}

function viral_times_get_default_widgets() {
    return array('viral-times-right-sidebar', 'viral-times-left-sidebar', 'viral-times-shop-right-sidebar', 'viral-times-shop-left-sidebar', 'viral-times-header-widget', 'viral-times-offcanvas-sidebar', 'viral-times-top-footer', 'viral-times-footer1', 'viral-times-footer2', 'viral-times-footer3', 'viral-times-footer4', 'viral-times-footer5', 'viral-times-footer6', 'viral-times-bottom-footer', 'viral-times-below-menu', 'viral-times-single-post-before-article', 'viral-times-single-post-after-article');
}

if (!function_exists('viral_times_youtube_duration')) {

    function viral_times_youtube_duration($duration) {
        preg_match_all('/(\d+)/', $duration, $parts);

        //Put in zeros if we have less than 3 numbers.
        if (count($parts[0]) == 1) {
            array_unshift($parts[0], "0", "0");
        } elseif (count($parts[0]) == 2) {
            array_unshift($parts[0], "0");
        }

        $sec_init = $parts[0][2];
        $seconds = $sec_init % 60;
        $seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);
        $seconds_overflow = floor($sec_init / 60);

        $min_init = $parts[0][1] + $seconds_overflow;
        $minutes = ($min_init) % 60;
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        $minutes_overflow = floor(($min_init) / 60);

        $hours = $parts[0][0] + $minutes_overflow;

        if ($hours != 0) {
            return $hours . ':' . $minutes . ':' . $seconds;
        } else {
            return $minutes . ':' . $seconds;
        }
    }

}


function viral_times_check_active_footer() {
    $footer_col = get_theme_mod('viral_times_footer_col', 'col-3-1-1-1');
    $footer_array = explode('-', $footer_col);
    $count = count($footer_array);
    $footer_col = $count - 2;
    $status = false;

    for ($i = 1; $i <= $footer_col; $i++) {
        if (is_active_sidebar('viral-times-footer' . $i)) {
            $status = true;
        }
    }

    return $status;
}


if (!function_exists('viral_times_calculate_reading_time')) {

    function viral_times_calculate_reading_time() {
        $wpm = apply_filters('viral_times_filter_wpm', 250);
        $include_shortcodes = true;
        $exclude_images = false;

        $tmpContent = get_post_field('post_content', get_the_ID());
        $number_of_images = substr_count(strtolower($tmpContent), '<img ');
        if (!$include_shortcodes) {
            $tmpContent = strip_shortcodes($tmpContent);
        }
        $tmpContent = wp_strip_all_tags($tmpContent);
        $wordCount = str_word_count($tmpContent);

        if (!$exclude_images) {
            $additional_words_for_images = viral_times_calculate_images($number_of_images, $wpm);
            $wordCount += $additional_words_for_images;
        }

        $readingTime = ceil($wordCount / $wpm);

        // If the reading time is 0 then return it as < 1 instead of 0.
        if ($readingTime < 1) {
            $readingTime = esc_html__('< 1 Min Read', 'viral-times');
        } elseif ($readingTime == 1) {
            $readingTime = esc_html__('1 Min Read', 'viral-times');
        } else {
            $readingTime = $readingTime . ' ' . esc_html__('Mins Read', 'viral-times');
        }

        return $readingTime;
    }

}

if (!function_exists('viral_times_calculate_images')) {

    function viral_times_calculate_images($total_images, $wpm) {
        $additional_time = 0;
        // For the first image add 12 seconds, second image add 11, ..., for image 10+ add 3 seconds
        for ($i = 1; $i <= $total_images; $i++) {
            if ($i >= 10) {
                $additional_time += 3 * (int) $wpm / 60;
            } else {
                $additional_time += (12 - ($i - 1)) * (int) $wpm / 60;
            }
        }

        return $additional_time;
    }

}

if (!function_exists('viral_times_get_schema_attribute')) {

    function viral_times_get_schema_attribute($place) {
        $schema_markup = get_theme_mod('viral_times_schema_markup', false);
        if (!$schema_markup) {
            return '';
        }
        $attrs = "";
        switch ($place) {
            case 'single':
                $itemscope = 'itemscope';
                $itemtype = 'WebPage';
                break;
            case 'article':
                $itemscope = 'itemscope';
                $itemtype = 'Article';
                break;
            case 'blog':
                $itemscope = 'itemscope';
                $itemtype = 'Blog';
                break;
            case 'header':
                $itemscope = '';
                $itemtype = 'WPHeader';
                break;
            case 'logo':
                $itemscope = 'itemscope';
                $itemtype = 'Organization';
                break;
            case 'navigation':
                $itemscope = '';
                $itemtype = 'SiteNavigationElement';
                break;
            case 'breadcrumb':
                $itemscope = '';
                $itemtype = 'BreadcrumbList';
                break;
            case 'sidebar':
                $itemscope = 'itemscope';
                $itemtype = 'WPSideBar';
                break;
            case 'footer':
                $itemscope = 'itemscope';
                $itemtype = 'WPFooter';
                break;
            case 'author':
                $itemprop = 'author';
                $itemscope = '';
                $itemtype = 'Person';
                break;
            case 'breadcrumb_list':
                $itemscope = '';
                $itemtype = 'BreadcrumbList';
                break;
            case 'breadcrumb_item':
                $itemscope = '';
                $itemprop = 'itemListElement';
                $itemtype = 'ListItem';
                break;
            case 'author_name':
                $itemprop = 'name';
                break;
            case 'author_link':
                $itemprop = 'author';
                break;
            case 'author_url':
                $itemprop = 'url';
                break;
            case 'publish_date':
                $itemprop = 'datePublished';
                break;
            case 'modified_date':
                $itemprop = 'dateModified';
                break;
            default:
        }
        if (isset($itemprop)) {
            $attrs .= ' itemprop="' . $itemprop . '"';
        }
        if (isset($itemtype)) {
            $attrs .= ' itemtype="https://schema.org/' . $itemtype . '"';
        }
        if (isset($itemscope)) {
            $attrs .= ' itemscope="' . $itemscope . '"';
        }
        return apply_filters('viral_times_schema_' . $place . '_attributes', $attrs); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

}
