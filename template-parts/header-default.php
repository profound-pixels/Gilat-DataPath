<?php
    $thumb_id = false;
    if(get_post_thumbnail_id() && !is_home() && !is_archive() && !is_search()){
        $thumb_id = get_post_thumbnail_id();
    }

if($thumb_id):
?>

<header class="page-header uk-margin-bottom">
    
     <div class="uk-container">
        <div class="page-header-card uk-inline uk-width-1-1 uk-light has-feature uk-background-cover" uk-img data-src="<?php echo wp_get_attachment_image_url($thumb_id, 'xxl'); ?>" data-srcset="<?php echo wp_get_attachment_image_srcset($thumb_id, 'xxl'); ?>" data-sizes="<?php echo wp_get_attachment_image_sizes($thumb_id, 'xxl'); ?>">
            
            <div class="page-header-card-content uk-overlay-primary uk-position-cover uk-padding">
               <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                      yoast_breadcrumb( '<ul class="uk-breadcrumb uk-text-uppercase">','</ul>' );
                    }
                ?>
               
                <div class="uk-padding-large uk-width-1-2@s uk-width-1-2@m">
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
                     <?php if(has_excerpt()): ?>

                         <?php the_excerpt(); ?> 

                     <?php endif; ?>
                 </div>
            </div><!-- .page-header-card-content -->
            
        </div><!-- .page-header-card -->
    </div><!-- .uk-container -->
    
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
               
                <div class="uk-padding-large uk-width-1-2@s uk-width-1-2@m">
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
             <?php if(has_excerpt()): ?>
                
                 <?php the_excerpt(); ?> 
                
             <?php endif; ?>
         </div>
            </div>
        </div>
    </div>
</header><!-- .page-header -->

<?php endif; ?>
