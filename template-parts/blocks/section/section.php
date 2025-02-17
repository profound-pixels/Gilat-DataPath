<?php

/**
 * Content Section Template.
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
    $id = 'section-' . $block['id'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ppx-content-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Space between class strings
$sp = ' ';

// Set section classes
$sctn = 'uk-section';

$sctn_padding = $sp . get_field('section_padding') ?: '';
$sctn_bg = $sp . get_field('section_bg') ?: '';
$sctn_overlapped = get_field('section_overlapped') ? $sp . 'uk-section-overlap' : '';

$sctn_img = get_field('section_img') ?: null;
$sctn_img_id = $sctn_img['img'] ?: null;
$sctn_img_size = $sp . $sctn_img['size'] ?: '';
$sctn_img_position = $sp . $sctn_img['position'] ?: '';
$sctn_img_fixed = $sctn_img['fixed'] ? ' uk-background-fixed' : '';

$section_classes = $sctn . $sctn_padding . $sctn_bg . $sctn_overlapped . $sctn_img_size . $sctn_img_position . $sctn_img_fixed;

// Set section attributes

$section_attr = '';
if( $sctn_img_id ){
    
    $data_src = ' data-src="' . wp_get_attachment_image_url($sctn_img_id, 'xxl') . '"';
    $data_srcset = ' data-srcset="' . wp_get_attachment_image_srcset($sctn_img_id, 'xxl') . '"';
    $data_sizes = ' data-sizes="' . wp_get_attachment_image_sizes($sctn_img_id, 'xxl') . '"';
    $sctn_img_parallax = $sctn_img['parallax'] ? ' uk-parallax="bgy: -120"': '';
    
    $section_attr = 'uk-img'. $data_src . $data_srcset . $data_sizes . $sctn_img_parallax;
    
}

// Set container classes

$ctnr = get_field('section_width') != 'no-container' ? 'uk-container ' : '';
$ctnr .= get_field('section_width') ?: ''; 

$container_classes = $ctnr;


//echo $section_classes;
//echo '<br>';
//echo $container_classes;
//echo '<br>';
//echo $section_bg['fixed'];
//echo '<br>';
//print_r($sctn_img);
?>

 <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php echo $section_classes; ?>" <?php echo $section_attr; ?>>
  <div class="<?php echo $container_classes; ?>" >

    <InnerBlocks  />

  </div>
</div> 