<?php
/**
 ** TILE LOOP TEMPLATE
 **/


class tileView extends viewBase
{

   public function render(){ ?>
        
       <div class="uk-child-width-1-2@s uk-grid-collapse uk-text-center" uk-grid>
       
       <?php while($this->query->have_posts()):
            $this->query->the_post();?>
            <div>
                <div class="uk-tile uk-tile-muted">
                    <h3 class="uk-h4"><?php echo get_the_title(); ?></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
            </div>    
        <?php endwhile;
    }
}

?>