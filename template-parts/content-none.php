<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package khoinguyen
 */

?>

<section class="no-results not-found">
	<?php if ( ! isset( $_GET['post_type'] ) ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'khoinguyen' ); ?></h1>
		</header><!-- .page-header -->
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
	<?php endif; ?>

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'khoinguyen' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'khoinguyen' ); ?></p>
			<form action="<?php echo esc_url( home_url() ); ?>/" method="get" class="header-search">
				<input type="hidden" name="post_type" value="product">
				<input type="text" name="s" id="quick-search" placeholder="Tìm kiếm sản phẩm">
			</form>
			<?php

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'khoinguyen' ); ?></p>
			<form action="<?php echo esc_url( home_url() ); ?>/" method="get" class="header-search">
				<input type="hidden" name="post_type" value="product">
				<input type="text" name="s" id="quick-search" placeholder="Tìm kiếm sản phẩm">
			</form>
			<?php

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
