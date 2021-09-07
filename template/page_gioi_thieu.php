<?php

/**
 * Template Name: gioi thieu
 *
 * @package khoinguyen
 */
get_header();
?>
<?php
	kn_get_path();
?>
<main id="primary" class="site-main ">
<div class="row">
		<div class="col-8">
	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
	
	</div>
		<div class="col-4">
			<?php get_sidebar(); ?>
		</div>
</main><!-- #main -->

<?php
get_footer();