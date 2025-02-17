<?php
/**
 ** CODE VIEW
 **/

class codeView extends viewBase
{

    public function render(){ 
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }

        // Set classes variable
        $block_classes = $this->classes;

        // Unconditional classes
        //$block_classes .= ' uk-grid-match';
        
        // Custom Wrapper classes
        $block_classes .= ' '.$this->settings['attr']['class_wrap'] ?: '';
        
        // Custom Wrapper Atrributes
        $wrapper_attr = $this->settings['attr']['attr_wrap'] ?: '';
        
        $code_view = $this->settings['code_view'];
        
        
?>
             
           
        <div <?php echo $block_id; ?> class="<?php echo $block_classes; ?>" <?php echo $wrapper_attr; ?>>
       
       <?php while($this->query->have_posts()):
            $this->query->the_post();
       
                // Store section content fields
                //$code_view = get_field('code_view');   
                ppx_get_code($code_view);
               
         endwhile; ?>
        </div>
<?php   }
}


// FUNCTION TO PRINT OUT CODE VIEW
if ( ! function_exists( 'ppx_get_code' ) ) :
function ppx_get_code($code_view = false){
     // Check value exists.
      if( $code_view ):

          // Loop through rows.
          foreach ( $code_view as $view ){   
              
              // Case: Custom Code ------------------------------------------------
              if($view['acf_fc_layout'] == 'code'){
                  echo $view['text'] ?: '';
              }
              
              // Case: Wordpress Post Data -----------------------------------------
              elseif($view['acf_fc_layout'] == 'wp_data'){
                
                  $thumb_id = get_post_thumbnail_id(get_the_ID());
                
                switch ($view['ppx_wp_field']) {
                    case 'ppx_permalink':
                        echo get_permalink(get_the_ID());
                        break;
                        
                    case 'ppx_thumbnail':
                        echo get_the_post_thumbnail_url(get_the_ID());
                        break;
                        
                    case 'ppx_author':
                        echo get_the_author_meta('display_name',get_post_field('post_author'));
                        break;
                        
                    case 'ppx_thumb_img_small':
                        get_img($thumb_id,'thumbnail');
                        break;
                        
                    case 'ppx_thumb_img_medium':
                        get_img($thumb_id,'small');
                        break;
                        
                    default:
                       $post_field = get_post_field($view['ppx_wp_field']);
                        echo $post_field;
                } 
                  
//                  if( strtotime($post_field)){
//                      echo date_format(date_create($post_field), 'm/d/Y');
//                  }
//                  else{
                      //echo $post_field;
                  //}
              }
              
              // Case: Wordpress Post Data -----------------------------------------
              elseif($view['acf_fc_layout'] == 'custom_data'){
                  //echo get_field($view['ppx_custom_field'],get_the_ID());
                  
                  echo get_post_meta( get_the_ID(), $view['ppx_custom_field'], true );
                  //echo $view['ppx_custom_field'];
                  //echo get_post_meta(get_the_ID(), $view['ppx_custom_field']);
              }
              
              
          } //end forech;
      
      // No value.
      else:
         echo "<div>";
          ppx_no_content_card();
         echo "</div>";
      endif;
}
endif;


?>