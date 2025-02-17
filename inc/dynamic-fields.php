<?php

//PPX-DYNFLDS 0.0 ACF DYNAMIC FIELDS
// Dynamic custom field population


//PPX-DYNFLDS 1.0 POPULATE VIEWS FIELD
function ppx_views_fields( $field ) {
    
    $field['choices'] = array();
    
    //PPX-DYNFLDS 1.1
    // Add New View Choice here
    $field['choices']['card'] = 'Cards';
    $field['choices']['slider'] = 'Slider';
    $field['choices']['thumbnailgrid'] = 'Thumbnail Grid';
    $field['choices']['filter'] = 'Filter';
    $field['choices']['code'] = 'Code';
    $field['choices']['tile'] = 'Tiles';
    
    return $field;
}
add_filter('acf/load_field/name=view', 'ppx_views_fields');


//PPX-DYNFLDS 1.1 POPULATE POST TYPE FIELD
function ppx_posttypes_fields( $field ) {
    
    $args = array(
        'public'   => true,
        '_builtin' => false
    );
    
    $output = 'objects'; // or objects
    $operator = 'and'; // 'and' or 'or'
    $posttypes = get_post_types($args,$output,$operator);
    
    //print_r($posttypes);
    
    if($posttypes):
    
        $field['choices'] = array();

        foreach( $posttypes as $posttype ) {
            $label = $posttype->label;
            $name = $posttype->name;
            $field['choices'][$name] = $label;
        }
        $field['choices']['post'] = 'Posts';
    
    endif;
    
    return $field;
}
add_filter('acf/load_field/name=post_type', 'ppx_posttypes_fields');

//PPX-DYNFLDS 1.2 POPULATE CATEGORY FIELD
function ppx_category_fields( $field ) {
    
    $categories = get_categories( array(
        'orderby' => 'name',
        'order'   => 'ASC'
    ) );
    
    if($categories):
    
        $field['choices'] = array();

        foreach( $categories as $category ) {
            $cat = $category->name;
            $slug = $category->slug;
            $field['choices'][$slug] = $cat;
        }
    
    endif;
    
    return $field;
}
add_filter('acf/load_field/name=category', 'ppx_category_fields');


//PPX-DYNFLDS 1.3 POPULATE TAXONOMY FIELD
function ppx_taxonomy_fields( $field ) {

    $args = array(
      'public'   => true,
      '_builtin' => false

    );
    $output = 'objects'; // or objects
    $operator = 'and'; // 'and' or 'or'
    $taxonomies = get_taxonomies($args,$output,$operator);
    
    if($taxonomies):
    
        $field['choices'] = array();
    
        foreach( $taxonomies as $taxonomy ) {
            $tax = $taxonomy->label;
            $slug = $taxonomy->name;
            $field['choices'][$slug] = $tax;
        }
    
    endif;
    
    return $field;
    
}

add_filter('acf/load_field/name=taxonomy', 'ppx_taxonomy_fields');


//PPX-DYNFLDS 1.4 POPULATE TAXONOMY TERMS FIELD
function ppx_taxonomy_terms_fields( $field ) {
    
    $selected_tax = get_field('taxonomy');
    
    //echo get_the_ID();
    
    //if($selected_tax):

        $field['choices'] = [];
    
        $tax_terms = get_terms( array(
            'taxonomy' => $selected_tax,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
        ) );
        
        foreach( $tax_terms as $tax_term ) {
            $tax = $tax_term->name;
            $slug = $tax_term->slug;
            $field['choices'][$slug] = $tax;
        }
    
    //endif;
    
    return $field;
}

add_filter('acf/load_field/key=field_5ee3df942ff31', 'ppx_taxonomy_terms_fields', 10, 3);
//add_filter('acf/load_field/name=taxonomy_terms', 'ppx_taxonomy_terms_fields', 10, 3);


