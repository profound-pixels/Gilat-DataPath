<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package PPx_Starter_Theme
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */

function ppx_starter_jetpack_setup() {
    
    //PPX-JETPACK 1.1 ACTIVATE INFINITE SCROLL
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main', //change to #ID infinite scroll should add posts to
		'render'    => 'ppx_starter_infinite_scroll_render',
		'footer'    => 'page', //additional footer that loads on down scroll
	) );
    
    //PPX-JETPACK 1.2 ACTIVATE RESPONSIVE VIDEOS
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
    
    //PPX-JETPACK 1.3 ACTIVATE CONTENT OPTIONS
	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'ppx-starter-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive'    => true,
			'post'       => true,
			'page'       => true,
		),
	) );
}
add_action( 'after_setup_theme', 'ppx_starter_jetpack_setup' );


//PPX-JETPACK 2.0 INFINITE SCROLL RENDER
//Custom render function for Infinite Scroll.
function ppx_starter_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_type() );
		endif;
	}
}
