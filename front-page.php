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
         <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/slider.jpeg" alt="Slide 1"></div>
         <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/slide2.jpg" alt="Slide 2"></div>
         <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/slide3.jpg" alt="Slide 3"></div>
      </div>
      <div class ="banner-description">
               <?php if ( ! empty( $styled_paragraph ) ) : ?>
                     <p class="styled-paragraph"><?php echo esc_html( $styled_paragraph ); ?></p>
               <?php endif; ?>

               <?php if ( ! empty( $main_text ) ) : ?>
                     <h1 class="main-text"><?php echo esc_html( $main_text ); ?></h1>
               <?php endif; ?>

               <?php if ( ! empty( $third_banner_text ) ) : ?>
                     <p class="third-banner-text"><?php echo esc_html( $third_banner_text ); ?></p>
               <?php endif; ?>

         <button class="contact-button">Get in Touch</button>
      </div>
   </section>

  
   <?php
// Retrieve the ribbon logos from post meta
$logo_urls = get_post_meta(get_the_ID(), '_ribbon_logos', true);

// Check if there are any logos to display
if (!empty($logo_urls) && is_array($logo_urls)) {
    ?>
    <div class="ribbon">
        <div class="ribbon-content">
            <div class="title">Trusted by <span style="color: #0066ff">100+ businesses.</span></div>
            <div class="logos">
                <?php foreach ($logo_urls as $logo_url) : ?>
                    <?php if (!empty($logo_url)) : ?>
                        <img src="<?php echo esc_url($logo_url); ?>" alt="Logo" class="logo">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}
?>
   <div class="about-us-container">
  <!-- Left Column: Text Content -->
  <div class="info-section">
    <span class="label">About Us</span>
    <?php 
    $about_us_title = get_post_meta(get_the_ID(), '_about_us_title', true);
$about_us_description = get_post_meta(get_the_ID(), '_about_us_description', true);
$image_url = get_post_meta(get_the_ID(), '_about_us_image_url', true);

    if ( ! empty( $about_us_title ) ) : ?>
      <h2><?php echo esc_html( $about_us_title ); ?></h2>
      <?php endif; ?>
      <?php if ( ! empty( $about_us_description ) ) : ?>
        <p >
          <?php echo esc_html( $about_us_description ); ?>
        </p>
    <?php endif; ?>
  
    <a href="#" class="btn-know-more">Know More ➡</a>

  </div>

  <!-- Right Column: Image -->
  <div class="image-section">
    <div class="peach-background"></div>
    <img src="<?php echo esc_url($image_url); ?>" class="img" alt="Person cleaning window" />
  </div>
</div>



</main>

<?php
get_footer();
?>

  

