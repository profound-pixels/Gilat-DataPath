<?
//PPX-ARCV 1.0 ARCHIVES
//echo '<div><strong>PPX-ARCV</strong></div>';

// Get global variables for content layout width
$ppx_contentWidth = wp_cache_get('ppx_contentFullWidth');
$ppx_sidebarWidth = wp_cache_get('ppx_sidebarWidth');


// Set widths for main content with sidebar
$ppx_contentWidth = (have_posts() && is_active_sidebar( 'sidebar-1' )) ? wp_cache_get('ppx_contentSidebarWidth') : null;

?>

		<?php if ( have_posts() ) :
			get_template_part( 'template-parts/header', 'default' );
        endif; ?>

        <div class="uk-container">

            <?php // If posts and sidebar open grid tag ?>
            <?php if ( have_posts() && is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div class="uk-grid">
            <?php endif; ?>

                <main id="main" class="<?php echo $ppx_contentWidth; ?>">

                <?php if ( have_posts() ) : ?>
<!--                        <div class="uk-child-width-1-2@m uk-child-width-1-1@l" uk-grid>-->
                        <div>

                        <?php renderView('cardArchive'); ?>
                        <?php get_template_part( 'template-parts/nav', 'pagination' ); ?>
                        </div>
               <?php else :
                    get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>

            </main><!-- #main -->

            <?php // If posts and sidebar output sidebar and closing grid tag ?>
            <?php if ( have_posts() && is_active_sidebar( 'sidebar-1' ) ) : ?>
                <aside id="sidebar-output" class="<?php echo $ppx_sidebarWidth; ?>">
                 <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </aside>
            </div>
            <?php endif; ?> <!-- #sidebar-output -->
        </div>
        
    