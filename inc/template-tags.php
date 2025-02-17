<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PPx_Starter_Theme
 */

require get_template_directory() . '/inc/layout-functions.php';

//PPX-TTAGS 1.0 POST DATE / TIME META
if ( ! function_exists( 'ppx_starter_posted_on' ) ) :
	/**
	 * Prints current post's date/time.
	 */
	function ppx_starter_posted_on($link = true) {
        
        $publish_prefix = ''; //'Published ';
		
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published uk-text-small" datetime="%1$s"><span uk-icon="icon: clock; ratio: .8"></span> <span class="uk-text-bottom"> %2$s </span></time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
        
        if($link){
            $posted_on = sprintf(
                /* translators: %s: post date. */
                esc_html_x( $publish_prefix.'%s', 'post date', 'ppx-starter' ),
                '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
            );
            echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
        }
        else{
           echo '<span class="posted-on">' . $time_string . '</span>'; // WPCS: XSS OK. 
        }
		
	}
endif;


//PPX-TTAGS 2.0 UPDATED DATE / TIME META
if ( ! function_exists( 'ppx_starter_updated_on' ) ) :
	/**
	 * Prints current post's update time.
	 */
	function ppx_starter_updated_on($link = true) {
        $update_prefix = 'Updated ';
        $update_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $update_string = '<time class="updated" datetime="%3$s">%4$s</time>';
        }
        
        $update_string = sprintf( $update_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
        
        if($link){
            $updated_on = sprintf(
                /* translators: %s: update date. */
                esc_html_x( $update_prefix.'%s', 'post date', 'ppx-starter' ),
                '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $update_string . '</a>'
            );
            echo '<span class="updated-on">' . $updated_on . '</span>'; // WPCS: XSS OK.
        }
        else{
            echo '<span class="updated-on">' . $update_string . '</span>'; // WPCS: XSS OK.    
        }   
    }
endif;

//PPX-TTAGS 3.0 AUTHOR META
if ( ! function_exists( 'ppx_starter_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ppx_starter_posted_by($type = '', $show_date = false) {
        
        $author_id = get_the_author_meta('ID');
        $author_prefix = '';
        $author_pic = get_field('profile_picture', 'user_'. $author_id );
        $author_position = get_field('position', 'user_'. $author_id );
        
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( $author_prefix.'%s', 'post author', 'ppx-starter' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		
        if($type == 'grid' && ! $show_date){
            ppx_author_grid($byline, $author_pic, $author_position);
        }
        elseif($type == 'grid' && $show_date){
            ppx_author_grid($byline, $author_pic, $author_position, true); 
        }
        elseif($type == 'line' && $show_date){
            ppx_author_line($byline, null, null, true); 
        }
        else{
            echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
        }
        

	}
endif;


//PPX-TTAGS 4.0 POST FOOTER
if ( ! function_exists( 'ppx_starter_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ppx_starter_entry_footer() {
        
        //echo '<div><strong>PPX-TTAGS 4.0</strong></div>';
        
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
        
            ppx_tag_list();
		}

		

	}
endif;


//PPX-TTAGS 5.0 LIST TAGS LINKS
if ( ! function_exists( 'ppx_tag_list' ) ) :
	/**
	 * Prints list of item tags
	 */
	function ppx_tag_list() {
        
        $taglist_prefix = '';
        
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '<li>','</li><li>','</li>' );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<nav class="uk-padding uk-padding-remove-horizontal div-top" uk-navbar><ul class="tags-links uk-subnav">' . esc_html__( $taglist_prefix.'%1$s', 'ppx-starter' ) . '</ul></nav>', $tags_list ); // WPCS: XSS OK.
        }
        
    }
endif;

