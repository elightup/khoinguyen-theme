<?php

/**
 * Template Name: Home page
 *
 * @package khoinguyen
 */

if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
	return;
}
get_header();
	get_template_part( 'template-parts/home/baner' );
	get_template_part( 'template-parts/home/banchay' );
	// get_template_part('template-parts/home/filterProduct');
	get_template_part( 'template-parts/home/danh-muc' );

get_footer();
