<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package poonam_themes
 */

?>

	<footer id="colophon" class="site-footer ">
		<div class="footer-image">
			<div class = "footer__contact-us">
				<h2> Contact us today! </h2>
				<p>Become part of a group of passionate people passionately crafting exceptional experiences they’re passionate about. </p>
				<a href = "#" class="footer-button"> Get in touch </a>
			</div>
		</div>
			<div class = "main-footer-section wrapper">
				<div class ="footer-branding">
					<div class="footer-logo">
					<?php the_custom_logo(); ?>
					</div>
				<p>Specialised cleaning solutions for healthcare facilities and other commercial premises.</p>
				</div>

				<div class="footer-link-section">
						<div class="quick-links">
							<ul class="footer-list">
								<li><h4>Quick Links</h4></li>
								<?php
								wp_nav_menu([
									'theme_location' => 'footer_quick_links',
									//WordPress usually wraps the menu in a <div class="menu-xyz-container"> automatically.

									//This disables that container. 
									'container' => false,
									'items_wrap' => '%3$s',//%3$s is a placeholder for just the raw <li> elements.
									'fallback_cb' => false
									
								]);
								?>
							</ul>
						</div>

						<div class="service">
							<ul class="footer-list">
								<li><h4>Services</h4></li>
								<?php
								wp_nav_menu([
									'theme_location' => 'footer_services',
									'container' => false,
									'items_wrap' => '%3$s',
									'fallback_cb' => false
								]);
								?>
							</ul>
						</div>

						<div class="contact">
							<ul class="footer-list">
								<li><h4>Contact Us</h4></li>
								<?php
								wp_nav_menu([
									'theme_location' => 'footer_contact',
									'container' => false,
									'items_wrap' => '%3$s',
									'fallback_cb' => false
								]);
								?>
							</ul>
						</div>
					</div>

			</div>

			<div class="footer-bottom">
				<div class="footer-bottom-left">
					<a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a>
				</div>
				<div class="footer-bottom-right">
					<p>Copyright &copy; <?php echo date('Y'); ?> @ebpearls</p>
				</div>
			</div>

	</footer><!-- #colophon -->




<?php wp_footer(); ?>

</body>
</html>
