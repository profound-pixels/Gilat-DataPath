<?php
/**
 * Sample Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

if( get_field('block_id') ){
    $id = get_field('block_id');
}
else{
    $id = 'div-' . $block['id'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ppx-block-sample ppx-page-content uk-container';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Variables =============================================
$desktop_sidebar_card_width = 'uk-width-1-1';// Width of Cards in Sidebar
$desktop_sidebar_width = 'uk-width-1-3'; // Width of Sidebar on desktop
//
$subnav_visible = 'uk-hidden'; // Determines if subnav is visible or not
$subnav_nav = false;
//
$sidebar_visible = 'uk-hidden';

//========================================================


// Sidebar Settings ---------------------------------
$add_sidebar = get_field('add_sidebar') ?: false;

if($add_sidebar){
    $sidebar_visible = '';
} 


// Layout Settings ---------------------------------
$layout = get_field('layout') ?: 'small';

if($layout == 'large'){
    $desktop_sidebar_card_width = 'uk-width-1-2@l';
    $desktop_sidebar_width = 'uk-width-1-2@l uk-width-1-3@m';
} else {
    $desktop_sidebar_width = 'uk-width-1-3@m uk-width-1-4@l';
}

// Subnav Settings ---------------------------------
$add_subnav = get_field('add_subnav') ?: false;

if($add_subnav && $layout != 'large'){
    $subnav_visible = 'uk-visible@l';
    $subnav_nav = get_field('nav') ?: false;
    
    if(!$add_sidebar){
        $subnav_visible = 'uk-visible@m';
    }
}


?>



<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    
    
    <div class="uk-grid-small" uk-grid>
        
        <div id="page-content-main" class="uk-width-expand@m">
           
            <div class="uk-grid-collapse uk-grid-match uk-background-default" uk-grid>
               
                <div class="uk-width-1-4@m uk-width-1-3@l div-right <?php echo $subnav_visible; ?>">
                    <div id="ppx-content-main-nav">
                        <div class="uk-padding uk-padding-remove-bottom uk-margin-medium-bottom">
                            <h3 class="header-bar-margin-small">Menu</h3>
                        </div>
                        <?php 
                            if($subnav_nav){
                                wp_nav_menu( array(
                                    'theme_location'    => $subnav_nav,
                                    'menu_id'           => 'menu-subpage',
                                    'menu_class'        => 'secondary-menu uk-list-divider uk-nav uk-nav-default uk-dropdown-nav uk-nav-parent-icon',
                                    'container'         => 'div',
                                    'container_class'   => 'div-top',
                                ) );
                            }
                        ?>
                    </div><!--#ppx-content-main-nav-->
                </div>
                
                <div class="uk-width-expand@m">
                    <article  id="ppx-content-main-content" class="ppx-main-content uk-padding uk-padding-remove-horizontal">
                        <InnerBlocks  />
                    </article> <!--#ppx-content-main-content-->
                </div>
                
            </div><!--left grid-->
            
        </div><!--#page-content-main-->
        
        <aside id="page-content-secondary" class="<?php echo $desktop_sidebar_width .' '. $sidebar_visible; ?>">
                   
                <?php
       
                // Check value exists.
                if( have_rows('sidebar_content') ):

                    //$column = array(); //Push chosen column here
                    $counter = 0;

                    // Loop through rows.
                    while ( have_rows('sidebar_content') ){     
                        the_row();

                        $sidebar_column_class = get_sub_field('column_class') ?: ''; 
                        // Class for column containing sidebar item


                        // Print Markup ------------------------------------------------
                        echo '<div class="uk-grid-small" uk-grid><div class="'.$desktop_sidebar_card_width.' '.$sidebar_column_class.'"><div class="uk-card uk-card-body uk-card-default uk-text-small" >';

                        
                        // Case: Text Column ------------------------------------------------
                        if( get_row_layout() == 'text' ):

                            $txt_heading            = get_sub_field('heading') ?: false;
                            $txt_heading_size       = get_sub_field('heading_size') ?: 'h3';
                            $txt_heading_classes    = get_sub_field('heading_classes') ?: '';

                            $txt_excerpt            = get_sub_field('excerpt') ?: false;
                            $txt_excerpt_classes    = get_sub_field('excerpt_classes') ?: '';

                            $txt_link               = get_sub_field('link_url') ?: false;
                            $txt_link_text          = get_sub_field('link_text') ?: '';
                            $txt_link_classes       = get_sub_field('link_classes') ?: '';
                            //$txt_links              = get_sub_field('links') ?: '';

                            if($txt_heading):
                                echo '<'.$txt_heading_size.' class="'.$txt_heading_classes.'" >';
                                echo $txt_heading;
                                echo '</'.$txt_heading_size.'>';
                            endif;
                            if($txt_excerpt):
                                echo '<p class="'.$txt_excerpt_classes.'">';
                                echo $txt_excerpt;
                                echo '</p>';
                            endif;
                            if(have_rows('links')):
                                echo '<ul class="uk-nav uk-list uk-margin-medium-top uk-text-small">';
                                
                                // Loop through rows.
                                while ( have_rows('links') ){     
                                    the_row();
                                    
                                    $link_type      = get_sub_field('link_type') ?: 'text';
                                    $link_url       = get_sub_field('link_url') ?: false;
                                    $file_url       = get_sub_field('file_url') ?: false;
                                    $link_text      = get_sub_field('link_text') ?: '(No input)';
                                    $link_icon      = get_sub_field('link_icon') ?: 'triangle-right';
                                    $link_classes   = get_sub_field('link_classes') ?: '';
                                    
                                    
                                    if($link_type == 'text'){
                                        echo '<li><span class="uk-margin-small-right uk-text-warning" uk-icon="icon: '.$link_icon.'; ratio: .9"></span><span class="'.$txt_link_classes.'">'.$link_text.'</span></li>';
                                    }
                                    elseif($link_type == 'link'){
                                        echo '<li><a href="'.$link_url.'" class="'.$txt_link_classes.'" ><span class="uk-margin-small-right" uk-icon="icon: '.$link_icon.'; ratio: .9"></span>';
                                        echo $link_text;
                                        echo '</a></li>';
                                    }
                                    elseif($link_type == 'file'){
                                        echo '<li><a href="'.$file_url.'" class="'.$txt_link_classes.'" ><span class="uk-margin-small-right" uk-icon="icon: '.$link_icon.'; ratio: .9"></span>';
                                        echo $link_text;
                                        echo '</a></li>';
                                    }
                                    
                                    
                                }
                                echo '</ul>';
                                
                            endif;
                            if($txt_heading == false && $txt_excerpt == false && $txt_link == false):
                                echo '<h3 class="header-bar header-bar-muted">Empty</h3>';
                                echo '<p>No content added to this item.</p>';
                            endif;

                        // Case: Custom HTML  ------------------------------------------------
                        elseif( get_row_layout() == 'empty_column' ):
                            echo get_sub_field('html') ?: '';

                       endif;

                        echo '</div></div></div>'; // end uk-grid div

                        $counter++;
                    // End loop.
                    } //endwhile;

                // No value.
                else:
                   echo '<div uk-grid><div><div class="uk-card uk-card-body uk-card-default" >No Content</div></div></div>';
                endif;
                ?>
            
        </aside><!--page-content-secondary-->
        
    </div>
    
    
    
</section>