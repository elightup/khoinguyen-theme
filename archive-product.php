<?php

/**
 * Archive Product Template
 */

get_header();
?>

<main id="primary" class="main site-main">
	<?php kn_get_path(); ?>

	<form action="" method="get" class="filters">
		<?php
		kn_filter_nganh_hang();
		kn_filter_gia();
		kn_filter_hang();
		// kn_filter_kieu_lap_dat();
		// kn_filter_loai_may();
		kn_filter_sap_xep();
		?>
	</form>

	<div class="product-list">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'product' );
		endwhile;
		?>
	</div>
	<?php
	the_posts_pagination([
		'prev_text'          => __('<i class="bi bi-chevron-double-left"></i>', 'khoinguyen'),
		'next_text'          => __('<i class="bi bi-chevron-double-right"></i>', 'khoinguyen'),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'khoinguyen') . ' </span>',
	]);
	?>
</main>

<?php
get_footer();