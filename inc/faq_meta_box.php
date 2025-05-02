<?php
function add_faq_meta_box() {
    $post_id = get_the_ID();
    if (get_post_type() == 'page' && $post_id == 156) {
        add_meta_box(
            'custom_faq_meta_box',
            'FAQ Section',
            'render_faq_meta_box',
            'page',
            'normal',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'add_faq_meta_box');

function render_faq_meta_box($post) {
    $faqs = get_post_meta($post->ID, '_custom_faqs', true);
    if (!is_array($faqs)) $faqs = [];

    wp_nonce_field('save_faqs_nonce_action', 'save_faqs_nonce');
    ?>
    <div id="faq-wrapper">
        <?php foreach ($faqs as $index => $faq): ?>
            <div class="faq-item">
                <input type="text" name="faq_questions[]" value="<?php echo esc_attr($faq['question']); ?>" placeholder="Question" style="width: 100%; margin-bottom: 5px;">
                <textarea name="faq_answers[]" rows="3" placeholder="Answer" style="width: 100%;"><?php echo esc_textarea($faq['answer']); ?></textarea>
                <hr>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" onclick="addFAQ()">+ Add FAQ</button>

    <script>
    function addFAQ() {
        const wrapper = document.getElementById('faq-wrapper');
        const item = document.createElement('div');
        item.classList.add('faq-item');
        item.innerHTML = `
            <input type="text" name="faq_questions[]" placeholder="Question" style="width: 100%; margin-bottom: 5px;">
            <textarea name="faq_answers[]" rows="3" placeholder="Answer" style="width: 100%;"></textarea>
            <hr>`;
        wrapper.appendChild(item);
    }
    </script>
    <?php
}
?>
<?php
function save_faq_meta_box($post_id) {
    if (!isset($_POST['save_faqs_nonce']) || !wp_verify_nonce($_POST['save_faqs_nonce'], 'save_faqs_nonce_action')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $questions = $_POST['faq_questions'] ?? [];
    $answers = $_POST['faq_answers'] ?? [];

    $faqs = [];
    for ($i = 0; $i < count($questions); $i++) {
        if (!empty($questions[$i]) && !empty($answers[$i])) {
            $faqs[] = [
                'question' => sanitize_text_field($questions[$i]),
                'answer'   => sanitize_textarea_field($answers[$i])
            ];
        }
    }

    update_post_meta($post_id, '_custom_faqs', $faqs);
}
add_action('save_post', 'save_faq_meta_box');
?>