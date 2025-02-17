<?php
/**
 ** FILTER LOOP TEMPLATE
 **/


class filterView extends viewBase
{
    public function render(){ ?>
    
    <?php  // GLOBAL ---------------------------------------------------

        // Set filter target
        $filter_class = 'js-filter-' . $this->id;

        // Card settings
        $set_support_load_more  = $this->settings['card']['support_load_more'] ?: false;
        $set_load_more_btn_text = $this->settings['card']['load_more_btn_text'] ?: 'Load More';   

        // Filter settings
        $set_filter_on          = $this->settings['filter']['filter_on'] ?: '';
        $set_filter_terms       = $this->settings['filter']['filter_terms'] ?: [];
        $set_filter_tags        = $this->settings['filter']['filter_tags'] ?: [];

        $filter_items = [];
        switch ($set_filter_on) {
            case 'taxonomy':
                if(is_array($set_filter_terms)){
                    $filter_items = $set_filter_terms;
                }
                break;
            case 'tags':
                if(is_array($set_filter_tags)){
                    $filter_items = $set_filter_tags;
                }
                break;
            default:
                break;
        }

    ?>
    <?php  // TOP LEVEL BLOCK -------------------------------------------
        
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }
        
        // Set classes variable
        $block_classes = $this->classes;
        
        // Unconditional classes
        $block_classes .= ' uk-grid-match '.$filter_class;
        
        // Set grid columns
        $columns = $this->settings['card']['columns'];
        $block_classes .= ' '.$columns;
    ?>
    <div <?php echo $block_id; ?> uk-filter="target: .<?php echo $filter_class; ?>">
       
    <?php  // FILTER NAVIGATION ----------------------------------------
        
        //Set Navigation Attributes & Classes
        $nav_attr = $this->settings['attr']['attr_nav'] ?: '';
        $nav_classes = $this->settings['attr']['class_nav'] ?: '';       
    ?>
        <ul class="uk-subnav uk-subnav-pill<?php echo $nav_classes; ?>" <?php echo $nav_attr; ?>>
            <li class="uk-active" uk-filter-control><a href="#">All</a></li>
            <?php foreach ($filter_items as $key => $item) {
                ?> 
                <li uk-filter-control="[data-<?php echo $set_filter_on; ?>*='<?php echo $item['value']; ?>']"><a href="#"><?php echo $item['label']; ?></a></li>
                <?
            }
            ?>
        </ul>
        
    <?php // UL SETTINGS ----------------------------------------      
            
        //Set UL Attributes & Classes
        $ul_attr = $this->settings['attr']['attr_ul'] ?: '';
        $ul_classes = $this->settings['attr']['class_ul'] ?: '';
        
    ?>
        <ul class="<?php echo $block_classes; ?> <?php echo $ul_classes; ?>" <?php echo $ul_attr; ?> uk-grid>
            <?php $this->renderPosts(); ?>
        </ul>
    </div>
    <?php }

    public function renderPosts(){
        // Card settings
        $set_support_link   = $this->settings['card']['support_link'] ?: false;
        $set_support_img    = $this->settings['card']['support_img'] ?: false;
        $set_img_align      = $this->settings['card']['img_alignment'] ?: '';    

        while($this->query->have_posts())
        {
            $this->query->the_post();

            // Filter on setting
            $set_filter_on          = $this->settings['filter']['filter_on'] ?: '';
            $set_filter_taxonomy    = $this->settings['filter']['filter_taxonomy'] ?: [];

            $filter_data = '';
            switch ($set_filter_on) {
                case 'taxonomy':
                    $terms = get_the_terms(get_the_ID(), $set_filter_taxonomy);
                    if(is_array($terms)){
                        foreach($terms as $term) {
                            $filter_data .= $term->slug . ' '; 
                        }
                    }
                    break;
                case 'tags':
                    $tags = get_the_tags();
                    if(is_array($tags)){
                        foreach($tags as $tag) {
                            $filter_data .= $tag->slug . ' '; 
                        }
                    }
                    break;
                default:
                    break;
            }

            // Get thumbnail id
            $thumbnail_id = get_post_thumbnail_id();

            // Permalink
            $permalink = get_permalink();
            
            // LI SETTINGS ----------------------------------------      
            
            //Set LI Attributes & Classes
            $li_attr = $this->settings['attr']['attr_li'] ?: '';
            $li_classes = $this->settings['attr']['class_li'] ?: '';
            
            // Filter info
            ?>  <li class="<?php echo $li_classes; ?>" <?php if(!empty($filter_data)): ?> data-<?php echo $set_filter_on; ?>="<?php echo rtrim($filter_data); ?>" <?php endif; ?> <?php echo $li_classes; ?>> <?
            
            
            // CARD SETTINGS ----------------------------------------      
            
            //Package All Attributes & Classes
            $block_attr = $this->settings['attr'] ?: [];
            
            // Get card
            ppx_get_card(get_the_title(), get_the_excerpt(), $set_support_link ? $permalink : '', $set_support_img ? $thumbnail_id : 0, $set_img_align, $block_attr);

            ?> </li> <?
        }
    }
}

?>