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
    $id = 'tax-browser-' . $block['id'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ppx-block-tax-browser';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}



$terms = get_field('tax_terms') ?: false;
$custom_attr = get_field('custom_attr') ?: false;
$is_title = get_field('title') ? true : false;
$slider = get_field('slider') ?: [];

// SLIDER Vars ------------------------------------
$set_dot_nav            = $slider['dot_nav'] ?: false;
$set_arrow_nav          = $slider['arrow_nav'] ?: false;


//print_r($custom_attr);
//print_r($terms);


// CUSTOM CLASS & ATTR SETTINGS ----------------------------------------
         
// Custom UL (grid div) Atrributes & Classes 
$ul_attr = $custom_attr['attr_ul'] ?: '';
$ul_classes = $custom_attr['class_ul'].' ' ?: '';   

//Set LI Attributes & Classes
$li_attr = $custom_attr['attr_li'] ?: '';
$li_classes = $custom_attr['class_li'] ?: '';

//Attributes & Classes for links
$link_attr = $custom_attr['attr_link'] ?: '';
$link_classes = $custom_attr['class_link'].'' ?: '';


?>

<?php if( $terms ): ?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" uk-slider>
    <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1">
        <ul class="uk-slider-items uk-grid <?php echo $ul_classes; ?>" <?php echo $ul_attr; ?> uk-grid>        
        
        <?php foreach( $terms as $term ): ?>
           <?php $img_id = get_field('tax_img', $term); // get Taxonomy img custom field
            if($img_id): // only print if a custom taxonomy image is available ?> 
            
            <li class="<?php echo $li_classes; ?>" <?php echo $li_attr; ?>>
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="<?php echo $link_classes; ?> uk-display-block uk-background-muted" <?php echo $link_attr; ?>>
                   
                   <div class="uk-inline uk-cover-container uk-background-cover uk-box-shadow-hover-large">
                        <canvas class="" width="540" height="380"></canvas>
                        <?php get_img($img_id, 'large' , '' , 'uk-cover'); ?>
                        
                        <?php // Display title overlay if enabled 
                        if( $is_title ): ?>
                            <div class="uk-position-bottom-left uk-overlay uk-overlay-default uk-padding-small">
                                <h3 class="uk-margin-remove-bottom uk-text-truncate uk-h2 uk-link-heading"><?php echo esc_html( $term->name ); ?></h3>
                                <?php if($term->description): ?><span class="uk-text-meta uk-text-truncate"><?php echo esc_html( $term->description ); ?></span><?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>
            </li>
        <?php endif; endforeach; ?>
    
        </ul>
        <?php if( $set_arrow_nav ): ?>
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
        <?php endif; ?>
    </div>
    <?php if( $set_dot_nav ): ?>
    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
    <?php endif; ?>
</div>
<?php 

else:     
    ppx_no_content_card();
endif;

?>


