<?php
add_action('after_switch_theme', 'viral_times_transfer_old_settings');

function viral_times_transfer_old_settings() {
    $is_setting_transferred = get_theme_mod('viral_times_is_setting_transferred', false);
    $previous_theme = strtolower(get_option('theme_switched'));

    if ($previous_theme !== 'viral-express' || $is_setting_transferred) {
        return;
    }

    $viral_times_mods = get_option('theme_mods_' . $previous_theme);

    $viral_times_new_value = array();

    $widgets = array('widget_viral_express_category', 'widget_viral_express_contact_info', 'widget_viral_express_category_post_carousel', 'widget_viral_express_category_post_list');
    foreach ($widgets as $wie) {
        $key = str_replace('viral_express', 'viral_times', $wie);
        $widget_val = get_option($wie);
        update_option($key, $widget_val);
    }

    if ($viral_times_mods) {
        foreach ($viral_times_mods as $viral_times_key => $viral_times_value) {
            if ($viral_times_key == 'viral_express_frontpage_sections') {
                foreach ($viral_times_value as $section) {
                    $viral_times_new_value[] = str_replace('viral_express', 'viral_times', $section);
                }
                $viral_times_value = $viral_times_new_value;
            }
            $viral_times_key = str_replace('viral_express', 'viral_times', $viral_times_key);
            set_theme_mod($viral_times_key, $viral_times_value);
        }


        $new_widget = array();
        foreach ($viral_times_mods['sidebars_widgets']['data'] as $widget_id => $widget) {
            $newwidget = array();
            foreach ($widget as $ww) {
                $newwidget[] = str_replace('viral_express', 'viral_times', $ww);
            }
            $new_widget[str_replace('viral-express', 'viral-times', $widget_id)] = $newwidget;
        }

        set_theme_mod('sidebars_widgets', $new_widget);
        update_option('sidebars_widgets', $new_widget);
    }

    

    set_theme_mod('viral_times_is_setting_transferred', true);
}