//PPX-TTAGS 6.0 LIST CATEGORY LINKS
if ( ! function_exists( 'ppx_category_list' ) ) :
	/**
	 * Prints list of categories
	 */
	function ppx_category_list() {
        
        
        $catlist_prefix = "Posted in";
        
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ppx-starter' ) );
        
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( $catlist_prefix.' %1$s', 'ppx-starter' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
        
    }
endif;

//PPX-TTAGS 6.1 DISPLAY SINGLE CATEGORY
if ( ! function_exists( 'ppx_category_single' ) ) :
	/**
	 * Prints list of categories
	 */
	function ppx_category_single() {
        
        $categories = get_the_category();
        if ( ! empty( $categories ) ){
        
            echo '<span class="uk-text-small uk-text-meta"><span uk-icon="icon: bookmark; ratio: .9"></span> <span class="uk-text-bottom">'. esc_html( $categories[0]->name ) .'</span></span>';
        
        }
    }
endif;


//PPX-TTAGS 7.0 PRINT COMMENT LINK
if ( ! function_exists( 'ppx_comment_link' ) ) :
	/**
	 * Prints Comment invite link or Comment Count Link
	 */
	function ppx_comment_link() {
        
        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ppx-starter' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
        
    }
endif;


//PPX-TTAGS 8.0 POST THUMBNAIL
if ( ! function_exists( 'ppx_starter_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function ppx_starter_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
            ?>
            <?php //PPX-TTAGS 4.1 - Thumbnail in single view
                echo '<div><strong>PPX-TTAGS 4.1</strong></div>';
            ?>
            
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
           
            <?php //PPX-TTAGS 4.2 - Thumbnail in index or loop view
                echo '<div><strong>PPX-TTAGS 4.1</strong></div>';
            ?>
        
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


//PPX-TTAGS 9.0 POST PAGINATION
if ( ! function_exists( 'pagination_nav' ) ) :
function pagination_nav() {
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;
    $translated = __( 'Page', 'ppx-starter' ); // Supply translatable string

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => '« Prev',
            'next_text' => 'Next »',
            'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
        ));
    }
}
endif;

//PPX-TTAGS 10.0 CONTAINER CLASS

wp_cache_set('ppx_enable_container',true);
wp_cache_set('ppx_contentFullWidth','uk-width-1-1');
wp_cache_set('ppx_contentSidebarWidth','uk-width-2-3@m');
wp_cache_set('ppx_sidebarWidth','uk-width-1-3@m');

if ( ! function_exists( 'ppx_starter_enable_container' ) ) :
function ppx_starter_enable_container(){
    
    $ppx_enable_container = wp_cache_get('ppx_enable_container');
    $container_classes = null;
    
    if( $ppx_enable_container ){
        $container_classes = 'uk-container';
    }
    
    return $container_classes;
}

endif;

//PPX-TTAGS 11.0 RESPONSIVE IMG FUNCTION 
if ( ! function_exists( 'get_img' ) ) :
function get_img($id, $size, $classes = '', $meta = '', $alt = null, $width = null, $height = null, $title = null, $bg = false){
    
    //get_img(id,system size,classes,meta,alt,width,height,title,bg?);
    if($width && $height){
    $meta .= ' width="'.$width.'" height="'.$height.'" ';
    }

    if($alt){
        $meta .= ' alt="'.$alt.'" ';
    }
    if($title){
        $meta .= ' title="'.$title.'" ';
    }
    $meta .= ' class="'.$classes.'"';
    
    
    if( $bg ){
        $data_result = 'data-src="'. wp_get_attachment_image_url( $id, $size ) .'" data-srcset="'. wp_get_attachment_image_srcset( $id, $size ) .'" sizes="'. wp_get_attachment_image_sizes( $id, $size ) .'" uk-img';
        return $data_result;
    }
    else{
        echo '<img uk-img data-src="'. wp_get_attachment_image_url( $id, $size ) .'" 
        data-srcset="'. wp_get_attachment_image_srcset( $id, $size ) .'"
        sizes="'. wp_get_attachment_image_sizes( $id, $size ) .'" '.$meta.'/>';
    }   
}

endif;

