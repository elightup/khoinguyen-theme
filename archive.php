<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package khoinguyen
 */

get_header();
get_sidebar();
?>
	
	<main id="primary" class="main site-main">

		<?php 
		kn_get_path();
		if ( have_posts() ) : ?>

			<div class="box_filter"><?php kn_nganh_hang_children( get_queried_object_id() ); ?></div>
			<header class="page-header">
				<?php echo '<h1 class="page-title">' . single_cat_title( '', false ) . '</h1>'; ?>
				<div class="fb-like" data-href="<?php echo get_term_link( get_queried_object_id(), 'nganh-hang' ); ?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div>
			</header><!-- .page-header -->


			<div class="post-list grid grid--4">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
			?>
			</div>
			<?php
			the_posts_pagination();
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
