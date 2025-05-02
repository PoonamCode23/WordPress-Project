<?php
/**
 * Template Name: FAQ
 */
get_header()
?>
<div class = "faq-title">
<h1 class="privacy-policy-title">Frequently Asked Questions</h1>
</div>
<div class="faq-section">

<?php
if (is_page(156)) {
    $faqs = get_post_meta(get_the_ID(), '_custom_faqs', true);
    if (!empty($faqs)) {
        echo '<div class="faq-section">';
        foreach ($faqs as $index => $faq) {
            echo '<details' . ($index === 1 ? ' open' : '') . '>';
            echo '<summary>' . esc_html(($index + 1) . '. ' . $faq['question']) . '</summary>';
            echo '<p>' . esc_html($faq['answer']) . '</p>';
            echo '</details>';
        }
        echo '</div>';
    }
}
?>
  <button class="load-more">Load More</button>
</div>

<?php get_footer() ?>


