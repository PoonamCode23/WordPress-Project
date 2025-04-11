<?php
/*
 * Template Name: Home Page
 * Description: A custom template for the homepage.
 */
get_header(); ?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Professional Cleaning Services for Your Business</h1>
            <p>We provide top-notch cleaning services for healthcare facilities and other commercial premises.</p>
            <a href="#contact" class="cta-button">Get in Touch</a>
            <div class="hero-badge">80</div>
        </div>
    </section>

    <!-- Trust Section -->
    <section class="trust-section">
        <h2>Trusted by 100+ Businesses</h2>
        <div class="trust-logos">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/walmart-logo.png" alt="Walmart">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/remote-logo.png" alt="Remote">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/disney-logo.png" alt="Disney">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gap-logo.png" alt="Gap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/goldman-sachs-logo.png" alt="Goldman Sachs">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ren-logo.png" alt="Ren">
        </div>
    </section>

    <!-- Trained & Certified Cleaners Section -->
    <section class="cleaners-section">
        <div class="cleaners-content">
            <h2>Trained & Certified Cleaners</h2>
            <p>Our cleaners undergo rigorous training to ensure they meet the highest standards of cleanliness and safety. Our team is certified in handling specialized cleaning tasks for healthcare facilities, ensuring a safe and sterile environment for your clients.</p>
            <a href="#learn-more" class="know-more">Know More</a>
        </div>
        <div class="cleaners-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cleaner-image.jpg" alt="Cleaner">
        </div>
    </section>

    <!-- Specialized Section -->
    <section class="specialized-section">
        <div class="specialized-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/specialized-image.jpg" alt="Specialized Cleaning">
        </div>
        <div class="specialized-content">
            <h2>Specialised in Medical Cleaning</h2>
            <p>We specialize in cleaning hygienic and safe environments for medical facilities, ensuring compliance with health standards. Our expertise guarantees a clean and safe space for your patients and staff.</p>
            <a href="#learn-more" class="know-more">Know More</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>