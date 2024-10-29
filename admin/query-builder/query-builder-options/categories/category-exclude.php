<?php //CATEGORIES EXCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_categories_exclude_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_categories_exclude', true ) );


$categories_exclude = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
?>

    <div class="cd_acr_field cd_acr_field--category">
        <label for="categories_exclude[]">Categories Exclude</label>
        <select class="cd_acr_categories_exclude" id="categories_exclude[]" name="categories_exclude[]" multiple="multiple">
        <?php
        foreach ( $categories_exclude as $cat_exclude) {
            if ( is_array( $cd_acr_categories_exclude_meta ) && in_array( $cat_exclude->term_id, $cd_acr_categories_exclude_meta ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = null;
            } ?>
            <option value="<?php echo $cat_exclude->term_id;?>" <?php echo $selected; ?>><?php echo $cat_exclude->name;?></option>

            <?php
     }

?>
        </select>

        <p class="cd_acr_instructions">Select which categories to exclude at this endpoint.</p>

    </div>
