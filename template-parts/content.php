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
?>
	
	<?php $thumbnail_class = get_post_thumbnail_id() ? 'uk-grid-collapse uk-child-width-expand@s uk-margin uk-grid' : ''; ?>
	
	<article id="post-<?php the_ID(); ?>" class="uk-card uk-card-default <?php echo $thumbnail_class; ?> <?php post_class(); ?>">
	
        <?php if(has_post_thumbnail() ): ?>
        <div class="uk-card-media-right uk-flex-last@s uk-cover-container uk-width-2-5@s">
            <canvas width="400" height="250" class="uk-width-expand"></canvas>
            <?php echo get_img(get_post_thumbnail_id(), 'medium', '', 'uk-cover'); ?>
        </div>
        <?php endif; ?>
    
        <div>
            <div class="uk-card-body">

                <header>
                    <?php
                    if ( is_singular() ) :
                        the_title( '<h1 class="uk-card-title">', '</h1>' );
                    else :
                        the_title( '<h2 class="uk-card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    endif;

                    if ( 'post' === get_post_type() ) :
                        ?>
                        <div class="entry-meta">
                            <?php ppx_starter_posted_by('line', true); ?>
                            <?php //ppx_starter_posted_on(); ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>

                </header><!-- .entry-header -->
                <?php
                the_excerpt( sprintf(
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
                    <?php ppx_starter_entry_footer(); ?>
                </footer><!--footer -->

            </div><!-- .uk-card-body -->
        </div>
	
	
	</article><!-- #post-<?php the_ID(); ?> -->
