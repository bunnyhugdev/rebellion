<?php


// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function add_custom_posts() {
	// creating (registering) the custom type
	register_post_type( 'brew_type',
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Rebellion Brews', 'rebelliontheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Rebellion Brew', 'rebelliontheme' ), /* This is the individual type */
			'all_items' => __( 'All Rebellion Brews', 'rebelliontheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'rebelliontheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Brew', 'rebelliontheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'rebelliontheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Post Types', 'rebelliontheme' ), /* Edit Display Title */
			'new_item' => __( 'New Post Type', 'rebelliontheme' ), /* New Display Title */
			'view_item' => __( 'View Post Type', 'rebelliontheme' ), /* View Display Title */
			'search_items' => __( 'Search Post Type', 'rebelliontheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'rebelliontheme' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'rebelliontheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Beverages brewed by Rebellion Brewing Co.', 'rebelliontheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/beer-nonic-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'brew', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'brew', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions')
		) /* end of options */
	); /* end of register post type */
	register_post_type( 'bio_type',
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Bios', 'rebelliontheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Bio', 'rebelliontheme' ), /* This is the individual type */
			'all_items' => __( 'All Bios', 'rebelliontheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'rebelliontheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Bio', 'rebelliontheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'rebelliontheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Bio', 'rebelliontheme' ), /* Edit Display Title */
			'new_item' => __( 'New Bio', 'rebelliontheme' ), /* New Display Title */
			'view_item' => __( 'View Bio', 'rebelliontheme' ), /* View Display Title */
			'search_items' => __( 'Search Bios', 'rebelliontheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'rebelliontheme' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'rebelliontheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Biographies of employees at Rebellion Brewing Co.', 'rebelliontheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-businessman', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'bio', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'bio', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions')
		) /* end of options */
	); /* end of register post type */
	register_post_type( 'location_type',
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Locations', 'rebelliontheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Location', 'rebelliontheme' ), /* This is the individual type */
			'all_items' => __( 'All Locations', 'rebelliontheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'rebelliontheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Location', 'rebelliontheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'rebelliontheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Location', 'rebelliontheme' ), /* Edit Display Title */
			'new_item' => __( 'New Location', 'rebelliontheme' ), /* New Display Title */
			'view_item' => __( 'View Location', 'rebelliontheme' ), /* View Display Title */
			'search_items' => __( 'Search Locations', 'rebelliontheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'rebelliontheme' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'rebelliontheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Locations where one can find Rebellion beverages.', 'rebelliontheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-location-alt', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'location', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'location', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions')
		) /* end of options */
	); /* end of register post type */
}

	// adding the function to the Wordpress init
	add_action( 'init', 'add_custom_posts');

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/

	// now let's add custom categories (these act like categories)
	register_taxonomy( 'custom_cat',
		array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Custom Categories', 'rebelliontheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Custom Category', 'rebelliontheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Custom Categories', 'rebelliontheme' ), /* search title for taxomony */
				'all_items' => __( 'All Custom Categories', 'rebelliontheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Custom Category', 'rebelliontheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Custom Category:', 'rebelliontheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Custom Category', 'rebelliontheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Custom Category', 'rebelliontheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Custom Category', 'rebelliontheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Custom Category Name', 'rebelliontheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'custom-slug' ),
		)
	);

	// now let's add custom tags (these act like categories)
	register_taxonomy( 'custom_tag',
		array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Custom Tags', 'rebelliontheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Custom Tag', 'rebelliontheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Custom Tags', 'rebelliontheme' ), /* search title for taxomony */
				'all_items' => __( 'All Custom Tags', 'rebelliontheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Custom Tag', 'rebelliontheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Custom Tag:', 'rebelliontheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Custom Tag', 'rebelliontheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Custom Tag', 'rebelliontheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Custom Tag', 'rebelliontheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Custom Tag Name', 'rebelliontheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);

	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/


?>