//PPX-DYNFLDS 1.5 POPULATE TAGS FIELD
function ppx_tags_fields( $field ) {
    
    $tags = get_tags();
    
    if($tags):
        $field['choices'] = array();

        foreach( $tags as $tag ) {
            $name = $tag->name;
            $slug = $tag->slug;
            $field['choices'][$slug] = $name;
        }
    endif;
    return $field;
}

add_filter('acf/load_field/name=tags', 'ppx_tags_fields');

//PPX-DYNFLDS 1.6 POPULATE FILTER TAGS FIELD
add_filter('acf/load_field/name=filter_tags', 'ppx_tags_fields');


//PPX-DYNFLDS 1.7 POPULATE FILTER TAXONOMY FIELD
add_filter('acf/load_field/name=filter_taxonomy', 'ppx_taxonomy_fields');

//PPX-DYNFLDS 1.8 POPULATE FILTER TERMS FIELD
function ppx_filter_terms_fields( $field ) {
    
    // $selected_tax = get_field('settings')['filter']['filter_taxonomy'] ?: '';
    $selected_tax = get_field('taxonomy');
    
    if($selected_tax):

        $field['choices'] = array();

        $tax_terms = get_terms( array(
            'taxonomy' => $selected_tax,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
        ) );

        foreach( $tax_terms as $tax_term ) {
            $tax = $tax_term->name;
            $slug = $tax_term->slug;
            $field['choices'][$slug] = $tax;
        }
    
    endif;
    
    return $field;
}
add_filter('acf/load_field/name=filter_terms', 'ppx_filter_terms_fields');


//PPX-DYNFLDS 1.9 SET TAXONOMY
function ppx_set_tax( $args ) {
    
    $selected_tax = get_field('tax_taxonomy');
//    print_r($args);
    
    $args['taxonomy'] = $selected_tax;
    return $args;
}

// Apply to all fields.
add_filter('acf/load_field/key=field_5f729ce43f00f', 'ppx_set_tax', 10, 3);


//PPX-DYNFLDS 1.10 SET WP FIELD VIEW
function ppx_set_wp_fields( $field ) {
 
    $field['choices'] = array();
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'posts';
    
    $field['choices']['ppx_permalink'] = 'ppx_permalink';
    $field['choices']['ppx_thumbnail'] = 'ppx_thumbnail';
    $field['choices']['ppx_author'] = 'ppx_author';
    $field['choices']['ppx_thumb_img_small'] = 'ppx_thumb_img_small';
    $field['choices']['ppx_thumb_img_medium'] = 'ppx_thumb_img_medium';
    
    foreach ( $wpdb->get_col( "DESC " . $table_name, 0 ) as $column_name ) {
        $field['choices'][$column_name] = $column_name;
    }
    
    return $field;
}

// Apply to all fields.
add_filter('acf/load_field/name=ppx_wp_field', 'ppx_set_wp_fields', 10, 3);

//PPX-DYNFLDS 1.11 SET CUSTOM FIELD VIEW
function ppx_set_custom_fields( $field ) {
 
    $field['choices'] = array();
    
    global $wpdb;
    $field['choices'] = array();
    $keys = $wpdb->get_results(
    "SELECT DISTINCT meta_key
	FROM $wpdb->postmeta
	WHERE meta_key NOT LIKE '_oembed_%'
	ORDER BY meta_key");
    
    //var_dump($keys);
    //print_r($keys);
    
    foreach ( $keys as $key ){
        $field['choices'][$key->meta_key] = $key->meta_key;
    }
    
//    $args = array(
//        'numberposts' => -1,
//        'post_type' => 'acf-field'
//    );
//    
//    $acf_fields = get_posts($args);
//    foreach ( $acf_fields as $acf ) {
//        $field['choices'][$acf->post_excerpt] = $acf->post_title . ' (' . $acf->post_excerpt . ')';
//    }

    return $field;
}

// Apply to all fields.
add_filter('acf/load_field/name=ppx_custom_field', 'ppx_set_custom_fields', 10, 3);
