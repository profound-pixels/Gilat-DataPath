<?php
/**
 * Two Column Section
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
$className = 'ppx-content-grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

//$var1 = get_field('field') ? 'string' : '';

//Section Vars --------------------------------------
$section_attr = get_field('section_attr') ?: '';

// Section BG img attributes
$bg_img_id = get_field('bg_img') ?: false;
if($bg_img_id){
    $section_attr .= ' '.get_img($bg_img_id,'xxl','','','','','','',true);
}

// Section BG Styles
$section_bg = get_field('bg_styles') ?: '';

if($section_bg != ''){
    foreach($section_bg as $bg_style){
        $className .= ' '.$bg_style;
    }
}
//Add Section Padding
$make_section = get_field('make_section') ? 'uk-section' : '';
$className .= ' '.$make_section;
    


// Grid Vars ----------------------------------------
$grid_classes = get_field('cell_spacing') ?: '';

// Set Col layout
$grid_columns = get_field('grid_columns');
$grid_classes .= ' '.$grid_columns;

// Set Cell Spacing
$cell_spacing = get_field('cell_spacing');
$grid_classes .= ' '.$cell_spacing ?: '';

// Grid height
$grid_classes .= ' '.get_field('grid_height') ?: '';

// Grid item arrangement
$grid_arrangement = get_field('arrangement') ?: '';

if($grid_arrangement != ''){
    foreach($grid_arrangement as $arrange_style){
        $grid_classes .= ' '.$arrange_style;
    }
}


// Col Vars -----------------------------------------
// Array to Store Column Field Settings
$column_settings = get_field('column_settings') ?: '';


       


 ?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" <?php echo $section_attr; ?>>
  
   <div class="<?php echo esc_attr($grid_classes); ?>" uk-grid>
   
    <?php
       
    // Store section content fields
    $section_content = get_field('section_content');
    
       
    // Check value exists.
    if( have_rows('section_content') ):
        
        //$column = array(); //Push chosen column here
        $counter = 0;
            
        // Loop through rows.
        while ( have_rows('section_content') ){     
            the_row();
            
            //Set Column Variables -----------------------------------------
            
            //Set variable to contain current column settings
            $column = array_key_exists($counter, $column_settings)  ? $column_settings[$counter] : $column_settings[0];
            
            //Col attributes
            $column_attrs = $column['attrs'] ?: '';
            
            //Col classes
            $column_classes = $column['classes'] ?: '';
            
            //Col height
            $column_classes .= ' '.$column['height'] ?: '';
            
            //Col content container cover (for cropped img feature)
            $activate_cover = '';
            if( get_row_layout() == 'canvas_img' ){
                $activate_cover = 'uk-cover-container';
            } 
            
            
            //Col width
            $column_widths = $column['column_width'] ?: '';
            $column_width_classes = '';
            
            if($column_widths != ''){
                foreach($column_widths as $width){
                    $column_width_classes .= $width.' ';
                }
            }
            
            $column_width = ' class="'.$column_width_classes.'" ' ?: '';
            
            
            //Col content width
            $content_widths = $column['content_width'] ?: '';
            $content_width_classes = '';
            
            if($content_widths != ''){
                foreach($content_widths as $width){
                    $content_width_classes .= $width.' ';
                }
            }
            
            $content_width = ' class="'.$content_width_classes.' '.$activate_cover.'" ' ?: '';
            
            
            
            // Col BG img attributes
            $bg_img_id = $column['bg_img'] ?: false;
            if($bg_img_id){
                $column_attrs .= ' '.get_img($bg_img_id,'xl','','','','','','',true) ?: '';
            }
            //Add padding col classes
            $column_padding = $column['padding'] ?: '';
            
            if($column_padding != ''){
                foreach($column_padding as $padding_val){
                    $column_classes .= ' '.$padding_val;
                }
            }
            
            //Add BG styles
            $column_bg = $column['bg_styles'] ?: '';
            
            if($column_bg != ''){
                foreach($column_bg as $bg_style){
                    $column_classes .= ' '.$bg_style;
                }
            }
            
            
            //Add horizontal positioning to classes
            $h_pos_settings = $column['h_position'] ?: '';
            
            if($h_pos_settings != ''){
                foreach($h_pos_settings as $h_pos){
                    $position = $h_pos['position'] ?: '';
                    $screen_size = $h_pos['screen_size'] ?: '';
                    $position .= $screen_size;
                    
                    $column_classes .= ' '.$position;
                }
            }
            
            // Add vertical positioning to classes
            $v_pos = $column['v_position'] ?: '';
            $column_classes .= ' uk-flex '.$v_pos;
            
            //echo $column_classes;
            //echo $column_attrs;
            //print_r($column_settings);
            
            
            // Print Markup ------------------------------------------------
            echo '<div'.$column_width.'><div class="'.esc_attr($column_classes).'" '.$column_attrs.' ><div'.$content_width.'>';
       
            // Case: Gutenberg Block Column ------------------------------------------------
            if( get_row_layout() == 'block_area' ): ?>
               <InnerBlocks  />
            
            <?php        
            // Case: Text Column ------------------------------------------------
            elseif( get_row_layout() == 'text' ):
            
                $txt_heading            = get_sub_field('heading') ?: false;
                $txt_heading_size       = get_sub_field('heading_size') ?: 'h3';
                $txt_heading_classes    = get_sub_field('heading_classes') ?: '';
            
                $txt_excerpt            = get_sub_field('excerpt') ?: false;
                $txt_excerpt_classes    = get_sub_field('excerpt_classes') ?: '';
            
                $txt_link               = get_sub_field('button_url') ?: false;
                $txt_link_text          = get_sub_field('button_text') ?: '';
                $txt_link_classes       = get_sub_field('button_classes') ?: '';
                
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
                if($txt_link):
                    echo '<a href="'.$txt_link.'" class="'.$txt_link_classes.'" >';
                    echo $txt_link_text;
                    echo '</a>';
                endif;
                if($txt_heading == false && $txt_excerpt == false && $txt_link == false):
                    ppx_no_content_card();
                endif;
                
       
            // Case: Responsive Cropped Image ------------------------------------------------
            elseif( get_row_layout() == 'canvas_img' ):
                
                $img_id             = get_sub_field('img') ?: '';
                $media_classes      = get_sub_field('media_classes') ?: '';
                $canvas_width       = get_sub_field('width') ?: '';
                $canvas_height      = get_sub_field('height') ?: '';
                $canvas_classes     = get_sub_field('canvas_classes') ?: '';
                $add_responsive     = get_sub_field('add_responsive') ?: false; 
            
                if($add_responsive){
                    $canvas_width_mobile       = get_sub_field('width_mobile') ?: '480';
                    $canvas_height_mobile      = get_sub_field('height_mobile') ?: '320';
                    $canvas_width_tablet       = get_sub_field('width_tablet') ?: '800';
                    $canvas_height_tablet      = get_sub_field('height_tablet') ?: '600';
                    
                    echo '<canvas class="'.$canvas_classes.' uk-visible@m" width="'.$canvas_width.'" height="'.$canvas_height.'"></canvas>';
                    
                    echo '<canvas class="'.$canvas_classes.' uk-visible@s uk-hidden@m" width="'.$canvas_width_tablet.'" height="'.$canvas_height_tablet.'"></canvas>';
                    
                    echo '<canvas class="'.$canvas_classes.' uk-hidden@s" width="'.$canvas_width_mobile.'" height="'.$canvas_height_mobile.'"></canvas>';
                    
                }
                else{
                    //echo '<div class="uk-cover-container">';
                    echo '<canvas class="'.$canvas_classes.'" width="'.$canvas_width.'" height="'.$canvas_height.'"></canvas>';
                    //echo '</div>';
                }
                get_img($img_id, 'large', $media_classes , 'uk-cover');
            
            
            // Case: Image ------------------------------------------------
            elseif( get_row_layout() == 'img' ):
                
                $img_id             = get_sub_field('img') ?: '';
                $img_alt            = get_sub_field('img_alt') ?: '';
                $img_title          = get_sub_field('img_title') ?: '';
                $media_classes      = get_sub_field('media_classes') ?: '';
                $img_width          = get_sub_field('width') ?: '';
                $img_height         = get_sub_field('height') ?: '';
                $add_link           = get_sub_field('add_link') ?: false; 
                $img_attr           = get_sub_field('media_attr') ?: '';
            
                $link_url           = get_sub_field('link_url') ?: false;
                $link_attr          = get_sub_field('link_attr') ?: '';
                $link_classes       = get_sub_field('link_classes') ?: '';
                    
                
                if($add_link){
                    echo '<a href="'.$link_url.'" class="'.$link_classes.'" '.$link_attr.'>';
                }
                
                get_img($img_id, 'large', $media_classes, $img_attr, $img_alt, $img_width, $img_height, $img_title);
            
            
                if($add_link):
                    echo "</a>"; 
                endif;
            
            //get_img(id,system size,classes,meta,alt,width,height,title,bg?);
            
            // Case: Empty Column (Background Images) ------------------------------------------------
            elseif( get_row_layout() == 'empty_column' ):
                echo get_sub_field('html') ?: '';
            
           endif;

            echo '</div></div></div>'; // end uk-grid div
            
            $counter++;
        // End loop.
        } //endwhile;

    // No value.
    else:
       echo "<div>";
        ppx_no_content_card();
       echo "</div>";
    endif;
    ?>
    
    </div>
</div>
