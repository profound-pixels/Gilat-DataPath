<?php
/**
 ** CARD LOOP TEMPLATE
 **/


class cardView extends viewBase
{
    public function render(){ ?>
    
    <?php  // GLOBAL ---------------------------------------------------
        // Max num pages
        $max_num_pages = $this->query->max_num_pages;
    ?>
    
    <?php  // TOP LEVEL BLOCK -------------------------------------------
        
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }
        
        // Set classes variable
        $block_classes = $this->classes;
        
        // Unconditional classes
        $block_classes .= ' uk-grid-match ppx-load-area';
        
        // Custom Wrapper classes
        $block_classes .= ' '.$this->settings['attr']['class_wrap'] ?: '';
        
        // Set grid columns
        $columns = $this->settings['card']['columns'];
        $block_classes .= ' '.$columns;
        
        // Custom Wrapper Atrributes
        $wrapper_attr = $this->settings['attr']['attr_wrap'] ?: '';
    ?>
    <div <?php echo $block_id; ?> class="<?php echo $block_classes; ?>" <?php echo $wrapper_attr; ?> uk-grid>
        <?php $this->renderPosts(); ?>
    </div>
    
    <?php  // CARD LOAD MORE BUTTON ----------------------------------------
        
        // Load more settings
        $set_support_load_more = $this->settings['card']['support_load_more'] ?: false;
        $set_load_more_btn_text = $this->settings['card']['load_more_btn_text'] ?: 'Load More';
        
        //Set Navigation Attributes & Classes
        $nav_attr = $this->settings['attr']['attr_nav'] ?: '';
        $nav_classes = $this->settings['attr']['class_nav'] ?: '';
        
        if($max_num_pages > 1 && $set_support_load_more): ?>
        <div class="btn-load-more-wrapper uk-text-center uk-padding">
        <button class="btn-load-more uk-button uk-button-default uk-button-large <?php echo $nav_classes; ?>" <?php echo $nav_attr; ?>><?php echo $set_load_more_btn_text ?></button>
        </div>
    <?php endif; ?>

    <?php }

    public function renderPosts($list_wrap = false){
        // Card settings
        $set_support_link   = $this->settings['card']['support_link'] ?: false;
        $set_support_img    = $this->settings['card']['support_img'] ?: false;
        $set_img_align      = $this->settings['card']['img_alignment'] ?: '';    

        while($this->query->have_posts())
        {
            $this->query->the_post();

            // Get thumbnail id
            $thumbnail_id = get_post_thumbnail_id();

            // Permalink
            $permalink = get_permalink();
            
            // CARD SETTINGS ----------------------------------------      
            
            //Package All Attributes & Classes
            $block_attr = $this->settings['attr'] ?: [];
            
            // Get card
            ppx_get_card(get_the_title(), get_the_excerpt(), $set_support_link ? $permalink : '', $set_support_img ? $thumbnail_id : 0, $set_img_align, $block_attr, "Learn More", "link");
        }
    }
}

?>