<?php
function khoinguyen_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="hidden updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Đăng vào %s', 'post date', 'khoinguyen' ),
		$time_string
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function khoinguyen_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'khoinguyen' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function khoinguyen_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'khoinguyen' ) );
		if ($categories_list) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'khoinguyen' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'khoinguyen' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'khoinguyen' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( !is_single() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'khoinguyen' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		echo '</span>';
	}
}

function khoinguyen_post_thumbnail() {
	if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->
	<?php else : ?>
	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
		the_post_thumbnail(
			'post-thumbnail',
			array(
				'alt' => the_title_attribute(
					array(
						'echo' => false,
					)
				),
			)
		);
		?>
	</a>
	<?php
	endif; // End is_singular().
}

function khoinguyen_get_categrory() {
	$terms = rwmb_meta( 'nganh_hang_show', [ 'object_type' => 'setting' ], 'setting' );
	?>
	<div class="category">
		<div class="category-menu">
			<div class="category-menu-icon">
				<img src="<?php echo get_template_directory_uri(); ?>/images/menu.png" alt="">
			</div>
			<p class="category-menu-title">Danh mục sản phẩm</p>
		</div>
		<div class="filter-category">
			<ul>
				<?php foreach ( $terms as $term ) :
					$childrens = get_term_children( $term->term_id, 'nganh-hang' );
				?>
				<li data-tab="<?php echo $term->slug ?>">
					<?php
					if ( $childrens ) : ?>
						<div class="filter-category__children d-flex">
							<?php foreach ( $childrens as $children ) :
								$term_child = get_term_by( 'id', $children, 'nganh-hang' );
							?>
								<div class="category__children-item d-flex">
									<?php
									$image = rwmb_meta( 'image_nganh_hang', ['object_type' => 'term'], $children );
									if ( $image ) :
										$link_image = wp_get_attachment_image_url( $image['ID'], 'thumbnail' );
										?>
										<img src="<?php echo $link_image; ?>" alt="">
									<?php endif; ?>
									<a href="<?php echo get_term_link( $term_child->slug, 'nganh-hang' ); ?>"><?php echo $term_child->name; ?></a>
								</div>
							<?php endforeach; ?>
						</div>
						<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" class="svg-inline--fa fa-angle-right fa-w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path></svg>
					<?php endif; ?>
					<a href="<?php echo get_term_link( $term->slug, 'nganh-hang' ); ?>"><?php echo $term->name; ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php

}

function kn_entry_title() {
	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
}
function kn_filter_home() {
	$terms = get_terms( array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,
	) );
	?>

	<div class="filter-category">
		<ul>
			<?php foreach ( $terms as $term ) : ?>
			<li data-tab="<?php echo $term->slug ?>">
				<a href="<?php echo get_term_link( $term->slug, 'nganh-hang' ); ?>"><?php echo $term->name; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

function kn_nganh_hang_children( $parent ) {
	$terms = get_term_children( $parent, 'nganh-hang' );
	if ( ! $terms ) {
		return;
	}
	?>

	<div class="filter-category">
		<ul>
			<?php foreach ( $terms as $key => $term_id ) :
				if ( $key > 4 && is_front_page() ) {
					break;
				}
				$term = get_term_by( 'id', $term_id, 'nganh-hang' );
			?>
			<li>
				<a href="<?php echo get_term_link( $term_id, 'nganh-hang' ); ?>"><?php echo $term->name; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
}

function kn_filter_khuyenmai() {
	$terms = get_terms( array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,
	) );
	?>

	<div class="filter-category_khuyenmai">
		<h4>Danh mục: </h4>
		<ul>
			<?php foreach ( $terms as $term ) : ?>
			<li data-tab="<?php echo $term->slug ?>">
				<?php echo $term->name; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
}

