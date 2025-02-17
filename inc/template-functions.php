<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package PPx_Starter_Theme
 */


//PPX-TPLFN 1.0 CONDITIONAL BODY CLASSES
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ppx_starter_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'ppx_starter_body_classes' );



//NAV MENU HOOKS -----------------

//PPX-TPLFN 2.0 UIKIT MENU ITEM CLASSES
function uikit_active_class ( $classes, $item ) { 
    
    //PPX-TPLFN 2.1 UIKIT ACTIVE CLASS
    // Adds uikit active class to the current menu item
    if ( $item->current || $item->current_item_ancestor ) {
        $classes[] = 'uk-active';
    }
    
    //PPX-TPLFN 2.2 UIKIT PARENT CLASS
    // Adds uikit parent class to li's with a submenu
    if ( in_array('menu-item-has-children', $classes) ) {
        $classes[] = 'uk-parent';
    }
    
    //print_r($item);
    return $classes;
}

add_filter( 'nav_menu_css_class', 'uikit_active_class', 10, 2 );


//PPX-TPLFN 3.0 CUSTOM SUBMENU
// Wraps wp submenus in uikit dropdown code
function new_submenu_class($menu) {
    
    // String determined by menu #id added via 'wp_nav_menu'
    $desktopid = 'menu-subpage';
    $mobileid = 'mobile-menu';
    
    //PPX-TPLFN 3.1 DESKTOP DROPDOWN MARKUP
    if(strpos($menu, $desktopid)){
        $menu = preg_replace('/<ul class="sub-menu">/','<ul class="uk-nav-sub">',$menu);        
        $menu = preg_replace('%</ul></li>%','</ul></li>',$menu);
        $menu = preg_replace('/id="'.$desktopid.'"/','id="'.$desktopid.'" uk-nav',$menu);
    }
    
    //PPX-TPLFN 3.2 ADD CLASSES TO SUBMENU ON MOBILE
    elseif(strpos($menu, $mobileid)){
        $menu = preg_replace('/<ul class="sub-menu">/','<ul class="uk-nav-sub">',$menu);        
        $menu = preg_replace('%</ul></li>%','</ul></li>',$menu);
        $menu = preg_replace('/id="'.$mobileid.'"/','id="'.$mobileid.'" uk-nav',$menu);
    }
    
    return $menu;      
}
add_filter('wp_nav_menu','new_submenu_class'); 


//PPX-TPLFN 4.0 CUSTOM LOGO CLASSES
// Adds uikit code to customizer logo output

add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['class'] )  && 'custom-logo-link' === $attr['class'] ){
        $attr['class'] = 'uk-logo uk-navbar-item';
    }
    if( isset( $attr['class'] )  && 'custom-logo' === $attr['class'] ){
        $attr['class'] = 'uk-navbar-item';
    }
    
    
    return $attr;
} );

//PPX-TPLFN 5.0 LIMIT EXCERPT CUSTOMIZATIONS
// Limit excerpt output to specified number of words
function ppx_excerpt_length( $length ) {
        return 15;
}
add_filter( 'excerpt_length', 'ppx_excerpt_length', 999 );

function new_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



//PPX-TPLFN 6.0 YOAST BREADCRUMB OUTPUT
// Limit excerpt output to specified number of words
function ppx_yoast_breadcrumb( $output ) {
    
    $output = str_replace('<span>', '', $output);
    $output = str_replace('</span>', '', $output);
    $output = $output.'</span>';
    $output = str_replace('<a href', '<li><a href', $output);
    $output = str_replace('</a>', '</a></li>', $output);
    
    $output = str_replace('<span', '<li><span', $output);
    $output = str_replace('</span>', '</span></li>', $output);
    //$output = '<ul class="uk-breadcrumb uk-text-uppercase uk-margin-remove-top">'.$output.'</ul>';
    
    return $output;
    //var_dump($output);
}
add_filter( 'wpseo_breadcrumb_output', 'ppx_yoast_breadcrumb' );


//PPX-TPLFN 7.0 ENABLE EXCERPTS

/**
 * Add excerpts to pages
 */
function ppx_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'ppx_add_excerpts_to_pages' );



add_filter( 'get_the_archive_title', 'my_theme_archive_title' );




//PPX-TPLFN 8.0 REMOVE ARCHIVE LABELS
/**
* Remove archive labels.
* 
* @param  string $title Current archive title to be displayed.
* @return string        Modified archive title to be displayed.
*/
function my_theme_archive_title( $title ) {
if ( is_category() ) {
$title = single_cat_title( '', false );
} elseif ( is_tag() ) {
$title = single_tag_title( '', false );
} elseif ( is_post_type_archive() ) {
$title = post_type_archive_title( '', false );
} elseif ( is_tax() ) {
$title = single_term_title( '', false );
}
return $title;
}


//function change_logo_class( $html ) {
//    
//    $html = str_replace( 'custom-logo-link', 'uk-logo uk-navbar-item', $html );
//    //$html = str_replace( 'custom-logo', 'uk-navbar-item', $html );
//    
//    return $html;
//}

//add_filter( 'get_custom_logo', 'change_logo_class' );

