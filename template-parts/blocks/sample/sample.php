<?php
/**
 * Sample Template
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
    $id = 'div-' . $block['id'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ppx-block-sample';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


$var1 = get_field('field') ? 'string' : '';
$var2 = get_field('field') ?: null;


?>



<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <InnerBlocks  />
</div>