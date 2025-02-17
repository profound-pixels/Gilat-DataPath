<?php
/**
 ** CARD LOOP TEMPLATE
 **/


class cardView extends viewBase
{
    public function render(){ ?>
    
    <?php 
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }
        
        // Set classes variable
        $block_classes = $this->classes;
        
        // Unconditional classes
        $block_classes .= ' uk-grid-match';
        
        // Set grid width based on post count
        $post_count = $this->query->found_posts;
        
        if( $post_count < 4 && $post_count > 1){
            $block_classes .= ' uk-child-width-1-2@m uk-child-width-1-'.$post_count.'@l';
        }
        elseif($post_count = 4){
            $block_classes .= ' uk-child-width-1-2@m uk-child-width-1-2@l';
        }
        elseif($post_count > 4){
            $block_classes .= ' uk-child-width-1-2@m uk-child-width-1-3@l';
        }

        // Card settings
        $set_support_load_more = $this->settings['card']['support_load_more'] ?: false;
        $set_load_more_btn_text = $this->settings['card']['load_more_btn_text'] ?: 'Load More';   

        // Max num pages
        $max_num_pages = $this->query->max_num_pages;
    ?>

    <div <?php echo $block_id; ?> class="<?php echo $block_classes; ?>" uk-grid>
        <?php $this->renderPosts(); ?>
    </div>
    
    <?php if($max_num_pages > 1 && $set_support_load_more): ?>
        <button class="btn-load-more"><?php echo $set_load_more_btn_text ?></button>
    <?php endif; ?>

    <?php }

    public function renderPosts(){
        // Card settings
        $set_support_link    = $this->settings['card']['support_link'] ?: false;
        $set_support_img    = $this->settings['card']['support_img'] ?: false;
        $set_img_align      = $this->settings['card']['img_alignment'] ?: '';    

        while($this->query->have_posts()): 
            $this->query->the_post();

            // Get thumbnail id
            $thumbnail_id = get_post_thumbnail_id();

            // Set show media bool variable
            $show_card_media = $thumbnail_id && $set_support_img;

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
            $image_data = $show_card_media ? wp_get_attachment_image_src($thumbnail_id, 'xxl') : [];

            // Image dimensions
            $image_width = $show_card_media ? $image_data[1] : 0;
            $image_height = $show_card_media ? $image_data[2] : 0;
        ?>
            
            <div>
                <div class="<?php echo $card_classes; ?>" <?php if($horizontal){ echo 'uk-grid'; } ?>>
                    <!-- Card Media (top, left, right) -->
                    <?php if($show_card_media && $set_img_align != 'bottom'): ?>
                        <div class="<?php echo $card_media_classes; ?>">
                            <?php if($set_support_link): ?><a href="<?php echo $permalink; ?>" class="uk-link-toggle"><?php endif; ?>
                            <?php echo get_img($thumbnail_id, 'xxl', '', 'uk-cover'); ?>
                            <?php if($set_support_link): ?></a><?php endif; ?>

                            <canvas class="<?php echo $canvas_classes ?>" width="400" height="200"></canvas>
                            <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                        </div>
                    <?php endif; ?>

                    <div>
                        <!-- Card Body -->
                        <div class="uk-card-body">
                            <?php if($set_support_link): ?><a href="<?php echo $permalink; ?>" class="uk-link-toggle"><?php endif; ?>
                            <h3 class="uk-card-title uk-link-heading">
                                <?php echo get_the_title(); ?>
                            </h3>
                            <?php if($set_support_link): ?></a><?php endif; ?>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </div>

                    <!-- Card Media (bottom) -->
                    <?php if($show_card_media && $set_img_align == 'bottom'): ?>
                        <div class="<?php echo $card_media_classes; ?>">
                            <?php if($set_support_link): ?><a href="<?php echo $permalink; ?>" class="uk-link-toggle"><?php endif; ?>
                            <?php echo get_img($thumbnail_id, 'xxl', '', 'uk-cover'); ?>
                            <?php if($set_support_link): ?></a><?php endif; ?>

                            <canvas class="<?php echo $canvas_classes ?>" width="400" height="200"></canvas>
                            <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile;
    }
}

?>