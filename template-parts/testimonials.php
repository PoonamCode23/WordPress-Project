
  <section class="testimonials-section">
    <h1>Testimonials</h1>
    <p>We are an Australian web design agency that offers full-service solutions for clients worldwide.</p>

    <?php
    // Get current page ID
    //But on the public website, your testimonials display code needs to be told to look for testimonials saved for the current page (like the service page), not just the front page.

    //If your code only looks for testimonials from the front page, then the service page won't show its own testimonials, even if you added them in the admin area.
    $current_page_id = get_the_ID();
    
    // Get testimonials from current page first
    $testimonials = get_post_meta($current_page_id, '_testimonials', true);
    
    // If empty, fall back to front page testimonials
    if (empty($testimonials)) {
        $front_page_id = get_option('page_on_front');
        $testimonials = get_post_meta($front_page_id, '_testimonials', true);
    }

    if (!empty($testimonials)) :
    ?>
      <div class="testimonial-container">
        <?php foreach ($testimonials as $testimonial) : ?>
          <div class="testimonial-card">
            <h3><?php echo esc_html($testimonial['title']); ?></h3>
            <p><?php echo esc_html($testimonial['description']); ?></p>
            <div class="author">
              <a href="#" class="author-name"><?php echo esc_html($testimonial['author_name']); ?></a><br>
              <span class="author-title"><?php echo esc_html($testimonial['author_title']); ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="slider-dots">
      <span class="dot active"></span>
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
</section>
