<?php //AUTHOR INCLUDE - FIELD ?>

<?php
// How to use 'get_post_meta()' for multiple checkboxes as array?
$cd_acr_authors_meta = maybe_unserialize( get_post_meta( $post->ID, 'cd_acr_authors', true ) );


$authors = get_users();

    ?>

    <div class="cd_acr_field cd_acr_field--author">
        <label for="authors[]">Authors Include</label>
        <select class="cd_acr_authors" id="authors[]" name="authors[]" multiple="multiple">
        <?php
        foreach ( $authors as $author) {
            if ( is_array( $cd_acr_authors_meta ) && in_array( $author->ID, $cd_acr_authors_meta ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = null;
            } ?>
            <option value="<?php echo $author->ID;?>" <?php echo $selected; ?>><?php echo $author->user_nicename;?></option>

            <?php
     }

?>
        </select>

        <p class="cd_acr_instructions">Select which authors to include at this endpoint.</p>

    </div>
