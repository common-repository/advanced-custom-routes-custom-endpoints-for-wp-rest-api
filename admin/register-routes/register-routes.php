<?php

add_action('rest_api_init', function() {

  $args = [
    'numberposts' => 99999,
    'post_type' => 'cd-custom-rest-api'
  ];

  $cd_customEndpoints = get_posts($args);

  foreach($cd_customEndpoints as $cd_customEndpoint) {

    //Get title of endpoint
    $endpointTitleBase = $cd_customEndpoint->post_title;
    //make title lowercase
    $endpointTitleLowercase = strtolower($endpointTitleBase);
    //Make alphanumerice (remove all other characters)
    $endpointTitleSpecialChar = preg_replace("/[^a-z0-9_\s-]/", "", $endpointTitleLowercase);
    //Clean up multiple dashes or whitespaces
    $endpointTitleMultiWhitespace = preg_replace("/[\s-]+/", " ", $endpointTitleSpecialChar);
    //Replace whitespaces with dashes
    $endpointTitle = preg_replace("/[\s_]/", "-", $endpointTitleMultiWhitespace);



    $endpointID = $cd_customEndpoint->ID;


    //Function to grab needed data for REST API
    $cd_acr_get_data = function ( WP_REST_Request $request ) use ($endpointID) {


      $amountParam = $request->get_param('amount');
      $offsetParam = $request->get_param('offset');
      $pageParam = $request->get_param('page');
      $postTypeParam = $request->get_param('post_type');
      $postIDInParam = $request->get_param('id');
      $postIDOutParam = $request->get_param('id_exclude');
      $catInParam = $request->get_param('category');
      $catOutParam = $request->get_param('category_exclude');
      $tagInParam = $request->get_param('tag');
      $tagOutParam = $request->get_param('tag_exclude');
      $authorInParam = $request->get_param('author');
      $authorOutParam = $request->get_param('author_exclude');
      $postParentInParam = $request->get_param('post_parent');
      $postParentOutParam = $request->get_param('post_parent_exclude');
      $postStatusParam = $request->get_param('status');
      $dateBeforeParam = $request->get_param('date_before');
      $dateAfterParam = $request->get_param('date_after');
      $orderParam = $request->get_param('order');
      $orderByParam = $request->get_param('orderby');

      $searchParam = $request->get_param('search');
      $slugParam = $request->get_param('slug');


      //SLUG
      if($slugParam == NULL) {
        $slug = '';
      }else{
        $slug = $slugParam;
      }

      //SEARCH
      if($searchParam == NULL) {
        $search = '';
      }else{
        $search = $searchParam;
      }


      //POST AMOUNT
      if($amountParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_amount' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_amount' ))){
          $amount = get_post_meta( $endpointID, 'cd_acr_amount' );
          $amount = implode(",",$amount);

          if($amount == ''){
            $amount = 10;
          }

        }else{
          $amount = 10;
        }
      }else{
        $amount = $amountParam;
      }


      //OFFSET
      if($offsetParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_offset' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_offset' ))){
          $offset = get_post_meta( $endpointID, 'cd_acr_offset' );
          $offset = implode(",",$offset);

          if($offset == ''){
            $offset = 0;
          }

        }else{
          $offset = 0;
        }
      }else{
        $offset = $offsetParam;
      }



      //PAGINATION
      if($pageParam == NULL){
        $postOffset = $offset;
      }else{
        //Math to figure out how many posts to offset for the next page of results.
        //page number minus one, then multiple that by the amount of posts per page.
        //Finally if there is an offset value add that to the page offset.
        $postOffset = ($amount * ($pageParam - 1)) + (int)$offset;
      }


      //ORDER
      if($orderParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_order' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_order' ))){
          $order = get_post_meta( $endpointID, 'cd_acr_order' );
          $order = implode(",",$order);
        }else{
          $order = 'desc';
        }
      }else{
        $order = $orderParam;
      }


      //ORDER BY
      if($orderByParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_orderby' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_orderby' ))){
          $orderBy = get_post_meta( $endpointID, 'cd_acr_orderby' );
          $orderBy = implode(",",$orderBy);
        }else{
          $orderBy = 'ID';
        }
      }else{
        $orderBy = $orderByParam;
      }


      //POST STATUS
      if($postStatusParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_status' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_status' ))){
          $status = get_post_meta( $endpointID, 'cd_acr_status' );
          $status = call_user_func_array('array_merge', $status);
        }else{
          $status = 'publish';
        }
      }else{
        $status = explode(',', $postStatusParam);
      }


      //POST TYPE
      if($postTypeParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_post_types' ) !== NULL && !empty(get_post_meta( $endpointID, 'cd_acr_post_types' ))){
          $postType = get_post_meta( $endpointID, 'cd_acr_post_types' );
          $postType = call_user_func_array('array_merge', $postType);
        }else{
          $postType = 'post';
        }
      }else{
        $postType = explode(',', $postTypeParam);
      }


      //AUTHORS INCLUDE
      if($authorInParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_authors' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_authors' ))){
          $authorsInclude = get_post_meta( $endpointID, 'cd_acr_authors' );
          $authorsInclude = call_user_func_array('array_merge', $authorsInclude);
        }else{
          $authorsInclude = null;
        }
      }else{
        $authorsInclude = explode(',', $authorInParam);
      }

      //AUTHORS EXCLUDE
      if($authorOutParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_authors_exclude' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_authors_exclude' ))){
          $authorsExclude = get_post_meta( $endpointID, 'cd_acr_authors_exclude' );
          $authorsExclude = call_user_func_array('array_merge', $authorsExclude);
        }else{
          $authorsExclude = null;
        }
      }else{
        $authorsExclude = explode(',', $authorOutParam);
      }



      //POST ID INCLUDE
      if($postIDInParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_post_ids' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_post_ids' ))){
          $postIDInclude = get_post_meta( $endpointID, 'cd_acr_post_ids' );
          $postIDInclude = call_user_func_array('array_merge', $postIDInclude);
        }else{
          $postIDInclude = null;
        }
      }else {
        $postIDInclude = explode(',', $postIDInParam);
      }


      //POST ID EXCLUDE
      if($postIDOutParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_post_ids_exclude' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_post_ids_exclude' ))){
          $postIDExclude = get_post_meta( $endpointID, 'cd_acr_post_ids_exclude' );
          $postIDExclude = call_user_func_array('array_merge', $postIDExclude);
        }else{
          $postIDExclude = null;
        }
      }else{
        $postIDExclude = explode(',', $postIDOutParam);
      }




      //CATEGORY INCLUDE
      if($catInParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_categories' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_categories' ))){
          $catInclude = get_post_meta( $endpointID, 'cd_acr_categories' );
          $catInclude = call_user_func_array('array_merge', $catInclude);
        }else{
          $catInclude = null;
        }
      }else{
        $catInclude = explode(',', $catInParam);
      }


      //CATEGORY EXCLUDE
      if($catOutParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_categories_exclude' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_categories_exclude' ))){
          $catExclude = get_post_meta( $endpointID, 'cd_acr_categories_exclude' );
          $catExclude = call_user_func_array('array_merge', $catExclude);
        }else{
          $catExclude = null;
        }
      }else{
        $catExclude = explode(',', $catOutParam);
      }



      //TAGS INCLUDE
      if($tagInParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_tags' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_tags' ))){
          $tagsInclude = get_post_meta( $endpointID, 'cd_acr_tags' );
          $tagsInclude = call_user_func_array('array_merge', $tagsInclude);
        }else{
          $tagsInclude = null;
        }
      }else{
        $tagsInclude = explode(',', $tagInParam);
      }




      //TAGS EXCLUDE
      if($tagOutParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_tags_exclude' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_tags_exclude' ))){
          $tagsExclude = get_post_meta( $endpointID, 'cd_acr_tags_exclude' );
          $tagsExclude = call_user_func_array('array_merge', $tagsExclude);
        }else{
          $tagsExclude = null;
        }
      }else{
        $tagsExclude = explode(',', $tagOutParam);
      }



      //DATE - BEFORE
      if($dateBeforeParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_date_before' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_date_before' ))){
          $dateBefore = get_post_meta( $endpointID, 'cd_acr_date_before' );
          $dateBefore = implode(",",$dateBefore);
          $dateBeforeType = 'before';
        }else{
          $dateBefore = null;
          $dateBeforeType = null;
        }
      }else{
        $dateBefore = $dateBeforeParam;
        $dateBeforeType = 'before';
      }



      //DATE - AFTER
      if($dateAfterParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_date_after' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_date_after' ))){
          $dateAfter = get_post_meta( $endpointID, 'cd_acr_date_after' );
          $dateAfter = implode(",",$dateAfter);
          $dateAfterType = 'after';
        }else{
          $dateAfter = null;
          $dateAfterType = null;
        }
      }else{
        $dateAfter = $dateAfterParam;
        $dateAfterType = 'after';
      }



      //POST PARENT INCLUDE
      if($postParentInParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_post_parent_include' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_post_parent_include' ))){
          $postParentInclude = get_post_meta( $endpointID, 'cd_acr_post_parent_include' );
          $postParentInclude = call_user_func_array('array_merge', $postParentInclude);
        }else{
          $postParentInclude = null;
        }
      }else {
        $postParentInclude = explode(',', $postParentInParam);
      }


      //POST PARENT EXCLUDE
      if($postParentOutParam == NULL) {
        if(get_post_meta( $endpointID, 'cd_acr_post_parent_exclude' ) !== null && !empty(get_post_meta( $endpointID, 'cd_acr_post_parent_exclude' ))){
          $postParentExclude = get_post_meta( $endpointID, 'cd_acr_post_parent_exclude' );
          $postParentExclude = call_user_func_array('array_merge', $postParentExclude);
        }else{
          $postParentExclude = null;
        }
      }else {
        $postParentExclude = explode(',', $postParentOutParam);
      }



      $args = [
        'numberposts' => 99999,
        'posts_per_page' => $amount,
        'offset' => $postOffset,
        'order' => $order,
        'orderby' => $orderBy,
        'post_status' => $status,
        'post_type' => $postType,
        'author__in' => $authorsInclude,
        'author__not_in' => $authorsExclude,
        'include' => $postIDInclude,
        'exclude' => $postIDExclude,
        'category__in' => $catInclude,
        'category__not_in' => $catExclude,
        'tag__in' => $tagsInclude,
        'tag__not_in' => $tagsExclude,
        'date_query' => array(
            $dateBeforeType => date($dateBefore),
            $dateAfterType => date($dateAfter),
         ),
         'post_parent__in' => $postParentInclude,
         'post_parent__not_in' => $postParentExclude,
         's' => $search,
         'name' => $slug,
      ];

      // var_dump($args);

      $posts = get_posts($args);

      $data = [];
      $i = 0;


      $fields = get_post_meta( $endpointID, 'cd_acr_output_fields' );

      foreach($posts as $post) {

        foreach ( $fields as $fieldsArray ) {
          foreach ($fieldsArray as $field) {
            $field = implode("",$field);

            if($field == 'id'){
              $data[$i]['id'] = $post->ID;
            }elseif($field == 'title'){
              $data[$i]['title'] = $post->post_title;
            }elseif($field == 'content'){
              $data[$i]['content'] = $post->post_content;
            }elseif($field == 'link'){
              $data[$i]['link'] = get_the_permalink($post->ID);
            }elseif($field == 'slug'){
              $data[$i]['slug'] = $post->post_name;
            }elseif($field == 'excerpt'){
              $data[$i]['excerpt'] = $post->post_excerpt;
            }elseif($field == 'date-posted'){
              $data[$i]['date_posted'] = $post->post_date;
            }elseif($field == 'status'){
              $data[$i]['status'] = $post->post_status;
            }elseif($field == 'post-type'){
              $data[$i]['post_type'] = $post->post_type;
            }elseif($field == 'template'){
              $data[$i]['template'] = get_page_template_slug( $post->ID );
            }elseif($field == 'parent-page'){
              $parentPageObject = (object) ['id' => $post->post_parent, 'title' => get_the_title($post->post_parent), 'link' => get_the_permalink($post->post_parent)];

              if($post->post_parent !== 0){
                  $data[$i]['post_parent'] = $parentPageObject;
              }

            }elseif($field == 'menu-order'){
              $data[$i]['menu_order'] = $post->menu_order;
            }elseif($field == 'featured-image'){
              $thumbnail_id = get_post_thumbnail_id( $post->ID );
              $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
              $url = get_the_post_thumbnail_url($post->ID);

              $featImgObject = (object) ['id' => $thumbnail_id, 'url' => $url, 'alt' => $alt];

              if($thumbnail_id !== ''){
                $data[$i]['featured_image'] = $featImgObject;
              }

            }elseif($field == 'author'){
              $userData = get_userdata($post->post_author);
              $authorObject = (object) ['id' => $userData->ID, 'username' => $userData->user_nicename, 'email' => $userData->user_email, 'display_name' => $userData->display_name, 'link' => get_author_posts_url($userData->ID), 'roles' => $userData->roles];

              $data[$i]['author'] = $authorObject;
            }elseif($field == 'categories'){
              $categories = get_the_category($post->ID);

              $data[$i]['categories'] = $categories;
            }elseif($field == 'tags'){
              $tags = get_the_tags($post->ID);

              $data[$i]['tags'] = $tags;
            }else{

              if(get_option( 'cd_acr_custom_field_type' ) == 'custom_built'){

                //Custom Built Field
                $data[$i][$field] = get_post_meta( $post->ID, $field, true );

              }elseif(get_option( 'cd_acr_custom_field_type' ) == 'acf'){

                //ACF
                $data[$i][$field] = get_field( $field, $post->ID );

              }elseif(get_option( 'cd_acr_custom_field_type' ) == 'metabox_io'){

                //MetaBox.io
                $data[$i][$field] = rwmb_meta( $field, '', $post->ID );

              }elseif(get_option( 'cd_acr_custom_field_type' ) == 'carbon_fields'){

                //Carbon Fields
                $data[$i][$field] = carbon_get_post_meta( $post->ID, $field );

              }else{

                //Custom Built Field
                $data[$i][$field] = get_post_meta( $post->ID, $field, true );

              }


            }

          }


        }


        $i++;
      }

      return $data;


    };


    //Reister Route for All Posts
    register_rest_route('custom-routes/v1', $endpointTitle, [
      'methods' => 'GET',
      'callback' => $cd_acr_get_data,
    ]);

    //Register Route for Single Post by ID
    register_rest_route('custom-routes/v1', $endpointTitle . '/(?P<id>[\d]+)', [
      'methods' => 'GET',
      'callback' => $cd_acr_get_data,
    ]);

    //Register Route for Single Post by Slug
    register_rest_route('custom-routes/v1', $endpointTitle . '/(?P<slug>[a-zA-Z0-9-]+)', [
      'methods' => 'GET',
      'callback' => $cd_acr_get_data,
    ]);

  };


});

 ?>
