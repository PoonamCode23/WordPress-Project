<?php
function handle_custom_contact_form() {
    if (isset($_POST['custom_contact_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize
        $first_name     = sanitize_text_field($_POST['first_name']);
        $last_name      = sanitize_text_field($_POST['last_name']);
        $email          = sanitize_email($_POST['email']);
        $contact_number = sanitize_text_field($_POST['contact_number']);
        $enquiry_type   = sanitize_text_field($_POST['enquiry_type']);
        $subject        = sanitize_text_field($_POST['subject']);
        $enquiry        = sanitize_textarea_field($_POST['enquiry']);

        // Validation
        $errors = [];
        if (empty($first_name) || !preg_match("/^[a-zA-Z ]+$/", $first_name)) {
            $errors[] = "First name should contain only letters and spaces.";
        }
        if (empty($last_name) || !preg_match("/^[a-zA-Z ]+$/", $last_name)) {
            $errors[] = "Last name should contain only letters and spaces.";
        }
        if (empty($email) || !is_email($email)) {
            $errors[] = "Please enter a valid email address.";
        }
        if (!preg_match("/^\d{10}$/", $contact_number)) {
            $errors[] = "Contact number must be exactly 10 digits with no letters or symbols.";
        }
        
        if (empty($enquiry)) {
            $errors[] = "Enquiry message is required.";
        }

        // Handle errors
        if (!empty($errors)) {
            set_transient('contact_form_errors', $errors, 30); // store errors for 30 seconds
            wp_redirect(add_query_arg('feedback', 'error', $_SERVER['REQUEST_URI'] . '#contact-form'));
            exit;
        }
        

        // Save to custom post type
        $post_id = wp_insert_post([
            'post_type'   => 'contact_submission',
            'post_title'  => $subject ?: 'Contact Submission',
            'post_status' => 'publish',
            'meta_input'  => [
                'first_name'     => $first_name,
                'last_name'      => $last_name,
                'email'          => $email,
                'contact_number' => $contact_number,
                'enquiry_type'   => $enquiry_type,
                'enquiry'        => $enquiry,
            ]
        ]);

        // Redirect with success or error
        if ($post_id) {
            wp_redirect(add_query_arg('feedback', 'success', $_SERVER['REQUEST_URI'] . '#contact-form'));
            exit;
        } else {
            wp_redirect(add_query_arg('feedback', 'error', $_SERVER['REQUEST_URI'] . '#contact-form'));
            exit;
        }
    }
}
add_action('wp', 'handle_custom_contact_form');


// Register custom post type
function register_contact_submission_post_type() {
    register_post_type('contact_submission', [
        'labels' => [
            'name'          => 'Contact Submissions',
            'singular_name' => 'Contact Submission',
        ],
        'public'       => false,
        'show_ui'      => true,
        'supports'     => ['title'],
        'menu_icon'    => 'dashicons-email-alt',
    ]);
}
add_action('init', 'register_contact_submission_post_type');

// Register meta fields
function register_meta_fields() {
    register_meta('post', 'first_name', ['type' => 'string', 'show_in_rest' => true, 'single' => true]);
    register_meta('post', 'last_name', ['type' => 'string', 'show_in_rest' => true, 'single' => true]);
    register_meta('post', 'email', ['type' => 'string', 'show_in_rest' => true, 'single' => true]);
    register_meta('post', 'contact_number', ['type' => 'string', 'show_in_rest' => true, 'single' => true]);
    register_meta('post', 'enquiry_type', ['type' => 'string', 'show_in_rest' => true, 'single' => true]);
    register_meta('post', 'enquiry', ['type' => 'string', 'show_in_rest' => true, 'single' => true]);
}
add_action('init', 'register_meta_fields');

// Add columns to display meta fields in admin panel
function contact_submission_columns($columns) {
  $columns['first_name'] = 'First Name';
  $columns['last_name']  = 'Last Name';
  $columns['email']      = 'Email';
  $columns['contact_number'] = 'Contact Number';
  $columns['enquiry_type'] = 'What is your enquiry related to?';
  $columns['enquiry']    = 'Enquiry';
    return $columns;
}
add_filter('manage_contact_submission_posts_columns', 'contact_submission_columns');

// Populate columns with meta field data
function contact_submission_custom_column($column, $post_id) {
    switch ($column) {
      case 'first_name':
        echo get_post_meta($post_id, 'first_name', true);
        break;
      case 'last_name':
          echo get_post_meta($post_id, 'last_name', true);
          break;
      case 'email':
          echo get_post_meta($post_id, 'email', true);
          break;
      case 'enquiry':
          echo get_post_meta($post_id, 'enquiry', true);
          break;
      case 'contact_number':
          echo get_post_meta($post_id, 'contact_number', true);
          break;
      case 'enquiry_type':
          echo get_post_meta($post_id, 'enquiry_type', true);
          break;
    
    }
}
add_action('manage_contact_submission_posts_custom_column', 'contact_submission_custom_column', 10, 2);
