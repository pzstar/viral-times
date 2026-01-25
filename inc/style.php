<?php

/**
 * @package Viral Times
 */
function viral_times_dymanic_styles() {
    $custom_css = $tablet_css = $mobile_css = "";
    $color = get_theme_mod('viral_times_template_color', '#f97c00');
    $darker_color = viral_times_color_brightness($color, -0.9);
    $container_width = get_theme_mod('viral_times_website_width', 1170);
    $fluid_container_width = get_theme_mod('viral_times_fluid_container_width', 80);
    $container_padding = get_theme_mod('viral_times_container_padding', 80);
    $container_width_200 = $container_width + 200;
    $sidebar_width = get_theme_mod('viral_times_sidebar_width', 30);
    $primary_width = 100 - 4 - $sidebar_width;
    $boxed_container_width = $container_width + $container_padding + $container_padding;
    $preloader_color = get_theme_mod('viral_times_preloader_color', '#000000');
    $preloader_bg_color = get_theme_mod('viral_times_preloader_bg_color', '#FFFFFF');
    $responsive_width = get_theme_mod('viral_times_responsive_width', 780);

    /* =============== Full & Boxed width =============== */
    $custom_css .= "
	.ht-container{
            max-width:{$container_width}px; 
	}
	body.ht-boxed #ht-page{
            max-width:{$boxed_container_width}px;
	}
    body.ht-fluid .ht-container{
            max-width:{$fluid_container_width}%;
	}
    #primary{ width:{$primary_width}%}
    #secondary{ width:{$sidebar_width}%}
    .ht-boxed .ht-fullwidth-container,
    .ht-boxed .vl-fwcarousel-block {
        margin-left: -{$container_padding}px !important;
        margin-right: -{$container_padding}px !important;
    }
	";

    /* =============== Typography CSS =============== */
    $fonts = viral_times_get_customizer_fonts();
    $font_class = array(
        'body' => 'html, body, button, input, select, textarea',
        'menu' => '.ht-menu > ul > li > a, a.ht-header-bttn',
        'frontpage_title' => 'h3.vl-post-title',
        'frontpage_block_title' => '.vl-block-title span.vl-title, .vp-block-title span.vl-title',
        'page_title' => '.ht-main-title, .single-post .entry-title',
        'h' => 'h1, h2, h3, h4, h5, h6, .ht-site-title'
    );

    foreach ($fonts as $key => $value) {
        $font_css = array();
        $font_family = get_theme_mod($key . '_font_family', $value['font_family']);
        $font_style = get_theme_mod($key . '_font_style', $value['font_style']);
        $text_transform = get_theme_mod($key . '_text_transform', $value['text_transform']);
        $text_decoration = get_theme_mod($key . '_text_decoration', $value['text_decoration']);
        if ($key != 'h') {
            $font_size = get_theme_mod($key . '_font_size', $value['font_size']);
        }
        $line_height = get_theme_mod($key . '_line_height', $value['line_height']);
        $letter_spacing = get_theme_mod($key . '_letter_spacing', $value['letter_spacing']);
        if ($key == 'body' || $key == 'page_title' || $key == 'title' || $key == 'tagline') {
            $font_color = get_theme_mod($key . '_color', $value['color']);
        }
        $font_italic = 'normal';

        if (strpos($font_style, 'italic')) {
            $font_italic = 'italic';
        }

        $font_weight = absint($font_style);

        $font_css[] = (!empty($font_family) && "Default" != $font_family) ? "font-family: '{$font_family}', serif" : '';
        $font_css[] = !empty($font_weight) ? "font-weight: {$font_weight}" : '';
        $font_css[] = !empty($font_italic) ? "font-style: {$font_italic}" : '';
        $font_css[] = !empty($text_transform) ? "text-transform: {$text_transform}" : '';
        $font_css[] = !empty($text_decoration) ? "text-decoration: {$text_decoration}" : '';
        if ($key != 'h') {
            $font_css[] = !empty($font_size) ? "font-size: {$font_size}px" : '';
        }
        $font_css[] = !empty($line_height) ? "line-height: {$line_height}" : '';
        $font_css[] = !empty($letter_spacing) ? "letter-spacing: {$letter_spacing}px" : '';
        if ($key == 'body' || $key == 'page_title' || $key == 'title' || $key == 'tagline') {
            $font_css[] = !empty($font_color) ? "color: {$font_color}" : '';
        }

        $font_style = implode(';', $font_css);

        $custom_css .= "
            $font_class[$key]{{$font_style}}";
    }


    $h1_font_size = get_theme_mod('hh1_font_size', 38);
    $h2_font_size = get_theme_mod('hh2_font_size', 34);
    $h3_font_size = get_theme_mod('hh3_font_size', 30);
    $h4_font_size = get_theme_mod('hh4_font_size', 26);
    $h5_font_size = get_theme_mod('hh5_font_size', 22);
    $h6_font_size = get_theme_mod('hh6_font_size', 18);

    $custom_css .= "h1, .ht-site-title{font-size:{$h1_font_size}px}";
    $custom_css .= "h2{font-size:{$h2_font_size}px}";
    $custom_css .= "h3{font-size:{$h3_font_size}px}";
    $custom_css .= "h4{font-size:{$h4_font_size}px}";
    $custom_css .= "h5{font-size:{$h5_font_size}px}";
    $custom_css .= "h6{font-size:{$h6_font_size}px}";

    $i_font_size = get_theme_mod('menu_font_size', 14);
    $i_font_family = get_theme_mod('menu_font_family', 'Default');
    $frontpage_block_title_lineheight = get_theme_mod('frontpage_block_title', 1);
    $custom_css .= "
	.ht-main-navigation,
        .menu-item-megamenu .widget-title,
        .menu-item-megamenu .vl-block-title span.vl-title{
        font-size: {$i_font_size}px;
        font-family: $i_font_family;
	}
        
    .single-ht-megamenu .ht-main-content{
    font-family: $i_font_family;
    }
    
    .vp-block-filter{
        line-height: $frontpage_block_title_lineheight;
    }
	";

    $content_header_color = get_theme_mod('viral_times_content_header_color', '#000000');
    $content_text_color = get_theme_mod('viral_times_content_text_color', '#333333');
    $content_link_color = get_theme_mod('viral_times_content_link_color', '#000000');
    $content_link_hov_color = get_theme_mod('viral_times_content_link_hov_color', '#f97c00');
    $content_widget_title_color = get_theme_mod('viral_times_content_widget_title_color', '#000000');
    $content_light_color = viral_times_hex2rgba($content_text_color, 0.1);
    $content_lighter_color = viral_times_hex2rgba($content_text_color, 0.05);

    $custom_css .= ".ht-main-content h1, .ht-main-content h2, .ht-main-content h3, .ht-main-content h4, .ht-main-content h5, .ht-main-content h6 {color:$content_header_color}";
    $custom_css .= ".ht-main-content{color:$content_text_color}";
    $custom_css .= "a{color:$content_link_color}";
    $custom_css .= "a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .breadcrumb-trail a:hover{color:$content_link_hov_color}";
    $custom_css .= ".ht-sidebar-style1 .ht-site-wrapper .widget-area ul ul, .ht-sidebar-style1 .ht-site-wrapper .widget-area li{border-color:$content_lighter_color}";
    $custom_css .= ".ht-sidebar-style2 .ht-site-wrapper .widget, .ht-sidebar-style2 .ht-site-wrapper .widget-title, .ht-sidebar-style3 .ht-site-wrapper .widget, .ht-sidebar-style5 .ht-site-wrapper .widget, .ht-sidebar-style7 .ht-site-wrapper .widget, .ht-sidebar-style7 .ht-site-wrapper .widget-title, .comment-list .sp-comment-content, .post-navigation, .post-navigation .nav-next, .ht-social-share{border-color:$content_light_color}";
    $custom_css .= ".ht-sidebar-style5 .ht-site-wrapper .widget-title:before, .ht-sidebar-style5 .ht-site-wrapper .widget-title:after{background-color:$content_light_color}";
    $custom_css .= ".single-entry-tags a, .widget-area .tagcloud a{border-color:$content_text_color}";
    $custom_css .= ".ht-sidebar-style3 .ht-site-wrapper .widget{background:$content_lighter_color}";
    $custom_css .= ".ht-main-content .widget-title{color:$content_widget_title_color}";
    $custom_css .= ".ht-sidebar-style1 .ht-site-wrapper .widget-title:after, .ht-sidebar-style3 .ht-site-wrapper .widget-title:after, .ht-sidebar-style6 .ht-site-wrapper .widget-title:after, .ht-sidebar-style7 .ht-site-wrapper .widget:before {background-color:$content_widget_title_color}";


    /* =============== FrontPage Section Advanced CSS =============== */
    $home_sections = viral_times_frontpage_sections();

    foreach ($home_sections as $home_section) {
        $sectionname = str_replace(array('viral_times_frontpage_', '_section'), array('', ''), $home_section);
        $sectionid = '#ht-' . $sectionname . '-section';
        $sectionclass = '.ht-' . $sectionname . '-section';
        $sectioncolor = get_theme_mod('viral_times_' . $sectionname . '_text_color', '#333333');
        $sectiontoppadding = get_theme_mod('viral_times_' . $sectionname . '_padding_top', '20');
        $sectionbottompadding = get_theme_mod('viral_times_' . $sectionname . '_padding_bottom', '20');
        $sectiontoppadding_tablet = get_theme_mod('viral_times_' . $sectionname . '_tablet_padding_top');
        $sectionbottompadding_tablet = get_theme_mod('viral_times_' . $sectionname . '_tablet_padding_bottom');
        $sectiontoppadding_mobile = get_theme_mod('viral_times_' . $sectionname . '_mobile_padding_top');
        $sectionbottompadding_mobile = get_theme_mod('viral_times_' . $sectionname . '_mobile_padding_bottom');
        $sectiontopmargin = get_theme_mod('viral_times_' . $sectionname . '_margin_top');
        $sectionbottommargin = get_theme_mod('viral_times_' . $sectionname . '_margin_bottom');
        $sectiontopmargin_tablet = get_theme_mod('viral_times_' . $sectionname . '_tablet_margin_top');
        $sectionbottommargin_tablet = get_theme_mod('viral_times_' . $sectionname . '_tablet_margin_bottom');
        $sectiontopmargin_mobile = get_theme_mod('viral_times_' . $sectionname . '_mobile_margin_top');
        $sectionbottommargin_mobile = get_theme_mod('viral_times_' . $sectionname . '_mobile_margin_bottom');
        $top_seperator_height = get_theme_mod('viral_times_' . $sectionname . '_ts_height', 60);
        $bottom_seperator_height = get_theme_mod('viral_times_' . $sectionname . '_bs_height', 60);
        $top_seperator_height_tablet = get_theme_mod('viral_times_' . $sectionname . '_ts_height_tablet');
        $bottom_seperator_height_tablet = get_theme_mod('viral_times_' . $sectionname . '_bs_height_tablet');
        $top_seperator_height_mobile = get_theme_mod('viral_times_' . $sectionname . '_ts_height_mobile');
        $bottom_seperator_height_mobile = get_theme_mod('viral_times_' . $sectionname . '_bs_height_mobile');
        $sectionfullheight = get_theme_mod('viral_times_' . $sectionname . '_enable_fullwindow', 'off');
        $sectionbgtype = get_theme_mod('viral_times_' . $sectionname . '_bg_type', 'color-bg');
        $sectionbgimage = get_theme_mod('viral_times_' . $sectionname . '_bg_image_url');
        $sectionbgimage_repeat = get_theme_mod('viral_times_' . $sectionname . '_bg_image_repeat', 'no-repeat');
        $sectionbgimage_size = get_theme_mod('viral_times_' . $sectionname . '_bg_image_size', 'cover');
        $sectionbgimage_position = get_theme_mod('viral_times_' . $sectionname . '_bg_position', 'center-center');
        $sectionbgimage_position = str_replace('-', ' ', $sectionbgimage_position);
        $sectionbgimage_attach = get_theme_mod('viral_times_' . $sectionname . '_bg_image_attach', 'fixed');
        $sectionbgoverlay = get_theme_mod('viral_times_' . $sectionname . '_overlay_color', 'rgba(255,255,255,0)');
        $sectionalignitem = get_theme_mod('viral_times_' . $sectionname . '_align_item', 'top');

        $css = $css1 = array();

        if ($sectionbgtype == 'color-bg' || $sectionbgtype == 'image-bg') {
            $sectionbgcolor = get_theme_mod('viral_times_' . $sectionname . '_bg_color', '#FFFFFF');
            $css[] = "background-color: $sectionbgcolor";
        }

        if ($sectionbgtype == 'image-bg' && !empty($sectionbgimage)) {
            $css[] = "background-image: url($sectionbgimage)";
            $css[] = "background-size: {$sectionbgimage_size}";
            $css[] = "background-position: {$sectionbgimage_position}";
            $css[] = "background-attachment: {$sectionbgimage_attach}";
            $css[] = "background-repeat: {$sectionbgimage_repeat}";
            if (!empty($sectionbgoverlay)) {
                $css1[] = "background-color: $sectionbgoverlay";
            }
        } elseif ($sectionbgtype == 'video-bg') {
            if (!empty($sectionbgoverlay)) {
                $css1[] = "background-color: $sectionbgoverlay";
            }
        } elseif ($sectionbgtype == 'gradient-bg') {
            $sectiongradientcolor = get_theme_mod('viral_times_' . $sectionname . '_bg_gradient');
            $css[] = "$sectiongradientcolor";
        }

        $custom_css .= "$sectionclass{" . implode(';', $css) . "}";

        if ($sectionfullheight == 'on') {
            $css1[] = "min-height:100vh";
            $css1[] = "display: -webkit-flex";
            $css1[] = "display: -ms-flexbox";
            $css1[] = "display: flex";
            $css1[] = "overflow: hidden";
            $css1[] = "flex-wrap: wrap";
            if ($sectionalignitem == 'top') {
                $css1[] = "align-items: flex-start";
            } elseif ($sectionalignitem == 'middle') {
                $css1[] = "align-items: center";
            } elseif ($sectionalignitem == 'bottom') {
                $css1[] = "align-items: flex-end";
            }
        }

        if (!empty($sectiontoppadding)) {
            $css1[] = "padding-top: {$sectiontoppadding}px";
        }

        if (!empty($sectionbottompadding)) {
            $css1[] = "padding-bottom: {$sectionbottompadding}px";
        }

        if (!empty($sectiontopmargin)) {
            $css1[] = "margin-top: {$sectiontopmargin}px";
        }

        if (!empty($sectionbottommargin)) {
            $css1[] = "margin-bottom: {$sectionbottommargin}px";
        }

        $css1[] = "color: $sectioncolor";

        $custom_css .= "$sectionclass .ht-section-wrap{" . implode(';', $css1) . "}";

        $title_color = get_theme_mod("viral_times_{$sectionname}_title_color", '#333333');
        $link_color = get_theme_mod("viral_times_{$sectionname}_link_color");

        if ($title_color) {
            $custom_css .= "$sectionclass h1,$sectionclass h2,$sectionclass h3,$sectionclass h4,$sectionclass h5,$sectionclass h6{color:$title_color}";
        }

        if ($link_color) {
            $custom_css .= "$sectionclass a{color:$link_color}";
        }

        $block_title_color = get_theme_mod("viral_times_{$sectionname}_block_title_color", '#333333');
        $block_title_background_color = get_theme_mod("viral_times_{$sectionname}_block_title_background_color", '#f97c00');
        $block_title_border_color = get_theme_mod("viral_times_{$sectionname}_block_title_border_color", '#f97c00');

        $custom_css .= "
            {$sectionclass}.ht-overwrite-color .vl-block-title span.vl-title{color:$block_title_color}
            .ht-block-title-style2 {$sectionclass}.ht-overwrite-color .vl-block-title:after, .ht-block-title-style5 {$sectionclass}.ht-overwrite-color .vl-block-title span.vl-title:before, .ht-block-title-style7 {$sectionclass}.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style8 {$sectionclass}.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style9 {$sectionclass}.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style9 {$sectionclass}.ht-overwrite-color .vl-block-title span.vl-title:before, .ht-block-title-style10 {$sectionclass}.ht-overwrite-color .vl-block-header, .ht-block-title-style11 {$sectionclass}.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style12 {$sectionclass}.ht-overwrite-color .vl-block-title{background-color:$block_title_background_color}
            .ht-block-title-style8 {$sectionclass}.ht-overwrite-color .vl-block-header, .ht-block-title-style9 {$sectionclass}.ht-overwrite-color .vl-block-header, .ht-block-title-style11 {$sectionclass}.ht-overwrite-color .vl-block-header{border-color:$block_title_background_color}
            .ht-block-title-style10 {$sectionclass}.ht-overwrite-color .vl-block-title:before{border-color: $block_title_background_color $block_title_background_color transparent transparent}
            ";

        $custom_css .= "
            .ht-block-title-style2 {$sectionclass}.ht-overwrite-color .vl-block-title, .ht-block-title-style3 {$sectionclass}.ht-overwrite-color .vl-block-header, .ht-block-title-style5 {$sectionclass}.ht-overwrite-color .vl-block-header{border-color:$block_title_border_color}
            .ht-block-title-style4 {$sectionclass}.ht-overwrite-color .vl-block-title:after, .ht-block-title-style6 {$sectionclass}.ht-overwrite-color .vl-block-title:before, .ht-block-title-style6 {$sectionclass}.ht-overwrite-color .vl-block-title:after, .ht-block-title-style7 {$sectionclass}.ht-overwrite-color .vl-block-title:after{background-color:$block_title_border_color}
            ";

        if (!empty($sectiontoppadding_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-wrap{padding-top: {$sectiontoppadding_tablet}px}";
        }

        if (!empty($sectionbottompadding_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-wrap{padding-bottom: {$sectionbottompadding_tablet}px}";
        }

        if (!empty($sectiontoppadding_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-wrap{padding-top: {$sectiontoppadding_mobile}px}";
        }

        if (!empty($sectionbottompadding_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-wrap{padding-bottom: {$sectionbottompadding_mobile}px}";
        }

        if (!empty($sectiontopmargin_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-wrap{margin-top: {$sectiontopmargin_tablet}px}";
        }

        if (!empty($sectionbottommargin_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-wrap{margin-bottom: {$sectionbottommargin_tablet}px}";
        }

        if (!empty($sectiontopmargin_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-wrap{margin-top: {$sectiontopmargin_mobile}px}";
        }

        if (!empty($sectionbottommargin_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-wrap{margin-bottom: {$sectionbottommargin_mobile}px}";
        }

        if (!empty($top_seperator_height)) {
            $custom_css .= "$sectionclass .ht-section-seperator.top-section-seperator{height: {$top_seperator_height}px}";
        }

        if (!empty($bottom_seperator_height)) {
            $custom_css .= "$sectionclass .ht-section-seperator.bottom-section-seperator{height: {$bottom_seperator_height}px}";
        }

        if (!empty($top_seperator_height_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-seperator.top-section-seperator{height: {$top_seperator_height_tablet}px}";
        }

        if (!empty($bottom_seperator_height_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-seperator.bottom-section-seperator{height: {$bottom_seperator_height_tablet}px}";
        }

        if (!empty($top_seperator_height_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-seperator.top-section-seperator{height: {$top_seperator_height_mobile}px}";
        }

        if (!empty($bottom_seperator_height_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-seperator.bottom-section-seperator{height: {$bottom_seperator_height_mobile}px}";
        }

        $section_seperator = get_theme_mod("viral_times_{$sectionname}_section_seperator");
        $top_seperator_color = get_theme_mod("viral_times_{$sectionname}_ts_color", '#FF0000');
        $bottom_seperator_color = get_theme_mod("viral_times_{$sectionname}_bs_color", '#FF0000');

        if ($section_seperator == 'top' || $section_seperator == 'top-bottom') {
            $custom_css .= "$sectionclass .top-section-seperator svg{ fill:$top_seperator_color }";
        }
        if ($section_seperator == 'bottom' || $section_seperator == 'top-bottom') {
            $custom_css .= "$sectionclass .bottom-section-seperator svg{ fill:$bottom_seperator_color }";
        }
    }

    /* =============== Header CSS =============== */
    $mh_button_color = get_theme_mod('viral_times_mh_button_color', '#000000');
    $th_bg_color = get_theme_mod('viral_times_th_bg_color', '#f97c00');
    $th_bottom_border_color = get_theme_mod('viral_times_th_bottom_border_color');
    $th_text_color = get_theme_mod('viral_times_th_text_color', '#FFFFFF');
    $th_anchor_color = get_theme_mod('viral_times_th_anchor_color', '#EEEEEE');
    $th_height = get_theme_mod('viral_times_th_height', 45);
    $mh_height = get_theme_mod('viral_times_mh_height', 65);
    $mh_half_height = $mh_height / 2;
    $mh_bg_color = get_theme_mod('viral_times_mh_bg_color', '#f97c00');
    $mh_bg_color_mobile = get_theme_mod('viral_times_mh_bg_color_mobile', '#f97c00');
    $mh_border_color = get_theme_mod('viral_times_mh_border_color', '#EEEEEE');
    $mh_menu_color = get_theme_mod('viral_times_mh_menu_color', '#FFFFFF');
    $mh_menu_hover_color = get_theme_mod('viral_times_mh_menu_hover_color', '#FFFFFF');
    $mh_menu_hover_bg_color = get_theme_mod('viral_times_mh_menu_hover_bg_color', '#f97c00');
    $mh_submenu_bg_color = get_theme_mod('viral_times_mh_submenu_bg_color', '#F2F2F2');
    $mh_submenu_color = get_theme_mod('viral_times_mh_submenu_color', '#333333');
    $mh_submenu_hover_color = get_theme_mod('viral_times_mh_submenu_hover_color', '#333333');
    $menu_dropdown_padding = get_theme_mod('viral_times_menu_dropdown_padding', 0);
    $logo_height = $mh_height - 30;
    $header6_height = $th_height + $mh_half_height;
    $header6_single_bottom_margin = 40 - $mh_half_height;
    $logo_actual_height = get_theme_mod('viral_times_logo_height', 60);
    $logo_min_height = min($logo_height, $logo_actual_height);
    $logo_padding = get_theme_mod('viral_times_logo_padding', 15);

    if ($th_bottom_border_color) {
        $custom_css .= "
            .ht-site-header .ht-top-header{
                border-bottom: 1px solid $th_bottom_border_color;
            }";
    }

    $custom_css .= "
        .ht-site-header .ht-top-header{
            background: $th_bg_color;
            color: $th_text_color;
        }
        
        .th-menu ul ul{
            background: $th_bg_color;
        }
        
        .ht-site-header .ht-top-header .ht-container{
            height: {$th_height}px;
        }
        
        .th-menu > ul > li > a{
            line-height: {$th_height}px;
        }
        
        .ht-top-header-on .ht-header-six.ht-site-header{
            margin-bottom: -{$mh_half_height}px;
        }
        
        .ht-top-header-on.ht-single-layout1 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout2 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout7 .ht-header-six.ht-site-header{
            margin-bottom: {$header6_single_bottom_margin}px;
        }
        
        .ht-top-header-on.ht-single-layout3 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout4 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout5 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout6 .ht-header-six.ht-site-header{
            margin-bottom: -{$mh_height}px;
        }
        
        .ht-header-six.ht-site-header .ht-top-header{
            height: {$header6_height}px;
        }

        .ht-site-header .ht-top-header a,
        .ht-site-header .ht-top-header a:hover,
        .ht-site-header .ht-top-header a i,
        .ht-site-header .ht-top-header a:hover i{
            color: $th_anchor_color;
        }

        .ht-header-one .ht-header,
        .ht-header-two .ht-header,
        .ht-header-three .ht-header,
        .ht-header-four .ht-header .ht-container,
        .ht-header-five .ht-header,
        .ht-header-six .ht-header .ht-container,
        .ht-header-seven .ht-header,
        .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top,
        .ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top{
            background: $mh_bg_color;
        }
        
        .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top .ht-container,
        .ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top .ht-container{
            background: none;
        }

        .ht-header-one .ht-header .ht-container,
        .ht-header-two .ht-header .ht-container,
        .ht-header-three .ht-header .ht-container,
        .ht-header-four .ht-header .ht-container,
        .ht-header-five .ht-header .ht-container,
        .ht-header-six .ht-header .ht-container,
        .ht-header-seven .ht-header .ht-container{
            height: {$mh_height}px;
        }

        .hover-style5 .ht-menu > ul > li.menu-item > a,
        .hover-style6 .ht-menu > ul > li.menu-item > a,
        .hover-style5 .ht-header-bttn,
        .hover-style6 .ht-header-bttn{
            line-height: {$mh_height}px;
        }
        
        #ht-site-branding img{
            height:{$logo_actual_height}px;
        }
        
        .ht-header-one #ht-site-branding img,
        .ht-header-three #ht-site-branding img,
        .ht-header-six #ht-site-branding img{
            max-height: {$logo_height}px;
        }
            
        .ht-header-two #ht-site-branding, 
        .ht-header-four #ht-site-branding, 
        .ht-header-five #ht-site-branding, 
        .ht-header-seven #ht-site-branding{
            padding-top:{$logo_padding}px;
            padding-bottom:{$logo_padding}px
        }
        
        .ht-site-header.ht-header-one .ht-header,
        .ht-site-header.ht-header-two .ht-header,
        .ht-site-header.ht-header-three .ht-header,
        .ht-site-header.ht-header-four .ht-header .ht-container,
        .ht-site-header.ht-header-five .ht-header,
        .ht-site-header.ht-header-six .ht-header .ht-container,
        .ht-site-header.ht-header-seven .ht-header{
            border-color: {$mh_border_color};
        }
        
        .ht-menu > ul > li.menu-item > a,
        .ht-search-button a,
        .ht-header-social-icons a,
        .hover-style1 .ht-search-button a:hover,
        .hover-style3 .ht-search-button a:hover,
        .hover-style5 .ht-search-button a:hover,
        .hover-style1 .ht-header-social-icons a:hover,
        .hover-style3 .ht-header-social-icons a:hover,
        .hover-style5 .ht-header-social-icons a:hover{
            color: $mh_menu_color;
        }
        
        .ht-offcanvas-nav a>span,
        .hover-style1 .ht-offcanvas-nav a:hover>span,
        .hover-style3 .ht-offcanvas-nav a:hover>span,
        .hover-style5 .ht-offcanvas-nav a:hover>span{
            background-color: $mh_menu_color;
        }
        
        .ht-search-button a:hover,
        .ht-header-social-icons a:hover,
        .hover-style1 .ht-menu > ul> li.menu-item:hover > a,
        .hover-style1 .ht-menu > ul> li.menu-item.current_page_item > a, 
        .hover-style1 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .ht-menu > ul > li.menu-item:hover > a,
        .ht-menu > ul > li.menu-item:hover > a > i,
        .ht-menu > ul > li.menu-item.current_page_item > a,
        .ht-menu > ul > li.menu-item.current-menu-item > a,
        .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .ht-menu > ul > li.menu-item.current > a{
            color: $mh_menu_hover_color;
        }
        
        .ht-offcanvas-nav a:hover>span{
            background-color: $mh_menu_hover_color;
        }

        .ht-menu ul ul,
        .menu-item-ht-cart .widget_shopping_cart,
        #ht-responsive-menu{
            background: $mh_submenu_bg_color;
        }
        
        .ht-menu .megamenu *,
        #ht-responsive-menu .megamenu *,
        .ht-menu .megamenu a,
        #ht-responsive-menu .megamenu a,
        .ht-menu ul ul li.menu-item > a,
        .menu-item-ht-cart .widget_shopping_cart a,
        .menu-item-ht-cart .widget_shopping_cart,
        #ht-responsive-menu li.menu-item > a,
        #ht-responsive-menu li.menu-item > a i,
        #ht-responsive-menu li .dropdown-nav,
        .megamenu-category .mega-post-title a{
            color: $mh_submenu_color;
        }

        li.megamenu-category > a .dropdown-nav {
            display: none;
        }
        
        .ht-menu .megamenu a:hover,
        #ht-responsive-menu .megamenu a:hover,
        .ht-menu .megamenu a:hover > i,
        #ht-responsive-menu .megamenu a:hover > i,
        .ht-menu > ul > li > ul:not(.megamenu) li.menu-item:hover > a,
        .ht-menu ul ul.megamenu li.menu-item > a:hover,
        .ht-menu ul ul li.menu-item > a:hover i,
        .menu-item-ht-cart .widget_shopping_cart a:hover,
        .ht-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab > div.active-tab,
        .ht-menu .megamenu-full-width.megamenu-category .mega-post-title a:hover{
            color: $mh_submenu_hover_color;
        }
        
        .ht-menu ul ul li.menu-item>a:after{
            background: $mh_submenu_hover_color;
        }

        .hover-style1 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current > a,
        .hover-style5 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current > a{
            background: $mh_menu_hover_bg_color;
        }

        .hover-style2 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current > a,
        .hover-style4 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current > a{
            color: $mh_menu_hover_color;
            border-color: $mh_menu_hover_color;
        }
        
        .hover-style6 .ht-menu > ul > li.menu-item:hover > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current_page_item > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current-menu-item > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current_page_ancestor > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current > a:before,
        .hover-style8 .ht-menu>ul>li.menu-item>a:before,
        .hover-style9 .ht-menu>ul>li.menu-item>a:before{
            background: $mh_menu_hover_color;
        }
        
        .hover-style7 .ht-menu>ul>li.menu-item>a:before{
            border-left-color: $mh_menu_hover_color;
            border-top-color: $mh_menu_hover_color;
        }
        
        .hover-style7 .ht-menu>ul>li.menu-item>a:after{
            border-right-color: $mh_menu_hover_color;
            border-bottom-color: $mh_menu_hover_color;
        }
        
        .rtl .hover-style7 .ht-menu>ul>li.menu-item>a:before{
            border-right-color: $mh_menu_hover_color;
        }

        .rtl .hover-style7 .ht-menu>ul>li.menu-item>a:after{
            border-left-color: $mh_menu_hover_color;
        }   

        .hover-style3 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current > a{
            background: $mh_menu_hover_bg_color;
        }
        
        .ht-menu>ul>li.menu-item{
            padding-top: {$menu_dropdown_padding}px;
            padding-bottom: {$menu_dropdown_padding}px;
        }
        
        .ht-header-two .ht-middle-header-left a,
        .ht-header-two .ht-middle-header-right>div>a{
            color: {$mh_button_color} !important;
        }
        
        .ht-header-two .ht-offcanvas-nav a>span{
            background: {$mh_button_color} !important;
        }
    ";

    $mh_header_bg_url = get_theme_mod('viral_times_mh_header_bg_url');
    $mh_header_bg_repeat = get_theme_mod('viral_times_mh_header_bg_repeat', 'no-repeat');
    $mh_header_bg_size = get_theme_mod('viral_times_mh_header_bg_size', 'cover');
    $mh_header_bg_position = get_theme_mod('viral_times_mh_header_bg_position', 'center-center');
    $mh_header_bg_position = str_replace('-', ' ', $mh_header_bg_position);
    $mh_header_bg_attach = get_theme_mod('viral_times_mh_header_bg_attach', 'scroll');
    $mh_header_bg_overlay = get_theme_mod('viral_times_mh_header_bg_overlay');
    $mh_header_bg_color = get_theme_mod('viral_times_mh_header_bg_color', '#FFFFFF');

    if ($mh_header_bg_url) {
        $custom_css .= "
        .ht-header-two,
        .ht-header-four,
        .ht-header-five,
        .ht-header-seven{
        background-image: url($mh_header_bg_url);
        background-repeat: $mh_header_bg_repeat;
        background-size: $mh_header_bg_size;
        background-position: $mh_header_bg_position;
        background-attachment: $mh_header_bg_attach;
        }";
    }

    if ($mh_header_bg_color) {
        $custom_css .= "
        .ht-header-two,
        .ht-header-four,
        .ht-header-five,
        .ht-header-seven{
        background-color: $mh_header_bg_color;
        }";
    }

    if ($mh_header_bg_overlay) {
        $custom_css .= "
        .ht-header-two:before,
        .ht-header-four:before,
        .ht-header-five:before,
        .ht-header-seven:before{
            background : $mh_header_bg_overlay;
        }";
    }

    /* =============== Block Title Style =============== */
    $block_title_color = get_theme_mod('viral_times_block_title_color', '#333333');
    $block_title_background_color = get_theme_mod('viral_times_block_title_background_color', '#f97c00');
    $block_title_border_color = get_theme_mod('viral_times_block_title_border_color', '#333333');

    $custom_css .= "
        .vl-block-title span.vl-title{color:$block_title_color}
        .ht-block-title-style2 .vl-block-header .vl-block-title:after, .ht-block-title-style5 .vl-block-header .vl-block-title span.vl-title:before, .ht-block-title-style7 .vl-block-header .vl-block-title span.vl-title, .ht-block-title-style8 .vl-block-header .vl-block-title span.vl-title, .ht-block-title-style9 .vl-block-header .vl-block-title span.vl-title, .ht-block-title-style10 .vl-block-header, .ht-block-title-style11 .vl-block-header .vl-block-title span.vl-title, .ht-block-title-style12 .vl-block-header{background-color:$block_title_background_color}
        .ht-block-title-style8 .vl-block-header, .ht-block-title-style9 .vl-block-header, .ht-block-title-style11 .vl-block-header{border-color:$block_title_background_color}
        .ht-block-title-style10 .vl-block-header .vl-block-title:before{border-color: $block_title_background_color $block_title_background_color transparent transparent}
    ";
    $custom_css .= "
        .ht-block-title-style2 .vl-block-header .vl-block-title, .ht-block-title-style2 .vl-block-header .vp-block-filter, .ht-block-title-style3 .vl-block-header, .ht-block-title-style5 .vl-block-header{border-color:$block_title_border_color}
        .ht-block-title-style4 .vl-block-header .vl-block-title:after, .ht-block-title-style6 .vl-block-header .vl-block-title:before, .ht-block-title-style6 .vl-block-header .vl-block-title:after, .ht-block-title-style7 .vl-block-header .vl-block-title:after{background-color:$block_title_border_color}
    ";

    /* =============== Background Color =============== */
    $custom_css .= "
        button,
        input[type='button'],
        input[type='reset'],
        input[type='submit'],
        .ht-button,
        .comment-navigation .nav-previous a,
        .comment-navigation .nav-next a,
        .pagination .page-numbers,
        .ht-progress-bar-length,
        .ht-main-content .entry-readmore a,
        .blog-layout2 .entry-date,
        .blog-layout4 .ht-post-date,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce ul.products li.product:hover .viral-times-product-title-wrap .button,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce nav.woocommerce-pagination ul li a,
        .woocommerce nav.woocommerce-pagination ul li span,
        .woocommerce span.onsale,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce #respond input#submit.disabled,
        .woocommerce #respond input#submit:disabled,
        .woocommerce #respond input#submit:disabled[disabled],
        .woocommerce a.button.disabled, .woocommerce a.button:disabled,
        .woocommerce a.button:disabled[disabled],
        .woocommerce button.button.disabled,
        .woocommerce button.button:disabled,
        .woocommerce button.button:disabled[disabled],
        .woocommerce input.button.disabled,
        .woocommerce input.button:disabled,
        .woocommerce input.button:disabled[disabled],
        .woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt:disabled[disabled],
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt:disabled[disabled],
        .woocommerce a.button.alt:disabled[disabled]:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt:disabled[disabled],
        .woocommerce button.button.alt:disabled[disabled]:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt:disabled[disabled],
        .woocommerce input.button.alt:disabled[disabled]:hover,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
        .woocommerce-MyAccount-navigation-link a,
        .ht-style2-accordion .ht-accordion-header,
        .ht-pt-header .ht-pt-tab.ht-pt-active,
        .ht-post-listing .ht-pl-count,
        .vl-post-categories li a.vl-category,
        .vl-slider-block .owl-carousel .owl-nav .owl-prev:hover, 
        .vl-slider-block .owl-carousel .owl-nav .owl-next:hover,
        .vl-fwcarousel-block .owl-carousel .owl-nav .owl-prev, 
        .vl-fwcarousel-block .owl-carousel .owl-nav .owl-next,
        .vl-primary-cat-block .vl-primary-cat,
        .vl-carousel-block .owl-carousel .owl-nav .owl-prev, 
        .vl-carousel-block .owl-carousel .owl-nav .owl-next,
        .video-controls,
        .vl-ticker.style1 .vl-ticker-title,
        .vl-ticker.style1 .owl-carousel .owl-nav button.owl-prev, 
        .vl-ticker.style1 .owl-carousel .owl-nav button.owl-next,
        .vl-ticker.style2 .vl-ticker-title,
        .vl-ticker.style3 .vl-ticker-title,
        .vl-ticker.style4 .vl-ticker-title,
        .single-entry-gallery .owl-carousel .owl-nav .owl-prev, 
        .single-entry-gallery .owl-carousel .owl-nav .owl-next,
        .viral-times-related-post.style3 .owl-carousel .owl-nav .owl-prev, 
        .viral-times-related-post.style3 .owl-carousel .owl-nav .owl-next,
        .ht-instagram-widget-footer a,
        .blog-layout7 .ht-post-date
        {
            background:{$color};
        }";

    /* =============== Color =============== */
    $custom_css .= "
        .no-comments,
        .woocommerce div.product p.price,
        .woocommerce div.product span.price,
        .woocommerce .product_meta a:hover,
        .woocommerce-error:before,
        .woocommerce-info:before,
        .woocommerce-message:before,
        .blog-layout1 .ht-post-date .entry-date span,
        .vp-block-filter ul.vp-block-filter-list li.vp-active a
        {
            color:{$color};
        }";

    /* =============== Border Color =============== */
    $custom_css .= "
        .woocommerce ul.products li.product:hover,
        .woocommerce-page ul.products li.product:hover,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce ul.products li.product:hover .viral-times-product-title-wrap .button,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce div.product .woocommerce-tabs ul.tabs,
        .woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt:disabled[disabled],
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt:disabled[disabled],
        .woocommerce a.button.alt:disabled[disabled]:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt:disabled[disabled],
        .woocommerce button.button.alt:disabled[disabled]:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt:disabled[disabled],
        .woocommerce input.button.alt:disabled[disabled]:hover,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .ht-style2-accordion .ht-accordion-content-wrap,
        .content-area .entry-content blockquote
        {
            border-color: {$color};
        }

        .woocommerce-error,
        .woocommerce-info,
        .woocommerce-message{
            border-top-color: {$color};
        }

        .woocommerce ul.products li.product .onsale:after{
            border-color: transparent transparent {$darker_color} {$darker_color};
        }

        .woocommerce span.onsale:after{
            border-color: transparent {$darker_color} {$darker_color} transparent;
        }

        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:before{
            border-color: {$color} transparent transparent;
        }
        
        .vl-ticker.style1 .vl-ticker-title:after{
            border-color: transparent transparent transparent {$color};
        }
        
        .vl-ticker.style4 .vl-ticker-title:after{
            border-color: {$color} transparent transparent {$color};
        }
        
        .rtl .vl-ticker.style1 .vl-ticker-title:after{
            border-color: transparent {$color} transparent transparent;
        }
        
        .rtl .vl-ticker.style4 .vl-ticker-title:after{
            border-color: transparent {$color} {$color} transparent;
        }
    ";

    /* ======== Scroll Top ======== */
    $st_height = get_theme_mod('viral_times_scroll_top_height', 46);
    $st_width = get_theme_mod('viral_times_scroll_top_width', 46);
    $st_border_radius = get_theme_mod('viral_times_scroll_top_border_radius', 46);
    $st_icon_size = get_theme_mod('viral_times_scroll_top_icon_size', 20);
    $st_color = get_theme_mod('viral_times_scroll_top_color', $color) ? get_theme_mod('viral_times_scroll_top_color', $color) : $color;
    $st_icon_color = get_theme_mod('viral_times_scroll_top_icon_color', '#FFF') ? get_theme_mod('viral_times_scroll_top_icon_color', '#FFF') : '#FFF';
    $st_hov_color = get_theme_mod('viral_times_scroll_top_hov_color');
    $st_icon_hov_color = get_theme_mod('viral_times_scroll_top_icon_hov_color');

    $custom_css .= "
        #ht-back-top{
            height: {$st_height}px;
            width: {$st_width}px;
            border-radius: {$st_border_radius}px;
        }
        #ht-back-top i{
            font-size: {$st_icon_size}px;
        }";

    $custom_css .= "
        #ht-back-top.ht-st-stacked{
            background: {$st_color};
            color: {$st_icon_color};
        }";

    if ($st_hov_color || $st_icon_hov_color) {
        $custom_css .= "
            #ht-back-top.ht-st-stacked:hover{
                background: {$st_hov_color};
                color: {$st_icon_hov_color};
            }";
    }

    $custom_css .= "
        #ht-back-top.ht-st-framed{
            border-color: {$st_color};
            color: {$st_color};
        }";

    if ($st_hov_color || $st_icon_hov_color) {
        $custom_css .= "
            #ht-back-top.ht-st-framed:hover{
                border-color: {$st_hov_color};
                color: {$st_hov_color};
            }";
    }

    $st_offset_left = get_theme_mod('viral_times_scroll_top_offset_left', 40);
    $st_offset_right = get_theme_mod('viral_times_scroll_top_offset_right', 40);
    $st_offset_bottom = get_theme_mod('viral_times_scroll_top_offset_bottom', 40);

    $custom_css .= "#ht-back-top.ht-st-left{left: {$st_offset_left}px;}";

    $custom_css .= "#ht-back-top.ht-st-right{right: {$st_offset_right}px;}";

    $custom_css .= "#ht-back-top{bottom: {$st_offset_bottom}px;}";

    /* =============== Footer Settings =============== */
    $footer_bg_url = get_theme_mod('viral_times_footer_bg_url');
    $footer_bg_repeat = get_theme_mod('viral_times_footer_bg_repeat', 'no-repeat');
    $footer_bg_size = get_theme_mod('viral_times_footer_bg_size', 'cover');
    $footer_bg_position = get_theme_mod('viral_times_footer_bg_position', 'center-center');
    $footer_bg_position = str_replace('-', ' ', $footer_bg_position);
    $footer_bg_attach = get_theme_mod('viral_times_footer_bg_attach', 'scroll');
    $footer_bg_color = get_theme_mod('viral_times_footer_bg_color', '#333333');
    $footer_title_color = get_theme_mod('viral_times_footer_title_color', '#EEEEEE');
    $footer_title_light_color = viral_times_hex2rgba($footer_title_color, 0.1);
    $footer_text_color = get_theme_mod('viral_times_footer_text_color', '#EEEEEE');
    $footer_anchor_color = get_theme_mod('viral_times_footer_anchor_color', '#EEEEEE');
    $footer_border_color = get_theme_mod('viral_times_footer_border_color', '#444444');


    $custom_css .= "
        #ht-colophon{
            background-image:url($footer_bg_url);
            background-repeat: $footer_bg_repeat;
            background-size: $footer_bg_size;
            background-position: $footer_bg_position;
            background-attachment: $footer_bg_attach;
        }
        
        .ht-site-footer:before{
                background-color: $footer_bg_color;
        }
        
        #ht-colophon .widget-title{
                color: $footer_title_color;
        }
        
        .ht-sidebar-style1 .ht-site-footer .widget-title:after,
        .ht-sidebar-style3 .ht-site-footer .widget-title:after,
        .ht-sidebar-style6 .ht-site-footer .widget-title:after{
            background: $footer_title_color;
        }
        
        .ht-sidebar-style2 .ht-site-footer .widget-title,
        .ht-sidebar-style7 .ht-site-footer .widget-title{
            border-color: $footer_title_light_color;
        }
        
        .ht-sidebar-style5 .ht-site-footer .widget-title:before,
        .ht-sidebar-style5 .ht-site-footer .widget-title:after{
            background-color: $footer_title_light_color;
        }

        .ht-site-footer *{
                color: $footer_text_color;
        }

        .ht-site-footer a,
        .ht-site-footer a *{
                color: $footer_anchor_color;
        }
        
        .ht-top-footer .ht-container,
        .ht-main-footer .ht-container,
        .ht-bottom-top-footer .ht-container{
            border-color: $footer_border_color;
        }";

    /* =============== Responsive CSS =============== */
    $custom_css .= "@media screen and (max-width: {$responsive_width}px){
            .ht-menu{
                display: none;
            }

            #ht-mobile-menu{
                display: block;
            }

            .ht-header-one .ht-header, 
            .ht-header-two .ht-header, 
            .ht-header-three .ht-header, 
            .ht-header-four .ht-header .ht-container, 
            .ht-header-five .ht-header, 
            .ht-header-six .ht-header .ht-container, 
            .ht-header-seven .ht-header, 
            .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top, 
            .ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top{
                background: {$mh_bg_color_mobile};
            }
            
            .ht-header-two .ht-header .ht-container {
                justify-content: flex-end;
            }
            
            .ht-header-six.ht-site-header .ht-top-header {
                height: auto !important;
            }
            .ht-top-header-on .ht-header-six .ht-header {
                -webkit-transform: translateY(0) !important;
                transform: translateY(0) !important;
            }
            .ht-header-six.ht-site-header {
                margin-bottom: 0 !important;
            }
            .ht-top-header-on.ht-single-layout1 .ht-header-six.ht-site-header, 
            .ht-top-header-on.ht-single-layout2 .ht-header-six.ht-site-header, 
            .ht-top-header-on.ht-single-layout5 .ht-header-six.ht-site-header,
            .ht-top-header-on.ht-single-layout6 .ht-header-six.ht-site-header,
            .ht-top-header-on.ht-single-layout7 .ht-header-six.ht-site-header{
                margin-bottom: 40px !important;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-content-full,
            .megamenu-full-width.megamenu-category .cat-megamenu-tab,
            .megamenu-full-width.megamenu-category .cat-megamenu-content{
                display: none;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-tab > div{
                padding: 15px 40px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-tab > div:after{
                display: none;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-content-full ul li{
                width: 100%;
                float: none;
                margin: 0;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-content-full ul li > a{
                display:none;
            }
            
            #ht-responsive-menu li.menu-item.megamenu-category > a > .dropdown-nav{
                display:none;
            }

            .ht-sticky-header .headroom.headroom--not-top{
                position: relative;
                top: auto !important;
                left: auto;
                right: auto;
                z-index: 9999;
                width: auto;
                box-shadow: none;
                -webkit-animation: none;
                animation: none;
            }
            
            .ht-header .ht-offcanvas-nav, 
            .ht-header .ht-search-button, 
            .ht-header .ht-header-social-icons{
                display: none;
            }
            
            #ht-content{
                padding-top: 0 !important;
            }
            
            .admin-bar.ht-sticky-header .headroom.headroom--not-top{
                top: auto;
            }
            
            .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top .ht-container{
                margin-bottom: 38px !important;
            }
            
            .ht-top-header-on.ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top {
                -webkit-transform: translateY(-50%);
                transform: translateY(-50%);
            }
            
            .ht-header-one #ht-site-branding img,
            .ht-header-three #ht-site-branding img,
            .ht-header-six #ht-site-branding img{
                max-height: {$logo_min_height}px;
            }
                    
            .ht-header-two #ht-site-branding img, 
            .ht-header-four #ht-site-branding img, 
            .ht-header-five #ht-site-branding img, 
            .ht-header-seven #ht-site-branding img{
                max-height: {$logo_actual_height}px;
            }
            
        }

        @media screen and (max-width: {$container_width}px){        
            .elementor-section.elementor-section-boxed.elementor-section-stretched>.elementor-container,
            .elementor-template-full-width .elementor-section.elementor-section-boxed>.elementor-container,
            .e-con.e-parent>.e-con-inner,
            .ht-fullwidth-container .elementor-section.elementor-section-boxed>.elementor-container,
            .ht-container,
            body.ht-fluid .ht-container{
                padding-left: 40px !important;
                padding-right: 40px !important;
                width: 100%;
                max-width: none;
            }
        }
            
        @media screen and (max-width: {$container_width_200}px){        
            .ht-single-layout5 .entry-header,
            .ht-single-layout6 .entry-header{
                margin-left: 0;
                margin-right: 0;
            }
            .ht-single-layout6 .entry-header{
                height: auto;
            }
        }";


    /* =============== Header Button =============== */
    $hb_text_color = get_theme_mod('viral_times_hb_text_color', '#FFFFFF');
    $hb_text_hov_color = get_theme_mod('viral_times_hb_text_hov_color', '#FFFFFF');
    $hb_bg_color = get_theme_mod('viral_times_hb_bg_color', '#f97c00');
    $hb_bg_hov_color = get_theme_mod('viral_times_hb_bg_hov_color', '#f97c00');
    $hb_borderradius = get_theme_mod('viral_times_hb_borderradius', '0');

    $custom_css .= "
            a.ht-header-bttn{
                color: $hb_text_color;
                background: $hb_bg_color;
                border-radius: {$hb_borderradius}px;
            }

            a.ht-header-bttn:hover{
                color: $hb_text_hov_color;
                background: $hb_bg_hov_color;
            }
        ";

    /* =============== GDPR =============== */
    $gdpr_bg = get_theme_mod('viral_times_gdpr_bg', '#333333');
    $gdpr_text_color = get_theme_mod('viral_times_gdpr_text_color', '#FFFFFF');
    $button_bg_color = get_theme_mod('viral_times_button_bg_color', '#f97c00');
    $button_text_color = get_theme_mod('viral_times_button_text_color', '#FFFFFF');
    $custom_css .= "
            .viral-times-privacy-policy{
                color: $gdpr_text_color;
                background: $gdpr_bg;
            }

            .policy-text a{
                color: $gdpr_text_color;
            }

            .policy-buttons a,
            .policy-buttons a:hover{
                color: $button_text_color;
                background: $button_bg_color;
            }
        ";


    /* =============== Category Color =============== */
    $cat = viral_times_category_list();
    foreach ($cat as $cat_id => $cat_name) {
        $cat_color = get_theme_mod("viral_times_category_{$cat_id}_color");
        if ($cat_color) {
            $custom_css .= ".vl-post-categories li a.vl-category-{$cat_id},.vl-primary-cat-block .vl-category-{$cat_id}{
            background: $cat_color;
            }";
        }
    }

    /* =============== Mobile Menu Button =============== */
    $toggle_button_color = get_theme_mod('viral_times_toggle_button_color', '#FFFFFF');

    $custom_css .= ".collapse-button{border-color:{$toggle_button_color}}";
    $custom_css .= ".collapse-button .icon-bar{background:{$toggle_button_color}}";

    /* =============== FrontPage Section Spacing =============== */
    $frontpage_section_spacing = get_theme_mod('viral_times_frontpage_section_spacing', 40);
    $featured_block_spacing = $frontpage_section_spacing - 30;

    $custom_css .= "#vl-video-playlist, .vl-bottom-block, .vl-carousel-block, .vl-fwcarousel-block, .vl-slider-block, .vl-news-block, .vl-ticker, .ht-mininews-section .ht-non-fullwidth-container, .ht-mininews-section .ht-fullwidth-container, .vl-fwnews-block, .vl-tile-block-wrap, .ht-section .widget{margin-bottom:{$frontpage_section_spacing}px}";
    $custom_css .= ".ht-featured-block-wrap{margin-bottom:{$featured_block_spacing}px}";

    $custom_css .= "@media screen and (max-width:768px){{$tablet_css}}";
    $custom_css .= "@media screen and (max-width:480px){{$mobile_css}}";
    $custom_css .= "@supports (-webkit-touch-callout: none) {[data-pllx-bg-ratio]{background-attachment:scroll !important; background-position:center !important;}}";
    $custom_css .= "@supports (-webkit-touch-callout: none) {[data-pllx-bg-ratio]{background-attachment:scroll !important; background-position:center !important;}}";

    return viral_times_css_strip_whitespace($custom_css);
}