// Output các option ra và mark option nào được chọn.
function kn_filter_nganh_hang() {
	$terms = get_terms( array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,
	) );

	if ( empty( $terms ) || !is_array( $terms ) ) {
		return;
	}

	$selected = isset( $_GET['filter-nganh-hang'] ) ? wp_strip_all_tags( $_GET['filter-nganh-hang'] ) : '';
	?>
	<select name="filter-nganh-hang">
		<option value="">Ngành hàng</option>
		<?php foreach ( $terms as $term ) : ?>
		<option value="<?php echo esc_attr( $term->slug ) ?>" <?php selected( $term->slug, $selected ) ?>>
			<?php echo $term->name; ?>
		</option>
		<?php endforeach; ?>
	</select>
	<?php
}
function kn_filter_sap_xep() {
	$selected = isset( $_GET['filter-sap-xep'] ) ? wp_strip_all_tags( $_GET['filter-sap-xep'] ) : '';
	?>
	<select name="filter-sap-xep">
		<option value="">Sắp xếp</option>
		<option value="1" <?php selected( '1', $selected ) ?>>Sản phẩm mới nhất</option>
		<option value="2" <?php selected( '2', $selected ) ?>>Sản phẩm cũ nhất</option>
		<option value="3" <?php selected( '3', $selected ) ?>>Giá từ thấp tới cao</option>
		<option value="4" <?php selected( '4', $selected ) ?>>Giá từ cao tới thấp</option>
	</select>
	<?php
}
function kn_filter_gia() {
	$selected = isset( $_GET['filter-gia'] ) ? wp_strip_all_tags( $_GET['filter-gia'] ) : '';
	?>
	<select name="filter-gia">
		<option value="">Giá</option>
		<option value="1" <?php selected( '1', $selected ) ?>>Dưới 1 triệu</option>
		<option value="1-3" <?php selected( '1-3', $selected ) ?>>Từ 1-3 triệu</option>
		<option value="3-5" <?php selected( '3-5', $selected ) ?>>Từ 3-5 triệu</option>
		<option value="5-10" <?php selected( '5-10', $selected ) ?>>Từ 5-10 triệu</option>
		<option value="10" <?php selected( '10', $selected ) ?>>Trên 10 triệu</option>
	</select>
	<?php
}
function kn_filter_hang() {
	$terms = get_terms( array(
		'taxonomy'   => 'hang',
		'hide_empty' => false,
	) );

	if ( empty( $terms ) || !is_array( $terms ) ) {
		return;
	}

	$selected = isset( $_GET['filter-hang'] ) ? wp_strip_all_tags( $_GET['filter-hang'] ) : '';
	?>
	<select name="filter-hang">
		<option value="">Thương hiệu</option>
		<?php foreach ( $terms as $term ) : ?>
		<option value="<?php echo esc_attr( $term->slug ) ?>" <?php selected( $term->slug, $selected ) ?>>
			<?php echo $term->name; ?>
		</option>
		<?php endforeach; ?>
	</select>
	<?php
}

