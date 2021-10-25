<section class="home_filter">
	<div class="box_title">
		<h2 class="title">Phân loại sản phẩm</h2>
	</div>
	<div class="box_filter">
		<?php kn_filter_home(); ?>

		<div class="product_list-filter ">
			<?php
			ob_start();
			$args = [
				'post_type'      => 'product',
				'posts_per_page' => 10,
			];

			$query = new WP_Query( $args );
			while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'template-parts/content', 'product' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<div class="box-btn">
			<a href="<?= home_url(); ?>/san-pham" class="btn-xemthem">
				Xem tất cả
			</a>
		</div>
	</div>
</section>