//PPX-TTAGS 12.0 CARD FUNCTION
if ( ! function_exists( 'ppx_get_card' ) ) :
	function ppx_get_card($title, $body, $link, $thumbnail_id, $img_align, $attr, $link_text = null, $link_type = "link"){
        // Set show media bool variable
        $show_card_media = $thumbnail_id > 0;

        // Set card classes
        $card_classes = 'uk-card uk-card-default';
        if($attr['class_post']){
            $card_classes .= " ".$attr['class_post'];
        }
        
        
        // Set card media classes
        $card_media_classes = '';

        // Set canvas classes
        $canvas_classes = '';

        // Set horizontal boolean
        $horizontal = false;

        // Conditional card and card media classes
        switch ($img_align) {
            case 'top':
                $card_media_classes .= 'uk-card-media-top uk-cover-container';
                $canvas_classes .= 'uk-width-expand';
                break;
            case 'right':
                $horizontal = true;
                $card_classes .= ' uk-grid-collapse uk-child-width-1-2@s uk-margin';
                $card_media_classes .= 'uk-card-media-right uk-flex-last@s uk-cover-container';
                break;
            case 'bottom':
                $card_media_classes .= 'uk-card-media-bottom uk-cover-container';
                $canvas_classes .= 'uk-width-expand';
                break;
            case 'left':
                $horizontal = true;
                $card_classes .= ' uk-grid-collapse uk-child-width-1-2@s uk-margin';
                $card_media_classes .= 'uk-card-media-left uk-cover-container';
                break;
            default:
                break;
        }

        // Image data
        $image_data = $show_card_media ? wp_get_attachment_image_src($thumbnail_id, 'xxl') : [];

        // Image dimensions
        $image_width = $show_card_media ? $image_data[1] : 0;
        $image_height = $show_card_media ? $image_data[2] : 0;

        // Header styles
        $header_styles = '';
        if( !empty($attr['header_styles']) ){
            $header_styles =  $attr['header_styles'] ?: '';
        }
        
        // Content settings
        $center_content = '';
        if ( !empty($attr['center_content']) ){
            $center_content = ' uk-flex uk-flex-middle uk-card-large';
        }
        ?>
            
        <div>
            <div class="<?php echo $card_classes; ?>" <?php if($horizontal){ echo 'uk-grid'; } ?>>
                <!-- Card Media (top, left, right) -->
                <?php if($show_card_media && $img_align == 'top'): ?>
                    <div class="<?php echo $card_media_classes; ?>">
                        
                        <?php echo get_img($thumbnail_id, 'large', 'uk-disabled', 'uk-cover'); ?>
                        
                        <?php if(!empty($link)): ?><a href="<?php echo $link; ?>" class="uk-link-toggle uk-display-block"><?php endif; ?>
                        <canvas class="<?php echo $canvas_classes ?>" width="400" height="240"></canvas>
                        <?php if(!empty($link)): ?></a><?php endif; ?>
                        <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                    </div>
                <?php endif; ?>
                
                <?php if($show_card_media && $img_align == 'left' || $img_align == 'right'): ?>
                    <div class="<?php echo $card_media_classes; ?>">
                        
                        <?php echo get_img($thumbnail_id, 'xlarge', 'uk-disabled', 'uk-cover'); ?>
                        
                        
                        <?php if(!empty($link)): ?><a href="<?php echo $link; ?>" class="uk-link-toggle uk-display-block"><?php endif; ?>
                        <canvas class="<?php echo $canvas_classes ?> uk-hidden@l" width="400" height="320"></canvas>
                        <canvas class="<?php echo $canvas_classes ?> uk-visible@l" width="540" height="480"></canvas>
                        <?php if(!empty($link)): ?></a><?php endif; ?>
                        <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                    </div>
                <?php endif; ?>

                <div class="uk-flex uk-flex-column">
                    <!-- Card Body -->
                    <div class="uk-card-body uk-flex-auto<?php echo $center_content; ?>">
                       <div>
                            <?php if(!empty($link)): ?><a href="<?php echo $link; ?>" class="uk-link-toggle header-bar header-bar-hover <?php echo $header_styles; ?>"><?php endif; ?>
                            <h3 class="uk-link-heading uk-h2 uk-margin-remove-bottom <?php echo $header_styles; ?>">
                                <?php echo $title; ?>
                            </h3>
                            <?php if(!empty($link)): ?></a><?php endif; ?>
                            <p><?php echo $body; ?></p>

                            <?php if(!empty($link) && $link_type != 'footer_button'): 
                               if($link_type == "link"){ ?>
                                    <a href="<?php echo $link; ?>" class="uk-display-block uk-button uk-button-primary"><?php echo $link_text; ?></a>
                            <?php } else{ ?>
                                   <a href="<?php echo $link; ?>" class="uk-display-block uk-button uk-button-secondary"><?php echo $link_text; ?></a>
                              <?php } ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(!empty($link) && $link_type == 'footer_button'): ?>
                            <a href="<?php echo $link; ?>" class="uk-card-footer div-top uk-display-block uk-text-uppercase"><?php echo $link_text; ?></a>
                    <?php endif; ?>
                </div>

                <!-- Card Media (bottom) -->
                <?php if($show_card_media && $img_align == 'bottom'): ?>
                    <div class="<?php echo $card_media_classes; ?>">
                        <?php echo get_img($thumbnail_id, 'large', 'uk-disabled', 'uk-cover'); ?>
                        
                        
                        <?php if(!empty($link)): ?><a href="<?php echo $link; ?>" class="uk-link-toggle uk-display-block"><?php endif; ?>
                        <canvas class="<?php echo $canvas_classes ?>" width="400" height="200"></canvas>
                        <?php if(!empty($link)): ?></a><?php endif; ?>
                        <!-- <canvas class="<?php //echo $canvas_classes ?>" width="<?php //echo $image_width; ?>" height="<?php //echo $image_height; ?>"></canvas> -->
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?
    }
	
