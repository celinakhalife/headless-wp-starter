<?php


function cptui_register_my_cpts_test_cpt() {

	/**
	 * Post Type: test_cpt.
	 */

	$labels = array(
		"name" => __( "test_cpt", "twentyseventeen" ),
		"singular_name" => __( "test_cpt", "twentyseventeen" ),
	);

	$args = array(
		"label" => __( "test_cpt", "twentyseventeen" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "test_cpt", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "test_cpt", $args );
}

add_action( 'init', 'cptui_register_my_cpts_test_cpt' );
