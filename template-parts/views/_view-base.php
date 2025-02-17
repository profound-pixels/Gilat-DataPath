<?php
//PPX-VIEWBASE 1.0 PPX CONTENT VIEWS BASE
abstract class viewBase
{
    protected $settings = Array();
    protected $query = Null;

    public function __construct($query, $id, $classes, $settings){
        $this->query = $query ?: null;
        $this->settings = $settings ?: null;
        $this->id = $id ?: null;
        $this->classes = $classes ?: null;
    }

//    public static function GetView($view, $query, $settings){}

    abstract public function render();
}

function renderView($view, $query = null, $id = 'view-content', $classes = null, $settings = null){
  if(!$query){
    	global $wp_query;
      $query = $wp_query;
  }

  $viewObject = Null;

  try{
      $view_args = array($query, $id, $classes, $settings);
      $viewClass = new ReflectionClass($view . 'View');
      $viewObject = $viewClass->newInstanceArgs($view_args);
  }
  catch(Exception $e){
      $viewObject = new cardView($query, $id, $classes, $settings);
  }

  $viewObject->render();
}


/**
* function to Call Content View
*/

function initContentView( $widget_args = null, $block = null ){
    
    //if widget supply widget id
    $widget_id_string = null;
    if( isset($widget_args) ){
        $widget_name = $widget_args['widget_name'];
        $widget_id = $widget_args['widget_id'];
        
        $widget_id_string = 'widget_' . $widget_id;
    }


    if( get_field('block_id', $widget_id_string) ){ //if widget set id from ACF editor
        $id = get_field('block_id', $widget_id_string);
    }
    elseif( isset($block['id']) ){ // Use default Gutenburg editor assignment
        $id = 'cv-' . $block['id'];
    }
    else{ 
       $id = null; 
    }

    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'ppx-block-cv';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }

    // Load values and assign defaults.

    $view = get_field('view', $widget_id_string) ?: 'card';
    $type = get_field('post_type', $widget_id_string) ?: 'demo';
    $settings = get_field('settings', $widget_id_string) ?: null;
    $limit = get_field('limit', $widget_id_string) ?: 2;
    $cat = get_field('category', $widget_id_string) ?: '';
    $sort = get_field('sort', $widget_id_string) ?: null;
    $tax = get_field('taxonomy', $widget_id_string) ?: null;
    $tax_terms = get_field('taxonomy_terms', $widget_id_string) ?: '';
    $tags = get_field('tags', $widget_id_string) ?: array();
    $tax_query;

    if($tags){
        $tags = implode(' ', $tags);
    }

    // Test for custom taxonomies
    if($tax){
        $tax_query = array(
            array(
                'taxonomy' => $tax,
                'field'    => 'slug',
                'terms'    => $tax_terms,
            ),
        );
    } else {
        $tax_query = '';
    }

    //Test for tags

    // Custom WP query query
    $args_query = array(
        'post_type' => array($type),
        'posts_per_page' => $limit,
        'order' => $sort['order'],
        'orderby' => $sort['orderby'],
        'category_name' => $cat,
        'tax_query' => $tax_query,
        'tag' => $tags,
    );

    $query = new WP_Query( $args_query );

    if ( $query->have_posts() ) {
        //call static function '::'
        //$viewObject = View::GetView($view, $query, $settings);

        renderView($view, $query, $id, $className, $settings);

    } else { 
        ppx_no_content_card();
    }
    
    
    
    // MAKES VARIABLES FROM FUNCTION ACCESSIBLE TO JAVASCRIPT
    // see //PPX-CVAJAX
    // Enqueue script
    if( ! wp_script_is('ppx_content_view_script') ){
        
        // Register our main script but do not enqueue it yet
        wp_register_script( 'ppx_content_view_script', get_template_directory_uri() . '/template-parts/views/content-views.js?version=1.1', array('jquery') );

        // Pass on parameters
        wp_localize_script( 'ppx_content_view_script', 'ppx_content_view_params', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
            'query' => json_encode($query->query_vars), // Loop information
            'id' => $id, // Block id
            'className' => $className, // Class name
            'view' => $view, // View name
            'settings' => json_encode($settings), // Settings
            'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1, // Current page
            'max_page' => $query->max_num_pages // Max page
        ) );
        
        wp_enqueue_script( 'ppx_content_view_script' );
    }
    
    wp_reset_postdata();
}


/**
* Ajax handler for ppx-content-view load more button
*/

function ppx_loadmore_ajax_handler(){
 
	// Prepare arguments
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
    
	// Custom properties
	$id = $_POST['id'];
	$className = $_POST['className'];
	$view = $_POST['view'];
	$settings = json_decode( stripslashes( $_POST['settings'] ), true );
    //print_r($_POST);
    
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		
		$viewObject = Null;
		
        try{
            
            $view_args = array($query, $id, $className, $settings);
            $viewClass = new ReflectionClass($view . 'View');
            $viewObject = $viewClass->newInstanceArgs($view_args);
            
        }
        catch(Exception $e){
            $viewObject = new cardView($query, $id, $classes, $settings);
        }
		
		$viewObject->renderPosts();
		
	} else { ?>
 		<div class="uk-card uk-card-secondary uk-card-body">
			<h2 class="uk-card-title">Sorry!</h2>
			<p>There is no content to show at this time.</p>
		</div>
 	<?php }
 
	die; // here we exit the script and even no wp_reset_query() required!
}

if( function_exists('ppx_loadmore_ajax_handler') ){
	add_action('wp_ajax_loadmore', 'ppx_loadmore_ajax_handler'); // wp_ajax_{action}
}

?>