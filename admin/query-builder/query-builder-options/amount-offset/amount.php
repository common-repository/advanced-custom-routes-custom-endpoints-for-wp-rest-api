<?php //AMOUNT FIELD ?>
    <div class="cd_acr_field cd_acr_field--amount-offset">
        <label for="cd_acr_amount">Amount</label>
        <input id="cd_acr_amount"
            type="number"
            name="cd_acr_amount"
            placeholder="10"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cd_acr_amount', true ) ); ?>">

            <p class="cd_acr_instructions">Select how many posts to query at this endpoint.</p>

    </div>
