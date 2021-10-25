<?php
/**
 * The template for displaying all single product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package khoinguyen
 */
get_header();
?>

	<main id="primary" class="main site-main">
		<?php kn_get_path(); ?>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content-single-product' );
		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
<?php
get_footer();