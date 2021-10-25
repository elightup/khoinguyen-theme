<?php

/**
 * Template Name: so sanh
 *
 * @package khoinguyen
 */
if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
	return;
}
get_header();

?>
<main id="primary" class="site-main ">
	<div class="main-title">
		<?php the_title( '<h2>', '</h2>' ) ?>
	</div>
	<?php kn_get_path(); ?>
	<div class="row product-sosanh">
		<div class="col-md-1">

		</div>
		<div class="col-md-5  product-left ">
			<?php kn_get_select_product(); ?>
			<div class="dislay-product">
				<?php
				if ( isset( $_GET['id'] ) ) {
					load_sosanh( $_GET['id'] );
				}
				?>
			</div>
		</div>
		<div class="col-md-5 product-right ">
			<?php kn_get_select_product2(); ?>
			<div class="dislay-product2"></div>
		</div>
		<!-- <div class="col-md-3  product-right product-sosanh">
			<?php //kn_get_select_product3();
			?>
			<div class="dislay-product3"></div>
		</div> -->
		<div class="col-md-1">

		</div>
	</div>
</main>
<?php

get_footer();
