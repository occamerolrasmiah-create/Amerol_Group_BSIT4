<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hero
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
<div id="page" class="site boxed">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hero' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
		
		<div class="site-branding">
		
		<?php $logo_image = get_custom_logo();
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) { ?>
		<?php the_custom_logo();	 ?>
	<?php } else { ?>
		<?php	if ( is_front_page() && is_home() ) :?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$hero_description = get_bloginfo( 'description', 'display' );
			if ( $hero_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $hero_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
	<?php } ?>
		</div><!-- .site-branding -->

	<!--top menu-->
<div id="menu_container">
			<nav id="site-navigation" class="main-navigation clearfix">
				<h3 class="menu-toggle"><?php _e( 'Menu', 'hero' ); ?></h3>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'fallback_cb'    => 'hero_primary_navigation_fallback',				
			) );
			?>
			</nav><!-- #site-navigation -->
		<div class="clear"></div>
	</div>

	</div><!-- .container -->			
	</header><!-- #masthead -->

					
