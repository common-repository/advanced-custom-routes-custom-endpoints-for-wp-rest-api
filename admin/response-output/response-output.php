<?php

//Creating Response Output - Meta box
function cd_acr_add_response_output_meta_box() {
    add_meta_box(
        'cd_acr_response_output', // $id
        'Response Output', // $title
        'cd_acr_show_response_output_meta_box', // $callback
        'cd-custom-rest-api', // $screen
        'normal', // $context
        'high' // $priority
    );
}

add_action( 'add_meta_boxes', 'cd_acr_add_response_output_meta_box' );






//Show Response Output - Custom Fields
function cd_acr_show_response_output_meta_box( $post ) {

    $cd_acr_output_fields_group = get_post_meta($post->ID, 'cd_acr_output_fields', true);
     wp_nonce_field( 'gpm_repeatable_meta_box_nonce', 'gpm_repeatable_meta_box_nonce' );


     $default_fields = array(
       'id' => 'ID',
       'title' => 'Title',
       'content' => 'Content',
       'link' => 'Link',
       'slug' => 'Slug',
       'excerpt' => 'Excerpt',
       'date-posted' => 'Date Posted',
       'status' => 'Status',
       'post-type' => 'Post Type',
       'template' => 'Template',
       'parent-page' => 'Parent Page',
       'menu-order' => 'Menu Order',
       'featured-image' => 'Featured Image',
       'author' => 'Author',
       'categories' => 'Categories',
       'tags' => 'Tags',
     );


     global $wpdb;

     $customFieldsQuery = $wpdb->get_results(
       'SELECT distinct( meta_key ) FROM '.$wpdb->postmeta.' WHERE meta_key NOT LIKE "\_%" AND meta_key NOT LIKE "\cd_acr%"', ARRAY_N
     );


     $customFieldsArray = [];

     foreach ($customFieldsQuery as $key => $value) {
       foreach ($value as $key2 => $value2) {
         $customFieldsArray[$value2] = $value2;
       }
     }


     $all_custom_fields = array_merge($default_fields, $customFieldsArray);


    ?>


<script type="text/javascript">
    jQuery(document).ready(function( $ ){
        $( '#add-row' ).on('click', function() {
            var row = $( '.empty-row.screen-reader-text' ).clone(true);
            row.removeClass( 'empty-row screen-reader-text' );
            row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
            return false;
        });

        $( '.remove-row' ).on('click', function() {
            $(this).parents('tr').remove();
            return false;
        });
    });
  </script>

<table id="repeatable-fieldset-one" class="cd_acr_response_output_container" width="100%">
  <tbody>
    <?php
     if ( $cd_acr_output_fields_group ) :
      foreach ( $cd_acr_output_fields_group as $field ) {
    ?>
    <tr>
      <td width="85%">
      <select class="cd_acr_output_fields_dropdown" name="outputField[]" id="outputField[]">
    			<option value="">Select a field</option>
          <?php // Loop through array and make a checkbox for each element
          foreach ( $all_custom_fields as $fieldID => $fieldName) { ?>
              <option value="<?php echo $fieldID; ?>" <?php selected( $field['outputField'], $fieldID ); ?>><?php echo $fieldName; ?></option>
            <?php } ?>
    	</select>
      </td>
      <td width="15%"><a class="button remove-row" href="#1">Remove</a></td>
    </tr>
    <?php
    }
    else :
    // show a blank one
    ?>
    <tr>
      <td>
        <select class="cd_acr_output_fields_dropdown" name="outputField[]" id="outputField[]">
    			<option value="">Select a field</option>
          <?php // Loop through array and make a checkbox for each element
          foreach ( $all_custom_fields as $fieldID => $fieldName) { ?>
              <option value="<?php echo $fieldID; ?>"><?php echo $fieldName; ?></option>
            <?php } ?>

    	</select>
     </td>
      <td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
    </tr>
    <?php endif; ?>

    <!-- empty hidden one for jQuery -->
    <tr class="empty-row screen-reader-text">
      <td>
      <select class="cd_acr_output_fields_dropdown" name="outputField[]" id="outputField[]">
          <option value="">Select a field</option>
          <?php // Loop through array and make a checkbox for each element
          foreach ( $all_custom_fields as $fieldID => $fieldName) { ?>
              <option value="<?php echo $fieldID; ?>"><?php echo $fieldName; ?></option>
            <?php } ?>
    	</select>
      </td>
      <td><a class="button remove-row" href="#">Remove</a></td>
    </tr>
  </tbody>
</table>
<div><a id="add-row" class="button" href="#">Add Field</a></div>


 <?php };



 function cd_acr_save_response_output_fields( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }


    $fields = [
        'cd_acr_output_fields',
    ];

    $old = get_post_meta($post_id, 'cd_acr_output_fields', true);
    $new = array();
    $outputItems = $_POST['outputField'];

    if(!empty( $outputItems )){

     $count = count( $outputItems );
     for ( $i = 0; $i < $count; $i++ ) {
        if ( $outputItems[$i] != '' ) :
            $new[$i]['outputField'] = stripslashes( strip_tags( $outputItems[$i] ) );
            //  $new[$i]['TitleDescription'] = stripslashes( $prices[$i] ); // and however you want to sanitize
        endif;
    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'cd_acr_output_fields', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'cd_acr_output_fields', $old );


    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }

   }

}

add_action( 'save_post', 'cd_acr_save_response_output_fields' );











 ?>
