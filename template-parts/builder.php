<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PPx_Starter_Theme
 */

?>

<?php 
//PPX-CNT 1.0 CONTENT
//echo '<div><strong>PPX-CNT</strong></div>'; 

// Get global variables for content layout width
$ppx_contentWidth = wp_cache_get('ppx_contentFullWidth');
$ppx_sidebarWidth = wp_cache_get('ppx_sidebarWidth');


// Set widths for main content with sidebar
$ppx_contentWidth = is_active_sidebar( 'sidebar-1' ) ? wp_cache_get('ppx_contentSidebarWidth') : null;
?>
	
<?php get_template_part( 'template-parts/header', 'single' ); ?>
           
         
<main id="main" class="uk-container">

    <div id="post-<?php the_ID(); ?>" class="uk-padding-large uk-background-default <?php post_class(); ?>">

       <div class="uk-container uk-container-xsmall">
        <?php
        the_content( sprintf(
            wp_kses(/* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ppx-starter' ),
                array('span' => array('class' => array(),),)
            ),
            get_the_title()
        ) );

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ppx-starter' ),
            'after'  => '</div>',
        ) );
        ?>
        
    <footer><?php ppx_starter_entry_footer(); ?></footer>
        
        </div>
    </div><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

    
