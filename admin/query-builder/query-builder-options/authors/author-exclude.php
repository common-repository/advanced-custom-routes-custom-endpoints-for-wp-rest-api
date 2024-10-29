<?php //author_exclude EXCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_authors_exclude_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_authors_exclude', true ) );


$authors_exclude = get_users();

    ?>

    <div class="cd_acr_field cd_acr_field--author">
        <label for="authors_exclude[]">Authors Exclude</label>
        <select class="cd_acr_authors_exclude" id="authors_exclude[]" name="authors_exclude[]" multiple="multiple">
        <?php
        foreach ( $authors_exclude as $author_exclude) {
            if ( is_array( $cd_acr_authors_exclude_meta ) && in_array( $author_exclude->ID, $cd_acr_authors_exclude_meta ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = null;
            } ?>
            <option value="<?php echo $author_exclude->ID;?>" <?php echo $selected; ?>><?php echo $author_exclude->user_nicename;?></option>

            <?php
     }

?>
        </select>

        <p class="cd_acr_instructions">Select which authors to exclude at this endpoint.</p>


    </div>
