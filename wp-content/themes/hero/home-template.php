<?php
/**
 * Template Name: Home Page
 *
 * @package hero
 */

get_header();

	$hero_home_sections = hero_home_section();

	get_template_part( 'elements/section', 'slider' );

	foreach ($hero_home_sections as $hero_home_section) {
		$hero_home_section = str_replace('hero_', '', $hero_home_section);
		$hero_home_section = str_replace('_section', '', $hero_home_section);
		get_template_part( 'elements/section', $hero_home_section );
	}

get_footer(); 