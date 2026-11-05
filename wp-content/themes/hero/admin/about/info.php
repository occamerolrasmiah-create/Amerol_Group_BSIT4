<?php
/**
 * Info setup
 *
 * @package hero
 */

if ( ! function_exists( 'hero_info_setup' ) ) :

	/**
	 * Info setup.
	 *
	 * @since 1.0.0
	 */
	function hero_info_setup() {

		$config = array(

			// Welcome content.
			'welcome_content' => sprintf( esc_html__( 'A very neat and clean black and red business theme. The theme is fully responsive that looks great on any device. The theme supports widgets. And features theme-options, threaded-comments and multi-level dropdown menu. A simple and neat typography. Uses WordPress custom menu, header image, and background. Get free support on https://themeszen.com/?page_id=33', 'hero' ), 'hero' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'hero' ),
				'support'         => esc_html__( 'Support', 'hero' ),
				'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'hero' ),
				),

			// Quick links.
			'quick_links' => array(
				'theme_url' => array(
					'text' => esc_html__( 'Theme Details', 'hero' ),
					'url'  => 'https://themeszen.com/hero-theme/',
					),
				'demo_url' => array(
					'text' => esc_html__( 'View Demo', 'hero' ),
					'url'  => 'https://demos.themeszen.com/hero/',
					),
				'documentation_url' => array(
					'text' => esc_html__( 'View Documentation', 'hero' ),
					'url'  => 'https://themeszen.com/hero-docs/',
					),
				),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'hero' ),
					'icon'        => 'dashicons dashicons-arrow-right',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'hero' ),
					'button_text' => esc_html__( 'View Documentation', 'hero' ),
					'button_url'  => 'https://themeszen.com/hero-docs/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'hero' ),
					'icon'        => 'dashicons dashicons-arrow-right',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'hero' ),
					'button_text' => esc_html__( 'Static Front Page', 'hero' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'hero' ),
					'icon'        => 'dashicons dashicons-arrow-right',
					'description' => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'hero' ),
					'button_text' => esc_html__( 'Customize', 'hero' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Theme Preview', 'hero' ),
					'icon'        => 'dashicons dashicons-arrow-right',
					'description' => esc_html__( 'Check the theme demo here.', 'hero' ),
					'button_text' => esc_html__( 'View Demo', 'hero' ),
					'button_url'  => 'https://demos.themeszen.com/hero/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			// Support.
			'support' => array(
				'one' => array(
					'title'       => esc_html__( 'Contact Support', 'hero' ),
					'icon'        => 'dashicons dashicons-arrow-right',
					'description' => esc_html__( 'Got theme support question, you can email us through our contact us form.', 'hero' ),
					'button_text' => esc_html__( 'Contact Support', 'hero' ),
					'button_url'  => 'https://themeszen.com/contact-us/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			// Upgrade content.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'hero' ),
				'button_text' => esc_html__( 'Buy Pro from ThemesZen', 'hero' ),
				'button_url'  => 'https://themeszen.com/hero-theme/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),
			);

		hero_Info::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'hero_info_setup' );
