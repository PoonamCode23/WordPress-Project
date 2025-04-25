<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package poonam_themes
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Link to Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'poonam_themes' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			
			<?php if ( is_front_page() ) : ?>
				<!-- Show both logos for scroll effect on front page -->
			 <div class="logo logo-default">
				<?php the_custom_logo()?>
			 </div>

			 	<img class="alternate-logo logo-scrolled" src="<?php echo get_template_directory_uri(); ?>/images/logo2.svg" alt="Logo 2">
			<?php else : ?>
				<!-- Just show the alternate logo for inner pages -->
				<a href="http://localhost/wordpress/" class="alternate-logo-link">
  					 <img class="alternate-logo" src="<?php echo get_template_directory_uri(); ?>/images/logo2.svg" alt="Logo 2">
				</a>
				
			<?php endif; ?>
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$poonam_themes_description = get_bloginfo( 'description', 'display' );
			if ( $poonam_themes_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $poonam_themes_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation <?php echo is_front_page() ? 'nav-front' : 'nav-inner'; ?>">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<?php esc_html_e( 'Primary Menu', 'poonam_themes' ); ?>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>


			<!-- Moblie Menu -->
			<!-- <div class="mobile-menu">
				<div class="mobile-menu-toggle">
					<i class="fas fa-bars fa-2x"></i>
				</div> -->
				<!-- <div class="mobile-menu-items">
					<ul class="mobile-menu-list"> 
						<li>
						<a href ="#"> Home </a>
						</li>
						<li>
						<a href ="#"> About </a>
						</li>
						<li>
						<a href ="#"> Our Services </a>
							<ul class="submenu">
								<li><a href="#">Medical Cleaning</a></li>
								<li><a href="#">Warehouse Cleaning</a></li>
								<li><a href="#">Office Cleaning</a></li>
							</ul>
						</li>
						<li>
						<a href ="#"> Contact Us </a>
						</li>
					</ul>-->
				<!-- </div>
			</div> -->
		</nav><!-- #site-navigation -->


<!-- mobile nav -->
<div class="mobile-nav">
	<div class="mobile-menu-toggle">
	<i class="fas fa-bars fa-2x mobile-icon <?php echo is_front_page() ? 'icon-white' : 'icon-black'; ?>"></i>
	</div>

	
</div>

    <nav class="mobile-nav-container">
        <?php 
            wp_nav_menu([
                'theme_location' => 'menu-1',
                'menu_class' => 'mobile-menu'// adding class where u can add css as well.
            ]);
        ?>
    </nav>
</div>

	</header><!-- #masthead -->
