<?php
/**
 * Template Name: Home Page
 *
 * @package Viral Times
 */

get_header();

$sections = viral_times_frontpage_sections();

foreach ($sections as $section) {
    $section();
}

get_footer();
