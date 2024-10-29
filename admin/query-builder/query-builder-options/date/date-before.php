<?php //DATE BEFORE FIELD ?>
        <div class="cd_acr_field cd_acr_field--date">
            <label for="cd_acr_date_before">Date - Before</label>
            <input id="cd_acr_date_before"
                class="cd_acr_date_before"
                type="date"
                name="cd_acr_date_before"
                value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cd_acr_date_before', true ) ); ?>">

                <p class="cd_acr_instructions">Select a date for this endpoint that will query posts that were published BEFORE the specified date.</p>

        </div>
