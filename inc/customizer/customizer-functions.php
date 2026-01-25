<?php

if (!function_exists('viral_times_widget_list')) {

    function viral_times_widget_list() {
        global $wp_registered_sidebars;
        $exclude = viral_times_get_default_widgets();
        $exclude = array_merge($exclude, array('viral-times-frontpage-right-sidebar', 'viral-times-frontpage-left-sidebar'));
        $widget_list['none'] = esc_html__('-- Choose Widget --', 'viral-times');
        if ($wp_registered_sidebars) {
            foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
                if (!in_array($wp_registered_sidebar['id'], $exclude)) {
                    $widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
                }
            }
        }
        return $widget_list;
    }

}

if (!function_exists('viral_times_cat')) {

    function viral_times_cat() {
        $cat = array();
        $categories = get_categories(array('hide_empty' => 0));
        if ($categories) {
            foreach ($categories as $category) {
                $cat[$category->term_id] = $category->cat_name;
            }
        }
        return $cat;
    }

}

if (!function_exists('viral_times_page_choice')) {

    function viral_times_page_choice() {
        $page_choice = array();
        $pages = get_pages(array('hide_empty' => 0));
        if ($pages) {
            foreach ($pages as $pages_single) {
                $page_choice[$pages_single->ID] = $pages_single->post_title;
            }
        }
        return $page_choice;
    }

}

if (!function_exists('viral_times_menu_choice')) {

    function viral_times_menu_choice() {
        $menu_choice = array('none' => esc_html('-- Choose Menu --', 'viral-times'));
        $menus = get_terms('nav_menu', array('hide_empty' => false));
        if ($menus) {
            foreach ($menus as $menus_single) {
                $menu_choice[$menus_single->slug] = $menus_single->name;
            }
        }
        return $menu_choice;
    }

}

