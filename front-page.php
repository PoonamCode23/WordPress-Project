<?php
/*
Template Name: Front Page
*/
get_header();

$styled_paragraph = get_post_meta( get_the_ID(), '_styled_paragraph', true );
$main_text = get_post_meta( get_the_ID(), '_main_text', true );
$third_banner_text = get_post_meta( get_the_ID(), '_third_banner_text', true );

?>

<main id="primary" class="site-main">



  <!-- Hero Slider Section -->
  <section class="hero-slider">
    <div class="slider">
      <div class="slide">
        <img src="<?php echo get_template_directory_uri(); ?>/images/slider.jpeg" alt="Slide 1">
      </div>
      <div class="slide">
        <img src="<?php echo get_template_directory_uri(); ?>/images/slide2.jpg" alt="Slide 2">
      </div>
      <div class="slide">
        <img src="<?php echo get_template_directory_uri(); ?>/images/slide3.jpg" alt="Slide 3">
      </div>
      
    </div>
  

    <div class="banner-description">
      <?php if (!empty($styled_paragraph)) : ?>
        <p class="styled-paragraph"><?php echo esc_html($styled_paragraph); ?></p>
      <?php endif; ?>

      <?php if (!empty($main_text)) : ?>
        <h1 class="main-text"><?php echo esc_html($main_text); ?></h1>
      <?php endif; ?>

      <?php if (!empty($third_banner_text)) : ?>
        <p class="third-banner-text"><?php echo esc_html($third_banner_text); ?></p>
      <?php endif; ?>

      <button class="contact-button">Get in Touch</button>
    </div>
  </section>



  <!-- Ribbon Section -->
  <?php
  $logo_urls = get_post_meta(get_the_ID(), '_ribbon_logos', true);
  if (!empty($logo_urls) && is_array($logo_urls)) :
  ?>
    <section class="ribbon">
      <div class="ribbon-content">
        <div class="title">
          Trusted by <span style="color: #0066ff">100+ businesses.</span>
        </div>
        <div class="logos">
          <?php foreach ($logo_urls as $logo_url) : ?>
            <?php if (!empty($logo_url)) : ?>
              <img src="<?php echo esc_url($logo_url); ?>" alt="Logo" class="logo">
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>



  <!-- About Us Section -->
  <section class="about-us-container wrapper">
    <div class="info-section">
      <span class="label font-wrapper">About Us</span>

      <?php
      $about_us_title = get_post_meta(get_the_ID(), '_about_us_title', true);
      $about_us_description = get_post_meta(get_the_ID(), '_about_us_description', true);
      $image_url = get_post_meta(get_the_ID(), '_about_us_image_url', true);
      ?>

      <?php if (!empty($about_us_title)) : ?>
        <h1><?php echo esc_html($about_us_title); ?></h1>
      <?php endif; ?>

      <?php if (!empty($about_us_description)) : ?>
        <p><?php echo esc_html($about_us_description); ?></p>
      <?php endif; ?>

      <a href="#" class="btn-know-more">Know More <span class="icon-right"></span></a>
    </div>
    
    <div class="image-shadow-container">
      <div class="image-section peach">
        <img src="<?php echo esc_url($image_url); ?>" class="img" alt="Person cleaning window" />
      </div>
    </div>

  </section>

  <!-- Our Expertise Section -->
  <section class="our-expertise-container wrapper">
  <div class="image-shadow-container">
    <div class="image-section blue">
      <img src="<?php echo get_template_directory_uri(); ?>/images/section2.jpeg" alt="Our Expertise Image">
    </div>
  </div>
    <div class="info-section">
      <span class="label">Our Expertise</span>
      <h1>Specialised in Medical Practice Cleaning</h1>
      <p>
        At Kris & Li Cleaning Services, we specialize in cleaning medical practices, ensuring a hygienic and safe environment for both patients and staff. In addition to our medical cleaning services, we also offer comprehensive office cleaning and strata cleaning solutions, tailored to meet the unique needs of each space.
      </p>
      <a href="#" class="btn-know-more">Know More <span class="icon-right"></span></a>
    </div>
  </section>




  <!-- Why Choose Us Section -->
  <section class="why-choose-us-container wrapper">
    <div class="info-section">
      <span class="label">Why Choose Us?</span>
      <h1>Top-Tier Cleaning Services</h1>
      <p>
        We are the leaders of mobile app development in Australia. With over 15 years of expertise developing mobile apps, we’ve created over 380 apps for clients across a broad range of industries.
      </p>
      <a href="#" class="btn-know-more">Know More <span class="icon-right"></span></a>
    </div>
    <div class="image-shadow-container">
      <div class="image-section purple">
        <img src="<?php echo get_template_directory_uri(); ?>/images/section3.jpeg" alt="Why Choose Us Image">
      </div>
      </div>
  </section>



  <!-- What We Offer Section -->
  <?php
$offers = get_post_meta(get_the_ID(), '_offers', true);
if (!empty($offers)) :
?>
<section class="what-we-offer wrapper">
  <div class="what-we-offer__intro">
    <h2 class="what-we-offer__heading">What We Offer</h2>
    <p class="what-we-offer__subtitle">
      We are an Australian web design agency that offers full-service solutions for clients worldwide.
    </p>
  </div>

  <?php foreach ($offers as $offer) : ?>
    <div class="what-we-offer__card">
      <div class="what-we-offer__image-wrapper">
<!-- if u are storing medias url just do this, no need to have get_template_directory. -->
        <img src="<?php echo esc_attr($offer['image']); ?>" alt="offer image" class="what-we-offer__image">
      </div>

      <div class="what-we-offer__title"><h3><?php echo esc_html($offer['title']); ?></h3></div>

      <div class="what-we-offer__description">
        <?php echo esc_html($offer['description']); ?>
      </div>

      <div class="what-we-offer__button">
      <a href="#" class="btn-know-more">Know More <span class="icon-right"></span></a>
      </div>
    </div>
  <?php endforeach; ?>
</section>
<?php endif; ?>




  <!-- Commitment to Safety Section -->
  <section class="commitment-container wrapper">
    <div class="image-section-commitment">
      <img src="<?php echo get_template_directory_uri(); ?>/images/bed-cleaning.jpeg" alt="Our Expertise Image">
    </div>

    <div class="info-section">
      <span class="label">Commitment to Safety</span>
      <h1>Prioritizing Health Through Strict OHS Adherence</h1>
      <p>
        At Kris & Li Cleaning Services, we prioritize the health and safety of our clients and their environments. Our strict adherence to Occupational Health and Safety (OHS) principles ensures that we effectively prevent cross-contamination between cleaning sites and within each facility.
      </p>
      <a href="#" class="contact-button">Contact Us <span class="icon-right-white"></span></a>
    </div>
  </section>



  <?php get_template_part('template-parts/testimonials'); ?>


</main>


<?php
get_footer();
?>

  

