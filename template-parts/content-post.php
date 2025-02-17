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

$using_sidebar = false;
$sidebar_active = false;

if(is_active_sidebar( 'sidebar-1' ) && $using_sidebar){
    $sidebar_active = true;
    $ppx_contentWidth =  wp_cache_get('ppx_contentSidebarWidth');
}

?>
	
<?php get_template_part( 'template-parts/header', 'single' ); ?>
           
    <div class="uk-margin-large-top uk-container uk-container-xsmall">
       
        <?php // If posts and sidebar open grid tag ?>
        <?php if ( $sidebar_active ) : ?>
        <div class="uk-grid">
        <?php endif; ?>
        
            <main id="main" class="<?php echo $ppx_contentWidth; ?>">


                <div id="post-<?php the_ID(); ?>" class=" <?php post_class(); ?>">

                    <div>
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
                            <footer>
                                <?php // ppx_starter_entry_footer(); ?>
                            </footer><!--footer -->

                    </div>


                </div><!-- #post-<?php the_ID(); ?> -->


            </main><!-- #main -->

            <?php // If posts and sidebar output sidebar and closing grid tag ?>
            <?php if ( $sidebar_active ) : ?>
            <aside id="sidebar-output" class="<?php echo $ppx_sidebarWidth; ?>">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </aside>
            <?php endif; ?><!-- #sidebar-output -->
        </div>
    </div>
