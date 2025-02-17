<?php
/**
 * Slideshow Block Template
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
    $id = 'slideshow-' . $block['id'];
}


if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ppx-block-slideshow';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load setting values and assign defaults.
$set_dot_nav            = get_field('dot_nav') ?: false;
$set_arrow_nav          = get_field('arrow_nav') ?: false;
$set_slides             = get_field('slides') ?: [];

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> uk-position-relative uk-visible-toggle uk-margin-medium-bottom uk-background-muted" tabindex="-1" uk-slideshow="animation: push">
    <ul class="uk-slideshow-items">
        <?php

        foreach( $set_slides as $slide ) {
            $thumbnail_id       = $slide['image'];
            $add_type           = $slide['add_type'];
            $heading            = $slide['heading'];
            $caption            = $slide['caption'];
            $learn_more_link    = $slide['learn_more_link'];

            ?>
                
            <li>
                <?php echo get_img($thumbnail_id, 'xxl', '', 'uk-cover'); ?>
                <?php if($add_type): ?>
                <div class="uk-position-center uk-position-small uk-text-center uk-light">
                    <h2 class="uk-margin-remove"><?php echo $heading; ?></h2>
                    <p class="uk-margin-remove"><?php echo $caption; ?></p>
                <?php if(!empty($learn_more_link)): ?><a href="<?php echo $learn_more_link; ?>">Learn More</a><?php endif; ?>
                </div>
                <?php endif; ?>
            </li>
            
            <?php
        }

        ?>
    </ul>

    <?php if($set_dot_nav): ?>
    <div class="uk-position-bottom-center uk-position-small uk-light">
        <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>
    </div>
    <?php endif; ?>

    <?php if($set_arrow_nav): ?>
    <div class="uk-light">
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
    </div>
    <?php endif; ?>
</div>

<?php

wp_reset_postdata();



