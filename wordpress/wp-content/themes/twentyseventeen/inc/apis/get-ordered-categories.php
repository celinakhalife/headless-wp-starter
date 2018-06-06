<?php

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
