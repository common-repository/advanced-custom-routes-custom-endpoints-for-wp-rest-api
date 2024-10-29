<?php //ORDER FIELD ?>
    <div class="cd_acr_field cd_acr_field--ordering">
    	<label for="cd_acr_order">Order</label>
    	<select name="cd_acr_order" id="cd_acr_order">
          <option value="" disabled <?php selected( get_post_meta( get_the_ID(), 'cd_acr_order', true ), '' ); ?>>Select Order</option>
          <option value="desc" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_order', true ), 'desc' ); ?>>DESC</option>
    			<option value="asc" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_order', true ), 'asc' ); ?>>ASC</option>
    	</select>


      <p class="cd_acr_instructions">Select how to order posts at this endpoint.</p>

    </div>
