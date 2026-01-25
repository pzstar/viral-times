<?php

/**
 * The template for displaying all single posts.
 *
 * @package Viral Times
 */
get_header();

$viral_times_single_layout = get_theme_mod('viral_times_single_layout', 'layout7');

do_action('viral_times_before_single_container');

get_template_part('template-parts/single/single', $viral_times_single_layout);

get_footer();
