<?php
/**
 * Template Name: About Us
 */

get_header();
?>

<section class="section-one wrapper">
    <div class="info-section">
      <h1>About Kris & Li – Excellence in Every Clean</h1>
      <p>
        We are the leaders of mobile app development in Australia. With over 15 years of expertise developing mobile apps, we’ve created over 380 apps for clients across a broad range of industries.
      </p>
      <a href="#team" class="contact-button">Meet Our Team</a>
      </div>
    <div class="image-container">
    <div class="section-one-image-section ">
        <img src="<?php echo get_template_directory_uri(); ?>/images/section1.png" alt="Why Choose Us Image">
      </div>
    </div>
  </section>

  <?php if (is_page(78)) :
    $get = function($key, $default = '') {
        return get_post_meta(get_the_ID(), "_custom_stats_$key", true) ?: $default;
    };
?>
<section class="stats-section">
    
    <?php get_template_part('template-parts/statistics'); ?>
    <div class="more-features">
        <div class="intro wrapper">
            <h1><?php echo esc_html($get('intro_title')); ?></h1>
            <p><?php echo esc_html($get('intro_text')); ?></p>
        </div>

        <div class="features wrapper">
            <div class="col-one">
                <div class="image-part">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/Card.png" alt="99% Satisfied">
                </div>
            </div>
            <div class="col-two">
                <div class="card image-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/clean-image.png" alt="Cleaner in action">
                </div>
            </div>
        </div>

        <div class="feature-bottom wrapper">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div>
                    <h3><?php echo esc_html($get("feature{$i}_title")); ?></h3>
                    <p><?php echo esc_html($get("feature{$i}_desc")); ?></p>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
<?php endif; ?>


  </section>

   <section class="cleaning-solutions wrapper">
    <div class="image-cleaning-solutions">
      <img src="<?php echo get_template_directory_uri(); ?>/images/cleaning_solutions.png" alt="Our Expertise Image">
    </div>

    <div class="cleaning-info-section">
      <h1>Prioritizing Health Through Strict OHS Adherence</h1>
      <p>
        At Kris & Li Cleaning Services, we prioritize the health and safety of our clients and their environments. Our strict adherence to Occupational Health and Safety (OHS) principles ensures that we effectively prevent cross-contamination between cleaning sites and within each facility.
      </p>
      <a href="#" class="contact-button">View Services</a>
    </div>
  </section>

  <section class="mission wrapper">
    <div class="mission-info-section">
        <h1>
            <?php echo esc_html(get_post_meta(get_the_ID(), '_kris_li_mission_title', true)); ?>
        </h1>
        <p>
            <?php echo esc_html(get_post_meta(get_the_ID(), '_kris_li_mission_paragraph', true)); ?>
        </p>
        <ul class="mission-points">
            <?php
            // Get mission points from the custom field and break them into an array
            $mission_points = get_post_meta(get_the_ID(), '_kris_li_mission_points', true);
            if ($mission_points) {
                $points = explode("\n", $mission_points); // Split by line breaks
                foreach ($points as $point) {
                    echo '<li>' . esc_html(trim($point)) . '</li>';
                }
            }
            ?>
        </ul>
    </div>
    <div class="image-mission">
        <img src="<?php echo esc_url(get_post_meta(get_the_ID(), '_kris_li_mission_image', true)); ?>" alt="Our Expertise Image">
    </div>
</section>

<?php get_template_part('template-parts/meet-our-team'); ?>

<?php get_footer(); ?>
