<?php

if ( ! function_exists( 'ppx_author_grid' ) ):
	
	function ppx_author_grid($author, $img_id = false, $postion = false, $date = false){
?>
    <address>
        <div class="uk-grid-small uk-flex-middle" uk-grid>
        <?php if($img_id): ?>
            <div class="uk-width-auto">
               
               <?php get_img($img_id,'thumbnail','uk-border-circle','','Author Profile Picture','50','50') ?>;
               
                <?php //<img class="uk-border-circle" width="50" height="50" alt="Author Profile Picture"> ?>
            </div>
        <?php endif; ?>

            <div class="uk-width-expand">
                <p class="uk-margin-remove-bottom" rel="author"><?php echo $author; ?></p>
                <?php if($postion && ! $date): ?>
                    <p class="uk-text-meta uk-margin-remove-top"><?php echo $postion; ?></p>
                <?php endif; ?> 
                
                <?php if($date): ?>  
                    <p class="uk-text-meta uk-margin-remove-top"><?php ppx_starter_posted_on(); ?></p>
                <?php endif; ?> 
            </div>
        </div>
    </address>

<?php

	}
endif;

if ( ! function_exists( 'ppx_author_line' ) ):
	
	function ppx_author_line($author, $img_id = false, $postion = false, $date = false){
        
        
    $position_print = $postion ? ', <i>'.$postion.'</i>' : '';
    $author_print = $author ? 'By '.$author. ' | ' : '';
    
?>

<div><?php echo $author_print.''.$position_print; ppx_starter_posted_on(); ?></div>


<?php

	}
endif;