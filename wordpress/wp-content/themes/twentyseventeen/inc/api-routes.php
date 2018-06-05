<?php 
 
  	/**
  	 *
  	 * Get The latest post from a category !
  	 * @param array $params Options for the function.
 	   * @return string|null Post title for the latest,? * or null if none
  	 *
  	 */
 
 
      function get_latest_post ( $params ){
        $post = get_posts( array(
       'category'      => $category,
         'posts_per_page'  => 1,
         'offset'      => 0
   ) );

        if( empty( $post ) ){
            return null;
        }

        return $post[0]->post_title;
    }

    function get_ordered_categories( $params ){
        $categories = get_categories( array(
            'orderby' => 'order',
            'order'   => 'ASC'
        ) );
        if( empty( $categories ) ){
            return null;
        }
        
        return $categories;
        
    }

// Register the rest route here.

add_action( 'rest_api_init', function () {
            
    register_rest_route( 'mynamespace/v1', 'latest-post',array(
        'methods'  => 'GET',
        'callback' => 'get_latest_post'
    ) );

    register_rest_route( 'postlight/v1', 'categories',array(
        'methods'  => 'GET',
        'callback' => 'get_ordered_categories'
        ) );
} );
