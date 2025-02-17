<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PPx_Starter_Theme
 */

?>

<?php 
//PPX-CNTNONE 1.0 CONTENT NONE
echo '<div><strong>PPX-CNTNONE</strong></div>'; 
?>

<section class="no-results not-found">
	
    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'ppx-starter' ); ?></h1>
	

	<div class="page-content">
	
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : // AUTHOR START -----
			printf(
				'<p>' . wp_kses(
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ppx-starter' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) : // NO SEARCH RESULTS ----------------------------------
			?>
            
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ppx-starter' ); ?></p>
			<?php
			get_search_form();

		else : // PAGE NOT FOUND -------------------------------------------------------
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ppx-starter' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