if (!class_exists('Viral_Times_Walker_Category_Checklist')) {

    class Viral_Times_Walker_Category_Checklist extends Walker {

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
                $output .= '<input value="' . $category->{$value_field} . '" type="checkbox" ' . ($name ? ('name="' . $name . '[]" ') : '') . checked(in_array($category->{$value_field}, $selected_cats), true, false) . '/>';
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

if (!function_exists('viral_times_terms_checklist')) {

    function viral_times_terms_checklist($post_id = 0, $args = array(), $terms = NULL) {
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
            $walker = new Viral_Times_Walker_Category_Checklist;
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

if (!function_exists('viral_times_get_dropdown_indent')) {

    function viral_times_get_dropdown_indent($parent_id, $categories, $selected_ids = [], $cat_ids = [], $child_count = -1) {
        $html = '';
        $loop_categories = array_filter($categories, function ($cats) use ($parent_id) {
            return $cats->parent == $parent_id;
        });

        if (count($loop_categories)) {
            $child_count++;
            $visible_slugs = $cat_ids;

            if ($loop_categories) {
                foreach ($loop_categories as $cat) {
                    $current_html = '';
                    if (in_array($cat->term_id, $selected_ids)) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $child_html = viral_times_get_dropdown_indent($cat->term_id, $categories, $selected_ids, $cat_ids, $child_count);

                    if (in_array($cat->term_id, $visible_slugs)) {
                        $current_html .= '<option value="' . esc_attr($cat->term_id) . '" ' . esc_attr($selected) . '>';
                        $i = 0;
                        while ($i < $child_count) {
                            $current_html .= '- ';
                            $i++;
                        }
                        $current_html .= esc_html(ucwords(str_replace('-', ' ', $cat->name)) . ' (' . $cat->count . ')');
                        $current_html .= '</option>';
                        if (strlen($child_html)) {
                            $current_html .= $child_html;
                        }
                    }
                    $html .= $current_html;
                }
            }
        }
        return $html;
    }

}

if (!function_exists('viral_times_icon_choices')) {

    function viral_times_icon_choices() {
        echo '<div id="ht--icon-box" class="ht--icon-box">';
        echo '<div class="ht--icon-search">';
        echo '<select>';

        //See customizer-icon-manager.php file
        $icons = apply_filters('viral_times_register_icon', array());

        if ($icons && is_array($icons)) {
            foreach ($icons as $icon) {
                if ($icon['name'] && $icon['label']) {
                    echo '<option value="' . esc_attr($icon['name']) . '">' . esc_html($icon['label']) . '</option>';
                }
            }
        }

        echo '</select>';
        echo '<input type="text" class="ht--icon-search-input" placeholder="' . esc_html__('Type to filter', 'viral-times') . '" />';
        echo '</div>';

        if ($icons && is_array($icons)) {
            $active_class = ' active';
            foreach ($icons as $icon) {
                $icon_name = isset($icon['name']) && $icon['name'] ? $icon['name'] : '';
                $icon_prefix = isset($icon['prefix']) && $icon['prefix'] ? $icon['prefix'] : '';
                $icon_displayPrefix = isset($icon['displayPrefix']) && $icon['displayPrefix'] ? $icon['displayPrefix'] . ' ' : '';

                echo '<ul class="ht--icon-list ' . esc_attr($icon_name) . esc_attr($active_class) . '">';
                $icon_array = isset($icon['icons']) ? $icon['icons'] : '';
                if (is_array($icon_array)) {
                    foreach ($icon_array as $icon_id) {
                        echo '<li><i class="' . esc_attr($icon_displayPrefix) . esc_attr($icon_prefix) . esc_attr($icon_id) . '"></i></li>';
                    }
                }
                echo '</ul>';
                $active_class = '';
            }
        }

        echo '</div>';
    }

}

add_action('customize_controls_print_footer_scripts', 'viral_times_icon_choices');

function viral_times_order_sections() {
    if (!current_user_can('manage_options')) {
        return;
    }

    check_ajax_referer('viral-times-order-sections', 'secure');

    if (isset($_POST['sections'])) {
        set_theme_mod('viral_times_frontpage_sections', $_POST['sections']);
    }
    wp_die();
}

add_action('wp_ajax_viral_times_order_sections', 'viral_times_order_sections');

function viral_times_frontpage_sections() {
    $defaults = array(
        'viral_times_frontpage_slider1_section',
        'viral_times_frontpage_mininews_section',
        'viral_times_frontpage_leftnews_section',
        'viral_times_frontpage_rightnews_section',
        'viral_times_frontpage_carousel1_section',
    );
    $sections = get_theme_mod('viral_times_frontpage_sections', $defaults);
    return $sections;
}

function viral_times_get_section_position($key) {
    $sections = viral_times_frontpage_sections();
    $position = array_search($key, $sections);
    $return = ($position + 1) * 10;
    return $return;
}

function viral_times_scroll_top_icons_array() {
    return array('arrow_up', 'arrow_carrot-up', 'arrow_carrot-2up', 'arrow_carrot-2up_alt2', 'arrow_carrot-up_alt2', 'arrow_triangle-up_alt2', 'arrow_up_alt', 'icofont-arrow-up', 'icofont-block-up', 'icofont-bubble-up', 'icofont-caret-up', 'icofont-circled-up', 'icofont-curved-up', 'icofont-dotted-up', 'icofont-hand-drawn-alt-up', 'icofont-hand-drawn-up', 'icofont-hand-up', 'icofont-line-block-up', 'icofont-long-arrow-up', 'icofont-rounded-up', 'icofont-scroll-bubble-up', 'icofont-scroll-double-up', 'icofont-scroll-long-up', 'icofont-scroll-up', 'icofont-simple-up', 'icofont-square-up', 'icofont-stylish-up', 'icofont-swoosh-up', 'icofont-thin-up', 'mdi-arrow-collapse-up', 'mdi-arrow-expand-up', 'mdi-arrow-up', 'mdi-arrow-up-bold', 'mdi-arrow-up-bold-box', 'mdi-arrow-up-bold-box-outline', 'mdi-arrow-up-bold-circle', 'mdi-arrow-up-bold-circle-outline', 'mdi-arrow-up-bold-hexagon-outline', 'mdi-arrow-up-bold-outline', 'mdi-arrow-up-box', 'mdi-arrow-up-circle', 'mdi-arrow-up-circle-outline', 'mdi-arrow-up-drop-circle', 'mdi-arrow-up-drop-circle-outline', 'mdi-arrow-up-thick', 'mdi-boom-gate-up', 'mdi-boom-gate-up-outline', 'mdi-chevron-double-up', 'mdi-chevron-triple-up', 'mdi-chevron-up', 'mdi-chevron-up-box', 'mdi-chevron-up-box-outline', 'mdi-chevron-up-circle-outline', 'mdi-clipboard-arrow-up-outline', 'mdi-elevator-up', 'mdi-format-text-rotation-up', 'mdi-gesture-swipe-up', 'mdi-hand-pointing-up', 'mdi-menu-up', 'mdi-menu-up-outline', );
}

function viral_times_check_cfu() {
    if (class_exists('Hash_Custom_Font_Uploader')) {
        return false;
    } else {
        return true;
    }
}

function viral_times_is_upgrade_notice_active() {
    $show_upgrade_notice = apply_filters('viral_times_hide_upgrade_notice', get_theme_mod('viral_times_hide_upgrade_notice', false));
    return !$show_upgrade_notice;
}

function viral_times_check_frontpage() {
    $show_on_front = get_option('show_on_front');
    $enable_frontpage = get_theme_mod('viral_times_enable_frontpage', false);

    if ($enable_frontpage) {
        return false;
    }

    if ($show_on_front == 'page') {
        $page_on_front = get_option('page_on_front');
        if (get_page_template_slug($page_on_front) != 'templates/home-template.php') {
            return true;
        }
        return false;
    } else {
        return true;
    }
}
