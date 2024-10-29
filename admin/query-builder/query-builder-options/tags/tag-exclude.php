<?php //TAGS EXCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_tags_exclude_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_tags_exclude', true ) );


$tags_exclude = get_tags( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
    ?>

    <div class="cd_acr_field cd_acr_field--tags">
        <label for="tags_exclude[]">Tags Exclude</label>
        <select class="cd_acr_tags_exclude" name="tags_exclude[]" multiple="multiple">
        <?php
        foreach ( $tags_exclude as $tag_exclude) {
            if ( is_array( $cd_acr_tags_exclude_meta ) && in_array( $tag_exclude->term_id, $cd_acr_tags_exclude_meta ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = null;
            } ?>
            <option value="<?php echo $tag_exclude->term_id;?>" <?php echo $selected; ?>><?php echo $tag_exclude->name;?></option>

            <?php
     }

?>
        </select>

        <p class="cd_acr_instructions">Select which tags to exclude at this endpoint.</p>


    </div>
