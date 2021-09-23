<?php
function khoinguyen_body_classes($classes) {
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    return $classes;
}
add_filter('body_class', 'khoinguyen_body_classes');
add_action('wp_ajax_filter', 'filter_product');
add_action('wp_ajax_nopriv_filter', 'filter_product');
function filter_product() {
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $lable = isset($_GET['lable']) ? $_GET['lable'] : false;
    $args = array(
        'post_type' => 'product',
        'p' => $id,
    );
    $query = new WP_Query($args);
    while ($query->have_posts()) :
        $query->the_post();
        $price   = rwmb_meta('price');
        $priceCV = rwmb_meta('price_nhap');
        $code    = rwmb_meta('code');
        $kithuat = rwmb_meta('thong_so');
        ?>
        <div class="filter-product-content">
            <div class="filter-product-top <?php echo $lable ?>">
                <div class="box_image">
                    <?php khoinguyen_post_thumbnail(); ?>
                </div>
                <div class="box_price">
                    <span class="price"><?php echo kn_currency_format($price ? $price : 0); ?></span>
                    <span class="price-sale"><?php echo kn_currency_format($priceCV ? $priceCV : 0) ?></span>
                </div>
                <div class="box_product-datmua">
            <?php
           $ID = get_current_user_id();
            $cart = get_user_meta( $ID, 'cart', true );
            if ( empty( $cart ) || ! is_array( $cart ) ) {
                $cart = [];
            }
            $cart_product_id = [];
            foreach ( $cart as $key => $value ) {
                $cart_product_id[] = $key;
            }
            if ( in_array( get_the_ID(), $cart_product_id ) ) : ?>
                <a href="<?= home_url(); ?>/gio-hang" class="btn btn-them">Đã thêm vào giỏ </a>
                <a href="<?= home_url(); ?>/gio-hang" class="btn btn-muangay" data-product="<?= get_the_ID(); ?>">Mua ngay </a>
            <?php else: ?>
                <a href="#" class="btn btn-them single-add-to-cart" data-product="<?= get_the_ID(); ?>">Thêm vào giỏ hàng</a>
                <a href="#" class="btn btn-muangay single-buynow" data-product="<?= get_the_ID(); ?>">Mua ngay</a>
            <?php endif; ?>
        </div>
            </div>
            <div class="filter-product-bottom">
                <div class="box_items">
                    <?php if(!$lable){
                        echo'<p class="product-lable">
                        Mã sản phẩm
                    </p>';
                    } ?>
                    <div class="product-content">
                        <?php echo $code ?>
                    </div>
                </div>
                <div class="box_items">
                <?php if(!$lable){
                        echo'<p class="product-lable">
                        Thông số kỹ thuật
                    </p>';
                    } ?>
                    <div class="product-content">
                        <?php kn_get_mota() ?>
                    </div>
                </div>
                <div class="box_items">
                <?php if(!$lable){
                        echo'<p class="product-lable">
                        Đặc điểm nổi bật
                        </p>';
                    } ?>
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
add_action( 'pre_get_posts', 'kn_filter_product_archive' );

function kn_filter_product_archive( $query ) {
	// Chỉ lọc ở trang archive product.
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'product' ) ) {
		return;
	}

	$tax_query = [
		'relation' => 'AND',		
	];
	// Lọc theo ngành hàng.
	$nganh_hang = isset( $_GET['filter-nganh-hang'] ) ? wp_strip_all_tags( $_GET['filter-nganh-hang'] ) : '';
	if ( $nganh_hang ) {
		$tax_query[] = [
			'taxonomy' => 'nganh-hang',
			'field' => 'slug',
			'terms' => $nganh_hang
		];
	}
	// Lọc theo hãng
	$hang = isset( $_GET['filter-hang'] ) ? wp_strip_all_tags( $_GET['filter-hang'] ) : '';
	if ( $hang) {
		$tax_query[] = [
			'taxonomy' => 'hang',
			'field' => 'slug',
			'terms' => $hang,
		];
	}
	// Lọc theo kiểu lắp đặt
	$kieu_lap_dat = isset( $_GET['filter-kieu-lap-dat'] ) ? wp_strip_all_tags( $_GET['filter-kieu-lap-dat'] ) : '';
	if ( $kieu_lap_dat ) {
		$tax_query[] = [
			'taxonomy' => 'kieu_lap_dat',
			'field' => 'slug',
			'terms' => $kieu_lap_dat,
		];
	}
	// Lọc theo loại m
	$loai_may = isset( $_GET['filter-loai-may'] ) ? wp_strip_all_tags( $_GET['filter-loai-may'] ) : '';
	if ( $loai_may ) {
		$tax_query[] = [
			'taxonomy' => 'loai_may',
			'field' => 'slug',
			'terms' => $loai_may,
		];
	}	
	$loai_may = isset( $_GET['filter-loai-may'] ) ? wp_strip_all_tags( $_GET['filter-loai-may'] ) : '';
	$query->set( 'tax_query', $tax_query );
	//sap xep
	$sap_xep = isset( $_GET['filter-sap-xep'] ) ? wp_strip_all_tags( $_GET['filter-sap-xep'] ) : '';
		if ($sap_xep) {
			if ($sap_xep == '1') {
				$query->set( 'order', 'DESC' );
				$query->set( 'orderby','date' ); 
			} elseif ($sap_xep == '2') {
            	$query->set('orderby', 'date');
            	$query->set('order', 'ASC' );
			} elseif ($sap_xep == '3') {
				$query->set('orderby', 'meta_value_num');
            	$query->set('order', 'ASC' );
				$query->set('meta_key', 'price');
			} elseif ($sap_xep == '4') {
				$query->set('orderby', 'meta_value_num');
            	$query->set('order', 'DESC' );
				$query->set('meta_key', 'price');
			}
		}

	// Lọc theo giá.
	$gia = isset( $_GET['filter-gia'] ) ? wp_strip_all_tags( $_GET['filter-gia'] ) : '';
	if ( $gia ) {
		$meta_query = [];
		if ( $gia == '5' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 5000000,
				'compare' => '<',
				'type' => 'NUMERIC',
			];
		} elseif ( $gia == '5-7' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 5000000,
				'compare' => '>=',
				'type' => 'NUMERIC',
			];
			$meta_query[] = [
				'key' => 'price',
				'value' => 7000000,
				'compare' => '<',
				'type' => 'NUMERIC',
			];
		} elseif ( $gia == '7-15' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 7000000,
				'compare' => '>=',
				'type' => 'NUMERIC',
			];
			$meta_query[] = [
				'key' => 'price',
				'value' => 15000000,
				'compare' => '<',
				'type' => 'NUMERIC',
			];
		} elseif ( $gia == '15' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 15000000,
				'compare' => '>=',
				'type' => 'NUMERIC',
			];
		}

		$query->set( 'meta_query', $meta_query );
	}
}