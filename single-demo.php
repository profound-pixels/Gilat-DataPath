<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PPx_Starter_Theme
 */

get_header();

//PPX-SNGL 1.0 SINGLE

// Get global variables for content layout width
//$ppx_contentWidth = wp_cache_get('ppx_contentFullWidth');
//$ppx_sidebarWidth = wp_cache_get('ppx_sidebarWidth');
//
//
//// Set widths for main content with sidebar
//$ppx_contentWidth = have_posts() && is_active_sidebar( 'sidebar-1' ) ? wp_cache_get('ppx_contentSidebarWidth') : null;

?>
    <article id="site-wrapper">
        
     <?php
     while ( have_posts() ) :
         the_post();
         get_template_part( 'template-parts/content','post');
     endwhile; // End of the loop.
     ?>
                    
    </article>
    <!-- #site-wrapper -->
    <?php get_footer(); ?>
        <?