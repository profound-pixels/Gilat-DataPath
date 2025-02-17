//PPX-CVAJAX 1.0 CONTENT VIEWS AJAX
// https://rudrastyh.com/wordpress/load-more-posts-ajax.html
// Calls function in //PPX-VIEWBASE


(function ($) {

    var initializeBlock = function ($block) {
        // console.log($block);
    }

    // Initialize each block on page load (front end).
    $(document).ready(function () {
        $('.ppx-block-cv').each(function () {
            initializeBlock($(this));
        });

        $('.btn-load-more').click(function () {
            var button = $(this),
                block = $('#' + ppx_content_view_params.id + ' .ppx-load-area, #' + ppx_content_view_params.id + '.ppx-load-area'),
                data = {
                    'action': 'loadmore',
                    'query': ppx_content_view_params.query,
                    'id': ppx_content_view_params.id,
                    'className': ppx_content_view_params.className,
                    'view': ppx_content_view_params.view,
                    'settings': ppx_content_view_params.settings,
                    'page': ppx_content_view_params.current_page
                };
            
            console.log('View: '+ppx_content_view_params.view);

            $.ajax({
                url: ppx_content_view_params.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    button.text('Loading...'); // change the button text (could be a loading bar/wheel)
                },
                success: function (data) {
                    if (data) {
                        button.text('Load More');
                        block.append(data); // insert new posts
                        ppx_content_view_params.current_page++;

                        if (ppx_content_view_params.current_page == ppx_content_view_params.max_page)
                            button.remove(); // if last page, remove the button
                    } else {
                        button.remove(); // if no data, remove the button as well
                    }
                }
            });
        });
    });

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction('render_block_preview/type=ppx-content-view', initializeBlock);
    }

})(jQuery);