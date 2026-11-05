<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hero
 */

?>


	
	<?php
	get_sidebar( 'footer' );
			?>

	<footer id="colophon" class="site-footer">
	
	<div class="container">
	
	
		<div class="site-info">
			<?php _e( 'Copyright', 'hero' ); ?> <?php echo date_i18n(__('Y','hero')); ?> <?php echo esc_html(get_theme_mod('total_footer_title')); ?> | <?php _e( 'Powered by', 'hero' ); ?> <a href="http://www.wordpress.org"><?php _e( 'WordPress', 'hero' ); ?></a> | <?php _e( 'hero theme by', 'hero' ); ?> <a href="https://www.themeszen.com"><?php _e( 'themeszen', 'hero' ); ?></a>
		</div><!-- .site-info -->
		
	</div><!-- .container -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
