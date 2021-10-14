<?php
function khoinguyen_posted_on()
{
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if (get_the_time('U') !== get_the_modified_time('U')) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="hidden updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr(get_the_date(DATE_W3C)),
		esc_html(get_the_date()),
		esc_attr(get_the_modified_date(DATE_W3C)),
		esc_html(get_the_modified_date())
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x('Đăng vào %s', 'post date', 'khoinguyen'),
		$time_string
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function khoinguyen_posted_by()
{
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x('by %s', 'post author', 'khoinguyen'),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function khoinguyen_entry_footer()
{
	// Hide category and tag text for pages.
	if ('post' === get_post_type()) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(esc_html__(', ', 'khoinguyen'));
		if ($categories_list) {
			/* translators: 1: list of categories. */
			printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'khoinguyen') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'khoinguyen'));
		if ($tags_list) {
			/* translators: 1: list of tags. */
			printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'khoinguyen') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'khoinguyen'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);
		echo '</span>';
	}
}

function khoinguyen_post_thumbnail()
{
	if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
		return;
	}
	if (is_singular()) :
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

function khoinguyen_get_categrory()
{
	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,

	));
	?>
<div class="category">
	<div class="category-menu">
		<div class="category-menu-icon">
			<img src="<?php echo get_template_directory_uri(); ?>/images/menu.png" alt="">
		</div>
		<p class="category-menu-title">
			Danh mục sản phẩm
		</p>
	</div>
	<div class="filter-category">
		<ul>
			<?php foreach ($terms as $term) : ?>
			<li data-tab="<?php echo $term->slug ?>">
				<a href="<?php echo get_term_link($term->slug, 'nganh-hang'); ?>"><?php echo $term->name; ?></a>

			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php

}

function kn_entry_title()
{
	the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
}
function kn_filter_home()
{
	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,

	));
	?>

	<div class="filter-category">
		<h4>Danh mục: </h4>
		<ul>
			<?php foreach ($terms as $term) : ?>
			<li data-tab="<?php echo $term->slug ?>">
				<a href="<?php echo get_term_link($term->slug, 'nganh-hang'); ?>"><?php echo $term->name; ?></a>

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
			<?php foreach ( $terms as $term_id ) :
				$term = get_term_by( 'id', $term_id, 'nganh-hang' );
			?>
			<li data-tab="<?php echo $term->slug ?>">
				<a href="<?php echo get_term_link($term->slug, 'nganh-hang'); ?>"><?php echo $term->name; ?></a>

			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
}

function kn_filter_khuyenmai()
{
	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,

	));
	?>

	<div class="filter-category_khuyenmai">
		<h4>Danh mục: </h4>
		<ul>
			<?php foreach ($terms as $term) : ?>
			<li data-tab="<?php echo $term->slug ?>">
				<?php echo $term->name; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
}

