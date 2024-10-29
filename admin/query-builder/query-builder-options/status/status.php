<?php //STATUS

// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_status_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_status', true ) );

// Our associative array here. id = value
$statuses = array(
  'publish' => 'Published',
  'pending' => 'Pending',
  'draft' => 'Draft',
  'auto-draft' => 'Auto Draft',
  'future' => 'Future',
  'private' => 'Private',
  'inherit' => 'Inherit',
  'trash' => 'Trash',
); ?>

<div class="cd_acr_field cd_acr_field--status">
  <div class="cd_acr_checkboxes">

  <?php
  $i = 0;
  // Loop through array and make a checkbox for each element
  foreach ( $statuses as $id => $status) {

      // If the postmeta for checkboxes exist and
      // this element is part of saved meta check it.
      if ( is_array( $cd_acr_status_meta ) && in_array( $id, $cd_acr_status_meta ) ) {
          $checked = 'checked="checked"';
      } else {
          $checked = null;
      }

      $i++;

      ?>

      <div>
          <label for="cd_acr_status<?php echo $i; ?>">
            <input  type="checkbox" name="statuses[]" id="cd_acr_status<?php echo $i; ?>" value="<?php echo $id;?>" <?php echo $checked; ?> />
            <?php echo $status;?>
          </label>
      </div>

      <?php
  }

  ?>

  </div>

  <p class="cd_acr_instructions">Select which status types to query at this endpoint.</p>


</div>
