<header class="page-header uk-inline uk-width-expand uk-margin-bottom">
  
    <div class="uk-container">
    
      
      <div class="uk-padding-large uk-background-default">
      <div class="uk-container uk-container-xsmall"> 
        
             <?php
          
                if(is_archive()):
                     the_archive_title( '<h1 class="page-title header-bar header-bar-short header-bar-margin-large uk-text-capitalize">', '</h1>' );
                     //the_archive_description( '<div class="archive-description">', '</div>' );
                 else:
                     the_title( '<h1 class="page-title header-bar header-bar-short header-bar-margin-large uk-text-capitalize">', '</h1>' );
                 endif;
                 //uk-flex uk-flex-middle uk-flex-left

                echo '<span class="uk-margin-small-right">';
                ppx_starter_posted_on();
                echo '</span>';

                ppx_category_single();
            
             ?>
         </div>
        </div>
          <?php
            $thumb_id = get_post_thumbnail_id() ? get_post_thumbnail_id() : false;
            if(get_post_thumbnail_id()):
        ?>

            <div class="uk-cover-container uk-height-large uk-background-muted">
            <?php echo get_img(get_post_thumbnail_id(), 'xl', '', 'uk-cover'); ?>
            </div>
        <?php endif; ?>
     </div>

</header><!-- .page-header -->