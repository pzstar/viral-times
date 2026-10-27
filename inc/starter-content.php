<?php
/**
 * Starter content, shown on new sites in the Customizer and in the WordPress.org theme preview.
 *
 * @package Viral Times
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('viral_times_starter_content')) {

    function viral_times_starter_content() {
        // Paragraphs as block markup, so the posts open cleanly in the block editor.
        $paragraphs = function ($texts) {
            $html = '';
            foreach ($texts as $text) {
                $html .= '<!-- wp:paragraph --><p>' . $text . '</p><!-- /wp:paragraph -->';
            }
            return $html;
        };

        // Starter posts can't be given categories, so every block shows the latest posts with category labels hidden (they would all read Uncategorized), and titles are kept general.
        $news_block = function ($title, $layout) {
            return array(
                'title' => $title,
                'category' => '',
                'layout' => $layout,
                'display_cat' => 'no',
                'display_author' => 'yes',
                'display_date' => 'yes',
                'enable' => 'on'
            );
        };

        // The theme's Post Listing and Post Carousel widgets, showing the latest posts.
        $post_list = function ($title, $layout, $count, $thumbnail_size, $display_excerpt) {
            return array('viral_times_category_post_list', array(
                'title' => $title,
                'category' => '',
                'post_count' => $count,
                'thumbnail_size' => $thumbnail_size,
                'display_date' => 1,
                'display_excerpt' => $display_excerpt,
                'layout' => $layout,
                'title_html_tag' => 'default',
            ));
        };

        $post_carousel = function ($title, $thumbnail_size, $display_date) {
            return array('viral_times_category_post_carousel', array(
                'title' => $title,
                'category' => '',
                'post_count' => 5,
                'thumbnail_size' => $thumbnail_size,
                'display_date' => $display_date,
                'display_excerpt' => 0,
                'title_html_tag' => 'default',
            ));
        };

        // An advertisement placeholder image bundled with the theme.
        $ad_image = function ($file, $width, $height) {
            return array('custom_html', array(
                'title' => '',
                'content' => '<a href="#"><img src="' . esc_url(get_template_directory_uri() . '/images/starter/' . $file) . '" width="' . $width . '" height="' . $height . '" alt="' . esc_attr_x('Advertise with us', 'Theme starter content', 'viral-times') . '"></a>',
            ));
        };

        $starter_content = array(
            'posts' => array(
                'viral-times-post-1' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Heatwave Brings Record Temperatures Across the Region', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('Temperatures climbed past 40°C in several towns this week, breaking records that had stood for more than thirty years. Forecasters expect the hot spell to last until the weekend before cooler air arrives from the coast.', 'Theme starter content', 'viral-times'),
                        _x('Local councils have opened cooling centers in libraries and community halls, and health officials are asking people to drink plenty of water, stay out of the midday sun and check on elderly neighbors.', 'Theme starter content', 'viral-times'),
                        _x('Farmers say the heat has arrived at a difficult time, just weeks before harvest, and are watering crops at night to save what they can.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-1}}',
                ),
                'viral-times-post-2' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Colorful Old Town Streets Draw Record Number of Visitors', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('The painted houses and tiled streets of the old town welcomed more visitors this summer than in any year before, according to the local tourism office.', 'Theme starter content', 'viral-times'),
                        _x('Cafe owners have added outdoor seating to keep up with demand, and a new walking tour now guides visitors through the quieter lanes behind the main square.', 'Theme starter content', 'viral-times'),
                        _x('Residents welcome the boost to local business but have asked the council to plan for busier seasons ahead, with more buses and better signs for visitors.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-2}}',
                ),
                'viral-times-post-3' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Old Factory Chimney to Become Centerpiece of New Waterfront Park', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('The tall brick chimney that has stood by the lake for over a century will be kept and restored as part of a new waterfront park, the city announced on Monday.', 'Theme starter content', 'viral-times'),
                        _x('Plans include walking and cycling paths, a small museum about the town\'s industrial past and a viewing platform with views across the water at sunset.', 'Theme starter content', 'viral-times'),
                        _x('Work is expected to begin next spring, and the first section of the park could open to the public within two years.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-3}}',
                ),
                'viral-times-post-4' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Young Boxers Shine at National Youth Championship', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('Two teenagers from the local boxing club came home with medals from the national youth championship, the club\'s best result since it opened.', 'Theme starter content', 'viral-times'),
                        _x('Their coach credits hard work and early morning training sessions, and says interest in the sport among young people in the area has never been higher.', 'Theme starter content', 'viral-times'),
                        _x('The club is now raising money for new equipment so it can welcome more members next season.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-4}}',
                ),
                'viral-times-post-5' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Tea Growers Turn to Organic Farming as Demand Rises', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('A growing number of tea estates in the highlands are switching to organic methods as buyers at home and abroad ask for chemical-free leaves.', 'Theme starter content', 'viral-times'),
                        _x('Growers say the change takes several years and lowers yields at first, but the higher price for organic tea makes the effort worthwhile.', 'Theme starter content', 'viral-times'),
                        _x('Workers have been trained in new ways to protect the plants from pests, and some estates now invite visitors to see how their tea is grown and picked.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-5}}',
                ),
                'viral-times-post-6' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Historic Fortress Reopens After Five-Year Restoration', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('After five years behind scaffolding, the old stone fortress on the hill has reopened its gates to visitors, with repaired towers, new walkways and a refreshed exhibition.', 'Theme starter content', 'viral-times'),
                        _x('Craftspeople used traditional tools and local stone to rebuild the damaged walls, keeping as much of the original structure as possible.', 'Theme starter content', 'viral-times'),
                        _x('Entry is free for local residents during the first month, and guided tours run every afternoon.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-6}}',
                ),
                'viral-times-post-7' => array(
                    'post_type' => 'post',
                    'post_title' => _x('New Rapid Bus Lanes Promise Shorter Commutes Downtown', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('Dedicated bus lanes opened on the city\'s main boulevard this week, and early figures suggest journeys across downtown are already up to ten minutes faster.', 'Theme starter content', 'viral-times'),
                        _x('The project also added new crossings, wider sidewalks and shade trees along the route, making the street safer for people on foot.', 'Theme starter content', 'viral-times'),
                        _x('Transport officials will review the results after six months before deciding whether to extend the lanes to other busy roads.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-7}}',
                ),
                'viral-times-post-8' => array(
                    'post_type' => 'post',
                    'post_title' => _x('How Communities Are Rebuilding After the Earthquake', 'Theme starter content', 'viral-times'),
                    'post_content' => $paragraphs(array(
                        _x('Months after the earthquake, families in the worst-hit villages are moving into new homes built to withstand future tremors.', 'Theme starter content', 'viral-times'),
                        _x('Volunteers, engineers and local builders have worked side by side, and many of the new houses use designs that are cheaper and stronger than before.', 'Theme starter content', 'viral-times'),
                        _x('Schools and health posts are next on the list, and aid groups say the community\'s own efforts have made all the difference.', 'Theme starter content', 'viral-times'),
                    )),
                    'thumbnail' => '{{viral-times-image-8}}',
                ),
                'about',
                'contact',
            ),

            // Photos from the WordPress.org Photo Directory (CC0).
            'attachments' => array(
                'viral-times-image-1' => array(
                    'post_title' => _x('Thermometer showing 40 degrees', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-1.jpg',
                ),
                'viral-times-image-2' => array(
                    'post_title' => _x('Colorful street with outdoor seating', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-2.jpg',
                ),
                'viral-times-image-3' => array(
                    'post_title' => _x('Chimney by a lake at sunset', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-3.jpg',
                ),
                'viral-times-image-4' => array(
                    'post_title' => _x('Young boxers training in a ring', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-4.jpg',
                ),
                'viral-times-image-5' => array(
                    'post_title' => _x('Worker on a tea plantation', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-5.jpg',
                ),
                'viral-times-image-6' => array(
                    'post_title' => _x('Stone fortress under a cloudy sky', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-6.jpg',
                ),
                'viral-times-image-7' => array(
                    'post_title' => _x('City road lined with palm trees', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-7.jpg',
                ),
                'viral-times-image-8' => array(
                    'post_title' => _x('House damaged by an earthquake', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/news-8.jpg',
                ),
                'viral-times-logo' => array(
                    'post_title' => _x('Viral Times Logo', 'Theme starter content', 'viral-times'),
                    'file' => 'images/starter/logo.png',
                ),
            ),

            // Settings from the Buzz demo (demo.hashthemes.com/viral-times/buzz).
            'theme_mods' => array(
                'custom_logo' => '{{viral-times-logo}}',
                'viral_times_hide_title' => true,
                'viral_times_hide_tagline' => true,
                'viral_times_logo_height' => 54,
                'viral_times_logo_padding' => 25,
                'viral_times_responsive_width' => 1100,
                'viral_times_template_color' => '#4a4e69',
                'viral_times_content_link_hov_color' => '#4a4e69',
                'viral_times_display_time_ago' => true,
                'h_font_family' => 'Montserrat',
                'h_font_style' => '600',
                'h_text_transform' => 'none',
                'menu_font_family' => 'Montserrat',
                'menu_font_style' => '700',
                'body_font_family' => 'Lato',
                'body_font_size' => 16,
                'frontpage_block_title_font_size' => 18,
                'frontpage_block_title_letter_spacing' => 1.6,

                // Header: white top bar with the address, purple sticky menu bar with a green hover.
                'viral_times_th_bg_color' => '#ffffff',
                'viral_times_th_bottom_border_color' => 'rgba(0,0,0,0.1)',
                'viral_times_th_text_color' => '#000000',
                'viral_times_th_anchor_color' => '#000000',
                'viral_times_th_text' => '<p>' . _x('1428 Elmwood Avenue, IL 62704 | (555) 123-4567', 'Theme starter content', 'viral-times') . '</p>',
                'viral_times_sticky_header' => 'on',
                'viral_times_mh_height' => 72,
                'viral_times_mh_bg_color' => '#4a4e69',
                'viral_times_mh_bg_color_mobile' => '#4a4e69',
                'viral_times_mh_menu_hover_bg_color' => '#1a936f',

                // Home sections, in the demo's order: carousel, mini news, left news, slider, right news.
                'viral_times_enable_frontpage' => true,
                'viral_times_frontpage_sections' => array(
                    'viral_times_frontpage_carousel1_section',
                    'viral_times_frontpage_mininews_section',
                    'viral_times_frontpage_leftnews_section',
                    'viral_times_frontpage_slider1_section',
                    'viral_times_frontpage_rightnews_section',
                ),
                'viral_times_frontpage_section_spacing' => 50,
                'viral_times_block_title_color' => '#ffffff',
                'viral_times_block_title_background_color' => '#4a4e69',

                // Carousel over a photo with a purple overlay.
                'viral_times_frontpage_carousel1_blocks' => wp_json_encode(array(
                    array(
                        'title' => '',
                        'category' => '',
                        'layout' => 'style1',
                        'display_cat' => 'no',
                        'display_author' => 'yes',
                        'display_date' => 'yes',
                        'post_count' => 5,
                        'slide_count' => 2,
                        'slide_pause' => 5,
                        'auto_slide' => 'yes',
                        'image_size' => 'full',
                        'title_size' => 'vl-big-title',
                        'gap' => '0',
                        'enable' => 'on'
                    )
                )),
                'viral_times_carousel1_bg_type' => 'image-bg',
                'viral_times_carousel1_bg_image_url' => get_template_directory_uri() . '/images/starter/news-2.jpg',
                'viral_times_carousel1_bg_color' => '#ededed',
                'viral_times_carousel1_overlay_color' => 'rgba(74,78,105,0.68)',
                'viral_times_carousel1_title_color' => '#ffffff',
                'viral_times_carousel1_text_color' => '#ffffff',
                'viral_times_carousel1_padding_top' => 80,
                'viral_times_carousel1_padding_bottom' => 80,

                // Full-width mini news.
                'viral_times_mininews_style' => 'style1',
                'viral_times_mininews_fullwidth' => true,
                'viral_times_mininews_image_size' => 'thumbnail',
                'viral_times_mininews_post_count_big' => 4,
                'viral_times_mininews_display_cat' => false,
                'viral_times_mininews_padding_top' => 50,
                'viral_times_mininews_padding_bottom' => 50,

                'viral_times_leftnews_bg_color' => '#f7f4ff',
                'viral_times_leftnews_padding_top' => 50,
                'viral_times_leftnews_padding_bottom' => 50,
                'viral_times_frontpage_leftnews_blocks' => wp_json_encode(array(
                    $news_block(_x('Latest News', 'Theme starter content', 'viral-times'), 'style11'),
                    $news_block(_x('Top Stories', 'Theme starter content', 'viral-times'), 'style1'),
                    $news_block(_x('Lifestyle', 'Theme starter content', 'viral-times'), 'style11'),
                )),

                // Slider over a photo with a purple overlay.
                'viral_times_frontpage_slider1_blocks' => wp_json_encode(array(
                    array(
                        'title' => '',
                        'category' => '',
                        'layout' => 'style3',
                        'display_cat' => 'no',
                        'display_author' => 'yes',
                        'display_date' => 'yes',
                        'post_count' => 5,
                        'enable' => 'on'
                    )
                )),
                'viral_times_slider1_bg_type' => 'image-bg',
                'viral_times_slider1_bg_image_url' => get_template_directory_uri() . '/images/starter/news-7.jpg',
                'viral_times_slider1_overlay_color' => 'rgba(74,78,105,0.58)',
                'viral_times_slider1_padding_top' => 80,
                'viral_times_slider1_padding_bottom' => 80,

                'viral_times_rightnews_bg_color' => '#f7fffc',
                'viral_times_rightnews_padding_top' => 50,
                'viral_times_rightnews_padding_bottom' => 50,
                'viral_times_frontpage_rightnews_blocks' => wp_json_encode(array(
                    $news_block(_x('Trending Now', 'Theme starter content', 'viral-times'), 'style1'),
                    $news_block(_x('Editor\'s Picks', 'Theme starter content', 'viral-times'), 'style3'),
                    $news_block(_x('Around the World', 'Theme starter content', 'viral-times'), 'style10'),
                )),

                'viral_times_blog_layout' => 'layout4',
                'viral_times_footer_bg_color' => '#4a4e69',
                'viral_times_footer_title_color' => '#ffffff',
                'viral_times_footer_border_color' => 'rgba(255,255,255,0.49)',
                'viral_times_footer_text_color' => '#ffffff',
                'viral_times_footer_anchor_color' => '#ffffff',
            ),

            'widgets' => array(
                'viral-times-header-widget' => array(
                    'ad_banner' => $ad_image('ad-banner.jpg', 700, 100),
                ),
                'viral-times-right-sidebar' => array(
                    'sidebar_ad' => $ad_image('ad-sidebar.jpg', 300, 400),
                    'trending' => $post_list(_x('Trending', 'Theme starter content', 'viral-times'), 'style4', 6, 'viral-times-360x240', 0),
                ),
                'viral-times-frontpage-right-sidebar' => array(
                    'frontpage_ad' => $ad_image('ad-sidebar.jpg', 300, 400),
                    'editors_pick' => $post_list(_x('Editors\' Pick', 'Theme starter content', 'viral-times'), 'style1', 3, 'viral-times-360x240', 1),
                ),
                'viral-times-frontpage-left-sidebar' => array(
                    'featured' => $post_carousel(_x('Featured Stories', 'Theme starter content', 'viral-times'), 'viral-times-500x600', 1),
                    'more_news' => $post_list(_x('More News', 'Theme starter content', 'viral-times'), 'style2', 5, 'viral-times-150x150', 0),
                ),
                'viral-times-footer1' => array(
                    'footer_about' => array('custom_html', array(
                        'title' => '',
                        'content' => '<p><img src="' . esc_url(get_template_directory_uri() . '/images/starter/logo-white.png') . '" width="228" height="46" alt="' . esc_attr(get_bloginfo('name')) . '"></p><p>' . esc_html_x('Viral Times covers the news you care about, from local stories to world events, with fresh reporting from our newsroom every day.', 'Theme starter content', 'viral-times') . '</p>',
                    )),
                ),
                'viral-times-footer2' => array(
                    'footer_recent' => $post_list(_x('Recent Posts', 'Theme starter content', 'viral-times'), 'style2', 4, 'viral-times-150x150', 0),
                ),
                'viral-times-footer3' => array(
                    'contact' => array('viral_times_contact_info', array(
                        'title' => _x('Contact Us', 'Theme starter content', 'viral-times'),
                        'phone' => '(555) 123-4567',
                        'email' => 'news@example.com',
                        'website' => 'www.example.com',
                        'address' => _x('1428 Elmwood Avenue, IL 62704', 'Theme starter content', 'viral-times'),
                        'time' => _x('Mon - Fri, 10:00 AM - 5:00 PM', 'Theme starter content', 'viral-times'),
                    )),
                ),
            ),

            'nav_menus' => array(
                'primary' => array(
                    'name' => __('Primary Menu', 'viral-times'),
                    'items' => array(
                        'link_home',
                        'page_about',
                        'page_contact',
                    ),
                ),
            ),
        );

        add_theme_support('starter-content', apply_filters('viral_times_starter_content', $starter_content));
    }

}

add_action('after_setup_theme', 'viral_times_starter_content');

if (!function_exists('viral_times_preview_starter_posts')) {

    // In the Customizer, starter posts stay auto-drafts until the user publishes, so the home sections' queries can't see them; include them while previewing.
    function viral_times_preview_starter_posts($query) {
        global $wp_customize;

        if (is_admin() || !is_customize_preview() || !get_option('fresh_site') || !$wp_customize instanceof WP_Customize_Manager || !in_array($query->get('post_type'), array('', 'post'), true)) {
            return;
        }

        $setting = $wp_customize->get_setting('nav_menus_created_posts');
        $ids = $setting ? array_filter(array_map('absint', (array) $setting->value())) : array();

        if ($ids) {
            $query->set('post_status', array('publish', 'auto-draft'));
            $query->set('viral_times_starter_ids', $ids);
        }
    }

}

add_action('pre_get_posts', 'viral_times_preview_starter_posts');

if (!function_exists('viral_times_preview_starter_posts_where')) {

    // Limits the auto-drafts let in above to the starter content ones.
    function viral_times_preview_starter_posts_where($where, $query) {
        global $wpdb;
        $ids = $query->get('viral_times_starter_ids');

        if ($ids) {
            $where .= " AND ({$wpdb->posts}.post_status <> 'auto-draft' OR {$wpdb->posts}.ID IN (" . implode(',', array_map('absint', $ids)) . '))';
        }

        return $where;
    }

}

add_filter('posts_where', 'viral_times_preview_starter_posts_where', 10, 2);

if (!function_exists('viral_times_theme_preview_posts')) {

    // The WordPress.org theme preview keeps starter posts only in the object cache, with made-up IDs from 10000 and their keys as slugs, so post lists never see them.
    // Finds them there and gives them the dates and author the preview leaves out; returns nothing on real sites.
    function viral_times_theme_preview_posts() {
        static $posts = null;

        if (null !== $posts) {
            return $posts;
        }

        $posts = array();

        if (is_admin() || !get_option('fresh_site') || wp_using_ext_object_cache()) {
            return $posts;
        }

        $starter_content = get_theme_starter_content();
        $keys = array();
        foreach ((array) ($starter_content['posts'] ?? array()) as $key => $starter_post) {
            if ('post' === ($starter_post['post_type'] ?? '')) {
                $keys[$key] = true;
            }
        }

        $last_id = 10000 + count((array) ($starter_content['posts'] ?? array())) + count((array) ($starter_content['attachments'] ?? array())) + 20;
        $found = array();
        for ($id = 10000; $id < $last_id && count($found) < count($keys); $id++) {
            $cached = wp_cache_get($id, 'posts');
            if (is_object($cached) && isset($cached->post_name, $keys[$cached->post_name])) {
                $found[$cached->post_name] = $cached;
            }
        }

        if (!$found) {
            return $posts;
        }

        $latest = get_posts(array('numberposts' => 1, 'post_type' => 'post', 'suppress_filters' => true));
        $author = $latest ? $latest[0]->post_author : 1;
        $time = current_time('timestamp');
        $i = 0;

        // Starter content order, newest first, a few hours apart.
        foreach (array_keys($keys) as $key) {
            if (!isset($found[$key])) {
                continue;
            }

            $data = (object) array_merge((array) $found[$key], array(
                'post_status' => 'publish',
                'post_author' => $author,
                'post_date' => gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS),
                'post_date_gmt' => get_gmt_from_date(gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS)),
                'post_modified' => gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS),
                'comment_status' => 'closed',
                'filter' => 'raw',
            ));
            wp_cache_set($data->ID, $data, 'posts');
            $posts[] = new WP_Post($data);
            $i++;
        }

        return $posts;
    }

}

if (!function_exists('viral_times_theme_preview_post_lists')) {

    // In the WordPress.org theme preview, the front page sections and post widgets list the starter posts instead of the Theme Unit Test posts.
    function viral_times_theme_preview_post_lists($posts, $query) {
        if (null !== $posts || $query->is_main_query() || !in_array($query->get('post_type'), array('', 'post'), true) || $query->get('p') || $query->get('page_id') || $query->get('post__in') || $query->get('s') || $query->get('cat') || $query->get('category_name') || $query->get('tag') || $query->get('tax_query') || $query->get('author')) {
            return $posts;
        }

        $preview_posts = viral_times_theme_preview_posts();

        if (!$preview_posts) {
            return $posts;
        }

        $per_page = (int) $query->get('posts_per_page');
        $per_page = $per_page > 0 ? $per_page : count($preview_posts);
        $offset = (int) $query->get('offset') + (max(1, (int) $query->get('paged')) - 1) * $per_page;
        $posts = array_slice($preview_posts, $offset, $per_page);

        $query->found_posts = count($preview_posts);
        $query->max_num_pages = (int) ceil(count($preview_posts) / $per_page);

        return 'ids' === $query->get('fields') ? wp_list_pluck($posts, 'ID') : $posts;
    }

}

add_filter('posts_pre_query', 'viral_times_theme_preview_post_lists', 10, 2);
