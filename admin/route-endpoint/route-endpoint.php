<?php

//Creating Route Endpoint - Meta box
function cd_acr_add_route_endpoint_meta_box() {
    add_meta_box(
        'cd_acr_route_endpoint', // $id
        'Route Endpoint', // $title
        'cd_acr_show_route_endpoint_meta_box', // $callback
        'cd-custom-rest-api', // $screen
        'normal', // $context
        'high' // $priority
    );
}

add_action( 'add_meta_boxes', 'cd_acr_add_route_endpoint_meta_box' );


//Show Route Endpoint - Custom Fields
function cd_acr_show_route_endpoint_meta_box( $post ) {

  //Get ID of the current post
  $postID = $_GET['post'];
  //Get title of endpoint
  $endpointTitleBase = get_the_title($postID);
  //make title lowercase
  $endpointTitleLowercase = strtolower($endpointTitleBase);
  //Make alphanumerice (remove all other characters)
  $endpointTitleSpecialChar = preg_replace("/[^a-z0-9_\s-]/", "", $endpointTitleLowercase);
  //Clean up multiple dashes or whitespaces
  $endpointTitleMultiWhitespace = preg_replace("/[\s-]+/", " ", $endpointTitleSpecialChar);
  //Replace whitespaces with dashes
  $endpointTitle = preg_replace("/[\s_]/", "-", $endpointTitleMultiWhitespace);

  $endpointURL = get_site_url().'/wp-json/custom-routes/v1/'.$endpointTitle;
  $customEndpoint = '<code><a href="'.$endpointURL.'" target="_blank">'.$endpointURL.'</a></code>';

  if($endpointTitleBase){
    $customEndpointFull = $customEndpoint;
  }else{
    $customEndpointFull = 'Publish the endpoint to receive the endpoint route.';
  } ?>

  <div class="cd_acr_route_endpoint_container">
    <?php echo $customEndpointFull; ?>
  </div>

<?php }; ?>
