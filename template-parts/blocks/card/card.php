<?php
/**
 * Card Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


if( get_field('block_id') ){
    $id = get_field('block_id');
}
else{
    $id = 'card-' . $block['id'];
}


if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ppx-block-card';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if ( get_field('bg_style') ){
    $className .= ' uk-light ' . get_field('bg_style'); 
}

// Set header styles
$header_settings = get_field('header_settings') ?: '';
$header_styles = '';

if($header_settings != '' || $header_settings != null){
    foreach($header_settings as $header_style){
        $header_styles .= $header_style . ' ';
    }
}


// Load setting values and assign defaults.
$set_heading            = get_field('heading') ?: '';
$set_excerpt            = get_field('excerpt') ?: '';
$set_link               = get_field('link') ?: '';
$set_support_img        = get_field('support_img') ?: false;
$set_featured_img_id    = get_field('featured_image_id') ?: 0;
$set_img_align          = get_field('img_alignment') ?: 'top';
$link_text              = get_field('link_text') ?: 'Learn More';
$link_type              = get_field('link_type') ?: '';

$attr = [];
$attr['class_post'] = $className;
$attr['header_styles'] = $header_styles;
$attr['center_content'] = get_field('center_content') ?: false;
//print_r($attr['header_styles']);

// Set show media bool variable
$show_card_media = $set_featured_img_id > 0 && $set_support_img;

ppx_get_card($set_heading, $set_excerpt, $set_link, $set_support_img ? $set_featured_img_id : 0, $set_img_align, $attr, $link_text, $link_type);

wp_reset_postdata();


