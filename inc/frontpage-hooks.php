<?php
/**
 *
 * @package Viral Times
 */
include_once get_template_directory() . '/home-parts/slider1-section.php';
include_once get_template_directory() . '/home-parts/mininews-section.php';
include_once get_template_directory() . '/home-parts/leftnews-section.php';
include_once get_template_directory() . '/home-parts/rightnews-section.php';
include_once get_template_directory() . '/home-parts/carousel1-section.php';

add_action('viral_times_slider1_section', 'viral_times_slider_section_style1');
add_action('viral_times_slider1_section', 'viral_times_slider_section_style2');
add_action('viral_times_slider1_section', 'viral_times_slider_section_style3');
add_action('viral_times_slider1_section', 'viral_times_slider_section_style4');

add_action('viral_times_leftnews_section', 'viral_times_news_section_style1');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style2');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style3');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style4');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style5');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style6');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style7');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style8');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style9');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style10');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style11');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style12');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style13');
add_action('viral_times_leftnews_section', 'viral_times_news_section_style14');

add_action('viral_times_rightnews_section', 'viral_times_news_section_style1');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style2');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style3');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style4');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style5');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style6');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style7');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style8');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style9');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style10');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style11');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style12');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style13');
add_action('viral_times_rightnews_section', 'viral_times_news_section_style14');

add_action('viral_times_carousel1_section', 'viral_times_carousel_section_style1');
add_action('viral_times_carousel1_section', 'viral_times_carousel_section_style2');
add_action('viral_times_carousel1_section', 'viral_times_carousel_section_style3');


