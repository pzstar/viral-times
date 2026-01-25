<?php
/**
 *
 * @package Viral Times
 */

require_once get_template_directory() . '/inc/widgets/widget-fields.php';

$active_widgets = array('widget-category', 'widget-contact-info', 'widget-post-carousel-category', 'widget-post-list-category');

if (is_array($active_widgets)) {
    foreach ($active_widgets as $widgets) {
        if (file_exists(get_template_directory() . '/inc/widgets/' . $widgets . '.php')) {
            require_once get_template_directory() . '/inc/widgets/' . $widgets . '.php';
        }
    }
}

if (!class_exists('Viral_Times_Walker_Widget_Category_Checklist')) {

    class Viral_Times_Walker_Widget_Category_Checklist extends Walker {

        var $tree_type = 'category';
        var $db_fields = array(
            'parent' => 'parent',
            'id' => 'term_id'
        );

        function start_lvl(&$output, $depth = 0, $args = []) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent<ul class='ht--checkbox-children'>\n";
        }

        function end_lvl(&$output, $depth = 0, $args = []) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        function start_el(&$output, $category, $depth = 0, $args = [], $id = 0) {
            extract($args);
            if (empty($taxonomy)) {
                $taxonomy = 'category';
            }

            if (!in_array($category->term_id, $hide_terms)) {
                $output .= "\n<li class='ht--checkbox-item ht--{$taxonomy}-{$category->{$value_field} }'>";
                $output .= '<label class="ht--checkbox-label">';
                $output .= '<input value="1" type="checkbox" ' . ($name ? ('name="' . $name . '[' . $category->{$value_field} . ']" ') : '') . checked('1', isset($selected_cats[$category->{$value_field}]), false) . '/>';
                $output .= '<span class="ht--title">';
                $output .= '<span class="ht--term">';
                $output .= isset($term_name_array[$category->term_id]) ? esc_html($term_name_array[$category->term_id]) : esc_html($category->name);
                $output .= '</span>';
                if ($show_count) {
                    $output .= '<span class="ht--count">&nbsp;(';
                    $output .= isset($term_count_array[$category->term_id]) ? esc_html($term_count_array[$category->term_id]) : esc_html($category->count);
                    $output .= ')</span>';
                }
                $output .= '</span>';
                $output .= '</label>';
            }
        }

        function end_el(&$output, $category, $depth = 0, $args = []) {
            extract($args);
            if (!in_array($category->term_id, $hide_terms)) {
                $output .= "</li>\n";
            }
        }

    }

}

if (!function_exists('viral_times_widgets_terms_checklist')) {

    function viral_times_widgets_terms_checklist($post_id = 0, $args = array(), $terms = NULL) {
        $defaults = array(
            'selected_cats' => false,
            'walker' => null,
            'taxonomy' => 'category',
            'hide_terms' => [],
            'checked_ontop' => false,
            'name' => '',
            'show_count' => true
        );

        extract(wp_parse_args($args, $defaults), EXTR_SKIP);

        if (empty($walker) || !is_a($walker, 'Walker')) {
            $walker = new Viral_Times_Walker_Widget_Category_Checklist;
        }

        $args = array(
            'taxonomy' => $taxonomy,
            'name' => $name,
            'value_field' => empty($value_field) ? 'term_id' : $value_field,
            'show_count' => $show_count,
            'hide_terms' => isset($hide_terms) ? $hide_terms : [],
            'term_name_array' => isset($term_name_array) ? $term_name_array : [],
            'term_count_array' => isset($term_count_array) ? $term_count_array : []
        );

        $tax = get_taxonomy($taxonomy);
        if ($tax) {
            $args['disabled'] = !current_user_can($tax->cap->assign_terms);

            if (is_array($selected_cats)) {
                $args['selected_cats'] = $selected_cats;
            } elseif ($post_id) {
                $args['selected_cats'] = wp_get_object_terms($post_id, $taxonomy, array_merge($args, array('fields' => 'ids')));
            } else {
                $args['selected_cats'] = array();
            }

            $categories = $terms ? $terms : (array) get_terms($taxonomy, array('get' => 'all'));

            if ($checked_ontop) {
                // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
                $checked_categories = array();
                $keys = array_keys($categories);

                foreach ($keys as $k) {
                    if (in_array($categories[$k]->term_id, $args['selected_cats'])) {
                        $checked_categories[] = $categories[$k];
                        unset($categories[$k]);
                    }
                }

                // Put checked cats on top
                echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
            }
            // Then the rest of them
            echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
        }
    }

}


