<?php
/**
 * Register ACF Blocks
 *
 */

//PPX-BLOCKS 1.0 REGISTER BLOCKS

function register_acf_block_types() {
    
    $stylesheet;
        
    if(is_admin()) { 
        //$stylesheet = get_template_directory_uri() .'/scss/uikit-admin.css';
        $stylesheet = get_template_directory_uri() .'/style.css';
        $script = get_template_directory_uri() . '/js/uikit.min.js';
    }
    else{ 
        $stylesheet = ''; 
        $script = '';
    }

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        // register layout block
        acf_register_block_type(array(
            'name'              => 'ppx-layout',
            'title'             => __('PPx Page Layout'),
            'description'       => __('Set the layout of the page'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => 'schedule',
            'keywords'          => array( 'layout', 'sidebar', 'page layout' ),
            'supports'			=> array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
            'render_template'   => 'template-parts/blocks/layout/layout.php',
            'enqueue_style'     => $stylesheet,
        ));
        // register section block
        acf_register_block_type(array(
            'name'              => 'ppx-section',
            'title'             => __('PPx Content Section'),
            'description'       => __('Section block for content'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M.5 1.5h22v8H.5Z"/><path d="M.5 15.5h22v8H.5Z"/></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'layout', 'section', 'text', 'container', 'page section', 'block' ),
            'supports'			=> array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
            'render_template'   => 'template-parts/blocks/section/section.php',
            'enqueue_style'     => $stylesheet
        ));
        // Register Content Grid Block
        acf_register_block_type(array(
            'name'              => 'ppx-content-grid',
            'title'             => __('PPx Content Grid'),
            'description'       => __('Section block for displaying information in a grid'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M1.5 17.5h5v5h-5Z"/><path d="M17.5 17.5h5v5h-5Z"/><path d="M9.5 17.5h5v5h-5Z"/><path d="M1.5 9.5h5v5h-5Z"/><path d="M17.5 9.5h5v5h-5Z"/><path d="M9.5 9.5h5v5h-5Z"/><path d="M1.5 1.5h5v5h-5Z"/><path d="M17.5 1.5h5v5h-5Z"/><path d="M9.5 1.5h5v5h-5Z"/></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'layout', 'grid', 'section', 'text', 'two column', 'block', 'image', 'canvas', 'information', 'content block' ),
            'supports'			=> array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
            'render_template'   => 'template-parts/blocks/content-grid/content-grid.php',
            'enqueue_style'     => $stylesheet
        ));
        
        // Register Subpage Content Block
        acf_register_block_type(array(
            'name'              => 'ppx-subpage-content',
            'title'             => __('PPx Sub Page Content'),
            'description'       => __('A block for displaying subpage text and navigation'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M.5 1.5h22v22H.5Z"/><path d="M15.5 1.5l0 22"/></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'layout', 'content', 'sub navigation', 'text', 'block', 'page content', 'sidebar', 'content block' ),
            'supports'			=> array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
            'render_template'   => 'template-parts/blocks/subpage/subpage.php',
            'enqueue_style'     => $stylesheet
        ));
        
        // Register content view block
        acf_register_block_type(array(
            'name'              => 'ppx-content-view',
            'title'             => __('PPx Content View'),
            'description'       => __('Display content in a custom view'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M.5 1.5h9v9h-9Z"/><path d="M12.5 2.5l11 0"/><path d="M12.5 5.5l11 0"/><path d="M12.5 8.5l6 0"/><path d="M.5 14.5h9v9h-9Z"/><path d="M12.5 15.5l11 0"/><path d="M12.5 18.5l11 0"/><path d="M12.5 21.5l6 0"/></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'views', 'page layout', 'uikit', 'slider', 'cards', 'elements' ),
            'render_template'   => 'template-parts/blocks/content-views/content-views.php',
            'enqueue_style'     => $stylesheet,
            'enqueue_script'     => $script
        ));

        // Register card block
        acf_register_block_type(array(
            'name'              => 'ppx-card',
            'title'             => __('PPx Card'),
            'description'       => __('Display content in a card block'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M8.5 23.5l0-1.5 -3-1 -3 1 0 1.5"/><path d="M7.5 19l-2 1 -2-1 0-2.5 2-1 2 1Z"/><path d="M8.5 10.5l0-1.5 -3-1 -3 1 0 1.5"/><path d="M7.5 6l-2 1 -2-1 0-2.5 2-1 2 1Z"/><path d="M.5 13.5h23v10H.5Z"/><path d="M10.5 23.5l0-10"/><path d="M13.5 16.5l6 0"/><path d="M13.5 18.5l4 0"/><path d="M.5.5h23v10H.5Z"/><path d="M10.5 10.5l0-10"/><path d="M13.5 3.5l6 0"/><path d="M13.5 5.5l4 0"/></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'page layout', 'uikit', 'cards', 'elements' ),
            'render_template'   => 'template-parts/blocks/card/card.php',
            'enqueue_style'     => $stylesheet
        ));
        
        // Register slideshow block
        acf_register_block_type(array(
            'name'              => 'ppx-slideshow',
            'title'             => __('PPx Slideshow'),
            'description'       => __('Slideshow of images and text'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M5.5 9.5h17v13h-17Z"/><path d="M7.5 11.5h13v9h-13Z"/><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M3.5 15.5l-3 0 0-13 17 0 0 5"/><path d="M3.5 13.5l-1 0 0-9 13 0 0 3"/><path d="M15 14l3 3"/><path d="M17.5 13.5l1 1"/></g></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'page layout', 'uikit', 'slideshow', 'elements', 'slides', 'hero' ),
            'render_template'   => 'template-parts/blocks/slideshow/slideshow.php',
            'enqueue_style'     => $stylesheet,
            'enqueue_script'     => $script
        ));
        // Register taxonomy browser block
        acf_register_block_type(array(
            'name'              => 'ppx-tax-browser',
            'title'             => __('PPx Taxonomy Browser'),
            'description'       => __('Display a slider of taxonomies'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M2.5 1.5l0 6 3 1.5 3-1.5 0-6"/><path d="M2.5 7.5l0 14.5 3 1.5 3-1.5 0-14.5"/><path d="M4.5 2.5l0 4"/><path d="M6.5 2.5l0 4"/><path d="M4.5 19.5l2 0"/><path d="M8.5 1.5l0 6 3 1.5 3-1.5 0-6"/><path d="M8.5 7.5l0 14.5 3 1.5 3-1.5 0-14.5"/><path d="M10.5 2.5l0 4"/><path d="M12.5 2.5l0 4"/><path d="M10.5 19.5l2 0"/><path d="M14.5 1.5l0 6 3 1.5 3-1.5 0-6"/><path d="M14.5 7.5l0 14.5 3 1.5 3-1.5 0-14.5"/><path d="M16.5 2.5l0 4"/><path d="M18.5 2.5l0 4"/><path d="M16.5 19.5l2 0"/><path d="M4.43 14.43h2.12v2.12H4.42Z" transform="rotate(-45 5.499 15.499) scale(.999)"/><path d="M10.43 14.43h2.12v2.12h-2.13Z" transform="rotate(-45 11.5 15.499) scale(.999)"/><path d="M16.43 14.43h2.12v2.12h-2.13Z" transform="rotate(-45 17.499 15.499) scale(.999)"/></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'page layout', 'uikit', 'taxonomy',  'taxonomies', 'slider', 'elements' ),
            'render_template'   => 'template-parts/blocks/taxonomy-browser/taxonomy-browser.php',
            'enqueue_style'     => $stylesheet
        ));
        // Register single thumbnail block
        acf_register_block_type(array(
            'name'              => 'ppx-thumbnail',
            'title'             => __('PPx Thumbnail'),
            'description'       => __('A single thumbnail link'),
            'mode'				=> 'preview',
            'category'          => 'layout',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="#58595B" stroke-linecap="round" stroke-linejoin="round" d="M.5 1.5h22v22H.5Z"/><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'layout', 'thumbnail', 'text', 'image', 'content', 'image', 'link', 'picture' ),
            'supports'			=> array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
            'render_template'   => 'template-parts/blocks/thumbnail/thumbnail.php',
            'enqueue_style'     => $stylesheet
        ));
        //Register single video block
        acf_register_block_type(array(
            'name'              => 'ppx-video',
            'title'             => __('PPx Video'),
            'description'       => __('Single video with title and description'),
            'mode'				=> 'preview',
            'category'          => 'Embeds',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke="#58595B" fill="none" stroke-linejoin="round"><path d="M16.5 9.5l-3 1.5 0-2.5 -7 0 0 7 7 0 0-2.5 3 1.5Z"/><path d="M.5 1.5h22v22H.5Z"/></g><path fill="none" d="M0 0h24v24H0Z"/></svg>',
            'keywords'          => array( 'video', 'content', 'youtube', 'block' ),
            'supports'			=> array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
            'render_template'   => 'template-parts/blocks/video/video.php',
            'enqueue_style'     => $stylesheet
        ));
    }
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}



//PPX-BLOCKS 2.0 REGISTER PATTERNS

function ppx_register_patterns() {
    if( function_exists('register_block_pattern') ) {
        register_block_pattern(
            'ppx-patterns/ppx-content-bio',
            array(
                'title'       => __( 'PPx Team Member Card', 'ppx-patterns' ),
                'viewportWidth' => 1200,
                'categories'    => ['datapath'],
                'keywords'      => ['card','photo','text','content','photo and text','title', 'user', 'bio'],
                'description'   => _x( 'A content card with a headshot, name, title, and bio', 'Block pattern description', 'ppx-patterns' ),
                'content'     => "<!-- wp:group {\"className\":\"div-bottom uk-padding ppx-content-item uk-padding-remove-top uk-margin-large-bottom\"} -->\n<div class=\"wp-block-group div-bottom uk-padding ppx-content-item uk-padding-remove-top uk-margin-large-bottom\"><!-- wp:acf/ppx-content-grid {\"id\":\"block_60fa0756cbeeb\",\"name\":\"acf/ppx-content-grid\",\"data\":{\"field_5f4dcf22524e7\":{\"row-0\":{\"acf_fc_layout\":\"canvas_img\",\"field_5f4e725384b63\":\"17040\",\"field_5f4e753384b64\":\"265\",\"field_5f4e779684b65\":\"300\",\"field_60f8c632c64a2\":\"1\",\"field_60f8c4bec649e\":\"480\",\"field_60f8c4c2c649f\":\"360\",\"field_60f8c566c64a1\":\"960\",\"field_60f8c565c64a0\":\"540\",\"field_5f597b0920e3c\":\"\",\"field_5f597b2e20e3d\":\"\",\"field_5f597b3e20e3e\":\"\"},\"row-1\":{\"acf_fc_layout\":\"block_area\"}},\"field_5f4e8f1c84b67\":{\"row-0\":{\"field_60f8d4f53f739\":[\"uk-width-1-1\",\"uk-width-auto@s\"],\"field_5f589855d83a2\":\"\",\"field_5f589e4f54e4e\":\"\",\"field_5f56ec815afb0\":\"\",\"field_5f4e954984b6d\":\"\",\"field_5f4e97d90aabc\":\"\",\"field_5f4e99f5b3aae\":\"\",\"field_5f58111784ec3\":\"\",\"field_5f4ea01db3ab1\":\"\",\"field_5f57283475fe5\":\"\"},\"row-1\":{\"field_60f8d4f53f739\":[\"uk-width-expand@m\",\"uk-width-1-1\"],\"field_5f589855d83a2\":\"\",\"field_5f589e4f54e4e\":\"\",\"field_5f56ec815afb0\":\"\",\"field_5f4e954984b6d\":\"\",\"field_5f4e97d90aabc\":\"\",\"field_5f4e99f5b3aae\":\"\",\"field_5f58111784ec3\":\"\",\"field_5f4ea01db3ab1\":\"\",\"field_5f57283475fe5\":\"\"}},\"field_5f58181f4a850\":{\"field_5f58181f4a850_field_5f1d1c43faceb\":\"\"},\"field_5f59ad9489ce2\":\"0\",\"field_5f5898eed83a3\":\"\",\"field_5f4ea079b3ab3\":\"\",\"field_5f580d8184ec2\":\"\",\"field_5f4ea220b10f2\":\"\",\"field_5f598370fb504\":\"\",\"field_5f4e9f8db3ab0\":\"\"},\"align\":\"\",\"mode\":\"preview\"} -->\n<!-- wp:heading {\"level\":3,\"className\":\"header-bar uk-margin-remove-bottom header-bar-margin-small\"} -->\n<h3 class=\"header-bar uk-margin-remove-bottom header-bar-margin-small\">Member Name</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"className\":\"uk-text-meta uk-margin-remove-top uk-text-uppercase\"} -->\n<p class=\"uk-text-meta uk-margin-remove-top uk-text-uppercase\">Member Title</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Replace with member bio. Nullam tincidunt adipiscing enim. Maecenas vestibulum mollis diam. Aliquam eu nunc. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Phasellus viverra nulla ut metus varius laoreet.</p>\n<!-- /wp:paragraph -->\n<!-- /wp:acf/ppx-content-grid --></div>\n<!-- /wp:group -->",
            )
        );
        register_block_pattern(
            'ppx-patterns/ppx-card-media-right',
            array(
                'title'       => __( 'PPx Card Media Right', 'ppx-patterns' ),
                'viewportWidth' => 1400,
                'categories'    => ['datapath'],
                'keywords'      => ['card','layout','photo','text','two column','photo and text','title'],
                'description'   => _x( 'A layout card with a photo to the right on desktops', 'Block pattern description', 'ppx-patterns' ),
                'content'     => "<!-- wp:acf/ppx-card {\"id\":\"block_60cce3656a799\",\"name\":\"acf/ppx-card\",\"data\":{\"heading\":\"Your Card Heading\",\"_heading\":\"field_5efdd88cbc5a4\",\"header_settings\":\"\",\"_header_settings\":\"field_60d0f872a8d50\",\"excerpt\":\"Aenean viverra rhoncus pede. Phasellus dolor. Sed a libero. Curabitur blandit mollis lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\",\"_excerpt\":\"field_5efde57ad516c\",\"link\":\"/#\",\"_link\":\"field_5f0140f39a89e\",\"link_text\":\"Learn More\",\"_link_text\":\"field_60d134c413da4\",\"link_type\":\"footer_button\",\"_link_type\":\"field_60d133b7d35ec\",\"support_img\":\"1\",\"_support_img\":\"field_5efde618d516e\",\"featured_image_id\":353,\"_featured_image_id\":\"field_5efde87fdb7aa\",\"img_alignment\":\"right\",\"_img_alignment\":\"field_5efde5bed516d\",\"bg_style\":\"\",\"_bg_style\":\"field_60d107accc4c3\",\"block_id\":\"\",\"_block_id\":\"field_5efdd88cd57bd\"},\"align\":\"\",\"mode\":\"preview\",\"className\":\"uk-margin-top\"} /-->",
            )
        );
        register_block_pattern(
            'ppx-patterns/ppx-card-media-left',
            array(
                'title'       => __( 'PPx Card Media Left', 'ppx-patterns' ),
                'viewportWidth' => 1400,
                'categories'    => ['datapath'],
                'keywords'      => ['card','layout','photo','text','two column','photo and text','title'],
                'description'   => _x( 'A layout card with a photo to the left on desktops', 'Block pattern description', 'ppx-patterns' ),
                'content'     => "<!-- wp:acf/ppx-card {\"id\":\"block_60cce3656a799\",\"name\":\"acf/ppx-card\",\"data\":{\"heading\":\"Your Card Heading\",\"_heading\":\"field_5efdd88cbc5a4\",\"header_settings\":\"\",\"_header_settings\":\"field_60d0f872a8d50\",\"excerpt\":\"Aenean viverra rhoncus pede. Phasellus dolor. Sed a libero. Curabitur blandit mollis lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\",\"_excerpt\":\"field_5efde57ad516c\",\"link\":\"/#\",\"_link\":\"field_5f0140f39a89e\",\"link_text\":\"Learn More\",\"_link_text\":\"field_60d134c413da4\",\"link_type\":\"footer_button\",\"_link_type\":\"field_60d133b7d35ec\",\"support_img\":\"1\",\"_support_img\":\"field_5efde618d516e\",\"featured_image_id\":353,\"_featured_image_id\":\"field_5efde87fdb7aa\",\"img_alignment\":\"right\",\"_img_alignment\":\"field_5efde5bed516d\",\"bg_style\":\"\",\"_bg_style\":\"field_60d107accc4c3\",\"block_id\":\"\",\"_block_id\":\"field_5efdd88cd57bd\"},\"align\":\"\",\"mode\":\"preview\",\"className\":\"uk-margin-top\"} /-->",
            )
        );
        register_block_pattern(
            'ppx-patterns/ppx-primary-card-media-right',
            array(
                'title'       => __( 'PPx Primary Card Media Right', 'ppx-patterns' ),
                'viewportWidth' => 1400,
                'categories'    => ['datapath'],
                'keywords'      => ['card','layout','photo','text','two column','photo and text','title'],
                'description'   => _x( 'A primary layout card with a photo to the right on desktops', 'Block pattern description', 'ppx-patterns' ),
                'content'     => "<!-- wp:acf/ppx-card {\"id\":\"block_60d36a83d046d\",\"name\":\"acf/ppx-card\",\"data\":{\"heading\":\"Your Card Heading\",\"_heading\":\"field_5efdd88cbc5a4\",\"header_settings\":[\"header-light\",\"header-bar-short\",\"header-bar-margin-small\"],\"_header_settings\":\"field_60d0f872a8d50\",\"excerpt\":\"Aenean viverra rhoncus pede. Phasellus dolor. Sed a libero. Curabitur blandit mollis lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\",\"_excerpt\":\"field_5efde57ad516c\",\"center_content\":\"1\",\"_center_content\":\"field_60d4e97d3a0d3\",\"link\":\"/about\",\"_link\":\"field_5f0140f39a89e\",\"link_text\":\"Learn More\",\"_link_text\":\"field_60d134c413da4\",\"link_type\":\"link\",\"_link_type\":\"field_60d133b7d35ec\",\"support_img\":\"1\",\"_support_img\":\"field_5efde618d516e\",\"featured_image_id\":440,\"_featured_image_id\":\"field_5efde87fdb7aa\",\"img_alignment\":\"left\",\"_img_alignment\":\"field_5efde5bed516d\",\"bg_style\":\"uk-background-primary\",\"_bg_style\":\"field_60d107accc4c3\",\"block_id\":\"\",\"_block_id\":\"field_5efdd88cd57bd\"},\"align\":\"\",\"mode\":\"preview\"} /-->",
            )
        );
        register_block_pattern(
            'ppx-patterns/ppx-three-column-cards',
            array(
                'title'       => __( 'PPx Three Column Cards', 'ppx-patterns' ),
                'viewportWidth' => 1200,
                'categories'    => ['datapath'],
                'keywords'      => ['card','cards','layout','photos','text','three column','photo and text','title'],
                'description'   => _x( 'A three column layout featuring a title card and two content cards', 'Block pattern description', 'ppx-patterns' ),
                'content'     => "<!-- wp:columns {\"className\":\"ppx-three-columns\"} -->\n<div class=\"wp-block-columns ppx-three-columns\"><!-- wp:column {\"className\":\"title-card-column\"} -->\n<div class=\"wp-block-column title-card-column\"><!-- wp:acf/ppx-card {\"id\":\"block_60d1f7b39bdba\",\"name\":\"acf/ppx-card\",\"data\":{\"heading\":\"Cyber Security\",\"_heading\":\"field_5efdd88cbc5a4\",\"header_settings\":\"\",\"_header_settings\":\"field_60d0f872a8d50\",\"excerpt\":\"Cybersecurity solutions for defense, government, and small to medium-sized enterprises who maintain high-value digital assets and would suffer significant reputational and financial damage if breached.\",\"_excerpt\":\"field_5efde57ad516c\",\"link\":\"/about\",\"_link\":\"field_5f0140f39a89e\",\"link_text\":\"See All Solutions\",\"_link_text\":\"field_60d134c413da4\",\"link_type\":\"footer_button\",\"_link_type\":\"field_60d133b7d35ec\",\"support_img\":\"0\",\"_support_img\":\"field_5efde618d516e\",\"bg_style\":\"\",\"_bg_style\":\"field_60d107accc4c3\",\"block_id\":\"\",\"_block_id\":\"field_5efdd88cd57bd\"},\"align\":\"\",\"mode\":\"preview\"} /--></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:acf/ppx-card {\"id\":\"block_60d1f7f39bdbb\",\"name\":\"acf/ppx-card\",\"data\":{\"heading\":\"Security Assesments\",\"_heading\":\"field_5efdd88cbc5a4\",\"header_settings\":\"\",\"_header_settings\":\"field_60d0f872a8d50\",\"excerpt\":\"Pro-active security analysis and remediation recommendations to enhance and protect your networks.\",\"_excerpt\":\"field_5efde57ad516c\",\"link\":\"/about\",\"_link\":\"field_5f0140f39a89e\",\"link_text\":\"Learn More\",\"_link_text\":\"field_60d134c413da4\",\"link_type\":\"link\",\"_link_type\":\"field_60d133b7d35ec\",\"support_img\":\"1\",\"_support_img\":\"field_5efde618d516e\",\"featured_image_id\":440,\"_featured_image_id\":\"field_5efde87fdb7aa\",\"img_alignment\":\"top\",\"_img_alignment\":\"field_5efde5bed516d\",\"bg_style\":\"\",\"_bg_style\":\"field_60d107accc4c3\",\"block_id\":\"\",\"_block_id\":\"field_5efdd88cd57bd\"},\"align\":\"\",\"mode\":\"preview\"} /--></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:acf/ppx-card {\"id\":\"block_60d1f83a9bdbc\",\"name\":\"acf/ppx-card\",\"data\":{\"heading\":\"Managed Security\",\"_heading\":\"field_5efdd88cbc5a4\",\"header_settings\":\"\",\"_header_settings\":\"field_60d0f872a8d50\",\"excerpt\":\"Comprehensive, multi-layered security that protects organizations from the increasing threat of attack.\",\"_excerpt\":\"field_5efde57ad516c\",\"link\":\"/about\",\"_link\":\"field_5f0140f39a89e\",\"link_text\":\"Learn More\",\"_link_text\":\"field_60d134c413da4\",\"link_type\":\"link\",\"_link_type\":\"field_60d133b7d35ec\",\"support_img\":\"1\",\"_support_img\":\"field_5efde618d516e\",\"featured_image_id\":353,\"_featured_image_id\":\"field_5efde87fdb7aa\",\"img_alignment\":\"top\",\"_img_alignment\":\"field_5efde5bed516d\",\"bg_style\":\"\",\"_bg_style\":\"field_60d107accc4c3\",\"block_id\":\"\",\"_block_id\":\"field_5efdd88cd57bd\"},\"align\":\"\",\"mode\":\"preview\"} /--></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
            )
        );
    }
}
 
add_action( 'init', 'ppx_register_patterns' );


//PPX-BLOCKS 3.0 REGISTER PATTERN CATEGORIES
function ppx_register_pattern_categories() {
  if( function_exists('register_block_pattern_category')){
      register_block_pattern_category(
            'datapath',
            [ 'label' => __( 'DataPath', 'ppx' )]
      );
  }
}
 
add_action( 'init', 'ppx_register_pattern_categories' );