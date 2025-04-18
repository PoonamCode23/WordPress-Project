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
					<img src="<?php echo get_template_directory_uri(); ?>/images/Vector.svg" alt="Kris & Li Logo" />
					<p>Specialised cleaning solutions for healthcare facilities and other commercial premises.</p>
				</div>

				<div class = "footer-link-section">
					<div class = "quick-links">
						<ul class = "footer-list">
							<li><b>Quick Links</b></li>
							<li>Home</li>
							<li>About Us</li>
							<li>Service</li>
							<li>Contact</li>
						</ul>
					</div>
					<div class="service">
						<ul class = "footer-list">
							<li><b>Services</b></li>
							<li>Medical Facilities</li>
							<li>Office Cleaning</li>
							<li>Strata Cleaning</li>
							<li>Wellness & Studio Cleaning</li>
							<li>Warehouse Cleaning</li>
						</ul>
					</div>
					<div class="contact">
						<ul class = "footer-list">
							<li><b>Contact Us</b></li>
							<li>Sydney, NSW, Australia</li>
							<li>8923- 1028-123</li>
							<li>8923- 1028-123</li>
							<li>support@krisli.com.au</li>
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
