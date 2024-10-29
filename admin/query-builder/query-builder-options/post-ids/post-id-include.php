<?php //POST IDS INCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_post_ids_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_post_ids', true ) );

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


$args = array(
    'numberposts' => 99999,
    'post_type'   => $all_post_types
    );

    $post_includes = get_posts( $args );

    ?>

    <div class="cd_acr_field cd_acr_field--post-ids">
        <label for="post_includes[]">Post IDs Include</label>
        <select class="cd_acr_post_ids" name="post_includes[]" multiple="multiple">
        <?php
    foreach ( $post_includes as $post_include) {
        if ( is_array( $cd_acr_post_ids_meta ) && in_array( $post_include->ID, $cd_acr_post_ids_meta ) ) {
            $selected = 'selected="selected"';
        } else {
            $selected = null;
        } ?>
            <option value="<?php echo $post_include->ID;?>" <?php echo $selected; ?>><?php echo $post_include->post_title;?></option>

            <?php
        }

?>
        </select>

        <p class="cd_acr_instructions">Select which posts to include at this endpoint.</p>

    </div>
