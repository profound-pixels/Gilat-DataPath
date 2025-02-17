<?php
/**
 ** TILE LOOP TEMPLATE
 **/


class tileView extends viewBase
{

    public function render(){ 
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }

        // Set classes variable
        $block_classes = $this->classes;

        // Unconditional classes
        $block_classes .= ' uk-grid-match';                        
?>
           
        <div <?php echo $block_id; ?> class="<?php echo $block_classes; ?>" uk-grid>
       
       <?php while($this->query->have_posts()):
            $this->query->the_post();?>
            <div>
                <div class="uk-tile-muted">
                    <h3 class="uk-h4"><?php echo get_the_title(); ?></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
            </div>    
        <?php endwhile; ?>
        </div>
    }
}

?>