<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DICE_Starter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dice' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header__inner">

			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="menu-toggle__bar"></span>
				<span class="menu-toggle__bar"></span>
				<span class="menu-toggle__bar"></span>
			</button>

			<div class="site-header__brand">
				<?php the_custom_logo(); ?>
				<?php if ( ! has_custom_logo() ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__name">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="site-header__nav main-navigation">
				<?php
				wp_nav_menu([
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => false,
				]);
				?>
			</nav>

	
			<div class="site-header__actions">
				<a href="#" class="fa-btn fa-btn--icon" aria-label="Search">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="11" cy="11" r="8"></circle>
						<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
					</svg>
				</a>
				<a href="#" class="fa-btn fa-btn--ghost fa-btn--sm">Sign In</a>
				<a href="#" class="fa-btn fa-btn--primary fa-btn--sm">Sign Up</a>
			</div>

		</div>
	</header>
