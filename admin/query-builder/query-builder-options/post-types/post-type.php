<?php //POST TYPES

// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_post_type_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_post_types', true ) );


$postTypeArgs = array(
   'public'   => true,
   '_builtin' => false
);

$post_types = get_post_types( $postTypeArgs );

$default_post_types = array(
  'post' => 'post',
  'page' => 'page',
);

$all_post_types = array_merge($default_post_types, $post_types);

 ?>

<div class="cd_acr_field cd_acr_field--post-types cd_acr_field--active">

  <div class="cd_acr_checkboxes">

  <?php
  $i = 0;
  // Loop through array and make a checkbox for each element
  foreach ( $all_post_types as $id => $post_type) {

      // If the postmeta for checkboxes exist and
      // this element is part of saved meta check it.
      if ( is_array( $cd_acr_post_type_meta ) && in_array( $id, $cd_acr_post_type_meta ) ) {
          $checked = 'checked="checked"';
      } else {
          $checked = null;
      }

      $i++;

      ?>

      <div>
          <label for="cd_acr_post_types<?php echo $i; ?>">
            <input  type="checkbox" name="post_types[]" id="cd_acr_post_types<?php echo $i; ?>" value="<?php echo $id;?>" <?php echo $checked; ?> />
            <?php echo $post_type;?>
          </label>
      </div>

      <?php
  } ?>

  </div>

<p class="cd_acr_instructions">Select which post types should be queried at this endpoint.</p>

</div>
