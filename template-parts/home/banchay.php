<section class="home_banchay">
	<div class="box_title">
		<h2 class="title">Top bán chạy</h2>
	</div>
	<div class="product_list ">
		<?php
		ob_start();
		$args = [
			'post_type' => 'product',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy'         => 'tag',
					'field'            => 'slug',
					'terms'            => array('noi-bat'),
					'include_children' => true,
					'operator'         => 'IN'
				)

			),
		];

		$query = new WP_Query( $args );
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/content', 'product' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
<?php
$banners = rwmb_meta( 'group_Banner_bottom' );
if ( empty( $banners ) ) {
	return;
}
	$img_1 = wp_get_attachment_image_url( $banners['banner_image_1'], 'full' );
	$img_2 = wp_get_attachment_image_url( $banners['banner_image_2'], 'full' );
?>

<div class="home_banner-bottom">
	<div class="box-image">
		<img src="<?=  $img_1 ?>" loading="lazy">
	</div>
	<div class="box-image">
		<img src="<?= $img_2 ?>" loading="lazy">
	</div>
</div>
