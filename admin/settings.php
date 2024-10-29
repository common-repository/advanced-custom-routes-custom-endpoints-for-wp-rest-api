<?php


add_action("admin_menu", "cd_acr_add_menu");


function cd_acr_add_menu() {
  add_menu_page( 'Custom Routes', 'Custom Routes', 'manage_options', 'edit.php?post_type=cd-custom-rest-api', '', 'dashicons-rest-api', 90 );

  add_submenu_page(
      'edit.php?post_type=cd-custom-rest-api',
      'Settings',
      'Settings',
      'manage_options',
      'wp-rest-endpoints-settings',
      'cd_acr_settings'
  );
}




//register settings
add_action( 'admin_init', 'cd_acr_register_settings' );
function cd_acr_register_settings() {
    //register our settings
    register_setting( 'cd_acr_settings_group', 'cd_acr_custom_field_type' );
}

function cd_acr_settings() { ?>


  <h1 class="er_title">Advanced Custom Routes - Settings</h1>

  <section class="er_container">

    <form method="post" action="options.php" class="EPT__form">
      <?php settings_fields( 'cd_acr_settings_group' ); ?>
      <?php do_settings_sections( 'cd_acr_settings_group' ); ?>

      <div class="er_field">
        <label for="er_customFieldPlugin" class="h3">Custom Field Plugin/Library</label>
        <select id="er_customFieldPlugin" name="cd_acr_custom_field_type" value="<?php echo get_option( 'cd_acr_custom_field_type' ); ?>">
          <?php if(get_option( 'cd_acr_custom_field_type' ) == ''){ ?>
            <option selected value="">Select a Custom Field Plugin/Library</option>
            <option value="custom_built">Custom Built (No Plugin)</option>
            <option value="acf">Advanced Custom Fields</option>
            <option value="metabox_io">Metabox.io</option>
            <option value="carbon_fields">Carbon Fields</option>
          <?php }elseif(get_option( 'cd_acr_custom_field_type' ) == 'custom_built'){ ?>
            <option value="">Select a Custom Field Plugin/Library</option>
            <option selected value="custom_built">Custom Built (No Plugin)</option>
            <option value="acf">Advanced Custom Fields</option>
            <option value="metabox_io">Metabox.io</option>
            <option value="carbon_fields">Carbon Fields</option>
          <?php }elseif(get_option( 'cd_acr_custom_field_type' ) == 'acf'){ ?>
            <option value="">Select a Custom Field Plugin/Library</option>
            <option value="custom_built">Custom Built (No Plugin)</option>
            <option selected value="acf">Advanced Custom Fields</option>
            <option value="metabox_io">Metabox.io</option>
            <option value="carbon_fields">Carbon Fields</option>
          <?php }elseif(get_option( 'cd_acr_custom_field_type' ) == 'metabox_io'){ ?>
            <option value="">Select a Custom Field Plugin/Library</option>
            <option value="custom_built">Custom Built (No Plugin)</option>
            <option value="acf">Advanced Custom Fields</option>
            <option selected value="metabox_io">Metabox.io</option>
            <option value="carbon_fields">Carbon Fields</option>
          <?php }elseif(get_option( 'cd_acr_custom_field_type' ) == 'carbon_fields'){ ?>
            <option value="">Select a Custom Field Plugin/Library</option>
            <option value="custom_built">Custom Built (No Plugin)</option>
            <option value="acf">Advanced Custom Fields</option>
            <option value="metabox_io">Metabox.io</option>
            <option selected value="carbon_fields">Carbon Fields</option>
          <?php }else{ ?>
            <option selected value="">Select a Custom Field Plugin/Library</option>
            <option value="custom_built">Custom Built (No Plugin)</option>
            <option value="acf">Advanced Custom Fields</option>
            <option value="metabox_io">Metabox.io</option>
            <option value="carbon_fields">Carbon Fields</option>
          <?php } ?>

        </select>

      </div>


      <?php submit_button(); ?>

    </form>


  </section>


<?php } ?>
