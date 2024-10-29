<?php

//Creating Query Builder Options - Meta box
function cd_acr_add_query_builder_options_meta_box() {
    add_meta_box(
        'cd_acr_query_builder_options', // $id
        'Query Builder Options', // $title
        'cd_acr_show_query_builder_options_meta_box', // $callback
        'cd-custom-rest-api', // $screen
        'normal', // $context
        'high' // $priority
    );
}

add_action( 'add_meta_boxes', 'cd_acr_add_query_builder_options_meta_box' );

//Show Query Builder Options - Custom Fields
function cd_acr_show_query_builder_options_meta_box( $post ) { ?>

<div class="cd_acr_query_builder_options_container">

    <div class="cd_acr_query_builder_options_headings">

        <div class="cd_acr_heading cd_acr_heading--post-type cd_acr_heading--active">Post Type</div>

        <div class="cd_acr_heading cd_acr_heading--post-id">Post ID</div>

        <div class="cd_acr_heading cd_acr_heading--category">Category</div>

        <div class="cd_acr_heading cd_acr_heading--tag">Tag</div>

        <div class="cd_acr_heading cd_acr_heading--author">Author</div>

        <div class="cd_acr_heading cd_acr_heading--date">Date</div>

        <div class="cd_acr_heading cd_acr_heading--post-parent">Post Parent</div>

        <div class="cd_acr_heading cd_acr_heading--amount-offset">Amount & Offset</div>

        <div class="cd_acr_heading cd_acr_heading--ordering">Ordering</div>

        <div class="cd_acr_heading cd_acr_heading--status">Status</div>

    </div>

    <div class="cd_acr_query_builder_options_fields">

        <input type="hidden" name="cd_acr_query_builder_options_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

        <!--POST TYPES-->
        <?php include('query-builder-options/post-types/post-type.php'); ?>

        <!--POST IDS INCLUDE-->
        <?php include('query-builder-options/post-ids/post-id-include.php'); ?>

        <!--POST IDS EXCLUDE-->
        <?php include('query-builder-options/post-ids/post-id-exclude.php'); ?>

        <!--CATEGORIES INCLUDE-->
        <?php include('query-builder-options/categories/category-include.php'); ?>

        <!--CATEGORIES EXCLUDE-->
        <?php include('query-builder-options/categories/category-exclude.php'); ?>

        <!--TAGS INCLUDE-->
        <?php include('query-builder-options/tags/tag-include.php'); ?>

        <!--TAGS EXCLUDE-->
        <?php include('query-builder-options/tags/tag-exclude.php'); ?>

        <!--AUTHORS INCLUDE-->
        <?php include('query-builder-options/authors/author-include.php'); ?>

        <!--AUTHORS EXCLUDE-->
        <?php include('query-builder-options/authors/author-exclude.php'); ?>

        <!--DATE BEFORE-->
        <?php include('query-builder-options/date/date-before.php'); ?>

        <!--DATE AFTER-->
        <?php include('query-builder-options/date/date-after.php'); ?>

        <!--AMOUNT-->
        <?php include('query-builder-options/amount-offset/amount.php'); ?>

        <!--OFFSET-->
        <?php include('query-builder-options/amount-offset/offset.php'); ?>

        <!--ORDERBY-->
        <?php include('query-builder-options/ordering/orderby.php'); ?>

        <!--ORDER-->
        <?php include('query-builder-options/ordering/order.php'); ?>

        <!--STATUS-->
        <?php include('query-builder-options/status/status.php'); ?>

        <!--POST PARENT INCLUDE-->
        <?php include('query-builder-options/post-parent/post-parent-include.php'); ?>

        <!--POST PARENT EXCLUDE-->
        <?php include('query-builder-options/post-parent/post-parent-exclude.php'); ?>

    </div>

</div>



 <?php };



 function cd_acr_save_query_builder_options_fields( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }


    //BEGINNING POST TYPES CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['post_types'] ) ) {

        // $postTypes = implode(",", $_POST['post_types'])
        //
        // var_dump($postTypes);

        update_post_meta( $post_id, 'cd_acr_post_types', $_POST['post_types']);
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_post_types' );
    }
    //END POST TYPES CHECK


    //BEGINNING POST IDS CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['post_includes'] ) ) {
        update_post_meta( $post_id, 'cd_acr_post_ids', $_POST['post_includes'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_post_ids' );
    }
    //END POST IDS CHECK


    //BEGINNING POST IDS EXCLUDE CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['post_excludes'] ) ) {
        update_post_meta( $post_id, 'cd_acr_post_ids_exclude', $_POST['post_excludes'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_post_ids_exclude' );
    }
    //END POST IDS EXCLUDE CHECK


    //BEGINNING CATEGORIES CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['categories_include'] ) ) {
        update_post_meta( $post_id, 'cd_acr_categories', $_POST['categories_include'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_categories' );
    }
    //END CATEGORIES CHECK


    //BEGINNING CATEGORIES EXCLUDE CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['categories_exclude'] ) ) {
        update_post_meta( $post_id, 'cd_acr_categories_exclude', $_POST['categories_exclude'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_categories_exclude' );
    }
    //END CATEGORIES EXCLUDE CHECK


    //BEGINNING TAGS CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['tags'] ) ) {
        update_post_meta( $post_id, 'cd_acr_tags', $_POST['tags'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_tags' );
    }
    //END TAGS CHECK


    //BEGINNING TAGS EXCLUDE CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['tags_exclude'] ) ) {
        update_post_meta( $post_id, 'cd_acr_tags_exclude', $_POST['tags_exclude'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_tags_exclude' );
    }
    //END TAGS EXCLUDE CHECK


    //BEGINNING AUTHORS CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['authors'] ) ) {
        update_post_meta( $post_id, 'cd_acr_authors', $_POST['authors'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_authors' );
    }
    //END AUTHORS CHECK

    //BEGINNING AUTHORS EXCLUDE CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['authors_exclude'] ) ) {
        update_post_meta( $post_id, 'cd_acr_authors_exclude', $_POST['authors_exclude'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_authors_exclude' );
    }
    //END AUTHORS EXCLUDE CHECK



    //BEGINNING STATUS CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['statuses'] ) ) {
        update_post_meta( $post_id, 'cd_acr_status', $_POST['statuses'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_status' );
    }
    //END STATUS CHECK


    //BEGINNING POST PARENT EXCLUDE CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['post_parent_excludes'] ) ) {
        update_post_meta( $post_id, 'cd_acr_post_parent_exclude', $_POST['post_parent_excludes'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_post_parent_exclude' );
    }
    //END POST PARENT EXCLUDE CHECK


    //BEGINNING POST PARENT INCLUDE CHECK
    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['post_parent_includes'] ) ) {
        update_post_meta( $post_id, 'cd_acr_post_parent_include', $_POST['post_parent_includes'] );
    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'cd_acr_post_parent_include' );
    }
    //END POST PARENT INCLUDE CHECK


    $fields = [
        'cd_acr_amount',
        'cd_acr_offset',
        'cd_acr_orderby',
        'cd_acr_order',
        'cd_acr_post_types',
        'cd_acr_post_ids',
        'cd_acr_post_ids_exclude',
        'cd_acr_categories',
        'cd_acr_categories_exclude',
        'cd_acr_tags',
        'cd_acr_tags_exclude',
        'cd_acr_authors',
        'cd_acr_authors_exclude',
        'cd_acr_date_before',
        'cd_acr_date_after',
        'cd_acr_status',
        'cd_acr_post_parent_exclude',
        'cd_acr_post_parent_include',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'cd_acr_save_query_builder_options_fields' );


 ?>
