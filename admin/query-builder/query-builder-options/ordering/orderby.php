<?php //ORDERBY FIELD ?>
    <div class="cd_acr_field cd_acr_field--ordering">
    	<label for="cd_acr_orderby">Orderby</label>
    	<select name="cd_acr_orderby" id="cd_acr_orderby">
        <option value="" disabled <?php selected( get_post_meta( get_the_ID(), 'cd_acr_orderby', true ), '' ); ?>>Select Orderby</option>
        <option value="ID" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_orderby', true ), 'ID' ); ?>>ID</option>
        <option value="title" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_orderby', true ), 'title' ); ?>>Post Title</option>
        <option value="date" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_orderby', true ), 'date' ); ?>>Post Date</option>
        <option value="author" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_orderby', true ), 'author' ); ?>>Post Author</option>
        <option value="parent" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_orderby', true ), 'parent' ); ?>>Post Parent</option>
        <option value="rand" <?php selected( get_post_meta( get_the_ID(), 'cd_acr_orderby', true ), 'rand' ); ?>>Random</option>
    	</select>

      <p class="cd_acr_instructions">Select what to order posts by at this endpoint.</p>

    </div>
