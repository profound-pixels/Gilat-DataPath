<?php

/**
 * Block to Layout Entire Page
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'layout-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ppx-block-layout';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.

$ppx_hasSidebar = false;
$ppx_contentWidth = wp_cache_get('ppx_contentFullWidth');
$ppx_sidebarWidth = wp_cache_get('ppx_sidebarWidth');

$ppx_layout = get_field('layout') ?: 'fullwidth';

if($ppx_layout === 'sidebar'){
    $ppx_hasSidebar = true;
    $ppx_contentWidth = wp_cache_get('ppx_contentSidebarWidth');
    $selected_sidebar = get_field('selected_sidebar');
}

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> uk-container wp-output">

<div class="uk-grid">
    <div id="main-output" class="<?php echo $ppx_contentWidth; ?>">
        <InnerBlocks  />
    </div>
    <?php if($ppx_hasSidebar): ?>
    
    <div id="sidebar-output" class="<?php echo $ppx_sidebarWidth; ?>">
      
        <?php if( is_active_sidebar( $selected_sidebar ) ): ?>
        <?php dynamic_sidebar( $selected_sidebar ); ?>
        <?php endif ?>
    </div>

    <?php endif; ?>
</div>

</div>