function kn_filter() {
	$filter = [
		'so_cap_loc' => [
			'name'  => 'Số cấp lọc',
			'value' => [
				'5'  => '5',
				'6'  => '6',
				'7'  => '7',
				'8'  => '8',
				'9'  => '9',
				'10' => '10',
				'11' => '11',
			],
		],
		'kieu_lap_dat' => [
			'name'  => 'Kiểu lắp đặt',
			'value' => [
				'de_ban'  => 'Để bàn',
				'tu_dung' => 'Tủ đứng',
				'lap_am'  => 'Lắp âm'
			]
		],
		'loai_may' => [
			'name'  => 'Loại máy',
			'value' => [
				'loc_nong_lanh'       => 'Máy lọc tích hợp nóng lạnh',
				'loc_hydrogen'        => 'Máy lọc nước Hydrogen',
				'loc_ion_kiem'        => 'Máy lọc nước Ion kiềm',
				'loc_ban_cong_nghiep' => 'Máy lọc nước bán công nghiệp',
				'loc_nuoc_man'        => 'Máy lọc nước mặn, nước lợ',
				'loc_dau_nguon'       => 'Lọc đầu nguồn',
			]
		],
		'cong_nghe_loc' => [
			'name'  => 'Công nghệ lọc',
			'value' => [
				'ro'      => 'RO',
				'nano'    => 'Nano',
				'uf'      => 'UF',
				'ket_hop' => 'RO kết hợp điện phân',
			]
		],
		'color' => [
			'name'  => 'Màu sắc',
			'value' => [
				'white'  => 'Trắng',
				'black'  => 'Đen',
				'red'    => 'Đỏ',
				'yellow' => 'Vàng',
				'blue'   => 'Xanh',
				'pink'   => 'Hồng',
				'orange' => 'Cam',
				'silver' => 'Bạc',
			],
		],
		'tinh_nang' => [
			'name'  => 'Tính năng',
			'value' => [
				'voi_nuoc_nguoi'         => 'Có vòi nước nguội',
				'khoa_voi_nong'          => 'Có khóa vòi nóng',
				'ngan_mat_chua_do'       => 'Có ngăn mát chứa đồ',
				'ngan_chua_do_khu_trung' => 'Có ngăn chứa đồ khử trùng',
				'ngan_chua_do'           => 'Có ngăn chứa đồ',
			]
		],
		'color_nhabep' => [
			'name'  => 'Màu sắc',
			'value' => [
				'white'  => 'Trắng',
				'black'  => 'Đen',
				'red'    => 'Đỏ',
				'yellow' => 'Vàng',
				'blue'   => 'Xanh',
				'pink'   => 'Hồng',
				'orange' => 'Cam',
				'silver' => 'Bạc',
			],
		],
		'dung_tich' => [
			'name'  => 'Dung tích',
			'value' => [
				'2'    => 'Dưới 2 lít',
				'2-5'  => 'Từ 2 lít đến 5 lít',
				'5-10' => 'Từ 5 lít đến 10 lít',
				'10'   => 'Trên 10 lít'
			]
		],
		'bang_dieu_khien' => [
			'name'  => 'Bảng điều khiển',
			'value' => [
				'nut_xoay' => 'Nút xoay',
				'phim_co'  => 'Phím cơ, nút nhấn điều khiển',
				'cam_ung'  => 'Cảm ứng'
			]
		],
		'dung_tich_su_dung' => [
			'name'  => 'Dung tích sử dụng',
			'value' => [
				'20'    => 'Dưới 20 lít',
				'20-30' => 'Từ 20 lít đến 30 lít',
				'30'    => 'Trên 30 lít',
			]
		],
		'color_mayloc' => [
			'name'  => 'Màu sắc',
			'value' => [
				'white'  => 'Trắng',
				'black'  => 'Đen',
				'red'    => 'Đỏ',
				'yellow' => 'Vàng',
				'blue'   => 'Xanh',
				'pink'   => 'Hồng',
				'orange' => 'Cam',
				'silver' => 'Bạc',
			],
		],
		'pham_vi_loc' => [
			'name'  => 'Phạm vi lọc hiệu quả',
			'value' => [
				'20'    => 'Dưới 20m2',
				'20-30' => 'Từ 20m2 đến 30m2',
				'30-40' => 'Từ 30m2 đến 40m2',
				'40'    => 'Trên 40m2',
			]
		],
		'dung_tich_binh_chua' => [
			'name'  => 'Dung tích bình chứa',
			'value' => [
				'10'    => 'Dưới 10 lít',
				'10-25' => 'Từ 10 lít đến 25 lít',
				'25-50' => 'Từ 25 lít đến 50 lít',
				'50'    => 'Trên 50 lít'
			]
		],
		'dien_tich' => [
			'name'  => 'Diện tích làm mát',
			'value' => [
				'20'    => 'Dưới 20m2',
				'20-30' => 'Từ 20m2 đến 30m2',
				'30-50' => 'Từ 30m2 đến 50m2',
				'50'    => 'Trên 50m2',
			]
		],
		'dieu_khien' => [
			'name'  => 'Điều khiển',
			'value' => [
				'phim_co'    => 'Phím cơ',
				'dieu_khien' => 'Điều khiển từ xa'
			]
		],
		'cong_suat' => [
			'name'  => 'Công suất',
			'value' => [
				'100'     => 'Dưới 100W',
				'100-200' => '100-200W',
				'200'     => 'Trên 200W'
			]
		],
		'color_giadung' => [
			'name'  => 'Màu sắc',
			'value' => [
				'white'  => 'Trắng',
				'black'  => 'Đen',
				'red'    => 'Đỏ',
				'yellow' => 'Vàng',
				'blue'   => 'Xanh',
				'pink'   => 'Hồng',
				'orange' => 'Cam',
				'silver' => 'Bạc',
			],
		],
		'loai_may_dieu_hoa' => [
			'name'  => 'Loại máy',
			'value' => [
				'1_chieu' => '1 chiều',
				'2_chieu' => '2 chiều',
			]
		],
		'dien_tich_phong_dh' => [
			'name'  => 'Diện tích phòng phù hợp',
			'value' => [
				'15'    => 'Dưới 15m2',
				'15-20' => 'Từ 25m2 đến 20m2',
				'20-30' => 'Từ 20m2 đến 30m2',
				'30-40' => 'Từ 30m2 đến 40m2',
				'40'    => 'Trên 40m2',
			]
		],
		'cong_nghe_inverter' => [
			'name'  => 'Công nghệ Inverter',
			'value' => [
				'yes' => 'Có Inverter',
				'no'  => 'Không có Inverter',
			]
		],
		'dung_tich_su_dung_tu_lanh' => [
			'name'  => 'Dung tích sử dụng',
			'value' => [
				'150'     => 'Dưới 150 lít',
				'150-300' => 'Từ 150 lít đến 300 lít',
				'300-450' => 'Từ 30 lít đến 450 lít',
				'450'     => 'Trên 450 lít',
			]
		],
		'so_ngan' => [
			'name'  => 'Số ngăn',
			'value' => [
				'1_ngan_dong'       => '1 ngăn đông',
				'1_ngan_dong_1_mat' => '1 ngăn đông - 1 ngăn mát',
			]
		],
	];
	return $filter;
}

