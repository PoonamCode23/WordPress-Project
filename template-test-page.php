<?php
/*
Template Name: Custom Content Page
*/

get_header(); // Load header

// Start WordPress Loop to get page content
while ( have_posts() ) : the_post();
    the_content(); // Display the page's default content
endwhile;

// Retrieve custom meta fields
$text_block = get_post_meta( get_the_ID(), '_text_block', true );
$image_block = get_post_meta( get_the_ID(), '_image_block', true );

// Display custom content (text block and image block)
if ( ! empty( $text_block ) ) {
    echo '<section class="text-block">';
    echo '<h2>Text Block</h2>';
    echo '<p>' . esc_html( $text_block ) . '</p>';
    echo '</section>';
}

if ( ! empty( $image_block ) ) {
    echo '<section class="image-block">';
    echo '<h2>Image Block</h2>';
    echo '<img src="' . esc_url( $image_block ) . '" alt="Image Block" />';
    echo '</section>';
}

get_footer(); // Load footer
?>
