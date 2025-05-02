<?php
/**
 * Template Name: Services
 */
get_header()
 ?>
<!-- services-page-template.php -->
<section  class="section-one wrapper">
  <div class="info-section">
    <h1>Some of the Latest Machinery We Use</h1>
    <p>
      Whether you require meticulous medical cleaning, reliable warehouse maintenance, or professional office cleaning, our skilled team is here to provide a spotless and hygienic space. Discover our wide range of services below.
    </p>
    <div class="button-group">
      <a href="#" class="contact-button">See Services</a>
      <a href="#" class="btn-know-more about-us">About Us</a>
    </div>
  </div>
  <div class="image-container">
    <div class="section-one-image-section">
      <img src="<?php echo get_template_directory_uri(); ?>/images/latest-technology.png" alt="Latest Technology">
    </div>
  </div>
</section>

<section class="whychoose-section ">
  <div class="whychoose-container wrapper">
    <h1 >Why choose us</h1>
    <div class="whychoose-cards">
      
      <div class="whychoose-card">
        <div class="whychoose-image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/icons/1.png" alt="Experienced Team">
        </div>
        <h3 class="whychoose-card-title">Experienced Team</h3>
        <p class="whychoose-card-text">
          The process of managing a task through its life cycle. It involves planning, testing, tracking. The process of managing a task through its life cycle. It involves planning, testing, tracking.
        </p>
      </div>
      
      <div class="whychoose-card">
        <div class="whychoose-image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/icons/2.svg" alt="Commitment to Quality">
        </div>
        <h3 class="whychoose-card-title">Commitment to Quality</h3>
        <p class="whychoose-card-text">
          The process of managing a task through its life cycle. It involves planning, testing, tracking. The process of managing a task through its life cycle. It involves planning, testing, tracking.
        </p>
      </div>
      
      <div class="whychoose-card">
        <div class="whychoose-image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/icons/3.png" alt="Eco-Friendly Practices">
        </div>
        <h3 class="whychoose-card-title">Eco-Friendly Practices</h3>
        <p class="whychoose-card-text">
          The process of managing a task through its life cycle. It involves planning, testing, tracking. The process of managing a task through its life cycle. It involves planning, testing, tracking.
        </p>
      </div>

    </div>
  </div>
</section>



<!-- Services Sections -->
<section class = "cleaning-services">
      <h1>Our Cleaning Services</h1>
      <p>We are an Australian web design agency that offers full-service solutions for clients worldwide.</p>
      
      <div class="services-tab">
  <?php
  $services = new WP_Query(array(
    'post_type' => 'cleaning_service',
    'posts_per_page' => -1,
  ));

  if ($services->have_posts()) :
    while ($services->have_posts()) : $services->the_post();
      ?>
      <button class="icon-button" onclick="scrollToSection('<?php echo sanitize_title(get_the_title()); ?>')">
          <img class="default-icon" style="margin-right:20px;" src="<?php echo get_template_directory_uri(); ?>/images/icons/office-icon.png" alt="Default Icon">
          <img class="hover-icon" style="margin-right:20px;" src="<?php echo get_template_directory_uri(); ?>/images/icons/white-icon.svg" alt="Hover Icon">
          <?php the_title(); ?>
      </button>

    <?php endwhile;
    wp_reset_postdata();
  endif;
  ?>
</div>

<!-- Services Sections -->
<?php
$services = new WP_Query(array(
  'post_type' => 'cleaning_service',
  'posts_per_page' => -1,
));

if ($services->have_posts()) :
  while ($services->have_posts()) : $services->the_post();
    $service_id = sanitize_title(get_the_title());
    ?>
    <section id="<?php echo esc_attr($service_id); ?>" class="services-section">
      <div class="services-inner wrapper">
        <div class="services-thumb">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large'); ?>
          <?php else : ?>
            <img src="https://via.placeholder.com/400x300?text=<?php echo urlencode(get_the_title()); ?>" alt="<?php the_title_attribute(); ?>">
          <?php endif; ?>
        </div>
        <div class="section-content">
          <h2><?php the_title(); ?></h2>
          <p><?php the_content(); ?></p>
          <a href="#" class="btn-know-more">Get Started <span class="icon-right"></span></a>
        </div>
      </div>
</section>

  <?php endwhile;
  wp_reset_postdata();
endif;
?>


    
</section>

<?php get_template_part('template-parts/statistics'); ?>

<section class="mission wrapper">
  <div class="mission-info-section">
    <h1>Commercial Cleaning Services</h1>
    <p>
    Our mission is to enhance the quality and safety of your environment through superior cleaning solutions. We aim to exceed client expectations by paying meticulous attention to detail, using advanced equipment, and employing eco-friendly cleaning practices.he highest standards of safety and professionalism in every task we undertake.
    </p>
    <ul class="mission-points">
      <li><b>Tailored to individual needs:</b> We operate with transparency and honesty in all our dealings.</li>
      <li><b>Attention to details:</b> We strive for the highest standards of quality in every aspect of our service.</li>
      <li><b>Disinfecting:</b>Providing a clean and safe environment for our clients while being mindful of our environmental impact.</li>
      <li><b>Consistent and integrated :</b>Providing a clean and safe environment for our clients while being mindful of our environmental impact.</li>
    </ul>
  </div>
  <div class="image-services">

  <img src="<?php echo get_template_directory_uri(); ?>/images/cleaning_solutions.png" alt="Commitment to Quality">
  </div>
</section>

<section class="mission mission-services wrapper">

  <div class="image-services">
  <img src="<?php echo get_template_directory_uri(); ?>/images/section2.jpeg" alt="Commitment to Quality">  </div>
  <div class="mission-info-section">
    <h1>Pricing Information: Transparent Pricing</h1>
    <p>
    Our mission is to enhance the quality and safety of your environment through superior cleaning solutions. We aim to exceed client expectations by paying meticulous attention to detail, using advanced equipment, and employing eco-friendly cleaning practices.
    </p>
    <ul class="mission-points">
      <li><b>Tailored to individual needs:</b> We operate with transparency and honesty in all our dealings.</li>
      <li><b>Attention to details:</b> We strive for the highest standards of quality in every aspect of our service.</li>
      <li><b>Disinfecting:</b>Providing a clean and safe environment for our clients while being mindful of our environmental impact.</li>
      <li><b>Consistent and integrated :</b>Providing a clean and safe environment for our clients while being mindful of our environmental impact.</li>
    </ul>
  </div>
  
</section>


<?php get_template_part('template-parts/meet-our-team'); ?>
<?php get_template_part('template-parts/testimonials'); ?>


<?php get_footer() ?>
