<?php
get_header()
?>

<div id="main" class="site-main ">
	<header class="page-header">
		<h1 class="page-title">Kết quả tìm kiếm cho: "<?php the_search_query() ?>"</h1>
		<?php kn_get_path(); ?>
	</header>
	<div class="box-seach-product row">
		<div class="col-sm-4 col-md-3">
			<h2 class="title-taxonomy">Danh mục sản phẩm</h2>
			<div class="product-taxonomy">
				<?php
				$type_products = get_terms( array(
					'taxonomy' => 'nganh-hang',
					'hide_empty' => false
				) );
				foreach ( $type_products as $type_product ) :
				?>
					<div class="product-taxonomy__item">
						<a href="<?php echo get_term_link( $type_product->slug, 'nganh-hang' ); ?>"><?php echo $type_product->name; ?></a>
					</div>
				<?php endforeach ?>
			</div>

		</div>
		<div class="col-sm-8 col-md-9">
			<?php if ( have_posts() ) : ?>
				<div class="products-list">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'product' );
					endwhile;
					?>
				</div>
			<?php
				the_posts_pagination( array(
					'prev_text' => __( '<i class="bi bi-chevron-double-left"></i>', 'khoinguyen' ),
					'next_text' => __( '<i class="bi bi-chevron-double-right"></i>', 'khoinguyen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'khoinguyen' ) . ' </span>',
				) );
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>
</div>

<?php
get_footer();
