<?php

/**
 * Archive Product Template
 */

get_header();
?>

<section id="content" class="danhmuc-sp">

	<div id="main" class="container">
	   
		<!-- Dùng 1 class của form này là đủ -->
		<form action="" method="get" class="filters">
			<div class="filters__left">
				<?php
				kn_get_path();
				kn_filter_nganh_hang();
				kn_filter_gia();
				kn_filter_hang();
				kn_filter_kieu_lap_dat();
				kn_filter_loai_may();
				kn_filter_sap_xep();
				?>
			</div>
			<div class="filters__right">
				<!-- Chỗ này hiện ô select sắp xếp theo thời gian, giá nhé -->
			</div>
		</form>
		<div class="content_product-list">
			<div class="product-list">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part('template-parts/content', 'product');
				endwhile;
				?>
			</div>
			<?php  the_posts_pagination(
					array(
						'prev_text' => __('<i class="bi bi-chevron-double-left"></i>', 'khoinguyen'),
						'next_text' => __('<i class="bi bi-chevron-double-right"></i>', 'khoinguyen'),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'khoinguyen') . ' </span>',
					)); ?>
		</div>
	</div>

	</div>


	</div>
</section>

<?php
get_footer();
