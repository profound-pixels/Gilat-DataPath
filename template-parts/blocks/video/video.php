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
$className = 'ppx-single-video';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


//$var1 = get_field('field') ? 'string' : '';
//$vID = get_field('video_post') ?: false;


?>


<?php if( get_field("video") ): ?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
   <div class="uk-grid">
       <div class="uk-width-2-3@l">
           <div class="embed-container">
               <?php 
                    $vid = get_field("video"); 
                    // Add extra attributes to iframe HTML.
                    $attributes = 'class="  " uk-responsive';
                    $vid = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $vid);
                    echo $vid;
               ?>
           </div>
       </div>
       <div class="uk-width-1-3@l<?php //uk-flex uk-flex-middle ?>">
           
           <div class="vid-content uk-margin-large-top">
              
               <?php 
                $txt_heading           = get_field('heading') ?: false;
                $txt_heading_size      = get_field('heading_size') ?: 'h3';
                $txt_heading_classes   = get_field('heading_classes') ?: '';
            
                $txt_excerpt           = get_field('excerpt') ?: false;
                $txt_excerpt_classes   = get_field('excerpt_classes') ?: '';
            
                $txt_link              = get_field('button_url') ?: false;
                $txt_link_text         = get_field('button_text') ?: '';
                $txt_link_classes      = get_field('button_classes') ?: '';
                
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
               ?>
           </div>
           
       </div>
   </div>
</div>
<?php else: 
ppx_no_content_card();
endif; ?>