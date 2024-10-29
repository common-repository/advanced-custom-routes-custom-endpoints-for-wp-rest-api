<?php


add_filter('manage_cd-custom-rest-api_posts_columns', 'cd_acr_columns');
function cd_acr_columns($columns) {
    $columns['endpoint'] = 'Custom Route';
    return $columns;
}

add_action('manage_cd-custom-rest-api_posts_custom_column',  'cd_acr_route_column');
function cd_acr_route_column($name) {
    global $post;
    switch ($name) {
        case 'endpoint':
            //Get title of endpoint
            $endpointTitleBase = get_the_title($post->ID);
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
            echo $customEndpoint;
    }
}

 ?>
