<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PPx_Starter_Theme
 */


//PPX-TTAGS 12.0 CARD FUNCTION
if ( ! function_exists( 'ppx_get_card' ) ) :
	function ppx_get_card($title, $body, $link, $thumbnail_id, $img_align, $attr = []){
        // Set show media bool variable
        $show_card_media = $thumbnail_id > 0;

        // Set card classes
        $card_classes = 'uk-card uk-card-default';

        // Set card media classes
        $card_media_classes = '';

        // Set canvas classes
        $canvas_classes = '';

        // Set horizontal boolean
        $horizontal = false;

        // Conditional card and card media classes
        switch ($img_align) {
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
        $image_data = $show_card_media ? wp_get_attachment_image_src($thumbnail_id, 'xl') : [];

        // Image dimensions
        $image_width = $show_card_media ? $image_data[1] : 0;
        $image_height = $show_card_media ? $image_data[2] : 0;
        
        // Set Custom Attributes and Classes
        $card_custom_classes = isset($attr['class_post']) ? $attr['class_post'] : '';
        $card_custom_attr = isset($attr['attr_post']) ? $attr['attr_post'] : '';
        
        //get_img(id,system size,classes,meta,alt,width,height,title);
        
        $wrapper_tag = 'div';
        
        if(!empty($link)){
            $wrapper_tag = 'a';
            $card_custom_attr .= ' href="'.$link.'"';
            $card_classes .= ' uk-link-toggle';
        } 
        
        ?>
            
        <div>        
            <<?php echo $wrapper_tag; ?> class="<?php echo $card_classes.' '.$card_custom_classes; ?>" <?php echo $card_custom_attr; ?> <?php if($horizontal){ echo 'uk-grid'; } ?>>
                <!-- Card Media (top, left, right) -->
                <?php if($show_card_media && $img_align != 'bottom'): ?>
                    <div class="<?php echo $card_media_classes; ?>">
                        
                        <?php echo get_img($thumbnail_id, 'large', '', 'uk-cover'); ?>
                        <canvas class="<?php echo $canvas_classes ?>" width="400" height="200"></canvas>
                        
                        <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                    </div>
                <?php endif; ?>

                <div>
                    <!-- Card Body -->
                    <div class="uk-card-body">
                        
                        <h3 class="uk-card-title uk-link-heading">
                            <?php if(!empty($link)): ?><span class="uk-link-heading"><?php endif; ?>
                            <?php echo $title; ?>
                            <?php if(!empty($link)): ?></span><?php endif; ?>
                        </h3>
                        
                        <p><?php echo $body; ?></p>
                    </div>
                </div>

                <!-- Card Media (bottom) -->
                <?php if($show_card_media && $img_align == 'bottom'): ?>
                    <div class="<?php echo $card_media_classes; ?>">
                        
                        <?php echo get_img($thumbnail_id, 'large', '', 'uk-cover'); ?>
                        <canvas class="<?php echo $canvas_classes ?>" width="400" height="200"></canvas>

                        <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                    </div>
                <?php endif; ?>
            </<?php echo $wrapper_tag; ?>>
        </div>

        <?php
    }
	
endif;