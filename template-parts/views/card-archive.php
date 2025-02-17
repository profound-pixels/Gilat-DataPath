<?php
/**
 ** CARD LOOP TEMPLATE
 **/


class cardArchiveView extends viewBase
{
    public function render(){ ?>
    
    <?
        // Set block id output
        $block_id = '';
        if($this->id){ $block_id = 'id="'. $this->id .'"'; }

        // Set classes variable
        $block_classes = $this->classes;

        // Unconditional classes
        $block_classes .= ' uk-grid-match';

        // Set grid width based on post count
//        $post_count = $this->query->found_posts;
//
//        if( $post_count < 4 && $post_count > 1){
//            $block_classes .= ' uk-child-width-1-2@m uk-child-width-1-'.$post_count.'@l';
//        }
//        elseif($post_count = 4){
//            $block_classes .= ' uk-child-width-1-2@m uk-child-width-1-2@l';
//        }
//        elseif($post_count > 4){
//            $block_classes .= ' uk-child-width-1-2@m uk-child-width-1-3@l';
//        }

    ?>

    <div <?php echo $block_id; ?> class="<?php echo $block_classes; ?>">
        <?php //while($this->query->have_posts()):
        while(have_posts()):
            the_post();  
            $thumbnail_class = get_post_thumbnail_id() ? 'uk-grid-collapse uk-child-width-expand@s uk-margin uk-grid' : ''; ?>
	
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
                            <?php ppx_starter_posted_on(false); ?>
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
        
       <?php endwhile; ?>
    </div>
    <?php }
}

?>
