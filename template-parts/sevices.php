<?php
/**
 * Template Name: Services
 */
get_header()
 ?>
<!-- services-page-template.php -->
 <section class="section-one wrapper">
    <div class="info-section">
      <h1>About Kris & Li – Excellence in Every Clean</h1>
      <p>
        We are the leaders of mobile app development in Australia. With over 15 years of expertise developing mobile apps, we’ve created over 380 apps for clients across a broad range of industries.
      </p>
      <a href="#" class="btn-know-more">Know More ➡</a>
    </div>
    <div class="image-container">
    <div class="section-one-image-section ">
        <img src="<?php echo get_template_directory_uri(); ?>/images/section1.png" alt="Why Choose Us Image">
      </div>
    </div>
  </section>

  <section class="what-we-offer wrapper">
  <div class="what-we-offer__intro">
    <h2 class="what-we-offer__heading">What We Offer</h2>
    <p class="what-we-offer__subtitle">
      We are an Australian web design agency that offers full-service solutions for clients worldwide.
    </p>
  </div>

  <div class="what-we-offer__card">
    <div class="what-we-offer__image-wrapper">
      <img src="https://via.placeholder.com/400x250" alt="offer image" class="what-we-offer__image">
    </div>

    <div class="what-we-offer__title">
      <h3>Web Design</h3>
    </div>

    <div class="what-we-offer__description">
      We create beautiful, user-friendly websites designed to grow your business.
    </div>

    <div class="what-we-offer__button">
      <a href="#" class="btn btn--primary">Know More ➡</a>
    </div>
  </div>

  <div class="what-we-offer__card">
    <div class="what-we-offer__image-wrapper">
      <img src="https://via.placeholder.com/400x250" alt="offer image" class="what-we-offer__image">
    </div>

    <div class="what-we-offer__title">
      <h3>SEO Optimization</h3>
    </div>

    <div class="what-we-offer__description">
      Our expert SEO strategies ensure that your website ranks higher in search results.
    </div>

    <div class="what-we-offer__button">
      <a href="#" class="btn btn--primary">Know More ➡</a>
    </div>
  </div>

  <div class="what-we-offer__card">
    <div class="what-we-offer__image-wrapper">
      <img src="https://via.placeholder.com/400x250" alt="offer image" class="what-we-offer__image">
    </div>

    <div class="what-we-offer__title">
      <h3>E-commerce Solutions</h3>
    </div>

    <div class="what-we-offer__description">
      Build a successful online store with our tailored e-commerce services.
    </div>

    <div class="what-we-offer__button">
      <a href="#" class="btn btn--primary">Know More ➡</a>
    </div>
  </div>
</section>


<section id="medical-cleaning">
  <h2>Medical Facilities</h2>
  <p>...Your content here...</p>
</section>

<section id="warehouse-cleaning">
  <h2>Warehouse Cleaning</h2>
  <p>...Your content here...</p>
</section>

<section id="office-cleaning">
  <h2>Office Cleaning</h2>
  <p>...Your content here...</p>
</section>



<?php get_template_part('template-parts/statistics'); ?>

<?php get_template_part('template-parts/meet-our-team'); ?>
<?php get_template_part('template-parts/testimonials'); ?>

<?php get_footer() ?>