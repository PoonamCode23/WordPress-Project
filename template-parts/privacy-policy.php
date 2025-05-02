<?php
/**
 * Template Name: Privacy Policy
 */

get_header();
?>
<div class="privacy-title">
<h1 class="privacy-policy-title"><?php the_title(); ?></h1>
</div>
<div class="privacy-policy-container">
  <?php
  if (have_posts()) :
    while (have_posts()) : the_post();
  ?>
      
      <div class="privacy-policy-content">
        <?php the_content(); ?>
      </div>
  <?php
    endwhile;
  endif;
  ?>
</div>

<?php get_footer(); ?>

