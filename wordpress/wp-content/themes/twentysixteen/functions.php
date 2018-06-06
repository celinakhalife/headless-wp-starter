<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}


// Add custom API tutorial endpoints
require_once 'inc/api-routes.php';


if ( ! function_exists( 'twentysixteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own twentysixteen_setup() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function twentysixteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on Twenty Sixteen, use a find and replace
		 * to change 'twentysixteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'twentysixteen' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Twenty Sixteen 1.2
		 */
		add_theme_support(
			'custom-logo', array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'twentysixteen' ),
				'social'  => __( 'Social Links Menu', 'twentysixteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'twentysixteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own twentysixteen_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentysixteen_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Inconsolata:400';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				), 'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script(
		'twentysixteen-script', 'screenReaderText', array(
			'expand'   => __( 'expand child menu', 'twentysixteen' ),
			'collapse' => __( 'collapse child menu', 'twentysixteen' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );


function cptui_register_my_cpts() {

	/**
	 * Post Type: Post Labels Using CPT.
	 */

	$labels = array(
		"name" => __( "Post Labels Using CPT", "twentysixteen" ),
		"singular_name" => __( "Post Label", "twentysixteen" ),
	);

	$args = array(
		"label" => __( "Post Labels Using CPT", "twentysixteen" ),
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
		"rewrite" => array( "slug" => "post_type_slug", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "post_type_slug", $args );

	/**
	 * Post Type: Movies CPT.
	 */

	$labels = array(
		"name" => __( "Movies CPT", "twentysixteen" ),
		"singular_name" => __( "Movie", "twentysixteen" ),
		"menu_name" => __( "Movies cpt", "twentysixteen" ),
		"all_items" => __( "All Movies", "twentysixteen" ),
		"add_new" => __( "Add New", "twentysixteen" ),
		"add_new_item" => __( "Add New Movie", "twentysixteen" ),
		"edit_item" => __( "Wdit Movie", "twentysixteen" ),
		"new_item" => __( "New Movie", "twentysixteen" ),
		"view_item" => __( "View Movie", "twentysixteen" ),
		"view_items" => __( "View Movies", "twentysixteen" ),
		"search_items" => __( "Search Movies", "twentysixteen" ),
		"not_found" => __( "No Movies Found", "twentysixteen" ),
		"not_found_in_trash" => __( "No Movies Found in Trash", "twentysixteen" ),
		"parent_item_colon" => __( "Parent Movie", "twentysixteen" ),
		"featured_image" => __( "Featured Movie Image", "twentysixteen" ),
		"set_featured_image" => __( "Set Featured Movie Image", "twentysixteen" ),
		"remove_featured_image" => __( "Remove Featured Movie Image", "twentysixteen" ),
		"use_featured_image" => __( "Use Featured Movie Image", "twentysixteen" ),
		"archives" => __( "Movie Archives", "twentysixteen" ),
		"insert_into_item" => __( "Insert Into Movie", "twentysixteen" ),
		"parent_item_colon" => __( "Parent Movie", "twentysixteen" ),
	);

	$args = array(
		"label" => __( "Movies CPT", "twentysixteen" ),
		"labels" => $labels,
		"description" => "Post Type Description",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "movies_post_type",
		"has_archive" => false,
		"show_in_menu" => "top-level",
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "post_movies", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-smiley",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "post_movies", $args );

	/**
	 * Post Type: test_cpt.
	 */

	$labels = array(
		"name" => __( "test_cpt", "twentysixteen" ),
		"singular_name" => __( "test_cpt", "twentysixteen" ),
	);

	$args = array(
		"label" => __( "test_cpt", "twentysixteen" ),
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

	/**
	 * Post Type: Movies CPT.
	 */

	$labels = array(
		"name" => __( "Movies CPT", "twentysixteen" ),
		"singular_name" => __( "Movie", "twentysixteen" ),
		"menu_name" => __( "Movies cpt", "twentysixteen" ),
		"all_items" => __( "All Movies", "twentysixteen" ),
		"add_new" => __( "Add New", "twentysixteen" ),
		"add_new_item" => __( "Add New Movie", "twentysixteen" ),
		"edit_item" => __( "Wdit Movie", "twentysixteen" ),
		"new_item" => __( "New Movie", "twentysixteen" ),
		"view_item" => __( "View Movie", "twentysixteen" ),
		"view_items" => __( "View Movies", "twentysixteen" ),
		"search_items" => __( "Search Movies", "twentysixteen" ),
		"not_found" => __( "No Movies Found", "twentysixteen" ),
		"not_found_in_trash" => __( "No Movies Found in Trash", "twentysixteen" ),
		"parent_item_colon" => __( "Parent Movie", "twentysixteen" ),
		"featured_image" => __( "Featured Movie Image", "twentysixteen" ),
		"set_featured_image" => __( "Set Featured Movie Image", "twentysixteen" ),
		"remove_featured_image" => __( "Remove Featured Movie Image", "twentysixteen" ),
		"use_featured_image" => __( "Use Featured Movie Image", "twentysixteen" ),
		"archives" => __( "Movie Archives", "twentysixteen" ),
		"insert_into_item" => __( "Insert Into Movie", "twentysixteen" ),
		"parent_item_colon" => __( "Parent Movie", "twentysixteen" ),
	);

	$args = array(
		"label" => __( "Movies CPT", "twentysixteen" ),
		"labels" => $labels,
		"description" => "Post Type Description",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "movies_post_type",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "post_bla_movies", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-smiley",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "post_bla_movies", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );



/////////////////////////
/**
 * Plugin Name: Shortcode UI Example
 * Version: 1.0.0
 * Description: Adds [shortcake_dev] and [shortcake-no-attributes] example shortcodes to see Shortcode UI in action.
 * Author: Fusion Engineering and community
 * Author URI: http://next.fusion.net/tag/shortcode-ui/
 * Text Domain: shortcode-ui-example
 * License: GPL v2 or later
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/*
 * This plugin handles the registration of two shortcodes, and the related Shortcode UI:
 *  a. [shortcake-no-attributes] - a shortcode with a minimal UI example that has no user inputs.
 *  b. [shortcake_dev] - a shortcode with a selection of user inputs.
 *
 * The plugin is broken down into four stages:
 *  0. Check to see if Shortcake is running, with an admin notice if not.
 *  1. Register the shortcodes - this is standard WP behaviour, nothing new here.
 *  2. Register the Shortcode UI setup for shortcodes.
 *  3. Define the callback for the advanced shortcode - fairly standard WP behaviour, nothing new here.
 */

/*
 * 0. Check to see if Shortcake is running, with an admin notice if not.
 */

add_action( 'init', 'shortcode_ui_detection' );
/**
 * If Shortcake isn't active, then add an administration notice.
 *
 * This check is optional. The addition of the shortcode UI is via an action hook that is only called in Shortcake.
 * So if Shortcake isn't active, you won't be presented with errors.
 *
 * Here, we choose to tell users that Shortcake isn't active, but equally you could let it be silent.
 *
 * Why not just self-deactivate this plugin? Because then the shortcodes would not be registered either.
 *
 * @since 1.0.0
 */
function shortcode_ui_detection() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		add_action( 'admin_notices', 'shortcode_ui_dev_example_notices' );
	}
}

/**
 * Display an administration notice if the user can activate plugins.
 *
 * If the user can't activate plugins, then it's poor UX to show a notice they can't do anything to fix.
 *
 * @since 1.0.0
 */
function shortcode_ui_dev_example_notices() {
	if ( current_user_can( 'activate_plugins' ) ) {
		?>
		<div class="error message">
			<p><?php esc_html_e( 'Shortcode UI plugin must be active for Shortcode UI Example plugin to function.', 'shortcode-ui-example', 'shortcode-ui' ); ?></p>
		</div>
		<?php
	}
}




/*
 * 1. Register the shortcodes.
 */

add_action( 'init', 'shortcode_ui_dev_register_shortcodes' );
/**
 * Register two shortcodes, shortcake_dev and shortcake-no-attributes.
 *
 * This registration is done independently of any UI that might be associated with them, so it always happens, even if
 * Shortcake is not active.
 *
 * @since 1.0.0
 */
function shortcode_ui_dev_register_shortcodes() {
	// This is a simple example for a pullquote with a citation.
	add_shortcode( 'shortcake_dev', 'shortcode_ui_dev_shortcode' );
}


add_action( 'register_shortcode_ui', 'shortcode_ui_dev_advanced_example' );
/**
 * Shortcode UI setup for the shortcake_dev shortcode.
 *
 * It is called when the Shortcake action hook `register_shortcode_ui` is called.
 *
 * This example shortcode has many editable attributes, and more complex UI.
 *
 * @since 1.0.0
 */
function shortcode_ui_dev_advanced_example() {
	/*
	 * Define the UI for attributes of the shortcode. Optional.
	 *
	 * In this demo example, we register multiple fields related to showing a quotation
	 * - Attachment, Citation Source, Select Page, Background Color, Alignment and Year.
	 *
	 * If no UI is registered for an attribute, then the attribute will
	 * not be editable through Shortcake's UI. However, the value of any
	 * unregistered attributes will be preserved when editing.
	 *
	 * Each array must include 'attr', 'type', and 'label'.
	 * * 'attr' should be the name of the attribute.
	 * * 'type' options include: text, checkbox, textarea, radio, select, email,
	 *     url, number, and date, post_select, attachment, color.
	 * * 'label' is the label text associated with that input field.
	 *
	 * Use 'meta' to add arbitrary attributes to the HTML of the field.
	 *
	 * Use 'encode' to encode attribute data. Requires customization in shortcode callback to decode.
	 *
	 * Depending on 'type', additional arguments may be available.
	 */
	$fields = array(
		array(
			'label'       => esc_html__( 'Attachment', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'        => 'attachment',
			'type'        => 'attachment',
			/*
			 * These arguments are passed to the instantiation of the media library:
			 * 'libraryType' - Type of media to make available.
			 * 'addButton'   - Text for the button to open media library.
			 * 'frameTitle'  - Title for the modal UI once the library is open.
			 */
			'libraryType' => array( 'image' ),
			'addButton'   => esc_html__( 'Select Image', 'shortcode-ui-example', 'shortcode-ui' ),
			'frameTitle'  => esc_html__( 'Select Image', 'shortcode-ui-example', 'shortcode-ui' ),
		),
		array(
			'label'       => 'Gallery',
			'attr'        => 'gallery',
			'description' => esc_html__( 'You can select multiple images.', 'shortcode-ui' ),
			'type'        => 'attachment',
			'libraryType' => array( 'image' ),
			'multiple'    => true,
			'addButton'   => 'Select Images',
			'frameTitle'  => 'Select Images',
		),
		array(
			'label'  => esc_html__( 'Citation Source', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'   => 'source',
			'type'   => 'text',
			'encode' => true,
			'meta'   => array(
				'placeholder' => esc_html__( 'Test placeholder', 'shortcode-ui-example', 'shortcode-ui' ),
				'data-test'   => 1,
			),
		),
		array(
			'label'    => esc_html__( 'Select Page', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'     => 'page',
			'type'     => 'post_select',
			'query'    => array( 'post_type' => 'page' ),
			'multiple' => true,
		),
		array(
			'label'    => __( 'Select Tag', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'     => 'tag',
			'type'     => 'term_select',
			'taxonomy' => 'post_tag',
			'multiple' => true,
		),
		array(
			'label'    => __( 'User Select', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'     => 'users',
			'type'     => 'user_select',
			'multiple' => true,
		),
		array(
			'label'  => esc_html__( 'Color', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'   => 'color',
			'type'   => 'color',
			'encode' => false,
			'meta'   => array(
				'placeholder' => esc_html__( 'Hex color code', 'shortcode-ui-example', 'shortcode-ui' ),
			),
		),
		array(
			'label'       => esc_html__( 'Alignment', 'shortcode-ui-example', 'shortcode-ui' ),
			'description' => esc_html__( 'Whether the quotation should be displayed as pull-left, pull-right, or neither.', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'        => 'alignment',
			'type'        => 'select',
			'options'     => array(
				array( 'value' => '', 'label' => esc_html__( 'None', 'shortcode-ui-example', 'shortcode-ui' ) ),
				array( 'value' => 'left', 'label' => esc_html__( 'Pull Left', 'shortcode-ui-example', 'shortcode-ui' ) ),
				array( 'value' => 'right', 'label' => esc_html__( 'Pull Right', 'shortcode-ui-example', 'shortcode-ui' ) ),
				array(
					'label' => 'Test Optgroup',
					'options' => array(
						array( 'value' => 'left-2', 'label' => esc_html__( 'Pull Left', 'shortcode-ui-example', 'shortcode-ui' ) ),
						array( 'value' => 'right-2', 'label' => esc_html__( 'Pull Right', 'shortcode-ui-example', 'shortcode-ui' ) ),
					)
				),
			),
		),
		array(
			'label'       => esc_html__( 'CSS Classes', 'shortcode-ui-example', 'shortcode-ui' ),
			'description' => esc_html__( 'Which classes the shortcode should get.', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'        => 'classes',
			'type'        => 'select',
			/**
			 * Use this to allow for multiple selections – similar to `'multiple' => true'`.
			 */
			'meta' => array( 'multiple' => true ),
			'options'     => array(
				array( 'value' => '', 'label' => esc_html__( 'Default', 'shortcode-ui-example', 'shortcode-ui' ) ),
				array( 'value' => 'bold', 'label' => esc_html__( 'Bold', 'shortcode-ui-example', 'shortcode-ui' ) ),
				array( 'value' => 'italic', 'label' => esc_html__( 'Italic', 'shortcode-ui-example', 'shortcode-ui' ) ),
			),
		),
		array(
			'label'       => esc_html__( 'Year', 'shortcode-ui-example', 'shortcode-ui' ),
			'description' => esc_html__( 'Optional. The year the quotation is from.', 'shortcode-ui-example', 'shortcode-ui' ),
			'attr'        => 'year',
			'type'        => 'number',
			'meta'        => array(
				'placeholder' => 'YYYY',
				'min'         => '1990',
				'max'         => date_i18n( 'Y' ),
				'step'        => '1',
			),
		),
	);

	/*
	 * Define the Shortcode UI arguments.
	 */
	$shortcode_ui_args = array(
		/*
		 * How the shortcode should be labeled in the UI. Required argument.
		 */
		'label' => esc_html__( 'Shortcake Dev', 'shortcode-ui-example', 'shortcode-ui' ),

		/*
		 * Include an icon with your shortcode. Optional.
		 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
		 */
		'listItemImage' => 'dashicons-editor-quote',

		/*
		 * Limit this shortcode UI to specific posts. Optional.
		 */
		'post_type' => array( 'post' ),

		/*
		 * Register UI for the "inner content" of the shortcode. Optional.
		 * If no UI is registered for the inner content, then any inner content
		 * data present will be backed-up during editing.
		 */
		'inner_content' => array(
			'label'        => esc_html__( 'Quote', 'shortcode-ui-example', 'shortcode-ui' ),
			'description'  => esc_html__( 'Include a statement from someone famous.', 'shortcode-ui-example', 'shortcode-ui' ),
		),

		/*
		 * Define the UI for attributes of the shortcode. Optional.
		 *
		 * See above, to where the the assignment to the $fields variable was made.
		 */
		'attrs' => $fields,
	);

	shortcode_ui_register_for_shortcode( 'shortcake_dev', $shortcode_ui_args );
}




/*
 * 3. Define the callback for the advanced shortcode.
 */

/**
 * Callback for the shortcake_dev shortcode.
 *
 * It renders the shortcode based on supplied attributes.
 */
function shortcode_ui_dev_shortcode( $attr, $content, $shortcode_tag ) {

	$attr = shortcode_atts( array(
		'source'     => '',
		'attachment' => 0,
		'gallery'    => '',
		'page'       => '',
		'term'       => '',
		'users'      => '',
		'color'      => '',
		'alignment'  => '',
		'classes'  => '',
		'year'       => '',
	), $attr, $shortcode_tag );

	$attr['page'] = array_map(
		function( $post_id ) {
			return get_the_title( $post_id );
		},
		array_filter( array_map( 'absint', explode( ',', $attr['page'] ) ) )
	);

	$attr['term'] = array_map(
		function( $term_id ) {
			$data = get_term( $term_id, 'post_tag' );
			return $data->name;
		},
		array_filter( array_map( 'absint', explode( ',', $attr['term'] ) ) )
	);

	$attr['users'] = array_map(
		function( $user_id ) {
			$data = get_userdata( $user_id );
			return $data->display_name;
		},
		array_filter( array_map( 'absint', explode( ',', $attr['users'] ) ) )
	);

	$attr['color'] = urldecode( $attr['color'] );

	// Shortcode callbacks must return content, hence, output buffering here.
	ob_start();
	?>
	<section class="pullquote" style="padding: 20px; background: rgba(0, 0, 0, 0.1);">
		<p style="margin:0; padding: 0;">

			<?php if ( ! empty( $content ) ) : ?>
			<b><?php esc_html_e( 'Content:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo wpautop( wp_kses_post( $content ) ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['source'] ) ) : ?>
			<b><?php esc_html_e( 'Source:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo wp_kses_post( $attr['source'] ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['attachment'] ) ) : ?>
			<b><?php esc_html_e( 'Image:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo wp_kses_post( wp_get_attachment_image( $attr['attachment'], array( 50, 50 ) ) ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['gallery'] ) ) : ?>
				<b><?php esc_html_e( 'Gallery:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b>
				<?php foreach ( explode( ',', $attr['gallery'] ) as $attachment ) : ?>
					 <?php echo wp_kses_post( wp_get_attachment_image( $attachment, array( 50, 50 ) ) ); ?>
				<?php endforeach; ?>
				<br />
			<?php endif; ?>

			<?php if ( ! empty( $attr['page'] ) ) : ?>
				<b><?php esc_html_e( 'Pages:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo esc_html( implode( ', ', $attr['page'] ) ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['term'] ) ) : ?>
				<b><?php esc_html_e( 'Terms:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo esc_html( implode( ', ', $attr['term'] ) ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['users'] ) ) : ?>
				<b><?php esc_html_e( 'Users:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo esc_html( implode( ', ', $attr['users'] ) ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['color'] ) ) : ?>
				<b><?php esc_html_e( 'Color:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: bottom; background-color: <?php echo esc_html( $attr['color'] ); ?>"></span></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['alignment'] ) ) : ?>
				<b><?php esc_html_e( 'Alignment:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo esc_html( $attr['alignment'] ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['classes'] ) ) : ?>
				<b><?php esc_html_e( 'Classes:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo esc_html( $attr['classes'] ); ?></br>
			<?php endif; ?>

			<?php if ( ! empty( $attr['year'] ) ) : ?>
				<b><?php esc_html_e( 'Year:', 'shortcode-ui-example', 'shortcode-ui' ); ?></b> <?php echo esc_html( $attr['year'] ); ?></br>
			<?php endif; ?>

		</p>
	</section>
	<?php

	return ob_get_clean();
}


