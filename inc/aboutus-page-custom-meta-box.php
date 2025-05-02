<?php
// Define the page IDs where the custom stats meta box should appear and be saved
define('CUSTOM_STATS_PAGE_IDS', [78, 81]);

// Add meta box for pages 78 and 81
function custom_stats_meta_box() {
    if (!isset($_GET['post']) || !in_array(intval($_GET['post']), CUSTOM_STATS_PAGE_IDS)) {
        return;
    }

    add_meta_box(
        // ID of your meta box. It's just a unique name to identify it. You’ll use this ID later when saving or retrieving data.
        'custom_stats_meta_box', 
        //title that will appear at the top of the box in the WordPress admin
        'Statistics and Features Section',
        // the function that will output the content inside the box (e.g., text fields, image inputs, etc.). You’ll define this function elsewhere in your code.
        'render_custom_stats_meta_box',
        'page',
        'normal',
        'default'//if high shows up in the screen.
    );
}
add_action('add_meta_boxes', 'custom_stats_meta_box');

//displaying the custom fields in the WordPress admin
//The $post parameter is automatically passed in and contains info about the page/post being edited.
function render_custom_stats_meta_box($post) {
    //Exit early if not page 78
  
    // verify the form submission is comming from wordpress dashboard only
    //'custom_stats_nonce_action' is a unique string used to verify the request.

//'custom_stats_nonce' is the name of the hidden field added to the form.

    wp_nonce_field('custom_stats_nonce_action', 'custom_stats_nonce');
    //Define all meta fields with optional default values

    // php associative array
    $fields = [
        'clients' => '1,000+',
        'hours' => '10,000+',
        'eco' => '100%',
        'availability' => '24hr',
        'intro_title' => '',
        'intro_text' => '',
        'feature1_title' => '',
        'feature1_desc' => '',
        'feature2_title' => '',
        'feature2_desc' => '',
        'feature3_title' => '',
        'feature3_desc' => '',
    ];

    //// Retrieve saved values or default
    foreach ($fields as $field => $default) {
        $$field = get_post_meta($post->ID, "_custom_stats_{$field}", true) ?: $default;
    }

    // alternatively:
    // $field_values = [];

    // foreach ($fields as $field => $default) {
    //     $value = get_post_meta($post->ID, "_custom_stats_{$field}", true);
    //     $field_values[$field] = $value ?: $default;
    // }


    ?>
   <div style="display: grid; grid-gap: 30px;">

            <!-- Stats Section -->
            <div>
                <h3>Stats</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <?php foreach (['clients' => 'Satisfied Clients', 'hours' => 'Hours of Cleaning', 'eco' => 'Eco-Friendly Products', 'availability' => 'Availability'] as $key => $label): ?>
                        <div>
                            <label><strong><?php echo $label; ?>:</strong></label>
                            <input type="text" name="custom_stats_<?php echo $key; ?>" value="<?php echo esc_attr($$key); ?>" style="width:100%;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Intro Section -->
            <div>
                <h3>Intro Section</h3>
                <div style="margin-bottom: 15px;">
                    <label><strong>Title:</strong></label>
                    <input type="text" name="custom_stats_intro_title" value="<?php echo esc_attr($intro_title); ?>" style="width:100%;">
                </div>
                <div>
                    <label><strong>Description:</strong></label>
                    <textarea name="custom_stats_intro_text" rows="3" style="width:100%;"><?php echo esc_textarea($intro_text); ?></textarea>
                </div>
            </div>

            <!-- Feature Bottom Section -->
            <div>
                <h3>Feature Bottom</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <div>
                            <label><strong>Feature <?php echo $i; ?> Title:</strong></label>
                            <input type="text" name="custom_stats_feature<?php echo $i; ?>_title" value="<?php echo esc_attr(${"feature{$i}_title"}); ?>" style="width:100%;">
                            <label style="margin-top:10px;"><strong>Feature <?php echo $i; ?> Description:</strong></label>
                            <textarea name="custom_stats_feature<?php echo $i; ?>_desc" rows="2" style="width:100%;"><?php echo esc_textarea(${"feature{$i}_desc"}); ?></textarea>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            </div>

    <?php
}
function save_custom_stats_meta_box($post_id) {
    // Check nonce
    if (
        !isset($_POST['custom_stats_nonce']) ||
        !wp_verify_nonce($_POST['custom_stats_nonce'], 'custom_stats_nonce_action')
    ) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (get_post_type($post_id) !== 'page' || !in_array($post_id, CUSTOM_STATS_PAGE_IDS)) {
        return;
    }
    

    // List of all fields to save
    $fields = [
        'clients', 'hours', 'eco', 'availability',
        'intro_title', 'intro_text',
        'feature1_title', 'feature1_desc',
        'feature2_title', 'feature2_desc',
        'feature3_title', 'feature3_desc',
    ];

    foreach ($fields as $field) {
        if (isset($_POST["custom_stats_$field"])) {
            $value = sanitize_text_field($_POST["custom_stats_$field"]);
            update_post_meta($post_id, "_custom_stats_$field", $value);
        }
    }
}
add_action('save_post', 'save_custom_stats_meta_box');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function kris_li_add_mission_section_meta_box() {
    if (!isset($_GET['post']) || $_GET['post'] != 78) return;

    add_meta_box(
        'kris_li_mission_meta_box',
        'Kris & Li Mission Section',
        'kris_li_render_mission_meta_box',
        'page',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'kris_li_add_mission_section_meta_box');

function kris_li_render_mission_meta_box($post) {
    wp_nonce_field('kris_li_mission_nonce_action', 'kris_li_mission_nonce');

    // Retrieve saved values
    $mission_title = get_post_meta($post->ID, '_kris_li_mission_title', true);
    $mission_paragraph = get_post_meta($post->ID, '_kris_li_mission_paragraph', true);
    $mission_image = get_post_meta($post->ID, '_kris_li_mission_image', true);
    $mission_points = get_post_meta($post->ID, '_kris_li_mission_points', true); // This will be an array

    ?>
    <div>
        <label><strong>Title:</strong></label>
        <input type="text" name="kris_li_mission_title" value="<?php echo esc_attr($mission_title); ?>" style="width:100%;" />
    </div>
    <div style="margin-top:15px;">
        <label><strong>Paragraph:</strong></label>
        <textarea name="kris_li_mission_paragraph" rows="4" style="width:100%;"><?php echo esc_textarea($mission_paragraph); ?></textarea>
    </div>
    <div style="margin-top:15px;">
        <label><strong>Mission Points:</strong></label>
        <textarea name="kris_li_mission_points" rows="4" style="width:100%;"><?php echo esc_textarea($mission_points); ?></textarea>
        <p>Enter one point per line (e.g., Integrity, Excellence, Responsibility).</p>
    </div>
    <div style="margin-top:15px;">
        <label><strong>Image URL:</strong></label>
        <input type="text" name="kris_li_mission_image" value="<?php echo esc_url($mission_image); ?>" style="width:100%;" />
        <?php if ($mission_image): ?>
            <div style="margin-top:10px;">
                <img src="<?php echo esc_url($mission_image); ?>" style="max-width:100%; height:auto;" />
            </div>
        <?php endif; ?>
    </div>
    <?php
}

function kris_li_save_mission_section_meta($post_id) {
    if (
        !isset($_POST['kris_li_mission_nonce']) ||
        !wp_verify_nonce($_POST['kris_li_mission_nonce'], 'kris_li_mission_nonce_action')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save fields
    $fields = [
        '_kris_li_mission_title'     => 'kris_li_mission_title',
        '_kris_li_mission_paragraph' => 'kris_li_mission_paragraph',
        '_kris_li_mission_image'     => 'kris_li_mission_image',
        '_kris_li_mission_points'    => 'kris_li_mission_points',
    ];

    foreach ($fields as $meta_key => $post_key) {
        if (isset($_POST[$post_key])) {
            $value = $meta_key === '_kris_li_mission_points'
                ? sanitize_textarea_field($_POST[$post_key]) // Points are textarea-based
                : sanitize_text_field($_POST[$post_key]);
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_action('save_post', 'kris_li_save_mission_section_meta');

////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_team_meta_box() {
    if (!isset($_GET['post']) || $_GET['post'] != 78) return;

    // Add meta box for Page ID 78
    add_meta_box(
        'team_meta_box',          // ID of the meta box
        'Team Member Details',    // Title of the meta box
        'display_team_meta_box',  // Callback function to display the fields
        'page',                   // Screen to show the meta box (here, it's pages)
        'normal',                 // Context (normal or side)
        'high'                    // Priority (high)
    );
}
add_action('add_meta_boxes', 'add_team_meta_box');

function display_team_meta_box($post) {
    // Add nonce for security
    wp_nonce_field('team_meta_box_nonce', 'team_meta_box_nonce_field');

    // Retrieve existing data if available
    $team_one_name = get_post_meta($post->ID, '_team_one_name', true);
    $team_one_position = get_post_meta($post->ID, '_team_one_position', true);
    $team_one_image = get_post_meta($post->ID, '_team_one_image', true);

    $team_two_name = get_post_meta($post->ID, '_team_two_name', true);
    $team_two_position = get_post_meta($post->ID, '_team_two_position', true);
    $team_two_image = get_post_meta($post->ID, '_team_two_image', true);
    ?>

    <div class="team-member-wrapper" style="display: flex; gap: 30px;">
        <!-- Team Member 1 -->
        <div class="team-member">
            <h3>Team Member 1</h3>
            <p>
                <label for="team_one_name">Team Member Name</label>
                <input type="text" name="team_one_name" id="team_one_name" value="<?php echo esc_attr($team_one_name); ?>" class="widefat" />
            </p>
            <p>
                <label for="team_one_position">Position</label>
                <input type="text" name="team_one_position" id="team_one_position" value="<?php echo esc_attr($team_one_position); ?>" class="widefat" />
            </p>
            <p>
                <label for="team_one_image">Image URL</label>
                <input type="text" name="team_one_image" id="team_one_image" value="<?php echo esc_attr($team_one_image); ?>" class="widefat" />
            </p>
        </div>

        <!-- Team Member 2 -->
        <div class="team-member">
            <h3>Team Member 2</h3>
            <p>
                <label for="team_two_name">Team Member Name</label>
                <input type="text" name="team_two_name" id="team_two_name" value="<?php echo esc_attr($team_two_name); ?>" class="widefat" />
            </p>
            <p>
                <label for="team_two_position">Position</label>
                <input type="text" name="team_two_position" id="team_two_position" value="<?php echo esc_attr($team_two_position); ?>" class="widefat" />
            </p>
            <p>
                <label for="team_two_image">Image URL</label>
                <input type="text" name="team_two_image" id="team_two_image" value="<?php echo esc_attr($team_two_image); ?>" class="widefat" />
            </p>
        </div>
    </div>

    <?php
}

function save_team_meta_box_data($post_id) {
    // Check if nonce is set
    if (!isset($_POST['team_meta_box_nonce_field'])) {
        return $post_id;
    }
    $nonce = $_POST['team_meta_box_nonce_field'];

    // Verify the nonce
    if (!wp_verify_nonce($nonce, 'team_meta_box_nonce')) {
        return $post_id;
    }

    // Don't save the data if auto-saving
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Save data for Team Member 1
    if (isset($_POST['team_one_name'])) {
        update_post_meta($post_id, '_team_one_name', sanitize_text_field($_POST['team_one_name']));
    }
    if (isset($_POST['team_one_position'])) {
        update_post_meta($post_id, '_team_one_position', sanitize_text_field($_POST['team_one_position']));
    }
    if (isset($_POST['team_one_image'])) {
        update_post_meta($post_id, '_team_one_image', esc_url_raw($_POST['team_one_image']));
    }

    // Save data for Team Member 2
    if (isset($_POST['team_two_name'])) {
        update_post_meta($post_id, '_team_two_name', sanitize_text_field($_POST['team_two_name']));
    }
    if (isset($_POST['team_two_position'])) {
        update_post_meta($post_id, '_team_two_position', sanitize_text_field($_POST['team_two_position']));
    }
    if (isset($_POST['team_two_image'])) {
        update_post_meta($post_id, '_team_two_image', esc_url_raw($_POST['team_two_image']));
    }

    return $post_id;
}
add_action('save_post', 'save_team_meta_box_data');