function kn_custom_filter() {
	$parent_id     = get_queried_object()->parent;
	$term_id       = !empty( $parent_id ) ? $parent_id : get_queried_object_id();
	$custom_filter = rwmb_meta( 'select_filter', ['object_type' => 'term'], $term_id );
	if ( ! $custom_filter ) {
		return;
	}

	$total_filter = kn_filter();
	foreach ( $custom_filter as $filter ) :
		$selected = isset( $_GET['filter-' . $filter ] ) ? wp_strip_all_tags( $_GET['filter-' . $filter ] ) : '';
	?>
		<select name="filter-<?php echo $filter ?>">
			<option value=""><?php echo $total_filter[$filter]['name']; ?></option>
			<?php foreach ( $total_filter[$filter]['value'] as $key => $value ) : ?>
			<option value="<?php echo esc_attr( $key ) ?>" <?php selected( $key, $selected ) ?>>
				<?php echo $value; ?>
			</option>
			<?php endforeach; ?>
		</select>
	<?php endforeach;
}


function kn_get_path() {
	echo '<div class="box_path">';
	yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
	echo '</div>';
}

function kn_get_mota() {
	$mota = rwmb_meta( 'mo_ta' );
	if ( empty( $mota ) ) {
		return;
	}
	?>
	<div class="content-mota">
		<?= wp_kses_post( $mota ) ?>
	</div>
	<?php
}

function kn_currency_format( $number ) {
	return number_format( $number, 0, ',', '.' ) . ' ₫';
}

function kn_get_posts_categrory() {
	$terms = get_the_terms( get_the_ID(), 'nganh-hang' );

	$ids = array_map( function ( $term ) {
		return $term->term_id;
	}, $terms );
	$args  = array(
		'posts_per_page' => 10,
		'post_type'      => 'product',
		'post__not_in'   => array( get_the_ID() ),
		'tax_query'      => [
			[
				'taxonomy' => 'nganh-hang',
				'field'    => 'id',
				'terms'    => $ids,
			]
		]
	);
	$query = new WP_Query( $args );
	if ( ! $query->have_posts() ) {
		return;
	}
	while ( $query->have_posts() ) :
		$query->the_post();
		get_template_part( 'template-parts/content', 'product' );
	endwhile;
	wp_reset_postdata();
}

