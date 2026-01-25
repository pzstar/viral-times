<?php
/**
 * @package Viral Times
 */
add_action('widgets_init', 'viral_times_register_category_post_carousel');

function viral_times_register_category_post_carousel() {
    register_widget('viral_times_category_post_carousel');
}

class viral_times_category_post_carousel extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => esc_html__('A widget to display category post with thumbnail.', 'viral-times'));
        parent::__construct('viral_times_category_post_carousel', '&bull; Viral Times : Post Carousel by Category', $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'ht_tab' => array(
                'viral_times_widgets_tabs' => array(
                    'ht-input' => esc_html__('Inputs', 'viral-times'),
                    'ht-settings' => esc_html__('Settings', 'viral-times')
                ),
                'viral_times_widgets_field_type' => 'tab'
            ),
            'tab_open' => array(
                'viral_times_widgets_class' => 'ht-widget-tab-content-wrap',
                'viral_times_widgets_field_type' => 'open'
            ),
            'input_open' => array(
                'viral_times_widgets_class' => 'ht-widget-tab-content',
                'viral_times_widgets_data_id' => 'ht-input',
                'viral_times_widgets_field_type' => 'open'
            ),
            'title' => array(
                'viral_times_widgets_name' => 'title',
                'viral_times_widgets_title' => esc_html__('Title', 'viral-times'),
                'viral_times_widgets_field_type' => 'text'
            ),
            'category' => array(
                'viral_times_widgets_name' => 'category',
                'viral_times_widgets_title' => esc_html__('Select Categories', 'viral-times'),
                'viral_times_widgets_field_type' => 'taxonomycheckbox',
                'viral_times_widgets_field_taxonomy' => 'category',
                'viral_times_widgets_description' => esc_html__('Latest Post will be displayed if category is not selected.', 'viral-times'),
            ),
            'post_count' => array(
                'viral_times_widgets_name' => 'post_count',
                'viral_times_widgets_title' => esc_html__('No of Posts to Display', 'viral-times'),
                'viral_times_widgets_field_type' => 'number',
                'viral_times_widgets_default' => '5'
            ),
            'thumbnail_size' => array(
                'viral_times_widgets_name' => 'thumbnail_size',
                'viral_times_widgets_title' => esc_html__('Thumbnail Size', 'viral-times'),
                'viral_times_widgets_field_type' => 'select',
                'viral_times_widgets_field_options' => viral_times_get_image_sizes(),
                'viral_times_widgets_default' => 'viral-times-500x500'
            ),
            'display_date' => array(
                'viral_times_widgets_name' => 'display_date',
                'viral_times_widgets_title' => esc_html__('Display Posted Date', 'viral-times'),
                'viral_times_widgets_field_type' => 'checkbox',
            ),
            'display_excerpt' => array(
                'viral_times_widgets_name' => 'display_excerpt',
                'viral_times_widgets_title' => esc_html__('Display Excerpt', 'viral-times'),
                'viral_times_widgets_field_type' => 'checkbox',
            ),
            'excerpt_letter_count' => array(
                'viral_times_widgets_name' => 'excerpt_letter_count',
                'viral_times_widgets_title' => esc_html__('No of Letter to Display in Excerpt', 'viral-times'),
                'viral_times_widgets_field_type' => 'number',
                'viral_times_widgets_default' => '100'
            ),
            'input_close' => array(
                'viral_times_widgets_field_type' => 'close'
            ),
            'settings_open' => array(
                'viral_times_widgets_class' => 'ht-widget-tab-content',
                'viral_times_widgets_data_id' => 'ht-settings',
                'viral_times_widgets_field_type' => 'open'
            ),
            'title_html_tag' => array(
                'viral_times_widgets_name' => 'title_html_tag',
                'viral_times_widgets_title' => esc_html__('Title HTMl Tag', 'viral-times'),
                'viral_times_widgets_field_type' => 'select',
                'viral_times_widgets_field_options' => array(
                    'default' => esc_html__('Default', 'viral-times'),
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p'
                ),
                'viral_times_widgets_default' => 'default'
            ),
            'title_color' => array(
                'viral_times_widgets_name' => 'title_color',
                'viral_times_widgets_title' => esc_html__('Title Color', 'viral-times'),
                'viral_times_widgets_field_type' => 'color'
            ),
            'excerpt_color' => array(
                'viral_times_widgets_name' => 'excerpt_color',
                'viral_times_widgets_title' => esc_html__('Posted Date & Excerpt Text Color', 'viral-times'),
                'viral_times_widgets_field_type' => 'color'
            ),
            'settings_close' => array(
                'viral_times_widgets_field_type' => 'close'
            ),
            'tab_close' => array(
                'viral_times_widgets_field_type' => 'close'
            )
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $title = isset($instance['title']) ? $instance['title'] : '';
        $post_count = isset($instance['post_count']) ? $instance['post_count'] : 5;
        $category = isset($instance['category']) ? $instance['category'] : '';
        $thumbnail_size = isset($instance['thumbnail_size']) ? $instance['thumbnail_size'] : 'viral-times-500x500';
        $display_date = (isset($instance['display_date']) && $instance['display_date']) ? true : false;
        $display_excerpt = (isset($instance['display_excerpt']) && $instance['display_excerpt']) ? true : false;
        $excerpt_letter_count = isset($instance['excerpt_letter_count']) ? $instance['excerpt_letter_count'] : 100;
        $title_html_tag = isset($instance['title_html_tag']) ? $instance['title_html_tag'] : 'div';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $excerpt_color = isset($instance['excerpt_color']) ? $instance['excerpt_color'] : '';

        $title_style = $excerpt_style = "";
        $class = 'ht-pl-title';

        if ($title_html_tag == 'default') {
            $title_html_tag = 'h3';
            $class = 'ht-pl-title vl-post-title';
        }

        if (!empty($title_color)) {
            $title_style = 'style="color:' . $title_color . '"';
        }

        if (!empty($excerpt_color)) {
            $excerpt_style = 'style="color:' . $excerpt_color . '"';
        }

        echo $before_widget;
        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <?php echo '<div class="ht-post-carousel owl-carousel">'; ?>
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $post_count,
            'ignore_sticky_posts' => true
        );

        if ($category) {
            $category = array_keys($category);
            $cat = join(',', $category);
            $args['cat'] = $cat;
        }

        $query = new WP_Query($args);

        while ($query->have_posts()):
            $query->the_post();
            ?>
            <div class="ht-post-slide">

                <div class="ht-pl-image">
                    <a href="<?php echo the_permalink(); ?>">
                        <?php viral_times_post_featured_image($thumbnail_size, false); ?>
                    </a>
                </div>

                <div class="ht-pl-content">
                    <<?php echo $title_html_tag; ?> class="<?php echo $class; ?>" <?php echo $title_style; ?>>
                        <a href="<?php echo the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </<?php echo $title_html_tag; ?>>

                    <?php if ($display_date) { ?>
                        <div class="ht-pl-date" <?php echo $excerpt_style; ?>>
                            <?php echo viral_times_post_date(); ?>
                        </div>
                    <?php } ?>

                    <?php if ($display_excerpt) { ?>
                        <div class="ht-pl-excerpt" <?php echo $excerpt_style; ?>>
                            <?php echo viral_times_excerpt(get_the_content(), $excerpt_letter_count); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
        ?>
        <?php echo '</div>'; ?>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    viral_times_widgets_updated_field_value()        defined in widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            if (!viral_times_exclude_widget_update($viral_times_widgets_field_type)) {
                $new = isset($new_instance[$viral_times_widgets_name]) ? $new_instance[$viral_times_widgets_name] : '';
                // Use helper function to get updated field values
                $instance[$viral_times_widgets_name] = viral_times_widgets_updated_field_value($widget_field, $new);
            }
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    viral_times_widgets_show_widget_field()      defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();
        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            // Make array elements available as variables
            extract($widget_field);

            if (!viral_times_exclude_widget_update($viral_times_widgets_field_type)) {
                $viral_times_widgets_field_value = !empty($instance[$viral_times_widgets_name]) ? $instance[$viral_times_widgets_name] : '';
            } else {
                $viral_times_widgets_field_value = '';
            }

            viral_times_widgets_show_widget_field($this, $widget_field, $viral_times_widgets_field_value);
        }
    }

}
