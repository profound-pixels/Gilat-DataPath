<?php
    $thumb_id = false;
    if( get_post_thumbnail_id() ){
        $thumb_id = get_post_thumbnail_id();
    }

if($thumb_id):
?>


<header class="page-header uk-margin-bottom">
    <div class="uk-container">
       
        <div class="uk-inline uk-width-1-1">
            <div class="page-header-card product-card uk-padding uk-background-primary uk-light">   
                <div class="page-header-card-content">
                   <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                          yoast_breadcrumb( '<ul class="uk-breadcrumb uk-text-uppercase">','</ul>' );
                        }
                    ?>

                    <div class="uk-padding-large uk-width-1-2@s uk-width-1-2@m">
                     <?php
                        the_title( '<h1 class="page-title header-bar-short header-bar-margin-large">', '</h1>' );
                     ?>
                     <?php if(get_the_excerpt()){  the_excerpt();  } ?>
                     </div>
                </div>
            </div>
            
            <div class="uk-position-small uk-position-bottom-right product-img-wrapper uk-text-center">
                <img class="product-img" data-src="<?php echo wp_get_attachment_image_url($thumb_id, 'xl'); ?>" alt="" uk-img>
            </div>
        </div>
        
    </div>
</header><!-- .page-header -->

<?php else: ?>

<header class="page-header uk-margin-bottom">
    <div class="uk-container">
        <div class="page-header-card uk-padding uk-background-primary uk-light">
            
            <div class="page-header-card-content">
               <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                      yoast_breadcrumb( '<ul class="uk-breadcrumb uk-text-uppercase">','</ul>' );
                    }
                ?>
               
                <div class="uk-padding-large uk-width-1-2@s">
             <?php
             if(is_home()):
                $id_frontpage = get_option('page_for_posts');
                echo '<h1 class="page-title header-bar-short header-bar-margin-large">'.get_the_title( $id_frontpage ).'</h1>';
            
            elseif(is_archive()):
               if(single_term_title()){
                   single_term_title( '<h1 class="page-title header-bar-short header-bar-margin-large">', '</h1>' );
               }
                else{
                    the_archive_title( '<h1 class="page-title header-bar-short header-bar-margin-large">', '</h1>' );
                }
               //the_archive_description( '<div class="archive-description">', '</div>' ); 
             
            elseif(is_search()):
                /* translators: %s: search query. */
                echo '<h1 class="page-title header-bar-short header-bar-margin-large">';
                printf( esc_html__( 'Search Results for: %s', 'ppx-starter' ), '<span>' . get_search_query() . '</span>' );
                echo '</h1>';
            
            else:
                the_title( '<h1 class="page-title header-bar-short header-bar-margin-large">', '</h1>' );
            endif;
             //uk-flex uk-flex-middle uk-flex-left
             ?>
             <?php if(get_the_excerpt()): ?>
                
                 <?php the_excerpt(); ?> 
                
             <?php endif; ?>
         </div>
            </div>
        </div>
    </div>
</header><!-- .page-header -->

<?php endif; ?>