function kn_get_phantram( $so1, $so2 ) {
	$phantram = ( ( $so1 - $so2 ) / $so1 ) * 100;

	if ( $phantram !== 'NAN' ) {
		echo '<div class="discount">';
		echo '-' . number_format( (float)$phantram, 0, '.', '' ) . '%';
		echo '</div>';
	}
}

function kn_get_select_product() {
	$args  = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
	);
	$query = new WP_Query( $args );

	if ( !$query->have_posts() ) {
		return;
	}
	?>
	<div class="select-product">
		<div class="select-product-title left">
			<p class="lable">Chọn sản phẩm để so sánh</p>
			<button id="filter" class="btn_select"> <i class="bi bi-caret-down-fill"></i></button>
		</div>
		<div class="seclect-product-list">
			<input type="text" id="inputFilter" />

			<div class="product-lists">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="product_item" id="product" data-title="<?php the_title(); ?>"
					data-id="<?php echo get_the_ID() ?>" data-link="<?php echo admin_url( 'admin-ajax.php' ) ?>">
					<?php the_title('<p class="product-title"  >', '</p>'); ?>
				</div>
				<?php
					endwhile;
					wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<?php
}

function kn_get_select_product2() {
	$args  = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
	);
	$query = new WP_Query( $args );
	if ( !$query->have_posts() ) {
		return;
	}
	?>
	<div class="select-product">
		<div class="select-product-title right">
			<p class="lable2">Chọn sản phẩm để so sánh</p>
			<button id="filter2" class="btn_select"> <i class="bi bi-caret-down-fill"></i></button>
		</div>
		<div class="seclect-product-list2">
			<input type="text" id="inputFilter2" />

			<div class="product-list2">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="product_item" id="product2" data-title="<?php the_title(); ?>"
					data-id="<?php echo get_the_ID() ?>" data-link="<?php echo admin_url( 'admin-ajax.php' ) ?>">
					<?php the_title( '<p class="product-title" >', '</p>' ); ?>
				</div>
				<?php
					endwhile;
					wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<?php
}
function kn_get_select_product3() {
	$args  = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
	);
	$query = new WP_Query( $args );
	if ( !$query->have_posts() ) {
		return;
	}
	?>
	<div class="select-product">
		<div class="select-product-title right">
			<p class="lable3">Chọn sản phẩm để so sánh</p>
			<button id="filter3" class="btn_select"> <i class="bi bi-caret-down-fill"></i></button>
		</div>
		<div class="seclect-product-list3">
			<input type="text" id="inputFilter3" />

			<div class="product-list3">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="product_item" id="product3" data-title="<?php the_title(); ?>"
					data-id="<?php echo get_the_ID() ?>" data-link="<?php echo admin_url( 'admin-ajax.php' ) ?>">
					<?php the_title( '<p class="product-title" >', '</p>' ); ?>
				</div>
				<?php
					endwhile;
					wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<?php
}

