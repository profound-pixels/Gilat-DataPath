<?php
/**
 ** THUMBNAIL GRID LOOP TEMPLATE
 **/


class thumbnailgridView extends viewBase
{

    public function render(){ 
        
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }

        // Set classes variable
        $block_classes = $this->classes.' ';

        // Unconditional classes
        $block_classes .= '';  
        
        //Block Vars --------------------------------------
        
        $block_attr = $this->settings['attr']['attr_wrap'] ?: '';
        $block_classes .= $this->settings['attr']['class_wrap'] ?: '';
        
        // Grid Vars ----------------------------------------
        $grid_classes = 'ppx-load-area ';
        $grid_classes .= $this->settings['thumb_grid']['thumb_grid_cell_spacing'].' ' ?: '';

        // Set Col layout
        $grid_columns = $this->settings['thumb_grid']['thumb_grid_columns'];
        $grid_classes .= $grid_columns;
        
        // Custom UL (grid div) Atrributes & Classes
        $ul_attr = $this->settings['attr']['attr_ul'] ?: '';
        $grid_classes .= ' '.$this->settings['attr']['class_ul'] ?: '';
        
        
?>
        
       <div <?php echo $block_id; ?> class="<?php echo $block_classes; ?>" <?php echo $block_attr; ?>>
           <div class="<?php echo $grid_classes; ?>" <?php echo $ul_attr; ?> uk-grid>
               <?php $this->renderPosts(); ?>
            </div>
        </div>
        
        <?php  // CARD LOAD MORE BUTTON ----------------------------------------
        
        // Max num pages
        $max_num_pages = $this->query->max_num_pages;
        
        // Load more settings
        $set_support_load_more = $this->settings['thumb_grid']['support_load_more'] ?: false;
        $set_load_more_btn_text = $this->settings['thumb_grid']['load_more_btn_text'] ?: 'Load More';
        
        //Set Navigation Attributes & Classes
        $nav_attr = $this->settings['attr']['attr_nav'] ?: '';
        $nav_classes = $this->settings['attr']['class_nav'] ?: '';
        
        if($max_num_pages > 1 && $set_support_load_more): ?>
        <div class="btn-load-more-wrapper">
        <button class="btn-load-more uk-button uk-button-primary <?php echo $nav_classes; ?>" <?php echo $nav_attr; ?>><?php echo $set_load_more_btn_text ?></button>
        </div>
        <?php endif; ?>
        
   <?php }
    
    public function renderPosts(){
        // Cell Vars ----------------------------------------
        
        //Thumbnail var
        $thumbnail_id = '';
        
        //Attributes & Classes for thumbnail cell
        $cell_attr = $this->settings['attr']['attr_li'].' ' ?: '';
        $cell_classes = $this->settings['attr']['class_li'].' ' ?: '';
        
        //Classes for img
        $media_classes = ''; 
        
        //Determine if image is on cell background
        $isbg = $this->settings['thumb_grid']['isbg'] ?: '';
        
        //Text placement
        $text_placement = $this->settings['thumb_grid']['text_placement'];
        
        // Link Vars ----------------------------------------
        //Attributes & Classes for links
        $link_attr = $this->settings['attr']['attr_link'].' ' ?: '';
        $link_classes = $this->settings['attr']['class_link'].' ' ?: '';
        
        while($this->query->have_posts()):
            $this->query->the_post();
            ppx_get_thumb($text_placement,$isbg,$link_classes,$link_attr,$cell_classes,$cell_attr,$media_classes);
        
        endwhile; 
    }
}

?>