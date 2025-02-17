<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PPx_Starter_Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php 
//PPX-SDBAR 1.0 SIDEBAR
echo '<div><strong>PPX-SDBAR</strong></div>'; 
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