function load_sosanh( $id ) {
	$args = array(
		'post_type' => 'product',
		'p'         => $id,
	);

	$lable = 'filter';
	$query = new WP_Query( $args );
	while ( $query->have_posts() ) :
		$query->the_post();
		$price          = rwmb_meta( 'price', get_the_ID() );
		$price_pre_sale = rwmb_meta( 'price_pre_sale', get_the_ID() );
		$code           = rwmb_meta( 'code', get_the_ID() );
		$kithuat        = rwmb_meta( 'thong_so_so_sanh', get_the_ID() );
	?>
	<div class="filter-product-content" data-name="<?php echo get_the_title() ?>">
		<div class="filter-product-top <?php echo $lable ?>">
			<div class="box_image">
				<a class="post-thumbnail" href="<?php echo get_the_permalink(); ?>">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
				</a>
			</div>
			<div class="box_price">
				<?php if ( $price_pre_sale ) : ?>
					<span class="price-pre-sale"><?php echo kn_currency_format( $price_pre_sale ? $price_pre_sale : 0 ) ?></span>
				<?php endif; ?>
				<span class="price"><?php echo kn_currency_format( $price ? $price : 0 ) ?></span>
			</div>
			<div class="box_product-datmua">
				<?php
					$ID = get_current_user_id();
					$product_id = get_the_ID();
					$cart = get_user_meta( $ID, 'cart', true );
					if ( empty( $cart ) || !is_array( $cart ) ) {
						$cart = [];
					}
					$cart_product_id = [];

					foreach ( $cart as $key => $value ) {
						$cart_product_id[] = $key;
					}

					if ( in_array( get_the_ID(), $cart_product_id ) ) : ?>
						<a href="<?= home_url(); ?>/gio-hang" class="btn btn-them added">Đã thêm vào giỏ </a>
						<a href="<?= home_url(); ?>/gio-hang" class="btn btn-muangay" data-product="<?= $product_id; ?>">Mua
							ngay </a>
					<?php else : ?>
						<a href="#" class="btn btn-them single-add-to-cart"
							data-info="<?= esc_attr( wp_json_encode( kn_get_product_info( $product_id ) ) ); ?>"
							data-product="<?= $product_id; ?>">Thêm vào giỏ hàng</a>
						<a href="#" class="btn btn-muangay single-buynow"
							data-info="<?= esc_attr( wp_json_encode( kn_get_product_info( $product_id ) ) ); ?>"
							data-product="<?= $product_id; ?>">Mua ngay</a>
					<?php endif;
				?>
			</div>
		</div>
		<div class="filter-product-bottom">
			<div class="box_items">
				<p class="product-lable">
					Mã sản phẩm
				</p>

				<div class="product-content">
					<?php echo $code ?>
				</div>
			</div>
			<div class="box_items">
				<p class="product-lable">
					Đặc điểm nổi bật
				</p>

				<div class="product-content">
					<?php kn_get_mota() ?>
				</div>
			</div>
			<div class="box_items">
				<p class="product-lable">
					Thông số kỹ thuật
				</p>

				<div class="product-content">
					<?php echo $kithuat ?>
				</div>
			</div>
		</div>
	</div>

	<?php
	endwhile;
	wp_reset_postdata();
}


/**
 *
 * @param  [type] $excerpt [description]
 * @return [type]          [description]
 */
function kn_excerpt_more( $excerpt ) {
	return str_replace( '[&hellip;]', '...', $excerpt );
}
add_filter( 'wp_trim_excerpt', 'kn_excerpt_more' );


/**
 * Change excerpt length
 *
 * @return int
 */
function kn_excerpt_length() {
	return 20;
}
add_filter( 'excerpt_length', 'kn_excerpt_length' );

function kn_get_product_info( $id ) {
	$price      = (float) get_post_meta( $id, 'price', true );

	$price_sale = (float) get_post_meta( $id, 'flash_sale_price', true );
	$time_start = (int) rwmb_meta( 'flash_sale_time_start', '', $id );
	$time_end   = (int) rwmb_meta( 'flash_sale_time_end', '', $id );
	$time_now   = strtotime( current_time( 'mysql' ) );

	if ( $price_sale && $time_start <= $time_now && $time_now <= $time_end ) {
		$price = $price_sale;
	}

	return [
		'id'    => $id,
		'title' => get_the_title( $id ),
		'price' => intval( $price ),
		'url'   => get_post_meta( $id, 'image_url', true ),
		'link'  => get_permalink( $id ),
		'ma_sp' => get_post_meta( $id, 'ma_sp', true ),
	];
}

function kn_get_districts_from_city( $city_id ) {
	$all_districts = json_decode( file_get_contents( get_stylesheet_directory() . '/js/districts.json' ), true );
	return $all_districts[$city_id];
}

function kn_get_wards_from_district( $district_id ) {
	$all_wards = json_decode( file_get_contents( get_stylesheet_directory() . '/js/wards.json' ), true );
	return $all_wards[$district_id];
}