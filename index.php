<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name: Advanced Custom Routes - Custom Endpoints for WP REST API
 * Description: The easiest solution to add custom REST API routes to your WordPress site.
 * Author: Carlile Design
 * Version: 0.8.0
 * Author URI: carlile.design
 */


 //Register Custom Endpoint Post Type
 include 'admin/register-custom-post-type.php';

 //Create Query Builder Option Fields
 include 'admin/query-builder/query-builder-options.php';

 //Create Response Output Fields
 include 'admin/response-output/response-output.php';

 //Create Route Endpoint Fields
 include 'admin/route-endpoint/route-endpoint.php';

 //Register Routes Function
 include 'admin/register-routes/register-routes.php';



include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active('advanced-custom-routes-custom-endpoints-for-wp-rest-api/index.php')) {

  $dir = plugin_dir_path( __FILE__ );

  require_once($dir.'admin/settings.php');

  require_once($dir.'admin/endpoint-column.php');


  // require_once($dir.'public/frontend/frontend.php');

  //Add styles to admin settings
  function cd_acr_styles() {
      wp_enqueue_style( 'cd_acr_enqueue', plugins_url( 'admin/lib/css/dist/styles.css', __FILE__ ) );
  }
  add_action('admin_print_styles', 'cd_acr_styles');


  wp_register_style( 'select2_styles', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css' );
  wp_enqueue_style('select2_styles');

  wp_register_script( 'select2_scripts', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js', 'jquery', null, true );
  wp_enqueue_script('select2_scripts');



  //Add scripts to admin settings
  function cd_acr_scripts() {
      wp_enqueue_script( 'cd_acr_enqueue', plugins_url( 'admin/lib/js/scripts.js', __FILE__ ) );
  }
  add_action('admin_print_styles', 'cd_acr_scripts');




}
