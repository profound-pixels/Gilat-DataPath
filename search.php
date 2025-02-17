<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package PPx_Starter_Theme
 */
get_header();
?>
<div id="site-wrapper">

<?php get_template_part( 'template-parts/page', 'archive' ); ?>

</div><!-- #site-wrapper -->
<?php
get_footer();