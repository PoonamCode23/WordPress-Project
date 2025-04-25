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
            'side',                            // Context
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

/* Testimonials Section*/
function custom_add_testimonials_meta_box() {
    $front_page_id = get_option('page_on_front');

    if (is_admin() && (get_the_ID() == $front_page_id || get_the_ID() == 81)) {

        add_meta_box(
            'custom_testimonials_meta_box',
            'Edit Testimonials Section',
            'custom_render_testimonials_meta_box',
            'page',
            'normal',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'custom_add_testimonials_meta_box');

function custom_render_testimonials_meta_box($post) {
    wp_nonce_field('custom_testimonials_nonce_action', 'custom_testimonials_nonce');

    $testimonials = get_post_meta($post->ID, '_testimonials', true);
    if (!is_array($testimonials)) {
        $testimonials = [];
    }

    ?>
    <div id="testimonials-wrapper">
        <?php foreach ($testimonials as $index => $testimonial): ?>
            <div class="testimonial-group" style="margin-bottom:30px;padding:10px;border:1px solid #ccc;">
                <label>Title:</label>
                <input type="text" name="testimonials[<?php echo $index; ?>][title]" value="<?php echo esc_attr($testimonial['title']); ?>" style="width:100%;" />

                <label>Description:</label>
                <textarea name="testimonials[<?php echo $index; ?>][description]" style="width:100%;"><?php echo esc_textarea($testimonial['description']); ?></textarea>

                <label>Author Name:</label>
                <input type="text" name="testimonials[<?php echo $index; ?>][author_name]" value="<?php echo esc_attr($testimonial['author_name']); ?>" style="width:100%;" />

                <label>Author Title:</label>
                <input type="text" name="testimonials[<?php echo $index; ?>][author_title]" value="<?php echo esc_attr($testimonial['author_title']); ?>" style="width:100%;" />
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button" onclick="addTestimonial()">+ Add Testimonial</button>

    <script>
        function addTestimonial() {
            const container = document.getElementById('testimonials-wrapper');
            const index = container.children.length;

            const div = document.createElement('div');
            div.classList.add('testimonial-group');
            div.style.marginBottom = '30px';
            div.style.padding = '10px';
            div.style.border = '1px solid #ccc';
            div.innerHTML = `
                <label>Title:</label>
                <input type="text" name="testimonials[${index}][title]" style="width:100%;" />

                <label>Description:</label>
                <textarea name="testimonials[${index}][description]" style="width:100%;"></textarea>

                <label>Author Name:</label>
                <input type="text" name="testimonials[${index}][author_name]" style="width:100%;" />

                <label>Author Title:</label>
                <input type="text" name="testimonials[${index}][author_title]" style="width:100%;" />
            `;
            container.appendChild(div);
        }
    </script>
    <?php
}

function custom_save_testimonials_meta_data($post_id) {
    if (
        !isset($_POST['custom_testimonials_nonce']) ||
        !wp_verify_nonce($_POST['custom_testimonials_nonce'], 'custom_testimonials_nonce_action')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['testimonials']) && is_array($_POST['testimonials'])) {
        $sanitized_testimonials = [];

        foreach ($_POST['testimonials'] as $testimonial) {
            $sanitized_testimonials[] = [
                'title' => sanitize_text_field($testimonial['title']),
                'description' => sanitize_textarea_field($testimonial['description']),
                'author_name' => sanitize_text_field($testimonial['author_name']),
                'author_title' => sanitize_text_field($testimonial['author_title']),
            ];
        }

        update_post_meta($post_id, '_testimonials', $sanitized_testimonials);
    }
}
add_action('save_post', 'custom_save_testimonials_meta_data');


/*what we offer section meta */
function custom_add_offers_meta_box() {
    $front_page_id = get_option('page_on_front');

    if (is_admin() && get_the_ID() == $front_page_id) {
        add_meta_box(
            'custom_offers_meta_box',
            'Edit What We Offer Section',
            'custom_render_offers_meta_box',
            'page',
            'normal',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'custom_add_offers_meta_box');

function custom_render_offers_meta_box($post) {
    wp_nonce_field('custom_offers_nonce_action', 'custom_offers_nonce');

    $offers = get_post_meta($post->ID, '_offers', true);
    if (!is_array($offers)) {
        $offers = [];
    }
    ?>
    <div id="offers-wrapper">
        <?php foreach ($offers as $index => $offer): ?>
            <div class="offer-group" style="margin-bottom:30px;padding:10px;border:1px solid #ccc;">
                <label>Title:</label>
                <input type="text" name="offers[<?php echo $index; ?>][title]" value="<?php echo esc_attr($offer['title']); ?>" style="width:100%;" />

                <label>Description:</label>
                <textarea name="offers[<?php echo $index; ?>][description]" style="width:100%;"><?php echo esc_textarea($offer['description']); ?></textarea>

                <label>Image URL:</label>
                <input type="text" name="offers[<?php echo $index; ?>][image]" value="<?php echo esc_attr($offer['image']); ?>" style="width:100%;" />

            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button" onclick="addOffer()">+ Add Offer</button>

    <script>
        function addOffer() {
            const container = document.getElementById('offers-wrapper');
            const index = container.children.length;

            const div = document.createElement('div');
            div.classList.add('offer-group');
            div.style.marginBottom = '30px';
            div.style.padding = '10px';
            div.style.border = '1px solid #ccc';
            div.innerHTML = `
                <label>Title:</label>
                <input type="text" name="offers[${index}][title]" style="width:100%;" />

                <label>Description:</label>
                <textarea name="offers[${index}][description]" style="width:100%;"></textarea>

                <label>Image URL (relative to theme's images folder):</label>
                <input type="text" name="offers[${index}][image]" style="width:100%;" />

            `;
            container.appendChild(div);
        }
    </script>
    <?php
}
function custom_save_offers_meta_data($post_id) {
    if (
        !isset($_POST['custom_offers_nonce']) ||
        !wp_verify_nonce($_POST['custom_offers_nonce'], 'custom_offers_nonce_action')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['offers']) && is_array($_POST['offers'])) {
        $sanitized_offers = [];

        foreach ($_POST['offers'] as $offer) {
            $sanitized_offers[] = [
                'title' => sanitize_text_field($offer['title']),
                'description' => sanitize_textarea_field($offer['description']),
                'image' => sanitize_text_field($offer['image']),
            ];
        }

        update_post_meta($post_id, '_offers', $sanitized_offers);
    }
}
add_action('save_post', 'custom_save_offers_meta_data');


//add custom footer section
function custom_add_footer_meta_box() {
    $front_page_id = get_option('page_on_front');

    if (is_admin() && get_the_ID() == $front_page_id) {
        add_meta_box(
            'custom_footer_meta_box',
            'Edit Footer Section',
            'custom_render_footer_meta_box',
            'page',
            'side',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'custom_add_footer_meta_box');

// Render the Meta Box HTML
function custom_render_footer_meta_box($post) {
    wp_nonce_field('custom_footer_nonce_action', 'custom_footer_nonce');

    // get current meta value
    $footer_data = get_post_meta($post->ID, '_footer_data', true);
    $headline = $footer_data['headline'] ?? '';
    $paragraph = $footer_data['paragraph'] ?? '';
    $button_text = $footer_data['button_text'] ?? '';
    $button_link = $footer_data['button_link'] ?? '';
    $quick_links = $footer_data['quick_links'] ?? [];
    if (!is_array($quick_links)) $quick_links = [];
    ?>
    <label>Headline:</label>
    <input type="text" name="footer_data[headline]" value="<?php echo esc_attr($headline); ?>" style="width:100%;" />

    <label>Paragraph:</label>
    <textarea name="footer_data[paragraph]" style="width:100%;"><?php echo esc_textarea($paragraph); ?></textarea>

    <label>Button Text:</label>
    <input type="text" name="footer_data[button_text]" value="<?php echo esc_attr($button_text); ?>" style="width:100%;" />

    <label>Button Link:</label>
    <input type="text" name="footer_data[button_link]" value="<?php echo esc_url($button_link); ?>" style="width:100%;" />

    <h3>Quick Links</h3>
    <div id="quick-links-wrapper">
        <?php foreach ($quick_links as $index => $link): ?>
            <div style="margin-bottom:10px;">
                <label>Link Text:</label>
                <input type="text" name="footer_data[quick_links][<?php echo $index; ?>][text]" value="<?php echo esc_attr($link['text']); ?>" style="width:45%;" />
                <label>URL:</label>
                <input type="text" name="footer_data[quick_links][<?php echo $index; ?>][url]" value="<?php echo esc_url($link['url']); ?>" style="width:45%;" />
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" onclick="addQuickLink()">+ Add Quick Link</button>

    <script>
    function addQuickLink() {
        const container = document.getElementById('quick-links-wrapper');
        const index = container.children.length;

        const div = document.createElement('div');
        div.style.marginBottom = '10px';
        div.innerHTML = `
            <label>Link Text:</label>
            <input type="text" name="footer_data[quick_links][${index}][text]" style="width:45%;" />
            <label>URL:</label>
            <input type="text" name="footer_data[quick_links][${index}][url]" style="width:45%;" />
        `;
        container.appendChild(div);
    }
    </script>
    <?php
}