if (!function_exists('viral_times_slider_section_style1')) {

    function viral_times_slider_section_style1($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $post_count = $args['post_count'];
        if ($layout != 'style1')
            return;
        ?>
        <div class="vl-slider-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>

            <?php echo '<div class="vl-slider-wrap owl-carousel">'; ?>
            <?php
            $args = array(
                'cat' => $cat,
                'posts_per_page' => $post_count,
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($args);

            while ($query->have_posts()):
                $query->the_post();
                ?>
                <div class="slide-item">
                    <?php
                    viral_times_post_featured_image('viral-times-1300x540', false);
                    ?>
                    <div class="vl-title-wrap">
                        <?php
                        if ($display_cat == 'yes') {
                            echo viral_times_get_the_category_list();
                        }
                        ?>

                        <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                        <?php
                        if ($display_author == 'yes' || $display_date == 'yes') {
                            echo '<div class="vl-post-metas">';
                            if ($display_author == 'yes') {
                                echo viral_times_post_author();
                            }

                            if ($display_date == 'yes') {
                                echo viral_times_post_date();
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
            <?php '</div>'; ?>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_slider_section_style2')) {

    function viral_times_slider_section_style2($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $post_count = $args['post_count'];
        if ($layout != 'style2')
            return;
        ?>
        <div class="vl-slider-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>

            <?php echo '<div class="vl-slider-wrap owl-carousel">'; ?>
            <?php
            $args = array(
                'cat' => $cat,
                'posts_per_page' => $post_count,
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($args);

            while ($query->have_posts()):
                $query->the_post();
                ?>
                <div class="slide-item">
                    <?php
                    viral_times_post_featured_image('viral-times-1300x540', false);
                    ?>
                    <div class="vl-title-wrap">
                        <?php
                        if ($display_cat == 'yes') {
                            echo viral_times_get_the_category_list();
                        }
                        ?>

                        <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                        <?php
                        if ($display_author == 'yes' || $display_date == 'yes') {
                            echo '<div class="vl-post-metas">';
                            if ($display_author == 'yes') {
                                echo viral_times_post_author();
                            }

                            if ($display_date == 'yes') {
                                echo viral_times_post_date();
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
            <?php echo '</div>'; ?>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_slider_section_style3')) {

    function viral_times_slider_section_style3($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $post_count = $args['post_count'];
        if ($layout != 'style3')
            return;
        ?>
        <div class="vl-slider-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>

            <?php echo '<div class="vl-slider-wrap owl-carousel">'; ?>
            <?php
            $args = array(
                'cat' => $cat,
                'posts_per_page' => $post_count,
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($args);

            while ($query->have_posts()):
                $query->the_post();
                ?>
                <div class="slide-item">
                    <?php
                    viral_times_post_featured_image('viral-times-1300x540', false);
                    ?>
                    <div class="vl-title-wrap">
                        <?php
                        if ($display_cat == 'yes') {
                            echo viral_times_get_the_category_list();
                        }
                        ?>

                        <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                        <div class="vl-excerpt">
                            <?php echo viral_times_excerpt(get_the_content(), 180); ?>
                        </div>

                        <?php
                        if ($display_author == 'yes' || $display_date == 'yes') {
                            echo '<div class="vl-post-metas">';
                            if ($display_author == 'yes') {
                                echo viral_times_post_author();
                            }

                            if ($display_date == 'yes') {
                                echo viral_times_post_date();
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
            <?php echo '</div>'; ?>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_slider_section_style4')) {

    function viral_times_slider_section_style4($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $post_count = $args['post_count'];
        if ($layout != 'style4')
            return;
        ?>
        <div class="vl-slider-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>

            <?php echo '<div class="vl-slider-wrap owl-carousel">'; ?>
            <?php
            $args = array(
                'cat' => $cat,
                'posts_per_page' => $post_count,
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($args);

            while ($query->have_posts()):
                $query->the_post();
                ?>
                <div class="slide-item">
                    <?php
                    viral_times_post_featured_image('viral-times-1300x540', false);
                    ?>
                    <div class="vl-title-wrap">
                        <?php
                        if ($display_cat == 'yes') {
                            echo viral_times_get_the_category_list();
                        }
                        ?>

                        <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                        <?php
                        if ($display_author == 'yes' || $display_date == 'yes') {
                            echo '<div class="vl-post-metas">';
                            if ($display_author == 'yes') {
                                echo viral_times_post_author();
                            }

                            if ($display_date == 'yes') {
                                echo viral_times_post_date();
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
            <?php echo '</div>'; ?>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style1')) {

    function viral_times_news_section_style1($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $class = $display_cat == 'yes' ? 'vl-display-cat' : '';
        $count = $display_cat == 'yes' ? 300 : 180;
        if ($layout != 'style1')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-news-block-wrap <?php echo esc_attr($class); ?>">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);

                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_author == 'yes' || $display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    if ($display_author == 'yes') {
                                        echo viral_times_post_author();
                                    }

                                    if ($display_date == 'yes') {
                                        echo viral_times_post_date();
                                    }
                                    echo '</div>';
                                }
                                ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_times_excerpt(get_the_content(), $count); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 4,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vl-post-item ht-clearfix">
                            <div class="vl-post-thumb vl-aligned-block">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-150x150'); ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    echo viral_times_post_date();
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style2')) {

    function viral_times_news_section_style2($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];

        if ($layout != 'style2')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-grid-blocks">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 6,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);

                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-grid-block vl-post-item">
                        <div class="vl-grid-block-inner">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>

                                    <div class="vl-post-content vl-gradient-overlay">

                                        <h3 class="vl-post-title"><?php the_title(); ?></h3>
                                        <?php
                                        if ($display_author == 'yes' || $display_date == 'yes') {
                                            echo '<div class="vl-post-metas">';
                                            if ($display_author == 'yes') {
                                                echo viral_times_post_author();
                                            }

                                            if ($display_date == 'yes') {
                                                echo viral_times_post_date();
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style3')) {

    function viral_times_news_section_style3($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $class = $display_cat == 'yes' ? 'vl-display-cat' : '';

        if ($layout != 'style3')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-double-small-block <?php echo esc_attr($class); ?>">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 8,
                    'ignore_sticky_posts' => true,
                );

                $query = new WP_Query($args);

                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-post-item ht-clearfix">
                        <div class="vl-post-thumb vl-aligned-block">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <?php viral_times_post_featured_image('viral-times-150x150'); ?>
                                </div>
                            </a>
                        </div>

                        <div class="vl-post-content">
                            <?php
                            if ($display_cat == 'yes') {
                                echo viral_times_post_primary_category();
                            }
                            ?>
                            <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            if ($display_author == 'yes' || $display_date == 'yes') {
                                echo '<div class="vl-post-metas">';
                                if ($display_author == 'yes') {
                                    echo viral_times_post_author();
                                }

                                if ($display_date == 'yes') {
                                    echo viral_times_post_date();
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style4')) {

    function viral_times_news_section_style4($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];

        if ($layout != 'style4')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>

            <div class="vl-alternate-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-alt-post-item vl-post-item">
                        <div class="vl-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                </div>
                            </a>
                        </div>

                        <div class="vl-post-content">
                            <div class="vl-post-content-wrap">
                                <div class="vl-post-content-wrap-inner">
                                    <div>
                                        <?php
                                        if ($display_cat == 'yes') {
                                            echo viral_times_post_primary_category();
                                        }
                                        ?>
                                        <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <?php
                                        if ($display_author == 'yes' || $display_date == 'yes') {
                                            echo '<div class="vl-post-metas">';
                                            if ($display_author == 'yes') {
                                                echo viral_times_post_author();
                                            }

                                            if ($display_date == 'yes') {
                                                echo viral_times_post_date();
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                        <div class="vl-excerpt">
                                            <?php echo viral_times_excerpt(get_the_content(), 80); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style5')) {

    function viral_times_news_section_style5($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $class = $display_cat == 'yes' ? 'vl-display-cat' : '';
        if ($layout != 'style5')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-double-block <?php echo esc_attr($class); ?>">
                <div class="vl-big-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 2,
                        'ignore_sticky_posts' => true
                    );

                    $query = new WP_Query($args);
                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                    <div class="vl-post-content vl-gradient-overlay">
                                        <h3 class="vl-big-title vl-post-title"><span><?php the_title(); ?></span></h3>
                                        <?php
                                        if ($display_author == 'yes' || $display_date == 'yes') {
                                            echo '<div class="vl-post-metas">';
                                            if ($display_author == 'yes') {
                                                echo viral_times_post_author();
                                            }

                                            if ($display_date == 'yes') {
                                                echo viral_times_post_date();
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                    endwhile;
                    ?>
                </div>
                <?php
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 6,
                        'ignore_sticky_posts' => true,
                        'offset' => 2
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vl-post-item ht-clearfix">
                            <div class="vl-post-thumb vl-aligned-block">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-150x150'); ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    echo viral_times_post_date();
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style6')) {

    function viral_times_news_section_style6($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        if ($layout != 'style6')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-1-3-block">
                <div class="vl-big-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 1,
                        'ignore_sticky_posts' => true
                    );

                    $query = new WP_Query($args);
                    while ($query->have_posts()):
                        $query->the_post();
                        ?>

                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-800x500'); ?>
                                    </div>
                                    <div class="vl-post-content vl-gradient-overlay">
                                        <h3 class="vl-large-title vl-post-title"><span><?php the_title(); ?></span></h3>
                                        <?php
                                        if ($display_author == 'yes' || $display_date == 'yes') {
                                            echo '<div class="vl-post-metas">';
                                            if ($display_author == 'yes') {
                                                echo viral_times_post_author();
                                            }

                                            if ($display_date == 'yes') {
                                                echo viral_times_post_date();
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_get_the_category_list();
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                    endwhile;
                    ?>
                </div>
                <?php
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 3,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_author == 'yes' || $display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    if ($display_author == 'yes') {
                                        echo viral_times_post_author();
                                    }

                                    if ($display_date == 'yes') {
                                        echo viral_times_post_date();
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style7')) {

    function viral_times_news_section_style7($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $class = $display_cat == 'yes' ? 'vl-display-cat' : '';

        if ($layout != 'style7')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-1-6-block <?php echo esc_attr($class); ?>">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item ht-clearfix">
                            <div class="vl-post-thumb vl-aligned-block">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_author == 'yes' || $display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    if ($display_author == 'yes') {
                                        echo viral_times_post_author();
                                    }

                                    if ($display_date == 'yes') {
                                        echo viral_times_post_date();
                                    }
                                    echo '</div>';
                                }
                                ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_times_excerpt(get_the_content(), 280); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 6,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vl-post-item">
                            <div class="vl-post-thumb vl-aligned-block">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-150x150'); ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    echo viral_times_post_date();
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style8')) {

    function viral_times_news_section_style8($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        if ($layout != 'style8')
            return;

        $args = array(
            'cat' => $cat,
            'posts_per_page' => 1,
            'ignore_sticky_posts' => true
        );

        $query = new WP_Query($args);
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-grid-6-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 6,
                    'ignore_sticky_posts' => true,
                );

                $query = new WP_Query($args);

                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-post-item">
                        <div class="vl-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                </div>
                            </a>
                            <?php
                            if ($display_cat == 'yes') {
                                echo viral_times_post_primary_category();
                            }
                            ?>
                        </div>

                        <div class="vl-post-content">
                            <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            if ($display_author == 'yes' || $display_date == 'yes') {
                                echo '<div class="vl-post-metas">';
                                if ($display_author == 'yes') {
                                    echo viral_times_post_author();
                                }

                                if ($display_date == 'yes') {
                                    echo viral_times_post_date();
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style9')) {

    function viral_times_news_section_style9($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        if ($layout != 'style9')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="ht-clearfix vl-1-4-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_author == 'yes' || $display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    if ($display_author == 'yes') {
                                        echo viral_times_post_author();
                                    }

                                    if ($display_date == 'yes') {
                                        echo viral_times_post_date();
                                    }
                                    echo '</div>';
                                }
                                ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_times_excerpt(get_the_content(), 150); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <div class="vl-small-block-wrap">
                        <?php
                        $args = array(
                            'cat' => $cat,
                            'posts_per_page' => 4,
                            'ignore_sticky_posts' => true,
                            'offset' => 1
                        );

                        $query = new WP_Query($args);

                        while ($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="vl-post-item">
                                <div class="vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vl-thumb-container">
                                            <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                        </div>
                                    </a>
                                </div>

                                <div class="vl-post-content">
                                    <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php
                                    if ($display_date == 'yes') {
                                        echo '<div class="vl-post-metas">';
                                        echo viral_times_post_date();
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style10')) {

    function viral_times_news_section_style10($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        if ($layout != 'style10')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-list-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 4,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-post-item ht-clearfix">
                        <div class="vl-post-thumb vl-aligned-block">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                </div>
                            </a>
                            <?php
                            if ($display_cat == 'yes') {
                                echo viral_times_post_primary_category();
                            }
                            ?>
                        </div>

                        <div class="vl-post-content">
                            <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            if ($display_author == 'yes' || $display_date == 'yes') {
                                echo '<div class="vl-post-metas">';
                                if ($display_author == 'yes') {
                                    echo viral_times_post_author();
                                }

                                if ($display_date == 'yes') {
                                    echo viral_times_post_date();
                                }
                                echo '</div>';
                            }
                            ?>
                            <div class="vl-excerpt">
                                <?php echo viral_times_excerpt(get_the_content(), 200); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style11')) {

    function viral_times_news_section_style11($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $class = $display_cat == 'yes' ? 'vl-display-cat' : '';
        if ($layout != 'style11')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-news-block-alt <?php echo esc_attr($class); ?>">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x600'); ?>
                                    </div>

                                    <div class="vl-post-content vl-gradient-overlay">
                                        <h3 class="vl-big-title vl-post-title"><span><?php the_title(); ?></span></h3>
                                        <?php
                                        if ($display_author == 'yes' || $display_date == 'yes') {
                                            echo '<div class="vl-post-metas">';
                                            if ($display_author == 'yes') {
                                                echo viral_times_post_author();
                                            }

                                            if ($display_date == 'yes') {
                                                echo viral_times_post_date();
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </a>

                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 4,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vl-post-item ht-clearfix">
                            <div class="vl-post-thumb vl-aligned-block">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-150x150'); ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    echo viral_times_post_date();
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style12')) {

    function viral_times_news_section_style12($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        if ($layout != 'style12')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="ht-clearfix vl-1-2-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_author == 'yes' || $display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    if ($display_author == 'yes') {
                                        echo viral_times_post_author();
                                    }

                                    if ($display_date == 'yes') {
                                        echo viral_times_post_date();
                                    }
                                    echo '</div>';
                                }
                                ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_times_excerpt(get_the_content(), 180); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 2,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_author == 'yes' || $display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    if ($display_author == 'yes') {
                                        echo viral_times_post_author();
                                    }

                                    if ($display_date == 'yes') {
                                        echo viral_times_post_date();
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style13')) {

    function viral_times_news_section_style13($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        if ($layout != 'style13')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="vl-grid-2-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 6,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-post-item">
                        <div class="vl-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                </div>
                            </a>
                            <?php
                            if ($display_cat == 'yes') {
                                echo viral_times_post_primary_category();
                            }
                            ?>
                        </div>

                        <div class="vl-post-content">
                            <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            if ($display_author == 'yes' || $display_date == 'yes') {
                                echo '<div class="vl-post-metas">';
                                if ($display_author == 'yes') {
                                    echo viral_times_post_author();
                                }

                                if ($display_date == 'yes') {
                                    echo viral_times_post_date();
                                }
                                echo '</div>';
                            }
                            ?>
                            <div class="vl-excerpt">
                                <?php echo viral_times_excerpt(get_the_content(), 140); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_news_section_style14')) {

    function viral_times_news_section_style14($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        if ($layout != 'style14')
            return;
        ?>
        <div class="vl-news-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <div class="ht-clearfix vl-1-2-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <?php viral_times_post_featured_image('viral-times-500x500'); ?>
                                    </div>
                                </a>
                                <?php
                                if ($display_cat == 'yes') {
                                    echo viral_times_post_primary_category();
                                }
                                ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php
                                if ($display_author == 'yes' || $display_date == 'yes') {
                                    echo '<div class="vl-post-metas">';
                                    if ($display_author == 'yes') {
                                        echo viral_times_post_author();
                                    }

                                    if ($display_date == 'yes') {
                                        echo viral_times_post_date();
                                    }
                                    echo '</div>';
                                }
                                ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_times_excerpt(get_the_content(), 180); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 7,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-times-150x150')
                            ?>
                        <div class="vl-post-item">
                            <div class="vl-post-content">
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_carousel_section_style1')) {

    function viral_times_carousel_section_style1($args) {
        $title = $args['title'];
        $cats = $args['cat'];
        $layout = $args['layout'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $post_count = $args['post_count'];
        $slide_count = $args['slide_count'];
        $slide_pause = $args['slide_pause'];
        $auto_slide = $args['auto_slide'];
        $image_size = $args['image_size'];
        $title_size = $args['title_size'];
        $gap = $args['gap'];
        $auto_slide = $auto_slide == 'yes' ? 'true' : 'false';

        if ($layout != 'style1')
            return;

        $parameters = array(
            'items' => intval($slide_count),
            'autoplay' => $auto_slide,
            'pause' => intval($slide_pause),
            'margin' => intval($gap)
        );

        $parameters_json = json_encode($parameters);
        ?>

        <div class="vl-carousel-block <?php echo esc_attr($layout) ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <?php
            $args = array(
                'cat' => $cats,
                'posts_per_page' => $post_count,
                'ignore_sticky_posts' => true
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ?>
                <div class="vl-carousel-wrap">
                    <?php
                    echo '<div class="owl-carousel" data-params=' . $parameters_json . '>';
                    while ($query->have_posts()):
                        $query->the_post();
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="vl-carousel-item">
                                <div class="vl-carousel-thumb vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
                                        ?>
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]); ?>" />
                                    </a>
                                </div>
                                <div class="vl-carousel-heading">
                                    <?php
                                    if ($display_cat == 'yes') {
                                        echo viral_times_post_primary_category();
                                    }
                                    ?>
                                    <h3 class="vl-post-title <?php echo esc_attr($title_size); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php
                                    if ($display_author == 'yes' || $display_date == 'yes') {
                                        echo '<div class="vl-post-metas">';
                                        if ($display_author == 'yes') {
                                            echo viral_times_post_author();
                                        }

                                        if ($display_date == 'yes') {
                                            echo viral_times_post_date();
                                        }
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    <?php echo '</div>'; ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_carousel_section_style2')) {

    function viral_times_carousel_section_style2($args) {
        $title = $args['title'];
        $cats = $args['cat'];
        $layout = $args['layout'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $post_count = $args['post_count'];
        $slide_count = $args['slide_count'];
        $slide_pause = $args['slide_pause'];
        $auto_slide = $args['auto_slide'];
        $image_size = $args['image_size'];
        $title_size = $args['title_size'];
        $gap = $args['gap'];
        $auto_slide = $auto_slide == 'yes' ? 'true' : 'false';

        if ($layout != 'style2')
            return;

        $parameters = array(
            'items' => intval($slide_count),
            'autoplay' => $auto_slide,
            'pause' => intval($slide_pause),
            'margin' => intval($gap)
        );

        $parameters_json = json_encode($parameters);
        ?>

        <div class="vl-carousel-block <?php echo esc_attr($layout) ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <?php
            $args = array(
                'cat' => $cats,
                'posts_per_page' => $post_count,
                'ignore_sticky_posts' => true
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ?>
                <div class="vl-carousel-wrap">
                    <?php
                    echo '<div class="owl-carousel" data-params=' . $parameters_json . '>';
                    while ($query->have_posts()):
                        $query->the_post();
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="vl-carousel-item">
                                <div class="vl-carousel-thumb vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
                                        ?>
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]); ?>" />
                                    </a>

                                    <div class="vl-carousel-heading">
                                        <?php
                                        if ($display_cat == 'yes') {
                                            echo viral_times_post_primary_category();
                                        }
                                        ?>
                                        <h3 class="vl-post-title <?php echo esc_attr($title_size); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <?php
                                        if ($display_author == 'yes' || $display_date == 'yes') {
                                            echo '<div class="vl-post-metas">';
                                            if ($display_author == 'yes') {
                                                echo viral_times_post_author();
                                            }

                                            if ($display_date == 'yes') {
                                                echo viral_times_post_date();
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    <?php echo '</div>'; ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}

if (!function_exists('viral_times_carousel_section_style3')) {

    function viral_times_carousel_section_style3($args) {
        $title = $args['title'];
        $cats = $args['cat'];
        $layout = $args['layout'];
        $display_cat = $args['display_cat'];
        $display_author = $args['display_author'];
        $display_date = $args['display_date'];
        $post_count = $args['post_count'];
        $slide_count = $args['slide_count'];
        $slide_pause = $args['slide_pause'];
        $auto_slide = $args['auto_slide'];
        $image_size = $args['image_size'];
        $title_size = $args['title_size'];
        $gap = $args['gap'];
        $auto_slide = $auto_slide == 'yes' ? 'true' : 'false';

        if ($layout != 'style3')
            return;

        $parameters = array(
            'items' => intval($slide_count),
            'autoplay' => $auto_slide,
            'pause' => intval($slide_pause),
            'margin' => intval($gap)
        );

        $parameters_json = json_encode($parameters);
        ?>

        <div class="vl-carousel-block <?php echo esc_attr($layout) ?>">
            <?php if ($title) { ?>
                <div class="vl-block-header">
                    <h2 class="vl-block-title"><span class="vl-title"><?php echo esc_html($title); ?></span></h2>
                </div>
            <?php } ?>
            <?php
            $args = array(
                'cat' => $cats,
                'posts_per_page' => $post_count,
                'ignore_sticky_posts' => true
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ?>
                <div class="vl-carousel-wrap">
                    <?php
                    echo '<div class="owl-carousel" data-params=' . $parameters_json . '>';
                    while ($query->have_posts()):
                        $query->the_post();
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="vl-carousel-item">
                                <div class="vl-carousel-thumb vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
                                        ?>
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]); ?>" />
                                    </a>
                                </div>
                                <div class="vl-carousel-heading">
                                    <?php
                                    if ($display_cat == 'yes') {
                                        echo viral_times_post_primary_category();
                                    }
                                    ?>
                                    <h3 class="vl-post-title <?php echo esc_attr($title_size); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php
                                    if ($display_author == 'yes' || $display_date == 'yes') {
                                        echo '<div class="vl-post-metas">';
                                        if ($display_author == 'yes') {
                                            echo viral_times_post_author();
                                        }

                                        if ($display_date == 'yes') {
                                            echo viral_times_post_date();
                                        }
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    <?php echo '</div>'; ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}