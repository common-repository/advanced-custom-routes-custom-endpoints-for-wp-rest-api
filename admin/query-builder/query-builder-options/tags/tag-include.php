<?php //TAGS INCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_tags_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_tags', true ) );


$tags = get_tags( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
    ?>

    <div class="cd_acr_field cd_acr_field--tags">
    <label for="tags[]">Tags Include</label>
        <select class="cd_acr_tags" name="tags[]" multiple="multiple">
        <?php
        foreach ( $tags as $tag) {
            if ( is_array( $cd_acr_tags_meta ) && in_array( $tag->term_id, $cd_acr_tags_meta ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = null;
            } ?>
            <option value="<?php echo $tag->term_id;?>" <?php echo $selected; ?>><?php echo $tag->name;?></option>

            <?php
     }

?>
        </select>

        <p class="cd_acr_instructions">Select which tags to include at this endpoint.</p>

    </div>
