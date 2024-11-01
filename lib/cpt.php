<?php
// Custom Post Type Setup
function wpbrim_post_type() {
	$labels = array(
		'name' => __('All Carousels', 'wb-carousel'),
		'singular_name' => __('WB Carousel', 'wb-carousel'),
		'add_new' => __('Add New Carousel', 'wb-carousel'),
		'add_new_item' => __('Add New Carousel', 'wb-carousel'),
		'all_items' => __('All Carousels', 'wb-carousel' ),
		'edit_item' => __('Edit Carousel', 'wb-carousel'),
		'new_item' => __('New Carousel', 'wb-carousel'),
		'view_item' => __('View Carousel', 'wb-carousel'),
		'search_items' => __('Search Carousel', 'wb-carousel'),
		'not_found' => __('No Carousel', 'wb-carousel'),
		'not_found_in_trash' => __('No Carousel found in Trash', 'wb-carousel'),
		'parent_item_colon' => '',
		'menu_name' => __('WB Carousels', 'wb-carousel') // this name will be shown on the menu
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 21,
		'menu_icon' =>plugins_url('/wb-carousel/assets/images/icons.png'),
		'supports' => array('title','thumbnail')
	);
	register_post_type('wb_carousel', $args);
}
 add_action( 'init', 'wpbrim_post_type' );

// Adding a taxonomy for the carousel post type
function wpbrim_carousel_taxonomy() {
		$args = array('hierarchical' => true);
		register_taxonomy( 'carousel_category', 'wb_carousel', $args );
	}
 add_action( 'init', 'wpbrim_carousel_taxonomy', 0 );