endif;



//PPX-TTAGS 13.0 NO CONTENT CARD FUNCTION
if ( ! function_exists( 'ppx_no_content_card' ) ) : 
    function ppx_no_content_card($custom_title = null, $custom_text = null){ ?>
     
      <div class="uk-card uk-card-secondary uk-card-body">
        <?php
            if($custom_title){
                echo '<h2 class="uk-card-title">'.$custom_title.'</h2>';
            }
            else{
                echo '<h2 class="uk-card-title">Sorry!</h2>';
            } 
            if($custom_text){
                echo '<p>'.$custom_text.'</p>';
            }
            elseif($custom_title){}
            else{
                echo '<p>There is no content to show at this time.</p>';
            } 
          ?>
        </div>
<?php 
        
    }
endif;


//PPX-TTAGS 14.0 THUMBNAIL FUNCTION
//Creates a thumbnail
if ( ! function_exists( 'ppx_get_thumb' ) ) : 
    function ppx_get_thumb( $text_placement = 'below', $isbg = true, $link_classes = '', $link_attr = '', $cell_classes = '', $cell_attr = '', $media_classes = ''){ ?>
    <div>
        <?php  
            // Permalink
            $permalink = get_permalink();
            echo '<a href="'.$permalink.'" class="uk-display-block uk-link-toggle '.$link_classes.'" '.$link_attr.'>';
            
            
            // Set Image
            // Get thumbnail id
            $thumbnail_id = get_post_thumbnail_id() ?: ppx_first_img();

            // If cell bg image is activated retrieve thumbnail
            $cell_attr .= $isbg ? 'uk-img '.get_img($thumbnail_id,'large','','','','','','',true) : '';
            
            
        ?>
        
        <div class="uk-inline uk-cover-container uk-background-cover uk-box-shadow-hover-large <?php echo $cell_classes ?>" <?php echo $cell_attr; ?>>
           <canvas class="" width="800" height="800"></canvas>
            <?php if (!$isbg):
               get_img($thumbnail_id, 'large', $media_classes , 'uk-cover');
            endif; ?>
            
        <?php // Set placement of text 
        if( $text_placement == 'overlay' ): ?>
            <div class="uk-position-bottom-left uk-overlay uk-overlay-default uk-padding-small">
                <?php the_title('<h4 class="uk-margin-remove-bottom uk-text-truncate uk-h5 uk-link-heading">','</h4>'); ?>
                <span class="uk-text-meta uk-text-truncate"><?php ppx_starter_posted_on(false) ?></span>
            </div>
        </div>
        <?php elseif( $text_placement == 'below' ): ?>
        </div>
        <div class='uk-margin-small-top'>
            <?php the_title('<h4 class="uk-margin-remove-bottom uk-text-truncate uk-h5 uk-link-heading">','</h4>'); ?>
            <span class="uk-text-meta uk-text-truncate"><?php ppx_starter_posted_on(false) ?></span>
        </div> 
        <?php else: ?>
        </div>
        <?php endif; ?>
        </a>
    </div>  
<?php }
endif;



