<?php //OFFSET FIELD ?>
    <div class="cd_acr_field cd_acr_field--amount-offset">
        <label for="cd_acr_offset">Offset</label>
        <input id="cd_acr_offset"
            type="number"
            name="cd_acr_offset"
            placeholder="0"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cd_acr_offset', true ) ); ?>">

            <p class="cd_acr_instructions">Select how many posts to offset at this endpoint.</p>

    </div>
