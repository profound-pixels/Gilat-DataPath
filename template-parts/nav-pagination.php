<?php 
//PPX-PAGINATION
    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    if ($total_pages > 1):
?>
<section class="uk-section div-top">
    <div class="uk-container">
         <?php 
            //the_posts_navigation(array( 'mid_size' => 3 ));
            echo '<nav class="pagination uk-text-center">';
            pagination_nav();
            echo '</nav>';
        ?>
    </div>
</section>
<?php endif; ?>