<?php
/**
 ** SLIDER LOOP TEMPLATE
 **/

class sliderView extends viewBase
{

     public function render(){
        
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }

        // Set classes variable
        $block_classes = $this->classes;

        // Unconditional classes
        $block_classes .= ' ';
        
        // Slider Settings --------
        $set_dot_nav = $this->settings['slider']['dot_nav'];
        $set_arrow_nav = $this->settings['slider']['arrow_nav'];
        
        // UL Vars ----------------------------------------
         
        // Custom UL (grid div) Atrributes & Classes 
        $ul_attr = $this->settings['attr']['attr_ul'] ?: '';
        $ul_classes = $this->settings['attr']['class_ul'].' ' ?: '';
         
        // Set Slider Columns
        $ul_columns = $this->settings['slider']['slider_items_columns'];
        $ul_classes .= $ul_columns;
         
         
        // CardView instance for rendering posts
		//$cards = new cardView($this->query, $this->id, $this->classes, $this->settings);
        
        ?>
        <div <?php echo $block_id; ?> class="<?php echo $block_classes; ?>" uk-slider>
            <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1">
                <ul class="uk-slider-items uk-grid <?php echo $ul_classes; ?>" <?php echo $ul_attr; ?> uk-grid>
                    <?php 
                        // Card settings
                        $set_support_link   = $this->settings['card']['support_link'] ?: false;
                        $set_support_img    = $this->settings['card']['support_img'] ?: false;
                        $set_img_align      = $this->settings['card']['img_alignment'] ?: '';  
                        
                        while($this->query->have_posts()){
                            
                            $this->query->the_post();
                            
                            // LI SETTINGS ----------------------------------------      

                            //Set LI Attributes & Classes
                            $li_attr = $this->settings['attr']['attr_li'] ?: '';
                            $li_classes = $this->settings['attr']['class_li'] ?: '';

                        // LI TAG 
                    ?> 
                        <li class="<?php echo $li_classes; ?>" <?php echo $li_attr; ?>>

                    <?php   // Determine type ( Card or Thumbnail )
                            if($this->settings['slider']['content_type'] == 'thumb'){
                                
                                //Text placement
                                $text_placement = $this->settings['thumb_grid']['text_placement'];
                                
                                //Determine if image is on cell background
                                $isbg = $this->settings['thumb_grid']['isbg'] ?: '';
                                
                                //Attributes & Classes for links
                                $link_attr = $this->settings['attr']['attr_link'].' ' ?: '';
                                $link_classes = $this->settings['attr']['class_link'].' ' ?: '';
                                
                                //Attributes & Classes for thumbnail cell
                                $cell_attr = $this->settings['attr']['attr_li'].' ' ?: '';
                                $cell_classes = $this->settings['attr']['class_li'].' ' ?: '';
                                
                                //Classes for img
                                $media_classes = '';
                                
                                ppx_get_thumb($text_placement,$isbg,$link_classes,$link_attr,$cell_classes,$cell_attr,$media_classes);
                            }
                            elseif($this->settings['slider']['content_type'] == 'code'){
                                $code_view = $this->settings['code_view'];
                                
                                ppx_get_code($code_view);
                            }
                            else{
                                // CARD SETTINGS ----------------------------------------      

                                // Get thumbnail id
                                $thumbnail_id = get_post_thumbnail_id();

                                // Permalink
                                $permalink = get_permalink();

                                //Package All Attributes & Classes
                                $block_attr = $this->settings['attr'] ?: [];

                                // Get card
                                ppx_get_card(get_the_title(), get_the_excerpt(), $set_support_link ? $permalink : '', $set_support_img ? $thumbnail_id : 0, $set_img_align, $block_attr);
                            }
                            ?>
                            </li>
                        <?php } ?>
                    
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
         
<?php    }
}

?>