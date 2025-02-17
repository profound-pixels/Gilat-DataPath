<?php
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

<?php 
//PPX-PG 1.0 PAGE
?>

<div id="site-wrapper">
<!--		<div id="wp-output">-->
        
<?php get_template_part( 'template-parts/page', 'page' ); ?>

<!--		</div>-->
		<!-- #wp-output -->

<?php //get_sidebar(); ?>

</div><!-- #site-wrapper -->

<?php get_footer(); ?>  