// Em sửa lại các hàm output filter như thế này nhé.
// Đây là cách để output các option ra và mark option nào được chọn nhé.
function kn_filter_nganh_hang()
{
	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,
	));

	if (empty($terms) || !is_array($terms)) {
		return;
	}

	$selected = isset($_GET['filter-nganh-hang']) ? wp_strip_all_tags($_GET['filter-nganh-hang']) : '';
	?>
	<select name="filter-nganh-hang">
		<option value="">Ngành hàng</option>
		<?php foreach ($terms as $term) : ?>
		<option value="<?php echo esc_attr($term->slug) ?>" <?php selected($term->slug, $selected) ?>>
			<?php echo $term->name; ?>
		</option>
		<?php endforeach; ?>
	</select>
	<?php
}
function kn_filter_sap_xep()
{
	$selected = isset($_GET['filter-sap-xep']) ? wp_strip_all_tags($_GET['filter-sap-xep']) : '';
	?>
	<select name="filter-sap-xep">
		<option value="">Sắp xếp</option>
		<option value="1" <?php selected('1', $selected) ?>>Sản phẩm mới nhất</option>
		<option value="2" <?php selected('2', $selected) ?>>Sản phẩm cũ nhất</option>
		<option value="3" <?php selected('3', $selected) ?>>Giá từ thấp tới cao</option>
		<option value="4" <?php selected('4', $selected) ?>>Giá từ cao tới thấp</option>
	</select>
	<?php
}
function kn_filter_gia()
{
	$selected = isset($_GET['filter-gia']) ? wp_strip_all_tags($_GET['filter-gia']) : '';
	?>
	<select name="filter-gia">
		<option value="">Giá</option>
		<option value="5" <?php selected('5', $selected) ?>>Dưới 5 triệu</option>
		<option value="5-7" <?php selected('5-7', $selected) ?>>Từ 5-7 triệu</option>
		<option value="7-15" <?php selected('7-15', $selected) ?>>Từ 7-15 triệu</option>
		<option value="15" <?php selected('15', $selected) ?>>Trên 15 triệu</option>
	</select>
	<?php
}
function kn_filter_hang()
{
	$terms = get_terms(array(
		'taxonomy'   => 'hang',
		'hide_empty' => false,
	));

	if (empty($terms) || !is_array($terms)) {
		return;
	}

	$selected = isset($_GET['filter-hang']) ? wp_strip_all_tags($_GET['filter-hang']) : '';
	?>
	<select name="filter-hang">
		<option value="">Hãng</option>
		<?php foreach ($terms as $term) : ?>
		<option value="<?php echo esc_attr($term->slug) ?>" <?php selected($term->slug, $selected) ?>>
			<?php echo $term->name; ?>
		</option>
		<?php endforeach; ?>
	</select>
	<?php
}
function kn_filter_kieu_lap_dat()
{
	$terms = get_terms(array(
		'taxonomy'   => 'kieu-lap-dat',
		'hide_empty' => false,
	));

	if (empty($terms) || !is_array($terms)) {
		return;
	}

	$selected = isset($_GET['filter-kieu-lap-dat']) ? wp_strip_all_tags($_GET['filter-kieu-lap-dat']) : '';
	?>
	<select name="filter-kieu-lap-dat">
		<option value="">Kiểu lắp đặt</option>
		<?php foreach ($terms as $term) : ?>
		<option value="<?php echo esc_attr($term->slug) ?>" <?php selected($term->slug, $selected) ?>>
			<?php echo $term->name; ?>
		</option>
		<?php endforeach; ?>
	</select>
	<?php
}
function kn_filter_loai_may()
{
	$terms = get_terms(array(
		'taxonomy'   => 'loai-may',
		'hide_empty' => false,
	));

	if (empty($terms) || !is_array($terms)) {
		return;
	}

	$selected = isset($_GET['filter-loai-may']) ? wp_strip_all_tags($_GET['filter-loai-may']) : '';

	?>
	<select name="filter-loai-may">
		<option value="">Loại máy</option>
		<?php foreach ($terms as $term) : ?>
		<option value="<?php echo esc_attr($term->slug) ?>" <?php selected($term->slug, $selected) ?>>
			<?php echo $term->name; ?>
		</option>
		<?php endforeach; ?>
	</select>
	<?php
}
function kn_get_path()
{
	echo '<div class="box_path">';
	yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
	echo '</div>';
}

function kn_get_mota()
{
	$mota = rwmb_meta('mo_ta');
	if (empty($mota)) {
		return;
	}
	?>
	<div class="content-mota">
		<?= wp_kses_post($mota) ?>
	</div>
	<?php
}

function kn_currency_format($number)
{
	return number_format($number, 0, ',', '.') . ' ₫';
}

function kn_get_posts_categrory()
{
	$terms = get_the_category(get_queried_object_id());

	$ids = array_map(function ($term) {
		return $term->term_id;
	}, $terms);
	$args  = array(
		'posts_per_page' => 10,
		'post_type'      => 'product',
		'post__not_in'   => array(get_the_ID()),
		'category__in'   => $ids,
	);
	$query = new WP_Query($args);
	if (!$query->have_posts()) {
		return;
	}
	while ($query->have_posts()) :
		$query->the_post();
		get_template_part('template-parts/content', 'product');
	endwhile;
	wp_reset_postdata();
}

function kn_get_phantram($so1, $so2)
{
	$phantram = (($so1 - $so2) / $so1) * 100;

	if ($phantram !== 'NAN') {
		echo '<div class="discount">';
		echo '-' . number_format((float)$phantram, 0, '.', '') . '%';
		echo '</div>';
	}
}

