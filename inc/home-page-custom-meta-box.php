<?php

// Register Custom Meta Boxes for Front Page Content
function custom_banner_meta_box() {
    // Check if the page uses the "Front Page" template
    $front_page_id = get_option( 'page_on_front' ); // returns the ID of the page that's set as your static front page

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
    // Add a unique nonce for the Banner Meta Box
    wp_nonce_field( 'save_banner_meta', 'banner_meta_nonce' );

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
    // Verify nonce for Banner Meta Box
    if ( ! isset( $_POST['banner_meta_nonce'] ) || ! wp_verify_nonce( $_POST['banner_meta_nonce'], 'save_banner_meta' ) ) {
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

// Add the Ribbon Logos Meta Box
function add_logos_meta_box() {
    $front_page_id = get_option( 'page_on_front' ); // returns the ID of the page that's set as your static front page

    // Add meta box only if it's the front page
    if ( is_admin() && get_the_ID() == $front_page_id ) {
        add_meta_box(
            'logos_meta_box',          // Unique ID
            'Ribbon Logos',            // Box title
            'render_logos_meta_box',   // Content callback
            'page',                    // Post type
            'normal',                  // Context
            'default'                  // Priority
        );
    }
}
add_action('add_meta_boxes', 'add_logos_meta_box');

// Render the Ribbon Logos Meta Box content
function render_logos_meta_box($post) {
    // Add a unique nonce for Ribbon Logos Meta Box
    wp_nonce_field( 'save_ribbon_logos', 'ribbon_logos_nonce' );

    // Retrieve existing logo URLs from post meta
    $logos = get_post_meta($post->ID, '_ribbon_logos', true);
    $logos = is_array($logos) ? $logos : array('');
    ?>
    <div id="logos-meta-box">
        <p>Enter the URLs of the logos you want to display in the ribbon section. <b style = "color: red">Add one URL per line.</b></p>
        <textarea name="ribbon_logos" rows="5" style="width:100%;"><?php echo esc_textarea(implode("\n", $logos)); ?></textarea>
    </div>
    <?php
}

// Save Ribbon Logos Meta Box Data
function save_logos_meta_box($post_id) {
    // Verify nonce for Ribbon Logos Meta Box
    if ( ! isset( $_POST['ribbon_logos_nonce'] ) || ! wp_verify_nonce( $_POST['ribbon_logos_nonce'], 'save_ribbon_logos' ) ) {
        return;
    }

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





// Add About Us Meta Box on the Front Page
// Add Meta Box only for the Front Page
function custom_add_about_us_meta_box() {
    $front_page_id = get_option('page_on_front'); 

    if ( is_admin() && get_the_ID() == $front_page_id ) {
        add_meta_box(
            'custom_about_us_meta_box',          // Unique ID
            'About Us Section',                  // Box title
            'custom_render_about_us_meta_box',   // Callback
            'page',                              // Post type
            'normal',                            // Context
            'default'                            // Priority
        );
    }
}
add_action('add_meta_boxes', 'custom_add_about_us_meta_box');

// Render the Meta Box HTML
function custom_render_about_us_meta_box($post) {
    // Unique and descriptive nonce name
    wp_nonce_field('custom_about_us_nonce_action', 'custom_about_us_nonce');

    // Get current meta values
    $about_us_title       = get_post_meta($post->ID, '_about_us_title', true);
    $about_us_description = get_post_meta($post->ID, '_about_us_description', true);
    $about_us_image_url   = get_post_meta($post->ID, '_about_us_image_url', true);
    ?>
    <div>
        <label for="about_us_title"><strong>Title:</strong></label>
        <input type="text" name="about_us_title" id="about_us_title" value="<?php echo esc_attr($about_us_title); ?>" style="width:100%;" />
    </div>

    <div style="margin-top: 20px;">
        <label for="about_us_description"><strong>Main Description:</strong></label>
        <textarea name="about_us_description" id="about_us_description" rows="4" style="width:100%;"><?php echo esc_textarea($about_us_description); ?></textarea>
    </div>

    <div style="margin-top: 20px;">
        <label for="about_us_image_url"><strong>Image URL:</strong></label>
        <input type="text" name="about_us_image_url" id="about_us_image_url" value="<?php echo esc_url($about_us_image_url); ?>" style="width:100%;" />
        <?php if ($about_us_image_url): ?>
            <div style="margin-top:10px;">
                <img src="<?php echo esc_url($about_us_image_url); ?>" style="max-width:100%; height:auto;" />
            </div>
        <?php endif; ?>
    </div>
    <?php
}

// Save Meta Box Data
function custom_save_about_us_meta_data($post_id) {
    // Check nonce
    if (
        ! isset($_POST['custom_about_us_nonce']) ||
        ! wp_verify_nonce($_POST['custom_about_us_nonce'], 'custom_about_us_nonce_action')
    ) {
        return;
    }

    // Prevent autosave overwrite
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save fields
    if (isset($_POST['about_us_title'])) {
        update_post_meta($post_id, '_about_us_title', sanitize_text_field($_POST['about_us_title']));
    }

    if (isset($_POST['about_us_description'])) {
        update_post_meta($post_id, '_about_us_description', sanitize_textarea_field($_POST['about_us_description']));
    }

    if (isset($_POST['about_us_image_url'])) {
        update_post_meta($post_id, '_about_us_image_url', esc_url_raw($_POST['about_us_image_url']));
    }
}
add_action('save_post', 'custom_save_about_us_meta_data');


// <?php

// // Utility function to save meta fields
// function save_custom_meta_field($post_id, $field_name, $meta_key, $sanitize_callback) {
//     if (isset($_POST[$field_name])) {
//         update_post_meta($post_id, $meta_key, $sanitize_callback($_POST[$field_name]));
//     }
// }

// function is_front_page_edit($post) {
//     $front_page_id = get_option('page_on_front');
//     return isset($post) && $post->ID == $front_page_id;
// }

// // Register meta boxes
// function register_custom_meta_boxes() {
//     global $post;
//     if (!is_front_page_edit($post)) return;

//     add_meta_box('banner_content', 'Banner Content', 'banner_meta_box_callback', 'page', 'normal', 'default');
//     add_meta_box('logos_meta_box', 'Ribbon Logos', 'render_logos_meta_box', 'page', 'normal', 'default');
//     add_meta_box('custom_about_us_meta_box', 'About Us Section', 'custom_render_about_us_meta_box', 'page', 'normal', 'default');
// }
// add_action('add_meta_boxes', 'register_custom_meta_boxes');

// // Banner Content Meta Box
// function banner_meta_box_callback($post) {
//     wp_nonce_field('save_banner_meta', 'banner_meta_nonce');
//     $styled_paragraph = get_post_meta($post->ID, '_styled_paragraph', true);
//     $main_text = get_post_meta($post->ID, '_main_text', true);
//     $third_banner_text = get_post_meta($post->ID, '_third_banner_text', true);
//     ?>
//     <p><label>Styled Paragraph:</label><textarea name="styled_paragraph" rows="4" style="width:100%;"><?php echo esc_textarea($styled_paragraph); ?></textarea></p>
//     <p><label>Main Heading:</label><input type="text" name="main_text" value="<?php echo esc_attr($main_text); ?>" style="width:100%;"></p>
//     <p><label>Third Banner Text:</label><textarea name="third_banner_text" rows="4" style="width:100%;"><?php echo esc_textarea($third_banner_text); ?></textarea></p>
//     <?php
// }

// function save_banner_meta_data($post_id) {
//     if (!isset($_POST['banner_meta_nonce']) || !wp_verify_nonce($_POST['banner_meta_nonce'], 'save_banner_meta')) return;
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

//     save_custom_meta_field($post_id, 'styled_paragraph', '_styled_paragraph', 'sanitize_textarea_field');
//     save_custom_meta_field($post_id, 'main_text', '_main_text', 'sanitize_text_field');
//     save_custom_meta_field($post_id, 'third_banner_text', '_third_banner_text', 'sanitize_textarea_field');
// }
// add_action('save_post', 'save_banner_meta_data');

// // Ribbon Logos Meta Box
// function render_logos_meta_box($post) {
//     wp_nonce_field('save_ribbon_logos', 'ribbon_logos_nonce');
//     $logos = get_post_meta($post->ID, '_ribbon_logos', true);
//     $logos = is_array($logos) ? $logos : array('');
//     ?>
//     <p>Enter one logo URL per line:</p>
//     <textarea name="ribbon_logos" rows="5" style="width:100%;"><?php echo esc_textarea(implode("\n", $logos)); ?></textarea>
//     <?php
// }

// function save_logos_meta_box($post_id) {
//     if (!isset($_POST['ribbon_logos_nonce']) || !wp_verify_nonce($_POST['ribbon_logos_nonce'], 'save_ribbon_logos')) return;
//     if (!current_user_can('edit_post', $post_id)) return;

//     $logos = isset($_POST['ribbon_logos']) ? array_filter(array_map('trim', explode("\n", $_POST['ribbon_logos']))) : [];
//     update_post_meta($post_id, '_ribbon_logos', $logos);
// }
// add_action('save_post', 'save_logos_meta_box');

// // About Us Meta Box
// function custom_render_about_us_meta_box($post) {
//     wp_nonce_field('custom_about_us_nonce_action', 'custom_about_us_nonce');
//     $title = get_post_meta($post->ID, '_about_us_title', true);
//     $desc = get_post_meta($post->ID, '_about_us_description', true);
//     $image = get_post_meta($post->ID, '_about_us_image_url', true);
//     ?>
//     <p><label>Title:</label><input type="text" name="about_us_title" value="<?php echo esc_attr($title); ?>" style="width:100%;"></p>
//     <p><label>Main Description:</label><textarea name="about_us_description" rows="4" style="width:100%;"><?php echo esc_textarea($desc); ?></textarea></p>
//     <p><label>Image URL:</label><input type="text" name="about_us_image_url" value="<?php echo esc_url($image); ?>" style="width:100%;"></p>
//     <?php if ($image): ?><div><img src="<?php echo esc_url($image); ?>" style="max-width:100%; height:auto;"></div><?php endif; ?>
//     <?php
// }

// function custom_save_about_us_meta_data($post_id) {
//     if (!isset($_POST['custom_about_us_nonce']) || !wp_verify_nonce($_POST['custom_about_us_nonce'], 'custom_about_us_nonce_action')) return;
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

//     save_custom_meta_field($post_id, 'about_us_title', '_about_us_title', 'sanitize_text_field');
//     save_custom_meta_field($post_id, 'about_us_description', '_about_us_description', 'sanitize_textarea_field');
//     save_custom_meta_field($post_id, 'about_us_image_url', '_about_us_image_url', 'esc_url_raw');
// }
// add_action('save_post', 'custom_save_about_us_meta_data');