//PPX-TTAGS 15.0 GET FIRST IMAGE FROM POST OR DEFAULT IMG
//src: https://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post
if ( ! function_exists( 'ppx_first_img' ) ) : 
    function ppx_first_img(){ 
        
        global $post, $posts;
        $first_img_url = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
        $first_img_url = $matches[1][0];
        
        //Check for attchment ID
        $first_img_id = ppx_id_from_url( $first_img_url );
        
        // If nothing ID of default image
        if($first_img_url) {
          $first_img_id = "44"; //Enter default attachment id
        }
        return $first_img_id;
    }
endif;

//PPX-TTAGS 16.0 GET IMG ID FROM IMG URL
//src: https://wpscholar.com/blog/get-attachment-id-from-wp-image-url
if ( ! function_exists( 'ppx_id_from_url' ) ) : 
    function ppx_id_from_url( $url ){ 
        
        $attachment_id = 0;
        $dir = wp_upload_dir();

        if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
            $file = basename( $url );

            $query_args = array(
                'post_type'   => 'attachment',
                'post_status' => 'inherit',
                'fields'      => 'ids',
                'meta_query'  => array(
                    array(
                        'value'   => $file,
                        'compare' => 'LIKE',
                        'key'     => '_wp_attachment_metadata',
                    ),
                )
            );

            $query = new WP_Query( $query_args );

            if ( $query->have_posts() ) {

                foreach ( $query->posts as $post_id ) {

                    $meta = wp_get_attachment_metadata( $post_id );

                    $original_file       = basename( $meta['file'] );
                    $cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );

                    if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
                        $attachment_id = $post_id;
                        break;
                    }

                }

            }
        }

        return $attachment_id;
        
    }
endif;


//PPX-TTAGS 17.0 THUMBNAIL FUNCTION
if ( ! function_exists( 'ppx_breadcrumbs' ) ) : 
// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
function ppx_breadcrumbs()
{
    echo '<div class="breadcrumbs-wrapper"><ul class="uk-breadcrumb">';

   echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
    
    echo '</ul></div> <!-- end breadcrumbs -->';
} //breadcrumbs()
endif;


//PPX-TTAGS 17.0 CALENDAR SHORTCODE
if ( ! function_exists( 'ppx_calendar_preview' ) ) : 
function ppx_calendar_preview(){
    global $post;
    $get_posts = tribe_get_events(
        array(
            'start_date'=>'today',
            'posts_per_page'=>2,
        )
     );
    
    $output = '<ul class="uk-padding uk-padding-remove-top uk-child-width-1-2@s" uk-grid>';
    
    foreach($get_posts as $post) { 
        setup_postdata($post); 

        $output .= '<li class="post-'. get_the_ID() .' event type-event">';
        $output .= '<h5 class="header-bar header-bar-margin-small header-bar-hover uk-text-decoration-none" id="post-'. get_the_ID() .'"><a href="'. get_the_permalink() .'" target="_self" rel="">'. get_the_title()  .'</a></h5>';

        $output .= '<div class="uk-text-meta uk-text-small"><span class="uk-margin-small-right" uk-icon="icon: calendar; ratio: .7"></span><time><span class="uk-text-middle">'. tribe_get_start_date($post->ID, true, 'M d, Y')  .'</span></time></div>';
        $output .= '</li>';

     } //endforeach
    wp_reset_query(); 
    
    $output .= '</ul>';
    
    return $output;
}
endif;
add_shortcode('calendar_preview','ppx_calendar_preview');