function kn_get_select_product()
{
	$args  = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
	);
	$query = new WP_Query($args);

	if (!$query->have_posts()) {
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
				<?php while ($query->have_posts()) : $query->the_post(); ?>
				<div class="product_item" id="product" data-title="<?php the_title(); ?>"
					data-id="<?php echo get_the_ID() ?>" data-link="<?php echo admin_url('admin-ajax.php') ?>">
					<?php
							the_title('<p class="product-title"  >', '</p>');
							?>
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

function kn_get_select_product2()
{
	$args  = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
	);
	$query = new WP_Query($args);
	if (!$query->have_posts()) {
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
				<?php while ($query->have_posts()) : $query->the_post(); ?>
				<div class="product_item" id="product2" data-title="<?php the_title(); ?>"
					data-id="<?php echo get_the_ID() ?>" data-link="<?php echo admin_url('admin-ajax.php') ?>">
					<?php
							the_title('<p class="product-title" >', '</p>');
							?>
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
function kn_get_select_product3()
{
	$args  = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
	);
	$query = new WP_Query($args);
	if (!$query->have_posts()) {
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
				<?php while ($query->have_posts()) : $query->the_post(); ?>
				<div class="product_item" id="product3" data-title="<?php the_title(); ?>"
					data-id="<?php echo get_the_ID() ?>" data-link="<?php echo admin_url('admin-ajax.php') ?>">
					<?php
							the_title('<p class="product-title" >', '</p>');
							?>
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

	function load_sosanh($id)
	{

		$args = array(
			'post_type' => 'product',
			'p'         => $id,
		);

		$lable = 'filter';
		$query = new WP_Query($args);
		while ($query->have_posts()) :
			$query->the_post();
			$price          = rwmb_meta('price', get_the_ID());
			$price_pre_sale = rwmb_meta('price_pre_sale', get_the_ID());
			$code           = rwmb_meta('code', get_the_ID());
			$kithuat        = rwmb_meta('thong_so_so_sanh', get_the_ID());
		?>
	<div class="filter-product-content" data-name="<?php echo get_the_title() ?>">
		<div class="filter-product-top <?php echo $lable ?>">
			<div class="box_image">
				<?php khoinguyen_post_thumbnail(); ?>
			</div>
			<div class="box_price">

				<?php if( $price_pre_sale ) : ?>
					<span class="price-pre-sale"><?php echo kn_currency_format($price_pre_sale ? $price_pre_sale : 0) ?></span>
				<?php endif; ?>
				<span class="price"><?php echo kn_currency_format($price ? $price : 0) ?></span>
			</div>
			<div class="box_product-datmua">
				<?php
						$ID = get_current_user_id();
						$product_id = get_the_ID();
						$cart = get_user_meta($ID, 'cart', true);
						if (empty($cart) || !is_array($cart)) {
							$cart = [];
						}
						$cart_product_id = [];

						foreach ($cart as $key => $value) {
							$cart_product_id[] = $key;
						}

						if (in_array(get_the_ID(), $cart_product_id)) : ?>
				<a href="<?= home_url(); ?>/gio-hang" class="btn btn-them added">Đã thêm vào giỏ </a>
				<a href="<?= home_url(); ?>/gio-hang" class="btn btn-muangay" data-product="<?= $product_id; ?>">Mua
					ngay </a>
				<?php else : ?>
				<a href="#" class="btn btn-them single-add-to-cart"
					data-info="<?= esc_attr(wp_json_encode(kn_get_product_info($product_id))); ?>"
					data-product="<?= $product_id; ?>">Thêm vào giỏ hàng</a>
				<a href="#" class="btn btn-muangay single-buynow"
					data-info="<?= esc_attr(wp_json_encode(kn_get_product_info($product_id))); ?>"
					data-product="<?= $product_id; ?>">Mua ngay</a>
				<?php endif; ?>
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
					Thông số kỹ thuật
				</p>

				<div class="product-content">
					<?php kn_get_mota() ?>
				</div>
			</div>
			<div class="box_items">
				<p class="product-lable">
					Đặc điểm nổi bật
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
	function kn_excerpt_more($excerpt)
	{
		return str_replace('[&hellip;]', '...', $excerpt);
	}
	add_filter('wp_trim_excerpt', 'kn_excerpt_more');


	/**
	 * Change excerpt length
	 *
	 * @return int
	 */
	function kn_excerpt_length()
	{
		return 20;
	}
	add_filter('excerpt_length', 'kn_excerpt_length');

	function kn_get_product_info($id)
	{
		$price      = (float) get_post_meta($id, 'price', true);

		$price_sale = (float) get_post_meta($id, 'flash_sale_price', true);
		$time_start = (int) rwmb_meta('flash_sale_time_start', '', $id);
		$time_end   = (int) rwmb_meta('flash_sale_time_end', '', $id);
		$time_now   = strtotime(current_time('mysql'));

		if ($price_sale && $time_start <= $time_now && $time_now <= $time_end) {
			$price = $price_sale;
		}

		return [
			'id'    => $id,
			'title' => get_the_title($id),
			'price' => intval($price),
			'url'   => get_post_meta($id, 'image_url', true),
			'link'  => get_permalink($id),
			'ma_sp' => get_post_meta($id, 'ma_sp', true),
		];
	}

	function kn_get_districts_from_city($city_id)
	{
		$all_districts = json_decode(file_get_contents(get_stylesheet_directory() . '/js/districts.json'), true);
		return $all_districts[$city_id];
	}

	function kn_get_wards_from_district($district_id)
	{
		$all_wards = json_decode(file_get_contents(get_stylesheet_directory() . '/js/wards.json'), true);
		return $all_wards[$district_id];
	}