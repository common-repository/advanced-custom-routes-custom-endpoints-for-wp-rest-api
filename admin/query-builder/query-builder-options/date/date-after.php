<?php //DATE AFTER FIELD ?>
        <div class="cd_acr_field cd_acr_field--date">
            <label for="cd_acr_date_after">Date - After</label>
            <input id="cd_acr_date_after"
                class="cd_acr_date_after"
                type="date"
                name="cd_acr_date_after"
                value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cd_acr_date_after', true ) ); ?>">

          <p class="cd_acr_instructions">Select a date for this endpoint that will query posts that were published AFTER the specified date.</p>


        </div>
