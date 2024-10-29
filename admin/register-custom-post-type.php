<?php

// let's create the function for the custom type
function easy_custom_rest_api_endpoints_post_type() {
 // creating (registering) the custom type
 register_post_type( 'cd-custom-rest-api', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
   // let's now add all the options for this post type
   array( 'labels' => array(
     'name' => __( 'REST API Endpoints', 'bonestheme' ), /* This is the Title of the Group */
     'singular_name' => __( 'REST API Endpoint', 'bonestheme' ), /* This is the individual type */
     'all_items' => __( 'All REST API Endpoints', 'bonestheme' ), /* the all items menu item */
     'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
     'add_new_item' => __( 'Add New REST API Endpoint', 'bonestheme' ), /* Add New Display Title */
     'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
     'edit_item' => __( 'Edit REST API Endpoints', 'bonestheme' ), /* Edit Display Title */
     'new_item' => __( 'New REST API Endpoint', 'bonestheme' ), /* New Display Title */
     'view_item' => __( 'View REST API Endpoint', 'bonestheme' ), /* View Display Title */
     'search_items' => __( 'Search REST API Endpoint', 'bonestheme' ), /* Search Custom Type Title */
     'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */
     'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
     'parent_item_colon' => ''
     ), /* end of arrays */
     'description' => __( 'This is the custom REST API endpoint post type', 'bonestheme' ), /* Custom Type Description */
     'public' => false,
     'publicly_queryable' => true,
     'exclude_from_search' => true,
     'show_ui' => true,
     'query_var' => true,
     'show_in_menu' => false,
     'rewrite'	=> array( 'slug' => 'rest-api-endpoint', 'with_front' => false ), /* you can specify its url slug */
     'has_archive' => 'rest-api-endpoint', /* you can rename the slug here */
     'capability_type' => 'post',
     'hierarchical' => false,
     'show_in_rest' => true,
     /* the next one is important, it tells what's enabled in the post editor */
     'supports' => array( 'title')
   ) /* end of options */
 ); /* end of register post type */

 /* this adds your post categories to your custom post type */
 // register_taxonomy_for_object_type( 'category', 'custom_type' );
 /* this adds your post tags to your custom post type */
 // register_taxonomy_for_object_type( 'post_tag', 'custom_type' );

}

 // adding the function to the Wordpress init
 add_action( 'init', 'easy_custom_rest_api_endpoints_post_type');

 ?>
