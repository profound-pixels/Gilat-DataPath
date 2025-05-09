<?php /* Template Name: Events Page */
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PPx_Starter_Theme
 */

get_header();
?>

<div id="site-wrapper">
       
       
    <div id="post-<?php the_ID(); ?>" class="uk-container">
       
       
        <article class="uk-background-default">
        <?php get_template_part( 'template-parts/header', 'default' ); ?>
            <?php
                while ( have_posts() ) :
                    the_post();

                    the_content(); 

                endwhile; // End of the loop.
            ?>
        </article>
    </div>   

</div><!-- #site-wrapper -->

<?php get_footer(); ?>  