<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PPx_Starter_Theme
 */

?>

<?php
//PPX-CNTPG 1.0 CONTENT PAGE
//echo '<div><strong>PPX-CNTPG</strong></div>';
?>

<?php
// Check see if sidebar is activated
$ppx_hasSidebar = get_field('select_sidebar');
// Get global variables for content layout width
$ppx_contentWidth = wp_cache_get('ppx_contentFullWidth');
$ppx_sidebarWidth = wp_cache_get('ppx_sidebarWidth');


// Check to see if template containers are enabled for the site
if( $ppx_hasSidebar && ppx_starter_enable_container() && is_active_sidebar( $ppx_hasSidebar ) ){
    
    $ppx_contentWidth = wp_cache_get('ppx_contentSidebarWidth');
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(ppx_starter_enable_container()); ?> uk-scrollspy="cls: uk-animation-slide-bottom-medium; delay: 50; target: > *">
	
    <?php //ppx_starter_post_thumbnail(); ?>
    <?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    
    <?php if($ppx_hasSidebar): //--------------------------- ?> 
    <div class="uk-grid">
        <main id="main-output" class="<?php echo $ppx_contentWidth; ?>">
    <?php endif; //--------------------------- ?>
	
    
	        <?php the_content(); ?>
	    
		
    <?php if($ppx_hasSidebar): //--------------------------- ?>
	    </main>
        <aside id="sidebar-output" class="<?php echo $ppx_sidebarWidth; ?>">
             <?php dynamic_sidebar( $ppx_hasSidebar ); ?>
        </aside>
   
    </div> <!--end .uk-grid-->
	<?php endif; //--------------------------- ?>

</div><!-- #post-<?php the_ID(); ?> -->