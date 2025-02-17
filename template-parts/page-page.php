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
//PPX-PGTPL 1.0 REUSABLE PAGE TEMPLATE
//echo '<div><strong>PPX-CNTPG</strong></div>';
?>
<?php 
    if(is_front_page()){}
    else{
        get_template_part( 'template-parts/header', 'default' ); 
    }
?>
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
?>