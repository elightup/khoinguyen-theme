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

			<form action="" method="get" class="filters">
				<?php
				kn_filter_gia();
				kn_filter_hang();
				// kn_filter_kieu_lap_dat();
				// kn_filter_loai_may();
				kn_custom_filter();
				kn_filter_sap_xep();
				?>
			</form>

			<header class="page-header">
				<?php echo '<h1 class="page-title">' . single_cat_title( '', false ) . '</h1>'; ?>
				<div class="box_product-share">
					<div class="product_share-item">
						<p>Chia sẻ:</p>

						<div class="zalo-share-button icon " data-href="<?php echo get_term_link( get_queried_object_id() ); ?>" data-oaid="579745863508352884" data-layout="2" data-color="blue" data-customize="true">
							<img src="<?= get_template_directory_uri(); ?>/images/logo-zalo.jpg" alt="" sizes="50px 50px" srcset="">
						</div>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_term_link( get_queried_object_id() ); ?>" class="icon" target="_blank"> <img src="<?= get_template_directory_uri(); ?>/images/facebook.png" alt="" sizes="50px 50px"></a>

					</div>
				</div>
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