function viral_times_widgets_terms_list($parent_id, $categories, $cat_ids = [], $child_count = -1) {
    $options = array();
    $loop_categories = array_filter($categories, function ($cats) use ($parent_id) {
        return $cats->parent == $parent_id;
    });

    if (count($loop_categories)) {
        $child_count++;
        $visible_slugs = $cat_ids;

        if ($loop_categories) {
            foreach ($loop_categories as $cat) {
                $cat_name = '';
                $child_options = viral_times_widgets_terms_list($cat->term_id, $categories, $cat_ids, $child_count);

                if (in_array($cat->term_id, $visible_slugs)) {
                    $i = 0;
                    while ($i < $child_count) {
                        $cat_name .= '- ';
                        $i++;
                    }
                    $cat_name .= esc_html(ucwords(str_replace('-', ' ', $cat->name)));
                    $options[$cat->term_id] = $cat_name . ' (' . $cat->count . ')';
                    if (!empty($child_options)) {
                        foreach ($child_options as $key => $val) {
                            $options[$key] = $val;
                        }
                    }
                }

            }
        }
    }
    return $options;
}

function viral_times_category_list() {
    $categories = get_categories(array('hide_empty' => 0));
    $cat = array();
    if ($categories) {
        foreach ($categories as $category) {
            $cat[$category->term_id] = $category->cat_name;
        }
    }

    return $cat;
}

/**
 * Enqueue Style and Script for widgets
 */
function viral_times_admin_scripts() {
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), VIRAL_TIMES_VER);
    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.css', array(), VIRAL_TIMES_VER);
    if (is_rtl()) {
        wp_enqueue_style('viral-times-admin-style', get_template_directory_uri() . '/inc/widgets/css/widget-style.rtl.css', array('wp-color-picker'), VIRAL_TIMES_VER);
    } else {
        wp_enqueue_style('viral-times-admin-style', get_template_directory_uri() . '/inc/widgets/css/widget-style.css', array('wp-color-picker'), VIRAL_TIMES_VER);
    }

    wp_enqueue_media();
    $is_widgets_block_editor = function_exists('wp_use_widgets_block_editor') && wp_use_widgets_block_editor() ? 'true' : 'false';
    wp_enqueue_script('viral-times-widget-script', get_template_directory_uri() . '/inc/widgets/js/widget-script.js', array('jquery', 'wp-color-picker', 'jquery-ui-datepicker'), VIRAL_TIMES_VER, true);
    wp_localize_script('viral-times-widget-script', 'viral_times_widget_options', array(
        'widgets_block_editor' => $is_widgets_block_editor,
    ));
}

add_action('admin_enqueue_scripts', 'viral_times_admin_scripts', 100);

add_action('elementor/editor/before_enqueue_scripts', 'viral_times_admin_scripts');


/* ADD EDITOR TO CUSTOMIZER */

function viral_times_customizer_editor() {
    ?>
    <div id="ht-wp-editor-widget-container" style="display: none;">
        <a class="ht-wp-editor-widget-close" href="#" title="<?php esc_attr_e('Close', 'viral-times'); ?>"><i class="icofont-close-squared-alt"></i></a>
        <div class="editor">
            <?php
            $settings = array('textarea_rows' => 55, 'editor_height' => 260);
            wp_editor('', 'wpeditorwidget', $settings);
            ?>
            <p><a href="#" class="ht-wp-editor-widget-update-close button button-primary"><?php _e('Save and Close', 'viral-times'); ?></a></p>
        </div>
    </div>
    <div id="ht-wp-editor-widget-backdrop" style="display: none;"></div>
    <?php
}

// END output_wp_editor_widget_html*/

add_action('widgets_admin_page', 'viral_times_customizer_editor', 100);
add_action('customize_controls_print_footer_scripts', 'viral_times_customizer_editor');
add_action('elementor/editor/before_enqueue_scripts', 'viral_times_customizer_editor');

//SiteOrigin Builder
if (function_exists('siteorigin_panels_render')) {
    add_action('admin_print_scripts-post.php', 'viral_times_customizer_editor', 100);
    add_action('admin_print_scripts-post-new.php', 'viral_times_customizer_editor', 100);
}

//Beaver Builder
if (class_exists('FLBuilder')) {
    if (isset($_GET['fl_builder'])) {
        add_action('viral_times_after_footer', 'viral_times_customizer_editor', 100);
    }
}

/* Add Filters for the Customizer wp_editor */
add_filter('wp_editor_widget_content', 'wptexturize');
add_filter('wp_editor_widget_content', 'convert_smilies');
add_filter('wp_editor_widget_content', 'convert_chars');
add_filter('wp_editor_widget_content', 'wpautop');
add_filter('wp_editor_widget_content', 'shortcode_unautop');
add_filter('wp_editor_widget_content', 'do_shortcode', 11);
