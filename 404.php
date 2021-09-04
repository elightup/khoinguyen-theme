<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package khoinguyen
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="row">

		<section class="error-404 not-found col-8">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e('Không tìm thấy trang này.', 'giathuoctot'); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e('Nội dung này không tồn tại. Hãy thử lại với đường dẫn khác', 'giathuoctot'); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
		<div class="col-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
