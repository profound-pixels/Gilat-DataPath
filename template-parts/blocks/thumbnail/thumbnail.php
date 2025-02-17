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

$add_text           = get_field('add_text') ?: true; 
$heading            = get_field('heading') ?: '';
$excerpt            = get_field('excerpt') ?: '';
$link               = get_field('link') ?: '#';  
$thumbnail_id       = get_field('image')?: '';
$text_placement     = get_field('text_placement') ?: 'below'; 
$isbg               = get_field('isbg') ?: true; 
$link_classes       = get_field('link_class') ?: ''; 
$link_attr          = get_field('link_attr') ?: '';
$cell_classes       = get_field('cell_class') ?: ''; 
$cell_attr          = get_field('cell_attr') ?: '';
$media_classes      = get_field('media_class') ?: '';

// $var1 = get_field('field') ? 'string' : '';
// $var2 = get_field('field') ?: null;


?>



<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <?php  
    // Link
    echo '<a href="'.$link.'" class="uk-display-block uk-link-toggle '.$link_classes.'" '.$link_attr.'>';

    // If cell bg image is activated retrieve thumbnail
    $cell_attr .= $isbg ? 'uk-img '.get_img($thumbnail_id,'large','','','','','','',true) : '';
        
    ?>
    
    <div class="uk-inline uk-cover-container uk-background-cover uk-box-shadow-xlarge uk-box-shadow-hover-xlarge uk-border-rounded <?php echo $cell_classes ?>" <?php echo $cell_attr; ?>>
       <canvas class="" width="800" height="800"></canvas>
        <?php if (!$isbg):
           get_img($thumbnail_id, 'large', $media_classes , 'uk-cover');
        endif; ?>
        
    <?php // Set placement of text 
    if( $text_placement == 'overlay' && $add_text ): ?>
        <div class="uk-position-bottom uk-overlay uk-overlay-primary ppx-overlay-gradient uk-padding">
            <h2 class="uk-margin-remove-bottom uk-text-truncate uk-h3 uk-link-heading"> 
                <?php echo $heading; ?>
            </h2>
            <span class="uk-text-meta uk-text-truncate"><?php echo $excerpt; ?></span>
        </div>
    </div>
    <?php elseif( $text_placement == 'below' && $add_text ): ?>
    </div>
    <div class='uk-margin-small-top'>
        <?php the_title('<h2 class="uk-h3 uk-margin-remove-bottom uk-text-truncate uk-h5 uk-link-heading">','</h2>'); ?>
        <span class="uk-text-meta uk-text-truncate"><?php ppx_starter_posted_on(false) ?></span>
    </div> 
    <?php else: ?>
    </div>
    <?php endif; ?>

    </a>
    
</div>