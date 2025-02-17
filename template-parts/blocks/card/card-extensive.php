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

// Load setting values and assign defaults.
$set_heading            = get_field('heading') ?: '';
$set_excerpt            = get_field('excerpt') ?: '';
$set_link               = get_field('link') ?: '';
$set_support_img        = get_field('support_img') ?: false;
$set_featured_img_id    = get_field('featured_image_id') ?: 0;
$set_img_align          = get_field('img_alignment') ?: 'top';


// Set show media bool variable
$show_card_media = $set_featured_img_id && $set_support_img;

// Set card classes
$card_classes = 'uk-card uk-card-default';

// Set card media classes
$card_media_classes = '';

// Set canvas classes
$canvas_classes = '';

// Set horizontal boolean
$horizontal = false;

// Permalink
$permalink = get_permalink();

// Conditional card and card media classes
switch ($set_img_align) {
    case 'top':
        $card_media_classes .= 'uk-card-media-top uk-cover-container';
        $canvas_classes .= 'uk-width-expand';
        break;
    case 'right':
        $horizontal = true;
        $card_classes .= ' uk-grid-collapse uk-child-width-1-2@s uk-margin';
        $card_media_classes .= 'uk-card-media-right uk-flex-last@s uk-cover-container';
        break;
    case 'bottom':
        $card_media_classes .= 'uk-card-media-bottom uk-cover-container';
        $canvas_classes .= 'uk-width-expand';
        break;
    case 'left':
        $horizontal = true;
        $card_classes .= ' uk-grid-collapse uk-child-width-1-2@s uk-margin';
        $card_media_classes .= 'uk-card-media-left uk-cover-container';
        break;
    default:
        break;
}

// Image data
$image_data = $set_support_img ? wp_get_attachment_image_src($set_featured_img_id, 'xxl') : [];

// Image dimensions
$image_width = $set_support_img ? $image_data[1] : 0;
$image_height = $set_support_img ? $image_data[2] : 0;
?>
    
    <div>
        <div class="<?php echo $card_classes; ?>" <?php if($horizontal){ echo 'uk-grid'; } ?>>
            <!-- Card Media (top, left, right) -->
            <?php if($set_support_img && $set_img_align != 'bottom'): ?>
                <div class="<?php echo $card_media_classes; ?>">
                    <?php if(!empty($set_link)): ?><a href="<?php echo $link; ?>" class="uk-link-toggle"><?php endif; ?>
                    <?php echo get_img($set_featured_img_id, 'xxl', '', 'uk-cover'); ?>
                    <?php if(!empty($set_link)): ?></a><?php endif; ?>

                    <canvas class="<?php echo $canvas_classes ?>" width="400" height="200"></canvas>
                    <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                </div>
            <?php endif; ?>

            <div>
                <!-- Card Body -->
                <div class="uk-card-body">
                    <?php if(!empty($set_link)): ?><a href="<?php echo $link; ?>" class="uk-link-toggle"><?php endif; ?>
                    <h3 class="uk-card-title uk-link-heading">
                        <?php echo $set_heading; ?>
                    </h3>
                    <?php if(!empty($set_link)): ?></a><?php endif; ?>
                    <p><?php echo $set_excerpt; ?></p>
                </div>
            </div>

            <!-- Card Media (bottom) -->
            <?php if($set_support_img && $set_img_align == 'bottom'): ?>
                <div class="<?php echo $card_media_classes; ?>">
                <?php if(!empty($set_link)): ?><a href="<?php echo $link; ?>" class="uk-link-toggle"><?php endif; ?>
                    <?php echo get_img($set_featured_img_id, 'xxl', '', 'uk-cover'); ?>
                    <?php if(!empty($set_link)): ?></a><?php endif; ?>

                    <canvas class="<?php echo $canvas_classes ?>" width="400" height="200"></canvas>
                    <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                </div>
            <?php endif; ?>
        </div>
    </div>
<?

wp_reset_postdata();


