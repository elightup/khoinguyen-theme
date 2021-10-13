<?php
$nganh_hang = rwmb_meta( 'chon_nganh_hang' );

if ( ! $nganh_hang ) {
	return;
}

foreach( $nganh_hang as $value ) :
	if ( $value->count == 0 ) {
		continue;
	}
	?>
	<section class="home_filter danh-muc-nganh-hang">
		<div class="box_title">
			<h2 class="title"><?php echo $value->name; ?></h2>
			<?php kn_nganh_hang_children( $value->term_id ); ?>
			<div class="box-btn">
			<a href="" class="btn-xemthem">
				Xem tất cả
			</a>
		</div>
		</div>
		<div class="box_filter">
			<div class="product_list-filter ">
				<?php
				ob_start();
				$args = [
					'post_type'      => 'product',
					'posts_per_page' => 10,
					'tax_query'      => [
						[
							'taxonomy' => 'nganh-hang',
							'field'    => 'id',
							'terms'    => $value->term_id,
						]
					],
				];

				$query = new WP_Query( $args );
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/content', 'product' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

<?php endforeach; ?>