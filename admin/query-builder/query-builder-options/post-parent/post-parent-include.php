<?php //POST PARENT INCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_post_parents_include_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_post_parent_include', true ) );


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

    $post_parent_includes = get_posts( $args );

    ?>

    <div class="cd_acr_field cd_acr_field--post-parent">
    <label for="post_parent_includes[]">Post Parent Include</label>
        <select class="cd_acr_post_parent_include" name="post_parent_includes[]" multiple="multiple">
        <?php
    foreach ( $post_parent_includes as $post_parent_include) {
        if ( is_array( $cd_acr_post_parents_include_meta ) && in_array( $post_parent_include->ID, $cd_acr_post_parents_include_meta ) ) {
            $selected = 'selected="selected"';
        } else {
            $selected = null;
        } ?>
            <option value="<?php echo $post_parent_include->ID;?>" <?php echo $selected; ?>><?php echo $post_parent_include->post_title;?></option>

            <?php
        }

?>
        </select>

        <p class="cd_acr_instructions">Select which post parents to include at this endpoint.</p>


    </div>
