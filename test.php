 <!-- <div class="ribbon">
    <div class="ribbon-content">
    <div class="title">Trusted by <span style ="color: #0066ff"> 100+ businesses.</span></div>
        <div class="logos">
            You can replace these with your logo images
            <img src="<?php echo get_template_directory_uri(); ?>/images/walmart.png" alt="Logo 1" class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/remote.png" alt="Logo 2" class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/disnep.svg" alt="Logo 3" class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gap.svg" alt="Logo 4" class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/goldman.svg" alt="Logo 5" class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/wb.svg" alt="Logo 6" class="logo">
        </div>
        
    </div>
</div> -->

<?php
// Register Custom Meta Boxes for Front Page Content
function custom_banner_meta_box() {
    // Check if the page uses the "Front Page" template
    $front_page_id = get_option( 'page_on_front' );// returns the ID of the page that's set as your static front page

    // Add meta box only if it's the front page
    if ( is_admin() && get_the_ID() == $front_page_id ) {
        add_meta_box(
            'banner_content',           // ID of the meta box
            'Banner Content',           // Title of the meta box
            'banner_meta_box_callback', // Callback function to display the content
            'page',                     // Display on 'page' post type
            'normal',                   // Position
            'default'                   // Priority
        );
    }
}

add_action( 'add_meta_boxes', 'custom_banner_meta_box' );

// Display fields in the meta box
function banner_meta_box_callback( $post ) {
    // Add a nonce field for security
    wp_nonce_field( 'banner_meta_box_nonce0', 'meta_box_nonce0' );

    // Get current meta values
    $styled_paragraph = get_post_meta( $post->ID, '_styled_paragraph', true );
    $main_text = get_post_meta( $post->ID, '_main_text', true );
    $third_banner_text = get_post_meta( $post->ID, '_third_banner_text', true );

    // Display fields for the content
    ?>
    <div>
        <label for="styled_paragraph">Styled Paragraph:</label>
        <textarea name="styled_paragraph" id="styled_paragraph" rows="4" style="width:100%;"><?php echo esc_textarea( $styled_paragraph ); ?></textarea>
    </div>
    <div style="margin-top: 20px;">
        <label for="main_text">Main Heading:</label>
        <input type="text" name="main_text" id="main_text" value="<?php echo esc_attr( $main_text ); ?>" style="width:100%;" />
    </div>
    <div style="margin-top: 20px;">
        <label for="third_banner_text">Third Banner Text:</label>
        <textarea name="third_banner_text" id="third_banner_text" rows="4" style="width:100%;"><?php echo esc_textarea( $third_banner_text ); ?></textarea>
    </div>
    <?php
}

// Save the custom meta data when the page is saved
function save_banner_meta_data( $post_id ) {
    // Verify nonce
    if ( ! isset( $_POST['meta_box_nonce0'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce0'], 'banner_meta_box_nonce0' ) ) {
        return;
    }
    // Avoid autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Save styled paragraph
    if ( isset( $_POST['styled_paragraph'] ) ) {
        update_post_meta( $post_id, '_styled_paragraph', sanitize_textarea_field( $_POST['styled_paragraph'] ) );
    }

    // Save main heading
    if ( isset( $_POST['main_text'] ) ) {
        update_post_meta( $post_id, '_main_text', sanitize_text_field( $_POST['main_text'] ) );
    }

    // Save third banner text
    if ( isset( $_POST['third_banner_text'] ) ) {
        update_post_meta( $post_id, '_third_banner_text', sanitize_textarea_field( $_POST['third_banner_text'] ) );
    }
}
add_action( 'save_post', 'save_banner_meta_data' );



// Add the meta box
function add_logos_meta_box() {
    $front_page_id = get_option( 'page_on_front' );// returns the ID of the page that's set as your static front page

    // Add meta box only if it's the front page
    if ( is_admin() && get_the_ID() == $front_page_id ) {
    add_meta_box(
        'logos_meta_box',          // Unique ID
        'Ribbon Logos',            // Box title
        'render_logos_meta_box',   // Content callback
        'page',                    // Post type
        'normal',                  // Context
        'default'                  // Priority
    );}
}
add_action('add_meta_boxes', 'add_logos_meta_box');

// Render the meta box content
function render_logos_meta_box($post) {
    // Retrieve existing logo URLs from post meta
    $logos = get_post_meta($post->ID, '_ribbon_logos', true);
    $logos = is_array($logos) ? $logos : array('');
    ?>
    <div id="logos-meta-box">
        <p>Enter the URLs of the logos you want to display in the ribbon section. <b>Add one URL per line.</b></p>
        <textarea name="ribbon_logos" rows="5" style="width:100%;"><?php echo esc_textarea(implode("\n", $logos)); ?></textarea>
    </div>
    <?php
}

// Save the meta box data
function save_logos_meta_box($post_id) {
    // Verify the nonce before proceeding
    // if (!isset($_POST['ribbon_logos_nonce']) || !wp_verify_nonce($_POST['ribbon_logos_nonce'], 'save_ribbon_logos')) {
    //     return;
    // }

    // Check if the current user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save or delete the logos
    if (isset($_POST['ribbon_logos'])) {
        $logos = array_filter(array_map('trim', explode("\n", $_POST['ribbon_logos'])));
        update_post_meta($post_id, '_ribbon_logos', $logos);
    } else {
        delete_post_meta($post_id, '_ribbon_logos');
    }
}
add_action('save_post', 'save_logos_meta_box');
?>