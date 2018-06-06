<?php

require get_parent_theme_file_path( '/inc/apis/get-ordered-categories.php' );

add_action( 'rest_api_init', function () {    
    register_rest_route( 'postlight/v1', 'latest-categories',array(
        'methods'  => 'GET',
        'callback' => 'get_ordered_categories'
    ));
});
