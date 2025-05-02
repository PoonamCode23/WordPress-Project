<?php
/**
 * Template Name: Contact Us
 */

get_header();
?>
<div class="map">
<img src="<?php echo get_template_directory_uri(); ?>/images/map.png" alt="Team Member">
</div>



<div class="contact-container">
  <div class="contact-form-section">

  <?php if (isset($_GET['feedback'])) : ?>
  <a id="contact-form"></a> <!-- Moved inside and above feedback -->
  <?php
    $type = sanitize_text_field($_GET['feedback']);
    if ($type === 'success') {
        $messages = ['Thank you! Your message has been sent.'];
    } elseif ($type === 'error') {
        $messages = get_transient('contact_form_errors');
        delete_transient('contact_form_errors');
        if (!$messages) {
            $messages = ['There was an error submitting your message. Please try again.'];
        }
    }

    $class = $type === 'success' ? 'feedback-success' : 'feedback-error';

    foreach ($messages as $msg) {
        echo '<p class="feedback-message ' . esc_attr($class) . '">' . esc_html($msg) . '</p>';
    }
  ?>
<?php endif; ?>


      <form method="post" action="">
        <h1 class="contact-title">Contact Us</h1>
        <div class="contact-form-group">
          <label for="first-name">First name</label>
          <input type="text" id="first-name" name="first_name" required />
        </div>

        <div class="contact-form-group">
          <label for="last-name">Last name</label>
          <input type="text" id="last-name" name="last_name" required />
        </div>

        <div class="contact-form-group">
          <label for="email">Email address</label>
          <input type="email" id="email" name="email" required />
        </div>

        <div class="contact-form-group">
          <label for="contact-number">Contact number</label>
          <input type="text" id="contact-number" name="contact_number" />
        </div>

        <div class="contact-form-group">
          <label for="enquiry-type">What is your enquiry related to?</label>
          <input type="text" id="enquiry-type" name="enquiry_type" />
        </div>

        <div class="contact-form-group">
          <label for="subject">Subject</label>
          <input type="text" id="subject" name="subject" />
        </div>

        <div class="contact-form-group">
          <label for="enquiry">Your enquiry</label>
          <textarea id="enquiry" name="enquiry" required></textarea>
        </div>

        <div class="contact-checkbox-group">
          <input type="checkbox" id="terms" name="terms" required />
          <label for="terms">I agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></label>
        </div>

        <!-- Hidden field to detect this form -->
        <input type="hidden" name="custom_contact_form" value="1" />

        <button type="submit" class="contact-submit-button">Submit</button>
      </form>
    </div>

    <div class="contact-image-section">
      <div class="contact-image-wrapper">
        <img src="<?php echo get_template_directory_uri(); ?>/images/contact-image.png" alt="Contact Us Image">
      </div>
    </div>
  </div>


<?php get_footer(); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const feedbackMessage = document.querySelector('.feedback-message');
  if (feedbackMessage) {
    setTimeout(() => {
      const yOffset = -200;
      const y = feedbackMessage.getBoundingClientRect().top + window.pageYOffset + yOffset;
      window.scrollTo({ top: y, behavior: 'smooth' });
    }, 200); // delay to allow for layout shifts
  }
});
</script>
<style>

.feedback-success {
  color: #0066ff;
  font-weight: 600;
  font-size:34px;
  line-height: 28px;
}

.feedback-error {
  color: red;
  font-weight: 600;
  font-size:24px;
}
@media (max-width: 768px) {
  .feedback-message{
    text-align:left;
    line-height: 28px;
    
  }
  .feedback-success {
  color: #0066ff;
  font-weight: 600;
  font-size:20px;
}

.feedback-error {
  color: red;
  font-weight: 600;
  font-size:20px;
}
}
</style>


