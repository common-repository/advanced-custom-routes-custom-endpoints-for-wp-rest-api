<?php //CATEGORIES INCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_categories_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_categories', true ) );


$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
?>

    <div class="cd_acr_field cd_acr_field--category">
        <label for="categories_include[]">Categories Include</label>
        <select class="cd_acr_categories" id="categories_include[]" name="categories_include[]" multiple="multiple">
        <?php
        foreach ( $categories as $cat) {
            if ( is_array( $cd_acr_categories_meta ) && in_array( $cat->term_id, $cd_acr_categories_meta ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = null;
            } ?>
            <option value="<?php echo $cat->term_id;?>" <?php echo $selected; ?>><?php echo $cat->name;?></option>

            <?php
     }

?>
        </select>

        <p class="cd_acr_instructions">Select which categories to include at this endpoint.</p>

    </div>
